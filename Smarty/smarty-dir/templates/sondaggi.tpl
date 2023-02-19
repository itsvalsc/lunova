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



            <ul class="navbar-nav ml-4">
                <li class="nav-item">
                    <a class="nav-link" href="/lunova/Carrello/mio_carrello">
                        <i class="fas fa-shopping-cart"></i>
                        <span class="badge rounded-pill bg-secondary">2</span>
                    </a>
                </li>
            </ul>



            <form class="d-flex" style="margin-block-end: 2px;">
                <input class="form-control me-sm-2" type="text" placeholder="Search">
                <button class="btn btn-secondary my-2 my-sm-0" type="submit">Search</button>
            </form>

            <ul class="navbar-nav ml-4">
                {if $logged}
                    <li class="nav-item">

                        <a class="nav-link" style="align-items: center " href="/lunova/Carrello/mio_carrello">
                            <i class="fa-solid fa-circle-user" style="font-size:24px;"></i>
                            <span class="badge rounded-pill bg-secondary">2</span>
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
<h3 class="text-secondary">Vota il tuo Disco preferito</h3>
    {if $logged ==false}
        <a >
            ACCEDI PER VOTARE
        </a>
    {/if}


<div class="row">
    <div class = "container" style="width: 20rem;">
        <a href="/lunova/Products_list/mostra_prodotto/{$sondaggio->getDisco1()->getID()}">
            <img style = "width: 250px; height: 200px;" src="data:{$sondaggio->getDisco1()->getCopertina()->getFormato()};base64,{$sondaggio->getDisco1()->getCopertina()->getImmagine()}">
            </img>
        </a>
        {if $logged}
            {if $votazione == false}
                <a href="/lunova/Sondaggi/vota/{$sondaggio->getDisco1()->getID()}">
                    <button type="button" class="btn btn-secondary">Vota</button>
                </a>
            {/if}
            {if $votazione}

            {/if}
        {/if}
        {if $logged ==false}
            <a >
                <button type="button" class="btn btn-secondary" disabled>Vota</button>
            </a>
        {/if}

        <div class="progress">
            <div class="progress-bar progress-bar-striped" role="progressbar" style="width: {$voti[0]}%;" aria-valuenow="10" aria-valuemin="0" aria-valuemax="100"></div>
        </div>
        {$sondaggio->getVotiDisco1()}
    </div>

    <!--<div class="progress">
      <div class="progress-bar progress-bar-striped" role="progressbar" style="width: 10%;" aria-valuenow="10" aria-valuemin="0" aria-valuemax="100"></div>
    </div>-->

    <div class = "container" style="width: 20rem;">
        <a href="/lunova/Products_list/mostra_prodotto/{$sondaggio->getDisco2()->getID()}">
        <img style = "width: 250px; height: 200px;" src="data:{$sondaggio->getDisco2()->getCopertina()->getFormato()};base64,{$sondaggio->getDisco2()->getCopertina()->getImmagine()}">
        </img>
        </a>
        {if $logged}
            {if $votazione == false}
                <a href="/lunova/Sondaggi/vota/{$sondaggio->getDisco2()->getID()}">
                    <button type="button" class="btn btn-secondary">Vota</button>
                </a>
            {/if}
            {if $votazione}

            {/if}
        {/if}
        {if $logged ==false}
            <a >
                <button type="button" class="btn btn-secondary" disabled>Vota</button>
            </a>
        {/if}
        <div class="progress">
            <div class="progress-bar progress-bar-striped bg-success" role="progressbar" style="width: {$voti[1]}%;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
        </div>
        {$sondaggio->getVotiDisco2()}
    </div>

    <div class="container" style="width: 20rem;">
        <a href="/lunova/Products_list/mostra_prodotto/{$sondaggio->getDisco3()->getID()}">
        <img style = "width: 250px; height: 200px;" src="data:{$sondaggio->getDisco3()->getCopertina()->getFormato()};base64,{$sondaggio->getDisco3()->getCopertina()->getImmagine()}" >
        </img>
        </a>
        {if $logged}
            {if $votazione == false}
                <a href="/lunova/Sondaggi/vota/{$sondaggio->getDisco3()->getID()}">
                    <button type="button" class="btn btn-secondary">Vota</button>
                </a>
            {/if}
            {if $votazione}

            {/if}
        {/if}
        {if $logged ==false}
            <a >
                <button type="button" class="btn btn-secondary" disabled>Vota</button>
            </a>
        {/if}

        <div class="progress">
            <div class="progress-bar progress-bar-striped bg-info" role="progressbar" style="width: {$voti[2]}%;" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
        </div>
        {$sondaggio->getVotiDisco3()}
    </div>

</div>
</div>

<div id="main" class="container" style="margin-top:500px; height: fit-content">
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
