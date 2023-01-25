<?php



	class FAdmin{

        public static function exist($email) : bool {

            $pdo = FConnectionDB::connect();
            $query = "SELECT * FROM admin WHERE Email = :email";
            $stmt= $pdo->prepare($query);
            $stmt->execute([":email" => $email]);
            $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
            if (count($rows)==0){
                return false;
            }
            else {
                return true;
            }
        }

        public static function store(EAdmin $admin): void {

            $pdo = FConnectionDB::connect();
            $query = "INSERT INTO admin VALUES(:IdAmministratore,:Email,:Nome,:Cognome,:Via,:NCivico,:Provincia,:Citta,:CAP,:NTelefono,:Password,:Livello)";
            $stmt = $pdo->prepare($query);
            $stmt->execute(array(
                ':IdAmministratore' => $admin->getIdAmministratore(),
                ':Email' => $admin->getEmail(),
                ':Nome'  =>$admin->getNome(),
                ':Cognome' =>$admin->getCognome(),
                ':Via' =>$admin->getVia(),
                ':NCivico' =>$admin->getNumeroCivico(),
                ':Provincia' =>$admin->getProvincia(),
                ':Citta' =>$admin->getCitta(),
                ':CAP' =>$admin->getCAP(),
                ':NTelefono' =>$admin->getTelefono(),
                ':Password' =>$admin->criptaPassword($admin->getPassword()),
                ':Livello' =>$admin->getLivello()
            ));
        }

        public static function load(string $email) {
            $pdo=FConnectionDB::connect();

            try {
                $ifExist = self::exist($email);
                if($ifExist) {
                    $query = "SELECT * FROM admin WHERE Email= :email";
                    $stmt = $pdo->prepare($query);
                    $stmt->execute( [":email" => $email] );
                    $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

                    $IdAmministratore = $rows[0]['IdAmministratore'];
                    $Email = $rows[0]['Email'];
                    $Nome = $rows[0]['Nome'];
                    $Cognome = $rows[0]['Cognome'];
                    $Via = $rows[0]['Via'];
                    $NumeroCivico = $rows[0]['NCivico'];
                    $Provincia = $rows[0]['Provincia'];
                    $Citta = $rows[0]['Citta'];
                    $CAP = $rows[0]['CAP'];
                    $Telefono = $rows[0]['NTelefono'];
                    $Password = $rows[0]['Password'];
                    // $Livello = $rows[0]['Livello'];

                    $utente = new EAdmin($IdAmministratore,$Email,$Nome,$Cognome,$Via,$NumeroCivico,$Provincia,$Citta,$CAP,$Telefono,$Password);
                    return $utente;
                }
                else {return "Non ci sono amministratori";}
            }
            catch (PDOException $exception) { print ("Errore".$exception->getMessage());}
        }

        public static function delete(string $email) {
            $pdo=FConnectionDB::connect();

            try {
                $ifExist = self::exist($email);
                if($ifExist) {
                    $query = "DELETE FROM admin WHERE Email= :email";
                    $stmt = $pdo->prepare($query);
                    $stmt->execute([":email" => $email]);
                    return true;
                }
                else{ return false;}
            }
            catch(PDOException $exception) {print("Errore".$exception->getMessage());}

        }


        public static function loadgeneri() : array {
            $pdo=FConnectionDB::connect();

            try {
                    $query = "SELECT * FROM categories";
                    $stmt = $pdo->prepare($query);
                    $stmt->execute();
                    $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
                    $gen = array();
                    foreach ($rows as $row){
                        $genere = $row['name'];
                        array_push($gen,$genere);
                    }
                    return $gen;

            }
            catch (PDOException $exception) {
                print ("Errore".$exception->getMessage());
                $pdo->rollBack();
                return array();}
        }

    /**
    * Metodo che verifica l'accesso di un utente , controllando che le credenziali (email e password) siano presenti nel db
     * @param $email
     * @param $pass
     */
    public function VerificaAccesso(string $email, string $password)
    {
        $pdo=FConnectionDB::connect();
        $pdo->beginTransaction();
        try {
            $email = addslashes($email);
            $query = "SELECT * FROM admin WHERE Email = :email";
            $stmt = $pdo->prepare($query);
            $stmt->execute( [":email" => $email] );
            $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
            $pdo->commit();

            // verificaPassword controlla se la password inserita corrisponde alla password hash recuperata da db
            if ($rows && EAdmin::verificaPassword($password, $rows['Password'])) return true;
            return false;
        }
        catch (PDOException $e) {
            echo "\nAttenzione errore: " . $e->getMessage();
            $pdo->rollBack();
            return null;
        }
    }
    }


?>