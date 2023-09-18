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
    <title>Dashboard</title>    
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Sharp:opsz,wght,FILL,GRAD@48,400,1,0" />
    <link rel="icon" href="../Issets/images/contigovoyico.ico">
    <link rel="stylesheet" href="../issets/css/MainGeneral.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
</head>
<body>
<?php
    require_once("../Controlador/Paciente/ControllerPaciente.php");
    require_once("../Controlador/Cita/citaControlador.php");
    $PORC=new usernameControlerCita();
    $Pac=new usernameControlerPaciente();
    $totalRegistrosEnCitas =$PORC->contarRegistrosEnCitas($_SESSION['IdPsicologo']); 
    $totalPacientes =$PORC->contarRegistrosEnPacientes($_SESSION['IdPsicologo']); 
    $totalPacientesRecientes =$PORC->contarPacientesConFechaActual($_SESSION['IdPsicologo']);
    $totalRegistrosEnCitasConfirmado =$PORC->contarCitasConfirmadas($_SESSION['IdPsicologo']);
    $totalRegistrosEnCitasHora =$PORC->obtenerFechasCitasConFechaActual($_SESSION['IdPsicologo']);
    $Citas=$PORC->showByFecha($_SESSION['IdPsicologo']);
    $datos=$Pac->MostrarPacientesRecientes($_SESSION['IdPsicologo']);
?>
    <div class="container">
        <?php
            require_once '../Issets/views/Menu.php';
        ?>    
        <!----------- end of aside -------->
        <main class="animate__animated animate__fadeIn">
            <br>
            <!----------- CAmbios NUEVOS DEL DASHBOARDS -------->
                 <h4 style=" color:#49c691;">¡Buenos dias, <?=$_SESSION['NombrePsicologo']?>!</h4>

                <h3 style="color:#6A90F1; font-size: 18px;">
                Tienes <span style="color:#416cd8; font-weight: bold; font-size:20px"><?= count($totalRegistrosEnCitasHora) ?> citas</span> programadas para hoy
</h3>


<div class="agenda">
<?php
$fecha_actual = new DateTime('now', new DateTimeZone('UTC'));
$fecha_actual->setTimeZone(new DateTimeZone('America/Lima')); // Cambia a tu zona horaria

$locale = 'es_ES';
$fmt = new IntlDateFormatter($locale, IntlDateFormatter::LONG, IntlDateFormatter::NONE);
$fecha_formateada = $fmt->format($fecha_actual);

?>
    <div class="div_event3">
        <div>
            <h3 style="text-align: left;font-size: 16px;">Citas del día</h3>
            <p style="text-align: left; color: #fff;">Hoy, <?php echo $fecha_formateada; ?></p>
        </div>
        <div style="display:flex; align-items: center;">
            <a href="citas.php">
                <span style="color: #fff" class="material-symbols-sharp">add_circle</span>
            </a>
        </div>
    </div>

    <?php
    // Llama a la función para obtener las citas con nombre del paciente, hora y minutos
    $citasConNombrePacienteHoraMinutos = (new UserModelCita())->obtenerCitasConNombrePacienteHoraMinutos($_SESSION['IdPsicologo']);
    ?>

    <?php if (!empty($citasConNombrePacienteHoraMinutos)): ?>
        <table>
            <?php foreach ($citasConNombrePacienteHoraMinutos as $cita): ?>
                <tr>
                    <td><?= $cita["HoraMinutos"] ?></td>
                    <td>
                        <div class="section-cia">
                            <span><?= $cita["NomPaciente"] ?></span>
                            <button class="button3">Botón</button>
                        </div>
                    </td>
                </tr>
            <?php endforeach; ?>
        </table>
    <?php else: ?>
        <p>No hay citas programadas para hoy.</p>
    <?php endif; ?>


    <script>
    // Importa los datos que deseas mostrar en el gráfico de pastel.
    var pacientesUltimoMes = <?= $contarPacientesUltimoMes ?>;

    // Configura el gráfico de pastel
    var ctx = document.getElementById("myPieChart").getContext('2d');
    var myPieChart = new Chart(ctx, {
        type: 'pie',
        data: {
            labels: ["Pacientes del último mes", "Otros Pacientes"],
            datasets: [{
                backgroundColor: ["#8CB7C2", "#f2f2f2"],
                data: [pacientesUltimoMes, <?= $totalPacientes - $contarPacientesUltimoMes ?>]
            }]
        },
        options: {
            responsive: true,
            legend: {
                display: false
            }
        }
    });

    // Agrega el mensaje "Gráfico del último mes" debajo del gráfico
    var pieChartMessage = document.createElement("p");
    pieChartMessage.innerHTML = "Gráfico del último mes";
    document.querySelector(".pie-chart").appendChild(pieChartMessage);

</script>
</div>
            <!--
            <h2>Estadisticas</h2>
            -->
            <div class="insights">  
                
                <div class="sales">
                    <div class="middle" >
                    <h3 style=" font-size: 14px; ">
                    <span style=" font-weight: bold; font-size:40px"><?= $totalPacientes ?></span> <br>Total de pacientes
                </h3>
                    </div>
                </div>
                <!------------------- Final del Sales -------------------->
                
                <div class="expenses">
                    <div class="middle">
                    <h3 style="font-size: 14px;">
                    <span style=" font-weight: bold; font-size:40px"><?= $totalPacientesRecientes ?></span> <br> Nuevos pacientes
                </h3>
                    </div> 
                </div>
                <!------------------- Final del expenses -------------------->
                <div class="income">
                    <div class="middle">
                    <h3 style="  font-size: 14px; ">
                    <span style=" font-weight: bold; font-size:40px"><?= $totalRegistrosEnCitasConfirmado ?></span> <br> Citas Confirmadas
                </h3>
                    </div>           
                </div>
                <!------------------- Final del income -------------------->
            </div>
        </main>
        <!------ End of Main -->
        <div class="right">
            <div class="top">
                <button id="menu-btn">
                    <span class="material-symbols-sharp" translate="no">menu</span>
                </button>
                <div class="theme-toggler">
                    <span class="material-symbols-sharp active" translate="no">light_mode</span>
                    <span class="material-symbols-sharp" translate="no">dark_mode</span>
                </div>
                <div>
                    <a class="ajuste-info nav-link" style="cursor:pointer;" onclick="openModalAjustes()">
                        <span class="material-symbols-sharp" translate="no">settings</span>
                    </a>
                </div>
                <?php
                    require_once 'ajuste.php';
                ?>
                <div class="profile">

                    <div class="info">
                        <p>| <b><?=$_SESSION['Usuario']?> | </b></p>
                    </div>
                </div>
                <a href="../issets/views/Salir.php">
                    <!-- <span class="material-symbols-sharp" translate="no">logout</span>-->
                    <h3 class="cerrar">Cerrar Sesion</h3>

                </a>
            </div>
            <!----------end of Top------->
            <div class="recent-updates">
                <h2 style="background-color: #6A90F1; margin:0px; border-radius: 20px 20px 0px 0px; padding:1.8rem; font-size:25px; color:#fff;">Pacientes Recientes</h2>
                <div class="updates">
                    <div class="update">
                        <?php if ($datos) : ?>
                            <?php foreach ($datos as $key) : ?>
                                <div class="message">
                                    <p><b><?= $key['NomPaciente'] ?> <?= $key['ApPaterno'] ?> <?= $key['ApMaterno'] ?>,</b> <?= $key['Edad'] ?> años</p>
                                    <small class="text-muted">Registrado el: <?= $key['Fecha'] ?></small>
                                    <br>
                                    <small class="text-muted">Hora: <?= $key['Hora'] ?></small>
                                </div>                                
                            <?php endforeach; ?>
                            <?php else : ?>
                                    <p style="text-align: center;">No hay Pacientes<a href="RegPaciente.php"> Agregar nuevo paciente </a> </p>
                        <?php endif; ?>
                    </div>
                </div>
                <a href="RegPaciente.php">Agregar Paciente</a>
            </div>
            <div class="pie-chart" >
<h3 style="text-align: start; margin:20px 30px;">Pacientes del ultimo mes</h3>
        <h2>Canal de Atracción</h2>
        <canvas id="myPieChart"></canvas>
        <h3  class="h3-dsh">Cita Online</h3>
        <h3  class="h3-dsh">Referidos</h3>
        <h3  class="h3-dsh">Marketing Digital</h3>
    </div>
        </div>
    <script src="../issets/js/Dashboard.js"></script>
</body>
</html>
<?php
}else{
  header("Location: ../index.php");
}
?>