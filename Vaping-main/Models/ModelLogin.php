<?php 
    class Login {
        private $PDO;
        public function __construct()
        {
        require("../Conexion/Conexion.php");
        $con=new conexion();
        $this->PDO=$con->conexion();
        }
        public function validarDatos($Nombre, $Contrasena) {
            if($_POST){
                session_start();
                $Nombre = $_POST['usu'];
                $Contrasena = $_POST['pass'];
                $this->PDO->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                $statement = $this->PDO->prepare("SELECT * FROM usuarios WHERE Nombre = :u AND Contrasena = :p");
                $statement->bindParam(":u", $Nombre);
                $statement->bindParam(":p", $Contrasena);
                $statement->execute();
                $Nombre = $statement->fetch(PDO::FETCH_ASSOC);
                if($Nombre){
                    $_SESSION['Nombre'] = $Nombre["Nombre"];
                    if ($Nombre["IdRol"] == 1) {
                        header("location: ../Views/Pods-Vapers.php");
                    } elseif ($Nombre["IdRol"] == 2) {
                        header("location: ../Views/Pods.php");
                    }
                }else{
                    header("location: ../Views/Login.php?error=1");
                } 
            }
        }

    }
?>