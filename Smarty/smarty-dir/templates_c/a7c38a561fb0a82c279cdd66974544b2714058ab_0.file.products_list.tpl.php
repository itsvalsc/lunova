<?php
/* Smarty version 4.2.1, created on 2022-11-25 12:04:36
  from 'C:\xampp\htdocs\lunova\Smarty\smarty-dir\templates\products_list.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.2.1',
  'unifunc' => 'content_6380a144d6aec2_59405009',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'a7c38a561fb0a82c279cdd66974544b2714058ab' => 
    array (
      0 => 'C:\\xampp\\htdocs\\lunova\\Smarty\\smarty-dir\\templates\\products_list.tpl',
      1 => 1669303234,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_6380a144d6aec2_59405009 (Smarty_Internal_Template $_smarty_tpl) {
echo '<?php'; ?>
 include ('header.tpl'); <?php echo '?>'; ?>

<div class ='row'>
    <?php
$__section_nr_0_loop = (is_array(@$_loop=$_smarty_tpl->tpl_vars['product']->value) ? count($_loop) : max(0, (int) $_loop));
$__section_nr_0_total = $__section_nr_0_loop;
$_smarty_tpl->tpl_vars['__smarty_section_nr'] = new Smarty_Variable(array());
if ($__section_nr_0_total !== 0) {
for ($__section_nr_0_iteration = 1, $_smarty_tpl->tpl_vars['__smarty_section_nr']->value['index'] = 0; $__section_nr_0_iteration <= $__section_nr_0_total; $__section_nr_0_iteration++, $_smarty_tpl->tpl_vars['__smarty_section_nr']->value['index']++){
?>


            <div class="card" style="width: 18rem;">
                <img src="https://media.istockphoto.com/photos/vinyl-record-picture-id134119615?k=20&m=134119615&s=612x612&w=0&h=zI6Fig1j8mbZp16CgvaDRMPHAzTaBNhhcBR0AldRXtw=" alt="prova">
                <div class="card-body">
                    <h5 class="card-title"> <?php echo $_smarty_tpl->tpl_vars['product']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_nr']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_nr']->value['index'] : null)]->getTitolo();?>
 </h5>
                    <h6 class = "card-subtitle mb-2 text-muted"><?php echo $_smarty_tpl->tpl_vars['product']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_nr']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_nr']->value['index'] : null)]->getPrezzo();?>
</h6>
                    <p class="card-text"><?php echo $_smarty_tpl->tpl_vars['product']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_nr']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_nr']->value['index'] : null)]->getDescrizione();?>
</p>
                    <!--<button class="btn btn-secondary btn-sm btn-block rounded-0" onclick="location.href='<?php echo '<?php'; ?>
 //echo ROOT_URL . '?page=view-product&id=' . esc_html($product->getID()); <?php echo '?>'; ?>
'">Vedi</button>-->
                    <button class="btn btn-secondary btn-sm btn-block rounded-0" onclick="#">Vedi</button>
                    <form method="post">
                        <!--<input type="hidden" name="id" value="<?php echo '<?php'; ?>
// echo esc_html($product->getID()); <?php echo '?>'; ?>
">-->
                        <input type="hidden" name="id" value="#"
                        <input name="add_to_cart" type="submit" class="btn btn-primary btn-sm btn-block rounded-0" value="Aggiungi al carrello">
                    </form>
                </div>
            </div>
    <?php
}
}
?>


</div>
<?php }
}
