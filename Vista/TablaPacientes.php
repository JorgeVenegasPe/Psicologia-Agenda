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
<?php
    require("../Controlador/Paciente/ControllerPaciente.php");
    require("../Controlador/Cita/citaControlador.php");
    $obj=new usernameControlerPaciente();
    $objcita=new usernameControlerCita();
    $rowscita=$objcita->contarRegistrosEnPacientes($_SESSION['IdPsicologo']);
    $rows=$obj->ver($_SESSION['IdPsicologo']);
?>
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
    <div class="recent-updates" style="display:flex; flex-direction: row; gap:20px; align-items: center; padding: 10px 0px 0px 10px">
        <span style="font-size: 15px;"><b style="font-size: 20px;"><?= $rowscita ?></b> pacientes </span>
        <div class="input-group" >
  	        <input  type="text" style="background-color: White;" placeholder="Buscar"  class="input" required/>
        </div>
        <a class="search" style="padding:10px; font-size:10px;" href="RegPaciente.php">Agregar Paciente</a>
    </div>
    <div class="recent-citas">
        <table>
            <thead>
                <tr>
                    <th></th>
                    <th>Paciente</th>
                    <th>Codigo</th>
                    <th>DNI</th>
                    <th>Email</th>
                    <th>Celular</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
            <?php if ($rows) :?>
                                <?php foreach ($rows as $row): ?>
                <tr>
                <td><span class="material-symbols-sharp">
check_box_outline_blank
</span>
</td>
                    <td><?=$row[1]?> <?=$row[2]?></td>
                    <td><?=$row[18]?></td>
                    <td><?=$row[4]?></td>
                    <td><?=$row[12]?></td>
                    <td><?=$row[11]?></td>
                    <td><span class="material-symbols-sharp">
more_vert
</span>
</td>
                </tr>
                
                <?php endforeach;?>            
            <?php endif;?>
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