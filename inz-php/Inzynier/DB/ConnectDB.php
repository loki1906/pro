<?php

class ConnectDB {

    private static $_instance = null;
    public $_pdo ;
    private $host = 'localhost',
            $db = 'test_inz',
            $login = 'jar0slaw',
            $pass = 'ossowski';

    private function __construct() {
        try {
            $this->_pdo = new PDO('mysql:host=' . $this->host . ';dbname=' . $this->db, $this->login, $this->pass); 
//            echo "Połączyło z bazą!</br>";
        } catch (PDOException $e) {
            die($e->getMessage());
        }
    }

    public static function getInstance() { 
        if (!isset(self::$_instance)) {
            self::$_instance = new ConnectDB();
        }
        return self::$_instance;
    }
    
    
    
}
