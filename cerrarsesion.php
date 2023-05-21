<?php 
	session_start();

	if(isset($_GET['action']) && ('logout' == $_GET['action'])){
        session_unset(); 

        // destroy the session 
        session_destroy();
		
		header('Location: menu_principal.php');
    }

 ?>