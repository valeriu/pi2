<?php
/**
 * Class Vue Admin
 * 
 * 
 * @author Valeriu Tihai
 * 
 */


class VueAdmin {

	public function afficherEntete() { ?>
	<!DOCTYPE html>
	<html lang="fr">
	  <head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<meta name="description" content="Wadagbé administration">
		<link rel="shortcut icon" href="images/favicon.png">
		<title>Wadagbé Administration</title>

		<!-- Bootstrap core CSS -->
		<link href="css/bootstrap.css" rel="stylesheet">

		<!-- Custom styles for login page -->
		<link href="css/login.css" rel="stylesheet">
		<link href="css/adminka.css" rel="stylesheet">
		<!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
		<!--[if lt IE 9]>
		  <script src="js/html5shiv.js"></script>
		  <script src="js/respond.min.js"></script>
		<![endif]-->
	  </head>

	  <body class="adminka">
	
	<?php }

	public function afficherFooter() { ?>
	<!-- Footer div -->
	   <div class="container">
	   <!-- Static navbar -->
		   <footer>
			   <p class="footer-text">Copyright 2013 - Wadagbe</p>
		   </footer>
	   </div> <!-- /container -->
	   <!-- Bootstrap core JavaScript
	   ================================================== -->
		<script src="https://code.jquery.com/jquery-1.10.2.min.js"></script>
		<script src="js/vendor/bootstrap.min.js"></script>
		<script src="js/adminka.js"></script>
	 </body>
   </html>
	
	<?php }

	public function afficherConnexion($msg='') { ?>
		<div class="container">
			<form class="form-signin" action="adminka.php?requete=connexion" method="post">
				<h2 class="form-signin-heading">Wadagbé administration</h2>
				<span><?php echo $msg; ?></span>
				<input type="text" name="courriel" class="form-control" placeholder="Adresse courriel" required autofocus>
				<input type="password" name="mot_passe" class="form-control" placeholder="Mot de passe" required>
				<button class="btn btn-lg btn-primary" type="submit">Se connecter</button>
			 </form>
		</div> <!-- /container -->
	
	<?php }

	public function afficherToolbar() { ?>
	    <div class="container">
		<!-- Static navbar -->
			<div class="navbar navbar-default navbar-static-top" role="navigation">
			  <div class="container">
				<div class="navbar-header">
				  <a class="navbar-brand" href="#">Wadagbé Administration</a>
				</div>
				<div class="navbar-collapse">
				  <ul class="nav navbar-nav navbar-right">
					<li class="active"><a href="adminka.php?requete=deconnexion">Déconnexion</a></li>
				  </ul>
				</div><!--/.nav-collapse -->
			  </div>
			</div>
		</div> <!-- /container -->
	
	<?php }
	
	public function afficherNavigation() { ?>
	  <div class="container">
    	<div class="row">
		  <div class="col-lg-2 col-md-2">
			<div class="list-group">
				<a href="#" class="list-group-item active">Panneau d'administration</a>
				<a href="adminka.php?requete=commandes" class="list-group-item">Commandes</a>
				<a href="adminka.php?requete=produits" class="list-group-item">Produits</a>
				<a href="adminka.php?requete=page" class="list-group-item">Pages</a>
				<a href="adminka.php?requete=liste_usagers" class="list-group-item">Usagers</a>
				<a href="adminka.php?requete=menu" class="list-group-item">Menu</a>
			</div>
		  </div>
	<div class="col-lg-10 col-md-10">
	<?php }
	
	public function afficherFinContent() { ?>
			  </div>
		</div>
    </div><!-- end content -->
	<?php }
}
?>