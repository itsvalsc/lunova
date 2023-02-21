<?php
//require_once "C:\\xampp\\htdocs\\lunova\\Foundation\\FDisco.php";
//require_once "C:\\xampp\\htdocs\\lunova\\Foundation\\FConnectionDB.php";
//require_once "C:\\xampp\\htdocs\\lunova\\inc\\configdb.php";

require_once "./Foundation/FCliente.php";
require_once "./Entity/ECliente.php";
require_once "./Entity/EUtente.php";
require_once "./Entity/ECarta.php";
require_once "./Entity/EWallet.php";
require_once "./Foundation/FConnectionDB.php";
require_once "./inc/configdb.php";
require_once "./Foundation/FDisco.php";
require_once "./Entity/EDisco.php";
require_once "./Entity/EOrdine.php";
require_once "./Foundation/FOrdine.php";
require_once "./Entity/ESondaggio.php";
require_once "./Entity/ERichiesta.php";
require_once "./Foundation/FSondaggio.php";
require_once "./Foundation/FRichiesta.php";
require_once "./Entity/EVotazione.php";
require_once "./Foundation/FVotazione.php";
require_once "./Foundation/FAdmin.php";
require_once "./Foundation/FPersistentManager.php";
require_once "./Foundation/FArtista.php";
require_once "./Entity/EArtista.php";
require_once "./inc/init.php";
require_once "./Foundation/FImmagine.php";
require_once "./Entity/EImmagine.php";
require_once "./Foundation/FConnectionDB.php";
require_once './Entity/ENotifiche.php';
require_once './Entity/ECommento.php';
require_once "./Foundation/FPersistentManager.php";
require_once './Foundation/FNotifiche.php';
//require_once ("inc/crosswords.txt");
//require_once "./Smarty/smarty-dir/templates/img/utente_default.jpg";
//require_once "./Smarty/smarty-dir/templates/img/icona_profilo_utente.jpg";
require_once "./Foundation/FCarrello.php";
require_once './Entity/ECarrello.php';
require_once "./Foundation/FCartItem.php";
require_once './Entity/ECartItem.php';



/*
$utt1 = new ECliente("serafino","cicerone","cia","via vale","3","L'Aquila","AQ","67100","1029384756","ser@fino.com",'passwd3!');

$utt2 = new ECliente("Noemi","Barbaro","noemi","via noemi","2","L'Aquila","AQ","67100","0987654321","noemi@barbaro.com",'passwd2!');
$utt3 = new ECliente("luigi","Bartolomeo","luigi","via marruvio","1","avezzano","AQ","67051","1234567890","l@l.com",'passwd1!');
*/
//var_dump($utt1);
//$a=FCliente::store($utt1);

//$a=FCliente::store($utt2);
//$a=FCliente::store($utt3);



//TODO: aggiungete sul database alla tabella artista alla fine l'attributo Username
//$art1 = new EArtista("Rocco","Pagliarulo","Via Palermo","148","Salerno","SA","65123","3314756294","roccohunt@gmail.com","rocchino1","Rocco Hunt");
//$art2 = new EArtista("Laura","Pausini","via roma","30","Faenza","23600","cappe","3451122637","laurapausini@gmail.com","laurina1","Laura Pausini");
//$art3 = new EArtista("Alessandro","Aleotti","via salernitana","63","Milano","MI","20100","3478172664","jaxsupport@gmail.com","jaxino1","J-AX");
//var_dump($art1);
//FArtista::store($art1);
//FArtista::store($art2);
//FArtista::store($art3);
//$a=FCliente::load('l@l.com');*/

//$a=FCliente::prelevaCliente('pluto@gmail.com');

//TODO: run main per caricare le immagini, una volta per ogni disco che si ha sul proprio db
/*
$c = new EImmagine("utente_default.jpg","image/jpg",file_get_contents("Smarty/smarty-dir/templates/img/icona_profilo_utente.jpg"),"D578");
$d = FImmagine::store($c);
$a = new EDisco('5','2022',12,'1) Easy 2) BEER 3) girl','1',$c,1500);
$b = FDisco::store($a);
*/
//$b = FDisco::prelevaDischiperGenere('0');

//print_r($b);

//$s = new EOrdine('34567');
//$s->Compile('34567','roma','00100','pizza', 'carta', '33');
//$s->setIdCliente('67890')
//$f = FOrdine::store($s);

//$b=new ERichiesta('dc4',"2022-10-10");

//$a = FPersistentManager::getInstance();
//$b = $a->prelevaOrdini('ut1');
//print_r($b);

/*
$pers = FPersistentManager::getInstance();

$elenco = $pers->prelevaDischi();
foreach ($elenco as $p ){$o = $p->getTitolo();
print_r($o);}
var_dump($elenco);


$a = new EDisco('Cinq','2022',12,'1) Easy 2) BEER 3) girl','1',null,1500);
FDisco::store($a);
*/

/*
$s = FCliente::load('valentina@scimia.com');
//$b = $s[0]->getEmail();
var_dump($s);

$a = FPersistentManager::getInstance();
$b = $a->prelevaArtisti();
print_r($b);
*/

/*
function Sicurezza(string $t, string $idap)
    {   $f = "inc/crosswords.txt";
        $pers = FPersistentManager::getInstance();
        //var_dump($f);
        $apertura = file($f);
        for ($i=0; $i < count($apertura) ; $i++) {
            $words = explode(";", $apertura[$i]);
        }

        $text = explode(" ", $t);
        $t1 = str_replace($words, "***",$t);
        if ( $t!=$t1){
            $n = new ENotifiche("Questo commento è inopportuno, generato dall'utente $idap", "alta"," $idap");
            $pers->store($n);
        }
        return $t1;
    }

print_r("\n-----------\n");
$A = Sicurezza("ciao", "C231");
print_r ($A);
*/
/*
function exist($id): bool
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

function loadD(string $id_cli){
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
function MinusToCart($productId, $cartid, $cli_id){
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
        print_r($quantity);

        $query1 = "UPDATE cart_item SET quantity= :q WHERE cart_id= :idcart AND product_id= :idprod";
        $stmt1 = $pdo->prepare($query1);
        $stmt1->execute(array(
            ":q" => $quantity,
            ":idcart" => $cartid,
            ':idprod' => $productId
        ));
    }

    else{
        delete($cartitem,$cartid);
        //FCartItem::delete($cartitem,$cartid);


        //$G= FDisco::load($productId);
        //$cart = new ECartItem(($G));
        //FCartItem::store($cart,$cartid);

    }
    return $quantity;

}
function delete(string $ID_carti, string $cart_id) {
    $pdo=FConnectionDB::connect();

    try {
        //$ifExist = self::exist($ID_carti);
        //if($ifExist) {
        if(true) {
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

$A= getCurrentCartId('C151');
$B = load('C151');
//var_dump($B[0]->getIdCartItem());
//print_r($B);
//MinusToCart('12345','F94','C151');
AddToCart('12345','F94','C151');
//print_r($B);
//delete('5584','F94'); */

