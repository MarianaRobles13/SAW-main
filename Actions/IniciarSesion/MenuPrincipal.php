<?php
	if(isset($_SESSION['troles'])){
		switch($_SESSION['troles']){
			case 1:
				header('Location: menu_principal.php');
			break;
	
			case 2:
				header('Location: menu_principal.php');
			break;
	
			default:
		}
	}

    if(isset($_POST['iniciar'])){
    	if(isset($_POST['Username']) && isset($_POST['Contrasena'])){
        	$Username = $_POST['Username'];
        	$Contrasena = $_POST['Contrasena'];

        	$db = new Database();
        	$query = $db->connect()->prepare('SELECT *FROM tusuarios WHERE Username = BINARY :Username AND Contrasena = BINARY :Contrasena');
        	$query->execute(['Username' => $Username, 'Contrasena' => $Contrasena]);

        	$row = $query->fetch(PDO::FETCH_NUM);
        
        	if($row == true){
            	//validar rol
           		$troles = $row[7];
            
            	$_SESSION['troles'] = $troles;

				$IDuser = $row[0];
				$_SESSION['user_id'] = $IDuser;
            	switch($troles){
                case 1:
            	        header("Location: menu_principal.php");
           		    break;

        	        case 2:
        		        header("Location: menu_principal.php");
        	        break;

        	        default:
        	    }
        	}else{
        	    // no existe el usuario
        	    echo "<div id='login_usuario'>Nombre de usuario o contraseña incorrecto  <a class='btn' href='menu_principal.php'><button class='btn'>Aceptar</button></a></div>";
        	}
        
        	$_SESSION['Username'] = $Username;
    	}
	}
?>