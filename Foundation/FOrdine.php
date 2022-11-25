<?php
class FOrdine{

    public static function exist($id) : bool {

        $pdo = FConnectionDB::connect();

        $query = "SELECT * FROM ordine WHERE IdOrdine = :id";
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

    public static function store(EOrdine $ordine): void {
        $pdo = FConnectionDB::connect();
        $query = "INSERT INTO ordine VALUES(:IdOrdine,:CittaSped,:CAPSped,:IndirizzoSped,:ModPagamento,:Dischi,:TotOrdine,:IdCliente)";
        $stmt = $pdo->prepare($query);
        $stmt->execute(array(
            ':IdOrdine' => $ordine->getIdOrdine(),
            ':CittaSped' => $ordine->getCittaSpe(),
            ':CAPSped'  =>$ordine->getCapSped(),
            ':IndirizzoSped' =>$ordine->getIndirizzoSped(),
            ':ModPagamento' =>$ordine->getModPagamento(),
            ':Dischi' =>$ordine->getDischi(),
            ':TotOrdine' =>$ordine->getTotOrdine(),
            ':IdCliente' =>$ordine->getIdCliente()
        ));
    }

    public static function load(string $idor) : EOrdine {
        $pdo=FConnectionDB::connect();

        $query = "SELECT * FROM ordine WHERE IdOrdine= :idor";
        $stmt = $pdo->prepare($query);
        $stmt->execute( [":idor" => $idor] );
        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $IdOrdine = $rows[0]['IdOrdine'];
        $CittàSpe = $rows[0]['CittaSped'];
        $CAPSped = $rows[0]['CAPSped'];
        $IndirizzoSped = $rows[0]['IndirizzoSped'];
        $ModPagamento = $rows[0]['ModPagamento'];
        $TotOrdine = $rows[0]['TotOrdine'];
        $IdCliente = $rows[0]['IdCliente'];

        $carrello = new ECarrello($IdCliente) ; //TODO: da mettere ECarrello [da controllare]
        $carrello->setDischi(FCarrello::loadlista($IdOrdine));

        $ordine = new EOrdine($IdCliente);

        $ordine->Compile($IdOrdine, $CittàSpe, $CAPSped, $IndirizzoSped, $ModPagamento, $TotOrdine,$carrello );

        return $ordine;
    }

    public static function delete(string $idor) {
        $pdo=FConnectionDB::connect();

        try {
            $ifExist = self::exist($idor);
            if($ifExist) {
                $query = "DELETE FROM ordine WHERE IdOrdine= :idor";
                $stmt = $pdo->prepare($query);
                $stmt->execute([":idor" => $idor]);
                return true;
            }
            else{ return false;}
        }
        catch(PDOException $exception) {print("Errore".$exception->getMessage());}

    }



    public static function prelevaOrdini(string $cl) : EOrdine {
        $pdo=FConnectionDB::connect();

        $query = "SELECT * FROM ordine WHERE IdCliente= :idcl";
        $stmt = $pdo->prepare($query);
        $stmt->execute( [":idcl" => $cl] );
        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $ordini = array();
        foreach ($rows as $row) {
            $IdOrdine = $rows[0]['IdOrdine'];
            $CittàSpe = $rows[0]['CittaSped'];
            $CAPSped = $rows[0]['CAPSped'];
            $IndirizzoSped = $rows[0]['IndirizzoSped'];
            $ModPagamento = $rows[0]['ModPagamento'];
            $TotOrdine = $rows[0]['TotaleOrdine'];
            $IdCliente = $rows[0]['IdCliente'];
            $carrello = new ECarrello($IdCliente) ; //TODO: da mettere ECarrello [da controllare]
            $carrello->setDischi(FCarrello::loadlista($IdOrdine));

            $ordine = new EOrdine($IdCliente);

            $ordine->Compile($IdOrdine, $CittàSpe, $CAPSped, $IndirizzoSped, $ModPagamento, $TotOrdine,$carrello );
            $ordini[$IdOrdine]=$ordine;
        }




        return $ordine;
    }






}