<?php
$error = isset($_GET['error']) ? $_GET['error'] : '';
if (!empty($error)) {
    echo "Error al Enviar: " . urldecode($error);
}
session_start();
if (isset($_SESSION['NombrePsicologo'])) {
    ?>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet"
            href="https://fonts.googleapis.com/css2?family=Material+Symbols+Sharp:opsz,wght,FILL,GRAD@48,400,1,0" />
        <link rel="stylesheet" href="../issets/css/formulario.css">
        <link rel="icon" href="../Issets/images/contigovoyico.ico">
        <link rel="stylesheet" href="../issets/css/Dashboard.css" />
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <title>Citas</title>
    </head>

    <body>
        <style>
            form {
                max-width: 490px;
            }
        </style>
        <?php
        require("../Controlador/Cita/citaControlador.php");
        $obj = new usernameControlerCita();
        $rows = $obj->ver($_SESSION['IdPsicologo']);
        ?>
        <div class="containerTotal">
            <?php
            require_once 'Menu.php';
            ?>
            <!----------- fin de aside -------->
            <main>
                <?php
                require_once 'Info.php';
                ?>
                <div class="container-form">
                    <div class="recent-updates">
                        <h2 class="title">Formulario de Citas</h2>
                        <form action="../Crud/Cita/guardarCita.php" method="post">
                            <div class="checkout-information">
                                <div class="input-group2">
                                    <div class="input-group">
                                        <h3 for="IdPaciente">Id Paciente <b style="color:red">*</b></h3>
                                        <div style="display: flex;gap:5px;">
                                            <input id="IdPaciente" style="width: 40%;" type="text" name="IdPaciente"
                                                required />
                                            <a class="search id"><span style="font-size:4em"
                                                    class="material-symbols-sharp">search</span></a>
                                        </div>
                                    </div>
                                    <div class="input-group">
                                        <h3 for="NomPaciente">Nombre Paciente <b style="color:red">*</b></h3>
                                        <div style="display: flex; gap:4px;">
                                            <input id="NomPaciente" type="text" name="NomPaciente" required />
                                            <a class="search nom"><span style="font-size:4em"
                                                    class="material-symbols-sharp">search</span></a>
                                        </div>
                                    </div>
                                </div>
                                <div class="input-group">
                                    <h3 for="Paciente">Paciente <b style="color:red">*</b></h3>
                                    <input id="Paciente" type="text" name="Paciente" readonly />
                                </div>
                                <div class="input-group">
                                    <h3 for="correo">correo<b style="color:red">*</b></h3>
                                    <input id="correo" type="text" name="correo" readonly />
                                </div>
                                <div class="input-group">
                                    <h3 for="telefono">telefono<b style="color:red">*</b></h3>
                                    <input id="telefono" type="text" name="telefono" readonly />
                                </div>
                                <div class="input-group">
                                    <h3 for="MotivoCita">Motivo de la Consutla <b style="color:red">*</b></h3>
                                    <textarea
                                        style="resize: none; padding: 1.2em 1em 2.8em 1em;font-family: 'Poppins', sans-serif;	font-size: 14px;"
                                        type="text" id="MotivoCita" name="MotivoCita" required></textarea>
                                </div>
                                <div class="input-group2" style="gap:60px">
                                    <div class="input-group">
                                        <h3 for="EstadoCita">Estado de la Cita <b style="color:red">*</b></h3>
                                        <select class="input" id="EstadoCita" name="EstadoCita" required>
                                            <option value="">Seleccione un Estado </option>
                                            <option value="Se requiere confirmacion">Se requiere confirmacion</option>
                                            <option value="Confirmado">Confirmado</option>
                                            <option value="Ausencia del paciente">Ausencia del paciente</option>
                                        </select>
                                    </div>
                                    <div class="input-group">
                                        <h3 for="ColorFondo">Color de Cita <b style="color:red">*</b></h3>
                                        <input type="color" value="#f38238" id="ColorFondo" name="ColorFondo"
                                            list="colorOptions" style="height: 46px;">
                                        <datalist id="colorOptions">
                                            <option value="#b4d77b">Rojo</option>
                                            <option value="#9274b3">Verde</option>
                                            <option value="#f38238">Azul</option>
                                        </datalist>
                                    </div>
                                </div>
                                <?php
                                /* FECHA LIMITE  */
                                $fechamin = date("Y-m-d");
                                    ?>
                                <div class="input-group2" style="gap:70px">
                                    <div class="input-group">
                                        <h3 for="FechaInicioCita">Fecha de Cita<b style="color:red">*</b></h3>
                                        <input type="date" id="FechaInicioCita" name="FechaInicioCita" min="<?= $fechamin ?>"
                                            required>
                                    </div>
                                    <div class="input-group">
                                        <h3 for="HoraInicio">Hora de Cita <b style="color:red">*</b></h3>
                                        <input type="time" id="HoraInicio" name="HoraInicio" />
                                    </div>
                                </div>
                                <div class="input-group2" style="gap:100px">
                                    <div class="input-group">
                                        <h3 for="TipoCita">Tipo de Cita <b style="color:red">*</b></h3>
                                        <select class="input" id="TipoCita" name="TipoCita" required>
                                            <option value="">Seleccione un Tipo </option>
                                            <option value="Primera Visita">Primera Visita</option>
                                            <option value="Visita de control">Visita de control</option>
                                        </select>
                                    </div>
                                    <div class="input-group">
                                        <h3 for="DuracionCita">Duracion <b style="color:red">*</b></h3>
                                        <select class="input" id="DuracionCita" name="DuracionCita" required>
                                            <option value="5'">5'</option>
                                            <option value="10'">10'</option>
                                            <option value="15'">15'</option>
                                            <option value="20'">20'</option>
                                            <option value="30'">30'</option>
                                            <option value="40'">40'</option>
                                            <option value="45'">45'</option>
                                            <option value="50'">50'</option>
                                            <option value="60'">60'</option>
                                            <option value="90'">90'</option>
                                            <option value="120'">120'</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="input-group2" style="gap:10px">
                                    <div class="input-group">
                                        <h3 for="CanalCita">Canal de Atraccion <b style="color:red">*</b></h3>
                                        <select class="input" id="CanalCita" name="CanalCita" required>
                                            <option value="">Seleccione una Atraccion</option>
                                            <option value="Cita Online">Cita Online</option>
                                            <option value="Marketing Directo">Marketing Directo</option>
                                            <option value="Referidos">Referidos</option>
                                        </select>
                                    </div>
                                    <div class="input-group">
                                        <h3 for="EtiquetaCita">Etiqueta <b style="color:red">*</b></h3>
                                        <select class="input" id="EtiquetaCita" name="EtiquetaCita" required>
                                            <option value="">Seleccione una Etiqueta</option>
                                            <option value="Consulta">Consulta</option>
                                            <option value="Familia Referida">Familia Referida</option>
                                            <option value="Prioridad">Prioridad</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="input-group" style="display: none">
                                    <h3 for="IdPsicologo">IdPsicologo </h3>
                                    <input type="text" id="IdPsicologo" name="IdPsicologo"
                                        value="<?= $_SESSION['IdPsicologo'] ?>"
                                        placeholder="Ingrese algun Antecedente Medico" />
                                </div>
                                <br>
                                <div class="button-container">
                                    <button id="submitButton" class="button">Registrar</button>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="recent-orders">
                        <table class="table-cita">
                            <?php
                            $rowsPerPage = 7;
                            if (is_array($rows) && count($rows) > 0) {
                                $totalRows = count($rows);
                                $totalPages = ceil($totalRows / $rowsPerPage);
                                $currentPage = isset($_GET['page']) ? $_GET['page'] : 1;
                                $startIndex = ($currentPage - 1) * $rowsPerPage;
                                $endIndex = $startIndex + $rowsPerPage;
                            }

                            ?>
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Paciente</th>
                                    <th>Motivo</th>
                                    <th>Estado</th>
                                    <th>Fecha de Inicio</th>
                                    <th>Duracion</th>
                                    <th>Tipo</th>
                                    <th>Canal</th>
                                    <th>Etiquetas</th>
                                    <th>1º Mensaje</th>
                                    <th>2º Mensaje</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if ($rows): ?>
                                    <?php foreach ($rows as $row): ?>
                                        <tr>
                                            <td>
                                                <?= $row[0] ?>
                                            </td>
                                            <td>
                                                <?= $row[1] ?>
                                            </td>
                                            <td>
                                                <?= $row[2] ?>
                                            </td>
                                            <td>
                                                <?= $row[3] ?>
                                            </td>
                                            <td>
                                                <?= $row[4] ?>
                                            </td>
                                            <td style="color:green">
                                                <?= $row[5] ?>
                                            </td>
                                            <td>
                                                <?= $row[6] ?>
                                            </td>
                                            <td>
                                                <?= $row[9] ?>
                                            </td>
                                            <td>
                                                <?= $row[10] ?>
                                            </td>
                                            <td style="color: green;">Yes</td>
                                            <td style="color: red;">No</td>
                                            <td class="acct">
                                                <a type="button" class="btne" onclick="openModalEliminar('<?= $row[0] ?>')">
                                                    <span style="color:red" class="material-symbols-sharp">delete</span>
                                                </a>
                                            </td>
                                            <td class="acct">
                                                <a type="button" class="btnm" onclick="openModal('<?= $row[0] ?>')">
                                                    <span style="color:green" class="material-symbols-sharp">edit</span>
                                                </a>
                                            </td>
                                        </tr>
                                        <?php
                                        $user = $obj->show($row[0]);
                                        ?>
                                        <!-- Modal para eliminacion -->
                                        <div id="modalEliminar<?= $row[0] ?>" class="modal">
                                            <div class="containerModalEliminar">
                                                <a href="#" class="close" style="margin-right:20px"
                                                    onclick="closeModalEliminar('<?= $row[0] ?>')">&times;</a>
                                                <form class="form" style="margin-top: -25px;" autocomplete="off" method="post">
                                                    <h2 class="title2" value="<?= $user[0] ?>">Eliminar Cita</h2>
                                                    <br>
                                                    <label class="Alertas" for="" value="<?= $user[0] ?>">¿Estas seguro de eliminar
                                                        esta cita?</label>

                                                    <div class="input-group">
                                                        <div>
                                                            <br>
                                                            <a class="ButtonEliminar" style="margin-left: 20em;"
                                                                href="../Crud/Cita/eliminarCita.php?id=<?= $row[0] ?>">Eliminar</a>
                                                        </div>
                                                    </div>
                                                    <br>
                                                </form>
                                            </div>
                                        </div>
                                        <!-- Modal para modificacion -->
                                        <div id="modal<?= $row[0] ?>" class="modal">
                                            <div class="containerModal">
                                                <a href="#" class="close" onclick="closeModal('<?= $row[0] ?>')">&times;</a>
                                                <form action="../Crud/Cita/ModificarCita.php" method="post" class="form">
                                                    <h2 class="title">Formulario Cita de
                                                        <?= $row[4] ?>
                                                    </h2>
                                                    <div class="checkout-information">
                                                        <input style="display:none" type="text" value="<?= $user['id'] ?>">
                                                        <div class="input-group">
                                                            <label style="display:none" class="labelModal"
                                                                for="IdCita">IdCita</label>
                                                            <input style="display:none" type="text" id="IdCita" name="IdCita"
                                                                value="<?= $user['id'] ?>" />
                                                        </div>
                                                        <div class="input-group2" style="gap:80px">
                                                            <div class="input-group">
                                                                <label style="color:black" for="FechaCitaInicio">Fecha de
                                                                    Inicio</label>
                                                                <input value="<?= $user['FechaInicio'] ?>" type="date"
                                                                    id="FechaCitaInicio" name="FechaCitaInicio" required>
                                                            </div>
                                                            <div class="input-group">
                                                                <label style="color:black" for="HoraInicio">Hora de Inicio</label>
                                                                <input type="time" value="<?= $user['HoraInicio'] ?>"
                                                                    id="HoraInicio" name="HoraInicio" />
                                                            </div>
                                                        </div>
                                                        <div class="input-group2" style="gap:80px">
                                                            <div class="input-group">
                                                                <label style="color:black" for="FechaCitaFin">Fecha de Fin</label>
                                                                <input value="<?= $user['FechaFin'] ?>" type="date"
                                                                    id="FechaCitaFin" name="FechaCitaFin" required>
                                                            </div>
                                                            <div class="input-group">
                                                                <label style="color:black" for="HoraFin">Hora de Fin</label>
                                                                <input type="time" value="<?= $user['HoraFin'] ?>" id="HoraFin"
                                                                    name="HoraFin" />
                                                            </div>
                                                        </div>
                                                        <div class="input-group">
                                                            <label style="color:black" for="ColorFondo">Color de Cita</label>
                                                            <input type="color" value="<?= $user['ColorFondo'] ?>" value="#3788D8"
                                                                id="ColorFondo" name="ColorFondo" style="height: 36px;" />
                                                        </div>
                                                        <div class="xd">
                                                            <button class="button">Enviar</button>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    <?php endforeach; ?>
                                <?php else: ?>
                                    <tr>
                                        <td colspan="7" class="text-center">No hay registro</td>
                                    </tr>
                                <?php endif; ?>
                            </tbody>
                        </table>

                        <div class="pagination">
                            <?php
                            if (isset($totalPages) && is_numeric($totalPages)) {
                                for ($page = 1; $page <= $totalPages; $page++) {
                                    ?>
                                    <a href="?page=<?= $page ?>"><?= $page ?></a>
                                    <?php
                                }
                            }
                            ?>
                        </div>
                    </div>
                </div>
            </main>

            <div id="notification" style="display: none;" class="notification">
                <p id="notification-text"></p>
                <span class="notification__progress"></span>
            </div>

        </div>
        <script src="../issets/js/Dashboard.js"></script>
        <script>
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
            // Buscador del paciente según su id
            $(document).ready(function () {
                $('.id').click(function () {
                    var codigoPaciente = $('#IdPaciente').val();

                    // Realizar la solicitud AJAX al servidor
                    $.ajax({
                        url: 'Fetch/fetch_paciente.php', // Archivo PHP que procesa la solicitud
                        method: 'POST',
                        data: { codigoPaciente: codigoPaciente },
                        success: function (response) {
                            if (response.error) {
                                $('#Paciente').val(response.error);
                            } else {
                                $('#Paciente').val(response.nombre);
                            }
                        },
                        error: function () {
                            $('#Paciente').val('Error al procesar la solicitud');
                        }
                    });
                });
            });
            // Buscador paciente segun su nombre 
            $(document).ready(function () {
                $('.nom').click(function () {
                    var NomPaciente = $('#NomPaciente').val();

                    // Realizar la solicitud AJAX al servidor
                    $.ajax({
                        url: 'Fetch/fetch_pacienteNom.php', // Archivo PHP que procesa la solicitud
                        method: 'POST',
                        data: { NomPaciente: NomPaciente },
                        success: function (response) {
                            if (response.error) {
                                $('#Paciente').val(response.error);
                                $('#IdPaciente').val('');
                                $('#correo').val('');
                                $('#telefono').val('');
                            } else {
                                $('#Paciente').val(response.nombre);
                                $('#IdPaciente').val(response.id);
                                $('#correo').val(response.correo);
                                $('#telefono').val(response.telefono);
                            }
                        },
                        error: function () {
                            $('#Paciente').val('Error al procesar la solicitud');
                            $('#IdPaciente').val('');
                            $('#correo').val('');
                            $('#telefono').val('');
                        }
                    });
                });
            });
            //Funciones del modal
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

            //funciones de la pagina
            var paginationLinks = document.getElementsByClassName('pagination')[0].getElementsByTagName('a');

            for (var i = 0; i < paginationLinks.length; i++) {
                paginationLinks[i].addEventListener('click', function (event) {
                    event.preventDefault();
                    var page = parseInt(this.getAttribute('href').split('=')[1]);
                    mostrarPagina(page);
                });
            }

            function mostrarPagina(page) {
                var rows = document.getElementById('myTable').getElementsByTagName('tr');

                for (var i = 0; i < rows.length; i++) {
                    rows[i].style.display = 'none';
                }

                var startIndex = (page - 1) * <?= $rowsPerPage ?>;
                var endIndex = startIndex + <?= $rowsPerPage ?>;

                for (var i = startIndex; i < endIndex && i < rows.length; i++) {
                    rows[i].style.display = 'table-row';
                }
            }

            mostrarPagina(1);
        </script>
    </body>

    </html>
    <?php
} else {
    header("Location: ../Index.php");
}
?>