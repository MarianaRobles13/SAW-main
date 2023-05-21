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

		$id				   = $_POST['id'];
		$Nombre            = $_POST['Nombre'];
		$Stock             = $_POST['Stock'];
		$Cantidad          = $_POST['Cantidad'];
		$Descripcion       = $_POST['Descripcion'];
		$Precio            = $_POST['Precio'];
		$usuario_id        = $_POST['usuario_id'];
		$TCategoria_id     = $_POST['TCategoria_id'];
		$TSubCategoria_id  = $_POST['TSubCategoria_id'];
		$imgProducto       = $_POST['foto_actual'];
		$imgRemove         = $_POST['foto_remove'];

			
			$foto = $_FILES['foto'];
			$nombre_foto = $foto['name'];
			$type        = $foto['type'];
			$url_temp    = $foto['tmp_name'];

			$upd = '';

			if($nombre_foto != '')
			{
				$destino = 'Imagenes/img_temporal/';
				$img_nombre = 'img_' .md5(date('d-m-Y H:m:s'));
				$imgProducto = $img_nombre.'.jpg';
				$src = $destino.$imgProducto;
			}else{
				if($_POST['foto_actual'] != $_POST['foto_remove']){
					$imgProducto = 'img_producto.png';
				}
			}

			if ($_POST['Cantidad'] == 0) {
				$Stock = 0;
			}else{
				$Stock = 1;
			}
	
			if (!empty($url_temp) OR $imgProducto == 'img_producto.png') {
				$query_update = mysqli_query($conexion, "UPDATE `tarticulos` SET `Nombre`='$Nombre',`Stock`='$Stock',`Cantidad`='$Cantidad',`Descripcion`='$Descripcion',`Precio`='$Precio',`usuario_id`='$usuario_id',`TCategoria_id`='$TCategoria_id', `TSubCategoria_id`='$TSubCategoria_id',`foto`='$imgProducto' 
														WHERE id = $id");

				if($query_update){
						if(($nombre_foto != '' && ($_POST['foto_actual'] != 'img_producto.png')) || ($_POST['foto_actual'] != $_POST['foto_remove']))
						{
							unlink('Imagenes/img_temporal/'.$_POST['foto_actual']);
						}
						if($nombre_foto != ''){
							move_uploaded_file($url_temp, $src);
						}

						echo "<h2 id='producto_edit'>Producto actualizado correctamente</h2>";
					}else{
						echo "<h2 id='producto_error'>Error al actualizar el producto</h2>";
					}
				
			}else{
				echo "<h2 id='producto'>La imagen es demasiado pesada, ¿Desea optimizarla? <a class='btn' href='http://localhost/test_image/formulario.php'><button class='btn'>Aceptar</button></a></h2>";
			}
			
	}
	

	//VALIDAR DATOS
	if(empty($_REQUEST['id'])){
		header("location: registros_panaderia.php");
	} else{
		
		$id = $_REQUEST['id'];
		if(!is_numeric($id)){
			header("location: registros_panaderia.php");
		}

		$query_producto = mysqli_query($conexion, "SELECT tarticulos.id, tarticulos.Nombre, tarticulos.Stock, tarticulos.Cantidad, tarticulos.NPersonas, tarticulos.Descripcion, tarticulos.Precio, 
														tarticulos.usuario_id, tarticulos.TCategoria_id,  tarticulos.TSubCategoria_id, tusuarios.Username, tcategoria.Categoria, tsubCategoria.SubCategoria, tarticulos.foto 
													FROM tarticulos 
													INNER JOIN tusuarios ON tarticulos.usuario_id = tusuarios.id
													INNER JOIN tcategoria ON tarticulos.TCategoria_id = tcategoria.id 
													INNER JOIN tsubCategoria ON tarticulos.TSubCategoria_id = tsubCategoria.id
													WHERE tarticulos.id = $id");
		$result_producto = mysqli_num_rows($query_producto);

		$foto = '';
		$classRemove = 'notBlock';

		if($result_producto > 0){
			$data_producto = mysqli_fetch_assoc($query_producto);

			if($data_producto['foto'] != 'img_producto.png'){
				$classRemove = '';
				$foto = '<img id="img" src="Imagenes/img_temporal/'.$data_producto['foto'].'" alt"Articulo">';
			}

			if ($data_producto['Cantidad'] == 0) {
				$data_producto['Stock'] = 0;
			}else{
				$data_producto['Stock'] = 1;
			}
			/*print_r($data_producto);*/
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
						<a id="op_menu" class="nav-link" href="registros_servicios.php">Regresar</a>
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
        		<form action="#" method="POST" enctype="multipart/form-data">
				<fieldset>
					<table>
						<input type="hidden" name="id" value="<?php echo $data_producto['id']; ?>">
						<input type="hidden" id="foto_actual" name="foto_actual" value="<?php echo $data_producto['foto']; ?>">
						<input type="hidden" id="foto_remove" name="foto_remove" value="<?php echo $data_producto['foto']; ?>">
						<tr>
							<td colspan="2"><label><h1>Actualizar producto</h1></label></td>
						</tr>
						<tr id="espacio"></tr>
						<tr>
							<td><label for="Nombre">Nombre:</label></td>
							<td><input type="text" name="Nombre" id="Nombre" value="<?php echo $data_producto['Nombre']; ?>" placeholder="Ingrese nombre del producto" required></td>
						</tr>
						<tr>
							<td><label for="Stock">Stock:</label></td>
							<td>
								<div id="content-select">
									<select class="notItemOne" name="Stock" id="Stock">
								<?php	if( $data_producto['Stock'] == 0){?>
											<option value="0" selected>Agotado</option>
								<?php	}else{?>
											<option value="1" selected>Disponible</option>
								<?php	} ?>
									</select>
								</div>
							</td>
						</tr>
						<tr>
							<td><label for="Cantidad">Cantidad:</label></td>
							<td><input type="number" name="Cantidad" id="Cantidad" value="<?php echo $data_producto['Cantidad']; ?>" placeholder="Ingrese cantidad disponible del producto" required></td>
						</tr>
						<tr>
							<td><label for="Descripcion">Descripción:</label></td>
							<td><input type="text" name="Descripcion" id="Descripcion" value="<?php echo $data_producto['Descripcion']; ?>" placeholder="Ingrese descripción del producto" required></td>
						</tr>
						<tr>
							<td><label for="Precio">Precio (MXN):</label></td>
							<td><input type="number" name="Precio" id="Precio" value="<?php echo $data_producto['Precio']; ?>" placeholder="Ingrese precio del producto" required></td>
						</tr>
						<tr>
							<td><label for="usuario_id">Regis. del usuario:</label></td>
							<td>
								<div id="content-select">
									<?php 
										$query_usuario = mysqli_query($conexion, "SELECT id, Username FROM tusuarios");
										$result_usuario = mysqli_num_rows($query_usuario);
									?>
									<select class="notItemOne" name="usuario_id" id="usuario_id">
										<option value="<?php echo $data_producto['usuario_id']; ?>" selected><?php echo $data_producto['Username']; ?></option>
									<?php
										if($result_usuario > 0){
											while($tusuarios = mysqli_fetch_array($query_usuario)){
									?>
									<option value="<?php echo $tusuarios['id']; ?>"><?php echo $tusuarios['Username']; ?></option>
									<?php
											}
										}
									?>
									</select>
								</div>
							</td>
						</tr>
						<tr>
							<td><label for="TCategoria_id">Categoría:</label></td>
							<td>
								<div id="content-select">
									<?php
										$query_categoria = mysqli_query($conexion, "SELECT id, Categoria FROM tcategoria");
										$result_categoria = mysqli_num_rows($query_categoria);
									?>
									<select class="notItemOne" name="TCategoria_id" id="TCategoria_id">
										<option value="<?php echo $data_producto['TCategoria_id']; ?>" selected><?php echo $data_producto['Categoria']; ?></option>
									<?php
										if($result_categoria > 0){
											while($tcategoria = mysqli_fetch_array($query_categoria)){
									?>
									<option value="<?php echo $tcategoria['id']; ?>"><?php echo $tcategoria['Categoria']; ?></option>
									<?php
											}
										}
									?>
									</select>
								</div>
							</td>
						</tr>
						<tr>
							<td><label for="TSubCategoria_id">Sub Categoría:</label></td>
							<td>
								<div id="content-select">
									<?php
										$query_subcategoria = mysqli_query($conexion, "SELECT id, SubCategoria FROM tsubCategoria");
										$result_subcategoria = mysqli_num_rows($query_subcategoria);
										mysqli_close($conexion);
									?>
									<select class="notItemOne" name="TSubCategoria_id" id="TSubCategoria_id">
										<option value="<?php echo $data_producto['TSubCategoria_id']; ?>" selected><?php echo $data_producto['SubCategoria']; ?></option>
									<?php
										if($result_subcategoria > 0){
											while($tsubCategoria = mysqli_fetch_array($query_subcategoria)){
									?>
									<option value="<?php echo $tsubCategoria['id']; ?>"><?php echo $tsubCategoria['SubCategoria']; ?></option>
									<?php
											}
										}
									?>
									</select>
								</div>
							</td>
						</tr>
						<tr>
							<td><div class="photo">
								<label for="foto">Imagen (2MB max):</label>
        						<div class="prevPhoto">
        							<span class="delPhoto <?php echo $classRemove; ?>">X</span>
        							<label for="foto"></label>
									<?php echo $foto; ?>
        						</div>
        					</td>
        					<td>
        						<div class="upimg">
        							<input type="file" name="foto" id="foto">
        						</div>
        						<div id="form_alert"></div>
								</div>
							</td>
						</tr>				
						<tr>
							<td colspan="2" id="boton_registrar"><input type="submit" value="Actualizar producto" name="enviar"></td>
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
		</script>


<!-- Option 1: BOOTSTRAP Bundle with Popper -------------------------------------->
		<script src="js/bootstrap_5_0_0_bundle_min.js"></script>
		<script src="js/core.js"></script>
		<script src="js/main.js"></script>
	</body>
</html>