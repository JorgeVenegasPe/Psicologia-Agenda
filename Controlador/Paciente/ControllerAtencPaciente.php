<?php
class usernameControlerAtencPaciente{
    private $model;
    public function __construct()
    {
        require_once("C:/xampp/htdocs/Psicologia-Agenda-Clinica-Master/Modelo/Paciente/ModelAtencPaciente.php");
        $this->model=new UserModelAtencPaciente();
    }
    public function guardarAtencPac($IdPaciente, $IdEnfermedad,$MotivoConsulta,$FormaContacto, $Diagnostico, $Tratamiento ,$Observacion,$UltimosObjetivos){
        $id=$this->model->insertarAtencPaciente($IdPaciente, $IdEnfermedad,$MotivoConsulta,$FormaContacto, $Diagnostico, $Tratamiento ,$Observacion,$UltimosObjetivos);
        return ($id!=false) ? header("Location:../../Vista/DatosPaciente.php") : header("Location:../../Vista/DatosPaciente.php");
    }
    public function ver(){
        return ($this->model->ver()) ? $this->model->ver():false;
    }
    public function eliminar($id){
        return ($this->model->eliminar($id)) ?  header("Location:../../Vista/DatosPaciente.php") : header("Location:../../Vista/DatosPaciente.php");
    }
    public function modificarAtencPaciente($IdAtencion, $MotivoConsulta,$FormaContacto,$Diagnostico, $Tratamiento, $Observacion, $UltimosObjetivos){
        return ($this->model->modificarAtencPaciente($IdAtencion, $MotivoConsulta,$FormaContacto,$Diagnostico, $Tratamiento, $Observacion, $UltimosObjetivos)) !=false ? 
        header("Location:../../Vista/DatosPaciente.php") : header("Location:../../Vista/DatosPaciente.php");
        }
    public function showAtenc($id) {
        $atencion = $this->model->showAtenc($id);
        if ($atencion !== false) {
            return $atencion;
        } else {
            return null;
        }
    }
    public function showAtencDiagnostico($id_paciente){
        $result = $this->model->showAtencDiagnostico($id_paciente);
        if ($result !== false) {
            return $result;
        } else {
            header("Location: ../../Vista/citas.php");
            exit();
        }
    }
    public function getAtencDiagnosticoById($id) {
        $atencion = $this->model->getAtencDiagnosticoById($id);
        return ($atencion != false) ? $atencion : false;
    }
}
?>