<?php
require("C:/xampp/htdocs/Psicologia-Agenda-Clinica-master/Conexion/conexion.php");
$con = new conexion();
$conn = $con->conexion();

// Obtener el código enviado por AJAX
$CodigoPaciente = $_POST['CodigoPaciente'];
$idPsicologo = $_POST['idPsicologo']; // Obtener el valor del IdPsicologo

// Consultar la base de datos para obtener la atención del paciente
$sql = "SELECT p.NomPaciente,p.ApPaterno,p.ApMaterno,p.IdPaciente
        FROM paciente p
        WHERE p.CodigoPaciente = :CodigoPaciente
        AND IdPsicologo = :idPsicologo"; // Agregar la condición para el IdPsicologo

$stmt = $conn->prepare($sql);
$stmt->bindParam(':CodigoPaciente', $CodigoPaciente);
$stmt->bindParam(':idPsicologo', $idPsicologo);
$stmt->execute();

// Obtener el resultado de la consulta
$row = $stmt->fetch(PDO::FETCH_ASSOC);

if ($row) {
  $IdPaciente = $row['IdPaciente'];
  $nombrePaciente = $row['NomPaciente'];
  $ApPaterno = $row['ApPaterno'];
  $ApMaterno = $row['ApMaterno'];
  $response = array('nombre' => $nombrePaciente . " " . $ApMaterno . " " . $ApPaterno, 'nom' => $nombrePaciente,'IdPaciente'=>$IdPaciente);
} else {
  $response = array('error' => 'No existe ese paciente');
}

// Devolver la respuesta en formato JSON
header('Content-Type: application/json');
echo json_encode($response);
?>
