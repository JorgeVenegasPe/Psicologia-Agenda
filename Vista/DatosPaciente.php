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
    <link href="../issets/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Sharp:opsz,wght,FILL,GRAD@48,400,1,0" />
    <link rel="icon" href="../Issets/images/contigovoyico.ico">
    <link rel="stylesheet" href="../Issets/css/formulario.css">
    <link rel="stylesheet" href="../Issets/css/Dashboard.css"/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <title>Datos de Paciente</title>
</head>
<style>
    .ContainerDatos.active{
        background-color: #49c691;
        padding:20px 30px;
        border-radius:10px; 
        display:none
    }
    .ContainerDatos{
        background-color: #49c691;
        padding:20px 30px;
        border-radius:10px; 
    }
</style>
<body>
<?php
require_once("../Controlador/Paciente/ControllerPaciente.php");
require_once("../Controlador/Paciente/ControllerAtencPaciente.php");
require_once("../Controlador/Paciente/ControllerAtencFamiliar.php");
    $Fam=new usernameControlerAreaFamiliar();
    $Atenc=new usernameControlerAtencPaciente();
    $Pac=new usernameControlerPaciente();
    $departamentos = $Pac->MostrarDepartamento();
    $rows=$Atenc->mostrarpacientecompleto();
    
?>

<div class="containerTotal">
<?php
    require_once '../issets/views/Menu.php';
  ?> 
  <!----------- end of aside -------->
  <main class="animate_animated animate_fadeIn">
    <?php
    require_once '../issets/views/Info.php';
    ?> 
    
    <h2 style="color: #49c691;">Historial de Pacientes</h2>
    <div class="recent-updates" style="display:flex; flex-direction: row; gap:20px; align-items: center; padding: 10px 0px 0px 10px">
        <div class="input-group">
  	        <input type="text" style="background-color: White;" placeholder="Buscar"  class="input" required></input>
        </div>
        <a class="search" style="padding:10px 30px; font-size:10px;" href="RegPaciente.php">
            <span class="material-symbols-sharp">add</span>Agregar Paciente
        </a>
    </div>
    <!-- Agrega una nueva sección para la vista de tabla -->
    <div style="display: flex; flex-direction:column;">
        <?php if ($rows) : ?>
            <?php foreach ($rows as $row):   ?>
                <div style="display: flex; flex-direction:row;">    
                <div class="insights" style="display:initial;margin-bottom:inherit">
                    <div style="display: flex; flex-direction:row; justify-content:space-between">
                        <div>
                            <h1><?=$row[4]?> <?=$row[12]?></h1>
                            <label><?=$row[7]?> / <?=$row[5]?></label>
                        </div>
                        <div style="display:flex; align-items: center;">
                            <button class="butonActive" style="padding:10px;">ver mas</button>
                        </div>
                    </div>
                </div>
                <div class="ContainerDatos active" >
                    <h1><?=$row[4]?> <?=$row[12]?></h1>
                    <label><?=$row[13]?> años</label>,
                    <label>primera consulta: <?=$row[11]?></label>
                    <div>
                        <h1>Diagnostico: </h1>
                        <label><?=$row[7]?></label>
                    </div>
                    <div>
                        <h1>Tratamiento: </h1>
                        <label><?=$row[8]?></label>
                    </div>
                    <div>
                        <h1>Medicamentos: </h1>
                        <label><?=$row[14]?></label>
                    </div>
                    <div>
                        <h1>Primera Cita: </h1>
                        <label><?=$row[5]?></label>
                    </div>
                </div>

                </div>
            <?php endforeach; ?>
        <?php endif; ?>
    </div>
  </main>
    <script src="../issets/js/Dashboard.js"></script>
</div>
</body>
<script>
    const wrapper = document.querySelector('.ContainerDatos');
    const loginLink = document.querySelector('.butonActive');

    loginLink.onclick = () => {
       wrapper.classList.remove('active');
    }
</script>
</html>
<?php
}else{
  header("Location: ../index.php");
}
?>