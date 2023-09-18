<?php
require_once("C:/xampp/htdocs/Psicologia-Agenda-Clinica-master/Controlador/Paciente/ControllerAtencPaciente.php");

$obj = new usernameControlerAtencPaciente();
$obj->guardarAtencPac($_POST['IdPaciente'], $_POST['IdEnfermedad'], $_POST['MotivoConsulta'], $_POST['FormaContacto'], $_POST['Diagnostico'], $_POST['Tratamiento'],$_POST['Observacion'],$_POST['UltimosObjetivos']);?>
