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
    <link rel="stylesheet" href="../issets/css/MainGeneralB.css">    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <title>Datos de Paciente</title>
</head>
<body>
<?php
require_once("../Controlador/Paciente/ControllerPaciente.php");
    $Pac=new usernameControlerPaciente();
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
    <div class="ContAtencion">        
            <div class="CAtencion">
                <table class="TabAtencion">
                    <thead>
                        <tr>
                            <th>Paciente</th>
                            <th>Fecha</th>
                        </tr>
                    </thead>         
                    <tbody>
                        <?php if ($rows) : ?>
                            <?php foreach ($rows as $row): ?>
                            <?php
                            $user = $Pac->show($row[0]);
                            $AtencsUser = $Pac->showAtenc($row[0]);
                            // Verifica si los índices existen antes de acceder a ellos
                            if (isset($AtencsUser[4]) && isset($AtencsUser[7]) && isset($AtencsUser[8]) && isset($AtencsUser[13])) {
                            ?>
                            <tr data-paciente-id="<?=$row[0]?>">
                                <td>
                                    <p style="cursor: pointer;" class="nombre-paciente"><?=$AtencsUser[4]?></p>
                                    <p><?=$AtencsUser[9]?> / <?=$AtencsUser[7]?></p>
                                </td>

                                <td>
                                    <p><?=$AtencsUser[13]?></p>
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
            </div>            
            <div class="contDetalles" style="display:none;">
                <div class="line"></div>
                <div class="DetallesVer">
                    <div class="contentDet">
                        <div style="margin-bottom: 10px;">
                        <p style="color: #6A92F4; font-size: 19px; font-weight: bold;" 
                        id="nombrePaciente"></p>

                            <p style="color: #6A92F4; font-size: 19px; font-weight: bold;">
                            NOMBRE DEL PACIENTE</p>
                            <p>X AÑOS , PRIMERA O ULTIMA CONSULTA</p>
                            <button type="button" id="butto">Ver Historial Medico</button>
                        </div>
                        <div style="margin: 25px 0px 0px 0px;">
                            <p class="pp2">Diagnóstico</p>
                            <p class="pp" id="diagnostico"><?=$AtencsUser[9]?>/p>
                            <p class="pp2">Tratamiento</p>
                            <p class="pp" id="tratamiento">Escribir Aquí</p>
                            <p class="pp2">Medicamentos</p>
                            <p class="pp" id="medicamentos">Escribir Aquí</p>
                            <p class="pp2">Primera Cita</p>
                            <p class="pp" id="primeraCita">Escribir Aquí</p>
                        </div>                         
                    </div>
                    <div>
                        <div class="date">
                            <h2 style="color: white;" >20/07</h2>
                            <p style="color: white;" >Próxima Consulta</p>
                        </div>
                        <div class="BUT">
                            <button type="button" id="button2">Nueva Entrada</button>
                        </div>
                    </div>                    
                </div>
            </div>      
        </div>
    </div>
  </main>
    <script src="../issets/js/Dashboard.js"></script>
</div>
</body>

<script>
// Agrega un event listener a todas las filas de la tabla
var tableRows = document.querySelectorAll('table tr');
tableRows.forEach(function (row) {
    // Encuentra el elemento de nombre del paciente dentro de la fila
    var nombrePaciente = row.querySelector('.nombre-paciente');

    // Verifica si se encontró un elemento de nombre de paciente
    if (nombrePaciente) {
        nombrePaciente.addEventListener('click', function () {
            // Remueve la clase 'selected' de todas las filas
            tableRows.forEach(function (r) {
                r.classList.remove('selected');
                
                // Cambia el color del texto de las etiquetas <p> dentro de la fila actual a su color original
                var paragraphs = r.querySelectorAll('p');
                paragraphs.forEach(function (p) {
                    p.style.color = 'black'; // Cambia 'black' al color original deseado
                });
            });

            // Agrega la clase 'selected' a la fila actual
            row.classList.add('selected');

            // Cambia el color del texto de las etiquetas <p> dentro de la fila actual a blanco
            var paragraphs = row.querySelectorAll('p');
            paragraphs.forEach(function (p) {
                p.style.color = 'white';
            });
        });
    }
});

</script>


<script>
// // Obtén todos los elementos con la clase "nombre-paciente"
// const nombresPacientes = document.querySelectorAll('.nombre-paciente');

// // Agrega un controlador de eventos clic a cada nombre de paciente
// nombresPacientes.forEach((nombrePaciente) => {
//   nombrePaciente.addEventListener('click', () => {
//     // Encuentra el elemento padre "tr" para obtener el atributo "data-paciente-id"
//     const pacienteId = nombrePaciente.closest('tr').getAttribute('data-paciente-id');

//     // Encuentra el contenedor de detalles correspondiente
//     const contDetalles = document.querySelector('.contDetalles');

//     // Actualiza el contenido del contenedor de detalles según el paciente seleccionado
//     // Esto podría involucrar una llamada a una función que cargue los detalles del paciente en el contenedor

//     // Muestra el contenedor de detalles
//     contDetalles.style.display = 'flex';

//     // Establece el estilo "display: block" para los elementos hijos de contDetalles que deben mantenerlo
//     contDetalles.querySelectorAll('.block-element').forEach((element) => {
//       element.style.display = 'block';
//     });

//     // Agrega un controlador de eventos dblclick para cerrar el contenedor al hacer doble clic
//     nombrePaciente.addEventListener('dblclick', (e) => {
//       // Evita que el doble clic se propague al contenedor de detalles
//       e.stopPropagation();

//       // Oculta el contenedor de detalles
//       contDetalles.style.display = 'none';
//     });
//   });
// });




// Obtén todos los elementos con la clase "nombre-paciente"
const nombresPacientes = document.querySelectorAll('.nombre-paciente');

// Obtén el contenedor de detalles
const contDetalles = document.querySelector('.contDetalles');

// Función para abrir el contenedor de detalles
function abrirDetalles(pacienteId, nombreSeleccionado, diagnostico, tratamiento, medicamentos, primeraCita) {
    // Actualiza el contenido del nombre en el contenedor de detalles
    const nombrePacienteDetalle = document.getElementById('nombrePaciente');
    nombrePacienteDetalle.textContent = nombreSeleccionado;

    // Actualiza otros elementos con los datos del paciente
    const diagnosticoElement = document.getElementById('diagnostico');
    diagnosticoElement.textContent = diagnostico;

    const tratamientoElement = document.getElementById('tratamiento');
    tratamientoElement.textContent = tratamiento;

    const medicamentosElement = document.getElementById('medicamentos');
    medicamentosElement.textContent = medicamentos;

    const primeraCitaElement = document.getElementById('primeraCita');
    primeraCitaElement.textContent = primeraCita;

  // Esto podría involucrar una llamada a una función que cargue los detalles del paciente en el contenedor

  // Muestra el contenedor de detalles
  contDetalles.style.display = 'flex';

  // Establece el estilo "display: block" para los elementos hijos de contDetalles que deben mantenerlo
  contDetalles.querySelectorAll('.block-element').forEach((element) => {
    element.style.display = 'block';
  });
}

// Agrega un controlador de eventos clic a cada nombre de paciente
nombresPacientes.forEach((nombrePaciente) => {
  nombrePaciente.addEventListener('click', () => {
    // Encuentra el elemento padre "tr" para obtener el atributo "data-paciente-id"
    const pacienteId = nombrePaciente.closest('tr').getAttribute('data-paciente-id');
    // Obtén el nombre del paciente seleccionado
    const nombreSeleccionado = nombrePaciente.textContent;
    // Abre el contenedor de detalles
    abrirDetalles(pacienteId, nombreSeleccionado);
  });
});

</script>

<script>
    
</script>


</html>
<?php
}else{
  header("Location: ../index.php");
}
?>