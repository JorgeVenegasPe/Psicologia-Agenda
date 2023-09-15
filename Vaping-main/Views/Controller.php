<?php
$categoria = ''; // Valor predeterminado vacío

// Verifica si se proporcionó un ID en la URL
if (isset($_GET['action']) && $_GET['action'] === 'select' && isset($_GET['id'])) {
    $categoriaSeleccionada = $_GET['id'];
    
    // Asigna el valor de $categoriaSeleccionada a $categoria
    $categoria = $categoriaSeleccionada;
    
    // Puedes realizar acciones adicionales aquí si es necesario
    
    // Por ejemplo, podrías redirigir al usuario a una página específica según la selección
    if ($categoriaSeleccionada === '1') {
        header('Location: Pods.php?id=' . $categoria);
        exit();
    } elseif ($categoriaSeleccionada === '2') {
        header('Location: Vapers.php?id=' . $categoria);
        exit();
    }
    
    // También puedes cargar vistas relacionadas con la selección aquí
    // Por ejemplo: include 'VistaSeleccionada.php';
    
} else {
    echo 'No se ha seleccionado ningún ID.';
}

?>