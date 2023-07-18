<?php
class usernameControlerCita{
    private $model;
    public function __construct()
    {
        require_once("C:/xampp/htdocs/Psicologia-Agenda-Clinica-Master/Modelo/Cita/ModelCita.php");
        $this->model=new UserModelCita();
    }
    public function guardar($IdPaciente, $MotivoCita, $EstadoCita, $FechaInicioCita, $DuracionCita, $TipoCita, $ColorFondo, $IdPsicologo, $CanalCita, $EtiquetaCita) {
        $id = $this->model->insertarCita($IdPaciente, $MotivoCita, $EstadoCita, $FechaInicioCita, $DuracionCita, $TipoCita, $ColorFondo, $IdPsicologo, $CanalCita, $EtiquetaCita);
        return ($id != false) ? header("Location:../../Vista/citas.php") : header("Location:../../Vista/citas.php");
    }
    public function ver($idUsuario) {
        return ($this->model->ver($idUsuario)) ?: false;
    }
    public function eliminar($id){
        return ($this->model->eliminar($id)) ?  header("Location:../../Vista/citas.php") : header("Location:../../Vista/citas.php");
    }
    public function modificarCita($IdCita,$FechaInicio, $FechaFin ,$ColorFondo){
        return ($this->model->modificarCita($IdCita,$FechaInicio, $FechaFin ,$ColorFondo)) !=false ? 
        header("Location:../../Vista/citas.php") : header("Location:../../Vista/citas.php");
        }
    public function show($id) {
        $cita = $this->model->show($id);
    
        if ($cita != false) {
            // Separar la fecha y la hora
            $FechaCitaInicio = explode(" ", $cita['FechaInicioCita']);
            $FechaInicio = $FechaCitaInicio[0];
            $HoraInicio = $FechaCitaInicio[1];
    
            // Asignar los valores a las variables para usar en el formulario
            $datos = [
                'id' => $cita['IdCita'],
                'FechaInicio' => $FechaInicio,
                'HoraInicio' => $HoraInicio,
                'ColorFondo' => $cita['ColorFondo'],
            ];
    
            return $datos;
        } else {
            header("Location: ../../Vista/citas.php");
        }
    }
    public function showbyFecha($id) {
        $cita = $this->model->show($id);
    
        if ($cita != false) {
            // Separar la fecha y la hora
            $FechaCitaInicio = explode(" ", $cita['FechaInicioCita']);
            $FechaInicio = $FechaCitaInicio[0];
            $HoraInicio = $FechaCitaInicio[1];
    
            // Asignar los valores a las variables para usar en el formulario
            $datos = [
                'id' => $cita['IdCita'],
                'FechaInicio' => $FechaInicio,
                'HoraInicio' => $HoraInicio,
                'ColorFondo' => $cita['ColorFondo'],
            ];
    
            return $datos;
        } else {
            header("Location: ../../Vista/citas.php");
        }
    }
    public function mostrarVista()
    {
    return $this->model->calcularPorcentajes();
    }

} 
?>