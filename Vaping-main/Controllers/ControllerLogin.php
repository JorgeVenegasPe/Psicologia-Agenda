<?php 
    if (isset($_POST["usu"]) && isset($_POST["pass"])) {
        require("../Models/ModelLogin.php");
        $validar = new Login();
        $validar->validarDatos($_POST["usu"], $_POST["pass"]);
    } else {
        header("location: ../Views/Login.php");
    }
?>