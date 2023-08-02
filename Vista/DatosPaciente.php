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
    <link
    rel="stylesheet"
    href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"
  />
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
    $departamentos = $Pac->MostrarDepartamento();
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
    
    <div style="display:flex; flex-direction:row; gap:20px">
      <h2>Datos del Paciente</h2>
      <button id="toggleViewBtn" type="button" class="button" style="cursor:pointer;">Cambiar a tabla</button>
    </div>
      <?php if($rows) :?>
    <div class="containerDatos" id="containerDatos">
        <?php foreach ($rows as $row): ?>
          <div class="insightsDatos" >
            <div class="card" data-id="<?=$row[0]?>">
                <div class="card__body">
                  <h1><a style="color: #9274b3; cursor: pointer;" class="nav-link" onclick="openModalVerPaciente('<?=$row[0]?>')"><?=$row[1]?> <?=$row[2]?></a></h1>
                    <br>
                    <p class="id" style="display:none"><b >Id: </b><?=$row[0]?></p>
                    <p class="codigo"><b>Código Paciente: </b> <?=$row[18]?></p>
                    <p class="correo"><b>Correo: </b><?=$row[12]?></p>
                    <br>
                    <a type="button" style="cursor:pointer;" class="nav-link" href="citas.php">Agregar Cita</a>
                    <br>
                    <a type="button" style="cursor:pointer;" class="nav-link" onclick="openModalVerHistorialFamiliar('<?=$row[0]?>')">Ver Datos Familiares</a>
                    <br>
                    <a type="button" style="cursor:pointer;" class="nav-link" onclick="openModalVerDiagnostico('<?=$row[0]?>')">Ver Ulitma Session</a>
                    <br>
                    <a type="button" style="cursor:pointer;" class="nav-link" onclick="openModalVerHistorial('<?=$row[0]?>')">Ver Historial</a>
                </div>
            </div>
          </div>
          <?php
            $user=$Pac->show($row[0]);
          ?>
          <!-- Ver Pacientes --> 
          <div id="modalPaciente<?=$row[0]?>" class="modal">
              <div class="containerModal">
                  <a href="#" class="close" onclick="closeModalVerPaciente('<?=$row[0]?>')">&times;</a>
                  <form>
                      <h2 class="title">Paciente <?=$user[2]?></h2>
                      <p><b>Codigo: </b><?=$user[1]?></p>
                      <p><b>Apellido Paterno: </b><?=$user[3]?></p>
                      <p><b>Apellido Materno: </b><?=$user[4]?></p>
                      <p><b>DNI: </b><?=$user[5]?></p>
                      <p><b>Fecha de Nacimiento: </b><?=$user[6]?></p>
                      <p><b>Edad: </b><?=$user[7]?></p>
                      <p><b>Grado de Instruccion: </b><?=$user[8]?></p>
                      <p><b>Ocupaciòn: </b><?=$user[9]?></p>
                      <p><b>Estado Civil: </b><?=$user[10]?></p>
                      <p><b>Genero:  </b><?=$user[11]?></p>
                      <p><b>Telefono:  </b><?=$user[12]?></p>
                      <p><b>Email:  </b><?=$user[13]?></p>
                      <p><b>Provincia:  </b><?=$user[20]?></p>
                      <p><b>Departamento:  </b><?=$user[18]?></p>
                      <p><b>Distrito:  </b><?=$user[19]?></p>
                      <p><b>Direccion:  </b><?=$user[14]?></p>
                      <p><b>Antecedentes Medicos:  </b><?=$user[15]?></p>
                      <p><b>Medicamentos Prescritos: </b><?=$user[17]?></p>
                      <div class="button-container">
                          <a type="button" href="../Crud/Paciente/eliminarPaciente.php?id=<?=$row[0]?>" id="deleteBtn" class="butonEliminar"><i class="fa fa-trash" aria-hidden="true"></i></a>
                          <a type="button" id="editBtn" onclick="openModalEditar('<?=$row[0]?>')" class="butonEditar"><i class="fa fa-pencil" aria-hidden="true"></i></a>
                      </div>
                  </form>
              </div>
          </div>

          <!-- Editar Paciente -->
          <div id="modalEditar<?=$row[0]?>" class="modal">
             <div class="containerModalEditar">
                 <a href="#" class="close" onclick="closeModalEditar('<?=$row[0]?>')">&times;</a>
                 <form action="../Crud/Paciente/modificarPaciente.php" autocomplete="off" method="post">
                     <h2 style="text-align:center">Modificar datos de <?=$user[2]?>  </h2>
                     <div class="checkout-information">
                         <input style="display:none" type="text" value="<?=$user[0]?>">
                         <div class="input-group">
                             <h3 style="display:none" for="IdPaciente">IdPaciente</h3>
                             <input style="display:none" type="text" Id="IdPaciente" name="IdPaciente" class="input"value="<?=$user[0]?>" />
                         </div>
                         <div class="input-group2">
                             <div class="input-group">
                                 <h3 for="NomPaciente">Nombre</h3>
                                 <input type="text" id="NomPaciente" name="NomPaciente" class="input" value="<?=$user[2]?>" />
                             </div>
                             <div class="input-group">
                                 <h3 for="Dni">DNI</h3>
                                 <input type="text"id="Dni" name="Dni" value="<?=$user[5]?>" required>
                             </div>
                         </div>
                         <div class="input-group2">
                             <div class="input-group">
                                 <h3 for="ApPaterno">Apellido Materno</h3>
                                 <input class="input" type="text" id="ApPaterno" name="ApPaterno" value="<?=$user[3]?>" required>
                             </div>
                             <div class="input-group">
                                 <h3 for="ApMaterno">Apellido Paterno</h3>
                                 <input class="input" type="text" id="ApMaterno" name="ApMaterno" value="<?=$user[4]?>" required>
                             </div>
                         </div>
                         <div class="input-group2">
                             <div class="input-group">
                                 <h3 for="FechaNacimiento">Fecha de Naciemiento</h3>
                                 <input type="date" id="FechaNacimiento" name="FechaNacimiento" value="<?=$user[6]?>" required>
                             </div>
                             <div style="width:55px" class="input-group">
                                 <h3 for="Edad">Edad</h3>
                                 <input type="text" id="Edad" name="Edad" value="<?=$user[7]?>" required>
                             </div>
                         </div>
                         <div class="input-group2">
                             <div class="input-group">
                                 <h3 for="GradoInstruccion">Grado de Instruccion</h3>
                                 <input class="input" id="GradoInstruccion"type="text" name="GradoInstruccion" value="<?=$user[8]?>" required>
                             </div>
                             <div class="input-group">
                                 <h3 for="Ocupacion">Ocupacion</h3>
                                 <input class="input" type="text" id="Ocupacion" name="Ocupacion" value="<?=$user[9]?>" required>
                             </div>
                         </div>
                         <div class="input-group2">
  	                       <div style="width:190px"class="input-group">
  		                       <h3 for="EstadoCivil">Estado civil</h3>
  		                         <select style="text-align:center" class="input" id="EstadoCivil" name="EstadoCivil" required>
                                     <option value="soltero" <?php if ($user[9] === "soltero") echo "selected"; ?>>Soltero/a</option>
                                     <option value="casado" <?php if ($user[9] === "casado") echo "selected"; ?>>Casado/a</option>
                                     <option value="divorciado" <?php if ($user[9] === "divorciado") echo "selected"; ?>>Divorciado/a</option>
                                     <option value="viudo" <?php if ($user[9] === "viudo") echo "selected"; ?>>Viudo/a</option>
                                 </select>
  	                       </div>
                           <div style=" width:190px;"class="input-group">
  		                       <h3 for="Genero">Género</h3>
  		                       <select style="text-align:center" class="input" id="Genero" name="Genero" required>
                                 <option value="Masculino" <?php if ($user[10] === "Masculino") echo "selected"; ?>>Masculino</option>
                                 <option value="Femenino" <?php if ($user[10] === "Femenino") echo "selected"; ?>>Femenino</option>
                                 <option value="Otro" <?php if ($user[10] === "Otro") echo "selected"; ?>>Otro</option>
                             </select>
  	                       </div>
                         </div>
                         <div class="input-group">
                             <h3 for="Telefono">Telefono</h3>
                             <input type="text" id="Telefono" name="Telefono" value="<?=$user[12]?>" required>
                         </div>
                         <div class="input-group">
                             <h3 for="Email">Email</h3>
                             <input class="input" id="Email" type="text" name="Email" value="<?=$user[13]?>" required>
                         </div>
                         <div  class="input-group2">
                           <div style="width: 190px" class="input-group">
                             <h3 for="Departamento">Departamento</h3>
                             <select style="text-align: center" class="input"  id="Departamento" name="Departamento" required>
                                 <?php foreach ($departamentos as $departamento) : ?>
                                     <option value="<?php echo $departamento['id']; ?>" data-id="<?php echo $departamento['id']; ?>" 
                                     <?php if ($departamento['name'] === $user[18]) echo 'selected'; ?>><?php echo $departamento['name']; ?></option>
                                 <?php endforeach; ?>
                             </select>
                           </div>
                           <div style="width: 190px" class="input-group">
                               <h3 for="Provincia">Provincia</h3>
                               <select style="text-align: center" class="input" id="Provincia" name="Provincia" required>
                                   <option value=""><?=$user[20]?></option>
                               </select>
                           </div>
                         </div>
                         <div  class="input-group2">
  	                         <div style="width:190px" class="input-group">
  		                       <h3 for="Distrito">Distrito</h3>
  		                         <select style="text-align:center" class="input" value="<?=$user[19]?>" id="Distrito" name="Distrito" required>
                                     <option value=""><?=$user[19]?></option>
                                 </select>
  	                         </div>
                             <div class="input-group">
  		                       <h3 for="Direccion">Dirección</h3>
  		                       <input type="text" id="Direccion" name="Direccion" class="input" value="<?=$user[14]?>" required/>
  	                         </div>
                         </div>
                         <div class="input-group">
                             <h3 for="AntecedentesMedicos">Antecedentes Medicos</h3>
                             <input type="text" id="AntecedentesMedicos" name="AntecedentesMedicos" value="<?=$user[15]?>" required>
                         </div>
                         <div class="input-group">
                             <h3 for="MedicamentosPrescritos">Medicamentos Prescritos</h3>
                             <input type="text" id="MedicamentosPrescritos" name="MedicamentosPrescritos" value="<?=$user[17]?>" required>
                         </div>
                         <br>
                         <div class="button-container">
                             <button type="submit" class="buttonEditar">Modificar</button>
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
                  <form>
                      <?php 
                      if ($AtencsUser !== null) { ?>
                          <h2 class="title">Paciente <?=$AtencsUser[4]?></h2>
                          <p><b>Clasificacion: </b><?=$AtencsUser[5]?></p>
                          <p><b>Motivo Consulta: </b><?=$AtencsUser[6]?></p>
                          <p><b>Forma Contacto: </b><?=$AtencsUser[3]?></p>
                          <p><b>Diagnóstico: </b><?=$AtencsUser[7]?></p>
                          <p><b>Tratamiento: </b><?=$AtencsUser[8]?></p>
                          <p><b>Observacion: </b><?=$AtencsUser[9]?></p>
                          <p><b>Ultimos Objetivos: </b><?=$AtencsUser[10]?></p>
                          <div class="button-container">
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
              <div class="containerModalEditar" >
                  <a href="#" class="close" onclick="closeModalEditarDiag('<?=$row[0]?>')">&times;</a>
                  <form action="../Crud/Paciente/modificarAtencPaciente.php" class="form" autocomplete="off"
                      method="post">
                      <h2 class="title">Modificar datos de <?=$AtencsUser[4]?></h2>
                      <div class="checkout-information">
                          <input style="display:none" type="text" value="<?=$AtencsUser[0]?>">
                          <div class="input-group">
                              <h3 style="display:none" for="IdAtencion">IdAtencion</h3>
                              <input style="display:none" type="text" Idn="IdAtencion" name="IdAtencion" class="input"value="<?=$AtencsUser[0]?>" />
                          </div>
                          <div class="input-group">
                              <h3 for="MotivoConsulta">Motivo Consulta</h3>
                              <input class="input" type="text" id="MotivoConsulta" name="MotivoConsulta" value="<?=$AtencsUser[5]?>" required>
                          </div>
                          <div class="input-group">
                              <h3 for="FormaContacto">Forma Contacto</h3>
                              <input class="input" type="text" id="FormaContacto" name="FormaContacto" value="<?=$AtencsUser[6]?>" required>
                          </div>
                          <div class="input-group">
                              <h3 for="Diagnostico">Diagnostico</h3>
                              <input class="input" type="text" id="Diagnostico" name="Diagnostico" value="<?=$AtencsUser[7]?>" required>
                          </div>
                          <div class="input-group">
                              <h3 for="Tratamiento">Tratamiento</h3>
                              <input class="input" type="text" id="Tratamiento" name="Tratamiento" value="<?=$AtencsUser[8]?>" required>
                          </div>
                          <div class="input-group">
                              <h3 for="Observacion">Obervacion</h3>
                              <input class="input" type="text" id="Observacion" name="Observacion" value="<?=$AtencsUser[9]?>" required>
                          </div>
                          <div class="input-group">
                              <h3 for="UltimosObjetivos">Ultimos Objetivos</h3>
                              <input class="input" type="text" id="UltimosObjetivos" name="UltimosObjetivos" value="<?=$AtencsUser[10]?>" required>
                          </div>
                          <br>
                          <div class="button-container">
                              <button type="submit" class="buttonEditar">Modificar</button>
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
                  <form>
                      <?php 
                      if ($AtencAreaFamiliar !== null) { ?>
                          <h2 class="title">Paciente <?=$AtencAreaFamiliar[2]?></h2>
                          <p style="display:none">Id: <lael><?=$AtencAreaFamiliar[0]?></h3></p>
                          <p><b>Nombre de Padre: </b><?=$AtencAreaFamiliar[3]?></p>
                          <p><b>Estado de Padre: </b><?=$AtencAreaFamiliar[4]?></p>
                          <p><b>Nombre de Madre: </b><?=$AtencAreaFamiliar[5]?></p>
                          <p><b>Estado de Madre: </b><?=$AtencAreaFamiliar[6]?></p>
                          <p><b>Nombre de Apoderado: </b><?=$AtencAreaFamiliar[7]?></p>
                          <p><b>Estado de Apoderado: </b><?=$AtencAreaFamiliar[8]?></p>
                          <p><b>Numero de Hermanos: </b><?=$AtencAreaFamiliar[9]?></p>
                          <p><b>Numero de Hijos: </b><?=$AtencAreaFamiliar[10]?></p>
                          <p><b>Integracion Familiar: </b><?=$AtencAreaFamiliar[11]?></p>
                          <p><b>Historial Familiar: </b><?=$AtencAreaFamiliar[12]?></p>
                          <div class="button-container">
                              <a type="button" href="../Crud/Paciente/eliminarAreaFamiliar.php?id=<?=$AtencAreaFamiliar[0]?>" id="deleteBtn" class="butonEliminar"><i class="fa fa-trash" aria-hidden="true"></i></a>
                              <a type="button" onclick="openModalModificarHistorialFamiliar('<?=$AtencAreaFamiliar[0]?>')"id="editBtn" class="butonEditar"><i class="fa fa-pencil" aria-hidden="true"></i></a>
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
              <div class="containerModalEditar" >
                  <a href="#" class="close" onclick="closeModalModificarHistorialFamiliar('<?=$AtencAreaFamiliar[0]?>')">&times;</a>
                  <form action="../Crud/Paciente/modificarAreaFamiliar.php" class="form" autocomplete="off"
                      method="post">
                      <h2 class="title">Modificar datos de <?=$AtencAreaFamiliar[2]?></h2>
                      <div class="checkout-information">
                          <input style="display:none" type="text" value="<?=$AtencAreaFamiliar[0]?>">
                          <div class="input-group">
                              <h3 style="display:none" for="IdFamiliar">IdFamiliar</h3>
                              <input style="display:none" type="text" id="IdFamiliar" name="IdFamiliar" class="input"value="<?=$AtencAreaFamiliar[0]?>" />
                          </div>
                          <div class="input-group">
                          	<h3 for="NomMadre" >Nombre de la Madre</h3>
                          	<input id="NomMadre" type="text" name="NomMadre" class="input" value="<?=$AtencAreaFamiliar[3]?>" required/>
                          </div>
                          <div class="input-group">
                          	<h3 for="EstadoMadre" >Estado de la Madre</h3>
                          	<input type="text" id="EstadoMadre" name="EstadoMadre" value="<?=$AtencAreaFamiliar[4]?>" required/>
                          </div>
                          <div class="input-group">
                          	<h3 for="NomPadre" >Nombre del Padre</h3>
                          	<input id="NomPadre" type="text" name="NomPadre" class="input" value="<?=$AtencAreaFamiliar[5]?>" required/>
                          </div>
                          <div class="input-group">
                          	<h3 for="EstadoPadre" >Estado del Padre</h3>
                          	<input type="text" id="EstadoPadre" name="EstadoPadre" value="<?=$AtencAreaFamiliar[6]?>" required/>
                          </div>
                          <div class="input-group">
                          	<h3 for="NomApoderado" >Nombre del Apoderado</h3>
                          	<input id="NomApoderado" type="text" name="NomApoderado" class="input" value="<?=$AtencAreaFamiliar[7]?>" required/>
                          </div>
                          <div class="input-group">
                          	<h3 for="EstadoApoderado" >Estado del Apoderado</h3>
                          	<input type="text" id="EstadoApoderado" name="EstadoApoderado" value="<?=$AtencAreaFamiliar[8]?>" required/>
                          </div>
                          <div class="input-group2">
                          	<div class="input-group">
                          		<h3 for="CantHermanos">Numero de Hermanos</h3>
                          	    <input id="CantHermanos" type="number" name="CantHermanos" value="<?=$AtencAreaFamiliar[9]?>" min="0" pattern="^[0-9]+" required />
                          	</div>
                          	<div class="input-group">
                          		<h3 for="CantHijos">Numero de Hijos</h3>
                          	    <input id="CantHijos" type="number" name="CantHijos" value="<?=$AtencAreaFamiliar[10]?>" min="0" pattern="^[0-9]+" required/>
                          	</div>
                          </div>
                          <div class="input-group">
                          	<h3 for="IntegracionFamiliar">Integracion Familiar</h3>
                          	<textarea style="resize: none; padding: 1.8em 1em;font-family: 'Poppins', sans-serif;font-size: 14px;" type="text" id="IntegracionFamiliar" name="IntegracionFamiliar" required><?=$AtencAreaFamiliar[11]?></textarea>
                          </div>
                          <div class="input-group">
                          	<h3 for="HistorialFamiliar">Historial Familiar:</h3>
                          	<textarea style="resize: none; padding: 1.8em 1em;font-family: 'Poppins', sans-serif;font-size: 14px;" type="text" id="HistorialFamiliar" name="HistorialFamiliar" required><?=$AtencAreaFamiliar[12]?></textarea>
                          </div>
                          <br>
                          <div class="button-container">
                              <button type="submit" class="buttonEditar">Modificar</button>
                          </div>
                      </div>
                  </form>
              </div>
          </div>
        <?php endforeach; ?>
          <div class="insightsDatos" >
            <div class="card">
                <div class="card__body">
                    <h1>Agregar nuevo Paciente</h1>
                    <br>
                    <a type="button" href="RegPaciente.php" style="cursor:pointer;" class="nav-link">Agregar</a>
                </div>
            </div>
          </div>
        <?php else : ?>  
                <p class="centered-text">No hay Pacientes<a href="RegPaciente.php"> Agregar nuevo paciente </a></p>

      <?php endif ; ?>
    </div>

    <!-- Agrega una nueva sección para la vista de tabla -->
    <div class="tableData" style="display: none;">
        <table>
            <thead>
                <tr>
                    <th>Nombres</th>
                    <th>Codigo</th>
                    <th>DNI</th>
                </tr>
            </thead>
            <tbody>
              <?php if($rows) :?>
                <?php foreach ($rows as $row): ?>
                  <tr>
                      <td>
                        <a style="color: black; cursor: pointer;" class="nav-link" onclick="openModalVerPaciente('<?=$row[0]?>')"><?=$row[1]?> <?=$row[2]?></a>
                      </td>
                      <td><?=$row[18]?></td>
                      <td><?=$row[4]?></td>
                      <td>
                      <a type="button" style="cursor:pointer;" class="nav-link" href="citas.php">Agregar Cita</a>
                      </td>
                      <td>
                          <a type="button" style="cursor:pointer;" class="nav-link" onclick="openModalVerHistorialFamiliar('<?=$row[0]?>')">Ver Datos Familiares</a>
                      </td>
                      <td>
                          <a type="button" style="cursor:pointer;" class="nav-link" onclick="openModalVerDiagnostico('<?=$row[0]?>')">Ver Ulitma Session</a>
                      </td>
                  </tr>
                
                <?php endforeach; ?>
              <?php endif ; ?>
            </tbody>
        </table>
    </div>
  </main>
    <script src="../issets/js/Dashboard.js"></script>
</div>
</body>
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
function toggleModal(id, show) {
  var modalElement = document.getElementById(id);

  if (show) {
    modalElement.style.display = 'block';
    modalElement.style.opacity = '0';
    modalElement.style.transform = 'translateY(-50px)';
    modalElement.style.transition = 'transform 0.5s ease, opacity 0.5s ease';

    setTimeout(function() {
      modalElement.style.opacity = '1';
      modalElement.style.transform = 'translateY(0)';
    }, 10);
  } else {
    modalElement.style.transform = 'translateY(-50px)';
    modalElement.style.opacity = '0';

    setTimeout(function() {
      modalElement.style.display = 'none';
      modalElement.style.transform = 'translateY(0)';
    }, 500);
  }
}

// Uso de la función para los diferentes modales

// Paciente
function openModalVerPaciente(id) {
  toggleModal('modalPaciente' + id, true);
}

function closeModalVerPaciente(id) {
  toggleModal('modalPaciente' + id, false);
}

// Diagnostico
function openModalVerDiagnostico(id) {
  toggleModal('modalDiagnostico' + id, true);
}

function closeModalVerDiagnostico(id) {
  toggleModal('modalDiagnostico' + id, false);
}

// Diagnostico Dos
function openModalVerDiagnosticoDos(id) {
  toggleModal('modalEditarDiagDos' + id, true);
}

function closeModalVerDiagnosticoDos(id) {
  toggleModal('modalEditarDiagDos' + id, false);
}

// Historial
function openModalVerHistorial(id) {
  toggleModal('modalHistorial' + id, true);
}

function closeModalVerHistorial(id) {
  toggleModal('modalHistorial' + id, false);
}

// Historial Familiar
function openModalVerHistorialFamiliar(id) {
  toggleModal('modalHistorialFamiliar' + id, true);
}

function closeModalVerHistorialFamiliar(id) {
  toggleModal('modalHistorialFamiliar' + id, false);
}

// Modificar Historial Familiar
function openModalModificarHistorialFamiliar(id) {
  toggleModal('modalModificarHistorialFamiliar' + id, true);
}

function closeModalModificarHistorialFamiliar(id) {
  toggleModal('modalModificarHistorialFamiliar' + id, false);
}

// Editar Paciente
function openModalEditar(id) {
  toggleModal('modalEditar' + id, true);
}

function closeModalEditar(id) {
  toggleModal('modalEditar' + id, false);
}

// Editar Diagnostico
function openModalEditarDiag(id) {
  toggleModal('modalEditarDiag' + id, true);
}

function closeModalEditarDiag(id) {
  toggleModal('modalEditarDiag' + id, false);
}



  // Obtener referencias al botón y los contenedores
  const toggleViewBtn = document.getElementById('toggleViewBtn');
  const containerDatos = document.getElementById('containerDatos');
  const cards = document.querySelectorAll('.insightsDatos');
  const tableData = document.querySelector('.tableData');

  // Función para alternar entre vista de cartas y tabla
  function toggleView() {
    if (cards[0].style.display === 'none') {
      // Si las cartas están ocultas, mostrarlas y ocultar la tabla
      cards.forEach(card => card.style.display = 'block');
      tableData.style.display = 'none';
      toggleViewBtn.innerText = 'Cambiar a tabla';
    } else {
      // Si las cartas están visibles, ocultarlas y mostrar la tabla
      cards.forEach(card => card.style.display = 'none');
      tableData.style.display = 'block';
      toggleViewBtn.innerText = 'Cambiar a cartas';
    }
  }

  // Asignar evento de clic al botón
  toggleViewBtn.addEventListener('click', toggleView);
</script>
</html>
<?php
}else{
  header("Location: ../Index.php");
}
?>