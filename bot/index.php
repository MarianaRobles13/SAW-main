<link rel="stylesheet" href="bot/css/style.css">

<div class="chatcontainer" id="chatcontainer">    
        <div class="chatbox">
            <div class="chatheader">
                    <div id="img-asistant"><h4> <img src='bot/img/perfil.png' class='imgRedonda'/> CakeBot </h4></div>
                    <div id="close_chatbot"><a id="botonchatbot_cerrar"><img id="close_img_chatbot" src="Imagenes/close.png"></a></div>
            </div>
                    
            <div class="chatbody" id="chatbody">
                <?php
                    if(isset($_SESSION['troles'])){
                ?>
                    <p class="asisbot">¡Hola! soy CakeBot, Bienvenido(a) de nuevo <?php echo "" . $_SESSION["Username"]; echo "";?> al sitio web de la Pastelería Fantasy of Love.</p>
                <?php    
                    }else{
                ?>
                    <p class="asisbot">¡Hola! soy CakeBot, Bienvenido(a) usuario invitado al sitio web de la Pastelería Fantasy of Love.</p>
                <?php
                    }
                ?>
                    <div class="scroller" id="scroller"></div>
            </div>

            <form class="chat" method="post" autocomplete="off">
                <div>
                    <input type="text" name="chat" id="chat" placeholder="¿Cuál es tu pregunta?">
                    <button type="submit" value="Enviar" id="btn"><i style="margin-left: -3px; margin-top: -2px;" class="fa-solid fa-paper-plane"></i></button>
                </div>
            </form>
        </div>
    </div>


<!--JAVASCRIPT------------------------------------------------------------------>
<script src="bot/app.js"></script>
<script>
    $('#btn').on('click',function()
        {
        //Le agrego otro ''Mensaje''
        $('#chatbody').append('<div class="chatMessage"></div>');
        //Fijo el scroll al fondo usando añadiendo una animación (animate)
        $("#chatbody").animate({ scrollTop: $('#chatbody').prop("scrollHeight")}, 1000);
    });

    $('#botonchatbot').on('click',function()
        {
        //Le agrego otro ''Mensaje''
        $('#chatbody').append('<div class="chatMessage"></div>');
        //Fijo el scroll al fondo usando añadiendo una animación (animate)
        $("#chatbody").animate({ scrollTop: $('#chatbody').prop("scrollHeight")}, 1000);
    });
</script>