<?php
/* Smarty version 4.2.1, created on 2022-11-24 15:47:57
  from 'C:\xampp\htdocs\lunova\Smarty\smarty-dir\templates\index.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.2.1',
  'unifunc' => 'content_637f841d7b8e55_78968039',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '42cce58efe4058265f3f537605601ba68cd16e3a' => 
    array (
      0 => 'C:\\xampp\\htdocs\\lunova\\Smarty\\smarty-dir\\templates\\index.tpl',
      1 => 1669291356,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_637f841d7b8e55_78968039 (Smarty_Internal_Template $_smarty_tpl) {
echo '<?php'; ?>

//$page = isset($_GET['page']) ? $_GET['page'] : 'homepage';
//$page = "login";

<?php echo '?>'; ?>


    <!--<?php echo '<?php'; ?>
// include '../inc/init.php'<?php echo '?>'; ?>

    <?php echo '<?php'; ?>
// include ROOT_PATH . 'public/template-parts/header.tpl' <?php echo '?>'; ?>
-->

<?php echo '<?php'; ?>
 include 'header.tpl' <?php echo '?>'; ?>



    <div id="main" class="container" style="margin-top:100px;">
        <div class="row">
            <div class="col-9">
                <?php echo '<?php'; ?>
 //include  $page .'.php' <?php echo '?>'; ?>

            </div><!-- perchè 12 colonne, gestissco lo spazio, i div sono trasparenti ma se vado a ispezionare lo trovo -->

            <?php echo '<?php'; ?>
 include 'sidebar.tpl' <?php echo '?>'; ?>


        </div>
    </div>
<?php echo '<?php'; ?>
 include 'footer.tpl' <?php echo '?>';
}
}
