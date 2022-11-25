<?php
class FCarta
{
    public static function exist($numero): bool
    {

        $pdo = FConnectionDB::connect();

        $query = "SELECT * FROM carte WHERE NCarta = :numero";
        $stmt = $pdo->prepare($query);
        $stmt->execute([":numero" => $numero]);
        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
        if (count($rows) == 0) {
            return false;
        } else {
            return true;
        }
    }

    public
    static function store(ECarta $carta, string $id): void
    {
        $pdo = FConnectionDB::connect();
        $query = "INSERT INTO carta VALUES(:NCarta, :Intestatario, :Scadenza, :CVC, :IdCLiente)";
        $stmt = $pdo->prepare($query);
        $stmt->execute(array(
            ':NCarta' => $carta->getNumero(),
            ':Intestatario' => $carta->getIntestatario(),
            ':Scadenza' => $carta->getScadenza(),
            ':CVC' => $carta->getCVC(),
            ':IdCliente' => $id
        ));
    }


    public static function load(string $idcar): ECarta
    {
        $pdo = FConnectionDB::connect();

        $query = "SELECT * FROM carta WHERE NCarta= :idcar";
        $stmt = $pdo->prepare($query);
        $stmt->execute([":idcar" => $idcar]);
        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $NCarta = $rows[0]['NCarta'];
        $Intestatario = $rows[0]['Intestatario'];
        $Scadenza = $rows[0]['Scadenza'];
        $CVC = $rows[0]['CVC'];
        $IdCliente = $rows[0]['IdCliente'];

        $carta = new ECarta($Intestatario, $NCarta, $CVC, $Scadenza);

        return $carta;
    }


    public static function delete(string $idcar)
    {
        $pdo = FConnectionDB::connect();

        try {
            $ifExist = self::exist($idcar);
            if ($ifExist) {
                $query = "DELETE FROM carta WHERE NCarta= :idcar";
                $stmt = $pdo->prepare($query);
                $stmt->execute([":idcar" => $idcar]);
                return true;
            } else {
                return false;
            }
        } catch (PDOException $exception) {
            print("Errore" . $exception->getMessage());
        }

    }









}