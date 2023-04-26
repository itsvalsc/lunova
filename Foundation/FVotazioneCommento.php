<?php

class FVotazioneCommento
{

    public static function exist(string $ut,string $comm): bool {
        $pdo = FConnectionDB::connect();
        $stmt = $pdo->prepare("SELECT * FROM votazione_commenti WHERE utente = :ut AND commento = :comm");
        $ris = $stmt->execute(array(
            ':ut' => $ut,
            ':comm' =>$comm));
        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

        if (count($rows) == 0) { return false; }
        else { return true; }
    }

    public static function store( EVotazioneCommento $votazione): bool
    {
        $pdo = FConnectionDB::connect();
        $stmt = $pdo->prepare("INSERT INTO votazione_commenti VALUES (:utente, :disco, :commento)");

        $ris = $stmt->execute(array(
            ':utente' => $votazione->getUtente(),
            ':disco' => $votazione->getDisco(),
            ':commento' => $votazione->getCommento()));
        return $ris;
    }

    public static function delete(string $ut,string $comm) {
        $pdo=FConnectionDB::connect();

        try {
            if(self::exist($ut,$comm)) {
                $query = "DELETE FROM votazione_commenti WHERE utente = :ut AND commento = :comm";
                $stmt = $pdo->prepare($query);
                $stmt->execute([
                    ":ut" => $ut,
                    ":comm"=>$comm]);
                return true;
            }
            else{ return false;}
        }
        catch(PDOException $exception) {return false;}
    }

    public static function loadMP(string $cliente, string $disco) {
        $pdo = FConnectionDB::connect();
        $stmt = $pdo->prepare("SELECT commento FROM votazione_commenti WHERE utente = :ut AND disco = :dc");
        $stmt->execute([
            ':ut' => $cliente,
            ':dc' => $disco]);
        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $voti=[];
        foreach ($rows as $row){
            $voti[] = $row['commento'];
    }
        return  $voti;
    }

    public static function loadNumeroMP(string $disco) {
        $pdo = FConnectionDB::connect();
        $stmt = $pdo->prepare("SELECT commento FROM votazione_commenti WHERE disco = :dc");
        $stmt->execute([':dc' => $disco]);
        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $voti=[];
        foreach ($rows as $row){
            $voti[] = $row['commento'];
        }
        return  (array_count_values($voti));
    }

    public static function loadNumeroMPbyComm(string $comm) {
        $pdo = FConnectionDB::connect();
        $stmt = $pdo->prepare("SELECT commento FROM votazione_commenti WHERE commento = :comm");
        $stmt->execute([':comm' => $comm]);
        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $voti=[];
        foreach ($rows as $row){
            $voti[] = $row['commento'];
        }
        return  (array_count_values($voti));
    }

}