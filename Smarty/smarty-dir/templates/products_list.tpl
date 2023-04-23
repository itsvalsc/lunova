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

                        <a class="nav-link" style="align-items: center " href="/lunova/Profile/mostraProfilo">
                            <i class="fa-solid fa-circle-user" style="font-size:24px;"></i>
                            <span class="badge rounded-pill bg-secondary"></span>
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

<div id="main" class="container" style="margin-top:40px; height: fit-content">

    <h5 ><label style="margin-left: 430px;margin-bottom: 15px">UTILIZZA I FILTRI PER UN RICERCA PIU VELOCE</label></h5 >
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
                {section name = ng loop= $generi}
                    <li><a class="dropdown-item" href="/lunova/RicercaDisco/ricerca/{$generi[ng]}">{$generi[ng]}</a></li>
                {/section}
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
