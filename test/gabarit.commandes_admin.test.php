<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="fr">
	<head>
		<title>Test Commandes</title>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	</head>

	<body>
		<div id="header">
			<h1>Test - Modèles - Commandes</h1>
		</div>
		<div id="contenu">
			<h3>Test: afficherListe () fonctionnel</h3>
			<?php 
			$r = rand(1,31);
			try {
				$page = new Commandes_Admin();
				$aDonnees = array();
				$result = $page->afficherListe();

				var_dump($result);
				
			} catch (Exception $e) {
				echo $e->getMessage();
			}	
			?>	
		
		</div>
	</body>
</html>
<?php 


?>