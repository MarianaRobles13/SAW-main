<link rel="stylesheet" type="text/css" href="Estilos/estilos_tarjetas.css">
<link rel="stylesheet" type="text/css" href="Estilos/swiper_bundle_min.css">

<div class="body_target">
<section>

<div class="swiper mySwiper tarjetas">
<div class="swiper-wrapper content">
<?php
	$query = mysqli_query($conexion, "SELECT tarticulos.id, tarticulos.Nombre, tarticulos.Stock, tarticulos.Descripcion, FORMAT(tarticulos.Precio, 2) AS moneda, 
	tarticulos.foto FROM tarticulos
	WHERE tarticulos.Stock = 1 /*ORDER BY tarticulos.Nombre ASC*/ LIMIT 6");

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
	
			<div class="swiper-slide card" id="tarjetas_destacados">
				<div class="card-content">
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
						<a href="pagina_pedidos.php?id=<?php echo $data["id"]; ?>" class="boton">Solicitar</a>
					<?php	}else{ ?>
						<a class="boton">Inicia Sesión</a>
					<?php	}?>
					</div>
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
</div>
		<div class="swiper-button-next"></div>
    	<div class="swiper-button-prev"></div>
    	<div class="swiper-pagination"></div>
</section>
</div>

<!-----------------------Javascript para el carrusel de productos--------------------->
<!-- Swiper JS -->
<script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>

<!-- Initialize Swiper -->
<script>
  var swiper = new Swiper(".mySwiper", {
	slidesPerView: 3,
	spaceBetween: 25,
	loop: true,
	centerSlide: 'true',
	fade: 'true',
	grapCursor:'true',
	pagination: {
	  el: ".swiper-pagination",
	  clickable: true,
	  dynamicBullets: true,
	},
	navigation: {
	  nextEl: ".swiper-button-next",
	  prevEl: ".swiper-button-prev",
	},
	breakpoints:{
		0:{
			slidesPerView: 1,
		},
		375:{
			slidesPerView: 1,
		},
		576:{
			slidesPerView: 1,
		},
		700:{
			slidesPerView: 2,
		},
		768:{
			slidesPerView: 2,
		},
		1000:{
			slidesPerView: 3,
		},
		1200:{
			slidesPerView: 3,
		},
	},
  });
</script>

<script>
var popoverTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="popover"]'))
var popoverList = popoverTriggerList.map(function (popoverTriggerEl) {
  return new bootstrap.Popover(popoverTriggerEl)
})
</script>
<!-----------------------Fin del javascript para el carrusel de productos--------------------->
