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

<div id="main" class="container" style="margin-top:40px; height: fit-content">

    <div class ='row'>
        {section name = nr loop= $ordine}
            <div class="card border-dark mb-3 bg-dark" style="width: 30rem;">
                <h5 class="card-header">Ordine</h5>
                <div class="card-body">
                    <!--<h5 class="card-title">Special title treatment</h5>-->
                    <p class="card-text">{$ordine[nr]}</p>
                    <!--<a href="#" class="btn btn-primary">Go somewhere</a>-->
                    <a href="/lunova/">
                        <div class="row w-10" >
                            <button class="btn btn-info btn-sm btn-block rounded-0" type="submit" >Iscrivi al sondaggio</button>
                        </div>
                    </a>
                </div>
            </div>
        {/section}

    </div>
</div>

<!-- footer -->
<div id="main" class="container" style="margin-top:200px; height: fit-content">
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
