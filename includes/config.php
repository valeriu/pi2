<?php
/**
 * Fichier de configuration. Il est appelé par index.php et par test/index.php
 * Il contient notamment l'autoloader
 * @author Jonathan Martel
 * @version 1.0
 * @update 2013-03-11
 * @license Creative Commons BY-NC 3.0 (Licence Creative Commons Attribution - Pas d’utilisation commerciale 3.0 non transposé)
 * @license http://creativecommons.org/licenses/by-nc/3.0/deed.fr
 * 
 */
	function mon_autoloader($class) {
		$dossierClasse = array('modeles/', 'vues/', 'lib/', '' );	// Ajouter les dossiers au besoin
		
		foreach ($dossierClasse as $dossier) {
			//var_dump('./'.$dossier.$class.'.class.php');
			if(file_exists('./'.$dossier.$class.'.class.php'))	{
				require_once('./'.$dossier.$class.'.class.php');
			}
		}
	}
	
	spl_autoload_register('mon_autoloader');
	
// Constantes 
	//Base de donne
	define("HOST","localhost");
	define("USER","e1295805");
	define("BD","e1295805");
	define("PASS","50319801101");
	
// Google Maps API
	define("GOOOGLEMAPAPI", "AIzaSyA65H6gOhP5ozo4DKYu0woD0tT7k2yKu78");
?>