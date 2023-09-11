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
    <link rel="stylesheet" href="../Issets/css/FormularioDatos.css">
    <link rel="stylesheet" href="../Issets/css/Dashboard.css"/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <title>Datos de Paciente</title>


    <style>
/* Estilo para el contenedor de detalles (inicialmente oculto) */
#detalles {
    display: none;
    border: 1px solid #ddd;
    padding: 10px;
    margin-left: 20px; /* Margen izquierdo para el contenedor de detalles */
    animation: fadeIn 0.5s ease-in-out; /* Animación de aparición */
}

.detalles {
            display: none;
            width: 300px; /* Ancho del contenedor de detalles */
            background-color: white;
            border: 1px solid #ddd;
            border-radius: 15px;
            padding: 20px;
            z-index: 10;
            animation: fadeIn 0.5s ease-in-out;
        }

/* Estilo para el botón de cierre */
.cerrar {
    cursor: pointer;
    color: red;
    float: right;

    
}

/* Animación de aparición */
@keyframes fadeIn {
    from {
        opacity: 0;
    }
    to {
        opacity: 1;
    }
}
.contener {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 10px;
         		
        }

        .izquierda {
            flex: 1;
            text-align: left;
        }

        .derecha {
            flex: 1;
            text-align: right;
        }
    </style>


</head>
<body>
<?php
require_once("../Controlador/Paciente/ControllerPaciente.php");
require_once("../Controlador/Paciente/ControllerAtencPaciente.php");
require_once("../Controlador/Paciente/ControllerAtencFamiliar.php");
    $Fam=new usernameControlerAreaFamiliar();
    $Atenc=new usernameControlerAtencPaciente();
    $Pac=new usernameControlerPaciente();
    $departamentos = $Pac->MostrarDepartamento();
    $rows=$Pac->ver($_SESSION['IdPsicologo']);
?>

<div class="containerTotal">
<?php
    require_once '../issets/views/Menu.php';
  ?> 
  <!----------- end of aside -------->
  <main class="animate__animated animate__fadeIn">
    <?php
    require_once '../issets/views/Info.php';
    ?> 
    <h2>Historial de Pacientes</h2>
    <div class="recent-updates" style="display:flex; flex-direction: row; gap:20px; align-items: center; padding: 10px 0px 0px 10px">
        <div class="input-group" >
  	        <input  type="text" style="background-color: White;" placeholder="Buscar..."  class="input" required/>
        </div>
        <a class="search" style="padding:10px; font-size:10px;" href="RegPaciente.php">Agregar Paciente</a>
    </div>
      <?php if($rows) :?>
    <div class="containerDatos" id="containerDatos" style="margin: 10px 0 0 75px ;">
        <?php foreach ($rows as $row): ?>
          
          <?php
            $user=$Pac->show($row[0]);
          ?>
          
         <?php
              $AtencsUser=$Atenc->showAtenc($row[0]);
          ?>

          <!-- Ver Diagnostico --> 
          <div id="modalDiagnostico<?=$row[0]?>" class="modal">
              <div class="containerModal">
                  <a href="#" class="close" onclick="closeModalVerDiagnostico('<?=$row[0]?>')">&times;</a>
                  <form>
                      <?php 
                      if ($AtencsUser !== null) { ?>
                          <h2 class="title">Paciente <?=$AtencsUser[4]?></h2>
                          <p><b>Clasificacion: </b><?=$AtencsUser[5]?></p>
                          <p><b>Motivo Consulta: </b><?=$AtencsUser[6]?></p>
                          <p><b>Forma Contacto: </b><?=$AtencsUser[3]?></p>
                          <p><b>Diagnóstico: </b><?=$AtencsUser[7]?></p>
                          <p><b>Tratamiento: </b><?=$AtencsUser[8]?></p>
                          <p><b>Observacion: </b><?=$AtencsUser[9]?></p>
                          <p><b>Ultimos Objetivos: </b><?=$AtencsUser[10]?></p>
                          <div class="button-container">
                              <a type="button" href="../Crud/Paciente/eliminarAtencPaciente.php?id=<?=$AtencsUser[0]?>" id="deleteBtn" class="butonEliminar"><i class="fa fa-trash" aria-hidden="true"></i></a>
                              <a type="button" onclick="openModalEditarDiag('<?=$row[0]?>')"id="editBtn" class="butonEditar"><i class="fa fa-pencil" aria-hidden="true"></i></a>
                          </div>
                      <?php 
                      } else { 
                          ?>
                          <h2 class="error">No hay registros de atención para este paciente</h2>
                      <?php 
                      } 
                      ?>                   
                  </form>
              </div>
          </div>
          <?php
              $AtencAreaFamiliar=$Fam->showAreaFamiliar($row[0]);
          ?>
       <?php endforeach; ?>
          <div class="insightsDatos" >
            <div class="card">
                <div class="card__body">
                    <h1>Agregar nuevo Paciente</h1>
                    <br>
                    <a type="button" href="RegPaciente.php" style="cursor:pointer;" class="nav-link">Agregar</a>
                </div>
            </div>
          </div>
        <?php else : ?>  
                <p class="centered-text">No hay Pacientes<a href="RegPaciente.php"> Agregar nuevo paciente </a></p>

      <?php endif ; ?>
    </div>


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
                  <?php foreach ($rows as $row) : ?>
                      <?php
                      // Obtén los datos de atención para el usuario actual
                      $AtencsUser = $Atenc->showAtenc($row[0]);
                      ?>
                      <tr>
                          <td>
                              <p style="color: black; cursor: pointer;" onclick="abrirDetallesDerecha('<?=$AtencsUser[4]?>', '<?=$AtencsUser[7]?>', '<?=$AtencsUser[8]?>', '<?=$AtencsUser[10]?>')" ondblclick="cerrarDetallesDerecha()"><?=$AtencsUser[4]?></p>
                              <p><?=$AtencsUser[7]?> / <?=$AtencsUser[8]?></p>
                          </td>
                          <td><?=$AtencsUser[7]?></td>
                      </tr>
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
var contenedorDetalles = document.getElementById("contenedorDetalles");
    var detallesAbiertos = null;

    // Función para abrir los detalles en la parte derecha
    function abrirDetallesDerecha(nombre, diagnostico, tratamiento, objetivos) {
        var contenedorIzquierda = contenedorDetalles.querySelector(".izquierda");
        var contenedorDerecha = contenedorDetalles.querySelector(".derecha");

        // Mostrar los datos en el contenedor de detalles
        contenedorIzquierda.innerHTML = "<p><b>Nombre: </b>" + nombre + "</p><p><b>Diagnóstico: </b>" + diagnostico + "</p><p><b>Tratamiento: </b>" + tratamiento + "</p>";
        contenedorDerecha.innerHTML = "<p><b>Ultimos Objetivos: </b>" + objetivos + "</p>";

        // Mostrar el contenedor de detalles en la parte derecha
        contenedorDetalles.style.display = "block";

        // Actualizar el contenedor de detalles abierto actualmente
        detallesAbiertos = contenedorDetalles;
    }

    // Función para cerrar los detalles en el caso de doble clic
    function cerrarDetallesDerecha() {
        if (detallesAbiertos !== null) {
            detallesAbiertos.style.display = "none";
            detallesAbiertos = null;
        }
    }
    </script>





</html>
<?php
}else{
  header("Location: ../Index.php");
}
?>