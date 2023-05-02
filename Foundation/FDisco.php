<?php

/**
 * La classe FDisco fornisce query per gli oggetti EDisco
 * @package Foundation
 */

class FDisco {

    /**
     * metodo che verifica l'esistenza di un disco nel db
     * @package Foundation
     */
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

    /**
     * metodo che memorizza l'stanza di un EDisco sul db
     * @package Foundation
     */
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

    /**
     * metodo che restituice un oggetto EDisco caricato dal db
     * @package Foundation
     */
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
            else {return null;}
        }
        catch (PDOException $exception) { print ("Errore".$exception->getMessage());}
    }

    /**
     * metodo che restituisce una lista con tutti gli oggetti EDisco caricati dal db
     * @package Foundation
     */
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

    /**
     * metodo che restituisce una lista con tutti gli oggetti EDisco caricati dal db passando come parametro il genere
     * @package Foundation
     */
    public static function prelevaDischiperGenere(string $cat) : array {
        try{
            $pdo = FConnectionDB::connect();

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

    /**
     * metodo che restituisce una lista con tutti gli oggetti EDisco caricati dal db passando come parametro l'artista
     * @package Foundation
     */
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

    /**
     * metodo che restituisce una lista con tutti gli oggetti EDisco caricati dal db passando come parametro il titolo
     * @package Foundation
     */
    public static function prelevaDischiperTitolo(string $ttl) : array {
        try{
            $pdo = FConnectionDB::connect();

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
            return $dischi;
        }
        catch (PDOException $e){
            print("ATTENTION ERROR: ") . $e->getMessage();
            $pdo->rollBack();
            return array();
        }
    }

    /**
     * metodo che elimina l'istanza di un oggetto EDisco
     * @package Foundation
     */
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
            else{ return false;}
        }
        catch(PDOException $exception) {print("Errore".$exception->getMessage());}
    }

    /**
     * metodo che elimina l'stanza di un oggetto EDisco tramite l'id dell'artista (autore del disco)
     * @package Foundation
     */
    public static function deletebyUtente(string $id) {
        $pdo=FConnectionDB::connect();
        try {
                $query = "DELETE FROM dischi WHERE artist_id= :id";
                $stmt = $pdo->prepare($query);
                $stmt->execute([":id" => $id]);
        }
        catch(PDOException $exception) {print("Errore".$exception->getMessage());}
    }

    /**
     * metodo che permette di aggiornare l'attributo della quantità dell'oggetto EDisco
     * @package Foundation
     */
    public static function updateQta( $valore, $id)
    {
        $pdo=FConnectionDB::connect();

        $query = "UPDATE dischi SET Qta = :valore  WHERE  ID = :id";
        $stmt = $pdo->prepare($query);
        $stmt->execute([":id" => $id , ":valore" => $valore]);
        return true;
    }

    /**
     * metodo che permette di aggiornare l'attributo del prezzo dell'oggetto EDisco
     * @package Foundation
     */
    public static function updatePrice( $valore, $id) {
        $pdo=FConnectionDB::connect();

        $query = "UPDATE dischi SET price = :valore  WHERE  ID = :id";
        $stmt = $pdo->prepare($query);
        $stmt->execute([":id" => $id , ":valore" => $valore]);
        return true;
    }
}
?>