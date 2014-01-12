<?php
/**
 * Description of Pagination
 *
 * @author valeriu
 */
 class Pagination{
        
	private $pages;

	public function paginate($aDonnees = Array()){ 
		
		$aTousElements	= $aDonnees['aTousElements'];
		$parPage		= (!empty($aDonnees['parPage'])) ? $aDonnees['parPage'] : 20;
		$pageCourante	= (!empty($aDonnees['pageCourante'])) ? $aDonnees['pageCourante'] : 1;
			
		if (!empty($aTousElements) && !Valider::estTableau($aTousElements)){
			throw new Exception("Tous Elements, doit être un Tableau");
		}
		if (!Valider::estInt($parPage)){
			throw new Exception("Nombre de item par Page, doit être un nombre");
		}
		if (!Valider::estInt($pageCourante)){
			throw new Exception("Page Courante, doit être un nombre");
		}
			
		$nbTousElements = count($aTousElements);
		$nbPages = ceil($nbTousElements/$parPage);
		$offset = ($pageCourante-1)*$parPage;
		$this->pages = array_slice($aTousElements, $offset, $parPage);

		for($i=1; $i<=$nbPages; $i++){
			$nombre[$i]["page"] = $i;
			$nombre[$i]["partir"] = $i*$parPage-$parPage;
			$nombre[$i]["fin"] = $i*$parPage;
		}
		
		//print_r($nombre);
		return $nombre;
		
	}

	public function voirResultats(){
			$voirRsultats = $this->pages;
			return $voirRsultats;
	}
}

?>
