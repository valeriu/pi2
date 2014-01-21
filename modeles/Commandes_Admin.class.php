<?php
/**
 * Module Commande
 * 
 * Description des commandes admin
 *
 * @author Luis Felipe Rosas
 *
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
		$req = $idbd->prepare ("SELECT  wa_commandes.id_commandes AS id_commandes,
										wa_commandes.date_commande AS date_commande,
										wa_commandes.total_commande AS total_commande,
										wa_commandes.statut AS statut,
										wa_commandes.token AS token,
										wa_commandes.utilisateurs_id_utilisateurs AS utilisateurs_id_utilisateurs,
										wa_utilisateurs.nom_prenom AS nom
								FROM  wa_commandes
								INNER JOIN wa_utilisateurs ON wa_commandes.utilisateurs_id_utilisateurs = wa_utilisateurs.id_utilisateurs
								WHERE wa_commandes.token != 'NULL' ORDER BY wa_commandes.date_commande DESC ");
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

	public function enregistreCommande($aDonnees= array()) {
		
		$courriel		= (!empty($aDonnees['courriel'])) ? $aDonnees['courriel'] : '';
		$id_adresse 	= (!empty($aDonnees['adresse']['id_adresse'])) ? $aDonnees['adresse']['id_adresse'] : 0;
		$total_commande = (!empty($aDonnees['tct'])) ? $aDonnees['tct'] : 0;
		$nb_produit		= (!empty($aDonnees['nb_produit'])) ? $aDonnees['nb_produit'] : 0;


		// Permière étape ******************
		$idbd = $this->bd->getBD();
		$reqUt = $idbd->prepare('SELECT id_utilisateurs FROM wa_utilisateurs WHERE courriel = ?');
		$reqUt->bindParam(1, $courriel);
		$reqUt->execute();

		$verifUt = $reqUt->fetch();

		if(!$verifUt){
			throw new Exception("Id Utilisateur ou courriel sont pas valides");
		}else{
			$id_utilisateurs = $verifUt['id_utilisateurs'];
		}

		// Deuxième étape ******************
		$reqAdd = $idbd->prepare('SELECT id_adresse_utilisateur FROM wa_adresse_utilisateur WHERE adresse_id_adresse = ? AND utilisateurs_id_utilisateurs = ?');
		$reqAdd->bindParam(1, $id_adresse);
		$reqAdd->bindParam(2, $id_utilisateurs);
		$reqAdd->execute();

		$verifAdd = $reqAdd->fetch();
		
		if(!$verifAdd){
			throw new Exception("L'adresse n'a pas été trouvée!.");
		}else{
			$id_adresse_utilisateur = $verifAdd['id_adresse_utilisateur'];
		}

		if(!Valider::estInt(intval($id_utilisateurs)))
			throw new Exception("Un id d'utilisateur doit exister comme nombre!.");
		if(!Valider::estInt(intval($id_adresse_utilisateur)))
			throw new Exception("Un id d'addresse doit exister comme nombre!.");
		if(!Valider::estInt(intval($total_commande)))
			throw new Exception("Le total de la commande doit être comme nombre!.");
		if(!Valider::estInt(intval($nb_produit)))
			throw new Exception("La quantite des produtis doit être comme nombre!.");


		// Troisième étape ******************
		$date_commande = date("Y-m-d H:i:s");

		//var_dump($total_commande);
		//BD wp_commandes
		$reqC = $idbd->prepare(	"INSERT INTO wa_commandes
								(id_commandes, statut, adresse_utilisateur_id_adresse_utilisateur, date_commande, utilisateurs_id_utilisateurs, total_commande, token)
								VALUES (null, 0, ?, ?, ?, ?, null)");

		$reqC->bindParam(1, $id_adresse_utilisateur);
		$reqC->bindParam(2, $date_commande);
		$reqC->bindParam(3, $id_utilisateurs);
		$reqC->bindParam(4, $total_commande);
		$resultat = $reqC->execute();

		$idCommande = $idbd->lastInsertId();

		if(!$resultat)
			throw new Exception("Error à l'insertion de la commande!");

		// Quatrième étape ******************

		//BD wp_commande_produit
		$reqProduit = $idbd->prepare("INSERT INTO wa_commande_produit 
									(quantite, produits_id_produits, commandes_id_commandes) 
									VALUES (?, ?, ?)");

		for($i = 0 ; $i < $nb_produit; $i++){
			$reqProduit->bindParam(1, $aDonnees['info_commande'][$i]->quant);
			$reqProduit->bindParam(2, $aDonnees['info_commande'][$i]->idP);
			$reqProduit->bindParam(3, $idCommande);
			$resultat = $reqProduit->execute();	
			
			if(!$resultat)
				throw new Exception("Error d'insertion de la commande au niveau d'un produit!");
		}
		$idCommandeProduit = $idbd->lastInsertId();

		if($idCommande && $idCommandeProduit){
			$_SESSION['id_commande'] = $idCommande; 
			return true;
		}else
			throw new Exception("Error de l'enregistrement de la commande");
	}

	public function modifieToken($nbToken = null) {

		$id_commandes = $_SESSION['id_commande'];

		$idbd = $this->bd->getBD();
		$reqCommande = $idbd->prepare('UPDATE wa_commandes SET token = ? WHERE id_commandes = ?');
		$reqCommande->bindParam(1, $nbToken);
		$reqCommande->bindParam(2, $id_commandes);
		$reqCommande->execute();

		if($reqCommande->rowCount() == 0)
			throw new Exception("Error token");
			

	}
	
}

?>
