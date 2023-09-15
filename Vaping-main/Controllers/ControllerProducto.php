<?php
class usernameControlerProducto{
    private $model;
    public function __construct()
    {
        require_once("C:/xampp/htdocs/Vaping-main/Models/ModelProducto.php");
        $this->model=new UserModelProducto();
    }
    public function InsertarProducto($IdCategoria,$nombre,$imagen,$descripcion,$precio) {
        $id = $this->model->InsertarProducto($IdCategoria,$nombre,$imagen,$descripcion,$precio);
        return ($id != false) ? header("Location: ../Views/Pods-Vapers.php") : header("Location: ../Views/Pods-Vapers.php");
    }
    public function VerProducto() {
        return ($this->model->VerProducto()) ?: false;
    }
    public function VerProductoPods() {
        return ($this->model->VerProductoPods()) ?: false;
    }
    public function VerProductoVapers() {
        return ($this->model->VerProductoVapers()) ?: false;
    }
    public function ShowProducto($id) {
        return ($this->model->ShowProducto($id)) ?: false;
    }
    public function ModificarProducto($nombre,$imagen,$descripcion,$precio){
        return ($this->model->ModificarProducto($nombre,$imagen,$descripcion,$precio)) !=false ? 
        header("Location: ../Views/Pods-Vapers.php") : header("Location: ../Views/Pods-Vapers.php");
    }
    public function EliminarProducto($id){
        return ($this->model->EliminarProducto($id)) ?  header("Location:../Views/Pods-Vapers.php") : header("Location:../Views/Pods-Vapers.php");
    }
} 
?>