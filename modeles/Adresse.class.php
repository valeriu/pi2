<?php

/*
 * MODÈLE ADRESSE
 */

/**
 * Description de Adresse
 *
 * @author Luc Cinq-Mars
 */
class Adresse {
	private $bd;
	
	public function __construct(){
		$this->bd = BD::getInstance();
	}
	
	
	/**
	 * Enregistrer une nouvelle adresse
	*/
	public function enregistrer ($courriel, $aDonnees = Array()) {
		//var_dump($aDonnees);
		
		$courriel				 	= (!empty($courriel)) ? $courriel : '';
		$telephone 				= (!empty($aDonnees['telephone'])) ? $aDonnees['telephone'] : '';
		$rue 							= (!empty($aDonnees['rue'])) ? $aDonnees['rue'] : '';
		$appartement 			= (!empty($aDonnees['appartement'])) ? $aDonnees['appartement'] : '';
		$ville 						= (!empty($aDonnees['ville'])) ? $aDonnees['ville'] : '';
		$code_postal 			= (!empty($aDonnees['code_postal'])) ? $aDonnees['code_postal'] : '';
		$province 				= (!empty($aDonnees['province'])) ? $aDonnees['province'] : '';

		
		if(Valider::estVide($courriel) || Valider::estVide($telephone) || Valider::estVide($rue) || Valider::estVide($ville) || Valider::estVide($code_postal) || Valider::estVide($province)){
			throw new Exception("Tous les champs sont obligatiore");
		}
		else{
			//Caractères indésirables
			$search = array(' ', '-', ',', '.');
			
			//Téléphone
			$telephone	= trim(strip_tags($telephone));
			$telephone = str_replace($search, "", $telephone);
			if((!Valider::estEntreString($telephone, 10, 10)) || (!Valider::estTel($telephone))){
				throw new Exception("Numéro de téléphone non conforme");
			}
			
			
			//Code postal
			$code_postal	= trim(strip_tags($code_postal));
			$code_postal	= str_replace($search, "", $code_postal);
			if(!Valider::estCodePostal($code_postal)){
				throw new Exception("Code Postal non conforme");
			}
			
			//estProvince
			if(!Valider::estProvince($province)){
				throw new Exception("Province invalide");
			}
			
			$idbd = $this->bd->getBD();
			
			$reqID = $idbd->prepare(	"SELECT id_utilisateurs
																	FROM wa_utilisateurs
																	WHERE courriel = ?");
	 
			$reqID->bindParam(1, $courriel);
			$reqID->execute();
			
			$id_utilisateurs = $reqID->fetch(PDO::FETCH_ASSOC);
			
			if($id_utilisateurs){
				//Préparation de la requête
				//id_adresse	telephone	rue	appartement	ville	code_postal	province
				$req = $idbd->prepare(	"INSERT INTO wa_adresse
																(id_adresse, telephone, rue, appartement, ville, code_postal, province)
																VALUES (null, ?, ?, ?, ?, ?, ?)");
						
				//var_dump($req);
				$req->bindParam(1, $telephone);
				$req->bindParam(2, $rue);
				$req->bindParam(3, $appartement);
				$req->bindParam(4, $ville);
				$req->bindParam(5, $code_postal);
				$req->bindParam(6, $province);
				
				$req->execute();
			
				if($req->rowCount() > 0){
					$adresse_id_adresse = $idbd->lastInsertId();
					//var_dump($adresse_id_adresse);
					//id_adresse_utilisateur	adresse_id_adresse	utilisateurs_id_utilisateurs
					$reqAdrUtil = $idbd->prepare(	"INSERT INTO wa_adresse_utilisateur
																				(adresse_id_adresse, utilisateurs_id_utilisateurs)
																				VALUES (?, ?)");
						
					//var_dump($adresse_id_adresse);
					//var_dump($id_utilisateurs);
					$reqAdrUtil->bindParam(1, $adresse_id_adresse);
					$reqAdrUtil->bindParam(2, $id_utilisateurs['id_utilisateurs']);
					
					$reqAdrUtil->execute();
					//var_dump($reponseAdrUtil);
					if($reqAdrUtil->rowCount() > 0){
						return true;
					}
					else{
						throw new Exception("Une erreur s'est produite lors de l'enregistrement, recommencez (adresse-utilisateurs)");
					}
				}
				else{
					throw new Exception("Une erreur s'est produite lors de l'enregistrement, recommencez (adresse)");
				}
			}
			else{
				throw new Exception("Une erreur s'est produite lors de la requête (utilisateur inexistant)");
			}
		}
				
	}
	
	/**
	 * Modifier une adresse
	*/
	public function modifier ($aDonnees = Array()) {
		$id_adresse 	= (!empty($aDonnees['id_adresse'])) ? $aDonnees['id_adresse'] : '';
		$telephone 		= (!empty($aDonnees['telephone'])) ? $aDonnees['telephone'] : '';
		$rue 					= (!empty($aDonnees['rue'])) ? $aDonnees['rue'] : '';
		$appartement 	= (!empty($aDonnees['appartement'])) ? $aDonnees['appartement'] : '';
		$ville 				= (!empty($aDonnees['ville'])) ? $aDonnees['ville'] : '';
		$code_postal 	= (!empty($aDonnees['code_postal'])) ? $aDonnees['code_postal'] : '';
		$province 		= (!empty($aDonnees['province'])) ? $aDonnees['province'] : '';
		
		//var_dump($id_adresse);
		$idbd = $this->bd->getBD();
		//Préparation de la requête
		$req = $idbd->prepare(	"UPDATE wa_adresse
                             	SET 	telephone = ?,
											rue = ?,
											appartement = ?,
											ville = ?,
											code_postal = ?,
											province = ?
								 WHERE id_adresse = ?");
		//var_dump($id_adresse);
		//var_dump($telephone);

		$req->bindParam(1, $telephone);
		$req->bindParam(2, $rue);
		$req->bindParam(3, $appartement);
		$req->bindParam(4, $ville);
		$req->bindParam(5, $code_postal);
		$req->bindParam(6, $province);												 
		$req->bindParam(7, $id_adresse);

		$req->execute();
		//var_dump($req->rowCount());
		if($req->rowCount() > 0){
			return true;
		}
		else{
			throw new Exception("Une erreur s'est produite lors de l'enregistrement, ou aucune modification n'a été apportée");
		}
	}
	
	/**
	 * Afficher une adresse
	*/
	public function afficher ($aDonnees = Array()) {
		//$id_adresse
		$id_adresse 	= (!empty($aDonnees['id_adresse'])) ? $aDonnees['id_adresse'] : '';
		
		$idbd = $this->bd->getBD();
		//Préparation de la requête
		$req = $idbd->prepare(	"SELECT *
                             FROM wa_adresse
                             WHERE id_adresse = ?");
        
		$req->bindParam(1, $id_adresse);
		$req->execute();
		$obj = $req->fetch(PDO::FETCH_ASSOC);
		
		if($obj){
			return $obj;
		}
		else{
			throw new Exception("Id d'adresse inexistant");
		}
	}
	
	/**
	 * Afficher la liste complète des adresses
	*/
	public function afficherListe () {
		$idbd = $this->bd->getBD();
		//Préparation de la requête
		$req = $idbd->prepare(	"SELECT *
                              FROM wa_adresse");
        
    $req->execute();
		
		$aAdresses = $req->fetchAll();
		if($aAdresses){
			return $aAdresses;
		}
		else{
			throw new Exception("Erreur lors de l'aquisition des données, recommencez");
		}
	}
	
	
	/**
	 * Afficher la liste complète des adresses liées a un usager
	*/
	public function afficherAdresseUsager ($aDonnees = Array()) {
		$courriel 	= (!empty($aDonnees['courriel'])) ? $aDonnees['courriel'] : '';
		$idbd = $this->bd->getBD();
		//Préparation de la requête
		$reqID = $idbd->prepare(	"SELECT id_utilisateurs
                              FROM wa_utilisateurs
															WHERE courriel = ?");
     
		$reqID->bindParam(1, $courriel);
    $reqID->execute();
		
		$idUtilisateur = $reqID->fetch(PDO::FETCH_ASSOC);
		//var_dump($idUtilisateur);
		
		if($idUtilisateur){
			
			$reqAdresses = $idbd->prepare(	" SELECT adresse_id_adresse
																				FROM wa_adresse_utilisateur
																				WHERE utilisateurs_id_utilisateurs = ?");
     
			$reqAdresses->bindParam(1, $idUtilisateur["id_utilisateurs"]);
			$reqAdresses->execute();
			
			$idAdresses = $reqAdresses->fetchAll();
			//var_dump($idAdresses);
			if($idAdresses){
				//var_dump($idAdresses[0]['adresse_id_adresse']);
				for($i = 0; $i < count($idAdresses); $i++){
					$reqAdresse = $idbd->prepare(	" SELECT *
																					FROM wa_adresse
																					WHERE id_adresse = ?
																					AND statut = 1");
			 
					$reqAdresse->bindParam(1, $idAdresses[$i]['adresse_id_adresse']);
					$reqAdresse->execute();
					
					$resultat = $reqAdresse->fetch(PDO::FETCH_ASSOC);
					
					if($resultat['statut'] == 1){
						$adressesUtilisateur[] = $resultat;
					}	
				}
				return $adressesUtilisateur;
			}
			else{
				return false;
			}
		}
		else{
			throw new Exception("Cet utilisateur n'existe pas");
		}
	}
	
	
	/**
	 * Suppression d'une adresse par un usager
	*/
	public function supprimerAdresse ($aDonnees = Array()) {
		//$id_adresse
		$id_adresse 	= (!empty($aDonnees['id_adresse'])) ? $aDonnees['id_adresse'] : '';
		
		if($id_adresse != ''){
			$idbd = $this->bd->getBD();
			//Préparation de la requête
			$req = $idbd->prepare(	"Update wa_adresse
																SET statut = 2
																WHERE id_adresse = ?");
			 
			$req->bindParam(1, $id_adresse);
			$req->execute();
			
			if($req->rowCount() > 0){
				return true;
			}
			else{
				throw new Exception("Une erreur s'est produite lors de la modification");
			}
		}	
		else{
			throw new Exception("Adresse introuvée");
		}
	
	}


	
}

?>
