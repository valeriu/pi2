<?php

class BD{
	private static $instance = null;
    //private 
    private $idbd;

    private function __construct() {
        $dsn = "mysql:host=".HOST.";dbname=".BD;
        $user = USER;
        $pass = PASS;
        $this->idbd = new PDO($dsn,$user,$pass);
        $this->idbd->exec('SET NAMES UTF8');
        if (!$this->idbd) {
            throw new Exception("Connexion Impossible à la base de données : ".HOST);
        }
    }
    
    public static function getInstance() {
        if(is_null(self::$instance)) {
            self::$instance = new BD();
        }
        return self::$instance;
    }

    
}

?>