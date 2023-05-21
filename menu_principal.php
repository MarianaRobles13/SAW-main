<?php
	include_once 'Conexion.php';

	session_start ();

	if(!isset($_SESSION['troles'])) {
		include 'Actions/IniciarSesion/MenuPrincipal.php';
		include 'Actions/Registrar/RegistroUsuario.php';
	}
	
 ?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
	<title>Pastelería Fantasy of Love</title>
	<?php
    if(isset($_SESSION['troles'])){
    ?>
		<link rel="stylesheet" type="text/css" href="Estilos/estilo_main.css"><!--Con iniciar sesion-->
	<?php
	}else{
	?>
		<link rel="stylesheet" type="text/css" href="Estilos/estilo_main2.css"><!--Sin iniciar sesion-->
		<link rel="stylesheet" type="text/css" href="Estilos/regist_usuario.css"><!--Sin iniciar sesion-->
		<link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap" rel="stylesheet"><!--Sin iniciar sesion-->
	<?php
	}
	?>
	<link rel="stylesheet" type="text/css" href="fontawesome/css/all.css">
	<link rel="shortcut icon" href="Imagenes/favicon.ico">
	
	<link href="Estilos/Bootstrap_min_5_1_3.css" rel="stylesheet">
	<script src="js/bootstrap_5_1_3_bundle_min.js"></script>
	<link rel="stylesheet" href="Estilos/Botstrap_icons_1_4_0.css">
	<link rel="stylesheet" href="Estilos/main.css">
	<script src="js/jquery_latest.js"></script>
	<script src="js/menu.js"></script>

</head>
<!--<body  onload="myFunction()">-- QUITAR COMENTARIO-->
<body>
<!--<div id="loader"></div>-- QUITAR COMENTARIO-->
<!-------------------------------------------------- CABECERA -------------------------------------------------------------->
		<span class="arriba" name="arriba"><i class="fa-solid fa-circle-chevron-up"></i></span>
		<a id="botonchatbot">
			<span class="chatbot" name="chatbot"><i class="fa-solid fa-comment"></i></span>
		</a>
		
		<?php
        if(isset($_SESSION['troles'])){
        ?>
			<div class="ventana" id="vent">
				<div id="close"><a href="javascript:cerrar()"><img id="close_img" src="Imagenes/close.png"></a></div>
				<div id="usuario"><?php echo "" . $_SESSION["Username"]; echo "";?></div>
				<?php 
					if ($_SESSION['troles'] == 1) {
				?>
						<div id="backend"><a href="Backend.php">Backend</a></div>
				<?php } ?>
				<div id="backend"><a href="Lista_pedidos_usuarios.php">Pedidos</a></div>
				<div id="cerrar"><a href="cerrarsesion.php?action=logout">Cerrar sesión</a></div>
			</div>
		<?php    
        }else{
        ?>
			<div class="ventana" id="vent">
				<div id="iniciar" data-bs-toggle="modal" data-bs-target="#myModal"><a href="#">Iniciar sesión</a></div>
				<div id="regist" data-bs-toggle="modal" data-bs-target="#myModal2"><a href="#">Registrarse</a></div>
				<div id="close"><a href="javascript:cerrar()"><img id="close_img" src="Imagenes/close.png"></a></div>
			</div>
		<?php
        }
        ?> 
		
<!--<div class="animate-bottom" id="myDiv">-- QUITAR COMENTARIO-->
	<div>


<header>
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-6 col-md-6">

                        <nav class="navbar navbar-expand-xl navbar-light" id="cabecera">
                            <div class="container-fluid">

                                <a href="menu_principal.php" class="navbar-brand">
                                    <img src="Imagenes/logo_pasteleria.png" alt="logo" class="img" style="width: 80px; height:auto;"/>
                                </a>
                                
                                <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false"
                                    aria-label="Toggle navigation">
                                    <span class="navbar-toggler-icon"></span>
                                </button>
                                
                                <div class="collapse navbar-collapse" id="navbarNavDropdown">

                                    <ul class="navbar-nav mx-auto" id="menuresponsive">
                                        <li class="nav-item">
                                            <a id="op_menu" class="nav-link active" aria-current="page" href="pagina_nosotros.php">Nosotros</a>
                                        </li>

                                        <li id="list_menu" class="nav-item dropdown">
                                            <a id="op_menu" class="nav-link dropdown-toggle" id="navbarDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">Panadería</a>
                                            <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                                                <li><a class="dropdown-item" href="pagina_panaderia.php?#Panques">Panqués</a></li>
							                    <li><a class="dropdown-item" href="pagina_panaderia.php?#Galletas">Galletas</a></li>
							                    <li><a class="dropdown-item" href="pagina_panaderia.php?#Brownies">Brownies</a></li>
							                    <li><a class="dropdown-item" href="pagina_panaderia.php?#Donas">Donas</a></li>
                                            </ul>
                                        </li>

                                        <li id="list_menu" class="nav-item dropdown">
                                            <a id="op_menu" class="nav-link dropdown-toggle" id="navbarDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">Pastelería</a>
                                            <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                                                <li><a class="dropdown-item" href="pagina_pasteleria.php?#DeLinea">De línea</a></li>
						                        <li><a class="dropdown-item" href="pagina_pasteleria.php?#Personalizados">Personalizados</a></li>
                                            </ul>
                                        </li>

                                        <li id="list_menu" class="nav-item dropdown">
                                            <a id="op_menu" class="nav-link dropdown-toggle" id="navbarDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">Servicios</a>
                                            <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                                                <li><a class="dropdown-item" href="pagina_servicios.php?#Pinata">Piñatas</a></li>
						                        <li><a class="dropdown-item" href="pagina_servicios.php?#CandyBar">Candy Bar</a></li>
						                        <li><a class="dropdown-item" href="pagina_servicios.php?#Renta">Renta de mueble</a></li> 
                                            </ul>
                                        </li>

                                        <li class="nav-item">
                                            <a id="op_menu" class="nav-link" href="pagina_contacto.php">Contáctanos</a>
                                        </li>
                                    </ul>
                                </div>
                                
                            </div>
                        </nav>
                    </div>

                    <div class="col-lg-2 col-md-3 cart-login">
                        <div class="float-end">
                            <a href="javascript:abrir()">
                            <button type="button" class="btn btn-light mt-2 btn-sm">
                                <img class="img_2" src="Imagenes/logo_usuario.png" alt="Log in" style="width: 60px; height: auto;">
                            </button>
                            </a>
                        </div>
                    </div>

                </div>
            </div>
        </header>
<!--------------------------------------------- FIN DE LA CABECERA --------------------------------------------------------->		


<!-------------------------------------------------- CUERPO ---------------------------------------------------------------->
		<div id="cuerpo">
		<?php include_once 'bot/index.php'?>
			<!-------------------- SLIDER DE IMAGENES-------------------->
			<!-- Carousel -->
				<div id="demo" class="carousel slide" data-bs-ride="carousel">

			<!-- Indicators/dots -->
				<div class="carousel-indicators">
  					<button type="button" data-bs-target="#demo" data-bs-slide-to="0" class="active"></button>
  					<button type="button" data-bs-target="#demo" data-bs-slide-to="1"></button>
  					<button type="button" data-bs-target="#demo" data-bs-slide-to="2"></button>
				</div>

			<!-- The slideshow/carousel -->
				<div class="carousel-inner">
  					<div class="carousel-item active">
						<img src="Imagenes/pasteleria/carrusel_2.jpg" alt="Pastel" class="d-block" id="imagenes_carrusel">
  					</div>
  					<div class="carousel-item">
						<img src="Imagenes/pasteleria/carrusel_3.jpg" alt="Pastel_2" class="d-block" id="imagenes_carrusel">
  					</div>
  					<div class="carousel-item">
						<img src="Imagenes/pasteleria/carrusel_brownie.jpg" alt="Pastel_3" class="d-block" id="imagenes_carrusel">
  					</div>
				</div>

			<!-- Left and right controls/icons -->
				<button class="carousel-control-prev" type="button" data-bs-target="#demo" data-bs-slide="prev">
  					<span class="carousel-control-prev-icon"></span>
				</button>
				<button class="carousel-control-next" type="button" data-bs-target="#demo" data-bs-slide="next">
  					<span class="carousel-control-next-icon"></span>
				</button>
			</div>

			<div id="destacado">Productos destacados</div>
			<div id="productos_destacados">
			<?php
				include 'productos_destacados.php';
			?>
			</div>
		</div>
<!--------------------------------------------- FIN DEL CUERPO --------------------------------------------------------->


<!-------------------------------------------------- PIE --------------------------------------------------------------->
	<?php
		include 'Includes/footer.php';
	?>
<!----------------------------------------------- FIN DEL PIE ---------------------------------------------------------->
</div>


<!----------------------------------------- LOS MODALES ----------------------------------------->
	<?php
		include 'Includes/modales.php';/*--Sin iniciar sesion--*/
	?>
<!------------------------------------ FIN DE LOS MODALES --------------------------------------->


<!--JAVASCRIPT------------------------------------------------------------------>
	<script type="text/javascript">
/*---------Ventana de registro e iniciar sesion----------*/
		function abrir(){
			document.getElementById("vent").style.display="block";
		}

		function cerrar(){
			document.getElementById("vent").style.display="none";
		}
/*---Fin de Ventana de registro e iniciar sesion---------*/

/*-------------------Loader de pagina--------------------*/
		var myVar;

		function myFunction() {
  			myVar = setTimeout(showPage, 3000);
		}

		function showPage() {
  			document.getElementById("loader").style.display = "none";
 	 		document.getElementById("myDiv").style.display = "block";
		}
/*----------------Fin de loader pagina-------------------*/
	</script>
	
	<?php
    if(!isset($_SESSION['troles'])){
    ?>
		<script src="js/funcionesjavascript.js"></script>
	<?php
	}
	?>
<!--FIN DE JAVASCRIPT------------------------------------------------------------->

<!-- Option 1: BOOTSTRAP Bundle with Popper -------------------------------------->
		<script src="js/core.js"></script>
		<script src="js/main.js"></script>
	</body>
</html>