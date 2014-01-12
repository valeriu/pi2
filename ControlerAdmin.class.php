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
				case 'page_edition':
					$this->pageAjouter();
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
			$oVueAdmin	= new VueAdmin();
			$oVueAdmin->afficherEntete();
			$oVueAdmin->afficherToolbar();
			$oVueAdmin->afficherNavigation();
			$nb1 = (!empty($_GET['partir'])) ? $_GET['partir'] : 0;
			$nb2 = (!empty($_GET['fin'])) ? $_GET['fin'] : 20;		
			VuePages::afficherListAdmin($nb1, $nb2);
			$oVueAdmin->afficherFinContent();
			$oVueAdmin->afficherFooter();
		}
		private function pageAjouter() {
			$oVueAdmin	= new VueAdmin();
			$oVueAdmin->afficherEntete();
			$oVueAdmin->afficherToolbar();
			$oVueAdmin->afficherNavigation();
			$nb1 = (!empty($_GET['page_id'])) ? $_GET['page_id'] : 0;
			$aDonnees = array("id_page" => $nb1);
			VuePages::ajouterPageAdmin($aDonnees);
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