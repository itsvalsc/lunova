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
            </ul>


            <form class="d-flex" style="margin-block-end: 2px;" action="/lunova/Profile/ricercaUtente" method="post">
                <input class="form-control me-sm-2" type="text" name="search" placeholder="Cerca Utenti o Artisti" required>
                <button class="btn btn-secondary my-2 my-sm-0" type="submit">Cerca</button>
            </form>

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


        <nav id="navbar-example2" class="navbar bg-primary px-3 mb-3" >
            <a class="navbar-brand" href="#">Users</a>
            <ul class="nav nav-pills" style="margin-right: 0px">
                <li class="nav-item" style="margin-right: 50px">
                    <a class="nav-link" href="#scrollspyHeading1">Artisti</a>
                </li>
                <li class="nav-item" style="margin-right: 50px">
                    <a class="nav-link" href="#scrollspyHeading2">Clienti</a>
                </li>
                <li class="nav-item" >
                    <input type="text" id="username" style="margin-top: 7px"/>
                    <a class="nav-link" style="float:right" href="" onclick="this.href='#'+document.getElementById('username').value">Trova utente tramite ID</a>
                </li>
            </ul>
        </nav>
        <div data-bs-spy="scroll" data-bs-target="#navbar-example2" data-bs-root-margin="0px 0px -40%" data-bs-smooth-scroll="true" class="scrollspy-example bg-dark p-3 rounded-2" tabindex="0">
            <h4 id="scrollspyHeading1">Artisti</h4>
            <table class="table table-primary">
                <thead>
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Email</th>
                    <th scope="col">Nome</th>
                    <th scope="col">Cognome</th>
                    <th scope="col" >Opzioni</th>
                </tr>
                </thead>
                {section name = ps loop= $user}
                    <tbody id="{$user[ps]->getIdArtista()}">
                    <tr class="table-dark">

                        <td>{$user[ps]->getIdArtista()}</td>
                        <td>{$user[ps]->getEmail()}</td>
                        <td>{$user[ps]->getNome()}</td>
                        <td>{$user[ps]->getCognome()}</td>
                        <td>
                            <a href="/lunova/Admin/EliminaA/{$user[ps]->getEmail()}">
                                <button type="button" class="btn btn-outline-danger">Blocca</button>
                            </a>
                        </td>
                    </tr>
                    </tbody>
                {/section}
            </table>
            <h4 id="scrollspyHeading2">Clienti</h4>
            <table class="table table-primary">
                <thead>
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Email</th>
                    <th scope="col">Nome</th>
                    <th scope="col">Cognome</th>
                    <th scope="col" >Opzioni</th>
                </tr>
                </thead>
                {section name = pc loop= $cli}
                    <tbody id="{$cli[pc]->getIdClient()}">
                    <tr class="table-dark">

                        <td>{$cli[pc]->getIdClient()}</td>
                        <td>{$cli[pc]->getEmail()}</td>
                        <td>{$cli[pc]->getNome()}</td>
                        <td>{$cli[pc]->getCognome()}</td>
                        <td>
                            {if $cli[pc]->getBannato()==true}
                            <a href="/lunova/Admin/riattivaUtente/{$cli[pc]->getEmail()}">
                                <button type="button" class="btn btn-outline-success">Sblocca</button>
                            </a>
                            {/if}
                            {if $cli[pc]->getBannato() == false}
                            <a href="/lunova/Admin/sospendiUtente/{$cli[pc]->getEmail()}">
                                <button type="button" class="btn btn-outline-danger">Blocca</button>
                            </a>
                            {/if}
                        </td>
                    </tr>
                    </tbody>
                {/section}
            </table>
        </div>
    </div>



    </body>
    </html>
