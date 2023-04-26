<?php

require_once "Utility/autoload.php";
require_once "Foundation/FSessione.php";

class CProfile
{


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
            }elseif ($session->isArtista()){
                return $view->Settings(true,null,false);
            }
            else{
                $elenco = $pers->prelevaCartItems('C151');
                $num = count($elenco);
                return $view->Settings(true, $num,true);
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
        $session = FSessione::getInstance();
        $l = true;
        if ($session->isLogged()){
            if ($session->isArtista()){
                return $view->Assistence($l, null, false);
            }else {
                $utente = 'C151';
                $elenco = $pers->prelevaCartItems($utente);
                $num = count($elenco);
                $view->Assistence($l, $num, true);
            }
        }
    }

    public static function ModificheProfile(){
        $view = new VProfile();
        $pers = FPersistentManager::getInstance();
        $session = FSessione::getInstance();
        $num = null;
        if ($session->isLogged()){
            if ($session->isAdmin()){
                return $view->Change_admin();
            }elseif ($session->isArtista()){
                return $view->Change(true,$num,false);
            }
            else{
                //todo:carrello
                //$elenco = $pers->prelevaCartItems($utente);
                //$num = count($elenco);
                $cli = true;
                return $view->Change(true, $num,true);
            }
        }else{
            return header('Location: /lunova');
        }
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
        $self_page = false;
        $controllo = false;
        $num = null;
        $cli = false;
        try {
            if($session->isLogged()){
                if ($session->isArtista()){
                    if (!isset($id)){
                        $id = $session->getUtente()->getIdArtista();
                        $self_page = true;
                    }else{
                        $id_art = $session->getUtente()->getIdArtista();
                        if ($id == $id_art){
                            $self_page = true;
                        }
                    }
                }elseif ($session->isCliente()){
                    $cli = true;
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
                        return $view->load($session->isLogged(),$Art, $elenco,$numero,$controllo,$numComm,$cli);

                    }else{
                        return $view->load_external($session->isLogged(),$Art, $elenco, $numero,$numComm,$cli);
                    }
                }else{
                    return $err->message($session->isLogged(),"non è stato possibile trovare l'artista selezionato",'alla home','');
                }
            }elseif (str_starts_with($id,'C')){
                $cl = $pers->ClienteFromID($id);
                $cli = true;
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
                        return $view->load_cl($session->isLogged(),$cl,$new_vot,$numComm,$commenti,$nmp_arr,$tot_nmp,$nome_dischi,$cli);
                    }else{
                        return $view->load_cl_external($session->isLogged(),$cl,$new_vot,$numComm,$commenti,$nmp_arr,$tot_nmp,$nome_dischi,$cli);
                    }
                    return $view->load_cl($session->isLogged(),$cl);
                }
            }
        }catch (Exception $e){
            return $err->message($session->isLogged(),$e->getMessage(),'alla home','',$num,$cli);
        }
    }


    public static function userset(string $id){
        $view = new VUsers();
        $err = new VErrore();
        $pers = FPersistentManager::getInstance();
        $session = FSessione::getInstance();
        $num = null;
        $cli = false;
        if ($session->isLogged() && $session->isArtista()){
            $id_art = $session->getUtente()->getIdArtista();
            if ($id_art != $id){
                return $err->message($session->isLogged(),'Impossibile accedere','alla home','', $num, $cli);
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
                return $err->message($session->isLogged(),"Errore: impossibile trovare l'artista",'alla home','', $num, $cli);
            }
        }
        else{
            return header('Location: /lunova');

        }

    }

    public static function Delete(){
        $err = new VErrore();
        $pers = FPersistentManager::getInstance();
        $sessione = FSessione::getInstance();
        $num = null;
        $cli = false;
        if ($sessione->isLogged() && $sessione->isArtista()){
            $utente = $sessione->getUtente();
            $email = $utente->getEmail();
            $sessione->logout();
            $pers->EliminaAccontA($email);
            $err->message(false,'Il tuo account è stato eliminato con successo','Torna alla Home','',$num,$cli);
        }elseif ($sessione->isLogged() && $sessione->isCliente()){
            $utente = $sessione->getUtente();
            $cli = true;
            $email = $utente->getEmail();
            $sessione->logout();
            $pers->EliminaAccontC($email);
            $err->message(false,'Il tuo account è stato eliminato con successo','Torna alla Home','',$num,$cli);
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
        $cli = false;
        if ($search!=null){
            $art = $pers->prelevaArtistiperUsername($search)??array();
            $cl = $pers->prelevaClientiperUsername($search)??array();
            $ut = array_merge($art,$cl);
            if ($session->isLogged() && $session->isCliente()){
                $cli = true;
            }
            $view->lista_utenti($ut,$session->isLogged(),null,$cli);

        }else{
            header('Location: /lunova');
        }
    }



    public static function NewPassword(){
        $err = new VErrore();
        $pers = FPersistentManager::getInstance();
        $sessione = FSessione::getInstance();
        $password = $_POST['Password'];
        $num = null;
        $cli = false;
        if ($password!=null){
            if ( $sessione->isLogged() && $sessione->isArtista()){
                $utente = $sessione->getUtente();
                $pass_nuova_cript = $utente->criptaPassword($password);
                $pers->update_value('FArtista','Password',$pass_nuova_cript,$utente->getIdArtista());
                $err->message($sessione->isLogged(),'La tua password è stata cambiata','alla home','',$num,$cli);
            }
            elseif ($sessione->isLogged() && $sessione->isCliente()){
                $utente = $sessione->getUtente();
                $cli = true;
                $pass_nuova_cript = $utente->criptaPassword($password);
                $pers->update_value('FCliente','Password',$pass_nuova_cript,$utente->getIdClient());
                $err->message($sessione->isLogged(),'La tua password è stata cambiata','alla home','',$num,$cli);
            }
            elseif ($sessione->isLogged() && $sessione->isAdmin()){
                $utente = $sessione->getUtente();
                $pass_nuova_cript = $utente->criptaPassword($password);
                $pers->update_value('FAdmin','Password',$pass_nuova_cript,$utente->getIdAmministratore());
                $err->message_admin('La tua password è stata cambiata','alla home','Admin/usersadmin');
            }
            else{
                header('Location: /lunova');
            }
        }else{
            $err->message($sessione->isLogged(),"Si è verificato un errore durante la modifica della password",'alla home','',$num,$cli);
        }
    }

    public static function NewUsername(){
        $err = new VErrore();
        $pers = FPersistentManager::getInstance();
        $sessione = FSessione::getInstance();
        $num = null;
        $cli = false;
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
                    $err->message($sessione->isLogged(),'Il tuo username è stato cambiato','alla home','',$num,$cli);
                }else{
                    $err->message($sessione->isLogged(),'Lo username scelto è gia stato preso','alla modifica','Profile/ModificheProfile',$num,$cli);
                }
            }
            elseif ($sessione->isLogged() && $sessione->isCliente()){
                $verifica = $pers->exist_username('FCliente',$username);
                $cli = true;
                if ($verifica){
                    $utente = $sessione->getUtente();
                    $id = $utente->getIdClient();
                    $pers->update_value('FCliente','Username',$username,$id);
                    $ut = $pers->ClienteFromID($id);
                    $sessione->setUtente($ut);
                    $err->message($sessione->isLogged(),'Il tuo username è stato cambiato','alla home','',$num,$cli);
                }else{
                    $err->message($sessione->isLogged(),'Lo username scelto è gia stato preso','alla modifica','Profile/ModificheProfile',$num,$cli);
                }
            }
            else{
                header('Location: /lunova');
            }
        }else{
            $err->message($sessione->isLogged(),"Si è verificato un errore durante la modifica dello username",'alla home','',$num,$cli);
        }
    }

    public static function NewImage(){
        $view = new VHome();
        $err = new VErrore();
        $pers = FPersistentManager::getInstance();
        $sessione = FSessione::getInstance();
        $num = null;
        $cli = false;
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
                    $err->message($sessione->isLogged(),'La tua foto profilo è stata cambiata','alla home','',$num,$cli);
                }else{
                    $pers->delete('FImmagine',$id);
                    $pers->store($image);
                    $ut = $pers->ArtistaFromID($id);
                    $sessione->setUtente($ut);
                    $err->message($sessione->isLogged(),'La tua foto profilo è stata cambiata','alla home','',$num,$cli);
                }
            }
            elseif ($sessione->isLogged() && $sessione->isCliente()){
                $utente = $sessione->getUtente();
                $cli = true;
                $id = $utente->getIdClient();
                $image = new EImmagine($imgName,$imgType,$imgData,$id);
                $verifica = $pers->exist('FImmagine',$id);
                if (!$verifica){
                    $pers->store($image);
                    $ut = $pers->ClienteFromID($id);
                    $sessione->setUtente($ut);
                    $err->message($sessione->isLogged(),'La tua foto profilo è stata cambiata','alla home','',$num,$cli);
                }else{
                    $pers->delete('FImmagine',$id);
                    $pers->store($image);
                    $ut = $pers->ClienteFromID($id);
                    $sessione->setUtente($ut);
                    $err->message($sessione->isLogged(),'La tua foto profilo è stata cambiata','alla home','',$num,$cli);
                }
            }
            else{
                header('Location: /lunova');
            }
        }else{
            $err->message($sessione->isLogged(),"Si è verificato un errore durante la modifica della foto",'alla home','',$num,$cli);
        }
    }

}