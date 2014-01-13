<?php

/*
 * Menu
 * status
 *	* 0 - invisible
 *  * 1 - visible
 *  * 2 - supprimé
 * 
 * parent 
 *	* 0 - root menu
 * 
 */

/**
 * Description of Menu
 * 
 *
 * @author Valeriu et Luc
 */
class Menu {
	private $bd;
	
	public function __construct(){
		$this->bd = BD::getInstance();
	}
	
	/**
	 * Vérifier l'existence d'item de menu
	 */
	public function verifier ($aDonnees = Array()) {
		$titre = (!empty($aDonnees['titre'])) ? $aDonnees['titre'] : '';

		if(!Valider::estString($titre)){
			throw new Exception("Entrez un titre valide");
		}

		$idbd = $this->bd->getBD();
		//Vérification de l'existence d'un titre semblable 
		$req = $idbd->prepare( 	"SELECT * FROM  `wa_menu`
								 WHERE titre = ?");

		$req->bindParam(1, $titre);
		$req->execute();
		$obj = $req->fetch(PDO::FETCH_ASSOC);

		if($obj){
			return true;
		}
		else{
			return false;
		}	
	}

	/**
	 * Enregistrer un nouvel item de menu
	 */
	public function enregistrer ($aDonnees = Array()) {
		//id_menu	titre	description	url	parent	order	statut
		$titre 			= (!empty($aDonnees['titre'])) ? $aDonnees['titre'] : '';
		$description 	= (!empty($aDonnees['description'])) ? $aDonnees['description'] : null;
		$url 			= (!empty($aDonnees['url'])) ? $aDonnees['url'] : '';
		$parent 		= (!empty($aDonnees['parent'])) ? $aDonnees['parent'] : 0;
		$ordre 			= (!empty($aDonnees['ordre'])) ? $aDonnees['ordre'] : 0;
		$statut 		= (!empty($aDonnees['statut'])) ? $aDonnees['statut'] : 0;
		
		/*if($this->verifier($aDonnees)){
			throw new Exception("Ce titre existe déjà");
		}*/
		$idbd = $this->bd->getBD();
		//Préparation de la requête
		$reqInsertion = $idbd->prepare(	"INSERT INTO wa_menu
								(titre, description, url, parent, ordre, statut)
								VALUES (?, ?, ?, ?, ?, ?)");
		
		
		//var_dump($statut);
		$reqInsertion->bindParam(1, $titre);
		$reqInsertion->bindParam(2, $description);
		$reqInsertion->bindParam(3, $url);
		$reqInsertion->bindParam(4, $parent);
		$reqInsertion->bindParam(5, $ordre);
		$reqInsertion->bindParam(6, $statut);
		
		$reponseInsertion = $reqInsertion->execute();
		
		if($reponseInsertion){
			return $reponseInsertion;
		}
		else{
			throw new Exception("Une erreur s'est produite lors de l'enregistrement, recommencez");
		}					
		
	} 
	
	/**
	 * Modifier un item de menu
	 */
	public function modifier ($aDonnees = Array()) {
		$id_menu 		= $aDonnees['id_menu'];
		$titre 			= $aDonnees['titre'];
		$description 	= $aDonnees['description'];
		$url 			= $aDonnees['url'];
		$parent 		= (!empty($aDonnees['parent'])) ? $aDonnees['parent'] : 0;
		$ordre 			= (!empty($aDonnees['ordre'])) ? $aDonnees['ordre'] : 0;
		$statut 		= (!empty($aDonnees['statut'])) ? $aDonnees['statut'] : 0;

		

		
		$idbd = $this->bd->getBD();
		//Préparation de la requête
		$req = $idbd->prepare(	"UPDATE wa_menu SET
										titre = ?,
										description = ?,
										url = ?,
										parent = ?,
										ordre = ?,
										statut = ?
								WHERE id_menu = ?");
		
		
		//var_dump($statut);
		$req->bindParam(1, $titre);
		$req->bindParam(2, $description);
		$req->bindParam(3, $url);
		$req->bindParam(4, $parent);
		$req->bindParam(5, $ordre);
		$req->bindParam(6, $statut);
		$req->bindParam(7, $id_menu);

		$reponse = $req->execute();

		if($reponse){
			return $reponse;
		}
		else{
			throw new Exception("Erreur lors de la modification, recommencez");
		}	
	}
	
	/**
	 * Affichage du menu pour les ADMIN
	 */
	public function afficherMenuAdmin () {
		$idbd = $this->bd->getBD();
		//Préparation de la requête
		//id_menu	titre	description	url	parent	ordre	statut
		$req = $idbd->prepare(	"SELECT * 
								FROM wa_menu");
        
    	$req->execute();
			
		$items = $req->fetchAll();
		
		if($items){
			return $items;
		}
		else{
			throw new Exception("Erreur lors de l'aquisition des données, recommencez");
		}
	}
	/**
	 * Affichage du menu pour les ADMIN
	 */
	public function afficherMenuAdminID ($aDonnees = array()) {
		$id_menu			= intval($aDonnees['id_menu']);
		
		if(!Valider::estInt($id_menu)){
			throw new Exception("Id page non conforme");
		}
		
		$idbd = $this->bd->getBD();
		$req = $idbd->prepare ("SELECT * FROM  `wa_menu` WHERE  `id_menu` = :id_menu");
		$req->bindParam(":id_menu", $id_menu, PDO::PARAM_INT);
        
		$reponse = $req->execute();
		
		if($reponse){
				return $req->fetch(PDO::FETCH_ASSOC);
			throw new Exception("Erreur lors de la modification, recommencez");
		}
	}
	/**
	 * Affichage du menu frontend
	 * Fonction tirée en partie du site suivant et modifier par Luc Cinq-Mars
	 * http://wizardinternetsolutions.com/articles/web-programming/dynamic-multilevel-css-menu-php-mysql
	 */
	public function afficherMenu () {
		$idbd = $this->bd->getBD();
		//Préparation de la requête
		//id_menu	titre	description	url	parent	ordre	statut
		$req = $idbd->prepare(	"SELECT id_menu, titre, description, url, parent, ordre, statut 
								FROM wa_menu
								WHERE statut = 1
								ORDER BY parent, ordre");
        
    	$req->execute();
		
		$menu = array(
			'items' => array(),
			'parents' => array()
		);
			
		//var_dump($items);
		while ($items = $req->fetch(PDO::FETCH_ASSOC)){
			// Creates entry into items array with current menu item id ie. $menu['items'][1] -- Commentaire du créateur de la fonction
			$menu['items'][$items['id_menu']] = $items;
			// Creates entry into parents array. Parents array contains a list of all items with children -- Commentaire du créateur de la fonction
			$menu['parents'][$items['parent']][] = $items['id_menu'];
		}
		//echo "<pre>";
		//print_r($menu);
		return $this->construireMenu(0, $menu);
	}
	
	/**
	 * Construction du menu frontend
	 * Fonction tirée en partie du site suivant et modifier par Luc Cinq-Mars
	 * http://wizardinternetsolutions.com/articles/web-programming/dynamic-multilevel-css-menu-php-mysql
	 */
	private function construireMenu($parent, $menu){
		//echo "<pre>";
		//print_r($menu);
		if (isset($menu['parents'][$parent])){
			//var_dump($menu['parents'][$parent]);
			foreach ($menu['parents'][$parent] as $itemId){
				//echo "<pre>";
				//print_r($itemId);
				if(!isset($menu['parents'][$itemId])){
					$menuConstruit[$menu['items'][$itemId]['id_menu']] = array('id_menu' => $menu['items'][$itemId]['id_menu'], 'url' => $menu['items'][$itemId]['url'], 'titre' => $menu['items'][$itemId]['titre']);
					$menuConstruit[$menu['items'][$itemId]['id_menu']]['enfants'] = 0;
				}
				if(isset($menu['parents'][$itemId])){
					$menuConstruit[$menu['items'][$itemId]['id_menu']] = array('id_menu' => $menu['items'][$itemId]['id_menu'],'url' => $menu['items'][$itemId]['url'], 'titre' => $menu['items'][$itemId]['titre']);
					//Création du sous-menu
					$menuConstruit[$menu['items'][$itemId]['id_menu']]['enfants'] = $this->construireMenu($itemId, $menu);
				}
			}
		}
		return $menuConstruit;
	}
}

?>
