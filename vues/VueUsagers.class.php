<?php
 /**
 * Description of vueUsagers
 * La vue qui affiche les formulaire d'inscriptions ou les modals
 *
 * @author Luc Cinq-Mars
 */


class VueUsagers {

	
	public function afficherFormUsagers() {
?>
			<section id="usager" class="pull-right">
				<form class="form-signin form-usager" method="post">
					<a  name="formEnregistrer" id="formEnregistrer" class="btn btn-md btn-lien" type="button">S'enregistrer</a>
					<a  name="formConnecter" id="formConnecter" class="btn btn-md btn-lien" type="button">Se connecter</a>
				</form>			
			</section>
			<script>
				$("#formEnregistrer").on("click", clickEnregistrer);

				$('#formConnecter').on('click', clickConnecter);
			</script>
<?php
	}

	public function afficherFormDeconnexion() {
?>
			<section id="usager" class="pull-right">
				<form class="form-signin form-usager" action="index.php?requete=deconnecter" method="post">
					<a name="deconnecter" id="deconnecter" class="btn btn-md btn-lien" type="button">Déconnexion</a>
				</form>			
			</section>
		
<?php
	}

	
	public function afficherModalConnexion() {
		$html =	'<div class="modal-header">
			        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
			        <h4 class="modal-title" id="myModalLabel">Se connecter</h4>
			    </div>
		      	<div class="modal-body">
					<form class="form-signin" name="form-usager-connecter">
						<div class="input-group input-group-sm">
							Courriel:
							<input name="courriel" id="courriel" type="email" class="form-control" required>
						</div>
						<div class="input-group input-group-sm">
							Mot de Passe:
							<input name="mot_passe" id="mot_passe" type="password" class="form-control" required>
						</div>
						<button name="motPasseOublie" id="motPasseOublie" type="button">Mot de passe oublié</a>
						<br>
						<button name="connexion" id="connexion" class="btn btn-primary" type="button">Connexion</button>
						<br>
					</form>
		      	</div>
			    <div class="modal-footer">
			    </div>
			    <script>
			    	//Mot de passe oublie
			    	$("#motPasseOublie").on("click", function(){
						var xhr = new XMLHttpRequest();
						xhr.open("GET", "ajaxControler.php?requete=formMotPasse", true);	
						xhr.onreadystatechange = function() {
							if (xhr.status == 200 && xhr.readyState == xhr.DONE) {
								$(".modal-content").html(xhr.responseText);
							}
						};
						xhr.send();
					});
					//Connexion
					$("#connexion").on("click", function(){
						var xhr = new XMLHttpRequest();
						var m = $("#courriel").val();
						var p = $("#mot_passe").val();
						xhr.open("POST", "ajaxControler.php?requete=connecter", true);
						var req = "courriel=" + m + "&mot_passe=" + p;
						xhr.onreadystatechange = function() {
							if (xhr.status == 200 && xhr.readyState == xhr.DONE) {
								//clearTimeout(timeout);
								$("#usager").replaceWith(xhr.responseText);
								$("#deconnecter").on("click", clickDeconnecter);
								$("#myModal").modal("hide");
							}
						};
						xhr.setRequestHeader("Content-type","application/x-www-form-urlencoded");
						xhr.send(req);
					});
			    </script>';	

		return $html;
		
	}


	public function afficherModalEnregistrer() {

		
		$html =	'<div class="modal-header">
			        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
			        <h4 class="modal-title" id="myModalLabel">Entrez les informations suivantes</h4>
			    </div>
		      	<div class="modal-body">
					<form class="form-signin" name="form-usager-enregistrer" >
						<div class="input-group input-group-sm">
							Nom, Prénom:
							<input id="nom" name="nom" type="text" class="form-control"  required>
						</div>
						<div class="input-group input-group-sm">
							Courriel:
							<input id="courriel" name="courriel" type="email" class="form-control" required>
						</div>
						<div class="input-group input-group-sm">
							Mot de Passe:
							<input id="mot_passe" name="mot_passe" type="password" class="form-control" required>
						</div>
						<br>
						<button name="enregistrer" id="enregistrer" class="btn btn-primary" type="button">Confirmer</button>
						<br>
					</form>
		      	</div>
			    <div class="modal-footer">
			    </div>
			    <script>
			    	//Enregistrement
			    	$("#enregistrer").on("click", function(){
						var xhr = new XMLHttpRequest();
						var n = $("#nom").val();
						var m = $("#courriel").val();
						var p = $("#mot_passe").val();
						xhr.open("POST", "ajaxControler.php?requete=enregistrer", true);
						var req = "courriel=" + m + "&mot_passe=" + p + "&nom_prenom=" + n;
						xhr.onreadystatechange = function() {
							if (xhr.status == 200 && xhr.readyState == xhr.DONE) {
								//clearTimeout(timeout);
								$("#usager").replaceWith(xhr.responseText);
								$("#deconnecter").on("click", clickDeconnecter);
								$("#myModal").modal("hide");
							}
						};
						xhr.setRequestHeader("Content-type","application/x-www-form-urlencoded");
						xhr.send(req);
					});
			    </script>';	

		return $html;	
	}


	public function afficherModalAdresse() {
	
		$html = '<div class="modal-header">	
			        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
			        <h4 class="modal-title" id="myModalLabel">Complétez toutes les informations suivantes</h4>
			    </div>
		      	<div class="modal-body">
					<form class="form-signin" name="form-usager-adresse" >
						<!-- telephone	rue	appartement	ville	code_postal	province -->
						<div class="input-group input-group-sm">
							Téléphone
							<input id="tel" name="tel" type="tel" class="form-control" required>
						</div>
						<div class="input-group input-group-sm">
							Rue:
							<input id="rue" name="rue" type="text" class="form-control" required>
						</div>
						<div class="input-group input-group-sm">
							Appartement:
							<input id="appartement" name="appartement" type="text" class="form-control">
						</div>
						<div class="input-group input-group-sm">
							Ville:
							<input id="ville" name="ville" type="text" class="form-control" required>
						</div>
						<div class="input-group input-group-sm">
							Province:
							<input id="province" name="province" type="text" class="form-control" required>
						</div>
						<div class="input-group input-group-sm">
							Code postal:
							<input id="codePostal" name="codePostal" type="text" class="form-control" required>
						</div>
						<button name="adresse" id="adresse" class="btn btn-primary" type="button">Soumettre</button>
						<br>	
					</form>
		      	</div>
			    <div class="modal-footer">
			    </div>
			    <script>
			    	//Enregistrement de l adresse
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
								//clearTimeout(timeout);
								$(".modal-content").html(xhr.responseText);
							}
						};
						xhr.setRequestHeader("Content-type","application/x-www-form-urlencoded");
						xhr.send(req);
					});
			    </script>';	

		return $html;	    
		
	}	

	public function afficherModalMotPasse() {
		$html = '<div class="modal-header">
			        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
			        <h4 class="modal-title" id="myModalLabel">Se connecter</h4>
			    </div>
		      	<div class="modal-body">
					<form class="form-signin" name="form-usager-connecter" >
						<div class="input-group input-group-sm">
							Courriel:
							<input id="courriel" name="courriel" type="email" class="form-control" required>
						</div>
						<button name="motpasse" id="motpasse" class="btn btn-primary" type="button">Soumettre</button>
						<br>	
					</form>
		      	</div>
			    <div class="modal-footer">
			    </div>
			    <script>
			    	//Envoie d un nouveau mot de passe
			    	$("#motpasse").on("click", function(){
						var xhr = new XMLHttpRequest();
						var m = $("#courriel").val();
						xhr.open("POST", "ajaxControler.php?requete=motpasse", true);
						var req = "courriel=" + m;
						xhr.onreadystatechange = function() {
							if (xhr.status == 200 && xhr.readyState == xhr.DONE) {
								if(xhr.responseText == "Un courriel avec la marche à suivre vous a été envoyé"){
									$(".modal-content").html(xhr.responseText);
								}
								else{
									var p = "<p>" + xhr.responseText + "</p>";
									$(".modal-body").prepend(p);
								}
								
							}
						};
						xhr.setRequestHeader("Content-type","application/x-www-form-urlencoded");
						xhr.send(req);
					});
			    </script>';	

		return $html;	    
	}

	
}
?>