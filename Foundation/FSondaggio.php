<?php

class FSondaggio
{

    public static function exist(string $id): bool {
        $pdo = FConnectionDB::connect();
        $stmt = $pdo->prepare("SELECT * FROM sondaggi WHERE id = :id");
        $ris = $stmt->execute([':id' => $id]);
        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

        if (count($rows) == 0) { return false; }
        else { return true; }
    }

    //metodo per load sondaggio per ritornare quello in corso
    public static function exist_incorso(): ?string {
        $pdo = FConnectionDB::connect();
        $stmt = $pdo->prepare("SELECT id FROM sondaggi WHERE in_corso = 1");
        $stmt->execute();
        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

        if (count($rows) == 0) { return ''; }
        else { return $rows[0]['id']; }
    }


    private static function update_incorso():void {
        $pdo = FConnectionDB::connect();
        $stmt = $pdo->prepare("UPDATE sondaggi SET in_corso = 0 WHERE in_corso = 1");
        $ris = $stmt->execute();
    }


    public static function load(string $id): ESondaggio {
        $pdo = FConnectionDB::connect();
        $stmt = $pdo->prepare("SELECT * FROM sondaggi WHERE id = :id");
        $stmt->execute([':id' => $id]);
        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $disco_1 = $rows[0]['disco1'];
        $voti_disco_1 = $rows[0]['voti_disco1'];
        $disco_2 = $rows[0]['disco2'];
        $voti_disco_2 = $rows[0]['voti_disco2'];
        $disco_3 = $rows[0]['disco3'];
        $voti_disco_3 = $rows[0]['voti_disco3'];
        $data = $rows[0]['data'];
        $in_corso = $rows[0]['in_corso'];
        $disco1 = FDisco::load($disco_1);
        $disco2 = FDisco::load($disco_2);
        $disco3 = FDisco::load($disco_3);
        $sondaggio = new ESondaggio($disco1,$disco2,$disco3,$data);
        $sondaggio->setId($id);
        //$sondaggio->setDisco1($disco_1);
        $sondaggio->setVotiDisco1($voti_disco_1);
        //$sondaggio->setDisco2($disco_2);
        $sondaggio->setVotiDisco2($voti_disco_2);
        //$sondaggio->setDisco3($disco_3);
        $sondaggio->setVotiDisco3($voti_disco_3);
        //$sondaggio->setData($data);
        $sondaggio->setInCorso($in_corso);
        return $sondaggio;
    }

    public static function load_incorso(): ESondaggio {

        $id = self::exist_incorso();
        if ($id == null){
            return $id;
        }
        else {
            $pdo = FConnectionDB::connect();
            $stmt = $pdo->prepare("SELECT * FROM sondaggi WHERE id = :id");
            $stmt->execute([':id' => $id]);
            $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

            $disco_1 = $rows[0]['disco1'];
            $voti_disco_1 = $rows[0]['voti_disco1'];
            $disco_2 = $rows[0]['disco2'];
            $voti_disco_2 = $rows[0]['voti_disco2'];
            $disco_3 = $rows[0]['disco3'];
            $voti_disco_3 = $rows[0]['voti_disco3'];
            $data = $rows[0]['data'];
            $in_corso = $rows[0]['in_corso'];
            $disco1 = FDisco::load($disco_1);
            $disco2 = FDisco::load($disco_2);
            $disco3 = FDisco::load($disco_3);
            $sondaggio = new ESondaggio($disco1,$disco2,$disco3,$data);
            $sondaggio->setId($id);
            //$sondaggio->setDisco1($disco_1);
            $sondaggio->setVotiDisco1($voti_disco_1);
            //$sondaggio->setDisco2($disco_2);
            $sondaggio->setVotiDisco2($voti_disco_2);
            //$sondaggio->setDisco3($disco_3);
            $sondaggio->setVotiDisco3($voti_disco_3);
            //$sondaggio->setData($data);
            $sondaggio->setInCorso($in_corso);
            return $sondaggio;
        }
    }




//nella classe control seguire i vari passi,recuperare dalla get le 3 richieste scelte e i relativi id dei dischi,creare un sondaggoi con questi e fare la store e dopo la delete delle richieste con quegli id
    public static function store(ESondaggio $sondaggio): bool
    {
        self::update_incorso();
        $pdo = FConnectionDB::connect();
        $stmt = $pdo->prepare("INSERT INTO sondaggi VALUES(:id , :disco1, 0, :disco2, 0, :disco3, 0, :dat, 1 )");

        $ris = $stmt->execute(array(
            ':id' => $sondaggio->getId(),
            ':disco1' => $sondaggio->getDisco1()->getID(),
            ':disco2' =>$sondaggio->getDisco2()->getID(),
            ':disco3' =>$sondaggio->getDisco3()->getID(),
            ':dat' =>$sondaggio->getData()));

        return $ris;
    }

    public static function delete(string $id): bool {
        $pdo = FConnectionDB::connect();
        $stmt = $pdo->prepare("DELETE FROM sondaggi WHERE id = :id");
        $ris = $stmt->execute([':id' => $id]);
        return $ris;
    }

    //aggiungere controllo votazione, con wireshark si potrebbero modificare i pacchetti e insierire un cd non valido per il sondaggio
    public static function update (ESondaggio $sondaggio): void {
        $pdo = FConnectionDB::connect();
        $stmt = $pdo->prepare("UPDATE sondaggi SET voti_disco1= :votidisco1, voti_disco2= :votidisco2,
                    voti_disco3 = :votidisco3 , in_corso = :incorso WHERE id = :id");
        $ris = $stmt->execute(array(
            ':votidisco1' => $sondaggio->getVotiDisco1(),
            ':votidisco2' =>$sondaggio->getVotiDisco2(),
            ':votidisco3' =>$sondaggio->getVotiDisco3(),
            ':incorso' =>$sondaggio->getInCorso(),
            ':id'=>$sondaggio->getId()));
       //ricordarsi di costruire nelle view l oggetto sondaggio corretto con l utente e la votazione
    }


    public static function prelevaSondaggi(): array {
        $pdo = FConnectionDB::connect();
        $stmt = $pdo->prepare("SELECT * FROM sondaggi");
        $stmt->execute();
        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $sondaggi = array();
        foreach ($rows as $row) {
            $sondaggio=new ESondaggio(
                $row['disco1'],
                $row['disco2'],
                $row['disco3'],
                $row['data']
            );
            $sondaggio->setId( $row['id']);
            $sondaggio->setVotiDisco1( $row['voti_disco1']);
            $sondaggio->setVotiDisco2( $row['voti_disco2']);
            $sondaggio->setVotiDisco3( $row['voti_disco3']);
            $sondaggio->setInCorso( $row['in_corso']);


            $sondaggi[$row['id']]=$sondaggio;
        }
        return $sondaggi;
    }


    /**
    //fare il controllo se l'utente ha gia votato
    public static function exist_votazione(string $ut):bool {
    $pdo = FConnectionDB::connect();
        $stmt = $pdo->prepare("SELECT * FROM votazione WHERE utente = :ut");
        $ris = $stmt->execute([':ut' => $ut]);
        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

        if (count($rows) == 0) { return false; }
        else { return true; }
    }

     */
    public static function store_votazione(string $utente,string $sondaggio,string $disco): void {

        $pdo = FConnectionDB::connect();
        $stmt = $pdo->prepare("INSERT INTO votazioni VALUES(:utente, :sondaggio, :disco)");
        $ris = $stmt->execute(array(
            ':utente' => $utente,
            ':sondaggio' =>$sondaggio,
            ':disco'=>$disco));
    }



}