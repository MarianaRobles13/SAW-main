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
						<a id="op_menu" class="nav-link" href="menu_principal.php">Regresar</a>
					</li>
				</ul>
			</div>

			<a class="navbar-brand-collapse w-1"  href="javascript:abrir()">
				<img class="imagen_2" src="Imagenes/logo_usuario.png" alt="Log in">
			</a>
		</div>
		</nav>

	
		<div id="cuerpo">

		        <div id="tabla_registros">
                <table id="tabla1" class="tabla_pedidos">
		        <tr><th colspan="9"><h1>Tu lista de pedidos</h1></th></tr>
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
                                                        WHERE tventas.TUsuarios_id = '$Info[id]' ORDER BY tventas.Fecha_pedido ASC/*LIMIT $desde,$por_pagina*/");

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
                    <?php 	if($data["Estado_pedido"] == 0){ ?>
					        <td>En proceso</td>
				    <?php	}else if ($data["Estado_pedido"] == 1) {?>
                            <td>Cancelado</td>
                    <?php   }else if ($data["Estado_pedido"] == 2) {?>
                            <td>Completado</td>
                    <?php   }?>
				        </tr>	
			    <?php
				        }
			        }
			    ?>
		        </table>
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