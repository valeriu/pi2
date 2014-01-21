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
					$this->page();
					break;
				case 'adresseCommande':
					$this->adresseCommande();
					break;
				case 'payer':
					$this->payer();
					break;
				case 'ipn':
					$this->ipn();
					break;
				case 'produits':
					$this->produits();
					break;
				default:
					$this->accueil();
					break;
			}
		}
		private function accueil() {
			//$form = (isset($_POST['form'])) ? $_POST['form'] : '';
			$oVue = new Vue();
			$oVue->afficherEntete();
			if(!isset($_SESSION['usager'])){
				VueUsagers::afficherFormUsagers();
			}
			else{
				VueUsagers::afficherFormDeconnexion();
			}
			$oVue->afficherBoutonPanier();
			VueMenu::afficherMenu();
			$oVue->afficherAccueil();
			$oVue->afficherFooter();

		}
		private function page() {
			$pageID = (isset($_GET['page_id'])) ? $_GET['page_id'] : '';
			$aDonnees = array("id_page" => $pageID);
			
			$oVue = new Vue();
			$oPage = new Pages();
			$courentPage = $oPage->afficher($aDonnees);
			$oVue->afficherEntete($courentPage);
			
			if(!isset($_SESSION['usager'])){
				VueUsagers::afficherFormUsagers();
			} else {
				VueUsagers::afficherFormDeconnexion();
			}
			$oVue->afficherBoutonPanier();
			VueMenu::afficherMenu();
			
			VuePages::afficherPage($courentPage);
			$oVue->afficherFooter();
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
		
		private function adresseCommande(){
			if(!isset($_SESSION['usager'])){
				$this->accueil();
			}
			else{
				$vue =  new Vue();
				$vue->afficherEntete();
				VueUsagers::afficherFormDeconnexion();
				$vue->afficherBoutonPanier();
				VueMenu::afficherMenu();
				$adresse = new Adresse();
				$courriel = array("courriel" => $_SESSION['usager']);
				$data = $adresse->afficherAdresseUsager($courriel);
				VueAdresse::afficherAdrese($data);
				$vue->afficherFooter();
			}
		}
		private function payer(){
			if(!isset($_SESSION['usager'])){
				$this->accueil();
			}
			else{
				$pp = new PayPal();
				$ret = ($pp->doExpressCheckout($_SESSION['tct']));
			}
		}
		
		private function ipn(){
			if(!isset($_SESSION['usager'])){
				$this->accueil();
			}
			else{
				$pp = new PayPal();
				$final = $pp->doPayment();

				if ($final['ACK'] == 'Success') {
					
					echo 'Succeed!';
					//suprime session
					//suprime localstorage
					//
					//$pp->getCheckoutDetails($final['TOKEN']);
					//insert in bd token (pour command)
					//header location succese page

				} else {
					//header location to error page
				}
			}
		}
		
		private function produits() {
			if(empty($_GET['mode']))
				//default : tous les produits
				$_GET['mode'] = "tous";
			if(isset($_GET["1"])) {
				$aCategories[1] = $_GET["1"];
				$aCategories[2] = $_GET["2"];
				$aCategories[3] = $_GET["3"];
			}
			else {
				$aCategories=array(1=>"true",2=>"true",3=>"true");
			}
			$oCatalogue = new Catalogue($aCategories);
			$aProduits = $oCatalogue->afficher($_GET['mode'],$aCategories);
			Vue::afficherEntete();
			if(!isset($_SESSION['usager'])){
				VueUsagers::afficherFormUsagers();
			}
			else{
				VueUsagers::afficherFormDeconnexion();
			}
			Vue::afficherBoutonPanier();
			VueMenu::afficherMenu();
			VueCatalogue::afficherCatalogue($aProduits);
			Vue::afficherFooter();
		}
		// Placer les méthodes du controleur.
				
}
?>