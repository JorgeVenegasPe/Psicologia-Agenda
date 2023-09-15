<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../Issets/css/main.css"/>
  <link rel="stylesheet" href="https://unpkg.com/boxicons@latest/css/boxicons.min.css" />
  <link rel="stylesheet" href="../Issets/css/main.css"/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta2/css/all.min.css">
  <link href="https://cdn.jsdelivr.net/npm/remixicon@2.5.0/fonts/remixicon.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@9/swiper-bundle.min.css"/>
    <title>Pagos</title>
</head>
<body>
    <style>
        .a{
            display: none;
        }
        .container-butt{
            display: flex;
            justify-content: space-between;   
        }
        a{
            text-decoration: none;
        }
        .aaa{
            display: flex;
            gap: 10px; 
            flex-direction: row;
        }
        .aaa input[type="checkbox"] {
        width: 40px;
        margin: 0;
    }
    </style>
  <!-- Header  -->
  <?php
    require 'Header.php'
  ?>
  
<main>
    <div class="container-butt">
        <a href="Pods.php" class="button-T">
            <i class="ri-arrow-left-line"></i>
            <p class="text">Seguir Comprando </p>
        </a>
    </div>
    <div class="container-productos-pago" id="productos-en-pago">
    <?php
// Inicializa un arreglo para almacenar los productos
$productos_almacenados = array();
// Inicializa un arreglo para almacenar los títulos de los productos
$productos_titulos = array();
// Recibir y mostrar los productos enviados mediante POST
if (isset($_POST['productos'])) {
    $productos = json_decode($_POST['productos'], true);
    foreach ($productos as $producto) {
        $productos_titulos[] = $producto['title'];
        ?>
        <div class="producto-en-pago">
            <div class="products">  
                <img  src="<?=$producto['image'] ?>" alt="<?=$producto['title'] ?>">
                <p><?=$producto['quantity'] ?></p>
                <h3><?=$producto['title'] ?></h3>
            </div>
            <?php
            $Total = intval($producto['quantity']) * intval(substr($producto['price'], 3));;
            ?>
            <p>S/<?= $Total ?>.00</p>
        </div>
        <?php

        // Agrega el producto actual al arreglo
        $productos_almacenados[] = array(
            'title' => $producto['title'],
            'quantity' => $producto['quantity'],
            'price' => $producto['price'],
            'image' => $producto['image']
        );
    }

    // Obtener el valor de valorTotal
    $valorTotal = isset($_POST['valorTotal']) ? $_POST['valorTotal'] : '0';
}
?>

        <div class="total" name="total" id="total">
            <h2>Total: </h2><span><?= $valorTotal ?></span>
        </div>
    </div>
    <div class="container-butt" name="tipo_entrega" id="tipo_entrega" >
        <a class="button-T RecojoTienda">
            <i class="ri-store-fill"></i>
            <p class="text" value="Recojo en tienda">Recojo en tienda</p>
        </a>
        <a class="button-T Delivery">
            <i class="ri-truck-line"></i>
            <p class="text" value="Delivery">Delivery</p>
        </a>
    </div>
</main>

<!-- Recojo en tienda -->
<div class="service-modal modalformrt flex-center">
    <div class="service-modal-body">
        <i class="fas fa-times modal-close-btn"></i>
        <form class="FormSeleccionTienda" >
			<div class="box-input">
				<h1 style="text-align: center;">Selecciona una direccion</h1>
                <br>
                <div class="Seleccion-tienda" style="text-align: center;">
                    <h4>Av. Arenales 963, Cercado de Lima, Perú</h4>
                    <p>LIMA, LIMA, LIMA, PERÚ</p>
                    <br>
                    <br>
                </div>
			</div>
            <div class="box-input">
                <h1 style="text-align: center;">Horario de Recojos</h1>
			    <div class="inputs-selects">
			    	<h4 for="">Dias</h4>
			    	<select name="" id="">
			    		<option value="1">Lunes</option>
			    		<option value="2">Martes</option>
			    		<option value="3">Miercoles</option>
			    		<option value="4">Jueves</option>
			    	</select>
			    </div>
			    <div class="inputs-selects">
			    	<h4 for="">Horarios</h4>
			    	<select name="" id="">
			    		<option value="1">De 6 A.M a 9 P.M</option>
			    	</select>
			    </div>
                <br>
            </div>
            <div class="container-butt">
                <a href="Pods.php" class="button-T">
                    <i class="ri-arrow-left-line"></i>
                    <p class="text">Seguir Comprando </p>
                </a>
                <a class="button-T datos">
                    <p class="text finalcomp">Finalizar Compra</p>
                    <i class="ri-arrow-right-line"></i>
                </a>
            </div>
    	</form>
        <div id="resultado_registro"></div>



        
        <form class="FormDatos active" method="post" action="Registro.php">
		    <h1 style="text-align: center;">Datos de facturizacion</h1>
		    <div class="box-input">
		    	<h4>Recoger en tienda:</h4>
                <h5> Av. Arenales 963, Cercado de Lima, Perú</h5>
                <h6>LIMA, LIMA, LIMA, PERÚ</h6>
		    	<a href="">Cambiar</a>
                <br>
                <br>
		    </div>
            <div class="container-butt" style="justify-content:inherit">
                <a class="button-T active">
                    <i class="ri-arrow-left-line"></i>
                    <p class="text">Boleta</p>
                </a>
                <a class="button-T">
                    <p class="text finalcomp">Factura</p>
                    <i class="ri-arrow-right-line"></i>
                </a>
            </div>
		    <h1 style="text-align: center;">Datos de Personales</h1>
		    <div class="box-input">
		    	<label class="labelimp" for="nombre_cliente"> </label>
		    	<input name="nombre_cliente" id="nombre_cliente" type="text" required>
		    </div>
            <div class="box-input-total">
                <div class="box-input">
			        <label for="">Documento:</label>
                    <div class="inputs-selects">
			        	<select style="text-align:center" name="documento" id="documento">
		            		<option value="1" class="dni">DNI</option>
		            		<option value="2">Pasaporte</option>
		            		<option value="3">Carnet de extranjeria</option>
			        	</select>
			        </div>
                </div>
                <div class="box-input">
		        	<label class="labelimp" for="telefono"> Numero de Decumento:</label>
		        	<input name="n_document" id="n_document" type="text" required>
		        </div>
		        <div class="box-input" style="display: none;">
		        	<label class="labelimp" for="telefono"> Razon Social:</label>
		        	<input name="r_social" id="r_social" type="text" required>
		        </div>
            </div>
		    <div class="box-input">
		    	<label class="labelimp" for="telefono"> Correo Electronico:</label>
		    	<input name="correo" id="correo" type="text" required>
		    </div>
		    <div class="box-input">
		    	<label class="labelimp" for="telefono"> Celular:</label>
		    	<input name="celular" id="celular" type="text" required>
		    </div>
            <div class="box-input" id="distrito" name="distrito" >
			    <label for="">Distrito</label>
                <br>
                <div class="inputs-selects">
			    	<select style="text-align:center" name="distrito" id="distrito">
		        		<option value="Ancon">Ancon</option>
		        		<option value="Puente Piedra">Puente Piedra</option>
		        		<option value="Comas">Comas</option>
			    	</select>
			    </div>
                <br>
            </div>
		    <div class="box-input">
		    	<label class="labelimp" for="telefono"> Direccion:</label>
		    	<input name="direccion" id="direccion" type="text" required>
		    </div>
            <br>
			<div class="metodos-pago">
				<p style="text-align:center;">Metodos de Pago:</p>
				<div class="metodos">
					<a><img class="yape" src="../Issets/img/LogoTipo/LogoYape.png"></a>
					<a><img class="visa" src="../Issets/img/LogoTipo/LogoVisa.png"></a>
					<a><img class="plin" src="../Issets/img/LogoTipo/LogoPlin.png"></a>
				</div>
			</div>
		    <div class="aaa">
		        <input type="checkbox" value="Acepto los Términos y Condiciones y Políticas de privacidad" >
                <p>Acepto los Términos y Condiciones y Políticas de privacidad</p>
		    </div>
            <div class="container-butt">
                <a href="Pods.php" class="button-T">
                    <i class="ri-arrow-left-line"></i>
                    <p class="text">Seguir Comprando </p>
                </a>
                <button type="submit" class="button-T" >
            <i class="ri-arrow-right-line"></i>
            <p class="text finalcomp">Finalizar Compra</p>
        </button>
        
            </div>
            </div><button type="submit" name="register_rt" id="register_rt">Enviar</button>

		</form>
    </div>
</div>

<?php
include ("Registro.php");
?>
<script>
    document.querySelector('#register_rt').addEventListener('click', function() {
    alert('Botón de envío presionado');
});

</script>




<script>
const finalcompra = document.querySelectorAll(".finalcomp");
const FormSeleccionTienda = document.querySelector(".FormSeleccionTienda"); // Cambiado a querySelector
const FormDatos = document.querySelector(".FormDatos"); // Cambiado a querySelector

    finalcompra.forEach((finalcompr, i) => {
        finalcompr.addEventListener("click", () => {
            FormSeleccionTienda.classList.add('active');
            FormDatos.classList.remove('active');
        });
    });

const serviceModalsrt = document.querySelectorAll(".modalformrt");
const serviceModalsdv = document.querySelectorAll(".modalformdv");
const RecojoTiendaBtns = document.querySelectorAll(".RecojoTienda");
const DeliveryBtns = document.querySelectorAll(".Delivery");
const modalCloseBtns = document.querySelectorAll(".modal-close-btn");

    var modalrt = function(modalClick){
        serviceModalsrt[modalClick].classList.add("active");
    }

    var modaldv = function(modalClick){
        serviceModalsdv[modalClick].classList.add("active");
    }

    RecojoTiendaBtns.forEach((RecojoTiendaBtn, i) => {
        RecojoTiendaBtn.addEventListener("click", () => {
            modalrt(i);
      });
    });

    DeliveryBtns.forEach((DeliveryBtn, i) => {
        DeliveryBtn.addEventListener("click", () => {
            modaldv(i);
      });
    });

    modalCloseBtns.forEach((modalCloseBtn) => {
        modalCloseBtn.addEventListener("click", () =>{
            serviceModalsrt.forEach((modalView)=>{ 
                FormSeleccionTienda.classList.remove('active');
                FormDatos.classList.add('active');
                modalView.classList.remove("active");
            });
            serviceModalsdv.forEach((modalView)=>{
                modalView.classList.remove("active");
            });
        });
    });



</script>
<script src="../Issets/js/main.js"></script>
</body>
</html>  