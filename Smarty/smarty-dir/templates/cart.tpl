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
	<script defer src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>


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
						<span class="badge rounded-pill bg-secondary">{$num}</span>
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
				  <span class="badge bg-secondary rounded-pill text.white">{$num} elementi nel carrello</span>
				</h4>

				<ul class="list-group mb-3">
					<script>var prova; prova = 0;</script>
					{section name = nr loop= $product }
						{if $product[nr]->getIdItem() == $disc[nr]->getID()}
						  <li class="list-group-item d-flex justify-content-between lh-sm p-4 bg-dark">
							<div class="row w-100" >

								<div class="col-lg-4 col-6">
									<h6 class="my-0">{$disc[nr]->getTitolo()}</h6>
									<small class="text-muted">{$disc[nr]->getDescrtaglio()}</small>
								</div>

								<div class="col-lg-2 col-6">
									<span class="text-muted">${$disc[nr]->getPrezzo()}</span>
								</div>
								<div class="col-lg-4 col-6">
									<div class="cart-buttons btn-group" role="group" aria-label="Basic example">
									<form method="post" action="/lunova/Carrello/mio_carrello">
										<a href="/lunova/Carrello/Minus/{$product[nr]->getIdItem()}">
											<button type="button" class="btn btn-sm btn-success text-primary"><strong>-</strong></button>
										</a>

									</form>

								  	<span class="text-muted"><strong>{$product[nr]->getQuantity()}</strong></span>

									<form>
										<a href="/lunova/Carrello/Add/{$product[nr]->getIdItem()}">
											<button type="button" class="btn btn-sm btn-success text-primary"><strong>+</strong></button>
										</a>
									</form>
								</div>
								</div>

								<div class="col-lg-2 col-6">
									<strong class ="text-primary">€
										<script>
											var x;
											var y;
											var somma;
											var provaa;

											x = {$product[nr]->getQuantity()};
											y ={$disc[nr]->getPrezzo()};
											somma= x*y;
											document.write(somma.toFixed(2));
											prova = prova + somma;
											provaa = prova.toFixed(2);


										</script></strong>
								</div>


							</div>
						  </li>
						{/if}
					{/section}


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
							<strong>€ <script>document.write(provaa);</script></strong>
						</div>
					</div>
				  </li>
				</ul>

				<hr>

			<!--
				<div class="row w-10" >
				  		<button  id ="check" onclick="document.getElementById('box').style.display='block'" class="btn btn-lg btn-secondary" type="button">Checkout</button>

				</div>
				-->
			<a href="/lunova/Ordini/AddToOrdini">
				<div class="row w-10" >
					<button  class="btn btn-lg btn-secondary" type="button">Checkout</button>

				</div>
			</a>



		</div>


		</div>




	<!-- Modal -->
	<div id="box" class="modal">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title">Il tuo acquisto è avvenuto con successo!</h5>
					<button type="button" class ="btn-close" data-bs-="modal"  aria-label="Close">
							<span aria-hidden="true"></span>
						</button>
				</div>
				<div class="modal-body">
					<p>Grazie per aver scelto Lunova.</p>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-primary">Vedi ordini</button>
					<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
				</div>
			</div>
		</div>
	</div>


{/if}

<div id="main" class="container" style="margin-top:300px; height: fit-content">
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