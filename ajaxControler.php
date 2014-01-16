<?php

/**
 * Controlleur AJAX. Ce fichier est la porte d'entrée des requêtes AJAX (XHR)
 * @author Luis Rosas, Luc Cinq-Mars
 * @version 1.0
 * @update 09-01-2014
 * @license Creative Commons BY-NC 3.0 (Licence Creative Commons Attribution - Pas d’utilisation commerciale 3.0 non transposé)
 * @license http://creativecommons.org/licenses/by-nc/3.0/deed.fr
 * 
 */
	session_start();

	require_once("./includes/config.php");

	if(empty($_GET['requete']))	{
		$_GET['requete'] = '';
	}

	switch ($_GET['requete']) {
		case 'confirmation_adresse':
			confirmationAdresse();
			break;
		case 'etapeDeux':
			etapeDeux();
			break;
		case 'passerCommande':
			enregistreCommande();
			break;
		case 'formConnecter':
			formConnecter();
			break;
		case 'formEnregistrer':
			formEnregistrer();
			break;
		case 'formMotPasse':
			formMotPasse();
			break;
		case 'formAdresse':
			formAdresse();
			break;	
		case 'connecter':
			//var_dump($_POST);
			connecter();
			break;
		case 'deconnecter':
			deconnecter();
			break;	
		case 'enregistrer':
			enregistrer();
			break;
		case 'motpasse':
			motpasse();
			break;			
		case 'adresse':
			adresse();
			break;					
		default:
			accueil();
			break;
	}

	function confirmationAdresse(){
		if(empty($_POST['data']))
		{
			$_POST['data'] = '';
		}
		$info = json_decode($_POST['data']);

		$vuePanier =  new Panier();
		$resultatNewCommande = $vuePanier->confirmationAdresse($_POST, $info);
		echo $resultatNewCommande; // Réponse AJAX , pour la vérification de l'enregistrement

		/*$commande = new Commande();
		$resultatNewCommande = $commande->creerCommande($_POST['email'], $details, round($totalCommande, 2), $nbProduits);
 		
		//var_dump($_POST['quantite'], $_POST['email'], $_POST['data'], $nbProduits, $resultatNewCommande);
		//return $resultatNewCommande;
		echo $resultatNewCommande; // Réponse AJAX , pour la vérification de l'enregistrement*/

	}

	function etapeDeux(){
		$vuePanier =  new VuePanier();
		$vuePanier->affichePanier();
	}

	function enregistreCommande(){
		$vuePanier =  new VuePanier();
		$vuePanier->enregistrePanier();
	}

	function formConnecter(){
		//return 'formConnecter';
		$html = VueUsagers::afficherModalConnexion();
		echo $html;
	}

	function formEnregistrer(){
		//return 'formEnregistrer';
		$html = VueUsagers::afficherModalEnregistrer();
		echo $html;
	}
	
	function formMotPasse(){
		$html = VueUsagers::afficherModalMotPasse();
		echo $html;
	}
	
	function formAdresse(){
		$html = VueUsagers::afficherModalAdresse();
		echo $html;
	}

	function deconnecter(){
		//var_dump($_SERVER['QUERY_STRING']);
		//var_dump($_SERVER['HTTP_REFERER']);
		session_destroy();
		echo VueUsagers::afficherFormUsagers();
		/*if($_SERVER['HTTP_REFERER'] == "http://e1295805.webdev.cmaisonneuve.qc.ca/Projet_Luc/index.php?requete=adresseCommande"){
			//header('Location: index.php?requete=accueil');

		}
		else{
			echo VueUsagers::afficherFormUsagers();
		}*/
		
	}

	function connecter(){
		try{
			//var_dump($_POST);
			$usager = new Usagers();
			$usager->connecter($_POST);
			$_SESSION['usager'] = $_POST['courriel'];
			echo VueUsagers::afficherFormDeconnexion();
		}
		catch(Exception $e){
			echo $e->getMessage();
		}
	}

	function enregistrer(){
		try{
			$usager = new Usagers();
			$usager->enregistrer($_POST);
			$_SESSION['usager'] = $_POST['courriel'];
			echo VueUsagers::afficherFormDeconnexion();
		}
		catch(Exception $e){
			echo $e->getMessage();
		}
	}

	function accueil() {
		$oVue = new Vue();
		$oVue->afficherAccueil();
	}

	function motpasse(){
		try{
			$usager = new Usagers();
			$usager->envoyerMotPasse($_POST);
			echo "Un courriel avec la marche à suivre vous a été envoyé";
		}
		catch(Exception $e){
			echo $e->getMessage();
		}
	}
	
	function adresse(){
		try{
			$adresse = new Adresse();
			//var_dump($_POST);
			//var_dump($_SESSION['usager']);
			$adresse->enregistrer($_SESSION['usager'], $_POST);
			//$adresse = new Adresse();
			$courriel = array("courriel" => $_SESSION['usager']);
			$data = $adresse->afficherAdresseUsager($courriel);
			VueAdresse::afficherAdrese($data);
		}
		catch(Exception $e){
			echo $e->getMessage();
		}
	}

?>