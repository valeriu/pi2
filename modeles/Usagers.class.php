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
	}
	
	public function enregistrer ($nom_prenom, $courriel, $mot_passe) {
		
	} 
	
	public function connecter ($courriel, $mot_passe) {
		
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
