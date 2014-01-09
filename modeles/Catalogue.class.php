<?php
/**
 * Modele Catalogue (class)
 *
 * @author Yan Boucher Bouchard
 */
class Catalogue {
	// PARAMS
	private $bd;
	private $categories = array("lampes"=>1,"kits"=>1,"panneaux"=>1);

	// CONSTRUCTEUR
	public function __construct(){
		$this->bd = BD::getInstance();

		// TODO : verif des categories selectionne pour mettre a jour $categories...
	}

	// METHODES
	public function afficher($mode) {
		$idbd = $this->bd->getBD();
		
		switch ($mode) {
			// tri par specifications
			case 'specs':
				return $this->categories;
				break;

			// tri par prix
			case 'prix':
				return $idbd;
				break;
			
			// tri par default
			default:
				# code...
				break;
		}
	}


}

?>
