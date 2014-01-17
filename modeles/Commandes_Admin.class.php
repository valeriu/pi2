<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Commandes_Admin
 *
 * @author Luis Rosas
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
	 * Méthode afficher() - Afficher une commande en fonction de ID
	 * 
	 * @param type $id_commande - Commande ID
	 * 
	 * @return type array - Retourne un tableau contenant tous les champs de la commande
	 */
	public function afficher ($aDonnees = array()) {
		$id_commande = (!empty($aDonnees['id_commande'])) ? $aDonnees['id_commande'] : '';

		if(!$id_commande)
			throw new Exception("Pas de id Commande");
		
		if(!Valider::estInt(intval($id_commande))) {
			throw new Exception("Id commande ne pas valide");
		}
		
		$idbd = $this->bd->getBD();
		$req = $idbd->prepare ("SELECT * FROM  `wa_commandes` WHERE  `id_commandes` = :id_commande");
		$req->bindParam(":id_commande", $id_commande, PDO::PARAM_INT);
        
		$reponse = $req->execute();

		$obj = $req->fetch(PDO::FETCH_ASSOC);
		
		if($obj){
			return $obj;
		}else{
			throw new Exception("Commande ne pas trouvée");
		}
	}
	
	/**
	 * Méthode afficherListe() - Afficher tous les commandes
	 * 
	 * @return type Array - Retourne un tableau des tableau qui contien tous les l'information général des commandes
	 */
	public function afficherListe () {
		$idbd = $this->bd->getBD();
		$req = $idbd->prepare ("SELECT * FROM  wa_commandes ORDER BY date_commande DESC ");
		$reponse = $req->execute();
	
		if($reponse){
				return $req->fetchALL();
			throw new Exception("Erreur lors de la modification, recommencez");
		}
	}

	/**
	 * Méthode modifier() - Modifier une commande spécifique
	 * 
	 * @param type $commande-modifier - Page titre
	 * @param type $commande_id - Description Meta
	 * @param type $commande-commentaires - Contenu de la page
	 * @param type $statut (optionsRadios) - 0 -> en-traitement,  1 -> backorder, 2 -> expedié, 3 -> anullé
	 *
	 * @return type Array - Retourne un tableau des tableau qui contient l'information de la commande et ses modifications
	 */
	public function modifier ($aDonnees = array()) {

		if(isset($aDonnees["commande-modifier"])){
			$id_commandes		= intval($aDonnees["commande_id"]);
			$commentaires		= $aDonnees["commande-commentaires"];
			$statut				= intval($aDonnees["optionsRadios"]);
		}
		if(!Valider::estInt($id_commandes)){
			throw new Exception("Id commande non conforme");
		}
		if (!empty($commentaires) && !Valider::estString($commentaires)){
			throw new Exception("Le commentaire, doit être un string");
		}
		if (!empty($statut) && !Valider::estEntreInt($statut, 0, 3)){
			throw new Exception("Statut, doit être un nombre entre 0 et 3");
		}
		
		$idbd = $this->bd->getBD();
		$idbd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$sql = "UPDATE wa_commandes SET
									commentaires = :commentaires,
									statut = :statut
									WHERE id_commandes = :id_commandes";
		$req = $idbd->prepare($sql);  
		$req->bindParam(':id_commandes', $id_commandes, PDO::PARAM_INT);  
		$req->bindParam(':commentaires', $commentaires, PDO::PARAM_STR);       
		$req->bindParam(':statut', $statut, PDO::PARAM_INT);  
		
		$reponse = $req->execute();
		
		if($reponse)
			return $reponse;
			throw new Exception("Erreur lors de la modification, recommencez");
	}
	
}

?>
