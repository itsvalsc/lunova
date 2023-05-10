<!-- header -->
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" type="text/css" href="https://bootswatch.com/5/vapor/bootstrap.css">

    <link rel="stylesheet" type="text/css" href="/lunova/inc/css/style.css ">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" type="text/css" href="/lunova/inc/css/Star.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">


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

<!-- singolo disco  -->

<div id="main" class="container" style="margin-top:100px; height: fit-content">
    <div class="row">
        <div class="col-4">
            <img style="width: 300px; height: 300px;" src="data:{$product->getCopertina()->getFormato()};base64,{$product->getCopertina()->getImmagine()}"  alt="prova">
        </div>
        <div class="col-8">
            <h1>
                {$product->getTitolo()}
                <small class="text-muted"> by </small>
                <a href="/lunova/Profile/users/{$product->getAutore()}">
                    <small class="text-muted"> {$artist}</small>
                </a>
                <small style="margin-left: 50px" class="text-warning">
                    {section name = n loop= [0,1,2,3,4]}
                        <span class="{$star[n]}"></span>
                    {/section}
                    {$media}
                </small>

            </h1>

            <p>{$product->getDescrizione()}</p>

            {if $logged && $isCliente}
                {if $product->getQta() != 0 }
                    <a href="/lunova/Carrello/Add/{$product->getID()}">
                        <button class="btn btn-primary btn-sm btn-block rounded-0" type="submit" >Aggiungi al carrello</button>
                    </a>
                {/if}
                {if $product->getQta() == 0 }
                    <button class="btn btn-primary btn-sm btn-block rounded-0 disabled">Aggiungi al carrello</button>
                {/if}
            {elseif $logged==false}
                <button class="btn btn-primary btn-sm btn-block rounded-0" type="submit" disabled>Aggiungi al carrello</button>
            {/if}


            <h5 class="text-secondary" style="margin-top: 20px">
                <script>
                    var x ;
                    var y;
                    var result;

                    x = {$product->getQta()};
                    if (x > 10) {
                        result = 'disponibile';
                    }
                    else if (( x != 0 ) && ( x <10 )) {
                        result = 'pochi pezzi';
                    }
                    else {
                        result = 'non disponibile';
                    }
                    document.write(result);

                </script>
            </h5>
            <hr>
            <h3>€ {$product->getPrezzo()} </h3>


            
            {if $logged}
                {if $votazione==false}
            <form  action="/lunova/Commento/votazioneDisco" method="post">
                <div class="form-group">
                    <div class="rate">
                    <input type="radio" id="star5" name="rate" value="5" />
                    <label for="star5" title="5 stelle">5 stars</label>
                    <input type="radio" id="star4" name="rate" value="4" />
                    <label for="star4" title="4 stelle">4 stars</label>
                    <input type="radio" id="star3" name="rate" value="3" />
                    <label for="star3" title="3 stelle">3 stars</label>
                    <input type="radio" id="star2" name="rate" value="2" />
                    <label for="star2" title="2 stelle">2 stars</label>
                    <input type="radio" id="star1" name="rate" value="1" />
                    <label for="star1" title="1 stella">1 star</label>
                    </div>
                    <input type="hidden" name="disco" value="{$product->getID()}">
                    <button type="submit" class="btn btn-warning">vota</button>
                </div>
            </form>

                {/if}
            {/if}
            {if $logged==false}
                <form  action="/lunova/Commento/votazioneDisco" method="post">
                    <div class="form-group">
                        <div class="rate">
                            <input type="radio" id="star5" name="rate" value="5" />
                            <label for="star5" title="5 stelle">5 stars</label>
                            <input type="radio" id="star4" name="rate" value="4" />
                            <label for="star4" title="4 stelle">4 stars</label>
                            <input type="radio" id="star3" name="rate" value="3" />
                            <label for="star3" title="3 stelle">3 stars</label>
                            <input type="radio" id="star2" name="rate" value="2" />
                            <label for="star2" title="2 stelle">2 stars</label>
                            <input type="radio" id="star1" name="rate" value="1" />
                            <label for="star1" title="1 stella">1 star</label>
                        </div>
                        <input type="hidden" name="disco" value="{$product->getID()}">
                        <button type="submit" id="rate" title="Effettua il login per votare" class="btn btn-warning" disabled >vota</button>
                    </div>
                </form>

            {/if}
        </div>
    </div>
</div>


<!-- commenti -->
<div id="main" class="container" style="margin-top:100px; height: fit-content">

    <!-- Add comment -->
    <div class="d-flex mb-3">
        {if $logged}
            <!-- Comment box  -->
            <form class="w-100" method="post" action="/lunova/Commento/scriviCommento">
                <textarea id="commento" data-autoresize class="form-control pe-4 bg-light bg-opacity-50" name="commento" rows="1" placeholder="Add a comment..."></textarea>
                <input hidden name="disco" value="{$product->getID()}">
                <button type="submit" class="btn btn-primary">Invia</button>
            </form>
        {else}
            <form class="w-100" method="post" action="/lunova/Commento/scriviCommento">
                <textarea id="commento" data-autoresize class="form-control pe-4 bg-light bg-opacity-50" name="commento" rows="1" placeholder="Effettua il login per poter pubblicare commenti"></textarea>
                <input hidden name="disco" value="{$product->getID()}">
                <button type="submit" class="btn btn-primary disabled">Invia</button>
            </form>
        {/if}
    </div>

    {section name = nr loop= $commenti}
    <!-- Comment wrap START -->
    <ul class="comment-wrap list-unstyled">
        <!-- Comment item START -->
        <li class="comment-item">
            <div class="d-flex position-relative">
                <!-- Avatar -->
                <div class="avatar avatar-xs">
                    {if !is_null($commenti[nr]->getCliente()->getImmProfilo())}
                        <a href="#!"><img style="width: 50px;height: 50px;position: relative;overflow: hidden;border-radius: 50%;" src="data:{$commenti[nr]->getCliente()->getImmProfilo()->getFormato()};base64,{$commenti[nr]->getCliente()->getImmProfilo()->getImmagine()}" alt=""></a>
                    {/if}
                    {if is_null($commenti[nr]->getCliente()->getImmProfilo())}
                        <a href="#!"><img class="avatar-img rounded-circle" style="width= 50 px; height: 50px;" src="../../Utility/img/icona_profilo_utente.jpg" alt=""></a>
                    {/if}
                </div>
                <div class="ms-2">
                    <!-- Comment by -->
                    <div class="bg-light rounded-start-top-0 p-3 rounded bg-opacity-75">
                        <div class="d-flex justify-content-between">
                            <h6 class="mb-1"> <a href="/lunova/Profile/users/{$commenti[nr]->getCliente()->getIdClient()}"> {$commenti[nr]->getCliente()->getUsername()}</a></h6>
                            <small class="ms-2">{$commenti[nr]->getData()}</small>
                        </div>
                        <p class="small mb-0">{$commenti[nr]->getDescrizione()}</p>
                    </div>
                    <!-- Comment react -->
                    <ul class="nav nav-divider py-2 small">
                        {if $logged}
                            {if  !in_array($commenti[nr]->getId(),$arr)}
                        <li class="nav-item">
                            <a class="nav-link" onmouseover="this.style.color='red'" onmouseleave="this.style.color='#32fbe2'" href="/lunova/Commento/votazioneCommento/{$commenti[nr]->getId()}/{$product->getID()}">Like ({$nmp[$commenti[nr]->getId()]|default:0 })</a>
                        </li>
                            {/if}
                            {if  in_array($commenti[nr]->getId(),$arr)}
                        <li class="nav-item">
                            <a class="nav-link" style="color: red" onmouseover="this.style.color='#32fbe2'" onmouseleave="this.style.color='red'" href="/lunova/Commento/eliminaMP/{$commenti[nr]->getId()}/{$product->getID()}">Like ({$nmp[$commenti[nr]->getId()]|default:0})</a>
                        </li>
                            {/if}

                            {if $proprieta == $commenti[nr]->getCliente()->getIdClient()}
                                <li class="nav-item">
                                    <a class="nav-link" href="/lunova/Commento/cancellaCommento/{$commenti[nr]->getId()}/{$product->getID()}"> Elimina</a>
                                </li>
                            {/if}

                            {if $proprieta != $commenti[nr]->getCliente()->getIdClient()}
                                <li class="nav-item" >
                                    <a class="nav-link" href="/lunova/Commento/segnalaCommento/{$commenti[nr]->getId()}/{$product->getID()}" > Segnala</a>
                                </li>
                            {/if}
                        {/if}
                        {if $logged==false}
                            <li class="nav-item">
                                <a class="nav-link disabled" href="#!"> Like ({$nmp[$commenti[nr]->getId()]|default:0 })</a>
                            </li>

                                <li class="nav-item" >
                                    <a class="nav-link disabled" href="#!" > Segnala</a>
                                </li>

                        {/if}
                    </ul>
                </div>
            </div>
            <!-- Comment item nested START -->
            <ul class="comment-item-nested list-unstyled">
                <!-- Comment item START -->
                <li class="comment-item">
                    <div class="d-flex">
                        <!-- Avatar -->
                        <div class="avatar avatar-story avatar-xs">
                            <a href="#!"><img class="avatar-img rounded-circle" src="assets/images/avatar/07.jpg" alt=""></a>
                        </div>

                    </div>
                </li>
                <!-- Comment item END -->
            </ul>
            {/section}

    </div>
</div>

<!-- footer -->

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