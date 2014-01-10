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
require_once 'Valider.class.php';
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
	
	public function ajouter ($aDonnees = Array()) {
		$date_modif			= date("Y-m-d H:i:s");
		$titre				= $aDonnees['titre'];
		$description_meta	= $aDonnees['description_meta'];
		$contenu			= $aDonnees['contenu'];
		$statut 			= (!empty($aDonnees['statut'])) ? $aDonnees['statut'] : 1;
		$geo_long 			= (!empty($aDonnees['geo_long'])) ? $aDonnees['geo_long'] : NULL;
		$geo_lat			= (!empty($aDonnees['geo_lat'])) ? $aDonnees['geo_lat'] : NULL;
		
		if (!empty($titre) && !Valider::estString($titre)){
			throw new Exception("Titre, doit être un string");
		}
		if (!empty($description_meta) && !Valider::estString($description_meta)){
			throw new Exception("Description meta, doit être un string");
		}
		if (!empty($contenu) && !Valider::estString($contenu)){
			throw new Exception("Contenu, doit être un string");
		}
		if (!empty($statut) && !Valider::estEntreInt($statut, 0, 2)){
			throw new Exception("Statut, doit être un nombre entre 0 et 2");
		}
		if (!empty($geo_long) && !Valider::estString($geo_long)){
			throw new Exception("Coordonner de longitude, doit être un float");
		}
		if (!empty($geo_lat) && !Valider::estString($geo_lat)){
			throw new Exception("Coordonner de latitude, doit être un float");
		}
		
		$idbd = $this->bd->getBD();
		$idbd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$sql = "INSERT INTO  wa_pages (	titre ,
										description_meta ,
										contenu ,
										date_modif ,
										statut ,
										geo_long ,
										geo_lat	)
							VALUES (   :titre, 
									   :description_meta, 
									   :contenu,  
									   :date_modif,  
									   :statut,
									   :geo_long,
									   :geo_lat )"; 
		$req = $idbd->prepare($sql);  
		$req->bindParam(':titre', $titre, PDO::PARAM_STR);       
		$req->bindParam(':description_meta', $description_meta, PDO::PARAM_STR);    
		$req->bindParam(':contenu', $contenu, PDO::PARAM_STR);
		$req->bindParam(':date_modif', $date_modif, PDO::PARAM_STR);
		$req->bindParam(':statut', $statut, PDO::PARAM_INT);
		$req->bindParam(':geo_long', $geo_long, PDO::PARAM_STR);   
		$req->bindParam(':geo_lat', $geo_lat, PDO::PARAM_STR);   
		$reponse = $req->execute();
		
		if($reponse){
				return $reponse;
			throw new Exception("Erreur lors de la ajouter, recommencez");
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
	
	public function modifier ($aDonnees = Array())  {
		$id_page			= $aDonnees['id_page'];
		$date_modif			= date("Y-m-d H:i:s");
		$titre				= $aDonnees['titre'];
		$description_meta	= $aDonnees['description_meta'];
		$contenu			= $aDonnees['contenu'];
		$statut 			= (!empty($aDonnees['statut'])) ? $aDonnees['statut'] : 1;
		$geo_long 			= (!empty($aDonnees['geo_long'])) ? $aDonnees['geo_long'] : NULL;
		$geo_lat			= (!empty($aDonnees['geo_lat'])) ? $aDonnees['geo_lat'] : NULL;
		
		if(!Valider::estInt($id_page)){
			throw new Exception("Id page non conforme");
		}
		if (!empty($titre) && !Valider::estString($titre)){
			throw new Exception("Titre, doit être un string");
		}
		if (!empty($description_meta) && !Valider::estString($description_meta)){
			throw new Exception("Description meta, doit être un string");
		}
		if (!empty($contenu) && !Valider::estString($contenu)){
			throw new Exception("Contenu, doit être un string");
		}
		if (!empty($statut) && !Valider::estEntreInt($statut, 0, 2)){
			throw new Exception("Statut, doit être un nombre entre 0 et 2");
		}
		if (!empty($geo_long) && !Valider::estString($geo_long)){
			throw new Exception("Coordonner de longitude, doit être un float");
		}
		if (!empty($geo_lat) && !Valider::estString($geo_lat)){
			throw new Exception("Coordonner de latitude, doit être un float");
		}
		
		$idbd = $this->bd->getBD();
		$idbd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$sql = "UPDATE wa_pages SET 
									titre = :titre, 
									description_meta = :description_meta, 
									contenu = :contenu,  
									date_modif = :date_modif,  
									statut = :statut,
									geo_long = :geo_long,
									geo_lat = :geo_lat 
									WHERE id_page = :id_page";
		$req = $idbd->prepare($sql);   
		$req->bindParam(':id_page', $id_page, PDO::PARAM_INT);  
		$req->bindParam(':titre', $titre, PDO::PARAM_STR);       
		$req->bindParam(':description_meta', $description_meta, PDO::PARAM_STR);    
		$req->bindParam(':contenu', $contenu, PDO::PARAM_STR);
		$req->bindParam(':date_modif', $date_modif, PDO::PARAM_STR);
		$req->bindParam(':statut', $statut, PDO::PARAM_INT);
		$req->bindParam(':geo_long', $geo_long, PDO::PARAM_STR);   
		$req->bindParam(':geo_lat', $geo_lat, PDO::PARAM_STR);   
		
		$reponse = $req->execute();
		
		if($reponse){
				return $reponse;
			throw new Exception("Erreur lors de la modification, recommencez");
		}
	}
	
	/**
	 * Méthode afficher() - Afficher une page en fonction de ID
	 * 
	 * @param type $id_page - Page ID
	 * 
	 * @return type array - Retourne un tableau contenant tous les champs de la page
	 */
	public function afficher ($aDonnees = array()) {
		$id_page			= $aDonnees['id_page'];
		
		if(!Valider::estInt($id_page)){
			throw new Exception("Id page non conforme");
		}
		
		$idbd = $this->bd->getBD();
		$req = $idbd->prepare ("SELECT * FROM  `wa_pages` WHERE  `id_page` = :id_page");
		$req->bindParam(":id_page", $id_page, PDO::PARAM_INT);
        
		$reponse = $req->execute();
		
		if($reponse){
				return $req->fetch(PDO::FETCH_ASSOC);
			throw new Exception("Erreur lors de la modification, recommencez");
		}
	}
	
	/**
	 * Méthode afficherListe() - Afficher tous les pages
	 * 
	 * @return type Array - Retourne un tableau des tableau qui contien tous les champs de la page
	 */
	public function afficherListe () {
		$idbd = $this->bd->getBD();
		$req = $idbd->prepare ("SELECT * FROM  `wa_pages`");
		$reponse = $req->execute();
	
		if($reponse){
				return $req->fetchALL();
			throw new Exception("Erreur lors de la modification, recommencez");
		}
	}
	
}
?>