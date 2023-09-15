<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>header</title>
    <link rel="stylesheet" href="../Issets/css/header.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Sharp:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
</head>
<body>
    <header class="header-container">
        <div class="nav-menu-btn"></div>  

        <!-- Logo a la izquierda -->
        <div class="logo">
            <img class="logots" src="../Issets/img/LogoTipo/NombreLogo.png" alt="Logo">
        </div>
        
        <!-- Barra de búsqueda a la derecha -->
        <div style="display: flex; flex-direction:row; align-items:center">
            <div class="container-icons">
                <div class="icons">
                    <div class="nav-close-btn"></div>
	        	    <form class="search a">
	        	    	<input type="text" placeholder="Search" class="search__input"/>
	        	    	<button type="button" class="search__button">
                            <span class="material-symbols-sharp buscador">search</span>
	        	    	</button>
	        	    </form>
					<div class="menu">
                    	<a class="menu-trigger">Productos</a>
                    	<ul class="submenu">
                    	    <li><a href="Pods.php">Pods</a></li>
                    	    <li><a href="Vapers.php">Vapers</a></li>
                    	</ul>
                	</div>
                    <a href="Login.php" class="a">Iniciar Session</a>
                    <a class="perfil"><span class="material-symbols-sharp ii ajuste ">person</span></a>
                    <a href="#"><span class="material-symbols-sharp ii ajuste ">logout</span></a>
                    <a class="iconossss" href="Ajustes.php">Ajuste</a>
                    <a class="iconossss" href="#">Cerrar Session</a>
                </div>
            </div>
            <div class="container-iconos a">
		        <div class="container-cart-icon">
                    <span class="material-symbols-sharp ii carrito">shopping_cart</span>
                    <div class="count-products">
		        	    <span id="contador-productos">0</span>
		            </div>
                </div>
                <div class="container-cart-products hidden-cart">
					<div class="row-product hidden">
						<div class="cart-product">
							<div class="info-cart-product">
								<img class="imagen-producto-carrito">
								<span class="cantidad-producto-carrito"></span>
								<p class="titulo-producto-carrito"></p>
								<span class="precio-producto-carrito"></span>
							</div>
							<svg
								xmlns="http://www.w3.org/2000/svg"
								fill="none"
								viewBox="0 0 24 24"
								stroke-width="1.5"
								stroke="currentColor"
								class="icon-close">
								<path
									stroke-linecap="round"
									stroke-linejoin="round"
									d="M6 18L18 6M6 6l12 12"/>
							</svg>
						</div>
					</div>
					<div class="cart-total">
						<div style="display:flex; flex-direction:row">
							<h3>Total :</h3>
							<span class="total-pagar" id="total-pagar">S/0</span>
						</div>
          				<div class="container-butt">
          				    <button class="button-metod-pago" id="vaciar">Vaciar carrito</button>
          				    <button href="pago.php" class="button-metod-pago pagar" id="btn-continuar-pago">Pagar</a>
          				</div>
						<div class="metodos-pago active">
          				</div>
					</div>
					<p class="cart-empty">El carrito está vacío</p>
					
			    </div>
            </div>
        </div>
    </header>

	<div class="service-modal modalformcg flex-center">
    	<?php
    	require 'Ajustes.php';
   	 	?>
  	</div>
</body>
</html>