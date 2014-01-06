<?php

/*
 * Menu
 * status
 *	* 0 - invisible
 *  * 1 - visible
 *  * 2 - supprimé
 * 
 * parent 
 *	* 0 - root menu
 * 
 */

/**
 * Description of Menu
 * http://wizardinternetsolutions.com/articles/web-programming/dynamic-multilevel-css-menu-php-mysql
 *
 * @author valeriu
 */
class Menu {
		public function __construct() {
		;
	} 
	
	public function ajouter ($titre, $description, $url, $parent, $order, $statut) {
		$req_sql = "";
	}
	
	public function modifier ($id) {
		$req_sql = "";
	}
	
	public function afficherListe ($id) {
		$req_sql = "SELECT * FROM  `wa_menu`";
	}
}

?>
