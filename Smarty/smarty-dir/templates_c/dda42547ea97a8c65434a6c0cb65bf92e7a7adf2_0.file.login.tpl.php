<?php
/* Smarty version 4.2.1, created on 2023-02-11 14:21:47
  from 'C:\xampp\htdocs\lunova\Smarty\smarty-dir\templates\login.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.2.1',
  'unifunc' => 'content_63e7966b472a85_41155507',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'dda42547ea97a8c65434a6c0cb65bf92e7a7adf2' => 
    array (
      0 => 'C:\\xampp\\htdocs\\lunova\\Smarty\\smarty-dir\\templates\\login.tpl',
      1 => 1676121705,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_63e7966b472a85_41155507 (Smarty_Internal_Template $_smarty_tpl) {
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



            <ul class="navbar-nav ml-4">
                <li class="nav-item">
                    <a class="nav-link" href="/lunova/Carrello/mio_carrello">
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
                <?php if ($_smarty_tpl->tpl_vars['logged']->value) {?>
                    <li class="nav-item">

                        <a class="nav-link" style="align-items: center " href="/lunova/Carrello/mio_carrello">
                            <i class="fa-solid fa-circle-user" style="font-size:24px;"></i>
                            <span class="badge rounded-pill bg-secondary">2</span>
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

<?php if ($_smarty_tpl->tpl_vars['logged']->value == false) {?>
<div id="main" class="container" style="margin-top:80px; height: fit-content">
    <form action="/lunova/Login/verificaLogin" method="post">
        <div class="form-group" style="width: 30rem;">
            <label for="exampleInputEmail1" class="form-label mt-4">Email address</label>
            <input type="email" class="form-control" id="Email" name="Email" aria-describedby="emailHelp" placeholder="Enter email" required>
            <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
        </div>

        <div class="form-group" style="width: 30rem;">
            <label for="exampleInputPassword1" class="form-label mt-4">Password</label>
            <input type="password" class="form-control" id="Password"  name="Password" placeholder="Password" required>
        </div>
        <hr>
        <div class="form-check">
            <input class="form-check-input" type="checkbox" name="type" id="type" value="artista">
            <label class="form-check-label" for="type">
                Seleziona se sei un Artista
            </label>

        </div>

        <hr>
        <button type="submit" class="btn btn-primary">Accedi</button>

        <hr>
        <h6>Se non sei ancora inscritto...</h6>
        <a href="/lunova/Login/Signin">
            <button type="button" class="btn btn-secondary">Inscriviti</button>
        </a>

    </form>
</div>
<?php }?>

<div id="main" class="container" style="margin-top:100px; height: fit-content">
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
