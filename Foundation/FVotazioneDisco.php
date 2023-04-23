<?php

class FVotazioneDisco
{
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

    public static function store( EVotazioneDisco $votazione): bool
    {
        $pdo = FConnectionDB::connect();
        $stmt = $pdo->prepare("INSERT INTO votazione_disco VALUES (:utente, :disco, :voto)");

        $ris = $stmt->execute(array(
            ':utente' => $votazione->getUtente(),
            ':disco' => $votazione->getDisco(),
            ':voto' => $votazione->getVoto()));
        return $ris;
    }

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

    public static function loadperCliente(string $cl) {
        $pdo = FConnectionDB::connect();
        $stmt = $pdo->prepare("SELECT * FROM votazione_disco WHERE utente = :cl");
        $stmt->execute([':cl' => $cl]);
        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $voti=[];
        if (count($rows)!=0){
            foreach ($rows as $row){
                $voti[$row['disco']] = $row['voto'];
            }
        }
        return  $voti;
    }

}