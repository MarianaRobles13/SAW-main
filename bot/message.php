<?php
// conectando a la base de datos
$conn = mysqli_connect("localhost", "root", "Antony1201", "bdcupcake") or die("Database Error");

// obteniendo el mensaje del usuario a través de ajax
$getMesg = mysqli_real_escape_string($conn, $_GET['msg']);

//comprobando la consulta del usuario a la consulta de la base de datos
$check_data = "SELECT * FROM chatbot WHERE messages LIKE '%$getMesg%'";
$run_query = mysqli_query($conn, $check_data) or die("Error");

// si la consulta del usuario coincide con la consulta de la base de datos, mostraremos la respuesta; de lo contrario, irá a otra declaración
if (mysqli_num_rows($run_query) > 0) {
    //recuperando la reproducción de la base de datos de acuerdo con la consulta del usuario
    $fetch_data = mysqli_fetch_assoc($run_query);
    //almacenando la respuesta a una variable que enviaremos a ajax
    $replay = $fetch_data['response'];
    echo $replay;
	
} else {
    echo "Lo siento, por el momento desconosco de esa información.
    
    </br><a href='https://www.configuroweb.com/contacto/'>Contacto</a>";
}