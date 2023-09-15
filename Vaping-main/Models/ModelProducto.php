<?php
class UserModelProducto{
    private $PDO;
    public function __construct()
    {
        require_once("C:/xampp/htdocs/Vaping-main/Conexion/Conexion.php");
        $con=new conexion();
        $this->PDO=$con->conexion();
    }
    public function InsertarProducto($IdCategoria,$nombre,$imagen,$descripcion,$precio) {
        $statement=$this->PDO->prepare("INSERT INTO producto (IdCategoria,Nombre, imagen, Descripcion, Precio) VALUES (:IdCategoria, :nombre, :imagen, :descripcion, :precio)");
        $statement->bindParam(':IdCategoria', $IdCategoria);
        $statement->bindParam(':nombre', $nombre);
        $statement->bindParam(':imagen', $imagen);
        $statement->bindParam(':descripcion', $descripcion);
        $statement->bindParam(':precio', $precio);

        return ($statement->execute()) ? $this->PDO->lastInsertId() : false;
    }

    public function VerProducto(){
        $statement=$this->PDO->prepare("SELECT * FROM producto");
        return($statement->execute()) ? $statement->fetchAll():false;
    }

    public function VerProductoPods(){
        $statement=$this->PDO->prepare("SELECT * FROM producto WHERE IdCategoria = 1");
        return($statement->execute()) ? $statement->fetchAll():false;
    }

    public function VerProductoVapers(){
        $statement=$this->PDO->prepare("SELECT * FROM producto WHERE IdCategoria = 2");
        return($statement->execute()) ? $statement->fetchAll():false;
    }


    public function ShowProducto($id){
        $statement=$this->PDO->prepare("SELECT * FROM producto where IdProducto=:id limit 1");
        $statement->bindParam(":id",$id);
        return($statement->execute()) ? $statement->fetch():false;
    }

    public function ModificarProducto($nombre,$imagen,$descripcion,$precio) {
        $statement=$this->PDO->prepare("UPDATE producto SET Nombre=:nombreactu, imagen=:imagenactu, Descripcion=:descripcionactu, Precio=:precioactu ");
        $statement->bindParam(':nombreactu', $nombre);
        $statement->bindParam(':imagenactu', $imagen);
        $statement->bindParam(':descripcionactu', $descripcion);
        $statement->bindParam(':precioactu', $precio);
        
        return ($statement->execute())? $this->PDO->lastInsertId():false;

    }

    public function EliminarProducto($id){
        $statement=$this->PDO->prepare("DELETE FROM producto WHERE IdProducto=:id");
        $statement->bindParam(":id",$id);
        return($statement->execute())? true:false;
    }
}

?>