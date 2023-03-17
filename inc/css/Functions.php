<?php
function getCurrentCartId($id_cli){
    $pdo=FConnectionDB::connect();

    $cartid = "";

    $query = "SELECT * FROM cart WHERE client_id= :idcli";
    $stmt = $pdo->prepare($query);
    $stmt->execute( [":idcli" => $id_cli] );
    $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
    var_dump($rows);
    if (count($rows) > 0 ){
        $cartid = $rows[0]["id"];
    }
    else {
        $C= new ECarrello($id_cli);
        FCarrello::store($C);
        $cartid = $C->getId();
    }
    return $cartid;

}




function AddToCart($productId, $cartid, $cli_id){
    $pdo=FConnectionDB::connect();

    $quantity = 0;

    $query = "SELECT quantity FROM cart_item WHERE cart_id= :idcart AND product_id= :idprod";
    $stmt = $pdo->prepare($query);
    $stmt->execute(array(
        ":idcart" => $cartid,
        ':idprod' => $productId
    ));
    $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
    //var_dump($rows);

    if (count($rows) > 0 ){
        $quantity = $rows[0]["quantity"];
        print_r($quantity);
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
        FCartItem::store($cart,$cartid);

    }
    return $quantity;

}

function MinusToCart($productId, $cartid, $cli_id){
    $pdo=FConnectionDB::connect();

    $quantity = 0;

    $query = "SELECT quantity FROM cart_item WHERE cart_id= :idcart AND product_id= :idprod";
    $stmt = $pdo->prepare($query);
    $stmt->execute(array(
        ":idcart" => $cartid,
        ':idprod' => $productId
    ));
    $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
    //var_dump($rows);

    if (count($rows) > 0 ){
        $quantity = $rows[0]["quantity"];
        print_r($quantity);
    }
    -- $quantity ;

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
        FCartItem::delete($cartid);
        //$G= FDisco::load($productId);
        //$cart = new ECartItem(($G));
        //FCartItem::store($cart,$cartid);

    }
    return $quantity;

}


//$A= getCurrentCartId("67890");

//$B= MinusToCart("12345","F94","67890");
//$B= AddToCart("98745","F94","67890");

//$A= getCurrentCartId("C8539");98745
//print_r ($B);
//print_r ("C8539");



function load(string $id_cli){
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

$B= CheckQta("12345");
var_dump($B);


/*
function AddToCart($productId, $cartid, $cli_id){
    $pdo=FConnectionDB::connect();

    $quantity = 0;

    $pass = CheckQta($productId);
    if ($pass[0] == true){

        $query = "SELECT quantity FROM cart_item WHERE cart_id= :idcart AND product_id= :idprod";
        $stmt = $pdo->prepare($query);
        $stmt->execute(array(
            ":idcart" => $cartid,
            ':idprod' => $productId
        ));
        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
        var_dump($rows);
        if (count($rows) > 0 ){
            $quantity = $rows[0]["quantity"];
            print_r($quantity);
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
            FCartItem::store($cart,$cartid);

        }
        return $quantity;

    }
    else {return "non è stato possibile eseguire l'opreazione";}

}
*/

// PER LA TABELLA CART NEL DB
/*
CREATE TABLE `cart` (
	`id` VARCHAR(30) NOT NULL COLLATE 'utf8mb4_general_ci',
	`client_id` VARCHAR(30) NOT NULL COLLATE 'utf8mb4_general_ci',
	PRIMARY KEY (`id`) USING BTREE,
	INDEX `FK_cart_cliente` (`client_id`) USING BTREE,
	CONSTRAINT `FK_cart_cliente` FOREIGN KEY (`client_id`) REFERENCES `cliente` (`IdCliente`) ON UPDATE NO ACTION ON DELETE NO ACTION
)
COLLATE='utf8mb4_general_ci'
ENGINE=InnoDB
;

*/

// PER LA TABELLA CART ITEM
/*
CREATE TABLE `cart_item` (
	`id` VARCHAR(30) NOT NULL COLLATE 'utf8mb4_general_ci',
	`cart_id` VARCHAR(30) NOT NULL COLLATE 'utf8mb4_general_ci',
	`product_id` VARCHAR(30) NOT NULL COLLATE 'utf8mb4_general_ci',
	`quantity` VARCHAR(30) NOT NULL COLLATE 'utf8mb4_general_ci',
	PRIMARY KEY (`id`) USING BTREE,
	INDEX `FK_cart_item_cart` (`cart_id`) USING BTREE,
	INDEX `FK_cart_item_dischi` (`product_id`) USING BTREE,
	CONSTRAINT `FK_cart_item_cart` FOREIGN KEY (`cart_id`) REFERENCES `cart` (`id`) ON UPDATE NO ACTION ON DELETE NO ACTION,
	CONSTRAINT `FK_cart_item_dischi` FOREIGN KEY (`product_id`) REFERENCES `dischi` (`ID`) ON UPDATE NO ACTION ON DELETE NO ACTION
)
COLLATE='utf8mb4_general_ci'
ENGINE=InnoDB
;
*/

