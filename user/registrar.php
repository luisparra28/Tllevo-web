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
   header("location: ../../tllevo-front/");

} else {
    // the user is not logged in. you can do whatever you want here.
    // for demonstration purposes, we simply show the "you are not logged in" view.
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<title>Tllevo : Registro Usuario :</title>
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
	<script src="../js/bootbox.js"></script>

	<style type="text/css">
		
		
		.close{color: #fff; opacity: 1}
		
		.modal {
		  text-align: center;
		  padding: 0!important;
		}

		.modal:before {
		  content: '';
		  display: inline-block;
		  height: 100%;
		  vertical-align: middle;
		  margin-right: -4px;
		}

		.modal-dialog {
		  display: inline-block;
		  text-align: left;
		  vertical-align: middle;
		}
		.modal-header{
			background-color: #31353d; 
			color: #fff;
		}
	</style>
</head>
<body>
	
	<div class="limiter">
		<div class="container-login100">
			<div class="wrap-login100">
				<form class="login100-form validate-form" method="post" accept-charset="utf-8" name="form_register" id="form_register" autocomplete="off">
					<span class="login100-form-title p-b-16">
						<img src="../img/tllevo-logo1.png" style="width: 60%">
					</span>
					<span class="login100-form-title p-b-18">
						Registrarme
					</span>
					
					
					<div class="wrap-input100 validate-input" data-validate ="Ingrese su Nombre">
						<input class="input100" type="text" name="user_name" id="user_name">
						<span class="focus-input100" data-placeholder="Nombre"></span>
					</div>
					<div class="wrap-input100 validate-input" data-validate ="Ingrese su Apellido">
						<input class="input100" type="text" name="user_apellido" id="user_apellido">
						<span class="focus-input100" data-placeholder="Apellido"></span>
					</div>
					<div class="wrap-input100 validate-input" data-validate ="Ingrese su RUT">
						<input class="input100" type="text" name="user_rut" id="user_rut">
						<span class="focus-input100" data-placeholder="RUT"></span>
					</div>
					<!--<div class="wrap-input100 validate-input" data-validate ="Ingrese su Teléfono">
						<input class="input100" type="text" name="user_phone">
						<span class="focus-input100" data-placeholder="Teléfono"></span>
					</div>-->

					<div class="wrap-input100 validate-input" data-validate ="Ingrese su email: nombre@correo.com">
						<input class="input100" type="text" name="email" id="email">
						<span class="focus-input100" data-placeholder="Email"></span>
					</div>

					<div class="wrap-input100 validate-input" data-validate="Ingrese su Contraseña">
						<span class="btn-show-pass">
							<i class="zmdi zmdi-eye"></i>
						</span>
						<input class="input100" type="password" name="user_password" id="user_password">
						<span class="focus-input100" data-placeholder="Contraseña"></span>
					</div>

					<div class="flex-m w-full p-b-33 validate-input" data-validate="Debe aceptar los términos"">
							<input class="input100 input-checkbox100 " id="ckb1" type="checkbox" name="remember-me">
							<label class="label-checkbox100" for="ckb1">
								<span class="txt1">
									He leído y acepto los
									<a href="" data-toggle="modal" data-target="#terms_and_conditions_modal" class=" hov1">
										Términos
									</a>
								</span>
							</label>
					</div>


					<div class="container-login100-form-btn">
						<div class="wrap-login100-form-btn">
							<div class="login100-form-bgbtn"></div>
							<button type="button" class="login100-form-btn" name="registrar" id="btn-registrar">
								Registrar
							</button>
						</div>
					</div>

					<div class="text-center p-t-40">
						<span class="txt1">
							Ya estás registrado?
						</span>
						<br>
						<a class="txt2" href="./">
							Ingresa en tu cuenta
						</a>
					</div>
				</form>
			</div>
		</div>
	</div>
	

	<div id="dropDownSelect1"></div>
	<!-- Modal -->
      <div class="modal fade" id="terms_and_conditions_modal" tabindex="-1" role="dialog" aria-labelledby="terms_and_conditions_modal_label" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
              <h4 class="modal-title" id="terms_and_conditions_modal_label">Terminos</h4>
            </div>
            <div class="modal-body">
              <p>
                Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas ante ipsum, pellentesque vel velit non, iaculis condimentum orci. Nullam turpis dolor, aliquet elementum mi eget, sagittis pharetra elit. Aenean blandit erat lacus, nec semper ipsum tempus a. Etiam non enim in turpis mollis aliquet. Suspendisse sagittis metus ac nibh venenatis elementum. Curabitur pretium nibh enim, sed fermentum ipsum porta sit amet. Maecenas laoreet finibus est aliquam laoreet. Etiam eros diam, condimentum a placerat ultrices, vestibulum at est. Duis at fringilla ante. Nullam ut est ac risus iaculis porttitor.
                <br /><br />
                Nulla feugiat lorem non nunc fringilla, a interdum dolor egestas. Integer quis semper diam. Mauris quam odio, cursus vel lectus at, mattis sodales neque. Aliquam et arcu mauris. Aliquam dapibus, nulla et consequat dignissim, augue enim efficitur erat, consectetur efficitur ipsum dui sed augue. Sed quis risus massa. Nullam non ex bibendum, tincidunt ipsum id, hendrerit lacus.
                <br /><br />
                Sed id lectus sed mauris dictum auctor feugiat et justo. Cras in neque non sapien cursus lobortis sit amet viverra velit. Nam accumsan, libero at congue consectetur, dolor tortor mattis felis, sed mollis nunc nibh sit amet enim. Aliquam commodo feugiat facilisis. Mauris ullamcorper blandit congue. Nulla in dolor eros. Cras non est aliquet, faucibus diam facilisis, aliquam purus. Quisque varius aliquam odio, vel consectetur orci iaculis eu. Nunc eu gravida diam. Donec semper mauris felis. Donec sit amet tristique enim, sit amet placerat ipsum. Donec facilisis volutpat magna non dictum.
              </p>
            </div>
          </div>
        </div>
      </div>
    

<!--===============================================================================================-->
	<script src="js/register.js"></script>
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