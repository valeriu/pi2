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
		</div>
		<div id="footer">

		</div>
	</body>
</html>








