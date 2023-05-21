<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" media="only screen and (max-width: 1068px)" href="Estilos/formulario.css">
	<!--<link rel="stylesheet" type="text/css" href="Estilos/formulario.css">-->
	<title>Comprimir imagen</title>
</head>

<body>
	<h1>Comprimir imagen</h1>

	<!--<a href="https://parzibyte.me/blog">By Parzibyte</a>
	<br>-->
	
	<label for="imagen">Seleccione una imagen:</label>
	<br>
	<input type="file" id="imagen">
	<br>
	<br>
	<label for="calidad">Calidad:</label>
	<input type="range" step="1" min="1" max="100" id="calidad">
	<br>
	<br>
	<a href="formulario.php">Nueva Imagen</a>
	<hr>

	
	<br>
	<button id="btnComprimirBlob">Comprimir y obtener como blob</button>
	<br>

	<br>
	<button id="btnComprimirPrevisualizar">Comprimir y visualizar</button>
	<img style="max-width: 100%;" src="" alt="" id="imagenPrevisualizar">
	<br>
	<br>
	<button id="btnComprimirDescargar">Comprimir y descargar</button>

</body>



<script>

	const $imagen = document.querySelector("#imagen"),
		$calidad = document.querySelector("#calidad"),
		$imagenPrevisualizar = document.querySelector("#imagenPrevisualizar");
	
	const comprimirImagen = (imagenComoArchivo, porcentajeCalidad) => {
		
		return new Promise((resolve, reject) => {
			const $canvas = document.createElement("canvas");
			const imagen = new Image();
			imagen.onload = () => {
				$canvas.width = imagen.width;
				$canvas.height = imagen.height;
				$canvas.getContext("2d").drawImage(imagen, 0, 0);
				$canvas.toBlob(
					(blob) => {
						if (blob === null) {
							return reject(blob);
						} else {
							resolve(blob);
						}
					},
					"image/jpeg",
					porcentajeCalidad / 100
				);
			};
			imagen.src = URL.createObjectURL(imagenComoArchivo);
		});
	};

	document.querySelector("#btnComprimirBlob").addEventListener("click", async () => {
		if ($imagen.files.length <= 0) {
			return;
		}
		const archivo = $imagen.files[0];
		const blob = await comprimirImagen(archivo, parseInt($calidad.value));
		// Ya puedes subir este archivo con FormData por ejemplo:
		//https://parzibyte.me/blog/2018/11/06/cargar-archivo-php-javascript-formdata/
		console.log({ blob });
	});

	document.querySelector("#btnComprimirPrevisualizar").addEventListener("click", async () => {
		if ($imagen.files.length <= 0) {
			return;
		}
		const archivo = $imagen.files[0];
		const blob = await comprimirImagen(archivo, parseInt($calidad.value));
		$imagenPrevisualizar.src = URL.createObjectURL(blob);
	});

	document.querySelector("#btnComprimirDescargar").addEventListener("click", async () => {
		if ($imagen.files.length <= 0) {
			return;
		}
		const archivo = $imagen.files[0];
		const blob = await comprimirImagen(archivo, parseInt($calidad.value));
		const url = URL.createObjectURL(blob);
		const enlace = document.createElement("a");
		enlace.href = url;
		enlace.download = "Imagen comprimida.jpg";
		enlace.click();
	});

</script>

</html>