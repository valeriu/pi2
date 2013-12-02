<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->
    <head>
        <meta charset="utf-8">
        <title>GrisOr</title>
        <meta name="description" content="Catalogue">
        <meta name="viewport" content="width=device-width">
<!--CSS-->
        <link rel="stylesheet" href="css/bootstrap.min.css">
        <link href='http://fonts.googleapis.com/css?family=Roboto+Condensed:300italic,400italic,700italic,400,300,700|Francois+One' rel='stylesheet' type='text/css'>
        <link rel="stylesheet" href="css/bootstrap-theme.min.css">
        <link rel="stylesheet" href="css/catalog.css">
<!--JS-->
        <script src="js/modernizr-2.6.2-respond-1.1.0.min.js"></script>
        <!--https://github.com/stretchr/arg.js--> 
        <script type="text/javascript" src="js/arg.js"></script>
    </head>
    <body>
        <!--[if lt IE 7]>
            <p class="chromeframe">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> or <a href="http://www.google.com/chromeframe/?redirect=true">activate Google Chrome Frame</a> to improve your experience.</p>
        <![endif]-->
    <div class="navbar navbar-default navbar-justified">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a rel="tooltip" title="Accueil" class="navbar-brand" href="catalog.php"><img src="./img/logo_grisOr.png" alt="GrisOr"></a>
        </div>
        <div class="navbar-collapse collapse">
          <ul class="nav navbar-nav">
            <li class="dropdown">
              <a rel="tooltip" title="Nombre de produits par page" href="#" class="dropdown-toggle" data-toggle="dropdown">Produits par page <b class="caret"></b></a>
              <ul class="dropdown-menu">
                <li><a href="catalog.php?nbP=12&amp;page=1&amp;mode=<?php if(isset($_GET['mode'])) echo $_GET['mode']; else echo 'details'; ?>">12</a></li>
                <li><a href="catalog.php?nbP=24&amp;page=1&amp;mode=<?php if(isset($_GET['mode'])) echo $_GET['mode']; else echo 'details'; ?>">24</a></li>
                <li><a href="catalog.php?nbP=36&amp;page=1&amp;mode=<?php if(isset($_GET['mode'])) echo $_GET['mode']; else echo 'details'; ?>">36</a></li>
                <li><a href="catalog.php?nbP=99&amp;page=1&amp;mode=<?php if(isset($_GET['mode'])) echo $_GET['mode']; else echo 'details'; ?>">Tous les produits</a></li>
              </ul>
            </li>
            <li><a rel="tooltip" title="Afficher les vignettes" href="catalog.php?mode=details&amp;page=1&amp;nbP=<?php if(isset($_GET['nbP'])) echo $_GET['nbP']; else echo 12; ?>">Vignettes</a></li>
            <li><a rel="tooltip" title="Afficher une liste" href="catalog.php?mode=grid&amp;page=1&amp;nbP=<?php if(isset($_GET['nbP'])) echo $_GET['nbP']; else echo 12; ?>">Liste</a></li>
          </ul>
          <ul id="pages-control" class="nav nav-pills pull-right">
            <!--DYNAMIC PAGINATION NAV -->
          </ul>
        </div><!--/.navbar-collapse -->
      </div>
    </div>
    <div id="product-container" class="container">

  <!-- PRODUCTS -->

    </div> <!-- /container -->

    <div class="container">
     <hr>
      <footer>
        <p>&copy; MEDYAN 2013</p>
      </footer>
    </div>
      
<!--JS--> 
        <script>window.jQuery || document.write('<script src="js/jquery-1.10.2.min.js"><\/script>')</script>
        <script type="text/javascript" src="js/products.js"></script>
        <script type="text/javascript" src="js/productView.js"></script>
        <script src="js/bootstrap.min.js"></script>
        <script src="js/catalog.js"></script>
    </body>
</html>
