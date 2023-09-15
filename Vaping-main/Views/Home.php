<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vapers - Pods</title>
  <link rel="stylesheet" href="../Issets/css/main.css"/>
</head>
<body>
    <div class="container">
        <h2 class="title">Nuestros Productos</h2>
        <div class="content">
            <div class="pods">
                <!-- Enlace que llama al controlador con un parámetro "id" -->
                <a href="Controller.php?action=select&id=1" class="btn">
                    <h2 class="title">Pods</h2>
                    <img src="../Issets/img/pods/classic-tobacco.webp" class="img-pods">
                </a>
            </div>
            <div class="vapers">
                <!-- Enlace que llama al controlador con un parámetro "id" -->
                <a href="Controller.php?action=select&id=2" class="btn">
                    <h2 class="title">Vapers</h2> 
                    <img src="../Issets/img/relxEssential/neon-purple.webp" class="img-vapers">
                </a>
            </div>
        </div>
    </div>
</body>
</html>