
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8"/>
  <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Vaping - Pods</title>
  <link rel="stylesheet" href="https://unpkg.com/boxicons@latest/css/boxicons.min.css" />
  <link rel="stylesheet" href="../Issets/css/main.css"/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta2/css/all.min.css">
  <link href="https://cdn.jsdelivr.net/npm/remixicon@2.5.0/fonts/remixicon.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@9/swiper-bundle.min.css"/>
</head>
<body>
  <!-- Header  -->
  <?php
  require("../Controllers/ControllerProducto.php");
  $obj = new usernameControlerProducto();
  $rows = $obj->VerProductoPods();
  require 'Header.php'
  ?>

  <!-- Carrusel  -->
  <main class="main">
    <div class="swiper carousel">
      <div class="swiper-wrapper">
        <?php if ($rows):?>
            <?php foreach ($rows as $row): ?>
              <div class="swiper-slide" >
                <div class="container-total">
                  <div class="container-imagen">
                    <img src="data:image/png;base64,<?= base64_encode($row[3]) ?>"/>
                  </div>
                  <div class="container-descrip">
                    <div class="descripcion">
                      <h1><?=$row[2]?></h1>
                      <p><?=$row[4]?></p>
                      <h2>S/.<?=$row[5]?></h2>
                    </div>
                    <div class="container-butt">
                      <button type="button" class="button-cantidad Añadir" >Añadir</button>
                      <button type="button" class="button-cantidad">Cantidad</button>
                    </div>
                  </div>
                </div>
              </div>
            <?php endforeach;?>
        <?php endif;?>
      </div>
        <button type="button" class="swiper-button-next"></button>
        <button type="button" class="swiper-button-prev"></button>
    </div>
  </main>

  <!-- ================ Modals ================================  -->
  
  <!-- Modal Añadido al Carrito -->
  <div class="modal" id="myModal">
    <div class="modal-content">
      <div class="checkmark-container">
        <svg class="checkmark" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 52 52">
          <circle class="checkmark-circle" cx="26" cy="26" r="25" fill="none" />
          <path class="checkmark-check" d="M14.1 27.2l7.1 7.2 16.7-16.8" />
        </svg>
      </div>
      <p class="added-text"></p>
    </div>
  </div>

  <!-- Redes Sociales -->
  <div class="icons-redes">
    <a href="#" class="icon icon--instagram">
      <i class="ri-instagram-line"></i>
    </a>
    <a href="#" class="icon icon--facebook">
      <i class="ri-facebook-line"></i>
    </a>
    <a href="#" class="icon icon--whatsapp">
      <i class="ri-whatsapp-line"></i>
    </a>
  </div>
  
  <!-- Ajustes General -->
  <div class="container">
    <input type="checkbox" id="btn-mas">
      <div class="class">
        <a class="icon-link">
					<i class="ri-secure-payment-line"></i>
          <span class="icon-text">Terminos y Condiciones </span>
        </a>
        <a href="#" class="icon-link libro-reclamacion">
          <i class="ri-book-open-fill"></i>
          <span class="icon-text">Libro de Reclamación</span>
        </a>
        <a class="icon-link">
          <i class="ri-shield-fill"></i>
          <span class="icon-text">Politicas de Privacidad</span>
        </a>
      </div>
      <div class="btn-mas">
        <label for="btn-mas" class="ri-add-line"></label>
      </div>
  </div>

  <!-- Libro de reclamaciones -->
  <div class="service-modal modalformlb flex-center">
    <?php
    require 'LibroReclamacion.php';
    ?>
  </div>

  <script type="text/javascript">
    (function () { 
      var ldk = document.createElement('script'); 
      ldk.type = 'text/javascript'; 
      ldk.async = true; 
      ldk.src = 'https://s.cliengo.com/weboptimizer/64d053e1e3a858003279d24e/64d053e3e3a858003279d251.js?platform=view_installation_code'; 
      var s = document.getElementsByTagName('script')[0]; 
      s.parentNode.insertBefore(ldk, s); 
    })();
  </script>
  
<script src="https://cdn.jsdelivr.net/npm/swiper@9/swiper-bundle.min.js"></script>
<script src="../Issets/js/main.js"></script>
<script>
  var swiper = new Swiper(".carousel", {
    navigation: {
      nextEl: ".swiper-button-next",
      prevEl: ".swiper-button-prev",
    },
    pagination: {
      el: ".swiper-pagination",
    },
  });

  const loginButton = document.getElementById('loginButton');
  const loginModal = document.getElementById('loginModal');

  // Asigna un controlador de eventos al botón de inicio de sesión
  loginButton.addEventListener('click', function() {

  // Muestra el modal
  loginModal.style.display = 'block';
  });
</script>
</body>
</html>