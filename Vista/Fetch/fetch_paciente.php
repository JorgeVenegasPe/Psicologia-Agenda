<?php
require("C:/xampp/htdocs/Psicologia-Agenda-Clinica-master/Conexion/conexion.php");
$con = new conexion();
$conn = $con->conexion();

$codigoPaciente = $_POST['codigoPaciente'];

$sql = "SELECT NomPaciente,ApPaterno,ApMaterno FROM paciente 
        WHERE IdPaciente = :codigoPaciente";

$stmt = $conn->prepare($sql);
$stmt->bindParam(':codigoPaciente', $codigoPaciente);
$stmt->execute();

$row = $stmt->fetch(PDO::FETCH_ASSOC);

if ($row) {
  $nombrePaciente = $row['NomPaciente'];
  $ApPaterno = $row['ApPaterno'];
  $ApMaterno = $row['ApMaterno'];
  $response = array('nombre' => $nombrePaciente." ".$ApMaterno." ".$ApPaterno, 'nom' => $nombrePaciente);
} else {
  $response = array('error' => 'No existe ese paciente');
}

header('Content-Type: application/json');
echo json_encode($response);
?>

