<?php

/**
 * La classe FOrdine fornisce query per gli oggetti EOrdine
 * @package Foundation
 */

class FOrdine{

    /**
     * metodo che verifica l'esistenza di un ordine nel db
     * @package Foundation
     */
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

    /**
     * metodo che memorizza l'istanza di un oggetto EOrdine nel db
     * @package Foundation
     */
    public static function store(EOrdine $ordine): void {
        $pdo = FConnectionDB::connect();
        $query = "INSERT INTO ordine VALUES(:IdOrdine,:CittaSped,:CAPSped,:IndirizzoSped,:civico,:TotOrdine,:Confermato,:IdCliente, :TotSpesa)";
        $stmt = $pdo->prepare($query);
        $stmt->execute(array(
            ':IdOrdine' => $ordine->getIdOrdine(),
            ':CittaSped' => $ordine->getCittaSpe(),
            ':CAPSped'  =>$ordine->getCapSped(),
            ':IndirizzoSped' =>$ordine->getIndirizzoSped(),
            ':civico' =>$ordine->getcivico(),
            ':TotOrdine' =>$ordine->getCarrello(),
            ':Confermato' =>0,
            ':IdCliente' =>$ordine->getIdCliente(),
            ':TotSpesa' =>$ordine->getTotOrdine()
        ));
    }

    /**
     * metodo che restituisce un oggetto EOrdine caricato dal db
     * @package Foundation
     */
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
        $civico = $rows[0]['civico'];
        $TotOrdine = $rows[0]['TotOrdine'];
        $IdCliente = $rows[0]['IdCliente'];

        $carrello = new ECarrello($IdCliente) ;
        $carrello->setDischi(FCarrello::loadlista($IdOrdine));

        $ordine = new EOrdine($IdCliente);
        $ordine->Compile($IdOrdine, $CittaSpe, $CAPSped, $IndirizzoSped, $civico, $TotOrdine,$carrello );
        return $ordine;
    }

    /**
     * metodo che restituisce la lista di oggetti EOrdine caricati dal db passando come parametro l'id del cliente
     * @package Foundation
     */
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

    /**
     * metodo che permette di eliminare l'istanza di un oggetto EOrdine dal db
     * @package Foundation
     */
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


    /**
     * metodo che permette di aggiungere  l'istanza di un oggetto EOrdine al db associato all'id del cliente in sessione
     * @package Foundation
     */
    public static function AddToOrdine(array $productarray, $cartid, $cli_id) {
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
            FCartItem::delete_cart($cartid);
        }

        $cli = FCliente::loadId($cli_id);
        $ordine = new EOrdine( $cli);
        //$ordine->setCarrello($lista);
        $ordine->setCarrello($stringa);
        $ordine->setTotOrdine($tot);
        FOrdine::store($ordine);
        return $ordine;
    }



}