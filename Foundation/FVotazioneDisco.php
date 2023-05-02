<?php

/**
 * La classe FVotazioneDisco fornisce query per gli oggetti EVotazioneDisco
 * @package Foundation
 */

class FVotazioneDisco{

    /**
     * metodo che verifica l'esistenza di una votazione_disco nel db
     * @package Foundation
     */
    public static function exist(string $ut,string $disco): bool {
        $pdo = FConnectionDB::connect();
        $stmt = $pdo->prepare("SELECT * FROM votazione_disco WHERE utente = :ut AND disco = :disc");
        $ris = $stmt->execute(array(
            ':ut' => $ut,
            ':disc' =>$disco));
        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

        if (count($rows) == 0) { return false; }
        else { return true; }
    }

    /**
     * metodo che memorizza l'istanza di un oggetto EVotazioneDisco nel db
     * @package Foundation
     */
    public static function store( EVotazioneDisco $votazione): bool {
        $pdo = FConnectionDB::connect();
        $stmt = $pdo->prepare("INSERT INTO votazione_disco VALUES (:utente, :disco, :voto)");

        $ris = $stmt->execute(array(
            ':utente' => $votazione->getUtente(),
            ':disco' => $votazione->getDisco(),
            ':voto' => $votazione->getVoto()));
        return $ris;
    }

    /**
     * metodo che restituisce un oggetto EVotazioneDisco caricato dal db
     * @package Foundation
     */
    public static function load(string $id) {
        $pdo = FConnectionDB::connect();
        $stmt = $pdo->prepare("SELECT voto FROM votazione_disco WHERE disco = :id");
        $stmt->execute([':id' => $id]);
        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $voti=[];
        foreach ($rows as $row){
            $voti[] = $row['voto'];
    }
        return  $voti;
    }

    /**
     * metodo che restituisce la lista di oggetti EVotazioneDisco caricati dal db passando come parametro l'id del cliente
     * @package Foundation
     */
    public static function loadperCliente(string $cl) {
        $pdo = FConnectionDB::connect();
        $stmt = $pdo->prepare("SELECT * FROM votazione_disco WHERE utente = :cl");
        $stmt->execute([':cl' => $cl]);
        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $voti=[];
        if (count($rows)!=0){
            foreach ($rows as $row){
                if(FDisco::exist($row['disco'])){
                    $voti[$row['disco']] = $row['voto'];
                }
            }
        }
        return  $voti;
    }
}