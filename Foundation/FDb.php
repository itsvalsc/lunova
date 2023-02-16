<?php
	if (file_exists('./inc/configdb.php'))
	{ require_once './inc/configdb.php'; }

    class FDb{
		/** Istanza della classe */
    	private static FDb $instance;

	    /** Oggetto PDO che effettua la connessione al DB */
	    private PDO $db;

        public $pdo;
	 	
        public function __construct() {
	    	
	 		try {
            $this->db = new PDO('mysql:dbname='. DB_NAME .';host=' . DB_HOST, DB_USER, DB_PASS);
	        } catch (PDOException $e) {
	            echo "DB Connection Failed" . $e->getMessage();
  				die;
  			}
	  	}
	  	/**
	     * Metodo che restituisce l'unica istanza dell'oggetto DB
	     * @return FDb
	     */
	    public static function getInstance(): FDb
	    {
	        if (!isset(FDb::$instance)) {
	            $class = __CLASS__;
	            FDb::$instance = new $class;
	        }
	        return FDb::$instance;
	    }
    }

?>