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
	
	//TAXES PAR PROVINCES
	define("CA", 0.05);
	define("QC", 0.09975);
	define("ON", 0.08);
	define("MN", 0.08);
	define("SK", 0.05);
	define("CB", 0.07);
	define("NB", 0.08);
	define("NE", 0.1);
	define("IE", 0.09);
	define("AL", 1);
	define("TN", 0.08);
	define("NO", 1);
	define("YK", 1);
	define("NV", 1);
	
	
// Google Maps API
	define("GOOOGLEMAPAPI", "AIzaSyA65H6gOhP5ozo4DKYu0woD0tT7k2yKu78");
?>