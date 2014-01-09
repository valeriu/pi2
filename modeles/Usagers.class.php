<?php
/*
 * MODÈLE USAGERS
 */

/**
 * Description of Usagers
 *
 * @author Luc
 *$idbd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
 */
class Usagers {
	private $bd;
	
	public function __construct(){
		$this->bd = BD::getInstance();
		//$idbd = $this->bd; //->getBD();
		//var_dump($idbd);
	}
	
	/**
	 * Enregistrer un nouvel usager
	 */
	public function enregistrer ($aDonnees = Array()) {
		//$courriel, $mot_passe, $nom_prenom, $role=0
		//$courriel = $aDonnees['courriel'];
		//$mot_passe = MD5($aDonnees['mot_passe']);
		//$nom_prenom = $aDonnees['nom_prenom'];
		(isset($aDonnees['courriel'])) ? $courriel = $aDonnees['courriel'] : $courriel = '';
		(isset($aDonnees['mot_passe'])) ? $mot_passe = $aDonnees['mot_passe'] : $mot_passe = '';
		(isset($aDonnees['nom_prenom'])) ? $nom_prenom = $aDonnees['nom_prenom'] : $nom_prenom = '';
		(isset($aDonnees['role'])) ? $role = $aDonnees['role'] : $role = 0;
		
		if(!Valider::estCourriel($courriel)){
			throw new Exception("Ce courriel est invalide");
		}
		
		if(!Valider::estEntreString($mot_passe, 6, 12)){
			throw new Exception("Mot de passe non conforme");
		}
		
		if(!Valider::estAlphaNumerique($nom_prenom)){
			throw new Exception("Nom, Prénom non conforme");
		}
		
		if(!Valider::estInt($role)){
			throw new Exception("Entrez un chiffre valide pour le rôle Ex. 0, 1 ou 2 ");
		}
		
		$mot_passe = MD5($mot_passe);
		
		$idbd = $this->bd->getBD();
		//Préparation de la requête
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
		
		$reponse = $req->execute();
		
		if($reponse){
			return $reponse;
		}
        else{
			throw new Exception("Une erreur s'est produite lors de l'enregistrement, recommencez");
		}
		
	} 
	
	/**
	 * Connecter un usager
	 */
	public function connecter ($aDonnees = Array()) {
		//$courriel, $mot_passe
		(isset($aDonnees['courriel'])) ? $courriel = $aDonnees['courriel'] : $courriel = '';
		(isset($aDonnees['mot_passe'])) ? $mot_passe = $aDonnees['mot_passe'] : $mot_passe = '';
		
		if(!Valider::estCourriel($courriel)){
			throw new Exception("Ce courriel est invalide");
		}
		
		if(!Valider::estEntreString($mot_passe, 4, 12)){
			throw new Exception("Mot de passe non conforme");
		}
		
		$mot_passe = MD5($mot_passe);
		
		$idbd = $this->bd->getBD();
		//$idbd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		//Préparation de la requête
		$req = $idbd->prepare(	"SELECT *
                                FROM wa_utilisateurs
                                WHERE courriel = ?
								AND mot_passe = ?");

        //var_dump($req);
        //var_dump($courriel);
        //var_dump($mot_passe);
        $req->bindParam(1, $courriel);
        $req->bindParam(2, $mot_passe);
        $req->execute();
		$obj = $req->fetch(PDO::FETCH_ASSOC);
		
		if($obj){
			return $obj;
		}
        else{
			throw new Exception("Courriel ou mot de passe invalide");
		}
	}
	
	/**
	 * Modifier un usager
	 */
	public function modifier ($aDonnees = Array()){
		//$aDonnees['id_utilisateurs'], $courriel, $mot_passe, $nom_prenom, $date_entree, $role, $cle_reactivation, $statut
		
		(isset($aDonnees['id_utilisateurs'])) ? $id_utilisateurs = $aDonnees['id_utilisateurs'] : $id_utilisateurs = '';
		(isset($aDonnees['courriel'])) ? $courriel = $aDonnees['courriel'] : $courriel = '';
		(isset($aDonnees['mot_passe'])) ? $mot_passe = $aDonnees['mot_passe'] : $mot_passe = '';
		(isset($aDonnees['nom_prenom'])) ? $nom_prenom = $aDonnees['nom_prenom'] : $nom_prenom = '';
		$date_entree = date("Y-m-d H:i:s");
		(isset($aDonnees['role'])) ? $role = $aDonnees['role'] : $role = 0;
		(isset($aDonnees['cle_reactivation'])) ? $cle_reactivation = $aDonnees['cle_reactivation'] : $cle_reactivation = '';
		(isset($aDonnees['statut'])) ? $statut = $aDonnees['statut'] : $statut = 1;
		
		if(!Valider::estInt($id_utilisateurs)){
			throw new Exception("Id d'utilisateur non conforme");
		}
		
		if(!Valider::estCourriel($courriel)){
			throw new Exception("Ce courriel est invalide");
		}
		
		if(!Valider::estEntreString($mot_passe, 6, 12)){
			throw new Exception("Mot de passe non conforme");
		}
		
		if(!Valider::estAlphaNumerique($nom_prenom)){
			throw new Exception("Nom, Prénom non conforme");
		}
		
		if(!Valider::estEntreInt($role, 0, 2)){
			throw new Exception("Entrez un chiffre valide pour le rôle Ex. 0, 1 ou 2 ");
		}
		
		if(!Valider::estEntreInt($statut, 0, 1)){
			throw new Exception("Entrez un chiffre valide pour le statut Ex. 0 ou 1");
		}
		
		$idbd = $this->bd->getBD();
		//Préparation de la requête
		$req = $idbd->prepare(	"UPDATE wa_utilisateurs
								SET courriel = ?, 
									mot_passe = ?,
									nom_prenom = ?, 
									date_entree = ?, 
									role = ?, 
									cle_reactivation = ?, 
									statut = ?
								WHERE id_utilisateurs = ?");
        
		//var_dump($req);
        $req->bindParam(1, $courriel);
        $req->bindParam(2, $mot_passe);
        $req->bindParam(3, $nom_prenom);
        $req->bindParam(4, $date_entree);
        $req->bindParam(5, $role);
        $req->bindParam(6, $cle_reactivation);
        $req->bindParam(7, $statut);
        $req->bindParam(8, $id_utilisateurs);

		$reponse = $req->execute();
		
		if($reponse){
			return $reponse;
		}
		else{
			throw new Exception("Erreur lors de la modification, recommencez");
		}
        
	}
	
	/**
	 * Afficher un usager
	 */
	public function afficher ($aDonnees = Array()) {
		//$id_utilisateurs
		(isset($aDonnees['id_utilisateurs'])) ? $id_utilisateurs = $aDonnees['id_utilisateurs'] : $id_utilisateurs = '';
		
		if(!Valider::estInt($id_utilisateurs)){
			throw new Exception("Id d'utilisateur non conforme");
		}
		
		$idbd = $this->bd->getBD();
		//Préparation de la requête
		$req = $idbd->prepare(	"SELECT *
                                FROM wa_utilisateurs
                                WHERE id_utilisateurs = :id_utilisateurs");
        
        $req->bindParam(":id_utilisateurs", $id_utilisateurs, PDO::PARAM_INT);
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
		$req = $idbd->prepare(	"SELECT *
                                FROM wa_utilisateurs");
        
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
		(isset($aDonnees['courriel'])) ? $courriel = $aDonnees['courriel'] : $courriel = '';
		if(!Valider::estCourriel($courriel)){
			throw new Exception("Ce courriel est invalide");
		}
		
		$cle = MD5(rand(1000, 1000077777));
		
		$req = $idbd->prepare(	"UPDATE wa_utilisateurs
								SET cle_reactivation = ?, 
								WHERE courriel = ?");
        
		//var_dump($req);
        $req->bindParam(1, $cle_reactivation);
        $req->bindParam(2, $courriel);
		
		$reponse = $req->execute();
		
		if($reponse){
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
	
	/**
	 * Modifier le mot de passe d'un usager
	 */
	public function modifierMotPasse ($aDonnees = Array()) {
		//$courriel, $mot_passe1, $mot_passe2
		//$courriel = $aDonnees['courriel'];
		//$mot_passe1 = MD5($aDonnees['mot_passe1']);
		//$mot_passe2 = MD5($aDonnees['mot_passe2']);
		
		(isset($aDonnees['courriel'])) ? $courriel = $aDonnees['courriel'] : $courriel = '';
		(isset($aDonnees['mot_passe1'])) ? $mot_passe1 = $aDonnees['mot_passe1'] : $mot_passe1 = '';
		(isset($aDonnees['mot_passe2'])) ? $mot_passe2 = $aDonnees['mot_passe2'] : $mot_passe2 = '';
		
		if(!Valider::estCourriel($courriel)){
			throw new Exception("Ce courriel est invalide");
		}
		
		if(!Valider::estEntreString($mot_passe1, 4, 12)){
			throw new Exception("Mot de passe (1) non conforme");
		}
		
		if(!Valider::estEntreString($mot_passe2, 4, 12)){
			throw new Exception("Mot de passe (2) non conforme");
		}
		
		$idbd = $this->bd->getBD();
		$val = array('courriel' => $courriel, 'mot_passe' => $mot_passe1);
		if($this->connecter($val)){
			//Préparation de la requête
			$mot_passe2 = MD5($mot_passe2);
			$req = $idbd->prepare(	"UPDATE wa_utilisateurs
									SET mot_passe = ?
									WHERE courriel = ?");
	        
			var_dump($req);
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
}

?>
