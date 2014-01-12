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
			
			switch ($_GET['requete']) {
				case 'connexion':
					$this->connexion();
					break;
				case 'page':
					$this->page();
					break;
				case 'page_modifier':
					$this->modifierPage();
					break;				
				default:
					$this->connexion();
					break;
			}
		}
		private function connexion() {
			$oVueAdmin	= new VueAdmin();
			$oVueAdmin->afficherEntete();
			$oVueAdmin->afficherConnexion();
			$oVueAdmin->afficherFooter();
		}
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
		private function panier(){
			$vue =  new Vue();
			$vue->afficherEntete();
			// VueUsager::afficherFormes();
			$vue->afficherBoutonPanier();
			VueMenu::afficherMenu();
			VuePanier::affichePanier();
			$vue->afficherFooter();
		}
		// Placer les méthodes du controleur.
				
}
?>