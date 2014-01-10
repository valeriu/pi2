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
						try{
                               $pageBD = new Pages();
							   $allpageBD = $pageBD->afficherListe();
							   
                               $page = new Pagination;
                                
                                $aDonnees = array("aTousElements" => $allpageBD, "parPage" => 20, "pageCourante" => 1);
                                $pages = $page->paginate($aDonnees);
                                $data = $page->voirRsultats();
                                

                                foreach($pages as $page){
                                        echo "<a href='http://e1295805.webdev.cmaisonneuve.qc.ca/valeriu/index.test.php?test=pagination&page=".$page."'>".$page."</a>";
                                }
						} catch (Exception $e) {
							echo $e->getMessage();
						}
                        ?>
		</div>
		<div id="footer">

		</div>
	</body>
</html>








