<?php

/**
 * Fichier de lancement du MVC, pour la partie admin
 * @author Valeriu Tihai
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
    /** Controleur Admin
    /***************************************************/
	$oControleur = new ControlerAdmin();  
	$oControleur->gerer();
?>