<?php
		session_start();
		require_once ("../config/db.php");//Contiene las variables de configuracion para conectar a la base de datos
		require_once ("../config/conexion.php");//Contiene funcion que conecta a la base de datos
		
		$id_chof=$_GET["idchof"];

		$query= mysqli_query($con,"SELECT * FROM tbl_proveedor INNER JOIN tbl_comuna ON tbl_comuna.com_id = tbl_proveedor.pro_comuna_id  where tbl_proveedor.pro_id = $id_chof");
		$row= mysqli_fetch_array($query);

		$pro_rut			= $row['pro_rut'];
		$pro_nombres   		= utf8_encode($row['pro_nombres']);
		$pro_apellidos 		= utf8_encode($row['pro_apellidos']);
		$pro_email      	= $row['pro_email'];
		$pro_telf_movil 	= $row['pro_telf_movil'];
		$pro_direccion		= utf8_encode($row['pro_direccion']);
		$pro_fecha_nac		= date('Y-m-d', strtotime($row['pro_fecha_nac']));
		$pro_foto			= $row['pro_foto'];
		$pro_venci_licencia	= date('Y-m-d', strtotime($row['pro_venci_licencia']));
		$pro_experiencia	= utf8_encode($row["pro_experiencia"]);
		
		$region_id			= "";
		$pro_comuna_id 		= $row['pro_comuna_id'];
		
		$ruta_img=$pro_foto;
            if (($pro_foto!=="") && (file_exists($pro_foto)))
                $ruta_img=$pro_foto;
            else
                $ruta_img= "img/perfiles/avatar04.png";
		// CONTAR EL NUMERO DE CARRERAS REALIZADAS POR UN  VEHICULO
		/*$count_ofer= mysqli_query($con,"SELECT COUNT(*) as numofertas from tbl_solicitud_oferta where oferta_solic_id=$id_solic and oferta_pro_id = 2");
		$fil= mysqli_fetch_array($count_ofer);
		$numofertas = $fil['numofertas'];
		*/
?>

<!doctype html>
<html lang="en" class="no-js">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<!--<link href='http://fonts.googleapis.com/css?family=PT+Sans:400,700' rel='stylesheet' type='text/css'>-->
	<link href="https://fonts.googleapis.com/css?family=Lato" rel="stylesheet">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" /> 
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>  
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script> 
	<!--<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>-->
	<link rel="stylesheet" href="../css/datepicker3.css">


	<script src="https://code.jquery.com/jquery-1.11.1.min.js"></script>
 

	<link rel="stylesheet" href="css/reset.css"> <!-- CSS reset -->
	<link rel="stylesheet" href="css/style.css"> <!-- Gem style -->
	<script src="../js/modernizr.js"></script> <!-- Modernizr -->
	
  	
	<title>:: Tllevo : Operador Vista Chofer</title>
	<style type="text/css">
		a:hover{
			text-decoration: none;
		}
		
		.close{color: #fff; opacity: 1}
		.row{margin-top: 7px;}
		
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
	<header role="banner">
		<div id="logo"><img src="img/logo-1.png" alt="Home"></div><div id="text-menu">Editar Chofer<br><span id="subtext-menu">Datos del Chofer</span></div>
		<div id="cd-hamburger-menu"><a class="cd-img-replace" href="#0">Menu</a></div>
	</header>
	<nav id="main-nav">
		<ul>
			<li><a class="current" href="operator.php"><i class="glyphicon glyphicon-home" id="icon-menu"></i>&nbsp; Home</a></li>
			<li><a href="operator_listproveh.php"><i class="glyphicon glyphicon-list-alt" id="icon-menu"></i>&nbsp; Mis Vehículos</a></li>
			<li><a href="./?logout"><i class="glyphicon glyphicon-off" id="icon-menu"></i>&nbsp; Salir</a></li>
		</ul>
	</nav>

	<main style="">
		<div class="col-md-12">
			<form action="#" id="form" class="form-vertical">
                    <input type="hidden" value="<?php echo $id_chof;?>" name="id_chof" id="id_chof" />

                    <div class="form-body">
                    	
						</div>
				        <div class="form-group">
				            <label for="origen">RUT:</label>
				            <input type="text" class="form-control" id="pro_rut" name="pro_rut" value="<?php echo $pro_rut;?>">
				        </div>
				        <div class="form-group">
				            <label for="origen">Nombres:</label>
				            <input type="text" class="form-control" id="pro_nombres" name="pro_nombres" value="<?php echo $pro_nombres;?>">
				        </div>
				        <div class="form-group">
				            <label for="origen">Apellidos:</label>
				            <input type="text" class="form-control" id="pro_apellidos" name="pro_apellidos" value="<?php echo $pro_apellidos;?>">
				        </div>
				        <div class="form-group">
				            <label for="origen">Email:</label>
				            <input type="text" class="form-control" id="pro_email" name="pro_email" value="<?php echo $pro_email;?>">
				        </div>
				        <div class="form-group row">
				            <div class="col-xs-6 col-md-6 col-lg-6">
							    	<label for="ex1">Telf Móvil:</label>
							    	<input class="form-control" id="pro_telf_movil" name="pro_telf_movil" type="text" value="<?php echo $pro_telf_movil;?>" >
							</div>
							<div class="col-xs-6 col-md-6 col-lg-6">
					            <label for="date">Fecha Nacimiento:</label>
					            <div class="input-daterange" >
					                <input type="text" name="pro_fecha_nac" id="pro_fecha_nac" value="<?php echo $pro_fecha_nac;?>" class="form-control" />
					            </div>
					        </div>
				        </div>
				        <div class="form-group">
				            <label for="origen">Dirección:</label>
				            <input type="text" class="form-control" id="pro_direccion" name="pro_direccion" onFocus="geolocate()" value="<?php echo $pro_direccion;?>">
				        </div>
				        <div class="form-group row">
				            <div class="col-xs-6 col-md-6 col-lg-6">
							    	<label for="ex1">Región:</label>
							    	<select class="form-control" id="cmb_region" name="cmb_region">
						            	<option>--Seleccione--</option>
						            	<?php
					            		$query_region= mysqli_query($con,"SELECT * FROM tbl_region");
					            		while ($trans=mysqli_fetch_array($query_region)){
					            			if ($region_id == $reg['reg_id']) {
					            				$selected="selected";
					            			}
					            			else $selected="";
						            	?>
						            	<option value="<?php echo $reg['reg_id'];?>" <?php echo $selected;?>><?php echo $reg["reg_nombre"];?></option>
						            	<?php }
						            	?>
						            	
						            </select>
							</div>
							<div class="col-xs-6 col-md-6 col-lg-6">
							    	<label for="ex1">Comuna:</label>
							    	<select class="form-control" id="cmb_comuna" name="cmb_comuna">
						            	<option>--Seleccione--</option>
						            	<?php
					            		$query_comuna= mysqli_query($con,"SELECT * FROM tbl_comuna");
					            		while ($comun=mysqli_fetch_array($query_comuna)){
					            			if ($pro_comuna_id == $comun['com_id']) {
					            				$selected="selected";
					            			}
					            			else $selected="";
						            	?>
						            	<option value="<?php echo $comun['com_id'];?>" <?php echo $selected;?>><?php echo utf8_encode($comun["com_nombre"]);?></option>
						            	<?php }
						            	?>
						            	
						            </select>
							</div>


				        </div>
				        <div class="form-group">
				            	<label for="origen">Experiencia en años conduciendo transporte:</label>
				            	<!--<textarea class="form-control" rows="4" id="pro_experiencia" name="pro_experiencia"><?php echo $pro_experiencia;?></textarea>-->
				            	<select class="form-control" id="pro_experiencia" name="pro_experiencia">
						            	<option>--Seleccione--</option>						            	
						            	<option value="1 a 5" <?php if ($pro_experiencia=="1 a 5") echo "selected";?>>1 a 5</option>
						            	<option value="6 a 10" <?php if ($pro_experiencia=="6 a 10") echo "selected";?>>6 a 10</option>
						            	<option value="mayor a 10" <?php if ($pro_experiencia=="mayor a 10") echo "selected";?>>mayor a 10</option>
						        </select>
				        </div>
				        <div class="form-group">
				            <label for="origen">Fecha Vencimiento Licencia:</label>
				            <div class="input-daterange" >
					                <input type="text" class="form-control" id="pro_venci_licencia" name="pro_venci_licencia" value="<?php echo $pro_venci_licencia;?>">
					        </div>
				            
				        </div>
				    </div>
			</form>
		</div>

		<!--<div class="col-md-12" align="center" >			
			<button type="button" onclick="javascript:location.href='chofer_vehiculos.html'" class="btn btn-md btn-default" id="btn-vehiculos"><i class="glyphicon glyphicon-record"></i> Datos Vehículo</button>
			
			<br><br>
		</div>-->

		<div class="col-md-12" align="center" >			
			<button type="button" onclick="grabar_perfil()" class="btn btn-lg btn-default" id="btn-grabar"><i class="glyphicon glyphicon-check"></i> Grabar Datos</button>
			<br><br><br>
		</div>
		
	</main>

	<div id="cd-shadow-layer"></div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
<script src="js/main-operator.js"></script> <!-- Gem jQuery -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCq2IB2MrfoWuvAsG0TFRCxoGiFgtot6Uw&v=3.exp&signed_in=true&libraries=places"></script>

<script src="../js/bootstrap-datepicker.js"></script>
<script src="../js/bootbox.js"></script> <!-- Bootbox -->

<script>
	function grabar_perfil(){
			$('#btn-grabar').text('Guardando...'); //change button text
    		$('#btn-grabar').attr('disabled',true); //set button disable 
    		var url;
    		$.ajax({
		        url : 'process/grabar_edit_chofer.php',
		        type: "POST",
		        data: $('#form').serialize(),
		        //dataType: "JSON",
		        success: function(data)
		        {
		            //alert(data);		            
		            
		            bootbox.dialog({
	                    title: 'Mensaje',
	                    message: data,
	                    buttons: {
	                        ok: {
	                            label: "OK",
	                            className: 'btn-default',
	                            callback: function(){
	                				location.href="operator_listproveh.php";
	                            }
	                        }
	                    }
		        	});
		        	$('#btn-grabar').html('<i class="glyphicon glyphicon-check"></i> Grabar Datos'); //change button text
		            $('#btn-grabar').attr('disabled',false); //set button enable
		            

		        },
		        error: function (jqXHR, textStatus, errorThrown)
		        {
		            alert('Error procesando los datos');
		            $('#btn-grabar').html('<i class="glyphicon glyphicon-check"></i> Grabar Datos'); //change button text
		            $('#btn-grabar').attr('disabled',false); //set button enable 

		        }
		    });
	}


</script>

<script>
	$(document).ready(function() {
		$('.input-daterange').datepicker({
		    "locale": {
		        "separator": " - ",
		        "applyLabel": "Aplicar",
		        "cancelLabel": "Cancelar",
		        "fromLabel": "Desde",
		        "toLabel": "Hasta",
		        "customRangeLabel": "Custom",
		        "daysOfWeek": [
		            "Do",
		            "Lu",
		            "Ma",
		            "Mi",
		            "Ju",
		            "Vi",
		            "Sa"
		        ],
		        "monthNames": [
		            "Enero",
		            "Febrero",
		            "Marzo",
		            "Abril",
		            "Mayo",
		            "Junio",
		            "Julio",
		            "Agosto",
		            "Septiembre",
		            "Octubre",
		            "Noviembre",
		            "Diciembre"
		        ],
		        "firstDay": 1
		    },
		  
		  format: "yyyy-mm-dd",
		  autoclose: true,
		  startView: 2,
		 });

	});

	var inputa = document.getElementById("pro_direccion");
		var autocomplete1 = new google.maps.places.Autocomplete(inputa); 	
		var autocomplete_textarea1 = new google.maps.places.Autocomplete((document.getElementById('autocomplete_textarea1')),
      		{ types: ['geocode'] }
  		);

			

		function geolocate() {
		  if (navigator.geolocation) {
		    navigator.geolocation.getCurrentPosition(function(position) {
		      var geolocation = new google.maps.LatLng(
		          position.coords.latitude, position.coords.longitude);
		      var circle = new google.maps.Circle({
		        center: geolocation,
		        radius: position.coords.accuracy
		      });
		      autocomplete1.setBounds(circle.getBounds());
		      //autocomplete_textarea.setBounds(circle.getBounds());
		      autocomplete_textarea1.setBounds(circle.getBounds());
		    });
		  }
		}
</script>
</body>
</html>