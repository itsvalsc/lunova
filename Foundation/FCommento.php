<?php

class FCommento{
    public static function exist($id) : bool {

        $pdo = FConnectionDB::connect();

        $query = "SELECT * FROM commenti WHERE idcom = :id";
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

    public static function store(ECommento $comm): void {
        $pdo = FConnectionDB::connect();
        $com = self::Sicurezza($comm, $comm->getIdAP());
        $comm->setTesto($com);
        $query = "INSERT INTO commenti VALUES(:idcom,:testo,:idad,:idap)";
        $stmt = $pdo->prepare($query);
        $stmt->execute(array(
            ':idcom' => $comm->getId(),
            ':testo' => $comm->getTesto(),
            ':idad' =>$comm->getIdAD(),
            ':idap' =>$comm->getIdAP()
        ));
    }

    public static function delete(string $ID_comm)
    {
        $pdo = FConnectionDB::connect();

        try {
            $ifExist = self::exist($ID_comm);
            if ($ifExist) {
                $query = "DELETE FROM commenti WHERE idcomm= :id";
                $stmt = $pdo->prepare($query);
                $stmt->execute([":id" => $ID_comm]);
                return true;
            } else {
                return print('File non trovato');
            }
        } catch (PDOException $exception) {
            print("Errore" . $exception->getMessage());
        }
    }


    public static function prelevaCommentiperAutore(string $aut) : array
    {
        try {
            $pdo = FConnectionDB::connect();
            //$pdo->beginTransaction();

            $stmt = $pdo->prepare("SELECT * FROM commenti WHERE idap = :autore");
            $stmt->execute([":autore" => $aut]);
            $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
            $comments = array();
            $i = 0;
            foreach ($rows as $row) {
                $id = $row['idcomm'];

                $comment = new ECommento($row['testo'],
                    $row['idad'],
                    $row['idap']
                );
                $comment->setId($id);

                $comments[$i] = $comment;
                ++$i;
            }
            return $comments;
        } catch (PDOException $e) {
            print("ATTENTION ERROR: ") . $e->getMessage();
            $pdo->rollBack();
            return array();
        }
    }

    public static function prelevaCommentiperDisco(string $aut) : array {
        try{
            $pdo = FConnectionDB::connect();
            //$pdo->beginTransaction();

            $stmt = $pdo->prepare("SELECT * FROM commenti WHERE idad = :disco");
            $stmt->execute([":disco"=>$aut]);
            $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
            $comments = array();
            $i= 0 ;
            foreach ($rows as $row) {
                $id = $row['idcomm'];

                $comment=new ECommento($row['testo'],
                    $row['idad'],
                    $row['idap']
                );
                $comment->setId($id);

                $comments[$i]=$comment;
                ++$i;
            }
            return $comments;
        }
        catch (PDOException $e){
            print("ATTENTION ERROR: ") . $e->getMessage();
            $pdo->rollBack();
            return array();
        }

    }

    public static function Sicurezza(string $t, string $idap)
    {   $f = "../inc/crosswords.txt";
        $pers = FPersistentManager::getInstance();
        //var_dump($f);
        $apertura = file($f);
        for ($i=0; $i < count($apertura) ; $i++) {
            $words = explode(";", $apertura[$i]);
        }

        $text = explode(" ", $t);
        $t1 = str_replace($words, "***",$t);
        if ( $t!=$t1){
            $n = new ENotifiche("Questo commento è inopportuno, generato dall'utente $idap", "alta", $idap);
            $pers->store($n);
        }
        return $t1;
    }


    }
