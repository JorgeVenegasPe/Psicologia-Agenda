<?php
require '../Conexion/Conexion.php';
?>
<?php

class VentaModel
{
    private $conexion;

    public function __construct($conexion)
    {
        $this->conexion = $conexion;
    }

    public function insertarVenta($datos)
    {
        $tipoEntrega = $datos['tipo_entrega'];
        $productos = json_encode($datos['productos']);
        $total = $datos['valorTotal'];
        $nombreCliente = $datos['nombre_cliente'];
        $documentoTipo = $datos['documento_tipo'];
        $documentoNumero = $datos['documento_numero'];
        $correo = $datos['correo'];
        $celular = $datos['celular'];
        $distrito = $datos['distrito'];
        $direccion = $datos['direccion'];
        $referencia = $datos['referencia'];
        $aceptoTerminos = isset($datos['acepto_terminos']) ? 1 : 0;

        $query = "INSERT INTO ventas (tipo_entrega, productos, total, nombre_cliente, documento_tipo, documento_numero, correo, celular, distrito, direccion, referencia, acepto_terminos) 
                  VALUES ('$tipoEntrega', '$productos', '$total', '$nombreCliente', '$documentoTipo', '$documentoNumero', '$correo', '$celular', '$distrito', '$direccion', '$referencia', '$aceptoTerminos')";

        $result = mysqli_query($this->conexion, $query);

        if ($result) {
            return true;
        } else {
            return false;
        }
    }
}
