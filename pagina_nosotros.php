<?php 
	include_once 'Conexion.php';

	session_start ();

    if(!isset($_SESSION['troles'])) {
		include 'Actions/IniciarSesion/Nosotros.php';
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
<body>
<!-------------------------------------------------- CABECERA -------------------------------------------------------------->
		<span class="arriba" name="arriba"><i class="fa-solid fa-circle-chevron-up"></i></span>
		
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

			<div id="nosotros">
				<div><h1> Sobre Nosotros </h1></div>
				<p>
					En "Cupcake Fantasy of Love" nuestros clientes son nuestra mayor prioridad, 
					por esa razón contamos con una variedad de cremas, merengues y ganaches, 
					así como biscochos 100% elaborados a mano con ingredientres de la más alta calidad de los cuales garantizamos el sabor. 
					Encontraras todo lo que necesites para tus eventos en nuestro servicio de decoración. 
					Somos un negocio en crecimiento, con el objetivo de seguir adelante, 
					manteniendo la calidad de nuestros productos y de esa manera continuar entregando momentos de felicidad en esas fechas especiales, 
					donde se busca mostrar el afecto por los que queremos y que mejor manera de hacerlo regalandole algo de "Cupcake Fantasy of Love" 
					La fantasía del sabor.
				</p>

				<div id="ubicacion-horario">
					<div id="ubicacion">	
						<div id="ubi"><h1>Ubicación</h1></div>
						<div id="mapa">
 							<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d496.8070811953583!2d-105.27287599924823!3d20.6911761477183!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x8421468217fadb29%3A0x6322320b3a83f85b!2sAv%20Mexico%20100%2C%20Costa%20Coral%2C%2063735%20Las%20Jarretaderas%2C%20Nay.!5e0!3m2!1ses!2smx!4v1637981505754!5m2!1ses!2smx" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
						</div>
					</div>
				
					<div id="horario">
						<div id="hora"><h1>Horarios</h1></div>
						<div id="tabla_nosotros">
							<table>
								<tr>
									<th>Lunes</th>
									<th>Martes</th>
									<th>Miercoles</th>
									<th>Jueves</th>
									<th>Viernes</th>
									<th>Sabado</th>
									<th>Domingo</th>
								</tr>
								<tr>
									<td>Cerrado</td>
									<td>10:00am - 8:00pm</td>
									<td>10:00am - 8:00pm</td>
									<td>10:00am - 8:00pm</td>
									<td>10:00am - 8:00pm</td>
									<td>10:00am - 8:00pm</td>
									<td>9:00am - 12:00pm</td>
								</tr>	
							</table>
						</div>
					</div>
				</div>
			</div>

		</div>
<!--------------------------------------------- FIN DEL CUERPO --------------------------------------------------------->


<!-------------------------------------------------- PIE --------------------------------------------------------------->
	<?php
		include 'Includes/footer.php';
	?>
<!----------------------------------------------- FIN DEL PIE ---------------------------------------------------------->


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

/*----------------Barra de busqueda----------------*/ 
		var accent_map = {'á':'a', 'é':'e', 'è':'e', 'í':'i','ó':'o','ú':'u','Á':'a', 'É':'e', 'è':'e', 'Í':'i','Ó':'o','Ú':'u'};
		function accent_fold (s) {
  			if (!s) { return ''; }
  				var ret = '';
  			for (var i = 0; i < s.length; i++) {
    			ret += accent_map[s.charAt(i)] || s.charAt(i);
  			}
  			return ret;
		};

		$(document).ready(function(){
  			$("#tableSearch").on("keyup", function() {
    			var value = $(this).val().toLowerCase();
				var filter = accent_fold(value).toLowerCase();
    			$("#contenedor_tarjetas #tarjetas").filter(function() {
					$(this).toggle(accent_fold($(this).text()).toLowerCase().indexOf(filter) > -1)
    			});
  			});
		});
/*-------------Fin de barra de busqueda-------------*/
	</script>

	<?php
    if(!isset($_SESSION['troles'])){
    ?>
		<script src="js/funcionesjavascript.js"></script><!--Sin iniciar sesion-->
	<?php
	}
	?>
<!--FIN DE JAVASCRIPT------------------------------------------------------------->

<!-- Option 1: BOOTSTRAP Bundle with Popper -------------------------------------->
		<script src="js/core.js"></script>
		<script src="js/main.js"></script>
	</body>
</html>