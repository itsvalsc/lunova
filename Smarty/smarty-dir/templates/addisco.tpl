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



<div id="main" class="container" style="margin-top:80px; height: fit-content">
    <form action="/lunova/Products_list/aggiungi_disco" method="post" enctype="multipart/form-data">
        <div class="form-group">
            <fieldset>
                <label class="form-label mt-4" for="readOnlyInput">Nome disco</label>
                <input class="form-control" name="ndisco" id="ndisco" type="text" placeholder="Nome">
            </fieldset>
        </div>
        <div class="form-group">
            <label for="exampleTextarea" class="form-label mt-4">Descrizione</label>
            <textarea class="form-control" name="descrizione" id="descrizione" rows="3"></textarea>
        </div>

        <div class="form-group">
            <label for="exampleSelect1" class="form-label mt-4">Genere</label>
            <select class="form-select" name="genere" id="genere">
                {section name = gn loop= $gen}
                    <option>{$gen[gn]}</option>
                {/section}
            </select>
        </div>

        <div class="form-group">
            <label for="formFile" class="form-label mt-4">Scegli una copertina</label>
            <input class="form-control" name="copertina" type="file" id="copertina">
        </div>


        <div class="form-group">
            <label class="form-label mt-4">Prezzo</label>
            <div class="form-group">
                <div class="input-group mb-3">
                    <span class="input-group-text">$</span>
                    <input type="text" class="form-control" name="prezzo" aria-label="Prezzo">
                    <span class="input-group-text"></span>
                </div>
            </div>
        </div>


        <div class="form-group">
            <label class="form-label mt-4">Quantita</label>
            <div class="form-group">
                <div class="input-group mb-3">
                    <input type="text" class="form-control" name="quantita" aria-label="Quantita">
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

<script src="https://bootswatch.com/_vendor/jquery/dist/jquery.min.js"></script>
<script src="https://bootswatch.com/_vendor/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://bootswatch.com/_vendor/prismjs/prism.js"></script>

<!--<script src="<?php //echo ROOT_URL; ?>assets/js/main.js"></script>-->
</body>
</html>