<?php
/**
 * Module Valider
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
		is_int($valeur);
	}
	
	/**
	 * Vérifiez si la chaîne $valeur est un FLOAT
	 * 
	 * @param type $valeur
	 * 
	 * @return boolean
	 */
	public function estFloat($valeur) {
		is_float($valeur);
	}
	
	/**
	 * Vérifiez si la $valeur est AlphaNumerique
	 * 
	 * @param type $valeur
	 * 
	 * @return boolean
	 */
	public function estAlphaNumerique($valeur){
		ctype_alnum($valeur);
	}
	
	/**
	 * Vérifiez si la $valeur est String
	 * 
	 * @param type $valeur
	 * 
	 * @return boolean
	 */
	public function estString($valeur){
		 is_string($valeur);
	}
	
	/**
	 * Vérifiez si la $valeur est negatif
	 * 
	 * @param type $valeur
	 * 
	 * @return boolean
	 */
	public function estNegatif($valeur){
		$valeurNegatif = ($valeur < 0 ? true : false);
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
	public function estEntreString($valeur, $nb1, $nb2){
		$valeur = strlen($valeur);
		$valeurEntre = ((($nb1 <= $valeur) && ($valeur <= $nb2)) ? true : false);
	}
	
	public function estEntreInt($valeur, $nb1, $nb2){
		
		$valeurEntre = ((($nb1 >= $valeur) && ($valeur <= $nb2)) ? true : false);
	}

	/**
	 * Vérifiez si l'adresse courriel est valide
	 * 
	 * @param type $valeur
	 * @return boolean
	 */
	public function estCourriel ($valeur) {
		filter_var($valeur, FILTER_VALIDATE_EMAIL);
	}
	
	/**
	 * Vérifiez si $valeur est un date en fonction du format
	 * 
	 * URL source -> http://ca1.php.net/checkdate#113205
	 * @param type $valeur
	 * @param type $format
	 * 
	 * @return boolean
	 */
	public function estDate($valeur, $format = 'Y-m-d H:i:s') {
		$d = DateTime::createFromFormat($format, $valeur);
		return $d && $d->format($format) == $valeur;
	}
	
	/**
	 * Vérifiez si la valeur est une adresse URL
	 * 
	 * @param type $valeur
	 * 
	 * @return boolean
	 */
	public function estURL($valeur) {
		filter_var($valeur, FILTER_VALIDATE_URL);
	}
	
	/**
	 * Vérifiez si la valeur est une image
	 * 
	 * @param type $valeur
	 * 
	 * @return boolean
	 */
	public function estImage($valeur) {
		$ext = strtolower(end(explode('.', $valeur)));
			switch($ext) {
				case "jpg": 
				case "jpeg": 
				case "jpe": 
				case "png": 
				case "gif": 
				case "bmp":
					return TRUE;
					break;
				default :
					return FALSE;
			}
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
