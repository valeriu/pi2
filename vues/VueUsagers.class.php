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
					<a  name="formEnregistrer" id="formEnregistrer" class="btn btn-lg btn-lien" type="button">S'enregistrer</a>
					<a  name="formConnecter" id="formConnecter" class="btn btn-lg btn-lien" type="button">Se connecter</a>
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
						<a name="motPasseOublie" id="motPasseOublie" href="ajaxControler.php?requete=motpasse">Mot de passe oublié?</a>
						<br>
						<button name="Connexion" id="Connexion" class="btn btn-primary" type="submit">Connexion</button>
						<br>
					</form>
		      	</div>
			    <div class="modal-footer">
			    </div>';	

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
			    </div>';

		return $html;	
	}


	public function afficherModalAdresse() {
?>
	
    	<div class="modal-header">
	        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
	        <h4 class="modal-title" id="myModalLabel">Complétez les informations suivantes</h4>
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
				<button name="soumettre" id="soumettre" class="btn btn-primary" type="submit">Soumettre</button>
				<br>	
			</form>
      	</div>
	    <div class="modal-footer">
	    </div>
		    		
<?php
		
	}	

	
}
?>