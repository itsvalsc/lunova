<?php
/* Smarty version 4.2.1, created on 2022-12-10 02:29:19
  from 'C:\xampp\htdocs\lunova\Smarty\smarty-dir\templates\users.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.2.1',
  'unifunc' => 'content_6393e0ef9a7328_89180002',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '4368612c68e7005ec92efaea1e5e041fa43c9461' => 
    array (
      0 => 'C:\\xampp\\htdocs\\lunova\\Smarty\\smarty-dir\\templates\\users.tpl',
      1 => 1670635755,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_6393e0ef9a7328_89180002 (Smarty_Internal_Template $_smarty_tpl) {
?>
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
                        <a href="http://localhost/lunova/RicercaDisco/newDisc" class="nav-link py-3 border-bottom rounded-0" style="margin-right: 8px; height: 10px; margin-block-start: 0px;" title="Customers" data-bs-toggle="tooltip" data-bs-placement="right">
                            <svg class="bi pe-none" width="24" height="24" role="img" aria-label="Customers"><use xlink:href="#people-circle"/></svg>
                        </a>
                    </li>
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
            <a class="navbar-brand" href="#">Users</a>
            <ul class="nav nav-pills">
                <li class="nav-item">
                    <a class="nav-link" href="#scrollspyHeading1">Artisti</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#scrollspyHeading2">Clienti</a>
                </li>
            </ul>
        </nav>
        <div data-bs-spy="scroll" data-bs-target="#navbar-example2" data-bs-root-margin="0px 0px -40%" data-bs-smooth-scroll="true" class="scrollspy-example bg-dark p-3 rounded-2" tabindex="0">
            <h4 id="scrollspyHeading1">Artisti</h4>
            <table class="table table-primary">
                <thead>
                <tr>
                    <th scope="col">Email</th>
                    <th scope="col">Nome</th>
                    <th scope="col">Cognome</th>
                    <th scope="col" >Opzioni</th>
                </tr>
                </thead>
                <?php
$__section_ps_0_loop = (is_array(@$_loop=$_smarty_tpl->tpl_vars['user']->value) ? count($_loop) : max(0, (int) $_loop));
$__section_ps_0_total = $__section_ps_0_loop;
$_smarty_tpl->tpl_vars['__smarty_section_ps'] = new Smarty_Variable(array());
if ($__section_ps_0_total !== 0) {
for ($__section_ps_0_iteration = 1, $_smarty_tpl->tpl_vars['__smarty_section_ps']->value['index'] = 0; $__section_ps_0_iteration <= $__section_ps_0_total; $__section_ps_0_iteration++, $_smarty_tpl->tpl_vars['__smarty_section_ps']->value['index']++){
?>
                    <tbody>
                    <tr class="table-dark">

                        <td><?php echo $_smarty_tpl->tpl_vars['user']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_ps']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_ps']->value['index'] : null)]->getEmail();?>
</td>
                        <td><?php echo $_smarty_tpl->tpl_vars['user']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_ps']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_ps']->value['index'] : null)]->getNome();?>
</td>
                        <td><?php echo $_smarty_tpl->tpl_vars['user']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_ps']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_ps']->value['index'] : null)]->getCognome();?>
</td>
                        <td>
                            <button type="button" class="btn btn-outline-info">Modifica</button>
                            <button type="button" class="btn btn-outline-danger">Elimina</button>
                        </td>
                    </tr>
                    </tbody>
                <?php
}
}
?>
            </table>
            <h4 id="scrollspyHeading2">Clienti</h4>
            <table class="table table-primary">
                <thead>
                <tr>
                    <th scope="col">Email</th>
                    <th scope="col">Nome</th>
                    <th scope="col">Cognome</th>
                    <th scope="col" >Opzioni</th>
                </tr>
                </thead>
                <?php
$__section_pc_1_loop = (is_array(@$_loop=$_smarty_tpl->tpl_vars['cli']->value) ? count($_loop) : max(0, (int) $_loop));
$__section_pc_1_total = $__section_pc_1_loop;
$_smarty_tpl->tpl_vars['__smarty_section_pc'] = new Smarty_Variable(array());
if ($__section_pc_1_total !== 0) {
for ($__section_pc_1_iteration = 1, $_smarty_tpl->tpl_vars['__smarty_section_pc']->value['index'] = 0; $__section_pc_1_iteration <= $__section_pc_1_total; $__section_pc_1_iteration++, $_smarty_tpl->tpl_vars['__smarty_section_pc']->value['index']++){
?>
                    <tbody>
                    <tr class="table-dark">

                        <td><?php echo $_smarty_tpl->tpl_vars['cli']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_pc']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_pc']->value['index'] : null)]->getEmail();?>
</td>
                        <td><?php echo $_smarty_tpl->tpl_vars['cli']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_pc']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_pc']->value['index'] : null)]->getNome();?>
</td>
                        <td><?php echo $_smarty_tpl->tpl_vars['cli']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_pc']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_pc']->value['index'] : null)]->getCognome();?>
</td>
                        <td>
                            <button type="button" class="btn btn-outline-info">Modifica</button>
                            <button type="button" class="btn btn-outline-danger">Elimina</button>
                        </td>
                    </tr>
                    </tbody>
                <?php
}
}
?>
            </table>
        </div>
    </div>



    </body>
    </html>
<?php }
}
