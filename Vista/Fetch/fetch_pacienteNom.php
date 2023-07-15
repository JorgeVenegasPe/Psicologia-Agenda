<?php
require("C:/xampp/htdocs/Psicologia-Agenda-Clinica-master/Conexion/conexion.php");
$con = new conexion();
$conn = $con->conexion();

// Obtener el código enviado por AJAX
$NomPaciente = $_POST['NomPaciente'];
$idPsicologo = $_POST['idPsicologo']; // Obtener el valor del IdPsicologo

// Consultar la base de datos para obtener la atención del paciente
$sql = "SELECT p.IdPaciente, p.NomPaciente, p.ApPaterno, p.ApMaterno, ap.Diagnostico, ap.Tratamiento, p.Email, p.Telefono
        FROM paciente p
        LEFT JOIN AtencionPaciente ap ON ap.IdPaciente = p.IdPaciente
        WHERE p.NomPaciente = :NomPaciente
        AND p.IdPsicologo = :idPsicologo"; // Agrega la condición para el IdPsicologo

$stmt = $conn->prepare($sql);
$stmt->bindParam(':NomPaciente', $NomPaciente);
$stmt->bindParam(':idPsicologo', $idPsicologo); // Bindear el parámetro idPsicologo
$stmt->execute();

// Obtener el resultado de la consulta
$row = $stmt->fetch(PDO::FETCH_ASSOC);

if ($row) {
  $IdPaciente = $row['IdPaciente'];
  $nombrePaciente = $row['NomPaciente'];
  $ApPaterno = $row['ApPaterno'];
  $ApMaterno = $row['ApMaterno'];
  $correo = $row['Email'];
  $telefono = $row['Telefono'];
  $response = array('nombre' => $nombrePaciente." ".$ApMaterno." ".$ApPaterno,'id' => $IdPaciente,'correo'=> $correo,'telefono'=> $telefono);
} else {
  $response = array('error' => 'No existe ese paciente');
}

// Devolver la respuesta en formato JSON
header('Content-Type: application/json');
echo json_encode($response);
?>


