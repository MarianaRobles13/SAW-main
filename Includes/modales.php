
		<!--------- Modal de Inicio de sesión --------->
		<div class="modal fade" id="myModal">
  			<div class="modal-dialog">
    			<div class="modal-content" id="body">

		 			<form action="#" method="POST" id="form">
						<div class="form">
							<!-- Modal Header -->
      						<div class="modal-header">
        						<h4 class="modal-title">Iniciar sesión</h4>
        						<button type="button" class="btn-close" data-bs-dismiss="modal"></button>
							</div>

      						<!-- Modal body -->
      						<div class="modal-body">
								<div class="grupo">
        							<input id="usernametext" type="text" required name="Username"><span class="barra"></span>
									<label class="username">Ingresar usuario:</label>
								</div>
								<div class="grupo">
									<div class="input-group-btn">
        								<input id="password_login" type="password" required name="Contrasena"><span class="barra"></span>
										<label class="password">Ingresar contraseña:</label>
									</div>
								</div>
									<input id="checkbox" type="checkbox" onclick="verpassword()"><div id="show">Mostrar contraseña</div>
          							<input id="boton_iniciar" type="submit" value="Iniciar sesión" name="iniciar">
     						</div>
						</div>
					</form>
    			</div>
  			</div>
		</div>
		<!--------- Modal de Registro de Usuario --------->
		<div class="modal fade" id="myModal2">
  			<div class="modal-dialog">
    			<div class="modal-content" id="body">

					<form action="#" method="POST"  id="form">
						<div class="form">
							<!-- Modal Header -->
							<div class="modal-header">
								<h4 class="modal-title">Registrarse</h4>
        						<button type="button" class="btn-close" data-bs-dismiss="modal"></button>
							</div>

      						<!-- Modal body -->
							<div class="modal-body">
								<div class="grupo" id="pregunta_1">
								<?php if(isset($_POST["Nombre"])){ ?>
										<input class="input" type="text" name="Nombre" id="Nombre" required value="<?php echo $_POST['Nombre'];?>"><span class="barra"></span>
								<?php }else{ ?>
									<input class="input" type="text" name="Nombre" id="Nombre" required><span class="barra"></span>
								<?php }?>
									<label for="Nombre">Nombre:</label>
								</div>

									<input class="boton_mostrar" id="siguiente_1" onclick="javascript:mostrar1()" type="button" value="Siguiente" name="Mostrar">
									
								<div class="grupo" id="pregunta_2">
								<?php if(isset($_POST["Apellido"])){ ?>
									<input class="input" type="text" name="Apellido" id="Apellido" required value="<?php echo $_POST['Apellido'];?>"><span class="barra"></span>
								<?php }else{ ?>
									<input class="input" type="text" name="Apellido" id="Apellido" required><span class="barra"></span>
								<?php }?>
									<label for="Apellido">Apellido:</label>
								</div>
									
									<input class="boton_mostrar" id="siguiente_2" onclick="javascript:mostrar2()" type="button" value="Siguiente" name="Mostrar">
									
								<div class="grupo" id="pregunta_3">
								<?php if(isset($_POST["Telefono"])){ ?>
									<input class="input" type="number" pattern="/^-?\d+\.?\d*$/" onKeyPress="if(this.value.length==10) return false;" name="Telefono" id="Telefono" required value="<?php echo $_POST['Telefono'];?>"><span class="barra"></span>
								<?php }else{ ?>
									<input class="input" type="number" pattern="/^-?\d+\.?\d*$/" onKeyPress="if(this.value.length==10) return false;" name="Telefono" id="Telefono" required><span class="barra"></span>
								<?php }?>
									<label for="Telefono">Numero Telefonico:</label>
								</div>
									
									<input class="boton_mostrar" id="siguiente_3" onclick="javascript:mostrar3()" type="button" value="Siguiente" name="Mostrar">
									
								<div class="grupo" id="pregunta_4">
								<?php if(isset($_POST["Email"])){ ?>
									<input class="input" type="text" name="Email" id="Email" required value="<?php echo $_POST['Email'];?>"><span class="barra"></span>
								<?php }else{ ?>
									<input class="input" type="text" name="Email" id="Email" required><span class="barra"></span>
								<?php }?>
									<label for="Email">Correo Electronico:</label>
								</div>
									
									<input class="boton_mostrar" id="siguiente_4" onclick="javascript:mostrar4()" type="button" value="Siguiente" name="Mostrar">
									
								<div class="grupo" id="pregunta_5">
								<?php if(isset($_POST["Username"])){ ?>
									<input class="input" type="text" name="Username" id="Username" required value="<?php echo $_POST['Username'];?>"><span class="barra"></span>
								<?php }else{ ?>
									<input class="input" type="text" name="Username" id="Username" required><span class="barra"></span>
								<?php }?>
									<label for="Username">Nombre de usuario:</label>
								</div>
									
									<input class="boton_mostrar" id="siguiente_5" onclick="javascript:mostrar5()" type="button" value="Siguiente" name="Mostrar">
									
								<div class="grupo" id="pregunta_6">
								<?php if(isset($_POST["Contrasena"])){ ?>
									<input class="input" type="text" name="Contrasena" id="Contrasena" required value="<?php echo $_POST['Contrasena'];?>"><span class="barra"></span>
								<?php }else{ ?>
									<input class="input" type="text" name="Contrasena" id="Contrasena" required><span class="barra"></span>
								<?php }?>
									<label for="Contrasena">Contraseña:</label>
								</div>
									
									<input class="boton_mostrar" id="siguiente_6" onclick="javascript:mostrar6()" type="button" value="Siguiente" name="Mostrar">
									
								<div class="grupo" id="pregunta_7">
									<label id="Pais">Pais:</label>
									<div id="seleccion">
										<?php 
										$query_pais = mysqli_query($conexion, "SELECT id, Pais FROM tpaises");
										$result_pais = mysqli_num_rows($query_pais);
										?>
										<select name="TPaises_id" id="TPaises_id">
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
								</div>
									
									<input class="boton_mostrar" id="siguiente_7" onclick="javascript:mostrar7()" type="button" value="Siguiente" name="Mostrar">
									
								<div class="grupo" id="pregunta_8">
									<label id="Estado">Estado:</label>
									<div id="seleccion">
										<?php 
										$query_estado = mysqli_query($conexion, "SELECT id, Estado FROM testados");
										$result_estado = mysqli_num_rows($query_estado);
										?>
										<select name="TEstados_id" id="TEstados_id" required>
											<option value="#">Elige tu estado</option>
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
								</div>
									
									<input class="boton_mostrar" id="siguiente_8" onclick="javascript:mostrar8()" type="button" value="Siguiente" name="Mostrar">
									
								<div class="grupo" id="pregunta_9">
									<label id="Ciudad">Ciudad:</label>
									<div id="seleccion">
										
										<select name="TCiudades_id" id="TCiudades_id" required></select>
									
									</div>
								</div>
									
									<input class="boton_mostrar" id="siguiente_9" onclick="javascript:mostrar9()" type="button" value="Siguiente" name="Mostrar">
								
								<div class="grupo" id="pregunta_10">
									<label id="CPostal">C. Postal:</label>
									<div id="seleccion">
								
										<select name="TCPostales_id" id="TCPostales_id" required></select>
									
									</div>
								</div>

									<input class="boton_mostrar" id="siguiente_10" onclick="javascript:mostrar10()" type="button" value="Siguiente" name="Mostrar">

								<div class="grupo" id="pregunta_11">
									<label id="Colonia">Colonia:</label>
									<div id="seleccion">
				
										<select name="TColonias_id" id="TColonias_id" required></select>
									
									</div>
								</div>
									
									<input class="boton_mostrar" id="siguiente_11" onclick="javascript:mostrar11()" type="button" value="Siguiente" name="Mostrar">
									
								<div class="grupo" id="pregunta_12">
								<?php if(isset($_POST["CalleYNumero"])){ ?>
									<input class="input" type="text" name="CalleYNumero" id="CalleYNumero" required value="<?php echo $_POST['CalleYNumero'];?>"><span class="barra"></span>
								<?php }else{ ?>
									<input class="input" type="text" name="CalleYNumero" id="CalleYNumero" required><span class="barra"></span>
								<?php }?>
									<label for="CalleYNumero">Calle y Numero:</label>
								</div>
									
									<input class="boton_mostrar" id="siguiente_12" onclick="javascript:mostrar12()" type="button" value="Siguiente" name="Mostrar">
									
								<input type="hidden" id="TUsuarios_id" name="TUsuarios_id">				
								<input id="btn_regist" type="submit" value="Registrarse" name="enviar">
							</div>
						</div>
					</form>
    			</div>
  			</div>
		</div>