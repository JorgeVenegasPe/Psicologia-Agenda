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
  <main class="animate_animated animate_fadeIn">
    <?php
    require_once '../issets/views/Info.php';
    ?> 
    
    <div style="display:flex; flex-direction:row; gap:20px; margin-left: 60px;">
      <h2>Historial de Pacientes</h2>
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
                  <?php foreach ($rows as $row): ?>
    <?php
    $user = $Pac->show($row[0]);
    $AtencsUser = $Atenc->showAtenc($row[0]);

    // Verifica si los índices existen antes de acceder a ellos
    if (isset($AtencsUser[4]) && isset($AtencsUser[7]) && isset($AtencsUser[8]) && isset($AtencsUser[10])) {
    ?>
    <tr>
        <td>
            <p style="color: black; cursor: pointer;" onclick="abrirDetallesDerecha('<?=$AtencsUser[4]?>', '<?=$AtencsUser[7]?>', '<?=$AtencsUser[8]?>', '<?=$AtencsUser[10]?>')" ondblclick="cerrarDetallesDerecha()"><?=$AtencsUser[4]?></p>
            <p><?=$AtencsUser[7]?> / <?=$AtencsUser[8]?></p>
        </td>
    </tr>
    <?php } else {?>
    <tr>
       <td colspan="4">No hay pacientes</td>
        </tr>
    <?php } ?>
<?php endforeach; ?>


                
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
  header("Location: ../index.php");
}
?>