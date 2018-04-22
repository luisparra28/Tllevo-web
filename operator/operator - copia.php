<?php 
session_start();
?>
<!doctype html>
<html lang="en" class="no-js">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<link rel='stylesheet prefetch' href='https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css'>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>  
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
	

	<link rel="stylesheet" href="css/reset.css"> <!-- CSS reset -->
	<link rel="stylesheet" href="css/style.css"> <!-- Gem style -->
	<script src="js/modernizr.js"></script> <!-- Modernizr -->
  	
	<title>:: Tllevo : Operador</title>
</head>
<body>
	<header role="banner">
		<div id="logo"><img src="img/logo-1.png" alt="Home"></div>
		<div id="cd-hamburger-menu"><a class="cd-img-replace" href="#0">Menu</a></div>
	</header>
	<nav id="main-nav">
		<ul>
			<li><a class="current" href="operator.php"><i class="glyphicon glyphicon-home" id="icon-menu"></i>&nbsp; Home</a></li>
			<li><a href="chofer_solicitudes.html"><i class="glyphicon glyphicon-list-alt" id="icon-menu"></i>&nbsp; Mis Solicitudes</a></li>
			<li><a href="./?logout"><i class="glyphicon glyphicon-off" id="icon-menu"></i>&nbsp; Salir</a></li>
		</ul>
	</nav>

	<main>
		Bienvenido <?php echo $_SESSION["ope_razon_social"];?>
		<h1>Mis Datos</h1>
		<div class="col-md-12">
			<form action="#" id="form" class="form-vertical">
                    <input type="hidden" value="<?php echo $id_clie;?>" name="id_clie" id="id_clie" />

                    <div class="form-body">
                    	
				        <div class="form-group">
				            <label for="origen">RUT:</label>
				   			<input type="text" class="form-control" id="clie_rut" name="clie_rut" value="<?php echo $_SESSION["ope_rut"];?>">
				        </div>
				        <div class="form-group">
				            <label for="origen">Razón Social:</label>
				            <input type="text" class="form-control" id="clie_nombre" name="clie_nombre" value="<?php echo $_SESSION["ope_razon_social"];?>">
				        </div>
				        <div class="form-group">
				            <label class="control-label" for="origen">Dirección Comercial:</label>
				            <input type="text" class="form-control" id="clie_apellido" name="clie_apellido" value="">
				        </div>
				        <div class="form-group">
				            <label for="origen">Teléfono:</label>
				            <input type="text" class="form-control" id="clie_correo" name="clie_correo" value="<?php echo $_SESSION["ope_telefono"];?>">
				        </div>
				        <div class="form-group">
					    	<label for="ex1">Email:</label>
					    	<input class="form-control" id="clie_telefono" name="clie_telefono" type="text" value="<?php echo $_SESSION["ope_email"];?>" >
				        </div>
				        <hr style="border: 1px dashed #ddd; height: 0; width: 100%;">


				        
				    </div>
			</form>
		</div>
	</main>

	<div id="cd-shadow-layer"></div>
	


<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
<script src="js/main-operator.js"></script> <!-- Gem jQuery -->
</body>
</html>