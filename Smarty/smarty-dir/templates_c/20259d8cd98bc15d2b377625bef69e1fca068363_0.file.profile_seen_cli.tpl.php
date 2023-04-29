<?php
/* Smarty version 4.2.1, created on 2023-04-29 20:00:20
  from 'C:\xampp\htdocs\lunova\Smarty\smarty-dir\templates\profile_seen_cli.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.2.1',
  'unifunc' => 'content_644d5b34083534_98908508',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '20259d8cd98bc15d2b377625bef69e1fca068363' => 
    array (
      0 => 'C:\\xampp\\htdocs\\lunova\\Smarty\\smarty-dir\\templates\\profile_seen_cli.tpl',
      1 => 1682787610,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_644d5b34083534_98908508 (Smarty_Internal_Template $_smarty_tpl) {
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
                            <!-- Cover image <div class="h-50px" style="background-image:url(assets/images/bg/01.jpg); background-position: center; background-size: cover; background-repeat: no-repeat;"></div>-->
                            <div class="h-50px" style="background-image:url(assets/images/bg/01.jpg); background-position: center; background-size: cover; background-repeat: no-repeat;"></div>
                            <!-- Card body START -->
                            <div class="card-body pt-0">
                                <div class="text-center">
                                    <!-- Avatar -->
                                    <div class="avatar avatar-lg mt-n5 mb-3">
                                        <?php if (!is_null($_smarty_tpl->tpl_vars['cliente']->value->getImmProfilo())) {?>
                                            <a href="#!"><img class="avatar-img rounded border border-white border-3" style="width: 200px;height: 200px" src="data:<?php echo $_smarty_tpl->tpl_vars['cliente']->value->getImmProfilo()->getFormato();?>
;base64,<?php echo $_smarty_tpl->tpl_vars['cliente']->value->getImmProfilo()->getImmagine();?>
" alt=""></a>
                                        <?php }?>
                                        <?php if (is_null($_smarty_tpl->tpl_vars['cliente']->value->getImmProfilo())) {?>
                                            <a href="#!"><img class="avatar-img rounded border border-white border-3" style="width= 200 px; height: 200px;" src="https://static.vecteezy.com/ti/vettori-gratis/p2/2318271-icona-profilo-utente-vettoriale.jpg" alt=""></a>
                                        <?php }?>
                                    </div>
                                    <!-- Info -->
                                    <h5 class="mb-0"> <a href="#!"><?php echo $_smarty_tpl->tpl_vars['cliente']->value->getUsername();?>
 </a> </h5>

                                    <p class="mt-3">Info</p>

                                    <!-- User stat START -->
                                    <div class="hstack gap-2 gap-xl-3 justify-content-center">
                                        <!-- User stat item -->
                                        <div>
                                            <h6 class="mb-0"><?php echo $_smarty_tpl->tpl_vars['tot_nmp']->value;?>
</h6>
                                            <small>Tot. &nbsp Mi Piace</small>
                                        </div>
                                        <!-- Divider -->
                                        <div class="vr"></div>
                                        <!-- User stat item -->
                                        <div>
                                            <h6 class="mb-0"><?php echo $_smarty_tpl->tpl_vars['numComm']->value;?>
</h6>
                                            <small>Commenti</small>
                                        </div>

                                    </div>
                                    <!-- User stat END -->
                                </div>

                                <!-- Divider -->
                                <hr>

                                <!-- Side Nav START -->
                                <div class="nav nav-link-secondary flex-column fw-bold gap-2">
                                    <li class="nav-item">
                                        <a class="nav-link" href="#"> <i class="fa-solid fa-album-circle-plus"></i><span>Votazioni </span></a>
                                        <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['votazioni']->value, 'i', false, 'k');
$_smarty_tpl->tpl_vars['i']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['k']->value => $_smarty_tpl->tpl_vars['i']->value) {
$_smarty_tpl->tpl_vars['i']->do_else = false;
?>
                                    <li style="margin-left: 25px">
                                        <?php echo $_smarty_tpl->tpl_vars['k']->value;?>

                                        <small style="margin-left: 50px" class="text-warning">
                                            <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['i']->value, 'ix');
$_smarty_tpl->tpl_vars['ix']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['ix']->value) {
$_smarty_tpl->tpl_vars['ix']->do_else = false;
?>
                                                <span class="<?php echo $_smarty_tpl->tpl_vars['ix']->value;?>
"></span>
                                            <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
                                        </small>
                                    </li>
                                    <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
                                        <hr>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="#"> <span>Commenti</span></a>
                                        <?php
$__section_c_0_loop = (is_array(@$_loop=$_smarty_tpl->tpl_vars['commenti']->value) ? count($_loop) : max(0, (int) $_loop));
$__section_c_0_total = $__section_c_0_loop;
$_smarty_tpl->tpl_vars['__smarty_section_c'] = new Smarty_Variable(array());
if ($__section_c_0_total !== 0) {
for ($__section_c_0_iteration = 1, $_smarty_tpl->tpl_vars['__smarty_section_c']->value['index'] = 0; $__section_c_0_iteration <= $__section_c_0_total; $__section_c_0_iteration++, $_smarty_tpl->tpl_vars['__smarty_section_c']->value['index']++){
?>
                                            
                                    <div class="ms-2">
                                    <div class="bg-dark rounded-start-top-0 p-3 rounded bg-opacity-75" style="margin-bottom: 5px">
                                        <div class="d-flex justify-content-between" >
                                            <h6 class="mb-1" ><span style="opacity: 0.7">Disco:</span> <a href="/lunova/Products_list/mostra_prodotto/<?php echo $_smarty_tpl->tpl_vars['commenti']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_c']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_c']->value['index'] : null)]->getIdDisco();?>
"> <?php echo (($tmp = $_smarty_tpl->tpl_vars['nome_dischi']->value[$_smarty_tpl->tpl_vars['commenti']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_c']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_c']->value['index'] : null)]->getId()] ?? null)===null||$tmp==='' ? "Errore, disco non trovato" ?? null : $tmp);?>
</a></h6>
                                            <small class="ms-2"><?php echo $_smarty_tpl->tpl_vars['commenti']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_c']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_c']->value['index'] : null)]->getData();?>
</small>
                                        </div>
                                        <p class="small mb-0" style="margin-top: 10px"><?php echo $_smarty_tpl->tpl_vars['commenti']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_c']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_c']->value['index'] : null)]->getDescrizione();?>
</p>
                                        <div class="d-flex justify-content-between" >
                                            <p></p>
                                            <p class="small mb-0 muted" style="opacity: 0.6;margin-top: 5px">Like (<?php echo (($tmp = $_smarty_tpl->tpl_vars['nmp']->value[$_smarty_tpl->tpl_vars['commenti']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_c']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_c']->value['index'] : null)]->getId()] ?? null)===null||$tmp==='' ? 0 ?? null : $tmp);?>
)</p>
                                        </div>
                                    </div>

                                </div>
                                        <?php
}
}
?>
                                        <hr>
                                    </li>
                                </ul>
                                <!-- Side Nav END -->
                            </div>

                        </div>
                        <!-- Card END -->


                    </div>
                </div>
            </nav>
            <!-- Navbar END-->
        </div>
        <!-- Sidenav END -->
    </div>
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
