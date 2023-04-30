<?php
/* Smarty version 4.2.1, created on 2023-04-29 19:27:54
  from 'C:\xampp\htdocs\lunova\Smarty\smarty-dir\templates\successorder.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.2.1',
  'unifunc' => 'content_644d539aaa6325_27619723',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '242a97a5c01db7ce41f13a70c20b4624f6235008' => 
    array (
      0 => 'C:\\xampp\\htdocs\\lunova\\Smarty\\smarty-dir\\templates\\successorder.tpl',
      1 => 1677341342,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_644d539aaa6325_27619723 (Smarty_Internal_Template $_smarty_tpl) {
?><link rel="stylesheet" type="text/css" href="https://bootswatch.com/5/vapor/bootstrap.css">
<?php if ($_smarty_tpl->tpl_vars['logged']->value) {?>
    <div class = "container">
    <div class="alert alert-dismissible alert-info"  style="margin-top:100px;">
        <strong>Il tuo ordine è stato eseguito!</strong> Grazie per aver scelto Lunova.
        <a href="/lunova/" class="alert-link">
            Torna alla home</a>

    </div>
        <a href="/lunova/Ordini/tutti">
            <button type="button" class="btn btn-primary">Vedi ordini</button>
        </a>
    </div>
<?php }
}
}
