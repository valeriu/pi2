<?php
/**
 * Class Vue Pages
 * Template de classe Vue Pages.
 * 
 * @author Valeriu Tihai
 * 
 */


class VuePages {

	/**
	 * Affiche un page Front End 
	 * 
	 */
	public function afficherPage() {	?>
		o pagina
	<?php }
	
	public function ajouterPageAdmin() {	?>
		<div class="panel panel-default">
			<!-- Default panel contents -->
			<div class="panel-heading">Ajouter ou modifier une page</div>
			<div class="panel-body">
			<!-- Form Edit pages-->
				<form role="form">
					<div class="form-group">
						<label for="page-title">Titre</label>
						<input type="text" class="form-control" id="page-title" placeholder="Enter Title">
					</div>
					<div class="form-group">
						<label for="page-description">Description</label>
						<textarea class="form-control" rows="3" id="page-description" placeholder="Meta Description"></textarea>
						<p class="help-block">Description du lien, celle-ci apparaît souvent dans les recherches Google. <code>&lt;meta name="description" content=""&gt;</code></p>
					</div>
					<div class="form-group">
						<label for="page-contenu">Contenu</label>
						<textarea class="form-control" rows="18" id="page-contenu" placeholder="Page contenu"></textarea>
					</div>
					<div class="form-group">
						<label for="page-contenu">Statut de la page</label>
						<div class="radio">
							<label>
								<input type="radio" name="optionsRadios" id="optionsRadios1" value="publie" checked>
								<span class="label label-success">Publié</span>
							</label>
						</div>
						<div class="radio">
							<label>
								<input type="radio" name="optionsRadios" id="optionsRadios2" value="draft">
								<span class="label label-warning">Brouillon</span>
							</label>
						</div>
						<div class="radio">
							<label>
								<input type="radio" name="optionsRadios" id="optionsRadios3" value="desactive">
								<span class="label label-danger">Privé</span>
							</label>
						</div>
					</div>

					<div class="checkbox">
						<label>
							<input type="checkbox">Page aura une carte.
						</label>
					</div>
					<div id="pagemap">
						<div class="form-group">
							<label for="page-latitudes">Latitudes</label>
							<input type="text" class="form-control" id="page-latitudes" placeholder="Enter Latitudes">
						</div>
						<div class="form-group">
							<label for="page-longitudes">Longitudes</label>
							<input type="text" class="form-control" id="page-longitudes" placeholder="Enter Longitudes">
						</div>
					</div>
					<div class="form-group">
						<label for="page-date">Date</label>
						<input type="text" class="form-control" id="page-date" value="Jeudi 11 octobre 2013, 16:03" disabled>
					</div>
					<div class="form-group">
						<button type="submit" class="btn btn-primary" data-loading-text="Sauvegardez...">Soumettre</button>
					</div>
					<div class="btn-group" data-toggle="buttons">
				</form>		<!-- /Form Edit pages-->
			</div>
			</div><!--end panel-->
		  </div>
	<?php }
	public function afficherListAdmin() {	?>
		<div class="panel panel-default">
			<!-- Default panel contents -->
			<div class="panel-heading">Toutes les pages<span class="badge pull-right">8</span><div> <a href="edition-pages.html">Ajouter une page</a></div></div>
			<div class="panel-body">
			<p>Les pages offrent en générale des informations intemporelles sur le site, en plus des pages habituelles comme "Contact" ou "À Propos" on y retrouve souvent  des ppages comme "Droits d'auteur", "Informations sur la compagnie" ou "Conditions d'utilisations".</p>
			</div>

			<!-- Table pages-->
			<table class="table table-hover">
				<thead>
				  <tr>
					<th>#</th>
					<th>Titre</th>
					<th>Date</th>
					<th>Statut</th>
				  </tr>
				</thead>
				<tbody>
				  <tr>
					<td><a href="../frontend/page-static.html" target="_blank" title="Preview Changes">1</a></td>
					<td><a href="edition-pages.html" title="Edit: A popos">A popos</a></td>
					<td>2013/11/22</td>
					<td><span class="label label-success">Publié</span></td>
				  </tr>
				  <tr>
					<td><a href="../frontend/page-static.html" target="_blank" title="Preview Changes">2</a></td>
					<td><a href="edition-pages.html" title="Edit: Contact">Contact</a></td>
					<td>2013/11/25</td>
					<td><span class="label label-warning">Brouillon</span></td>
				  </tr>
				  <tr>
					<td><a href="../frontend/page-static.html" target="_blank" title="Preview Changes">3</a></td>
					<td><a href="edition-pages.html" title="Edit: Politique de confidentialité">Politique de confidentialité</a></td>
					<td>2013/12/15</td>
					<td><span class="label label-danger">Privé</span></td>
				  </tr>
				  <tr>
					<td><a href="../frontend/page-static.html" target="_blank" title="Preview Changes">5</a></td>
					<td><a href="edition-pages.html" title="Edit: Accord d’utilisation du site Web">Accord d’utilisation du site Web</a></td>
					<td>2013/12/15</td>
					<td><span class="label label-success">Publié</span></td>
				  </tr>
				  <tr>
					<td><a href="../frontend/page-static.html" target="_blank" title="Preview Changes">8</a></td>
					<td><a href="edition-pages.html" title="Edit: Copyright">Copyright</a></td>
					<td>2013/12/15</td>
					<td><span class="label label-success">Publié</span></td>
				  </tr>
				  <tr>
					<td><a href="../frontend/page-static.html" target="_blank" title="Preview Changes">6</a></td>
					<td><a href="edition-pages.html" title="Edit:Company Information">Informations</a></td>
					<td>2013/12/15</td>
					<td><span class="label label-danger">Privé</span></td>
				  </tr>
				  <tr>
					<td><a href="../frontend/page-static.html" target="_blank" title="Preview Changes">9</a></td>
					<td><a href="edition-pages.html" title="Edit: Accessibility Statement">Conditions d'utilisations</a></td>
					<td>2013/12/15</td>
					<td><span class="label label-success">Publié</span></td>
				  </tr>
				  <tr>
					<td><a href="../frontend/page-static.html" target="_blank" title="Preview Changes">10</a></td>
					<td><a href="edition-pages.html" title="Edit: Reprint Permissions">Permissions</a></td>
					<td>2013/12/15</td>
					<td><span class="label label-danger">Supprimée</span></td>
				  </tr>
				</tbody>
			  </table><!-- end table-->
			</div><!--end panel-->
	<?php }
}
?>