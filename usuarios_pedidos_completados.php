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
			$Nombre         = $_POST["Nombre"];
			$Stock          = $_POST["Stock"];
			$Cantidad       = $_POST["Cantidad"];
			$NPersonas      = $_POST["NPersonas"];
			$Descripcion    = $_POST["Descripcion"];
			$Precio         = $_POST["Precio"];
			$usuario_id     = $_POST["usuario_id"];
			$TCategoria_id  = $_POST["TCategoria_id"];
			$TSubCategoria_id  = $_POST["TSubCategoria_id"];

			$foto = $_FILES['foto'];
			$nombre_foto = $foto['name'];
			$type        = $foto['type'];
			$url_temp    = $foto['tmp_name'];

			$imgProducto = 'img_producto.png';

			if($nombre_foto != '')
			{
				$destino = 'Imagenes/img_temporal/';
				$img_nombre = 'img_' .md5(date('d-m-Y H:m:s'));
				$imgProducto = $img_nombre.'.jpg';
				$src = $destino.$imgProducto;
			}

			if (!empty($url_temp) OR $imgProducto == 'img_producto.png') {
				$query_articulo = mysqli_query($conexion, "SELECT * FROM tarticulos");
				$result_articulo = mysqli_num_rows($query_articulo);

				$query_insert = mysqli_query($conexion, "INSERT INTO `tarticulos`(`id`, `Nombre`, `Stock`, `Cantidad`, `NPersonas`, `Descripcion`, `Precio`, `usuario_id`, `TCategoria_id`, `TSubCategoria_id`, `foto`) 
														VALUES (NULL,'$Nombre','$Stock','$Cantidad','$NPersonas','$Descripcion','$Precio','$usuario_id','$TCategoria_id', '$TSubCategoria_id','$imgProducto')");

				if($query_insert){
					if($nombre_foto != ''){
						move_uploaded_file($url_temp, $src);
					}
					echo "<h2 id='producto'>Producto registrado correctamente <a class='btn' href='adm_usuarios.php'><button class='btn'>Aceptar</button></a></h2>";
				}else{
					echo "<h2 id='producto_error'>Error al registrar producto</h2>";
				}
				
			}else{
				echo "<h2 id='producto'>La imagen es demasiado pesada, ¿Desea optimizarla? <a class='btn' href='http://localhost/test_image/formulario.php'><button class='btn'>Aceptar</button></a></h2>";
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
	<link rel="stylesheet" type="text/css" href="Estilos/estilo_botones_pedidos.css">
	<link rel="shortcut icon" href="Imagenes/favicon.ico">
    <script>
		function confirmacion(){
			if (confirm("¿Desea eliminar este usuario?")) {
				return true;
			}return false;
		}
	</script>
	
	<link href="Estilos/Bootstrap_5_0_0.css" rel="stylesheet">
	<link rel="stylesheet" href="Estilos/Botstrap_icons_1_4_0.css">
	<script src="js/jquery_latest.js"></script>
	<script src="js/menu.js"></script>
	<script src="js/functions.js"></script>
	<script src="https://code.jquery.com/jquery-3.6.0.js"></script>

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
						<a id="op_menu_backend" class="nav-link" href="registros_panaderia.php">Panadería</a>
					</li>

					<li class="nav-item">
						<a id="op_menu_backend" class="nav-link" href="registros_pasteleria.php">Pastelería</a>
					</li>

					<li class="nav-item">
						<a id="op_menu_backend" class="nav-link" href="registros_servicios.php">Servicios</a>
					</li>

					<li class="nav-item dropdown">
						<a id="op_menu_backend" class="nav-link" data-bs-toggle="dropdown">Usuarios  <i class="fa-solid fa-caret-down"></i></a>
						<ul class="dropdown-menu">
						  <li><a class="dropdown-item" href="adm_usuarios.php">Adm. Usuarios</a></li>
						  <li><a class="dropdown-item" href="usuarios_pedidos.php"><div class="pageSelected">Pedidos</div></a></li>
						  <li><a class="dropdown-item" href="registros_mensajes.php">Mensajes</a></li>
						</ul>
					</li>

					<li class="nav-item" data-bs-toggle="modal" data-bs-target="#myModal">
						<a id="op_menu_backend" class="nav-link">R. Articulos</a>
					</li>
				</ul>
			</div>

			<a class="navbar-brand-collapse w-1"  href="javascript:abrir()">
				<img class="imagen_2" src="Imagenes/logo_usuario.png" alt="Log in">
			</a>
		</div>
		</nav>

	
		<div id="cuerpo">
					<div id="contenedor_botones_pedidos">
                        <div class="boton_pedido_cancelado"><a href="usuarios_pedidos_cancelados.php">Cancelados</a></div>
                        <div class="boton_pedido"><a href="usuarios_pedidos.php">Recibidos</a></div>
                        <div class="boton_pedido_completado"><a class="Selected" href="usuarios_pedidos_completados.php">Completados</a></div>
                    </div>


		<div id="tabla_registros">
        <table id="tabla1" class="tabla_pedidos">
		<tr><th colspan="10"><h1>Lista de pedidos completados</h1></th></tr>
		<tr>
			<th>N. Ticket</th>
			<th>Articulo</th>
            <th>Cantidad solicitada</th>
			<th>Total</th>
			<th>Nombre completo</th>
			<th>Nombre de usuario</th>
            <th>Dirección</th>
            <th>Fecha de pedido</th>
			<th>Estado del pedido</th>
			<th>Eliminar</th>
		</tr>

		<?php 
			//Paginador
			$sql_registe = mysqli_query($conexion, "SELECT COUNT(*) as total_registro FROM tusuarios");
			$result_register = mysqli_fetch_array($sql_registe);
			$total_registro = $result_register['total_registro'];

			$por_pagina = 1;
			
			if(empty($_GET['pagina']))
			{
				$pagina = 1;
			}else{
				$pagina = $_GET['pagina'];
			}

			$desde = ($pagina-1) * $por_pagina;
			$total_pagina = ceil($total_registro / $por_pagina);

			$query = mysqli_query($conexion, "SELECT tventas.id_NTicket, tventas.Cantidad_soli, tventas.Subtotal, tventas.IVA, tventas.Total, tventas.Estado_pedido, tventas.Fecha_pedido,
                                                    (tarticulos.Nombre) AS articulo_nombre, tusuarios.Nombre, tusuarios.Apellido, tusuarios.Username, tusuarios.CalleYNumero,
													tusuarios.TColonias_id, tcolonias.Colonia, tcpostales.CPostal, tciudades.Ciudad,
													testados.Estado, tpaises.Pais FROM tventas
                                                    INNER JOIN tarticulos ON tventas.TArticulos_id = tarticulos.id
													INNER JOIN tusuarios ON tventas.TUsuarios_id = tusuarios.id
													INNER JOIN tcolonias ON tusuarios.TColonias_id = tcolonias.id
											        INNER JOIN tcpostales ON tcolonias.TCPostales_id = tcpostales.id 
											        INNER JOIN tciudades ON tcpostales.TCiudades_id = tciudades.id 
											        INNER JOIN testados ON tciudades.TEstados_id = testados.id
                                                    INNER JOIN tpaises ON testados.TPaises_id = tpaises.id
                                                    WHERE tventas.Estado_pedido = 2 ORDER BY tventas.Fecha_pedido ASC/*LIMIT $desde,$por_pagina*/");

			$result = mysqli_num_rows($query);
			if($result > 0){

				while ($data = mysqli_fetch_array($query)){
			?>
				<tr>
                    <td><?php echo $data["id_NTicket"]; ?></td>
					<td><?php echo $data["articulo_nombre"]; ?></td>
                    <td><?php echo $data["Cantidad_soli"]; ?></td>
					<td><?php echo $data["Total"]; ?></td>
					<td><?php echo $data["Nombre"]." ".$data["Apellido"]; ?></td>
					<td><?php echo $data["Username"]; ?></td>
					<td><?php echo $data["CalleYNumero"].", ".$data["CPostal"].", ".$data["Colonia"].", ".$data["Ciudad"].", ".$data["Estado"].", ".$data["Pais"]."."; ?></td>
                    <td><?php echo $data["Fecha_pedido"]; ?></td>
				<?php 	if($data["Estado_pedido"] == 2){ ?>
					<td>Completado</td>
				<?php	}?>
					
					<td><a href="editar_pedidos.php?id_NTicket=<?php echo $data["id_NTicket"];?>"><i class="fa-solid fa-file-pen"></i></a></td>
				</tr>	
			<?php
				}
			}
			?>
		</table>
		</div>
		

<!-- The Modal -->
<div class="modal fade" id="myModal">
  <div class="modal-dialog">
    <div class="modal-content" id="formu">

      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title">Registra los datos del articulo</h4>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>

      <!-- Modal body -->
      <div class="modal-body">
	  <form action="#" method="POST" enctype="multipart/form-data">
				<fieldset>
					<table>
						<tr id="espacio"></tr>
						<tr>
						<td><label for="Nombre">Nombre:</label></td>
						<td><input type="text" name="Nombre" id="Nombre" placeholder="Ingrese nombre del producto" required></td>
						</tr>
						<tr>
							<td><label for="Stock">Stock:</label></td>
							<td>
								<div id="content-select">
									<select name="Stock" id="Stock">
										<option value="0">Agotado</option>
										<option value="1">En Stock</option>
									</select>
								</div>
							</td>
						</tr>
						<tr>
							<td><label for="Cantidad">Cantidad:</label></td>
							<td><input type="number" name="Cantidad" id="Cantidad" placeholder="Ingrese cantidad disponible del producto" required></td>
						</tr>
						<tr>
							<td><label for="NPersonas">Número de Personas:</label></td>
							<td><input type="number" name="NPersonas" id="NPersonas" placeholder="Ingrese una medida en numero de personas" required></td>
						</tr>
						<tr>
							<td><label for="Descripcion">Descripción:</label></td>
							<td><input type="text" name="Descripcion" id="Descripcion" placeholder="Ingrese descripción del producto" required></td>
						</tr>
						<tr>
							<td><label for="Precio">Precio (MXN):</label></td>
							<td><input type="number" name="Precio" id="Precio" placeholder="Ingrese precio del producto" required></td>
						</tr>
						<tr>
							<td><label for="usuario_id">Regis. del usuario:</label></td>
							<td>
								<div id="content-select">
									<?php 
										$query_usuario = mysqli_query($conexion, "SELECT id, Username FROM tusuarios WHERE TRoles_id = 1");
										$result_usuario = mysqli_num_rows($query_usuario);
									?>
									<select name="usuario_id" id="usuario_id">
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
										mysqli_close($conexion);
									?>
									<select name="TCategoria_id" id="TCategoria_id" required>
										<option value="">Seleccione una categoria</option>
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
									<select name="TSubCategoria_id" id="TSubCategoria_id"></select>
								</div>
							</td>
						</tr>
						<tr>
							<td><div class="photo">
								<label for="foto">Imagen (2MB max):</label>
        						<div class="prevPhoto">
        							<span class="delPhoto notBlock">X</span>
        							<label for="foto"></label>
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
							<td colspan="2" id="boton_registrar"><input type="submit" value="Registrar producto" name="enviar"></td>
						</tr>
					</table>
				</fieldset>
    		</form>
      </div>

    </div>
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

		<script language="javascript">
			$(document).ready(function(){
    			$("#TCategoria_id").on('change', function () {
        			$("#TCategoria_id option:selected").each(function () {
        				categoriaelegida=$(this).val();
    				    $.post("buscarcategoria.php", { categoriaelegida: categoriaelegida }, function(data){
    			            $("#TSubCategoria_id").html(data);
    			        });         
    			    });
			   });
			});
		</script>


<!-- Option 1: BOOTSTRAP Bundle with Popper -------------------------------------->
		<script src="js/bootstrap_5_0_0_bundle_min.js"></script>
		<script src="js/core.js"></script>
		<script src="js/main.js"></script>
	</body>
</html>