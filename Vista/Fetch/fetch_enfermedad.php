<?php
  require("C:/xampp/htdocs/Psicologia-Agenda-Clinica-master/Conexion/conexion.php");
  $con=new conexion();
  $conn=$con->conexion();

  // Obtener el código enviado por AJAX
  $CodEnfermedad = $_POST['CodEnfermedad'];

  // Consultar la base de datos para obtener la enfermedad correspondiente
  $sql = "SELECT IdEnfermedad,Clasificacion, Gravedad 
  FROM Enfermedad 
  WHERE DSM5 = :CodEnfermedad";
  $stmt = $conn->prepare($sql);
  $stmt->bindParam(':CodEnfermedad', $CodEnfermedad);
  $stmt->execute();

  // Obtener el resultado de la consulta
  $row = $stmt->fetch(PDO::FETCH_ASSOC);

  if ($row) {
    $IdEnfermedad = $row['IdEnfermedad']; 
    $Clasificacion = $row['Clasificacion'];
    $Gravedad = $row['Gravedad'];
    $response = array('nombre' => $Clasificacion." - ".$Gravedad, 'id' => $IdEnfermedad);
  } else {
    $response = array('error' => 'No existe esa enfermedad');
  }

  // Devolver la respuesta en formato JSON
  header('Content-Type: application/json');
  echo json_encode($response);
  ?>