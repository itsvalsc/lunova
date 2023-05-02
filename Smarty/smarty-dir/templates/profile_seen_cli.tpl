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
                            <span class="badge rounded-pill bg-secondary"></span>
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
                            <!-- Cover image <div class="h-50px" style="background-image:url(assets/images/bg/01.jpg); background-position: center; background-size: cover; background-repeat: no-repeat;"></div>-->
                            <div class="h-50px" style="background-image:url(assets/images/bg/01.jpg); background-position: center; background-size: cover; background-repeat: no-repeat;"></div>
                            <!-- Card body START -->
                            <div class="card-body pt-0">
                                <div class="text-center">
                                    <!-- Avatar -->
                                    <div class="avatar avatar-lg mt-n5 mb-3">
                                        {if !is_null($cliente->getImmProfilo())}
                                            <a href="#!"><img class="avatar-img rounded border border-white border-3" style="width: 200px;height: 200px" src="data:{$cliente->getImmProfilo()->getFormato()};base64,{$cliente->getImmProfilo()->getImmagine()}" alt=""></a>
                                        {/if}
                                        {if is_null($cliente->getImmProfilo())}
                                            <a href="#!"><img class="avatar-img rounded border border-white border-3" style="width= 200 px; height: 200px;" src="https://static.vecteezy.com/ti/vettori-gratis/p2/2318271-icona-profilo-utente-vettoriale.jpg" alt=""></a>
                                        {/if}
                                    </div>
                                    <!-- Info -->
                                    <h5 class="mb-0"> <a href="#!">{$cliente->getUsername()} </a> </h5>

                                    <p class="mt-3">Info</p>

                                    <!-- User stat START -->
                                    <div class="hstack gap-2 gap-xl-3 justify-content-center">
                                        <!-- User stat item -->
                                        <div>
                                            <h6 class="mb-0">{$tot_nmp}</h6>
                                            <small>Tot. &nbsp Mi Piace</small>
                                        </div>
                                        <!-- Divider -->
                                        <div class="vr"></div>
                                        <!-- User stat item -->
                                        <div>
                                            <h6 class="mb-0">{$numComm}</h6>
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
                                        {foreach from=$votazioni key=k item=i}
                                    <li style="margin-left: 25px">
                                        {$k}
                                        <small style="margin-left: 50px" class="text-warning">
                                            {foreach from=$i item=ix}
                                                <span class="{$ix}"></span>
                                            {/foreach}
                                        </small>
                                    </li>
                                    {/foreach}
                                        <hr>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="#"> <span>Commenti</span></a>
                                        {section name= c loop=$commenti}
                                            
                                    <div class="ms-2">
                                    <div class="bg-dark rounded-start-top-0 p-3 rounded bg-opacity-75" style="margin-bottom: 5px">
                                        <div class="d-flex justify-content-between" >
                                            <h6 class="mb-1" ><span style="opacity: 0.7">Disco:</span> <a href="/lunova/Products_list/mostra_prodotto/{$commenti[c]->getIdDisco()}"> {$nome_dischi[$commenti[c]->getId()]|default:"Errore, disco non trovato"}</a></h6>
                                            <small class="ms-2">{$commenti[c]->getData()}</small>
                                        </div>
                                        <p class="small mb-0" style="margin-top: 10px">{$commenti[c]->getDescrizione()}</p>
                                        <div class="d-flex justify-content-between" >
                                            <p></p>
                                            <p class="small mb-0 muted" style="opacity: 0.6;margin-top: 5px">Like ({$nmp[$commenti[c]->getId()]|default:0})</p>
                                        </div>
                                    </div>

                                </div>
                                        {/section}
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

<script src="https://bootswatch.com/_vendor/jquery/dist/jquery.min.js"></script>
<script src="https://bootswatch.com/_vendor/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://bootswatch.com/_vendor/prismjs/prism.js"></script>

<!--<script src="<?php //echo ROOT_URL; ?>assets/js/main.js"></script>-->
</body>
</html>