<?php
/* Smarty version 4.2.1, created on 2022-12-12 20:29:30
  from 'C:\xampp\htdocs\lunova\Smarty\smarty-dir\templates\profile.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.2.1',
  'unifunc' => 'content_6397811ae19cd5_46426657',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'b487c8adcc07d632830ee16e790b1c6bfbdd0f26' => 
    array (
      0 => 'C:\\xampp\\htdocs\\lunova\\Smarty\\smarty-dir\\templates\\profile.tpl',
      1 => 1670873368,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_6397811ae19cd5_46426657 (Smarty_Internal_Template $_smarty_tpl) {
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
                                        <a href="#"><img class="avatar-img rounded border border-white border-3" style="width: 80 px; height: 80px;"src="data:image/jpeg;base64,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" alt="avatar"></a>
                                    </div>
                                    <!-- Info -->
                                    <h5 class="mb-0"> <a href="#!">Sam Lanson </a> </h5>

                                    <p class="mt-3">Info</p>

                                    <!-- User stat START -->
                                    <div class="hstack gap-2 gap-xl-3 justify-content-center">
                                        <!-- User stat item -->
                                        <div>
                                            <h6 class="mb-0">256</h6>
                                            <small>N. Dischi</small>
                                        </div>
                                        <!-- Divider -->
                                        <div class="vr"></div>
                                        <!-- User stat item -->
                                        <div>
                                            <h6 class="mb-0">2.5K</h6>
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
                                    <li class="nav-item">
                                        <a class="nav-link" href="my-profile.html"> <img class="me-2 h-20px fa-fw" src="assets/images/icon/home-outline-filled.svg" alt=""><span>Feed </span></a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="my-profile-connections.html"> <img class="me-2 h-20px fa-fw" src="assets/images/icon/person-outline-filled.svg" alt=""><span>Connections </span></a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="blog.html"> <img class="me-2 h-20px fa-fw" src="assets/images/icon/earth-outline-filled.svg" alt=""><span>Latest News </span></a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="events.html"> <img class="me-2 h-20px fa-fw" src="assets/images/icon/calendar-outline-filled.svg" alt=""><span>Events </span></a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="groups.html"> <img class="me-2 h-20px fa-fw" src="assets/images/icon/chat-outline-filled.svg" alt=""><span>Groups </span></a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="notifications.html"> <img class="me-2 h-20px fa-fw" src="assets/images/icon/notification-outlined-filled.svg" alt=""><span>Notifications </span></a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="settings.html"> <img class="me-2 h-20px fa-fw" src="assets/images/icon/cog-outline-filled.svg" alt=""><span>Settings </span></a>
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
