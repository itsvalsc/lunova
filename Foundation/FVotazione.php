<?php

/**
 * La classe FVotazione fornisce query per gli oggetti EVotazione
 * @package Foundation
 */

class FVotazione{

    /**
     * metodo che verifica l'esistenza di una votazione nel db
     * @package Foundation
     */
    public static function exist(string $ut,string $sondaggio): bool {
        $pdo = FConnectionDB::connect();
        $stmt = $pdo->prepare("SELECT * FROM votazioni WHERE utente = :ut AND sondaggio = :sond");
        $ris = $stmt->execute(array(
            ':ut' => $ut,
            ':sond' =>$sondaggio));
        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

        if (count($rows) == 0) { return false; }
        else { return true; }
    }

    /**
     * metodo che memorizza l'istanza di un oggetto EVotazione nel db
     * @package Foundation
     */
    public static function store(EVotazione $votazione): bool
    {
        $pdo = FConnectionDB::connect();
        $stmt = $pdo->prepare("INSERT INTO votazioni VALUES (:utente, :sondaggio , :disco)");

        $ris = $stmt->execute(array(
            ':utente' => $votazione->getUtente(),
            ':sondaggio' => $votazione->getSondaggio(),
            ':disco' => $votazione->getDisco()));
        return $ris;
    }
}