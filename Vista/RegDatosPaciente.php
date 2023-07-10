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
    <link rel="icon" href="../Issets/images/contigovoyico.ico">
    <link rel="stylesheet" href="../issets/css/Dashboard.css"/>
    <title>Datos del Paciente</title>
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
        <h2>Datos del Paciente</h2>
        <form action="../Crud/Paciente/guardarPaciente.php" method="post" >
        <div style="display:flex; flex-direction:row; gap:70px;">
          <div class="checkout-information">
            <div class="input-group2">
              <div class="input-group">
             	    <h3 for="NomPaciente">Nombre</h3>
				          <input id="NomPaciente" type="text" name="NomPaciente" class="input" required/>
              </div>
              <div class="input-group">
				          <h3 for="Dni">DNI</h3>
				          <input id="Dni" type="text" name="Dni" class="input" required/>
				       </div>
            </div>
            <div class="input-group">
  		        <h3 for="ApPaterno">Apellido Paterno</h3>
  	        	<input id="ApPaterno" type="text" name="ApPaterno" class="input" required/>
            </div>
            <div class="input-group">
              <h3 for="ApMaterno">Apellido Materno</h3>
  	        	<input id="ApMaterno" type="text" name="ApMaterno" class="input" required/>
            </div>
            <div class="input-group2">
  	          <div class="input-group">
  		            <h3 for="FechaNacimiento">Fecha de nacimiento</h3>
  		            <input type="date" id="FechaNacimiento" name="FechaNacimiento" value="<?php echo date('Y-m-d'); ?>" placeholder="Ingrese su Fecha de Nacimiento" onchange="calcularEdad()" />
              </div>
  	          <div class="input-group">
  		            <h3 for="Edad">Edad</h3>
  		            <input type="number" style="width: 40%;"  id="Edad" name="Edad" readonly/>
  	          </div>
            </div>
            <div class="input-group2">
              <div class="input-group">
  		            <h3 for="GradoInstruccion">Grado de instruccion</h3>
  	        	    <input id="GradoInstruccion" type="text" name="GradoInstruccion" class="input" required/>
              </div>
  	          <div class="input-group">
  		            <h3 for="Ocupacion">Ocupacion</h3>
  		            <input type="text" id="Ocupacion" class="input" name="Ocupacion" required/>
  	          </div>
            </div>
            <div class="input-group2">
  	          <div class="input-group">
  		          <h3 for="EstadoCivil">Estado civil</h3>
  		          <select class="input" id="EstadoCivil" name="EstadoCivil" required>
                  <option value="">Seleccione un Estado Civil</option>
                  <option value="soltero">Soltero/a</option>
                  <option value="casado">Casado/a</option>
                  <option value="divorciado">Divorciado/a</option>
                  <option value="viudo">Viudo/a</option>
                </select>
  	          </div>
              <div class="input-group">
  		          <h3 for="Genero">Género</h3>
  		          <select class="input" id="Genero" name="Genero" required>
                  <option value="">Seleccione un Genero</option>
                  <option value="Masculino">Masculino</option>
                  <option value="Femenino">Femenino</option>
                  <option value="Otro">Otro</option>
                </select>
  	          </div>
            </div>
            <div class="input-group">
  		          <h3 for="Telefono">Celular</h3>
  		          <input type="tel" id="Telefono" class="input" name="Telefono"  required/>
  	          </div>
          </div>
          <div class="checkout-information">
            <div style=" width:290px" class="input-group">
  		          <h3 for="Email">Correo Electronico</h3>
  		          <input type="Email" id="Email" class="input" name="Email" required/>
  	        </div>
            <div class="input-group">
  		          <h3 for="Direccion">Dirección</h3>
  		          <input type="text" id="Direccion" class="input" name="Direccion" required/>
  	        </div>
            <div class="input-group">
  		          <h3 for="AntecedentesMedicos">Antecedentes médicos</h3>
  		          <input type="text" id="AntecedentesMedicos" class="input" name="AntecedentesMedicos" required/>
  	        </div>
            <div class="input-group">
  		          <h3 for="MedicamentosPrescritos">Medicamentos Prescritos</h3>
  		          <input type="text" id="MedicamentosPrescritos" class="input" name="MedicamentosPrescritos"  required/>
  	        </div>
            <div class="input-group" style="display: none">
  		          <h3 for="IdPsicologo">IdPsicologo</h3>
  		          <input type="text" id="IdPsicologo" class="input" name="IdPsicologo" value="<?=$_SESSION['IdPsicologo']?>" />
  	        </div>
          </div>
        </div>
        <br>
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
  function calcularEdad() {
    var fechaNacimiento = document.getElementById('FechaNacimiento').value;
    var fechaActual = new Date();
    var edad = fechaActual.getFullYear() - new Date(fechaNacimiento).getFullYear();
    
    // Verificar si el mes actual es anterior al mes de nacimiento o si el mes actual es igual al mes de nacimiento pero el día actual es anterior al día de nacimiento
    if (fechaActual.getMonth() < new Date(fechaNacimiento).getMonth() || (fechaActual.getMonth() === new Date(fechaNacimiento).getMonth() && fechaActual.getDate() < new Date(fechaNacimiento).getDate())) {
      edad--;
    }
    
    document.getElementById('Edad').value = edad;
  }
</script>
</html>
<?php
}else{
  header("Location: ../Index.php");
}
?>