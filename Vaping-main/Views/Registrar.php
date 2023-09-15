<?php
$conex = mysqli_connect("localhost", "root", "", "Vaping");

if (!$conex) {
    echo "Error de conexión: " . mysqli_connect_error();
}

if (isset($_POST['register'])) {

    if (strlen($_POST['nombre_cliente']) >= 1 && strlen($_POST['celular']) >= 1 && strlen($_POST['correo']) >= 1 && strlen($_POST['documento']) >= 1  && strlen($_POST['n_document']) >= 1  && strlen($_POST['distrito']) >= 1 && strlen($_POST['direccion']) >= 1   && strlen($_POST['referencia']) >= 1  && strlen($_POST['tipo_entrega']) >= 1  && strlen($_POST['total_input']) >= 1 && strlen($_POST['categoria']) >= 1 ) {
        $nombre_cliente = trim($_POST['nombre_cliente']);
        $celular = trim($_POST['celular']);
        $correo = trim($_POST['correo']);
        $documento_tipo = trim($_POST['documento']); // Ajusta según tus datos
        $documento_numero = trim($_POST['n_document']); // Ajusta según tus datos
        $distrito = trim($_POST['distrito']); // Ajusta según tus datos
        $direccion =  trim($_POST['direccion']); // Ajusta según tus datos
        $referencia = trim($_POST['referencia']); // Ajusta según tus datos
        $tipo_entrega = trim($_POST['tipo_entrega']); // Esto es un ejemplo, ajusta según tu necesidad
        $categoria = trim($_POST['categoria']); // Esto es un ejemplo, ajusta según tu necesidad


        // Obtén el valor total del campo oculto en el formulario
        $total = trim($_POST['total_input']);
        
        // Decodificar la cadena JSON de productos al recuperarla de la base de datos
        if (isset($_POST['productos_titulos'])) {
            $productosJSON = $_POST['productos_titulos'];
            $productosArray = json_decode($productosJSON);
        } else {
            $productosArray = []; // Si no hay productos, establece un array vacío
        }
        
        $consulta = "INSERT INTO `ventas`(`tipo_entrega`, `productos`, `total`, `nombre_cliente`, `documento_tipo`, `documento_numero`, `correo`, `celular`, `distrito`, `direccion`, `referencia`, `acepto_terminos`, `categoria`) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

        
        $stmt = mysqli_prepare($conex, $consulta);
        
        mysqli_stmt_bind_param($stmt, "ssdssssssssds", $tipo_entrega, $productosJSON, $total, $nombre_cliente, $documento_tipo, $documento_numero, $correo, $celular, $distrito, $direccion, $referencia, $acepto_terminos, $categoria);

        
        // Establecer valores para los parámetros
        $acepto_terminos = 1; // Ajusta según tus datos
        
        $resultado = mysqli_stmt_execute($stmt);

        if ($resultado) {
            ?>
            <h3 class="ok">Te has registrado correctamente</h3>
            <?php
        } else {
            ?>
            <h3 class="bad">Error en la inserción</h3>
            <?php
        }
        
        mysqli_stmt_close($stmt);
        
        // Mostrar los elementos de la matriz sin comillas y comas
        foreach ($productosArray as $producto) {
            echo $producto . "<br>";
        }
        
    } else {
        ?>
        <h3 class="bad">Completa el registro</h3>
        <?php
    }
}
?>
