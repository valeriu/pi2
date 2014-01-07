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
	
	public function enregistrer ($nom_prenom, $courriel, $mot_passe) {
		
		
	} 
	
	public function connecter ($courriel, $mot_passe) {
		$mot_passe = MD5($mot_passe);
		$idbd = $this->bd->getBD();
		//var_dump($idbd);
		$req = $idbd->prepare(	"SELECT *
                                FROM wa_utilisateurs
                                WHERE courriel = :courriel
								AND mot_passe = :mot_passe");
        
        $req->bindParam(":courriel", $courriel, PDO::PARAM_STR);
        $req->bindParam(":mot_passe", $mot_passe, PDO::PARAM_STR);
        $req->execute();
		
		return $req->fetch(PDO::FETCH_ASSOC);
		/*if($req->fetch(PDO::FETCH_BOUND)){
			
		}
		else{
			
		}*/
	}
	
	public function modifier ($id){
		
	}
	
	public function afficher ($id) {
		
	}
	
	public function afficherListe () {
		
	}
	
	public function envoyerMotPasse ($courriel) {
		
	} 
	
	public function modifierMotPasse ($courriel, $mot_passe1, $mot_passe2) {
		
	}
}

?>
