<?php
/**
 * Module Vue Panier
 * La vue qui affiche les differentes étapes du panier
 *
 * @author Luis Felipe Rosas, Luc Cinq-Mars
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
		<script src="js/panier.js"></script>
		<script>
			window.addEventListener('load', function () {
				Panier.creerPanier();	
			});
		</script>
		<?php
					if(!isset($_SESSION['usager'])){
				?>	
						<script>
							//CONNECTER
							window.addEventListener('load', function () {
								$("#confirmer").off("click", confirmerCommande);
								$("#confirmer").on("click", function(){
									var xhr = new XMLHttpRequest();
									xhr.open("GET", "ajaxControler.php?requete=formConnecter", true);	
									xhr.onreadystatechange = function() {
										if (xhr.status == 200 && xhr.readyState == xhr.DONE) {
											//$(".modal-content").html(xhr.responseText);
											var str = xhr.responseText;

											$(".modal-content").html(xhr.responseText);
											$('#myModal').modal('show');
											
										}
									};
										xhr.send();
								});
							})
						</script>
				<?php	
					}
					else{
						?>
						<script>							
							window.addEventListener('load', function () {
								$("#confirmer").on("click", confirmerCommande);
							});	
						</script>	
						<?php		
					}
				?>	
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
				<a href="./index.php?requete=produits"><button name="retourner" id="back" class="btn btn-lg btn-primary" type="button">Retour au catalogue</button></a>
				<button id="confirmer" class="btn btn-lg btn-primary" >Continuer</button>


			</div>
			<div id="panierVide"><!-- Message de panier Vide -->
				<div class="alert alert-danger">
					<p>Votre panier est vide.</p>
				</div>
				<a href="./index.php?requete=produits"><button name="retourner" id="back" class="btn btn-lg btn-primary" type="button">Retour au catalogue</button></a>
			</div>
			<div id="msgError"><!-- Message d'error de réponse ou autre -->
				<div class="alert alert-danger">
					<p>Désolé, trop temps, essayez plus tard!</p>
				</div>
			</div>
<?php
		
	}

	public function affichePanierFinal($aDonnes) {

	?>
		<div id="panierConfirmer" class="">
				<div class="panel panel-default">
					<header class="panel-heading">
						<h2>Votre commande</h2>
						<div class="row">
							<div class="col-sm-12">
								<div class="col-sm-2">
									<h4>Produit</h4>
								</div>
								<div class="col-sm-5">
									<h4>Description</h4>
								</div>
								<div class="col-sm-2">
									<h4>Prix</h4>
								</div>
								<div class="col-sm-1">
									<h4>Qt</h4>
								</div>
								<div class="col-sm-2">
									<h4>Total</h4>
								</div>
							</div>
						</div>
					</header>
					<article id="produits" class="panel-body">

					<?php
					$htmlProduits = '';
					for ($i = 0; $i < $aDonnes['nb_produit']; $i++){
						$htmlProduits .= '<article id="'.$aDonnes['info_commande'][$i]->idP.'" class="row"><div class="col-sm-12"><div class="col-sm-2"><a href="#" class="thumbnail"><img class="img-responsive" src="'.$aDonnes['info_commande'][$i]->image.'" alt="'.$aDonnes['info_commande'][$i]->nom.'"></a></div><div class="col-sm-5"><p>'.$aDonnes['info_commande'][$i]->nom.'</p></div><div class="col-sm-2"><p><span class="prix">'.$aDonnes['info_commande'][$i]->prix.'</span><span> $CAD</span></p></div><div class="col-sm-1"><p>'.$aDonnes['info_commande'][$i]->quant.'</p></div><div class="col-sm-2 text-center"><p><span class="total">'.number_format($aDonnes['info_commande'][$i]->prix * $aDonnes['info_commande'][$i]->quant, 2).'</span><span> $CAD</span></p></div></div></article>';
           			}
           			echo $htmlProduits;
					?>				    	
				  	</article>
				  	<article id="infoPanier" class="panel-footer">
				  		<article id="totalPrix" class="row">
							<div class="col-sm-12 text-right">
								<div class="col-lg-offset-8 col-md-offset-7 col-sm-offset-7 col-lg-2 col-md-2 col-sm-2 text-right">
									<p><strong>Prix</strong></p>
								</div>
								<div class="col-lg-2 col-md-3 col-sm-3">
									<p><strong><?= number_format($aDonnes['total_commande'], 2) ?> $CAD</strong></p>
								</div>
							</div>
						</article>
				  		<article id="totalProduits" class="row">
							<div class="col-sm-12 text-right">
								<div class="col-lg-offset-8 col-md-offset-7 col-sm-offset-7 col-lg-2 col-md-2 col-sm-2 text-right">
									<p><strong>Taxes</strong></p>
								</div>
								<div class="col-lg-2 col-md-3 col-sm-3">
									<p><strong><?= number_format($aDonnes['taxes'], 2) ?> $CAD</strong></p>
								</div>
							</div>
						</article>
						<article id="totalPrix" class="row">
							<div class="col-sm-12 text-right">
								<div class="col-lg-offset-8 col-md-offset-7 col-sm-offset-7 col-lg-2 col-md-2 col-sm-2 text-right">
									<p><strong>Prix total</strong></p>
								</div>
								<div class="col-lg-2 col-md-3 col-sm-3">
									<p><strong><?= number_format($aDonnes['total_commande'] + $aDonnes['taxes'], 2) ?> $CAD</strong></p>
								</div>
							</div>
						</article>
				  	</article>
				</div>
				<div id="adresseLivraison" class="row">
					<div class="col-lg-6 col-md-6 col-sm-6">
					  	<div class="panel panel-default">
						  	<div class="panel-heading">
						    	<h3 class="panel-title">Adresse de livraison</h3>
						  	</div>
						  	<div class="panel-body">
								<p><?= $aDonnes['adresse']['rue'] ?>&nbsp;<?= "App.".$aDonnes['adresse']['appartement'] ?></p>
								<p><?= $aDonnes['adresse']['ville'] ?>,&nbsp;<?= $aDonnes['adresse']['province'] ?>&nbsp;&nbsp;<?= $aDonnes['adresse']['code_postal'] ?>
								<a href="./index.php?requete=adresseCommande"><button type="button" class="btn btn-sm btn-default pull-right" id="back" name="retourner">Changer l'adresse</button></a></p>
					  		</div>
						</div>
				  	</div><!-- /.col-lg-6 -->
				</div><!-- /.row -->
				<a href="./index.php?requete=panier"><button name="retourner" id="back" class="btn btn-lg btn-primary" type="button">Retour au panier</button></a>
				<form class="passerCommande" action="index.php?requete=payer" method="post">
					<?php $_SESSION['commandePaypal'] = $aDonnes; ?>
					<button id="confirmerPayment" class="btn btn-lg btn-primary" >Payer avec PayPal</button>
				</form>
			</div>
	<?php

	}


	
}
?>