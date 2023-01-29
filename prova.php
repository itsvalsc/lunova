<?php

////ABOUT.TPL//////////
///
///
<!-- header -->
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" type="text/css" href="https://bootswatch.com/5/vapor/bootstrap.css">

    <link rel="stylesheet" type="text/css" href="http://localhost/lunova/inc/css/style.css ">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g==" crossorigin="anonymous" referrerpolicy="no-referrer" />


    <title>Lunova</title>
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container-fluid" >
        <a class="navbar-brand" href="/lunova/RicercaDisco/index">Lunova</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarColor03" aria-controls="navbarColor03" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarColor03">
            <ul class="navbar-nav me-auto">
                <li class="nav-item">
                    <a class="nav-link" href="/lunova/Products_list/elenco_dischi">Prodotti</a>
                </li>
                {if $logged==false}
                    <li class="nav-item">
                        <a class="nav-link" href="/lunova/Login/login">Login</a>
                    </li>
                {/if}
                <li class="nav-item">
                    <a class="nav-link" href="/lunova/AboutUs/us">About</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/lunova/Sondaggi/show">Sondaggi</a>
                </li>
            </ul>



            <ul class="navbar-nav ml-4">
                <li class="nav-item">
                    <a class="nav-link" href="/Carrello/mio_carrello">
                        <i class="fas fa-shopping-cart"></i>
                        <span class="badge rounded-pill bg-secondary">2</span>
                    </a>
                </li>
            </ul>



            <form class="d-flex" style="margin-block-end: 2px;">
                <input class="form-control me-sm-2" type="text" placeholder="Search">
                <button class="btn btn-secondary my-2 my-sm-0" type="submit">Search</button>
            </form>

            <ul class="navbar-nav ml-4">
                {if $logged}
                    <li class="nav-item">

                        <a class="nav-link" style="align-items: center " href="/Carrello/mio_carrello">
                            <i class="fa-solid fa-circle-user" style="font-size:24px;"></i>
                            <span class="badge rounded-pill bg-secondary">2</span>
                        </a>

                    </li>

                {/if}
                {if $logged==false}
                    <li class="nav-item">

                        <a class="nav-link" style="align-items: center " href="/lunova/Login/login">
                            <i class="fa-solid fa-circle-user" style="font-size:24px;"></i>
                            <span class="badge rounded-pill bg-secondary">2</span>
                        </a>

                    </li>
                {/if}
            </ul>

            </ul>
        </div>
    </div>
</nav>
<!-- end header -->
<div id="main" class="container" style="margin-top:80px; height: 700px">
    <div class="col-9">
        <h2>About us</h2>
        <p>Siamo una compagnia...</p>
        <p> {$verifica}</p>




    </div>
</div>


<!-- footer -->
<footer class="bg-dark" style ="margin-bottom: 0px;">
    <hr>
    <p class="container text-light">Copyright &copy; 2022 </p>
</footer>

<script src="https://bootswatch.com/_vendor/jquery/dist/jquery.min.js"></script>
<script src="https://bootswatch.com/_vendor/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://bootswatch.com/_vendor/prismjs/prism.js"></script>

<!--<script src="<?php //echo ROOT_URL; ?>assets/js/main.js"></script>-->
</body>
</html>


////ERROR.TPL//////////
///
///
 <link rel="stylesheet" type="text/css" href="https://bootswatch.com/5/vapor/bootstrap.css">
{if $logged}
    <div id="main" class="container" style="margin-top:100px;">
        <div class="alert alert-dismissible alert-danger">
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            <h4 class="alert-heading">Attenzione!</h4>
            <strong>Ops! qualcosa è andato storto... {$errore} </strong> <a href="/lunova/RicercaDisco/index" class="alert-link">Clicca qui</a> per tornare indietro.
        </div>
    </div>
{/if}


///VLOGIN.PHP//////
///
///


//require_once "Smarty/smarty-lib/Autoloader.php";
//require_once "StartSmarty.php";

/**
 * La classe VLogin si occupa della visualizzazione e il recupero delle informazioni dalle pagine relative all'accesso e alla registrazione degli utenti.
 * @package View
 */

class VLogin
{

    private $smarty;

    /**
     * VLogin constructor.
     */
    public function __construct()
    {
        $this->smarty = StartSmarty::configuration();
    }

    /**
     * @param $name
     * @param $dati
     */
    public function setData($name, $dati)
    {
        $this->smarty->assign($name, $dati);
    }

    /**
     * @param $template
     */
    public function setTemplate($template)
    {
        $this->smarty->display($template);
    }

    public function Login($l, $v)
    {
        $this->setData('logged', $l);
        $this->setData('verifica', $v);
        $this->setTemplate("login.tpl");
    }

    public function erroreLogin($tipo)
    {
        if ($tipo == "vuoti") {
            $this->smarty->assign('errore', 'Errore! I campi non possono essere vuoti ');
            $this->smarty->display('login.tpl');
        } else {
            $this->smarty->assign('errore', 'Errore! Username o password errati');
            $this->smarty->display('error.tpl');
        }
    }

    /**
     * Funzione che si occupa di gestire la visualizzazione degli errori in fase login
     * @throws SmartyException
     */
    public function loginError()
    {
        $this->smarty->assign('error', "errore"); //Utente inesistente
        $this->smarty->display('login.tpl');
    }

    /**
     * Funzione che si occupa di gestire la visualizzazione della form di registrazione del Cliente
     * @throws SmartyException
     */
    public function registra_cliente()
    {
        $this->smarty->display('singin.tpl');
    }

    /**
     * Funzione che si occupa di gestire la visualizzazione degli errori nella form di registrazione per il cliente
     * @param $error tipo di errore da visualizzare nella form
     * @throws SmartyException
     */
    public function ErroreRegistrazioneCli($error)
    {
        switch ($error) {
            case "email":
                $this->smarty->assign('erroreUsername', "errore"); //Username già esistente
                break;
            case "typeimg" :
                $this->smarty->assign('erroreFormato', "errore"); //Formato immagine non supportato
                break;
            //case "size" :
            //$this->smarty->assign('erroreImmagine',"errore"); //Dimensione Immagine non supportata(troppo grande)
            //break;
        }
        $this->smarty->display('singin.tpl');
    }


    /**
     * Funzione che si occupa di gestire la visualizzazione della form di registrazione dell'Artista
     * @throws SmartyException
     */
    public function registra_artista()
    {
        $this->smarty->display('singin.tpl');
    }

    /**
     * Funzione che si occupa di gestire la visualizzazione degli errori nella form di registrazione per l'artista
     * @param $error tipo di errore da visualizzare nella form
     * @throws SmartyException
     */
    public function ErroreRegistrazioneArt($error)
    {
        switch ($error) {
            case "email":
                $this->smarty->assign('erroreUsername', "errore"); //Username già esistente
                break;
            case "formimg" :
                $this->smarty->assign('erroreFormato', "errore"); //Formato immagine non supportato
                break;
            //case "size" :
            //$this->smarty->assign('erroreImmagine',"errore"); //Dimensione Immagine non supportata(troppo grande)
            //break;
        }
        $this->smarty->display('singin.tpl');
    }

    /** METODI GET */

    /**
     * Restituisce la email inserita dall'utente(utilizzato nei login/registrazione/modifica profilo)
     * Inviato con metodo post
     * @return mixed|string
     */
    public function getEmail()
    {
        if (isset($_POST['Email']))
            return $_POST['Email'];
        else {
            return "";
        }
    }

    /**
     * Restituisce lo username inserito dall'utente(utilizzato nei login/registrazione/modifica profilo)
     * Inviato con metodo post
     * @return mixed|string
     */
    public function getUsername()
    {
        if (isset($_POST['Email']))
            return $_POST['Email'];
        else {
            return "";
        }
    }

    /**
     * Restituisce la password inserito dall'utente(utilizzato nei login/registrazione/modifica profilo)
     * Inviato con metodo post
     * @return mixed|string
     */
    public function getPwd()
    {
        if (isset($_POST['Password']))
            return $_POST['Password'];
        else {
            return "";
        }
    }

    /**
     * Restituisce il nome inserito dall'utente(utilizzato nei login/registrazione/modifica profilo)
     * Inviato con metodo post
     * @return mixed|string
     */
    public function getNome()
    {
        if (isset($_POST['Email']))
            return $_POST['Email'];
        else {
            return "";
        }
    }

    /**
     * Restituisce il cognome inserito dall'utente(utilizzato nei login/registrazione/modifica profilo)
     * Inviato con metodo post
     * @return mixed|string
     */
    public function getCognome()
    {
        if (isset($_POST['Email']))
            return $_POST['Email'];
        else {
            return "";
        }
    }

    /**
     * Restituisce un array contenente le informazioni sul immagine da caricare,
     * contenuto nel array _$_FILES,
     * questo verrà poi passato al metodo upload per controllare la correttezza del file caricato
     * @return array|null
     */
    public function getImgProfilo()
    {
        if ($_FILES['img_profilo']['Nome'] == "" || $_FILES['img_profilo']['Formato'] == "" || $_FILES['img_profilo']['tmp_name'] == "" || $_FILES['img_profilo']['IdAppartenenza'] == "") {
            $arrayImg = array();
        } else {
            $nome = $_FILES['img_profilo']['Nome'];
            $formato = $_FILES['img_profilo']['Formato'];
            $file = $_FILES['img_profilo']['Immagine'];
            $id_app = $_FILES['img_profilo']['IdAppartenenza'];
            $arrayImg = array($nome, $formato, $id_app, file_get_contents($file));
        }
        return $arrayImg;
    }
}

///CLOGIN.PHP//////////
///
///
///


/**
 * La classe CLogin è utilizzata per la registrazione e l'autenticazione dell'utente/proprietario.
 * @package Controller
 */

class CLogin
{

    /**
     * @var CLogin|null Variabile di classe che mantiene l'istanza della classe.
     */
    public static ?CLogin $instance = null;

    /** Costruttore della classe */
    private function __construct()
    {
    }

    /**
     * Restituisce l'istanza della classe
     * @return CLogin|null
     */
    public static function getInstance(): ?CLogin
    {
        if (!isset(self::$instance)) {
            self::$instance = new CLogin();
        }
        return self::$instance;
    }

    /**
     * Va a riconoscere il browser tramite il 'PHPSESSID'
     * @return bool
     */
    public static function isLogged()
    {
        $login = false;
        if (isset($_COOKIE['PHPSESSID'])) {
            if (FSessione::status() == PHP_SESSION_NONE) {
                FSessione::start();
            }
        }
        if (FSessione::getUtente() != null) {
            $login = true;
        }
        return $login;
    }

    /**
     * Mostra il form della registrazione dell'artista
     * @throws SmartyException
     */
    public function formRegistrazioneArtista()
    {
        $view = new VLogin();
        $view->registra_artista();
    }

    /**
     * Mostra il form della registrazione del cliente
     * @throws SmartyException
     */
    public function formRegistrazioneCliente()
    {
        $view = new VLogin();
        $view->registra_cliente();
    }

    /**
     * public static function login(){
     * $view = new VLogin();
     * $l = true;
     * $view->Login($l);
     * }
     */
    /**
     * Funzione che gestisce il login di un utente
     * @return void
     */
    public static function login()
    {
        $view = new VLogin();
        $pm = FPersistentManager::getInstance();
        $l = true;
        $v = 'NO';

        $emailLogin = $view->getEmail();
        $passwordLogin = $pm->criptaPassword($view->getPwd());
        if ($emailLogin == null || $passwordLogin == null) {
            $tipo = "vuoti";
            self::erroreLogin($tipo);
        } else {
            $user = $pm->verificaLogin($emailLogin, $passwordLogin);
            if ($user != null) {
                $sessione = new FSessione();

                $sessione->imposta_valore('utente', $user->getEmail());
                $sessione->imposta_valore("tipo_utente", get_class($user));
                if (get_class($user) == "EAdmin") {
                    header("Location: /lunova/Admin/dashboardAdmin");
                } else {
                    $v = 'OK';
                    header("Location: /lunova/Ricerca/mostraHome");
                }
            } else {
                $tipo = "credenziali";
                self::erroreLogin($tipo);
            }
        }
        $view->login($l, $v);

    }

    /**
     * Effettua il logout e chiude la sessione
     */
    public function logout()
    {
        $sessione = new FSessione();
        $sessione->close_session();
        header('Location: /lunova/');
    }

    /**
     * Permette il reinserimento delle credenziali nel caso di errato login
     * @param $tipo
     * @return void
     */
    public static function erroreLogin($tipo): void
    {
        $view = new VLogin();
        $view->erroreLogin($tipo);
    }

    //TODO : funzione verifica login da fare dopo aver scritto il persistent manager
    /**
     * public function prova(){
     * $viewex = new VLogin();
     * FSessione::start();
     * //$l = 'login';
     * $viewex->Login();
     * }
     */
}

>