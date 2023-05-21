<?php
if (isset($_POST["contactar"])) {
    $Nombre_contact     = $_POST["Nombre_contact"];
    $E_mail_contact     = $_POST["E_mail_contact"];
    $Telefono_contact   = $_POST["Telefono_contact"];
    $Mensaje_contact    = $_POST["Mensaje_contact"];
    
    $query_articulo = mysqli_query($conexion, "SELECT * FROM tcontacto");
    $result_articulo = mysqli_num_rows($query_articulo);

    $query_insert = mysqli_query($conexion, "INSERT INTO `tcontacto`(`id`, `Nombre_contact`, `E_mail_contact`, `Telefono_contact`, `Mensaje_contact`, `Fecha_mensaje`) 
                                                    VALUES (NULL,'$Nombre_contact','$E_mail_contact','$Telefono_contact','$Mensaje_contact',DEFAULT)");

    if($query_insert){
        echo "<h2 id='producto'>Mensaje enviado correctamente <a class='btn' href='pagina_contacto2.php'><button class='btn'>Aceptar</button></a></h2>";
    }else{
        echo "<h2 id='producto_error'>Error al enviar mensaje</h2>";
    }
}
?>