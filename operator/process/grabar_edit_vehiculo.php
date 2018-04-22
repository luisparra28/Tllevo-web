<?php
require_once ("../../config/db.php");//Contiene las variables de configuracion para conectar a la base de datos
require_once ("../../config/conexion.php");//Contiene funcion que conecta a la base de datos
mysqli_autocommit($con, false);

session_start();
//$id_chof = $_SESSION["id_chofer"];

$id_vehi       		    = $_POST["id_vehi"];
$vehi_pro_id           	= $_POST["cmb_nomchofer"];
$vehi_patente   	    = $_POST["vehi_patente"];
$vehi_modelo   		    = $_POST["vehi_modelo"];
$vehi_marca   		    = $_POST["vehi_marca"];
$vehi_anio   		    = $_POST["vehi_anio"];
$vehi_volumen   	    = $_POST["vehi_volumen"];
$vehi_transporte_id    	= $_POST["cmb_tipotrans"];
$vehi_abierto_cerrado	= $_POST["cmb_abiercerr"];
$vehi_num_ejes   	    = $_POST["vehi_num_ejes"];
$vehi_rendimiento      	= $_POST["vehi_rendimiento"];


$flag=true;

$sql1="UPDATE tbl_vehiculo SET vehi_pro_id=$vehi_pro_id, vehi_transporte_id=$vehi_transporte_id, vehi_patente='".$vehi_patente."', vehi_anio=$vehi_anio, vehi_modelo='".$vehi_modelo."', vehi_marca='".$vehi_marca."', vehi_volumen=$vehi_volumen, vehi_rendimiento=$vehi_rendimiento, vehi_abierto_cerrado=$vehi_abierto_cerrado where vehi_id = $id_vehi";	

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