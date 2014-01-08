<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="fr">
	<head>
		<title>Test Valider</title>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	</head>

	<body>
		<div id="header">
			<h1>Test - Modèles - Valider</h1>
		</div>
		<div id="contenu">
			<h3>Test: estCourriel($valeur)</h3>
			<?php 
				$aEmail = array("valeriu@tihai.md", "testtest", "test@mail.comssskslsl", "mail.ca@ca.ca.ca", "ion@gmail.com" );
				
				foreach ($aEmail as $email) {
					if(Valider::estCourriel($email)){
						echo $email . " - true<br>";
					} else {
						echo $email . " - false<br>";
					}
				}
			?>
<hr>
				<h3>Test: estInt($valeur)</h3>
			<?php 
				$a = array(23, "23", 23.5, -23.5, "23.5", null, true, false, 15, -11);
				
				foreach ($a as $k) {
					if(Valider::estInt($k)){
						echo $k . " - true<br>";
					} else {
						echo $k . " - false<br>";
					}
				}
			?>
<hr>
				<h3>Test: estFloat($valeur)</h3>
			<?php 
				$a = array(23, "23", 23.5, "23.5", null, true, false, 15, -11);
				
				foreach ($a as $k) {
					if(Valider::estFloat($k)){
						echo $k . " - true<br>";
					} else {
						echo $k . " - false<br>";
					}
				}
			?>			
<hr>
				<h3>Test: estAlphaNumerique($valeur)</h3>
			<?php 
				$a = array(23, "23", 23.5, "23.5", null, true, false, 15, -11);
				
				foreach ($a as $k) {
					if(Valider::estFloat($k)){
						echo $k . " - true<br>";
					} else {
						echo $k . " - false<br>";
					}
				}
			?>				
		</div>
	</body>
</html>