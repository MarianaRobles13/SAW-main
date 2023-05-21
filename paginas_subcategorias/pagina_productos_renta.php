<link rel="stylesheet" type="text/css" href="Estilos/estilos_tarjetas_productos.css">

<div id="contenedor_tarjetas">
<?php
	$query = mysqli_query($conexion, "SELECT tarticulos.id, tarticulos.Nombre, tarticulos.Stock, tarticulos.Descripcion, FORMAT(tarticulos.Precio, 2) AS moneda, tarticulos.TSubCategoria_id,
	tarticulos.foto FROM tarticulos
	WHERE tarticulos.Stock = 1 AND tarticulos.TSubCategoria_id = 9 ORDER BY tarticulos.Nombre ASC");

	$result = mysqli_num_rows($query);
	if($result > 0){

	while ($data = mysqli_fetch_array($query)){
	if($data['foto'] != 'img_producto.png'){
		$foto = 'Imagenes/img_temporal/'.$data['foto'];
	}else{
		$foto = 'Imagenes/'.$data['foto'];
	}
?>	
		
		<?php if($data["Stock"] == 1)
		{ ?>
	
			<div class="card" id="tarjetas">
				<img class="imagen_tarjeta" class="card-img-top" src="<?php echo $foto; ?>" alt="<?php echo $data["Nombre"]; ?>">
					<div>
						<h4 class="text-titulo"><?php echo $data["Nombre"]; ?></h4>
						<div class="boton-detalles">
							<a title="<?php echo $data["Nombre"]; ?>" data-bs-toggle="popover" data-bs-trigger="hover" data-bs-placement="bottom" data-bs-content="<?php echo $data["Descripcion"]; ?>">Detalles</a>
						</div>
						<p class="text-moneda"><?php echo "$".$data["moneda"]." MXN"; ?></p>
					<?php 	if($data["Stock"] == 1){ ?>
						<p class="text-stock">Disponible</p>
					<?php	}else{ ?>
						<p class="text-stock">Agotado</p>
					<?php	}?>
					<div class="boton-borde">
					<?php 	if(isset($_SESSION['troles'])){ ?>
						<a href="pagina_pedidos_servicios.php?id=<?php echo $data["id"]; ?>" class="boton">Solicitar</a>
					<?php	}else{ ?>
						<a class="boton">Inicia Sesión</a>
					<?php	}?>
					</div>
					</div>
					
			</div>
<?php
		}
?>	
<?php 
	}
	}
?>
</div>

<!-----------------------Javascript para el carrusel de productos--------------------->
<script>
var popoverTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="popover"]'))
var popoverList = popoverTriggerList.map(function (popoverTriggerEl) {
  return new bootstrap.Popover(popoverTriggerEl)
})
</script>
<!-----------------------Fin del javascript para el carrusel de productos--------------------->
