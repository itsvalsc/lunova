<?php

/**
 * in FUtente e Fdisco mettere il riferimento id dell'immagine nei values (bind)
 * Class FImmagine
 */

class FImmagine
{
    private static $class = "FImmagine";

    private static $table = "immagine";

    private static $values = "(:Id,:Nome,:Formato,:Byte)";

    public function __construct(){}

    /**
     * @param $statement
     * @param EImmagine $immagine
     * @param $foreignkey

    public static function bind($statement, EImmagine $immagine, $foreignkey){
        $statement->bindValue(':Id',$immagine->getId(), PDO::PARAM_STR);
        $statement->bindValue(':Nome',$immagine->getNome(), PDO::PARAM_STR);
        $statement->bindValue(':Formato',$immagine->getFormato(), PDO::PARAM_STR);
        $statement->bindValue(':Byte',$immagine->getByte(), PDO::PARAM_STR);
        if($foreignkey["idartista"]!=null){
            $statement->bindValue(':IdArtista',$foreignkey["idartista"], PDO::PARAM_STR);
        }else{
            $statement->bindValue(':IdArtista',null, PDO::PARAM_STR);
        }
        //if($foreignkey["idcategoria"]!=null){
            //$statement->bindValue(':RIdCategoria',$foreignkey["idcategoria"],PDO::PARAM_STR);
        //}else{
            //$statement->bindValue(':RIdCategoria',null,PDO::PARAM_STR);
        //}

    }*/

    /**
     * @param $immagine
     * @param $foreignkey
     */
    public static function store(EImmagine $imm): void {
        $pdo = FConnectionDB::connect();
        $query = "INSERT INTO immagine VALUES(:id,:nome,:formato,:immagine,:idAppartenenza)";
        $stmt = $pdo->prepare($query);
        $stmt->execute(array(
            ':id' => $imm->getId(),
            ':nome' => $imm->getNome(),
            ':formato'  =>$imm->getFormato(),
            ':immagine' => base64_encode($imm->getImmagine()),
            ':idAppartenenza' =>$imm->getIdAppartenenza(),

        ));

    }

    /**
     * @param $etichetta
     * @param $nome
     * @return mixed
     */

    public static function exist($id) : bool {

        $pdo = FConnectionDB::connect();

        $query = "SELECT * FROM immagine WHERE IdAppartenenza = :id";
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
     * @param $etichetta
     * @param $nome
     * @return bool

    public static function deleteImmagine ($etichetta,$nome){
        $connection = FPersistentManager::getInstance();
        $ris = $connection->delete(static::getClass(),$etichetta,$nome);
        return $ris;
    }*/

    /**
     * @param $etichetta
     * @param $id
     * @return EImmagine
     * @throws Exception
     */
    public static function load(string $idappartenenza):?EImmagine {
        $pdo=FConnectionDB::connect();
        $query = "SELECT * FROM immagine WHERE IdAppartenenza= :id";
        $stmt = $pdo->prepare($query);
        $stmt->execute( [":id" => $idappartenenza] );
        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
        if (count($rows)!=0){
            $Id = $rows[0]['Id'];
            $nome = $rows[0]['Nome'];
            $formato = $rows[0]['Formato'];
            $immagine = $rows[0]['Immagine'];
            $image = new EImmagine($nome,$formato,$immagine,$idappartenenza);
            $image->setId($Id);
        }else{
            $image = null;
        }
        return $image;
        }

    public static function delete(string $id) {
        $pdo=FConnectionDB::connect();

        try {
            $ifExist = self::exist($id);
            if($ifExist) {
                $query = "DELETE FROM immagine WHERE IdAppartenenza= :id";
                $stmt = $pdo->prepare($query);
                $stmt->execute([":id" => $id]);
                return true;
            }
            else{ return false;}
        }
        catch(PDOException $exception) {print("Errore".$exception->getMessage());}

    }

    /**
     * @return string
     */
    public static function getClass(): string
    {
        return self::$class;
    }

    /**
     * @return string
     */
    public static function getTable(): string
    {
        return self::$table;
    }

    /**
     * @return string
     */
    public static function getValues(): string
    {
        return self::$values;
    }



}