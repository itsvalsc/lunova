<?php

/**
 * La classe FArtista permette la comunicazione tra db e l'stanza di un oggetto EArtista
 * @package Foundation
 */

class FArtista{

    /**
     * metodo che verifica l'esistenza di un artista nel db
     * @package Foundation
     */
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

    /**
     * metodo che verifica l'esistenza dello username dell'artista nel db
     * @package Foundation
     */
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
     * metodo che memorizza un'istanza di EArtista sul database
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

    /**
     * metodo che permette la cancellazione dell'stanza di EArtista dal db
     * @package Foundation
     */
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

    /**
     * metodo che permette di caricare un oggetto EArtista prendendo i dati dal db
     * @package Foundation
     */
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
                $immagine = FImmagine::load($IdArtista);
                $artista = new EArtista($Username,$Email,$Nome, $Cognome, $Via, $NumeroCivico,$Citta,$Provincia, $CAP, $Telefono, $Password, $IdArtista );
                $artista->setImmProfilo($immagine);
                return $artista;
            }
            else {return "Non ci sono artisti";}
        }
        catch (PDOException $exception) { print ("Errore".$exception->getMessage());}
    }

    /**
     * metodo che permette di aggiornare un oggetto EArtista prendendo i dati dal db
     * @package Foundation
     */
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

    /**
     * metodo che permette di aggiornare un valore dell'oggetto EArtista
     * @package Foundation
     */
    public static function update_value($attributo,$value,$id){
        $pdo = FConnectionDB::connect();
        $query = "UPDATE artista SET $attributo = :value  WHERE IdArtista = :id";
        $stmt= $pdo->prepare($query);
        $ris = $stmt->execute([
            ":value" => $value,
            ":id" => $id
        ]);
        return $ris;
    }

    /**
     * metodo che permette di caricare tutte le istanze di EArtista presenti nel db
     * @package Foundation
     */
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

                $artista = new EArtista($Username, $Email, $Nome, $Cognome, $Via, $NumeroCivico,$Citta,$Provincia, $CAP, $Telefono, $Password, $IdArtista );
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
     * metodo che permette di caricare tutte le istanze di EArtista presenti nel db passandogli come parametro di ricerca lo Username
     * @package Foundation
     */
    public static function loadArtistiperUsername(string $username) : ?array {
        try{
            $pdo = FConnectionDB::connect();

            $stmt = $pdo->prepare("SELECT * FROM artista WHERE Username like CONCAT(:username,'%')");
            $stmt->execute([":username"=>$username]);
            $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
            if (count($rows)!=0){
                $artisti = array();
                $i= 0 ;
                foreach ($rows as $row) {
                    $id = $row['IdArtista'];
                    $immagine = FImmagine::load($id);
                    $art=new EArtista(
                        $row['Username'],
                        $row['Email'],
                        $row['Nome'],
                        $row['Cognome'],
                        $row['Via'],
                        $row['NCivico'],
                        $row['Provincia'],
                        $row['Citta'],
                        $row['CAP'],
                        $row['NTelefono'],
                        $row['Password'],
                        $row['IdArtista']
                    );
                    $art->setImmProfilo($immagine);
                    $artisti[$i]=$art;
                    ++$i;
                }
            } else{ $artisti=null; }
            return $artisti;
        }
        catch (PDOException $e){
            print("ATTENTION ERROR: ") . $e->getMessage();
            $pdo->rollBack();
            return array();
        }
    }

    /**
     * metodo che permette la ricerca del nome di uno o più artisti passandogli l'id come parametro
     * @package Foundation
     */
    public static function loadName(string $id) {
        $pdo=FConnectionDB::connect();

        try {
            $query = "SELECT * FROM artista WHERE IdArtista= :id";
            $stmt = $pdo->prepare($query);
            $stmt->execute( [":id" => $id] );
            $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

            $Username = $rows[0]['Username'];
            $Nome = $rows[0]['Nome'];
            $Cognome = $rows[0]['Cognome'];

            return $Username;
        }
        catch (PDOException $exception) { print ("Errore".$exception->getMessage());}
    }

    /**
     * metodo che permette la ricerca dell'id di un artista passando lo username
     * @package Foundation
     */
    public static function loadId($Username){
        $pdo = FConnectionDB::connect();
        $query = "SELECT * FROM artista WHERE Username = :username";
        $stmt= $pdo->prepare($query);
        $stmt->execute([":username" => $Username]);
        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
        if (count($rows)!=0){
            return $rows[0]['IdArtista'];
        }
        else{
            return null;
        }
    }

    /**
     * metodo che permette di caricare tutte le istanze di EArtista presenti nel db passandogli come parametro di ricerca l'id
     * @package Foundation
     */
    public static function loadFromID(string $id) {
            $pdo=FConnectionDB::connect();

            $query = "SELECT * FROM artista WHERE IdArtista= :email";
            $stmt = $pdo->prepare($query);
            $stmt->execute( [":email" => $id] );
            $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
            if (count($rows)!=0) {
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
                $immagine = FImmagine::load($IdArtista);
                $artista = new EArtista($Username, $Email, $Nome, $Cognome, $Via, $NumeroCivico, $Citta, $Provincia, $CAP, $Telefono, $Password, $IdArtista);
                $artista->setImmProfilo($immagine);
                return $artista;
            }else{
                return null;
            }
    }
}