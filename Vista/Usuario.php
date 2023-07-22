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
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <title>Datos del Paciente</title>
</head>
<body>    
  <?php
    require("../Controlador/Paciente/ControllerPaciente.php");
    $obj = new usernameControlerPaciente();
    $departamentos = $obj->MostrarDepartamento();
  ?>
<div class="containerTotal">
<?php
    require_once '../Issets/views/Menu.php';
  ?> 
  <!----------- end of aside -------->
  <main>
    <?php
    require_once '../Issets/views/Info.php';
    ?> 
      <div class="recent-updates">
      <form action="../Crud/Paciente/guardarPaciente.php" method="post">
    <h4 style="margin-bottom: 0px;"></h4>
    <div style="display: flex; align-items: center; justify-content: center;"></div>
    <div style="width: 70%; margin-left: 15%; margin-bottom:5px;">
        <div class="checkout-information">
            <div style="display: flex; align-items: center; justify-content: center;">
                <img src="https://static.vecteezy.com/system/resources/previews/018/765/757/non_2x/user-profile-icon-in-flat-style-member-avatar-illustration-on-isolated-background-human-permission-sign-business-concept-vector.jpg" alt="" style="width: 150px; height: 150px; border-radius: 80px; border: 10px solid #886CA7; position: absolute; top: +50px;"></div><br><br><br><br>
                <div class="input-group" style="margin-bottom:20px;">
                <div class="data_usuario" style="background-color: white;">
                <h3 for="ApPaterno" style="font-size: 14px; margin-bottom:5px;"></h3>
                <input style="height: 40px; font-size:20px; text-align: center; background-color:white;" id="ApPaterno" type="text" name="ApPaterno" class="input" required value="<?php echo $_SESSION['Usuario']; ?>" disabled/>
              </div>
          </div>
      <script>
        // Wait for the document to be ready
        $(document).ready(function() {
          // When the "Editar" button is clicked
          $("#editarBtn").click(function() {
            // Enable the input field
            $("#ApPaterno").prop("disabled", false);
          });
        });
      </script>
 <div class="input-group" style="display: grid; grid-template-columns: repeat(2, 1fr);  margin-bottom:20px;">
                <div class="data_usuario" style="background-color: white;">
                  <h3 for="ApPaterno" style="font-size: 14px;">ID</h3>
                  <input style="height: 40px; font-size:15px; " id="ApPaterno" type="text" name="ApPaterno" class="input" required value="<?php echo $_SESSION['IdPsicologo']; ?>" disabled/>
                </div>
                <div class="btn_editar" style="display: flex; justify-content: flex-end; align-items:center; background-color: white; height:100%; ">
                  <button style="width: 100px; height:40px; border: 2px solid #886CA7; background-color: #eee3fffb;  border-radius:10px; ">Editar</button>
                </div>
              </div>
              <div class="input-group" style="display: grid; grid-template-columns: repeat(2, 1fr);  margin-bottom:20px;">
                <div class="data_usuario" style="background-color: white;">
                  <h3 for="ApPaterno" style="font-size: 14px;">Nombre</h3>
                  <input style="height: 40px; font-size:14px; " id="ApPaterno" type="text" name="ApPaterno" class="input" required value="<?php echo $_SESSION['NombrePsicologo']; ?>" disabled/>
                </div>
                <div class="btn_editar" style="display: flex; justify-content: flex-end; align-items:center; background-color: white; height:100%; ">
                  <button style="width: 100px; height:40px; border: 2px solid #886CA7; background-color: #eee3fffb;  border-radius:10px; ">Editar</button>
                </div>
              </div>
              <?php
// Obtener el ID del psicólogo desde la sesión o desde alguna otra fuente confiable
$idPsicologo = $_SESSION['IdPsicologo'];

// Conexión a la base de datos (reemplaza estos valores con los de tu propia conexión)
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "Psicologia";

// Crear la conexión
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar la conexión
if ($conn->connect_error) {
    die("La conexión a la base de datos falló: " . $conn->connect_error);
}

// Consultar la contraseña del psicólogo usando su ID
$sql = "SELECT Passwords FROM Psicologo WHERE IdPsicologo = $idPsicologo";
$result = $conn->query($sql);

// Verificar si se encontró el psicólogo y obtener su contraseña
if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $passwordPsicologo = $row['Passwords'];

    // Cerrar la conexión a la base de datos
    $conn->close();
} else {
    // Si el psicólogo no se encontró o no tiene contraseña, puedes mostrar un mensaje de error o manejarlo de otra manera
    $passwordPsicologo = "No se encontró el psicólogo o no tiene contraseña";
}
?>
              <div class="input-group" style="display: grid; grid-template-columns: repeat(2, 1fr);  margin-bottom:20px;">
                <div class="data_usuario" style="background-color: white;">
                  <h3 for="ApPaterno" style="font-size: 14px;"> Contraseña</h3>
                  <input style="height: 40px; font-size:14px; " id="ApPaterno" type="password" name="ApPaterno" class="input" required value="<?php echo $passwordPsicologo; ?>" disabled/>
                </div>
                <div class="btn_editar" style="display: flex; justify-content: flex-end; align-items:center; background-color: white; height:100%; ">
                  <button style="width: 100px; height:40px; border: 2px solid #886CA7; background-color: #eee3fffb;  border-radius:10px; ">Editar</button>
                </div>
              </div>
            
              <div class="input-group" style="display: grid; grid-template-columns: repeat(2, 1fr);  margin-bottom:20px;">
                <div class="data_usuario" style="background-color: white;">
                  <h3 for="ApPaterno" style="font-size: 14px;">Correo</h3>
                  <input style="height: 40px;" id="ApPaterno" type="text" name="ApPaterno" class="input" required/>
                </div>
                <div class="btn_editar" style="display: flex; justify-content: flex-end; align-items:center; background-color: white; height:100%; ">
                  <button style="width: 100px; height:40px; border: 2px solid #886CA7; background-color: #eee3fffb;  border-radius:10px; ">Editar</button>
                </div>
              </div>
              <div class="input-group" style="display: grid; grid-template-columns: repeat(2, 1fr);  margin-bottom:20px;">
                <div class="data_usuario" style="background-color: white;">
                  <h3 for="ApPaterno" style="font-size: 14px;">Telefono</h3>
                  <input style="height: 40px;" id="ApPaterno" type="text" name="ApPaterno" class="input" required/>
                </div>
                <div class="btn_editar" style="display: flex; justify-content: flex-end; align-items:center; background-color: white; height:100%; ">
                  <button style="width: 100px; height:40px; border: 2px solid #886CA7; background-color: #eee3fffb;  border-radius:10px; ">Editar</button>
                </div>
              </div>
            <div class="input-group2"></div>
            <div class="button-container">
                <button id="submitButton"  style="height: 20px; "class="button">Editar</button>
            </div>
        </div>          
    </div>
    <br>
</form>


    </div>
    <div id="notification" style="display: none;" class="notification">
      <p id="notification-text"></p>
      <span class="notification__progress"></span>
    </div>
  </main>
  <script src="../Issets/js/Dashboard.js"></script>

<script>
$(document).ready(function() {
  $('#Departamento').change(function() {
    var departamentoId = $(this).find(':selected').data('id');
    obtenerProvincias(departamentoId);
  });

  function obtenerProvincias(departamentoId) {
    $.ajax({
      url: 'Fetch/obtenerProvincias.php',
      method: 'POST',
      data: { departamentoId: departamentoId },
      dataType: 'json',
      success: function(provincias) {
        // Llenar el select de provincias con los datos obtenidos
        var selectProvincias = $('#Provincia');
        selectProvincias.empty();
        selectProvincias.append($('<option>', {
          value: '',
          text: 'Seleccionar'
        }));
        provincias.forEach(function(provincia) {
          selectProvincias.append($('<option>', {
            value: provincia.id,
            text: provincia.name
          }));
        });
      }
    });
  }
});

$('#Provincia').change(function() {
  var provinciaId = $(this).val();
  obtenerDistritos(provinciaId);
});

function obtenerDistritos(provinciaId) {
  $.ajax({
    url: 'Fetch/obtenerDistritos.php',
    method: 'POST',
    data: { provinciaId: provinciaId },
    dataType: 'json',
    success: function(distritos) {
      // Llenar el select de distritos con los datos obtenidos
      var selectDistritos = $('#Distrito');
      selectDistritos.empty();
      selectDistritos.append($('<option>', {
        value: '',
        text: 'Seleccionar'
      }));
      distritos.forEach(function(distrito) {
        selectDistritos.append($('<option>', {
          value: distrito.id,
          text: distrito.name
        }));
      });
    }
  });
}
    window.addEventListener('DOMContentLoaded', (event) => {
    const notification = document.getElementById('notification');
    const notificationText = document.getElementById('notification-text');

    const urlParams = new URLSearchParams(window.location.search);
    const enviado = urlParams.get('enviado');

    if (enviado === 'true') {
        notification.style.display = 'block';
        notificationText.textContent = 'Enviado Correctamente ✔️';
        history.replaceState(null, null, window.location.pathname);
    }
});
  // Solo acepta 8 digitos en el input dni
  $('input#Dni').keypress(function (event) {
    if (event.which < 48 || event.which > 57 || this.value.length === 8) {
      return false;
    }
  });

  // Solo permite 9 digitos en el numero y que comience con 9
  $('input#Telefono').keypress(function(event) {
    var keyCode = event.which;
    var inputValue = String.fromCharCode(keyCode);

    // Permitir solo números y una longitud máxima de 9 dígitos
    if (keyCode < 48 || keyCode > 57 || this.value.length === 9) {
        return false;
    }

    // Asegurarse de que comience con el número 9
    if (this.value.length === 0 && inputValue !== "9") {
        return false;
    }

  });
 
  // Captura el valor del dni y contar la Longitud
  $("#Dni").on("keyup", function() {
    var Dni = $("#Dni").val(); 
    var longitudDni = $("#Dni").val().length; 
    
    // Valido la longitud 
    if(longitudDni >= 3){
      var dataString = 'Dni=' + Dni;
    
      $.ajax({
        url: 'Fetch/vereficardni.php',
        type: "GET",
        data: dataString,
        dataType: "JSON",
        success: function(datos){
          if(datos.success == 1){
            $("#respuesta").html(datos.message);
            $("input").attr('disabled',true); 
            $("input#Dni").attr('disabled',false); 
            $("#submitButton").attr('disabled',true); 
          
          }else{
            $("#respuesta").html(datos.message);
            $("input").attr('disabled',false); 
            $("#submitButton").attr('disabled',false); 
          
          }
        }
      });
    }
  });

  // Captura el valor del telefono y contar la Longitud
  $("#Telefono").on("keyup", function() {
    var Telefono = $("#Telefono").val(); 
    var longitudTelefono = $("#Telefono").val().length; 

    //Valido la longitud 
    if(longitudTelefono >= 3){
      var dataString = 'Telefono=' + Telefono;

      $.ajax({
        url: 'Fetch/vereficarcelular.php',
        type: "GET",
        data: dataString,
        dataType: "JSON",
        success: function(datos){
          if(datos.success == 1){
            $("#respuesta2").html(datos.message);
            $("input").attr('disabled',true); 
            $("input#Telefono").attr('disabled',false); 
            $("#submitButton").attr('disabled',true); 
          }else{
            $("#respuesta2").html(datos.message);
            $("input").attr('disabled',false); 
            $("#submitButton").attr('disabled',false); 
          }
        }
      });
    }
  });

  // Captura el valor del email y contar la Longitud
  $("#Email").on("keyup", function() {
    var Email = $("#Email").val(); 
    var longitudEmail = $("#Email").val().length; 

    if(longitudEmail >= 3){
      var dataString = 'Email=' + Email;

      $.ajax({
        url: 'Fetch/vereficaremail.php',
        type: "GET",
        data: dataString,
        dataType: "JSON",
        success: function(datos){
          if(datos.success == 1){
            $("#respuesta3").html(datos.message);
            $("input").attr('disabled',true); //Desabilito el input nombre
            $("input#Email").attr('disabled',false); //Habilitando el input cedula
            $("#submitButton").attr('disabled',true); //Desabilito el Botton
          }else{
            $("#respuesta3").html(datos.message);
            $("input").attr('disabled',false); //Habilito el input nombre
            $("#submitButton").attr('disabled',false); //Habilito el Botton
          }
        }
      });
    }
  });

  // Calcular la edad segun la fecha de nacimiento
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
</body>
</html>
<?php
}else{
  header("Location: ../Index.php");
}
?>