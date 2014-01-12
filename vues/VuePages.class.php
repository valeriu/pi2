<?php
/**
 * Class Vue Pages
 * Template de classe Vue Pages.
 * 
 * @author Valeriu Tihai
 * 
 */


class VuePages {

	/**
	 * Affiche un page Front End 
	 * 
	 */
	public function afficherPage($data) {	
		if($data["statut"] != 1)
			throw new Exception("Page introuvable");
		?>
		<h1><?php echo $data["titre"];?></h1>
		<div class="pagecontent">
			<?php echo $data["contenu"];?>
		</div>
		<?php
			if(!($data["geo_lat"] == NULL && $data["geo_long"] == NULL)){ ?>
				<h2>La carte</h2>
				<style type="text/css">#map-wadagbe{height: 400px;}</style>
				<div id="map-wadagbe"></div>
				<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=<?php echo GOOOGLEMAPAPI; ?>&sensor=false"></script>
				<script type="text/javascript">
				function initialize() {
					var mapOptions = {
						center: new google.maps.LatLng(<?php echo $data["geo_lat"];?>, <?php echo $data["geo_long"];?>),
						zoom: 15,
							mapTypeId: google.maps.MapTypeId.ROADMAP
						};
					var map = new google.maps.Map(document.getElementById("map-wadagbe"), mapOptions);
				}
				google.maps.event.addDomListener(window, 'load', initialize);
				</script>
				<?php
			}
		?>
	<?php }
	
	public function ajouterPageAdmin($data) {
		//print_r($data);
		?>
		
		<div class="panel panel-default">
			<!-- Default panel contents -->
			<div class="panel-heading">Ajouter ou modifier une page</div>
			<div class="panel-body">
			<!-- Form Edit pages-->
				<form role="form">
					<div class="form-group">
						<label for="page-title">Titre</label>
						<input type="text" class="form-control" id="page-title" placeholder="Enter Title" value="<?php echo $data["titre"] ;?>">
					</div>
					<div class="form-group">
						<label for="page-description">Description</label>
						<textarea class="form-control" rows="3" id="page-description" placeholder="Meta Description"><?php echo $data["description_meta"] ;?></textarea>
						<p class="help-block">Description du lien, celle-ci apparaît souvent dans les recherches Google. <code>&lt;meta name="description" content=""&gt;</code></p>
					</div>
					<div class="form-group">
						<label for="page-contenu">Contenu</label>
						<textarea class="form-control" rows="18" id="page-contenu" placeholder="Page contenu"><?php echo $data["contenu"] ;?></textarea>
					</div>
					<div class="form-group">
						<label for="page-contenu">Statut de la page</label>
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
								<span class="label label-danger">Privé</span>
							</label>
						</div>
					</div>

					<div class="checkbox">
						<label>
							<input type="checkbox">Page aura une carte.
						</label>
					</div>
					<div id="pagemap">
						<div class="form-group">
							<label for="page-latitudes">Latitudes</label>
							<input value="<?php echo $data["geo_lat"];?>" type="text" class="form-control" id="page-latitudes" placeholder="Enter Latitudes">
						</div>
						<div class="form-group">
							<label for="page-longitudes">Longitudes</label>
							<input  value="<?php echo $data["geo_long"];?>" type="text" class="form-control" id="page-longitudes" placeholder="Enter Longitudes">
						</div>
					</div>
					<div class="form-group">
						<label for="page-date">Date</label>
						<input type="hidden" id="page-date" value="<?php echo $data["date_modif"];?>">
						<input type="text" class="form-control" id="page-date-human" value="<?php echo date("l, d F  Y H:i:s",strtotime($data["date_modif"]));?>" disabled>
					</div>
					<div class="form-group">
						<button type="submit" class="btn btn-primary" data-loading-text="Sauvegardez...">Soumettre</button>
					</div>
					<div class="btn-group" data-toggle="buttons">
				</form>		<!-- /Form Edit pages-->
			</div>
			</div><!--end panel-->
		  </div>
	<?php }
	public function afficherListAdmin($aDonneesPages, $aDonneesPaginator, $partir, $fin) {	?>
		<?php

			$nomberPages = count($aDonneesPages);
			//print_r($data);
			$htmlPage = "";
			$htmlPagination = "";
			
			$htmlPagination .= "<!--Pagination-->	<ul class=\"pagination\">";
				foreach($aDonneesPaginator as $page){
					$htmlPagination .= "<li><a href='adminka.php?requete=page&partir={$page["partir"]}&fin={$page["fin"]}'>{$page["page"]}</a></li>";
				}
			$htmlPagination .= "</ul>";
			
			$fin = min($fin, $nomberPages);
			
			for ($i=$partir, $j=$fin; $i<$j; $i++){
				$htmlPage .= "<tr>\r\n";
					$htmlPage .= "<td><a href=\"index.php?requete=page&page_id={$aDonneesPages[$i]["id_page"]}\" target=\"_blank\" title=\"Preview - {$aDonneesPages[$i]["titre"]}\">{$aDonneesPages[$i]["id_page"]}</a></td>\r\n";
					$htmlPage .= "<td><a href=\"adminka.php?requete=page_edition&page_id={$aDonneesPages[$i]["id_page"]}\" title=\"Edit: {$aDonneesPages[$i]["titre"]}\">{$aDonneesPages[$i]["titre"]}</a></td>\r\n";
					$dateFormatLisible = date("l, d F Y",strtotime($aDonneesPages[$i]["date_modif"]));
					$heureFormatLisible = date("H:i:s",strtotime($aDonneesPages[$i]["date_modif"]));
					$htmlPage .= "<td><abbr title=\"{$heureFormatLisible}\">{$dateFormatLisible}</abbr></td>";
					switch ($aDonneesPages[$i]["statut"]) {
						case 0:
							$htmlPage .= "<td><span class=\"label label-warning\">Brouillon</span></td>";
							break;
						case 1:
							$htmlPage .= "<td><span class=\"label label-success\">Publié</span></td>";
							break;
						case 2:
							$htmlPage .= "<td><span class=\"label label-danger\">Privé</span></td>";
							break;
					}
				$htmlPage .= "</tr>\r\n";
			}
				//var_dump($tousPages);

		?>
				 
		<div class="panel panel-default">
			<!-- Default panel contents -->
			<div class="panel-heading">Toutes les pages<span class="badge pull-right"><?php echo $nomberPages;?></span><div> <a href="adminka.php?requete=page_edition">Ajouter une page</a></div></div>
			<div class="panel-body">
			<p>Les pages offrent en générale des informations intemporelles sur le site, en plus des pages habituelles comme "Contact" ou "À Propos" on y retrouve souvent  des ppages comme "Droits d'auteur", "Informations sur la compagnie" ou "Conditions d'utilisations".</p>
			</div>

			<!-- Table pages-->
			<table class="table table-hover">
				<thead>
				  <tr>
					<th>#</th>
					<th>Titre</th>
					<th>Date</th>
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
}
?>