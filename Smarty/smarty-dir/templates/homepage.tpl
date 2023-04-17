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


            {if $logged}
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

                        <a class="nav-link" style="align-items: center " href="/lunova/Profile/users/{$idUtente}">
                            <i class="fa-solid fa-circle-user" style="font-size:24px;"></i>
                            <span class="badge rounded-pill bg-secondary">profilo</span>
                        </a>

                    </li>
                    <a class="nav-link" style="align-items: center " href="/lunova/Login/logout">
                    <button >Logout</button> </a>


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
    <h1>Benvenuto </h1>

    {if $logged}
        {$var}
    {/if}

    <!--<p class="lead">Benvenuti nel sito!</p>-->
    <p class="lead">Clicca sul bottone per iniziare gli acquisti.</p>
    <!--<a href="/lunova/Products_list/elenco_dischi" class="btn btn-primary btn-lg mb-5 mt-3">Vai allo Shopping &raquo;</a>-->
    <a href="/lunova/Products_list/elenco_dischi" class="btn btn-primary btn-lg mb-5 mt-3">Vai allo Shopping &raquo;</a>

    <div id="carouselExampleCaptions" class="carousel slide" data-bs-ride="false">
        <div class="carousel-indicators">
            <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
            <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="1" aria-label="Slide 2"></button>
            <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="2" aria-label="Slide 3"></button>
        </div>
        <div class="carousel-inner">
            <div class="carousel-item active">
                <img src="https://www.rockambula.com/wp-content/uploads/2020/02/dischi-in-uscita-rockambula-808x450.png" class="d-block w-100" alt="...">
                <div class="carousel-caption d-none d-md-block">
                    <h5>Acquista da noi tutte le ultime uscite</h5>
                    <p>Tutte le ultime novità in campo musicale </p>
                </div>
            </div>
            <div class="carousel-item">
                <img src="https://i.pinimg.com/originals/ec/f3/d2/ecf3d26dcce257844a3f2d07da5c3670.jpg" class="d-block w-100" alt="...">
                <div class="carousel-caption d-none d-md-block">
                    <h5>Sei un'artista e vuoi metterti in gioco? Partecipa ai nostri sondaggi</h5>
                    <p>ogni settimana scegliamo tre brani da mettere a confronto, ti aspettiamo!</p>
                </div>
            </div>
            <div class="carousel-item">
                <img src="https://www.businessintelligencegroup.it/wp-content/uploads/2021/02/social-community.jpg" class="d-block w-100" alt="...">
                <div class="carousel-caption d-none d-md-block">
                    <h5>Entra a far parte della nostra comunity</h5>
                    <p>lascia un commento e confrontati con gli altri utenti</p>
                </div>
            </div>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
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