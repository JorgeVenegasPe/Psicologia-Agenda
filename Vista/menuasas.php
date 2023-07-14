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
    <link rel="stylesheet" href="../issets/css/Dashboard.css" />
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/svg.js/3.1.0/svg.min.js"></script>

</head>
<body>
    <?php
require_once("../Controlador/Cita/citaControlador.php");
    $PORC=new usernameControlerCita();
    $PORCENTAJES=$PORC->mostrarVista();
?>
    <div class="container">
        <aside>
            <div class="top">
                <div class="logo">
                    <img src="" alt="">
                    <h2>Psicologa</h2>
                </div>
                <div class="close" id="close-btn">
                    <span class="material-symbols-sharp" translate="no">close</span>
                </div>
            </div>
            <div class="sidebar">
                <a href="Dashboards.php" >
                    <span class="material-symbols-sharp" translate="no">grid_view</span>
                    <h3>Dashboard</h3>
                </a>
                <a href="CalendarioCitas.php">
                    <span class="material-symbols-sharp" translate="no">calendar_month</span>
                    <h3>Calendario</h3>
                </a>
                <a href="RegDatosPaciente.php">
                    <span class="material-symbols-sharp" translate="no">receipt_long</span>
                    <h3>Pacientes</h3>
                </a>
                <a href="citas.php">
                    <span class="material-symbols-sharp" translate="no">contacts</span>
                    <h3>Citas</h3>
                </a>
                <a href="RegFamiliar.php">
                    <span class="material-symbols-sharp" translate="no">receipt_long</span>
                    <h3>Registro Familiar</h3>
                </a>
                <a href="AtenPaciente.php">
                    <span class="material-symbols-sharp" translate="no">mail</span>
                    <h3>Atencion al Paciente</h3>
                    <span class="message-count">26</span>
                </a>
                <a href="DatosPaciente.php">
                    <span class="material-symbols-sharp" translate="no">inventory</span>
                    <h3>Historial</h3>
                </a>
                <a href="#">
                    <span class="material-symbols-sharp" translate="no">settings</span>
                    <h3>Ajustes</h3>
                </a>
                <a href="../issets/views/Salir.php">
                    <span class="material-symbols-sharp" translate="no">logout</span>
                    <h3>Salir</h3>
                </a>
            </div>
        </aside>   

        <!----------- end of aside -------->
        <main>
            <h1>Dashboard</h1>

            <div class="date">
                <input type="date">                
            </div>

            <div class="insights">
                <div class="sales">
                    <span class="material-symbols-sharp" translate="no">analytics</span>
                    <div class="middle">
                        <div class="left">
                            <h3>Tipo de Cita</h3>
                            <p style="display: flex;align-items: center;">
                                <span style="color:#f38238" class="material-symbols-sharp no-style">arrow_right</span>
                                Primera Visita : <b><?php echo $PORCENTAJES['porcentaje_primera_visita']; ?>%</b>
                            </p>
                            <p style="display: flex;align-items: center;">
                                <span style="color:#9274b3" class="material-symbols-sharp no-style">arrow_right</span>
                                Visita de Control: <b><?php echo $PORCENTAJES['porcentaje_visita_control'];?> %</b>
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
                    <span class="material-symbols-sharp" translate="no">bar_chart</span>
                    <div class="middle">
                        <div class="left">
                            <h3>Canal de Atraccion</h3>
                            <p style="display: flex;align-items: center;">
                                <span style="color:#f38238" class="material-symbols-sharp no-style">arrow_right</span>
                                Cita Online: <b> <?php echo $PORCENTAJES['porcentaje_cita_online'];?> %  </b>
                            </p>
                            <p style="display: flex;align-items: center;">
                                <span style="color:#9274b3" class="material-symbols-sharp no-style">arrow_right</span>
                                Marketing Directo: <b><?php echo $PORCENTAJES['porcentaje_marketing_directo'];?> %</b>
                            </p>
                            <p style="display: flex;align-items: center;">
                                <span style="color:#b4d77b" class="material-symbols-sharp no-style">arrow_right</span>
                                Referidos: <b><?php echo $PORCENTAJES['porcentaje_referidos'];?>  %</b>
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
                    <span class="material-symbols-sharp" translate="no">stacked_line_chart</span>
                    <div class="middle">
                        <div class="left">
                            <h3>Estado de Cita</h3>
                            <p style="display: flex;align-items: center;">
                                <span style="color:#f38238" class="material-symbols-sharp no-style">arrow_right</span>
                                Se requiere configuración: <b><?php echo $PORCENTAJES['porcentaje_se_requiere_confirmacion'];?> %</b>  
                            </p>
                            <p style="display: flex;align-items: center;">
                                <span style="color:#9274b3" class="material-symbols-sharp no-style">arrow_right</span>
                                Confirmado: <b><?php echo $PORCENTAJES['porcentaje_confirmado'];?> %</b>
                            </p>
                            <p style="display: flex;align-items: center;">
                                <span style="color:#b4d77b" class="material-symbols-sharp no-style">arrow_right</span>
                                Ausencia del paciente: <b><?php echo $PORCENTAJES['porcentaje_ausencia_paciente'];?> %</b>
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
                <h2>Citas de Hoy</h2>
                <table>
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Fecha Registro</th>
                            <th>Fecha de Inicio</th>
                            <th>Fecha de Fin</th>
                            <th>Nombre de P.</th>
                            <th>Nombre de D.</th>
                            <th>Eliminar</th>
                            <th>Editar</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>foldable mini drone</td>
                            <td>foldable mini drone</td>
                            <td class="warning">peding</td>
                            <td class="primary">Details</td>
                        </tr>
                    </tbody>
                </table>
                <a href="">Show All </a>
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
                        <p>Hola. <b><?=$_SESSION['NombrePsicologo']?></b></p>
                        <small class="text-muted">Admin</small>
                    </div>
                    <div class="profile-photo">
                        <img src="" alt="">
                    </div>
                </div>
            </div>

            <!----------end of Top------->
            <div class="recent-updates">
                <h2>Pacientes Recientes</h2>
                <div class="updates">
                    <div class="update">
                        <div class="profile-photo">
                            <img src="" alt="">
                        </div>
                        <div class="message">
                            <p><b>Mike Tyson</b>asddddddddd</p>
                            <small class="text-muted">2minutes ago</small>
                        </div>
                    </div>
                    <div class="update">
                        <div class="profile-photo">
                            <img src="" alt="">
                        </div>
                        <div class="message">
                            <p><b>Mike Tyson</b>asddddddddd</p>
                            <small class="text-muted">2minutes ago</small>
                        </div>
                    </div>
                    <div class="update">
                        <div class="profile-photo">
                            <img src="" alt="">
                        </div>
                        <div class="message">
                            <p><b>Mike Tyson</b>asddddddddd</p>
                            <small class="text-muted">2minutes ago</small>
                        </div>
                    </div>
                    <div class="update">
                        <div class="profile-photo">
                            <img src="" alt="">
                        </div>
                        <div class="message">
                            <p><b>Mike Tyson</b>asddddddddd</p>
                            <small class="text-muted">2minutes ago</small>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="../issets/js/Dashboard.js"></script>
</body>
</html>
<?php
}else{
  header("Location: ../Index.php");
}
?>

