<?php
/**
 * Modele Catalogue (class)
 *
 * @author Yan Boucher Bouchard
 */
class Catalogue {
	// PARAMS
	private $bd;
	private $categories = array(1=>true,2=>true,3=>true);
	private $sWhere 	= "WHERE ";

	// CONSTRUCTEUR
	public function __construct(){
		$this->bd = BD::getInstance();

		// TODO : verif des categories selectionne pour mettre a jour $categories...

		// $categories --> string SQL $sWhere
		foreach ($this->categories as $key => $value) {
			if($value==true) {
				$this->sWhere .= "categorie_id_categorie=".$key." OR ";
			}
		}
		if($this->sWhere!="WHERE ") {
			$this->sWhere = substr($this->sWhere,0,-4)."";
		} else {
			$this->sWhere = "";
		}
		//var_dump($this->sWhere);
	}

	// METHODES
	public function afficher($mode) {
		$idbd = $this->bd->getBD();
		
		switch ($mode) {
			// tri par specifications
			case 'specs':
				//Préparation de la requête
				$req = $idbd->prepare(	"SELECT *
		                                FROM wa_produits ".$this->sWhere." ORDER BY puissance;");
				$req->execute();
				//var_dump($req);
				$aProduits = $req->fetchAll();
				
				if($aProduits){
					return $aProduits;
				}
				else{
					throw new Exception("Erreur lors du chargement des produits...");
				}
				break;

			// tri par prix
			case 'prix':
				//Préparation de la requête
				$req = $idbd->prepare(	"SELECT *
		                                FROM wa_produits ".$this->sWhere." ORDER BY prix;");
				$req->execute();
				$aProduits = $req->fetchAll();
				
				if($aProduits){
					return $aProduits;
				}
				else{
					throw new Exception("Erreur lors du chargement des produits...");
				}
				break;

			// tri par prix
			case 'tous':
				//Préparation de la requête
				$req = $idbd->prepare(	"SELECT *
		                                FROM wa_produits ".$this->sWhere." ORDER BY categorie_id_categorie;");
				$req->execute();
				$aProduits = $req->fetchAll();
				
				if($aProduits){
					return $aProduits;
				}
				else{
					throw new Exception("Erreur lors du chargement des produits...");
				}
				break;
			
			// erreur
			default:
				throw new Exception("Mode de tri invalide...");
				break;
		}
	}


}

?>
