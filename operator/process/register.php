<?php
require_once ("../../config/db.php");//Contiene las variables de configuracion para conectar a la base de datos
require_once ("../../config/conexion.php");//Contiene funcion que conecta a la base de datos

mysqli_autocommit($con, false);

$ope_razon_social = mysqli_real_escape_string($con,$_POST["user_name"]);
$ope_rut          = mysqli_real_escape_string($con,$_POST["user_rut"]);
$ope_telefono     = mysqli_real_escape_string($con,$_POST["user_phone"]);
$ope_correo       = mysqli_real_escape_string($con,$_POST["email"]);
$ope_password     = password_hash($_POST["user_password"], PASSWORD_DEFAULT);

$flag=true;

$cons_buscar=mysqli_query($con, "SELECT ope_email FROM tbl_operador where ope_email='".$ope_correo."'");
if (mysqli_num_rows($cons_buscar)>0){
  echo "Error! Este correo ya se encuentra en uso.";
  $flag = false;
}
else{
	$sql1="INSERT INTO tbl_operador (ope_rut, ope_razon_social, ope_telefono, ope_email, ope_password, ope_fecha_registro, ope_validado) VALUES ('".$ope_rut."', '".$ope_razon_social."', '".$ope_telefono."', '".$ope_correo."', '".$ope_password."', now(), 1)";
	$result1 = mysqli_query($con, $sql1);
	if (!$result1){
        $flag = false;
        echo "Error: " . mysqli_error($con) . ". ";  
	}	
}






if ($flag) {//si no ha habido error en las consultas  
   mysqli_commit($con);
   echo "Se ha registrado correctamente ";
} else {  
   mysqli_rollback($con);  
   echo " No se completó en el registro ".mysqli_error($con);  
}
?>