<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="fr">

	<head>

		<title>Test unitaire</title>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	</head>

	<body>
		<div id="header">
			<h1>Test - Modèles - Panier</h1>
		</div>
		<div id="contenu">
			<h2>1) Test: enregistrer() non-fonctionnel</h2>
			<?php
				try{
					$array = array("id_utilisateur" => "98", "adresse_utilisateur" => 21, "quantite" => 2 , "produits" => array( array("id_produits" => 8 , "quantite" => 2), array("id_produits" => 68 , "quantite" => 6)));
					$panier = new Panier();					
					$rep = $panier->enregistrer($array);
					var_dump($rep);
				}catch(Exception $e){
					echo $e->getMessage();
				}
			?>
			<h2>2) Test: enregistrer() non-fonctionnel</h2>
			<?php
				try{
					$array = array("id_utilisateur" => 98, "adresse_utilisateur" => "21", "quantite" => 2 , "produits" => array( array("id_produits" => 8 , "quantite" => 2), array("id_produits" => 68 , "quantite" => 6)));
					$panier = new Panier();					
					$rep = $panier->enregistrer($array);
					var_dump($rep);
				}catch(Exception $e){
					echo $e->getMessage();
				}
			?>
			<h2>3) Test: enregistrer() non-fonctionnel</h2>
			<?php
				try{
					$array = array("id_utilisateur" => 98, "adresse_utilisateur" => 21, "quantite" => "2" , "produits" => array( array("id_produits" => 8 , "quantite" => 2), array("id_produits" => 68 , "quantite" => 6)));
					$panier = new Panier();					
					$rep = $panier->enregistrer($array);
					var_dump($rep);
				}catch(Exception $e){
					echo $e->getMessage();
				}
			?>
			<h2>4) Test: enregistrer() non-fonctionnel</h2>
			<?php
				try{
					$array = array("id_utilisateur" => 98, "adresse_utilisateur" => 21, "quantite" => 2 , "produits" => 2);
					$panier = new Panier();					
					$rep = $panier->enregistrer($array);
					var_dump($rep);
				}catch(Exception $e){
					echo $e->getMessage();
				}
			?>
			<h2>5) Test: enregistrer() non-fonctionnel</h2>
			<?php
				try{
					$array = array("id_utilisateur" => 98, "adresse_utilisateur" => 21, "quantite" => 2 , "produits" => "2");
					$panier = new Panier();					
					$rep = $panier->enregistrer($array);
					var_dump($rep);
				}catch(Exception $e){
					echo $e->getMessage();
				}
			?>
			<h2>6) Test: enregistrer() non-fonctionnel</h2>
			<?php
				try{
					$array = array("id_utilisateur" => 98, "adresse_utilisateur" => 21, "quantite" => 2 , "produits" => array( array("id_produits" => "8" , "quantite" => 2), array("id_produits" => 68 , "quantite" => 6)));
					$panier = new Panier();					
					$rep = $panier->enregistrer($array);
					var_dump($rep);
				}catch(Exception $e){
					echo $e->getMessage();
				}
			?>
			<h2>7) Test: enregistrer() non-fonctionnel</h2>
			<?php
				try{
					$array = array("id_utilisateur" => 98, "adresse_utilisateur" => 21, "quantite" => 2 , "produits" => array( array("id_produits" => 8 , "quantite" => "2"), array("id_produits" => 68 , "quantite" => 6)));
					$panier = new Panier();					
					$rep = $panier->enregistrer($array);
					var_dump($rep);
				}catch(Exception $e){
					echo $e->getMessage();
				}
			?>
			<h2>8) Test: enregistrer() non-fonctionnel</h2>
			<?php
				try{
					$array = array("id_utilisateur" => 98, "quantite" => 2 , "produits" => array( array("id_produits" => 8 , "quantite" => 2), array("id_produits" => 68 , "quantite" => 6)));
					$panier = new Panier();					
					$rep = $panier->enregistrer($array);
					var_dump($rep);
				}catch(Exception $e){
					echo $e->getMessage();
				}
			?>
			<h1>9) Test: enregistrer() non-fonctionnel</h1>
			<?php
				try{
					$array = array("id_utilisateur" => 98, "adresse_utilisateur" => 150, "quantite" => 2 , "produits" => array( array("id_produits" => 8 , "quantite" => 2), array("id_produits" => 68 , "quantite" => 6)));
					$panier = new Panier();					
					$rep = $panier->enregistrer($array);
					var_dump($rep);
				}catch(Exception $e){
					echo $e->getMessage();
				}
			?>
			<h1>11) Test: enregistrer() fonctionnel</h1>
			<?php
				try{
					$array = array("id_utilisateur" => 98, "adresse_utilisateur" => 21, "quantite" => 2 , "produits" => array( array("id_produits" => 5 , "quantite" => 2), array("id_produits" => 9 , "quantite" => 3)));
					$panier = new Panier();					
					$rep = $panier->enregistrer($array);
					var_dump($rep);
				}catch(Exception $e){
					echo $e->getMessage();
				}
			?>
		</div>
		<div id="footer">

		</div>
	</body>
</html>








