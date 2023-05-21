<?php
// conectando a la base de datos
$conn = mysqli_connect("localhost", "root", "Antony1201", "bdcupcake") or die("Database Error");

$check_data = "SELECT * FROM chatbot";
$run_query = mysqli_query($conn, $check_data) or die("Error");
$fetch_data = mysqli_fetch_assoc($run_query);
$replay = $fetch_data['response'];

include "Bot.php";
$bot = new Bot;
//INTENCIONES DEL CHATBOT
include_once "intenciones.php";




/*----JAVASCRIPT------------------------------------------------------------------*/
function eliminar_acentos($cadena){
		
    //Reemplazamos la A y a
    $cadena = str_replace(
    array('Á', 'À', 'Â', 'Ä', 'á', 'à', 'ä', 'â', 'ª'),
    array('A', 'A', 'A', 'A', 'a', 'a', 'a', 'a', 'a'),
    $cadena
    );

    //Reemplazamos la E y e
    $cadena = str_replace(
    array('É', 'È', 'Ê', 'Ë', 'é', 'è', 'ë', 'ê'),
    array('E', 'E', 'E', 'E', 'e', 'e', 'e', 'e'),
    $cadena );

    //Reemplazamos la I y i
    $cadena = str_replace(
    array('Í', 'Ì', 'Ï', 'Î', 'í', 'ì', 'ï', 'î'),
    array('I', 'I', 'I', 'I', 'i', 'i', 'i', 'i'),
    $cadena );

    //Reemplazamos la O y o
    $cadena = str_replace(
    array('Ó', 'Ò', 'Ö', 'Ô', 'ó', 'ò', 'ö', 'ô'),
    array('O', 'O', 'O', 'O', 'o', 'o', 'o', 'o'),
    $cadena );

    //Reemplazamos la U y u
    $cadena = str_replace(
    array('Ú', 'Ù', 'Û', 'Ü', 'ú', 'ù', 'ü', 'û'),
    array('U', 'U', 'U', 'U', 'u', 'u', 'u', 'u'),
    $cadena );

    //Reemplazamos la N, n, C y c
    $cadena = str_replace(
    array('Ñ', 'ñ', 'Ç', 'ç'),
    array('N', 'n', 'C', 'c'),
    $cadena
    );
    
    return $cadena;
}

function Quitar_Espacios($Frase)
    {
        $Frase_Bien = preg_replace(array('/\s{2,}/', '/[\t\n]/'), ' ', $Frase);
        
        return $Frase_Bien;
    }


if (isset($_GET['msg'])) {
    
    $cadena = eliminar_acentos($_GET['msg']);
    $Frase_Bien = Quitar_Espacios($cadena);
    $msg = strtolower($Frase_Bien);

    $bot->hears($msg, function (Bot $botty) {
        global $msg;
        global $questions;
        if ($msg == 'hi' || $msg == "hello" || $msg == "hey") {
            $botty->reply('Hola');
        } elseif ($botty->ask($msg, $questions) == "") {
            /*include_once '../message.php';*/
            $conn = mysqli_connect("localhost", "root", "Antony1201", "bdcupcake") or die("Database Error");
            $query_insert = "INSERT INTO `chatbot`(`id`, `messages`) VALUES (NULL,'$msg')";
            $query=mysqli_query($conn, $query_insert);

            $botty->reply("Lo siento, por el momento desconosco de esa información. Pero puede ponerse en contacto con el administrador para cualquier duda <a id='mensaje_bot_error' href='https://wa.me/+523223227013'>Contacto</a>");
        } else {
            $botty->reply($botty->ask($msg,$questions));
        }
    });
}
/*----FIN DE JAVASCRIPT-------------------------------------------------------------*/