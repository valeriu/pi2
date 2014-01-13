<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="fr">

	<head>

		<title>Tests unitaires - Catalogue</title>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	</head>

	<body>
		<div id="header">
			<h1>Tests - Modèle - Catalogue</h1>
			<?php 
				// array des categories selon les cases selectionne
				$aCategories = array(1=>true,2=>false,3=>false);
				$catalogue 	 = new Catalogue($aCategories);
			 ?>
		</div>
		<div id="contenu">
			<h2>Test: enregistrer() fonctionnel</h2>
			<?php 
				try {
					$array = array("nomProduit"=>"Test","prixProduit"=>9.99,"descProduit"=>"Test description","specsProduit"=>"Test specifications","imgProduit"=>"test.jpg","statutProduit"=>1,"typeProduit"=>1,"suppProduit"=>"Fournisseur test","suppIdProduit"=>"ID01","poidsProduit"=>11.11,"longProduit"=>11.11,"largProduit"=>11.11,"hautProduit"=>11.11,"evalProduit"=>4,"catIdProduit"=>2,"powerProduit"=>55);
					$rep = $catalogue->enregistrer($array);
					var_dump($rep);
				} catch(Exception $e) {
					echo $e->getMessage();
				}
			?>
			<h2>Test: enregistrer() non-fonctionnel</h2>
			<?php 
				try {
					$array = array("nomProduit"=>"@","prixProduit"=>9.99,"descProduit"=>"Test description","specsProduit"=>"Test specifications","imgProduit"=>"test.jpg","statutProduit"=>1,"typeProduit"=>1,"suppProduit"=>"Fournisseur test","suppIdProduit"=>"ID fournisseur test","poidsProduit"=>11.11,"longProduit"=>11.11,"largProduit"=>11.11,"hautProduit"=>11.11,"evalProduit"=>4,"catIdProduit"=>2,"powerProduit"=>55);
					$rep = $catalogue->enregistrer($array);
					var_dump($rep);
				} catch(Exception $e) {
					echo $e->getMessage();
				}
			?>
			<h2>Test: enregistrer() non-fonctionnel</h2>
			<?php 
				try {
					$array = array("nomProduit"=>"Test","prixProduit"=>"abc","descProduit"=>"Test description","specsProduit"=>"Test specifications","imgProduit"=>"test.jpg","statutProduit"=>1,"typeProduit"=>1,"suppProduit"=>"Fournisseur test","suppIdProduit"=>"ID fournisseur test","poidsProduit"=>11.11,"longProduit"=>11.11,"largProduit"=>11.11,"hautProduit"=>11.11,"evalProduit"=>4,"catIdProduit"=>2,"powerProduit"=>55);
					$rep = $catalogue->enregistrer($array);
					var_dump($rep);
				} catch(Exception $e) {
					echo $e->getMessage();
				}
			?>
			<h2>Test: enregistrer() non-fonctionnel</h2>
			<?php 
				try {
					$array = array("nomProduit"=>"Test","prixProduit"=>9.99,"descProduit"=>"@hotmail.com","specsProduit"=>"Test specifications","imgProduit"=>"test.jpg","statutProduit"=>1,"typeProduit"=>1,"suppProduit"=>"Fournisseur test","suppIdProduit"=>"ID fournisseur test","poidsProduit"=>11.11,"longProduit"=>11.11,"largProduit"=>11.11,"hautProduit"=>11.11,"evalProduit"=>4,"catIdProduit"=>2,"powerProduit"=>55);
					$rep = $catalogue->enregistrer($array);
					var_dump($rep);
				} catch(Exception $e) {
					echo $e->getMessage();
				}
			?>
			<h2>Test: enregistrer() non-fonctionnel</h2>
			<?php 
				try {
					$array = array("nomProduit"=>"Test","prixProduit"=>9.99,"descProduit"=>"Test description","specsProduit"=>"@hotmail.com","imgProduit"=>"test.jpg","statutProduit"=>1,"typeProduit"=>1,"suppProduit"=>"Fournisseur test","suppIdProduit"=>"ID01","poidsProduit"=>11.11,"longProduit"=>11.11,"largProduit"=>11.11,"hautProduit"=>11.11,"evalProduit"=>4,"catIdProduit"=>2,"powerProduit"=>55);
					$rep = $catalogue->enregistrer($array);
					var_dump($rep);
				} catch(Exception $e) {
					echo $e->getMessage();
				}
			?>
			<h2>Test: enregistrer() non-fonctionnel</h2>
			<?php 
				try {
					$array = array("nomProduit"=>"Test","prixProduit"=>9.99,"descProduit"=>"Test description","specsProduit"=>"Test specifications","imgProduit"=>"test","statutProduit"=>1,"typeProduit"=>1,"suppProduit"=>"Fournisseur test","suppIdProduit"=>"ID01","poidsProduit"=>11.11,"longProduit"=>11.11,"largProduit"=>11.11,"hautProduit"=>11.11,"evalProduit"=>4,"catIdProduit"=>2,"powerProduit"=>55);
					$rep = $catalogue->enregistrer($array);
					var_dump($rep);
				} catch(Exception $e) {
					echo $e->getMessage();
				}
			?>
			<h2>Test: enregistrer() non-fonctionnel</h2>
			<?php 
				try {
					$array = array("nomProduit"=>"Test","prixProduit"=>9.99,"descProduit"=>"Test description","specsProduit"=>"Test specifications","imgProduit"=>"test.jpg","statutProduit"=>"abc","typeProduit"=>1,"suppProduit"=>"Fournisseur test","suppIdProduit"=>"ID01","poidsProduit"=>11.11,"longProduit"=>11.11,"largProduit"=>11.11,"hautProduit"=>11.11,"evalProduit"=>4,"catIdProduit"=>2,"powerProduit"=>55);
					$rep = $catalogue->enregistrer($array);
					var_dump($rep);
				} catch(Exception $e) {
					echo $e->getMessage();
				}
			?>
			<h2>Test: enregistrer() non-fonctionnel</h2>
			<?php 
				try {
					$array = array("nomProduit"=>"Test","prixProduit"=>9.99,"descProduit"=>"Test description","specsProduit"=>"Test specifications","imgProduit"=>"test.jpg","statutProduit"=>1,"typeProduit"=>"abc","suppProduit"=>"Fournisseur test","suppIdProduit"=>"ID01","poidsProduit"=>11.11,"longProduit"=>11.11,"largProduit"=>11.11,"hautProduit"=>11.11,"evalProduit"=>4,"catIdProduit"=>2,"powerProduit"=>55);
					$rep = $catalogue->enregistrer($array);
					var_dump($rep);
				} catch(Exception $e) {
					echo $e->getMessage();
				}
			?>
			<h2>Test: enregistrer() non-fonctionnel</h2>
			<?php 
				try {
					$array = array("nomProduit"=>"Test","prixProduit"=>9.99,"descProduit"=>"Test description","specsProduit"=>"Test specifications","imgProduit"=>"test.jpg","statutProduit"=>1,"typeProduit"=>1,"suppProduit"=>"@gmail.com","suppIdProduit"=>"ID01","poidsProduit"=>11.11,"longProduit"=>11.11,"largProduit"=>11.11,"hautProduit"=>11.11,"evalProduit"=>4,"catIdProduit"=>2,"powerProduit"=>55);
					$rep = $catalogue->enregistrer($array);
					var_dump($rep);
				} catch(Exception $e) {
					echo $e->getMessage();
				}
			?>
			<h2>Test: enregistrer() non-fonctionnel</h2>
			<?php 
				try {
					$array = array("nomProduit"=>"Test","prixProduit"=>9.99,"descProduit"=>"Test description","specsProduit"=>"Test specifications","imgProduit"=>"test.jpg","statutProduit"=>1,"typeProduit"=>1,"suppProduit"=>"Fournisseur test","suppIdProduit"=>"@domain","poidsProduit"=>11.11,"longProduit"=>11.11,"largProduit"=>11.11,"hautProduit"=>11.11,"evalProduit"=>4,"catIdProduit"=>2,"powerProduit"=>55);
					$rep = $catalogue->enregistrer($array);
					var_dump($rep);
				} catch(Exception $e) {
					echo $e->getMessage();
				}
			?>
			<h2>Test: enregistrer() non-fonctionnel</h2>
			<?php 
				try {
					$array = array("nomProduit"=>"Test","prixProduit"=>9.99,"descProduit"=>"Test description","specsProduit"=>"Test specifications","imgProduit"=>"test.jpg","statutProduit"=>1,"typeProduit"=>1,"suppProduit"=>"Fournisseur test","suppIdProduit"=>"ID01","poidsProduit"=>"abc","longProduit"=>11.11,"largProduit"=>11.11,"hautProduit"=>11.11,"evalProduit"=>4,"catIdProduit"=>2,"powerProduit"=>55);
					$rep = $catalogue->enregistrer($array);
					var_dump($rep);
				} catch(Exception $e) {
					echo $e->getMessage();
				}
			?>
			<h2>Test: enregistrer() non-fonctionnel</h2>
			<?php 
				try {
					$array = array("nomProduit"=>"Test","prixProduit"=>9.99,"descProduit"=>"Test description","specsProduit"=>"Test specifications","imgProduit"=>"test.jpg","statutProduit"=>1,"typeProduit"=>1,"suppProduit"=>"Fournisseur test","suppIdProduit"=>"ID01","poidsProduit"=>11.11,"longProduit"=>"abc","largProduit"=>11.11,"hautProduit"=>11.11,"evalProduit"=>4,"catIdProduit"=>2,"powerProduit"=>55);
					$rep = $catalogue->enregistrer($array);
					var_dump($rep);
				} catch(Exception $e) {
					echo $e->getMessage();
				}
			?>
			<h2>Test: enregistrer() non-fonctionnel</h2>
			<?php 
				try {
					$array = array("nomProduit"=>"Test","prixProduit"=>9.99,"descProduit"=>"Test description","specsProduit"=>"Test specifications","imgProduit"=>"test.jpg","statutProduit"=>1,"typeProduit"=>1,"suppProduit"=>"Fournisseur test","suppIdProduit"=>"ID01","poidsProduit"=>11.11,"longProduit"=>11.11,"largProduit"=>"abc","hautProduit"=>11.11,"evalProduit"=>4,"catIdProduit"=>2,"powerProduit"=>55);
					$rep = $catalogue->enregistrer($array);
					var_dump($rep);
				} catch(Exception $e) {
					echo $e->getMessage();
				}
			?>
			<h2>Test: enregistrer() non-fonctionnel</h2>
			<?php 
				try {
					$array = array("nomProduit"=>"Test","prixProduit"=>9.99,"descProduit"=>"Test description","specsProduit"=>"Test specifications","imgProduit"=>"test.jpg","statutProduit"=>1,"typeProduit"=>1,"suppProduit"=>"Fournisseur test","suppIdProduit"=>"ID01","poidsProduit"=>11.11,"longProduit"=>11.11,"largProduit"=>11.11,"hautProduit"=>"abc","evalProduit"=>4,"catIdProduit"=>2,"powerProduit"=>55);
					$rep = $catalogue->enregistrer($array);
					var_dump($rep);
				} catch(Exception $e) {
					echo $e->getMessage();
				}
			?>
			<h2>Test: enregistrer() non-fonctionnel</h2>
			<?php 
				try {
					$array = array("nomProduit"=>"Test","prixProduit"=>9.99,"descProduit"=>"Test description","specsProduit"=>"Test specifications","imgProduit"=>"test.jpg","statutProduit"=>1,"typeProduit"=>1,"suppProduit"=>"Fournisseur test","suppIdProduit"=>"ID01","poidsProduit"=>11.11,"longProduit"=>11.11,"largProduit"=>11.11,"hautProduit"=>11.11,"evalProduit"=>"a","catIdProduit"=>2,"powerProduit"=>55);
					$rep = $catalogue->enregistrer($array);
					var_dump($rep);
				} catch(Exception $e) {
					echo $e->getMessage();
				}
			?>
			<h2>Test: enregistrer() non-fonctionnel</h2>
			<?php 
				try {
					$array = array("nomProduit"=>"Test","prixProduit"=>9.99,"descProduit"=>"Test description","specsProduit"=>"Test specifications","imgProduit"=>"test.jpg","statutProduit"=>1,"typeProduit"=>1,"suppProduit"=>"Fournisseur test","suppIdProduit"=>"ID01","poidsProduit"=>11.11,"longProduit"=>11.11,"largProduit"=>11.11,"hautProduit"=>11.11,"evalProduit"=>4,"catIdProduit"=>"b","powerProduit"=>55);
					$rep = $catalogue->enregistrer($array);
					var_dump($rep);
				} catch(Exception $e) {
					echo $e->getMessage();
				}
			?>
			<h2>Test: enregistrer() non-fonctionnel</h2>
			<?php 
				try {
					$array = array("nomProduit"=>"Test","prixProduit"=>9.99,"descProduit"=>"Test description","specsProduit"=>"Test specifications","imgProduit"=>"test.jpg","statutProduit"=>1,"typeProduit"=>1,"suppProduit"=>"Fournisseur test","suppIdProduit"=>"ID01","poidsProduit"=>11.11,"longProduit"=>11.11,"largProduit"=>11.11,"hautProduit"=>11.11,"evalProduit"=>4,"catIdProduit"=>2,"powerProduit"=>"c");
					$rep = $catalogue->enregistrer($array);
					var_dump($rep);
				} catch(Exception $e) {
					echo $e->getMessage();
				}
			?>

			<h2>Test: modifier() fonctionnel</h2>
			<?php 
				try {
					$array = array("IdProduit"=>1,"nomProduit"=>"Test","prixProduit"=>9.99,"descProduit"=>"Test description","specsProduit"=>"Test specifications","imgProduit"=>"test.jpg","statutProduit"=>1,"typeProduit"=>1,"suppProduit"=>"Fournisseur test","suppIdProduit"=>"ID01","poidsProduit"=>11.11,"longProduit"=>11.11,"largProduit"=>11.11,"hautProduit"=>11.11,"evalProduit"=>4,"catIdProduit"=>2,"powerProduit"=>55);
					$rep = $catalogue->modifier($array);
					var_dump($rep);
				} catch(Exception $e) {
					echo $e->getMessage();
				}
			?>
			<h2>Test: modifier() non-fonctionnel</h2>
			<?php 
				try {
					$array = array("IdProduit"=>1,"nomProduit"=>"@","prixProduit"=>9.99,"descProduit"=>"Test description","specsProduit"=>"Test specifications","imgProduit"=>"test.jpg","statutProduit"=>1,"typeProduit"=>1,"suppProduit"=>"Fournisseur test","suppIdProduit"=>"ID fournisseur test","poidsProduit"=>11.11,"longProduit"=>11.11,"largProduit"=>11.11,"hautProduit"=>11.11,"evalProduit"=>4,"catIdProduit"=>2,"powerProduit"=>55);
					$rep = $catalogue->modifier($array);
					var_dump($rep);
				} catch(Exception $e) {
					echo $e->getMessage();
				}
			?>
			<h2>Test: modifier() non-fonctionnel</h2>
			<?php 
				try {
					$array = array("IdProduit"=>1,"nomProduit"=>"Test","prixProduit"=>"abc","descProduit"=>"Test description","specsProduit"=>"Test specifications","imgProduit"=>"test.jpg","statutProduit"=>1,"typeProduit"=>1,"suppProduit"=>"Fournisseur test","suppIdProduit"=>"ID fournisseur test","poidsProduit"=>11.11,"longProduit"=>11.11,"largProduit"=>11.11,"hautProduit"=>11.11,"evalProduit"=>4,"catIdProduit"=>2,"powerProduit"=>55);
					$rep = $catalogue->modifier($array);
					var_dump($rep);
				} catch(Exception $e) {
					echo $e->getMessage();
				}
			?>
			<h2>Test: modifier() non-fonctionnel</h2>
			<?php 
				try {
					$array = array("IdProduit"=>1,"nomProduit"=>"Test","prixProduit"=>9.99,"descProduit"=>"@hotmail.com","specsProduit"=>"Test specifications","imgProduit"=>"test.jpg","statutProduit"=>1,"typeProduit"=>1,"suppProduit"=>"Fournisseur test","suppIdProduit"=>"ID fournisseur test","poidsProduit"=>11.11,"longProduit"=>11.11,"largProduit"=>11.11,"hautProduit"=>11.11,"evalProduit"=>4,"catIdProduit"=>2,"powerProduit"=>55);
					$rep = $catalogue->modifier($array);
					var_dump($rep);
				} catch(Exception $e) {
					echo $e->getMessage();
				}
			?>
			<h2>Test: modifier() non-fonctionnel</h2>
			<?php 
				try {
					$array = array("IdProduit"=>1,"nomProduit"=>"Test","prixProduit"=>9.99,"descProduit"=>"Test description","specsProduit"=>"@hotmail.com","imgProduit"=>"test.jpg","statutProduit"=>1,"typeProduit"=>1,"suppProduit"=>"Fournisseur test","suppIdProduit"=>"ID01","poidsProduit"=>11.11,"longProduit"=>11.11,"largProduit"=>11.11,"hautProduit"=>11.11,"evalProduit"=>4,"catIdProduit"=>2,"powerProduit"=>55);
					$rep = $catalogue->modifier($array);
					var_dump($rep);
				} catch(Exception $e) {
					echo $e->getMessage();
				}
			?>
			<h2>Test: modifier() non-fonctionnel</h2>
			<?php 
				try {
					$array = array("IdProduit"=>1,"nomProduit"=>"Test","prixProduit"=>9.99,"descProduit"=>"Test description","specsProduit"=>"Test specifications","imgProduit"=>"test","statutProduit"=>1,"typeProduit"=>1,"suppProduit"=>"Fournisseur test","suppIdProduit"=>"ID01","poidsProduit"=>11.11,"longProduit"=>11.11,"largProduit"=>11.11,"hautProduit"=>11.11,"evalProduit"=>4,"catIdProduit"=>2,"powerProduit"=>55);
					$rep = $catalogue->modifier($array);
					var_dump($rep);
				} catch(Exception $e) {
					echo $e->getMessage();
				}
			?>
			<h2>Test: modifier() non-fonctionnel</h2>
			<?php 
				try {
					$array = array("IdProduit"=>1,"nomProduit"=>"Test","prixProduit"=>9.99,"descProduit"=>"Test description","specsProduit"=>"Test specifications","imgProduit"=>"test.jpg","statutProduit"=>"abc","typeProduit"=>1,"suppProduit"=>"Fournisseur test","suppIdProduit"=>"ID01","poidsProduit"=>11.11,"longProduit"=>11.11,"largProduit"=>11.11,"hautProduit"=>11.11,"evalProduit"=>4,"catIdProduit"=>2,"powerProduit"=>55);
					$rep = $catalogue->modifier($array);
					var_dump($rep);
				} catch(Exception $e) {
					echo $e->getMessage();
				}
			?>
			<h2>Test: modifier() non-fonctionnel</h2>
			<?php 
				try {
					$array = array("IdProduit"=>1,"nomProduit"=>"Test","prixProduit"=>9.99,"descProduit"=>"Test description","specsProduit"=>"Test specifications","imgProduit"=>"test.jpg","statutProduit"=>1,"typeProduit"=>"abc","suppProduit"=>"Fournisseur test","suppIdProduit"=>"ID01","poidsProduit"=>11.11,"longProduit"=>11.11,"largProduit"=>11.11,"hautProduit"=>11.11,"evalProduit"=>4,"catIdProduit"=>2,"powerProduit"=>55);
					$rep = $catalogue->modifier($array);
					var_dump($rep);
				} catch(Exception $e) {
					echo $e->getMessage();
				}
			?>
			<h2>Test: modifier() non-fonctionnel</h2>
			<?php 
				try {
					$array = array("IdProduit"=>1,"nomProduit"=>"Test","prixProduit"=>9.99,"descProduit"=>"Test description","specsProduit"=>"Test specifications","imgProduit"=>"test.jpg","statutProduit"=>1,"typeProduit"=>1,"suppProduit"=>"@gmail.com","suppIdProduit"=>"ID01","poidsProduit"=>11.11,"longProduit"=>11.11,"largProduit"=>11.11,"hautProduit"=>11.11,"evalProduit"=>4,"catIdProduit"=>2,"powerProduit"=>55);
					$rep = $catalogue->modifier($array);
					var_dump($rep);
				} catch(Exception $e) {
					echo $e->getMessage();
				}
			?>
			<h2>Test: modifier() non-fonctionnel</h2>
			<?php 
				try {
					$array = array("IdProduit"=>1,"nomProduit"=>"Test","prixProduit"=>9.99,"descProduit"=>"Test description","specsProduit"=>"Test specifications","imgProduit"=>"test.jpg","statutProduit"=>1,"typeProduit"=>1,"suppProduit"=>"Fournisseur test","suppIdProduit"=>"@domain","poidsProduit"=>11.11,"longProduit"=>11.11,"largProduit"=>11.11,"hautProduit"=>11.11,"evalProduit"=>4,"catIdProduit"=>2,"powerProduit"=>55);
					$rep = $catalogue->modifier($array);
					var_dump($rep);
				} catch(Exception $e) {
					echo $e->getMessage();
				}
			?>
			<h2>Test: modifier() non-fonctionnel</h2>
			<?php 
				try {
					$array = array("IdProduit"=>1,"nomProduit"=>"Test","prixProduit"=>9.99,"descProduit"=>"Test description","specsProduit"=>"Test specifications","imgProduit"=>"test.jpg","statutProduit"=>1,"typeProduit"=>1,"suppProduit"=>"Fournisseur test","suppIdProduit"=>"ID01","poidsProduit"=>"abc","longProduit"=>11.11,"largProduit"=>11.11,"hautProduit"=>11.11,"evalProduit"=>4,"catIdProduit"=>2,"powerProduit"=>55);
					$rep = $catalogue->modifier($array);
					var_dump($rep);
				} catch(Exception $e) {
					echo $e->getMessage();
				}
			?>
			<h2>Test: modifier() non-fonctionnel</h2>
			<?php 
				try {
					$array = array("IdProduit"=>1,"nomProduit"=>"Test","prixProduit"=>9.99,"descProduit"=>"Test description","specsProduit"=>"Test specifications","imgProduit"=>"test.jpg","statutProduit"=>1,"typeProduit"=>1,"suppProduit"=>"Fournisseur test","suppIdProduit"=>"ID01","poidsProduit"=>11.11,"longProduit"=>"abc","largProduit"=>11.11,"hautProduit"=>11.11,"evalProduit"=>4,"catIdProduit"=>2,"powerProduit"=>55);
					$rep = $catalogue->modifier($array);
					var_dump($rep);
				} catch(Exception $e) {
					echo $e->getMessage();
				}
			?>
			<h2>Test: modifier() non-fonctionnel</h2>
			<?php 
				try {
					$array = array("IdProduit"=>1,"nomProduit"=>"Test","prixProduit"=>9.99,"descProduit"=>"Test description","specsProduit"=>"Test specifications","imgProduit"=>"test.jpg","statutProduit"=>1,"typeProduit"=>1,"suppProduit"=>"Fournisseur test","suppIdProduit"=>"ID01","poidsProduit"=>11.11,"longProduit"=>11.11,"largProduit"=>"abc","hautProduit"=>11.11,"evalProduit"=>4,"catIdProduit"=>2,"powerProduit"=>55);
					$rep = $catalogue->modifier($array);
					var_dump($rep);
				} catch(Exception $e) {
					echo $e->getMessage();
				}
			?>
			<h2>Test: modifier() non-fonctionnel</h2>
			<?php 
				try {
					$array = array("IdProduit"=>1,"nomProduit"=>"Test","prixProduit"=>9.99,"descProduit"=>"Test description","specsProduit"=>"Test specifications","imgProduit"=>"test.jpg","statutProduit"=>1,"typeProduit"=>1,"suppProduit"=>"Fournisseur test","suppIdProduit"=>"ID01","poidsProduit"=>11.11,"longProduit"=>11.11,"largProduit"=>11.11,"hautProduit"=>"abc","evalProduit"=>4,"catIdProduit"=>2,"powerProduit"=>55);
					$rep = $catalogue->modifier($array);
					var_dump($rep);
				} catch(Exception $e) {
					echo $e->getMessage();
				}
			?>
			<h2>Test: modifier() non-fonctionnel</h2>
			<?php 
				try {
					$array = array("IdProduit"=>1,"nomProduit"=>"Test","prixProduit"=>9.99,"descProduit"=>"Test description","specsProduit"=>"Test specifications","imgProduit"=>"test.jpg","statutProduit"=>1,"typeProduit"=>1,"suppProduit"=>"Fournisseur test","suppIdProduit"=>"ID01","poidsProduit"=>11.11,"longProduit"=>11.11,"largProduit"=>11.11,"hautProduit"=>11.11,"evalProduit"=>"a","catIdProduit"=>2,"powerProduit"=>55);
					$rep = $catalogue->modifier($array);
					var_dump($rep);
				} catch(Exception $e) {
					echo $e->getMessage();
				}
			?>
			<h2>Test: modifier() non-fonctionnel</h2>
			<?php 
				try {
					$array = array("IdProduit"=>1,"nomProduit"=>"Test","prixProduit"=>9.99,"descProduit"=>"Test description","specsProduit"=>"Test specifications","imgProduit"=>"test.jpg","statutProduit"=>1,"typeProduit"=>1,"suppProduit"=>"Fournisseur test","suppIdProduit"=>"ID01","poidsProduit"=>11.11,"longProduit"=>11.11,"largProduit"=>11.11,"hautProduit"=>11.11,"evalProduit"=>4,"catIdProduit"=>"b","powerProduit"=>55);
					$rep = $catalogue->modifier($array);
					var_dump($rep);
				} catch(Exception $e) {
					echo $e->getMessage();
				}
			?>
			<h2>Test: modifier() non-fonctionnel</h2>
			<?php 
				try {
					$array = array("IdProduit"=>1,"nomProduit"=>"Test","prixProduit"=>9.99,"descProduit"=>"Test description","specsProduit"=>"Test specifications","imgProduit"=>"test.jpg","statutProduit"=>1,"typeProduit"=>1,"suppProduit"=>"Fournisseur test","suppIdProduit"=>"ID01","poidsProduit"=>11.11,"longProduit"=>11.11,"largProduit"=>11.11,"hautProduit"=>11.11,"evalProduit"=>4,"catIdProduit"=>2,"powerProduit"=>"c");
					$rep = $catalogue->modifier($array);
					var_dump($rep);
				} catch(Exception $e) {
					echo $e->getMessage();
				}
			?>

			<h2>Test: afficher() tous les produits</h2>
			<?php
				try {
					$rep = $catalogue->afficher("tous");
					var_dump($rep);
				} catch(Exception $e) {
					echo $e->getMessage();
				}	
			?>
			<h2>Test: afficher() par specs</h2>
			<?php 
				try {
					$rep = $catalogue->afficher("specs");
					var_dump($rep);
				} catch(Exception $e) {
					echo $e->getMessage();
				}
					
			?>
			<h2>Test: afficher() par prix</h2>
			<?php 
				try {
					$rep = $catalogue->afficher("prix");
					var_dump($rep);
				} catch(Exception $e) {
					echo $e->getMessage();
				}
			?>
		</div>
		<div id="footer">

		</div>
	</body>
</html>








