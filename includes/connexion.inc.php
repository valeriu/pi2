<?php
function connexionPDO() {
	include_once("includes/connexion.inc.php");
	$dsn  = "mysql:host=".HOST.";dbname=".BD;
	$user = USER;
	$pass = PASS;
	try {
		$idBD = new PDO($dsn,$user,$pass);
		return $idBD;
	} catch(PDOException $pdoe) {
		echo "Echec de la connexion : ",$pdoe->getMessage();
		return FALSE;
		exit();
	}
}
?>
