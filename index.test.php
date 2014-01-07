<?php
require_once("./includes/config.php");

switch($_GET['test']){
	case 'usagers':
		require_once ("./test/gabarit.usagers.test.php");
		break;
	case 'pages':
		require_once ("./test/gabarit.pages.test.php");
		break;	
	default:
		echo "	<ul>
					<li><a href='?test=usagers'></a></li>
				</ul>";
}

?>