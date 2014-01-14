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
	 * Vérifier l'existence d'une adresse dans la BD
	 */
	public function verifier($aDonnees = Array()){
		//telephone	rue	appartement	ville	code_postal	province

		$telephone 		= (!empty($aDonnees['telephone'])) ? $aDonnees['telephone'] : '';
		$rue 			= (!empty($aDonnees['rue'])) ? $aDonnees['rue'] : '';
		$appartement 	= (!empty($aDonnees['appartement'])) ? $aDonnees['appartement'] : '';
		$ville 			= (!empty($aDonnees['ville'])) ? $aDonnees['ville'] : '';
		$code_postal 	= (!empty($aDonnees['code_postal'])) ? $aDonnees['code_postal'] : '';
		$province 		= (!empty($aDonnees['province'])) ? $aDonnees['province'] : '';
		
		$idbd = $this->bd->getBD();
		//Préparation de la requête
		$req = $idbd->prepare(	"SELECT *
                             FROM wa_adresse
                             WHERE telephone = ?
														 AND rue = ?
														 AND appartement = ?
														 AND ville = ?
														 AND code_postal = ?
														 AND province = ?");

		//var_dump($req);
		//var_dump($telephone);
		//var_dump($rue);
		//var_dump($appartement);
		//var_dump($ville);
		//var_dump($code_postal);
		//var_dump($province);
		$req->bindParam(1, $telephone);
		$req->bindParam(2, $rue);
		$req->bindParam(3, $appartement);
		$req->bindParam(4, $ville);
		$req->bindParam(5, $code_postal);
		$req->bindParam(6, $province);
		$req->execute();
		$obj = $req->fetch(PDO::FETCH_ASSOC);
		//var_dump($req->execute());
		if($obj){
			return true;
		}
    	else{
			return false;
		}

	}
	
	/**
	 * Enregistrer une nouvelle adresse
	*/
	public function enregistrer ($aDonnees = Array()) {
		//var_dump($aDonnees);
		if($this->verifier($aDonnees)){
			$idbd = $this->bd->getBD();

			$adresse_id_adresse = $idbd->lastInsertId();
			//var_dump($adresse_id_adresse);
			//id_adresse_utilisateur	adresse_id_adresse	utilisateurs_id_utilisateurs
			$reqAdrUtil = $idbd->prepare(	"INSERT INTO wa_adresse_utilisateur
																		(adresse_id_adresse, utilisateurs_id_utilisateurs)
																		VALUES (?, ?)");
				
			//var_dump($adresse_id_adresse);
			//var_dump($id_utilisateurs);
			$reqAdrUtil->bindParam(1, $adresse_id_adresse);
			$reqAdrUtil->bindParam(2, $id_utilisateurs);
			
			$reponseAdrUtil = $reqAdrUtil->execute();
			//var_dump($reponseAdrUtil);
			if($reponseAdrUtil){
				return $reponseAdrUtil;
			}
			else{
				throw new Exception("Une erreur s'est produite lors de l'enregistrement, recommencez (adresse-utilisateurs)");
			}
		}
		else{
			$id_utilisateurs 	= (!empty($aDonnees['id_utilisateurs'])) ? $aDonnees['id_utilisateurs'] : '';
			$telephone 			= (!empty($aDonnees['telephone'])) ? $aDonnees['telephone'] : '';
			$rue 				= (!empty($aDonnees['rue'])) ? $aDonnees['rue'] : '';
			$appartement 		= (!empty($aDonnees['appartement'])) ? $aDonnees['appartement'] : '';
			$ville 				= (!empty($aDonnees['ville'])) ? $aDonnees['ville'] : '';
			$code_postal 		= (!empty($aDonnees['code_postal'])) ? $aDonnees['code_postal'] : '';
			$province 			= (!empty($aDonnees['province'])) ? $aDonnees['province'] : '';
			
			
			$idbd = $this->bd->getBD();
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
			
			$reponse = $req->execute();
			
			if($reponse){
				$adresse_id_adresse = $idbd->lastInsertId();
				//var_dump($adresse_id_adresse);
				//id_adresse_utilisateur	adresse_id_adresse	utilisateurs_id_utilisateurs
				$reqAdrUtil = $idbd->prepare(	"INSERT INTO wa_adresse_utilisateur
																			(adresse_id_adresse, utilisateurs_id_utilisateurs)
																			VALUES (?, ?)");
					
				//var_dump($adresse_id_adresse);
				//var_dump($id_utilisateurs);
				$reqAdrUtil->bindParam(1, $adresse_id_adresse);
				$reqAdrUtil->bindParam(2, $id_utilisateurs);
				
				$reponseAdrUtil = $reqAdrUtil->execute();
				//var_dump($reponseAdrUtil);
				if($reponseAdrUtil){
					return $reponseAdrUtil;
				}
				else{
					throw new Exception("Une erreur s'est produite lors de l'enregistrement, recommencez (adresse-utilisateurs)");
				}
			}
			else{
				throw new Exception("Une erreur s'est produite lors de l'enregistrement, recommencez (adresse)");
			}
		}	
	}
	
	/**
	 * Modifier une adresse
	*/
	public function modifier ($aDonnees = Array()) {
		$id_adresse 	= (!empty($aDonnees['id_adresse'])) ? $aDonnees['id_adresse'] : '';
		$telephone 		= (!empty($aDonnees['telephone'])) ? $aDonnees['telephone'] : '';
		$rue 			= (!empty($aDonnees['rue'])) ? $aDonnees['rue'] : '';
		$appartement 	= (!empty($aDonnees['appartement'])) ? $aDonnees['appartement'] : '';
		$ville 			= (!empty($aDonnees['ville'])) ? $aDonnees['ville'] : '';
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
				foreach($idAdresses['adresse_id_adresse'] as $val){
					$reqAdresse = $idbd->prepare(	" SELECT *
																					FROM wa_adresse
																					WHERE id_adresse = ?");
			 
					$reqAdresse->bindParam(1, $idUtilisateur);
					$reqAdresse->execute();
					
					$idUtilisateur = $reqAdresse->fetchAll();
				}
			}
			else{
				return false;
			}*/
		}
		else{
			throw new Exception("Cet utilisateur n'existe pas");
		}
	}
	
	
}

?>
