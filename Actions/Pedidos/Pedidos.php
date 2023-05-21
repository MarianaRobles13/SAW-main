<?php

if(!isset ($_SESSION['troles'])){
    header('Location: menu_principal.php');
} else {
    if($_SESSION['troles'] != 1 AND $_SESSION['troles'] != 2){
        header('Location: menu_principal.php');
    }
}


/*================================= SOLICITUD DE PEDIDO =================================*/
if (isset($_POST["solicitar"])) {
    $Cantidad_soli  = $_POST["Cantidad_soli"];
    $Cantidad       = $_POST["Cantidad"];

    if ($Cantidad_soli == 0) {
        echo "<h2 id='producto_error'>No ingreso una cantidad</h2>";
    }else{
        if ($Cantidad == 0) {
            echo "<h2 class='pedido_existencias'>Ya no hay en existencias <a class='btn' href='menu_principal.php'><button class='btn'>Aceptar</button></a></h2>";
        }else{

            if ($Cantidad_soli > $Cantidad) {
                echo "<h2 class='pedido_disponible'>Sobrepasa la cantidad disponible, solicite una cantidad menor</h2>";
            }else{
                $Subtotal       = $_POST["Subtotal"];
                $IVA            = $_POST["IVA"];
                $Total          = $_POST["Total"];
                $TUsuarios_id   = $_POST["TUsuarios_id"];
                $TArticulos_id  = $_POST["TArticulos_id"];

                $query_articulo = mysqli_query($conexion, "SELECT * FROM tventas");
                $result_articulo = mysqli_num_rows($query_articulo);

                $query_insert = mysqli_query($conexion, "INSERT INTO `tventas`(`id_NTicket`, `Cantidad_soli`, `Subtotal`, `IVA`, `Total`, `TServicos_id`, `TUsuarios_id`, `TArticulos_id`) 
                                                                VALUES (NULL,'$Cantidad_soli','$Subtotal','$IVA','$Total',NULL,'$TUsuarios_id','$TArticulos_id')");
        
                if($query_insert){
                    echo "<h2 id='mensaje_pedido'>Pedido realizado correctamente <a class='btn' href='Lista_pedidos_usuarios.php'><button class='btn'>Aceptar</button></a></h2>";
                }else{
                    echo "<h2 id='producto_error'>Error al solicitar pedido</h2>";
                }
            }
        }
    }
}
/*================================= FIN SOLICITUD DE PEDIDO =================================*/


/*================================= ACTUALIZACIÓN DE STOCK EN LA TABLA TARTICULOS =================================*/
if (isset($_POST['solicitar'])) {
    $Cantidad_soli  = $_POST["Cantidad_soli"];
    $Cantidad       = $_POST["Cantidad"];

    if ($Cantidad_soli == 0) {
        echo "<h2 id='producto_error'>No ingreso una cantidad</h2>";
    }else{
        if ($Cantidad == 0) {
            echo "<h2 class='pedido_existencias'>Ya no hay en existencias <a class='btn' href='menu_principal.php'><button class='btn'>Aceptar</button></a></h2>";
            }else{
            if ($Cantidad_soli > $Cantidad) {
                echo "<h2 class='pedido_disponible'>Sobrepasa la cantidad disponible, solicite  una cantidad menor</h2>";
            }else{
                $id             = $_POST["id"];
                $Stock          = $_POST["Stock"];

            $Result= $_POST['Cantidad'] - $Cantidad_soli;

                if ($Result == 0) {
                    $Stock = 0;
                    $actualizar = mysqli_query($conexion, "UPDATE tarticulos 
                                                        SET Cantidad = $Result, Stock = $Stock
                                                        WHERE id = $id");
                }else{
                    $Stock = 1;
                    $actualizar = mysqli_query($conexion, "UPDATE tarticulos 
                                                        SET Cantidad = $Result, Stock = $Stock
                                                        WHERE id = $id");
                }	
            }
        }
    }
}
/*================================= FIN ACTUALIZACIÓN DE STOCK EN LA TABLA TARTICULOS =================================*/


/*================================= VALIDAR DATOS USUARIO =================================*/
if (!isset($_SESSION['Username'])) {
    header('location: menu_principal.php');
}else{
    $_USER = $_SESSION['Username'];
    $SQL = mysqli_query($conexion, "SELECT  tusuarios.id, tusuarios.Nombre, tusuarios.Apellido, tusuarios.Username, tusuarios.CalleYNumero, tusuarios.TColonias_id,
                                            tcolonias.Colonia, tcolonias.TCPostales_id, tcpostales.CPostal, tcpostales.TCiudades_id, tciudades.Ciudad, tciudades.TEstados_id,
                                            testados.Estado, testados.TPaises_id, tpaises.Pais
                                              FROM tusuarios
                                              INNER JOIN tcolonias ON tusuarios.TColonias_id = tcolonias.id
                                              INNER JOIN tcpostales ON tcolonias.TCPostales_id = tcpostales.id 
                                              INNER JOIN tciudades ON tcpostales.TCiudades_id = tciudades.id 
                                              INNER JOIN testados ON tciudades.TEstados_id = testados.id
                                              INNER JOIN tpaises ON testados.TPaises_id = tpaises.id 
                                            
                                            WHERE Username = '".$_USER."'");
    $Info = mysqli_fetch_assoc($SQL);
    /*print_r($Info);*/
}
/*================================= FIN VALIDAR DATOS USUARIO =================================*/


/*================================= VALIDAR DATOS =================================*/
if(empty($_REQUEST['id'])){
    header("location: menu_principal.php");
} else{
    
    $id = $_REQUEST['id'];
    if(!is_numeric($id)){
        header("location: menu_principal.php");
    }

    $query_producto = mysqli_query($conexion, "SELECT tarticulos.id, tarticulos.Nombre, tarticulos.Cantidad, tarticulos.Stock, tarticulos.Precio, 
                                                     tarticulos.TCategoria_id, tcategoria.Categoria
                                                FROM tarticulos 
                                                INNER JOIN tcategoria ON tarticulos.TCategoria_id = tcategoria.id 
                                                WHERE tarticulos.id = $id");
    $result_producto = mysqli_num_rows($query_producto);

    if($result_producto > 0){
        $data_producto = mysqli_fetch_assoc($query_producto);
        
        if ($data_producto['Cantidad'] == 0) {
            $data_producto['Stock'] = 0;
        }else{
            $data_producto['Stock'] = 1;
        }
        /*print_r($data_producto);*/
    }
}
/*================================= FIN VALIDAR DATOS=================================*/
?>