<?php
 /**
 * Description of vueUsagers
 * La vue qui affiche les formulaire d'inscriptions
 *
 * @author Luc Cinq-Mars
 */


class VueUsagers {

	/**
	 * Affiche la page d'accueil 
	 * @access public
	 * 
	 */
	public function afficherFormUsagers() {
	?>
		<form class="form-signin">
			<button name="enregistrer" id="enregistrer" class="btn btn-lg btn-lien" type="button">S'enregistrer</button>
			<button name="connecter" id="connecter" class="btn btn-lg btn-lien" type="button">Se connecter</button>
		</form>
		
		<div id="connecterDiv">
			<form class="form-signin" name="form-usager-connecter" action="ajaxControler.php?requete=connexion">
				<div class="input-group input-group-sm">
					Courriel:
					<input name="courriel" type="email" class="form-control" required>
				</div>
				<div class="input-group input-group-sm">
					Mot de Passe:
					<input name="password" type="password" class="form-control" required>
				</div>
				<a name="motPasseOublie" id="motPasseOublie" href="#">Mot de passe oublié?</a>
				<br>
				<button name="connexion" id="connexion" class="btn btn-primary" type="button">Connexion</button>
				<br>
			</form>
			<!--<div id="infosConnecter">
				<h1>Bienvenue sur le site de Wadagbé!</h1>
				<a name="completerInfos" href="completerInfos.html">Compléter les informations du compte</a>
			</div>-->
		</div>
		
		<div id="enregistrerDiv">
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
					<input name="password" type="password" class="form-control" required>
				</div>
				<button name="confirmer" id="confirmer" class="btn btn-primary" type="button">Confirmer</button>
				<br>
			</form>
			<!--<div id="infosEnregistrer">
				<h1>Bienvenue sur le site de Wadagbé!</h1>
				<a name="completerInfos" href="completerInfos.html">Compléter les informations du compte</a>
			</div>	-->
		</div>
		
		<div id="motPasseOublieDiv">
			<form class="form-signin" name="form-usager-oublie" action="ajaxControler.php?requete=motPasse">
				<div class="input-group input-group-sm">
					Courriel:
					<input name="courriel" type="email" class="form-control" required>
				</div>
				<button name="envoyer" id="envoyer" class="btn btn-primary" type="button">Envoyer</button>
			</form>	
			<!--<div id="courrielEnvoye">
				<h1>Un courriel avec un mot de passe temporaire vous a été envoyé.</h1>
			</div>-->
		</div>
	<?php
	}
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