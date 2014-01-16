<?php
 /**
 * Description of VueCatalogue
 * La vue qui affiche les pages du catalogue
 *
 * @author Yan Boucher Bouchard
 */


class VueCatalogue { 

	public function afficherCatalogue($aProduits) {
		$aCategories = array(1=>"Panneaux solaires",2=>"Kits Solaires",3=>"Lampes DEL");
?>
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

<?php
		for($i=0,$c=count($aProduits);$i<$c;$i++) {
?>

					  <tr title="Cliquez pour description!">
			            <td class="clickable"><?php echo $aProduits[$i]["id_produits"]; ?></td>
			            <td class="clickable nom"><h3><?php echo $aProduits[$i]["nom"]; ?></h3></td>
			            <td class="clickable"><?php echo $aProduits[$i]["puissance"]; ?>W</td>
			            <td class="clickable"><?php echo $aCategories[$aProduits[$i]["categorie_id_categorie"]]; ?></td>
			            <td class="clickable img"><img src="img/products/<?php echo $aProduits[$i]["image"]; ?>.jpg"></td>
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