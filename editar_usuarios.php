<?php 
	session_start ();

    if(!isset ($_SESSION['troles'])){
        header('Location: menu_principal.php');
    } else {
        if($_SESSION['troles'] != 1 AND $_SESSION['troles'] != 2){
            header('Location: menu_principal.php');
        }
    }


	include 'Conexion.php';
	if (isset($_POST["enviar"])) {
		$id = $_POST["id"];
		$Nombre=$_POST["Nombre"];
		$Apellido=$_POST["Apellido"];
		$Telefono=$_POST["Telefono"];
		$Email=$_POST["Email"];
		$Username=$_POST["Username"];
		$Contrasena=$_POST["Contrasena"];
		$CalleYNumero=$_POST["CalleYNumero"];
		$TPaises_id=$_POST["TPaises_id"];
		$TEstados_id=$_POST["TEstados_id"];
		$TCiudades_id=$_POST["TCiudades_id"];
		$TCPostales_id=$_POST["TCPostales_id"];
		$TColonias_id=$_POST["TColonias_id"];
		$TRoles_id=$_POST["TRoles_id"];
		
		include_once 'Conexion.php';

		$consulta="SELECT id, Username FROM tusuarios WHERE Username = '".$Username."'";
		$result=mysqli_query($conexion, $consulta);
		$exist_result_user=mysqli_fetch_assoc($result);

		if(mysqli_num_rows($result) == 1 AND $exist_result_user['id'] != $id){
			echo "<div id='exist_usuario'> Ya existe este nombre de usuario, ingrese otro</div>";
		}else{
			$actualizar=mysqli_query($conexion, "UPDATE tusuarios SET 
				Nombre = '$Nombre',
				Apellido = '$Apellido',
				Username = '$Username',
				Contrasena = '$Contrasena',
				CalleYNumero = '$CalleYNumero',
				TColonias_id = '$TColonias_id',
				TRoles_id = '$TRoles_id'
			WHERE
				id = '$id'
			");

			$actualizar2=mysqli_query($conexion, "UPDATE ttelefonosusr SET 
				Telefono = '$Telefono'
				WHERE
					TUsuarios_id='$id'
			");

			$actualizar3=mysqli_query($conexion, "UPDATE temailusr SET 
				Email = '$Email'
				WHERE
					TUsuarios_id = '$id'
			");

			$actualizar4=mysqli_query($conexion, "UPDATE tcolonias 
													INNER JOIN tusuarios ON tusuarios.TColonias_id = tcolonias.id SET 
				TCPostales_id = '$TCPostales_id'
				WHERE 
					TUsuarios.id = '$id'
			");

			$actualizar5=mysqli_query($conexion, "UPDATE tcpostales 
													INNER JOIN tcolonias ON tcolonias.TCPostales_id = tcpostales.id
													INNER JOIN tusuarios ON tusuarios.TColonias_id = tcolonias.id SET 
				TCiudades_id = '$TCiudades_id'
				WHERE 
					TUsuarios.id = '$id'
			");

			$actualizar6=mysqli_query($conexion, "UPDATE tciudades
													INNER JOIN tcpostales ON tcpostales.TCiudades_id = tciudades.id 
													INNER JOIN tcolonias ON tcolonias.TCPostales_id = tcpostales.id
													INNER JOIN tusuarios ON tusuarios.TColonias_id = tcolonias.id SET 
				TEstados_id = '$TEstados_id'
				WHERE 
					TUsuarios.id = '$id'
			");

			$actualizar7=mysqli_query($conexion, "UPDATE testados
													INNER JOIN tciudades ON tciudades.TEstados_id = testados.id 
													INNER JOIN tcpostales ON tcpostales.TCiudades_id = tciudades.id 
													INNER JOIN tcolonias ON tcolonias.TCPostales_id = tcpostales.id
													INNER JOIN tusuarios ON tusuarios.TColonias_id = tcolonias.id SET 
				TPaises_id = '$TPaises_id'
				WHERE 
					TUsuarios.id = '$id'
			");

			if($actualizar || $actualizar2 || $actualizar3 || $actualizar4 || $actualizar5 || $actualizar6 || $actualizar7)
			{
				if($_SESSION['user_id'] == $id){
					if($_SESSION['Username'] == $Username AND $_SESSION['troles'] != $TRoles_id){
						header('Location: cerrarsesion.php?action=logout');
					}else if($_SESSION['Username'] != $Username AND $_SESSION['troles'] == $TRoles_id){
						header('Location: cerrarsesion.php?action=logout');
					}else{
						echo "<h2 id='producto_edit'>Usuario actualizado correctamente</h2>";
					}
				}else{
					echo "<h2 id='producto_edit'>Usuario actualizado correctamente</h2>";
				}


				//echo "<h2 id='producto_edit'>Usuario actualizado correctamente</h2>";
			}else{
				echo "<h2 id='producto_error'>Error al modificar usuario</h2>";
			}
		}
	}

	//VALIDAR DATOS
	if(empty($_REQUEST['id'])){
		header("location: adm_usuarios.php");
	} else{
		
		$id = $_REQUEST['id'];
		if(!is_numeric($id)){
			header("location: adm_usuarios.php");
		}

		$query_producto = mysqli_query($conexion, "SELECT tusuarios.id, tusuarios.Nombre, tusuarios.Apellido, tusuarios.Username, tusuarios.Contrasena, tusuarios.CalleYNumero, tusuarios.TColonias_id, tusuarios.TRoles_id,
														  temailusr.Email, ttelefonosusr.Telefono, tcolonias.Colonia,  tcolonias.TCPostales_id, tcpostales.CPostal, tcpostales.TCiudades_id, tciudades.Ciudad, tciudades.TEstados_id,
                                                          testados.Estado, testados.TPaises_id, tpaises.Pais, troles.Rol 
													FROM tusuarios
													INNER JOIN troles ON tusuarios.TRoles_id = troles.id 
													INNER JOIN temailusr ON temailusr.TUsuarios_id = tusuarios.id
											        INNER JOIN ttelefonosusr ON ttelefonosusr.TUsuarios_id = tusuarios.id
											        INNER JOIN tcolonias ON tusuarios.TColonias_id = tcolonias.id
											        INNER JOIN tcpostales ON tcolonias.TCPostales_id = tcpostales.id 
											        INNER JOIN tciudades ON tcpostales.TCiudades_id = tciudades.id 
											        INNER JOIN testados ON tciudades.TEstados_id = testados.id
                                                    INNER JOIN tpaises ON testados.TPaises_id = tpaises.id
													WHERE tusuarios.id = $id");
		$result_producto = mysqli_num_rows($query_producto);

		if($result_producto > 0){
			$data_producto = mysqli_fetch_assoc($query_producto);
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
	<!--<span class="arriba" name="arriba"><i class="fa-solid fa-circle-chevron-up"></i></span>-->

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

	
		<div id="cuerpo">
			<div id="tabla_actualizar">
                <form action="#" method="POST">
				<input type="hidden" name="id" value="<?php echo $data_producto['id']; ?>">
                <fieldset>
					<table>
                        <tr>
							<td colspan="2"><label><h1>Modificar usuario</h1></label></td>
						</tr>	
						<tr>
                            <td><label for="Nombre">Nombre:</label></td>
							<td><input class="input" type="text" name="Nombre" id="Nombre" value="<?php echo $data_producto['Nombre']; ?>" required></td>
                         </tr>
						<tr>
                            <td><label for="Apellido">Apellido:</label></td>
							<td><input class="input" type="text" name="Apellido" id="Apellido" value="<?php echo $data_producto['Apellido']; ?>" required></td>
                        </tr>
						<tr>
                            <td><label for="Telefono">Numero Telefonico:</label></td>
							<td><input class="input" type="number" name="Telefono" id="Telefono" value="<?php echo $data_producto['Telefono']; ?>" required></td>
                        </tr>
						<tr>
                            <td><label for="Email">Correo Electronico:</label></td>
							<td><input class="input" type="text" name="Email" id="Email" value="<?php echo $data_producto['Email']; ?>" required></td>
                        </tr>
						<tr>
                            <td><label for="Username">Nombre de usuario:</label><div style="width: 338px; font-size: 12px;">(Si se modifica el nombre de usuario se tendrá que iniciar sesión nuevamente; Si es tu propio usuario te cerrará sesión.)</div></td>
							<td><input class="input" type="text" name="Username" id="Username" value="<?php echo $data_producto['Username']; ?>" required></td>
                        </tr>
						<tr>
                            <td><label for="Contrasena">Contraseña:</label></td>
							<td><input class="input" type="text" name="Contrasena" id="Contrasena" value="<?php echo $data_producto['Contrasena']; ?>" required></td>
                        </tr>
						<tr>
							<td><label id="Pais">Pais:</label></td>
							<td>
                                <div id="content-select">
								    <?php 
								    $query_pais = mysqli_query($conexion, "SELECT id, Pais FROM tpaises");
								    $result_pais = mysqli_num_rows($query_pais);
								    ?>
								    <select class="notItemOne" name="TPaises_id" id="TPaises_id">
                                        <option value="<?php echo $data_producto['TPaises_id']; ?>" selected><?php echo $data_producto['Pais']; ?></option>
								    <?php
								    if($result_pais > 0){
								    	while($tpaises = mysqli_fetch_array($query_pais)){
								    ?>
								    	<option value="<?php echo $tpaises['id']; ?>"><?php echo $tpaises['Pais']; ?></option>
								    <?php
								    	}
								    }
								    ?>
								    </select>
                                </div>
							</td>	  
                        </tr>
						<tr>
                            <td><label id="Estado">Estado:</label></td>
							<td>
                                <div id="content-select">
								    <?php 
								    $query_estado = mysqli_query($conexion, "SELECT id, Estado FROM testados");
								    $result_estado = mysqli_num_rows($query_estado);
								    ?>
								    <select class="notItemOne" name="TEstados_id" id="TEstados_id">
                                        <option value="<?php echo $data_producto['TEstados_id']; ?>" selected><?php echo $data_producto['Estado']; ?></option>
								    <?php
								    if($result_estado > 0){
								    	while($testados = mysqli_fetch_array($query_estado)){
								    ?>
								    	<option value="<?php echo $testados['id']; ?>"><?php echo $testados['Estado']; ?></option>
								    <?php
								    	}
								    }
								    ?>
								    </select>
                                </div>
							</td>
                        </tr>
						<tr>
                            <td><label id="Ciudad">Ciudad:</label></td>
							<td>
                                <div id="content-select">
			
								    <select class="notItemOne" name="TCiudades_id" id="TCiudades_id">
                                        <option value="<?php echo $data_producto['TCiudades_id']; ?>" selected><?php echo $data_producto['Ciudad']; ?></option>
								    </select>

                                </div>
							</td>
                        </tr>
						<tr>
                            <td><label id="CPostal">Codigo Postal:</label></td>
							<td>
                                <div id="content-select">
			
								    <select class="notItemOne" name="TCPostales_id" id="TCPostales_id">
                                        <option value="<?php echo $data_producto['TCPostales_id']; ?>" selected><?php echo $data_producto['CPostal']; ?></option>
								    </select>

                                </div>
							</td>
                        </tr>
						<tr>
                            <td><label id="Colonia">Colonia:</label></td>
							<td>
                                <div id="content-select">
			
								    <select class="notItemOne" name="TColonias_id" id="TColonias_id">
                                        <option value="<?php echo $data_producto['TColonias_id']; ?>" selected><?php echo $data_producto['Colonia']; ?></option>
								    </select>

                                </div>
							</td>
                        </tr>
						<tr>
                            <td><label for="CalleYNumero">Calle y Numero:</label></td>
							<td><input class="input" type="text" name="CalleYNumero" id="CalleYNumero" value="<?php echo $data_producto['CalleYNumero']; ?>" required></td>
                        </tr>
						<tr>
							<td><label id="Rol">Rol:</label></td>
							<td>
                                <div id="content-select">
								<?php 
								    $query_rol = mysqli_query($conexion, "SELECT id, Rol FROM troles");
								    $result_rol = mysqli_num_rows($query_rol);

									$consulta_rol="SELECT TRoles_id FROM tusuarios WHERE TRoles_id = 1";
									$result_rol2=mysqli_query($conexion, $consulta_rol);

									if(mysqli_num_rows($result_rol2) < 2){
										if($data_producto['TRoles_id'] == 1){
									?>
											<div style="width: 338px; font-size: 12px;">(No se puede modificar el rol porque debe de haber al menos 1 administrador.)</div>
											<select class="notItemOne" name="TRoles_id" id="TRoles_id" hidden>
									<?php
										}else{
									?>
											<div style="width: 338px; font-size: 12px;">(Si modificas el rol de tu propio usuario tendrás que iniciar sesión nuevamente; Si es tu propio usuario te cerrará sesión.)</div>
											<select class="notItemOne" name="TRoles_id" id="TRoles_id">
									<?php
										}
									}else{
									?>
										<div style="width: 338px; font-size: 12px;">(Si modificas el rol de tu propio usuario tendrás que iniciar sesión nuevamente; Si es tu propio usuario te cerrará sesión.)</div>
								    	<select class="notItemOne" name="TRoles_id" id="TRoles_id">
                                	<?php 
									}
									?>	
											<option value="<?php echo $data_producto['TRoles_id']; ?>" selected><?php echo $data_producto['Rol']; ?></option>
									<?php
								    if($result_rol > 0){
								    	while($troles = mysqli_fetch_array($query_rol)){
									?>
								    		<option value="<?php echo $troles['id']; ?>"><?php echo $troles['Rol']; ?></option>
									<?php
								    	}
									}
								    ?>
								    </select>
                                </div>
							</td>	  
                        </tr>
                        <tr>			
						    <td colspan="2" id="boton_registrar" ><input type="submit" value="Actualizar usuario" name="enviar"></td>
                        </tr>
                        </table>
                </fieldset>
				</form>
		    </div>
		</div>



<!--JAVASCRIPT------------------------------------------------------------------>
		<script type="text/javascript">
			function abrir(){
				document.getElementById("vent").style.display="block";
			}

			function cerrar(){
				document.getElementById("vent").style.display="none";
			}

			/*-------------------Selector de dirección--------------------*/
			$(document).ready(function(){
    			$("#TEstados_id").on('change', function () {
        			$("#TEstados_id option:selected").each(function () {
        				estadoselegidos=$(this).val();
    				    $.post("buscardireccion.php", { estadoselegidos: estadoselegidos }, function(data){
    			            $("#TCiudades_id").html(data);
    			        });         
    			    });
			   });
			});

			$(document).ready(function(){
    			$("#TCiudades_id").on('change', function () {
        			$("#TCiudades_id option:selected").each(function () {
        				ciudadeselegidos=$(this).val();
    				    $.post("buscardireccion.php", { ciudadeselegidos: ciudadeselegidos }, function(data){
    			            $("#TCPostales_id").html(data);
    			        });         
    			    });
			   });
			});

			$(document).ready(function(){
    			$("#TCPostales_id").on('change', function () {
        			$("#TCPostales_id option:selected").each(function () {
        				cpostaleselegidos=$(this).val();
    				    $.post("buscardireccion.php", { cpostaleselegidos: cpostaleselegidos }, function(data){
    			            $("#TColonias_id").html(data);
    			        });         
    			    });
			   });
			});
/*-----------------Fin selector de dirección------------------*/
		</script>


<!-- Option 1: BOOTSTRAP Bundle with Popper -------------------------------------->
		<script src="js/bootstrap_5_0_0_bundle_min.js"></script>
		<script src="js/core.js"></script>
		<script src="js/main.js"></script>
	</body>
</html>