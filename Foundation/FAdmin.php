<?php

/**
 * La classe FAdmin permette la comunicazione tra db e l'istanza di un oggetto EAdmin
 * @package Foundation
 */

class FAdmin{

    /**
     * metodo che verifica l'esistenza di un amministratore nel db
     * @package Foundation
     */
    public static function exist($email) : bool {

            $pdo = FConnectionDB::connect();
            $query = "SELECT * FROM admin WHERE Email = :email";
            $stmt= $pdo->prepare($query);
            $stmt->execute([":email" => $email]);
            $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
            if (count($rows)==0){
                return false;
            }
            else {
                return true;
            }
    }

    /**
     * metodo che memorizza un'istanza di EAdmin sul db
     * @package Foundation
     */
    public static function store(EAdmin $admin): void {

            $pdo = FConnectionDB::connect();
            $query = "INSERT INTO admin VALUES(:IdAmministratore,:Email,:Nome,:Cognome,:NTelefono,:Password,:Livello)";
            $stmt = $pdo->prepare($query);
            $stmt->execute(array(
                ':IdAmministratore' => $admin->getIdAmministratore(),
                ':Email' => $admin->getEmail(),
                ':Nome'  =>$admin->getNome(),
                ':Cognome' =>$admin->getCognome(),
                ':NTelefono' =>$admin->getTelefono(),
                ':Password' =>$admin->criptaPassword($admin->getPassword()),
                ':Livello' =>$admin->getLivello()
            ));
    }

    /**
     * metodo che permette di caricare un oggetto EAdmin prendendo i dati dal db
     * @package Foundation
     */
    public static function load(string $email) {
            $pdo=FConnectionDB::connect();

            try {
                $ifExist = self::exist($email);
                if($ifExist) {
                    $query = "SELECT * FROM admin WHERE Email= :email";
                    $stmt = $pdo->prepare($query);
                    $stmt->execute( [":email" => $email] );
                    $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

                    $IdAmministratore = $rows[0]['IDAmministratore'];
                    $Email = $rows[0]['Email'];
                    $Nome = $rows[0]['Nome'];
                    $Cognome = $rows[0]['Cognome'];
                    $Telefono = $rows[0]['NTelefono'];
                    $Password = $rows[0]['Password'];
                    //$Livello = $rows[0]['Livello'];

                    $utente = new EAdmin($Nome,$Cognome,$Email,$Password,$Telefono,$IdAmministratore);
                    return $utente;
                }
                else {return "Non ci sono amministratori";}
            }
            catch (PDOException $exception) { print ("Errore".$exception->getMessage());}

    }

    /**
     * metodo che permette di aggiornare un valore del profilo EAdmin
     * @package Foundation
     */
    public static function update_value($attributo,$value,$id){
            $pdo = FConnectionDB::connect();
            $query = "UPDATE admin SET $attributo = :value  WHERE IDAmministratore = :id";
            $stmt= $pdo->prepare($query);
            $ris = $stmt->execute([
                ":value" => $value,
                ":id" => $id
            ]);
            return $ris;
    }

    /**
     * metodo che permette la cancellazione di un oggetto EAdmin dal db
     * @package Foundation
     */
    public static function delete(string $email) {
            $pdo=FConnectionDB::connect();

            try {
                $ifExist = self::exist($email);
                if($ifExist) {
                    $query = "DELETE FROM admin WHERE Email= :email";
                    $stmt = $pdo->prepare($query);
                    $stmt->execute([":email" => $email]);
                    return true;
                }
                else{ return false;}
            }
            catch(PDOException $exception) {print("Errore".$exception->getMessage());}
    }


    /**
     * metodo che mermette all'amministratore di caricare i generi dal db
     * @package Foundation
     */
    public static function loadgeneri() : array {
            $pdo=FConnectionDB::connect();

            try {
                    $query = "SELECT * FROM categories";
                    $stmt = $pdo->prepare($query);
                    $stmt->execute();
                    $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
                    $gen = array();
                    foreach ($rows as $row){
                        $genere = $row['name'];
                        array_push($gen,$genere);
                    }
                    return $gen;
            }
            catch (PDOException $exception) {
                print ("Errore".$exception->getMessage());
                $pdo->rollBack();
                return array();}
    }
}
?>