<?php
/**
 * Description of vueUsagers
 * La vue qui affiche les formulaire d'inscriptions ou les modals
 *
 * @author Luc Cinq-Mars
 */


class VueAdresse {

	
	public function afficherAdrese() {

		?>
		<script>
			window.addEventListener('load', function () {
				Panier.creerPanier();
			});
		</script>

			<form id="ShippingAddress" method="POST" action="#">
				<div class="panel-group" id="accordion">
					<div class="panel panel-default">
						<div class="panel-heading">
							<h4 class="panel-title">
								<a data-toggle="collapse" data-parent="#accordion" href="#collapseOne">
									Options d'adresses de livraison
								</a>
							</h4>
						</div>
						<div id="collapseOne" class="panel-collapse collapse in">
							<div class="panel-body">
								<div class="row">
									<article class="col-lg-3">
										<p>2650 Desjardins App.4</p>
										<p>Montreal, Québec &nbsp;H1V 2H7</p>
										<div class="input-group">
											<label for="address1" class="form-control">Addresse 1</label> 
											<span class="input-group-addon">
												<input type="radio" id="address1" name="shippingAddress" value="20">
											</span>
										</div><!-- /input-group -->
									</article>
									<article class="col-lg-3">
										<p>1936 Martial App. 9</p>
										<p>Montreal, Québec &nbsp;H1H 1W7</p>
										<div class="input-group">
											<label for="address2" class="form-control">Addresse 2</label> 
											<span class="input-group-addon">
												<input type="radio" id="address2" name="shippingAddress" value="20">
											</span>
										</div><!-- /input-group -->
									</article>
								</div>
							</div>
						</div>
					</div>
					<div class="panel panel-default">
						<div class="panel-heading">
						  <h4 class="panel-title">
							<a data-toggle="collapse" data-parent="#accordion" href="#collapseTwo">
								Entrer un nouvelle addresse
							</a>
						  </h4>
						</div>
						<div id="collapseTwo" class="panel-collapse collapse">
							<div class="panel-body">
								<div class="row">
									<article class="col-lg-6">
										<div class="input-group input-group-sm">
											Téléphone:
											<input name="tel" type="tel" class="form-control" required>
										</div>
										<div class="input-group input-group-sm">
											Adresse:
											<input name="numCivique" type="number" class="form-control" required>
										</div>
										<div class="input-group input-group-sm">
											Rue:
											<input name="rue" type="text" class="form-control" required>
										</div>
										<div class="input-group input-group-sm">
											Appartement:
											<input name="appartement" type="text" class="form-control">
										</div>
										<div class="input-group input-group-sm">
											Ville:
											<input name="ville" type="text" class="form-control" required>
										</div>
										<div class="input-group input-group-sm">
											Province:
											<input name="province" type="text" class="form-control" required>
										</div>
										<div class="input-group input-group-sm">
											Code postal:
											<input name="codePostal" type="text" class="form-control" required>
										</div>
										<div class="input-group">
											<br>
											<label for="address3" class="form-control">Enregistrer l'adresse</label> 
											<span class="input-group-addon">
												<input type="radio" id="address3" name="shippingAddress" value="20">
											</span>
										</div><!-- /input-group -->
									</article>
								</div>
							</div>
						</div>
					</div>
					<hr class="featurette-divider">
					<a href="panier.html"><button name="back" id="back" class="btn btn-lg btn-primary" type="button">Retour</button></a>
					<a href="panier_confirmation.html"><button name="pay" id="pay" class="btn btn-lg btn-primary" type="button">Payer</button></a>
					<!--<button name="pay" id="pay" class="btn btn-lg btn-primary" type="submit">Pay</button>-->
				</div>
			</form>
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