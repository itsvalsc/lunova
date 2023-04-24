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
    public static function profilo(){

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

                if (!$pers->exist($Ftype,$p['email']) && !$pers->exist_username($Ftype,$p['username']) ){
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
        $session = FSessione::getInstance();
        if ($session->isLogged()){
            if($session->isAdmin()){
                return $view->Settings_admin();
            }else{
                $elenco = $pers->prelevaCartItems('C151');
                $num = count($elenco);
                return $view->Settings(true, $num);
            }
        }
        else{
           return header('Location: /lunova');
        }

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


    public static function users(string $id=null){
        $err= new VErrore();
        $view = new VUsers(); //todo:controllo per id artista
        $pers = FPersistentManager::getInstance();
        $session = FSessione::getInstance();
        $l = true;
        $self_page = false;
        $controllo = false;
        try {
            if($session->isLogged()){
                if ($session->isArtista()){
                    $id_art = $session->getUtente()->getIdArtista();
                    if ($id == $id_art){
                        $self_page = true;
                    }
                }elseif ($session->isCliente()){

                    if (!isset($id)){
                        $id=$session->getUtente()->getIdClient();
                        $self_page = true;
                    }else{
                        $id_cl = $session->getUtente()->getIdClient();
                        if ($id == $id_cl){
                            $self_page = true;
                        }
                    }
                }
            }
            if (str_starts_with($id,'B')){
                $Art = $pers->ArtistaFromID($id);
                if ($Art!=null){
                    $elenco = $pers->prelevaDischiperIDAutore($id);
                    $array=[];
                    foreach ($elenco as $key => $value){
                        $temp = $pers->loadCommenti($value->getID());
                        $array = array_merge($array,$temp);
                    }
                    $numComm = count($array);
                    $numero = count($elenco);
                    if($self_page){
                        return $view->load($session->isLogged(),$Art, $elenco,$numero,$controllo,$numComm);

                    }else{
                        return $view->load_external($session->isLogged(),$Art, $elenco, $numero,$numComm);
                    }
                }else{
                    return $err->message($session->isLogged(),"non è stato possibile trovare l'artista selezionato",'alla home','');
                }
            }elseif (str_starts_with($id,'C')){
                $cl = $pers->ClienteFromID($id);
                if ($cl!=null){
                    $votazioni = $pers->loadVotazioniDiscoperCliente($id);
                    $new_vot=[];
                    foreach ($votazioni as $disco=>$voto){
                        $d = $pers->load('FDisco',$disco);
                        $new_vot[$d->getTitolo()]=CProducts_list::star_Rate($voto);
                    }
                    $commenti = $pers->loadCommentibyCliente($id);
                    $numComm= count($commenti);
                    $nmp_arr=[];
                    $tot_nmp=0;
                    foreach ($commenti as  $comm){
                        $temp_arr = $pers->loadNumeroMPbyComm($comm->getId());
                        $d = $pers->load('FDisco',$comm->getIdDisco());
                        $nome_dischi[$comm->getId()]=$d->getTitolo();
                        if (count($temp_arr)!=0){
                            $nmp_arr[key($temp_arr)]= $temp_arr[key($temp_arr)];
                            $tot_nmp= $tot_nmp + intval($temp_arr[key($temp_arr)]);
                        }
                    }
                    //return $err->message('true',json_encode($nome_dischi),'','');
                    if($self_page){
                        return $view->load_cl($session->isLogged(),$cl,$new_vot,$numComm,$commenti,$nmp_arr,$tot_nmp,$nome_dischi);
                    }else{
                        return $view->load_cl_external($session->isLogged(),$cl,$new_vot,$numComm,$commenti,$nmp_arr,$tot_nmp,$nome_dischi);
                    }
                    return $view->load_cl($session->isLogged(),$cl);
                }
            }
        }catch (Exception $e){
            return $err->message($session->isLogged(),$e->getMessage(),'alla home','');
        }
    }


    public static function userset(string $id){
        $view = new VUsers();
        $err = new VErrore();
        $pers = FPersistentManager::getInstance();
        $session = FSessione::getInstance();
        if ($session->isLogged() && $session->isArtista()){
            $id_art = $session->getUtente()->getIdArtista();
            if ($id_art != $id){
                return $err->message($session->isLogged(),'Impossibile accedere','alla home','');
            }
            $l = true;
            $controllo = true ;
            $Art = $pers->ArtistaFromID($id);
            if ($Art!=null){
                $elenco = $pers->prelevaDischiperIDAutore($id);
                $array=[];
                foreach ($elenco as $key => $value){
                    $temp = $pers->loadCommenti($value->getID());
                    $array = array_merge($array,$temp);
                }
                $numComm = count($array);
                $numero = count($elenco);
                $view->load($l,$Art, $elenco, $numero, $controllo,$numComm);
            }
            else{
                return $err->message($session->isLogged(),"Errore: impossibile trovare l'artista",'alla home','');
            }
        }
        else{
            return header('Location: /lunova');

        }

    }

    public static function Delete(){
        $view = new VHome();
        $pers = FPersistentManager::getInstance();
        $sessione = FSessione::getInstance();
        if ($sessione->isLogged() && $sessione->isArtista()){
            $utente = $sessione->getUtente();
            $email = $utente->getEmail();
            $sessione->logout();
            $pers->EliminaAccontA($email);
            $view->message(false,'Il tuo account è stato eliminato con successo','Torna alla Home','');
        }elseif ($sessione->isLogged() && $sessione->isCliente()){
            $utente = $sessione->getUtente();
            $email = $utente->getEmail();
            $sessione->logout();
            $pers->EliminaAccontC($email);
            $view->message(false,'Il tuo account è stato eliminato con successo','Torna alla Home','');
        }
        else{
            header('Location: /lunova');
        }
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

    public static function ricercaUtente(){
        $view = new VRicerca();
        $v = new VErrore();
        $pers = FPersistentManager::getInstance();
        $session = FSessione::getInstance();
        $search = $view->getsearch();
        if ($search!=null){
            $art = $pers->prelevaArtistiperUsername($search)??array();
            $cl = $pers->prelevaClientiperUsername($search)??array();
            $ut = array_merge($art,$cl);
            //$v->message(true,json_encode($ut),'dsa','asd');
            $view->lista_utenti($ut,$session->isLogged(),null);

        }else{
            header('Location: /lunova');
        }
    }



    public static function NewPassword(){
        $view = new VHome();
        $pers = FPersistentManager::getInstance();
        $sessione = FSessione::getInstance();
        $password = $_POST['Password'];
        if ($password!=null){
            if ( $sessione->isLogged() && $sessione->isArtista()){
                $utente = $sessione->getUtente();
                $pass_nuova_cript = $utente->criptaPassword($password);
                $pers->update_value('FArtista','Password',$pass_nuova_cript,$utente->getIdArtista());
                $view->message($sessione->isLogged(),'La tua password è stata cambiata','alla home','');
            }
            elseif ($sessione->isLogged() && $sessione->isCliente()){
                $utente = $sessione->getUtente();
                $pass_nuova_cript = $utente->criptaPassword($password);
                $pers->update_value('FCliente','Password',$password,$utente->getIdClient());
                $view->message($sessione->isLogged(),'La tua password è stata cambiata','alla home','');
            }
            elseif ($sessione->isLogged() && $sessione->isAdmin()){
                $utente = $sessione->getUtente();
                $pass_nuova_cript = $utente->criptaPassword($password);
                $pers->update_value('FAdmin','Password',$password,$utente->getIdAmministratore());
                $view->message($sessione->isLogged(),'La tua password è stata cambiata','alla home','');
            }
            else{
                header('Location: /lunova');
            }
        }else{
            $view->message($sessione->isLogged(),"Si è verificato un errore durante la modifica della password",'alla home','');
        }
    }

    public static function NewUsername(){
        $view = new VHome();
        $pers = FPersistentManager::getInstance();
        $sessione = FSessione::getInstance();
        $username = $_POST['Username'];
        if ($username!=null){
            if ( $sessione->isLogged() && $sessione->isArtista()){
                $verifica = $pers->exist_username('FArtista',$username);
                if (!$verifica){
                    $utente = $sessione->getUtente();
                    $id = $utente->getIdArtista();
                    $pers->update_value('FArtista','Username',$username,$id);
                    $ut = $pers->ArtistaFromID($id);
                    $sessione->setUtente($ut);
                    $view->message($sessione->isLogged(),'Il tuo username è stato cambiato','alla home','');
                }else{
                    $view->message($sessione->isLogged(),'Lo username scelto è gia stato preso','alla modifica','/Profile/Impostazioni');
                }
            }
            elseif ($sessione->isLogged() && $sessione->isCliente()){
                $verifica = $pers->exist_username('FCliente',$username);
                if ($verifica){
                    $utente = $sessione->getUtente();
                    $id = $utente->getIdClient();
                    $pers->update_value('FCliente','Username',$username,$id);
                    $ut = $pers->ClienteFromID($id);
                    $sessione->setUtente($ut);
                    $view->message($sessione->isLogged(),'Il tuo username è stato cambiato','alla home','');
                }else{
                    $view->message($sessione->isLogged(),'Lo username scelto è gia stato preso','alla modifica','/Profile/Impostazioni');
                }
            }
            else{
                header('Location: /lunova');
            }
        }else{
            $view->message($sessione->isLogged(),"Si è verificato un errore durante la modifica dello username",'alla home','');
        }
    }

    public static function NewImage(){
        $view = new VHome();
        $pers = FPersistentManager::getInstance();
        $sessione = FSessione::getInstance();
        $imgName =$_FILES['Foto']['name'];
        $imgType =$_FILES['Foto']['type'];
        $imgData =@file_get_contents($_FILES['Foto']['tmp_name']);

        if ($imgData!=null){
            if ( $sessione->isLogged() && $sessione->isArtista()){
                $utente = $sessione->getUtente();
                $id = $utente->getIdArtista();
                $image = new EImmagine($imgName,$imgType,$imgData,$id);
                $verifica = $pers->exist('FImmagine',$id);
                if (!$verifica){
                    $pers->store($image);
                    $ut = $pers->ArtistaFromID($id);
                    $sessione->setUtente($ut);
                    $view->message($sessione->isLogged(),'La tua foto profilo è stata cambiata','alla home','');
                }else{
                    $pers->delete('FImmagine',$id);
                    $pers->store($image);
                    $ut = $pers->ArtistaFromID($id);
                    $sessione->setUtente($ut);
                    $view->message($sessione->isLogged(),'La tua foto profilo è stata cambiata','alla home','');
                }
            }
            elseif ($sessione->isLogged() && $sessione->isCliente()){
                $utente = $sessione->getUtente();
                $id = $utente->getIdClient();
                $image = new EImmagine($imgName,$imgType,$imgData,$id);
                $verifica = $pers->exist('FImmagine',$id);
                if (!$verifica){
                    $pers->store($image);
                    $ut = $pers->ClienteFromID($id);
                    $sessione->setUtente($ut);
                    $view->message($sessione->isLogged(),'La tua foto profilo è stata cambiata','alla home','');
                }else{
                    $pers->delete('FImmagine',$id);
                    $pers->store($image);
                    $ut = $pers->ClienteFromID($id);
                    $sessione->setUtente($ut);
                    $view->message($sessione->isLogged(),'La tua foto profilo è stata cambiata','alla home','');
                }
            }
            else{
                header('Location: /lunova');
            }
        }else{
            $view->message($sessione->isLogged(),"Si è verificato un errore durante la modifica della foto",'alla home','');
        }
    }

}