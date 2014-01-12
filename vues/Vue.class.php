<?php
/**
 * Class Vue
 * Template de classe Vue. Dupliquer et modifier pour votre usage.
 * 
 * @author Jonathan Martel
 * @version 1.0
 * @update 2013-12-11
 * @license Creative Commons BY-NC 3.0 (Licence Creative Commons Attribution - Pas d’utilisation commerciale 3.0 non transposé)
 * @license http://creativecommons.org/licenses/by-nc/3.0/deed.fr
 * 
 */


class Vue {

	/**
	 * Affiche la page d'accueil 
	 * @access public
	 * 
	 */

	public function afficherEntete($aDonnees = array()) {
		
?>	
		<!DOCTYPE html>
		<html lang="fr">
			<head>
				<meta charset="utf-8">
				<meta http-equiv="X-UA-Compatible" content="IE=edge">
				<meta name="viewport" content="width=device-width, initial-scale=1.0">
				<meta name="description" content="<?php  echo $titre = (isset($aDonnees["description_meta"])) ? $aDonnees["description_meta"] : 'Wadagbé'; ?>">
				<meta name="author" content="">
				<link rel="shortcut icon" href="img/favicon.png">

				<title><?php  echo $titre = (isset($aDonnees["titre"])) ? $aDonnees["titre"] : 'Wadagbé'; ?></title>
			 
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
							<a href="index.php">
								<img class="img-responsive" src="img/Logo.png" alt="logo wadagbe">
							</a>
						</article>
						<article class="col-lg-offset-4 col-lg-4 col-md-offset-4 col-md-4 col-sm-offset-4 col-sm-4 col-xs-12 pull-right">

<?php

	}

	public function afficherFooter() {

?>
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
<?php
	}

	public function afficherBoutonPanier() {
?>
				</article><!-- Shopping Cart -->
				<article id="shopping-cart" class="col-lg-4 pull-right text-right">
					<a href="./index.php?requete=panier">
						<button type="button" class="btn btn-panier btn-lg">
							 <span class="glyphicon glyphicon-shopping-cart"></span> Panier : <span id="nbProducts">Vide</span>
						</button>
					</a>
				</article>
				<!-- / Shopping Cart -->
<?php

	}

	public function afficherAccueil($form = '') {
		
		?>
  <!-- Carousel -->
                        <div class="row hidden-xs">
                                <div class="col-lg-12"><!-- configuration pour les différents écrans -->
                                  <!-- Carousel au milieu du page, pas visible dans les petits écrans -->
                                  <div id="myCarousel" class="carousel slide" data-ride="carousel">
                                        <!-- Indicators -->
                                        <ol class="carousel-indicators">
                                          <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
                                          <li data-target="#myCarousel" data-slide-to="1"></li>
                                          <li data-target="#myCarousel" data-slide-to="2"></li>
                                        </ol>
                                        <div class="carousel-inner">
                                                <div class="item active">
                                                        <img src="img/slider03.jpg" alt="">
                                                </div>
                                                <div class="item">
                                                        <img src="img/slider02.jpg" alt="">
                                                </div>
                                                <div class="item">
                                                        <img src="img/slider01.jpg" alt="">
                                                </div>
                                        </div>
                                        <a class="left carousel-control" href="#myCarousel" data-slide="prev"><span class="glyphicon glyphicon-chevron-left"></span></a>
                                        <a class="right carousel-control" href="#myCarousel" data-slide="next"><span class="glyphicon glyphicon-chevron-right"></span></a>
                                  </div>
                                </div>
                        </div><!-- / Carousel -->
                        
                        <!-- Trois colonnes de texte en dessous du carrousel -->
                        <div class="row">
                                <div class="col-lg-4 col-md-4">
                                  <img class="img-thumbnail" src="img/produit_promo.jpg" alt="Generic placeholder image">
                                  <h2>Panneaux solaires</h2>
                                  <p>Nous faisons vos rêves reels! Nos artisans sont capables de reproduire toutes sortes de créations à votre demande. Si vous n'avez pas un modelé à vous, nous mettons la meilleure équipe d’experts créateurs à votre service.</p>
                                  <p><a class="btn btn-default" href="catalogue.html" role="button">En savoir plus &raquo;</a></p>
                                </div><!-- /.col-lg-4 -->
                                <div class="col-lg-4 col-md-4">
                                  <img class="img-thumbnail" src="img/LED_lamp.jpg" alt="Generic placeholder image">
                                  <h2>Lampes DEL</h2>
                                  <p>Les plus fines bagues de mariage pour ce moment si spécial. Célébrez votre amour avec des bagues de mariage fait spécialement pour vous.</p>
                                  <p><a class="btn btn-default" href="catalogue.html" role="button">En savoir plus &raquo;</a></p>
                                </div><!-- /.col-lg-4 -->
                                <div class="col-lg-4 col-md-4">
                                  <img class="img-thumbnail" src="img/solar_kit.jpg" alt="Generic placeholder image">
                                  <h2>Ensemble</h2>
                                  <p>Le mariage parfait entre modernité et élégance. Vous aimerez notre ample collection de bijoux contemporains. Dessin exclusif de Fabio Villalba!</p>
                                  <p><a class="btn btn-default" href="catalogue.html" role="button">En savoir plus &raquo;</a></p>
                                </div><!-- /.col-lg-4 -->
                        </div><!-- /.row -->
		<div name="modal-content">
			<?php echo $form; ?>
		</div>
		<?php
		
	}
	

}
?>