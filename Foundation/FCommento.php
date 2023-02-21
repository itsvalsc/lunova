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
        $query = "INSERT INTO commenti VALUES(:id,:descrizione,:voto,:data,:segnalato,:cliente,:disco)";
        $stmt = $pdo->prepare($query);
        $stmt->execute(array(
            ':id' => $commento->getId(),
            ':descrizione' => $commento->getDescrizione(),
            ':voto' => $commento->getVoto(),
            ':data'  =>$commento->getData(),
            ':segnalato' =>$commento->isSegnalato(),
            ':cliente' =>$commento->getIdCliente(),
            ':disco' =>$commento->getIdDisco()
        ));
    }

    public static function load(int $id) {
        $pdo=FConnectionDB::connect();

        try {
            $ifExist = self::exist($id);
            if($ifExist) {
                $query = "SELECT * FROM commenti WHERE id= :id";
                $stmt = $pdo->prepare($query);
                $stmt->execute( [":id" => $id] );
                $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

                $descrizione = $rows[0]['descrizione'];
                $voto = $rows[0]['voto'];
                $data = $rows[0]['data'];
                $cliente = $rows[0]['cliente'];
                $disco = $rows[0]['disco'];

                $commento = new ECommento($descrizione, $voto, $data, $cliente, $disco);
                return $commento;
            }
            else {
                return "Non ci sono commenti per questo disco";
                //return null;
            }
        }
        catch (PDOException $exception) { print ("Errore".$exception->getMessage());}
    }

    public static function loadCommenti() : array {
        try {
            $pdo = FConnectionDB::connect();
            $query = "SELECT * FROM commenti";
            $stmt = $pdo->prepare($query);
            $stmt->execute();
            $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
            $commenti = array();
            $i = 0;
            foreach ($rows as $row) {
                $descrizione = $rows[0]['descrizione'];
                $voto = $rows[0]['voto'];
                $data = $rows[0]['data'];
                $cliente = $rows[0]['cliente'];
                $disco = $rows[0]['disco'];

                $commento = new ECommento($descrizione, $voto, $data, $cliente, $disco);

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
        $query = "UPDATE commenti SET :id,:descrizione,:voto,:data,:segnalato,:cliente,:disco WHERE id = :id";
        $stmt = $pdo->prepare($query);
        $ris = $stmt->execute(array(
            ':id' => $commento->getId(),
            ':descrizione' => $commento->getDescrizione(),
            ':voto' => $commento->getVoto(),
            ':data' => $commento->getData(),
            ':segnalato' => $commento->isSegnalato(),
            ':cliente' => $commento->getIdCliente(),
            ':disco' => $commento->getIdDisco()
        ));
        return $ris;
    }

    public static function delete(int $id) {
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