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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>    
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <title>Datos del Paciente</title>
</head>
<body>    
  <?php
    require("../Controlador/Paciente/ControllerPaciente.php");
    $obj = new usernameControlerPaciente();
    $Dato = $obj->DatosPsicologo($_SESSION['IdPsicologo']);
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
    <br>
    <br>
      <div class="recent-updates">
        <form action="" method="post" style="width: 620px;">
        <div class="checkout-information">
          <h2><?=$_SESSION['Usuario']?></h2>
          <h1 style="margin-top:-10px">#<?=$_SESSION['IdPsicologo']?></h1>
          <div class="input-group">
            <br>
            <h3 for="CodigoPaciente">Nombre</h3>
            <div style="display: flex; gap:25px;"> 
                <input id="CodigoPaciente" type="text" name="CodigoPaciente" value="<?=$_SESSION['Usuario']?>"  required/>
                <a style="font-size:15px; padding:2px 15px" class="search Codigo">Editar</a>
            </div>
          </div>
          <div class="input-group">
            <h3 for="CodigoPaciente">Usuario</h3>
            <div style="display: flex; gap:25px;"> 
                <input id="CodigoPaciente" type="text" name="CodigoPaciente" value="<?=$_SESSION['NombrePsicologo']?>" required/>
                <a style="font-size:15px; padding:2px 15px" class="search Codigo">Editar</a>
            </div>
          </div>
          <div class="input-group">
            <h3 for="CodigoPaciente">Correo</h3>
            <div style="display: flex; gap:25px;"> 
                <input id="CodigoPaciente" type="text" name="CodigoPaciente" value="<?=$_SESSION['email']?>" required/>
                <a style="font-size:15px; padding:2px 15px" class="search Codigo">Editar</a>
            </div>
          </div>
          <div class="input-group">
            <h3 for="CodigoPaciente">Celular / Telefono</h3>
            <div style="display: flex; gap:25px;"> 
                <input id="CodigoPaciente" type="text" name="CodigoPaciente" value="<?=$_SESSION['celular']?>" required/>
                <a style="font-size:15px; padding:2px 15px" class="search Codigo">Editar</a>
            </div>
          </div>
          <div class="input-group">
            <h3 for="CodigoPaciente">Contraseña </h3>
            <div style="display: flex; gap:25px;"> 
                <input id="CodigoPaciente" type="password" name="CodigoPaciente" value="<?=$_SESSION['Passwords']?>" required/>
                <a style="font-size:15px; padding:2px 15px" class="search Codigo">Editar</a>
            </div>
          </div>
        </div>
        </form>
      </div>
  </main>
</div>
<script src="../Issets/js/Dashboard.js"></script>
</body>
</html>
<?php
}else{
  header("Location: ../Index.php");
}
?>
