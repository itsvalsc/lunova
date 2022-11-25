<?php
class FCarrello{


    public static function exist($id) : bool {

        $pdo = FConnectionDB::connect();

        $query = "SELECT * FROM carrello WHERE id = :id";
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

    public static function loadlista(string $id_or): array {
        $pdo=FConnectionDB::connect();

        $query = "SELECT * FROM carrello WHERE id_ordine= :idor";
        $stmt = $pdo->prepare($query);
        $stmt->execute( [":idor" => $id_or] );
        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);


        $lista = $rows[0]['lista'];

        $line = explode(";", $lista);

        for ($i=0; $i < count($line) -2; ++$i) {

            if ($i>0)++$i;
            $a= $i;
            $b = 1 +$i;
            $elenco[$i] =array ('prodotto' => "$line[$a]",
                'quantità' => "$line[$b]");

        }

        return $elenco;
    }

    public static function load(string $id_or): ECarrello {
        $pdo=FConnectionDB::connect();

        $query = "SELECT * FROM carrello WHERE id_ordine= :idor";
        $stmt = $pdo->prepare($query);
        $stmt->execute( [":idor" => $id_or] );
        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $id = $rows[0]['id'];
        $id_cliente = $rows[0]['id_cliente'];
        $lista = $rows[0]['lista'];

        $line = explode(";", $lista);

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

    public static function store(ECarrello $car): void {
        $pdo = FConnectionDB::connect();
        $query = "INSERT INTO carrello VALUES(:id,:id_cliente,:id_ordine,:lista)";
        $stmt = $pdo->prepare($query);
        $stmt->execute(array(
            ':id' => $car->getId(),
            ':id_cliente' => $car->getIdUtente(),
            ':id_ordine'  =>$car->getIdOrdine(),
            ':lista' =>$car->getToStringDischi()
        ));
    }

    public static function delete(string $idcar) {
        $pdo=FConnectionDB::connect();

        try {
            $ifExist = self::exist($idcar);
            if($ifExist) {
                $query = "DELETE FROM carrello WHERE id= :idcar";
                $stmt = $pdo->prepare($query);
                $stmt->execute([":idcar" => $idcar]);
                return true;
            }
            else{ return false;}
        }
        catch(PDOException $exception) {print("Errore".$exception->getMessage());}

    }


    public static function calcoloTot(string $id_or): float {
        $pdo=FConnectionDB::connect();

        $query = "SELECT * FROM carrello WHERE id_ordine= :idor";
        $stmt = $pdo->prepare($query);
        $stmt->execute( [":idor" => $id_or] );
        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);


        $queryy = "SELECT price FROM dischi WHERE ID= :idp";


        $lista = $rows[0]['lista'];

        $line = explode(";", $lista);
        $tot_sing= 0;

        for ($i=0; $i < count($line) -2; ++$i) {

            if ($i>0)++$i;

            $a= $i;
            $b = 1 +$i;
            $elenco[$i] =array ('prodotto' => "$line[$a]",
                'quantità' => "$line[$b]");


            $stmt2 = $pdo->prepare($queryy);
            $stmt2->execute( [":idp" => $line[$a]] );
            $rowss = $stmt2->fetchAll(PDO::FETCH_ASSOC);

            $tot_sing = $tot_sing + ( $line[$b] * ($rowss[0]['price']) );



        }
        print($tot_sing);
        return $tot_sing;
    }







}