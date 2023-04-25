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
        <div></div>
        <form action="/lunova/Admin/aggiungi_admin" method="post">

            <div class="form-group" style="width: 50rem;">
                <fieldset>
                    <label class="form-label mt-4" ">Nome</label>
                    <input class="form-control" id="nutente" name='nome' type="text" placeholder="Nome" required>
                </fieldset>
            </div>

            <div class="form-group"style="width: 50rem;">
                <fieldset>
                    <label class="form-label mt-4" >Cognome</label>
                    <input class="form-control" id="cutente" name='cognome' type="text" placeholder="Nome" required>
                </fieldset>
            </div>

            <div class="form-group" style="width: 50rem;">
                <label for="exampleInputEmail1" class="form-label mt-4">Email</label>
                <input type="email" class="form-control" id="Email" name="email" aria-describedby="emailHelp" placeholder="Enter email" required>
            </div>

            <div class="form-group" style="width: 50rem;">
                <label for="exampleInputPassword1" class="form-label mt-4">Password</label>
                <input type="password" class="form-control" id="password"  name="password" placeholder="password" required>
            </div>

            <div class="form-group"style="width: 50rem;">
                <fieldset>
                    <label class="form-label mt-4" >Telefono</label>
                    <input class="form-control" id="telefono" name='telefono' type="text" placeholder="Telefono" required>
                </fieldset>
            </div>
            <hr>
            <button type="submit" class="btn btn-primary">AGGIUNGI AMMINISTRATORE</button>
        </form>
    </div>


<div id="main" class="container" style="margin-top:80px; height: fit-content">
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