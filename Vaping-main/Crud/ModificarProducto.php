<?php
require_once("C:/xampp/htdocs/Vaping-main/Controllers/ControllerProducto.php");
$obj = new usernameControlerProducto();

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Otros procesamientos de campos del formulario

    if (!empty($_FILES['imagenactualizado']['tmp_name'])) {
        // Si se proporcionó una nueva imagen, procesarla
        $imagen_actualizada = file_get_contents($_FILES['imagenactualizado']['tmp_name']);
        $precio = floatval($_POST['precioactualizado']);

        $obj->ModificarProducto($_POST['nombreActualiado'],$imagen_actualizada,$_POST['descripcionactualizado'],$precio);
        // Realizar la actualización de la imagen en la base de datos
    } else {
        
        $precio = floatval($_POST['precioactualizado']);
        $obj->ModificarProducto($_POST['nombreActualiado'],$imagen_actualizada,$_POST['descripcionactualizado'],$precio);
        // Si no se proporcionó una nueva imagen, mantener la imagen actual en la base de datos
    }


}
?>