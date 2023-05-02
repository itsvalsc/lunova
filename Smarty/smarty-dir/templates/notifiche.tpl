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
        <div class="navbar-brand" >Lunova</div>

        <div class="collapse navbar-collapse" id="navbarColor03">
            <ul class="navbar-nav me-auto">
                <li class="nav-item">
                    <a class="nav-link" href="/lunova/Admin/notifiche">Notifiche</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/lunova/Admin/usersadmin">Users</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/lunova/Admin/ordini_admin">Ordini</a>
                </li>
            </ul>

            <ul class="navbar-nav ml-4">

                <li class="nav-item">

                    <a class="nav-link" style="align-items: center " href="/lunova/Profile/Impostazioni">
                        <i class="fa-solid fa-circle-user" style="font-size:24px;"></i>
                        <span style="scale: 0.9;" class="badge rounded-pill bg-primary">impostazioni</span>
                    </a>

                </li>



            </ul>

            </ul>
        </div>
    </div>
</nav>



<!-- end header -->

<div id="main" class="container" style="margin-top:80px; height: 700px">

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
                        <a href="/lunova/Admin/eliminaNotifica/{$notifica[nt]->getId()}"><button  type="button" class="btn btn-outline-danger">Elimina</button></a>
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
                <th scope="col">Commento</th>
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
                        <a href="/lunova/Admin/ignora/{$notificb[pc]->getId()}/{$notificb[pc]->getMittente()}"><button type="button" class="btn btn-outline-info">Ignora</button></a>
                        <a href="/lunova/Admin/eliminaCommento/{$notificb[pc]->getMittente()}/{$notificb[pc]->getId()}"><button type="button" class="btn btn-outline-danger">Elimina Commento</button></a>
                        <a href="/lunova/Admin/ricercaUtente/{$notificb[pc]->getMittente()}"><button type="button" class="btn btn-outline-warning"> Vai all'Utente</button></a>
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
