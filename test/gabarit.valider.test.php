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
			try{
					Valider::estVide();
				}
				catch(Exception $e){
					echo $e->getMessage();
				}
			
			
			
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
				$a = array(23, "", 23.5, -23.5, "23.5", null, true, false, 15, -11);
				
				foreach ($a as $k) {
					try{
						if(Valider::estInt($k)){
							echo $k . " - true<br>";
						} else {
							echo $k . " - false<br>";
						}
						}catch(Exception $e){
					echo $e->getMessage();
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
				<h3>Test: estEntreString($valeur)</h3>
			<?php 
				$valeur = "test";
				$nb1 = array(0, 1, 2, 3, 4, 5, 6); 
				$nb2 = array(6, 7, 8, 9, 10, 11, 12);
				
				for($i=0, $j=count($nb1); $i<$j; $i++ ){
					if(Valider::estEntreString($valeur, $nb1[$i], $nb2[$i])){
						echo $valeur." / ".$nb1[$i]." - ".$nb2[$i]." = true<br>";
					} else {
						echo $valeur." / ".$nb1[$i]." - ".$nb2[$i]." = false<br>";
					}
				}
			?>
<hr>
				<h3>Test: estEntreInt($valeur)</h3>
			<?php 
				$valeur = array(3, 7, 1, 4, 9, 4, 1); 
				$nb1 = array(0, 1, 2, 3, 4, 5, 6); 
				$nb2 = array(6, 7, 8, 9, 10, 11, 12);
				
				for($i=0, $j=count($nb1); $i<$j; $i++ ){
					if(Valider::estEntreInt($valeur[$i], $nb1[$i], $nb2[$i])){
						echo $valeur[$i]." / ".$nb1[$i]." - ".$nb2[$i]." = true<br>";
					} else {
						echo $valeur[$i]." / ".$nb1[$i]." - ".$nb2[$i]." = false<br>";
					}
				}
			?>	
<hr>
				<h3>Test: estTableau($valeur)</h3>
			<?php 
				$valeur = "array"; 
				$nb1 = array(0, 1, 2, 3, 4, 5, 6); 
				$nb2 = array(6, 7, 8, 9, 10, 11, 12);
				$nb3 =2;
					if(Valider::estTableau($nb3)){
						echo " = true<br>";
					} else {
						echo " = false<br>";
					}

			?>	
<hr>
				<h3>Test: estNegatif($valeur)</h3>
			<?php 
				$a = array(23, "23", 23.5, -23.5, "23.5", null, true, false, 15, -11);
				
				foreach ($a as $k) {
					if(Valider::estNegatif($k)){
						echo $k . " - true<br>";
					} else {
						echo $k . " - false<br>";
					}
				}
			?>				
<hr>
				<h3>Test: estImage($valeur)</h3>
			<?php 
				$a = array ("jpg", "jpeg", "doc", "jpe", "csv", "png", "gif", "bmp", "exe", "dll");
				
				foreach ($a as $k) {
					if(Valider::estImage($k)){
						echo $k . " - true<br>";
					} else {
						echo $k . " - false<br>";
					}
				}
			?>	
<hr>
				<h3>Test: estTel($valeur)</h3>
			<?php 
				$a = array("4388872098","5141347314","d2309021458","ssss976512586","8236529368","4284722034","1334593643","8933157676","8538867262","9624681372","5137929352","6723998340","4393277714","1233905538","5149065471","4455731365","8975263325","3917699474","5146546173","8543319523","5819453358","5811172826","5093994144","9092923573","5118869215","3514104300","1433836198","9171438356","5149637694","5879173997","4517623595","2011923898","2738465725","3894595560","7552321994","7018016436","6014628493","4281339865","5074977669","6257963386","8103597209","1107337793","1614843217","3045703992","7826669283","6752257652","3128818451","6709007340","2014391539","2759284807","6951974284","5145894991","9363280879","9004528926","5782465755");
				
				foreach ($a as $k) {
					if(Valider::estTel($k)){
						echo $k . " - true<br>";
					} else {
						echo $k . " - false<br>";
					}
				}
			?>					
				<h3>Test: estCodePostal($valeur)</h3>
			<?php 
				$a = array("555", "888888", "zzzzzz", "h0h0h0", "z1z1z1", "A0A1G0", "A0A1H0", "A0A1J0", "A0A1K0", "A0A1L0", "A0A1M0", "A0A1N0", "A0A1P0", "A0A1R0", "A0A1S0", "A0A1T0", "A0A1V0", "A0A1W0", "A0A1X0", "A0A1Y0", "A0A1Z0", "A0A2A0", "A0A2B0", "A0A2C0", "A0A2E0", "A0A2G0", "A0A2H0", "A0A2J0", "A0A2K0", "A0A2L0", "A0A2M0", "A0A2N0", "A0A2P0", "A0A2R0", "A0A2R1", "A0A2R2", "A0A2R3", "A0A2S0", "A0A2T0", "A0A2T6", "A0A2V0", "A0A2W0", "A0A2X0", "A0A2Y0", "A0A2Z0", "A0A3A0", "A0A3B0", "A0A3B8", "A0A3C0", "A0A3E0", "A0A3G0", "A0A3H0", "A0A3J0", "A0A3K0", "A0A3L0", "A0A3M0", "A0A3N0", "A0A3P0", "A0A3R0", "A0A3S0", "A0A3T0", "A0A3V0", "A0A3W0", "A0A3X0", "A0A3X1", "A0A3Y0", "A0A3Z0", "A0A4A0", "A0A4B0", "A0A4C0", "A0A4E0", "A0A4G0", "A0A4H0", "A0A4J0", "A0A4K0", "A0A4L0", "A0A4T6", "A0A6J6", "A0A6X1", "A0B1A0", "A0B1A1", "A0B1B0", "A0B1C0", "A0B1C3", "A0B1E0", "A0B1G0", "A0B1H0", "A0B1J0", "A0B1K0", "A0B1L0", "A0B1M0", "A0B1N0", "A0B1N2", "A0B1P0", "A0B1R0", "A0B1S0", "A0B1T0", "A0B1V0", "A0B1W0", "A0B1X0", "A0B1Y0", "A0B1Z0", "A0B2A0", "A0B2A1", "A0B2B0", "A0B2C0", "A0B2E0", "A0B2G0", "A0B2H0", "A0B2J0", "A0B2K0", "A0B2L0", "A0B2M0", "A0B2N0", "A0B2P0", "A0B2R0", "A0B2S0", "A0B2T0", "A0B2V0", "A0B2W0", "A0B2X0", "A0B2Y0", "A0B2Z0", "A0B3A0", "A0B3A1", "A0B3B0", "A0B3C0", "A0B3E0", "A0B3G0", "A0B3H0", "A0B3J0", "A0B3K0", "A0B3K1", "A0B3L0", "A0B3M0", "A0B3N0", "A0B3P0", "A0B3R0", "A0B3W5", "A0B3X0", "A0B4L0", "A0C1A0", "A0C1A9", "A0C1B0", "A0C1C0", "A0C1E0", "A0C1G0", "A0C1H0", "A0C1J0", "A0C1K0", "A0C1L0", "A0C1M0", "A0C1N0", "A0C1P0", "A0C1R0", "A0C1S0", "A0C1T0", "A0C1V0");
				
				foreach ($a as $k) {
					if(Valider::estCodePostal($k)){
						echo $k . " - true<br>";
					} else {
						echo $k . " - false<br>";
					}
				}
			?>					
				<h3>Test: estProvince($valeur)</h3>
			<?php 
				$a = array(
						13 =>  array("abb" => "oob", "fr" => "OoO", "en" => "Alberta"),
						0 =>  array("abb" => "ab", "fr" => "Alberta", "en" => "Alberta"),
						1 =>  array("abb" => "bc", "fr" => "Colombie-Britannique", "en" => "British Columbia"),
						2 =>  array("abb" => "mb", "fr" => "Manitoba", "en" => "Manitoba"),
						3 =>  array("abb" => "nb", "fr" => "Nouveau-Brunswick", "en" => "New Brunswick"),
						4 =>  array("abb" => "nl", "fr" => "Terre-Neuve-et-Labrador", "en" => "Newfoundland and Labrador"),
						5 =>  array("abb" => "ns", "fr" => "Nouvelle-Écosse", "en" => "Nova Scotia"),	
						6 =>  array("abb" => "nt", "fr" => "Territoires du Nord-Ouest", "en" => "Northwest Territories"),	
						7 =>  array("abb" => "nu", "fr" => "Nunavut", "en" => "Nunavut"),	
						8 =>  array("abb" => "on", "fr" => "Ontario", "en" => "Ontario"),
						9 =>  array("abb" => "pe", "fr" => "Île-du-Prince-Édouard", "en" => "Prince Edward Island"),
						10 =>  array("abb" => "qc", "fr" => "Québec", "en" => "Quebec"),
						11 =>  array("abb" => "sk", "fr" => "Saskatchewan", "en" => "Saskatchewan"),	
						12 =>  array("abb" => "sk", "fr" => "Yukon", "en" => "Yukon"));
								
				for($i=0, $j=count($a); $i<$j; $i++ ){ 
					if(Valider::estProvince($a[$i]["abb"])){
						echo $a[$i]["abb"]." - " .$a[$i]["fr"]. " - true<br>";
					} else {
						echo $a[$i]["abb"]." - " .$a[$i]["fr"]. " - false<br>";
					}
				}
			?>	
					<h3>Test: estAlphaNumerique($valeur)</h3>
			<?php 
				$a = array("555", "888888", "zz.zzzz", "h0h0h0", "z1z1z1", "A0A1G0");
				
				foreach ($a as $k) {
					if(Valider::estAlphaNumerique($k)){
						echo $k . " - true<br>";
					} else {
						echo $k . " - false<br>";
					}
				}
			?>				
<hr>
					<h3>Test: estDate($valeur)</h3>
			<?php //Y-m-d H:i:s
				$a = array("555", "1801-01-01 01:01:01", "zz.zzzz", "1978-12-18 15:85:18", "z1z1z1", "A0A1G0");
				foreach ($a as $k) {
					if(Valider::estDate($k)){
						echo $k . " - true<br>";
					} else {
						echo $k . " - false<br>";
					}
				}
			?>					
<hr>
					<h3>Test: estURL($valeur)</h3>
			<?php //Y-m-d H:i:s
				$a = array("https://weami_va.net", "file://weamiva.biz", "weamiva.org","www.weamiva.us", "http://wea.m.i.v.a.co.uk?a=b&c=z", "http://weamiva.de", "http://weamiva.co", "http://weamiva.io");;
				foreach ($a as $k) {
					if(Valider::estURL($k)){
						echo $k . " - true<br>";
					} else {
						echo $k . " - false<br>";
					}
				}
			?>						
</div>
	</body>
</html>
