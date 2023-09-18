<?php
session_start();
if (isset($_SESSION['NombrePsicologo'])) {
?>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Sharp:opsz,wght,FILL,GRAD@48,400,1,0" />
        <link rel="stylesheet" href="../issets/css/MainGeneral.css">
        <link rel="icon" href="../Issets/images/contigovoyico.ico">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <title>Paciente</title>
    </head>

    <body>
        <?php
        require("../Controlador/Paciente/ControllerPaciente.php");
        require("../Controlador/Cita/citaControlador.php");
        $obj = new usernameControlerPaciente();
        $objcita = new usernameControlerCita();
        $rowscita = $objcita->contarRegistrosEnPacientes($_SESSION['IdPsicologo']);
        $rows = $obj->ver($_SESSION['IdPsicologo']);
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
                <h2 style="color: #49c691;">Lista de Pacientes</h2>
                <div class="recent-updates" style="display:flex; flex-direction: row; gap:20px; align-items: center; padding: 10px 0px 0px 10px">
                    <span style="font-size: 15px;color: #6a90f1;"><b style="font-size: 25px;color: #6a90f1;"><?= $rowscita ?></b> pacientes </span>
                    <div class="input-group">
                        <input type="text" style="background-color: White;" placeholder="Buscar" class="input" required></input>
                    </div>
                    <a class="button" style="padding:10px 30px; font-size:10px;" href="RegPaciente.php"><span class="material-symbols-sharp">add</span>Agregar Paciente</a>
                </div>
                <div class="recent-citas">
                    <table>
                        <thead>
                            <tr>

                                <th>
                                    <span class="material-symbols-sharp">check_box_outline_blank</span>
                                </th>
                                <th>Paciente</th>
                                <th>Codigo</th>
                                <th>DNI</th>
                                <th>Email</th>
                                <th>Celular</th>
                                <th>Nueva Cita</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if ($rows) : ?>
                                <?php foreach ($rows as $row) : ?>
                                    <tr>
                                        <td>
                                            <span class="material-symbols-sharp">check_box_outline_blank</span>
                                        </td>
                                        <td><?= $row[1] ?> <?= $row[2] ?></td>
                                        <td><?= $row[18] ?></td>
                                        <td><?= $row[4] ?></td>
                                        <td><?= $row[12] ?></td>
                                        <td><?= $row[11] ?></td>
                                        <td>
                                            <a class="button" style="width: 110px; padding:6px; display:flex; font-size:10px;" href="citas.php">
                                                <span class="material-symbols-sharp">add</span>Crear Cita
                                            </a>
                                        </td>
                                        <td>
                                            <div class="dropdown">
                                                <button class="dropbtn"><span class="material-symbols-sharp">more_vert</span></button>
                                                <div class="dropdown-content">
                                                    <a type="button" class="btne" onclick="openModalEliminar('<?= $row[0] ?>')">
                                                        <p style="color: #6a90f1;"><img src="../Issets/images/eliminar.png" style="float:left; width: 20px; height: 20px; ">Eliminar</p>
                                                    </a>
                                                    <a type="button" class="btnm" onclick="openModal('<?= $row[0] ?>')">
                                                        <p style="color: #6a90f1;"><img src="../Issets/images/editar.png" style="float:left; width: 20px; height: 20px; ">Editar</p>
                                                    </a>
                                                </div>
                                        </td>
                                    </tr>
                                    <?php
                                    $user = $obj->show($row[0]);
                                    ?>
                                    <div id="modalEliminar<?= $row[0] ?>" class="modal">
                                        <div class="containerModalEliminar">
                                            <a href="#" class="close" onclick="closeModalEliminar('<?= $row[0] ?>')">&times;</a>
                                            <form class="form" style="margin-top: -10px;" autocomplete="off" method="post">
                                                <h2 class="title2" value="<?= $user[0] ?>">Eliminar Paciente</h2>
                                                <br>
                                                <label class="Alertas" for="" value="<?= $user[0] ?>">¿Estas seguro de eliminar este Paciente?</label>

                                                <div class="input-group">
                                                    <div>
                                                        <br>
                                                        <a class="ButtonEliminar" style="float:center;" href="../Crud/Paciente/eliminarPaciente.php?id=<?= $row[0] ?>">Eliminar</a>
                                                    </div>
                                                </div>
                                                <br>
                                            </form>
                                        </div>
                                    </div>
                                    <!-- Modal para modificacion -->
                                    <div id="modal<?= $row[0] ?>" class="modal">
                                        <div class="containerModal">
                                            <a href="#" class="close" style="margin-right:20px" onclick="closeModal('<?= $row[0] ?>')">&times;</a>
                                            <form action="../Crud/Paciente/modificarPaciente.php" autocomplete="off" method="post">
                                                <h2 style="text-align:center">Modificar datos de <?= $user[2] ?> </h2>
                                                <div class="checkout-information">
                                                    <input style="display:none" type="text" value="<?= $user[0] ?>">
                                                    <div class="input-group">
                                                        <h3 style="display:none" for="IdPaciente">IdPaciente</h3>
                                                        <input style="display:none" type="text" Id="IdPaciente" name="IdPaciente" class="input" value="<?= $user[0] ?>" />
                                                    </div>
                                                    <div class="input-group2">
                                                        <div class="input-group">
                                                            <h3 for="NomPaciente">Nombre</h3>
                                                            <input type="text" id="NomPaciente" name="NomPaciente" class="input" value="<?= $user[2] ?>" />
                                                        </div>
                                                        <div class="input-group">
                                                            <h3 for="Dni">DNI</h3>
                                                            <input type="text" id="Dni" name="Dni" value="<?= $user[5] ?>" required>
                                                        </div>
                                                    </div>
                                                    <div class="input-group2">
                                                        <div class="input-group">
                                                            <h3 for="ApPaterno">Apellido Materno</h3>
                                                            <input class="input" type="text" id="ApPaterno" name="ApPaterno" value="<?= $user[3] ?>" required>
                                                        </div>
                                                        <div class="input-group">
                                                            <h3 for="ApMaterno">Apellido Paterno</h3>
                                                            <input class="input" type="text" id="ApMaterno" name="ApMaterno" value="<?= $user[4] ?>" required>
                                                        </div>
                                                    </div>
                                                    <div class="input-group2">
                                                        <div class="input-group">
                                                            <h3 for="FechaNacimiento">Fecha de Naciemiento</h3>
                                                            <input type="date" id="FechaNacimiento" name="FechaNacimiento" value="<?= $user[6] ?>" required>
                                                        </div>
                                                        <div style="width:55px" class="input-group">
                                                            <h3 for="Edad">Edad</h3>
                                                            <input type="text" id="Edad" name="Edad" value="<?= $user[7] ?>" required>
                                                        </div>
                                                    </div>
                                                    <div class="input-group2">
                                                        <div class="input-group">
                                                            <h3 for="GradoInstruccion">Grado de Instruccion</h3>
                                                            <input class="input" id="GradoInstruccion" type="text" name="GradoInstruccion" value="<?= $user[8] ?>" required>
                                                        </div>
                                                        <div class="input-group">
                                                            <h3 for="Ocupacion">Ocupacion</h3>
                                                            <input class="input" type="text" id="Ocupacion" name="Ocupacion" value="<?= $user[9] ?>" required>
                                                        </div>
                                                    </div>
                                                    <div class="input-group2">
                                                        <div style="width:190px" class="input-group">
                                                            <h3 for="EstadoCivil">Estado civil</h3>
                                                            <select style="text-align:center" class="input" id="EstadoCivil" name="EstadoCivil" required>
                                                                <option value="soltero" <?php if ($user[9] === "soltero") echo "selected"; ?>>Soltero/a</option>
                                                                <option value="casado" <?php if ($user[9] === "casado") echo "selected"; ?>>Casado/a</option>
                                                                <option value="divorciado" <?php if ($user[9] === "divorciado") echo "selected"; ?>>Divorciado/a</option>
                                                                <option value="viudo" <?php if ($user[9] === "viudo") echo "selected"; ?>>Viudo/a</option>
                                                            </select>
                                                        </div>
                                                        <div style=" width:190px;" class="input-group">
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
                                                        <input type="text" id="Telefono" name="Telefono" value="<?= $user[12] ?>" required>
                                                    </div>
                                                    <div class="input-group">
                                                        <h3 for="Email">Email</h3>
                                                        <input class="input" id="Email" type="text" name="Email" value="<?= $user[13] ?>" required>
                                                    </div>
                                                    <div class="input-group2">
                                                        <div style="width: 190px" class="input-group">
                                                            <h3 for="Departamento">Departamento</h3>
                                                            <select style="text-align: center" class="input" id="Departamento" name="Departamento" required>
                                                                <?php foreach ($departamentos as $departamento) : ?>
                                                                    <option value="<?php echo $departamento['id']; ?>" data-id="<?php echo $departamento['id']; ?>" <?php if ($departamento['name'] === $user[19]) echo 'selected'; ?>><?php echo $departamento['name']; ?></option>
                                                                <?php endforeach; ?>
                                                            </select>
                                                        </div>
                                                        <div style="width: 190px" class="input-group">
                                                            <h3 for="Provincia">Provincia</h3>
                                                            <select style="text-align: center" class="input" id="Provincia" name="Provincia" required>
                                                                <option value=""><?= $user[20] ?></option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="input-group2">
                                                        <div style="width:190px" class="input-group">
                                                            <h3 for="Distrito">Distrito</h3>
                                                            <select style="text-align:center" class="input" value="<?= $user[19] ?>" id="Distrito" name="Distrito" required>
                                                                <option value=""><?= $user[19] ?></option>
                                                            </select>
                                                        </div>
                                                        <div class="input-group">
                                                            <h3 for="Direccion">Dirección</h3>
                                                            <input type="text" id="Direccion" name="Direccion" class="input" value="<?= $user[14] ?>" required />
                                                        </div>
                                                    </div>
                                                    <div class="input-group">
                                                        <h3 for="AntecedentesMedicos">Antecedentes Medicos</h3>
                                                        <input type="text" id="AntecedentesMedicos" name="AntecedentesMedicos" value="<?= $user[15] ?>" required>
                                                    </div>
                                                    <div class="input-group">
                                                        <h3 for="MedicamentosPrescritos">Medicamentos Prescritos</h3>
                                                        <input type="text" id="MedicamentosPrescritos" name="MedicamentosPrescritos" value="<?= $user[17] ?>" required>
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
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </main>
            <script src="../Issets/js/Dashboard.js"></script>
            <script>
                function openModal(id) {
                    document.getElementById('modal' + id).style.display = 'block';
                }

                function closeModal(id) {
                    document.getElementById('modal' + id).style.display = 'none';
                }

                function openModalEliminar(id) {
                    document.getElementById('modalEliminar' + id).style.display = 'block';
                }

                function closeModalEliminar(id) {
                    document.getElementById('modalEliminar' + id).style.display = 'none';
                }
            </script>
    </body>

    </html>
<?php
} else {
    header("Location: ../Index.php");
}
?>