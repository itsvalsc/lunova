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
    <link rel="stylesheet" type="text/css" href="http://localhost/lunova/inc/css/Star.css">
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

            {if $product->getQta() != 0 }
            <a href="/lunova/Carrello/Add/{$product->getID()}">
                <button class="btn btn-primary btn-sm btn-block rounded-0" type="submit" style="margin-top: 15px" >Aggiungi al carrello</button>
            </a>
            {/if}
            {if $product->getQta() == 0 }
                <button class="btn btn-primary btn-sm btn-block rounded-0 disabled" type="submit" style="margin-top: 15px" >Aggiungi al carrello</button>

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
                <button type="submit" class="btn btn-primary" disabled>Invia</button>
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
                    <a href="#!"><img class="avatar-img rounded-circle" style="width= 50 px; height: 50px;" src="data:image/jpeg;base64,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" alt=""></a>
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