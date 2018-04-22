<?php
require_once ("../config/db.php");//Contiene las variables de configuracion para conectar a la base de datos
require_once ("../config/conexion.php");//Contiene funcion que conecta a la base de datos

mysqli_autocommit($con, false);

$clie_nombre    = mysqli_real_escape_string($con,$_POST["nombre"]);
$clie_apellido  = mysqli_real_escape_string($con,$_POST["apellido"]);
$clie_rut       = mysqli_real_escape_string($con,$_POST["rut"]);
$clie_telefono  = "";
$clie_correo    = mysqli_real_escape_string($con,$_POST["correo"]);
$clie_password  = password_hash($_POST["password"], PASSWORD_DEFAULT);

$flag=true;

$cons_buscar=mysqli_query($con, "SELECT clie_correo FROM tbl_cliente where clie_correo='".$clie_correo."'");
if (mysqli_num_rows($cons_buscar)>0){
  echo "Error Este correo ya se encuentra en uso";
  $flag = false;
}
else{
	$sql1="INSERT INTO tbl_cliente (clie_rut, clie_nombre, clie_apellido, clie_telefono, clie_correo, clie_password, clie_fecha_registro, clie_validado) VALUES ('".$clie_rut."', '".$clie_nombre."', '".$clie_apellido."', '".$clie_telefono."', '".$clie_correo."', '".$clie_password."', now(), 1)";
	$result1 = mysqli_query($con, $sql1);
	if (!$result1){
        $flag = false;
        echo "Error: " . mysqli_error($con) . ". ";  
	}	
}






if ($flag) {//si no ha habido error en las consultas  
   mysqli_commit($con);
   echo "Gracias! Te has registrado en Tllevo correctamente ";
} else {  
   mysqli_rollback($con);  
   echo "Error en el registro ".mysqli_error($con);  
}
?>