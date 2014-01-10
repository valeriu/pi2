<?php
/**
 * Class Vue
 * Template de classe Vue. Dupliquer et modifier pour votre usage.
 * 
 * @author Jonathan Martel
 * @version 1.0
 * @update 2013-12-11
 * @license Creative Commons BY-NC 3.0 (Licence Creative Commons Attribution - Pas d’utilisation commerciale 3.0 non transposé)
 * @license http://creativecommons.org/licenses/by-nc/3.0/deed.fr
 * 
 */


class VuePanier {

	/**
	 * Affiche la page d'accueil 
	 * @access public
	 * 
	 */
	public function affichePanier() {
		?>
		<script>
				window.addEventListener('load', function () {
					Panier.creerPanier();
				});
			</script>
			<div id="panier" class="">
				<div class="panel panel-default">
					<header class="panel-heading">
						<h2>Votre panier</h2>
						<div class="row">
							<div class="col-sm-12">
								<div class="col-sm-2">
									<h4>Produit</h4>
								</div>
								<div class="col-sm-4">
									<h4>Description</h4>
								</div>
								<div class="col-sm-2">
									<h4>Prix</h4>
								</div>
								<div class="col-sm-2">
									<h4>Qt</h4>
								</div>
								<div class="col-sm-2">
									<h4>Total</h4>
								</div>
							</div>
						</div>
					</header>
					<article id="produits" class="panel-body">
				    	
				  	</article>
				  	<article id="infoPanier" class="panel-footer">
				  		<article id="totalProduits" class="row">
							<div class="col-sm-12">
								<div class="col-sm-offset-8 col-sm-2 text-right">
									<p><strong>Produits</strong></p>
								</div>
								<div class="col-sm-2 text-center">
									<p id="totalProduitsPanier"></p>
								</div>
							</div>
						</article>
						<article id="totalPrix" class="row">
							<div class="col-sm-12">
								<div class="col-sm-offset-8 col-sm-2 text-right">
									<p><strong>Prix total</strong></p>
								</div>
								<div class="col-sm-2 text-center">
									<p><strong id="totalPrixPanier"></strong><strong> $CAD</strong></p>
								</div>
							</div>
						</article>
				  	</article>
				</div>
				<a href="../index.html"><button name="retourner" id="back" class="btn btn-lg btn-primary" type="button">Retour au catalogue</button></a>
				<button id="confirmer" class="btn btn-lg btn-primary" data-toggle="modal" data-target="#myModal" data-backdrop="false">Passer la commande</button>
				<!-- Modal -->
				<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
				  <div class="modal-dialog">
				    <div class="modal-content">
				    	<div class="modal-header">
					        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
					        <h4 class="modal-title" id="myModalLabel">Informations à completer</h4>
					    </div>
				      	<div class="modal-body">
							<div class="input-group input-group-sm">
								Courriel :
								<input name="email" type="text" class="form-control" required value=""/>
							</div>
							<div class="input-group input-group-sm">
								Adresse:
								<input name="adresse" type="text" class="form-control" required value=""/>
							</div>
							<div class="input-group input-group-sm">
								Ville:
								<input name="ville" type="text" class="form-control" required value=""/>
							</div>
							<div class="input-group input-group-sm">
								Province:
								<input name="province" type="text" class="form-control" required value=""/>
							</div>
							<br>
							<div id="champsVides" class="alert alert-danger">
								<p>Il faut remplir tous les champs!</p>
							</div>
				      	</div>
					    <div class="modal-footer">
					        <button type="button" class="btn btn-default" data-dismiss="modal">Retourner au panier</button>
					        <button type="submit" class="btn btn-primary" id="confirmerCommande">Confirmer la commande</button>
					    </div>
				    </div><!-- /.modal-content -->
				  </div><!-- /.modal-dialog -->
				</div><!-- /.modal -->
			</div>
			<div id="panierVide"><!-- Message de panier Vide -->
				<div class="alert alert-danger">
					<p>Votre panier est vide.</p>
				</div>
				<a href="../index.html"><button name="retourner" id="back" class="btn btn-lg btn-primary" type="button">Retour au catalogue</button></a>
			</div>
			<div id="panierConfirmation"><!-- Message de confirmation de la commande -->
				<div class="alert alert-success">
					<p>Votre commande a été envoyé!.</p>
				</div>
			</div>
			<div id="msgError"><!-- Message d'error de télechargement ou autre -->
				<div class="alert alert-danger">
					<p>Désolé, trop temps, essayez plus tard!</p>
				</div>
			</div>
			<div id="pasEnregistre"><!-- Message d'error de télechargement ou autre -->
				<div class="alert alert-danger">
					<p>Désolé, votre commande n'a pas été enregistré, essayez plus tard!</p>
				</div>
			</div>
<?php
		
	}

	
	public function affiche() {
		?>
		<article>
			<h1>PANIER</h1>
			<p>Information panier</p>
		</article>
		<?php
		
	}


	
}
?>