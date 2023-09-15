<?php
require('../fpdf.php');

// Conexión a la base de datos
$conex = mysqli_connect("localhost", "root", "", "Vaping");

if (!$conex) {
    die("Error de conexión: " . mysqli_connect_error());
}

// Obtener el último venta_id de la tabla ventas2
$consulta_ultimo_id = "SELECT MAX(id) AS ultimo_id FROM ventas2";
$resultado_ultimo_id = mysqli_query($conex, $consulta_ultimo_id);

if ($row_ultimo_id = mysqli_fetch_assoc($resultado_ultimo_id)) {
    $venta_id = $row_ultimo_id['ultimo_id'];

    // Obtener los datos del registro que deseas mostrar en el reporte (cambia esto según tus necesidades)
    $consulta_datos = "SELECT * FROM ventas2 WHERE id = ?";
    $stmt_datos = mysqli_prepare($conex, $consulta_datos);
    mysqli_stmt_bind_param($stmt_datos, "d", $venta_id);
    mysqli_stmt_execute($stmt_datos);

    $resultado_datos = mysqli_stmt_get_result($stmt_datos);

    if ($row = mysqli_fetch_assoc($resultado_datos)) {
        // Crear el objeto PDF
        $pdf = new FPDF();
        $pdf->AddPage();
        
        // Configurar fuente y color del título
        $pdf->SetFont('Arial', 'B', 24);
        $pdf->SetTextColor(0, 0, 255); // Azul
        $pdf->Cell(0, 20, 'Informe de Venta', 0, 1, 'C');
        $pdf->Ln(10); // Espacio después del título
        
        // Configurar fuente y color del contenido
        $pdf->SetFont('Arial', '', 16);
        $pdf->SetTextColor(0, 0, 0); // Negro
        
        // Agregar los datos al PDF (cambia esto según tu estructura de datos)
        $pdf->Cell(0, 10, 'Nombre del Cliente: ' . $row['nombre_cliente'], 0, 1);
        $pdf->Cell(0, 10, 'Correo: ' . $row['correo'], 0, 1);
        $pdf->Cell(0, 10, 'Total: $' . $row['total'], 0, 1);
        // Agregar más datos aquí...
        
        // Agregar una línea separadora
        $pdf->SetLineWidth(0.5);
        $pdf->Line(10, $pdf->GetY(), 200, $pdf->GetY());
        $pdf->Ln(10); // Espacio después de la línea separadora
        
        // Aquí puedes agregar más datos de la venta, como fecha, hora, etc.

        // Generar el PDF
        $pdf->Output();
    } else {
        // No se encontraron datos para el ID proporcionado
        echo "No se encontraron datos para el ID proporcionado.";
    }

    mysqli_stmt_close($stmt_datos);
} else {
    // No se pudo obtener el último venta_id
    echo "No se pudo obtener el último venta_id.";
}

mysqli_close($conex);
?>
