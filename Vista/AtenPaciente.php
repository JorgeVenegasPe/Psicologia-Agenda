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
    <link rel="stylesheet" href="../issets/css/formulario.css">
    <link rel="stylesheet" href="../issets/css/Dashboard.css"/>
    <link rel="icon" href="../Issets/images/contigovoyico.ico">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <title>Datos del Paciento</title>
</head>
<body>    
<div class="containerTotal">
  <?php
    require_once '../Issets/views/Menu.php';
  ?> 
  <!----------- end of aside -------->
  <main>
    <?php
    require_once '../Issets/views/Info.php';
    ?> 
    <div class="container-form">
      <div class="recent-updates">
        <form action="../Crud/Paciente/guardarAtencPaciente.php" method="post">
        <h4>Atencion al Paciente</h4>
        <div style="display:flex; flex-direction:row; gap:70px;">
          <div class="checkout-information">
            <div class="input-group2">
              <div class="input-group" >
                <h3 for="IdPaciente">Id Paciente</h3>
                <div style="display: flex;">
                  <input id="IdPaciente"  type="text" name="IdPaciente" class="input" required/>
                    <a class="search id"><span style="font-size:4em" class="material-symbols-sharp">search</span></a>
                </div>
              </div>
              <div class="input-group" >
                <h3 for="NomPaciente">Nombre Paciente</h3>
                <div style="display: flex; gap:5px;">
                  <input id="NomPaciente" type="text" name="NomPaciente" class="input" />
                    <a class="search nom"><span style="font-size:4em" class="material-symbols-sharp">search</span></a>
                </div>
              </div>
            </div>
            <div class="input-group">
					      <h3 for="Paciente" >Paciente</h3>
					      <input id="Paciente" type="text" name="Paciente" class="input" readonly/>
				    </div>
            <div class="input-group2">
              <div class="input-group">
         	      <h3 for="MotivoConsulta">Motivo de la Consulta</h3>
				        <input id="MotivoConsulta" type="text" name="MotivoConsulta" class="input" required/>
              </div>
              <div class="input-group">
				        <h3 for="FormaContacto">Forma de Contacto</h3>
				        <input id="FormaContacto" type="text" name="FormaContacto" class="input" required/>
				      </div>
            </div>
            <div class="input-group">
				      	<h3 for="Diagnostico">Diagnostico</h3>
				      	<textarea style="resize: none; padding: 1.2em 1em 2.8em 1em;font-family: 'Poppins', sans-serif;	font-size: 14px;" type="text" id="Diagnostico" name="Diagnostico" placeholder="Ingrese su diagnostico" required></textarea>
				    </div>
            <div class="input-group">
				      	<h3 for="Tratamiento">Tratamiento</h3>
				      	<textarea style="resize: none; padding: 1.2em 1em 2.8em 1em;font-family: 'Poppins', sans-serif;	font-size: 14px;" type="text" id="Tratamiento" name="Tratamiento" placeholder="Tratamiento" required></textarea>
				    </div>
          </div>
          <div class="checkout-information">
            <div class="input-group">
				      	<h3 for="Observacion">Observacion</h3>
				      	<textarea style="resize: none; padding: 1.2em 1em 2.8em 1em;font-family: 'Poppins', sans-serif;	font-size: 14px;" type="text" id="Observacion" name="Observacion" placeholder="Observacion" required></textarea>
				    </div>
            <div class="input-group">
				      	<h3 for="UltimosObjetivos">Ultimos Objetivo / Objetivo alcanzado </h3>
				      	<textarea style="resize: none; padding: 1.2em 1em 2.8em 1em;font-family: 'Poppins', sans-serif;	font-size: 14px;" type="text" id="UltimosObjetivos" name="UltimosObjetivos" placeholder="Observacion" required></textarea>
				    </div>
            <div class="input-group2">
              <div class="input-group" >
                <h3 for="CodEnfermedad">DSM5</h3>
                <div style="display: flex;gap:5px;">
                  <input id="CodEnfermedad"  type="text" name="CodEnfermedad" class="input" />
                    <a class="search codEnf"><span style="font-size:4em" class="material-symbols-sharp">search</span></a>
                </div>
              </div>
              <div class="input-group" >
                <h3 for="CodEnfermedad">CEA10</h3>
                <div style="display: flex;gap:5px;">
                  <input id="CodEnfermedad"  type="text" name="CodEnfermedad" class="input" />
                    <a class="search codEnf"><span style="font-size:4em" class="material-symbols-sharp">search</span></a>
                </div>
              </div>
              
            </div>
            <div class="input-group" style="flex-direction: column;width: 140%;">
                <h3 for="DescripcionEnfermedad">Clasificacion</h3>
                <div style="display: flex; gap:5px;">
                  <input id="DescripcionEnfermedad" type="text" name="DescripcionEnfermedad" class="input" />
                </div>
              </div>
            <div class="input-group" style="display: none;">
					      <h3 for="IdEnfermedad" >IdEnfermedad</h3>
					      <input id="IdEnfermedad" type="text" name="IdEnfermedad" class="input" readonly/>
				    </div>
          </div>
        </div>
          <div class="button-container">
            <button id="submitButton" class="button">Registrar</button>
          </div>
        </form>
      </div>
    </div>
  </main>  
  <script src="../issets/js/Dashboard.js"></script>

</body>
<script>
// Buscador de la Enfermedad
  $(document).ready(function() {
    $('.codEnf').click(function() {
      var CodEnfermedad = $('#CodEnfermedad').val();
      $.ajax({
        url: 'Fetch/fetch_enfermedad.php',
        method: 'POST',
        data: { CodEnfermedad: CodEnfermedad },
        success: function(response) {
          if (response.error) {
            $('#DescripcionEnfermedad').val('No existe esa enfermedad');
            $('#IdEnfermedad').val('');
          } else {
            $('#DescripcionEnfermedad').val(response.nombre);
		        $('#IdEnfermedad').val(response.id);
          }
        },
        error: function() {
          $('#DescripcionEnfermedad').val('Error al procesar la solicitud');
          $('#IdEnfermedad').val('');
        }
      });
    });
  });
  
//Buscador del paciente segun su id 
  $(document).ready(function() {
  $('.id').click(function() {
    var codigoPaciente = $('#IdPaciente').val();
    var idPsicologo = <?php echo $_SESSION['IdPsicologo']; ?>;

    // Realizar la solicitud AJAX al servidor
    $.ajax({
      url: 'Fetch/fetch_paciente.php', // Archivo PHP que procesa la solicitud
      method: 'POST',
      data: { codigoPaciente: codigoPaciente, idPsicologo: idPsicologo },
      success: function(response) {
        if (response.hasOwnProperty('error')) {
          $('#Paciente').val(response.error);
          $('#NomPaciente').val(response.error);
        } else {
          $('#Paciente').val(response.nombre);
          $('#NomPaciente').val(response.nom);
        }
      },
      error: function() {
        $('#Paciente').val('Error al procesar la solicitud');
        $('#NomPaciente').val('Error al procesar la solicitud');
      }
    });
  });
});

// Buscador paciente segun su nombre 
$(document).ready(function() {
  $('.nom').click(function() {
    var NomPaciente = $('#NomPaciente').val();
    var idPsicologo = <?php echo $_SESSION['IdPsicologo']; ?>;

    // Realizar la solicitud AJAX al servidor
    $.ajax({
      url: 'Fetch/fetch_pacienteNom.php', // Archivo PHP que procesa la solicitud
      method: 'POST',
      data: { NomPaciente: NomPaciente, idPsicologo: idPsicologo },
      success: function(response) {
        if (response.hasOwnProperty('error')) {
          $('#Paciente').val(response.error);
          $('#IdPaciente').val('');
        } else {
          $('#Paciente').val(response.nombre);
		      $('#IdPaciente').val(response.id);
        }
      },
      error: function() {
        $('#Paciente').val('Error al procesar la solicitud');
        $('#IdPaciente').val('');
      }
    });
  });
});
</script>
</html>
<?php
}else{
  header("Location: ../Index.php");
}
?>