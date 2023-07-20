<?php
class usernameControlerAreaFamiliar{
    private $model;
    public function __construct()
    {
        require_once("C:/xampp/htdocs/agenda/Psicologia-Agenda/Modelo/Paciente/ModelAtencFamiliar.php");
        $this->model=new UserModelAreaFamiliar();
    }
    public function guardarAreaFamiliar($IdPaciente, $NomPadre,$EstadoPadre, $NomMadre,$EstadoMadre, $NomApoderado,$EstadoApoderado,$CantHermanos,$CantHijos,$IntegracionFamiliar,$HistorialFamiliar){
        $id=$this->model->insertarAreaFamiliar($IdPaciente, $NomPadre,$EstadoPadre, $NomMadre,$EstadoMadre, $NomApoderado,$EstadoApoderado,$CantHermanos,$CantHijos,$IntegracionFamiliar,$HistorialFamiliar);
        return ($id!=false) ? header("Location:../../Vista/DatosPaciente.php") : header("Location:../../Vista/DatosPaciente.php");
    }
    public function ver(){
        return ($this->model->ver()) ? $this->model->ver():false;
    }
    public function eliminarAreaFamiliar($id){
        return ($this->model->eliminarAreaFamiliar($id)) ?  header("Location:../../Vista/DatosPaciente.php") : header("Location:../../Vista/DatosPaciente.php");
    }
    public function ModificarAreaFamiliar($IdFamiliar,$NomPadre,$EstadoPadre, $NomMadre,$EstadoMadre, $NomApoderado,$EstadoApoderado,$CantHermanos,$CantHijos,$IntegracionFamiliar,$HistorialFamiliar){
        return ($this->model->ModificarAreaFamiliar($IdFamiliar,$NomPadre,$EstadoPadre, $NomMadre,$EstadoMadre, $NomApoderado,$EstadoApoderado,$CantHermanos,$CantHijos,$IntegracionFamiliar,$HistorialFamiliar)) !=false ? 
        header("Location:../../Vista/DatosPaciente.php") : header("Location:../../Vista/DatosPaciente.php");
        }
    public function showAreaFamiliar($id) {
        $atencion = $this->model->showAreaFamiliar($id);
        if ($atencion !== false) {
            return $atencion;
        } else {
            return null;
        }
    }
}
?>