<?php
/**
 * Class Vue Menu
 * Template de classe Vue Pages.
 * 
 * @author Valeriu Tihai
 * 
 */


class VueMenu {

	/**
	 * Affiche le Menu
	 * 
	 */
	public function afficherMenu() {	?>
	</article><!-- / Fermeture row Logo / Usager / Bouton panier -->
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
							<?php
								$menu = new Menu();
								$monMenu = $menu->afficherMenu();
								$li="";
								foreach ($monMenu as $k => $v1) {	
									
									if (is_array($v1["enfants"])) {
										
										$li .= "<li class=\"dropdown\">\r\n";
										$li .= "<a href=\"{$v1["url"]}\" class=\"dropdown-toggle\" data-toggle=\"dropdown\">{$v1["titre"]}<b class=\"caret\"></b></a>\r\n";
										$li .= "<ul class=\"dropdown-menu\">\r\n";
										foreach ($v1["enfants"] as $v2)	{											
											$li .= "<li><a href=\"{$v2["url"]}\">{$v2["titre"]}</a></li>\r\n";
										}
										$li .= "</ul>\r\n</li>\r\n";
									} else {
										$li .= "<li><a href=\"{$v1["url"]}\">{$v1["titre"]}</a></li>\r\n";
									}
									
									
								}
								echo $li;
							?>
							</div><!-- / PLUGIN DROPDOWN BOOTSTRAP -->
						</div>
					</div>
				</nav><!-- / Menu de Navegation -->      
			</section>
			<!-- / Menu de Navegation -->
		</header><!-- / Header -->
		<!-- Division du contenu principal -->
		<main class="container marketing">
	  
	<?php }
	

}
?>