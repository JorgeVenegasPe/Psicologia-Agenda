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
    <link rel="stylesheet" href="../Issets/css/Dashboard.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">

</head>

<body>
<?php
require_once("../Controlador/Paciente/ControllerPaciente.php");
require_once("../Controlador/Cita/citaControlador.php");
require_once("../Modelo/Cita/ModelCita.php");//LLAMAMOS AL MODELO DONDE ESTA LA FUNCION DE CONTEO
    //OBTENEMOS EL CONTEO TOTAL
    $totalRegistrosEnCitas = (new UserModelCita())->contarRegistrosEnCitas(); 
    $totalPacientes = (new UserModelCita())->contarRegistrosEnPacientes(); 
    $totalPacientesRecientes = (new UserModelCita())->contarPacientesConFechaActual();
    $totalRegistrosEnCitasConfirmado = (new UserModelCita())->contarCitasConfirmadas();


    $totalRegistrosEnCitasHora = (new UserModelCita())->obtenerFechasCitasConFechaActual();

    $contarPacientesUltimoMes = (new UserModelCita())->contarPacientesUltimoMes();




    $PORC=new usernameControlerCita();
    $Pac=new usernameControlerPaciente();
    $Citas=$PORC->showByFecha($_SESSION['IdPsicologo']);
    $datos=$Pac->MostrarPacientesRecientes($_SESSION['IdPsicologo']);
    $PORCENTAJES=$PORC->mostrarVista($_SESSION['IdPsicologo']);
?>
    <div class="container">
        <?php
            require_once '../Issets/views/Menu.php';
        ?>    
        <!----------- end of aside -------->
        <main class="animate__animated animate__fadeIn">
            <br>
            <!----------- CAmbios NUEVOS DEL DASHBOARDS -------->
            <div style="text-align: center; max-width: 400px;">
                 <h4 style=" color:#49c691;">¡Buenos dias, <?=$_SESSION['NombrePsicologo']?>!</h4>

                <h3 style="color:#6A90F1; font-size: 18px;">
                Tienes <span style="color:#416cd8; font-weight: bold; font-size:20px"><?= count($totalRegistrosEnCitasHora) ?> citas</span> programadas para hoy
</h3>
<h3 style="color:#6A90F1; font-size: 18px;">
    Tienes <span style="color:#416cd8; font-weight: bold; font-size:20px"><?= $contarPacientesUltimoMes ?> pacientes</span> registrados en el último mes
</h3>

<div class="contenedor-secciones">

<div class="agenda">
    <div class="div_event3">
        <h1>Citas del día</h1>
        <p style="color: #fff;" id="fechaActual"></p>
        
        <a href="citas.php" class="add-button">
    <i class="fas fa-plus"></i> <!-- Icono de suma -->
</a>

        </button>
    </div>

    <?php
    // Llama a la función para obtener las citas con nombre del paciente, hora y minutos
    $citasConNombrePacienteHoraMinutos = (new UserModelCita())->obtenerCitasConNombrePacienteHoraMinutos();
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
</div>
<div class="pie-chart" >
<h3 style="text-align: start; margin:20px 30px;">Pacientes del ultimo mes</h3>
        <h2>Canal de Atracción</h2>
        <canvas id="myPieChart"></canvas>
        <h3  class="h3-dsh">Cita Online</h3>
        <h3  class="h3-dsh">Referidos</h3>
        <h3  class="h3-dsh">Marketing Digital</h3>
    </div>

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
            <div class="insights"style="color: #49c691; ">  
                
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
                <div class="profile">
                    <div class="info">
                        <p>Hola. <b><?=$_SESSION['Usuario']?></b></p>
                        <small class="text-muted">Admin</small>
                    </div>
                </div>
                
                <a href="../issets/views/Salir.php">
                    <span class="material-symbols-sharp" translate="no">logout</span>
                    <h3>Salir</h3>
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
                                    <p><b><?= $key['NomPaciente'] ?> <?= $key['ApPaterno'] ?> <?= $key['ApMaterno'] ?> (<?= $key['CodigoPaciente'] ?>)</b> <?= $key['Edad'] ?> años</p>
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