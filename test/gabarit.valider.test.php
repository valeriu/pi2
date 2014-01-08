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
				$a = array("555", "888888", "zzzzzz", "h0h0h0", "z1z1z1", "A0A1G0", "A0A1H0", "A0A1J0", "A0A1K0", "A0A1L0", "A0A1M0", "A0A1N0", "A0A1P0", "A0A1R0", "A0A1S0", "A0A1T0", "A0A1V0", "A0A1W0", "A0A1X0", "A0A1Y0", "A0A1Z0", "A0A2A0", "A0A2B0", "A0A2C0", "A0A2E0", "A0A2G0", "A0A2H0", "A0A2J0", "A0A2K0", "A0A2L0", "A0A2M0", "A0A2N0", "A0A2P0", "A0A2R0", "A0A2R1", "A0A2R2", "A0A2R3", "A0A2S0", "A0A2T0", "A0A2T6", "A0A2V0", "A0A2W0", "A0A2X0", "A0A2Y0", "A0A2Z0", "A0A3A0", "A0A3B0", "A0A3B8", "A0A3C0", "A0A3E0", "A0A3G0", "A0A3H0", "A0A3J0", "A0A3K0", "A0A3L0", "A0A3M0", "A0A3N0", "A0A3P0", "A0A3R0", "A0A3S0", "A0A3T0", "A0A3V0", "A0A3W0", "A0A3X0", "A0A3X1", "A0A3Y0", "A0A3Z0", "A0A4A0", "A0A4B0", "A0A4C0", "A0A4E0", "A0A4G0", "A0A4H0", "A0A4J0", "A0A4K0", "A0A4L0", "A0A4T6", "A0A6J6", "A0A6X1", "A0B1A0", "A0B1A1", "A0B1B0", "A0B1C0", "A0B1C3", "A0B1E0", "A0B1G0", "A0B1H0", "A0B1J0", "A0B1K0", "A0B1L0", "A0B1M0", "A0B1N0", "A0B1N2", "A0B1P0", "A0B1R0", "A0B1S0", "A0B1T0", "A0B1V0", "A0B1W0", "A0B1X0", "A0B1Y0", "A0B1Z0", "A0B2A0", "A0B2A1", "A0B2B0", "A0B2C0", "A0B2E0", "A0B2G0", "A0B2H0", "A0B2J0", "A0B2K0", "A0B2L0", "A0B2M0", "A0B2N0", "A0B2P0", "A0B2R0", "A0B2S0", "A0B2T0", "A0B2V0", "A0B2W0", "A0B2X0", "A0B2Y0", "A0B2Z0", "A0B3A0", "A0B3A1", "A0B3B0", "A0B3C0", "A0B3E0", "A0B3G0", "A0B3H0", "A0B3J0", "A0B3K0", "A0B3K1", "A0B3L0", "A0B3M0", "A0B3N0", "A0B3P0", "A0B3R0", "A0B3W5", "A0B3X0", "A0B4L0", "A0C1A0", "A0C1A9", "A0C1B0", "A0C1C0", "A0C1E0", "A0C1G0", "A0C1H0", "A0C1J0", "A0C1K0", "A0C1L0", "A0C1M0", "A0C1N0", "A0C1P0", "A0C1R0", "A0C1S0", "A0C1T0", "A0C1V0", "A0C1W0", "A0C1X0", "A0C1Y0", "A0C1Z0", "A0C2A0", "A0C2B0", "A0C2C0", "A0C2E0", "A0C2G0", "A0C2G8", "A0C2H0", "A0C2J0", "A0C2K0", "A0C2L0", "A0C2M0", "A0C2N0", "A0C2P0", "A0C2R0", "A0C2S0", "A0C2V0", "A0E0Z0", "A0E1A0", "A0E1A1", "A0E1B0", "A0E1C0", "A0E1E0", "A0E1G0", "A0E1H0", "A0E1J0", "A0E1K0", "A0E1L0", "A0E1M0", "A0E1N0", "A0E1P0", "A0E1R0", "A0E1S0", "A0E1T0", "A0E1V0", "A0E1W0", "A0E1W2", "A0E1X0", "A0E1Y0", "A0E1Z0", "A0E2A0", "A0E2A1", "A0E2B0", "A0E2C0", "A0E2E0", "A0E2G0", "A0E2H0", "A0E2J0", "A0E2K0", "A0E2L0", "A0E2M0", "A0E2N0", "A0E2P0", "A0E2R0", "A0E2S0", "A0E2T0", "A0E2V0", "A0E2W0", "A0E2X0", "A0E2Y0", "A0E2Z0", "A0E3A0", "A0E3B0", "A0E6H1", "A0G0A0", "A0G1A0", "A0G1B0", "A0G1C0", "A0G1E0", "A0G1G0", "A0G1H0", "A0G1J0", "A0G1K0", "A0G1L0", "A0G1M0", "A0G1N0", "A0G1P0", "A0G1R0", "A0G1S0", "A0G1S1", "A0G1T0", "A0G1V0", "A0G1W0", "A0G1X0", "A0G1Y0", "A0G1Z0", "A0G2A0", "A0G2B0", "A0G2C0", "A0G2E0", "A0G2G0", "A0G2H0", "A0G2J0", "A0G2K0", "A0G2L0", "A0G2M0", "A0G2N0", "A0G2P0", "A0G2R0", "A0G2S0", "A0G2T0", "A0G2V0", "A0G2W0", "A0G2X0", "A0G2Y0", "A0G2Z0", "A0G3A0", "A0G3B0", "A0G3C0", "A0G3E0", "A0G3G0", "A0G3H0", "A0G3J0", "A0G3K0", "A0G3L0", "A0G3M0", "A0G3N0", "A0G3P0", "A0G3R0", "A0G3R3", "A0G3S0", "A0G3T0", "A0G3V0", "A0G3W0", "A0G3X0", "A0G3Y0", "A0G3Z0", "A0G4A0", "A0G4B0", "A0G4C0", "A0G4E0", "A0G4G0", "A0G4H0", "A0G4J0", "A0G4K0", "A0G4L0", "A0G4M0", "A0G4N0", "A0G4P0", "A0G4R0", "A0G4S0", "A0G4T0", "A0H0A0", "A0H1A0", "A0H1B0", "A0H1C0", "A0H1C1", "A0H1E0", "A0H1G0", "A0H1H0", "A0H1J0", "A0H1K0", "A0H1L0", "A0H1M0", "A0H1N0", "A0H1P0", "A0H1R0", "A0H1S0", "A0H1T0", "A0H1V0", "A0H1W0", "A0H1X0", "A0H1Y0", "A0H1Z0", "A0H2A0", "A0H2B0", "A0H2C0", "A0H2E0", "A0H2G0", "A0H2H0", "A0H2J0", "A0J0A0", "A0J1A0", "A0J1B0", "A0J1C0", "A0J1E0", "A0J1G0", "A0J1H0", "A0J1J0", "A0J1K0", "A0J1L0", "A0J1M0", "A0J1N0", "A0J1P0", "A0J1R0", "A0J1S0", "A0J1T0", "A0J1V0", "A0J4M0", "A0K0A0", "A0K0B6", "A0K1A0", "A0K1B0", "A0K1C0", "A0K1E0", "A0K1G0", "A0K1H0", "A0K1J0", "A0K1K0", "A0K1L0", "A0K1M0", "A0K1N0", "A0K1P0", "A0K1R0", "A0K1S0", "A0K1T0", "A0K1V0", "A0K1W0", "A0K1X0", "A0K1Y0", "A0K1Z0", "A0K2A0", "A0K2A1", "A0K2B0", "A0K2C0", "A0K2E0", "A0K2E4", "A0K2G0", "A0K2H0", "A0K2J0", "A0K2K0", "A0K2L0", "A0K2M0", "A0K2N0", "A0K2P0", "A0K2R0", "A0K2S0", "A0K2T0", "A0K2V0", "A0K2W0", "A0K2X0", "A0K2Y0", "A0K2Z0", "A0K3A0", "A0K3B0", "A0K3C0", "A0K3E0", "A0K3G0", "A0K3H0", "A0K3J0", "A0K3K0", "A0K3L0", "A0K3M0", "A0K3N0", "A0K3P0", "A0K3R0", "A0K3S0", "A0K3T0", "A0K3V0", "A0K3W0", "A0K3X0", "A0K3Y0", "A0K3Z0", "A0K4A0", "A0K4B0", "A0K4C0", "A0K4E0", "A0K4G0", "A0K4H0", "A0K4I0", "A0K4J0", "A0K4J1", "A0K4K0", "A0K4L0", "A0K4M0", "A0K4N0", "A0K4P0", "A0K4R0", "A0K4S0", "A0K4T0", "A0K4V0", "A0K4W0", "A0K4X0", "A0K4Y0", "A0K4Z0", "A0K5A0", "A0K5B0", "A0K5C0", "A0K5E0", "A0K5G0", "A0K5H0", "A0K5J0", "A0K5K0", "A0K5L0", "A0K5M0", "A0K5N0", "A0K5P0", "A0K5R0", "A0K5S0", "A0K5T0", "A0K5V0", "A0K5W0", "A0K5X0", "A0K5Y0", "A0K5Z0", "A0L0L0", "A0L1A0", "A0L1A1", "A0L1B0", "A0L1B1", "A0L1C0", "A0L1E0", "A0L1G0", "A0L1H0", "A0L1J0", "A0L1K0", "A0L1L0", "A0L1N0", "A0L1X0", "A0L2A0", "A0L4L0", "A0L4S0", "A0M1A0", "A0M1B0", "A0M1C0", "A0M1E0", "A0M1G0", "A0M1H0", "A0M1J0", "A0M1J6", "A0M1K0", "A0M1L0", "A0M1M0", "A0M1N0", "A0M1P0", "A0M1Y0", "A0M2H0", "A0N0A2", "A0N1A0", "A0N1B0", "A0N1C0", "A0N1E0", "A0N1G0", "A0N1H0", "A0N1J0", "A0N1K0", "A0N1L0", "A0N1M0", "A0N1N0", "A0N1P0", "A0N1R0", "A0N1S0", "A0N1T0", "A0N1T1", "A0N1V0", "A0N1W0", "A0N1X0", "A0N1Y0", "A0N1Z0", "A0N2A0", "A0N2B0", "A0N2C0", "A0N2E0", "A0N2G0", "A0N2H0", "A0N2J0", "A0N2K0", "A0N2L0", "A0N2Y0", "A0N2Z5", "A0P1A0", "A0P1B0", "A0P1C0", "A0P1E0", "A0P1G0", "A0P1H0", "A0P1J0", "A0P1K0", "A0P1L0", "A0P1M0", "A0P1N0", "A0P1O3", "A0P1P0", "A0P1R0", "A0P1S0", "A0P1T0", "A0P2K0", "A0R1A0", "A0R1B0", "A0R1B1", "A0R1C0", "A0R4M0", "A1A0A1", "A1A0A2", "A1A0A3", "A1A0A4", "A1A0A5", "A1A0A6", "A1A0A7", "A1A0A8", "A1A0A9", "A1A0B1", "A1A0B2", "A1A0B3", "A1A0B4", "A1A0B5", "A1A0B6", "A1A0B7", "A1A0B8", "A1A0B9", "A1A0C1", "A1A0C2", "A1A0C3", "A1A0C4", "A1A0C5", "A1A0C6", "A1A0C7", "A1A0C8", "A1A0C9", "A1A0E1", "A1A0E2", "A1A0E3", "A1A0E4", "A1A0E5", "A1A0E6", "A1A0E7", "A1A0E8", "A1A0E9", "A1A0G1", "A1A0G2", "A1A0G3", "A1A0G4", "A1A0G5", "A1A0G6", "A1A0G7", "A1A0G8", "A1A0G9", "A1A0H1", "A1A0H2", "A1A0H3", "A1A0H4", "A1A0H5", "A1A0J2", "A1A0K6", "A1A1A1", "A1A1A2", "A1A1A3", "A1A1A4", "A1A1A5", "A1A1A6", "A1A1A7", "A1A1A8", "A1A1A9", "A1A1B1", "A1A1B2", "A1A1B3", "A1A1B4", "A1A1B5", "A1A1B6", "A1A1B7", "A1A1B8", "A1A1B9", "A1A1C1", "A1A1C2", "A1A1C3", "A1A1C4", "A1A1C5", "A1A1C6", "A1A1C7", "A1A1C8", "A1A1C9", "A1A1E1", "A1A1E2", "A1A1E3", "A1A1E4", "A1A1E5", "A1A1E6", "A1A1E7", "A1A1E8", "A1A1E9", "A1A1G1", "A1A1G2", "A1A1G3", "A1A1G4", "A1A1G5", "A1A1G6", "A1A1G7", "A1A1G8", "A1A1G9", "A1A1H1", "A1A1H2", "A1A1H3", "A1A1H4", "A1A1H5", "A1A1H6", "A1A1H7", "A1A1H8", "A1A1H9", "A1A1J0", "A1A1J1", "A1A1J2", "A1A1J3", "A1A1J4", "A1A1J5", "A1A1J6", "A1A1J7", "A1A1J8", "A1A1J9", "A1A1K1", "A1A1K2", "A1A1K3", "A1A1K4", "A1A1K5", "A1A1K6", "A1A1K7", "A1A1K8", "A1A1K9", "A1A1L1", "A1A1L2", "A1A1L3", "A1A1L4", "A1A1L5", "A1A1L6", "A1A1L7", "A1A1L8", "A1A1L9", "A1A1M1", "A1A1M2", "A1A1M3", "A1A1M4", "A1A1M5", "A1A1M6", "A1A1M7", "A1A1M8", "A1A1M9", "A1A1N1", "A1A1N2", "A1A1N3", "A1A1N4", "A1A1N5", "A1A1N6", "A1A1N7", "A1A1N8", "A1A1N9", "A1A1P1", "A1A1P2", "A1A1P3", "A1A1P4", "A1A1P6", "A1A1P7", "A1A1P8", "A1A1P9", "A1A1R1", "A1A1R2", "A1A1R3", "A1A1R4", "A1A1R5", "A1A1R6", "A1A1R7", "A1A1R8", "A1A1R9", "A1A1S1", "A1A1S2", "A1A1S3", "A1A1S4", "A1A1S5", "A1A1S6", "A1A1S7", "A1A1S8", "A1A1T1", "A1A1T2", "A1A1T3", "A1A1T4", "A1A1T5", "A1A1T6", "A1A1T7", "A1A1T8", "A1A1T9", "A1A1V1", "A1A1V2", "A1A1V3", "A1A1V4", "A1A1V5", "A1A1V6", "A1A1V7", "A1A1V8", "A1A1V9", "A1A1W0", "A1A1W1", "A1A1W2", "A1A1W3", "A1A1W4", "A1A1W5", "A1A1W6", "A1A1W7", "A1A1W8", "A1A1W9", "A1A1X0", "A1A1X1", "A1A1X2", "A1A1X3", "A1A1X4", "A1A1X5", "A1A1X6", "A1A1X7", "A1A1X8", "A1A1X9", "A1A1Y1", "A1A1Y2", "A1A1Y3", "A1A1Y4", "A1A1Y5", "A1A1Y6", "A1A1Y7", "A1A1Y8", "A1A1Y9", "A1A1Z1", "A1A1Z2", "A1A1Z3", "A1A1Z4", "A1A1Z5", "A1A1Z6", "A1A1Z7", "A1A1Z8", "A1A1Z9", "A1A2A1", "A1A2A2", "A1A2A3", "A1A2A4", "A1A2A5", "A1A2A6", "A1A2A7", "A1A2A8", "A1A2A9", "A1A2B1", "A1A2B2", "A1A2B3", "A1A2B4", "A1A2B5", "A1A2B6", "A1A2B7", "A1A2B8", "A1A2B9", "A1A2C1", "A1A2C2", "A1A2C3", "A1A2C4", "A1A2C5", "A1A2C6", "A1A2C7", "A1A2C8", "A1A2C9", "A1A2E1", "A1A2E2", "A1A2E3", "A1A2E4", "A1A2E5", "A1A2E6", "A1A2E7", "A1A2E8", "A1A2E9", "A1A2G1", "A1A2G2", "A1A2G3", "A1A2G4", "A1A2G5", "A1A2G6", "A1A2G7", "A1A2G8", "A1A2G9", "A1A2H0", "A1A2H1", "A1A2H2", "A1A2H3", "A1A2H4", "A1A2H6", "A1A2H7", "A1A2H8", "A1A2H9", "A1A2J1", "A1A2J2", "A1A2J3", "A1A2J4");
				
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
						"ab" =>  array("fr" => "Alberta", "en" => "Alberta"),
						"bc" =>  array("fr" => "Colombie-Britannique", "en" => "British Columbia"),
						"mb" =>  array("fr" => "Manitoba", "en" => "Manitoba"),
						"nb" =>  array("fr" => "Nouveau-Brunswick", "en" => "New Brunswick"),
						"nl" =>  array("fr" => "Terre-Neuve-et-Labrador", "en" => "Newfoundland and Labrador"),
						"ns" =>  array("fr" => "Nouvelle-Écosse", "en" => "Nova Scotia"),	
						"nt" =>  array("fr" => "Territoires du Nord-Ouest", "en" => "Northwest Territories"),	
						"nu" =>  array("fr" => "Nunavut", "en" => "Nunavut"),	
						"on" =>  array("fr" => "Ontario", "en" => "Ontario"),
						"pe" =>  array("fr" => "Île-du-Prince-Édouard", "en" => "Prince Edward Island"),
						"qc" =>  array("fr" => "Québec", "en" => "Quebec"),
						"sk" =>  array("fr" => "Saskatchewan", "en" => "Saskatchewan"),	
						"sk" =>  array("fr" => "Yukon", "en" => "Yukon"));
				
				for($i=0, $j=count($a); $i<$j; $i++ ){ {
					if(Valider::estProvince($a[$i])){
						echo $a[$i] . " - true<br>";
					} else {
						echo $a[$i] . " - false<br>";
					}
				}
			?>	
				
				
</div>
	</body>
</html>
