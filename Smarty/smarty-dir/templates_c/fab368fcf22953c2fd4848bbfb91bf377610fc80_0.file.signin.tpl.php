<?php
/* Smarty version 4.2.1, created on 2022-12-08 22:48:04
  from 'C:\xampp\htdocs\lunova\Smarty\smarty-dir\templates\signin.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.2.1',
  'unifunc' => 'content_63925b94b90821_12095444',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'fab368fcf22953c2fd4848bbfb91bf377610fc80' => 
    array (
      0 => 'C:\\xampp\\htdocs\\lunova\\Smarty\\smarty-dir\\templates\\signin.tpl',
      1 => 1670536081,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_63925b94b90821_12095444 (Smarty_Internal_Template $_smarty_tpl) {
?><!-- header -->
<?php echo '<?php'; ?>

require_once 'C:\xampp\htdocs\lunova\inc\css\icons.php';
<?php echo '?>'; ?>

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
        <a class="navbar-brand" href="http://localhost/lunova/RicercaDisco/index">Lunova</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarColor03" aria-controls="navbarColor03" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarColor03">
            <ul class="navbar-nav me-auto">
                <li class="nav-item">
                    <a class="nav-link" href="http://localhost/lunova/Products_list/elenco_dischi">Prodotti</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="http://localhost/lunova/Login/login">Login</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="http://localhost/lunova/AboutUs/us">About</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="http://localhost/lunova/Sondaggi/show">Sondaggi</a>
                </li>
            </ul>



            <ul class="navbar-nav ml-4">
                <li class="nav-item">
                    <a class="nav-link" href="http://localhost/lunova/Carrello/mio_carrello">
                        <i class="fas fa-shopping-cart"></i>
                        <span class="badge rounded-pill bg-secondary">1</span>
                    </a>
                </li>
            </ul>



            <form class="d-flex" style="margin-block-end: 2px;">
                <input class="form-control me-sm-2" type="text" placeholder="Search">
                <button class="btn btn-secondary my-2 my-sm-0" type="submit">Search</button>
            </form>

            <ul>
                <li>
                    <a href="http://localhost/lunova/templates/?page=profile" class="nav-link py-3 border-bottom rounded-0" style="margin-right: 8px; height: 10px; margin-block-start: 0px;" title="Customers" data-bs-toggle="tooltip" data-bs-placement="right">
                        <svg class="bi pe-none" width="24" height="24" role="img" aria-label="Customers"><use xlink:href="#people-circle"/></svg>
                    </a>
                </li>
            </ul>
        </div>
    </div>
</nav>
<!-- end header -->

<?php if ($_smarty_tpl->tpl_vars['logged']->value) {?>
    <div id="main" class="container" style="margin-top:80px; height: fit-content">
        <form action="/lunova/AboutUs/us/" method="post">
            <div class="form-group" style="width: 50rem;">
                <fieldset>
                    <label class="form-label mt-4" for="readOnlyInput">Nome</label>
                    <input class="form-control" id="nutente" type="text" placeholder="Nome" readonly="">
                </fieldset>
            </div>

            <div class="form-group"style="width: 50rem;">
                <fieldset>
                    <label class="form-label mt-4" for="readOnlyInput">Cognome</label>
                    <input class="form-control" id="cutente" type="text" placeholder="Nome" readonly="">
                </fieldset>
            </div>

            <div class="form-group" style="width: 50rem;">
                <label for="exampleInputEmail1" class="form-label mt-4">Email address</label>
                <input type="email" class="form-control" id="Email" name="Email" aria-describedby="emailHelp" placeholder="Enter email" required>
                <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
            </div>

            <div class="form-group" style="width: 50rem;">
                <label for="exampleInputPassword1" class="form-label mt-4">Password</label>
                <input type="password" class="form-control" id="Password"  name="Password" placeholder="Password" required>
            </div>

            <div class="form-group"style="width: 50rem;">
                <fieldset>
                    <label class="form-label mt-4" for="readOnlyInput">Telefono</label>
                    <input class="form-control" id="telefono" type="text" placeholder="Nome" readonly="">
                </fieldset>
            </div>

            <div class="form-group"style="width: 50rem;">
                <fieldset>
                    <label class="form-label mt-4" for="readOnlyInput">CAP</label>
                    <input class="form-control" id="CAP" type="text" placeholder="Nome" readonly="">
                </fieldset>
            </div>

            <div class="form-group"style="width: 50rem;">
                <fieldset>
                    <label class="form-label mt-4" for="readOnlyInput">Provincia</label>
                    <input class="form-control" id="provincia" type="text" placeholder="Nome" readonly="">
                </fieldset>
            </div>

            <div class="form-group"style="width: 50rem;">
                <fieldset>
                    <label class="form-label mt-4" for="readOnlyInput">Citt??</label>
                    <input class="form-control" id="citta" type="text" placeholder="Nome" readonly="">
                </fieldset>
            </div>

            <div class="form-group"style="width: 50rem;">
                <fieldset>
                    <label class="form-label mt-4" for="readOnlyInput">N. Civico</label>
                    <input class="form-control" id="civico" type="text" placeholder="Nome" readonly="">
                </fieldset>
            </div>

            <div class="form-group"style="width: 50rem;">
                <fieldset>
                    <label class="form-label mt-4" for="readOnlyInput">Via</label>
                    <input class="form-control" id="via" type="text" placeholder="Nome" readonly="">
                </fieldset>
            </div>
            <hr>
            <div class="form-check">
                <input class="form-check-input" type="radio" name="optionsRadios" id="optionsRadios1" value="option1" checked="">
                <label class="form-check-label" for="optionsRadios1">
                    Artista
                </label>

            </div>
            <div class="form-check">
                <input class="form-check-input" type="radio" name="optionsRadios" id="optionsRadios1" value="option2" checked="">
                <label class="form-check-label" for="optionsRadios1">
                    Utente
                </label>
            </div>
            <hr>
            <button type="submit" class="btn btn-primary">Submit</button>

            <button type="button" class="btn btn-primary">Accedi</button>
            <hr>
            <button type="button" class="btn btn-secondary">Inscriviti</button>
        </form>
    </div>
<?php }?>

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
