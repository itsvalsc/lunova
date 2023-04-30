<?php
/* Smarty version 4.2.1, created on 2023-04-26 19:30:49
  from 'C:\xampp\htdocs\lunova\Smarty\smarty-dir\templates\products_list.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.2.1',
  'unifunc' => 'content_64495fc9a71758_38787133',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'a7c38a561fb0a82c279cdd66974544b2714058ab' => 
    array (
      0 => 'C:\\xampp\\htdocs\\lunova\\Smarty\\smarty-dir\\templates\\products_list.tpl',
      1 => 1682530246,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_64495fc9a71758_38787133 (Smarty_Internal_Template $_smarty_tpl) {
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


            <?php if ($_smarty_tpl->tpl_vars['logged']->value && $_smarty_tpl->tpl_vars['isCliente']->value) {?>
                <ul class="navbar-nav ml-4">
                    <li class="nav-item">
                        <a class="nav-link" href="/lunova/Carrello/mio_carrello">
                            <i class="fas fa-shopping-cart"></i>
                            <span class="badge rounded-pill bg-secondary"><?php echo $_smarty_tpl->tpl_vars['num']->value;?>
</span>
                        </a>
                    </li>
                </ul>
            <?php }?>


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

<div id="main" class="container" style="margin-top:40px; height: fit-content">

    <h5 ><label>UTILIZZA I FILTRI PER UN RICERCA PIU VELOCE</label></h5 >
    <div>
        <div style="display: inline-block">
            <form class="d-flex" style="margin-bottom:40px" action="/lunova/RicercaDisco/ricerca" method="post">

                <select class="btn btn-secondary my-2 my-sm-0" name="filtro" id="filtro" style="margin-right:5px;width: 200px">
                    <option value="disco">NOME DISCO</option>
                    <option value="artista">ARTISTA</option>
                </select>
                <input style="width: 400px" id="test" class="form-control me-sm-2" type="text" name="search" placeholder="Search"></input>
                <button class="btn btn-secondary my-2 my-sm-0" type="submit">Search</button>
            </form>
        </div>

        <div class="dropdown" style="display: inline-block;margin-left: 100px">
            <a class="btn btn-secondary dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-bs-toggle="dropdown" aria-expanded="false"> GENERI </a>
            <ul class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                <?php
$__section_ng_0_loop = (is_array(@$_loop=$_smarty_tpl->tpl_vars['generi']->value) ? count($_loop) : max(0, (int) $_loop));
$__section_ng_0_total = $__section_ng_0_loop;
$_smarty_tpl->tpl_vars['__smarty_section_ng'] = new Smarty_Variable(array());
if ($__section_ng_0_total !== 0) {
for ($__section_ng_0_iteration = 1, $_smarty_tpl->tpl_vars['__smarty_section_ng']->value['index'] = 0; $__section_ng_0_iteration <= $__section_ng_0_total; $__section_ng_0_iteration++, $_smarty_tpl->tpl_vars['__smarty_section_ng']->value['index']++){
?>
                    <li><a class="dropdown-item" href="/lunova/RicercaDisco/ricerca/<?php echo $_smarty_tpl->tpl_vars['generi']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_ng']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_ng']->value['index'] : null)];?>
"><?php echo $_smarty_tpl->tpl_vars['generi']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_ng']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_ng']->value['index'] : null)];?>
</a></li>
                <?php
}
}
?>
            </ul>
        </div>
    </div>
        <!--
    <form class="d-flex" style="margin-bottom:40px" action="/lunova/RicercaDisco/ricerca" method="post">

        <select class="btn btn-secondary my-2 my-sm-0" name="filtro" id="filtro" style="margin-right:5px;width: 200px">
            <option value="disco">GENERI</option>
            <option value="artista">ARTISTA</option>
        </select>
        <button class="btn btn-secondary my-2 my-sm-0" type="submit">Search</button>
    </form>-->





    <div class ='row'>
         <label style="margin-bottom: 15px;text-align: center;font-size: xx-large" >LISTA DEGLI ARTICOLI IN VENDITA</label>

        <?php
$__section_nr_1_loop = (is_array(@$_loop=$_smarty_tpl->tpl_vars['product']->value) ? count($_loop) : max(0, (int) $_loop));
$__section_nr_1_total = $__section_nr_1_loop;
$_smarty_tpl->tpl_vars['__smarty_section_nr'] = new Smarty_Variable(array());
if ($__section_nr_1_total !== 0) {
for ($__section_nr_1_iteration = 1, $_smarty_tpl->tpl_vars['__smarty_section_nr']->value['index'] = 0; $__section_nr_1_iteration <= $__section_nr_1_total; $__section_nr_1_iteration++, $_smarty_tpl->tpl_vars['__smarty_section_nr']->value['index']++){
?>

            <div class="card border-dark mb-3 bg-dark" style="width: 18rem;">
                <img style = "width: 250px; height: 250px;" src="data:<?php echo $_smarty_tpl->tpl_vars['product']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_nr']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_nr']->value['index'] : null)]->getCopertina()->getFormato();?>
;base64,<?php echo $_smarty_tpl->tpl_vars['product']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_nr']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_nr']->value['index'] : null)]->getCopertina()->getImmagine();?>
" alt="prova">
                <div class="card-body" >
                    <h5 class="card-title"> <?php echo $_smarty_tpl->tpl_vars['product']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_nr']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_nr']->value['index'] : null)]->getTitolo();?>
 </h5>
                    <h6 class = "card-subtitle mb-2 text-muted">€ <?php echo $_smarty_tpl->tpl_vars['product']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_nr']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_nr']->value['index'] : null)]->getPrezzo();?>
</h6>
                    <p class="card-text">
                        <?php echo $_smarty_tpl->tpl_vars['product']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_nr']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_nr']->value['index'] : null)]->getDescrtaglio();?>

                    </p>
                    <!--<button class="btn btn-secondary btn-sm btn-block rounded-0" onclick="location.href='<?php echo '<?php'; ?>
 //echo ROOT_URL . '?page=view-product&id=' . esc_html($product->getID()); <?php echo '?>'; ?>
'">Vedi</button>-->
                    <a href="/lunova/Products_list/mostra_prodotto/<?php echo $_smarty_tpl->tpl_vars['product']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_nr']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_nr']->value['index'] : null)]->getID();?>
">
                        <button class="btn btn-secondary btn-sm btn-block rounded-0" type="submit" >Vedi</button></a>



                    <?php if ($_smarty_tpl->tpl_vars['product']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_nr']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_nr']->value['index'] : null)]->getQta() != 0) {?>
                        <a href="/lunova/Carrello/Add/<?php echo $_smarty_tpl->tpl_vars['product']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_nr']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_nr']->value['index'] : null)]->getID();?>
">
                            <button class="btn btn-primary btn-sm btn-block rounded-0" type="submit" >Aggiungi al carrello</button>
                        </a>
                    <?php }?>
                    <?php if ($_smarty_tpl->tpl_vars['product']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_nr']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_nr']->value['index'] : null)]->getQta() == 0) {?>
                            <button class="btn btn-primary btn-sm btn-block rounded-0 disabled">Aggiungi al carrello</button>

                    <?php }?>

                </div>
            </div>
    <?php
}
}
?>

</div>
</div>
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
</html>
<?php }
}
