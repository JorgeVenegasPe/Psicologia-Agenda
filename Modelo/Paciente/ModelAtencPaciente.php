<?php
class UserModelAtencPaciente{
    private $PDO;
    public function __construct()
    {
        require_once("C:/xampp/htdocs/Psicologia-Agenda-Clinica-master/Conexion/conexion.php");
        $con=new conexion();
        $this->PDO=$con->conexion();

    }
    public function insertarAtencPaciente($IdPaciente, $IdEnfermedad, $MotivoConsulta,$FormaContacto,$Diagnostico, $Tratamiento,$Observacion,$UltimosObjetivos) {
        $IdPaciente = $_POST['IdPaciente'];
        $IdEnfermedad = $_POST['IdEnfermedad'];
        $MotivoConsulta = $_POST['MotivoConsulta'];
        $FormaContacto = $_POST['FormaContacto'];
        $Diagnostico = $_POST['Diagnostico'];
        $Tratamiento = $_POST['Tratamiento'];
        $Observacion = $_POST['Observacion'];
        $UltimosObjetivos = $_POST['UltimosObjetivos'];
        $statement=$this->PDO->prepare("INSERT INTO AtencionPaciente(IdPaciente, IdEnfermedad, MotivoConsulta,FormaContacto, Diagnostico, Tratamiento, Observacion,UltimosObjetivos) VALUES(:IdPaciente, :IdEnfermedad, :MotivoConsulta, :FormaContacto, :Diagnostico, :Tratamiento, :Observacion, :UltimosObjetivos)");
        $array = array($IdPaciente, $IdEnfermedad, $MotivoConsulta,$FormaContacto,$Diagnostico, $Tratamiento,$Observacion,$UltimosObjetivos);
        $statement->bindParam(":IdPaciente",$IdPaciente);
        $statement->bindParam(":IdEnfermedad",$IdEnfermedad);
        $statement->bindParam(":MotivoConsulta",$MotivoConsulta);
        $statement->bindParam(":FormaContacto",$FormaContacto);
        $statement->bindParam(":Diagnostico",$Diagnostico);
        $statement->bindParam(":Tratamiento",$Tratamiento);
        $statement->bindParam(":Observacion",$Observacion);
        $statement->bindParam(":UltimosObjetivos",$UltimosObjetivos);

        return ($statement->execute())? $this->PDO->lastInsertId():false;
    }
    public function ver(){
        $statement=$this->PDO->prepare("SELECT * FROM AtencionPaciente");
        return($statement->execute())? $statement->fetchaLL():false;
    }
    public function showAtencDiagnostico($IdPaciente){
        $statement = $this->PDO->prepare("SELECT ap.IdAtencion, ap.FechaRegistro
                                          FROM AtencionPaciente ap
                                          WHERE IdPaciente = :IdPaciente
                                          ORDER BY ap.FechaRegistro DESC");
        $statement->bindParam(":IdPaciente", $IdPaciente);
        return ($statement->execute()) ? $statement->fetchAll() : false;
    }
    public function getAtencDiagnosticoById($IdAtencion) {
        $statement = $this->PDO->prepare("SELECT ap.Diagnostico, ap.Tratamiento, ap.Observacion, ap.IdEnfermedad, e.NombreEmfermedad, ap.IdPaciente, p.NomPaciente
        FROM AtencionPaciente ap
        JOIN Enfermedad e ON ap.IdEnfermedad = e.IdEnfermedad
        JOIN Paciente p ON ap.IdPaciente = p.IdPaciente
        WHERE ap.IdAtencion = :IdAtencion");
        $statement->bindParam(":IdAtencion", $IdAtencion);
        return ($statement->execute()) ? $statement->fetch() : false;
    }
    public function showAtenc($IdPaciente){
        $statement=$this->PDO->prepare("SELECT ap.IdAtencion,ap.IdPaciente,ap.IdEnfermedad,e.Clasificacion,p.NomPaciente,ap.MotivoConsulta,ap.FormaContacto,ap.Diagnostico,ap.Tratamiento,ap.Observacion,ap.UltimosObjetivos
        FROM AtencionPaciente ap
        JOIN Enfermedad e ON ap.IdEnfermedad = e.IdEnfermedad
        JOIN Paciente p ON ap.IdPaciente = p.IdPaciente
        WHERE p.IdPaciente = :IdPaciente
        ORDER BY ap.FechaRegistro DESC
        LIMIT 1 ");
        $statement->bindParam(":IdPaciente",$IdPaciente);
        return($statement->execute())? $statement->fetch():false;
    }
    public function eliminar($IdAtencion){
        $statement=$this->PDO->prepare("DELETE FROM AtencionPaciente WHERE IdAtencion=:IdAtencion;");
        $statement->bindParam(":IdAtencion",$IdAtencion);
        return($statement->execute())? true:false;

    }
    public function modificarAtencPaciente($IdAtencion, $MotivoConsulta,$FormaContacto,$Diagnostico, $Tratamiento, $Observacion, $UltimosObjetivos) {
      
        $statement = $this->PDO->prepare("UPDATE AtencionPaciente SET MotivoConsulta=:MotivoConsulta,FormaContacto=:FormaContacto,Diagnostico=:Diagnostico, Tratamiento=:Tratamiento, Observacion=:Observacion, UltimosObjetivos=:UltimosObjetivos WHERE IdAtencion=:IdAtencion");
        $statement->bindParam(":IdAtencion",$IdAtencion);
        $statement->bindParam(":MotivoConsulta",$MotivoConsulta);
        $statement->bindParam(":FormaContacto",$FormaContacto);
        $statement->bindParam(":Diagnostico",$Diagnostico);
        $statement->bindParam(":Tratamiento",$Tratamiento);
        $statement->bindParam(":Observacion",$Observacion);
        $statement->bindParam(":UltimosObjetivos",$UltimosObjetivos);
    
        return ($statement->execute())? $this->PDO->lastInsertId():false;
    }
}
?>