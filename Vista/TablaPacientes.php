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
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Sharp:opsz,wght,FILL,GRAD@48,400,1,0" />
    <link rel="stylesheet" href="../Issets/css/formulario.css">
    <link rel="icon" href="../Issets/images/contigovoyico.ico">
    <link rel="stylesheet" href="../Issets/css/Dashboard.css"/> 
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <title>Paciente</title>
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
    require("../Controlador/Paciente/ControllerPaciente.php");
    require("../Controlador/Cita/citaControlador.php");
    $obj=new usernameControlerPaciente();
    $objcita=new usernameControlerCita();
    $rowscita=$objcita->contarRegistrosEnPacientes($_SESSION['IdPsicologo']);
    $rows=$obj->ver($_SESSION['IdPsicologo']);
    $datos = $obj->verPatientAndFamilyInfo($_SESSION['IdPsicologo']);
?>
<div class="containerTotal">
<?php
    require_once '../Issets/views/Menu.php';
  ?> 
  <!----------- end of aside -------->
  <main class="animate__animated animate__fadeIn">
    <?php
    require_once '../Issets/views/Info.php';
    ?>
    <h2>Pacientes del dia</h2>
    <div class="recent-updates" style="display:flex; flex-direction: row; gap:20px; align-items: center; padding: 10px 0px 0px 10px">
        <span style="font-size: 15px;"><b style="font-size: 20px;"><?= $rowscita ?></b> pacientes </span>
        <div class="input-group" >
  	        <input  type="text" style="background-color: White;" placeholder="Buscar"  class="input" required/>
        </div>
        <a class="search" style="padding:10px; font-size:10px;" href="RegPaciente.php">Agregar Paciente</a>
    </div>
    <div class="recent-citas">
        <table>
            <thead>
                <tr>
                    <th></th>
                    <th>Paciente</th>
                    <th>Codigo</th>
                    <th>DNI</th>
                    <th>Email</th>
                    <th>Celular</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
            <?php if ($rows) :?>
    <?php foreach ($rows as $row): ?>
      <tr>
        <td><span class="material-symbols-sharp">check_box_outline_blank</span></td>
        <td id="filaPaciente-<?= $row[0] ?>" style="cursor: pointer;" onclick="toggleInfoPaciente(<?= $row[0] ?>)">
          <?= $row[1] ?> <?= $row[2] ?>
        </td>
        <td><?= $row[18] ?></td>
        <td><?= $row[4] ?></td>
        <td><?= $row[12] ?></td>
        <td><?= $row[11] ?></td>
        <td><span class="material-symbols-sharp">more_vert</span></td>
      </tr>
    <?php endforeach;?>
  <?php endif;?>
  </tbody>
</table>
    </div>
    
    <!--INICIO DE CONTENEDOR DETALLES--->

    <!----- CAMBIOS TEST HANS ------>
    <br>
        <?php if ($datos) :?>

        <?php foreach ($datos as $dato): ?>
          <div class="detalles" id="detallesPaciente-<?= $dato[0] ?>">
        <!-------2do CAMBIO Posicionamiento Vertical------->
        <div style="display:grid; flex-direction:row; gap:10px;">
        <div class="checkout-information">
            <div class="input-group3">
                <p class="visual"><?= $dato[1] ?> <?= $dato[2] ?> <?= $dato[3] ?></p>
                <p class="arriba" for="#">ID: <?= $dato[0] ?></p>
            </div>
            <div class="input-group">
             	<p class="arriba" for="#">Última cita: </p>
              <h2 class="arriba"><?= $dato[17] ?></h2>
            </div>
        </div>
        <!-------2DO CAMBIO FIN------>
        <!-------MI CAMBIO Posicionamiento Horizontal ------>
        <div style="display:flex; flex-direction:row; gap:10px;">
        <!-------MI CAMBIO ------>
        <div class="checkout-information">
          <p class="arriba">Datos especificos: </p>
            <div class="input-group4">
              
  		          <p class="abajo" for="Genero">Género</p>
  		          <p class="arriba"><?= $dato[10] ?></p>
  	          
            </div>
            <div class="input-group4">
                <p class="abajo" for="Genero">Edad</p>
  		          <p class="arriba"><?= $dato[6] ?></p>
            </div>
            <div class="input-group4">
              <p class="abajo" for="#">Estado civil</p>
              <p class="arriba"><?= $dato[9] ?></p>
            </div>
        </div>
        <!-------FIN DE MI CAMBIO ------>

        <div class="checkout-information">
          <p class="arriba">Información de contacto: </p>
            <div class="input-group4">
              
  		          <p class="abajo" for="Genero">Celular</p>
  		          <p class="arriba"><?= $dato[11] ?></p>
  	          
            </div>
            <div class="input-group4">
             	<p class="abajo" for="#">Correo</p>
               <p class="arriba"><?= $dato[12] ?></p>
            </div>
            <div class="input-group4">
             	<p class="abajo" for="#">DNI</p>
               <p class="arriba"><?= $dato[4] ?></p>
            </div>
        </div>
        <!------ Linea de separacion entre mi display flex y grid ---->
        </div>
        <!-------fin de MI CAMBIO2 ------>
          <!-------CAMBIO test 2 Posicionamiento horizontal------>
          <div style="display:flex; flex-direction:row; gap:10px;">
          <div class="checkout-information">
            <p class="arriba">Información personal: </p>
            <div class="input-group4">
              
  		          <p class="abajo" for="Genero">Nombres y apellidos</p>
  		          <p class="arriba"><?= $dato[1] ?> <?= $dato[2] ?> <?= $dato[3] ?></p>
  	          
            </div>
            <div class="input-group4">
             	<p class="abajo" for="#">Correo</p>
               <p class="arriba"><?= $dato[12] ?></p>
            </div>
            <div class="input-group4">
             	<p class="abajo" for="#">DNI</p>
               <p class="arriba"><?= $dato[4] ?></p>
            </div>
        </div>
          
        <div class="checkout-information">
          <p class="arriba">Información familiar: </p>
            <div class="input-group4">
              
  		          <p class="abajo" for="Genero">Nombre de la madre</p>
  		          <p class="arriba"><?= $dato[25] ?></p>
  	          
            </div>
            <div class="input-group4">
             	<p class="abajo" for="#">Estado de la madre</p>
              <p class="arriba"><?= $dato[26] ?></p>
            </div>
            <div class="input-group4">
             	<p class="abajo" for="#">Nombre del padre</p>
              <p class="arriba"><?= $dato[23] ?></p>
            </div>
            <div class="input-group4">
             	<p class="abajo" for="#">Estado del padre</p>
              <p class="arriba"><?= $dato[24] ?></p>
            </div>
            <div class="input-group4">
             	<p class="abajo" for="#">Cantidad de hijos</p>
              <p class="arriba"><?= $dato[30] ?></p>
            </div>
            <div class="input-group4">
             	<p class="abajo" for="#">Antecedentes familiares</p>
              <p class="arriba"><?= $dato[32] ?></p>
            </div>
        </div>
          <!----Linea de separacion entre el formulario y los botones ---->
        </div>
        </div>
        <?php endforeach;?>
        <?php endif;?>
        </div>
            <!----FIN DEL CONTENEDOR DETALLES----->
  </main>
  <script src="../Issets/js/Dashboard.js"></script>
</body>
<script>
function toggleInfoPaciente(idPaciente) {
  // Obtén el contenedor de detalles del paciente
  var contenedorDetalles = document.getElementById('detallesPaciente-' + idPaciente);

  // Si está oculto, muéstralo; de lo contrario, ocúltalo
  if (contenedorDetalles.style.display === 'none' || contenedorDetalles.style.display === '') {
    contenedorDetalles.style.display = 'block';
  } else {
    contenedorDetalles.style.display = 'none';
  }
}
</script>
</html>
<?php
}else{
  header("Location: ../Index.php");
}
?>