<?php
class userModelPaciente{
    private $PDO;
    public function __construct()
    {
        require_once("C:/xampp/htdocs/Psicologia-Agenda-Clinica-master/Conexion/conexion.php");
        $con=new conexion();
        $this->PDO=$con->conexion();

    }
    public function GuardarPaciente($NomPaciente, $ApPaterno, $ApMaterno, $Dni, $FechaNacimiento, $Edad,$GradoInstruccion, $Ocupacion, $EstadoCivil,$Genero,$Telefono, $Email, $Direccion,$AntecedentesMedicos,$IdPsicologo,$MedicamentosPrescritos) {
        $NomPaciente = $_POST['NomPaciente'];
        $ApPaterno = $_POST['ApPaterno'];
        $ApMaterno = $_POST['ApMaterno'];
        $Dni = $_POST['Dni'];
        $FechaNacimiento = $_POST['FechaNacimiento'];
        $Edad = $_POST['Edad'];
        $GradoInstruccion = $_POST['GradoInstruccion'];
        $Ocupacion = $_POST['Ocupacion'];
        $EstadoCivil = $_POST['EstadoCivil'];
        $Genero = $_POST['Genero'];
        $Telefono = $_POST['Telefono'];
        $Email = $_POST['Email'];
        $Direccion = $_POST['Direccion'];
        $AntecedentesMedicos = $_POST['AntecedentesMedicos'];
        $IdPsicologo = $_POST['IdPsicologo'];
        $MedicamentosPrescritos = $_POST['MedicamentosPrescritos'];
        $statement=$this->PDO->prepare("INSERT INTO Paciente(NomPaciente, ApPaterno, ApMaterno, Dni, FechaNacimiento, Edad,
         GradoInstruccion, Ocupacion, EstadoCivil, Genero,Telefono, Email, Direccion, AntecedentesMedicos,IdPsicologo,MedicamentosPrescritos) 
         VALUES(:NomPaciente, :ApPaterno, :ApMaterno, :Dni, :FechaNacimiento, :Edad, :GradoInstruccion, 
         :Ocupacion, :EstadoCivil, :Genero, :Telefono, :Email, :Direccion, :AntecedentesMedicos, :IdPsicologo,:MedicamentosPrescritos)");
        $array = array($NomPaciente, $ApPaterno, $ApMaterno, $Dni, $FechaNacimiento, $Edad,$GradoInstruccion, $Ocupacion, $EstadoCivil,$Genero,$Telefono, $Email, $Direccion,$AntecedentesMedicos,$IdPsicologo,$MedicamentosPrescritos);
        $statement->bindParam(":NomPaciente",$NomPaciente);
        $statement->bindParam(":ApPaterno",$ApPaterno);
        $statement->bindParam(":ApMaterno",$ApMaterno);
        $statement->bindParam(":Dni",$Dni);
        $statement->bindParam(":FechaNacimiento",$FechaNacimiento);
        $statement->bindParam(":Edad",$Edad);
        $statement->bindParam(":GradoInstruccion",$GradoInstruccion);
        $statement->bindParam(":Ocupacion",$Ocupacion);
        $statement->bindParam(":EstadoCivil",$EstadoCivil);
        $statement->bindParam(":Genero",$Genero);
        $statement->bindParam(":Telefono",$Telefono);
        $statement->bindParam(":Email",$Email);
        $statement->bindParam(":Direccion",$Direccion);
        $statement->bindParam(":AntecedentesMedicos",$AntecedentesMedicos);
        $statement->bindParam(":IdPsicologo",$IdPsicologo);
        $statement->bindParam(":MedicamentosPrescritos",$MedicamentosPrescritos);
    
        return ($statement->execute())? $this->PDO->lastInsertId():false;
    }
    public function ver($IdPsicologo) {
        $statement = $this->PDO->prepare("SELECT * FROM Paciente WHERE IdPsicologo = :IdPsicologo ");
        $statement->bindValue(':IdPsicologo', $IdPsicologo);
        return ($statement->execute()) ? $statement->fetchAll() : false;
    }
    public function show($IdPaciente){
        $statement=$this->PDO->prepare("SELECT * FROM Paciente where IdPaciente = :IdPaciente limit 1");
        $statement->bindParam(":IdPaciente",$IdPaciente);
        return($statement->execute())? $statement->fetch():false;

    }
    public function eliminar($IdPaciente){
        $statement=$this->PDO->prepare("DELETE FROM Paciente WHERE IdPaciente=:id;");
        $statement->bindParam(":id",$IdPaciente);
        return($statement->execute())? true:false;

    }
    public function modificarPaciente($IdPaciente,$NomPaciente, $ApPaterno, $ApMaterno, $Dni, $FechaNacimiento, $Edad,$GradoInstruccion, $Ocupacion, $EstadoCivil,$Genero,$Telefono, $Email, $Direccion,$AntecedentesMedicos,$MedicamentosPrescritos) {
        $statement = $this->PDO->prepare("UPDATE Paciente SET NomPaciente=:NomPaciente, ApPaterno=:ApPaterno, ApMaterno=:ApMaterno,
        Dni=:Dni,FechaNacimiento=:FechaNacimiento,Edad=:Edad, GradoInstruccion=:GradoInstruccion, Ocupacion=:Ocupacion, EstadoCivil=:EstadoCivil, Genero=:Genero,
        Telefono=:Telefono, Email=:Email, Direccion=:Direccion, AntecedentesMedicos=:AntecedentesMedicos, MedicamentosPrescritos=:MedicamentosPrescritos WHERE IdPaciente=:IdPaciente");
        $statement->bindParam(":IdPaciente",$IdPaciente);
        $statement->bindParam(":NomPaciente",$NomPaciente);
        $statement->bindParam(":ApPaterno",$ApPaterno);
        $statement->bindParam(":ApMaterno",$ApMaterno);
        $statement->bindParam(":Dni",$Dni);
        $statement->bindParam(":FechaNacimiento",$FechaNacimiento);
        $statement->bindParam(":Edad",$Edad);
        $statement->bindParam(":GradoInstruccion",$GradoInstruccion);
        $statement->bindParam(":Ocupacion",$Ocupacion);
        $statement->bindParam(":EstadoCivil",$EstadoCivil);
        $statement->bindParam(":Genero",$Genero);
        $statement->bindParam(":Telefono",$Telefono);
        $statement->bindParam(":Email",$Email);
        $statement->bindParam(":Direccion",$Direccion);
        $statement->bindParam(":AntecedentesMedicos",$AntecedentesMedicos);
        $statement->bindParam(":MedicamentosPrescritos",$MedicamentosPrescritos);
        return ($statement->execute())? $this->PDO->lastInsertId():false;
    }
    public function MostrarPacientesRecientes($idPsicologo) {
        $statement = $this->PDO->prepare("SELECT NomPaciente, ApMaterno, ApPaterno, Edad, FechaRegistro FROM paciente 
        WHERE IdPsicologo = :idPsicologo
        ORDER BY IdPaciente DESC LIMIT 4");
        $statement->bindParam(":idPsicologo", $idPsicologo);        
        return ($statement->execute()) ? $statement->fetchAll() : false;
    }    
}
?>