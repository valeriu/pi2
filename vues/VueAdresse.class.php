<?php
/**
 * Description of vueUsagers
 * La vue qui affiche les formulaire d'inscriptions ou les modals
 *
 * @author Luc Cinq-Mars
 */


class VueAdresse {

	
	public function afficherAdrese($data) {

		?>
		<script>
			window.addEventListener('load', function () {
				//Pour la province
				$('input[name="choixProvince"]').on('change', function(){
					$('#province').val(this.id);
				});
				
				$("#adresse").on("click", function(){
					var xhr = new XMLHttpRequest();
					var t = $("#tel").val();
					var r = $("#rue").val();
					var a = $("#appartement").val();
					var v = $("#ville").val();
					var p = $("#province").val();
					var cp = $("#codePostal").val();
					xhr.open("POST", "ajaxControler.php?requete=adresse", true);
					//telephone	rue	appartement	ville	code_postal	province
					var req = "telephone=" + t + "&rue=" + r + "&appartement=" + a + "&ville=" + v + "&province=" + p + "&code_postal=" + cp;
					xhr.onreadystatechange = function() {
						if (xhr.status == 200 && xhr.readyState == xhr.DONE) {
							var str = xhr.responseText;
							if(str > 100){
								$('#ShippingAddress').replaceWith(xhr.responseText);
							}
							else{
								$("#adresse-erreur").html(xhr.responseText);
							}
						}
					};
					xhr.setRequestHeader("Content-type","application/x-www-form-urlencoded");
					xhr.send(req);
				});
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
								<div class="row adresses">
								<?php
									for($i = 0; $i < count($data); $i++){
										?>
											<article class="col-lg-3 col-sm-3">
												<p><?php echo $data[$i]['rue']; ?> <?php echo "App.".$data[$i]['appartement']; ?></p>
												<p><?php echo $data[$i]['ville']; ?>, <?php echo $data[$i]['province']; ?> &nbsp;<?php echo $data[$i]['code_postal']; ?></p>
												<div class="input-group">
													<label for="<?php echo $data[$i]['id_adresse']; ?>" class="form-control">Addresse <?php echo $i+1; ?></label> 
													<span class="input-group-addon">
														<input type="radio" id="<?php echo $data[$i]['id_adresse']; ?>" name="shippingAddress" value="<?php echo $data[$i]['id_adresse']; ?>">
													</span>
												</div><!-- /input-group -->
											</article>
										<?php
									}
								?>		
								<!--<article class="col-lg-3">
										<p>2650 Desjardins App.4</p>
										<p>Montreal, Québec &nbsp;H1V 2H7</p>
										<div class="input-group">
											<label for="address1" class="form-control">Addresse 1</label> 
											<span class="input-group-addon">
												<input type="radio" id="address1" name="shippingAddress" value="20">
											</span>
										</div><!-- /input-group 
									</article>
									<article class="col-lg-3">
										<p>1936 Martial App. 9</p>
										<p>Montreal, Québec &nbsp;H1H 1W7</p>
										<div class="input-group">
											<label for="address2" class="form-control">Addresse 2</label> 
											<span class="input-group-addon">
												<input type="radio" id="address2" name="shippingAddress" value="20">
											</span>
										</div><!-- /input-group
									</article>-->
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
									<article class="col-lg-8">
										<span id="adresse-erreur"></span>
										<form class="form-signin" name="form-usager-adresse" >
											<!-- telephone	rue	appartement	ville	code_postal	province -->
											<div class="input-group input-group-sm">
												Téléphone
												<input id="tel" name="tel" type="tel" class="form-control" required placeholder="xxx-xxx-xxxx">
											<div class="input-group input-group-sm">
												No. civique et Rue:
												<input id="rue" name="rue" type="text" class="form-control" required placeholder="123 rue exemple">
											</div>
											<div class="input-group input-group-sm">
												Appartement:
												<input id="appartement" name="appartement" type="text" class="form-control" placeholder="#3">
											</div>
											<div class="input-group input-group-sm">
												Ville:
												<input id="ville" name="ville" type="text" class="form-control" required placeholder="Exemple">
											</div>
											<div class="input-group input-group-sm">
												Province:
												<br>
												<div class="btn-group row provinces"  data-toggle="buttons">
													<label class="btn btn-default" title="Québec">
														<input type="radio" name="choixProvince" id="qc"> Qc
													</label>
													<label class="btn btn-default" title="Ontario">
														<input type="radio" name="choixProvince" id="on"> On
													</label>
													<label class="btn btn-default" title="Manitoba">
														<input type="radio" name="choixProvince" id="mn"> Mn
													</label>
													<label class="btn btn-default" title="Saskatchewan">
														<input type="radio" name="choixProvince" id="sk"> Sk
													</label>
													<label class="btn btn-default" title="Colombie-Britannique">
														<input type="radio" name="choixProvince" id="cb"> Cb
													</label>
													<label class="btn btn-default" title="Nouveau-Brunswick">
														<input type="radio" name="choixProvince" id="nb"> Nb
													</label>
													<label class="btn btn-default" title="Nouvelle-Écosse">
														<input type="radio" name="choixProvince" id="ne"> Ne
													</label>
													<label class="btn btn-default" title="Île-du-Prince-Édouard">
														<input type="radio" name="choixProvince" id="ie"> Ie
													</label>
													<label class="btn btn-default" title="Alberta">
														<input type="radio" name="choixProvince" id="al"> Al
													</label>
													<label class="btn btn-default" title="Terre-Neuve">
														<input type="radio" name="choixProvince" id="tn"> Tn
													</label>
													<label class="btn btn-default" title="Territoire du Nord-Ouest">
														<input type="radio" name="choixProvince" id="no"> No
													</label>
													<label class="btn btn-default" title="Yukon">
														<input type="radio" name="choixProvince" id="yk"> Yk
													</label>
													<label class="btn btn-default" title="Nunavut">
														<input type="radio" name="choixProvince" id="nv"> Nv
													</label>
												</div>
												<input type="hidden" id="province" name="province" value="">
											</div>	
											<div class="input-group input-group-sm">
												Code postal:
												<input id="codePostal" name="codePostal" type="text" class="form-control" required placeholder="X1X 1X1">
											</div>
											<button name="adresse" id="adresse" class="btn btn-primary" type="button">Soumettre</button>
											<br>	
										</form>
									</article>
								</div>
							</div>
						</div>
					</div>
					<hr class="featurette-divider">
					<a href="index.php?requete=panier"><button name="back" id="back" class="btn btn-lg btn-primary" type="button">Retour</button></a>
					<a href="index.php?requete=panier_confirmation"><button name="pay" id="pay" class="btn btn-lg btn-primary" type="button">Payer</button></a>
					<!--<button name="pay" id="pay" class="btn btn-lg btn-primary" type="submit">Pay</button>-->
				</div>
			</form>
<?php
		
	}

}
?>