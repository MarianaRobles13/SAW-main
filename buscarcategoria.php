<?php

    $html = "";
    if ($_POST["categoriaelegida"]==1) {
        $html = '';
        include 'Conexion.php';
        $query_subCategoria = mysqli_query($conexion, "SELECT id, SubCategoria FROM tsubCategoria WHERE id = 1 OR id = 2 OR id = 3 OR id = 4");
        $result_subCategoria = mysqli_num_rows($query_subCategoria);
        $html = '';
        
			if($result_subCategoria > 0){
				while($tsubCategoria = mysqli_fetch_array($query_subCategoria)){
			?>
				<option value="<?php echo $tsubCategoria["id"]; ?>"><?php echo $tsubCategoria["SubCategoria"]; ?></option>
			<?php
					}
				}  
    }
    if ($_POST["categoriaelegida"]==2) {
        $html = '';  
        include 'Conexion.php';
        $query_subCategoria = mysqli_query($conexion, "SELECT id, SubCategoria FROM tsubCategoria WHERE id = 5 OR id = 6");
        $result_subCategoria = mysqli_num_rows($query_subCategoria);
        $html = '';
        
			if($result_subCategoria > 0){
				while($tsubCategoria = mysqli_fetch_array($query_subCategoria)){
			?>
				<option value="<?php echo $tsubCategoria["id"]; ?>"><?php echo $tsubCategoria["SubCategoria"]; ?></option>
			<?php
					}
				}
    }
    if ($_POST["categoriaelegida"]==3) {
        include 'Conexion.php';
        $query_subCategoria = mysqli_query($conexion, "SELECT id, SubCategoria FROM tsubCategoria WHERE id = 7 OR id = 8 OR id = 9");
        $result_subCategoria = mysqli_num_rows($query_subCategoria);
        $html = '';
        
			if($result_subCategoria > 0){
				while($tsubCategoria = mysqli_fetch_array($query_subCategoria)){
			?>
				<option value="<?php echo $tsubCategoria["id"]; ?>"><?php echo $tsubCategoria["SubCategoria"]; ?></option>
			<?php
					}
				}
    }
    echo $html; 
    
?>