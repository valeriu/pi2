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
				case 'panier':
					$this->panier();
					break;
				case 'page':
					$this->page();
					break;
				case 'page_ajouter':
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
			VuePages::afficherListAdmin();
			$oVueAdmin->afficherPagination();
			$oVueAdmin->afficherFinContent();
			$oVueAdmin->afficherFooter();
		}
		private function pageAjouter() {
			$oVueAdmin	= new VueAdmin();
			$oVueAdmin->afficherEntete();
			$oVueAdmin->afficherToolbar();
			$oVueAdmin->afficherNavigation();
			VuePages::ajouterPageAdmin();
			$oVueAdmin->afficherPagination();
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















