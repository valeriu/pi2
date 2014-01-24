<?php
/**
 * Fichier de configuration. Il est appelé par index.php et par test/index.php
 * Il contient notamment l'autoloader
 * 
 */
	function mon_autoloader($class) {
		$dossierClasse = array('modeles/', 'vues/', 'lib/', '' );
		
		foreach ($dossierClasse as $dossier) {
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

// PAYPAL API credentials
	define("PAYPAL", 'wadagbe.solar@gmail.com');
	define("PAYPAL_SUCCES", 211);
	define("PAYPAL_ECHEC", 212);
	define("PAYPAL_API_USERNAME",  "b_api1.w.ca");
	define("PAYPAL_API_PASSWORD", "1390266218");
	define("PAYPAL_API_SIGNATURE", "AfEXsgrsMbCGLpPhIaBqYTCol0BcA3sgydsqful8E7ucPMlnTH0nVxue");
	define("PAYPAL_HOST",  "api-3t.sandbox.paypal.com");
	define("PAYPAL_GATE", "https://www.sandbox.paypal.com/cgi-bin/webscr?");
	define("PAYPAL_PAGE_RETURN", "http://e1295805.webdev.cmaisonneuve.qc.ca/finale/index.php?requete=ipn");
	define("PAYPAL_PAGE_CANCEL", "http://e1295805.webdev.cmaisonneuve.qc.ca/finale/index.php?requete=page&page_id=210");

	
	
// Google Maps API
	define("GOOOGLEMAPAPI", "AIzaSyA65H6gOhP5ozo4DKYu0woD0tT7k2yKu78");
?>