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
				$rep = $usagers->connecter("ex@ex.com", "pass");
				var_dump($rep);
			?>
			<h1>Test: connecter() fonctionnel</h1>
			<?php 
				$usagers = new Usagers();
				$rep = $usagers->connecter("tempor.lorem.eget@Curabiturvel.net", "ZYG98ZBO7EQ");
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
			<h1>Test: modifier() fonctionnel</h1>
			<?php 
				$usagers = new Usagers();
				//$id_utilisateurs, $courriel, $mot_passe, $nom_prenom, $date_entree, $role, $cle_reactivation, $statut
				$rep = $usagers->modifier('4', 'a@a.eu', 'pass', 'TEST', '1965-10-29 00:00:00', '1', null, '1');
				var_dump($rep);
			?>
			<h1>Test: modifierMotPasse() fonctionnel</h1>
			<?php 
				$usagers = new Usagers();
				$rep = $usagers->modifierMotPasse("ex@ex.com", "pass", "pass");
				var_dump($rep);
			?>
		</div>
		<div id="footer">

		</div>
	</body>
</html>








