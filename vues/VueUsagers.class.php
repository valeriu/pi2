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
				<form class="form-signin" method="post">
					<a  name="formEnregistrer" id="formEnregistrer" class="btn btn-md btn-lien" type="button">S'enregistrer</a>
					<a  name="formConnecter" id="formConnecter" class="btn btn-md btn-lien" type="button">Se connecter</a>
				</form>			
			</section>
		</article>
		
		
		
<?php
	}

	public function afficherFormDeconnexion() {
?>
			<section id="usager" class="pull-right">
				<form class="form-signin" action="index.php?requete=deconnecter" method="post">
					<a name="deconnecter" id="deconnecter" class="btn btn-lg btn-lien" type="button">Déconnexion</a>
				</form>			
			</section>
		</article>
<?php
	}

	
	public function afficherModalConnexion() {

		$html =	'<div class="modal-header">
			        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
			        <h4 class="modal-title" id="myModalLabel">Se connecter</h4>
			    </div>
		      	<div class="modal-body">
					<form class="form-signin" name="form-usager-connecter" action="ajaxControler.php?requete=connecter">
						<div class="input-group input-group-sm">
							Courriel:
							<input name="courriel" type="email" class="form-control" required>
						</div>
						<div class="input-group input-group-sm">
							Mot de Passe:
							<input name="mot_passe" type="password" class="form-control" required>
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
						xhr.open("GET", "ajaxControler.php?requete=motpasse, true);	
						xhr.onreadystatechange = function() {
							if (xhr.status == 200 && xhr.readyState == xhr.DONE) {
								/*clearTimeout(timeout);*/
								console.log(xhr.responseText);
								$(\'[name="modal-content"]\').html(xhr.responseText);
								$(\'#myModal\').modal(\'show\');
							}
						};
						xhr.send();
					});
					//Connexion
					$("#connexion").on("click", function(){
						var xhr = new XMLHttpRequest();
						xhr.open("GET", "ajaxControler.php?requete=connecter, true);	
						xhr.onreadystatechange = function() {
							if (xhr.status == 200 && xhr.readyState == xhr.DONE) {
								/*clearTimeout(timeout);*/
								console.log(xhr.responseText);
								$(\'[name="modal-content"]\').html(xhr.responseText);
								$(\'#myModal\').modal(\'show\');
							}
						};
						xhr.send();
					});
			    <script>';	

		return $html;
		
	}


	public function afficherModalEnregistrer() {

		
		$html =	'<div class="modal-header">
			        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
			        <h4 class="modal-title" id="myModalLabel">Entrez les informations suivantes</h4>
			    </div>
		      	<div class="modal-body">
					<form class="form-signin" name="form-usager-enregistrer" action="ajaxControler.php?requete=enregistrer">
						<div class="input-group input-group-sm">
							Nom, Prénom:
							<input name="nom" type="text" class="form-control"  required>
						</div>
						<div class="input-group input-group-sm">
							Courriel:
							<input name="courriel" type="email" class="form-control" required>
						</div>
						<div class="input-group input-group-sm">
							Mot de Passe:
							<input name="mot_passe" type="password" class="form-control" required>
						</div>
						<br>
						<button name="enregistrer" id="enregistrer" class="btn btn-primary" type="submit">Confirmer</button>
						<br>
					</form>
		      	</div>
			    <div class="modal-footer">
			    </div>
			    <script>
			    	//Enregistrement
			    	$("#enregistrer").on("click", function(){
						var xhr = new XMLHttpRequest();
						xhr.open("GET", "ajaxControler.php?requete=enregistrer, true);	
						xhr.onreadystatechange = function() {
							if (xhr.status == 200 && xhr.readyState == xhr.DONE) {
								/*clearTimeout(timeout);*/
								console.log(xhr.responseText);
								$(\'[name="modal-content"]\').html(xhr.responseText);
								$(\'#myModal\').modal(\'show\');
							}
						};
						xhr.send();
					});
			    <script>';	

		return $html;	
	}


	public function afficherModalAdresse() {
	
		$html = '<div class="modal-header">	
			        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
			        <h4 class="modal-title" id="myModalLabel">Complétez toutes les informations suivantes</h4>
			    </div>
		      	<div class="modal-body">
					<form class="form-signin" name="form-usager-adresse" action="ajaxControler.php?requete=enregistrer">
						<!-- telephone	rue	appartement	ville	code_postal	province -->
						<div class="input-group input-group-sm">
							Téléphone
							<input name="tel" type="tel" class="form-control" required>
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
						xhr.open("GET", "ajaxControler.php?requete=adresse, true);	
						xhr.onreadystatechange = function() {
							if (xhr.status == 200 && xhr.readyState == xhr.DONE) {
								/*clearTimeout(timeout);*/
								console.log(xhr.responseText);
								$(\'[name="modal-content"]\').html(xhr.responseText);
								$(\'#myModal\').modal(\'show\');
							}
						};
						xhr.send();
					});
			    <script>';	

		return $html;	    
		
	}	

	public function afficherModalMotPasse() {
		$html = '<div class="modal-header">
			        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
			        <h4 class="modal-title" id="myModalLabel">Se connecter</h4>
			    </div>
		      	<div class="modal-body">
					<form class="form-signin" name="form-usager-connecter" action="ajaxControler.php?requete=connecter">
						<div class="input-group input-group-sm">
							Courriel:
							<input name="courriel" type="email" class="form-control" required>
						</div>
						<button name="motpasse" id="motpasse" class="btn btn-primary" type="button">Soumettre</button>
						<br>	
					</form>
		      	</div>
			    <div class="modal-footer">
			    </div>
			    <script>
			    	//Envoie d un nouveau mot de passe
			    	$("#adresse").on("click", function(){
						var xhr = new XMLHttpRequest();
						xhr.open("GET", "ajaxControler.php?requete=motpasse, true);	
						xhr.onreadystatechange = function() {
							if (xhr.status == 200 && xhr.readyState == xhr.DONE) {
								/*clearTimeout(timeout);*/
								console.log(xhr.responseText);
								$(\'[name="modal-content"]\').html(xhr.responseText);
								$(\'#myModal\').modal(\'show\');
							}
						};
						xhr.send();
					});
			    <script>';	
	}

	
}
?>