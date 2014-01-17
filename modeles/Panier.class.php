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
	public function confirmationAdresse($aDonnees) { //$courriel='', $infoCommande='', $totalCommande=0, $produits=0

		$courriel 	= (!empty($aDonnees['email'])) ? $aDonnees['email'] : '';
		$nb_produit	= (!empty($aDonnees['nb_produit'])) ? $aDonnees['nb_produit'] : '';
		$id_adresse	= (!empty($aDonnees['id_adresse'])) ? $aDonnees['id_adresse'] : '';
		$data 		= (!empty($aDonnees['data'])) ? $aDonnees['data'] : '';
		//var_dump($courriel);
		
		if(!Valider::estCourriel($courriel))
			throw new Exception("Ce courriel est invalide");
		if(!Valider::estInt(intval($nb_produit)))
			throw new Exception("Quantite de produtis doit être un nombre");
		if(!Valider::estInt(intval($id_adresse)))
			throw new Exception("L'id de l'adresse doit éxister!");
		if(!Valider::estObject($data))
			throw new Exception("Les produits doivent être un objet!.");

		$infoCommande = json_decode($data);
		$details = $_POST['data'];
		
		// Pour enregistrer le prix total de la commande
		$totalCommande = '';		
		for($i = 0 ; $i < $nb_produit; $i++){
			$totalCommande += $infoCommande->{"$i"}->{"prix"} * $infoCommande->{"$i"}->{"quant"};
		}

		// Requête Code province Adresse
		$idbd = $this->bd->getBD();
		$reqAdd = $idbd->prepare('SELECT province FROM wa_adresse WHERE id_adresse = ?');
		$reqAdd->bindParam(1, $id_adresse);
		$reqAdd->execute();
		$codeProvinciel = $reqAdd->fetch(PDO::FETCH_ASSOC);

		if(!$codeProvinciel)
			throw new Exception("Error d'adresse, aucune adresse trouvée");
		
		switch (strtoupper($codeProvinciel['province'])) {
			case 'QC':
				$taxes = $totalCommande * (QC+CA);
				break;
			case 'ON':
				$taxes = $totalCommande * (ON+CA);
				break;
			case 'MN':
				$taxes = $totalCommande * (MN+CA);
				break;
			case 'SK':
				$taxes = $totalCommande * (SK+CA);
				break;
			case 'CB':
				$taxes = $totalCommande * (CB+CA);
				break;
			case 'NB':
				$taxes = $totalCommande * (NB+CA);
				break;
			case 'NE':
				$taxes = $totalCommande * (NE+CA);
				break;
			case 'IE':
				$taxes = $totalCommande * (IE+CA);
				break;
			case 'AL':
				$taxes = $totalCommande * (AL+CA);
				break;
			case 'TN':
				$taxes = $totalCommande * (TN+CA);
				break;
			case 'NO':
				$taxes = $totalCommande * (NO+CA);
				break;
			case 'YK':
				$taxes = $totalCommande * (YK+CA);
				break;
			case 'NV':
				$taxes = $totalCommande * (NV+CA);
				break;
		}

		if(!$taxes)
			throw new Exception("Code postal ne pas correct!");

		// Création de la date actuelle de la commande
		$dateCommande = date("Y-m-d H:i:s");

		$adresse = new Adresse;
		$oAdresse = $adresse->afficher(array('id_adresse' => $id_adresse));

		//Tableau de retour d'information pour la dernière étape du panier
		$tableauPanier = array('courriel' => $courriel, 'nb_produit' => $nb_produit, 'adresse'=> $oAdresse, 'info_commande'=> $infoCommande, 'total_commande'=> round($totalCommande,2), 'taxes'=> round($taxes, 2) ) ;

		return $tableauPanier;
		
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
