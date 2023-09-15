<?php
// Conexión a la base de datos
$conex = mysqli_connect("localhost", "root", "", "Vaping");

if (!$conex) {
    echo "Error de conexión: " . mysqli_connect_error();
}

if (isset($_POST['register2'])) {
    $nombre_cliente = isset($_POST['nombre_cliente']) ? trim($_POST['nombre_cliente']) : '';
    $celular = isset($_POST['celular']) ? trim($_POST['celular']) : '';
    $correo = isset($_POST['correo']) ? trim($_POST['correo']) : '';
    $documento_tipo = isset($_POST['documento']) ? trim($_POST['documento']) : ''; 
    $documento_numero = isset($_POST['n_document']) ? trim($_POST['n_document']) : ''; 
    $distrito = isset($_POST['distrito']) ? trim($_POST['distrito']) : ''; 
    $direccion = isset($_POST['direccion']) ? trim($_POST['direccion']) : ''; 
    $referencia = isset($_POST['referencia']) ? trim($_POST['referencia']) : ''; 
    $tipo_entrega = isset($_POST['tipo_entrega']) ? trim($_POST['tipo_entrega']) : ''; 
    $total = isset($_POST['total_input']) ? trim($_POST['total_input']) : '';

    // Verificar y establecer un valor predeterminado para tipo_entrega si es nulo o vacío
    if (empty($tipo_entrega)) {
        $tipo_entrega = "Valor predeterminado o algún valor por defecto";
    }

    $productosJSON = isset($_POST['productos_titulos']) ? $_POST['productos_titulos'] : '[]';
    $productosArray = json_decode($productosJSON);

    $ubicacion = isset($_POST['ubicacion']) ? trim($_POST['ubicacion']) : ''; 
    $dia = isset($_POST['dia']) ? trim($_POST['dia']) : ''; 
    $categoria = isset($_POST['categoria']) ? trim($_POST['categoria']) : ''; 

    // Insertar datos en la tabla ventas2
    $consulta_ventas2 = "INSERT INTO `ventas2`(`tipo_entrega`, `productos`, `total`, `nombre_cliente`, `documento_tipo`, `documento_numero`, `correo`, `celular`, `distrito`, `direccion`, `referencia`, `acepto_terminos`, `ubicacion`, `dia`, `categoria`) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
    $stmt_ventas2 = mysqli_prepare($conex, $consulta_ventas2);
    mysqli_stmt_bind_param($stmt_ventas2, "ssdssssssssdsss", $tipo_entrega, $productosJSON, $total, $nombre_cliente, $documento_tipo, $documento_numero, $correo, $celular, $distrito, $direccion, $referencia, $acepto_terminos, $ubicacion, $dia, $categoria);
    
    $acepto_terminos = 1;

    $resultado_ventas2 = mysqli_stmt_execute($stmt_ventas2);

    if ($resultado_ventas2) {
        // La inserción en ventas2 se realizó correctamente
        // Obtener el ID de la venta recién insertada
        $venta_id = mysqli_insert_id($conex);

        // Insertar datos en la tabla productos_seleccionados con el ID de la venta
        foreach ($productosArray as $producto) {
            $nombre_producto = $producto->title;
            $cantidad = $producto->value0; // Asumiendo que 'value0' es la cantidad
            $precio = $producto->price;  // Aquí debes obtener el precio adecuado del producto, ya que no se proporciona en el formulario
            $imagen = isset($producto->image) ? $producto->image : 'ruta_predeterminada_de_la_imagen.jpg'; // Aquí asignamos la imagen o una ruta predeterminada
            $usuarioId = 0; // Aquí debes obtener el ID del usuario actual, si lo tienes

            $consulta_productos = "INSERT INTO `productos_seleccionados` (`nombre_producto`, `cantidad`, `precio`, `imagen`, `usuario_id`, `venta_id`, `tipo_entrega`) VALUES (?, ?, ?, ?, ?, ?, ?)";
            $stmt_productos = mysqli_prepare($conex, $consulta_productos);
            mysqli_stmt_bind_param($stmt_productos, "sddssss", $nombre_producto, $cantidad, $precio, $imagen, $usuarioId, $venta_id, $tipo_entrega);

            $resultado_productos = mysqli_stmt_execute($stmt_productos);

            if ($resultado_productos) {
                // La inserción en productos_seleccionados se realizó correctamente
            } else {
                // Hubo un error en la inserción de productos_seleccionados
            }

            mysqli_stmt_close($stmt_productos);
        }
    } else {
        // Hubo un error en la inserción de ventas2
    }

    mysqli_stmt_close($stmt_ventas2);
}
?>
