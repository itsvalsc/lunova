<?php
/* Smarty version 4.2.1, created on 2023-04-29 19:59:22
  from 'C:\xampp\htdocs\lunova\Smarty\smarty-dir\templates\profile_seen_art.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.2.1',
  'unifunc' => 'content_644d5afa94eb10_23525366',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '807b624fe00f8b5362b5d5cb45de35bae7487665' => 
    array (
      0 => 'C:\\xampp\\htdocs\\lunova\\Smarty\\smarty-dir\\templates\\profile_seen_art.tpl',
      1 => 1682787610,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_644d5afa94eb10_23525366 (Smarty_Internal_Template $_smarty_tpl) {
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
<div class="container">
    <div class="row g-4">

        <!-- Sidenav START -->
        <div class="col-12">

            <!-- Advanced filter responsive toggler START -->
            <div class="d-flex align-items-center d-lg-none" ">
                <button class="border-0 bg-transparent"  type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasSideNavbar" aria-controls="offcanvasSideNavbar">
                    <i class="btn btn-primary fw-bold fa-solid fa-sliders-h" ></i>
                    <span class="h6 mb-0 fw-bold d-lg-none ms-2" >My profile</span>
                </button>
            </div>
            <!-- Advanced filter responsive toggler END -->

            <!-- Navbar START-->
            <nav class="navbar navbar-expand-lg mx-0">
                <div class="offcanvas offcanvas-start" tabindex="-1" id="offcanvasSideNavbar">
                    <!-- Offcanvas header -->
                    <div class="offcanvas-header">
                        <button type="button" class="btn-close text-reset ms-auto" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                    </div>

                    <!-- Offcanvas body -->
                    <div class="offcanvas-body d-block px-2 px-lg-0">
                        <!-- Card START -->
                        <div class="card overflow-hidden">
                            <!-- Card body START -->
                            <div class="card-body pt-0">
                                <div class="text-center">
                                    <!-- Avatar -->
                                    <div class="avatar avatar-lg mt-n5 mb-3">
                                        <?php if (!is_null($_smarty_tpl->tpl_vars['artista']->value->getImmProfilo())) {?>
                                            <a href="#!"><img class="avatar-img rounded border border-white border-3" style="width: 200px;height: 200px" src="data:<?php echo $_smarty_tpl->tpl_vars['artista']->value->getImmProfilo()->getFormato();?>
;base64,<?php echo $_smarty_tpl->tpl_vars['artista']->value->getImmProfilo()->getImmagine();?>
" alt=""></a>
                                        <?php }?>
                                        <?php if (is_null($_smarty_tpl->tpl_vars['artista']->value->getImmProfilo())) {?>
                                            <a href="#!"><img class="avatar-img rounded border border-white border-2" style="width= 200 px; height: 200px;" src="https://st2.depositphotos.com/50337402/47081/v/450/depositphotos_470817490-stock-illustration-black-male-user-symbol-blue.jpg" alt=""></a>
                                        <?php }?>
                                    </div>
                                    <!-- Info -->
                                    <h5 class="mb-0"> <a href="#!"><?php echo $_smarty_tpl->tpl_vars['artista']->value->getUsername();?>
 </a> </h5>

                                    <p class="mt-3">Info</p>

                                    <!-- User stat START -->
                                    <div class="hstack gap-2 gap-xl-3 justify-content-center">
                                        <!-- User stat item -->
                                        <div>
                                            <h6 class="mb-0"><?php echo $_smarty_tpl->tpl_vars['numero']->value;?>
</h6>
                                            <small>N. Dischi</small>
                                        </div>
                                        <!-- Divider -->
                                        <div class="vr"></div>
                                        <!-- User stat item -->
                                        <div>
                                            <h6 class="mb-0"><?php echo $_smarty_tpl->tpl_vars['numComm']->value;?>
</h6>
                                            <small>Commenti</small>
                                        </div>
                                        <!-- Divider -->
                                        <!--<div class="vr"></div>-->
                                        <!-- User stat item -->
                                        <!--<div>-->
                                        <!--    <h6 class="mb-0">365</h6>-->
                                        <!--    <small>Following</small>-->
                                        <!--</div>-->
                                    </div>
                                    <!-- User stat END -->
                                </div>

                                <!-- Divider -->
                                <hr>

                                <!-- Side Nav START -->
                                <ul class="nav nav-link-secondary flex-column fw-bold gap-2">
                                    <!--
                                    <li class="nav-item">
                                        <a class="nav-link" href="my-profile.html"> <img class="me-2 h-20px fa-fw" src="assets/images/icon/home-outline-filled.svg" alt=""><span>Feed </span></a>
                                        <hr>
                                    </li>
                                    -->
                                    <li class="nav-item">
                                        <div class ='row'>
                                            <a class="nav-link" href=""> <img class="me-2 h-20px fa-fw" src="" alt=""><span>Dischi </span></a>
                                            <?php echo '<script'; ?>
>
                                                var p;
                                            <?php echo '</script'; ?>
>
                                            <?php
$__section_nr_0_loop = (is_array(@$_loop=$_smarty_tpl->tpl_vars['product']->value) ? count($_loop) : max(0, (int) $_loop));
$__section_nr_0_total = $__section_nr_0_loop;
$_smarty_tpl->tpl_vars['__smarty_section_nr'] = new Smarty_Variable(array());
if ($__section_nr_0_total !== 0) {
for ($__section_nr_0_iteration = 1, $_smarty_tpl->tpl_vars['__smarty_section_nr']->value['index'] = 0; $__section_nr_0_iteration <= $__section_nr_0_total; $__section_nr_0_iteration++, $_smarty_tpl->tpl_vars['__smarty_section_nr']->value['index']++){
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



                                                    <?php if ($_smarty_tpl->tpl_vars['logged']->value && $_smarty_tpl->tpl_vars['isCliente']->value) {?>
                                                        <?php if ($_smarty_tpl->tpl_vars['product']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_nr']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_nr']->value['index'] : null)]->getQta() != 0) {?>
                                                            <a href="/lunova/Carrello/Add/<?php echo $_smarty_tpl->tpl_vars['product']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_nr']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_nr']->value['index'] : null)]->getID();?>
">
                                                                <button class="btn btn-primary btn-sm btn-block rounded-0" type="submit" >Aggiungi al carrello</button>
                                                            </a>
                                                        <?php }?>
                                                        <?php if ($_smarty_tpl->tpl_vars['product']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_nr']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_nr']->value['index'] : null)]->getQta() == 0) {?>
                                                            <button class="btn btn-primary btn-sm btn-block rounded-0 disabled">Aggiungi al carrello</button>
                                                        <?php }?>
                                                    <?php } elseif ($_smarty_tpl->tpl_vars['logged']->value == false) {?>
                                                        <button class="btn btn-primary btn-sm btn-block rounded-0" type="submit" disabled>Aggiungi al carrello</button>
                                                    <?php }?>

                                                </div>
                                            </div>
                                            <?php
}
}
?>

                                        </div>
                                        <hr>
                                    </li>

                                </ul>
                                <!-- Side Nav END -->
                            </div>
                        </div>
                    </div>
                </div>
            </nav>

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
</html><?php }
}
