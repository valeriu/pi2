<?php
/*
 * MODÈLE USAGERS
 */

/**
 * Description de Usagers
 *
 * @author Luc Cinq-Mars
 */
class Usagers {
	private $bd;
	
	public function __construct(){
		$this->bd = BD::getInstance();
	}
	
	/**
	 * Enregistrer un nouvel usager
	 */
	public function enregistrer ($aDonnees = Array()) {
		$courriel 		= (!empty($aDonnees['courriel'])) ? $aDonnees['courriel'] : '';
		$mot_passe 		= (!empty($aDonnees['mot_passe'])) ? $aDonnees['mot_passe'] : '';
		$nom_prenom 	= (!empty($aDonnees['nom_prenom'])) ? $aDonnees['nom_prenom'] : '';
		$role 				= (!empty($aDonnees['role'])) ? intval($aDonnees['role']) : 0;
		//var_dump($_POST);
	
		//Courriel
		if(Valider::estVide($courriel)){
			throw new Exception("Entrez un courriel valide");
		}
		if(!Valider::estCourriel($courriel)){
			throw new Exception("Ce courriel est invalide");
		}
		$courriel	= trim(strip_tags($courriel));
		
		//Mot de passe
		if(Valider::estVide($mot_passe)){
			throw new Exception("Entrez un mot de passe");
		}
		if(!Valider::estEntreString($mot_passe, 6, 12)){
			throw new Exception("Mot de passe non conforme");
		}
		$mot_passe	= trim(strip_tags($mot_passe));
		//Encodage
		$mot_passe = MD5($mot_passe);
		
		//Nom prénom
		if(Valider::estVide($nom_prenom)){
			throw new Exception("Entrez votre nom et prénom");
		}
		$nom_prenom	= trim(strip_tags($nom_prenom));
		
		//Role
		if(Valider::estEntreInt($role, 0, 2)){
			throw new Exception("Entrez un nombre valide pour le rôle (0, 1 ou 2)");
		}
		$role	= trim(strip_tags($role));
		
		
		
		$idbd = $this->bd->getBD();
		//Si le courriel est déjà dans la BD
		if(!$this->verifierCourriel($courriel)){
			//Préparation de la requête d'insertion
			$aujourdhui = date("Y-m-d H:i:s");
			$req = $idbd->prepare(	"INSERT INTO wa_utilisateurs
									(id_utilisateurs, courriel, mot_passe, nom_prenom, date_entree, role, cle_reactivation, statut)
									VALUES (null, ?, ?, ? , ?, ?, null, 1)");
					
			//var_dump($req);
			$req->bindParam(1, $courriel);
			$req->bindParam(2, $mot_passe);
			$req->bindParam(3, $nom_prenom);
			$req->bindParam(4, $aujourdhui);
			$req->bindParam(5, $role);
			
			$req->execute();
			
			if($req->rowCount() > 0){
				return true;
			}
			else{
				throw new Exception("Erreur lors de l'insertion");
			}
		}
		else{
			throw new Exception("Ce courriel est déjà utilisé");
		}
	} 
	
	/**
	 * Connecter un usager
	 */
	public function connecter ($aDonnees = Array()) {
		//$courriel, $mot_passe
		//var_dump($aDonnees['courriel']);
		//var_dump($aDonnees['mot_passe']);
		$courriel 		= (!empty($aDonnees['courriel'])) ? $aDonnees['courriel'] : '';
		$mot_passe 		= (!empty($aDonnees['mot_passe'])) ? $aDonnees['mot_passe'] : '';
		
		//Courriel
		if(!Valider::estCourriel($courriel)){
			throw new Exception("Ce courriel est invalide");
		}
		
		//Mot de Passe
		if(!Valider::estEntreString($mot_passe, 6, 12)){
			throw new Exception("Mot de passe non conforme");
		}
		$mot_passe = MD5($mot_passe);
		
		$idbd = $this->bd->getBD();
		//Préparation de la requête
		$req = $idbd->prepare(	"	SELECT *
                              FROM wa_utilisateurs
                              WHERE courriel = ?
															AND mot_passe = ?
															AND statut = 1");

		//var_dump($req);
		//var_dump($courriel);
		//var_dump($mot_passe);
		$req->bindParam(1, $courriel);
		$req->bindParam(2, $mot_passe);
		$req->execute();
		$obj = $req->fetch(PDO::FETCH_ASSOC);
		
		if($obj){
			return true;
		}
    else{
			throw new Exception("Courriel ou mot de passe invalide");
		}
	}
	
	
	/**
	 * Connecter un usager ADMIN
	 */
	public function connecterAdmin ($aDonnees = Array()) {
		$courriel 		= (!empty($aDonnees['courriel'])) ? $aDonnees['courriel'] : '';
		$mot_passe 		= (!empty($aDonnees['mot_passe'])) ? $aDonnees['mot_passe'] : '';
		
		//Courriel
		if(!Valider::estCourriel($courriel)){
			throw new Exception("Ce courriel est invalide");
		}
		
		//Mot de Passe
		if(!Valider::estEntreString($mot_passe, 6, 12)){
			throw new Exception("Mot de passe non conforme");
		}
		$mot_passe = MD5($mot_passe);
		
		$idbd = $this->bd->getBD();
		//Préparation de la requête
		$req = $idbd->prepare(	"	SELECT *
                              FROM wa_utilisateurs
                              WHERE courriel = ?
															AND mot_passe = ?
															AND statut = 1
															AND (role = 1 OR role = 2)");

		//var_dump($req);
		//var_dump($courriel);
		//var_dump($mot_passe);
		$req->bindParam(1, $courriel);
		$req->bindParam(2, $mot_passe);
		$req->execute();
		
		$obj = $req->fetch(PDO::FETCH_ASSOC);
		//var_dump($obj);
		if($obj){
			return true;
		}
    else{
			throw new Exception("Courriel ou mot de passe invalide");
		}
	}
	
	/**
	 * Modifier un usager
	 */
	public function modifier ($aId, $aDonnees = Array()){
		//$aDonnees['id_utilisateurs'], $courriel, $mot_passe, $nom_prenom, $date_entree, $role, $cle_reactivation, $statut
		$id_utilisateurs 	= (!empty($aId['id_utilisateurs'])) ? $aId['id_utilisateurs'] : '';
		$courriel 				= (!empty($aDonnees['courriel'])) ? $aDonnees['courriel'] : '';
		$nom_prenom 			= (!empty($aDonnees['nom_prenom'])) ? $aDonnees['nom_prenom'] : '';
		$date_entree 			= date("Y-m-d H:i:s");
		$role 						= (!empty($aDonnees['role'])) ? intval($aDonnees['role']) : 0;
		$statut 					= (!empty($aDonnees['statut'])) ? intval($aDonnees['statut']) : 1;
		
		//ID
		if(!Valider::estInt((int)$id_utilisateurs)){
			throw new Exception("Id d'utilisateur non conforme");
		}
		
		//Courriel
		if(!Valider::estCourriel($courriel) || Valider::estVide($courriel)){
			throw new Exception("Ce courriel est invalide");
		}
		$courriel	= trim(strip_tags($courriel));
		
		//Nom
		if(Valider::estVide($nom_prenom)){
			throw new Exception("Nom, Prénom non conforme");
		}
		$nom_prenom	= trim(strip_tags($nom_prenom));
		
		//Role
		if(!Valider::estEntreInt($role, 0, 2)){
			throw new Exception("Entrez un nombre valide pour le rôle (0, 1 ou 2)");
		}
		$role	= trim(strip_tags($role));
		
		//Statut
		if(!Valider::estEntreInt($statut, 1, 2)){
			throw new Exception("Entrez un nombre valide pour le rôle (0, 1 ou 2)");
		}
		$statut	= trim(strip_tags($statut));
		
		$idbd = $this->bd->getBD();
		//Préparation de la requête
		$req = $idbd->prepare(	"UPDATE wa_utilisateurs
								SET courriel = ?, 
									nom_prenom = ?, 
									date_entree = ?, 
									role = ?, 
									statut = ?
								WHERE id_utilisateurs = ?");
        
		//var_dump($req);
		$req->bindParam(1, $courriel);
		$req->bindParam(2, $nom_prenom);
		$req->bindParam(3, $date_entree);
		$req->bindParam(4, $role);
		$req->bindParam(5, $statut);
		$req->bindParam(6, $id_utilisateurs);

		$req->execute();
		
		if($req->rowCount() > 0){
			return true;
		}
		else{
			throw new Exception("Erreur lors de la modification, recommencez(assurez-vous que le courriel est unique)");
		}
        
	}
	
	/**
	 * Afficher un usager
	 */
	public function afficher ($aDonnees = Array()) {
		//$id_utilisateurs
		$id_utilisateurs 	= (!empty($aDonnees['id_utilisateurs'])) ? $aDonnees['id_utilisateurs'] : '';
		//var_dump($id_utilisateurs);
		if(!Valider::estInt((int)$id_utilisateurs)){
			throw new Exception("Id d'utilisateur non conforme");
		}
		
		$idbd = $this->bd->getBD();
		//Préparation de la requête
		$req = $idbd->prepare(	"SELECT *
                                FROM wa_utilisateurs
                                WHERE id_utilisateurs = ?");
        
		$req->bindParam(1, $id_utilisateurs);
		$req->execute();
		$obj = $req->fetch(PDO::FETCH_ASSOC);
		
		if($obj){
			return $obj;
		}
		else{
			throw new Exception("Id d'utilisateur inexistant");
		}
	}
	
	/**
	 * Afficher la liste des usagers
	 */
	public function afficherListe () {
		$idbd = $this->bd->getBD();
		//Préparation de la requête
		$req = $idbd->prepare(	"	SELECT *
                              FROM wa_utilisateurs
															ORDER BY id_utilisateurs DESC");
        
    $req->execute();
		$aUtilisateurs = $req->fetchAll();
		
		if($aUtilisateurs){
			return $aUtilisateurs;
		}
		else{
			throw new Exception("Erreur lors de l'aquisition des données, recommencez");
		}
	}
	
	/**
	 * Envoyer un mot de passe temporaire a un usager
	 */
	public function envoyerMotPasse ($aDonnees = Array()) {
		$courriel = (!empty($aDonnees['courriel'])) ? $aDonnees['courriel'] : '';
		//var_dump($courriel);
		if(!Valider::estCourriel($courriel)){
			throw new Exception("Ce courriel est invalide");
		}
		
		$idbd = $this->bd->getBD();
		
		$idbd = $this->bd->getBD();
		//Préparation de la requête
		$reqCourriel	= $idbd->prepare(	"SELECT *
																		FROM wa_utilisateurs
																		WHERE courriel = ?");
        
		$reqCourriel->bindParam(1, $courriel);
		$reqCourriel->execute();
		$obj = $reqCourriel->fetch(PDO::FETCH_ASSOC);
		
		if($obj){
			$cle = MD5(rand(1000, 1000077777));
			$req = $idbd->prepare(	"UPDATE wa_utilisateurs
									SET cle_reactivation = ? 
									WHERE courriel = ?");
					
			//var_dump($req);
			$req->bindParam(1, $cle);
			$req->bindParam(2, $courriel);
			
			$req->execute();
			//var_dump($req->rowCount());
			if($req->rowCount() > 0){
				$to      = $courriel;
				$subject = 'Réinitialisation de mot de passe';
				$message = "Cliquez sur le lien suivant pour choisir un nouveau mot de passe:
				http://1295805.webdev.cmaisonneuve.qc.ca/Projet_Luc/index.php?pass=$cle";
				$headers = 'From: webmaster@wadagbe.com' . "\r\n" .
					'Reply-To: webmaster@wadagbe.com' . "\r\n" .
					'X-Mailer: PHP/' . phpversion();

				mail($to, $subject, $message, $headers);
				
				return true;
			}
			else{
				throw new Exception("Erreur lors de la modification, recommencez");
			}			
		}
		else{
			throw new Exception("Ce courriel n'existe pas");
		}	
		
	} 
	
	/**
	 * Modifier le mot de passe d'un usager
	 */
	public function modifierMotPasse ($aDonnees = Array()) {
		
		$courriel 		= (!empty($aDonnees['courriel'])) ? $aDonnees['courriel'] : '';
		$mot_passe1 	= (!empty($aDonnees['mot_passe1'])) ? $aDonnees['mot_passe1'] : '';
		$mot_passe2 	= (!empty($aDonnees['mot_passe2'])) ? $aDonnees['mot_passe2'] : '';

		
		if(!Valider::estCourriel($courriel)){
			throw new Exception("Ce courriel est invalide");
		}
		
		if(!Valider::estEntreString($mot_passe1, 6, 12)){
			throw new Exception("Mot de passe non conforme");
		}
		
		if(!Valider::estEntreString($mot_passe2, 6, 12)){
			throw new Exception("Mot de passe non conforme");
		}
		
		$idbd = $this->bd->getBD();
		$val = array('courriel' => $courriel, 'mot_passe' => $mot_passe1);
		if($this->connecter($val)){
			//Préparation de la requête
			$mot_passe2 = MD5($mot_passe2);
			$req = $idbd->prepare(	"UPDATE wa_utilisateurs
									SET mot_passe = ?
									WHERE courriel = ?");
	        
			//var_dump($req);
	        $req->bindParam(1, $mot_passe2);
	        $req->bindParam(2, $courriel);
			
			if($req->execute()){
				return $req->execute();
			}
			else{
				throw new Exception("Erreur lors de la modification, recommencez");
			}
		}
	}
	
	/**
	 * Vérifier l'existence d'un courriel dans la BD
	 */
	private function verifierCourriel($courriel) {
		$courriel 		= (!empty($courriel)) ? $courriel : '';
		$idbd = $this->bd->getBD();
		//Préparation de la requête
		$req = $idbd->prepare(	"SELECT *
                             FROM wa_utilisateurs
                             WHERE courriel = ?");
        
		$req->bindParam(1, $courriel);
		$req->execute();
		$obj = $req->fetch(PDO::FETCH_ASSOC);
		
		if($obj){
			return true;
		}
		else{
			return false;
		}
	}
}

?>
