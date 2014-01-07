<?php
/**
 * Description of Pagination
 *
 * @author valeriu
 */
 class Pagination{
        
	private $pages;

	public function paginate($aTousElements, $parPage=10){ 

			$nbTousElements = count($aTousElements);

			if(isset($_GET['page'])){
					$pageCourante = $_GET['page'];
			} else{
					$pageCourante = 1;
			}

			$nbPages = ceil($nbTousElements/$parPage);
			$offset = ($pageCourante-1)*$parPage;
			$this->pages = array_slice($aTousElements, $offset, $parPage);

			for($i=1; $i<=$nbPages; $i++){
					$numbers[] = $i;
			}
			return $numbers;
	}

	public function voirRsultats(){
			$voirRsultats = $this->pages;
			return $voirRsultats;
	}
}

?>
