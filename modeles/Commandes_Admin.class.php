<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Commandes_Admin
 *
 * @author valeriu
 */
class Commandes_Admin {
	private $bd;
	
	/**
	 *  Méthode __construct() - Instancie la base de données
	 */
	
	public function __construct(){
		$this->bd = BD::getInstance();
	}

	/**
	 * Méthode afficher() - Afficher une page en fonction de ID
	 * 
	 * @param type $id_page - Page ID
	 * 
	 * @return type array - Retourne un tableau contenant tous les champs de la page
	 */
	public function afficher ($aDonnees = array()) {
		$id_commande			= intval($aDonnees['id_commande']);
		
		if(!Valider::estInt($id_commande)){
			throw new Exception("Id commande ne pas valide");
		}
		
		$idbd = $this->bd->getBD();
		$req = $idbd->prepare ("SELECT * FROM  `wa_commandes` WHERE  `id_commandes` = :id_commande");
		$req->bindParam(":id_commande", $id_commande, PDO::PARAM_INT);
        
		$reponse = $req->execute();
		
		if($reponse){
				return $req->fetch(PDO::FETCH_ASSOC);
			throw new Exception("Erreur lors de la modification, recommencez");
		}
	}
	
	/**
	 * Méthode afficherListe() - Afficher tous les commandes
	 * 
	 * @return type Array - Retourne un tableau des tableau qui contien tous les l'information général des commandes
	 */
	public function afficherListe () {
		$idbd = $this->bd->getBD();
		$req = $idbd->prepare ("SELECT * FROM  `wa_commandes`");
		$reponse = $req->execute();
	
		if($reponse){
				return $req->fetchALL();
			throw new Exception("Erreur lors de la modification, recommencez");
		}
	}

	public function modifier ($aDonnees = Array())  {
		$id_commande		= $aDonnees['id_commande'];
		$commentaire	= $aDonnees['commentaire'];
		$statut 			= (!empty($aDonnees['statut'])) ? $aDonnees['statut'] : 1;
		
		if(!Valider::estInt($id_commande)){
			throw new Exception("Id commande non conforme");
		}
		if (!empty($titre) && !Valider::estString($commentaire)){
			throw new Exception("Le commentaire, doit être un string");
		}
		if (!empty($statut) && !Valider::estEntreInt($statut, 0, 3)){
			throw new Exception("Statut, doit être un nombre entre 0 et 2");
		}
	
		$idbd = $this->bd->getBD();
		$idbd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$sql = "UPDATE wa_commandes SET 
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
	
}

?>
