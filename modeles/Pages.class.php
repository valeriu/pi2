<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Pages
 *
 * @author valeriu
 */
class Pages {
	
	public function __construct() {
		;
	} 
	
	public function ajouter ($titre, $description_meta, $contenu, $date, $statut, $long, $lat) {
		$req_sql = "INSERT INTO  `wa_pages` (
										`id_page` ,
										`titre` ,
										`description_meta` ,
										`contenu` ,
										`date` ,
										`statut` ,
										`long` ,
										`lat`
										)
					VALUES (
							NULL ,  
							'Titre',  
							'Description Meta',  
							'Contenu',  
							'2014-01-06 06:32:27',  
							'1',  
							'148.5142',  
							'-50.85023'
					);";
	}
	
	public function modifier ($id) {
		$req_sql = "UPDATE  `e1295805`.`wa_pages` 
			SET  `titre` =  'Vestibulum accumsan neque',
				`description_meta` =  'Lorem ipsum',
				`contenu` = 'Nulla eget metus .',
				`date` =  '2011-01-04 15:22:50',
				`statut` =  '1',
				`long` =  '148.5142',
				`lat` =  '-50.85023' 
			WHERE  `id_page` = 99";
	}
	
	public function afficher ($id) {
		$req_sql = "SELECT * FROM  `wa_pages` WHERE  `id_page` = 99";
	}
	
	public function afficherListe () {
		$req_sql = "SELECT * FROM  `wa_pages` LIMIT 0 , 30";
	}
	
}

?>
