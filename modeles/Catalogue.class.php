<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Catalogue
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
	}

	// METHODES
	public function afficher($mode) {
		$idbd = $this->bd->getBD();
		
		switch ($mode) {
			case 'specs':
				return $this->categories;
				break;

			case 'prix':
				return $idbd;
				break;
			
			default:
				# code...
				break;
		}
	}


}

?>
