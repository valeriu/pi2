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
		return is_int($valeur);
	}
	
	/**
	 * Vérifiez si la chaîne $valeur est un FLOAT
	 * 
	 * @param type $valeur
	 * 
	 * @return boolean
	 */
	public function estFloat($valeur) {
		return is_float($valeur);
	}
	
	/**
	 * Vérifiez si la $valeur est AlphaNumerique
	 * 
	 * @param type $valeur
	 * 
	 * @return boolean
	 */
	public function estAlphaNumerique($valeur){
		return ctype_alnum($valeur);
	}
	
	/**
	 * Vérifiez si la $valeur est String
	 * 
	 * @param type $valeur
	 * 
	 * @return boolean
	 */
	public function estString($valeur){
		 return is_string($valeur);
	}
	
	/**
	 * Vérifiez si la $valeur est negatif
	 * 
	 * @param type $valeur
	 * 
	 * @return boolean
	 */
	public function estNegatif($valeur){
		return; ($valeur < 0 ? true : false);
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
		$valeurLength = strlen($valeur);
		if (($nb1 <= $valeurLength) && ($valeurLength <= $nb2))
			return TRUE;
		return FALSE;
	}
	
	/**
	 * Vérifiez si la $valeur est comprise entre $nb1 et $nb2
	 * 
	 * @param type $valeur
	 * 
	 * @param type $nb1
	 * @param type $nb2
	 * 
	 *  @return boolean
	 */
	public function estEntreInt($valeur, $nb1, $nb2){
		if(!($nb1 >= $valeur) && ($valeur <= $nb2))
			return TRUE;
		return FALSE;
	}

	/**
	 * Vérifiez si l'adresse courriel est valide
	 * 
	 * @param type $valeur
	 * @return boolean
	 */
	public function estCourriel ($valeur) {
		return filter_var($valeur, FILTER_VALIDATE_EMAIL);
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
	 * 
	 * http://en.wikipedia.org/wiki/Telephone_numbers_in_Canada
	 * 
	 * @param type $valeur
	 * @return boolean
	 */
	public function estTel($valeur) {
		$pattern = "/^(800|844|855|866|877|888|900|403|587|780|250|604|778|236|204|431|506|709|902|782|226|249|289|343|416|519|613|647|705|807|905|418|438|450|514|579|581|819|873|306|639|867)\d{7}$/";
		return preg_match($pattern, $valeur);
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
		$pattern = "/^[abceghjklmnprstvxy][0-9][abceghjklmnprstvwxyz][ ]?[0-9][[abceghjklmnprstvwxyz][0-9]$/i";
		return preg_match($pattern, $valeur);
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
