<?php
/* Smarty version 4.2.1, created on 2022-12-08 21:29:15
  from 'C:\xampp\htdocs\lunova\Smarty\smarty-dir\templates\error.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.2.1',
  'unifunc' => 'content_6392491b961586_15488107',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '2110297357fb46f170e24649630a857a132b9386' => 
    array (
      0 => 'C:\\xampp\\htdocs\\lunova\\Smarty\\smarty-dir\\templates\\error.tpl',
      1 => 1670531353,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_6392491b961586_15488107 (Smarty_Internal_Template $_smarty_tpl) {
?><link rel="stylesheet" type="text/css" href="https://bootswatch.com/5/vapor/bootstrap.css">
<?php if ($_smarty_tpl->tpl_vars['logged']->value) {?>
    <div id="main" class="container" style="margin-top:100px;">
        <div class="alert alert-dismissible alert-danger">
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            <h4 class="alert-heading">Attenzione!</h4>
            <strong>Ops! qualcosa è andato storto... </strong> <a href="/lunova/RicercaDisco/index" class="alert-link">Clicca qui</a> per tornare indietro.
        </div>
    </div>
<?php }?>

<?php }
}
