<!doctype html>
<html lang="en" class="no-js">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<!--<link href='http://fonts.googleapis.com/css?family=PT+Sans:400,700' rel='stylesheet' type='text/css'>-->
	<link href="https://fonts.googleapis.com/css?family=Lato" rel="stylesheet">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" /> 
	<!--<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>-->

	<script src="https://code.jquery.com/jquery-1.11.1.min.js"></script>
 

	<link rel="stylesheet" href="css/reset.css"> <!-- CSS reset -->
	<link rel="stylesheet" href="css/style.css"> <!-- Gem style -->
	<script src="../js/modernizr.js"></script> <!-- Modernizr -->
  	
	<title>:: Tllevo : Operador Choferes</title>
	<style type="text/css">
		a:hover{
			text-decoration: none;
		}
		.nav-pills>li.active>a, .nav-pills>li.active>a:focus, .nav-pills>li.active>a:hover {
		    color: #000;
		    background-color: #efefe7;
		    border-bottom:3px solid #ce2129; 
		}
		.close{color: #fff; opacity: 1}
		
	</style>
</head>
<body>
	<header role="banner">
		<div id="logo"><img src="img/logo-1.png" alt="Home"></div><div id="text-menu">Choferes-Vehículos<br><span id="subtext-menu">Mis Choferes y Vehículos</span></div>
		<div id="cd-hamburger-menu"><a class="cd-img-replace" href="#0">Menu</a></div>
	</header>
	<nav id="main-nav">
		<ul>
			<li><a class="current" href="operator.php"><i class="glyphicon glyphicon-home" id="icon-menu"></i>&nbsp; Home</a></li>
			<li><a href="operator_listproveh.php"><i class="glyphicon glyphicon-list-alt" id="icon-menu"></i>&nbsp; Mis Vehículos</a></li>
			<li><a href="./?logout"><i class="glyphicon glyphicon-off" id="icon-menu"></i>&nbsp; Salir</a></li>
		</ul>
	</nav>

	<main style="padding: 20px 10px">
		<!--<ul class="nav nav-pills nav-justified">
		    <li class="active"><a data-toggle="pill" href="#tab1">Mis Choferes / Vehículos</a></li>
		</ul>-->
		<div class="col-md-12" align="center">
			<button type="button" onclick="javascript: location.href='operator_newproveh.php'" class="btn btn-md btn-default" id="btn-grabar"><i class="glyphicon glyphicon-plus"></i> Registrar Nuevo</button>
			<br>
		</div>
		<div class="tab-content">
		    <div id="tab1" class="tab-pane fade in active">
		      	<div id="resultados" align="center"></div><!-- Carga los datos ajax -->
				<div class='outer_div'></div><!-- Carga los datos ajax -->
		    </div>
  		</div>
		
	</main>

	<div id="cd-shadow-layer"></div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
<script src="js/main-operator.js"></script> <!-- Gem jQuery -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<script>
	$(document).ready(function(){
			cargar(1);
		});

		function cargar(page){
			//var q= $("#q").val();
			$("#resultados").fadeIn('slow');
			$.ajax({
				url:'./process/operador_buscar_chof_veh.php?action=ajax&page='+page,
				 beforeSend: function(objeto){
				 $('#resultados').html('<img src="./img/car-loader2.gif">');
			  },
				success:function(data){
					$(".outer_div").html(data).fadeIn('slow');
					$('#resultados').html('');
					
				}
			})
		}

</script>
</body>
</html>