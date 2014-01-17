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
					<a  name="formEnregistrer"  id="formEnregistrer" class="btn btn-md btn-lien" type="button">S'enregistrer</a>
					<a  name="formConnecter"  id="formConnecter" class="btn btn-md btn-lien" type="button">Se connecter</a>
				</form>			
			</section>
			<script>
				$(function(){
					$("#formEnregistrer").on("click", clickEnregistrer);
					$("#formConnecter").on("click", clickConnecter);
				//Si on est dans le panier et non-connecté
					$("#confirmer").on("click", clickConnecter); 
				});
			
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
			<script>
				$(function(){
					$("#confirmer").off("click", clickConnecter);
					$("#deconnecter").on("click", clickDeconnecter);
					$("#confirmer").on("click", confirmerCommande);
				});	
			</script>
		
<?php
	}

	
	public function afficherModalConnexion() {
		$html =	'<div class="modal-header">
			        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
			        <h4 class="modal-title" id="myModalLabel">Se connecter</h4>
			    </div>
		      	<div class="modal-body">
						<p id="modal-erreur"></p>
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
								//$(".modal-content").html(xhr.responseText);
								var str = xhr.responseText;
								if(str.length > 100){
									$(".modal-content").html(xhr.responseText);
								}
								else{
									$("#modal-erreur").html(xhr.responseText);
								}
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
								var str = xhr.responseText;
								if(str.length > 100){
									$("#usager").replaceWith(xhr.responseText);
									$("#deconnecter").on("click", clickDeconnecter);
									$("#myModal").modal("hide");
								}
								else{
									$("#modal-erreur").html(xhr.responseText);
								}
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
						<p id="modal-erreur"></p>
					<form class="form-signin" name="form-usager-enregistrer" >
						<div class="input-group input-group-sm">
							Nom, Prénom:
							<input id="nom" name="nom" type="text" class="form-control"  required placeholder="Nom, Prénom">
						</div>
						<div class="input-group input-group-sm">
							Courriel:
							<input id="courriel" name="courriel" type="email" class="form-control" required placeholder="Ex@ex.com">
						</div>
						<div class="input-group input-group-sm">
							Mot de Passe:
							<input id="mot_passe" name="mot_passe" type="password" class="form-control" required placeholder="Entre 6 et 12 caractère">
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
								var str = xhr.responseText;
								//console.log(str.length);
								if(str.length > 100){
									$("#usager").replaceWith(xhr.responseText);
									$("#deconnecter").on("click", clickDeconnecter);
									$("#myModal").modal("hide");
								}
								else{
									$("#modal-erreur").html(xhr.responseText);
								}
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
						<p id="modal-erreur"></p>
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
							<div class="btn-group row " data-toggle="buttons">
								<label class="btn btn-default" title="Québec">
									<input type="radio" name="province" id="option1" value="qc"> Qc
								</label>
								<label class="btn btn-default" title="Ontario">
									<input type="radio" name="province" id="option2" value="on"> On
								</label>
								<label class="btn btn-default" title="Manitoba">
									<input type="radio" name="province" id="option3" value="mn"> Mn
								</label>
								<label class="btn btn-default" title="Saskatchewan">
									<input type="radio" name="province" id="option4" value="sk"> Sk
								</label>
								<label class="btn btn-default" title="Colombie-Britannique">
									<input type="radio" name="province" id="option5" value="cb"> Cb
								</label>
								<label class="btn btn-default" title="Nouveau-Brunswick">
									<input type="radio" name="province" id="option6" value="nb"> Nb
								</label>
								<label class="btn btn-default" title="Nouvelle-Écosse">
									<input type="radio" name="province" id="option7" value="ne"> Ne
								</label>
								<label class="btn btn-default" title="Île-du-Prince-Édouard">
									<input type="radio" name="province" id="option7" value="ie"> Ie
								</label>
								<label class="btn btn-default" title="Alberta">
									<input type="radio" name="province" id="option8" value="al"> Al
								</label>
								<label class="btn btn-default" title="Terre-Neuve">
									<input type="radio" name="province" id="option9" value="tn"> Tn
								</label>
								<label class="btn btn-default" title="Territoire du Nord-Ouest">
									<input type="radio" name="province" id="option9" value="no"> No
								</label>
								<label class="btn btn-default" title="Yukon">
									<input type="radio" name="province" id="option10" value="yk"> Yk
								</label>
								<label class="btn btn-default" title="Nunavut">
									<input type="radio" name="province" id="option11" value="nv"> Nv
								</label>
							</div>
						</div>	
						<div class="input-group input-group-sm">
							Code postal:
							<input id="codePostal" name="codePostal" type="text" class="form-control" required placeholder="X1X 1X1">
						</div>
						<button name="adresse" id="adresse" class="btn btn-primary" type="button">Soumettre</button>
						<br>	
					</form>
		      	</div>
			    <div class="modal-footer">
			    </div>
			    <script>
			    	//Enregistrement de l adresse
			    	/*$("#adresse").on("click", function(){
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
								if(xhr.responseText == "Nouvelle adresse enregistrée"){
									$(".modal-content").html(xhr.responseText);
								}
								else{
									$("#modal-erreur").html(xhr.responseText);
								}
							}
						};
						xhr.setRequestHeader("Content-type","application/x-www-form-urlencoded");
						xhr.send(req);
					});*/
			    </script>';	

		return $html;	    
		
	}	

	public function afficherModalMotPasse() {
		$html = '<div class="modal-header">
			        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
			        <h4 class="modal-title" id="myModalLabel">Se connecter</h4>
			    </div>
		      	<div class="modal-body">
						<p id="modal-erreur"></p>
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
									var erreur = "<p>" + xhr.responseText + "</p>";
									$("#modal-erreur").html(erreur);
								}
								
							}
						};
						xhr.setRequestHeader("Content-type","application/x-www-form-urlencoded");
						xhr.send(req);
					});
			    </script>';	

		return $html;	    
	}

	
	public function afficherListeUsagersAdmin($aDonneesUsagers, $aDonneesPaginator, $partir, $fin) {	
			//var_dump($aDonneesUsagers);
			$nomberUsager = count($aDonneesUsagers);
			//print_r($data);
			$htmlPage = "";
			$htmlPagination = "";
			
			$htmlPagination .= "<!--Pagination-->	<ul class=\"pagination\">";
				foreach($aDonneesPaginator as $page){
					$htmlPagination .= "<li><a href='adminka.php?requete=liste_usagers&partir={$page["partir"]}&fin={$page["fin"]}'>{$page["page"]}</a></li>";
				}
			$htmlPagination .= "</ul>";
			
			$fin = min($fin, $nomberUsager);
			
			for ($i=$partir, $j=$fin; $i<$j; $i++){
				$htmlPage .= "<tr>\r\n";
					//ID
					$htmlPage .= "<td>{$aDonneesUsagers[$i]["id_utilisateurs"]}</td>\r\n";
					//NOM
					$htmlPage .= "<td><a href='adminka.php?requete=details_usager&id_utilisateurs={$aDonneesUsagers[$i]["id_utilisateurs"]}'>{$aDonneesUsagers[$i]["nom_prenom"]}</a></td>\r\n";
					//COURRIEL
					$htmlPage .= "<td>{$aDonneesUsagers[$i]["courriel"]}</td>\r\n";
					//STATUT
					switch ($aDonneesUsagers[$i]["statut"]) {
						case 1: // Actif
							$htmlPage .= "<td><span class=\"label label-success\">Actif</span></td>";
							break;
						case 2: // Supprimé
							$htmlPage .= "<td><span class=\"label label-danger\">Supprimé</span></td>";
							break;
					}
				$htmlPage .= "</tr>\r\n";
			}
				//var_dump($tousPages);

		?>
				 
		<div class="panel panel-default">
			<!-- Default panel contents -->
			<div class="panel-heading">Liste des usagers<span class="badge pull-right"><?php echo $nomberUsager;?></span>
			</div>
			<div class="panel-body">
				Vous pouvez regarder le détails d'un usager en cliquant sur son nom.
			</div>
			<!-- Table pages-->
			<table class="table table-hover">
				<thead>
				  <tr>
						<th>Id</th>
						<th>Nom, Prénom</th>
						<th>Courriel</th>
						<th>Statut</th>
				  </tr>
				</thead>
				<tbody>
				  <?php echo $htmlPage; ?>
				</tbody>
			  </table><!-- end table-->
			</div><!--end panel-->
			
			
			<?php echo $htmlPagination; ?>
			
	<?php 
	}

	public function detailsUsagerAdmin($aUsager, $aAdresses, $msg = '') {
		//print_r($result);
		?>
		
		<div class="panel panel-default">
			<!-- Default panel contents -->
			<div class="panel-heading">Modifier les informations d'un usager</div>
			<div class="panel-body">
			<?php
				switch ($msg) {
					case 1:
						echo "<div class=\"alert alert-success\"><strong>Bien fait!</strong> Vous avez inséré le détails de la commande dans la base de données avec succès.</div>";
						break;
					case '':
						break;
					default:
						echo "<div class=\"alert alert-danger\">.$msg.</div>";
						break;
				}
			?>
				<!-- Form modif USAGERS-->
				<form role="form" action="adminka.php?requete=modifier_usager&id_utilisateurs=<?php echo $aUsager['id_utilisateurs']; ?>" method="post">
					<div class="form-group">
						<label for="nom_prenom">Nom, Prénom</label>
						<input type="text" class="form-control" name="nom_prenom" value="<?php echo $aUsager['nom_prenom']; ?>">
					</div>
					<div class="form-group">
						<label for="courriel">Courriel</label>
						<input type="text" class="form-control" name="courriel" value="<?php echo $aUsager['courriel']; ?>">
					</div>
					<div class="panel-body">
							<div class="radio">
								<label>
									<input type="radio" name="role" id="0" value="0" <?php echo $nb1 = ($aUsager['role']==0) ? "checked" : "";?>>
									<span class="label label-default">Usager</span>
								</label>
							</div>
							<div class="radio">
								<label>
									<input type="radio" name="role" id="1" value="1" <?php echo $nb1 = ($aUsager['role']==1) ? "checked" : "";?>>
									<span class="label label-default">Administrateur</span>
								</label>
							</div>
							<div class="radio">
								<label>
									<input type="radio" name="role" id="2" value="2" <?php echo $nb1 = ($aUsager['role']==2) ? "checked" : "";?>>
									<span class="label label-default">Super-Administrateur</span>
								</label>
							</div>
						</div>
			<?php		
					for($i = 0; $i < count($aAdresses); $i++){
			?>
						<div class="panel panel-default">
							<div class="panel-heading">Adresse <?php echo $i+1; ?> (id: <?php echo $aAdresses[$i]['id_adresse']; ?>)
							</div>
							<div class="panel-body">
								<p>Téléphone: <?php echo $aAdresses[$i]['telephone']; ?></p>
								<p>Adresse: <?php echo $aAdresses[$i]['rue']; ?><?php echo $app = (isset($aAdresses[$i]['appartement'])) ? " App.".$aAdresses[$i]['appartement'] : ''; ?></p>
								<p>Ville: <?php echo $aAdresses[$i]['ville']; ?></p>
								<p>Province: <?php echo $aAdresses[$i]['province']; ?></p>
								<p>Code Postal: <?php echo $aAdresses[$i]['code_postal']; ?></p>
							</div>
						</div>
			<?php			
					}
					$date = new DateTime();
						
			?>		
					
					<div class="panel panel-default">
						<div class="panel-heading">Changer le statut
						</div>
						<div class="panel-body">
							<div class="radio">
								<label>
									<input type="radio" name="statut" id="1" value="1" <?php echo $nb1 = ($aUsager['statut']==1) ? "checked" : "";?>>
									<span class="label label-success">Actif</span>
								</label>
							</div>
							<div class="radio">
								<label>
									<input type="radio" name="statut" id="2" value="2" <?php echo $nb1 = ($aUsager['statut']==2) ? "checked" : "";?>>
									<span class="label label-danger">Supprimé</span>
								</label>
							</div>
						</div>
					</div>
					
					<div class="form-group">
						<label for="page-date">Date</label>
						<input type="text" class="form-control" id="page-date" value="<?php echo $aUsager['date_entree']; ?>" disabled>
					</div>
					
					<div class="form-group">
						<button type="submit" class="btn btn-primary" >Soumettre les changements</button>
					</div>
				</form>		<!-- /Form Edit USAGERS-->
			</div><!--end panel-body -->	
		</div>
	<?php }
	
	
}
?>