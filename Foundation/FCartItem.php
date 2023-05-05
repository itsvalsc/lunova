<?php

/**
* La classe FCartItem fornisce query per gli oggetti ECartItem
* @package Foundation
 */

class FCartItem{

    /**
     * metodo che verifica l'esistenza di un cartItem nel db
     * @package Foundation
     */
    public static function exist($id): bool{

        $pdo = FConnectionDB::connect();

        $query = "SELECT * FROM cart_item WHERE id = :id";
        $stmt = $pdo->prepare($query);
        $stmt->execute([":id" => $id]);
        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
        if (count($rows) == 0) {
            return false;
        } else {
            return true;
        }
    }

    /**
     * metodo che memorizza l'istanza di un oggetto ECartItem nel db
     * @package Foundation
     */
    public static function store(ECartItem $citem, $cartid): void{

        $pdo = FConnectionDB::connect();
        $query = "INSERT INTO cart_item VALUES(:id,:cart_id,:product_id,:quantity,:data)";
        $stmt = $pdo->prepare($query);
        $stmt->execute(array(
            ':id' => $citem->getIdCartItem(),
            ':cart_id' => $cartid,
            ':product_id' => $citem->getIdItem(),
            ':quantity' => $citem->getQuantity(),
            ':data' => $citem->getData()
        ));
    }

    /**
     * metodo che permette di eliminare l'stanza di ECartItem dal db
     * @package Foundation
     */
    public static function delete(string $ID_carti, string $cart_id){
        $pdo=FConnectionDB::connect();

        try {
            $ifExist = self::exist($ID_carti);
            if($ifExist) {
                $query = "DELETE FROM cart_item WHERE id= :id and cart_id = :cart_id";
                $stmt = $pdo->prepare($query);
                $stmt->execute(array(
                    ':id' => $ID_carti,
                    ':cart_id' => $cart_id
                ));
                return true;
            }
            else{ return print('File non trovato');}
        }
        catch(PDOException $exception) {return ("Errore".$exception->getMessage());}
    }
    public static function delete_cart(string $cart_id) {
        $pdo=FConnectionDB::connect();

        try {
            $query = "DELETE FROM cart_item WHERE cart_id = :cart_id";
            $stmt = $pdo->prepare($query);
            $stmt->execute([':cart_id' => $cart_id]);
            return true;
        }
        catch(PDOException $exception) {return ("Errore".$exception->getMessage());}
    }

    public static function delete_disco(string $product_id) {
        $pdo=FConnectionDB::connect();

        try {
            $query = "DELETE FROM cart_item WHERE product_id = :id";
            $stmt = $pdo->prepare($query);
            $stmt->execute([':id' => $product_id]);
            return true;
        }
        catch(PDOException $exception) {return ("Errore".$exception->getMessage());}
    }

    public static function load(string $id_cli){
        $pdo=FConnectionDB::connect();
        $dischi = array();

        //prendiamo id carrello

        $query = "SELECT * FROM cart WHERE client_id= :idcli";
        $stmt = $pdo->prepare($query);
        $stmt->execute( [":idcli" => $id_cli] );
        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

        if (count($rows)==0 ){
            $elenco = [];
            return $elenco;
        }
        else {
            $id = $rows[0]['id'];

            //prendiamo i prodotti che hanno lo stesso id carrello

            $query = "SELECT * FROM cart_item WHERE cart_id= :idcart";
            $stmt = $pdo->prepare($query);
            $stmt->execute([":idcart" => $id]);
            $prods = $stmt->fetchAll(PDO::FETCH_ASSOC);

            foreach ($prods as $row) {
                $idd = $row['id'];
                $quantity = $row['quantity'];
                $product_id = $row['product_id'];
                $data = $row['data'];
                //$immagine = FImmagine::load($id);
                $disco = FDisco::load($product_id);
                if ($disco != null) {
                    $Disc = new ECartItem($disco);
                    $Disc->setQuantity($quantity);
                    $Disc->setIdCartItem($idd);
                    $Disc->setIdCart($id);
                    $Disc->setData($data);
                    array_push($dischi, $Disc);
                }
            }
            return $dischi;
        }
    }

    /**
     * metodo che permette di caricare i dischi dello stesso CartItem
     * @package Foundation
     */
    public static function loadD(string $id_cli){
        $pdo=FConnectionDB::connect();
        $dischi = array();

        //prendiamo id carrello

        $query = "SELECT * FROM cart WHERE client_id= :idcli";
        $stmt = $pdo->prepare($query);
        $stmt->execute( [":idcli" => $id_cli] );
        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $id = $rows[0]['id'];

        //prendiamo i prodotti che hanno lo stesso id carrello

        $query = "SELECT * FROM cart_item WHERE cart_id= :idcart";
        $stmt = $pdo->prepare($query);
        $stmt->execute( [":idcart" => $id] );
        $prods = $stmt->fetchAll(PDO::FETCH_ASSOC);

        foreach ($prods as $row) {
            $idd = $row['id'];
            $quantity = $row['quantity'];
            $product_id = $row['product_id'];
            //$immagine = FImmagine::load($id);

            if (FDisco::exist($product_id)){
                $Disc = FDisco::load($product_id);
                array_push($dischi, $Disc);
            }
        }
        return $dischi;
    }

    /**
     * metodo che permette di aggiungere di una unità alla volta un oggetto di tipo EDisco al CartItem
     * @package Foundation
     */
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
     * metodo che permette di rimuovere di una unità alla volta un oggetto di tipo Edisco dal CartItem
     * @package Foundation
     */
    public static function MinusToCart($productId, $cartid, $cli_id){
        $pdo=FConnectionDB::connect();

        $quantity = 0;

        $query = "SELECT quantity,id FROM cart_item WHERE cart_id= :idcart AND product_id= :idprod";
        $stmt = $pdo->prepare($query);
        $stmt->execute(array(
            ":idcart" => $cartid,
            ':idprod' => $productId
        ));
        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
        //var_dump($rows);
        $cartitem = $rows[0]["id"];
        $quantity = $rows[0]["quantity"];

        if ($quantity > 1 ){
            -- $quantity ;

            $query1 = "UPDATE cart_item SET quantity= :q WHERE cart_id= :idcart AND product_id= :idprod";
            $stmt1 = $pdo->prepare($query1);
            $stmt1->execute(array(
                ":q" => $quantity,
                ":idcart" => $cartid,
                ':idprod' => $productId
            ));

            $numero = self::GETQta($productId);
            $quantity = $numero + 1;
            $query2 = "UPDATE dischi SET Qta= :q WHERE ID= :id";
            $stmt2 = $pdo->prepare($query2);
            $stmt2->execute(array(
                ":q" => $quantity,
                ':id' => $productId
            ));
        }

        else{
            self::delete($cartitem,$cartid);
            //FCartItem::delete($cartitem,$cartid);
            //$G= FDisco::load($productId);
            //$cart = new ECartItem(($G));
            //FCartItem::store($cart,$cartid);
        }
        return $quantity;
    }


    /**
     * metodo che permette di controllare la quantità di dischi presenti nel db per verificare se è possibile aggiungerne un numero >0 al carrello
     * @package Foundation
     */
    public static function CheckQta($id) : bool{
        $pdo=FConnectionDB::connect();

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