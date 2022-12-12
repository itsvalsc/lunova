<?php
/* Smarty version 4.2.1, created on 2022-12-10 02:29:59
  from 'C:\xampp\htdocs\lunova\Smarty\smarty-dir\templates\addisco.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.2.1',
  'unifunc' => 'content_6393e1172c9820_69919759',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '60066c2c891b6640edafb91485464804a328437e' => 
    array (
      0 => 'C:\\xampp\\htdocs\\lunova\\Smarty\\smarty-dir\\templates\\addisco.tpl',
      1 => 1670635797,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_6393e1172c9820_69919759 (Smarty_Internal_Template $_smarty_tpl) {
?><!DOCTYPE html>
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



<div id="main" class="container" style="margin-top:80px; height: fit-content">
    <form action="/lunova/AboutUs/us/" method="post">
        <div class="form-group">
            <fieldset>
                <label class="form-label mt-4" for="readOnlyInput">Nome disco</label>
                <input class="form-control" id="ndisco" type="text" placeholder="Nome" readonly="">
            </fieldset>
        </div>
        <div class="form-group">
            <label for="exampleTextarea" class="form-label mt-4">Descrizione</label>
            <textarea class="form-control" id="descrizione" rows="3"></textarea>
        </div>

        <div class="form-group">
            <label for="exampleSelect1" class="form-label mt-4">Genere</label>
            <select class="form-select" id="genere">
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
            <input class="form-control" type="file" id="copertina">
        </div>


        <div class="form-group">
            <label class="form-label mt-4">Prezzo</label>
            <div class="form-group">
                <div class="input-group mb-3">
                    <span class="input-group-text">$</span>
                    <input type="text" class="form-control" aria-label="Prezzo">
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
