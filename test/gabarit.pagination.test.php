<!DOCTYPE html>
	<head>
		<title>Test Pagination</title>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	</head>

	<body>
		<div id="header">
			<h1>Test - Modèles - Pagination</h1>
		</div>
		<div id="contenu">
			<h1>Test: paginate()</h1>
			
                        <?php
                               $pageBD = new Pages();
							   $allpageBD = $pageBD->afficherListe();
							   
                               $page = new Pagination;
                                
                                
                                $pages = $page->paginate($allpageBD, 30);
                                $data = $page->voirRsultats();
                                

                                foreach($pages as $page){
                                        echo "<a href='http://e1295805.webdev.cmaisonneuve.qc.ca/valeriu/index.test.php?test=pagination&page=".$page."'>".$page."</a>";
                                }
                        ?>
		</div>
		<div id="footer">

		</div>
	</body>
</html>








