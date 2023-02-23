<?php

class FCliente
{
    private static $class = "Cliente";
    private static $table = "cliente";

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
     * Memorizza un'istanza di EClient sul database
     * @param ECliente $cliente
     */
    public static function store(ECliente $cliente): void {
        $pdo = FConnectionDB::connect();
        $query = "INSERT INTO cliente VALUES(:IdCliente,:Email,:Username,:Nome,:Cognome,:Via,:NCivico,:Provincia,:Citta,:CAP,:NTelefono,:Password,:Livello)";
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
            ':Livello' =>$cliente->getLivello()
        ));
    }

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
               //$Livello = $rows[0]['Livello'];

                $utente = new ECliente($Email,$Username,$Nome,$Cognome,$Via,$NumeroCivico,$Provincia,$Citta,$CAP,$Telefono,$Password,null,$Idcliente);
                return $utente;
            }
            else {return "Non ci sono clienti";}
        }
        catch (PDOException $exception) { print ("Errore".$exception->getMessage());}
    }

    public static function loadId(string $id) {
        $pdo=FConnectionDB::connect();

        try {
                $query = "SELECT * FROM cliente WHERE IdCliente= :id";
                $stmt = $pdo->prepare($query);
                $stmt->execute( [":id" => $id] );
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
               //$Livello = $rows[0]['Livello'];

                $utente = new ECliente($Email,$Username,$Nome,$Cognome,$Via,$NumeroCivico,$Provincia,$Citta,$CAP,$Telefono,$Password,null,$Idcliente);
                return $utente;
        }
        catch (PDOException $exception) { print ("Errore".$exception->getMessage());}
    }

    public static function update(EClient $cl) : bool{
        $pdo = FConnectionDB::connect();
        $query = "UPDATE cliente SET IdCliente = :id, Email = :email, Username = :username, Nome = :nome, Cognome = :cognome,Via = :via, NCivico = :ncivico, Provincia = :provincia, Citta = :citta, CAP = :cap,NTelefono = :ntelefono, Password = :password, Livello = :livello   WHERE Email = :email";
        $stmt=$pdo->prepare($query);
        $ris = $stmt->execute(array(
            ":id" => $cl->getIdClient(),
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
            ":livello" => $cl->getLivello()));

        return $ris;

    }

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
                //$Livello = $rows[0]['Livello'];

                $utente = new ECliente($Username,$Nome,$Cognome,$Via,$NumeroCivico,$Provincia,$Citta,$CAP,$Telefono,$Email,$Password,null,$Idcliente);

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
     * Metodo che verifica l'accesso di un utente , controllando che le credenziali (email e password) siano presenti nel db
     * @param $email
     * @param $pass
     */
    public function VerificaAccesso(string $email, string $password)
    {
        $pdo=FConnectionDB::connect();
        $pdo->beginTransaction();
        try {
            $email = addslashes($email);
            $query = "SELECT * FROM admin WHERE Email = :email";
            $stmt = $pdo->prepare($query);
            $stmt->execute( [":email" => $email] );
            $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
            $pdo->commit();

            // verificaPassword controlla se la password inserita corrisponde alla password hash recuperata da db
            if ($rows && ECliente::verificaPassword($password, $rows['Password'])) return true;
            return false;
        }
        catch (PDOException $e) {
            echo "\nAttenzione errore: " . $e->getMessage();
            $pdo->rollBack();
            return null;
        }
    }
}


?>