<?php

class FWallet {

    public static function exist($id) : bool {

        $pdo = FConnectionDB::connect();

        $query = "SELECT * FROM wallet WHERE IdWallet = :id";
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

    public static function store(EWallet $wallet): void {
        $pdo = FConnectionDB::connect();
        $query = "INSERT INTO wallet VALUES(:IdWallet,:saldo,:IdCliente)";
        $stmt = $pdo->prepare($query);
        $stmt->execute(array(
            ':IdWallet' => $wallet->getIdWallet(),
            ':saldo' => $wallet->getConto(),
            ':IdCliente'  =>$wallet->getIdCliente()
        ));
    }

    public static function load(string $id) {
        $pdo=FConnectionDB::connect();

        try {
            $ifExist = self::exist($id);
            if($ifExist) {
                $query = "SELECT * FROM wallet WHERE IdWallet= :id";
                $stmt = $pdo->prepare($query);
                $stmt->execute( [":id" => $id] );
                $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

                $IdWallet = $rows[0]['IdWallet'];
                $saldo = $rows[0]['Saldo'];
                $IdCliente = $rows[0]['IdCliente'];

                $wallet = new EWallet($IdWallet, $saldo, $IdCliente);
                $wallet->setIdWallet($IdWallet);
                return $wallet;
            }
            else {return "Non ci sono wallet associati a questo cliente";}
        }
        catch (PDOException $exception) { print ("Errore".$exception->getMessage());}

    }

    public static function update( $campo, $valore, $id)
    {
        $pdo=FConnectionDB::connect();

        $query = "UPDATE wallet SET " . $campo . " = :valore  WHERE  IdWallet = :id";
        $stmt = $pdo->prepare($query);
        $stmt->execute([":id" => $id , ":valore" => $valore]);
        return true;
    }

    public static function delete(string $Id) {
        $pdo=FConnectionDB::connect();

        try {
            $ifExist = self::exist($Id);
            if($ifExist) {
                $query = "DELETE FROM wallet WHERE IdWallet= :id";
                $stmt = $pdo->prepare($query);
                $stmt->execute([":id" => $Id]);
                return true;
            }
            else{ return print('File non trovato');}
        }
        catch(PDOException $exception) {print("Errore".$exception->getMessage());}

    }

}