<?php

/**
 * La classe FImmagine fornisce query per gli oggetti EImmagine
 * Class FImmagine
 */

class FImmagine{

    /**
     * metodo che verifica l'esistenza dellistanza di EImmagine nel db
     * @package Foundation
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
     * metodo che memorizza l'istanza di un oggetto EImmagine sul db
     * @package Foundation
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
     * metodo che restituisce un oggetto EImmagine caricato dal db
     * @package Foundation
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

    /**
     * metodo che permette di eliminare l'istanza di un oggetto EImmagine dal db
     * @package Foundation
     */
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
}