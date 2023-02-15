<?php

require_once "Smarty/smarty-lib/Autoloader.php";
require_once "StartSmarty.php";

/**
 * La classe VProfile si occupa dell'input-output per operazioni su dati personali di clienti e artisti
 * @package View
 */
class VProfile
{
    private Smarty $smarty;

    public function __construct()
    { $this->smarty = StartSmarty::configuration(); }

    /**
     * Funzione che permette di visualizzare il profilo del Cliente prelevando le informazioni dall'oggetto,
     * assegna i parametri al template, assegna il messaggio di errore e mostra la pagina.
     * @param $utente informazioni sull' utente da visualizzare
     * @param $dischi elenco di dischi gestiti dall'artista, vale null se è il profilo di un cliente
     * @param $error errore, se preswente, ottenuto nella modifica del profilo
     * @throws SmartyException
     */
    public function profilo($utente,$dischi, $error) {
        //encode con base64 del img profilo
        list($formato,$imm) = $this->setImage($utente->getImmProfilo(), get_class($utente));
        if ($utente->getImgProfilo() !== null) {
            $imm = base64_encode($utente->getImgProfilo()->getImmagine());
        }
        else {
            $data = file_get_contents( $_SERVER['DOCUMENT_ROOT'] . '/lunova/smarty-dir/template/img/icona_profilo_utente.jpg');
            $imm = base64_encode($data);
        }
        $this->smarty->assign('formato', $formato);
        $this->smarty->assign('immagine', $imm);
        $this->smarty->assign('userlogged',"loggato");
        $this->smarty->assign('nome',$utente->getNome());
        $this->smarty->assign('cognome',$utente->getCognome());
        $this->smarty->assign('username',$utente->getUsername());
        $this->smarty->assign('email',$utente->getEmail());
        //ECliente o EArtista
        $this->smarty->assign('classe', get_class($utente));
        //Gestione dell'errore
        if(isset($error)){

            switch($error){
                case ("password_old"):{
                    $this->smarty->assign('errorePwOld',"Hai inserito la password precedente");
                    break;
                }
                case ("password_error"):{
                    $this->smarty->assign('errorePw',"La vecchia password non corrisponde");
                    break;
                }
                //case ("size"):{
                  //  $this->smarty->assign('errorSize',"Dimensione immagine non supportata");
                    //break;
                //}
                case ("formato"):{
                    $this->smarty->assign('erroreFormato',"Formato immagine non supportato");
                    break;
                }
                case ("username"):{
                    $this->smarty->assign('erroreUsername',"Username già presente");
                    break;
                }
            }
        }
        //Se Cliente dischi pref, se invece Artista dischi pubblicati
        if($dischi==null){
            $this->smarty->assign('array',$utente->getDischiPref());
            $this->smarty->display('profile.tpl');
        }else{
            $this->smarty->assign('array',$dischi);
            $this->smarty->display('profile.tpl');
        }
    }

    /** METODI GET */

    /**
     * Metodo che restituisce la email inserita nel campo "Nuova EMail", utilizzata nella modifica del profilo, e prelevata dal vettore $_FILES
     * @return string
     */
    public function getNewEmail(): string
    { return $_POST['newemail']; }

    /**
     * Metodo che restituisce la username inserita nel campo "Nuova Username", utilizzata nella modifica del profilo, e prelevata dal vettore $_FILES
     * @return string
     */
    public function getNewUsername(): string
    { return $_POST['newusername']; }

    /**
     * Metodo che restituisce la password inserita nel campo "Nuova Password", utilizzata nella modifica del profilo, e prelevata dal vettore $_FILES
     * @return string
     */
    public function getNewPassword(): string
    { return $_POST['newpassword']; }

    /**
     * Metodo che restituisce la password inserita nel campo "Password precedente", utilizzata nella modifica del profilo per la validazione della password, e prelevata dal vettore $_FILES
     * @return string
     */
    public function getPassword(): string
    { return $_POST['password']; }

    /**
     * Restituisce un array contenente le informazioni sull'immagine da caricare, contenuto nel array _$_FILES,
     * questo verrà poi passato al metodo upload per controllare la correttezza del file caricato
     * @return array
     */
    public function getNewImgProfilo(): array
    {
        if($_FILES['newimg_profilo']['formato'] == "" || $_FILES['newimg_profilo']['nome'] == "" || $_FILES['newimg_profilo']['immagine'] == ""){
            $arrayImg = array();
        }else{
            $formato = $_FILES['newimg_profilo']['formato'];
            $nome = $_FILES['newimg_profilo']['nome'];
            $file = $_FILES['newimg_profilo']['immagine'];
            $arrayImg = array($nome, $formato, file_get_contents($file));
        }
        return $arrayImg;
    }

    /**
     * Funzione utilizzata per visualizzare l'area personale di un cliente.
     * @param ECliente $cliente cliente
     * @param $dischi_preferiti array dei dischi preferiti
     */
    public function mostraProfiloCliente(ECliente $cliente, $dischi_preferiti){
        $username = $cliente->getUsername();
        $nome = $cliente->getNome();
        $cognome = $cliente->getCognome();
        $email = $cliente->getEmail();
        $img_profilo = $cliente->getImmProfilo();
        if($img_profilo != null){
            $imm = $img_profilo->getImmagine();
            $formato = $img_profilo->getFormato();
        }else{
            $imm = "";
            $formato = "";
        }
        $this->smarty->assign("logged",true);
        $this->smarty->assign("username",$username);
        $this->smarty->assign("nome",$nome);
        $this->smarty->assign("cognome",$cognome);
        $this->smarty->assign("email",$email);
        $this->smarty->assign("pic64",$imm);
        $this->smarty->assign("type",$formato);
        $this->smarty->assign("dischi_preferiti",$dischi_preferiti);

        $this->smarty->display('users.tpl');
    }
    //TODO:: utilizzare una sola funzione di mostra profile e vedere tramite la sessione se è un utente o un artista
    /**
     * Funzione utilizzata per visualizzare l'area personale di un artista.
     * @param EArtista $artista artista
     * @param $locali array di dischi
     */
    public function mostraProfiloArtista(EArtista $artista,$dischi){
        $username = $artista->getUsername();
        $nome = $artista->getNome();
        $cognome = $artista->getCognome();
        $email = $artista->getEmail();
        $img_profilo = $artista->getImmProfilo();
        if($img_profilo != null){
            $imm = $img_profilo->getImmagine();
            $formato = $img_profilo->getFormato();
        }else{
            $imm = "";
            $formato = "";
        }

        $this->smarty->assign("username",$username);
        $this->smarty->assign("nome",$nome);
        $this->smarty->assign("cognome",$cognome);
        $this->smarty->assign("email",$email);
        $this->smarty->assign("imm",$imm);
        $this->smarty->assign("formato",$formato);
        $this->smarty->assign("dischi",$dischi);

        $this->smarty->display('profile.tpl');
    }

    /**
     * Funzione utilizzata per mostrare l'errore generato.
     * @param $tipo tipo di errore generato
     * @param $message messaggio da stampare
     * @param $user utente collegato
     */
    public function errore($tipo,$message,$user){
        $pm = FPersistentManager::getInstance();

        $this->smarty->assign("tipo",$tipo);
        $this->smarty->assign("message",$message);

        $username = $user->getUsername();
        $nome = $user->getNome();
        $cognome = $user->getCognome();
        $email = $user->getEmail();
        $img_profilo = $user->getImmProfilo();
        if($img_profilo != null){
            $imm = $img_profilo->getImmagine();
            $formato = $img_profilo->getFormato();
        }else{
            $imm = "";
            $formato = "";
        }
        $this->smarty->assign("username",$username);
        $this->smarty->assign("nome",$nome);
        $this->smarty->assign("cognome",$cognome);
        $this->smarty->assign("email",$email);
        $this->smarty->assign("imm",$imm);
        $this->smarty->assign("formato",$formato);

        /**
        if(get_class($user) =="ECliente"){
            $dischi_preferiti = $pm->getDischiPreferiti($username);  //SOLO SE SI VUOLE AGGIUNGERE UNA TABELLA CLIENTE-DISCHI CHE TIENE CONTO DELLE PREFERENZE
            $this->smarty->assign("dischi_preferiti",$dischi_preferiti);
            $this->smarty->display('profile.tpl');
        }elseif (get_class($user)=="EArtista"){
            $dischi = $pm->load("artista", $username);
            $this->smarty->assign("dischi",$dischi);
            $this->smarty->display('profile.tpl');
        }*/
    }
}