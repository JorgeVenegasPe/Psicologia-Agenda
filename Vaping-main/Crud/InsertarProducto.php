<?php
require_once("C:/xampp/htdocs/Vaping-main/Controllers/ControllerProducto.php");
$obj = new usernameControlerProducto();

$imagen = file_get_contents($_FILES['imagen']['tmp_name']);
$precio = floatval($_POST['precio']); 

$obj->InsertarProducto($_POST['IdCategoria'],$_POST['nombre'],$imagen,$_POST['descripcion'],$precio);
?>