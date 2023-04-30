<?php

/**
 * La classe FCliente permette la comunicazione tra db e l'stanza di un oggetto ECliente
 * @package Foundation
 */

class FCliente{

    /**
     * metodo che verifica l'esistenza di un cliente nel db
     * @package Foundation
     */
    public static function exist($email) : bool {
	    $pdo = FConnectionDB::connect();
	    $query = "SELECT * FROM cliente WHERE Email = :email";
	    $stmt= $pdo->prepare($query);
	    $stmt->execute([":email" => $email]);
	    $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
	    if (count($rows)==0){
		    return false;
	    }
	    else {
		    return true;
	    }
    }

    /**
     * metodo che verifica l'esistenza dello username del cliente nel db
     * @package Foundation
     */
    public static function exist_username($Username) : bool {
	    $pdo = FConnectionDB::connect();
	    $query = "SELECT * FROM cliente WHERE Username = :username";
	    $stmt= $pdo->prepare($query);
	    $stmt->execute([":username" => $Username]);
	    $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
	    if (count($rows)==0){
		    return false;
	    }
	    else {
		    return true;
	    }
    }
    /**
     * metodo che verifica l'esistenza dell' id del cliente nel db
     * @package Foundation
     */
    public static function exist_id($id) : bool {
	    $pdo = FConnectionDB::connect();
	    $query = "SELECT * FROM cliente WHERE IdCliente = :id";
	    $stmt= $pdo->prepare($query);
	    $stmt->execute([":id" => $id]);
	    $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
	    if (count($rows)==0){
		    return false;
	    }
	    else {
		    return true;
	    }
    }
    /**
     * metodo che memorizza un'istanza di EClient sul database
     * @param ECliente $cliente
     */
    public static function store(ECliente $cliente): void {
        $pdo = FConnectionDB::connect();
        $query = "INSERT INTO cliente VALUES(:IdCliente,:Email,:Username,:Nome,:Cognome,:Via,:NCivico,:Provincia,:Citta,:CAP,:NTelefono,:Password,:Livello,:Bannato)";
        $stmt = $pdo->prepare($query);
        $stmt->execute(array(
            ':IdCliente' => $cliente->getIdClient(),
            ':Email' => $cliente->getEmail(),
            ':Username' => $cliente->getUsername(),
            ':Nome'  =>$cliente->getNome(),
            ':Cognome' =>$cliente->getCognome(),
            ':Via' =>$cliente->getVia(),
            ':NCivico' =>$cliente->getNumeroCivico(),
            ':Provincia' =>$cliente->getProvincia(),
            ':Citta' =>$cliente->getCitta(),
            ':CAP' =>$cliente->getCAP(),
            ':NTelefono' =>$cliente->getTelefono(),
            ':Password' =>$cliente->criptaPassword($cliente->getPassword()),
            ':Livello' =>$cliente->getLivello(),
            ':Bannato' =>$cliente->getBannato()
        ));
    }

    /**
     * metodo che permette la cancellazione dell'stanza di ECliente dal db
     * @package Foundation
     */
    public static function delete(string $email) {
        $pdo=FConnectionDB::connect();

        try {
            $ifExist = self::exist($email);
            if($ifExist) {
                $query = "DELETE FROM cliente WHERE Email= :email";
                $stmt = $pdo->prepare($query);
                $stmt->execute([":email" => $email]);
                return true;
            }
            else{ return false;}
        }
        catch(PDOException $exception) {print("Errore".$exception->getMessage());}

    }

    /**
     * metodo che permette di caricare un oggetto ECliente prendendo i dati dal db
     * @package Foundation
     */
    public static function load(string $email) {
        $pdo=FConnectionDB::connect();
        try {
            $ifExist = self::exist($email);
            if($ifExist) {
                $query = "SELECT * FROM cliente WHERE Email= :email";
                $stmt = $pdo->prepare($query);
                $stmt->execute( [":email" => $email] );
                $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

                $Idcliente = $rows[0]['IdCliente'];
                $Email = $rows[0]['Email'];
                $Username = $rows[0]['Username'];
                $Nome = $rows[0]['Nome'];
                $Cognome = $rows[0]['Cognome'];
                $Via = $rows[0]['Via'];
                $NumeroCivico = $rows[0]['NCivico'];
                $Provincia = $rows[0]['Provincia'];
                $Citta = $rows[0]['Citta'];
                $CAP = $rows[0]['CAP'];
                $Telefono = $rows[0]['NTelefono'];
                $Password = $rows[0]['Password'];
                $Bannato = $rows[0]['Bannato'];
                //$Livello = $rows[0]['Livello'];
                $immagine = FImmagine::load($Idcliente);
                $utente = new ECliente($Email,$Username,$Nome,$Cognome,$Via,$NumeroCivico,$Provincia,$Citta,$CAP,$Telefono,$Password,$Idcliente,$Bannato);
                $utente->setImmProfilo($immagine);
                return $utente;
            }
            else {return "Non ci sono clienti";}
        }
        catch (PDOException $exception) { print ("Errore".$exception->getMessage());}
    }

    /**
     * metodo che permette di caricare tutte le istanze di ECliente presenti nel db passandogli come parametro di ricerca l'id
     * @package Foundation
     */
    public static function loadId(string $id) {
        try {
            $pdo=FConnectionDB::connect();
            $query = "SELECT * FROM cliente WHERE IdCliente= :id";
            $stmt = $pdo->prepare($query);
            $stmt->execute( [":id" => $id] );
            $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
        }catch (Exception $a){
            throw new Exception('errore nel caricamento dell utente');
        }
        if (count($rows)==0){
                throw new Exception('utente non trovato');
            }else{
                $Idcliente = $rows[0]['IdCliente'];
                $Email = $rows[0]['Email'];
                $Username = $rows[0]['Username'];
                $Nome = $rows[0]['Nome'];
                $Cognome = $rows[0]['Cognome'];
                $Via = $rows[0]['Via'];
                $NumeroCivico = $rows[0]['NCivico'];
                $Provincia = $rows[0]['Provincia'];
                $Citta = $rows[0]['Citta'];
                $CAP = $rows[0]['CAP'];
                $Telefono = $rows[0]['NTelefono'];
                $Password = $rows[0]['Password'];
                $Bannato = $rows[0]['Bannato'];
                //$Livello = $rows[0]['Livello'];
                $immagine = FImmagine::load($Idcliente);
                $utente = new ECliente($Email,$Username,$Nome,$Cognome,$Via,$NumeroCivico,$Provincia,$Citta,$CAP,$Telefono,$Password,$Idcliente,$Bannato);
                $utente->setImmProfilo($immagine);
                return $utente;
            }
    }

    /**
     * metodo che permette di aggiornare l'istanza di ECliente nel db
     * @package Foundation
     */
    public static function update(ECliente $cl) : bool{
        $pdo = FConnectionDB::connect();
        $query = "UPDATE cliente SET Email = :email, Username = :username, Nome = :nome, Cognome = :cognome,Via = :via, NCivico = :ncivico, Provincia = :provincia, Citta = :citta, CAP = :cap,NTelefono = :ntelefono, Password = :password, Livello = :livello, Bannato = :bannato   WHERE Email = :email";
        $stmt=$pdo->prepare($query);
        $ris = $stmt->execute(array(
            ":email" => $cl->getEmail(),
            ":username" => $cl->getUsername(),
            ":nome" => $cl->getNome(),
            ":cognome" => $cl->getCognome(),
            ":via" => $cl->getVia(),
            ":ncivico" => $cl->getNumeroCivico(),
            ":provincia" => $cl->getProvincia(),
            ":citta" => $cl->getCitta(),
            ":cap" => $cl->getCAP(),
            ":ntelefono" => $cl->getTelefono(),
            ":password" => $cl->getPassword(),
            ":livello" => $cl->getLivello(),
            ":bannato" => $cl->getBannato()));
        return $ris;
    }

    /**
     * metodo che permette di aggiornare lo stato di bannato di ECliente nel db
     * @package Foundation
     */
    public static function updateBannato($email,$value){
        $pdo = FConnectionDB::connect();
        $query = "UPDATE cliente SET Bannato = :value  WHERE Email = :email";
        $stmt= $pdo->prepare($query);
        $ris = $stmt->execute([
            ":value" => $value,
            ":email" => $email
        ]);
        return $ris;
    }

    /**
     * metodo che permette di aggiornare un valore dell'istanza di ECliente
     * @package Foundation
     */
    public static function update_value($attributo,$value,$id){
        $pdo = FConnectionDB::connect();
        $query = "UPDATE cliente SET $attributo = :value  WHERE IdCliente = :id";
        $stmt= $pdo->prepare($query);
        $ris = $stmt->execute([
            ":value" => $value,
            ":id" => $id
        ]);
        return $ris;
    }

    /**
     * metodo che permette di caricare tutte le istanze di ECliente presenti nel db
     * @package Foundation
     */
    public static function loadClienti() : array {
        try {
            $pdo = FConnectionDB::connect();
            $query = "SELECT * FROM cliente";
            $stmt = $pdo->prepare($query);
            $stmt->execute();
            $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
            $clienti = array();
            $i = 0;
            foreach ($rows as $row) {
                $Idcliente = $row['IdCliente'];
                $Email = $row['Email'];
                $Username = $row['Username'];
                $Nome = $row['Nome'];
                $Cognome = $row['Cognome'];
                $Via = $row['Via'];
                $NumeroCivico = $row['NCivico'];
                $Provincia = $row['Provincia'];
                $Citta = $row['Citta'];
                $CAP = $row['CAP'];
                $Telefono = $row['NTelefono'];
                $Password = $row['Password'];
                $Bannato = $row['Bannato'];
                //$Livello = $rows[0]['Livello'];

                $utente = new ECliente($Email,$Username,$Nome,$Cognome,$Via,$NumeroCivico,$Provincia,$Citta,$CAP,$Telefono,$Password,$Idcliente,$Bannato);
                $clienti[$i] = $utente;
                ++$i;
            }
            return $clienti;
        }
        catch (PDOException $exception) {
            print ("Errore".$exception->getMessage());
            $pdo->rollBack();
            return array();}
    }

    /**
     * metodo che permette di caricare tutte le istanze di ECliente presenti nel db passandogli come parametro di ricerca lo Username
     * @package Foundation
     */
    public static function loadClientiperUsername(string $username) : ?array {
        try{
            $pdo = FConnectionDB::connect();

            $stmt = $pdo->prepare("SELECT * FROM cliente WHERE Username like CONCAT(:username,'%')");
            $stmt->execute([":username"=>$username]);
            $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
            if (count($rows)!=0){
                $clienti = array();
                $i= 0 ;
                foreach ($rows as $row) {
                    $Idcliente = $rows[0]['IdCliente'];
                    $Email = $rows[0]['Email'];
                    $Username = $rows[0]['Username'];
                    $Nome = $rows[0]['Nome'];
                    $Cognome = $rows[0]['Cognome'];
                    $Via = $rows[0]['Via'];
                    $NumeroCivico = $rows[0]['NCivico'];
                    $Provincia = $rows[0]['Provincia'];
                    $Citta = $rows[0]['Citta'];
                    $CAP = $rows[0]['CAP'];
                    $Telefono = $rows[0]['NTelefono'];
                    $Password = $rows[0]['Password'];
                    $Bannato = $rows[0]['Bannato'];
                    $immagine = FImmagine::load($Idcliente);
                    $utente = new ECliente($Email,$Username,$Nome,$Cognome,$Via,$NumeroCivico,$Provincia,$Citta,$CAP,$Telefono,$Password,$Idcliente,$Bannato);
                    $utente->setImmProfilo($immagine);
                    $clienti[]=$utente;
                }
                return $clienti;
            }else{
                return null;
            }
        }
        catch (PDOException $e){
            print("ATTENTION ERROR: ") . $e->getMessage();
            $pdo->rollBack();
            return array();
        }
    }

    /**
     * metodo che permette di generare la notifica di tipo: alta
     * @package Foundation
     */
    public static function Assistenzaa($testo,$idmittente){
        $pers = FPersistentManager::getInstance();
        $n = new ENotifiche($testo, "alta"," $idmittente");
        $pers->store($n);
    }
}
?>