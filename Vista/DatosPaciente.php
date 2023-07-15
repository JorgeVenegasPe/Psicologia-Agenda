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
    <link rel="stylesheet" href="../issets/css/FormularioDatos.css">
    <link rel="icon" href="../Issets/images/contigovoyico.ico">
    <link rel="stylesheet" href="../issets/css/Dashboard.css"/>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <title>Datos de Paciente</title>
</head>
<body>
<?php
require_once("../Controlador/Paciente/ControllerPaciente.php");
require_once("../Controlador/Paciente/ControllerAtencPaciente.php");
require_once("../Controlador/Paciente/ControllerAtencFamiliar.php");
    $Fam=new usernameControlerAreaFamiliar();
    $Atenc=new usernameControlerAtencPaciente();
    $Pac=new usernameControlerPaciente();
    $rows=$Pac->ver($_SESSION['IdPsicologo']);
?>
<div class="containerTotal">
<?php
    require_once '../issets/views/Menu.php';
  ?> 
  <!----------- end of aside -------->
  <main>
    <?php
    require_once '../issets/views/Info.php';
    ?> 
    <h2>Datos del Paciente</h2>
<div class="containerDatos">
    <div class="insightsDatos">
        <?php if ($rows): ?>
            <?php foreach ($rows as $row): ?>
                <div class="card" data-id="<?=$row[0]?>">
                    <div class="card__body">
                        <h1><?=$row[1]?> <?=$row[2]?></h1>
                        <label>Id: </label><label class="id"><?=$row[0]?></label>
                        <br>
                        <!--MOSTRAMOS EL CODIGO DEL PACIENTE-->
                        <?php
                            $user = $Pac->show($row[0]);
                        ?>
                        <label>Código Paciente: </label><label class="codigo"><?=$user['CodigoPaciente']?></label>
                        <br>
                        <label>Correo: </label><label class="correo"><?=$row[12]?></label>
                        <br>
                        <br>
                        <a type="button" style="cursor:pointer;" class="nav-link" onclick="openModalVerPaciente('<?=$row[0]?>')">Ver Datos Personales</a>
                        <br>
                        <a type="button" style="cursor:pointer;" class="nav-link" onclick="openModalVerHistorialFamiliar('<?=$row[0]?>')">Ver Datos Familiares</a>
                        <br>
                        <a type="button" style="cursor:pointer;" class="nav-link" onclick="openModalVerDiagnostico('<?=$row[0]?>')">Ver Última Sesión</a>
                        <br>
                        <a type="button" style="cursor:pointer;" class="nav-link" onclick="openModalVerHistorial('<?=$row[0]?>')">Ver Historial</a>
                    </div>
                </div>

                <?php
                    $user=$Pac->show($row[0]);
                ?>
                <!-- Ver Pacientes --> 
                <div id="modalPaciente<?=$row[0]?>" class="modal">
                    <div class="containerModal">
                        <a href="#" class="close" onclick="closeModalVerPaciente('<?=$row[0]?>')">&times;</a>
                        <form autocomplete="off"method="post">
                            <h2 class="title">Paciente <?=$user[1]?></h2>
                            <p>Id <label class="datos"><?=$user[0]?></label></p>
                            <p>Apellido Paterno: <label class="datos"><?=$user[2]?></label></p>
                            <p>Apellido Materno:  <label class="datos"><?=$user[3]?></label></p>
                            <p>DNI:  <label class="datos"><?=$user[4]?></label></p>
                            <p>Fecha de Nacimiento:  <label class="datos"><?=$user[5]?></label></p>
                            <p>Edad: <label class="datos"> <?=$user[6]?></label></p>
                            <p>Grado de Instruccion:  <label class="datos"><?=$user[7]?></label></p>
                            <p>Ocupaciòn:  <label class="datos"><?=$user[8]?></label></p>
                            <p>Estado Civil:  <label class="datos"><?=$user[9]?></label></p>
                            <p>Genero:  <label class="datos"><?=$user[10]?></label></p>
                            <p>Telefono:  <label class="datos"><?=$user[11]?></label></p>
                            <p>Email:  <label class="datos"><?=$user[12]?></label></p>
                            <p>Direccion:  <label class="datos"><?=$user[13]?></label></p>
                            <p>Antecedentes Medicos:  <label class="datos"><?=$user[14]?></label></p>
                            <p>Medicamentos Prescritos:  <label class="datos"><?=$user[16]?></label></p>
                            <div class="butonss">
                            <a type="button" href="../Crud/Paciente/eliminarPaciente.php?id=<?=$row[0]?>" id="deleteBtn" class="btne"><i class="fa fa-trash" aria-hidden="true"></i></a>
                            <a type="button" id="editBtn" onclick="openModalEditar('<?=$row[0]?>')" class="btnm"><i class="fa fa-pencil" aria-hidden="true"></i></a>
                            </div>
                        </form>
                    </div>
                </div>
                 <!-- Editar Paciente -->
                 <div id="modalEditar<?=$row[0]?>" class="modal">
                    <div class="containerModal">
                        <a href="#" class="close" onclick="closeModalEditar('<?=$row[0]?>')">&times;</a>
                        <form action="../Crud/Paciente/modificarPaciente.php" class="form" autocomplete="off"
                            method="post">
                            <h2 class="title">Modificar datos de <?=$user[1]?><label class="labelModalTittle"></label></h2>
                            <div class="checkout-information">
                                <input style="display:none" type="text" value="<?=$user[0]?>">
                                <div class="input-group">
                                    <label style="display:none" class="labelModal" for="IdPaciente">IdPaciente</label>
                                    <input style="display:none" type="text" Id="IdPaciente" name="IdPaciente" class="input"value="<?=$user[0]?>" />
                                </div>
                                <div class="input-group2">
                                    <div class="input-group">
                                        <label class="labelModal" for="NomPaciente">Nombre</label>
                                        <input type="text" id="NomPaciente" name="NomPaciente" class="input" value="<?=$user[1]?>" />
                                    </div>
                                    <div class="input-group">
                                        <label class="labelModal" for="Dni">DNI</label>
                                        <input type="text"id="Dni" name="Dni" value="<?=$user[4]?>" required>
                                    </div>
                                </div>
                                <div class="input-group">
                                    <label class="labelModal" for="ApPaterno">Apellido Materno</label>
                                    <input class="input" type="text" id="ApPaterno" name="ApPaterno" value="<?=$user[2]?>" required>
                                </div>
                                <div class="input-group">
                                    <label class="labelModal" for="ApMaterno">Apellido Paterno</label>
                                    <input class="input" type="text" id="ApMaterno" name="ApMaterno" value="<?=$user[3]?>" required>
                                </div>
                                <div class="input-group2">
                                    <div class="input-group">
                                        <label class="labelModal" for="FechaNacimiento">Fecha de Naciemiento</label>
                                        <input type="date" id="FechaNacimiento" name="FechaNacimiento" value="<?=$user[5]?>" required>
                                    </div>
                                    <div class="input-group">
                                        <label class="labelModal" for="Edad">Edad</label>
                                        <input type="text" id="Edad" name="Edad" value="<?=$user[6]?>" required>
                                    </div>
                                </div>
                                <div class="input-group2">
                                    <div class="input-group">
                                        <label class="labelModal" for="GradoInstruccion">Grado de Instruccion</label>
                                        <input class="input" id="GradoInstruccion"type="text" name="GradoInstruccion" value="<?=$user[7]?>" required>
                                    </div>
                                    <div class="input-group">
                                        <label class="labelModal" for="Ocupacion">Ocupacion</label>
                                        <input class="input" type="text" id="Ocupacion" name="Ocupacion" value="<?=$user[8]?>" required>
                                    </div>
                                </div>
                                <div class="input-group2">
                                    <div class="input-group">
                                        <label class="labelModal" for="EstadoCivil">Estado Civil</label>
                                        <input type="text" id="EstadoCivil" name="EstadoCivil" value="<?=$user[9]?>" required>
                                    </div>
                                    <div class="input-group">
                                        <label class="labelModal" for="Genero">Genero</label>
                                        <input type="text" id="Genero" name="Genero" value="<?=$user[10]?>" required>
                                    </div>
                                </div>
                                <div class="input-group">
                                    <label class="labelModal" for="Telefono">Telefono</label>
                                    <input type="text" id="Telefono" name="Telefono" value="<?=$user[11]?>" required>
                                </div>
                                <div class="input-group">
                                    <label class="labelModal" for="Email">Email</label>
                                    <input class="input" id="Email" type="text" name="Email" value="<?=$user[12]?>" required>
                                </div>
                                <div class="input-group">
                                    <label class="labelModal" for="Direccion">Direccion</label>
                                    <input class="input" type="text" id="Direccion" name="Direccion" value="<?=$user[13]?>" required>
                                </div>
                                <div class="input-group">
                                    <label class="labelModal" for="AntecedentesMedicos">Antecedentes Medicos</label>
                                    <input type="text" id="AntecedentesMedicos" name="AntecedentesMedicos" value="<?=$user[14]?>" required>
                                </div>
                                <div class="input-group">
                                    <label class="labelModal" for="MedicamentosPrescritos">Medicamentos Prescritos</label>
                                    <input type="text" id="MedicamentosPrescritos" name="MedicamentosPrescritos" value="<?=$user[16]?>" required>
                                </div>
                                <br>
                                <div class="xd">
                                    <button type="submit" class="buttonEditar">Editar</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <?php
                    $AtencsUser=$Atenc->showAtenc($row[0]);
                ?>
                <!-- Ver Diagnostico --> 
                <div id="modalDiagnostico<?=$row[0]?>" class="modal">
                    <div class="containerModal">
                        <a href="#" class="close" onclick="closeModalVerDiagnostico('<?=$row[0]?>')">&times;</a>
                        <form class="form" autocomplete="off"method="post">
                            <?php 
                            if ($AtencsUser !== null) { ?>
                                <h2 class="title">Paciente <?=$AtencsUser[4]?></h2>
                                <p>Clasificacion: <label class="datos"><?=$AtencsUser[3]?></label></p>
                                <p>Motivo Consulta: <label class="datos"><?=$AtencsUser[5]?></label></p>
                                <p>Forma Contacto: <label class="datos"><?=$AtencsUser[6]?></label></p>
                                <p>Diagnóstico: <label class="datos"><?=$AtencsUser[7]?></label></p>
                                <p>Tratamiento: <label class="datos"><?=$AtencsUser[8]?></label></p>
                                <p>Observacion: <label class="datos"><?=$AtencsUser[9]?></label></p>
                                <p>Ultimos Objetivos: <label class="datos"><?=$AtencsUser[10]?></label></p>
                                <div class="container-buttons">
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
                <!-- Editar Diagnostico -->
                <div id="modalEditarDiag<?=$row[0]?>" class="modal">
                    <div class="containerModal" >
                        <a href="#" class="close" onclick="closeModalEditarDiag('<?=$row[0]?>')">&times;</a>
                        <form action="../Crud/Paciente/modificarAtencPaciente.php" class="form" autocomplete="off"
                            method="post">
                            <h2 class="title">Modificar datos de <?=$AtencsUser[3]?><label class="labelModalTittle"></label></h2>
                            <div class="checkout-information">
                                <input style="display:none" type="text" value="<?=$AtencsUser[0]?>">
                                <div class="input-group">
                                    <label style="display:none" class="labelModal" for="IdAtencion">IdAtencion</label>
                                    <input style="display:none" type="text" Idn="IdAtencion" name="IdAtencion" class="input"value="<?=$AtencsUser[0]?>" />
                                </div>
                                <div class="input-group">
                                    <label class="labelModal" for="MotivoConsulta">Motivo Consulta</label>
                                    <input class="input" type="text" id="MotivoConsulta" name="MotivoConsulta" value="<?=$AtencsUser[5]?>" required>
                                </div>
                                <div class="input-group">
                                    <label class="labelModal" for="FormaContacto">Forma Contacto</label>
                                    <input class="input" type="text" id="FormaContacto" name="FormaContacto" value="<?=$AtencsUser[6]?>" required>
                                </div>
                                <div class="input-group">
                                    <label class="labelModal" for="Diagnostico">Diagnostico</label>
                                    <input class="input" type="text" id="Diagnostico" name="Diagnostico" value="<?=$AtencsUser[7]?>" required>
                                </div>
                                <div class="input-group">
                                    <label class="labelModal" for="Tratamiento">Tratamiento</label>
                                    <input class="input" type="text" id="Tratamiento" name="Tratamiento" value="<?=$AtencsUser[8]?>" required>
                                </div>
                                <div class="input-group">
                                    <label class="labelModal" for="Observacion">Obervacion</label>
                                    <input class="input" type="text" id="Observacion" name="Observacion" value="<?=$AtencsUser[9]?>" required>
                                </div>
                                <div class="input-group">
                                    <label class="labelModal" for="UltimosObjetivos">Ultimos Objetivos</label>
                                    <input class="input" type="text" id="UltimosObjetivos" name="UltimosObjetivos" value="<?=$AtencsUser[10]?>" required>
                                </div>
                                <br>
                                <div class="xd">
                                    <button type="submit" class="buttonM">Editar</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <?php
                    $AtencAreaFamiliar=$Fam->showAreaFamiliar($row[0]);
                ?>
                <!-- Ver Historial Familiar-->
                <div id="modalHistorialFamiliar<?=$row[0]?>" class="modal">
                    <div class="containerModal">
                        <a href="#" class="close" onclick="closeModalVerHistorialFamiliar('<?=$row[0]?>')">&times;</a>
                        <form class="form" autocomplete="off" method="post">
                            <?php 
                            if ($AtencAreaFamiliar !== null) { ?>
                                <h2 class="title">Paciente <?=$AtencAreaFamiliar[2]?></h2>
                                <p style="display:none">Id: <label class="datos"><?=$AtencAreaFamiliar[0]?></label></p>
                                <p>Nombre de Padre: <label class="datos"><?=$AtencAreaFamiliar[3]?></label></p>
                                <p>Estado de Padre: <label class="datos"><?=$AtencAreaFamiliar[4]?></label></p>
                                <p>Nombre de Madre: <label class="datos"><?=$AtencAreaFamiliar[5]?></label></p>
                                <p>Estado de Madre: <label class="datos"><?=$AtencAreaFamiliar[6]?></label></p>
                                <p>Nombre de Apoderado: <label class="datos"><?=$AtencAreaFamiliar[7]?></label></p>
                                <p>Estado de Apoderado: <label class="datos"><?=$AtencAreaFamiliar[8]?></label></p>
                                <p>Numero de Hermanos: <label class="datos"><?=$AtencAreaFamiliar[9]?></label></p>
                                <p>Numero de Hijos: <label class="datos"><?=$AtencAreaFamiliar[10]?></label></p>
                                <p>Integracion Familiar: <label class="datos"><?=$AtencAreaFamiliar[11]?></label></p>
                                <p>Historial Familiar: <label class="datos"><?=$AtencAreaFamiliar[12]?></label></p>
                                <div class="butonss">
                                    <a type="button" href="../Crud/Paciente/eliminarAreaFamiliar.php?id=<?=$AtencAreaFamiliar[0]?>" id="deleteBtn" class="btne"><i class="fa fa-trash" aria-hidden="true"></i></a>
                                    <a type="button" onclick="openModalModificarHistorialFamiliar('<?=$AtencAreaFamiliar[0]?>')"id="editBtn" class="btnm"><i class="fa fa-pencil" aria-hidden="true"></i></a>
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
                <!-- Editar Hitorial Familar-->
                <div id="modalModificarHistorialFamiliar<?=$AtencAreaFamiliar[0]?>" class="modal">
                    <div class="containerModal" >
                        <a href="#" class="close" onclick="closeModalModificarHistorialFamiliar('<?=$AtencAreaFamiliar[0]?>')">&times;</a>
                        <form action="../Crud/Paciente/modificarAreaFamiliar.php" class="form" autocomplete="off"
                            method="post">
                            <h2 class="title">Modificar datos de <?=$AtencAreaFamiliar[2]?><label class="labelModalTittle"></label></h2>
                            <div class="checkout-information">
                                <input style="display:none" type="text" value="<?=$AtencAreaFamiliar[0]?>">
                                <div class="input-group">
                                    <label style="display:none" class="labelModal" for="IdFamiliar">IdFamiliar</label>
                                    <input style="display:none" type="text" id="IdFamiliar" name="IdFamiliar" class="input"value="<?=$AtencAreaFamiliar[0]?>" />
                                </div>
                                <div class="input-group">
                                	<label for="NomMadre" >Nombre de la Madre</label>
                                	<input id="NomMadre" type="text" name="NomMadre" class="input" value="<?=$AtencAreaFamiliar[3]?>" required/>
                                </div>
                                <div class="input-group">
                                	<label for="EstadoMadre" >Estado de la Madre</label>
                                	<input type="text" id="EstadoMadre" name="EstadoMadre" value="<?=$AtencAreaFamiliar[4]?>" required/>
                                </div>
                                <div class="input-group">
                                	<label for="NomPadre" >Nombre del Padre</label>
                                	<input id="NomPadre" type="text" name="NomPadre" class="input" value="<?=$AtencAreaFamiliar[5]?>" required/>
                                </div>
                                <div class="input-group">
                                	<label for="EstadoPadre" >Estado del Padre</label>
                                	<input type="text" id="EstadoPadre" name="EstadoPadre" value="<?=$AtencAreaFamiliar[6]?>" required/>
                                </div>
                                <div class="input-group">
                                	<label for="NomApoderado" >Nombre del Apoderado</label>
                                	<input id="NomApoderado" type="text" name="NomApoderado" class="input" value="<?=$AtencAreaFamiliar[7]?>" required/>
                                </div>
                                <div class="input-group">
                                	<label for="EstadoApoderado" >Estado del Apoderado</label>
                                	<input type="text" id="EstadoApoderado" name="EstadoApoderado" value="<?=$AtencAreaFamiliar[8]?>" required/>
                                </div>
                                <div class="input-group2">
                                	<div style="flex-direction:column">
                                		<label for="CantHermanos">Numero de Hermanos</label>
                                	    <input id="CantHermanos" type="number" name="CantHermanos" value="<?=$AtencAreaFamiliar[9]?>" class="input4" />
                                	</div>
                                	<div style="flex-direction:column">
                                		<label for="CantHijos">Numero de Hijos</label>
                                	    <input id="CantHijos" type="number" name="CantHijos" value="<?=$AtencAreaFamiliar[10]?>"class="input4"/>
                                	</div>
                                </div>
                                <div class="input-group">
                                	<label for="IntegracionFamiliar">Integracion Familiar</label>
                                	<textarea style="resize: none; padding: 1.8em 1em;font-family: 'Poppins', sans-serif;font-size: 14px;" type="text" id="IntegracionFamiliar" name="IntegracionFamiliar" required><?=$AtencAreaFamiliar[11]?></textarea>
                                </div>
                                <div class="input-group">
                                	<label for="HistorialFamiliar">Historial Familiar:</label>
                                	<textarea style="resize: none; padding: 1.8em 1em;font-family: 'Poppins', sans-serif;font-size: 14px;" type="text" id="HistorialFamiliar" name="HistorialFamiliar" required><?=$AtencAreaFamiliar[12]?></textarea>
                                </div>
                                <br>
                                <div class="xd">
                                    <button type="submit" class="buttonM">Editar</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php endif; ?>
    </div>
    </div>
  </main>
    <script src="../issets/js/Dashboard.js"></script>
</div>
</body>
<script>
// Paciente    
function openModalVerPaciente(id) {
document.getElementById('modalPaciente' + id).style.display = 'block';
}
function closeModalVerPaciente(id) {
    document.getElementById('modalPaciente' + id).style.display = 'none';
}
// Diagnostico
function openModalVerDiagnostico(id) {
    document.getElementById('modalDiagnostico' + id).style.display = 'block';
}
function closeModalVerDiagnostico(id) {
    document.getElementById('modalDiagnostico' + id).style.display = 'none';
}
// Diagnostico Dos
function openModalVerDiagnosticoDos(id) {
    document.getElementById('modalEditarDiagDos' + id).style.display = 'block';
}
function closeModalVerDiagnosticoDos(id) {
    document.getElementById('modalEditarDiagDos' + id).style.display = 'none';
}
// Historial
function openModalVerHistorial(id) {
    document.getElementById('modalHistorial' + id).style.display = 'block';
}
function closeModalVerHistorial(id) {
    document.getElementById('modalHistorial' + id).style.display = 'none';
}// Historial Familiar
function openModalVerHistorialFamiliar(id) {
    document.getElementById('modalHistorialFamiliar' + id).style.display = 'block';
}
function closeModalVerHistorialFamiliar(id) {
    document.getElementById('modalHistorialFamiliar' + id).style.display = 'none';
}
function openModalModificarHistorialFamiliar(id) {
    document.getElementById('modalModificarHistorialFamiliar' + id).style.display = 'block';
}
function closeModalModificarHistorialFamiliar(id) {
    document.getElementById('modalModificarHistorialFamiliar' + id).style.display = 'none';
}
// Editar Paciente
function openModalEditar(id) {
    document.getElementById('modalEditar' + id).style.display = 'block';
}
function closeModalEditar(id) {
    document.getElementById('modalEditar' + id).style.display = 'none';
}
// Editar Giagnostico 
function openModalEditarDiag(id) {
    document.getElementById('modalEditarDiag' + id).style.display = 'block';
}
function closeModalEditarDiag(id) {
    document.getElementById('modalEditarDiag' + id).style.display = 'none';
}
</script>
</html>
<?php
}else{
  header("Location: ../Index.php");
}
?>

