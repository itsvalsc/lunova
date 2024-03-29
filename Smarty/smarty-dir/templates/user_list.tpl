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

<div id="main" class="container" style="margin-top:40px; height: fit-content">
    
    <div class ='row'>
        {if count($product)==0}
            <h3 style="text-align: center;margin-top: 100px;color: #ff00ea"><label >Spiacente, nessun Utente trovato</label></h3>
        {else}
            {section name = nr loop= $product}


            <div class="card border-dark mb-3 bg-dark" style="width: 18rem;">
                {if !is_null($product[nr]->getImmProfilo())}
                <img style = "width: 250px; height: 250px;" src="data:{$product[nr]->getImmProfilo()->getFormato()};base64,{$product[nr]->getImmProfilo()->getImmagine()}" alt="prova">
                {elseif is_null($product[nr]->getImmProfilo())}
                {if $product[nr]->getLivello() == 'B'}
                    <img style = "width: 250px; height: 250px;" src="https://st2.depositphotos.com/50337402/47081/v/450/depositphotos_470817490-stock-illustration-black-male-user-symbol-blue.jpg" alt="prova">
                {elseif  $product[nr]->getLivello() == 'C'}
                    <img style = "width: 250px; height: 250px;" src="https://static.vecteezy.com/ti/vettori-gratis/p2/2318271-icona-profilo-utente-vettoriale.jpg" alt="prova">
                {/if}
                {/if}
                <div class="card-body" >
                    <h5 class="card-title"> {$product[nr]->getUsername()} </h5>
                    <h6 class = "card-subtitle mb-2 text-muted">{if $product[nr]->getLivello() == 'B'}Artista{elseif  $product[nr]->getLivello() == 'C'}Utente{/if} </h6>

                    <!--<button class="btn btn-secondary btn-sm btn-block rounded-0" onclick="location.href='<?php //echo ROOT_URL . '?page=view-product&id=' . esc_html($product->getID()); ?>'">Vedi</button>-->
                    <a href="/lunova/Profile/users/{if $product[nr]->getLivello() == 'B'}{$product[nr]->getIdArtista()}{elseif $product[nr]->getLivello() == 'C'}{$product[nr]->getIdClient()}{/if}">
                        <button class="btn btn-secondary btn-sm btn-block rounded-0" type="submit" >Vai al Profilo</button></a>

                </div>
            </div>
    {/section}

        {/if}

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
