<?php
/* Smarty version 4.2.1, created on 2022-11-24 16:27:08
  from 'C:\xampp\htdocs\lunova\Smarty\smarty-dir\templates\homepage.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.2.1',
  'unifunc' => 'content_637f8d4cb15570_82514985',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'e41b575d8a6974a0dc84ef00e08fc0730a2dc774' => 
    array (
      0 => 'C:\\xampp\\htdocs\\lunova\\Smarty\\smarty-dir\\templates\\homepage.tpl',
      1 => 1669303625,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_637f8d4cb15570_82514985 (Smarty_Internal_Template $_smarty_tpl) {
echo '<?php'; ?>
 include 'header.tpl' <?php echo '?>'; ?>

<h1>Benvenuti</h1>
<!--<p class="lead">Benvenuti nel sito!</p>-->
<p class="lead">Clicca sul bottone per iniziare gli acquisti.</p>
<a href="#" class="btn btn-primary btn-lg mb-5 mt-3">Vai allo Shopping &raquo;</a>

<div id="carouselExampleCaptions" class="carousel slide" data-bs-ride="false">
    <div class="carousel-indicators">
        <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
        <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="1" aria-label="Slide 2"></button>
        <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="2" aria-label="Slide 3"></button>
    </div>
    <div class="carousel-inner">
        <div class="carousel-item active">
            <img src="https://www.rockambula.com/wp-content/uploads/2020/02/dischi-in-uscita-rockambula-808x450.png" class="d-block w-100" alt="...">
            <div class="carousel-caption d-none d-md-block">
                <h5>Acquista da noi tutte le ultime uscite</h5>
                <p>Tutte le ultime novità in campo musicale </p>
            </div>
        </div>
        <div class="carousel-item">
            <img src="https://i.pinimg.com/originals/ec/f3/d2/ecf3d26dcce257844a3f2d07da5c3670.jpg" class="d-block w-100" alt="...">
            <div class="carousel-caption d-none d-md-block">
                <h5>Sei un'artista e vuoi metterti in gioco? Partecipa ai nostri sondaggi</h5>
                <p>ogni settimana scegliamo tre brani da mettere a confronto, ti aspettiamo!</p>
            </div>
        </div>
        <div class="carousel-item">
            <img src="https://www.businessintelligencegroup.it/wp-content/uploads/2021/02/social-community.jpg" class="d-block w-100" alt="...">
            <div class="carousel-caption d-none d-md-block">
                <h5>Entra a far oarte della nostra comunity</h5>
                <p>lascia un commento e confrontati con gli altri utenti</p>
            </div>
        </div>
    </div>
    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Previous</span>
    </button>
    <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Next</span>
    </button>
</div><?php }
}
