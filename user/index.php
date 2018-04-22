<?php
// include the configs / constants for the database connection
require_once("../config/db.php");

// load the login class
require_once("../classes/Loginclient.php");

// create a login object. when this object is created, it will do all login/logout stuff automatically
// so this single line handles the entire login process. in consequence, you can simply ...
$login = new Login();

// ... ask if we are logged in here:
if ($login->isUserLoggedIn() == true) {
    // the user is logged in. you can do whatever you want here.
    // for demonstration purposes, we simply show the "you are logged in" view.
   header("location: ../../tllevo-front/index.php");

} else {
    // the user is not logged in. you can do whatever you want here.
    // for demonstration purposes, we simply show the "you are not logged in" view.
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<title>Tllevo : Login Usuario :</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link href="https://fonts.googleapis.com/css?family=Lato" rel="stylesheet">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" /> 
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>  
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<!--===============================================================================================-->	
	<link rel="icon" type="image/png" sizes="16x16" href="../img/favicons/favicon-16x16.png">

	<link rel="stylesheet" type="text/css" href="fonts/font-awesome-4.7.0/css/font-awesome.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="fonts/iconic/css/material-design-iconic-font.min.css">

	<link rel="stylesheet" type="text/css" href="css/util.css">
	<link rel="stylesheet" type="text/css" href="css/main.css">
<!--===============================================================================================-->
</head>
<body>
	
	<div class="limiter">
		<div class="container-login100">
			<div class="wrap-login100">
				<form class="login100-form validate-form" method="post" accept-charset="utf-8" action="index.php" name="loginform" autocomplete="off">
					<span class="login100-form-title p-b-22">
						<img src="../img/tllevo-logo1.png" style="width: 80%">
					</span>
					<span class="login100-form-title p-b-7">
						Bienvenido
					</span>
					<span class="login100-form-subtitle p-b-28">
						Inicia sesión para solicitar un Servicio
					</span>
					
					<?php
					// show potential errors / feedback (from login object)
					if (isset($login)) {
						if ($login->errors) {
							?>
							<div class="alert alert-danger alert-dismissible" role="alert">
							    <strong>Error!</strong> 
							
							<?php 
							foreach ($login->errors as $error) {
								echo $error;
							}
							?>
							</div>
							<?php
						}
						if ($login->messages) {
							?>
							<div class="alert alert-success alert-dismissible" role="alert">
							    <strong>Aviso!</strong>
							<?php
							foreach ($login->messages as $message) {
								echo $message;
							}
							?>
							</div> 
							<?php 
						}
					}
					?>
					<div class="wrap-input100 validate-input" data-validate ="Ingrese su email: nombre@correo.com">
						<input class="input100" type="text" name="email">
						<span class="focus-input100" data-placeholder="Email"></span>
					</div>

					<div class="wrap-input100 validate-input" data-validate="Ingrese su Contraseña">
						<span class="btn-show-pass">
							<i class="zmdi zmdi-eye"></i>
						</span>
						<input class="input100" type="password" name="user_password">
						<span class="focus-input100" data-placeholder="Contraseña"></span>
					</div>

					<div class="container-login100-form-btn">
						<div class="wrap-login100-form-btn">
							<div class="login100-form-bgbtn"></div>
							<button class="login100-form-btn" name="login">
								Ingresar
							</button>
						</div>
					</div>

					<div class="text-center p-t-70">
						<span class="txt1">
							No tienes una cuenta?
						</span>

						<a class="txt2" href="registrar.php">
							Registrar
						</a>
					</div>
				</form>
			</div>
		</div>
	</div>
	

	<div id="dropDownSelect1"></div>
	

<!--===============================================================================================-->
	<script src="js/login.js"></script>
	<script>
		$(document).ready (function(){
            $(".alert").delay(4000).slideUp(200, function() {
   				$(this).alert('close');
			});
        });
	</script>
</body>
</html>
<?php
}
?>