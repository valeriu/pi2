<?php
/**
 * Class Controler Admin
 * Gère les requêtes HTTP
 * 
 * @author Valeriu Tihai
 * 
 */

class ControlerAdmin {
	
		/**
		 * Traite la requête
		 * @return void
		 */
		public function gerer() {
			if(isset($_SESSION['usager'])){
				switch ($_GET['requete']) {
					case 'connexion':
						$this->connexion();
						break;
					case 'deconnexion':
						$this->deconnexion();
						break;	
					case 'page':
						$this->page();
						break;
					case 'page_modifier':
						$this->modifierPage();
						break;				
					case 'page_ajouter':
						$this->ajouterPage();
						break;
					case 'menu':
						$this->menu();
						break;
					case 'menu_modifier':
						$this->modifierMenu();
						break;				
					case 'menu_ajouter':
						$this->ajouterMenu();
						break;		
					case 'commandes':
						$this->commandes();
						break;
					case 'details_commande':
						$this->detailsCommande();
						break;
					case 'modifier_commande':
						$this->modifierCommande();
						break;
					case 'liste_usagers':
						$this->liste_usagers();
						break;
					case 'details_usager':
						$this->details_usager();
						break;	
					case 'modifier_usager':
						$this->modifier_usager();
						break;
					case 'produits':
						$this->produits();
						break;
					case 'ajouter_produit':
						$this->ajouterProduit();
						break;	
					case 'details_produits':
						$this->detailsProduit();
						break;
					case 'modifier_produit':
						$this->modifierProduit();
						break;	
					default:
						$this->connexion();
						break;
				}
			}
			else{
				$this->connexion();
			}
		}
		private function connexion() {
			//var_dump($_POST);
			//var_dump($_SESSION['usager']);
			if(isset($_SESSION['usager'])){
				$this->commandes();
			}
			else{
				if(isset($_POST['courriel']) && isset($_POST['courriel'])){
					try{
						//var_dump($_POST);
						$usager = new Usagers();
						$usager->connecterAdmin($_POST);
						$_SESSION['usager'] = $_POST['courriel'];
						$this->commandes();
					}
					catch(Exception $e){
						$oVueAdmin	= new VueAdmin();
						$oVueAdmin->afficherEntete();
						$oVueAdmin->afficherConnexion($e->getMessage());
						$oVueAdmin->afficherFooter();
					}
				}
				else{
					$oVueAdmin	= new VueAdmin();
					$oVueAdmin->afficherEntete();
					$oVueAdmin->afficherConnexion();
					$oVueAdmin->afficherFooter();
				}
			}
		}
		
		private function deconnexion(){
			session_destroy();
			header('Location: adminka.php');
		}
		/**
		 * Pages
		 */
		private function page() {
			$nb1 = (!empty($_GET['partir'])) ? $_GET['partir'] : 0;
			$nb2 = (!empty($_GET['fin'])) ? $_GET['fin'] : 20;	
			
			$oVueAdmin	= new VueAdmin();
			$oPage = new Pages();
			$tousPages = $oPage->afficherListe();
			
			$pagePagination = new Pagination();
			$aDonnees = array("aTousElements" => $tousPages);
			$pagesPaginator = $pagePagination->paginate($aDonnees);
			$datas = $pagePagination->voirResultats();
			
			$oVueAdmin->afficherEntete();
			$oVueAdmin->afficherToolbar();
			$oVueAdmin->afficherNavigation();
	
			VuePages::afficherListAdmin($tousPages, $pagesPaginator, $nb1, $nb2);
			$oVueAdmin->afficherFinContent();
			$oVueAdmin->afficherFooter();
		}
		/**
		 * Ajouter une page
		 */
		private function ajouterPage() {
			$oVueAdmin	= new VueAdmin();			
			$oVueAdmin->afficherEntete();
			$oVueAdmin->afficherToolbar();
			$oVueAdmin->afficherNavigation();
			$oPage = new Pages();
			$mes="";
			try {
				$result = $oPage->ajouter($_POST);
			} catch (Exception $e) {
				$mes = $e->getMessage();
				$result = FALSE;
			}
			VuePages::ajouterPageAdmin($result, $mes);
			$oVueAdmin->afficherFinContent();
			$oVueAdmin->tinymce("page-contenu");
			$oVueAdmin->afficherFooter();

}
		/**
		 * Modifier une page
		 */
		private function modifierPage() {
			$page_id = (!empty($_GET['page_id'])) ? $_GET['page_id'] : "";
			$aDonnees = array("id_page" => $page_id);
			
			$oVueAdmin	= new VueAdmin();			
			$oVueAdmin->afficherEntete();
			$oVueAdmin->afficherToolbar();
			$oVueAdmin->afficherNavigation();
			$oPage = new Pages();
			try {
				$result = $oPage->modifier($aDonnees, $_POST);
				$courentPage = $oPage->afficher($aDonnees);
				VuePages::modifierPageAdmin($courentPage, $result);
			} catch (Exception $e){
				$courentPage = $oPage->afficher($aDonnees);
				VuePages::modifierPageAdmin($courentPage, $e->getMessage());
			}
			$oVueAdmin->afficherFinContent();
			$oVueAdmin->tinymce("page-contenu");
			$oVueAdmin->afficherFooter();
	}
		/**
		 * Menu
		 */
		private function menu() {
			$nb1 = (!empty($_GET['partir'])) ? $_GET['partir'] : 0;
			$nb2 = (!empty($_GET['fin'])) ? $_GET['fin'] : 20;	
			
			$oVueAdmin	= new VueAdmin();
			$oMenu = new Menu();
			$tousMenu = $oMenu->afficherMenuAdmin();
			
			$pagePagination = new Pagination();
			$aDonnees = array("aTousElements" => $tousMenu);
			$pagesPaginator = $pagePagination->paginate($aDonnees);
			$datas = $pagePagination->voirResultats();
			
			$oVueAdmin->afficherEntete();
			$oVueAdmin->afficherToolbar();
			$oVueAdmin->afficherNavigation();
	
			VueMenu::afficherListMenuAdmin($tousMenu, $pagesPaginator, $nb1, $nb2);
			$oVueAdmin->afficherFinContent();
			$oVueAdmin->afficherFooter();
		}
		
		private function ajouterMenu() {
			$oVueAdmin	= new VueAdmin();			
			$oVueAdmin->afficherEntete();
			$oVueAdmin->afficherToolbar();
			$oVueAdmin->afficherNavigation();
			$oMenu = new Menu();
			$mes="";
			try {
				$result = $oMenu->enregistrer($_POST);
			} catch (Exception $e) {
				$mes = $e->getMessage();
				$result = FALSE;
			}
			VueMenu::ajouterMenuAdmin($result, $mes);
			$oVueAdmin->afficherFinContent();
			$oVueAdmin->afficherFooter();
			
		}
		
		/**
		 * Modifier le menu
		 */
		private function modifierMenu() {
			$menu_id = (!empty($_GET['menu_id'])) ? $_GET['menu_id'] : 0;
			$aDonnees = array("id_menu" => $menu_id);
			$oVueAdmin	= new VueAdmin();			
			$oVueAdmin->afficherEntete();
			$oVueAdmin->afficherToolbar();
			$oVueAdmin->afficherNavigation();
			$oMenu = new Menu();
			try {
				$result = $oMenu->modifier($aDonnees, $_POST);
				$courentMenu = $oMenu->afficherMenuAdminID($aDonnees);
				VueMenu::modifierMenuAdmin($courentMenu, $result);
			} catch (Exception $e) {
				$courentMenu = $oMenu->afficherMenuAdminID($aDonnees);
				VueMenu::modifierMenuAdmin($courentMenu, $e->getMessage());
			}
			$oVueAdmin->afficherFinContent();
			$oVueAdmin->afficherFooter();
			
		}
		
		/**
		 * Liste Usagers
		 */
		private function liste_usagers(){
			$nb1 = (!empty($_GET['partir'])) ? $_GET['partir'] : 0;
			$nb2 = (!empty($_GET['fin'])) ? $_GET['fin'] : 20;	
		
			$oVueAdmin	= new VueAdmin();
			$oUsagers = new Usagers();
			$listeUsagers = $oUsagers->afficherListe();
			
			$pagePagination = new Pagination();
			$aDonnees = array("aTousElements" => $listeUsagers);
			$pagesPaginator = $pagePagination->paginate($aDonnees);
			$datas = $pagePagination->voirResultats();
			
			$oVueAdmin->afficherEntete();
			$oVueAdmin->afficherToolbar();
			$oVueAdmin->afficherNavigation();
			
			VueUsagers::afficherListeUsagersAdmin($listeUsagers, $pagesPaginator, $nb1, $nb2);
			$oVueAdmin->afficherFinContent();
			$oVueAdmin->afficherFooter();
		}
		
		/**
		 * Commandes
		 */
		private function commandes() {
			$nb1 = (!empty($_GET['partir'])) ? $_GET['partir'] : 0;
			$nb2 = (!empty($_GET['fin'])) ? $_GET['fin'] : 20;	
			
			$oVueAdmin	= new VueAdmin();
			$oCommandes = new Commandes_Admin();
			$tousCommandes = $oCommandes->afficherListe();
			
			$pagePagination = new Pagination();
			$aDonnees = array("aTousElements" => $tousCommandes);
			$pagesPaginator = $pagePagination->paginate($aDonnees);
			$datas = $pagePagination->voirResultats();
			
			$oVueAdmin->afficherEntete();
			$oVueAdmin->afficherToolbar();
			$oVueAdmin->afficherNavigation();
	
			VueCommandes::afficherListAdmin($tousCommandes, $pagesPaginator, $nb1, $nb2);
			$oVueAdmin->afficherFinContent();
			$oVueAdmin->afficherFooter();
		}

		/**
		 * Détails d'une commande
		 */
		private function detailsCommande() {
			$commande_id = (!empty($_GET['commande_id'])) ? $_GET['commande_id'] : 0;
			$aDonnees = array("id_commande" => $commande_id);
			try{
				$oCommande = new Commandes_Admin();
				$courentCommande = $oCommande->afficher($aDonnees);
				$result = "2";
			}
			catch(Exception $e){
				echo $e->getMessage();
			}
			$oVueAdmin	= new VueAdmin();		
			$oVueAdmin->afficherEntete();
			$oVueAdmin->afficherToolbar();
			$oVueAdmin->afficherNavigation();
			VueCommandes::detailsCommandesAdmin($courentCommande, $result);
			$oVueAdmin->afficherFinContent();
			$oVueAdmin->tinymce("commande-commentaires");
			$oVueAdmin->afficherFooter();
			//*/
				
			//}		
		}

		/**
		 * Modifier une commande
		 */
		private function modifierCommande() {
			$commande_id = (!empty($_GET['commande_id'])) ? $_GET['commande_id'] : 0;
			$aDonnees = array("id_commande" => $commande_id);
			
			//var_dump($_POST);
			try{
				$oCommande = new Commandes_Admin();
				$result = $oCommande->modifier($_POST);
				//var_dump($result);
				$courentCommande = $oCommande->afficher($aDonnees);
			}
			catch(Exception $e){
				echo $e->getMessage();
			}
			
			$oVueAdmin	= new VueAdmin();			
			$oVueAdmin->afficherEntete();
			$oVueAdmin->afficherToolbar();
			$oVueAdmin->afficherNavigation();
			VueCommandes::detailsCommandesAdmin($courentCommande, $result);
			$oVueAdmin->afficherFinContent();
			$oVueAdmin->tinymce("commande-commentaires");
			$oVueAdmin->afficherFooter();
			//*/
				
			//}*/		

		}
		
		/**
		 * Détails usager
		 */
		private function details_usager($msg = ''){
			$id_utilisateurs = (!empty($_GET['id_utilisateurs'])) ? $_GET['id_utilisateurs'] : '';
			$aDonnees = array("id_utilisateurs" => $id_utilisateurs);
			
			//var_dump($id_utilisateurs);
			//var_dump($aDonnees);
			try{
				$oUsagers = new Usagers();
				$aUsager = $oUsagers->afficher($aDonnees);
				$oAdresse = new Adresse();
				$aAdresses = $oAdresse->afficherAdresseUsager(array('courriel' => $aUsager['courriel']));
				//var_dump($result);
			}
			catch(Exception $e){
				echo $e->getMessage();
			}
			
			$oVueAdmin	= new VueAdmin();			
			$oVueAdmin->afficherEntete();
			$oVueAdmin->afficherToolbar();
			$oVueAdmin->afficherNavigation();
			VueUsagers::detailsUsagerAdmin($aUsager, $aAdresses, $msg);
			$oVueAdmin->afficherFinContent();
			$oVueAdmin->afficherFooter();
		}

		/**
		 * Modifier un usager
		 */
		private function modifier_usager(){
			$id_utilisateurs = (!empty($_GET['id_utilisateurs'])) ? $_GET['id_utilisateurs'] : '';
			$aId = array("id_utilisateurs" => $id_utilisateurs);
			
			//var_dump($_POST);
			try{
				$oUsagers = new Usagers();
				$result = $oUsagers->modifier($aId, $_POST);
				$aUsager = $oUsagers->afficher($aId);
				$oAdresse = new Adresse();
				$aAdresses = $oAdresse->afficherAdresseUsager(array('courriel' => $aUsager['courriel']));
				//var_dump($result);
				$oVueAdmin	= new VueAdmin();			
				$oVueAdmin->afficherEntete();
				$oVueAdmin->afficherToolbar();
				$oVueAdmin->afficherNavigation();
				VueUsagers::detailsUsagerAdmin($aUsager, $aAdresses, $result);
				$oVueAdmin->afficherFinContent();
				$oVueAdmin->afficherFooter();
			}
			catch(Exception $e){
				//echo $e->getMessage();
				$this->details_usager($e->getMessage());
			}
		}

		/**
		 * Produits
		 */
		private function produits() {
			$nb1 = (!empty($_GET['partir'])) ? $_GET['partir'] : 0;
			$nb2 = (!empty($_GET['fin'])) ? $_GET['fin'] : 20;	
			
			$oVueAdmin	= new VueAdmin();
			$oProduits  = new Catalogue();
			$aProduits  = $oProduits->afficherListe("tous");
			
			$pagePagination = new Pagination();
			$aDonnees 		= array("aTousElements" => $aProduits);
			$pagesPaginator = $pagePagination->paginate($aDonnees);
			$datas = $pagePagination->voirResultats();
			
			$oVueAdmin->afficherEntete();
			$oVueAdmin->afficherToolbar();
			$oVueAdmin->afficherNavigation();
	
			VueCatalogue::afficherListAdmin($aProduits, $pagesPaginator, $nb1, $nb2);
			$oVueAdmin->afficherFinContent();
			$oVueAdmin->afficherFooter();
		}

		/**
		 * Détails d'un produit
		 */
		private function detailsProduit() {
			$produit_id = (!empty($_GET['produit_id'])) ? $_GET['produit_id'] : 0;

			try {
				$oProduits  = new Catalogue();
				$aProduit 	= $oProduits->afficherProduit($produit_id);
				$result = "2";
			} 
			catch(Exception $e) {
				echo $e->getMessage();
			}
				
			$oVueAdmin	= new VueAdmin();			
			$oVueAdmin->afficherEntete();
			$oVueAdmin->afficherToolbar();
			$oVueAdmin->afficherNavigation();
			VueCatalogue::modifierProduitAdmin($aProduit, $result);
			$oVueAdmin->afficherFinContent();
			$oVueAdmin->afficherFooter();
		}
		
		/**
		 * Modifier un produit
		 */
		private function modifierProduit() {
			$produit_id = (!empty($_GET['produit_id'])) ? $_GET['produit_id'] : 0;

			try {
				$oProduits  = new Catalogue();
				$result 	= $oProduits->modifier($_POST);
				$aProduit 	= $oProduits->afficherProduit($produit_id);
			} 
			catch(Exception $e) {
				echo $e->getMessage();
			}
				
			$oVueAdmin	= new VueAdmin();			
			$oVueAdmin->afficherEntete();
			$oVueAdmin->afficherToolbar();
			$oVueAdmin->afficherNavigation();
			VueCatalogue::modifierProduitAdmin($aProduit, $result);
			$oVueAdmin->afficherFinContent();
			$oVueAdmin->afficherFooter();
		}
		
			/**
		 * Ajouter un produit
		 */
		private function ajouterProduit() {

			if(isset($_POST['modifierProduit'])) {
				try {
					$oProduits  = new Catalogue();
					$result 	= $oProduits->enregistrer($_POST);
					$produit_id = intval($oProduits->dernierIdProduit());
					$aProduit 	= $oProduits->afficherProduit($produit_id);
				} 
				catch(Exception $e) {
					echo $e->getMessage();
				}
			} else {
				$result = 2;
			}
	
			if(isset($_POST['modifierProduit'])) {
				$aProduit = $_POST;
			} else {
				$aProduit = array();
			}
			$oVueAdmin	= new VueAdmin();			
			$oVueAdmin->afficherEntete();
			$oVueAdmin->afficherToolbar();
			$oVueAdmin->afficherNavigation();
			VueCatalogue::modifierProduitAdmin($aProduit,$result);
			$oVueAdmin->afficherFinContent();
			$oVueAdmin->afficherFooter();
		}	
}
?>