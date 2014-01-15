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
		private function ajouterPage() {
			if(isset($_POST["page-ajouter"])){
				$titre				= $_POST["page-title"];
				$description_meta	= $_POST["page-description"];
				$contenu			= $_POST["page-contenu"];
				$statut				= intval($_POST["optionsRadios"]);
				$geo_lat			= $_POST["page-latitudes"];
				$geo_long			= $_POST["page-longitudes"];
				
				
				//$page = new Pages();
				$aDonneesPOST = array( 
									"titre" => $titre, 
									"description_meta" => $description_meta, 
									"contenu" => $contenu, 
									"statut" => $statut, 
									"geo_long" => $geo_long, 
									"geo_lat" => $geo_lat
								);
				$oPage = new Pages();
				$result = $oPage->ajouter($aDonneesPOST);
				
			} else {
				$result = "2";
			}
			
			$oVueAdmin	= new VueAdmin();			
			$oVueAdmin->afficherEntete();
			$oVueAdmin->afficherToolbar();
			$oVueAdmin->afficherNavigation();
			VuePages::ajouterPageAdmin($result);
			$oVueAdmin->afficherFinContent();
			$oVueAdmin->afficherFooter();
		}
		
		private function modifierPage() {
			$page_id = (!empty($_GET['page_id'])) ? $_GET['page_id'] : 0;
			$aDonnees = array("id_page" => $page_id);
			if(isset($_POST["page-modifier"])){
				$id_page			= intval($_POST["page-id"]);
				$titre				= $_POST["page-title"];
				$description_meta	= $_POST["page-description"];
				$contenu			= $_POST["page-contenu"];
				$statut				= intval($_POST["optionsRadios"]);
				$geo_lat			= $_POST["page-latitudes"];
				$geo_long			= $_POST["page-longitudes"];
				$date_modif			= $_POST["page-date"];
				
				//$page = new Pages();
				$aDonneesPOST = array(	"id_page" => $id_page, 
									"titre" => $titre, 
									"description_meta" => $description_meta, 
									"contenu" => $contenu, 
									"statut" => $statut, 
									"geo_long" => $geo_long, 
									"geo_lat" => $geo_lat
								);
				$oPage = new Pages();
				$result = $oPage->modifier($aDonneesPOST);
				$courentPage = $oPage->afficher($aDonnees);
			} else {
				$oPage = new Pages();
				$courentPage = $oPage->afficher($aDonnees);
				$result = "2";
			}
			
			$oVueAdmin	= new VueAdmin();			
			$oVueAdmin->afficherEntete();
			$oVueAdmin->afficherToolbar();
			$oVueAdmin->afficherNavigation();
			VuePages::modifierPageAdmin($courentPage, $result);
			$oVueAdmin->afficherFinContent();
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
			if(isset($_POST["menu-ajouter"])){
				$titre				= $_POST["menu-title"];
				$description		= $_POST["menu-description"];
				$url				= $_POST["menu-url"];
				$parent				= intval($_POST["menu-parent"]);
				$ordre				= intval($_POST["menu-ordre"]);
				$statut				= intval($_POST["optionsRadios"]);
	
				//$page = new Pages();
				$aDonneesPOST = array( 
									"titre" => $titre, 
									"description" => $description, 
									"url" => $url, 
									"parent" => $parent, 
									"ordre" => $ordre, 
									"statut" => $statut
								);
				$oMenu = new Menu();
				$result = $oMenu->enregistrer($aDonneesPOST);
				
			} else {
				$result = "2";
			}
			
			$oVueAdmin	= new VueAdmin();			
			$oVueAdmin->afficherEntete();
			$oVueAdmin->afficherToolbar();
			$oVueAdmin->afficherNavigation();
			VueMenu::ajouterMenuAdmin($result);
			$oVueAdmin->afficherFinContent();
			$oVueAdmin->afficherFooter();
		}
		
		private function modifierMenu() {
			$menu_id = (!empty($_GET['menu_id'])) ? $_GET['menu_id'] : 0;
			$aDonnees = array("id_menu" => $menu_id);
			if(isset($_POST["menu-modifier"])){
				$id_menu			= intval($_POST["menu-id"]);
				$titre				= $_POST["menu-title"];
				$description		= $_POST["menu-description"];
				$url				= $_POST["menu-url"];
				$parent				= intval($_POST["menu-parent"]);
				$ordre				= intval($_POST["menu-ordre"]);
				$statut				= intval($_POST["optionsRadios"]);
				
				//$page = new Pages();
				$aDonneesPOST = array(	"id_menu" => $id_menu, 
									"titre" => $titre, 
									"description" => $description, 
									"url" => $url, 
									"parent" => $parent, 
									"ordre" => $ordre, 
									"statut" => $statut
								);
				$oMenu = new Menu();
				$result = $oMenu->modifier($aDonneesPOST);
				$courentMenu = $oMenu->afficherMenuAdminID($aDonnees);
			} else {
				$oMenu = new Menu();
				$courentMenu = $oMenu->afficherMenuAdminID($aDonnees);
				$result = "2";
			}
			
			$oVueAdmin	= new VueAdmin();			
			$oVueAdmin->afficherEntete();
			$oVueAdmin->afficherToolbar();
			$oVueAdmin->afficherNavigation();
			VueMenu::modifierMenuAdmin($courentMenu, $result);
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

		public function detailsCommande() {
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
			$oVueAdmin->afficherFooter();
			//*/
				
			//}		
		}

		public function modifierCommande() {
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
			$oVueAdmin->afficherFooter();
			//*/
				
			//}*/		

		}
		
		public function details_usager(){
			$id_utilisateurs = (!empty($_GET['id_utilisateurs'])) ? $_GET['id_utilisateurs'] : '';
			$aDonnees = array("id_utilisateurs" => $id_utilisateurs);
			
			//var_dump($_POST);
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
			VueUsagers::detailsUsagerAdmin($aUsager, $aAdresses);
			$oVueAdmin->afficherFinContent();
			$oVueAdmin->afficherFooter();
		}

		
				
}
?>