<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="fr">
	<head>
		<title>Test Pages</title>
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

			
		</div>
	</body>
</html>