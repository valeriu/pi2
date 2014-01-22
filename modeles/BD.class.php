<?php
/**
 * Module base de donnees
 * Connexion a la base de donnees avec 
 *
 * En utilisant la méthode singleton (un patron de conception)
 * 
 * http://fr.wikipedia.org/wiki/Singleton_(patron_de_conception)
 */

class BD {
	
	private static $instance = null;
	
    //private 
    private $idbd;
	
	/**
	 * Constructeur du classe
	 * 
	 * @throws Exception
	 */
    private function __construct() {
        $dsn = "mysql:host=".HOST.";dbname=".BD;
        $user = USER;
        $pass = PASS;
        $this->idbd = new PDO($dsn,$user,$pass);
        $this->idbd->exec('SET NAMES UTF8');
        if (!$this->idbd) {
            throw new Exception("Connexion Impossible a la base de donnees : ".HOST);
        }
    }
    
	/**
	 * 
	 * @return type Instance du Base de Donnees
	 */
    public static function getInstance() {
        if(is_null(self::$instance)) {
            self::$instance = new BD();
        }
        return self::$instance;
    }

	public function getBD(){
		return $this->idbd;
	}
    
}

?>