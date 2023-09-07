<?php
session_start();
if (isset($_SESSION['NombrePsicologo'])){
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Sharp:opsz,wght,FILL,GRAD@48,400,1,0" />
    <link rel="stylesheet" href="../issets/css/formulario.css">
    <link rel="icon" href="../Issets/images/contigovoyico.ico">
    <link rel="stylesheet" href="../issets/css/Dashboard.css"/> 
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <title>Paciente</title>
</head>
<body>
<div class="containerTotal">
<?php
    require_once '../Issets/views/Menu.php';
  ?> 
  <!----------- end of aside -------->
  <main class="animate__animated animate__fadeIn">
    <?php
    require_once '../Issets/views/Info.php';
    ?>
    <h2>Pacientes del dia</h2>
    <div class="recent-orders" style="flex-direction:row;">
     <span>10 pacientes</span>
     <button type="submit" style="padding:10px;  background-color:beige">Agregar Paciente</button>
     <button type="submit" style="padding:10px;  background-color:azure">Buscar Paciente</button>
    </div>
    <div class="recent-citas">
        <table>
            <thead>
                <tr>
                    <th>Paciente</th>
                    <th>Codigo</th>
                    <th>DNI</th>
                    <th>Email</th>
                    <th>Edad</th>
                    <th>Duracion</th>
                    <th ></th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td>Crear cita</td>
                    <td></td>
                    <td></td>
                </tr>
            </tbody>
        </table>
    </div>
  </main>
  <script src="../Issets/js/Dashboard.js"></script>
</body>
</html>
<?php
}else{
  header("Location: ../Index.php");
}
?>