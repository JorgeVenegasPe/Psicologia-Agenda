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
    require 'Header.php';
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
// Inicializa un arreglo para almacenar los títulos de los productos (value0 y title)
$productos_titulos = array();
// Recibir y mostrar los productos enviados mediante POST
if (isset($_POST['productos'])) {
    $productos = json_decode($_POST['productos'], true);
    $productos_sin_etiquetas = array(); // Crear un arreglo para los valores de value0 y title

    foreach ($productos as $producto) {
        // Asigna la imagen del producto a la variable $imagen
        $imagen = $producto['image'];

        // Agrega el producto actual al arreglo de productos almacenados
        $productos_almacenados[] = array(
            'title' => $producto['title'],
            'quantity' => $producto['quantity'],
            'price' => $producto['price'],
            'image' => $imagen, // Aquí asignamos la imagen
            'value1' => $producto['value1'],
            'value0' => $producto['value0'],
        );

        // Agrega el valor de 'value0' y el 'title' al arreglo de productos_titulos
        $productos_titulos[] = array(
            'value0' => $producto['value0'],
            'title' => $producto['title'],
            'price' => intval(substr($producto['price'], 3))
        );

        // Agrega el valor de 'value0' y el 'title' al arreglo sin etiquetas
        $productos_sin_etiquetas[] = array(
            $producto['value0'],
            $producto['title'],
            $producto['price']
        );

        ?>
        <div class="producto-en-pago">
            <div class="products">  
                <img src="<?=$imagen ?>" alt="<?=$producto['title'] ?>">
                <p><?=$producto['quantity'] ?></p>
                <h3><?=$producto['title'] ?></h3>
                <p style="display: none;"><?=$producto['value1'] ?></p>
                <p style="display: none;"><?=$producto['value0'] ?></p>
                <p style="display: none;"><?=intval(substr($producto['price'], 3)) ?></p>
            </div>
            <?php
            $Total = intval($producto['quantity']) * intval(substr($producto['price'], 3));;
            ?>
            <p>S/<?= $Total ?>.00</p>
        </div>
        <?php
    }

    // Convertir $productos_sin_etiquetas en una cadena JSON
    $productosJSON = json_encode($productos_sin_etiquetas);

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
        <form class="FormSeleccionTienda" method="post">
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
			    	<select name="dias" id="dias">
			    		<option value="Lunes">Lunes</option>
			    		<option value="Martes">Martes</option>
			    		<option value="Miercoles">Miercoles</option>
			    		<option value="Jueves">Jueves</option>
			    	</select>
			    </div>
			    <div class="inputs-selects">
			    	<h4 for="">Horarios</h4>
			    	<select name="Horario" id="Horarios">
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

        <form class="FormDatos active" method="post">
		    <h1 style="text-align: center;">Datos de facturizacion</h1>
		    <div class="box-input">
		    	<h4>Recoger en tienda:</h4>
                <h5> Av. Arenales 963, Cercado de Lima, Perú</h5>
                <h6>LIMA, LIMA, LIMA, PERÚ</h6>
		    	<a href="">Cambiar</a>
                <br>
                <br>
                <input type="hidden" name="ubicacion" id="ubicacion" value=" Av. Arenales 963, Cercado de Lima, Perú">
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
		            		<option value="DNI" class="dni">DNI</option>
		            		<option value="Pasaporte">Pasaporte</option>
		            		<option value="Carnet de extranjeria">Carnet de extranjeria</option>
			        	</select>
			        </div>
                </div>
                <div class="box-input">
		        	<label class="labelimp" for="telefono"> Numero de Decumento:</label>
		        	<input name="n_document" id="n_document" type="text" required>
		        </div>
		        <div class="box-input" style="display: none;">
		        	<label class="labelimp" for="telefono"> Razon Social:</label>
		        	<input name="referencia" id="referencia" type="text" >
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
                <button  type="submit" class="button-T" name="register2" id="register2">
            <i class="ri-arrow-right-line"></i>
            <p class="text finalcomp">Finalizar Compra</p>
        </button>
    
            </div>
            </div>
            <?php
                $valorTotal = 0; // Inicializa el valor total a 0

                if (isset($_POST['productos'])) {
                $productos = json_decode($_POST['productos'], true);

                foreach ($productos as $producto) {
                $valorTotal += intval($producto['quantity']) * intval(substr($producto['price'], 3));
                    }   
                }
            ?>
            <input type="hidden" name="tipo_entrega" id="tipo_entrega_input" value="Recojo en Tienda">
            <input type="hidden"  name="total_input" id="total_input" value="<?= $valorTotal  ?>">
            <input type="hidden" name="productos_titulos" id="productos_titulos_input" value="<?= htmlspecialchars(json_encode($productos_titulos)) ?>">
            <input type="hidden" name="dia" id="dia" value="">
            <?php
                $categoria = isset($_GET['id']) ? $_GET['id'] : '';
            ?>
            <input type="hidden" name="categoria" id="categoria" value="<?= $categoria  ?>">

		</form>
    </div>
</div>

<script>
    // Obtén el elemento select del primer formulario y el campo oculto del segundo formulario
    const selectDiaForm1 = document.getElementById("dias");
    const inputDiaForm2 = document.getElementById("dia");

    // Agrega un evento change al select del primer formulario
    selectDiaForm1.addEventListener("change", function() {
        // Obtén el valor seleccionado del select del primer formulario
        const dia = selectDiaForm1.value;

        // Si el valor seleccionado es vacío, establece "Lunes" como valor por defecto
        const valorPorDefecto = dia || "Lunes";

        // Asigna el valor al campo oculto del segundo formulario
        inputDiaForm2.value = valorPorDefecto;
    });

    // Establece "Lunes" como valor inicial en el campo oculto
    inputDiaForm2.value = "Lunes";
</script>



<?php
include ('Registrar2.php');
?>




<!-- Delivery-->
<div class="service-modal modalformdv flex-center">
    <div class="service-modal-body">
        <i class="fas fa-times modal-close-btn"></i>
        <form class="FormDatosDelivery active" method="post">
		    <h1 style="text-align: center;">Informacion de Contacto</h1>
		    <div class="box-input">
		    	<label class="labelimp" for="telefono"> Nombre y Apellido</label>
		    	<input name="nombre_cliente" id="nombre_cliente" type="text" required>
		    </div>
            <div class="box-input-total">
                <div class="box-input">
			        <label for="">Documento:</label>
                    <div class="inputs-selects">
			        	<select style="text-align:center" name="documento" id="documento">
		            		<option value="DNI" class="dni">DNI</option>
		            		<option value="Pasaporte">Pasaporte</option>
		            		<option value="Carnet de extranjeria">Carnet de extranjeria</option>
			        	</select>
			        </div>
                </div>
                <div class="box-input">
		        	<label class="labelimp" for="telefono"> Numero de Decumento:</label>
		        	<input name="n_document" id="n_document" type="text" required>
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
		    <h1 style="text-align: center;">Direccion de Envio</h1>
            <div class="box-input">
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
		    <div class="box-input">
		    	<label class="labelimp" for="telefono">Referencia</label>
		    	<textarea name="referencia" id="referencia" required></textarea>
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
		        <input type="checkbox" value="Acepto los Términos y Condiciones y Políticas de privacidad">
                <p>Acepto los Términos y Condiciones y Políticas de privacidad</p>
		    </div>
            <div class="container-butt">
                <a href="Pods.php" class="button-T">
                    <i class="ri-arrow-left-line"></i>
                    <p class="text">Seguir Comprando </p>
                </a>
                <div class="container-butt">
                <button type="submit" class="button-T" name="register" id="register">
            <i class="ri-arrow-right-line"></i>
            <p class="text finalcomp">Finalizar Compra</p>
        </button>
    </div>
            </div>
            <?php
                $valorTotal = 0; // Inicializa el valor total a 0

                if (isset($_POST['productos'])) {
                $productos = json_decode($_POST['productos'], true);

                foreach ($productos as $producto) {
                $valorTotal += intval($producto['quantity']) * intval(substr($producto['price'], 3));
                    }   
                }
            ?>            
            <input type="hidden" name="tipo_entrega" id="tipo_entrega_input" value="Delivery">
            <input type="hidden"  name="total_input" id="total_input" value="<?= $valorTotal  ?>">
            <input type="hidden" name="productos_titulos" id="productos_titulos_input" value="<?= htmlspecialchars(json_encode($productos_titulos)) ?>">
            <?php
                $categoria = isset($_GET['id']) ? $_GET['id'] : '';
            ?>
            <input type="hidden" name="categoria" id="categoria" value="<?= $categoria  ?>">
		</form>
    </div>
</div>

<?php
include ('Registrar.php');
?>



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