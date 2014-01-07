<?php
require_once("./includes/config.php");

if(isset($_GET['test'])){
	switch($_GET['test']){
		case 'usagers':
			require_once ("./test/gabarit.usagers.test.php");
			break;
		case 'pages':
			require_once ("./test/gabarit.pages.test.php");
			break;	
		case 'adresse':
			require_once ("./test/gabarit.adresse.test.php");
			break;	
		case 'catalogue':
			require_once ("./test/gabarit.catalogue.test.php");
			break;
		case 'commandes_admin':
			require_once ("./test/gabarit.commandes_admin.test.php");
			break;
		case 'menu':
			require_once ("./test/gabarit.menu.test.php");
			break;
		case 'pagination':
			require_once ("./test/gabarit.pagination.test.php");
			break;
		case 'panier':
			require_once ("./test/gabarit.panier.test.php");
			break;	
	}
}
else{
	echo "	<ul>
				<li><a href='?test=usagers'>USAGERS</a></li>
				<li><a href='?test=pages'>PAGES</a></li>
				<li><a href='?test=adresse'>ADRESSE</a></li>
				<li><a href='?test=catalogue'>CATALOGUE</a></li>
				<li><a href='?test=commandes_admin'>commandes_admin</a></li>
				<li><a href='?test=menu'>MENU</a></li>
				<li><a href='?test=pagination'>PAGINATION</a></li>
				<li><a href='?test=panier'>PANIER</a></li>
			</ul>";
}	

?>