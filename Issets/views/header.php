<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../issets/css/header.css" >
	<link href="https://cdn.jsdelivr.net/npm/remixicon@2.5.0/fonts/remixicon.css" rel="stylesheet" />

    <title>Document</title>
</head>
<body>
	<style>
		html {
		scroll-behavior: smooth;
	}
	</style>
    <header class="primary-header2">
	<nav class="navbar2 container1">
		<a class="logo">Psicologa</a>
		<input type="checkbox" id="toggler" />
		<label for="toggler"><i class="ri-menu-line"></i></label>
		<div class="menu">
			<ul class="nav-list1 e">
					<li><a href="./CalendarioCitas.php" class="nav-link1 a">Calendario</a></li>
					<li><a href="./RegFamiliar.php" class="nav-link1 a">Registro Familiar</a></li>
					<li><a href="./citas.php" class="nav-link1 a">Citas</a></li>
					<li><a href="./AtenPaciente.php" class="nav-link1 a">Atencion al Paciente</a></li>
					<li><a href="./RegDatosPaciente.php" class="nav-link1 a">Datos del Paciente</a></li>
					<li><a href="./RegDatosPaciente.php" class="nav-link1 b">Volver</a></li>
					<li><a href="../Issets/views/Salir.php" class="nav-link1 a">Cerrar Sesion</a></li>
			</ul>
		</div>
</nav>
</header>
<script>
			const isScrolling = () => {
				const headerEl = document.querySelector('.primary-header')
				let windowPosition = window.scrollY > 20
				headerEl.classList.toggle('active', windowPosition)
			}
			window.addEventListener('scroll', isScrolling)
		</script>
</body>
</html>
