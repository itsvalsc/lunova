<?php

/**
 * La classe FConnectionDB permette di creare una connessione con il database
 * @package Foundation
 */

if (file_exists('./inc/configdb.php')) {
    require_once './inc/configdb.php';
}

class FConnectionDB{
	private static $instance;

	public static function connect() {

        if (!isset(self::$instance)) {
            try {
                //self::$instance = new PDO ("mysql:host=" . $GLOBALS['hostname'] . ";dbname=" . $GLOBALS['dbname'], $GLOBALS['user'], $GLOBALS['password']);
                self::$instance = new PDO ('mysql:dbname='. DB_NAME .';host=' . DB_HOST, DB_USER, DB_PASS);

            } catch (PDOException $e) {
                echo "Errore in FConnectionDB: " . $e->getMessage();
                die;
            }
        }

        return self::$instance;
    }
}