<?php
	if (isset($_POST["enviar"])) {
		$Nombre=$_POST["Nombre"];
		$Apellido=$_POST["Apellido"];
		$Telefono=$_POST["Telefono"];
		$Email=$_POST["Email"];
		$Username=$_POST["Username"];
		$Contrasena=$_POST["Contrasena"];
		$CalleYNumero=$_POST["CalleYNumero"];
		$TColonias_id=$_POST["TColonias_id"];
		$TCPostales_id=$_POST["TCPostales_id"];
		$TCiudades_id=$_POST["TCiudades_id"];
		$TEstados_id=$_POST["TEstados_id"];
		$TPaises_id=$_POST["TPaises_id"];
		$TUsuarios_id=$_POST["TUsuarios_id"];
		

		//$Contrasena_Encode = password_hash($Contrasena, PASSWORD_DEFAULT);

		include_once 'Conexion.php';

		$consulta="SELECT Username FROM tusuarios WHERE Username = '".$Username."'";
		$result=mysqli_query($conexion, $consulta);

		if(mysqli_num_rows($result)>0){
			echo "<div id='login_usuario' data-bs-toggle='modal' data-bs-target='#myModal2'>Ya existe este nombre de usuario, ingrese otro <a class='btn' href='#'><button onclick='javascript:mostrar13()' class='btn'>Aceptar</button></a></div>";
		}else{

		$insertar="INSERT INTO tusuarios (`id`, `Nombre`, `Apellido`, `Username`, `Contrasena`, `CalleYNumero`, `TColonias_id`, `TRoles_id`) VALUES (
			NULL,
			'$Nombre',
			'$Apellido',
			'$Username',
			'$Contrasena',
			'$CalleYNumero',
			'$TColonias_id',
			 DEFAULT)";
			$query=mysqli_query($conexion, $insertar);

		$insertar2="INSERT INTO temailusr (`id`, `Email`, `TUsuarios_id`) VALUES (
			NULL,
			'$Email',
			(SELECT MAX(id) FROM tusuarios))";
			$quy2=mysqli_query($conexion, $insertar2);
		
		if(isset($TUsuarios_id)){
			$insertar8="INSERT INTO ttelefonosusr (`id`, `Telefono`, `TUsuarios_id`) VALUES 
				(NULL,
				'$Telefono',
				(SELECT MAX(id) FROM tusuarios))";
				$quy8=mysqli_query($conexion, $insertar8);

			
			
			?>
				<div class="content" id='login_usuario'>Registrando usuario...</div>
				<div class="content2" style="display:none;" id='login_usuario'>Usuario registrado con exito! <a class='btn' href='menu_principal.php'><button class='btn'>Aceptar</button></a></div>
	
				<script src="https://code.jquery.com/jquery-3.2.1.js"></script>
				<script type="text/javascript">
					$(document).ready(function() {
						setTimeout(function() {
							$(".content").fadeOut(1500);
						},3000);
	 
						setTimeout(function() {
							$(".content2").fadeIn(1500);
						},6000);
					});
				</script>
	
			<?php

			//header("Location: menu_principal.php");
		}
		}
	}
?>