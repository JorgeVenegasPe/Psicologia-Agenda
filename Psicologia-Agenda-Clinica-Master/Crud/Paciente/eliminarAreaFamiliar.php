<?php
require_once("C:/xampp/htdocs/Psicologia-Agenda-Clinica-master/Controlador/Paciente/ControllerAtencFamiliar.php");

$obj = new usernameControlerAreaFamiliar();

$obj->eliminarAreaFamiliar($_GET['id']);
?>
