<?php

require_once "Utility/autoload.php";
require_once "Foundation/FSessione.php";

class CProfile
{

    /**
     * @var CProfile|null Variabile di classe che mantiene l'istanza della classe.
     */
    private static ?CProfile $instance = null;

    /**
     * Costruttore della classe.
     */
    private function __construct(){}

    /**
     * Restituisce l'istanza della classe.
     */
    public static function getInstance(): ?CProfile {
        if (!isset(self::$instance)){
            self::$instance = new CProfile();
        }
        return self::$instance;
    }

    /**
     * Funzione utilizzata per mostrare l'area personale di un Utente(Cliente o Artista)
     * @return void
     */
    public static function mostraProfilo(){
        $sessione = new FSessione();
        $pm = FPersistentManager::getInstance();

        if ($sessione->isLogged() && $sessione->isCliente()){

                $cliente = $pm->load("FCliente", $sessione->getUtente()->getEmail());
                $view = new VProfile();
                $view->mostraProfiloCliente($cliente,);
        } elseif ($sessione->isLogged() && $sessione->isArtista()) {
                $artista = $pm->load("FArtista", $sessione->getUtente()->getEmail());
                $view = new VProfile();
                $view->mostraProfiloArtista($artista);
            }
        else{
            header("Location: /lunova/RicercaDisco/index");
        }
    }

    /**
     * Funzione che gestisce la modifica dello Username per cliente o artista.
     * Preleva lo username nuovo dalla view e procede alla modifica.
     * @return void
     * @throws SmartyException
     */
    public function modificaUsername()
    {
        $view = new VProfile();
        $sessione = new FSessione();
        $pm = FPersistentManager::getInstance();

        if ($sessione->isLogged()) {
            $username = $sessione->leggi_valore('utente');
            $tipo = $sessione->leggi_valore('tipo_utente');
            $tipo[0] = "F";
            $class = $tipo;

            $user = $pm->load($class, $username);

            $newusername = $view->getNewUsername();
            if ($username == $newusername) {
                $message = "L'username è uguale a quello precedente";
                $tipo = "user";
                self::erroreModifica($tipo, $message, $user);
            } elseif ($newusername == null) {
                $message = "Si prega di inserire il nuovo username prima di cliccare sul tasto modifica";
                $tipo = "user";
                self::erroreModifica($tipo, $message, $user);
            } elseif ($pm->exist("FCliente", "Username", $newusername) || $pm->exist("FArtista", "Username", $newusername)) {
                $message = "L'username inserito esiste già, inserirne un altro";
                $tipo = "user";
                self::erroreModifica($tipo, $message, $user);
            } else {
                $pm->update_value($class, "Username", $newusername, "Username", $username);
                $user->setUsername($newusername);
                $sessione->imposta_valore("utente", $newusername);
                $sessione->imposta_valore("tipo_utente", get_class($user));
                header("Location: /lunova/Profile/mostraProfilo");
            }
        } else {
            header("Location: /lunova/Ricerca/mostraHome");
        }
    }

    /**
     * Funzione che gestisce la modifica dell'email del Cliente o dell'Artista.
     * Preleva la nuova email dalla View e procede alla modifica.
     * @return void
     */
    public function modificaEmail()
    {
        $view = new VProfile();
        $sessione = new FSessione();
        $pm = FPersistentManager::getInstance();

        if ($sessione->isLogged()) {
            $username = $sessione->leggi_valore('utente');
            $tipo = $sessione->leggi_valore('tipo_utente');
            $tipo[0] = "F";
            $class = $tipo;

            $newemail = $view->getNewEmail();
            $user = $pm->load($class, $username);

            if ($newemail != null) {
                if ($newemail != $user->getEmail()) {
                    $user->setEmail($newemail);
                    $pm->update_value($class, "Email", $newemail, "Username", $username);
                    header('Location: /lunova/Profile/mostraProfilo');
                } else {
                    $message = "La email inserita è uguale a quella precedente, si prega di scriverne un'altra";
                    $tipo = "email";
                    self::erroreModifica($tipo, $message, $user);
                }
            } else {
                $message = "Entrambi i campi devono essere pieni";
                $tipo = "email";
                self::erroreModifica($tipo, $message, $user);
            }
        } else {
            header("Location: /lunova/Ricerca/mostraHome");
        }
    }

    /**
     * Funzione che gestisce la modifica della password del Cliente o dell'Artista.
     * Preleva la vecchia e la nuova password dalla View, verifica la correttezza della vecchia e procede alla modifica.
     * @return false|void False se la vecchia password inserita non è corretta, altrimenti lancia un errore che rimanda alla View del errore.
     * @throws SmartyException
     */
    public function modificaPassword(){
        $view = new VProfile();
        $sessione = new FSessione();
        $pm = FPersistentManager::getInstance();

        if($sessione->isLogged()){
            $username = $sessione->leggi_valore('utente');
            $tipo = $sessione->leggi_valore('tipo_utente');
            $tipo[0] = "F";
            $class = $tipo;

            $password = $view->getPwd();
            $newpassword = $view->getNewPassword();

            $user = $pm->load($class, $username);

            if($password != null && $newpassword != null){
                if(md5($password) == $user->getPassword()){
                    if($newpassword != $password){
                        $user->setPassword($newpassword);
                        $pm->update_value($class,"Password", md5($newpassword),"Username",$username);
                        header('Location: /lunova/Profile/mostraProfilo');
                    }else{
                        $message = "La password inserita è uguale a quella precedente, si prega di scriverne un'altra";
                        $tipo="password";
                        self::erroreModifica($tipo,$message,$user);
                    }
                }else{
                    $message = "La password precedentemente inserita è sbagliata, si prega di riprovare";
                    $tipo="password";
                    self::erroreModifica($tipo,$message,$user);
                }
            }else{
                $message = "Entrambi i campi devono essere pieni";
                $tipo="password";
                self::erroreModifica($tipo,$message,$user);
            }
        }else{
            header("Location: /lunova/Ricerca/mostraHome");
        }
    }

    /**
     * Gestisce la modifica dell'immagine del Cliente o dell'Artista.
     * Preleva la nuova immagine dalla view e procede alla modifica.
     * @return void
     * @throws SmartyException
     */
    public function modificaImmagineProfilo()
    {
        $view = new VProfile();
        $sessione = new FSessione();
        $pm = FPersistentManager::getInstance();

        if ($sessione->isLogged()) {
            $username = $sessione->leggi_valore('utente');
            $tipo = $sessione->leggi_valore('tipo_utente');
            $tipo[0] = "F";
            $class = $tipo;

            $img = $view->getNewImgProfilo();
            if (!empty($img)) {
                $img_profilo = new EImmagine($img[0], $img[1], $img[2], $img[3]);
                $id = $pm->store($img_profilo);
                if($id){
                    $img_profilo->setId($id);
                    $user = $pm->load($class, $username);
                    if($user->getImgProfilo() != null){
                        $id_imgvecchia = $user->getImgProfilo()->getId();
                        $pm->update_value($class, "Id", $id, "Username", $username);
                        $pm->delete("FImmagine", "Id", $id_imgvecchia);
                    }else{
                        $pm->update_value($class, "Id", $id, "Username", $username);
                        $user->setImmProfilo($img_profilo);
                    }
                }
            }
            header('Location: /lunova/Profile/mostraProfilo');
        } else {
            header("Location: /lunova/Ricerca/mostraHome");
        }
    }

    /**
     * Gestisce la visualizzazione dell'area personale degli utenti in base al tipo di utente.
     * Se nessun utente è loggato reindirizza al login.
     * @return void
     * @throws SmartyException
     */
    public function profilo(){

        $sessione = FSessione::getInstance();
        if (!$sessione->leggi_valore('utente')) {
            $log = CLogin::getInstance();
            $log->mostraLogin();
        } else {
            if ((get_class($sessione->leggi_valore('utente')) == 'ECliente') || (get_class($sessione->leggi_valore('utente')) == 'EArtista')) {
                $sessione->cancella_valore("last_visited");
                $utente = unserialize($sessione->leggi_valore('utente'));
                $view = new VProfile();
                $view->profilo($utente, null);
            }
            if (get_class($sessione->leggi_valore('utente')) == 'EAdmin') {
                $sessione->cancella_valore("last_visited");
                $admin = CAdmin::getInstance();
                $admin->homepage();
            }
        }
    }

    /**
     * Funzione che richiama il metodo errore della class VProfile per mostrare l'errore generato dall'utente
     * @param $tipo string tipo di errore generato
     * @param $message string messaggio da stampare
     * @param $user utente collegato
     */
    public function erroreModifica($tipo, $message, $user): void {
        $view = new VProfile();
        $view->errore($tipo, $message, $user);
    }

    public static function registrati(){
        try {
            $view = new VLogin();
            $pers = FPersistentManager::getInstance();
            $sessione = FSessione::getInstance();
            if (!$sessione->isLogged()){
                $p = $_POST;
                $Etype = 'E'.$p['type'];
                $Ftype = 'F'.$p['type'];

                if (!$pers->exist($Ftype,$p['email']) || !$pers->exist_username($Ftype,$p['username']) ){
                    $new = new $Etype($p['username'],$p['nome'],$p['cognome'],$p['via'],$p['civico'],$p['citta'],$p['provincia'],$p['cap'],$p['telefono'],$p['email'],$p['password']);
                    $pers->store($new);
                    $view->message(false,'Registrazione avvenuta con successo','al Login per accedere','Login/login');
                }
                elseif ($pers->exist($Ftype,$p['email'])){
                    $view->Signin(false,'EMAIL GIA ESISTENTE');
                }
                elseif ($pers->exist_username($Ftype,$p['username'])){
                    $view->Signin(false,'USERNAME GIA ESISTENTE');
                }
                else{
                    $view->message(false,'Errore nella registrazione','alla Registrazione','Login/Signin');
                }
            }else{
                header('Location: /lunova');
            }
        }catch (Exception $e){
            $view->message(false,'Errore occorso durante la registrazione : '.$e->getMessage(),'alla Registrazione','Login/Signin');

        }

    }

    public static function prelevadati(){
        $post =$_POST;
        $r = json_encode($post['type']);
        $v = new VLogin();
        $v->message(false,$r,'al preleva dati','Login/Signin');
    }



    public static function Impostazioni(){
        $view = new VProfile();
        $pers = FPersistentManager::getInstance();

        $l = true;
        $elenco = $pers->prelevaCartItems('C151');
        $num = count($elenco);
        $view->Settings($l, $num);
    }

    public static function AddDisco(){
        $view = new VProfile();
        $pers = FPersistentManager::getInstance();

        $utente = 'C151';
        $l = true;
        $generi = $pers->prelevaGeneri();
        $elenco = $pers->prelevaCartItems($utente);
        $num = count($elenco);
        $view->addDisco($l, $num, $generi);
    }


    public static function Assistence(){
        $view = new VProfile();
        $pers = FPersistentManager::getInstance();

        $utente = 'C151';
        $l = true;
        $elenco = $pers->prelevaCartItems($utente);
        $num = count($elenco);
        $view->Assistence($l, $num);
    }

    public static function ModificheProfile(){
        $view = new VProfile();
        $pers = FPersistentManager::getInstance();

        $utente = 'C151';
        $l = true;
        $elenco = $pers->prelevaCartItems($utente);
        $num = count($elenco);
        $view->Change($l, $num);
    }

    public static function AssistenceSend(){
        $view = new VProfile();
        $pers = FPersistentManager::getInstance();


        $testo = $view->getNotification();
        $utente = 'C151';
        $l = true;
        $pers->AssistenzaMex($testo,$utente);
        header('Location: /lunova/Profile/Impostazioni');
    }


    public static function users(string $id){
        $view = new VUsers();
        $pers = FPersistentManager::getInstance();
        $l = true;
        $controllo = false;
        $Art = $pers->ArtistaFromID($id);
        $elenco = $pers->prelevaDischiperIDAutore($id);
        $numero = count($elenco);
        $view->load($l,$Art, $elenco, $numero, $controllo);
    }


    public static function userset(string $id){
        $view = new VUsers();
        $pers = FPersistentManager::getInstance();
        $l = true;
        $controllo = true ;
        $Art = $pers->ArtistaFromID($id);
        $elenco = $pers->prelevaDischiperIDAutore($id);
        $numero = count($elenco);
        $view->load($l,$Art, $elenco, $numero, $controllo);
    }

    public static function Delete(){
        $pers = FPersistentManager::getInstance();
        $l = true;
        $id = ""; //recuperare l'id da sessione
        //TODO: CONTROLLO DIFFERENZIATO PER CLIENTE E ARTISTA
        $pers->EliminaAccontA($id);
        header('Location: /lunova');
    }


    public static function SetQta($id_disco, $id_artista){
        $view = new VUsers();
        $pers = FPersistentManager::getInstance();
        $l = true;
        $id = ""; //recuperare l'id da sessione
        $numero = $view->getQta();
        $pers->SetQta($id_disco, $numero);
        header("Location: /lunova/Profile/users/$id_artista");
    }


}