<?php
/* Smarty version 4.2.1, created on 2023-02-19 23:06:15
  from 'C:\xampp\htdocs\lunova\Smarty\smarty-dir\templates\cart.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.2.1',
  'unifunc' => 'content_63f29d57291fb5_54603544',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'bc918b062fc5f506c7ae1da3512d5668763b09a1' => 
    array (
      0 => 'C:\\xampp\\htdocs\\lunova\\Smarty\\smarty-dir\\templates\\cart.tpl',
      1 => 1676844371,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_63f29d57291fb5_54603544 (Smarty_Internal_Template $_smarty_tpl) {
?><!-- header -->
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



			<ul class="navbar-nav ml-4">
				<li class="nav-item">
					<a class="nav-link" href="/lunova/Carrello/mio_carrello">
						<i class="fas fa-shopping-cart"></i>
						<span class="badge rounded-pill bg-secondary">2</span>
					</a>
				</li>
			</ul>



			<form class="d-flex" style="margin-block-end: 2px;">
				<input class="form-control me-sm-2" type="text" placeholder="Search">
				<button class="btn btn-secondary my-2 my-sm-0" type="submit">Search</button>
			</form>

			<ul class="navbar-nav ml-4">
				<?php if ($_smarty_tpl->tpl_vars['logged']->value) {?>
					<li class="nav-item">

						<a class="nav-link" style="align-items: center " href="/lunova/Carrello/mio_carrello">
							<i class="fa-solid fa-circle-user" style="font-size:24px;"></i>
							<span class="badge rounded-pill bg-secondary">2</span>
						</a>

					</li>

				<?php }?>
				<?php if ($_smarty_tpl->tpl_vars['logged']->value == false) {?>
					<li class="nav-item">

						<a class="nav-link" style="align-items: center " href="/lunova/Login/login">
							<i class="fa-solid fa-circle-user" style="font-size:24px;"></i>
							<span class="badge rounded-pill bg-secondary">2</span>
						</a>

					</li>
				<?php }?>
			</ul>

			</ul>
		</div>
	</div>
</nav>



<!-- end header -->

<?php if ($_smarty_tpl->tpl_vars['logged']->value) {?>
<div id="main" class="container" style="margin-top:80px; height: fit-content">
		<div class="col-12 order-md-last mt-4">
				<h4 class="d-flex justify-content-between align-items-center mb-3">
				  <span >Carrello</span>
				  <span class="badge bg-secondary rounded-pill text.white"><?php echo $_smarty_tpl->tpl_vars['num']->value;?>
 elementi nel carrello</span>
				</h4>

				<ul class="list-group mb-3">
					<?php echo '<script'; ?>
>var prova; prova = 0;<?php echo '</script'; ?>
>
					<?php
$__section_nr_0_loop = (is_array(@$_loop=$_smarty_tpl->tpl_vars['product']->value) ? count($_loop) : max(0, (int) $_loop));
$__section_nr_0_total = $__section_nr_0_loop;
$_smarty_tpl->tpl_vars['__smarty_section_nr'] = new Smarty_Variable(array());
if ($__section_nr_0_total !== 0) {
for ($__section_nr_0_iteration = 1, $_smarty_tpl->tpl_vars['__smarty_section_nr']->value['index'] = 0; $__section_nr_0_iteration <= $__section_nr_0_total; $__section_nr_0_iteration++, $_smarty_tpl->tpl_vars['__smarty_section_nr']->value['index']++){
?>
						<?php if ($_smarty_tpl->tpl_vars['product']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_nr']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_nr']->value['index'] : null)]->getIdItem() == $_smarty_tpl->tpl_vars['disc']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_nr']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_nr']->value['index'] : null)]->getID()) {?>
						  <li class="list-group-item d-flex justify-content-between lh-sm p-4 bg-dark">
							<div class="row w-100" >

								<div class="col-lg-4 col-6">
									<h6 class="my-0"><?php echo $_smarty_tpl->tpl_vars['disc']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_nr']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_nr']->value['index'] : null)]->getTitolo();?>
</h6>
									<small class="text-muted"><?php echo $_smarty_tpl->tpl_vars['disc']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_nr']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_nr']->value['index'] : null)]->getDescrizione();?>
</small>
								</div>

								<div class="col-lg-2 col-6">
									<span class="text-muted">$<?php echo $_smarty_tpl->tpl_vars['disc']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_nr']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_nr']->value['index'] : null)]->getPrezzo();?>
</span>
								</div>
								<div class="col-lg-4 col-6">
									<div class="cart-buttons btn-group" role="group" aria-label="Basic example">
									<form method="post" action="/lunova/Carrello/mio_carrello">
											<input type="hidden" name="idprod" value="<?php echo $_smarty_tpl->tpl_vars['product']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_nr']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_nr']->value['index'] : null)]->getIdItem();?>
">
											<button type="submit" class="btn btn-sm btn-success text-primary"><strong>-</strong></button>

									</form>

								  	<span class="text-muted"><strong><?php echo $_smarty_tpl->tpl_vars['product']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_nr']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_nr']->value['index'] : null)]->getQuantity();?>
</strong></span>

									<form>
										<a href="/lunova/Carrello/Add/<?php echo $_smarty_tpl->tpl_vars['product']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_nr']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_nr']->value['index'] : null)]->getIdItem();?>
">
											<button type="button" class="btn btn-sm btn-success text-primary"><strong>+</strong></button>
										</a>
									</form>
								</div>
								</div>

								<div class="col-lg-2 col-6">
									<strong class ="text-primary">$
										<?php echo '<script'; ?>
>
											var x;
											var y;
											var somma;

											x = <?php echo $_smarty_tpl->tpl_vars['product']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_nr']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_nr']->value['index'] : null)]->getQuantity();?>
;
											y =<?php echo $_smarty_tpl->tpl_vars['disc']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_nr']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_nr']->value['index'] : null)]->getPrezzo();?>
;
											somma= x*y;
											document.write(somma);
											prova = prova + somma;

										<?php echo '</script'; ?>
></strong>
								</div>


							</div>
						  </li>
						<?php }?>
					<?php
}
}
?>


				<!---
				  <li class="list-group-item d-flex justify-content-between bg-light">
					<div class="text-success">
					  <h6 class="my-0">Promo code</h6>
					  <small>EXAMPLECODE</small>
					</div>
					<span class="text-success">−$5</span>
				  </li>
				--->
				  <li class="cart-total list-group-item d-flex justify-content-between p-4">
					<div class="row w-100" >
						<div class="col-lg-4 col-6">
							<span>Totale</span>
						</div>
						<div class="col-lg-6 lg-screen"></div>
						<div class="col-lg-2 col-6">
							<strong>$<?php echo '<script'; ?>
>document.write(prova);<?php echo '</script'; ?>
></strong>
						</div>
					</div>
				  </li>
				</ul>

				<hr>

				<div class="row w-10" >
				  <button class="btn btn-lg btn-secondary" type="button">Checkout</button>
				</div>

		</div>

		</div>

<?php }?>

<div id="main" class="container" style="margin-top:300px; height: fit-content">
</div>

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
