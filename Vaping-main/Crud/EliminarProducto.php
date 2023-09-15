<?php
require_once("C:/xampp/htdocs/Vaping-main/Controllers/ControllerProducto.php");
$obj = new usernameControlerProducto();
$obj->EliminarProducto($_GET['id']);
?>
