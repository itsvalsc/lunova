<?php

class FConnectionDB{
	private static $instance;

	public static function connect() {

        if (!isset(self::$instance)) {
            try {
                self::$instance = new PDO ("mysql:host=" . $GLOBALS['hostname'] . ";dbname=" . $GLOBALS['dbname'], $GLOBALS['user'], $GLOBALS['password']);

            } catch (PDOException $e) {
                echo "Errore in FConnectionDB: " . $e->getMessage();
                die;
            }
        }

        return self::$instance;
    }



}