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
	
	if (isset($_POST["solicitar"])) {
		$Cantidad_soli  = $_POST["Cantidad_soli"];
		$Cantidad       = $_POST["Cantidad"];

		if ($Cantidad_soli == 0) {
			echo "<h2 id='producto_error'>No ingreso una cantidad</h2>";
		}else{
			if ($Cantidad == 0) {
				echo "<h2 class='pedido_existencias'>Ya no hay en existencias <a class='btn' href='menu_principal.php'><button class='btn'>Aceptar</button></a></h2>";
			}else{
	
				if ($Cantidad_soli > $Cantidad) {
					echo "<h2 class='pedido_disponible'>Sobrepasa la cantidad disponible, solicite  una cantidad menor</h2>";
				}else{
					$Subtotal       = $_POST["Subtotal"];
					$IVA            = $_POST["IVA"];
					$Total          = $_POST["Total"];
					$TUsuarios_id   = $_POST["TUsuarios_id"];
					$TArticulos_id  = $_POST["TArticulos_id"];
	
					$query_articulo = mysqli_query($conexion, "SELECT * FROM tventas");
					$result_articulo = mysqli_num_rows($query_articulo);
	
					$query_insert = mysqli_query($conexion, "INSERT INTO `tventas`(`id_NTicket`, `Cantidad_soli`, `Subtotal`, `IVA`, `Total`, `TServicos_id`, `TUsuarios_id`, `TArticulos_id`) 
																	VALUES (NULL,'$Cantidad_soli','$Subtotal','$IVA','$Total',NULL,'$TUsuarios_id','$TArticulos_id')");
			
					if($query_insert){
						echo "<h2 id='mensaje_pedido'>Pedido realizado correctamente <a class='btn' href='Lista_pedidos_usuarios.php'><button class='btn'>Aceptar</button></a></h2>";
					}else{
						echo "<h2 id='producto_error'>Error al solicitar pedido</h2>";
					}
				}
			}
		}
	}


	if (isset($_POST['solicitar'])) {
		$Cantidad_soli  = $_POST["Cantidad_soli"];
		$Cantidad       = $_POST["Cantidad"];

		if ($Cantidad_soli == 0) {
			echo "<h2 id='producto_error'>No ingreso una cantidad</h2>";
		}else{
			if ($Cantidad == 0) {
				echo "<h2 class='pedido_existencias'>Ya no hay en existencias <a class='btn' href='menu_principal.php'><button class='btn'>Aceptar</button></a></h2>";
				}else{
				if ($Cantidad_soli > $Cantidad) {
					echo "<h2 class='pedido_disponible'>Sobrepasa la cantidad disponible, solicite  una cantidad menor</h2>";
				}else{
					$id             = $_POST["id"];
					$Stock          = $_POST["Stock"];
	
				$Result= $_POST['Cantidad'] - $Cantidad_soli;
	
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
				}
			}
		}
	}


	//VALIDAR DATOS USUARIO
	if (!isset($_SESSION['Username'])) {
		header('location: menu_principal.php');
	}else{
		$_USER = $_SESSION['Username'];
		$SQL = mysqli_query($conexion, "SELECT  tusuarios.id, tusuarios.Nombre, tusuarios.Apellido, tusuarios.Username, tusuarios.CalleYNumero, tusuarios.TColonias_id,
												tcolonias.Colonia, tcolonias.TCPostales_id, tcpostales.CPostal, tcpostales.TCiudades_id, tciudades.Ciudad, tciudades.TEstados_id,
												testados.Estado, testados.TPaises_id, tpaises.Pais
  												FROM tusuarios
  												INNER JOIN tcolonias ON tusuarios.TColonias_id = tcolonias.id
  												INNER JOIN tcpostales ON tcolonias.TCPostales_id = tcpostales.id 
  												INNER JOIN tciudades ON tcpostales.TCiudades_id = tciudades.id 
  												INNER JOIN testados ON tciudades.TEstados_id = testados.id
  												INNER JOIN tpaises ON testados.TPaises_id = tpaises.id 
												
												WHERE Username = '".$_USER."'");
		$Info = mysqli_fetch_assoc($SQL);
		/*print_r($Info);*/
	}

	//VALIDAR DATOS
	if(empty($_REQUEST['id'])){
		header("location: registros_panaderia.php");
	} else{
		
		$id = $_REQUEST['id'];
		if(!is_numeric($id)){
			header("location: registros_panaderia.php");
		}

		$query_producto = mysqli_query($conexion, "SELECT tarticulos.id, tarticulos.Nombre, tarticulos.Cantidad, tarticulos.Stock, tarticulos.Precio, 
													 	tarticulos.TCategoria_id, tcategoria.Categoria
													FROM tarticulos 
													INNER JOIN tcategoria ON tarticulos.TCategoria_id = tcategoria.id 
													WHERE tarticulos.id = $id");
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
	<link rel="stylesheet" type="text/css" href="Estilos/estilo_form_pedido.css">
	<link rel="shortcut icon" href="Imagenes/favicon.ico">
	
	<link href="Estilos/Bootstrap_min_5_1_3.css" rel="stylesheet">
	<script src="js/bootstrap_5_1_3_bundle_min.js"></script>
	<link rel="stylesheet" href="Estilos/Botstrap_icons_1_4_0.css">
	<link rel="stylesheet" href="Estilos/main.css">
	<script src="js/jquery_latest.js"></script>
	<script src="js/menu.js"></script>

</head>
<body>
		<span class="arriba" name="arriba"><i class="fa-solid fa-circle-chevron-up"></i></span>
		
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

		<nav class="navbar navbar-expand-lg navbar-light  p-1" id="cabecera">
		<div class="container">

			<a class="navbar-brand" href="menu_principal.php">
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
						<a id="op_menu" class="nav-link" href="pagina_servicios.php">Regresar</a>
					</li>
				</ul>
			</div>

			<a class="navbar-brand-collapse w-1"  href="javascript:abrir()">
				<img class="imagen_2" src="Imagenes/logo_usuario.png" alt="Log in">
			</a>
		</div>
		</nav>



		<div id="cuerpo" class="cuerpo">
			
			<div id="pedido">
				<form action="#" method="POST">
					<table>
						<div>
							<input type="hidden" name="id" value="<?php echo $data_producto['id']; ?>">
							<input type="hidden" name="TArticulos_id" value="<?php echo $data_producto['id']; ?>">
							<input type="hidden" name="TUsuarios_id" value="<?php echo $Info['id']; ?>">
							<input type="hidden" name="Stock" value="<?php echo $data_producto['Stock']; ?>">
						
							<h3>Formulario de pedido</h3>
						</div>
						<div>
							<div class="divisor_datos">
								<?php if ($data_producto['TCategoria_id'] == 1 ||$data_producto['TCategoria_id'] == 2) {?>
									<h6 id="dato_articulo">Datos del producto</h6>
								<?php }else if($data_producto['TCategoria_id'] == 3){ ?>
									<h6 id="dato_articulo">Datos del servicio</h6>
								<?php	}?>
								
							
								<div>
									<label for="">Nombre:</label>
								</div>
								<div>
									<input type="text" disabled value="<?php echo $data_producto['Nombre'];?>">
								</div>
								<div>
									<label for="">Categoria:</label>
								</div>
								<div>
									<input type="text" disabled value="<?php echo $data_producto['Categoria'];?>">
								</div>
								<div>
									<label for="">Disponibles:</label>
								</div>
								<div>
									<input type="number" id="Cantidad" name="Cantidad" readonly value="<?php echo $data_producto['Cantidad'];?>">
								</div>
								<div>
									<label for="">Precio:</label>
								</div>
								<div>
									<input type="number" id="Precio" disabled value="<?php echo $data_producto['Precio'];?>">
								</div>
							</div>

							<div class="divisor_datos">
								<h6>Datos de usuario</h6>
							
								<div>
									<label for="">Nombre completo:</label>
								</div>
								<div>
									<input type="text" disabled value="<?php echo $Info['Nombre']." ".$Info['Apellido'];?>">
								</div>
								<div>
									<label for="">Nombre de usuario:</label>
								</div>
								<div>
									<input type="text" disabled value="<?php echo $Info['Username']?>">
								</div>
								<div>
									<label for="">Dirección:</label>
								</div>
								<div>
									<textarea id="direccion" disabled><?php echo $Info['CalleYNumero'].", ".$Info['CPostal'].", ".$Info['Colonia'].", ".$Info['Ciudad'].", ".$Info['Estado'].", ".$Info['Pais'];?></textarea>
								</div>
							</div>

							<div  class="divisor_datos">
								<h6 id="dato_pedido">Datos del pedido</h6>
							
								<div>
									<label for="">Cantidad a solicitar:</label>
								</div>
								<div>
									<input type="number" onKeyPress="if(this.value.length==3) return false;" onkeydown="filtro()" name="Cantidad_soli" id="Cantidad_soli" required>
								</div>
								<div  id="contenido_subtotal">
									<div>
										<label class="calculo_subtotal" for="">Subtotal:</label>
										<input class="calculo_precio" type="number" name="Subtotal" id="Subtotal" readonly>
									</div>
									<div>
										<label class="calculo_subtotal" for="">IVA (0%):</label>
										<input class="calculo_precio" type="number" name="IVA" id="IVA" readonly value="0">
									</div>
									<div>
										<label class="calculo_subtotal" for="">Total:</label>
										<input class="calculo_precio" type="number" name="Total" id="Total" readonly>
									</div>
								</div>
							</div>
							<div>
								<input type="submit" name="solicitar" id="solicitar" value="Solicitar">
							</div>
						</div>
					</table>
				</form>
				
			</div>
			
		</div>


		
<!-------------------------------------------------- PIE --------------------------------------------------------------->
	<?php
		include 'Includes/footer.php';
	?>
<!----------------------------------------------- FIN DEL PIE ---------------------------------------------------------->


</div>		


<!--JAVASCRIPT------------------------------------------------------------------>
		<script type="text/javascript">
			function abrir(){
				document.getElementById("vent").style.display="block";
			}

			function cerrar(){
				document.getElementById("vent").style.display="none";
			}

			//Cuando cambie la cantidad...
			$('#Cantidad_soli').on('change', function(){
				//Obtenemos el precio de venta
  				let precio = $('#Precio').val();
  				//Obtenemos la cantidad
  				let cantidad = $('#Cantidad_soli').val();
  				//Multiplicamos ambos valores
  				let subtotal = precio * cantidad;
  				//Asignamos el resultado al value de subtotal
  				$('#Subtotal').val(subtotal);
				let IVA = $('#IVA').val();
				let Total = Number(subtotal) + Number(IVA);
				$('#Total').val(Total);
			});


			function filtro(){
				var tecla = event.key;
				if (['.','e'].includes(tecla))
   					event.preventDefault()
			}
		</script>


<!-- Option 1: BOOTSTRAP Bundle with Popper -------------------------------------->
		<script src="js/bootstrap_5_0_0_bundle_min.js"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
		<script src="js/core.js"></script>
		<script src="js/main.js"></script>
	</body>
</html>