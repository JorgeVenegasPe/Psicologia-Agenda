<?php
class usernameControlerPaciente{
    private $model;
    public function __construct()
    {
        require_once("C:/xampp/htdocs/agenda/Psicologia-Agenda/Modelo/Paciente/ModelPaciente.php");
        $this->model=new UserModelPaciente();
    }
    public function GuardarPaciente($NomPaciente, $ApPaterno, $ApMaterno, $Dni, $FechaNacimiento, $Edad,$GradoInstruccion, $Ocupacion, $EstadoCivil,$Genero,$Telefono, $Email, $Direccion,$AntecedentesMedicos,$IdPsicologo,$MedicamentosPrescritos){
        $id=$this->model->GuardarPaciente($NomPaciente, $ApPaterno, $ApMaterno, $Dni, $FechaNacimiento, $Edad,$GradoInstruccion, $Ocupacion, $EstadoCivil,$Genero,$Telefono, $Email, $Direccion,$AntecedentesMedicos,$IdPsicologo,$MedicamentosPrescritos);
        return ($id!=false) ? header("Location:../../Vista/DatosPaciente.php") : header("Location:../../Vista/DatosPaciente.php");
    }
    public function ver($IdPsicologo) {
        return ($this->model->ver($IdPsicologo)) ?: false;
    }
    public function eliminar($id){
        return ($this->model->eliminar($id)) ?  header("Location:../../Vista/DatosPaciente.php") : header("Location:../../Vista/DatosPaciente.php");
    }
    public function modificarPaciente($IdPaciente,$NomPaciente, $ApPaterno, $ApMaterno, $Dni, $FechaNacimiento, $Edad,$GradoInstruccion, $Ocupacion, $EstadoCivil,$Genero,$Telefono, $Email, $Direccion,$AntecedentesMedicos,$MedicamentosPrescritos){
        return ($this->model->modificarPaciente($IdPaciente,$NomPaciente, $ApPaterno, $ApMaterno, $Dni, $FechaNacimiento, $Edad,$GradoInstruccion, $Ocupacion, $EstadoCivil,$Genero,$Telefono, $Email, $Direccion,$AntecedentesMedicos,$MedicamentosPrescritos)) !=false ? 
        header("Location:../../Vista/DatosPaciente.php") : header("Location:../../Vista/DatosPaciente.php");
        }
    public function show($IdPaciente){
            return ($this->model->show($IdPaciente) != false) ? $this->model->show($IdPaciente):header("Location:../../Vista/DatosPaciente.php");
        }
        public function MostrarPacientesRecientes($idPsicologo) {
            $pacientesRecientes = $this->model->MostrarPacientesRecientes($idPsicologo);
            if ($pacientesRecientes !== false) {
                foreach ($pacientesRecientes as &$paciente) {
                    $fecha = date('Y-m-d', strtotime($paciente['FechaRegistro']));
                    $hora = date('H:i:s', strtotime($paciente['FechaRegistro']));
                    
                    $paciente['Fecha'] = $fecha;
                    $paciente['Hora'] = $hora;
                }
            } else {
                $pacientesRecientes = array(); // Asignar un arreglo vacío
            }
            
            return $pacientesRecientes;
        }
        
        
}
?>