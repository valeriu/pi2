<!DOCTYPE html>
<html lang="fr">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<meta name="description" content="Wadagbé">
		<meta name="author" content="">
		<link rel="shortcut icon" href="../../docs-assets/ico/favicon.png">

		<title>Wadagbé</title>
	 
		<!-- Bootstrap core CSS -->
		<link href="css/bootstrap.css" rel="stylesheet">

		<!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
		<!--[if lt IE 9]>
			<script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
			<script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
		<![endif]-->

		<!-- Custom styles for this template -->
		<link href="css/carousel.css" rel="stylesheet">
		<link href="css/main.css" rel="stylesheet">
		<link href="css/usager.css" rel="stylesheet">
		<link href="css/panier.css" rel="stylesheet">
		<link href="css/catalogue.css" rel="stylesheet">
		<!-- GOOGLE FONTS -->
		<link href='http://fonts.googleapis.com/css?family=Roboto+Slab:400,100,300,700' rel='stylesheet' type='text/css'>
	</head>
<!-- NAVBAR
================================================== -->
	<body>
		<!-- Header -->
		<header class="container">
			<article class="row"><!-- Une autre division pour le logo de la page -->
				<article class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
					<a href="index.html">
						<img class="img-responsive" src="img/Logo.png" alt="logo wadagbe">
					</a>
				</article>
				<article class="col-lg-offset-4 col-lg-4 col-md-offset-4 col-md-4 col-sm-offset-4 col-sm-4 col-xs-12 pull-right">
				<!-- / Connexion Usagers -->
					<section id="usager" class="pull-right">
						<?php
							// Gestion connexion usager
						?>
					</section><!-- / Connexion Usagers -->
				</article>
				<!-- Shopping Cart -->
				<article id="shopping-cart" class="col-lg-4 pull-right text-right">
					<a href="./index.php?requete=panier">
						<button type="button" class="btn btn-panier btn-lg">
							 <span class="glyphicon glyphicon-shopping-cart"></span> Panier : <span id="nbProducts">Vide</span>
						</button>
					</a>
				</article>
				<!-- / Shopping Cart -->
			</article><!-- / -->
			<section class="row">
				<!-- Menu de Navegation -->
				<nav class="navbar-wrapper">
					<div class="navbar navbar-inverse navbar-static-top" role="navigation">
						<div class="container">
							<div class="navbar-header">
								<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
									<span class="sr-only">Toggle navigation</span>
									<span class="icon-bar"></span>
									<span class="icon-bar"></span>
									<span class="icon-bar"></span>
								</button>
							</div>
							<div class="navbar-collapse collapse"><!-- PLUGIN DROPDOWN BOOTSTRAP -->
								<ul class="nav navbar-nav">
									<li class="active"><a href="index.html">Accueil</a></li>
									<li class="dropdown">
										<a href="#" class="dropdown-toggle" data-toggle="dropdown">Produits<b class="caret"></b></a>
										<ul class="dropdown-menu">
											<li class="dropdown-header">Panneaux solaires</li>
											<li><a href="catalogue.html">######</a></li>
											<li><a href="catalogue.html">######</a></li>
											<li><a href="catalogue.html">######</a></li>
											<li class="divider"></li>
											<li class="dropdown-header hidden-xs">Lampes DEL</li><!-- hidden dans les petits écrans pour eviter le scroll -->
											<li><a class="hidden-xs" href="catalogue.html">######</a></li><!-- hidden dans les petits écrans pour eviter le scroll -->
											<li><a class="hidden-xs" href="catalogue.html">######</a></li><!-- hidden dans les petits écrans pour eviter le scroll -->
										</ul>
									</li>
									<li><a href="page-static.html">À propos</a></li>
									<li><a href="contact.html">Contact</a></li>
								</ul>
							</div><!-- / PLUGIN DROPDOWN BOOTSTRAP -->
						</div>
					</div>
				</nav><!-- / Menu de Navegation -->        
			</section>
		</header><!-- / Header -->
		<!-- Division du contenu principal -->
		<main class="container marketing">
			<!-- ======================= 
					 *** BASE ***
			=========================== -->

			<?php 		
				$oControleur = new Controler();	
				$oControleur->gerer();	
			?>			  
			
			<!-- ======================= 
				 *** / FIN BASE ***
			=========================== -->

			<hr class="featurette-divider">

			<!-- FOOTER -->
			<footer>
				<p class="pull-right btn-lien"><a href="#">Haut de la page</a></p>
				<p class="auteur">&copy; © Wadagbé 2014 | Projet Intégration II</p>
			</footer><!-- / FOOTER -->
		</main>
		<!-- /.container -->

		<!-- Bootstrap core JavaScript
		================================================== -->
		<!-- Placed at the end of the document so the pages load faster -->
		<script src="https://code.jquery.com/jquery-1.10.2.min.js"></script>
		<script src="js/vendor/bootstrap.min.js"></script>
		<script src="js/holder.js"></script>
		<script src="js/usager.js"></script>
		<script src="js/main.js"></script>
		<script src="js/panier.js"></script>
	</body>
</html>