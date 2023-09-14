<?php
session_start();
if (isset($_SESSION['usuario'])){
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../issets/css/formulario.css">
    <title>Registro del Paciente</title>
</head>
<body><style>
        .b{
          display: none;
        }
    </style>
  <?php
	    require "../issets/views/header.php";
	?>
  <div style="margin-top:150px; text-align:center;">
      <h2 class="title">Nada Primera pag</h2>
  </div>
</body>
</html>
<?php
}else{
  header("Location: ../Index.php");
}
?>