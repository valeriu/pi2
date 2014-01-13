<?php
/**
 * Class Vue Pages
 * Template de classe Vue Pages.
 * 
 * @author Valeriu Tihai
 * 
 */


class VueCommandes {

	/**
	 * Affiche un page Front End 
	 * 
	 */
	
	public function afficherListAdmin($aDonneesCommandes, $aDonneesPaginator, $partir, $fin) {	?>
		<?php

			$nomberCommandes = count($aDonneesCommandes);
			//print_r($data);
			$htmlPage = "";
			$htmlPagination = "";
			
			$htmlPagination .= "<!--Pagination-->	<ul class=\"pagination\">";
				foreach($aDonneesPaginator as $page){
					$htmlPagination .= "<li><a href='adminka.php?requete=commandes&partir={$page["partir"]}&fin={$page["fin"]}'>{$page["page"]}</a></li>";
				}
			$htmlPagination .= "</ul>";
			
			$fin = min($fin, $nomberCommandes);
			
			for ($i=$partir, $j=$fin; $i<$j; $i++){
				$htmlPage .= "<tr>\r\n";
					$htmlPage .= "<td>{$aDonneesCommandes[$i]["id_commandes"]}</td>\r\n";
					
					$htmlPage .= "<td><a href=\"adminka.php?requete=details_commandes&commande_id={$aDonneesCommandes[$i]["id_commandes"]}\" title=\"Edit: {$aDonneesCommandes[$i]["date_commande"]}\">{$aDonneesCommandes[$i]["date_commande"]}</a></td>\r\n";
					$htmlPage .= "<td>{$aDonneesCommandes[$i]["utilisateurs_id_utilisateurs"]}</td>\r\n";
					/*$dateFormatLisible = date("l, d F Y",strtotime($aDonneesCommandes[$i]["date_modif"]));
					$heureFormatLisible = date("H:i:s",strtotime($aDonneesCommandes[$i]["date_modif"]));
					$htmlPage .= "<td><abbr title=\"{$heureFormatLisible}\">{$dateFormatLisible}</abbr></td>";*/
					switch ($aDonneesCommandes[$i]["statut"]) {
						case 0: // En traitement
							$htmlPage .= "<td><span class=\"label label-warning\">En-traitement</span></td>";
							break;
						case 1: // Back-order
							$htmlPage .= "<td><span class=\"label label-danger\">Back-order</span></td>";
							break;
						case 2: // Expedié
							$htmlPage .= "<td><span class=\"label label-success\">Expedié</span></td>";
							break;
						case 3: // Anullé
							$htmlPage .= "<td><span class=\"label label-danger\">Anullé</span></td>";
							break;
					}
				$htmlPage .= "<td>{$aDonneesCommandes[$i]["total_commande"]}</td>\r\n";
				$htmlPage .= "</tr>\r\n";
			}
				//var_dump($tousPages);

		?>
				 
		<div class="panel panel-default">
			<!-- Default panel contents -->
			<div class="panel-heading">Toutes les pages<span class="badge pull-right"><?php echo $nomberCommandes;?></span>
			</div>
			<div class="panel-body">
			Liste de toutes le commandes
			</div>
			<!-- Table pages-->
			<table class="table table-hover">
				<thead>
				  <tr>
					<th>Id</th>
					<th>Date</th>
					<th>id Client</th>
					<th>Statut</th>
					<th>Total $CAD</th>
				  </tr>
				</thead>
				<tbody>
				  <?php echo $htmlPage; ?>
				</tbody>
			  </table><!-- end table-->
			</div><!--end panel-->
			
			
			<?php echo $htmlPagination; ?>
			
	<?php }

	public function modifierCommandeAdmin($data, $result) {
		//print_r($result);
		?>
		
		<div class="panel panel-default">
			<!-- Default panel contents -->
			<div class="panel-heading">Ajouter ou modifier une page</div>
			<div class="panel-body">
			<?php
				switch ($result) {
					case 1:
						echo "<div class=\"alert alert-success\"><strong>Bien fait!</strong> Vous insérez cette page dans la base de données avec succès.</div>";
						break;
					case 0:
						echo "<div class=\"alert alert-danger\"><strong>Oh rupture!</strong> Changer quelques choses et essayer à nouveau soumission.</div>";
						break;
					default:
						break;
				}
			?>
			<!-- Form Edit pages-->
			<form role="form" method="POST" action="<?php echo $_SERVER['REQUEST_URI'];?>">
					<div class="form-group">
						<label for="page-title">Titre</label>
						<input type="text" class="form-control" name="page-title" placeholder="Enter Title" value="<?php echo $data["titre"] ;?>">
					</div>
					<div class="form-group">
						<label for="page-description">Description</label>
						<textarea class="form-control" rows="3" name="page-description" placeholder="Meta Description"><?php echo $data["description_meta"] ;?></textarea>
						<p class="help-block">Description du lien, celle-ci apparaît souvent dans les recherches Google. <code>&lt;meta name="description" content=""&gt;</code></p>
					</div>
					<div class="form-group">
						<label for="page-contenu">Contenu</label>
						<textarea class="form-control" rows="18" name="page-contenu" placeholder="Page contenu"><?php echo $data["contenu"] ;?></textarea>
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

					<div class="checkbox" >
						<label id="pagemap-toogle">
							Page aura une carte.
						</label>
					</div>
					<div id="pagemap">
						<div class="form-group">
							<label for="page-latitudes">Latitudes</label>
							<input value="<?php echo $data["geo_lat"];?>" type="text" class="form-control" name="page-latitudes" placeholder="Enter Latitudes">
						</div>
						<div class="form-group">
							<label for="page-longitudes">Longitudes</label>
							<input  value="<?php echo $data["geo_long"];?>" type="text" class="form-control" name="page-longitudes" placeholder="Enter Longitudes">
						</div>
					</div>
					<div class="form-group">
						<label for="page-date">Date</label>
						<input type="hidden" name="page-date" value="<?php echo $data["date_modif"];?>">
						<input type="hidden" name="page-id" value="<?php echo $data["id_page"];?>">
						<input type="text" class="form-control" id="page-date-human" value="<?php echo date("l, d F  Y H:i:s",strtotime($data["date_modif"]));?>" disabled>
					</div>
					<div class="form-group">
						<button name="commande-modifier" type="submit" class="btn btn-primary" data-loading-text="Sauvegardez...">Soumettre</button>
					</div>
					<div class="btn-group" data-toggle="buttons">
				</form>		<!-- /Form Edit pages-->
			</div>
			</div><!--end panel-->
		  </div>
	<?php }
}
?>