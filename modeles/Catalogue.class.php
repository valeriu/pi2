<?php
/**
 * Modele Catalogue (class)
 *
 * @author Yan Boucher Bouchard
 */
class Catalogue {
	// PARAMS
	private $bd;
	private $aCategories;
	private $sWhere = "WHERE (";

	// CONSTRUCTEUR
	public function __construct($aCategories=array(1=>"true",2=>"true",3=>"true")){
		$this->aCategories = $aCategories;
		if(isset($_GET['1'])) $this->aCategories['1'] = $_GET['1'];
		if(isset($_GET['2'])) $this->aCategories['2'] = $_GET['2'];
		if(isset($_GET['3'])) $this->aCategories['3'] = $_GET['3'];
		$this->bd 		   = BD::getInstance();

		// $categories --> string SQL $sWhere
		foreach ($this->aCategories as $key => $value) {
			if($value=="true") {
				$this->sWhere .= "categorie_id_categorie=".$key." OR ";
			}
		}
		if($this->sWhere!="WHERE ") {
			$this->sWhere = substr($this->sWhere,0,-4).") AND ";
		} else {
			$this->sWhere = "WHERE (";
		}
		//var_dump($this->sWhere);
	}

	// METHODES

		// afficher 1 seul produit
	public function afficherProduit($id) {
		$idbd = $this->bd->getBD();

		// requete SQL
		$req = $idbd->prepare("SELECT *
                                FROM wa_produits WHERE id_produits=".$id.";");
		$req->execute();
		$aProduit = $req->fetch();
		if(isset($aProduit['nom'])) {
			$aProduit['nomProduit'] = $aProduit['nom'];
			$aProduit['statutProduit'] = $aProduit['statut'];
			$aProduit['typeProduit'] = $aProduit['type'];
			$aProduit['prixProduit'] = $aProduit['prix'];
			$aProduit['descProduit'] = $aProduit['description'];
			$aProduit['specsProduit'] = $aProduit['specification'];
			$aProduit['imgProduit'] = $aProduit['image'];
			$aProduit['suppProduit'] = $aProduit['fournisseur'];
			$aProduit['suppIdProduit'] = $aProduit['iditem_fournisseur'];
			$aProduit['poidsProduit'] = $aProduit['poids'];
			$aProduit['longProduit'] = $aProduit['taille_longueur'];
			$aProduit['largProduit'] = $aProduit['taille_largeur'];
			$aProduit['hautProduit'] = $aProduit['taille_hauteur'];
			$aProduit['evalProduit'] = $aProduit['evaluation_id_evaluation'];
			$aProduit['catIdProduit'] = $aProduit['categorie_id_categorie'];
			$aProduit['powerProduit'] = $aProduit['puissance'];
			$aProduit['IdProduit'] = $aProduit['id_produits'];
		}
			

		if($aProduit){
			return $aProduit;
		}
		else{
			throw new Exception("ID du produit invalide...");
		}
	}

	// afficher les produits
	public function afficherListe($mode) {
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
				throw new Exception("Mode d'affichage invalide...");
				break;
		}
		// requete SQL
		$req = $idbd->prepare(	"SELECT *
                                FROM wa_produits ".substr($this->sWhere,0,-4)." ORDER BY ".$sOrderBy.";");
		$req->execute();
		//var_dump($req);
		$aProduits = $req->fetchAll();
		//var_dump($aProduits);
		
		if($aProduits){
			return $aProduits;
		}
		else{
			throw new Exception("Erreur lors du chargement des produits...");
		}
	}

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
				throw new Exception("Mode d'affichage invalide...");
				break;
		}
		// requete SQL
		$req = $idbd->prepare(	"SELECT *
                                FROM wa_produits ".$this->sWhere."statut=1 ORDER BY ".$sOrderBy.";");
		$req->execute();
		//var_dump($req);
		$aProduits = $req->fetchAll();
		//var_dump($aProduits);
		
		if($aProduits){
			return $aProduits;
		}
		else{
			throw new Exception("Erreur lors du chargement des produits...");
		}
	}

		// ajouter un nouveau produit
	public function enregistrer($aDonnees = Array(), $imgFile) {
		$nomProduit    = (!empty($aDonnees['nomProduit']))	  ? $aDonnees['nomProduit']    	  	    : '';
		$prixProduit   = (!empty($aDonnees['prixProduit']))   ? floatval($aDonnees['prixProduit'])  : '';
		$descProduit   = (!empty($aDonnees['descProduit']))   ? $aDonnees['descProduit']   	  	    : '';
		$specsProduit  = (!empty($aDonnees['specsProduit']))  ? $aDonnees['specsProduit']  	  	    : '';
		$imgProduit    = (!empty($imgFile)) 	  			  ? $imgFile    	  	     			: '';
		$statutProduit = intval($aDonnees['statutProduit']);
		$typeProduit   = intval($aDonnees['typeProduit']);
		$suppProduit   = (!empty($aDonnees['suppProduit']))   ? $aDonnees['suppProduit']  	  	    : '';
		$suppIdProduit = (!empty($aDonnees['suppIdProduit'])) ? $aDonnees['suppIdProduit'] 	   		: '';
		$poidsProduit  = (!empty($aDonnees['poidsProduit']))  ? floatval($aDonnees['poidsProduit']) : '';
		$longProduit   = (!empty($aDonnees['longProduit']))   ? floatval($aDonnees['longProduit'])  : '';
		$largProduit   = (!empty($aDonnees['largProduit']))   ? floatval($aDonnees['largProduit'])  : '';
		$hautProduit   = (!empty($aDonnees['hautProduit']))   ? floatval($aDonnees['hautProduit'])  : '';
		$evalProduit   = (!empty($aDonnees['evalProduit']))   ? intval($aDonnees['evalProduit'])    : '';
		$catIdProduit  = (!empty($aDonnees['catIdProduit']))  ? intval($aDonnees['catIdProduit'])   : '';
		$powerProduit  = (!empty($aDonnees['powerProduit']))  ? intval($aDonnees['powerProduit'])   : '';

		if(!Valider::estStringValide($nomProduit)){
			throw new Exception("Nom du produit non conforme");
		}
		if(!Valider::estFloat($prixProduit)){
			throw new Exception("Prix du produit non conforme");
		}
		if(!Valider::estStringValide($descProduit)){
			throw new Exception("Description du produit non conforme");
		}
		if(!Valider::estString($specsProduit)){
			throw new Exception("Specifications du produit non conforme");
		}
		if(!Valider::estImage($imgProduit['name'])){
			throw new Exception("Image du produit non conforme");
		} else {
			 if (file_exists("img/products/" . $imgProduit["name"]))
		      {
		      move_uploaded_file($imgProduit["tmp_name"],"img/products/"."_".$imgProduit["name"]);
		      $imgProduit["name"] = "_".$imgProduit["name"];
		      }
		    else
		      {
		      move_uploaded_file($imgProduit["tmp_name"],"img/products/".$imgProduit["name"]);
		      }
		}
		if(!Valider::estInt($statutProduit)){
			throw new Exception("Statut produit non conforme");
		}
		if(!Valider::estInt($typeProduit)){
			throw new Exception("Type produit non conforme");
		}
		if(!Valider::estStringValide($suppProduit)){
			throw new Exception("Fournisseur du produit non conforme");
		}
		if(!Valider::estStringValide($suppIdProduit)){
			throw new Exception("ID du produit au fournisseur non conforme");
		}
		if(!Valider::estFloat($poidsProduit)){
			throw new Exception("Poids du produit non conforme");
		}
		if(!Valider::estFloat($longProduit)){
			throw new Exception("Longueur du produit non conforme");
		}
		if(!Valider::estFloat($largProduit)){
			throw new Exception("Largeur du produit non conforme");
		}
		if(!Valider::estFloat($hautProduit)){
			throw new Exception("Hauteur du produit non conforme");
		}
		if(!Valider::estInt($evalProduit)){
			throw new Exception("Evaluation du produit non conforme");
		}
		if(!Valider::estInt($catIdProduit)){
			throw new Exception("Categorie de produit non conforme");
		}
		if(!Valider::estInt($powerProduit)){
			throw new Exception("Puissance du produit non conforme");
		}

		$idbd = $this->bd->getBD();
		//Préparation de la requête
		$req = $idbd->prepare(	"INSERT INTO wa_produits
								(nom, prix, description, specification, image, statut, type, fournisseur, iditem_fournisseur, poids, taille_longueur, taille_largeur, taille_hauteur, evaluation_id_evaluation, categorie_id_categorie, puissance)
								VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
        
		//var_dump($req);
        $req->bindParam(1, $nomProduit);
        $req->bindParam(2, $prixProduit);
        $req->bindParam(3, $descProduit);
        $req->bindParam(4, $specsProduit);
        $req->bindParam(5, $imgProduit['name']);
        $req->bindParam(6, $statutProduit);
        $req->bindParam(7, $typeProduit);
        $req->bindParam(8, $suppProduit);
        $req->bindParam(9, $suppIdProduit);
        $req->bindParam(10, $poidsProduit);
        $req->bindParam(11, $longProduit);
        $req->bindParam(12, $largProduit);
        $req->bindParam(13, $hautProduit);
        $req->bindParam(14, $evalProduit);
        $req->bindParam(15, $catIdProduit);
        $req->bindParam(16, $powerProduit);
		
		$reponse = $req->execute();
		
		if($reponse){
			return $reponse;
		}
        else {
        	print_r($req->errorInfo());
			throw new Exception("Erreur lors de l'ajout du produit...");
		}

	}

		// modifier un produit
	public function modifier($aDonnees = Array(), $imgFile) {
		$IdProduit     = intval($aDonnees['IdProduit']);
		$nomProduit    = (!empty($aDonnees['nomProduit']))	  ? $aDonnees['nomProduit']    	  	    : '';
		$prixProduit   = (!empty($aDonnees['prixProduit']))   ? floatval($aDonnees['prixProduit'])  : '';
		$descProduit   = (!empty($aDonnees['descProduit']))   ? $aDonnees['descProduit']   	  	    : '';
		$specsProduit  = (!empty($aDonnees['specsProduit']))  ? $aDonnees['specsProduit']  	  	    : '';
		$imgProduit    = (!empty($imgFile)) 	  			  ? $imgFile    	  	     			: '';
		$statutProduit = intval($aDonnees['statutProduit']);
		$typeProduit   = intval($aDonnees['typeProduit']);
		$suppProduit   = (!empty($aDonnees['suppProduit']))   ? $aDonnees['suppProduit']  	  	    : '';
		$suppIdProduit = (!empty($aDonnees['suppIdProduit'])) ? $aDonnees['suppIdProduit'] 	   		: '';
		$poidsProduit  = (!empty($aDonnees['poidsProduit']))  ? floatval($aDonnees['poidsProduit']) : '';
		$longProduit   = (!empty($aDonnees['longProduit']))   ? floatval($aDonnees['longProduit'])  : '';
		$largProduit   = (!empty($aDonnees['largProduit']))   ? floatval($aDonnees['largProduit'])  : '';
		$hautProduit   = (!empty($aDonnees['hautProduit']))   ? floatval($aDonnees['hautProduit'])  : '';
		$evalProduit   = (!empty($aDonnees['evalProduit']))   ? intval($aDonnees['evalProduit'])    : '';
		$catIdProduit  = (!empty($aDonnees['catIdProduit']))  ? intval($aDonnees['catIdProduit'])   : '';
		$powerProduit  = (!empty($aDonnees['powerProduit']))  ? intval($aDonnees['powerProduit'])   : '';

		if(!Valider::estInt($IdProduit)){
			throw new Exception("ID produit non conforme");
		}
		if(!Valider::estStringValide($nomProduit)){
			throw new Exception("Nom du produit non conforme");
		}
		if(!Valider::estFloat($prixProduit)){
			throw new Exception("Prix du produit non conforme");
		}
		if(!Valider::estStringValide($descProduit)){
			throw new Exception("Description du produit non conforme");
		}
		if(!Valider::estString($specsProduit)){
			throw new Exception("Specifications du produit non conforme");
		}
		if(!Valider::estImage($imgProduit['name'])){
			throw new Exception("Image du produit non conforme");
		} else {
			 if (file_exists("img/products/" . $imgProduit["name"]))
		      {
		      move_uploaded_file($imgProduit["tmp_name"],
		      "img/products/" . "_" . $imgProduit["name"]);
		      $imgProduit["name"] = "_" . $imgProduit["name"];
		      }
		    else
		      {
		      move_uploaded_file($imgProduit["tmp_name"],
		      "img/products/" . $imgProduit["name"]);
		      }
		}
		if(!Valider::estInt($statutProduit)){
			throw new Exception("Statut produit non conforme");
		}
		if(!Valider::estInt($typeProduit)){
			throw new Exception("Type produit non conforme");
		}
		if(!Valider::estStringValide($suppProduit)){
			throw new Exception("Fournisseur du produit non conforme");
		}
		if(!Valider::estStringValide($suppIdProduit)){
			throw new Exception("ID du produit au fournisseur non conforme");
		}
		if(!Valider::estFloat($poidsProduit)){
			throw new Exception("Poids du produit non conforme");
		}
		if(!Valider::estFloat($longProduit)){
			throw new Exception("Longueur du produit non conforme");
		}
		if(!Valider::estFloat($largProduit)){
			throw new Exception("Largeur du produit non conforme");
		}
		if(!Valider::estFloat($hautProduit)){
			throw new Exception("Hauteur du produit non conforme");
		}
		if(!Valider::estInt($evalProduit)){
			throw new Exception("Evaluation du produit non conforme");
		}
		if(!Valider::estInt($catIdProduit)){
			throw new Exception("Categorie de produit non conforme");
		}
		if(!Valider::estInt($powerProduit)){
			throw new Exception("Puissance du produit non conforme");
		}

		$idbd = $this->bd->getBD();
		//Préparation de la requête
		$req = $idbd->prepare(	"UPDATE wa_produits
								SET nom = ?, 
									prix = ?,
									description = ?, 
									specification = ?, 
									image = ?, 
									statut = ?, 
									type = ?, 
									fournisseur = ?, 
									iditem_fournisseur = ?, 
									poids = ?, 
									taille_longueur = ?, 
									taille_largeur = ?, 
									taille_hauteur = ?, 
									evaluation_id_evaluation = ?, 
									categorie_id_categorie = ?, 
									puissance = ?
								WHERE id_produits = ?");
        
		//var_dump($req);
        $req->bindParam(1, $nomProduit);
        $req->bindParam(2, $prixProduit);
        $req->bindParam(3, $descProduit);
        $req->bindParam(4, $specsProduit);
        $req->bindParam(5, $imgProduit['name']);
        $req->bindParam(6, $statutProduit);
        $req->bindParam(7, $typeProduit);
        $req->bindParam(8, $suppProduit);
        $req->bindParam(9, $suppIdProduit);
        $req->bindParam(10, $poidsProduit);
        $req->bindParam(11, $longProduit);
        $req->bindParam(12, $largProduit);
        $req->bindParam(13, $hautProduit);
        $req->bindParam(14, $evalProduit);
        $req->bindParam(15, $catIdProduit);
        $req->bindParam(16, $powerProduit);
        $req->bindParam(17, $IdProduit);

		$reponse = $req->execute();
		
		if($reponse){
			return $reponse;
		}
		else{
			print_r($req->errorInfo());
			throw new Exception("Erreur lors de la modification du produit...");
		}
	}

	public function dernierIdProduit() {
		$idbd 	= $this->bd->getBD();
		$lastID = $idbd->lastInsertId();
		return $lastID;
	}

}

?>
