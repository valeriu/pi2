<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Usagers
 *
 * @author valeriu
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
		//Préparation de la requête
		$aujourdhui = date("Y-m-d H:i:s");
		$req = $idbd->prepare(	"INSERT INTO wa_utilisateurs
								(id_utilisateurs, courriel, mot_passe, nom_prenom, date_entree, role, cle_reactivation, statut)
								VALUES (null, ?, ?, ? , ?, ?, null, 1)");
        
		var_dump($req);
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
                                WHERE courriel = :courriel
								AND mot_passe = :mot_passe");
        
        $req->bindParam(":courriel", $courriel, PDO::PARAM_STR);
        $req->bindParam(":mot_passe", $mot_passe, PDO::PARAM_STR);
        $req->execute();
		
		return $req->fetch(PDO::FETCH_ASSOC);
	}
	
	public function modifier ($id_utilisateurs){
		
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
		
	}
}

?>
