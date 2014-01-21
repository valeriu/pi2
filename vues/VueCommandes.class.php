<?php
/**
 * Class Vue Commandes
 * Template de classe Vue Commandes.
 * 
 * @author Luis
 * 
 */


class VueCommandes {

	/**
	 * Affiche un page Front End 
	 * 
	 */
	
	public function afficherListAdmin($aDonneesCommandes, $aDonneesPaginator, $partir, $fin) {
		
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
					$htmlPage .= "<td><a href=\"adminka.php?requete=details_commande&commande_id={$aDonneesCommandes[$i]["id_commandes"]}\" title=\"Edit: {$aDonneesCommandes[$i]["date_commande"]}\">{$aDonneesCommandes[$i]["id_commandes"]}</a></td>\r\n";
					// Format heure
					$dateFormatLisible = date("l, d F Y",strtotime($aDonneesCommandes[$i]["date_commande"]));
					$heureFormatLisible = date("H:i:s",strtotime($aDonneesCommandes[$i]["date_commande"]));

					$htmlPage .= "<td><abbr title=\"{$heureFormatLisible}\">{$dateFormatLisible}</abbr></td>\r\n";
					$htmlPage .= "<td><a href=\"adminka.php?requete=details_usager&id_utilisateurs={$aDonneesCommandes[$i]["utilisateurs_id_utilisateurs"]}\" title=\"Edit: {$aDonneesCommandes[$i]["utilisateurs_id_utilisateurs"]}\">{$aDonneesCommandes[$i]["utilisateurs_id_utilisateurs"]}</a></td>\r\n";
					$htmlPage .= "<td>{$aDonneesCommandes[$i]["total_commande"]}</td>\r\n";
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
				$htmlPage .= "</tr>\r\n";
			}
				//var_dump($tousPages);

		?>
				 
		<div class="panel panel-default">
			<!-- Default panel contents -->
			<div class="panel-heading">Liste de toutes les Commande<span class="badge pull-right"><?php echo $nomberCommandes;?></span>
			</div>
			<div class="panel-body">
				Vous pouvez regarder le détails de la commande et aussi le cliente qui a accheté la commande.
			</div>
			<!-- Table pages-->
			<table class="table table-hover">
				<thead>
				  <tr>
					<th>Id</th>
					<th>Date</th>
					<th>id Client</th>
					<th>Total $CAD</th>
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

	public function detailsCommandesAdmin($data, $result) {
		//print_r($result);
		?>
		
		<div class="panel panel-default">
			<!-- Default panel contents -->
			<div class="panel-heading">Ajouter un commentaire ou modifier le status de la commande</div>
			<div class="panel-body">
			<?php
				switch ($result) {
					case 1:
						echo "<div class=\"alert alert-success\"><strong>Bien fait!</strong> Vous avez inséré le détails de la commande dans la base de données avec succès.</div>";
						break;
					case 0:
						echo "<div class=\"alert alert-danger\"><strong>Oh rupture!</strong> Il y a eu un problèmme, essayer de nouveau soumission.</div>";
						break;
					default:
						break;
				}

				// Format heure
					$dateFormatLisible = date("l, d F Y",strtotime($data["date_commande"]));
					$heureFormatLisible = date("H:i:s",strtotime($data["date_commande"]));
					$dateEtHeure = "<abbr title=\"{$heureFormatLisible}\">{$dateFormatLisible}</abbr>";
			?>
				<!-- Form Edit Commande-->
				<form role="form" method="POST" action="./adminka.php?requete=modifier_commande&commande_id=<?php echo $data["id_commandes"]?>">
					<!-- CODE -->
					<div class="panel panel-default">
						<div class="panel-heading">
							<div class="row">
								<div class="col-sm-12">
									<div class="col-sm-2">id</div>
									<div class="col-sm-2">Date</div>
									<div class="col-sm-2">id Client</div>
									<div class="col-sm-2">Prix total</div>
									<div class="col-sm-3">Statut</div>
								</div>
							</div>
						</div>
						<div class="panel-body">
							<div class="row">
								<div class="col-sm-12">
									<input type="hidden" name="commande_id" value="<?php echo $data["id_commandes"] ;?>">
									<div class="col-sm-1"><?php echo $data["id_commandes"] ;?></div>
									<div class="col-sm-3"><?php echo $dateEtHeure ;?></div>
									<div class="col-sm-2"><?php echo $data["utilisateurs_id_utilisateurs"] ;?></div>
									<div class="col-sm-2"><?php echo $data["total_commande"] ;?></div>
									<div class="col-sm-3"><?php
										$htmlPage = '';
										switch ($data["statut"]) {
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
										echo $htmlPage;
										?>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="form-group">
						<label for="product-details">Notes sur la commande</label>
						<textarea class="form-control" rows="12" name="commande-commentaires" placeholder="Commentaires"><?php echo $data["commentaires"] ;?></textarea>
					</div>
					<div class="form-group">
						<label for="product-status">Statut de la commande</label>
						<div class="radio">
							<label>
								<input type="radio" name="optionsRadios" id="optionsRadios1" value="2" <?php echo $nb1 = ($data["statut"]==2) ? "checked" : "";?>>
								<span class="label label-success">Expedié</span>
							</label>
						</div>
						<div class="radio">
							<label>
								<input type="radio" name="optionsRadios" id="optionsRadios2" value="0" <?php echo $nb1 = ($data["statut"]==0) ? "checked" : "";?>>
								<span class="label label-warning">En-traitement</span>
							</label>
						</div>
						<div class="radio">
							<label>
								<input type="radio" name="optionsRadios" id="optionsRadios3" value="1" <?php echo $nb1 = ($data["statut"]==1) ? "checked" : "";?>>
								<span class="label label-danger">Back-order</span>
							</label>
						</div>
						<div class="radio">
							<label>
								<input type="radio" name="optionsRadios" id="optionsRadios3" value="3" <?php echo $nb1 = ($data["statut"]==3) ? "checked" : "";?>>
								<span class="label label-danger">Anullé</span>
							</label>
						</div>
					</div>
					<div class="form-group">
						<button name="commande-modifier" type="submit" class="btn btn-primary" data-loading-text="Sauvegardez...">Soumettre</button>
					</div>
					<div class="btn-group" data-toggle="buttons">
					<!-- / FIN CODE -->
				</form><!-- /Form Edit Commande-->
			</div>
		</div><!--end panel-->
	<?php }
}
?>