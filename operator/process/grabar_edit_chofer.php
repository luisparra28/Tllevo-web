<?php
require_once ("../../config/db.php");
require_once ("../../config/conexion.php");
mysqli_autocommit($con, false);

$id_chof       		  = $_POST["id_chof"];
$pro_rut            = $_POST["pro_rut"];
$pro_nombres     	  = utf8_decode($_POST["pro_nombres"]);
$pro_apellidos 		  = utf8_decode($_POST["pro_apellidos"]);
$pro_email    		  = $_POST["pro_email"];
$pro_telf_movil   	= $_POST["pro_telf_movil"];
$pro_direccion   	  = utf8_decode($_POST["pro_direccion"]);
$pro_comuna_id      = $_POST["cmb_comuna"];
$pro_fecha_nac      = $_POST["pro_fecha_nac"];
$pro_venci_licencia = $_POST["pro_venci_licencia"];
$pro_experiencia    = utf8_decode($_POST["pro_experiencia"]);


$flag=true;


	$sql1="UPDATE tbl_proveedor SET pro_rut='".$pro_rut."', pro_nombres='".$pro_nombres."', pro_apellidos='".$pro_apellidos."', pro_telf_movil='".$pro_telf_movil."', pro_email='".$pro_email."', pro_direccion='".$pro_direccion."', pro_comuna_id=".$pro_comuna_id.", pro_fecha_nac='".$pro_fecha_nac."', pro_experiencia='".$pro_experiencia."', pro_venci_licencia='".$pro_venci_licencia."' where pro_id = $id_chof";	

$result1 = mysqli_query($con, $sql1);
if (!$result1){
        $flag = false;
        echo "Error: " . mysqli_error($con) . ". ";  
}



    if ($flag) {//si no ha habido error en las consultas  
       mysqli_commit($con);  
       echo "Se han Guardado los Datos Correctamente ";  
    } else {  
       mysqli_rollback($con);  
       echo "Error guardando los Datos ".mysqli_error($con);  
    }

?>