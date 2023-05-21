<?php 
	session_start ();

    include 'Conexion.php';

	include 'Actions/Pedidos/Pedidos.php';
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
<!-------------------------------------------------- CABECERA -------------------------------------------------------------->
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
                                            <a id="op_menu" class="nav-link active" aria-current="page" href="menu_principal.php">Regresar</a>
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
<!--------------------------------------------- FIN DEL CUERPO --------------------------------------------------------->

		
<!-------------------------------------------------- PIE --------------------------------------------------------------->
	<?php
		include 'Includes/footer.php';
	?>
<!----------------------------------------------- FIN DEL PIE ---------------------------------------------------------->
</div>		


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
			if (['.','e', '+', '-'].includes(tecla))
   				event.preventDefault()
		}
	</script>
<!--FIN DE JAVASCRIPT------------------------------------------------------------->

<!-- Option 1: BOOTSTRAP Bundle with Popper -------------------------------------->
		<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
		<script src="js/core.js"></script>
		<script src="js/main.js"></script>
	</body>
</html>