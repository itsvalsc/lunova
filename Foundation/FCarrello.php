<?php
class FCarrello{


    public static function exist($id) : bool {

        $pdo = FConnectionDB::connect();

        $query = "SELECT * FROM cart WHERE client_id = :id";
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


    public static function getCurrentCartId($id_cli){
        $pdo=FConnectionDB::connect();

        $carrello = null;

        $query = "SELECT * FROM cart WHERE client_id= :idcli";
        $stmt = $pdo->prepare($query);
        $stmt->execute( [":idcli" => $id_cli] );
        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

        if (count($rows) > 0 ){
            $cartid = $rows[0]["id"];
            $carrello = new ECarrello($id_cli);
            $carrello->setId($cartid);
        }
        return $carrello;

    }


    public static function store(ECarrello $car): void {
        $pdo = FConnectionDB::connect();
        $query = "INSERT INTO cart VALUES(:id,:id_cliente)";
        $stmt = $pdo->prepare($query);
        $stmt->execute(array(
            ':id' => $car->getId(),
            ':id_cliente' => $car->getIdUtente()
        ));
    }

    public static function load(string $id_cli): ECarrello {
        $pdo=FConnectionDB::connect();

        $query = "SELECT * FROM cart WHERE client_id= :idcli";
        $stmt = $pdo->prepare($query);
        $stmt->execute( [":idcli" => $id_cli] );
        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $id = $rows[0]['id'];
        //$id_cliente = $rows[0]['client_id'];
        //$line = explode(";", $lista);
        $query = "SELECT * FROM cart_item WHERE cart_id= :idcart";
        $stmt = $pdo->prepare($query);
        $stmt->execute( [":idcart" => $id] );
        $prods = $stmt->fetchAll(PDO::FETCH_ASSOC);

        foreach ($prods as $row) {
            $id = $row['ID'];
            $immagine = FImmagine::load($id);
            $disc=new EDisco($row['name'],
                $row['artist_id'],
                $row['price'],
                $row['description'],
                $row['category_id'],
                $immagine,
                $row['Qta']
            );
            $disc->setID($id);
            $dischi[$i]=$disc;
            ++$i;
        }
        $line = '';
        $id_cliente='';
        $id_or=''; //levare
        for ($i=0; $i < count($line) -2; ++$i) {

            if ($i>0)++$i;
            $a= $i;
            $b = 1 +$i;
            $elenco[$i] =array ('prodotto' => "$line[$a]",
                'quantità' => "$line[$b]");

        }
        $tot = FCarrello::calcoloTot($id);
        $ris = new ECarrello($id,$id_cliente, $id_or, $elenco, $tot);
        $ris->setDischi($elenco);
        return $ris;
    }
}