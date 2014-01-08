<?php
/**
 * Description of Valider
 * Classe utilitaire avec qui nous pouvons valider les données
 *
 * @author Valeriu Tihai
 */
abstract class Valider {
	
	/**
	 * Vérifiez si la chaîne $valeur est un nombre
	 * 
	 * @param type $valeur
	 * 
	 * @return boolean 
	 */
	public function estInt($valeur) {
		return TRUE;
	}
	
	/**
	 * Vérifiez si la chaîne $valeur est un FLOAT
	 * 
	 * @param type $valeur
	 * 
	 * @return boolean
	 */
	public function estFloat($valeur) {
		return TRUE;
	}
	
	/**
	 * Vérifiez si la $valeur est negatif
	 * 
	 * @param type $valeur
	 * 
	 * @return boolean
	 */
	public function estNegatif($valeur){
		return TRUE;
	}
	
	/**
	 * Vérifiez si la longueur du $valeur est comprise entre $nb1 et $nb2
	 * 
	 * @param type $valeur
	 * @param type $nb1
	 * @param type $nb2
	 * 
	 * @return boolean
	 */
	public function estEntre($valeur, $nb1, $nb2){
		return TRUE;
	}

	/**
	 * Vérifiez si l'adresse courriel est valide
	 * 
	 * @param type $valeur
	 * @return boolean
	 */
	public function estCourriel ($valeur) {
		return TRUE;
	}
	
	/**
	 * 
	 * @param type $valeur
	 * @return boolean
	 */
	public function estDate($valeur) {
		return TRUE;
	}
	
	/**
	 * 
	 * @param type $valeur
	 * @return boolean
	 */
	public function estURL($valeur) {
		return TRUE;
	}
	
	/**
	 * 
	 * @param type $valeur
	 * @return boolean
	 */
	public function estImage($valeur) {
		return TRUE;
	}
	
	/**
	 * 
	 * @param type $valeur
	 * @return boolean
	 */
	public function estTel($valeur) {
		return TRUE;
	}
	
	/**
	 * 
	 * @param type $valeur
	 * @return boolean
	 */
	public function estRue($valeur) {
		return TRUE;
	}
	
	/**
	 * 
	 * @param type $valeur
	 * @return boolean
	 */
	public function estApp($valeur) {
		return TRUE;
	}
	
	/**
	 * 
	 * @param type $valeur
	 * @return boolean
	 */
	public function estVille($valeur) {
		return TRUE;
	}
	
	/**
	 * 
	 * @param type $valeur
	 * @return boolean
	 */
	public function estCodePostal($valeur){
		return TRUE;
	}
	
	/**
	 * 
	 * @param type $valeur
	 * @return boolean
	 */
	public function estProvince($valeur){
		return TRUE;
	}
}

?>
