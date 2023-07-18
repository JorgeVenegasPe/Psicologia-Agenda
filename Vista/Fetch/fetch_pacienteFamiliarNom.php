<?php
require("C:/xampp/htdocs/Psicologia-Agenda-Clinica-master/Conexion/conexion.php");
$con = new conexion();
$conn = $con->conexion();

// Obtener el código enviado por AJAX
$NomPaciente = $_POST['NomPaciente'];


// Consultar la base de datos para obtener la atención del paciente
$sql = "SELECT p.IdPaciente,p.NomPaciente,p.ApPaterno,p.ApMaterno, af.NomPadre, af.NomMadre, af.IntegracionFamiliar
        FROM Paciente p
        LEFT JOIN AreaFamiliar af ON af.IdPaciente = p.IdPaciente
        WHERE p.NomPaciente = :NomPaciente";

$stmt = $conn->prepare($sql);
$stmt->bindParam(':NomPaciente', $NomPaciente);
$stmt->execute();

// Obtener el resultado de la consulta
$row = $stmt->fetch(PDO::FETCH_ASSOC);

if ($row) {
  $IdPaciente = $row['IdPaciente']; 
  $NomPaciente = $row['NomPaciente'];
  $ApMaterno = $row['ApMaterno'];
  $ApPaterno = $row['ApPaterno'];
  $NomPadre = $row['NomPadre'];
  $NomMadre = $row['NomMadre'];
  $IntegracionFamiliar = $row['IntegracionFamiliar'];

  if ($NomPadre && $NomMadre && $IntegracionFamiliar) {
    $response = array('error' => 'Este paciente ya esta Registrado');
  } else {
    $response = array('nombre' => $NomPaciente." ".$ApPaterno." ".$ApMaterno, 'id' => $IdPaciente);
  }
} else {
  $response = array('error' => 'No existe ese paciente');
}

// Devolver la respuesta en formato JSON
header('Content-Type: application/json');
echo json_encode($response);
?>
