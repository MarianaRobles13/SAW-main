<?php 
	session_start ();

 ?>

<?php 
	if (isset($_GET["id"])) {
		$id=$_GET["id"];
			
		require_once("Conexion.php");

		$consulta="SELECT id, TRoles_id FROM tusuarios WHERE id = $id";
		$result=mysqli_query($conexion, $consulta);
		$result_consult = mysqli_fetch_assoc($result);

		$consulta2="SELECT TRoles_id FROM tusuarios WHERE TRoles_id = 1";
		$result2=mysqli_query($conexion, $consulta2);

		if($_SESSION['user_id'] == $id){
			echo "<h2 id='error_eliminado'>No se puede eliminar el usuario con el que iniciaste sesión   <a class='btn' href='adm_usuarios.php'><button class='btn'>Aceptar</button></a></h2>";
		}else{
			if(mysqli_num_rows($result) < 2){
				if($result_consult['TRoles_id'] == 1){
					echo "<h2 id='error_eliminado'>No se puede eliminar, debe de haber al menos un administrador  <a class='btn' href='adm_usuarios.php'><button class='btn'>Aceptar</button></a></h2>";
				}else{
					$eliminar=mysqli_query($conexion, "DELETE tusuarios, temailusr, ttelefonosusr
													FROM `tusuarios`
													JOIN temailusr ON temailusr.TUsuarios_id = tusuarios.id
													JOIN ttelefonosusr ON ttelefonosusr.TUsuarios_id = tusuarios.id
													WHERE tusuarios.id = '$id'");

					echo "<h2 id='eliminado'>Datos eliminados con éxito  <a class='btn' href='adm_usuarios.php'><button class='btn'>Aceptar</button></a></h2>";
				}
			}else{
				$eliminar=mysqli_query($conexion, "DELETE tusuarios, temailusr, ttelefonosusr
													FROM `tusuarios`
													JOIN temailusr ON temailusr.TUsuarios_id = tusuarios.id
													JOIN ttelefonosusr ON ttelefonosusr.TUsuarios_id = tusuarios.id
													WHERE tusuarios.id = '$id'");

				echo "<h2 id='eliminado'>Datos eliminados con éxito  <a class='btn' href='adm_usuarios.php'><button class='btn'>Aceptar</button></a></h2>";
			}
		}
	}
?>


<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
	<title>Pastelería Fantasy of Love</title>
	<link rel="stylesheet" type="text/css" href="Estilos/estilo_main.css">
	<link rel="stylesheet" type="text/css" href="fontawesome/css/all.css">
	<link rel="shortcut icon" href="Imagenes/favicon.ico">
	
	<link href="Estilos/Bootstrap_5_0_0.css" rel="stylesheet">
	<link rel="stylesheet" href="Estilos/Botstrap_icons_1_4_0.css">
	<script src="js/jquery_latest.js"></script>
	<script src="js/menu.js"></script>
	<script src="js/functions.js"></script>

</head>
<body>

	<span class="arriba" name="arriba"><i class="fa-solid fa-circle-chevron-up"></i></span>

	<div class="ventana" id="vent">
			<div id="close"><a href="javascript:cerrar()"><img id="close_img" src="Imagenes/close.png"></a></div>
			<div id="usuario"><?php echo "" . $_SESSION["Username"]; echo "";?></div>
			<?php 
				if ($_SESSION['troles'] == 1) {
			?>
				<div id="main_menu"><a href="menu_principal.php">Menu Principal</a></div>
			<?php } ?>
			<div id="cerrar"><a href="cerrarsesion.php?action=logout">Cerrar sesión</a></div>
		</div>


		<nav class="navbar navbar-expand-lg navbar-light  p-1" id="cabecera">
		<div class="container">

			<a class="navbar-brand" href="Backend.php">
				<img class="imagen_1" src="Imagenes/logo_pasteleria.png" alt="Logo" >
			</a>

			<button class="navbar-toggler" type="button" data-bs-toggle="collapse"
				data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
				aria-label="Toggle navigation">
				<span class="navbar-toggler-icon"></span>
			</button>

			<div class="collapse navbar-collapse" id="navbarSupportedContent">

				<ul class="navbar-nav me-auto mb-2 mb-lg-0">
					<li class="nav-item">
						<a id="op_menu" class="nav-link" href="adm_usuarios.php">Regresar</a>
					</li>
				</ul>
			</div>

			<a class="navbar-brand-collapse w-1"  href="javascript:abrir()">
				<img class="imagen_2" src="Imagenes/logo_usuario.png" alt="Log in">
			</a>
		</div>
		</nav>

<!--JAVASCRIPT------------------------------------------------------------------>
		<script type="text/javascript">
			function abrir(){
				document.getElementById("vent").style.display="block";
			}

			function cerrar(){
				document.getElementById("vent").style.display="none";
			}
		</script>


<!-- Option 1: BOOTSTRAP Bundle with Popper -------------------------------------->
		<script src="js/bootstrap_5_0_0_bundle_min.js"></script>
		<script src="js/core.js"></script>
		<script src="js/main.js"></script>
	</body>
</html>
</body>
</html>