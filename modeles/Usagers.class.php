<?php

/*
 * MODÈLE USAGERS
 */

/**
 * Description of Usagers
 *
 * @author Luc
 */
class Usagers {
	private $bd;
	
	public function __construct(){
		$this->bd = BD::getInstance();
		//$idbd = $this->bd; //->getBD();
		//var_dump($idbd);
	}
	
	public function enregistrer ($courriel, $mot_passe, $nom_prenom, $role=0) {
		$idbd = $this->bd->getBD();
		$mot_passe = MD5($mot_passe);
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
        return $req->execute();

		//return $req->fetch(PDO::FETCH_ASSOC);
		
	} 
	
	public function connecter ($courriel, $mot_passe) {
		$mot_passe = MD5($mot_passe);
		$idbd = $this->bd->getBD();
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
		
		return $req->fetch(PDO::FETCH_ASSOC);
	}
	
	public function modifier ($id_utilisateurs, $courriel, $mot_passe, $nom_prenom, $date_entree, $role, $cle_reactivation, $statut){
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
        
		var_dump($req);
        $req->bindParam(1, $courriel);
        $req->bindParam(2, $mot_passe);
        $req->bindParam(3, $nom_prenom);
        $req->bindParam(4, $date_entree);
        $req->bindParam(5, $role);
        $req->bindParam(6, $cle_reactivation);
        $req->bindParam(7, $statut);
        $req->bindParam(8, $id_utilisateurs);

        return $req->execute();
	}
	
	public function afficher ($id_utilisateurs) {
		$idbd = $this->bd->getBD();
		//Préparation de la requête
		$req = $idbd->prepare(	"SELECT *
                                FROM wa_utilisateurs
                                WHERE id_utilisateurs = :id_utilisateurs");
        
        $req->bindParam(":id_utilisateurs", $id_utilisateurs, PDO::PARAM_INT);
        $req->execute();
		
		return $req->fetch(PDO::FETCH_ASSOC);
	}
	
	public function afficherListe () {
		$idbd = $this->bd->getBD();
		//Préparation de la requête
		$req = $idbd->prepare(	"SELECT *
                                FROM wa_utilisateurs");
        
        $req->execute();
		$aUtilisateurs = $req->fetchAll();
		
		return $aUtilisateurs;
	}
	
	public function envoyerMotPasse ($courriel) {
		
	} 
	
	public function modifierMotPasse ($courriel, $mot_passe1, $mot_passe2) {
		$idbd = $this->bd->getBD();
		if($this->connecter($courriel, $mot_passe1)){
			//Préparation de la requête
			$mot_passe2 = MD5($mot_passe2);
			$req = $idbd->prepare(	"UPDATE wa_utilisateurs
									SET mot_passe = ?
									WHERE courriel = ?");
	        
			var_dump($req);
	        $req->bindParam(1, $mot_passe2);
	        $req->bindParam(2, $courriel);

	        return $req->execute();

		}
		else{
			return false;
		}
	}
}

?>
