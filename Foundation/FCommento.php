<?php

/**
 * La classe FCommento fornisce query per gli oggetti ECommento
 * @package Foundation
 */

class FCommento{

    /**
     * metodo che verifica l'esistenza di un commento nel db
     * @package Foundation
     */
    public static function exist($id) : bool{

        $pdo = FConnectionDB::connect();

        $query = "SELECT * FROM commenti WHERE id = :id";
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
     * Memorizza un'istanza di ECommento sul database
     * @param ECommento $commento
     */
    public static function store(ECommento $commento): void {
        $descrizione = self::Sicurezza($commento->getDescrizione(),$commento->getCliente()->getIdClient(),$commento->getId());
        $pdo = FConnectionDB::connect();
        $query = "INSERT INTO commenti VALUES(:id,:descrizione,:data,:segnalato,:cliente,:disco)";
        $stmt = $pdo->prepare($query);
        $stmt->execute(array(
            ':id' => $commento->getId(),
            ':descrizione' => $descrizione,
            ':data'  =>$commento->getData(),
            ':segnalato' =>$commento->isSegnalato(),
            ':cliente' =>$commento->getCliente()->getIdClient(),
            ':disco' =>$commento->getIdDisco()
        ));
    }

    /**
     * metodo che permette di caricare un oggetto ECommento prendendo i dati dal db
     * @package Foundation
     */
    public static function load($id){
        $pdo=FConnectionDB::connect();

        try {
            $ifExist = self::exist($id);
            if($ifExist) {
                $query = "SELECT * FROM commenti WHERE id= :id";
                $stmt = $pdo->prepare($query);
                $stmt->execute( [":id" => $id] );
                $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

                $cliente = $rows[0]['cliente'];
                $descrizione = $rows[0]['descrizione'];
                $segnalato = $rows[0]['segnalato'];
                $data = $rows[0]['data'];
                $disco = $rows[0]['disco'];

                if (FCliente::exist_id($cliente)){
                    $cliente = FCliente::loadId($cliente);
                    $commento = new ECommento($cliente,$descrizione, $data,  $disco);
                    $commento->setId($id);
                    $commento->setSegnala($segnalato);
                    return $commento;
                }else{
                    return null;
                }
            }
            else {
                return null;
            }
        }
        catch (PDOException $exception) { print ("Errore".$exception->getMessage());}
    }

    public static function update(ECommento $commento) : bool
    {
        $pdo = FConnectionDB::connect();
        $query = "UPDATE commenti SET id = :id,descrizione = :descrizione,data = :data,segnalato = :segnalato,cliente = :cliente,disco = :disco WHERE id = :id";
        $stmt = $pdo->prepare($query);
        $ris = $stmt->execute(array(
            ':id' => $commento->getId(),
            ':descrizione' => $commento->getDescrizione(),
            ':data' => $commento->getData(),
            ':segnalato' => $commento->isSegnalato(),
            ':cliente' => $commento->getCliente()->getIdClient(),
            ':disco' => $commento->getIdDisco()
        ));
        return $ris;
        return array();
    }


    /**
     * metodo che permette di caricare tutti gli oggetti ECommento relativi allo stesso disco(id_disco) prendendo i dati dal db
     * @package Foundation
     */
    public static function loadCommenti($disco) : array {
        try {
            $pdo = FConnectionDB::connect();
            $query = "SELECT * FROM commenti WHERE disco= :id_disco ORDER BY data DESC";
            $stmt = $pdo->prepare($query);
            $stmt->execute( [":id_disco" => $disco]);
            $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
            $commenti = array();
            $i = 0;
            if ($rows==0){
                return $commenti;
            }
            foreach ($rows as $row) {
                $id = $row['id'];
                $descrizione = $row['descrizione'];
                $data = $row['data'];
                $idCliente = $row['cliente'];
                $disco = $row['disco'];

                if (FCliente::exist_id($idCliente)){
                    $cliente = FCliente::loadId($idCliente);
                    $commento = new ECommento($cliente,$descrizione, $data, $disco);
                    $commento->setId($id);
                    $commenti[$i] = $commento;
                    ++$i;
                }
            }
            return $commenti;
        }
        catch (PDOException $exception) {
            print ("Errore".$exception->getMessage());
            $pdo->rollBack();
            return array();
        }
    }

    /**
     * metodo che permette di caricare tutti gli oggetti ECommento relativi allo stesso cliente(id_cliente) prendendo i dati dal db
     * @package Foundation
     */
    public static function loadCommentibyCliente($cliente) : array {
        try {
            $pdo = FConnectionDB::connect();
            $query = "SELECT * FROM commenti WHERE cliente = :id_cliente";
            $stmt = $pdo->prepare($query);
            $stmt->execute( [":id_cliente" => $cliente]);
            $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
            $commenti = array();
            $i = 0;
            if ($rows==0){
                return $commenti;
            }
            foreach ($rows as $row) {
                $id = $row['id'];
                $descrizione = $row['descrizione'];
                $data = $row['data'];
                $idCliente = $row['cliente'];
                $disco = $row['disco'];
                if (FDisco::exist($disco)){
                    if (FCliente::exist_id($idCliente)){
                        $cliente = FCliente::loadId($idCliente);
                        $commento = new ECommento($cliente,$descrizione, $data, $disco);
                        $commento->setId($id);
                        $commenti[$i] = $commento;
                        ++$i;
                    }
                }
            }
            return $commenti;
        }
        catch (PDOException $exception) {
            print ("Errore".$exception->getMessage());
            $pdo->rollBack();
            return array();
        }
    }

    /**
     * metodo che permette di eliminare un oggetto ECommento dal db
     * @package Foundation
     */
    public static function delete(string $id) {
        $pdo=FConnectionDB::connect();
        try {
            $ifExist = self::exist($id);
            if($ifExist) {
                $query = "DELETE FROM commenti WHERE id= :id";
                $stmt = $pdo->prepare($query);
                $stmt->execute([":id" => $id]);
                return true;
            }
            else{ return false;}
        }
        catch(PDOException $exception) {print("Errore".$exception->getMessage());}
    }

    /**
     * metodo che permette di eliminare un oggetto ECommento tramite id_cliente dal db non usato????????
     * @package Foundation
     */
    public static function deletebyUtente(string $id) {
        $pdo=FConnectionDB::connect();
        try {
                $query = "DELETE FROM commenti WHERE cliente= :id";
                $stmt = $pdo->prepare($query);
                $stmt->execute([":id" => $id]);
        }
        catch(PDOException $exception) {print("Errore".$exception->getMessage());}
    }

    /**
     * metodo che verifica i caratteri scritti nel commento con quelle presenti nel file crosswords e se trova una corrispondenza la sostituisce con **
     * il commento bannato verrà direttamente inviato all'admin
     * @package Foundation
     */
    private static function Sicurezza(string $t, string $idap,string $idcomm)
    {   $f = "inc/crosswords.txt";
        $pers = FPersistentManager::getInstance();
        $apertura = file($f);
        for ($i=0; $i < count($apertura) ; $i++) {
            $words = explode(";", $apertura[$i]);
        }

        $text = explode(" ", $t);
        $t1 = str_replace($words, "***",$t);
        if ( $t!=$t1){
            $n = new ENotifiche("Questo commento è inopportuno, generato dall'utente $idap", "bassa","$idcomm");
            $pers->store($n);
        }
        return $t1;
    }
}