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
    <link rel="stylesheet" href="../issets/css/info.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>

<body>
    <div class="top">
        <button id="menu-btn">
            <span class="material-symbols-sharp" translate="no">menu</span>
        </button>
        <div class="theme-toggler">
            <span class="material-symbols-sharp active" translate="no">light_mode</span>
            <span class="material-symbols-sharp" translate="no">dark_mode</span>
        </div>
        <div>
            <div>
                <a class="ajuste-info nav-link" style="cursor:pointer;" onclick="openModalAjustes()">
                    <span class="material-symbols-sharp" translate="no">settings</span>
                </a>
            </div>
            <?php
    require_once 'ajuste.php';
  ?>
        </div>
        <div class="profile">

            <div class="info">
                <p>| <b><?=$_SESSION['Usuario']?> | </b></p>
            </div>
        </div>
        <a href="../issets/views/Salir.php">
            <!-- <span class="material-symbols-sharp" translate="no">logout</span>-->
            <h3 class="cerrar-info">Cerrar Sesion</h3>

        </a>
    </div>


    <!-- JavaScript para abrir y cerrar el modal -->
    <script>
    function openModalAjustes() {
        var modal = document.getElementById("myModal");
        modal.style.display = "block";
    }

    function closeModalAjustes() {
        var modal = document.getElementById("myModal");
        modal.style.display = "none";
    }

    </script>

</body>

</html>