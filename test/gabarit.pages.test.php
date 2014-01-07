<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="fr">
	<head>
		<title>Test Pages</title>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	</head>

	<body>
		<div id="header">
			<h1>Test - Modèles - Pages</h1>
		</div>
		<div id="contenu">
			<h1>Test: ajouter ($titre, $description_meta, $contenu, $statut, $geo_long, $geo_lat) fonctionnel</h1>
			<?php 
				$page = new Pages();
				$result = $page->ajouter ("titre", "description_meta", "contenu", 1, 22.55, 55.888);

				var_dump($result);
			?>

			<h1>Test: modifier ($id_page, $titre, $description_meta, $contenu, $date, $statut, $geo_long, $geo_lat) fonctionnel</h1>
			<?php 
				$page = new Pages();
				$date = date("Y-m-d H:i:s");
				$result = $page->modifier (110, "titre", "description_meta", "contenu", $date, 1, 22.55, 55.888);

				var_dump($result);
			?>
		<h1>Test: afficher ($id_page) fonctionnel</h1>
		<pre>
			<?php 
				$page = new Pages();
				$result = $page->afficher (99);

				var_dump($result);
			?>	
		</pre>
		
		
		<h1>Test: afficherListe() - fonctionnel</h1>
		<pre>
			<?php 
				$page = new Pages();
				$result = $page->afficherListe();

				var_dump($result);
			?>	
		</pre>		
		
		</div>
	</body>
</html>