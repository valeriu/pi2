<?php

/**
 * Fichier de lancement du MVC, Il appel le var.init et le gabarit HTML 
 * @author Jonathan Martel
 * @version 1.0
 * @update 2013-03-11
 * @license Creative Commons BY-NC 3.0 (Licence Creative Commons Attribution - Pas d’utilisation commerciale 3.0 non transposé)
 * @license http://creativecommons.org/licenses/by-nc/3.0/deed.fr
 * 
 */
	session_start();
 
	 /***************************************************/
    /** Fichier de configuration, contient l'autoloader **/
    /***************************************************/
	require_once("./includes/config.php");
	
   /***************************************************/
    /** Initialisation des variables **/
    /***************************************************/
	require_once("./var.init.php");
   
   /***************************************************/
    /** Controleur
    /***************************************************/
	try {
		$oControleur = new Controler();  
		$oControleur->gerer();
	} catch (Exception $e) {
				echo $e->getMessage();
	}	

?>
