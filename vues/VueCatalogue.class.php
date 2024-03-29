<?php
 /**
 * Description of VueCatalogue
 * La vue qui affiche les pages du catalogue
 *
 * @author Yan Boucher Bouchard
 */


class VueCatalogue { 

	//VUE POUR MODIFIER UN PRODUIT DANS L'ADMIN
	public function modifierProduitAdmin($data,$result) {
		if(isset($_POST['modifierProduit'])) {
			$data = $_POST;
		}

?>
		
		  <div class="panel panel-default">
			<!-- Default panel contents -->
			<div class="panel-heading">Ajouter ou modifier un produit</div>
			<div class="panel-body">
<?php
				switch ($result) {
					case 1:
						echo "<div class=\"alert alert-success\"><strong>Bien fait!</strong> Vous avez ajouter/modifier ce produit dans la base de données avec succès.</div>";
						break;
					case 0:
						echo "<div class=\"alert alert-danger\"><strong>Oh rupture!</strong>Changer quelques choses et essayer à nouveau la soumission.</div>";
						break;
					default:
						break;
				}
?>

				<!-- Form Edit pages-->
				<form role="form" method="POST" action="./adminka.php?requete=<?php if(isset($_GET['modifier'])) echo "modifier"; else echo "ajouter"; ?>_produit&produit_id=<?php if(isset($data)) echo $data["IdProduit"]; ?>&modifier=1" enctype="multipart/form-data">
					<div class="form-group">
						<label for="product-title">Nom du produit</label>
						<input required type="text" class="form-control" id="nomProduit" name="nomProduit" placeholder="Titre du produit" value="<?php if(isset($data['nomProduit'])) echo $data['nomProduit']; ?>">
					</div>
					<div class="form-group">
						<label for="product-details">Spécifications</label>
						<textarea class="form-control" rows="18" id="specsProduit" name="specsProduit" placeholder="Détails du produit"><?php if(isset($data['specsProduit'])) echo $data['specsProduit']; ?></textarea>
						<p>Séparer d'une virgule (,) chancun des points importants..</p>
					</div>
					<div class="form-group">
						<label for="product-power">Détails</label>
						<input required type="text" class="form-control" id="descProduit" name="descProduit" value="<?php if(isset($data['descProduit'])) echo $data['descProduit']; ?>">
					</div>
					<div class="form-group">
						<label for="product-power">Puissance (W)</label>
						<input required type="text" class="form-control" id="powerProduit" name="powerProduit" value="<?php if(isset($data['powerProduit'])) echo $data['powerProduit']; ?>">
					</div>
					<div class="form-group">
						<label for="product-status">Catégorie</label>
						<div class="radio">
							<label>
								<input required type="radio" name="catIdProduit" id="catIdProduit0" value="1" <?php if(isset($data['catIdProduit'])){if($data['catIdProduit']==1) echo "checked";} ?>>
								<span class="label label-default">Panneaux solaires</span>
							</label>
						</div>
						<div class="radio">
							<label>
								<input required type="radio" name="catIdProduit" id="catIdProduit1" value="2" <?php if(isset($data['catIdProduit'])){if($data['catIdProduit']==2) echo "checked";} ?>>
								<span class="label label-default">Kits Solaires</span>
							</label>
						</div>
						<div class="radio">
							<label>
								<input required type="radio" name="catIdProduit" id="catIdProduit2" value="3" <?php if(isset($data['catIdProduit'])){if($data['catIdProduit']==3) echo "checked";} ?>>
								<span class="label label-default">Lampes DEL</span>
							</label>
						</div>
					</div>
					<div class="form-group">
						<label for="product-status">Statut du produit</label>
						<div class="radio">
							<label>
								<input required type="radio" name="statutProduit" id="statutProduit1" value="1" <?php if(isset($data['statutProduit'])){if($data['statutProduit']==1) echo "checked";} ?>>
								<span class="label label-success">Disponible</span>
							</label>
						</div>
						<div class="radio">
							<label>
								<input required type="radio" name="statutProduit" id="statutProduit0" value="3" <?php if(isset($data['statutProduit'])){if($data['statutProduit']==3) echo "checked";} ?>>
								<span class="label label-warning">Non-disponible</span>
							</label>
						</div>
						<div class="radio">
							<label>
								<input required type="radio" name="statutProduit" id="statutProduit2" value="2" <?php if(isset($data['statutProduit'])){if($data['statutProduit']==2) echo "checked";} ?>>
								<span class="label label-danger">Supprimée</span>
							</label>
						</div>
					</div>
					<div class="form-group">
						<label for="product-status">Type du produit</label>
						<div class="radio">
							<label>
								<input required type="radio" name="typeProduit" id="typeProduit0" value="3" <?php if(isset($data['typeProduit'])){if($data['typeProduit']==3) echo "checked";} ?>>
								<span class="label label-primary">Régulier</span>
							</label>
						</div>
						<div class="radio">
							<label>
								<input required type="radio" name="typeProduit" id="typeProduit1" value="1" <?php if(isset($data['typeProduit'])){if($data['typeProduit']==1) echo "checked";} ?>>
								<span class="label label-success">Nouveauté</span>
							</label>
						</div>
						<div class="radio">
							<label>
								<input required type="radio" name="typeProduit" id="typeProduit2" value="2" <?php if(isset($data['typeProduit'])){if($data['typeProduit']==2) echo "checked";} ?>>
								<span class="label label-info">Meilleur vendeur</span>
							</label>
						</div>
					</div>
					<div class="form-group">
						<label for="product-supplier">Fournisseur</label>
						<input required type="text" class="form-control" id="suppProduit" name="suppProduit" value="<?php if(isset($data['suppProduit'])) echo $data['suppProduit']; ?>">
					</div>
					<div class="form-group">
						<label for="product-supplier-id">ID du produit du fournisseur</label>
						<input required type="text" class="form-control" id="suppIdProduit" name="suppIdProduit" value="<?php if(isset($data['suppIdProduit'])) echo $data['suppIdProduit']; ?>">
					</div>
					<div class="form-group">
						<label for="product-price">Prix</label>
						<input required type="text" class="form-control" id="prixProduit" name="prixProduit" value="<?php if(isset($data['prixProduit'])) echo $data['prixProduit']; ?>">
					</div>
					<div class="form-group">
						<label for="product-weight">Poids (kilogrammes)</label>
						<input required type="text" class="form-control" id="poidsProduit" name="poidsProduit" value="<?php if(isset($data['poidsProduit'])) echo $data['poidsProduit']; ?>">
					</div>
					<div class="form-group">
						<label for="product-dimensions">Dimensions (cm)</label>
						<input required type="text" class="form-control" id="hautProduit" name="hautProduit" value="<?php if(isset($data['hautProduit'])) echo $data['hautProduit']; ?>">
						<input required type="text" class="form-control" id="largProduit" name="largProduit" value="<?php if(isset($data['largProduit'])) echo $data['largProduit']; ?>">
						<input required type="text" class="form-control" id="longProduit" name="longProduit" value="<?php if(isset($data['longProduit'])) echo $data['longProduit']; ?>">
					</div>
					<input required type="hidden" id="evalProduit" name="evalProduit" value="<?php if(isset($data['evalProduit'])) echo $data['evalProduit']; else echo "3";?>">
					<input required type="hidden" id="IdProduit" name="IdProduit" value="<?php if(isset($data['IdProduit'])) echo $data['IdProduit']; ?>">
					<div class="media">
					  <a class="pull-left" href="#">
					    <img class="media-object" src="<?php if(!isset($_FILES['imgUpload'])) echo "img/products/".$data['imgProduit']; else echo "img/products/".$_FILES['imgUpload']['name']; ?>" alt="Apercu du produit">
					  </a>
					  <div class="media-body">
					  	<label class="media-heading" for="imgUpload">Image du produit</label>
					    <input type="file" id="imgUpload" name="imgUpload">
					    <input type="hidden" id="imgProduit" name="imgProduit" value="<?php if(empty($_FILES['imgUpload']['name'])) echo $data['imgProduit']; else echo $_FILES['imgUpload']['name']; ?>">
					  </div>
					</div>
					<br>
					<div class="form-group">
						<button id="modifierProduit" name="modifierProduit" type="submit" class="btn btn-primary" data-loading-text="Sauvegarde...">Soumettre</button>
					</div>
					<div class="btn-group" data-toggle="buttons">
				</form>		<!-- /Form Edit pages-->
			</div>
			</div><!--end panel-->
		  </div>

<?php

	}

	//VUE POUR CONSULTER LA LISTE DES PRODUITS DANS L'ADMIN
	public function afficherListAdmin($aDonnees, $aDonneesPaginator, $partir, $fin) {
		
			$nbProduits = count($aDonnees);
			$htmlPage = "";
			$htmlPagination = "";
			
			$htmlPagination .= "<!--Pagination-->	<ul class=\"pagination\">";
				foreach($aDonneesPaginator as $page){
					$htmlPagination .= "<li><a href='adminka.php?requete=produits&partir={$page["partir"]}&fin={$page["fin"]}'>{$page["page"]}</a></li>";
				}
			$htmlPagination .= "</ul>";
			
			$fin = min($fin, $nbProduits);

			for ($i=$partir, $j=$fin; $i<$j; $i++){
				$htmlPage .= "<tr>\r\n";
					$htmlPage .= "<td><a href=\"adminka.php?requete=details_produits&produit_id={$aDonnees[$i]["id_produits"]}&modifier=1\" title=\"Editer: {$aDonnees[$i]["nom"]}\">{$aDonnees[$i]["id_produits"]}</a></td>\r\n";
					$htmlPage .= "<td><a href=\"adminka.php?requete=details_produits&produit_id={$aDonnees[$i]["id_produits"]}&modifier=1\" title=\"Editer: {$aDonnees[$i]["nom"]}\">{$aDonnees[$i]["nom"]}</a></td>\r\n";
					$htmlPage .= "<td>{$aDonnees[$i]["prix"]}</td>\r\n";
					$htmlPage .= "<td>{$aDonnees[$i]["fournisseur"]}</td>\r\n";
					switch ($aDonnees[$i]["statut"]) {
						case "3": // Inactif
							$htmlPage .= "<td><span class=\"label label-warning\">Inactif</span></td>";
							break;
						case "1": // Actif
							$htmlPage .= "<td><span class=\"label label-success\">Actif</span></td>";
							break;
						case "2": // Supprimé
							$htmlPage .= "<td><span class=\"label label-danger\">Supprimé</span></td>";
							break;
					}
				$htmlPage .= "</tr>\r\n";
			}

?>

			<div class="panel panel-default">
			<!-- Default panel contents -->
			<div class="panel-heading">Tous les produits<span class="badge pull-right"><?php echo $nbProduits;?></span><div> <a href="adminka.php?requete=ajouter_produit">Ajouter un produit</a></div>
			</div>
			<div class="panel-body">
				Vous pouvez modifier et ajouter des produits du catalogue.
			</div>
			<!-- Table pages-->
			<table class="table table-hover tablesorter" id="trier">
				<thead>
				  <tr>
					<th>Id</th>
					<th>Nom</th>
					<th>Prix $</th>
					<th>Fournisseur</th>
					<th>Statut</th>
				  </tr>
				</thead>
				<tbody>
				  <?php echo $htmlPage; ?>
				</tbody>
			  </table><!-- end table-->
			</div><!--end panel-->
			
			
<?php 
			echo $htmlPagination;
			
	}

	//VUE PRINCIPAL DU CATALOGUE COTÉ CLIENT
	public function afficherCatalogue($aProduits) {
		$aCategories 	 = array(1=>"Panneaux solaires",2=>"Kits Solaires",3=>"Lampes DEL");
		$checkCategories = 0;
		if(isset($_GET["1"])) {
			if($_GET["1"]=="true") $checkCategories++;
			if($_GET["2"]=="true") $checkCategories++;
			if($_GET["3"]=="true") $checkCategories++;
		}
?>
			<div class="panel panel-default">
			<!--TRI DU CATALOGUE-->
			  <div class="panel-heading">
			    <div>
			       <label class="checkbox-inline">
			        <input type="checkbox" class="categorieBox" id="inlineCheckbox1" value="1" <?php if($_GET["1"]=="true" || (!isset($_GET["1"]))) echo "checked"; if($checkCategories==1 && $_GET["1"]=="true") echo " disabled"; ?>> Panneaux solaires
			       </label>
			       <label class="checkbox-inline">
			         <input type="checkbox" class="categorieBox" id="inlineCheckbox2" value="2" <?php if($_GET["2"]=="true" || (!isset($_GET["2"]))) echo "checked"; if($checkCategories==1 && $_GET["2"]=="true") echo " disabled"; ?>> Kits solaires
			       </label>
			       <label class="checkbox-inline">
			         <input type="checkbox" class="categorieBox" id="inlineCheckbox3" value="3" <?php if($_GET["3"]=="true" || (!isset($_GET["3"]))) echo "checked"; if($checkCategories==1 && $_GET["3"]=="true") echo " disabled"; ?>> Lampes DEL
			       </label>
			    </div>
			    <div class="pull-right">
			      <button type="button" id="btn-filtres" class="btn btn-default">Trier</button>
			    </div>
			  </div>
			  <div id="panel-filtres" class="panel-heading" hidden>
			  	<label class="radio-inline">
			        <input type="radio" class="filtreRadio" id="inlineradio1" name="radio-filtres" value="specs" <?php if(isset($_GET['mode'])) {if($_GET['mode']=="specs") echo "checked";} ?>> Spécifications
			       </label>
			       <label class="radio-inline">
			         <input type="radio" class="filtreRadio" id="inlineradio2" name="radio-filtres" value="tous" <?php if(isset($_GET['mode'])) {if($_GET['mode']=="tous") echo "checked";} ?>> Catégories
			       </label>
			       <label class="radio-inline">
			         <input type="radio" class="filtreRadio" id="inlineradio3" name="radio-filtres" value="prix" <?php if(isset($_GET['mode'])) {if($_GET['mode']=="prix") echo "checked";} ?>> Prix
			       </label>
			  </div>
			<!--CATALOGUE-->
			  <main class="panel-body">
			  	<section class="table-responsive">
			      <table class="table-hover col-sm-12">
			        <tbody>

<?php
		for($i=0,$c=count($aProduits);$i<$c;$i++) {
?>

					  <tr title="Cliquez pour description!">
			            <td class="clickable"><?php echo $aProduits[$i]["id_produits"]; ?></td>
			            <td class="clickable nom"><h3><?php echo $aProduits[$i]["nom"]; ?></h3></td>
			            <td class="clickable"><?php echo $aProduits[$i]["puissance"]; ?>W</td>
			            <td class="clickable"><?php echo $aCategories[$aProduits[$i]["categorie_id_categorie"]]; ?></td>
			            <td class="clickable img"><img src="img/products/<?php echo $aProduits[$i]["image"]; ?>"></td>
			            <td class="clickable text-success text-pricing"><strong><span class="prix-valeur"><?php echo $aProduits[$i]["prix"]; ?></span>$</strong></td>
			            <td>
			              <button type="button" id="<?php echo $aProduits[$i]["id_produits"]; ?>" class="btn btn-primary btn-home ajouter"><span class="glyphicon glyphicon-shopping-cart"></span>&nbsp;Ajouter au panier</button>
			            </td>
			          </tr>
					  <tr>
			            <td colspan="7">
			              <article class="product-details" hidden>
			                <ul class="list-group col-md-9">
<?php 
							//decoupage de la liste des specifications en liste
							$aSpecs = explode(",", $aProduits[$i]["specification"]);
							for($j=0,$d=count($aSpecs);$j<$d;$j++) {
?>
								<li class="list-group-item"><?php echo $aSpecs[$j]; ?></li>
<?php
							}
 ?>
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
					
<?php
		}
?>
					</tbody>
			      </table>
			    </section>
			  </main>
			</div>
<?php
	}
}
?>