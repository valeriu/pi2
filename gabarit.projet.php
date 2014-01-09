<!--<!DOCTYPE html>
<html lang="fr">
	<head>
		<title>Mon simple MVC</title>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
		<meta name="description" content="">
		<meta name="viewport" content="width=device-width">
		
		<link rel="stylesheet" href="./css/normalize.css" type="text/css" media="screen">
		<link rel="stylesheet" href="./css/base_h5bp.css" type="text/css" media="screen">
		<link rel="stylesheet" href="./css/main.css" type="text/css" media="screen">
		
		<script src="js/vendor/modernizr-2.6.2-respond-1.1.0.min.js"></script>
		<script src="./js/plugins.js"></script>
		<script src="./js/main.js"></script>
	</head>

	<body>
			<?php 		
				//$oControleur = new Controler();	
				//$oControleur->gerer();	
			?>
			
			<div id="footer">
				<p>© Wadagbé 2014</p>
			</div>
		</div>	
	</body>
</html>-->
<!DOCTYPE html>
<html lang="en">
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
						<form class="form-signin">
							<button name="enregistrer" id="enregistrer" class="btn btn-lien" type="button">S'enregistrer</button>
							<button name="connecter" id="connecter" class="btn btn-lien" type="button">Connexion</button>
						</form>
						
						<article id="connecterDiv">
							<form class="form-signin" name="form-usager-connecter" action="usager_informations.html" method="post">
								<div class="input-group input-group-sm">
									Courriel :
									<input name="courriel" type="email" class="form-control" required>
								</div>
								<div class="input-group input-group-sm">
									Mot de passe :
									<input name="password" type="password" class="form-control" required>
								</div>
								<a name="motPasseOublie" id="motPasseOublie" href="#">Mot de passe oublié</a>
								<br>
								<button name="connexion" id="connexion" class="btn btn-primary" type="submit">Connexion</button>
								<br>
							</form>
							<div id="infosConnecter">
								<h1>Bienvenue sur Wadagbé!</h1>
								<a name="completerInfos" href="completerInfos.html">Compléter les informations</a>
							</div>
						</article>
						
						<article id="enregistrerDiv">
							<form class="form-signin" name="form-usager-enregistrer">
								<div class="input-group input-group-sm">
									Nom, prénom:
									<input name="nom" type="text" class="form-control"  required>
								</div>
								<div class="input-group input-group-sm">
									Courriel:
									<input name="courriel" type="email" class="form-control" required>
								</div>
								<div class="input-group input-group-sm">
									Mot de passe:
									<input name="password" type="password" class="form-control" required>
								</div>
								<button name="confirmer" id="confirmer" class="btn btn-primary" type="submit">Confirmer</button>
								<br>
							</form>
							<div id="infosEnregistrer">
								<h1>Bienvenue sur Wadagbé!</h1>
								<a name="completerInfos" href="completerInfos.html">Compléter les informations</a>
							</div>  
						</article>
						
						<article id="motPasseOublieDiv">
							<form class="form-signin" name="form-usager-oublie">
								<div class="input-group input-group-sm">
									Courriel:
									<input name="courriel" type="email" class="form-control" required>
								</div>
								<button name="envoyer" id="envoyer" class="btn btn-primary" type="submit">Soumettre</button>
							</form> 
							<div id="courrielEnvoye">
								<h1>Répondez à la question suivante: </h1>
							</div>
						</article>
					</section><!-- / Connexion Usagers -->
				</article>
				<!-- Shopping Cart -->
				<article id="shopping-cart" class="col-lg-4 pull-right text-right">
					<a href="./panier/index.php?requete=panier">
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
									<li><a href="index.html">Accueil</a></li>
									<li class="dropdown active">
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
			<div id="msgError">Désolé, trop temps, essayez plus tard!</div><!-- Message d'error de télechargement -->
			<div class="panel panel-default">
				<!--TRI DU CATALOGUE-->
			  <div class="panel-heading">
			    <div>
			       <label class="checkbox-inline">
			        <input type="checkbox" id="inlineCheckbox1" value="option1"> Solar Panels
			       </label>
			       <label class="checkbox-inline">
			         <input type="checkbox" id="inlineCheckbox2" value="option2"> Solar Kits
			       </label>
			       <label class="checkbox-inline">
			         <input type="checkbox" id="inlineCheckbox3" value="option3"> LED Lamps
			       </label>
			    </div>
			    <div class="pull-right">
			      <button type="button" id="btn-filtres" class="btn btn-default">Ordonner</button>
			    </div>
			  </div>
			  <div id="panel-filtres" class="panel-heading" hidden>
			  	<label class="radio-inline">
			        <input type="radio" id="inlineradio1" name="radio-filtres" value="option1"> Spécifications
			       </label>
			       <label class="radio-inline">
			         <input type="radio" id="inlineradio2" name="radio-filtres" value="option2"> Catégories
			       </label>
			       <label class="radio-inline">
			         <input type="radio" id="inlineradio3" name="radio-filtres" value="option3"> Prix
			       </label>
			  </div>

			  <!--CATALOGUE-->
			  <main class="panel-body">
			  	<section class="table-responsive">
			      <table class="table-hover col-sm-12">
			        <tbody>
			          <tr title="Click for details!">
			            <td class="clickable">1</td>
			            <td class="clickable"><h3>Kit panneau solaire</h3></td>
			            <td class="clickable">65W</td>
			            <td class="clickable">Panneaux solaire</td>
			            <td class="clickable"><img src="img/Solar_cell.png"></td>
			            <td class="clickable text-success text-pricing"><strong>99.99$</strong></td>
			            <td>
			              <button type="button" id="5" class="btn btn-primary btn-home ajouter"><span class="glyphicon glyphicon-shopping-cart"></span>&nbsp;Ajouter au panier</button>
			            </td>
			          </tr>
			          <tr>
			            <td colspan="7">
			              <article class="product-details" hidden>
			                <ul class="list-group col-md-9">
			                  <li class="list-group-item">Panneau monocristallin 65W</li>
			                  <li class="list-group-item">Contrôleur de charge de 10A EPRC-ST</li>
			                  <li class="list-group-item">Câble 12AWG de 20Pi chacun avec connecteurs MC4</li>
			                  <li class="list-group-item">Câble 12AWG de 7Pi chacun avec des pinces</li>
			                  <li class="list-group-item">3.59A avec régulateur</li>
			                  <li class="list-group-item">Il n'y a pas de supports ou de fusibles inclus dans ce kit</li>
			                </ul> 
			                <ul class="nav col-md-3">
			                	<li>
			                	  <span class="glyphicon glyphicon-star"></span>
				                  <span class="glyphicon glyphicon-star"></span>
				                  <span class="glyphicon glyphicon-star"></span>
				                  <span class="glyphicon glyphicon-star-empty"></span>
				                  <span class="glyphicon glyphicon-star-empty"></span>
			                	</li>
			                	<br>
				                <li>
				                   <aside class="panel panel-default">
						            <div class="panel-heading">
						              <h3 class="panel-title">Suggestions :</h3>
						            </div>
						            <div class="panel-body">
						              <ul class="nav">
						              	<li><a href="#">Produit 1</a></li>
						              	<li><a href="#">Produit 2</a></li>
						              	<li><a href="#">Produit 3</a></li>
						              </ul>
						            </div>
						          </aside>
				                </li>   
			                </ul>
			              </article>
			            </td>
			          </tr>
			          <tr title="Click for details!">
			            <td class="clickable">2</td>
			            <td class="clickable"><h3>Kit panneau solaire</h3></td>
			            <td class="clickable">65W</td>
			            <td class="clickable">Panneaux solaire</td>
			            <td class="clickable"><img src="img/Solar_cell.png"></td>
			            <td class="clickable text-success text-pricing"><strong>99.99$</strong></td>
			            <td>
			              <button type="button" id="8" class="btn btn-primary btn-home ajouter"><span class="glyphicon glyphicon-shopping-cart"></span>&nbsp;Ajouter au panier</button>
			            </td>
			          </tr>
			          <tr>
			            <td colspan="7">
			              <article class="product-details" hidden>
			                <ul class="list-group col-md-9">
			                  <li class="list-group-item">Panneau monocristallin 65W</li>
			                  <li class="list-group-item">Contrôleur de charge de 10A EPRC-ST</li>
			                  <li class="list-group-item">Câble 12AWG de 20Pi chacun avec connecteurs MC4</li>
			                  <li class="list-group-item">Câble 12AWG de 7Pi chacun avec des pinces</li>
			                  <li class="list-group-item">3.59A avec régulateur</li>
			                  <li class="list-group-item">Il n'y a pas de supports ou de fusibles inclus dans ce kit</li>
			                </ul> 
			                <ul class="nav col-md-3">
			                	<li>
			                	  <span class="glyphicon glyphicon-star"></span>
				                  <span class="glyphicon glyphicon-star"></span>
				                  <span class="glyphicon glyphicon-star"></span>
				                  <span class="glyphicon glyphicon-star-empty"></span>
				                  <span class="glyphicon glyphicon-star-empty"></span>
			                	</li>
			                	<br>
				                <li>
				                   <aside class="panel panel-default">
						            <div class="panel-heading">
						              <h3 class="panel-title">Suggestions :</h3>
						            </div>
						            <div class="panel-body">
						              <ul class="nav">
						              	<li><a href="#">Produit 1</a></li>
						              	<li><a href="#">Produit 2</a></li>
						              	<li><a href="#">Produit 3</a></li>
						              </ul>
						            </div>
						          </aside>
				                </li>   
			                </ul>
			              </article>
			            </td>
			          </tr>
			          <tr title="Click for details!">
			            <td class="clickable">3</td>
			            <td class="clickable"><h3>Kit panneau solaire</h3></td>
			            <td class="clickable">65W</td>
			            <td class="clickable">Panneaux solaire</td>
			            <td class="clickable"><img src="img/Solar_cell.png"></td>
			            <td class="clickable text-success text-pricing"><strong>99.99$</strong></td>
			            <td>
			              <button type="button" id="12" class="btn btn-primary btn-home ajouter"><span class="glyphicon glyphicon-shopping-cart"></span>&nbsp;Ajouter au panier</button>
			            </td>
			          </tr>
			          <tr>
			            <td colspan="7">
			              <article class="product-details" hidden>
			                <ul class="list-group col-md-9">
			                  <li class="list-group-item">Panneau monocristallin 65W</li>
			                  <li class="list-group-item">Contrôleur de charge de 10A EPRC-ST</li>
			                  <li class="list-group-item">Câble 12AWG de 20Pi chacun avec connecteurs MC4</li>
			                  <li class="list-group-item">Câble 12AWG de 7Pi chacun avec des pinces</li>
			                  <li class="list-group-item">3.59A avec régulateur</li>
			                  <li class="list-group-item">Il n'y a pas de supports ou de fusibles inclus dans ce kit</li>
			                </ul> 
			                <ul class="nav col-md-3">
			                	<li>
			                	  <span class="glyphicon glyphicon-star"></span>
				                  <span class="glyphicon glyphicon-star"></span>
				                  <span class="glyphicon glyphicon-star"></span>
				                  <span class="glyphicon glyphicon-star-empty"></span>
				                  <span class="glyphicon glyphicon-star-empty"></span>
			                	</li>
			                	<br>
				                <li>
				                   <aside class="panel panel-default">
						            <div class="panel-heading">
						              <h3 class="panel-title">Suggestions :</h3>
						            </div>
						            <div class="panel-body">
						              <ul class="nav">
						              	<li><a href="#">Produit 1</a></li>
						              	<li><a href="#">Produit 2</a></li>
						              	<li><a href="#">Produit 3</a></li>
						              </ul>
						            </div>
						          </aside>
				                </li>   
			                </ul>
			              </article>
			            </td>
			          </tr>
			          <tr title="Click for details!">
			            <td class="clickable">4</td>
			            <td class="clickable"><h3>Kit panneau solaire</h3></td>
			            <td class="clickable">65W</td>
			            <td class="clickable">Panneaux solaire</td>
			            <td class="clickable"><img src="img/Solar_cell.png"></td>
			            <td class="clickable text-success text-pricing"><strong>99.99$</strong></td>
			            <td>
			              <button type="button" id="53" class="btn btn-primary btn-home ajouter"><span class="glyphicon glyphicon-shopping-cart"></span>&nbsp;Ajouter au panier</button>
			            </td>
			          </tr>
			          <tr>
			            <td colspan="7">
			              <article class="product-details" hidden>
			                <ul class="list-group col-md-9">
			                  <li class="list-group-item">Panneau monocristallin 65W</li>
			                  <li class="list-group-item">Contrôleur de charge de 10A EPRC-ST</li>
			                  <li class="list-group-item">Câble 12AWG de 20Pi chacun avec connecteurs MC4</li>
			                  <li class="list-group-item">Câble 12AWG de 7Pi chacun avec des pinces</li>
			                  <li class="list-group-item">3.59A avec régulateur</li>
			                  <li class="list-group-item">Il n'y a pas de supports ou de fusibles inclus dans ce kit</li>
			                </ul> 
			                <ul class="nav col-md-3">
			                	<li>
			                	  <span class="glyphicon glyphicon-star"></span>
				                  <span class="glyphicon glyphicon-star"></span>
				                  <span class="glyphicon glyphicon-star"></span>
				                  <span class="glyphicon glyphicon-star-empty"></span>
				                  <span class="glyphicon glyphicon-star-empty"></span>
			                	</li>
			                	<br>
				                <li>
				                   <aside class="panel panel-default">
						            <div class="panel-heading">
						              <h3 class="panel-title">Suggestions :</h3>
						            </div>
						            <div class="panel-body">
						              <ul class="nav">
						              	<li><a href="#">Produit 1</a></li>
						              	<li><a href="#">Produit 2</a></li>
						              	<li><a href="#">Produit 3</a></li>
						              </ul>
						            </div>
						          </aside>
				                </li>   
			                </ul>
			              </article>
			            </td>
			          </tr>
			        </tbody>
			      </table>
			    </section>
			  </main>
			  <!--NAVIGATION CATALOGUE-->
			  <nav class="panel-footer">
			    <ul class="pagination">
				<li class="disabled"><a href="#">&laquo;</a></li>
				<li class="active"><a href="#">1 <span class="sr-only">(current)</span></a></li>
				<li><a href="#">2</a></li>
				<li><a href="#">3</a></li>
				<li><a href="#">4</a></li>
				<li><a href="#">5</a></li>
				<li><a href="#">&raquo;</a></li>
			</ul>
			  </nav>
			</div>
			<!-- ======================= 
				 *** / FIN BASE ***
			=========================== -->

			<hr class="featurette-divider">

			<!-- FOOTER -->
			<footer>
				<p class="pull-right"><a href="#">Haut de la page</a></p>
				<p class="auteur">&copy; 2013 Projet Intégration II</p>
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
		<script src="js/catalogue.js"></script>
	</body>
</html>
