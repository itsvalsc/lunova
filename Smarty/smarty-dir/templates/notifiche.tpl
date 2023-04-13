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

<div id="main" class="container" style="margin-top:80px; height: 700px">

    <form class="d-flex" style="margin-block-end: 2px;">
        <input class="form-control me-sm-2" type="text" placeholder="Search">
        <button class="btn btn-secondary my-2 my-sm-0" type="submit">Search</button>
    </form>
    <hr>


    <nav id="navbar-example2" class="navbar bg-primary px-3 mb-3">
        <a class="navbar-brand" href="#">Notifiche</a>
        <ul class="nav nav-pills">
            <li class="nav-item">
                <a class="nav-link" href="#scrollspyHeading1">Alta</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#scrollspyHeading2">Bassa</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#scrollspyHeading3">Sondaggi</a>
            </li>
        </ul>
    </nav>
    <div data-bs-spy="scroll" data-bs-target="#navbar-example2" data-bs-root-margin="0px 0px -40%" data-bs-smooth-scroll="true" class="scrollspy-example bg-dark p-3 rounded-2" tabindex="0">
        <h4 id="scrollspyHeading1">Alta</h4>
        <table class="table table-danger ">
            <thead>
            <tr>
                <th scope="col">Priorità</th>
                <th scope="col">Testo</th>
                <th scope="col">Mittente</th>
                <th scope="col" >Opzioni</th>
            </tr>
            </thead>
            {section name = nt loop= $notifica}
                <tbody>
                <tr class="table-dark">

                    <td>{$notifica[nt]->getPriority()}</td>
                    <td>{$notifica[nt]->getText()}</td>
                    <td>{$notifica[nt]->getMittente()}</td>
                    <td>
                        <a><button  type="button" class="btn btn-outline-danger">Elimina</button></a>
                    </td>
                </tr>
                </tbody>
            {/section}
        </table>
        <h4 id="scrollspyHeading2">Bassa</h4>
        <table class="table table-secondary">
            <thead>
            <tr>
                <th scope="col">Priorità</th>
                <th scope="col">Testo</th>
                <th scope="col">Mittente</th>
                <th scope="col" >Opzioni</th>
            </tr>
            </thead>
            {section name = pc loop= $notificb}
                <tbody>
                <tr class="table-dark">

                    <td>{$notificb[pc]->getPriority()}</td>
                    <td>{$notificb[pc]->getText()}</td>
                    <td>{$notificb[pc]->getMittente()}</td>
                    <td>
                        <a href="/lunova/Admin/eliminaNotifica/{$notificb[pc]->getId()}"><button type="button" class="btn btn-outline-info">Ignora</button></a>
                        <a href="/lunova/Admin/eliminaCommento/{$notificb[pc]->getMittente()}/{$notificb[pc]->getId()}"><button type="button" class="btn btn-outline-danger">Elimina Commento</button></a>
                    </td>
                </tr>
                </tbody>
            {/section}
        </table>

        <h4 id="scrollspyHeading3">Sondaggi</h4>
        <table class="table table-warning bg-opacity-50" style="margin-top: 10px">
            <thead>
            <tr >
                <th scope="col">Disco</th>
                <th scope="col">Autore</th>
                <th scope="col">Data</th>


            </tr>
            </thead>

            <form method="post" id="sondaggi" action="/lunova/Sondaggi/nuovoSondaggio">
                <small>SELEZIONARE 3 DISCHI CONFERMARLI PER CREARE UN NUOVO SONDAGGIO</small>
            {section name = ps loop= $notifics}
                <tbody>

                    <div>
                        <tr class="table-dark">

                            <td>{$notifics[ps]->getDisco()}</td>
                            <td>{$notifics[ps]->getArtista()}</td>
                            <td>{$notifics[ps]->getData()}</td>
                            <td>
                                <input
                                type="checkbox"
                                class="check"
                                name="{$notifics[ps]->getDisco()}"
                                value={$notifics[ps]->getDisco()}> <!-- todo:max 3 scelte-->
                            </td>
                        </tr>
                    </div>
                </tbody>
            {/section}
                <div>
                    <button type="submit" class="btn btn-primary">CONFERMA</button>
                </div>

            </form>


        </table>




    </div>
</div>



</body>
</html>
