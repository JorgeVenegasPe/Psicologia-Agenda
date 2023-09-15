<?php
class UserModelAreaFamiliar{
    private $PDO;
    public function __construct()
    {
        require_once("C:/xampp/htdocs/Psicologia-Agenda-Clinica-master/Conexion/conexion.php");
        $con=new conexion();
        $this->PDO=$con->conexion();

    }
    public function insertarAreaFamiliar($IdPaciente, $NomPadre,$EstadoPadre, $NomMadre,$EstadoMadre, $NomApoderado,$EstadoApoderado,$CantHermanos,$CantHijos,$IntegracionFamiliar,$HistorialFamiliar) {
        $IdPaciente = $_POST['IdPaciente'];
        $NomPadre = $_POST['NomPadre'];
        $EstadoPadre = $_POST['EstadoPadre'];
        $NomMadre = $_POST['NomMadre'];
        $EstadoMadre = $_POST['EstadoMadre'];
        $NomApoderado = $_POST['NomApoderado'];
        $EstadoApoderado = $_POST['EstadoApoderado'];
        $CantHermanos = $_POST['CantHermanos'];
        $CantHijos = $_POST['CantHijos'];
        $IntegracionFamiliar = $_POST['IntegracionFamiliar'];
        $HistorialFamiliar = $_POST['HistorialFamiliar'];
        $statement=$this->PDO->prepare("INSERT INTO AreaFamiliar(IdPaciente, NomPadre, EstadoPadre, NomMadre, EstadoMadre, NomApoderado, EstadoApoderado, CantHermanos,CantHijos,IntegracionFamiliar,HistorialFamiliar) VALUES(:IdPaciente, :NomPadre, :EstadoPadre, :NomMadre, :EstadoMadre, :NomApoderado, :EstadoApoderado, :CantHermanos,:CantHijos,:IntegracionFamiliar,:HistorialFamiliar)");
        $array = array($IdPaciente, $NomPadre,$EstadoPadre, $NomMadre,$EstadoMadre, $NomApoderado,$EstadoApoderado,$CantHermanos,$CantHijos,$IntegracionFamiliar,$HistorialFamiliar);
        $statement->bindParam(":IdPaciente",$IdPaciente);
        $statement->bindParam(":NomPadre",$NomPadre);
        $statement->bindParam(":EstadoPadre",$EstadoPadre);
        $statement->bindParam(":NomMadre",$NomMadre);
        $statement->bindParam(":EstadoMadre",$EstadoMadre);
        $statement->bindParam(":NomApoderado",$NomApoderado);
        $statement->bindParam(":EstadoApoderado",$EstadoApoderado);
        $statement->bindParam(":CantHermanos",$CantHermanos);
        $statement->bindParam(":CantHijos",$CantHijos);
        $statement->bindParam(":IntegracionFamiliar",$IntegracionFamiliar);
        $statement->bindParam(":HistorialFamiliar",$HistorialFamiliar);

        return ($statement->execute())? $this->PDO->lastInsertId():false;
    }
    public function ver(){
        $statement=$this->PDO->prepare("SELECT * FROM AtencionPaciente");
        return($statement->execute())? $statement->fetchaLL():false;
    }
    public function showAreaFamiliar($IdPaciente){
        $statement=$this->PDO->prepare("SELECT af.IdFamiliar,af.IdPaciente,p.NomPaciente,af.NomPadre,af.EstadoPadre,af.NomMadre,af.EstadoMadre,af.NomApoderado,af.EstadoApoderado,af.CantHermanos,af.CantHijos,af.IntegracionFamiliar,af.HistorialFamiliar
        FROM AreaFamiliar af
        JOIN Paciente p ON af.IdPaciente = p.IdPaciente
        WHERE p.IdPaciente = :IdPaciente
        LIMIT 1 ");
        $statement->bindParam(":IdPaciente",$IdPaciente);
        return($statement->execute())? $statement->fetch():false;
    }
    public function eliminarAreaFamiliar($id){
        $statement=$this->PDO->prepare("DELETE FROM AreaFamiliar WHERE IdFamiliar=:id;");
        $statement->bindParam(":id",$id);
        return($statement->execute())? true:false;

    }
    public function ModificarAreaFamiliar($IdFamiliar,$NomPadre,$EstadoPadre, $NomMadre,$EstadoMadre, $NomApoderado,$EstadoApoderado,$CantHermanos,$CantHijos,$IntegracionFamiliar,$HistorialFamiliar) {
      
        $statement = $this->PDO->prepare("UPDATE AreaFamiliar SET NomPadre=:NomPadre,EstadoPadre=:EstadoPadre, NomMadre=:NomMadre, EstadoMadre=:EstadoMadre,NomApoderado=:NomApoderado, EstadoApoderado=:EstadoApoderado, CantHermanos=:CantHermanos, CantHijos=:CantHijos, IntegracionFamiliar=:IntegracionFamiliar, HistorialFamiliar=:HistorialFamiliar WHERE IdFamiliar=:IdFamiliar");
        $statement->bindParam(":IdFamiliar",$IdFamiliar);
        $statement->bindParam(":NomPadre",$NomPadre);
        $statement->bindParam(":EstadoPadre",$EstadoPadre);
        $statement->bindParam(":NomMadre",$NomMadre);
        $statement->bindParam(":EstadoMadre",$EstadoMadre);
        $statement->bindParam(":NomApoderado",$NomApoderado);
        $statement->bindParam(":EstadoApoderado",$EstadoApoderado);
        $statement->bindParam(":CantHermanos",$CantHermanos);
        $statement->bindParam(":CantHijos",$CantHijos);
        $statement->bindParam(":IntegracionFamiliar",$IntegracionFamiliar);
        $statement->bindParam(":HistorialFamiliar",$HistorialFamiliar);
    
        return ($statement->execute())? $this->PDO->lastInsertId():false;
    }
}
?>