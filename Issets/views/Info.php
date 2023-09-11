<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="stylesheet" href="../issets/css/info.css" />
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