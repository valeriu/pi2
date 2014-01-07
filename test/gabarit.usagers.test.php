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
				$usagers = new Usagers();
				$rep = $usagers->connecter("per.inceptos@blandit.com", "pass");
				var_dump($rep);
			?>
			<h1>Test: connecter() non-fonctionnel</h1>
			<?php 
				$usagers = new Usagers();
				$rep = $usagers->connecter("test", "pass");
				var_dump($rep);
			?>
			<h1>Test: connecter() non-fonctionnel</h1>
			<?php 
				$usagers = new Usagers();
				$rep = $usagers->connecter("per.inceptos@blandit.com", "test");
				var_dump($rep);
			?>
			<h1>Test: afficher() fonctionnel</h1>
			<?php 
				$usagers = new Usagers();
				$rep = $usagers->afficher(1);
				var_dump($rep);
			?>
			<h1>Test: afficher() fonctionnel</h1>
			<?php 
				$usagers = new Usagers();
				$rep = $usagers->afficher(8);
				var_dump($rep);
			?>
			<h1>Test: afficher() non-fonctionnel</h1>
			<?php 
				$usagers = new Usagers();
				$rep = $usagers->afficher(5000);
				var_dump($rep);
			?>
			<h1>Test: afficherListe() fonctionnel</h1>
			<?php 
				$usagers = new Usagers();
				$rep = $usagers->afficherListe();
				//echo "<pre>";
				//print_r($rep);
			?>
			<h1>Test: enregistrer() fonctionnel</h1>
			<?php 
				$usagers = new Usagers();
				$rep = $usagers->enregistrer('test@test.eu', 'pass', 'Luc, Mars');
				var_dump($rep);
			?>
		</div>
		<div id="footer">

		</div>
	</body>
</html>








