<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="fr">

	<head>

		<title>Test unitaire</title>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	</head>

	<body>
		<div id="header">
			<h1>Test - Modèles - Usagers</h1>
		</div>
		<div id="contenu">
			<h1>Test: connecter() fonctionnel</h1>
			<?php 
				try{
					$usagers = new Usagers();
					$array = array("courriel" => "ex@ex.com", "mot_passe" => "password");
					$rep = $usagers->connecter($array);
					var_dump($rep);
				}
				catch(Exception $e){
					echo $e->getMessage();
				}
				
			?>
			<h1>Test: connecter() non-fonctionnel</h1>
			<?php 
				try{
					$usagers = new Usagers();
					$array = array("courriel" => "ex@ex.com", "mot_passe" => "ps");
					$rep = $usagers->connecter($array);
					var_dump($rep);
				}
				catch(Exception $e){
					echo $e->getMessage();
				}
				
			?>
			<h1>Test: connecter() fonctionnel</h1>
			<?php
				try{
					$usagers = new Usagers();
					$array = array("courriel" => "tempor.lorem.eget@Curabiturvel.net", "mot_passe" => "ZYG98ZBO7EQ");
					$rep = $usagers->connecter($array);
					var_dump($rep);
				}
				catch(Exception $e){
					echo $e->getMessage();
				}
				
			?>
			<h1>Test: connecter() non-fonctionnel</h1>
			<?php 
				try{
					$usagers = new Usagers();
					$array = array("courriel" => "per.inceptos@blandit.com", "mot_passe" => "test");
					$rep = $usagers->connecter($array);
					var_dump($rep);
				}
				catch(Exception $e){
					echo $e->getMessage();
				}
				
			?>
			<h1>Test: afficher() fonctionnel</h1>
			<?php 
				try{
					$usagers = new Usagers();
					$array = array("id_utilisateurs" => 1);
					$rep = $usagers->afficher($array);
					var_dump($rep);
				}
				catch(Exception $e){
					echo $e->getMessage();
				}
				
			?>
			<h1>Test: afficher() fonctionnel</h1>
			<?php 
				try{
					$usagers = new Usagers();
					$array = array("id_utilisateurs" => 8);
					$rep = $usagers->afficher($array);
					var_dump($rep);
				}
				catch(Exception $e){
					echo $e->getMessage();
				}
				
			?>
			<h1>Test: afficher() non-fonctionnel</h1>
			<?php 
				try{
					$usagers = new Usagers();
					$array = array("id_utilisateurs" => 5000);
					$rep = $usagers->afficher($array);
					var_dump($rep);
				}
				catch(Exception $e){
					echo $e->getMessage();
				}
				
			?>
			<h1>Test: afficherListe() fonctionnel</h1>
			<?php 
				$usagers = new Usagers();
				$rep = $usagers->afficherListe();
				//echo "<pre>";
				//print_r($rep);
			?>
			<h1>Test: enregistrer() fonctionnel(sans role)</h1>
			<?php 
				try{
					$usagers = new Usagers();
					$array = array("courriel" => "e@e.com", "mot_passe" => "luccinq", "nom_prenom" => "Pierre");
					$rep = $usagers->enregistrer($array);
					var_dump($rep);
				}
				catch(Exception $e){
					echo $e->getMessage();
				}
				
			?>
			<h1>Test: enregistrer() fonctionnel(avec role)</h1>
			<?php 
				try{
					$usagers = new Usagers();
					$array = array("courriel" => "x@rx.ca", "mot_passe" => "luccinq", "nom_prenom" => "Jean", "role" => 1);
					$rep = $usagers->enregistrer($array);
					var_dump($rep);
				}
				catch(Exception $e){
					echo $e->getMessage();
				}
				
			?>
			<h1>Test: modifier() fonctionnel</h1>
			<?php 
				try{
					$usagers = new Usagers();
					//$id_utilisateurs, $courriel, $mot_passe, $nom_prenom, $date_entree, $role, $cle_reactivation, $statut
					$array = array("id_utilisateurs" => 4, "courriel" => "a@a.eu", "mot_passe" => "password", "nom_prenom" => "TEST", "date_entree" => date("Y-m-d H:i:s"), "role" => 1, "cle_reactivation" => null, "statut" => 1);
					$rep = $usagers->modifier($array);
					var_dump($rep);
				}
				catch(Exception $e){
					echo $e->getMessage();
				}
				
			?>
			<h1>Test: modifier() non-fonctionnel</h1>
			<?php 
				try{
					$usagers = new Usagers();
					//$id_utilisateurs, $courriel, $mot_passe, $nom_prenom, $date_entree, $role, $cle_reactivation, $statut
					$array = array("id_utilisateurs" => 4, "courriel" => "a@a.eu", "mot_passe" => "pass", "nom_prenom" => "TEST", "date_entree" => date("Y-m-d H:i:s"), "role" => 10, "cle_reactivation" => null, "statut" => 1);
					$rep = $usagers->modifier($array);
					var_dump($rep);
				}
				catch(Exception $e){
					echo $e->getMessage();
				}
				
			?>
			<h1>Test: modifierMotPasse() fonctionnel</h1>
			<?php 
				try{
					$usagers = new Usagers();
					$array = array("courriel" => "ex@ex.com", "mot_passe1" => "password", "mot_passe2" => "password");
					$rep = $usagers->modifierMotPasse($array);
					var_dump($rep);
				}
				catch(Exception $e){
					echo $e->getMessage();
				}
				
			?>
		</div>
		<div id="footer">

		</div>
	</body>
</html>








