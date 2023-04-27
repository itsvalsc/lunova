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
        <a class="navbar-brand" href="/lunova/">Lunova</a>
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



            {if $logged && $isCliente}
                <ul class="navbar-nav ml-4">
                    <li class="nav-item">
                        <a class="nav-link" href="/lunova/Carrello/mio_carrello">
                            <i class="fas fa-shopping-cart"></i>
                            <span class="badge rounded-pill bg-secondary">{$num}</span>
                        </a>
                    </li>
                </ul>
            {/if}



            <form class="d-flex" style="margin-block-end: 2px;" action="/lunova/Profile/ricercaUtente" method="post">
                <input class="form-control me-sm-2" type="text" name="search" placeholder="Cerca Utenti o Artisti" required>
                <button class="btn btn-secondary my-2 my-sm-0" type="submit">Cerca</button>
            </form>

            <ul class="navbar-nav ml-4">
                {if $logged}
                    <li class="nav-item">

                        <a class="nav-link" style="align-items: center " href="/lunova/Profile/users">
                            <i class="fa-solid fa-circle-user" style="font-size:24px;"></i>
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
                                        {if !is_null($artista->getImmProfilo())}
                                            <a href="#!"><img class="avatar-img rounded border border-white border-3" style="width: 200px;height: 200px" src="data:{$artista->getImmProfilo()->getFormato()};base64,{$artista->getImmProfilo()->getImmagine()}" alt=""></a>
                                        {/if}
                                        {if is_null($artista->getImmProfilo())}
                                            <a href="#!"><img class="avatar-img rounded border border-white border-3" style="width= 200 px; height: 200px;" src="../../Utility/img/icona_profilo_utente.jpg" alt=""></a>
                                        {/if}
                                    </div>
                                    <!-- Info -->
                                    <h5 class="mb-0"> <a href="#!">{$artista->getUsername()} </a> </h5>

                                    <p class="mt-3">Info</p>

                                    <!-- User stat START -->
                                    <div class="hstack gap-2 gap-xl-3 justify-content-center">
                                        <!-- User stat item -->
                                        <div>
                                            <h6 class="mb-0">{$numero}</h6>
                                            <small>N. Dischi</small>
                                        </div>
                                        <!-- Divider -->
                                        <div class="vr"></div>
                                        <!-- User stat item -->
                                        <div>
                                            <h6 class="mb-0">{$numComm}</h6>
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
                                            <script>
                                                var p;
                                            </script>
                                            {section name = nr loop= $product}


                                            <div class="card border-dark mb-3 bg-dark" style="width: 18rem;">
                                                <img style = "width: 250px; height: 250px;" src="data:{$product[nr]->getCopertina()->getFormato()};base64,{$product[nr]->getCopertina()->getImmagine()}" alt="prova">
                                                <div class="card-body" >
                                                    <h5 class="card-title"> {$product[nr]->getTitolo()} </h5>
                                                    <h6 class = "card-subtitle mb-2 text-muted">€ {$product[nr]->getPrezzo()}</h6>
                                                    <p class="card-text">
                                                        {$product[nr]->getDescrtaglio()}
                                                    </p>
                                                    <!--<button class="btn btn-secondary btn-sm btn-block rounded-0" onclick="location.href='<?php //echo ROOT_URL . '?page=view-product&id=' . esc_html($product->getID()); ?>'">Vedi</button>-->
                                                    <a href="/lunova/Products_list/mostra_prodotto/{$product[nr]->getID()}">
                                                        <button class="btn btn-secondary btn-sm btn-block rounded-0" type="submit" >Vedi</button></a>



                                                    {if $product[nr]->getQta() != 0 }
                                                        <a href="/lunova/Carrello/Add/{$product[nr]->getID()}">
                                                            <button class="btn btn-primary btn-sm btn-block rounded-0" type="submit" >Aggiungi al carrello</button>
                                                        </a>
                                                    {/if}
                                                    {if $product[nr]->getQta() == 0 }
                                                        <button class="btn btn-primary btn-sm btn-block rounded-0 disabled">Aggiungi al carrello</button>

                                                    {/if}

                                                </div>
                                            </div>
                                            {/section}

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

<script src="https://bootswatch.com/_vendor/jquery/dist/jquery.min.js"></script>
<script src="https://bootswatch.com/_vendor/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://bootswatch.com/_vendor/prismjs/prism.js"></script>

<!--<script src="<?php //echo ROOT_URL; ?>assets/js/main.js"></script>-->
</body>
</html>