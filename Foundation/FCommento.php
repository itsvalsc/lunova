<?php

class FCommento
{
    public static function exist($id) : bool {

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

    public static function load($id) {
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

                $cliente = FCliente::loadId($cliente);
                $commento = new ECommento($cliente,$descrizione, $data,  $disco);
                $commento->setId($id);
                $commento->setSegnala($segnalato);
                return $commento;
            }
            else {
                return null;
            }
        }
        catch (PDOException $exception) { print ("Errore".$exception->getMessage());}
    }

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

                $cliente = FCliente::loadId($idCliente);
                $commento = new ECommento($cliente,$descrizione, $data, $disco);
                $commento->setId($id);

                $commenti[$i] = $commento;
                ++$i;
            }
            return $commenti;
        }
        catch (PDOException $exception) {
            print ("Errore".$exception->getMessage());
            $pdo->rollBack();
            return array();}
    }

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

                $cliente = FCliente::loadId($idCliente);
                $commento = new ECommento($cliente,$descrizione, $data, $disco);
                $commento->setId($id);

                $commenti[$i] = $commento;
                ++$i;
            }
            return $commenti;
        }
        catch (PDOException $exception) {
            print ("Errore".$exception->getMessage());
            $pdo->rollBack();
            return array();}
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
    }

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