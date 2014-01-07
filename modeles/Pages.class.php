<?php
/**
 * Module Pages
 * 
 * Permet de créer une nouvelle page, de modifier une page existante, 
 * affichez une page en fonction de l'ID ou affiche toutes les pages pages de la base de données.
 *
 * @author valeriu
 */

/*
 * Informations utiles: 
 * return $req->fetchALL(); 
 * return $req->fetchColumn();
 * $idbd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); 
 * http://ca2.php.net/manual/en/pdo.constants.php
 */

class Pages {

	private $bd;
	
	/**
	 *  Méthode __construct() - Instancie la base de données
	 */
	
	public function __construct(){
		$this->bd = BD::getInstance();
	}
	
	/** 
	 * Méthode ajouter() - Ajouter une nouvelle page dans notre base de données
	 * 
	 * @param type $titre - Page titre
	 * @param type $description_meta - Description Meta
	 * @param type $contenu - Contenu de la page
	 * @param type $statut - 0 -> invisible,  1 -> visible, 2 -> supprimé
	 * @param type $geo_long - Coordonner de longitude
	 * @param type $geo_lat - Coordonner de latitude
	 * 
	 * @return TRUE ou FALSE
	 */	
	
	public function ajouter ($titre, $description_meta, $contenu, $statut, $geo_long, $geo_lat) {
		$idbd = $this->bd->getBD();
		$idbd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$date = date("Y-m-d H:i:s");
		$sql = "INSERT INTO  wa_pages (	titre ,
										description_meta ,
										contenu ,
										date ,
										statut ,
										geo_long ,
										geo_lat	)
							VALUES (   :titre, 
									   :description_meta, 
									   :contenu,  
									   :date,  
									   :statut,
									   :geo_long,
									   :geo_lat )"; 
		$req = $idbd->prepare($sql);  
		$req->bindParam(':titre', $titre, PDO::PARAM_STR);       
		$req->bindParam(':description_meta', $description_meta, PDO::PARAM_STR);    
		$req->bindParam(':contenu', $contenu, PDO::PARAM_STR);
		$req->bindParam(':date', $date, PDO::PARAM_STR);
		$req->bindParam(':statut', $statut, PDO::PARAM_INT);
		$req->bindParam(':geo_long', $geo_long, PDO::PARAM_STR);   
		$req->bindParam(':geo_lat', $geo_lat, PDO::PARAM_STR);   
		//var_dump($req);
			try {
				return $req->execute();
			} catch (PDOException $e) {
				echo $e->getMessage();
			}
	}
	/** 
	 * Méthode modifier() - Modifier une page dans notre base de données en fonction de ID
	 * 
	 * @param type $id_page - Page ID
	 * @param type $titre - Page titre
	 * @param type $description_meta - Description Meta
	 * @param type $contenu - Contenu de la page
	 * @param type $statut - 0 -> invisible,  1 -> visible, 2 -> supprimé
	 * @param type $geo_long - Coordonner de longitude
	 * @param type $geo_lat - Coordonner de latitude
	 * 
	 * @return TRUE ou FALSE
	 */	
	
	public function modifier ($id_page, $titre, $description_meta, $contenu, $date, $statut, $geo_long, $geo_lat)  {
		$idbd = $this->bd->getBD();
		$idbd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$sql = "UPDATE wa_pages SET 
									titre = :titre, 
									description_meta = :description_meta, 
									contenu = :contenu,  
									date = :date,  
									statut = :statut,
									geo_long = :geo_long,
									geo_lat = :geo_lat 
									WHERE id_page = :id_page";
		$req = $idbd->prepare($sql);   
		$req->bindParam(':id_page', $id_page, PDO::PARAM_INT);  
		$req->bindParam(':titre', $titre, PDO::PARAM_STR);       
		$req->bindParam(':description_meta', $description_meta, PDO::PARAM_STR);    
		$req->bindParam(':contenu', $contenu, PDO::PARAM_STR);
		$req->bindParam(':date', $date, PDO::PARAM_STR);
		$req->bindParam(':statut', $statut, PDO::PARAM_INT);
		$req->bindParam(':geo_long', $geo_long, PDO::PARAM_STR);   
		$req->bindParam(':geo_lat', $geo_lat, PDO::PARAM_STR);   
		return $req->execute(); 
	}
	
	/**
	 * Méthode afficher() - Afficher une page en fonction de ID
	 * 
	 * @param type $id_page - Page ID
	 * 
	 * @return type array - Retourne un tableau contenant tous les champs de la page
	 */
	public function afficher ($id_page) {
		$idbd = $this->bd->getBD();
		$req = $idbd->prepare ("SELECT * FROM  `wa_pages` WHERE  `id_page` = :id_page");
		$req->bindParam(":id_page", $id_page, PDO::PARAM_INT);
        $req->execute();
		
		return $req->fetch(PDO::FETCH_ASSOC);
	}
	
	/**
	 * Méthode afficherListe() - Afficher tous les pages
	 * 
	 * @return type Array - Retourne un tableau des tableau qui contien tous les champs de la page
	 */
	public function afficherListe () {
		$idbd = $this->bd->getBD();
		$req = $idbd->prepare ("SELECT * FROM  `wa_pages`");
        $req->execute();
		
		return $req->fetchALL();
	}
	
}
?>