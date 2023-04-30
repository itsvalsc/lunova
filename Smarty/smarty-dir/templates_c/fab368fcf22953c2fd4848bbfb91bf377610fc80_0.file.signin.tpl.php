<?php
/* Smarty version 4.2.1, created on 2023-04-26 19:31:54
  from 'C:\xampp\htdocs\lunova\Smarty\smarty-dir\templates\signin.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.2.1',
  'unifunc' => 'content_6449600ada8ca6_49129922',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'fab368fcf22953c2fd4848bbfb91bf377610fc80' => 
    array (
      0 => 'C:\\xampp\\htdocs\\lunova\\Smarty\\smarty-dir\\templates\\signin.tpl',
      1 => 1682529174,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_6449600ada8ca6_49129922 (Smarty_Internal_Template $_smarty_tpl) {
?><!-- header -->
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
        <a class="navbar-brand" href="/lunova/">Lunova</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarColor03" aria-controls="navbarColor03" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarColor03">
            <ul class="navbar-nav me-auto">
                <li class="nav-item">
                    <a class="nav-link" href="/lunova/Products_list/elenco_dischi">Prodotti</a>
                </li>
                <?php if ($_smarty_tpl->tpl_vars['logged']->value == false) {?>
                    <li class="nav-item">
                        <a class="nav-link" href="/lunova/Login/login">Login</a>
                    </li>
                <?php }?>
                <li class="nav-item">
                    <a class="nav-link" href="/lunova/AboutUs/us">About</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/lunova/Sondaggi/show">Sondaggi</a>
                </li>
            </ul>




            <form class="d-flex" style="margin-block-end: 2px;" action="/lunova/Profile/ricercaUtente" method="post">
                <input class="form-control me-sm-2" type="text" name="search" placeholder="Cerca Utenti o Artisti" required>
                <button class="btn btn-secondary my-2 my-sm-0" type="submit">Cerca</button>
            </form>

            <ul class="navbar-nav ml-4">
                <?php if ($_smarty_tpl->tpl_vars['logged']->value) {?>
                    <li class="nav-item">

                        <a class="nav-link" style="align-items: center " href="/lunova/Profile/users">
                            <i class="fa-solid fa-circle-user" style="font-size:24px;"></i>
                        </a>

                    </li>

                <?php }?>
                <?php if ($_smarty_tpl->tpl_vars['logged']->value == false) {?>
                    <li class="nav-item">

                        <a class="nav-link" style="align-items: center " href="/lunova/Login/login">
                            <i class="fa-solid fa-circle-user" style="font-size:24px;"></i>
                            <span class="badge rounded-pill bg-secondary">2</span>
                        </a>

                    </li>
                <?php }?>
            </ul>

            </ul>
        </div>
    </div>
</nav>



<!-- end header -->


    <div id="main" class="container" style="margin-top:80px; height: fit-content">
        <div><?php echo $_smarty_tpl->tpl_vars['message']->value;?>
</div>
        <form action="/lunova/Profile/registrati" method="post">
            <div class="form-group" style="width: 50rem;">
                <fieldset>
                    <label class="form-label mt-4" ">Username</label>
                    <input class="form-control" id="nutente" name='username' type="text" placeholder="Username" required>
                </fieldset>
            </div>

            <div class="form-group" style="width: 50rem;">
                <fieldset>
                    <label class="form-label mt-4" ">Nome</label>
                    <input class="form-control" id="nutente" name='nome' type="text" placeholder="Nome" required>
                </fieldset>
            </div>

            <div class="form-group"style="width: 50rem;">
                <fieldset>
                    <label class="form-label mt-4" >Cognome</label>
                    <input class="form-control" id="cutente" name='cognome' type="text" placeholder="Nome" required>
                </fieldset>
            </div>

            <div class="form-group" style="width: 50rem;">
                <label for="exampleInputEmail1" class="form-label mt-4">Email address</label>
                <input type="email" class="form-control" id="Email" name="email" aria-describedby="emailHelp" placeholder="Enter email" required>
                <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
            </div>

            <div class="form-group" style="width: 50rem;">
                <label for="exampleInputPassword1" class="form-label mt-4">Password</label>
                <input type="password" class="form-control" id="password"  name="password" placeholder="password" required>
            </div>

            <div class="form-group"style="width: 50rem;">
                <fieldset>
                    <label class="form-label mt-4" >Telefono</label>
                    <input class="form-control" id="telefono" name='telefono' type="text" placeholder="Telefono" required>
                </fieldset>
            </div>
            <hr>
            <h4>Inserisci l'indirizzo in cui vuoi effettuare la spedizione</h4>
            <div class="form-group"style="width: 50rem;">

                <fieldset>
                    <label class="form-label mt-4" >CAP</label>
                    <input class="form-control" id="CAP"  name='cap' type="text" placeholder="CAP" required>
                </fieldset>
            </div>

            <div class="form-group"style="width: 50rem;">
                <fieldset>
                    <label class="form-label mt-4">Provincia</label>
                    <input class="form-control" id="provincia" name='provincia' type="text" placeholder="Provincia" required>
                </fieldset>
            </div>

            <div class="form-group"style="width: 50rem;">
                <fieldset>
                    <label class="form-label mt-4" >Città</label>
                    <input class="form-control" id="citta" name='citta' type="text" placeholder="Città" required>
                </fieldset>
            </div>

            <div class="form-group"style="width: 50rem;">
                <fieldset>
                    <label class="form-label mt-4" >N. Civico</label>
                    <input class="form-control" id="civico" name='civico' type="text" placeholder="Civico" required>
                </fieldset>
            </div>

            <div class="form-group"style="width: 50rem;">
                <fieldset>
                    <label class="form-label mt-4">Via</label>
                    <input class="form-control" id="via" type="text" name='via' placeholder="Via" required>
                </fieldset>
            </div>
            <hr>
            <div class="form-check">
                <input class="form-check-input" type="radio" name="type" id="optionsRadios1" value="Artista" checked="">
                <label class="form-check-label" for="optionsRadios1">
                    Artista
                </label>

            </div>
            <div class="form-check">
                <input class="form-check-input" type="radio" name="type" id="optionsRadios1" value="Cliente" checked="">
                <label class="form-check-label" for="optionsRadios1">
                    Utente
                </label>
            </div>
            <hr>
            <button type="submit" class="btn btn-primary">CONFERMA ISCRIZIONE</button>
        </form>
    </div>


<div id="main" class="container" style="margin-top:80px; height: fit-content">
</div>

<footer class="bg-dark">
    <hr>
    <p class="container text-light">Copyright &copy; 2022 </p>
</footer>

<?php echo '<script'; ?>
 src="https://bootswatch.com/_vendor/jquery/dist/jquery.min.js"><?php echo '</script'; ?>
>
<?php echo '<script'; ?>
 src="https://bootswatch.com/_vendor/bootstrap/dist/js/bootstrap.bundle.min.js"><?php echo '</script'; ?>
>
<?php echo '<script'; ?>
 src="https://bootswatch.com/_vendor/prismjs/prism.js"><?php echo '</script'; ?>
>

<!--<?php echo '<script'; ?>
 src="<?php echo '<?php'; ?>
 //echo ROOT_URL; <?php echo '?>'; ?>
assets/js/main.js"><?php echo '</script'; ?>
>-->
</body>
</html><?php }
}
