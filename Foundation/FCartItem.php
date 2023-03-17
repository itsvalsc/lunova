<?php

class FCartItem
{

    public static function exist($id): bool
    {

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

    public static function store(ECartItem $citem, $cartid): void
    {
        $pdo = FConnectionDB::connect();
        $query = "INSERT INTO cart_item VALUES(:id,:cart_id,:product_id,:quantity)";
        $stmt = $pdo->prepare($query);
        $stmt->execute(array(
            ':id' => $citem->getIdCartItem(),
            ':cart_id' => $cartid,
            ':product_id' => $citem->getIdItem(),
            ':quantity' => $citem->getQuantity()
        ));
        //FImmagine::store($disco->getCopertina());
    }

    public static function delete(string $ID_carti, string $cart_id) {
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
        catch(PDOException $exception) {print("Errore".$exception->getMessage());}

    }

    public static function load(string $id_cli){
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
            $Disc = new ECartItem(FDisco::load($product_id));
            $Disc->setQuantity($quantity);
            $Disc->setIdCartItem($idd);
            $Disc->setIdCart($id);


            array_push($dischi, $Disc);

        }
        return $dischi;

    }

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

            $Disc = FDisco::load($product_id);



            array_push($dischi, $Disc);

        }
        return $dischi;

    }


    public static function AddToCart($productId, $cartid, $cli_id){
        $pdo=FConnectionDB::connect();

        $quantity = 0;

        $query = "SELECT quantity, product_id FROM cart_item WHERE cart_id= :idcart AND product_id= :idprod";
        $stmt = $pdo->prepare($query);
        $stmt->execute(array(
            ":idcart" => $cartid,
            ':idprod' => $productId
        ));
        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
        //var_dump($rows);
        $id_magazzino = $rows[0]["product_id"];
        $verify = CheckQta($id_magazzino);
        $quantity = 0;

        if ($verify){
            if (count($rows) > 0 ){
                $quantity = $rows[0]["quantity"];

            }
            ++ $quantity ;

            if (count($rows) > 0 ) {
                $query1 = "UPDATE cart_item SET quantity= :q WHERE cart_id= :idcart AND product_id= :idprod";
                $stmt1 = $pdo->prepare($query1);
                $stmt1->execute(array(
                    ":q" => $quantity,
                    ":idcart" => $cartid,
                    ':idprod' => $productId
                ));
            }
            else{
                $G= FDisco::load($productId);
                $cart = new ECartItem(($G));
                self::store($cart,$cartid);


            }
            return $quantity;
        }
        else {
            if (count($rows) > 0 ){
                $quantity = $rows[0]["quantity"];
                return $quantity;
            }
            else {
                $quantity = 0;
                return $quantity;
            }
        }



    }


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
            //print_r($quantity);

            $query1 = "UPDATE cart_item SET quantity= :q WHERE cart_id= :idcart AND product_id= :idprod";
            $stmt1 = $pdo->prepare($query1);
            $stmt1->execute(array(
                ":q" => $quantity,
                ":idcart" => $cartid,
                ':idprod' => $productId
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



    function CheckQta($id) : bool{
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














}