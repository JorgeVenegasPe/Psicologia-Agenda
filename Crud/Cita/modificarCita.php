<?php
require_once("C:/xampp/htdocs/Psicologia-Agenda-Clinica-Master/Controlador/Cita/citaControlador.php");
$obj = new usernameControlerCita();
$FechaCitaInicio = $_POST['FechaCitaInicio'];
$HoraInicio = $_POST['HoraInicio'];
$FechaInicio = $FechaCitaInicio . ' ' . $HoraInicio;

$FechaCitaFin = $_POST['FechaCitaFin'];
$HoraFin = $_POST['HoraFin'];
$FechaFin = $FechaCitaFin . ' ' . $HoraFin;
$obj->modificarCita($_POST['IdCita'],$FechaInicio, $FechaFin, $_POST['ColorFondo']);

?>
