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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <title>Datos de Paciente</title>
</head>
<style>
    .before-details{
        background-color: var(--color-white);
        height: 85%;
        width: 100%;
        border-radius: 30px 0px 0px 30px;
    }
    .checkout-information {
     border-left: 10px solid #6a92f4;
     padding-top: 10px;
     padding-right: 10px;
     border-radius: 0px 30px 30px 0px !important;
    }
    .container-paciente-tabla.active{
        display: grid;
        grid-template-columns: 40% 60%;
        gap: 0rem;
        width: 100%;
    }
    .container-paciente-tabla{
        width: 100%;
        align-items: center;
        animation: fadeIn 0.5s ease-in-out;
    }
   
.div-hora{
    display: flex;
    align-items: center;
    background-color: #6A92F4;
    color: white;
    justify-content: center;
}
.visual2{ /*Nueva clase creada para el formulario - Hans */
    color: #6a92f4; /*Añadi un cambio de color - Hans */
    font-size: 22px;
    font-weight: bold;
}
.ci-input-group {
    margin-left: 1rem;
    margin-top: 1rem;
}
.ci-input-group .arriba1{
        font-size: 18px;
        font-weight: 600;
        color: #8fbbc8;
}
.ci-input-group .arriba{
        font-size: 14px;
        font-weight: 500;
        text-align: start;
}
.name{
    display: flex;
    flex-direction: column;
    justify-content: start;
    align-items: start;
    gap: 2px;
}
.container-paciente-tabla.active table {
    width:100%;
    margin-top: 1rem;
    max-height: 55%;
    border-spacing: 0;
}
table{
    width: 100%;
    margin-top: 0.5rem;
    max-height: 55%;
    border-spacing: 0.5rem;
}
.container-paciente-tabla.active table tr.primera-fila td{
    border-top-left-radius: 20px !important;
}   
.container-paciente-tabla.active table td{
    padding-bottom: 1rem;
    padding-top: 1rem;
    /*border de 1px color var(--danger)*/
    border-bottom: 1px solid var(--color-warning);
    border-top: 1px solid var(--color-warning);
}
.patient-details {
        display: none;
        width: auto;
        max-width: 80%;
        text-align: center;
        color: #49c691;
        border-radius: var(--card-border-radius);
        margin-top: 1rem;
        box-shadow: var(--box-shadow);
        animation: fadeIn 0.5s ease-in-out;
    }
    .arriba1 {
        font-size: 24px;
        font-weight: 700;
        text-align: start;
    }
    .arriba{
        font-size: 14px;
        font-weight: 700;
        text-align: start;
    }
</style>
<body>
<?php
require_once("../Controlador/Paciente/ControllerPaciente.php");
    $Pac=new usernameControlerPaciente();
    $patients=$Pac->showCompletoAtencion($_SESSION['IdPsicologo']);    
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
   
    <div class="container-paciente-tabla">      
        <div class="before-details">
        <table>
            <?php if (!empty($patients)) : ?>
                <?php foreach ($patients as $index => $patient) : ?>
                    <tbody>
                        <tr <?php if ($index === 0) echo 'class="primera-fila"'; ?>>
                            <td>
                                <a style="cursor:pointer"
                                    class="show-info"
                                    data-patient-id="<?=$patient[0]?>"
                                    data-nombres="<?= $patient['NomPaciente'] ?> <?= $patient['ApPaterno'] ?> <?= $patient['ApMaterno']?>"
                                    data-edad="<?=$patient['Edad']?>"
                                    data-diagnostico="<?=$patient['Diagnostico']?>"
                                    data-tratamiento="<?=$patient['Tratamiento']?>"
                                    data-medicamentosprescritos="<?=$patient['MedicamentosPrescritos']?>"
                                    data-FechaInicioCita="<?=$patient['FechaInicioCita']?>">
                                    <p style="cursor: pointer;" class="nombre-paciente"><?=$patient['NomPaciente']?> <?=$patient['ApPaterno']?></p>
                                    <p><?=$patient['Diagnostico']?> / <?=$patient['MotivoConsulta']?></p> 
                                </a>
                            </td>
                            <td ><?=$patient['FechaInicioCita']?></td>
                            <td class="additional-column"></td>
                        </tr>
                    </tbody>
                <?php endforeach;?>             
            <?php endif;?>
        </table>
        </div>
        <div class="details">
        <div class="patient-details">
                    
        </div>

        </div>
    </div>
</main>
</div>
<script src="../issets/js/Dashboard.js"></script>
<script>

// Obtén una referencia al elemento con la clase "details"
const detailsContainer = document.querySelector('.details');

// Agrega un event listener al nombre del paciente
const nombrePaciente = document.querySelector('.nombre-paciente');
nombrePaciente.addEventListener('click', function () {
    // Agrega una clase "open" al contenedor de detalles
    detailsContainer.classList.add('open');
});



// Agrega un event listener a todas las filas de la tabla
var tableRows = document.querySelectorAll('table tr');
tableRows.forEach(function (row) {
    // Encuentra el primer TD dentro de la fila
    var firstColumn = row.querySelector('td:first-child');

    // Verifica si se encontró el primer TD
    if (firstColumn) {
        firstColumn.addEventListener('click', function () {
            // Remueve la clase 'selected' de todas las filas
            tableRows.forEach(function (r) {
                r.classList.remove('selected');
                
                // Cambia el color del texto del contenido de las palabras de la fila actual a su color original
                var textElements = r.querySelectorAll('*');
                textElements.forEach(function (el) {
                    el.style.color = 'black'; // Cambia 'black' al color original deseado
                });
            });

            // Agrega la clase 'selected' a la fila actual
            row.classList.add('selected');

            // Cambia el color del texto del contenido de las palabras de la fila actual a blanco
            var textElements = row.querySelectorAll('*');
            textElements.forEach(function (el) {
                el.style.color = 'white';
            });
        });
    }
});

const showInfoLinks = document.querySelectorAll('.show-info');
const additionalColumns = document.querySelectorAll('.additional-column');
const containerpacientetabla = document.querySelector('.container-paciente-tabla');
const patientDetails = document.querySelector('.patient-details');
let currentPatientId = null; // Variable para rastrear el paciente actual

showInfoLinks.forEach(link => {
    link.addEventListener('click', () => {
        // Obtener el ID del paciente desde el atributo data
        const patientId = link.getAttribute('data-patient-id');

            // Ocultar las columnas adicionales
            additionalColumns.forEach(column => {
                column.classList.add('hidden');
                containerpacientetabla.classList.add('active');
            });

            // Obtener los datos del paciente
            const nombres = link.getAttribute('data-nombres');
            const edad = link.getAttribute('data-edad');
            const diagnostico = link.getAttribute('data-diagnostico');
            const tratamiento = link.getAttribute('data-tratamiento');
            const medicamentosprescritos = link.getAttribute('data-medicamentosprescritos');

            const FechaInicioCita = link.getAttribute('FechaInicioCita');
            // Crear el contenido de los detalles del paciente
            const patientInfoHTML = `
            
            <div style="display:grid; flex-direction:row; gap:10px;">
                <div class="checkout-information">
                    <div class="input-group3">
                        <div class="name">
                            <h2 class="visual2">${nombres}</h2>                        
                            <p class="arriba">${edad} años, ${FechaInicioCita || 'Aun no hay cita'}</p>
                            <button type="button" id="butto">Ver Historial Medico</button>                            
                        </div>
                        <div class="date">
                            <h2 style="color: white;" >20/07</h2>
                            <p style="color: white;" >Próxima Consulta</p>
                        </div>
                    </div>
                    <div class="ci-input-group">
                        <h2 class="arriba1" for="#">Diagnostico </h2>
                        <p class="arriba">${diagnostico || 'Aun no hay cita'}</p>
                    </div>
                    <div class="ci-input-group">
                        <h2 class="arriba1" for="#">Tratamiento </h2>
                        <p class="arriba">${tratamiento || 'Aun no hay cita'}</p>
                    </div>
                    <div class="ci-input-group">
                        <h2 class="arriba1" for="#">Medicamentos </h2>
                        <p class="arriba">${medicamentosprescritos || 'Aun no hay cita'}</p>
                    </div>
                    <div class="ci-input-group">
                        <h2 class="arriba1" for="#">Primera cita </h2>
                        <p class="arriba">${FechaInicioCita || 'Aun no hay cita'}</p>
                    </div>
                    <div class="BUT">
                        <button type="button" id="button2">Nueva Entrada</button>
                    </div>
                </div>
            </div>
            `;

            // Mostrar la información en el elemento .patient-details
            patientDetails.innerHTML = patientInfoHTML;

            // Mostrar el cuadro de detalles
            patientDetails.style.display = 'block';

            currentPatientId = patientId; // Actualizar el ID del paciente actual
        
    });
});
</script>
</body>
</html>
<?php
}else{
  header("Location: ../index.php");
}
?>