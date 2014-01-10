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
			<h3>Test: ajouter ($titre, $description_meta, $contenu, $statut, $geo_long, $geo_lat) fonctionnel</h3>
			<?php 
			$r = rand(1,1000);
			try {
				$page = new Pages();
				$aDonnees = array("titre" => "Titlul".$r, "description_meta" => "sDescrierea", "contenu" => "Content", "statut" => 1, "geo_long" => "", "geo_lat" => "-6582.5");
				$result = $page->ajouter ($aDonnees);

				var_dump($result);
				
			} catch (Exception $e) {
				echo $e->getMessage();
			}	
			?>

			<h1>Test: modifier ($id_page, $titre, $description_meta, $contenu, $date, $statut, $geo_long, $geo_lat) fonctionnel</h1>
			<?php 
			$r = rand(1,1000);
			try {
				$page = new Pages();
				$aDonnees = array("id_page" => 149, "titre" => "Titlul".$r, "description_meta" => $r." sDescrierea", "contenu" => "Content", "statut" => 1, "geo_long" => "", "geo_lat" => "-6582.5");
				$result = $page->modifier ($aDonnees);

				var_dump($result);
				
			} catch (Exception $e) {
				echo $e->getMessage();
			}	
			?>
		<h3>Test: afficher ($id_page) fonctionnel</h3>
		<pre>
			<?php 
			try {
				$page = new Pages();
				$aDonnees = array("id_page" => 99);
				$result = $page->afficher ($aDonnees);

				var_dump($result);
			} catch (Exception $e) {
				echo $e->getMessage();
			}		
			?>	
		</pre>
		
		
		<h1>Test: afficherListe() - fonctionnel</h1>
		<pre>
			<?php 
			try {
				$page = new Pages();
				$result = $page->afficherListe();

				var_dump($result);
			} catch (Exception $e) {
				echo $e->getMessage();
			}		
			?>	
		</pre>		
		
		</div>
	</body>
</html>
<?php 


?>