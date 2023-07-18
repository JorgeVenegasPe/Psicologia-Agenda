<?php
require("C:/xampp/htdocs/Psicologia-Agenda-Clinica-master/Conexion/conexion.php");
$con = new conexion();
$conn = $con->conexion();

// Obtener el código enviado por AJAX
$NomPaciente = $_POST['NomPaciente'];
$idPsicologo = $_POST['idPsicologo'];

// Consultar la base de datos para obtener la atención del paciente
$sql = "SELECT p.IdPaciente,p.NomPaciente,p.ApPaterno,p.ApMaterno
        FROM paciente p
        WHERE p.NomPaciente = :NomPaciente
        AND IdPsicologo = :idPsicologo";

$stmt = $conn->prepare($sql);
$stmt->bindParam(':NomPaciente', $NomPaciente);
$stmt->bindParam(':idPsicologo', $idPsicologo);
$stmt->execute();

// Obtener el resultado de la consulta
$row = $stmt->fetch(PDO::FETCH_ASSOC);

if ($row) {
  $IdPaciente = $row['IdPaciente']; 
  $NomPaciente = $row['NomPaciente'];
  $ApMaterno = $row['ApMaterno'];
  $ApPaterno = $row['ApPaterno'];

  $response = array('nombre' => $NomPaciente." ".$ApPaterno." ".$ApMaterno, 'id' => $IdPaciente);
} else {
  $response = array('error' => 'No existe ese paciente');
}

// Devolver la respuesta en formato JSON
header('Content-Type: application/json');
echo json_encode($response);
?>
