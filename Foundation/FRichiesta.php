<?php

class FRichiesta
{
    public static function exist(string $id): bool {
        $pdo = FConnectionDB::connect();
        $stmt = $pdo->prepare("SELECT * FROM richieste_sondaggi WHERE disco = :disco");
        $ris = $stmt->execute([':disco' => $id]);
        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

        if (count($rows) == 0) { return false; }
        else { return true; }
    }

    public static function load(string $id): ERichiesta {
        $pdo = FConnectionDB::connect();
        $stmt = $pdo->prepare("SELECT * FROM richieste_sondaggi WHERE disco = :id");
        $stmt->execute([':id' => $id]);
        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $disco = $rows[0]['disco'];
        $data = $rows[0]['data'];
        $art = $rows[0]['nomeArtista'];

        $richiesta = new ERichiesta($disco,$data,$art);
        return  $richiesta;
    }

    public static function store(ERichiesta $richiesta): bool
    {
        $pdo = FConnectionDB::connect();
        $stmt = $pdo->prepare("INSERT INTO richieste_sondaggi VALUES (:disco, :data,:artista)");

        $ris = $stmt->execute(array(
            ':disco' => $richiesta->getDisco(),
            ':data' =>$richiesta->getData(),
            ':artista' =>$richiesta->getArtista()));
        return $ris;
    }

    //far partire la funzioone delte ogni qualvolta si crea un nuovo sondaggio
    public static function delete(string $disco): bool {
        $pdo = FConnectionDB::connect();
        $stmt = $pdo->prepare("DELETE FROM richieste_sondaggi WHERE disco = :dc");
        $ris = $stmt->execute([':dc' => $disco]);
        return $ris;
    }

    //ritorna  un array contenente tutte le richieste
    public static function load_richieste():?array {
        $pdo = FConnectionDB::connect();
        $stmt = $pdo->prepare("SELECT * FROM richieste_sondaggi");
        $stmt->execute();
        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
        if (count($rows)==0){
            return null;
        }
        else{
            foreach ($rows as $row){
                $richiesta=new ERichiesta($row['disco'],$row['data'],$row['nomeArtista']);
                $array[]=$richiesta;
            }
        }
        return $array;
    }
}