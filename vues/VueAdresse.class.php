<?php
/**
 * Description of vueUsagers
 * La vue qui affiche les formulaire d'inscriptions ou les modals
 *
 * @author Luc Cinq-Mars
 */


class VueAdresse {

	
	public function afficherAdrese($data = '') {
		
		?>
		<script>
			$(function(){
				//On cache la partie pour les messages d'erreur 
				$('#msgError').hide();
				
				//Pour passer à l'étape suivante de la commande
				$('input[name="shippingAddress"]').on('change', function(e){
					var idTarget = e.target.id;
					$('#confirmationAdresses').removeAttr('disabled');
					$('#confirmationAdresses').on('click', function(){
		               Panier.passerCommande(idTarget);
		            });

				});
				//Pour la province
				$('input[name="choixProvince"]').on('change', function(){
					$('#province').val(this.id);

				});
				
				//Enregistrer une adresse
				$("#adresse").on("click", function(){
					
					var t = $("#tel").val();
					var r = $("#rue").val();
					var a = $("#appartement").val();
					var v = $("#ville").val();
					var p = $("#province").val();
					var cp = $("#codePostal").val();
					//Vérifications des champs vides
					if(t == '' || r == '' || v == '' || p == '' || cp == '' ){
						$("#adresse-erreur").html('Veuillez remplir les champs en rouge');
						$('#msgError').show();
						if(t == ''){
							$("#tel").css({ "border-color": "red" });
						}
						else{
							$("#tel").css({ "border-color": "#CCCCCC" });
						}
						if(r == ''){
							$("#rue").css({ "border-color": "red" });
						}
						else{
							$("#rue").css({ "border-color": "#CCCCCC" });
						}
						if(v == ''){
							$("#ville").css({ "border-color": "red" });
						}
						else{
							$("#ville").css({ "border-color": "#CCCCCC" });
						}
						if(p == ''){
							$("#province").css({ "border-color": "red" });
						}
						else{
							$("#province").css({ "border-color": "#CCCCCC" });
						}
						if(cp == ''){
							$("#codePostal").css({ "border-color": "red" });
						}
						else{
							$("#codePostal").css({ "border-color": "#CCCCCC" });
						}
					}
					else{
						var xhr = new XMLHttpRequest();
						xhr.open("POST", "ajaxControler.php?requete=adresse", true);
						//telephone	rue	appartement	ville	code_postal	province
						var req = "telephone=" + t + "&rue=" + r + "&appartement=" + a + "&ville=" + v + "&province=" + p + "&code_postal=" + cp;
						xhr.onreadystatechange = function() {
							if (xhr.status == 200 && xhr.readyState == xhr.DONE) {
								var str = xhr.responseText;
								if(str.length < 100){
									//$('#ShippingAddress').html();
									$("#adresse-erreur").html(xhr.responseText);
									$('#msgError').show();
								}
								else{
									$('#msgError').hide();
									$('#ShippingAddress').html(xhr.responseText);
								}
							}
						};
						xhr.setRequestHeader("Content-type","application/x-www-form-urlencoded");
						xhr.send(req);
					}
				});
				//Suppression d'adresse
				console.log($('[name="supprimer"]'));
				
				$('[name="supprimer"]').on("click", function(e){
					console.log(e);
					var xhr = new XMLHttpRequest();
					var name = e.currentTarget.id;
					//console.log(name.substr(10));
					var adrId = name.substr(10);
					var req = "id_adresse=" + adrId;
					xhr.open("POST", "ajaxControler.php?requete=supprimerAdresse", true);
					xhr.onreadystatechange = function() {
						if (xhr.status == 200 && xhr.readyState == xhr.DONE) {
							var str = xhr.responseText;
							if(str.length < 100){
								//$('#ShippingAddress').html();
								$("#supprimerAdresse-erreur").html(xhr.responseText);
							}
							else{
								$('#msgError').hide();
								$('#ShippingAddress').html(xhr.responseText);
							}
						}
					};
					xhr.setRequestHeader("Content-type","application/x-www-form-urlencoded");
					xhr.send(req);
				});
			});	
		</script>

			<div id="ShippingAddress" method="POST" action="#">
				<div class="panel-group" id="accordion">
					<div class="panel panel-default">
						<div class="panel-heading">
							<h4 class="panel-title">
								<a data-toggle="collapse" data-parent="#accordion" href="#collapseOne">
									Options d'adresses de livraison
								</a>
							</h4>
							<?php 
								if(isset($_SESSION['usager'])) {
									echo '<input name="courriel" type="hidden" value="'.$_SESSION['usager'].'">';
								}
								else{
									echo '<input name="courriel" type="hidden" value="invalide">';
								}
								?>
						</div>
						
						<div id="collapseOne" class="panel-collapse collapse in">
							<div class="panel-body">
								<div class="row adresses">
								<?php
									if($data != ''){
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
													<button name="supprimer" id="supprimer_<?php echo $data[$i]['id_adresse']; ?>" class="btn btn-default btn-xs supprimerAdresse" type="button">
				                    <span class="glyphicon glyphicon-remove"></span>
				                  </button>
												</article>
											<?php
										}
									}
									else{
										?>
										<div class="alert alert-danger">
												<span id="supprimerAdresse-erreur">Aucune adresse associée à ce courriel</span>
										</div>
										<?php
									}
								?>		
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
										<div id="msgError"><!-- Message d'error de télechargement ou autre -->
											<div class="alert alert-danger">
												<span id="adresse-erreur"></span>
											</div>
										</div>
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
					
					<button name="pay" id="confirmationAdresses" class="btn btn-lg btn-primary" type="button" disabled="disabled">Continuer</button>
				
				</div>
			</form>
<?php
		
	}

}
?>