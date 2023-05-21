/* Funciones Javascript de Iniciar sesion y Registro de usuarios */


/*--------------------Boton siguiente--------------------*/
	function mostrar1(){
		document.getElementById("pregunta_1").style.display="none";
		document.getElementById("siguiente_1").style.display="none";
		document.getElementById("pregunta_2").style.display="block";
		document.getElementById("siguiente_2").style.display="block";
	}

	function mostrar2(){
		document.getElementById("pregunta_2").style.display="none";
		document.getElementById("siguiente_2").style.display="none";
		document.getElementById("pregunta_3").style.display="block";
		document.getElementById("siguiente_3").style.display="block";
	}

	function mostrar3(){
		document.getElementById("pregunta_3").style.display="none";
		document.getElementById("siguiente_3").style.display="none";
		document.getElementById("pregunta_4").style.display="block";
		document.getElementById("siguiente_4").style.display="block";
	}

	function mostrar4(){
		document.getElementById("pregunta_4").style.display="none";
		document.getElementById("siguiente_4").style.display="none";
		document.getElementById("pregunta_5").style.display="block";
		document.getElementById("siguiente_5").style.display="block";
	}

	function mostrar5(){
		document.getElementById("pregunta_5").style.display="none";
		document.getElementById("siguiente_5").style.display="none";
		document.getElementById("pregunta_6").style.display="block";
		document.getElementById("siguiente_6").style.display="block";
	}

	function mostrar6(){
		document.getElementById("pregunta_6").style.display="none";
		document.getElementById("siguiente_6").style.display="none";
		document.getElementById("pregunta_7").style.display="block";
		document.getElementById("siguiente_7").style.display="block";
	}

	function mostrar7(){
		document.getElementById("pregunta_7").style.display="none";
		document.getElementById("siguiente_7").style.display="none";
		document.getElementById("pregunta_8").style.display="block";
		document.getElementById("siguiente_8").style.display="block";
	}

	function mostrar8(){
		document.getElementById("pregunta_8").style.display="none";
		document.getElementById("siguiente_8").style.display="none";
		document.getElementById("pregunta_9").style.display="block";
		document.getElementById("siguiente_9").style.display="block";
	}

	function mostrar9(){
		document.getElementById("pregunta_9").style.display="none";
		document.getElementById("siguiente_9").style.display="none";
		document.getElementById("pregunta_10").style.display="block";
		document.getElementById("siguiente_10").style.display="block";
	}

	function mostrar10(){
		document.getElementById("pregunta_10").style.display="none";
		document.getElementById("siguiente_10").style.display="none";
		document.getElementById("pregunta_11").style.display="block";
		document.getElementById("siguiente_11").style.display="block";
	}

	function mostrar11(){
		document.getElementById("pregunta_11").style.display="none";
		document.getElementById("siguiente_11").style.display="none";
		document.getElementById("pregunta_12").style.display="block";
		document.getElementById("siguiente_12").style.display="block";
	}

	function mostrar12(){
		document.getElementById("pregunta_12").style.display="none";
		document.getElementById("siguiente_12").style.display="none";
		document.getElementById("pregunta_1").style.display="block";
		document.getElementById("pregunta_2").style.display="block";
		document.getElementById("pregunta_3").style.display="block";
		document.getElementById("pregunta_4").style.display="block";
		document.getElementById("pregunta_5").style.display="block";
		document.getElementById("pregunta_6").style.display="block";
		document.getElementById("pregunta_7").style.display="block";
		document.getElementById("pregunta_8").style.display="block";
		document.getElementById("pregunta_9").style.display="block";
		document.getElementById("pregunta_10").style.display="block";
		document.getElementById("pregunta_11").style.display="block";
		document.getElementById("pregunta_12").style.display="block";
		document.getElementById("btn_regist").style.display="block";
	}

	function mostrar13(){
		document.getElementById("pregunta_12").style.display="none";
		document.getElementById("siguiente_12").style.display="none";
		document.getElementById("siguiente_1").style.display="none";
		document.getElementById("pregunta_1").style.display="block";
		document.getElementById("pregunta_2").style.display="block";
		document.getElementById("pregunta_3").style.display="block";
		document.getElementById("pregunta_4").style.display="block";
		document.getElementById("pregunta_5").style.display="block";
		document.getElementById("pregunta_6").style.display="block";
		document.getElementById("pregunta_7").style.display="block";
		document.getElementById("pregunta_8").style.display="block";
		document.getElementById("pregunta_9").style.display="block";
		document.getElementById("pregunta_10").style.display="block";
		document.getElementById("pregunta_11").style.display="block";
		document.getElementById("pregunta_12").style.display="block";
		document.getElementById("btn_regist").style.display="block";
	}
/*----------------Fin de boton siguiente-----------------*/


/*------------------Ocultar contraseña-------------------*/
	function verpassword(){
        var tipo = document.getElementById("password_login");
        if (tipo.type == "password"){
        	tipo.type = "text";
        }else{
        	tipo.type = "password";
        }
    }
/*---------------Fin de ocultar contraseña---------------*/


/*-------------------Selector de dirección--------------------*/
	$(document).ready(function(){
    	$("#TEstados_id").on('change', function () {
        	$("#TEstados_id option:selected").each(function () {
        		estadoselegidos=$(this).val();
    			$.post("buscardireccion.php", { estadoselegidos: estadoselegidos }, function(data){
    			    $("#TCiudades_id").html(data);
    			});         
    		});
		});
	});

	$(document).ready(function(){
    	$("#TCiudades_id").on('change', function () {
        	$("#TCiudades_id option:selected").each(function () {
        		ciudadeselegidos=$(this).val();
    			$.post("buscardireccion.php", { ciudadeselegidos: ciudadeselegidos }, function(data){
    				$("#TCPostales_id").html(data);
    			});         
    		});
		});
	});

	$(document).ready(function(){
    	$("#TCPostales_id").on('change', function () {
        	$("#TCPostales_id option:selected").each(function () {
        		cpostaleselegidos=$(this).val();
    			$.post("buscardireccion.php", { cpostaleselegidos: cpostaleselegidos }, function(data){
    			    $("#TColonias_id").html(data);
    			});         
    		});
		});
	});
/*-----------------Fin selector de dirección------------------*/