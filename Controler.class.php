<?php
/**
 * Class Controler
 * Gère les requêtes HTTP
 * 
 * @author Jonathan Martel
 * @version 1.0
 * @update 2013-12-10
 * @license Creative Commons BY-NC 3.0 (Licence Creative Commons Attribution - Pas d’utilisation commerciale 3.0 non transposé)
 * @license http://creativecommons.org/licenses/by-nc/3.0/deed.fr
 * 
 */

class Controler {
	
		/**
		 * Traite la requête
		 * @return void
		 */
		public function gerer() {
			
			switch ($_GET['requete']) {
				case 'accueil':
					$this->accueil();
					//$this->page();
					break;
				case 'panier':
					$this->panier();
					break;
				case 'page':
					$this->panier();
					break;
				default:
					$this->accueil();
					break;
			}
		}
		private function accueil() {
			$form = (isset($_POST['form'])) ? $_POST['form'] : '';
			$oVue = new Vue();
			$oVue->afficherEntete();
			if(!isset($_SESSION['usager'])){
				VueUsagers::afficherFormUsagers();
			}
			else{
				VueUsagers::afficherFormDeconnexion();
			}
			$oVue->afficherBoutonPanier();
			$oVue->afficherAccueil($form);
			$oVue->afficherFooter();

		}
		private function page() {

			$oVue = new Vue();
			$oVue->afficherPage($id);
		}
		private function panier(){
			$vue =  new Vue();
			$vue->afficherEntete();
			if(!isset($_SESSION['usager'])){
				VueUsagers::afficherFormUsagers();
			}
			else{
				VueUsagers::afficherFormDeconnexion();
			}
			$vue->afficherBoutonPanier();
			VueMenu::afficherMenu();
			VuePanier::affichePanier();
			$vue->afficherFooter();
		}
		// Placer les méthodes du controleur.
				
}
?>















