<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Panier
 *
 * @author Luis
 */
class Panier {
	
	private $bd;
	
	public function __construct(){
		$this->bd = BD::getInstance();
	}

	// Methode de création d'une commande
	public function etapeUnPanier($aDonnees, $info) { //$courriel='', $infoCommande='', $totalCommande=0, $produits=0

		$courriel 		= (!empty($aDonnees['email'])) ? $aDonnees['email'] : '';
		$quantite 		= (!empty($aDonnees['quantite'])) ? $aDonnees['quantite'] : '';
		$data 	= (!empty($aDonnees['data'])) ? $aDonnees['data'] : '';
		//var_dump($courriel);
		
		if(!Valider::estCourriel($courriel))
			throw new Exception("Ce courriel est invalide");		
		//if(!Valider::estTableau($data))
			//throw new Exception("Les produits doivent être dans un tableau!.");
		//if(!Valider::estInt($quantite))
			//throw new Exception("Quantite, doit être un nombre");

		$infoCommande = json_decode($data);
		$details = $_POST['data'];
		$totalCommande = '';
		$nbProduits = intval($_POST['quantite']);


		// Pour enregistrer le prix total de la commande
		for($i = 0 ; $i < $quantite; $i++){
			$totalCommande += $infoCommande->{"$i"}->{"prix"} * $infoCommande->{"$i"}->{"quant"};
		}
		// Création de la date actuelle de la commande
		$dateCommande = date("Y-m-d H:i:s");

		// Bonne insertion dans la BD :)
		// Ajoute de htmlentities() et addslashes()
		//$info = $this->maDB->executer("INSERT INTO infoCommandeTP3 (email, dateCommande, details, total, produits) values ('".htmlentities($courriel)."', '".$dateCommande."', '".addslashes($infoCommande)."', ".$totalCommande.", ".$produits." )");
		var_dump($infoCommande);

		$info = ''.$courriel.'-'.$totalCommande.'-'.'-'.$dateCommande.' - DETAILS'.$details;

		return $info;
		
	}

	public function enregistrePanier($aDonnees= array()) {
		
		$id_utilisateur = (!empty($aDonnees['id_utilisateur'])) ? $aDonnees['id_utilisateur'] : '';
		$id_adresse = (!empty($aDonnees['adresse_utilisateur'])) ? $aDonnees['adresse_utilisateur'] : '';
		$quantite = (!empty($aDonnees['quantite'])) ? $aDonnees['quantite'] : '';
		$produits = (!empty($aDonnees['produits'])) ? $aDonnees['produits'] : '';

		if(!Valider::estInt($id_utilisateur))
			throw new Exception("Un id d'utilisateur doit exister comme nombre!.");
		if(!Valider::estInt($id_adresse))
			throw new Exception("Un id d'addresse doit exister comme nombre!.");
		if(!Valider::estInt($quantite))
			throw new Exception("Une quantite doit être un entier positif!.");
		if(!Valider::estTableau($produits))
			throw new Exception("Les produits doivent être dans un tableau!.");

		$idbd = $this->bd->getBD();
		
		// Permière étape ******************
		$reqAdd = $idbd->prepare('SELECT id_adresse_utilisateur FROM wa_adresse_utilisateur WHERE adresse_id_adresse = ? AND utilisateurs_id_utilisateurs = ?');
		$reqAdd->bindParam(1, $id_adresse);
		$reqAdd->bindParam(2, $id_utilisateur);
		$reqAdd->execute();

		$verifAdd = $reqAdd->fetchAll();
		
		if(count($verifAdd) == 0)
			throw new Exception("L'adresse n'est pas valide!.");

		// Deuxième étape ******************
		$reqPC = 'SELECT id_produits FROM wa_produits';
		$resultat = $idbd->query($reqPC);

		$produitsCatalogue = $resultat->fetchAll();

		for($i = 0 ; $i < count($produits); $i++){
			if(!Valider::estInt($produits[$i]['id_produits']))
				throw new Exception("Les produits doivent être des entiers positifs !.");
			if(!Valider::estInt($produits[$i]['quantite']))
				throw new Exception("Le quantite de chacun des produits doivent être des entiers positifs !.");

			$verfIdProduit[] = array('id_produits'=>$produits[$i]['id_produits']);
		}

		// Vérification de l'existance des produits
		$comparaison = array_intersect($verfIdProduit, $produitsCatalogue);
		if(count($comparaison) != count($verfIdProduit))
			throw new Exception("Error de comparaison des tableaux!");
			

		// Troisième étape ******************
		$dateCommande = date("Y-m-d H:i:s");

		//BD wp_commandes
		$reqC = $idbd->prepare(	"INSERT INTO wa_commandes
								(id_commandes, statut, adresse_utilisateur_id_adresse_utilisateur, date_commande)
								VALUES (null, 0, ?, ?)");

		$reqC->bindParam(1, $verifAdd[0]['id_adresse_utilisateur']);
		$reqC->bindParam(2, $dateCommande);
		$resultat = $reqC->execute();

		$idCommande = $idbd->lastInsertId();

		if(!$resultat)
			throw new Exception("Error d'insertion de la commande, table wa_commandes!");

		// Quatrième étape ******************

		//BD wp_commande_produit
		$reqProduit = $idbd->prepare("INSERT INTO wa_commande_produit 
									(quantite, produits_id_produits, commandes_id_commandes) 
									VALUES (?, ?, ?)");

		for($i = 0 ; $i < count($produits); $i++){
			$reqProduit->bindParam(1, $produits[$i]['quantite']);
			$reqProduit->bindParam(2, $produits[$i]['id_produits']);
			$reqProduit->bindParam(3, $idCommande);
			$resultat = $reqProduit->execute();	
			
			if(!$resultat)
				throw new Exception("Error d'insertion de la commande par produit, table wa_commmade_produit!");
		}
		$idCommandeProduit = $idbd->lastInsertId();

		if($idCommande && $idCommandeProduit)
			return true;
		else
			return false;

	}



}

?>
