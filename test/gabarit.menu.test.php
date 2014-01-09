<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="fr">

	<head>

		<title>Test unitaire</title>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	</head>

	<body>
		<div id="header">
			<h1>Test - Modèles - Menu</h1>
		</div>
		<div id="contenu">
			<h1>Test: enregistrer() non-fonctionnel</h1>
			<?php 
				try{
				//id_menu	titre	description	url	parent	order	statut
				$menu = new Menu();
				$rep = $menu->enregistrer(array( 'description' => '', 'url' => '', 'parent' => '', 'order' => '', 'statut' => ''));
				var_dump($rep);
				}
				catch(Exception $e){
					echo $e->getMessage();
				}
			?>
			<h1>Test: enregistrer() non-fonctionnel</h1>
			<?php 
				try{
				//id_menu	titre	description	url	parent	order	statut
				$menu = new Menu();
				$rep = $menu->enregistrer(array('titre' => '', 'description' => '', 'url' => '', 'parent' => '', 'order' => '', 'statut' => ''));
				var_dump($rep);
				}
				catch(Exception $e){
					echo $e->getMessage();
				}
			?>
			<h1>Test: enregistrer() fonctionnel</h1>
			<?php 
				try{
				//id_menu	titre	description	url	parent	order	statut
				$menu = new Menu();
				$rep = $menu->enregistrer(array('titre' => 'Nouveau', 'description' => '', 'url' => '', 'parent' => '', 'order' => '', 'statut' => ''));
				var_dump($rep);
				}
				catch(Exception $e){
					echo $e->getMessage();
				}
			?>
			<h1>Test: enregistrer() fonctionnel</h1>
			<?php 
				try{
				//id_menu	titre	description	url	parent	order	statut
				$menu = new Menu();
				$rep = $menu->enregistrer(array('titre' => 'Autre', 'description' => '', 'url' => '', 'parent' => '', 'order' => '', 'statut' => ''));
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








