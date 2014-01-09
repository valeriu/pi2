<?php

/*
 * Menu
 * status
 *	* 0 - invisible
 *  * 1 - visible
 *  * 2 - supprimé
 * 
 * parent 
 *	* 0 - root menu
 * 
 */

/**
 * Description of Menu
 * http://wizardinternetsolutions.com/articles/web-programming/dynamic-multilevel-css-menu-php-mysql
 *
 * @author Valeriu et Luc
 */
class Menu {
	private $bd;
	
	public function __construct(){
		$this->bd = BD::getInstance();
	}
	
	
	public function enregistrer ($aDonnees = Array()) {
		//id_menu	titre	description	url	parent	order	statut
		$titre 			= (!empty($aDonnees['titre'])) ? $aDonnees['titre'] : '';
		$description 	= (!empty($aDonnees['description'])) ? $aDonnees['description'] : null;
		$url 			= (!empty($aDonnees['url'])) ? $aDonnees['url'] : '';
		$parent 		= (!empty($aDonnees['parent'])) ? $aDonnees['parent'] : 0;
		$ordre 			= (!empty($aDonnees['ordre'])) ? $aDonnees['ordre'] : 0;
		$statut 		= (!empty($aDonnees['statut'])) ? $aDonnees['statut'] : 0;

		if(!Valider::estString($titre)){
			throw new Exception("Entrez un titre valide");
		}

		$idbd = $this->bd->getBD();
		//Vérification de l'existence d'un titre semblable 
		$req = $idbd->prepare( 	"SELECT * FROM  `wa_menu`
								 WHERE titre = ?");

		$req->bindParam(1, $titre);
		$req->execute();
		$obj = $req->fetch(PDO::FETCH_ASSOC);
		//var_dump($obj);
		if($obj){
			throw new Exception("Ce titre existe déjà");
		}
        else{
			//Préparation de la requête
			$reqInsertion = $idbd->prepare(	"INSERT INTO wa_menu
									(titre, description, url, parent, ordre, statut)
									VALUES (?, ?, ?, ?, ?, ?)");
	        
			
			//var_dump($statut);
	        $reqInsertion->bindParam(1, $titre);
	        $reqInsertion->bindParam(2, $description);
	        $reqInsertion->bindParam(3, $url);
	        $reqInsertion->bindParam(4, $parent);
	        $reqInsertion->bindParam(5, $ordre);
	        $reqInsertion->bindParam(6, $statut);
			
			$reponseInsertion = $reqInsertion->execute();
			
			if($reponseInsertion){
				return $reponseInsertion;
			}
	        else{
				throw new Exception("Une erreur s'est produite lors de l'enregistrement, recommencez");
			}
		}
							
		
	} 
	
	public function modifier ($id) {
		$req_sql = "";
	}
	
	public function afficherListe ($id) {
		$req_sql = "SELECT * FROM  `wa_menu`";
	}
}

?>
