<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="fr">

	<head>

		<title>Test unitaire</title>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	</head>

	<body>
		<div id="header">
			<h1>Test - Modèles - Adresses</h1>
		</div>
		<div id="contenu">
			<h1>Test: verifier() fonctionnel</h1>
			<?php 
				try{
					$adresse = new Adresse();
					$rep = $adresse->verifier(array('telephone' => '255',	'rue' => '9537 Mi St.',	'appartement' => '4354',	'ville' => 'Brive-la-Gaillarde',	'code_postal' => 'Z9L8W8',	'province' => 'Limousin'));
					var_dump($rep);
				}
				catch(Exception $e){
					echo $e->getMessage();
				}
				
			?>
			<h1>Test: verifier() non-fonctionnel</h1>
			<?php 
				try{
					$adresse = new Adresse();
					$rep = $adresse->verifier(array('telephone' => '0',	'rue' => '9537 Mi St.',	'appartement' => '4354',	'ville' => 'Brive-la-Gaillarde',	'code_postal' => 'Z9L8W8',	'province' => 'Limousin'));
					var_dump($rep);
				}
				catch(Exception $e){
					echo $e->getMessage();
				}
				
			?>
			<h1>Test: eregistrer() non-fonctionnel</h1>
			<?php 
				try{
					$adresse = new Adresse();
					$rep = $adresse->enregistrer(array('id_utilisateurs' => '1', 'telephone' => '255',	'rue' => '9537 Mi St.',	'appartement' => '4354',	'ville' => 'Brive-la-Gaillarde',	'code_postal' => 'Z9L8W8',	'province' => 'Limousin'));
					var_dump($rep);
				}
				catch(Exception $e){
					echo $e->getMessage();
				}
				
			?>
			<h1>Test: eregistrer() fonctionnel</h1>
			<?php 
				try{
					$adresse = new Adresse();
					$rep = $adresse->enregistrer(array('id_utilisateurs' => '1', 'telephone' => '438',	'rue' => 'TEST',	'appartement' => '3',	'ville' => 'Montréal',	'code_postal' => 'Z9L8W8',	'province' => 'Qc'));
					var_dump($rep);
				}
				catch(Exception $e){
					echo $e->getMessage();
				}
				
			?>
			<h1>Test: modifier() fonctionnel</h1>
			<?php 
				try{
					$adresse = new Adresse();
					$rep = $adresse->modifier(array('id_adresse' => '113', 'telephone' => '819',	'rue' => 'TEST 2',	'appartement' => '3',	'ville' => 'Montréal',	'code_postal' => 'Z9L8W8',	'province' => 'Qc'));
					var_dump($rep);
				}
				catch(Exception $e){
					echo $e->getMessage();
				}
				
			?>
			<h1>Test: afficher() fonctionnel</h1>
			<?php 
				try{
					$adresse = new Adresse();
					$rep = $adresse->afficher(array('id_adresse' => '112'));
					var_dump($rep);
				}
				catch(Exception $e){
					echo $e->getMessage();
				}
				
			?>
			<h1>Test: afficher() non-fonctionnel</h1>
			<?php 
				try{
					$adresse = new Adresse();
					$rep = $adresse->afficher(array('id_adresse' => '1112'));
					var_dump($rep);
				}
				catch(Exception $e){
					echo $e->getMessage();
				}
				
			?>
			<h1>Test: afficherListe() fonctionnel</h1>
			<?php 
				try{
					$adresse = new Adresse();
					$rep = $adresse->afficherListe();
					//var_dump($rep);
				}
				catch(Exception $e){
					echo $e->getMessage();
				}
				
			?>
			
			<h1>Test: afficherAdresseUsager() fonctionnel</h1>
			<?php 
				try{
					$adresse = new Adresse();
					$rep = $adresse->afficherAdresseUsager(array("courriel" => "tempor.lorem.eget@Curabiturvel.net"));
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








