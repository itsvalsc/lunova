<?php
/* Smarty version 4.2.1, created on 2022-12-10 02:35:28
  from 'C:\xampp\htdocs\lunova\Smarty\smarty-dir\templates\admin.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.2.1',
  'unifunc' => 'content_6393e260e05ff7_61213347',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '7207eb13a720204628df754175d3bcc1383824e9' => 
    array (
      0 => 'C:\\xampp\\htdocs\\lunova\\Smarty\\smarty-dir\\templates\\admin.tpl',
      1 => 1670626536,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_6393e260e05ff7_61213347 (Smarty_Internal_Template $_smarty_tpl) {
if ($_smarty_tpl->tpl_vars['logged']->value) {?>
    <!-- header -->
    <?php echo '<?php'; ?>

require_once 'C:\xampp\htdocs\lunova\inc\css\icons.php';
<?php echo '?>'; ?>

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
            <a class="navbar-brand" href="http://localhost/lunova/RicercaDisco/index">Lunova</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarColor03" aria-controls="navbarColor03" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarColor03">
                <ul class="navbar-nav me-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="http://localhost/lunova/Products_list/elenco_dischi">Prodotti</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="http://localhost/lunova/Login/login">Notifications</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="http://localhost/lunova/Admin/users">Users</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="http://localhost/lunova/Sondaggi/show">Sondaggi</a>
                    </li>
                </ul>



                <ul class="navbar-nav ml-4">
                    <li class="nav-item">
                        <a class="nav-link" href="http://localhost/lunova/Carrello/mio_carrello">
                            <i class="fas fa-shopping-cart"></i>
                            <span class="badge rounded-pill bg-secondary">1</span>
                        </a>
                    </li>
                </ul>



                <form class="d-flex" style="margin-block-end: 2px;">
                    <input class="form-control me-sm-2" type="text" placeholder="Search">
                    <button class="btn btn-secondary my-2 my-sm-0" type="submit">Search</button>
                </form>

                <ul>
                    <li>
                        <a href="http://localhost/lunova/templates/?page=profile" class="nav-link py-3 border-bottom rounded-0" style="margin-right: 8px; height: 10px; margin-block-start: 0px;" title="Customers" data-bs-toggle="tooltip" data-bs-placement="right">
                            <svg class="bi pe-none" width="24" height="24" role="img" aria-label="Customers"><use xlink:href="#people-circle"/></svg>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <!-- end header -->




    </body>
    </html>
<?php }
}
}
