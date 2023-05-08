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

    public static function update_value($attributo,$value,$id){
        $pdo = FConnectionDB::connect();
        $query = "UPDATE ordine SET $attributo = :value  WHERE IdOrdine = :id";
        $stmt= $pdo->prepare($query);
        $ris = $stmt->execute([
            ":value" => $value,
            ":id" => $id
        ]);
        return $ris;
    }


    /**
     * metodo che permette di aggiungere  l'istanza di un oggetto EOrdine al db associato all'id del cliente in sessione
     * @package Foundation
     */
    public static function AddToOrdine(array $productarray, $cli_id) {
        $pdo = FConnectionDB::connect();
        $pdo->exec('LOCK TABLES dischi WRITE, artista WRITE');
        $pdo->beginTransaction();
        try{

            $lista = [];
            $tot= 0;
            $stringa="";

            foreach ($productarray as $row){
                $recupero = FDisco::load($row->getIdItem());
                $productId = $recupero->getID();
                $qta=$row->getQuantity();

                $verify = self::CheckQta($productId);
                $numero = self::GETQta($productId);

                if($verify && $numero>=$qta){
                    $autore = $recupero->getAutore();
                    $artista = FArtista::loadName($autore);

                    $titolo =$recupero->getTitolo();
                    $prezzo = $recupero->getPrezzo();
                    $stringa = $stringa . "$qta x $titolo by $artista $ $prezzo;";
                    array_push($lista, $stringa);


                    $quantity = $numero - $qta;
                    $query2 = "UPDATE dischi SET Qta= :q WHERE ID= :id";
                    $stmt2 = $pdo->prepare($query2);
                    $stmt2->execute(array(
                        ":q" => $quantity,
                        ':id' => $productId
                    ));

                    $tot = $tot + ($qta * $prezzo);
                }
                else{
                    $pdo->rollBack();
                    $pdo->exec('UNLOCK TABLES');
                    return [false,$recupero->getTitolo()];
                }

                //cancellare la sessione
            }

            $cli = FCliente::loadId($cli_id);
            $ordine = new EOrdine( $cli);
            //$ordine->setCarrello($lista);
            $ordine->setCarrello($stringa);
            $ordine->setTotOrdine($tot);
            FOrdine::store($ordine);
            $pdo->commit();
            $pdo->exec('UNLOCK TABLES');
            return [true,null];

        }catch (PDOException $e) {
           // if ($pdo->isTransactionActive()){}  // this function does NOT exist
            $pdo->rollBack();
            $pdo->exec('UNLOCK TABLES');
            return [false,null];
        }
    }





    public static function AddToCart($productId, $cartid, $cli_id){
        $pdo = FConnectionDB::connect();

        $query = "SELECT quantity, product_id FROM cart_item WHERE cart_id= :idcart AND product_id= :idprod";
        $stmt = $pdo->prepare($query);
        $stmt->execute(array(
            ":idcart" => $cartid,
            ':idprod' => $productId
        ));
        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $verify = self::CheckQta($productId);
        $quantity = 0;

        if ($verify) {
            if (count($rows) > 0) {
                $quantity = $rows[0]["quantity"];

            }
            ++$quantity;

            if (count($rows) > 0) {
                $query1 = "UPDATE cart_item SET quantity= :q WHERE cart_id= :idcart AND product_id= :idprod";
                $stmt1 = $pdo->prepare($query1);
                $stmt1->execute(array(
                    ":q" => $quantity,
                    ":idcart" => $cartid,
                    ':idprod' => $productId
                ));

                $numero = self::GETQta($productId);

                $quantity = $numero - 1;
                $query2 = "UPDATE dischi SET Qta= :q WHERE ID= :id";
                $stmt2 = $pdo->prepare($query2);
                $stmt2->execute(array(
                    ":q" => $quantity,
                    ':id' => $productId
                ));

            } else {
                $G = FDisco::load($productId);
                $cart = new ECartItem(($G));
                self::store($cart, $cartid);

                $numero = self::GETQta($productId);
                $quantity = $numero - 1;
                $query2 = "UPDATE dischi SET Qta= :q WHERE ID= :id";
                $stmt2 = $pdo->prepare($query2);
                $stmt2->execute(array(
                    ":q" => $quantity,
                    ':id' => $productId
                ));

            }
            return $quantity;
        } else {
            if (count($rows) > 0) {
                $quantity = $rows[0]["quantity"];
                return $quantity;
            } else {
                $quantity = 0;
                return $quantity;
            }
        }
    }



    /**
     * metodo che permette di controllare la quantità di dischi presenti nel db per verificare se è possibile aggiungerne un numero >0 al carrello
     * @package Foundation
     */
    public static function CheckQta($id) : ?bool{
        $pdo=FConnectionDB::connect();

            //$pdo->beginTransaction();
            //controllo quantità

            $query = "SELECT Qta FROM dischi WHERE ID= :id";
            $stmt = $pdo->prepare($query);
            $stmt->execute( [":id" => $id] );
            $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
            $quantity = $rows[0]["Qta"];
            $verify=false;

            if($quantity>0){
                $verify=true;
            }
            //$pdo->commit();
            return $verify;
        }

    /**
     * metodo che preleva la quantità disponibile di un EDisco
     * @package Foundation
     */
    public static function GETQta($id) {
        $pdo=FConnectionDB::connect();

        //controllo quantità
        $query = "SELECT Qta FROM dischi WHERE ID= :id";
        $stmt = $pdo->prepare($query);
        $stmt->execute( [":id" => $id] );
        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $quantity = $rows[0]["Qta"];
        return $quantity;
    }

}