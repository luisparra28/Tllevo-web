<?php
require_once ("../../config/db.php");//Contiene las variables de configuracion para conectar a la base de datos
require_once ("../../config/conexion.php");//Contiene funcion que conecta a la base de datos
mysqli_autocommit($con, false);

session_start();
$id_ope = $_SESSION['ope_id'];

$pro_rut              = $_POST["pro_rut"];
$pro_nombres     	  = utf8_decode($_POST["pro_nombres"]);
$pro_apellidos 		  = utf8_decode($_POST["pro_apellidos"]);
$pro_email    		  = $_POST["pro_email"];
$pro_password       = password_hash ( '123',PASSWORD_DEFAULT );
$pro_telf_movil    	  = $_POST["pro_telf_movil"];
$pro_direccion   	  = utf8_decode($_POST["pro_direccion"]);
$pro_comuna_id        = $_POST["cmb_comuna"];
$pro_fecha_nac        = $_POST["pro_fecha_nac"];
$pro_venci_licencia   = $_POST["pro_venci_licencia"];
$pro_experiencia      = utf8_decode($_POST["pro_experiencia"]);

$query1 = 'INSERT INTO tbl_proveedor (pro_ope_id, pro_rut, pro_nombres, pro_apellidos, pro_email, pro_password, pro_telf_movil, pro_direccion, pro_comuna_id, pro_fecha_nac, pro_venci_licencia, pro_experiencia, pro_fecha_registro) VALUES('.$id_ope.',"'.$pro_rut.'","'.$pro_nombres.'","'.$pro_apellidos.'","'.$pro_email.'","'.$pro_password.'", "'.$pro_telf_movil.'", "'.$pro_direccion.'", '.$pro_comuna_id.', "'.$pro_fecha_nac.'","'.$pro_venci_licencia.'", "'.$pro_experiencia.'", now());';

$result = mysqli_query($con, $query1);  
    if (mysqli_errno($con)) {  
        $flag = false;  
        echo "Error chofer: " . mysqli_error($con) . ". ";  
    }

$insert_id = mysqli_insert_id($con);



$vehi_pro_id           	= $insert_id;
$vehi_foto              = $_POST["imagefile"];
$vehi_nueva_foto 		= explode('/',$vehi_foto);
$vehi_fotonew			= $vehi_nueva_foto[3]."/".$vehi_nueva_foto[4]."/".$vehi_nueva_foto[5];
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

$sql1="INSERT INTO tbl_vehiculo (vehi_pro_id, vehi_transporte_id, vehi_patente, vehi_foto, vehi_anio, vehi_modelo, vehi_marca, vehi_volumen, vehi_num_ejes, vehi_rendimiento, vehi_abierto_cerrado) VALUES (".$vehi_pro_id.", ".$vehi_transporte_id.", '".$vehi_patente."','".$vehi_fotonew."', '".$vehi_anio."', '".$vehi_modelo."', '".$vehi_marca."', ".$vehi_volumen.", ".$vehi_num_ejes.",".$vehi_rendimiento.", ".$vehi_abierto_cerrado.")";	

$result1 = mysqli_query($con, $sql1);
if (!$result1){
        $flag = false;
        echo "Error vehiculo: " . mysqli_error($con) . ". ";  
}



    if ($flag) {//si no ha habido error en las consultas  
       mysqli_commit($con);  
       echo "Se han Guardado los Datos Correctamente ";  
    } else {  
       mysqli_rollback($con);  
       echo "Error guardando los Datos ".mysqli_error($con);  
    }

?>