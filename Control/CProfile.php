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
    public function mostraProfilo(){
        $sessione = new FSessione();
        $pm = FPersistentManager::getInstance();

        if ($sessione->isLogged()){
            $username = $sessione->leggi_valore("utente");
            $tipo = $sessione->leggi_valore("tipo_utente");
            if ($tipo == "ECliente") {
                $cliente = $pm->load("FCliente", $username);
                $view = new VProfile();
                $view->mostraProfiloCliente($cliente);
            } elseif ($tipo == "EArtista") {
                $artista = $pm->load("FArtista", $username);
                $view = new VProfile();
                $view->mostraProfiloArtista($artista);
            }
        }else{
            header("Location: /lunova/Ricerca/mostraHome");
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

}