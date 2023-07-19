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
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body>
<?php
require_once("../Controlador/Paciente/ControllerPaciente.php");
require_once("../Controlador/Cita/citaControlador.php");
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
        <main>
            <h2>Dashboard</h2>

            <div class="insights">  
                <div class="sales">
                    <span class="material-symbols-sharp a" translate="no">analytics</span>
                    <div class="middle">
                        <div class="left">
                            <h3>Tipo de Citass</h3>
                            <p style="display: flex;align-items: center;">
                                <span style="color:#f38238" class="material-symbols-sharp no-style">arrow_right</span>
                                Primera Visita : <b> <?php echo $PORCENTAJES['porcentaje_primera_visita']; ?>%</b>
                            </p>
                            <p style="display: flex;align-items: center;">
                                <span style="color:#9274b3" class="material-symbols-sharp no-style">arrow_right</span>
                                Visita de Control : <b> <?php echo $PORCENTAJES['porcentaje_visita_control'];?> %</b>
                            </p>
                            <p style="display: flex;align-items: center;">
                                <span style="color:#b4d77b" class="material-symbols-sharp no-style">arrow_right</span>
                            </p>
                        </div>
                        <div class="progress">
                            <canvas id="miGrafica"></canvas>
                            <script>
                                const datos = [<?php echo $PORCENTAJES['porcentaje_primera_visita']; ?>, <?php echo $PORCENTAJES['porcentaje_visita_control']; ?>];

                                const data = {
                                  labels: ["Primera visita", "Visita de control"],
                                  datasets: [
                                    {
                                      label: "Ventas",
                                      backgroundColor: ["#f38238", "#9274b3" ],
                                      borderColor: "#fff",
                                      borderWidth: 1,
                                      hoverBackgroundColor: ["#f38238", "#9274b3"],
                                      hoverBorderColor: "#fff",
                                      data: datos
                                    }
                                  ]
                                };

                                const options = {
                                  cutout: '70%',
                                  plugins: {
                                    legend: {
                                      display: false, // Oculta la leyenda
                                    },
                                  },
                                };

                                const config = {
                                  type: 'doughnut',
                                  data: data,
                                  options: options,
                                };

                                var miGrafica = new Chart(  document.getElementById('miGrafica'), config);

                            </script>
                        </div>
                    </div>
                </div>
                <!------------------- Final del Sales -------------------->
                <div class="expenses">
                    <span class="material-symbols-sharp a" translate="no">bar_chart</span>
                    <div class="middle">
                        <div class="left">
                            <h3>Canal de Atraccion</h3>
                            <p style="display: flex;align-items: center;">
                                <span style="color:#f38238" class="material-symbols-sharp no-style">arrow_right</span>
                                Cita Online : <b> <?php echo $PORCENTAJES['porcentaje_cita_online'];?> %  </b>
                            </p>
                            <p style="display: flex;align-items: center;">
                                <span style="color:#9274b3" class="material-symbols-sharp no-style">arrow_right</span>
                                Marketing Directo : <b><?php echo $PORCENTAJES['porcentaje_marketing_directo'];?> %</b>
                            </p>
                            <p style="display: flex;align-items: center;">
                                <span style="color:#b4d77b" class="material-symbols-sharp no-style">arrow_right</span>
                                Referidos : <b><?php echo $PORCENTAJES['porcentaje_referidos'];?>  %</b>
                            </p>
                        </div>
                        <div class="progress">
                            <canvas id="miGrafica2"></canvas>
                            <script>
                                const datos2 = [<?php echo $PORCENTAJES['porcentaje_cita_online']; ?>, <?php echo $PORCENTAJES['porcentaje_marketing_directo']; ?>, <?php echo $PORCENTAJES['porcentaje_referidos']; ?>];

                                const data2 = {
                                  labels: ["Cita Online", "Marketing Directo", "Referidos"],
                                  datasets: [
                                    {
                                      backgroundColor: ["#f38238", "#9274b3", "#b4d77b"],
                                      borderColor: "#fff",
                                      borderWidth: 1,
                                      hoverBackgroundColor: ["#f38238", "9274b3", "#b4d77b"],
                                      hoverBorderColor: "#fff",
                                      data: datos2,
                                    }
                                  ]
                                };

                                const options2 = {
                                  cutout: '70%',
                                  plugins: {
                                    legend: {
                                      display: false, // Oculta la leyenda
                                    },
                                  },
                                };

                                const config2 = {
                                  type: 'doughnut',
                                  data: data2,
                                  options: options2,
                                };

                                var miGrafica2 = new Chart(document.getElementById('miGrafica2'), config2);

                            </script>
                        </div>
                    </div> 
                </div>
                <!------------------- Final del expenses -------------------->
                <div class="income">
                    <span class="material-symbols-sharp a" translate="no">stacked_line_chart</span>
                    <div class="middle">
                        <div class="left">
                            <h3>Estado de Cita</h3>
                            <p style="display: flex;align-items: center;">
                                <span style="color:#f38238" class="material-symbols-sharp no-style">arrow_right</span>
                                Se requiere configuración : <b><?php echo $PORCENTAJES['porcentaje_se_requiere_confirmacion'];?> %</b>  
                            </p>
                            <p style="display: flex;align-items: center;">
                                <span style="color:#9274b3" class="material-symbols-sharp no-style">arrow_right</span>
                                Confirmado : <b><?php echo $PORCENTAJES['porcentaje_confirmado'];?> %</b>
                            </p>
                            <p style="display: flex;align-items: center;">
                                <span style="color:#b4d77b" class="material-symbols-sharp no-style">arrow_right</span>
                                Ausencia del paciente : <b><?php echo $PORCENTAJES['porcentaje_ausencia_paciente'];?> %</b>
                            </p>
                        </div>
                        <div class="progress">
                            <canvas id="miGrafica3"></canvas>
                            <script>
                            const datos3 = [<?php echo $PORCENTAJES['porcentaje_se_requiere_confirmacion']; ?>, <?php echo $PORCENTAJES['porcentaje_confirmado']; ?>, <?php echo  $PORCENTAJES['porcentaje_ausencia_paciente']; ?> ];

                              const data3 = {
                                labels: ["Se requiere confirmación", "Confirmado", " Ausencia del paciente "],
                                datasets: [{
                                  label: "Estados de cita",
                                  backgroundColor: ["#f38238", "#9274b3", "#b4d77b"],
                                  borderColor: "#fff",
                                  borderWidth: 1,
                                  hoverBackgroundColor: ["#f38238", "#9274b3", "#b4d77b"],
                                  hoverBorderColor: "#fff",
                                  data: datos3
                                }]
                              };
                          
                              const options3 = {
                                  cutout: '70%',
                                  plugins: {
                                    legend: {
                                      display: false, // Oculta la leyenda
                                    },
                                  },
                                };
                            
                              const config3 = {
                                type: 'doughnut',
                                data: data3,
                                options: options3,
                              };
                          
                              var miGrafica3 = new Chart(document.getElementById('miGrafica3'), config3 );
                            </script>
                        </div>
                    </div>           
                </div>
                <!------------------- Final del income -------------------->
            </div>
            <!----------------- END OF INSIGHTS --------------->
            <div class="recent-orders">
                <h2>Citas de la Semana</h2>
                <table class="tabla-dash">
                    <thead>
                        <tr>
                            <th>Cod.</th>
                            <th>Paciente</th>
                            <th>Motivo</th>
                            <th>Estado</th>
                            <th>Fecha de Inicio</th>
                            <th>Duracion</th>
                            <th>Tipo</th>
                            <th>Canal</th>
                            <th>Etiquetas</th>
                            <th >1º Mensaje</th>
                            <th >2º Mensaje</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php if ($Citas) :?>
                        <?php foreach ($Citas as $Cita): ?>
                        <tr>
                            <td><?=$Cita[11]?></td>
                            <td><?=$Cita[1]?></td>
                            <td><?=$Cita[2]?></td>
                            <td><?=$Cita[3]?></td>
                            <td><?=$Cita[4]?></td>
                            <td style="color:green"><?=$Cita[5]?></td>
                            <td><?=$Cita[6]?></td>
                            <td><?=$Cita[9]?></td>
                            <td><?=$Cita[10]?></td>
                            <td style="color: green;">Yes</td>
                            <td style="color: red;">No</td>
                        </tr>
                        <?php endforeach;?>
                            <?php else : ?>
                                <tr>
                                <td colspan="13" style="text-align: center;"><a href="citas.php"> No hay Citas Agregar nueva Cita </a> </td>
                                </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
                <a href="citas.php">Agregar nueva cita</a>
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
            </div>
            <!----------end of Top------->
            <div class="recent-updates">
                <h2>Pacientes Recientes</h2>
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
                                    <p style="text-align: center;">No hay Pacientes<a href="RegDatosPaciente.php"> Agregar nuevo paciente </a> </p>
                        <?php endif; ?>
                    </div>
                </div>
                <a href="RegDatosPaciente.php">Agregar Paciente</a>
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