<?php
session_start();
require_once ("../../config/db.php");//Contiene las variables de configuracion para conectar a la base de datos
require_once ("../../config/conexion.php");//Contiene funcion que conecta a la base de datos

mysqli_autocommit($con, false);

$id_ope = $_POST["id_ope"];

$ope_rut				= $_POST['ope_rut'];
$ope_razon_social   	= utf8_decode($_POST['ope_razon_social']);
$ope_direccion      	= utf8_decode($_POST['ope_direccion']);
$ope_telefono    		= $_POST['ope_telefono'];
$ope_email				= $_POST['ope_email'];
$ope_repres_rut         = $_POST["rut_repre"];
$ope_repres_telefono    = $_POST["telf_repre"];
$ope_repres_nombre      = utf8_decode($_POST["nom_repre"]);
$ope_cuenta_banco		= $_POST['ope_cuenta_banco'];
$ope_cuenta_tipo		= $_POST['ope_cuenta_tipo'];
$ope_cuenta_rut			= $_POST['ope_cuenta_rut'];
$ope_cuenta_nombre		= utf8_decode($_POST['ope_cuenta_nombre']);
$ope_cuenta_numero		= $_POST['ope_cuenta_numero'];

$flag=true;

$sql1="UPDATE tbl_operador SET ope_rut='".$ope_rut."', ope_razon_social='".$ope_razon_social."', ope_direccion='".$ope_direccion."', ope_telefono='".$ope_telefono."', ope_email='".$ope_email."', ope_repres_rut='".$ope_repres_rut."', ope_repres_nombre='".$ope_repres_nombre."', ope_repres_telefono='".$ope_repres_telefono."', ope_cuenta_banco=".$ope_cuenta_banco.", ope_cuenta_tipo=".$ope_cuenta_tipo.", ope_cuenta_rut='".$ope_cuenta_rut."', ope_cuenta_nombre='".$ope_cuenta_nombre."', ope_cuenta_numero='".$ope_cuenta_numero."' where ope_id = $id_ope";
$result1 = mysqli_query($con, $sql1);
if (!$result1){
        $flag = false;
        echo "Error: " . mysqli_error($con) . ". ";  
}




if ($flag) {//si no ha habido error en las consultas  
   mysqli_commit($con);  
   echo "Se han Grabado los datos correctamente";  
} else {  
   mysqli_rollback($con);  
   echo "Error grabando los Datos ".mysqli_error($con);  
}

?>