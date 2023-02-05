<!-- header -->
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
				{if $logged==false}
					<li class="nav-item">
						<a class="nav-link" href="/lunova/Login/login">Login</a>
					</li>
				{/if}
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
				{if $logged}
					<li class="nav-item">

						<a class="nav-link" style="align-items: center " href="/lunova/Carrello/mio_carrello">
							<i class="fa-solid fa-circle-user" style="font-size:24px;"></i>
							<span class="badge rounded-pill bg-secondary">2</span>
						</a>

					</li>

				{/if}
				{if $logged==false}
					<li class="nav-item">

						<a class="nav-link" style="align-items: center " href="/lunova/Login/login">
							<i class="fa-solid fa-circle-user" style="font-size:24px;"></i>
							<span class="badge rounded-pill bg-secondary">2</span>
						</a>

					</li>
				{/if}
			</ul>

			</ul>
		</div>
	</div>
</nav>



<!-- end header -->

{if $logged}
<div id="main" class="container" style="margin-top:80px; height: fit-content">
		<div class="col-12 order-md-last mt-4">
				<h4 class="d-flex justify-content-between align-items-center mb-3">
				  <span >Carrello</span>
				  <span class="badge bg-secondary rounded-pill text.white">3 elementi nel carrello</span>
				</h4>

				<ul class="list-group mb-3">
				  <li class="list-group-item d-flex justify-content-between lh-sm p-4 bg-dark">
					<div class="row w-100" >

						<div class="col-lg-4 col-6">
							<h6 class="my-0">Product name</h6>
							<small class="text-muted">Brief description</small>
						</div>

						<div class="col-lg-2 col-6">
							<span class="text-muted">$5.00</span>
						</div>
						<div class="col-lg-4 col-6">
							<div class="cart-buttons btn-group" role="group" aria-label="Basic example">
						  <button type="button" class="btn btn-sm btn-success text-primary"><strong>-</strong></button>
						  <span class="text-muted"><strong>2</strong></span>
						  <button type="button" class="btn btn-sm btn-success text-primary"><strong>+</strong></button>
						</div>
						</div>

						<div class="col-lg-2 col-6">
							<strong class ="text-primary">$10.00</strong>
						</div>


					</div>
				  </li>

				  <li class="list-group-item d-flex justify-content-between lh-sm p-4 bg-dark">
					<div class="row w-100" >

						<div class="col-lg-4 col-6">
							<h6 class="my-0">Product name</h6>
							<small class="text-muted">Brief description</small>
						</div>

						<div class="col-lg-2 col-6">
							<span class="text-muted">$5.00</span>
						</div>
						<div class="col-lg-4 col-6">
							<div class="cart-buttons btn-group" role="group" aria-label="Basic example">
								  <button type="button" class="btn btn-sm btn-success text-primary"><strong>-</strong></button>
								  <span class="text-muted"><strong>2</strong></span>
								  <button type="button" class="btn btn-sm btn-success text-primary"><strong>+</strong></button>
								</div>
						</div>

						<div class="col-lg-2 col-6">
							<strong class ="text-primary">$10.00</strong>
						</div>


					</div>
				  </li>

				  <li class="list-group-item d-flex justify-content-between bg-light">
					<div class="text-success">
					  <h6 class="my-0">Promo code</h6>
					  <small>EXAMPLECODE</small>
					</div>
					<span class="text-success">−$5</span>
				  </li>

				  <li class="cart-total list-group-item d-flex justify-content-between p-4">
					<div class="row w-100" >
						<div class="col-lg-4 col-6">
							<span>Totale</span>
						</div>
						<div class="col-lg-6 lg-screen"></div>
						<div class="col-lg-2 col-6">
							<strong>$50.00</strong>
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

{/if}

<div id="main" class="container" style="margin-top:100px; height: fit-content">
</div>

<footer class="bg-dark">
	<hr>
	<p class="container text-light">Copyright &copy; 2022 </p>
</footer>

<script src="https://bootswatch.com/_vendor/jquery/dist/jquery.min.js"></script>
<script src="https://bootswatch.com/_vendor/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://bootswatch.com/_vendor/prismjs/prism.js"></script>

<!--<script src="<?php //echo ROOT_URL; ?>assets/js/main.js"></script>-->
</body>
</html>