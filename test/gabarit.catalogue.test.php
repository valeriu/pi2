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
			<h1>Test: afficher() tous les produits</h1>
			<?php
				try {
					$rep = $catalogue->afficher("tous");
					var_dump($rep);
				} catch(Exception $e) {
					echo $e->getMessage();
				}	
			?>
			<h1>Test: afficher() par specs</h1>
			<?php 
				try {
					$rep = $catalogue->afficher("specs");
					var_dump($rep);
				} catch(Exception $e) {
					echo $e->getMessage();
				}
					
			?>
			<h1>Test: afficher() par prix</h1>
			<?php 
				try {
					$rep = $catalogue->afficher("prix");
					var_dump($rep);
				} catch(Exception $e) {
					echo $e->getMessage();
				}
			?>
			<h1>Test: enregistrer() fonctionnel</h1>
			<?php 
				try {
					$array = array("nomProduit"=>"Test","prixProduit"=>9.99,"descProduit"=>"Test description",);
					$rep = $catalogue->enregistrer($array);
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








