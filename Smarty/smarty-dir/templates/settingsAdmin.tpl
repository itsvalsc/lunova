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

    <div id="main" class="container" style="margin-top:80px; height: fit-content">
        <ul class="nav nav-link-secondary flex-column fw-bold gap-2">
            <li class="nav-item">
                <a class="nav-link" href="/lunova/Profile/Impostazioni"><span>Cambio dati profilo</span></a>
                <hr>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="/lunova/Login/logout"><i class="fa-solid fa-right-from-bracket"></i><span> Logout</span></a>
                <hr>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="/lunova/Profile"><span>Aggiungi Admin</span></a>
                <hr>
            </li>
        </ul>
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