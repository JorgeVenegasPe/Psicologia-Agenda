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
    <link rel="stylesheet" href="../issets/css/MainGeneral.css">
    <link rel="stylesheet" href="../Issets/css/formulario.css">
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
    $Pac=new usernameControlerPaciente();
    $departamentos = $Pac->MostrarDepartamento();
    $rows=$Pac->ver($_SESSION['IdPsicologo']);
    
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
        <a class="button" style="padding:10px 30px; font-size:10px;" href="RegPaciente.php">
            <span class="material-symbols-sharp">add</span>Agregar Paciente
        </a>
    </div>
    <!-- Agrega una nueva sección para la vista de tabla -->
        <!-- Agrega una nueva sección para la vista de tabla -->

        <div class="tableData" style="display: flex;justify-content: center;align-items: stretch;margin: 50px;">
        <table>
            <thead>
                <tr>
                    <th>Nombres</th>
                    <th>FECHA</th>
                </tr>
            </thead>
            <tbody>
                <?php if ($rows) : ?>
                    <?php foreach ($rows as $row): ?>
    <?php
    $user = $Pac->show($row[0]);
    $AtencsUser = $Pac->showAtenc($row[0]);

    // Verifica si los índices existen antes de acceder a ellos
    if (isset($AtencsUser[4]) && isset($AtencsUser[7]) && isset($AtencsUser[8]) && isset($AtencsUser[10])) {
    ?>
    <tr>
        <td>
            <p style="color: black; cursor: pointer;" onclick="abrirDetallesDerecha('<?=$AtencsUser[4]?>', '<?=$AtencsUser[7]?>', '<?=$AtencsUser[8]?>', '<?=$AtencsUser[10]?>')" ondblclick="cerrarDetallesDerecha()"><?=$AtencsUser[4]?></p>
            <p><?=$AtencsUser[7]?> / <?=$AtencsUser[8]?></p>
        </td>
    </tr>
    <?php } ?>
<?php endforeach; ?>


                <?php else : ?>
                    <tr>
                        <td colspan="4">No hay pacientes</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>

        <!-- Contenedor de detalles para mostrar al lado derecho -->
    <div class="detalles" id="contenedorDetalles">
        <div class="contener">
            <div class="izquierda">
                <!-- Contenido izquierdo -->
                <p></p> <!-- Aquí mostrarás el nombre -->
                <p><b>Diagnóstico: </b></p> <!-- Aquí mostrarás el diagnóstico -->
                <p><b>Tratamiento: </b></p> <!-- Aquí mostrarás el tratamiento -->
            </div>
            <div class="derecha">
                <!-- Contenido derecho -->
                <p><b>Ultimos Objetivos: </b></p> <!-- Aquí mostrarás los últimos objetivos -->
            </div>
        </div>
    </div>
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