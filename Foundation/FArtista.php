<?php
class FArtista{

    public static function exist($email) : bool {

        $pdo = FConnectionDB::connect();

        $query = "SELECT * FROM artista WHERE Email = :email";
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
        $query = "SELECT * FROM artista WHERE Username = :username";
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
     * Memorizza un'istanza di EArtista sul database
     * @param EArtista $artista
     */
    public static function store(EArtista $artista): void {
        $pdo = FConnectionDB::connect();
        $query = "INSERT INTO artista VALUES(:IdArtista,:Email,:Username,:Nome,:Cognome,:Via,:NCivico,:Provincia,:Citta,:CAP,:NTelefono,:Password,:Livello)";
        $stmt = $pdo->prepare($query);
        $stmt->execute(array(
            ':IdArtista' => $artista->getIdArtista(),
            ':Email' => $artista->getEmail(),
            ':Username' =>$artista->getUsername(),
            ':Nome'  =>$artista->getNome(),
            ':Cognome' =>$artista->getCognome(),
            ':Via' =>$artista->getVia(),
            ':NCivico' =>$artista->getNumeroCivico(),
            ':Provincia' =>$artista->getProvincia(),
            ':Citta' =>$artista->getCitta(),
            ':CAP' =>$artista->getCAP(),
            ':NTelefono' =>$artista->getTelefono(),
            ':Password' =>$artista->criptaPassword($artista->getPassword()),
            ':Livello' =>$artista->getLivello()
        ));
    }

    public static function delete(string $email) {
        $pdo=FConnectionDB::connect();

        try {
            $ifExist = self::exist($email);
            if($ifExist) {
                $query = "DELETE FROM artista WHERE Email= :email";
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
                $query = "SELECT * FROM artista WHERE Email= :email";
                $stmt = $pdo->prepare($query);
                $stmt->execute( [":email" => $email] );
                $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

                $IdArtista = $rows[0]['IdArtista'];
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

                $artista = new EArtista($Username,$Email,$Nome, $Cognome, $Via, $NumeroCivico,$Citta,$Provincia, $CAP, $Telefono, $Password, $IdArtista );
                return $artista;
                //TODO: aggiustare costruttore per artista e cliente, ad artista aggiungere e recupare l'IBAN [da controllare]
            }
            else {return "Non ci sono artisti";}
        }
        catch (PDOException $exception) { print ("Errore".$exception->getMessage());}
    }

    //TODO:finire update artista [da controllare]
    public static function update(EArtista $art) : bool{
        $pdo = FConnectionDB::connect();
        $query = "UPDATE cliente SET IdCliente = :id, Email = :email, Username = :username, Nome = :nome, Cognome = :cognome,Via = :via, NCivico = :ncivico, Provincia = :provincia, Citta = :citta, CAP = :cap,NTelefono = :ntelefono, Password = :password, Livello = :livello WHERE Email = :email";
        $stmt=$pdo->prepare($query);
        $ris = $stmt->execute(array(
            ":id" => $art->getIdClient(),
            ":email" => $art->getEmail(),
            ":username" => $art->getUsername(),
            ":nome" => $art->getNome(),
            ":cognome" => $art->getCognome(),
            ":via" => $art->getVia(),
            ":ncivico" => $art->getNumeroCivico(),
            ":provincia" => $art->getProvincia(),
            ":citta" => $art->getCitta(),
            ":cap" => $art->getCAP(),
            ":ntelefono" => $art->getTelefono(),
            ":password" => $art->getPassword(),
            ":livello" => $art->getLivello(),
            )
        );

        return $ris;
    }

    public static function loadArtisti() : array {
        try {
            $pdo = FConnectionDB::connect();
            $query = "SELECT * FROM artista";
            $stmt = $pdo->prepare($query);
            $stmt->execute();
            $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
            $artisti = array();
            $i = 0;
            foreach ($rows as $row) {
                $IdArtista = $row['IdArtista'];
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

                $artista = new EArtista($Email, $Username, $Nome, $Cognome, $Via, $NumeroCivico,$Citta,$Provincia, $CAP, $Telefono, $Password, $IdArtista );
                $artisti[$i] = $artista;
                ++$i;
            }
            return $artisti;
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
            //$email = addslashes($email);
            $query = "SELECT * FROM admin WHERE Email = :email";
            $stmt = $pdo->prepare($query);
            $stmt->execute( [":email" => $email] );
            $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
            $pdo->commit();

            // verificaPassword controlla se la password inserita corrisponde alla password hash recuperata da db
            if ($rows && EArtista::verificaPassword($password, $rows['Password'])) return true;
            return false;
        }
        catch (PDOException $e) {
            echo "\nAttenzione errore: " . $e->getMessage();
            $pdo->rollBack();
            return null;
        }
    }
}