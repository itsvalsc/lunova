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
        $query = "INSERT INTO ordine VALUES(:IdOrdine,:CittaSped,:CAPSped,:IndirizzoSped,:ModPagamento,:Dischi,:TotOrdine,:IdCliente, :TotSpesa)";
        $stmt = $pdo->prepare($query);
        $stmt->execute(array(
            ':IdOrdine' => $ordine->getIdOrdine(),
            ':CittaSped' => $ordine->getCittaSpe(),
            ':CAPSped'  =>$ordine->getCapSped(),
            ':IndirizzoSped' =>$ordine->getIndirizzoSped(),
            ':ModPagamento' =>$ordine->getModPagamento(),
            ':Dischi' =>$ordine->getCarrello(),
            ':TotOrdine' =>$ordine->getTotOrdine(),
            ':IdCliente' =>$ordine->getIdCliente(),
            ':TotSpesa' =>$ordine->getTotOrdine()
        ));
    }

    public static function load(string $idor) : EOrdine {
        $pdo=FConnectionDB::connect();

        $query = "SELECT * FROM ordine WHERE IdOrdine= :idor";
        $stmt = $pdo->prepare($query);
        $stmt->execute( [":idor" => $idor] );
        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $IdOrdine = $rows[0]['IdOrdine'];
        $CittaSpe = $rows[0]['CittaSped'];
        $CAPSped = $rows[0]['CAPSped'];
        $IndirizzoSped = $rows[0]['IndirizzoSped'];
        $ModPagamento = $rows[0]['ModPagamento'];
        $TotOrdine = $rows[0]['TotOrdine'];
        $IdCliente = $rows[0]['IdCliente'];


        $carrello = new ECarrello($IdCliente) ; //TODO: da mettere ECarrello [da controllare]
        $carrello->setDischi(FCarrello::loadlista($IdOrdine));

        $ordine = new EOrdine($IdCliente);

        $ordine->Compile($IdOrdine, $CittaSpe, $CAPSped, $IndirizzoSped, $ModPagamento, $TotOrdine,$carrello );

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
            $CittaSpe = $rows[0]['CittaSped'];
            $CAPSped = $rows[0]['CAPSped'];
            $IndirizzoSped = $rows[0]['IndirizzoSped'];
            $ModPagamento = $rows[0]['ModPagamento'];
            $TotOrdine = $rows[0]['TotaleOrdine'];
            $IdCliente = $rows[0]['IdCliente'];
            $carrello = new ECarrello($IdCliente) ; //TODO: da mettere ECarrello [da controllare]
            $carrello->setDischi(FCarrello::loadlista($IdOrdine));

            $ordine = new EOrdine($IdCliente);

            $ordine->Compile($IdOrdine, $CittaSpe, $CAPSped, $IndirizzoSped, $ModPagamento, $TotOrdine,$carrello );
            $ordini[$IdOrdine]=$ordine;
        }




        return $ordine;
    }





    public static function AddToOrdine(array $productarray, $cartid, $cli_id)
    {
        //$pdo = FConnectionDB::connect();

        $lista = [];
        $tot= 0;
        $stringa="";

        foreach ($productarray as $row){
            //var_dump($row->getQuantity());
            //var_dump($row->getIdItem()); //mi serve
            $recupero = FDisco::load($row->getIdItem());
            $autore = $recupero->getAutore();
            $artista = FArtista::loadName($autore);
            $id_nel_carrello = $row->getIdCartItem();
            //var_dump($recupero->getTitolo());
            //var_dump($recupero->getAutore());
            //var_dump($recupero->getPrezzo());
            $qta=$row->getQuantity();
            $titolo =$recupero->getTitolo();
            $prezzo = $recupero->getPrezzo();
            $stringa = $stringa . "$qta x $titolo by $artista $ $prezzo;";
            //print_r($stringa);
            //print_r("\n");
            array_push($lista, $stringa);

            $tot = $tot + ($qta * $prezzo);

            FCartItem::delete($id_nel_carrello,$cartid);
        }

        $ordine = new EOrdine( $cli_id);
        //$ordine->setCarrello($lista);
        $ordine->setCarrello($stringa);
        $ordine->setTotOrdine($tot);
        FOrdine::store($ordine);


        return $ordine;
    }

    public static function RecuperoOrdini($id_cli){
        $pdo = FConnectionDB::connect();

        $query = "SELECT * FROM ordine WHERE IdCliente= :idcl";
        $stmt = $pdo->prepare($query);
        $stmt->execute( [":idcl" => $id_cli] );
        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $recovery = [];

        foreach ($rows as $row) {
            $fff = $row['TotaleOrdine'];
            $totalesoldi = $row['TotSpesa'];
            $utile_array = explode(";", $fff);
            $uscita = "";
            foreach ($utile_array as $utile) {
                $uscita = $uscita . $utile . "\n";
            }
            $uscita = nl2br($uscita). "\nTOTALE : €". "$totalesoldi";
            array_push($recovery, $uscita);
        }

        return $recovery;
    }





}