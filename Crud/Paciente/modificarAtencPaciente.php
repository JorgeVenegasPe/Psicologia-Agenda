<?php
require_once("c:/xampp/htdocs/Psicologia-Agenda-Clinica-master/Controlador/Paciente/ControllerAtencPaciente.php");
$obj = new usernameControlerAtencPaciente();

$obj->modificarAtencPaciente($_POST['IdAtencion'], $_POST['MotivoConsulta'], $_POST['FormaContacto'], $_POST['Diagnostico'], $_POST['Tratamiento'],$_POST['Observacion'],$_POST['UltimosObjetivos']);

?>
