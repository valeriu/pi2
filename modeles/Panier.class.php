<?php
/**
 * Module Panier
 * 
 * Description de module Panier
 *
 * @author Luis Felipe Rosas
 *
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
		if(!Valider::estString($data))
			throw new Exception("Les produits doivent être un objet en string!.");

		$infoCommande = json_decode($data);
		$details = $_POST['data'];

		if(!Valider::estTableau($infoCommande))
			throw new Exception("Les produits doivent être un tableau!.");
		
		// Pour enregistrer le prix total de la commande
		$totalCommande = '';

		for($i = 0 ; $i < $nb_produit; $i++){
			$totalCommande += $infoCommande[$i]->prix * $infoCommande[$i]->quant;
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
			default :
				throw new Exception("Code provincial incorrect");				
				break;
		}

		if(!$taxes)
			throw new Exception("Code postal ne pas correct!");

		// Création de la date actuelle de la commande
		$dateCommande = date("Y-m-d H:i:s");

		$adresse = new Adresse;
		$oAdresse = $adresse->afficher(array('id_adresse' => $id_adresse));

		//Tableau de retour d'information pour la dernière étape du panier
		$tableauPanier = array('courriel' => $courriel, 'nb_produit' => $nb_produit, 'adresse'=> $oAdresse, 'info_commande'=> $infoCommande, 'total_commande'=> round($totalCommande,2), 'taxes'=> round($taxes, 2), 'tct' => round($totalCommande + $taxes,2) ) ;

		return $tableauPanier;
		
	}
}

?>
