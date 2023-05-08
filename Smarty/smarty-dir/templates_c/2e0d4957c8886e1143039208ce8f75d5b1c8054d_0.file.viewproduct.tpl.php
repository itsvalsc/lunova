<?php
/* Smarty version 4.2.1, created on 2023-05-08 00:23:49
  from 'C:\xampp\htdocs\lunova\Smarty\smarty-dir\templates\viewproduct.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.2.1',
  'unifunc' => 'content_645824f55b1577_12553128',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '2e0d4957c8886e1143039208ce8f75d5b1c8054d' => 
    array (
      0 => 'C:\\xampp\\htdocs\\lunova\\Smarty\\smarty-dir\\templates\\viewproduct.tpl',
      1 => 1683494548,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_645824f55b1577_12553128 (Smarty_Internal_Template $_smarty_tpl) {
?><!-- header -->
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" type="text/css" href="https://bootswatch.com/5/vapor/bootstrap.css">

    <link rel="stylesheet" type="text/css" href="http://<?php echo $_smarty_tpl->tpl_vars['server']->value;?>
/lunova/inc/css/style.css ">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" type="text/css" href="http://<?php echo $_smarty_tpl->tpl_vars['server']->value;?>
/lunova/inc/css/Star.css">
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
                <?php if ($_smarty_tpl->tpl_vars['logged']->value == false) {?>
                    <li class="nav-item">
                        <a class="nav-link" href="/lunova/Login/login">Login</a>
                    </li>
                <?php }?>
                <li class="nav-item">
                    <a class="nav-link" href="/lunova/AboutUs/us">About</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/lunova/Sondaggi/show">Sondaggi</a>
                </li>
            </ul>


            <?php if ($_smarty_tpl->tpl_vars['logged']->value && $_smarty_tpl->tpl_vars['isCliente']->value) {?>
                <ul class="navbar-nav ml-4">
                    <li class="nav-item">
                        <a class="nav-link" href="/lunova/Carrello/mio_carrello">
                            <i class="fas fa-shopping-cart"></i>
                            <span class="badge rounded-pill bg-secondary"><?php echo $_smarty_tpl->tpl_vars['num']->value;?>
</span>
                        </a>
                    </li>
                </ul>
            <?php }?>


            <form class="d-flex" style="margin-block-end: 2px;" action="/lunova/Profile/ricercaUtente" method="post">
                <input class="form-control me-sm-2" type="text" name="search" placeholder="Cerca Utenti o Artisti" required>
                <button class="btn btn-secondary my-2 my-sm-0" type="submit">Cerca</button>
            </form>

            <ul class="navbar-nav ml-4">
                <?php if ($_smarty_tpl->tpl_vars['logged']->value) {?>
                    <li class="nav-item">

                        <a class="nav-link" style="align-items: center " href="/lunova/Profile/users">
                            <i class="fa-solid fa-circle-user" style="font-size:24px;"></i>
                        </a>

                    </li>

                <?php }?>
                <?php if ($_smarty_tpl->tpl_vars['logged']->value == false) {?>
                    <li class="nav-item">

                        <a class="nav-link" style="align-items: center " href="/lunova/Login/login">
                            <i class="fa-solid fa-circle-user" style="font-size:24px;"></i>
                            <span class="badge rounded-pill bg-secondary"></span>
                        </a>

                    </li>
                <?php }?>
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
            <img style="width: 300px; height: 300px;" src="data:<?php echo $_smarty_tpl->tpl_vars['product']->value->getCopertina()->getFormato();?>
;base64,<?php echo $_smarty_tpl->tpl_vars['product']->value->getCopertina()->getImmagine();?>
"  alt="prova">
        </div>
        <div class="col-8">
            <h1>
                <?php echo $_smarty_tpl->tpl_vars['product']->value->getTitolo();?>

                <small class="text-muted"> by </small>
                <a href="/lunova/Profile/users/<?php echo $_smarty_tpl->tpl_vars['product']->value->getAutore();?>
">
                    <small class="text-muted"> <?php echo $_smarty_tpl->tpl_vars['artist']->value;?>
</small>
                </a>
                <small style="margin-left: 50px" class="text-warning">
                    <?php
$__section_n_0_loop = (is_array(@$_loop=array(0,1,2,3,4)) ? count($_loop) : max(0, (int) $_loop));
$__section_n_0_total = $__section_n_0_loop;
$_smarty_tpl->tpl_vars['__smarty_section_n'] = new Smarty_Variable(array());
if ($__section_n_0_total !== 0) {
for ($__section_n_0_iteration = 1, $_smarty_tpl->tpl_vars['__smarty_section_n']->value['index'] = 0; $__section_n_0_iteration <= $__section_n_0_total; $__section_n_0_iteration++, $_smarty_tpl->tpl_vars['__smarty_section_n']->value['index']++){
?>
                        <span class="<?php echo $_smarty_tpl->tpl_vars['star']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_n']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_n']->value['index'] : null)];?>
"></span>
                    <?php
}
}
?>
                    <?php echo $_smarty_tpl->tpl_vars['media']->value;?>

                </small>

            </h1>

            <p><?php echo $_smarty_tpl->tpl_vars['product']->value->getDescrizione();?>
</p>

            <?php if ($_smarty_tpl->tpl_vars['logged']->value && $_smarty_tpl->tpl_vars['isCliente']->value) {?>
                <?php if ($_smarty_tpl->tpl_vars['product']->value->getQta() != 0) {?>
                    <a href="/lunova/Carrello/Add/<?php echo $_smarty_tpl->tpl_vars['product']->value->getID();?>
">
                        <button class="btn btn-primary btn-sm btn-block rounded-0" type="submit" >Aggiungi al carrello</button>
                    </a>
                <?php }?>
                <?php if ($_smarty_tpl->tpl_vars['product']->value->getQta() == 0) {?>
                    <button class="btn btn-primary btn-sm btn-block rounded-0 disabled">Aggiungi al carrello</button>
                <?php }?>
            <?php } elseif ($_smarty_tpl->tpl_vars['logged']->value == false) {?>
                <button class="btn btn-primary btn-sm btn-block rounded-0" type="submit" disabled>Aggiungi al carrello</button>
            <?php }?>


            <h5 class="text-secondary" style="margin-top: 20px">
                <?php echo '<script'; ?>
>
                    var x ;
                    var y;
                    var result;

                    x = <?php echo $_smarty_tpl->tpl_vars['product']->value->getQta();?>
;
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

                <?php echo '</script'; ?>
>
            </h5>
            <hr>
            <h3>€ <?php echo $_smarty_tpl->tpl_vars['product']->value->getPrezzo();?>
 </h3>


            
            <?php if ($_smarty_tpl->tpl_vars['logged']->value) {?>
                <?php if ($_smarty_tpl->tpl_vars['votazione']->value == false) {?>
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
                    <input type="hidden" name="disco" value="<?php echo $_smarty_tpl->tpl_vars['product']->value->getID();?>
">
                    <button type="submit" class="btn btn-warning">vota</button>
                </div>
            </form>

                <?php }?>
            <?php }?>
            <?php if ($_smarty_tpl->tpl_vars['logged']->value == false) {?>
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
                        <input type="hidden" name="disco" value="<?php echo $_smarty_tpl->tpl_vars['product']->value->getID();?>
">
                        <button type="submit" id="rate" title="Effettua il login per votare" class="btn btn-warning" disabled >vota</button>
                    </div>
                </form>

            <?php }?>
        </div>
    </div>
</div>


<!-- commenti -->
<div id="main" class="container" style="margin-top:100px; height: fit-content">

    <!-- Add comment -->
    <div class="d-flex mb-3">
        <?php if ($_smarty_tpl->tpl_vars['logged']->value) {?>
            <!-- Comment box  -->
            <form class="w-100" method="post" action="/lunova/Commento/scriviCommento">
                <textarea id="commento" data-autoresize class="form-control pe-4 bg-light bg-opacity-50" name="commento" rows="1" placeholder="Add a comment..."></textarea>
                <input hidden name="disco" value="<?php echo $_smarty_tpl->tpl_vars['product']->value->getID();?>
">
                <button type="submit" class="btn btn-primary">Invia</button>
            </form>
        <?php } else { ?>
            <form class="w-100" method="post" action="/lunova/Commento/scriviCommento">
                <textarea id="commento" data-autoresize class="form-control pe-4 bg-light bg-opacity-50" name="commento" rows="1" placeholder="Effettua il login per poter pubblicare commenti"></textarea>
                <input hidden name="disco" value="<?php echo $_smarty_tpl->tpl_vars['product']->value->getID();?>
">
                <button type="submit" class="btn btn-primary disabled">Invia</button>
            </form>
        <?php }?>
    </div>

    <?php
$__section_nr_1_loop = (is_array(@$_loop=$_smarty_tpl->tpl_vars['commenti']->value) ? count($_loop) : max(0, (int) $_loop));
$__section_nr_1_total = $__section_nr_1_loop;
$_smarty_tpl->tpl_vars['__smarty_section_nr'] = new Smarty_Variable(array());
if ($__section_nr_1_total !== 0) {
for ($__section_nr_1_iteration = 1, $_smarty_tpl->tpl_vars['__smarty_section_nr']->value['index'] = 0; $__section_nr_1_iteration <= $__section_nr_1_total; $__section_nr_1_iteration++, $_smarty_tpl->tpl_vars['__smarty_section_nr']->value['index']++){
?>
    <!-- Comment wrap START -->
    <ul class="comment-wrap list-unstyled">
        <!-- Comment item START -->
        <li class="comment-item">
            <div class="d-flex position-relative">
                <!-- Avatar -->
                <div class="avatar avatar-xs">
                    <?php if (!is_null($_smarty_tpl->tpl_vars['commenti']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_nr']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_nr']->value['index'] : null)]->getCliente()->getImmProfilo())) {?>
                        <a href="#!"><img style="width: 50px;height: 50px;position: relative;overflow: hidden;border-radius: 50%;" src="data:<?php echo $_smarty_tpl->tpl_vars['commenti']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_nr']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_nr']->value['index'] : null)]->getCliente()->getImmProfilo()->getFormato();?>
;base64,<?php echo $_smarty_tpl->tpl_vars['commenti']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_nr']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_nr']->value['index'] : null)]->getCliente()->getImmProfilo()->getImmagine();?>
" alt=""></a>
                    <?php }?>
                    <?php if (is_null($_smarty_tpl->tpl_vars['commenti']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_nr']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_nr']->value['index'] : null)]->getCliente()->getImmProfilo())) {?>
                        <a href="#!"><img class="avatar-img rounded-circle" style="width= 50 px; height: 50px;" src="../../Utility/img/icona_profilo_utente.jpg" alt=""></a>
                    <?php }?>
                </div>
                <div class="ms-2">
                    <!-- Comment by -->
                    <div class="bg-light rounded-start-top-0 p-3 rounded bg-opacity-75">
                        <div class="d-flex justify-content-between">
                            <h6 class="mb-1"> <a href="/lunova/Profile/users/<?php echo $_smarty_tpl->tpl_vars['commenti']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_nr']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_nr']->value['index'] : null)]->getCliente()->getIdClient();?>
"> <?php echo $_smarty_tpl->tpl_vars['commenti']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_nr']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_nr']->value['index'] : null)]->getCliente()->getUsername();?>
</a></h6>
                            <small class="ms-2"><?php echo $_smarty_tpl->tpl_vars['commenti']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_nr']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_nr']->value['index'] : null)]->getData();?>
</small>
                        </div>
                        <p class="small mb-0"><?php echo $_smarty_tpl->tpl_vars['commenti']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_nr']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_nr']->value['index'] : null)]->getDescrizione();?>
</p>
                    </div>
                    <!-- Comment react -->
                    <ul class="nav nav-divider py-2 small">
                        <?php if ($_smarty_tpl->tpl_vars['logged']->value) {?>
                            <?php if (!in_array($_smarty_tpl->tpl_vars['commenti']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_nr']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_nr']->value['index'] : null)]->getId(),$_smarty_tpl->tpl_vars['arr']->value)) {?>
                        <li class="nav-item">
                            <a class="nav-link" onmouseover="this.style.color='red'" onmouseleave="this.style.color='#32fbe2'" href="/lunova/Commento/votazioneCommento/<?php echo $_smarty_tpl->tpl_vars['commenti']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_nr']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_nr']->value['index'] : null)]->getId();?>
/<?php echo $_smarty_tpl->tpl_vars['product']->value->getID();?>
">Like (<?php echo (($tmp = $_smarty_tpl->tpl_vars['nmp']->value[$_smarty_tpl->tpl_vars['commenti']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_nr']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_nr']->value['index'] : null)]->getId()] ?? null)===null||$tmp==='' ? 0 ?? null : $tmp);?>
)</a>
                        </li>
                            <?php }?>
                            <?php if (in_array($_smarty_tpl->tpl_vars['commenti']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_nr']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_nr']->value['index'] : null)]->getId(),$_smarty_tpl->tpl_vars['arr']->value)) {?>
                        <li class="nav-item">
                            <a class="nav-link" style="color: red" onmouseover="this.style.color='#32fbe2'" onmouseleave="this.style.color='red'" href="/lunova/Commento/eliminaMP/<?php echo $_smarty_tpl->tpl_vars['commenti']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_nr']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_nr']->value['index'] : null)]->getId();?>
/<?php echo $_smarty_tpl->tpl_vars['product']->value->getID();?>
">Like (<?php echo (($tmp = $_smarty_tpl->tpl_vars['nmp']->value[$_smarty_tpl->tpl_vars['commenti']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_nr']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_nr']->value['index'] : null)]->getId()] ?? null)===null||$tmp==='' ? 0 ?? null : $tmp);?>
)</a>
                        </li>
                            <?php }?>

                            <?php if ($_smarty_tpl->tpl_vars['proprieta']->value == $_smarty_tpl->tpl_vars['commenti']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_nr']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_nr']->value['index'] : null)]->getCliente()->getIdClient()) {?>
                                <li class="nav-item">
                                    <a class="nav-link" href="/lunova/Commento/cancellaCommento/<?php echo $_smarty_tpl->tpl_vars['commenti']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_nr']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_nr']->value['index'] : null)]->getId();?>
/<?php echo $_smarty_tpl->tpl_vars['product']->value->getID();?>
"> Elimina</a>
                                </li>
                            <?php }?>

                            <?php if ($_smarty_tpl->tpl_vars['proprieta']->value != $_smarty_tpl->tpl_vars['commenti']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_nr']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_nr']->value['index'] : null)]->getCliente()->getIdClient()) {?>
                                <li class="nav-item" >
                                    <a class="nav-link" href="/lunova/Commento/segnalaCommento/<?php echo $_smarty_tpl->tpl_vars['commenti']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_nr']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_nr']->value['index'] : null)]->getId();?>
/<?php echo $_smarty_tpl->tpl_vars['product']->value->getID();?>
" > Segnala</a>
                                </li>
                            <?php }?>
                        <?php }?>
                        <?php if ($_smarty_tpl->tpl_vars['logged']->value == false) {?>
                            <li class="nav-item">
                                <a class="nav-link disabled" href="#!"> Like (<?php echo (($tmp = $_smarty_tpl->tpl_vars['nmp']->value[$_smarty_tpl->tpl_vars['commenti']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_nr']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_nr']->value['index'] : null)]->getId()] ?? null)===null||$tmp==='' ? 0 ?? null : $tmp);?>
)</a>
                            </li>

                                <li class="nav-item" >
                                    <a class="nav-link disabled" href="#!" > Segnala</a>
                                </li>

                        <?php }?>
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
            <?php
}
}
?>

    </div>
</div>

<!-- footer -->

<footer class="bg-dark">
    <hr>
    <p class="container text-light">Copyright &copy; 2022 </p>
</footer>

<?php echo '<script'; ?>
 src="https://bootswatch.com/_vendor/jquery/dist/jquery.min.js"><?php echo '</script'; ?>
>
<?php echo '<script'; ?>
 src="https://bootswatch.com/_vendor/bootstrap/dist/js/bootstrap.bundle.min.js"><?php echo '</script'; ?>
>
<?php echo '<script'; ?>
 src="https://bootswatch.com/_vendor/prismjs/prism.js"><?php echo '</script'; ?>
>

<!--<?php echo '<script'; ?>
 src="<?php echo '<?php'; ?>
 //echo ROOT_URL; <?php echo '?>'; ?>
assets/js/main.js"><?php echo '</script'; ?>
>-->
</body>
</html><?php }
}
