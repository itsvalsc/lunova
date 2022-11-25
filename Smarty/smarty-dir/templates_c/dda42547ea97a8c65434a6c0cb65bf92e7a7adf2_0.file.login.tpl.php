<?php
/* Smarty version 4.2.1, created on 2022-11-25 12:45:05
  from 'C:\xampp\htdocs\lunova\Smarty\smarty-dir\templates\login.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.2.1',
  'unifunc' => 'content_6380aac10aa159_90307464',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'dda42547ea97a8c65434a6c0cb65bf92e7a7adf2' => 
    array (
      0 => 'C:\\xampp\\htdocs\\lunova\\Smarty\\smarty-dir\\templates\\login.tpl',
      1 => 1669375670,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_6380aac10aa159_90307464 (Smarty_Internal_Template $_smarty_tpl) {
echo '<?php'; ?>
 include 'header.tpl' <?php echo '?>'; ?>

<?php if ($_smarty_tpl->tpl_vars['log']->value) {?>
        <div class="form-group" style="width: 30rem;">
              <label for="exampleInputEmail1" class="form-label mt-4">Email address</label>
              <input type="email" class="form-control" id="Email" aria-describedby="emailHelp" placeholder="Enter email">
              <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
        </div>

        <div class="form-group" style="width: 30rem;">
              <label for="exampleInputPassword1" class="form-label mt-4">Password</label>
              <input type="password" class="form-control" id="Password" placeholder="Password">
        </div>
        <hr>
        <div class="form-check">
                <input class="form-check-input" type="radio" name="optionsRadios" id="optionsRadios1" value="option1" checked="">
                <label class="form-check-label" for="optionsRadios1">
                  Artista
                </label>

        </div>
        <div class="form-check">
                <input class="form-check-input" type="radio" name="optionsRadios" id="optionsRadios1" value="option2" checked="">
                <label class="form-check-label" for="optionsRadios1">
                  Utente
                </label>
              </div>
        <hr>
        <button type="submit" class="btn btn-primary">Submit</button>

        <button type="button" class="btn btn-primary">Accedi</button>
        <hr>
        <button type="button" class="btn btn-secondary">Inscriviti</button>
<?php }
}
}
