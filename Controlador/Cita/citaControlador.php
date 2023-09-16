<?php
class usernameControlerCita{
    private $model;
    public function __construct()
    {
        require_once("C:/xampp/htdocs/Psicologia-Agenda-Clinica-Master/Modelo/Cita/ModelCita.php");
        $this->model=new UserModelCita();
    }
    public function guardar($IdPaciente, $MotivoCita, $EstadoCita, $FechaInicioCita, $DuracionCita,$FechaFinCita, $TipoCita, $ColorFondo, $IdPsicologo, $CanalCita, $EtiquetaCita) {
        $id = $this->model->insertarCita($IdPaciente, $MotivoCita, $EstadoCita, $FechaInicioCita, $DuracionCita,$FechaFinCita , $TipoCita, $ColorFondo, $IdPsicologo, $CanalCita, $EtiquetaCita);
        return ($id != false) ? header("Location:../../Vista/citas.php") : header("Location:../../Vista/citas.php");
    }
    public function ver($idUsuario) {
        return ($this->model->ver($idUsuario)) ?: false;
    }
    public function eliminar($id){
        return ($this->model->eliminar($id)) ?  header("Location:../../Vista/citas.php") : header("Location:../../Vista/citas.php");
    }
    public function modificarCita($IdCita,$FechaInicio, $EstadoCita,$MotivoCita,$Duracioncita,$TipoCita,$CanalCita,$EtiquetaCita ,$ColorFondo){
        return ($this->model->modificarCita($IdCita,$FechaInicio, $EstadoCita,$MotivoCita,$Duracioncita,$TipoCita,$CanalCita,$EtiquetaCita ,$ColorFondo)) !=false ? 
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
                'MotivoCita' => $cita['MotivoCita'],
                'EstadoCita' => $cita['EstadoCita'],
                'TipoCita' => $cita['TipoCita'],
                'CanalCita' => $cita['CanalCita'],
                'EtiquetaCita' => $cita['EtiquetaCita'],
                'Duracioncita' => $cita['Duracioncita'],
                'Email' => $cita['Email'],
            ];
    
            return $datos;
        } else {
            header("Location: ../../Vista/citas.php");
        }
    }
    public function showByFecha($id) {
        return ($this->model->showByFecha($id));
    }


    public function contarRegistrosEnCitas($id) {
        return ($this->model->contarRegistrosEnCitas($id));
    }

    
    
    /*FUNCIONA-DANIEL */
    /* CODIGO PARA EL DASHBOARD */

    public function contarCitasConfirmadas($id) {
        return ($this->model->contarCitasConfirmadas($id));
    }
  
    public function contarRegistrosEnPacientes($id) {
        return ($this->model->contarRegistrosEnPacientes($id));
    }

    public function contarPacientesConFechaActual($id) {
        return ($this->model->contarPacientesConFechaActual($id));
    }

    public function obtenerFechasCitasConFechaActual($id) {
        return ($this->model->obtenerFechasCitasConFechaActual($id));
    }
    public function obtenerCitasConNombrePacienteHoraMinutos2($id) {
        return ($this->model->obtenerCitasConNombrePacienteHoraMinutos2($id));
    }
    public function contarPacientesUltimoMes($id) {
        return ($this->model->contarPacientesUltimoMes($id));
    }
    public function contarCitasConfirmadasConCanal($id, $canal) {
        return $this->model->contarCitasConfirmadasConCanal($id, $canal);
    }
    
}
