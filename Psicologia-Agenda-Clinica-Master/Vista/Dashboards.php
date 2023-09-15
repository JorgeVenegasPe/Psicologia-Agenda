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
    <link rel="stylesheet" href="../issets/css/formulario.css">
    <link rel="stylesheet" href="../Issets/css/Dashboard.css" />
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

    $totalRegistrosEnCanalAtraccion =$PORC->contarCitasConfirmadasConCanal($_SESSION['IdPsicologo']); 
    $totalRegistrosEnCanalAtraccion2 =$PORC->contarCitasConfirmadasConCanal2($_SESSION['IdPsicologo']); 
    $totalRegistrosEnCanalAtraccion3 =$PORC->contarCitasConfirmadasConCanal3($_SESSION['IdPsicologo']); 

    $totalRegistrosEnCitas =$PORC->contarRegistrosEnCitas($_SESSION['IdPsicologo']); 
    $totalPacientes =$PORC->contarRegistrosEnPacientes($_SESSION['IdPsicologo']); 
    $totalPacientesRecientes =$PORC->contarPacientesConFechaActual($_SESSION['IdPsicologo']);
    $totalRegistrosEnCitasConfirmado =$PORC->contarCitasConfirmadas($_SESSION['IdPsicologo']);
    $totalRegistrosEnCitasHora =$PORC->obtenerFechasCitasConFechaActual($_SESSION['IdPsicologo']);
    $contarPacientesUltimoMes =$PORC->contarPacientesUltimoMes($_SESSION['IdPsicologo']);
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
            <div class="contenedor_dsh" >

                 <h4 style=" color:#49c691; text-align: start; margin-left: 20PX;">¡Buenos dias, <?=$_SESSION['NombrePsicologo']?>!</h4>

                <h3 style="color:#6A90F1; font-size: 18px; text-align: start; margin-left: 20PX; ">
                Tienes <span style="color:#416cd8; font-weight: bold; font-size:20px"><?= count($totalRegistrosEnCitasHora) ?> citas</span> programadas para hoy
                </h3>
<div class="contenedor-secciones">
<div class="agenda">
    <?php
    $fecha_actual = new DateTime('now', new DateTimeZone('UTC'));
    $fecha_actual->setTimeZone(new DateTimeZone('America/Lima')); // Cambia a tu zona horaria

    $locale = 'es_ES';
    $fmt = new IntlDateFormatter($locale, IntlDateFormatter::LONG, IntlDateFormatter::NONE);
    $fecha_formateada = $fmt->format($fecha_actual);

    // Llama a la función para obtener las citas con nombre del paciente, hora y minutos
    $citasConNombrePacienteHoraMinutos = (new UserModelCita())->obtenerCitasConNombrePacienteHoraMinutos2($_SESSION['IdPsicologo']);

    // Función de comparación para ordenar citas por hora
    function compararPorHora($a, $b) {
        return strtotime($a['HoraMinutos']) - strtotime($b['HoraMinutos']);
    }

    // Crear un arreglo con todas las horas desde las 09:00 AM hasta las 12:00 PM
    $horas_disponibles = array();
    for ($i = 9; $i <= 12; $i++) {
        $hora = sprintf('%02d:00 AM', $i);
        $horas_disponibles[] = $hora;
    }

    // Crear un arreglo para todas las citas (registradas y en blanco)
    $todas_las_citas = array();

    // Agregar las citas registradas al arreglo
    if (!empty($citasConNombrePacienteHoraMinutos)) {
        foreach ($citasConNombrePacienteHoraMinutos as $cita) {
            $cita["HoraMinutos"] .= " AM"; // Agregar "AM" a la hora de la cita registrada
            $todas_las_citas[] = array(
                'HoraMinutos' => $cita['HoraMinutos'],
                'NomPaciente' => $cita['NomPaciente'],
            );
        }
    }

    // Agregar las citas en blanco al arreglo
    foreach ($horas_disponibles as $hora) {
        $cita_en_blanco = array(
            'HoraMinutos' => $hora,
            'NomPaciente' => '', // Dejar el nombre del paciente en blanco
        );

        // Verificar si hay una cita programada con la misma hora
        $hora_cita_en_blanco = strtotime($hora);
        $eliminar_cita_en_blanco = false;

        foreach ($todas_las_citas as $cita_programada) {
            $hora_cita_programada = strtotime($cita_programada['HoraMinutos']);
            if ($hora_cita_en_blanco === $hora_cita_programada) {
                $eliminar_cita_en_blanco = true;
                break; // Salir del bucle al encontrar una coincidencia
            }
        }

        // Agregar la cita en blanco solo si no coincide con una cita programada
        if (!$eliminar_cita_en_blanco) {
            $todas_las_citas[] = $cita_en_blanco;
        }
    }

    // Ordenar todas las citas por hora
    usort($todas_las_citas, 'compararPorHora');
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

    <table style="background-color: #fff;">
        <?php foreach ($todas_las_citas as $cita): ?>
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
            
<div class="pie-chart" >
<h2 style="text-align: start; margin:20px 20px; font-size:20px;">Pacientes del ltimo mes</h2>
        <div class="grafico">
            <canvas id="myPieChart"></canvas>
        </div>
        <h3  class="h3-dsh">Cita Online: <?= $totalRegistrosEnCanalAtraccion ?> </h3>
        <h3  class="h3-dsh">Marketing Digital: <?= $totalRegistrosEnCanalAtraccion2 ?></h3>
        <h3  class="h3-dsh">Referidos: <?= $totalRegistrosEnCanalAtraccion3 ?></h3>
    </div>

    <script>
    // Importa los datos que deseas mostrar en el gráfico de pastel.
    var canalAtraccion1 = <?= $totalRegistrosEnCanalAtraccion ?>;
    var canalAtraccion2 = <?= $totalRegistrosEnCanalAtraccion2 ?>;
    var canalAtraccion3 = <?= $totalRegistrosEnCanalAtraccion3 ?>;

    // Define colores personalizados para cada canal de atracción
    var colores = ["#8CB7C2", "#7999A4", "#27ae60"];

    // Configura el gráfico de pastel
    var ctx = document.getElementById("myPieChart").getContext('2d');
    var myPieChart = new Chart(ctx, {
        type: 'pie',
        data: {
            //labels: ["Cita Online", "Marketing Digital", "Canal Atracción 3"],
            datasets: [{
                backgroundColor: colores,
                data: [canalAtraccion1, canalAtraccion2, canalAtraccion3]
            }]
        },
        options: {
            responsive: true,
            legend: {
                display: true,
                position: 'bottom'
            }
        }
    });

    // Agrega el mensaje "Gráfico de Canales de Atracción" debajo del gráfico
    /*
    var pieChartMessage = document.createElement("p");
    pieChartMessage.innerHTML = "Gráfico de Canales de Atracción";
    document.querySelector(".pie-chart").appendChild(pieChartMessage);
    */
</script>



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