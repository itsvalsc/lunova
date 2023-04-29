<?php
/* Smarty version 4.2.1, created on 2023-04-29 19:50:02
  from 'C:\xampp\htdocs\lunova\Smarty\smarty-dir\templates\addisco.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.2.1',
  'unifunc' => 'content_644d58ca29d218_04368021',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '60066c2c891b6640edafb91485464804a328437e' => 
    array (
      0 => 'C:\\xampp\\htdocs\\lunova\\Smarty\\smarty-dir\\templates\\addisco.tpl',
      1 => 1682787610,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_644d58ca29d218_04368021 (Smarty_Internal_Template $_smarty_tpl) {
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
                            <span class="badge rounded-pill bg-secondary"></span>
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
    <form action="/lunova/Products_list/aggiungi_disco" method="post" enctype="multipart/form-data">
        <div class="form-group">
            <fieldset>
                <label class="form-label mt-4" for="readOnlyInput">Nome disco</label>
                <input class="form-control" name="ndisco" id="ndisco" type="text" placeholder="Nome" required>
            </fieldset>
        </div>
        <div class="form-group">
            <label for="exampleTextarea" class="form-label mt-4">Descrizione</label>
            <textarea class="form-control" name="descrizione" id="descrizione" rows="3" placeholder="Scrivi qui la tua descrizione..." required></textarea>
        </div>

        <div class="form-group">
            <label for="exampleSelect1" class="form-label mt-4">Genere</label>
            <select class="form-select" name="genere" id="genere" required>
                <?php
$__section_gn_0_loop = (is_array(@$_loop=$_smarty_tpl->tpl_vars['gen']->value) ? count($_loop) : max(0, (int) $_loop));
$__section_gn_0_total = $__section_gn_0_loop;
$_smarty_tpl->tpl_vars['__smarty_section_gn'] = new Smarty_Variable(array());
if ($__section_gn_0_total !== 0) {
for ($__section_gn_0_iteration = 1, $_smarty_tpl->tpl_vars['__smarty_section_gn']->value['index'] = 0; $__section_gn_0_iteration <= $__section_gn_0_total; $__section_gn_0_iteration++, $_smarty_tpl->tpl_vars['__smarty_section_gn']->value['index']++){
?>
                    <option><?php echo $_smarty_tpl->tpl_vars['gen']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_gn']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_gn']->value['index'] : null)];?>
</option>
                <?php
}
}
?>
            </select>
        </div>

        <div class="form-group">
            <label for="formFile" class="form-label mt-4">Scegli una copertina</label>
            <input class="form-control" name="copertina" type="file" id="copertina" accept="image/png, image/jpeg" required>
        </div>


        <div class="form-group">
            <label class="form-label mt-4">Prezzo</label>
            <div class="form-group">
                <div class="input-group mb-3">
                    <span class="input-group-text">€</span>
                    <input type="" class="form-control" name="prezzo" aria-label="Prezzo" required required>
                    <span class="input-group-text"></span>
                </div>
            </div>
        </div>


        <div class="form-group">
            <label class="form-label mt-4">Quantita</label>
            <div class="form-group">
                <div class="input-group mb-3">
                    <input type="number" class="form-control" name="quantita" aria-label="Quantita" required datatype="number">
                    <span class="input-group-text"></span>
                </div>
            </div>
        </div>

        <button type="submit" class="btn btn-secondary">Aggiungi</button>
    </form>
</div>


<div id="main" class="container" style="margin-top:100px; height: fit-content">
</div>

<!-- footer -->
<footer class="bg-dark" style ="margin-bottom: 0px;">
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
