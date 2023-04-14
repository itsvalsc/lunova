<?php

class FDisco {

    public static function exist($id) : bool {

        $pdo = FConnectionDB::connect();

        $query = "SELECT * FROM dischi WHERE ID = :id";
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

    public static function store(EDisco $disco): void {
        $pdo = FConnectionDB::connect();
        $query = "INSERT INTO dischi VALUES(:ID,:name,:description,:price,:category_id,:artist_id,:Qta)";
        $stmt = $pdo->prepare($query);
        $stmt->execute(array(
            ':ID' => $disco->getID(),
            ':name' => $disco->getTitolo(),
            ':description' =>$disco->getDescrizione(),
            ':price' =>$disco->getPrezzo(),
            ':category_id' =>$disco->getGenere(),
            ':artist_id' =>$disco->getAutore(),
            ':Qta' =>$disco->getQta()
        ));
        FImmagine::store($disco->getCopertina());
    }

    public static function load(string $id) {
        $immagine = FImmagine::load($id);
        $pdo=FConnectionDB::connect();

        try {
            $ifExist = self::exist($id);
            if($ifExist) {
                $query = "SELECT * FROM dischi WHERE ID= :id";
                $stmt = $pdo->prepare($query);
                $stmt->execute( [":id" => $id] );
                $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

                $IdDisco = $rows[0]['ID'];
                $titolo = $rows[0]['name'];
                $desc = $rows[0]['description'];
                $prez= $rows[0]['price'];
                $gen = $rows[0]['category_id'];
                $art = $rows[0]['artist_id'];
                $qta = $rows[0]['Qta'];


                $disco = new EDisco($titolo,$art,$prez,$desc,$gen,$immagine,$qta);
                $disco->setID($IdDisco);
                return $disco;
            }
            else {return "Non ci sono Dischi";}
        }
        catch (PDOException $exception) { print ("Errore".$exception->getMessage());}

    }


    public static function prelevaDischi() : array {
        try{
            $pdo = FConnectionDB::connect();
            //$pdo->beginTransaction();

            $stmt = $pdo->prepare("SELECT * FROM dischi");
            $stmt->execute();
            $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
            $dischi = array();
            $i= 0 ;
            foreach ($rows as $row) {
                $id = $row['ID'];
                $immagine = FImmagine::load($id);
                $disc=new EDisco($row['name'],
                    $row['artist_id'],
                    $row['price'],
                    $row['description'],
                    $row['category_id'],
                    $immagine,
                    $row['Qta']
                    );
                $disc->setID($id);

                $dischi[$i]=$disc;
                ++$i;
            }
            //$pdo->commit();
            return $dischi;
        }
        catch (PDOException $e){
            print("ATTENTION ERROR: ") . $e->getMessage();
            //$pdo->rollBack();
            return array();
        }

    }

    public static function prelevaDischiperGenere(string $cat) : array {
        try{
            $pdo = FConnectionDB::connect();
            //$pdo->beginTransaction();

            $stmt = $pdo->prepare("SELECT * FROM dischi WHERE category_id = :categoria");
            $stmt->execute([":categoria"=>$cat]);
            $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
            if (count($rows)!=0){
            $dischi = array();
            $i= 0 ;
            foreach ($rows as $row) {
                $id = $row['ID'];
                $immagine = FImmagine::load($id);
                $disc=new EDisco($row['name'],
                    $row['artist_id'],
                    $row['price'],
                    $row['description'],
                    $row['category_id'],
                    $immagine,
                    $row['Qta']
                );
                $disc->setID($id);
                $dischi[$i]=$disc;
                ++$i;
                }
            }else{
                $dischi=array();
            }

            return $dischi;
        }
        catch (PDOException $e){
            print("ATTENTION ERROR: ") . $e->getMessage();
            $pdo->rollBack();
            return array();
        }

    }

    public static function prelevaDischiperAutore(string $aut) : array {
        try{
            $pdo = FConnectionDB::connect();
            //$pdo->beginTransaction();

            $stmt = $pdo->prepare("SELECT * FROM dischi WHERE artist_id = :artista");
            $stmt->execute([":artista"=>$aut]);
            $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
            $dischi = array();
            $i= 0 ;
            foreach ($rows as $row) {
                $id = $row['ID'];
                $immagine = FImmagine::load($id);
                $disc=new EDisco($row['name'],
                    $row['artist_id'],
                    $row['price'],
                    $row['description'],
                    $row['category_id'],
                    $immagine,
                    $row['Qta']
                );
                $disc->setID($id);

                $dischi[$i]=$disc;
                ++$i;
            }
            //$pdo->commit();
            return $dischi;
        }
        catch (PDOException $e){
            print("ATTENTION ERROR: ") . $e->getMessage();
            $pdo->rollBack();
            return array();
        }

    }

    public static function prelevaDischiperTitolo(string $ttl) : array {
        try{
            $pdo = FConnectionDB::connect();
            //$pdo->beginTransaction();

            $stmt = $pdo->prepare("SELECT * FROM dischi WHERE name like CONCAT(:titolo,'%')");
            $stmt->execute([":titolo"=>$ttl]);
            $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
            if (count($rows)!=0){
                $dischi = array();
                $i= 0 ;
                foreach ($rows as $row) {
                    $id = $row['ID'];
                    $immagine = FImmagine::load($id);
                    $disc=new EDisco($row['name'],
                        $row['artist_id'],
                        $row['price'],
                        $row['description'],
                        $row['category_id'],
                        $immagine,
                        $row['Qta']
                    );
                    $disc->setID($id);

                    $dischi[$i]=$disc;
                    ++$i;
                }
            }else{
                $dischi = array();
            }
            //$pdo->commit();
            return $dischi;
        }
        catch (PDOException $e){
            print("ATTENTION ERROR: ") . $e->getMessage();
            $pdo->rollBack();
            return array();
        }

    }

    public static function delete(string $ID_disco) {
        $pdo=FConnectionDB::connect();

        try {
            $ifExist = self::exist($ID_disco);
            if($ifExist) {
                $query = "DELETE FROM dischi WHERE ID= :id";
                $stmt = $pdo->prepare($query);
                $stmt->execute([":id" => $ID_disco]);
                return true;
            }
            else{ return print('File non trovato');}
        }
        catch(PDOException $exception) {print("Errore".$exception->getMessage());}

    }

    public static function update( $campo, $valore, $id)
    {
        $pdo=FConnectionDB::connect();

        $query = "UPDATE wallet SET " . $campo . " = :valore  WHERE  IdWallet = :id";
        $stmt = $pdo->prepare($query);
        $stmt->execute([":id" => $id , ":valore" => $valore]);
        return true;
    }

    public static function updateQta( $valore, $id)
    {
        $pdo=FConnectionDB::connect();

        $query = "UPDATE dischi SET Qta = :valore  WHERE  ID = :id";
        $stmt = $pdo->prepare($query);
        $stmt->execute([":id" => $id , ":valore" => $valore]);
        return true;
    }

}






















?>