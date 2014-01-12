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
            <h2>1) Test: enregistrePanier() non-fonctionnel</h2>
            <h2>Donnees Objets Json par Ajax</h2>
			<?php
				try{
					$array = array("id_utilisateur" => 98, "adresse_utilisateur" => 21, "quantite" => 2 , "produits" => '{"idP":"5","nom":"Kit panneau solaire","image":"img/Solar_cell.png","quant":5,"prix":"99.99"}' );
					$panier = new Panier();					
					$rep = $panier->enregistrePanier($array);
					var_dump($rep);
				}catch(Exception $e){
					echo $e->getMessage();
				}
			?>
			<h2>1.1) Test: enregistrePanier() non-fonctionnel</h2>
			<?php
				try{
					$array = array("id_utilisateur" => "98", "adresse_utilisateur" => 21, "quantite" => 2 , "produits" => array( array("id_produits" => 8 , "quantite" => 2), array("id_produits" => 68 , "quantite" => 6)));
					$panier = new Panier();					
					$rep = $panier->enregistrePanier($array);
					var_dump($rep);
				}catch(Exception $e){
					echo $e->getMessage();
				}
			?>
			<h2>2) Test: enregistrePanier() non-fonctionnel</h2>
			<?php
				try{
                                        $array = array("id_utilisateur" => 98, "adresse_utilisateur" => "21", "quantite" => 2 , "produits" => array( array("id_produits" => 8 , "quantite" => 2), array("id_produits" => 68 , "quantite" => 6)));
					$panier = new Panier();					
					$rep = $panier->enregistrePanier($array);
					var_dump($rep);
				}catch(Exception $e){
					echo $e->getMessage();
				}
			?>
			<h2>3) Test: enregistrePanier() non-fonctionnel</h2>
			<?php
				try{
					$array = array("id_utilisateur" => 98, "adresse_utilisateur" => 21, "quantite" => "2" , "produits" => array( array("id_produits" => 8 , "quantite" => 2), array("id_produits" => 68 , "quantite" => 6)));
					$panier = new Panier();					
					$rep = $panier->enregistrePanier($array);
					var_dump($rep);
				}catch(Exception $e){
					echo $e->getMessage();
				}
			?>
			<h2>4) Test: enregistrePanier() non-fonctionnel</h2>
			<?php
				try{
					$array = array("id_utilisateur" => 98, "adresse_utilisateur" => 21, "quantite" => 2 , "produits" => 2);
					$panier = new Panier();					
					$rep = $panier->enregistrePanier($array);
					var_dump($rep);
				}catch(Exception $e){
					echo $e->getMessage();
				}
			?>
			<h2>5) Test: enregistrePanier() non-fonctionnel</h2>
			<?php
				try{
					$array = array("id_utilisateur" => 98, "adresse_utilisateur" => 21, "quantite" => 2 , "produits" => "2");
					$panier = new Panier();					
					$rep = $panier->enregistrePanier($array);
					var_dump($rep);
				}catch(Exception $e){
					echo $e->getMessage();
				}
			?>
			<h2>6) Test: enregistrePanier() non-fonctionnel</h2>
			<?php
				try{
					$array = array("id_utilisateur" => 98, "adresse_utilisateur" => 21, "quantite" => 2 , "produits" => array( array("id_produits" => "8" , "quantite" => 2), array("id_produits" => 68 , "quantite" => 6)));
					$panier = new Panier();					
					$rep = $panier->enregistrePanier($array);
					var_dump($rep);
				}catch(Exception $e){
					echo $e->getMessage();
				}
			?>
			<h2>7) Test: enregistrePanier() non-fonctionnel</h2>
			<?php
				try{
					$array = array("id_utilisateur" => 98, "adresse_utilisateur" => 21, "quantite" => 2 , "produits" => array( array("id_produits" => 8 , "quantite" => "2"), array("id_produits" => 68 , "quantite" => 6)));
					$panier = new Panier();					
					$rep = $panier->enregistrePanier($array);
					var_dump($rep);
				}catch(Exception $e){
					echo $e->getMessage();
				}
			?>
			<h2>8) Test: enregistrePanier() non-fonctionnel</h2>
			<?php
				try{
					$array = array("id_utilisateur" => 98, "quantite" => 2 , "produits" => array( array("id_produits" => 8 , "quantite" => 2), array("id_produits" => 68 , "quantite" => 6)));
					$panier = new Panier();					
					$rep = $panier->enregistrePanier($array);
					var_dump($rep);
				}catch(Exception $e){
					echo $e->getMessage();
				}
			?>
			<h2>9) Test: enregistrePanier() non-fonctionnel</h2>
			<?php
				try{
					$array = array("id_utilisateur" => 98, "adresse_utilisateur" => 150, "quantite" => 2 , "produits" => array( array("id_produits" => 8 , "quantite" => 2), array("id_produits" => 68 , "quantite" => 6)));
					$panier = new Panier();					
					$rep = $panier->enregistrePanier($array);
					var_dump($rep);
				}catch(Exception $e){
					echo $e->getMessage();
				}
			?>
			<h1>11) Test: enregistrePanier() fonctionnel</h1>
			<?php
				try{
					$array = array("id_utilisateur" => 98, "adresse_utilisateur" => 21, "quantite" => 2 , "produits" => array( array("id_produits" => 5 , "quantite" => 2), array("id_produits" => 9 , "quantite" => 3)));
					$panier = new Panier();					
					$rep = $panier->enregistrePanier($array);
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








