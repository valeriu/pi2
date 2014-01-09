<?php

/**
 * Controlleur AJAX. Ce fichier est la porte d'entrée des requêtes AJAX (XHR)
 * @author Luis Rosas
 * @version 1.0
 * @update 09-01-2014
 * @license Creative Commons BY-NC 3.0 (Licence Creative Commons Attribution - Pas d’utilisation commerciale 3.0 non transposé)
 * @license http://creativecommons.org/licenses/by-nc/3.0/deed.fr
 * 
 */

	require_once("./config.php");
	
	
	if($_GET['requete']== 'passerCommande')
	{
		if(empty($_POST['quantite']))
		{
			$_POST['quantite'] = '';
		}
		if(empty($_POST['email']))
		{
			$_POST['email'] = '';
		}
		if(empty($_POST['data']))
		{
			$_POST['data'] = '';
		}

		$infoCommande = json_decode($_POST['data']);
		$details = $_POST['data'];
		$totalCommande = '';
		$nbProduits = intval($_POST['quantite']);


		// Pour enregistrer le prix total de la commande
		for($i = 0 ; $i < $_POST['quantite']; $i++){
			$totalCommande += $infoCommande->{"$i"}->{"prix"} * $infoCommande->{"$i"}->{"quant"};
		}
		$commande = new Commande();
		$resultatNewCommande = $commande->creerCommande($_POST['email'], $details, round($totalCommande, 2), $nbProduits);
		
		//var_dump($_POST['quantite'], $_POST['email'], $_POST['data'], $nbProduits, $resultatNewCommande);
		//return $resultatNewCommande;
		echo $resultatNewCommande; // Réponse AJAX , pour la vérification de l'enregistrement
		
	}else {
		Vue::message('Erreur à l\'enregistrement de la commande, éssaie plus tard!');
	}
	

?>