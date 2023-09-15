<?php
require_once("C:/xampp/htdocs/Psicologia-Agenda-Clinica-master/Controlador/Paciente/ControllerAtencPaciente.php");


$obj = new usernameControlerAtencPaciente();

$obj->eliminar($_GET['id']);
?>
