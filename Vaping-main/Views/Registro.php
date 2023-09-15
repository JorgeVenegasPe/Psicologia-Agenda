<?php
$conex = mysqli_connect("localhost", "root", "", "Vaping");
if(isset($_POST['register_rt'])){
    if(strlen($_POST['nombre_cliente'])>=1){
        $nombre_cliente = trim($_POST['nombre_cliente']);
        $consulta ="INSERT INTO `recojo_tienda`(`nombre_cliente`) VALUES ('$nombre_cliente')";
        $resultado=mysqli_query($conex,$consulta);
        if($resultado){
            ?>
            <h3>Registro completado</h3>
            <?php
        }else{
            ?>
            <h3>El Registro NO completado</h3>
            <?php
        }
    }   else{
        ?>
        <h3>Complete el Registro</h3>
        <?php
    }
}


?>