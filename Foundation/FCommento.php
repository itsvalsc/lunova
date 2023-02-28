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
        $pdo = FConnectionDB::connect();
        $query = "INSERT INTO commenti VALUES(:id,:descrizione,:data,:segnalato,:cliente,:disco)";
        $stmt = $pdo->prepare($query);
        $stmt->execute(array(
            ':id' => $commento->getId(),
            ':descrizione' => $commento->getDescrizione(),
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
                $data = $rows[0]['data'];
                $disco = $rows[0]['disco'];

                $cliente = FCliente::loadId($cliente);
                $commento = new ECommento($cliente,$descrizione, $data,  $disco);
                $commento->setId($id);
                return $commento;
            }
            else {
                return "Non ci sono commenti per questo disco";
                //return null;
            }
        }
        catch (PDOException $exception) { print ("Errore".$exception->getMessage());}
    }

    public static function loadCommenti($disco) : array {
        try {
            $pdo = FConnectionDB::connect();
            $query = "SELECT * FROM commenti WHERE disco= :id_disco";
            $stmt = $pdo->prepare($query);
            $stmt->execute( [":id_disco" => $disco]);
            $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
            $commenti = array();
            $i = 0;
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
        $query = "UPDATE commenti SET :id,:descrizione,:data,:segnalato,:cliente,:disco WHERE id = :id";
        $stmt = $pdo->prepare($query);
        $ris = $stmt->execute(array(
            ':id' => $commento->getId(),
            ':descrizione' => $commento->getDescrizione(),
            ':data' => $commento->getData(),
            ':segnalato' => $commento->isSegnalato(),
            ':cliente' => $commento->getIdCliente(),
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

}