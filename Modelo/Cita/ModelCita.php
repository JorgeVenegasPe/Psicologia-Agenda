<?php
class UserModelCita{
    private $PDO;
    public function __construct()
    {
        require_once("C:/xampp/htdocs/Psicologia-Agenda-Clinica-Master/conexion/conexion.php");
        $con=new conexion();
        $this->PDO=$con->conexion();
    }
    public function insertarCita($IdPaciente, $MotivoCita, $EstadoCita, $FechaInicioCita, $DuracionCita,$FechaFinCita, $TipoCita, $ColorFondo, $IdPsicologo, $CanalCita, $EtiquetaCita) {
        $statement = $this->PDO->prepare("INSERT INTO cita (IdPaciente, MotivoCita, EstadoCita, FechaInicioCita, DuracionCita, FechaFinCita, TipoCita, ColorFondo, IdPsicologo, CanalCita, EtiquetaCita) 
                                        VALUES (:IdPaciente, :MotivoCita, :EstadoCita, :FechaInicioCita, :DuracionCita,:FechaFinCita, :TipoCita, :ColorFondo, :IdPsicologo, :CanalCita, :EtiquetaCita)");
        $statement->bindParam(":IdPaciente", $IdPaciente);
        $statement->bindParam(":MotivoCita", $MotivoCita);
        $statement->bindParam(":EstadoCita", $EstadoCita);
        $statement->bindParam(":FechaInicioCita", $FechaInicioCita);
        $statement->bindParam(":DuracionCita", $DuracionCita);
        $statement->bindParam(":FechaFinCita", $FechaFinCita);
        $statement->bindParam(":TipoCita", $TipoCita);
        $statement->bindParam(":ColorFondo", $ColorFondo);
        $statement->bindParam(":IdPsicologo", $IdPsicologo);
        $statement->bindParam(":CanalCita", $CanalCita);
        $statement->bindParam(":EtiquetaCita", $EtiquetaCita);
    
        return ($statement->execute()) ? $this->PDO->lastInsertId() : false;
    }
    
    public function ver($idUsuario){
        $statement=$this->PDO->prepare("SELECT c.IdCita,p.NomPaciente,c.MotivoCita,c.EstadoCita,c.FechaInicioCita,c.Duracioncita,c.TipoCita,c.ColorFondo,ps.NombrePsicologo,c.CanalCita,c.EtiquetaCita FROM cita c
                                        INNER JOIN paciente p on c.IdPaciente=p.IdPaciente
                                        INNER JOIN psicologo ps on c.IdPsicologo=ps.IdPsicologo
                                        WHERE c.IdPsicologo = :idUsuario");
        $statement->bindValue(':idUsuario', $idUsuario);
        return($statement->execute())? $statement->fetchaLL():false;

    }
    public function show($id){
        $statement=$this->PDO->prepare("SELECT c.IdCita,p.NomPaciente,p.Email,c.EstadoCita,c.MotivoCita,c.FechaInicioCita,c.Duracioncita,c.TipoCita,c.ColorFondo,ps.NombrePsicologo,c.CanalCita,c.EtiquetaCita,c.FechaRegistro FROM cita c
                                       INNER JOIN psicologo ps on c.IdPsicologo=ps.IdPsicologo
                                       INNER JOIN paciente p on c.IdPaciente=p.IdPaciente
                                       where IdCita=:id limit 1");
        $statement->bindParam(":id",$id);
        return($statement->execute())? $statement->fetch():false;

    }
    public function showByFecha($id){
        $statement=$this->PDO->prepare("SELECT c.IdCita,p.NomPaciente,c.MotivoCita,c.EstadoCita,c.FechaInicioCita,c.Duracioncita,c.TipoCita,c.ColorFondo,ps.NombrePsicologo,c.CanalCita,c.EtiquetaCita,p.CodigoPaciente FROM cita c
                                       INNER JOIN psicologo ps on c.IdPsicologo=ps.IdPsicologo
                                       INNER JOIN paciente p on c.IdPaciente=p.IdPaciente
                                       where c.IdPsicologo = :idUsua
                                       AND WEEK(c.FechaRegistro)=WEEK(NOW())");
        $statement->bindParam(":idUsua",$id);
        return($statement->execute())? $statement->fetchaLL():false;

    }
    public function eliminar($id){
        $statement=$this->PDO->prepare("DELETE FROM cita WHERE IdCita=:id;");
        $statement->bindParam(":id",$id);
        return($statement->execute())? true:false;
        
    }
    public function modificarCita($IdCita,$FechaInicio, $EstadoCita,$MotivoCita,$Duracioncita,$TipoCita,$CanalCita,$EtiquetaCita ,$ColorFondo) {
      
        $statement = $this->PDO->prepare("UPDATE cita SET FechaInicioCita=:FechaInicioCita,EstadoCita=:EstadoCita,MotivoCita=:MotivoCita,Duracioncita=:Duracioncita,TipoCita=:TipoCita,CanalCita=:CanalCita,EtiquetaCita=:EtiquetaCita,ColorFondo=:ColorFondo WHERE IdCita=:IdCita");
        $statement->bindParam(":IdCita",$IdCita);
        $statement->bindParam(":FechaInicioCita",$FechaInicio);
        $statement->bindParam(":EstadoCita",$EstadoCita);
        $statement->bindParam(":MotivoCita",$MotivoCita);
        $statement->bindParam(":Duracioncita",$Duracioncita);
        $statement->bindParam(":TipoCita",$TipoCita);
        $statement->bindParam(":CanalCita",$CanalCita);
        $statement->bindParam(":EtiquetaCita",$EtiquetaCita);
        $statement->bindParam(":ColorFondo",$ColorFondo);
    
        return ($statement->execute())? $this->PDO->lastInsertId():false;
    }
    public function calcularPorcentajes($idPsicologo) {

        $sql_primera_visita = "SELECT COUNT(*) AS count FROM cita WHERE TipoCita = 'Primera visita' AND IdPsicologo = :idPsicologo";
        $stmt_primera_visita = $this->PDO->prepare($sql_primera_visita);
        $stmt_primera_visita->bindParam(':idPsicologo', $idPsicologo, PDO::PARAM_INT);
        $stmt_primera_visita->execute();
        $count_primera_visita = $stmt_primera_visita->fetchColumn();
        
        // Consulta para contar los valores "Visita de control"
        $sql_visita_control = "SELECT COUNT(*) AS count FROM cita WHERE TipoCita = 'Visita de control' AND IdPsicologo = :idPsicologo";
        $stmt_visita_control = $this->PDO->prepare($sql_visita_control);
        $stmt_visita_control->bindParam(':idPsicologo', $idPsicologo, PDO::PARAM_INT);
        $stmt_visita_control->execute();
        $count_visita_control = $stmt_visita_control->fetchColumn();
        
        // Calcular el porcentaje con dos decimales
        $total_registros = $count_primera_visita + $count_visita_control;
        $porcentaje_primera_visita = ($total_registros != 0) ? number_format(($count_primera_visita / $total_registros) * 100, 2): 0;
        $porcentaje_visita_control = ($total_registros != 0) ? number_format(($count_visita_control / $total_registros) * 100, 2): 0;
        
        // Consulta para contar los valores "Cita Online"
        $sql_cita_online = "SELECT COUNT(*) AS count FROM cita WHERE CanalCita = 'Cita Online' AND IdPsicologo = :idPsicologo";
        $stmt_cita_online = $this->PDO->prepare($sql_cita_online);
        $stmt_cita_online->bindParam(':idPsicologo', $idPsicologo, PDO::PARAM_INT);
        $stmt_cita_online->execute();
        $count_cita_online = $stmt_cita_online->fetchColumn();
        
        // Consulta para contar los valores "Marketing Directo"
        $sql_marketing_directo = "SELECT COUNT(*) AS count FROM cita WHERE CanalCita = 'Marketing Directo' AND IdPsicologo = :idPsicologo";
        $stmt_marketing_directo = $this->PDO->prepare($sql_marketing_directo);
        $stmt_marketing_directo->bindParam(':idPsicologo', $idPsicologo, PDO::PARAM_INT);
        $stmt_marketing_directo->execute();
        $count_marketing_directo = $stmt_marketing_directo->fetchColumn();
        
        // Consulta para contar los valores "Referidos"
        $sql_referidos = "SELECT COUNT(*) AS count FROM cita WHERE CanalCita = 'Referidos' AND IdPsicologo = :idPsicologo";
        $stmt_referidos = $this->PDO->prepare($sql_referidos);
        $stmt_referidos->bindParam(':idPsicologo', $idPsicologo, PDO::PARAM_INT);
        $stmt_referidos->execute();
        $count_referidos = $stmt_referidos->fetchColumn();
        
        // Calcular el porcentaje con dos decimales
        $total_registros_canal = $count_cita_online + $count_marketing_directo + $count_referidos;
        $porcentaje_cita_online = ($total_registros_canal != 0) ? number_format(($count_cita_online / $total_registros_canal) * 100, 2) : 0;
        $porcentaje_marketing_directo = ($total_registros_canal != 0) ? number_format(($count_marketing_directo / $total_registros_canal) * 100, 2) : 0;
        $porcentaje_referidos = ($total_registros_canal != 0) ? number_format(($count_referidos / $total_registros_canal) * 100, 2) : 0;


        // Consulta para contar los valores "Se requiere confirmacion"
        $sql_se_requiere_confirmacion = "SELECT COUNT(*) AS count FROM cita WHERE EstadoCita = 'Se requiere confirmacion' AND IdPsicologo = :idPsicologo";
        $stmt_se_requiere_confirmacion = $this->PDO->prepare($sql_se_requiere_confirmacion);
        $stmt_se_requiere_confirmacion->bindParam(':idPsicologo', $idPsicologo, PDO::PARAM_INT);
        $stmt_se_requiere_confirmacion->execute();
        $count_se_requiere_confirmacion = $stmt_se_requiere_confirmacion->fetchColumn();
        
        // Consulta para contar los valores "Confirmado"
        $sql_confirmado = "SELECT COUNT(*) AS count FROM cita WHERE EstadoCita = 'Confirmado' AND IdPsicologo = :idPsicologo";
        $stmt_confirmado = $this->PDO->prepare($sql_confirmado);
        $stmt_confirmado->bindParam(':idPsicologo', $idPsicologo, PDO::PARAM_INT);
        $stmt_confirmado->execute();
        $count_confirmado = $stmt_confirmado->fetchColumn();
        
        // Consulta para contar los valores "Ausencia del paciente"
        $sql_ausencia_paciente = "SELECT COUNT(*) AS count FROM cita WHERE EstadoCita = 'Ausencia del paciente' AND IdPsicologo = :idPsicologo";
        $stmt_ausencia_paciente = $this->PDO->prepare($sql_ausencia_paciente);
        $stmt_ausencia_paciente->bindParam(':idPsicologo', $idPsicologo, PDO::PARAM_INT);
        $stmt_ausencia_paciente->execute();
        $count_ausencia_paciente = $stmt_ausencia_paciente->fetchColumn();
        
        // Calcular el porcentaje con dos decimales
        $total_registros_estado = $count_se_requiere_confirmacion + $count_confirmado + $count_ausencia_paciente;
        $porcentaje_se_requiere_confirmacion = ($total_registros_estado != 0) ? number_format(($count_se_requiere_confirmacion / $total_registros_estado) * 100, 2) :0;
        $porcentaje_confirmado = ($total_registros_estado != 0) ? number_format(($count_confirmado / $total_registros_estado) * 100, 2) :0;
        $porcentaje_ausencia_paciente = ($total_registros_estado != 0) ? number_format(($count_ausencia_paciente / $total_registros_estado) * 100, 2):0;
        
        return [
            'porcentaje_primera_visita' => $porcentaje_primera_visita,
            'porcentaje_visita_control' => $porcentaje_visita_control,
        
            'porcentaje_cita_online' => $porcentaje_cita_online,
            'porcentaje_marketing_directo' => $porcentaje_marketing_directo,
            'porcentaje_referidos' => $porcentaje_referidos,
        
            'porcentaje_se_requiere_confirmacion' => $porcentaje_se_requiere_confirmacion,
            'porcentaje_confirmado' => $porcentaje_confirmado,
            'porcentaje_ausencia_paciente' => $porcentaje_ausencia_paciente
        ];
}
       //FUNCION PARA CONTAR LAS CITAS REGISTRADAS
       public function contarRegistrosEnCitas() {
        // Obtener el IdPsicologo de la sesión
        $idPsicologo = $_SESSION['IdPsicologo'];
    
        // Consulta SQL para contar los registros donde IdPsicologo sea igual al valor de la sesión
        $sql = "SELECT COUNT(*) as total FROM cita WHERE IdPsicologo = :idPsicologo";
        
        // Preparar la consulta
        $statement = $this->PDO->prepare($sql);
        
        // Asignar el valor de IdPsicologo a la consulta
        $statement->bindParam(":idPsicologo", $idPsicologo, PDO::PARAM_INT);
        
        // Ejecutar la consulta
        $result = $statement->execute();
    
        if ($result) {
            $row = $statement->fetch(PDO::FETCH_ASSOC);
            $total_registros = $row["total"];
            return $total_registros;
        } else {
            return 0;
        }
    }

    public function contarCitasConfirmadas() {
        // Obtener el IdPsicologo de la sesión
        $idPsicologo = $_SESSION['IdPsicologo'];
    
        // Consulta SQL para contar los registros donde IdPsicologo sea igual al valor de la sesión
        // y EstadoCita sea igual a "Confirmado"
        $sql = "SELECT COUNT(*) as total FROM cita WHERE IdPsicologo = :idPsicologo AND EstadoCita = 'Confirmado'";
        
        // Preparar la consulta
        $statement = $this->PDO->prepare($sql);
        
        // Asignar el valor de IdPsicologo a la consulta
        $statement->bindParam(":idPsicologo", $idPsicologo, PDO::PARAM_INT);
        
        // Ejecutar la consulta
        $result = $statement->execute();
    
        if ($result) {
            $row = $statement->fetch(PDO::FETCH_ASSOC);
            $total_registros = $row["total"];
            return $total_registros;
        } else {
            return 0;
        }
    }
    

    

    
       //FUNCION PARA CONTAR LAS CITAS REGISTRADAS
       public function contarRegistrosEnPacientes() {
        // Obtener el IdPsicologo de la sesión
        $idPsicologo = $_SESSION['IdPsicologo'];
    
        // Consulta SQL para contar los registros donde IdPsicologo sea igual al valor de la sesión
        $sql = "SELECT COUNT(*) as total FROM paciente WHERE IdPsicologo = :idPsicologo";
        
        // Preparar la consulta
        $statement = $this->PDO->prepare($sql);
        
        // Asignar el valor de IdPsicologo a la consulta
        $statement->bindParam(":idPsicologo", $idPsicologo, PDO::PARAM_INT);
        
        // Ejecutar la consulta
        $result = $statement->execute();
    
        if ($result) {
            $row = $statement->fetch(PDO::FETCH_ASSOC);
            $total_registros = $row["total"];
            return $total_registros;
        } else {
            return 0;
        }
    }

    public function contarPacientesConFechaActual() {
        // Obtener el IdPsicologo de la sesión
        $idPsicologo = $_SESSION['IdPsicologo'];
    
        // Obtener la fecha actual en el formato YYYY-MM-DD
        $fechaActual = date("Y-m-d");
    
        // Consulta SQL para contar los registros donde IdPsicologo sea igual al valor de la sesión
        // y la FechaRegistro (solo la parte de la fecha) sea igual a la fecha actual
        $sql = "SELECT COUNT(*) as total FROM paciente WHERE IdPsicologo = :idPsicologo AND DATE(FechaRegistro) = :fechaActual";
    
        // Preparar la consulta
        $statement = $this->PDO->prepare($sql);
    
        // Asignar los valores a los parámetros de la consulta
        $statement->bindParam(":idPsicologo", $idPsicologo, PDO::PARAM_INT);
        $statement->bindParam(":fechaActual", $fechaActual, PDO::PARAM_STR);
    
        // Ejecutar la consulta
        $result = $statement->execute();
    
        if ($result) {
            $row = $statement->fetch(PDO::FETCH_ASSOC);
            $total_registros = $row["total"];
            return $total_registros;
        } else {
            return 0;
        }
    }



    //fechas con citas de fecha actual 
    public function obtenerFechasCitasConFechaActual() {
        // Obtener el IdPsicologo de la sesión
        $idPsicologo = $_SESSION['IdPsicologo'];
    
        // Obtener la fecha actual en el formato YYYY-MM-DD
        $fechaActual = date("Y-m-d");
    
        // Consulta SQL para obtener las fechas de las citas donde IdPsicologo sea igual al valor de la sesión
        // y la FechaCita (solo la parte de la fecha) sea igual a la fecha actual
        $sql = "SELECT FechaRegistro FROM cita WHERE IdPsicologo = :idPsicologo AND DATE(FechaRegistro) = :fechaActual";
    
        // Preparar la consulta
        $statement = $this->PDO->prepare($sql);
    
        // Asignar los valores a los parámetros de la consulta
        $statement->bindParam(":idPsicologo", $idPsicologo, PDO::PARAM_INT);
        $statement->bindParam(":fechaActual", $fechaActual, PDO::PARAM_STR);
    
        // Ejecutar la consulta
        $result = $statement->execute();
    
        if ($result) {
            $fechas = array();
    
            while ($row = $statement->fetch(PDO::FETCH_ASSOC)) {
                $fechas[] = $row["FechaRegistro"];
            }
    
            return $fechas;
        } else {
            return array(); // Devolver un arreglo vacío si no se encontraron citas
        }
    }




    //horas con citas de fecha actual 
    public function obtenerHorasCitasConFechaActual() {
        // Obtener el IdPsicologo de la sesión
        $idPsicologo = $_SESSION['IdPsicologo'];
    
        // Obtener la fecha actual en el formato YYYY-MM-DD
        $fechaActual = date("Y-m-d");
    
        // Consulta SQL para obtener las horas y minutos de las citas donde IdPsicologo sea igual al valor de la sesión
        // y la FechaCita (solo la parte de la fecha) sea igual a la fecha actual
        $sql = "SELECT DATE_FORMAT(FechaRegistro, '%H:%i') as HoraMinutos FROM cita WHERE IdPsicologo = :idPsicologo AND DATE(FechaRegistro) = :fechaActual";
    
        // Preparar la consulta
        $statement = $this->PDO->prepare($sql);
    
        // Asignar los valores a los parámetros de la consulta
        $statement->bindParam(":idPsicologo", $idPsicologo, PDO::PARAM_INT);
        $statement->bindParam(":fechaActual", $fechaActual, PDO::PARAM_STR);
    
        // Ejecutar la consulta
        $result = $statement->execute();
    
        if ($result) {
            $horasMinutos = array();
    
            while ($row = $statement->fetch(PDO::FETCH_ASSOC)) {
                $horasMinutos[] = $row["HoraMinutos"];
            }
    
            return $horasMinutos;
        } else {
            return array(); // Devolver un arreglo vacío si no se encontraron citas
        }
    }
    


    

    public function obtenerCitasConNombrePacienteHoraMinutos() {
        // Obtener el IdPsicologo de la sesión
        $idPsicologo = $_SESSION['IdPsicologo'];
    
        // Obtener la fecha actual en el formato YYYY-MM-DD
        $fechaActual = date("Y-m-d");
    
        // Consulta SQL para obtener el IdPaciente, NomPaciente, hora y minutos de las citas
        // donde IdPsicologo sea igual al valor de la sesión y la FechaRegistro (solo la parte de la fecha) sea igual a la fecha actual
        $sql = "SELECT paciente.IdPaciente, paciente.NomPaciente, DATE_FORMAT(cita.FechaRegistro, '%H:%i') as HoraMinutos
                FROM cita
                INNER JOIN paciente ON cita.IdPaciente = paciente.IdPaciente
                WHERE cita.IdPsicologo = :idPsicologo AND DATE(cita.FechaRegistro) = :fechaActual";
    
        // Preparar la consulta
        $statement = $this->PDO->prepare($sql);
    
        // Asignar los valores a los parámetros de la consulta
        $statement->bindParam(":idPsicologo", $idPsicologo, PDO::PARAM_INT);
        $statement->bindParam(":fechaActual", $fechaActual, PDO::PARAM_STR);
    
        // Ejecutar la consulta
        $result = $statement->execute();
    
        if ($result) {
            $citas = array();
    
            while ($row = $statement->fetch(PDO::FETCH_ASSOC)) {
                $citas[] = $row;
            }
    
            return $citas;
        } else {
            return array(); // Devolver un arreglo vacío si no se encontraron citas
        }
    }
    


    
    
    
    
    
    
    
}

?>