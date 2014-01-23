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
	 * Affiche le Menu dans FrontEnd 
	 * Version Descktop et Version Mobile
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
								$li .= "</ul>";
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
	
	/**
	 * Afficher tous les liens du menu sous forme de liste
	 * 
	 * @param type $aDonneesPages
	 * @param type $aDonneesPaginator
	 * @param type $partir
	 * @param type $fin
	 */
	public function afficherListMenuAdmin($aDonneesPages, $aDonneesPaginator, $partir, $fin) {	?>
			<?php

			$nomberMenu = count($aDonneesPages);
			//print_r($data);
			$htmlPage = "";
			$htmlPagination = "";
			
			$htmlPagination .= "<!--Pagination-->	<ul class=\"pagination\">";
				foreach($aDonneesPaginator as $page){
				$htmlPagination .= "<li><a href='adminka.php?requete=menu&partir={$page["partir"]}&fin={$page["fin"]}'>{$page["page"]}</a></li>";	
					
				}
			$htmlPagination .= "</ul>";
			
			$fin = min($fin, $nomberMenu);
			
			for ($i=$partir, $j=$fin; $i<$j; $i++){
				$htmlPage .= "<tr>\r\n"; 
					$titre = (!empty($aDonneesPages[$i]["titre"])) ? $aDonneesPages[$i]["titre"] : "Sans titre";
					$url = substr($aDonneesPages[$i]["url"],0,70).'...';
					$htmlPage .= "<td><a href=\"adminka.php?requete=menu_modifier&menu_id={$aDonneesPages[$i]["id_menu"]}\" title=\"Edit: {$aDonneesPages[$i]["titre"]}\">{$aDonneesPages[$i]["id_menu"]}</a></td>\r\n";
					$htmlPage .= "<td>{$titre}</td>\r\n";
					$htmlPage .= "<td><a target=\"_blank\" href=\"{$aDonneesPages[$i]["url"]}\">{$url}</a></td>\r\n";
					$htmlPage .= "<td>{$aDonneesPages[$i]["parent"]}</td>\r\n";
					$htmlPage .= "<td>{$aDonneesPages[$i]["ordre"]}</td>\r\n";
					switch ($aDonneesPages[$i]["statut"]) {
						case 0:
							$htmlPage .= "<td><span class=\"label label-warning\">Brouillon</span></td>";
							break;
						case 1:
							$htmlPage .= "<td><span class=\"label label-success\">Publié</span></td>";
							break;
						case 2:
							$htmlPage .= "<td><span class=\"label label-danger\">Supprimé</span></td>";
							break;
					}
				$htmlPage .= "</tr>\r\n";
					
			}
				?>
		<div class="panel panel-default">
			<!-- Default panel contents -->
			<div class="panel-heading">Toutes les lien du menu<span class="badge pull-right"><?php echo $nomberMenu;?></span><div> <a href="adminka.php?requete=menu_ajouter">Ajouter un lien</a></div></div>
			<!-- Table pages-->
			<table class="table table-hover">
				<thead>
				  <tr>
					<th>#</th>
					<th>Titre</th>
					<th>URL</th>
					<th>Parent</th>
					<th>Order</th>
					<th>Statut</th>
				  </tr>
				</thead>
				<tbody>
				   <?php echo $htmlPage; ?>
				</tbody>
			  </table><!-- end table-->
			</div><!--end panel-->
			<?php echo $htmlPagination; ?>
	<?php }
	
	/**
	 * Ajouter un nouveau lien dans le menu
	 * 
	 * @param type $result
	 * @param type $mes
	 */
	public function ajouterMenuAdmin($result="", $mes="") {	?>
		<div class="panel panel-default">
			<!-- Default panel contents -->
			<div class="panel-heading">Ajouter ou modifier un menu</div>
			<div class="panel-body">
		<?php
			if ($mes !=""){
				echo "<div class=\"alert alert-danger\">".$mes."</div>";
			}

			if ($result != NULL) {
				switch ($result) {
					case 1:
						echo "<div class=\"alert alert-success\"><strong>Bien fait!</strong> Vous insérez cette lien dans la base de données avec succès.<br />
							Vous voulez  <a href=\"adminka.php?requete=menu_ajouter\" class=\"alert-link\">ajouter</a> une autre lien?
							</div>";
						break;
					case 0:
						echo "<div class=\"alert alert-danger\"><strong>Oh rupture!</strong> Changer quelques choses et essayer à nouveau soumission.";
						echo "</div>";
						break;					
				}	
			}
		?>	
				
			<!-- Form Edit pages-->
				<form role="form" method="POST" action="<?php echo $_SERVER['REQUEST_URI'];?>">
					<div class="form-group">
						<label for="menu-title">Titre</label>
						<input type="text" class="form-control" id="menu-title" name="menu-title" placeholder="Enter Title">
					</div>
					<div class="form-group">
						<label for="menu-description">Description</label>
						<input type="text" class="form-control" name="menu-description" id="menu-description" placeholder="Enter Description">
					</div>
					<div class="form-group">
						<label for="menu-url">URL</label>
						<input type="text" class="form-control" name="menu-url" id="menu-url" placeholder="Enter URL">
					</div>					
					<div class="form-group">
						<label for="menu-parent">Parent</label>
						<input type="text" class="form-control" name="menu-parent" name="menu-parent" placeholder="Enter Parent">
					</div>	
					<div class="form-group">
						<label for="menu-ordre">Ordre</label>
						<input type="text" class="form-control" id="menu-ordre" name="menu-ordre" placeholder="Enter Ordre">
					</div>	
					<div class="form-group">
						<label for="menu-contenu">Statut de la menu</label>
						<div class="radio">
							<label>
								<input type="radio" name="optionsRadios" id="optionsRadios1" value="1" checked>
								<span class="label label-success">Publié</span>
							</label>
						</div>
						<div class="radio">
							<label>
								<input type="radio" name="optionsRadios" id="optionsRadios2" value="0">
								<span class="label label-warning">Brouillon</span>
							</label>
						</div>
						<div class="radio">
							<label>
								<input type="radio" name="optionsRadios" id="optionsRadios3" value="2">
								<span class="label label-danger">Supprimé</span>
							</label>
						</div>
					</div>

					<div class="form-group">
						<button name="menu-ajouter" type="submit" class="btn btn-primary" data-loading-text="Sauvegardez...">Soumettre</button>
					</div>
					<div class="btn-group" data-toggle="buttons">
				</form>		<!-- /Form Edit pages-->
			</div>
			</div><!--end panel-->
		  </div>
	<?php }
	
	/**
	 * Modifier un nouveau lien dans le menu
	 * 
	 * @param type $data
	 * @param type $mes
	 */
	public function modifierMenuAdmin($data, $mes="") {	?>
		<div class="panel panel-default">
			<!-- Default panel contents -->
			<div class="panel-heading">Ajouter ou modifier une page</div>
			<div class="panel-body">
			<?php
				switch ($mes) {
					case 1:
						echo "<div class=\"alert alert-success\"><strong>Bien fait!</strong> Vous modifiez cette lien dans la base de données avec succès.</div>";
						break;
					case '':
						break;
					default:
						echo "<div class=\"alert alert-danger\">".$mes."</div>";
						break;
				}
			?>
				
			<!-- Form Edit pages-->
				<form role="form" method="POST" action="<?php echo $_SERVER['REQUEST_URI'];?>">
					<input type="hidden" name="menu-id" value="<?php echo $data["id_menu"];?>">
					<div class="form-group">
						<label for="menu-title">Titre</label>
						<input value="<?php echo $data["titre"] ;?>" type="text" class="form-control" id="menu-title" name="menu-title" placeholder="Enter Title">
					</div>
					<div class="form-group">
						<label for="menu-description">Description</label>
						<input value="<?php echo $data["description"] ;?>"  type="text" class="form-control" name="menu-description" id="menu-description" placeholder="Enter Description">
					</div>
					<div class="form-group">
						<label for="menu-url">URL</label>
						<input value="<?php echo $data["url"] ;?>" type="text" class="form-control" name="menu-url" id="menu-url" placeholder="Enter URL">
					</div>					
					<div class="form-group">
						<label for="menu-parent">Parent</label>
						<input value="<?php echo $data["parent"] ;?>" type="text" class="form-control" name="menu-parent" name="menu-parent" placeholder="Enter Parent">
					</div>	
					<div class="form-group">
						<label for="menu-ordre">Ordre</label>
						<input value="<?php echo $data["ordre"] ;?>" type="text" class="form-control" id="menu-ordre" name="menu-ordre" placeholder="Enter Ordre">
					</div>	
					<div class="form-group">
						<label for="menu-contenu">Statut de la menu</label>
						<div class="radio">
							<label>
								<input type="radio" name="optionsRadios" id="optionsRadios1" value="1" <?php echo $nb1 = ($data["statut"]==1) ? "checked" : "";?>>
								<span class="label label-success">Publié</span>
							</label>
						</div>
						<div class="radio">
							<label>
								<input type="radio" name="optionsRadios" id="optionsRadios2" value="0" <?php echo $nb1 = ($data["statut"]==0) ? "checked" : "";?>>
								<span class="label label-warning">Brouillon</span>
							</label>
						</div>
						<div class="radio">
							<label>
								<input type="radio" name="optionsRadios" id="optionsRadios3" value="2" <?php echo $nb1 = ($data["statut"]==2) ? "checked" : "";?>>
								<span class="label label-danger">Supprimé</span>
							</label>
						</div>
					</div>

					<div class="form-group">
						<button name="menu-modifier" type="submit" class="btn btn-primary" data-loading-text="Sauvegardez...">Soumettre</button>
					</div>
					<div class="btn-group" data-toggle="buttons">
				</form>		<!-- /Form Edit pages-->
			</div>
			</div><!--end panel-->
		  </div>
	<?php }
}
?>