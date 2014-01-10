<?php
/**
 * Modele Catalogue (class)
 *
 * @author Yan Boucher Bouchard
 */
class Catalogue {
	// PARAMS
	private $bd;
	private $aCategories = array(1=>true,2=>true,3=>true);
	private $sWhere 	 = "WHERE ";

	// CONSTRUCTEUR
	public function __construct($aCategories){
		$this->aCategories = $aCategories;
		$this->bd 		   = BD::getInstance();

		// $categories --> string SQL $sWhere
		foreach ($this->aCategories as $key => $value) {
			if($value==true) {
				$this->sWhere .= "categorie_id_categorie=".$key." OR ";
			}
		}
		if($this->sWhere!="WHERE ") {
			$this->sWhere = substr($this->sWhere,0,-4);
		} else {
			$this->sWhere = "";
		}
		//var_dump($this->sWhere);
	}

	// METHODES
	public function afficher($mode) {
		$idbd = $this->bd->getBD();
		
		switch ($mode) {
			// tri par specification
			case 'specs':
				$sOrderBy = "puissance";
				break;

			// tri par prix
			case 'prix':
				$sOrderBy = "prix";
				break;

			// tri par prix
			case 'tous':
				$sOrderBy = "categorie_id_categorie";
				break;
			
			// erreur
			default:
				throw new Exception("Mode de tri invalide...");
				break;
		}
		// requete SQL
		$req = $idbd->prepare(	"SELECT *
                                FROM wa_produits ".$this->sWhere." ORDER BY ".$sOrderBy.";");
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
	}


}

?>
