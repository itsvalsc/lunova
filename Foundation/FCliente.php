<?php

class FCliente
{

    private static $class = "Cliente";
    private static $table = "cliente";

    /**
    public static function bind($statement, EClient $cliente)
    {
        $statement->bindValue(':IdCliente', $cliente->getIdCliente(), PDO::PARAM_STR);
        $statement->bindValue(':Email', $cliente->getEmail(), PDO::PARAM_STR);
        $statement->bindValue(':Nome', $cliente->getNome(), PDO::PARAM_STR);
        $statement->bindValue(':Cognome', $cliente->getCognome(), PDO::PARAM_STR);
        $statement->bindValue(':Via', $cliente->getVia(), PDO::PARAM_STR);
        $statement->bindValue(':NCivico', $cliente->getNumeroCivico(), PDO::PARAM_STR);
        $statement->bindValue(':Provincia', $cliente->getProvincia(), PDO::PARAM_STR);
        $statement->bindValue(':Citta', $cliente->getCitta(), PDO::PARAM_STR);
        $statement->bindValue(':CAP', $cliente->getCAP(), PDO::PARAM_STR);
        $statement->bindValue(':NTelefono', $cliente->getTelefono(), PDO::PARAM_STR);
        $statement->bindValue(':Password', password_hash($cliente->getPassword(), PASSWORD_DEFAULT), PDO::PARAM_STR);
        $statement->bindValue(':Livello', $cliente->getLivello(), PDO::PARAM_STR);
    }
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
     * Memorizza un'istanza di EClient sul database
     * @param EClient $cliente
     */
    public static function store(EClient $cliente): void {
        $pdo = FConnectionDB::connect();
        $query = "INSERT INTO cliente VALUES(:IdCliente,:Email,:Nome,:Cognome,:Via,:NCivico,:Provincia,:Citta,:CAP,:NTelefono,:Password,:Livello)";
        $stmt = $pdo->prepare($query);
        $stmt->execute(array(
            ':IdCliente' => $cliente->getIdClient(),
            ':Email' => $cliente->getEmail(),
            ':Nome'  =>$cliente->getNome(),
            ':Cognome' =>$cliente->getCognome(),
            ':Via' =>$cliente->getVia(),
            ':NCivico' =>$cliente->getNumeroCivico(),
            ':Provincia' =>$cliente->getProvincia(),
            ':Citta' =>$cliente->getCitta(),
            ':CAP' =>$cliente->getCAP(),
            ':NTelefono' =>$cliente->getTelefono(),
            ':Password' =>$cliente->getPassword(),
            ':Livello' =>$cliente->getLivello()
        ));
    }

    /**
     * Carica in RAM l'istanza di EClient che possiede l' email fornita
     * @param EClient $cliente

    public static function load(string $email) : EClient {
        $pdo=FConnectionDB::connect();

        $query = "SELECT * FROM cliente WHERE Email= :email";
        $stmt = $pdo->prepare($query);
        $stmt->execute( [":email" => $email] );
        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $Idcliente = $rows[0]['IdCliente'];
        $Email = $rows[0]['Email'];
        $Nome = $rows[0]['Nome'];
        $Cognome = $rows[0]['Cognome'];
        $Via = $rows[0]['Via'];
        $NumeroCivico = $rows[0]['NCivico'];
        $Provincia = $rows[0]['Provincia'];
        $Citta = $rows[0]['Citta'];
        $CAP = $rows[0]['CAP'];
        $Telefono = $rows[0]['NTelefono'];
        $Password = $rows[0]['Password'];
        $Livello = $rows[0]['Livello'];

        $utente = new EClient($Nome,$Cognome,$Via,$NumeroCivico,$Provincia,$Citta,$CAP,$Telefono,$Email,$Password,null,$Idcliente);


        return $utente;
    }
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

                $utente = new ECliente($Nome,$Cognome,$Via,$NumeroCivico,$Provincia,$Citta,$CAP,$Telefono,$Email,$Password,null,$Idcliente);
                return $utente;
            }
            else {return "Non ci sono clienti";}
        }
        catch (PDOException $exception) { print ("Errore".$exception->getMessage());}

    }

    public static function update(EClient $cl) : bool{
        $pdo = FConnectionDB::connect();
        $query = "UPDATE cliente SET IdCliente = :id, Email = :email, Nome = :nome, Cognome = :cognome,Via = :via, NCivico = :ncivico, Provincia = :provincia, Citta = :citta, CAP = :cap,NTelefono = :ntelefono, Password = :password, Livello = :livello   WHERE Email = :email";
        $stmt=$pdo->prepare($query);
        $ris = $stmt->execute(array(
            ":id" => $cl->getIdClient(),
            ":email" => $cl->getEmail(),
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

                $utente = new ECliente($Nome,$Cognome,$Via,$NumeroCivico,$Provincia,$Citta,$CAP,$Telefono,$Email,$Password,null,$Idcliente);

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
}


?>