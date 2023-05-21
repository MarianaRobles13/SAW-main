<?php 
	session_start ();

 ?>

<?php

	include 'Conexion.php';

	if (isset($_POST["enviar"])) {
		$id_NTicket = $_POST["id_NTicket"];
		$Estado_pedido = $_POST["Estado_pedido"];
		$Cantidad = $_POST["Cantidad"];
		$Cantidad_soli = $_POST["Cantidad_soli"];
		$Stock = $_POST["Stock"];

			$actualizar=mysqli_query($conexion, "UPDATE tventas SET 
				Estado_pedido = '$Estado_pedido'
				
				WHERE id_NTicket = '$id_NTicket'
			");


			if($actualizar)
			{
				echo "<h2 id='producto_edit'>Pedido actualizado correctamente</h2>";
			}else{
				echo "<h2 id='producto_error'>Error al actualizar pedido</h2>";
			}
	}

	if (isset($_POST['enviar'])) {
		$Cantidad_soli  = $_POST["Cantidad_soli"];
		$Cantidad       = $_POST["Cantidad"];
		$id             = $_POST["id"];
		$Stock          = $_POST["Stock"];
		$Estado_pedido = $_POST["Estado_pedido"];

		if ($Estado_pedido == 1) {
			$Result= $_POST['Cantidad'] + $Cantidad_soli;

			if ($Result == 0) {
				$Stock = 0;
				$actualizar = mysqli_query($conexion, "UPDATE tarticulos 
														SET Cantidad = $Result, Stock = $Stock
														WHERE id = $id");
			}else{
				$Stock = 1;
				$actualizar = mysqli_query($conexion, "UPDATE tarticulos 
														SET Cantidad = $Result, Stock = $Stock
														WHERE id = $id");
			}	
		}else{

		}
		
	}


	//VALIDAR DATOS
	if(empty($_REQUEST['id_NTicket'])){
		header("location: usuarios_pedidos.php");
	} else{
		
		$id_NTicket = $_REQUEST['id_NTicket'];
		if(!is_numeric($id_NTicket)){
			header("location: usuarios_pedidos.php");
		}

		$query_producto = mysqli_query($conexion, "SELECT tventas.id_NTicket, tventas.Cantidad_soli, tventas.Subtotal, tventas.IVA, tventas.Total, tventas.Estado_pedido, tventas.Fecha_pedido,
													tarticulos.id, tarticulos.Cantidad, tarticulos.Stock
													FROM tventas
													INNER JOIN tarticulos ON tventas.TArticulos_id = tarticulos.id
													WHERE tventas.id_NTicket = $id_NTicket");
		$result_producto = mysqli_num_rows($query_producto);

		if($result_producto > 0){
			$data_producto = mysqli_fetch_assoc($query_producto);

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
						<a id="op_menu" class="nav-link" href="usuarios_pedidos.php">Regresar</a>
					</li>
				</ul>
			</div>

			<a class="navbar-brand-collapse w-1"  href="javascript:abrir()">
				<img class="imagen_2" src="Imagenes/logo_usuario.png" alt="Log in">
			</a>
		</div>
		</nav>


		<div>
		<div id="tabla_actualizar">
                <form action="#" method="POST">
				<input type="hidden" name="id_NTicket" value="<?php echo $data_producto['id_NTicket']; ?>">
				<input type="hidden" name="id" value="<?php echo $data_producto['id']; ?>">
				<input type="hidden" name="Cantidad_soli" value="<?php echo $data_producto['Cantidad_soli']; ?>">
				<input type="hidden" name="Cantidad" value="<?php echo $data_producto['Cantidad']; ?>">
				<input type="hidden" name="Stock" value="<?php echo $data_producto['Stock']; ?>">
                <fieldset>
					<table>
                        <tr>
							<td colspan="2"><label><h1>Estado del pedido</h1></label></td>
						</tr>	
						<tr>
                            <td><label id="Estado" for="Estado">¿Que desea hacer con el pedido:</label></td>
							<td>
								<div id="content-select">
									<select class="notItemOne" name="Estado_pedido" id="Estado_pedido">
								<?php	if( $data_producto['Estado_pedido'] == 0){?>
											<option value="0" selected>En proceso</option>
								<?php	}else if( $data_producto['Estado_pedido'] == 1){?>
											<option value="1" selected>Cancelar</option>
								<?php	} else{ ?>
											<option value="2" selected>Completar</option>
								<?php 	}	?>
											<option value="0">En proceso</option>
											<option value="1">Cancelar</option>
											<option value="2">Completar</option>
									</select>
								</div>
							</td>
                         </tr>
                        <tr>			
						    <td colspan="2" id="boton_registrar" ><input type="submit" value="Modificar pedido" name="enviar"></td>
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
</body>
</html>