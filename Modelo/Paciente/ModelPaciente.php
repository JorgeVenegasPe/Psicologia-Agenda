<?php
class userModelPaciente{
    private $PDO;
    public function __construct()
    {
        require_once("C:/xampp/htdocs/Psicologia-Agenda-Clinica-master/Conexion/conexion.php");
        $con=new conexion();
        $this->PDO=$con->conexion();

    }
    private function generarCodigoPaciente($IdPaciente) {
        $prefijo = 'PA';
        $idPacienteFormateado = str_pad($IdPaciente, 4, '0', STR_PAD_LEFT);
        $codigoPaciente = $prefijo . $idPacienteFormateado;
        return $codigoPaciente;
    }
    // Método para guardar un nuevo paciente con el código generado automáticamente
    public function GuardarPaciente($NomPaciente, $ApPaterno, $ApMaterno, $Dni, $FechaNacimiento, $Edad, $GradoInstruccion, $Ocupacion, $EstadoCivil, $Genero, $Telefono, $Email, $Direccion, $AntecedentesMedicos, $IdPsicologo, $MedicamentosPrescritos,$IdProvincia,$IdDepartamento,$IdDistrito)
    {
        $statement = $this->PDO->prepare("INSERT INTO Paciente(NomPaciente, ApPaterno, ApMaterno, Dni, FechaNacimiento, Edad,
         GradoInstruccion, Ocupacion, EstadoCivil, Genero, Telefono, Email, Direccion, AntecedentesMedicos, IdPsicologo, MedicamentosPrescritos,IdProvincia,IdDepartamento,IdDistrito) 
         VALUES(:NomPaciente, :ApPaterno, :ApMaterno, :Dni, :FechaNacimiento, :Edad, :GradoInstruccion, 
         :Ocupacion, :EstadoCivil, :Genero, :Telefono, :Email, :Direccion, :AntecedentesMedicos, :IdPsicologo, :MedicamentosPrescritos,:IdProvincia,:IdDepartamento,:IdDistrito)");

        $statement->bindParam(":NomPaciente", $NomPaciente);
        $statement->bindParam(":ApPaterno", $ApPaterno);
        $statement->bindParam(":ApMaterno", $ApMaterno);
        $statement->bindParam(":Dni", $Dni);
        $statement->bindParam(":FechaNacimiento", $FechaNacimiento);
        $statement->bindParam(":Edad", $Edad);
        $statement->bindParam(":GradoInstruccion", $GradoInstruccion);
        $statement->bindParam(":Ocupacion", $Ocupacion);
        $statement->bindParam(":EstadoCivil", $EstadoCivil);
        $statement->bindParam(":Genero", $Genero);
        $statement->bindParam(":Telefono", $Telefono);
        $statement->bindParam(":Email", $Email);
        $statement->bindParam(":Direccion", $Direccion);
        $statement->bindParam(":AntecedentesMedicos", $AntecedentesMedicos);
        $statement->bindParam(":IdPsicologo", $IdPsicologo);
        $statement->bindParam(":MedicamentosPrescritos", $MedicamentosPrescritos);
        $statement->bindParam(":IdProvincia", $IdProvincia);
        $statement->bindParam(":IdDepartamento", $IdDepartamento);
        $statement->bindParam(":IdDistrito", $IdDistrito);

        $id = ($statement->execute()) ? $this->PDO->lastInsertId() : false;

        if ($id !== false) {
            // Genera el código del paciente utilizando el IdPaciente
            $codigoPaciente = $this->generarCodigoPaciente($id);

            // Actualiza la columna CodigoPaciente en la base de datos con el código generado
            $this->actualizarCodigoPaciente($id, $codigoPaciente);
        }

        return $id;
    }
    // Método para actualizar el código del paciente en la base de datos
    private function actualizarCodigoPaciente($IdPaciente, $codigoPaciente) {
        $statement = $this->PDO->prepare("UPDATE Paciente SET CodigoPaciente = :codigoPaciente WHERE IdPaciente = :IdPaciente");
        $statement->bindParam(":IdPaciente", $IdPaciente);
        $statement->bindParam(":codigoPaciente", $codigoPaciente);
        return $statement->execute();
    }
    public function ver($IdPsicologo) {
        $statement = $this->PDO->prepare("SELECT * FROM Paciente WHERE IdPsicologo = :IdPsicologo ");
        $statement->bindValue(':IdPsicologo', $IdPsicologo);
        return ($statement->execute()) ? $statement->fetchAll() : false;
    }
    public function show($IdPaciente){
        $statement=$this->PDO->prepare("SELECT p.IdPaciente,p.CodigoPaciente, p.NomPaciente, p.ApPaterno, p.ApMaterno, p.Dni, p.FechaNacimiento, p.Edad, p.GradoInstruccion, p.Ocupacion, p.EstadoCivil,p.Genero, p.Telefono,
         p.Email, p.Direccion, p.AntecedentesMedicos, p.IdPsicologo, p.MedicamentosPrescritos, de.name, di.name, pr.name 
         FROM paciente p 
         inner join departamento de on de.id = p.IdDepartamento
         inner join distrito di on di.id = p.IdDistrito
         inner join provincia pr on pr.id = p.IdProvincia
        where p.IdPaciente = :IdPaciente limit 1");
        $statement->bindParam(":IdPaciente",$IdPaciente);
        return($statement->execute())? $statement->fetch():false;

    }
    public function eliminar($IdPaciente){
        $statement=$this->PDO->prepare("DELETE FROM Paciente WHERE IdPaciente=:id;");
        $statement->bindParam(":id",$IdPaciente);
        return($statement->execute())? true:false;

    }
    public function modificarPaciente($IdPaciente,$NomPaciente, $ApPaterno, $ApMaterno, $Dni, $FechaNacimiento, $Edad,$GradoInstruccion, $Ocupacion, $EstadoCivil,$Genero,$Telefono, $Email, $Direccion,$AntecedentesMedicos,$MedicamentosPrescritos,$IdProvincia,$IdDepartamento,$IdDistrito) {
        $statement = $this->PDO->prepare("UPDATE Paciente SET NomPaciente=:NomPaciente, ApPaterno=:ApPaterno, ApMaterno=:ApMaterno,
        Dni=:Dni,FechaNacimiento=:FechaNacimiento,Edad=:Edad, GradoInstruccion=:GradoInstruccion, Ocupacion=:Ocupacion, EstadoCivil=:EstadoCivil, Genero=:Genero,
        Telefono=:Telefono, Email=:Email, Direccion=:Direccion, AntecedentesMedicos=:AntecedentesMedicos, MedicamentosPrescritos=:MedicamentosPrescritos,
        IdProvincia=:IdProvincia, IdDepartamento=:IdDepartamento, IdDistrito=:IdDistrito WHERE IdPaciente=:IdPaciente");
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
        $statement->bindParam(":IdProvincia",$IdProvincia);
        $statement->bindParam(":IdDepartamento",$IdDepartamento);
        $statement->bindParam(":IdDistrito",$IdDistrito);

        return ($statement->execute())? $this->PDO->lastInsertId():false;
    }
    public function MostrarPacientesRecientes($idPsicologo) {
        $statement = $this->PDO->prepare("SELECT NomPaciente, ApMaterno, ApPaterno, Edad,CodigoPaciente, FechaRegistro FROM paciente 
        WHERE IdPsicologo = :idPsicologo
        ORDER BY IdPaciente DESC LIMIT 4");
        $statement->bindParam(":idPsicologo", $idPsicologo);        
        return ($statement->execute()) ? $statement->fetchAll() : false;
    }   
    public function MostrarDepartamento(){
        $statement = $this->PDO->prepare("SELECT * FROM departamento");  
        return ($statement->execute()) ? $statement->fetchAll() : false;
    }
    public function DatosPsicologo($idPsicologo){
        $statement = $this->PDO->prepare("SELECT * FROM psicologo 
        where IdPsicologo = :idPsicologo");  
        $statement->bindParam(":idPsicologo", $idPsicologo);        
        return ($statement->execute()) ? $statement->fetchAll() : false;
    }
    //Nueva funcion creada para llamar a los pacientes y areafamiliar en una consulta
    public function getPatientAndFamilyInfo($IdPsicologo) {
        $statement = $this->PDO->prepare("
            SELECT p.*, af.IdFamiliar, af.NomPadre, af.EstadoPadre, af.NomMadre, af.EstadoMadre, af.NomApoderado, af.EstadoApoderado, af.CantHermanos, af.CantHijos, af.IntegracionFamiliar, af.HistorialFamiliar
            FROM Paciente p
            INNER JOIN AreaFamiliar af ON p.IdPaciente = af.IdPaciente
            WHERE p.IdPsicologo = :IdPsicologo
        ");
        
        $statement->bindValue(':IdPsicologo', $IdPsicologo);
        
        return ($statement->execute()) ? $statement->fetchAll() : false;
    }
}
