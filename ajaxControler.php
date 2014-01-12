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

	require_once("./includes/config.php");

	if(empty($_GET['requete']))	{
		$_GET['requete'] = '';
	}

	switch ($_GET['requete']) {
		case 'etapeUn':
			etapeUn();
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
		default:
			accueil();
			break;
	}

	function etapeUn(){
		if(empty($_POST['data']))
		{
			$_POST['data'] = '';
		}
		$info = json_decode($_POST['data']);

		$vuePanier =  new Panier();
		$resultatNewCommande = $vuePanier->etapeUnPanier($_POST, $info);
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

	function deconnecter(){
		session_destroy();
	}

	function connecter(){
		try{
			//var_dump($_POST);
			$usager = new Usagers();
			$usager->connecter($_POST);
			$_SESSION['usager'] = $_POST['courriel'];
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
		}
		catch(Exception $e){
			$e->getMessage();
		}
	}

	function accueil() {
		$oVue = new Vue();
		$oVue->afficheAccueil();
	}

	function motpasse(){
		$html = VueUsagers::afficherModalMotPasse();
		echo $html;
	}

?>