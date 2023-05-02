<?php

/**
 * La classe FNotifiche fornisce query per gli oggetti ENotifiche
 * @package Foundation
 */

class FNotifiche{

    /**
     * metodo che verifica l'esistenza di una notifica nel db
     * @package Foundation
     */
    public static function exist($id) : bool {

        $pdo = FConnectionDB::connect();

        $query = "SELECT * FROM notifiche WHERE id = :id";
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
     * metodo che memorizza l'istanza di un oggetto ENotifiche nel db
     * @package Foundation
     */
    public static function store(ENotifiche $n): void {

        $pdo = FConnectionDB::connect();
        $query = "INSERT INTO notifiche VALUES(:id,:priority,:testo,:mittente)";
        $stmt = $pdo->prepare($query);
        $stmt->execute(array(
            ':id' => $n->getId(),
            ':priority' => $n->getPriority(),
            ':testo' =>$n->getText(),
            ':mittente' =>$n->getMittente()
        ));
    }

    /**
     * metodo che restituisce la lista di oggetti ENotifiche caricate dal db
     * @package Foundation
     */
    public static function load() : ?array {
        $pdo=FConnectionDB::connect();

        try {
            $query = "SELECT * FROM notifiche";
            $stmt = $pdo->prepare($query);
            $stmt->execute();
            $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
            $not = array();
            foreach ($rows as $row){
                $sing = new ENotifiche($row['testo'], $row['priority'], $row['mittente']);
                $sing->setId($row['id']);
                array_push($not, $sing);
            }
            return $not;

        }
        catch (PDOException $exception) {
            print ("Errore".$exception->getMessage());
            $pdo->rollBack();
            return array();}
    }

    /**
     * metodo che restituisce la lista di oggetti ENotifiche con priorità alta caricate dal db
     * @package Foundation
     */
    public static function loadAlta() : ?array {
        $pdo=FConnectionDB::connect();

        try {
            $query = "SELECT * FROM notifiche WHERE priority = 'alta'";
            $stmt = $pdo->prepare($query);
            $stmt->execute();
            $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
            $not = array();
            if (count($rows)!=0){
                foreach ($rows as $row){
                $sing = new ENotifiche($row['testo'], $row['priority'], $row['mittente']);
                $sing->setId($row['id']);
                array_push($not, $sing);
                }
            }
            return $not;

        }
        catch (PDOException $exception) {
            print ("Errore".$exception->getMessage());
            $pdo->rollBack();
            return array();}
    }

    /**
     * metodo che restituisce la lista di oggetti ENotifiche con priorità bassa caricate dal db
     * @package Foundation
     */
    public static function loadBassa() : ?array {
        $pdo=FConnectionDB::connect();

        try {
            $query = "SELECT * FROM notifiche WHERE priority = 'bassa'";
            $stmt = $pdo->prepare($query);
            $stmt->execute();
            $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
            $not = array();
            foreach ($rows as $row){
                $sing = new ENotifiche($row['testo'], $row['priority'], $row['mittente']);
                $sing->setId($row['id']);
                array_push($not, $sing);
            }
            return $not;

        }
        catch (PDOException $exception) {
            print ("Errore".$exception->getMessage());
            $pdo->rollBack();
            return array();}
    }

    /**
     * metodo che restituisce la lista di oggetti ENotifiche di tipo sondaggi caricate dal db
     * @package Foundation
     */
    public static function loadSond() : array {
        $pdo=FConnectionDB::connect();

        try {
            $query = "SELECT * FROM notifiche WHERE priority = 's'";
            $stmt = $pdo->prepare($query);
            $stmt->execute();
            $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
            $not = array();
            foreach ($rows as $row){
                $sing = new ENotifiche($row['testo'], $row['priority'], $row['mittente']);
                $sing->setId($row['id']);
                array_push($not, $sing);
            }
            return $not;

        }
        catch (PDOException $exception) {
            print ("Errore".$exception->getMessage());
            $pdo->rollBack();
            return array();}
    }

    /**
     * metodo che permette di eliminare l'istanza di un oggetto EImmagine dal db
     * @package Foundation
     */
    public static function delete(string $ID_not)
    {
        $pdo = FConnectionDB::connect();

        try {
            $ifExist = self::exist($ID_not);
            if ($ifExist) {
                $query = "DELETE FROM notifiche WHERE id= :id";
                $stmt = $pdo->prepare($query);
                $stmt->execute([":id" => $ID_not]);
                return true;
            } else {
                return print('Notifica non trovata');
            }
        } catch (PDOException $exception) {
            print("Errore" . $exception->getMessage());
        }
    }
}