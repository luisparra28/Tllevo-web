<?php
session_start();
	if (isset($_GET["idvehi"])){
		require_once ("../config/db.php");//Contiene las variables de configuracion para conectar a la base de datos
		require_once ("../config/conexion.php");//Contiene funcion que conecta a la base de datos
		$id_vehi= $_GET["idvehi"];
		$id_ope = $_SESSION['ope_id'];

		$query= mysqli_query($con,"SELECT * FROM tbl_vehiculo INNER JOIN tbl_transporte ON tbl_transporte.trans_id = tbl_vehiculo.vehi_transporte_id  where tbl_vehiculo.vehi_id = $id_vehi");
		$row= mysqli_fetch_array($query);

		$vehi_patente	= $row['vehi_patente'];
		$vehi_pro_id 	= $row['vehi_pro_id'];
		$vehi_anio   	= $row['vehi_anio'];
		$vehi_foto      = $row['vehi_foto'];
		$vehi_modelo    = utf8_encode($row['vehi_modelo']);
		$vehi_marca		= utf8_encode($row['vehi_marca']);
		$vehi_capacidad	= $row['vehi_capacidad'];
		$vehi_volumen	= $row['vehi_volumen'];
		$vehi_num_ejes	= $row['vehi_num_ejes'];
		$vehi_rendimiento= $row["vehi_rendimiento"];
		$vehi_abierto_cerrado= $row["vehi_abierto_cerrado"];
		$trans_id        = $row["vehi_transporte_id"];
		$trans_nombre    = utf8_encode($row["trans_nombre"]);
		
		$ruta_img="../../tllevo-front/".$vehi_foto;
            if (($vehi_foto!=="") && (file_exists($ruta_img)))
                $ruta_img=$ruta_img;
            else
                $ruta_img= "../../tllevo-front/img/vehiculos/transport.png";
		// CONTAR EL NUMERO DE CARRERAS REALIZADAS POR UN  VEHICULO
		/*$count_ofer= mysqli_query($con,"SELECT COUNT(*) as numofertas from tbl_solicitud_oferta where oferta_solic_id=$id_solic and oferta_pro_id = 2");
		$fil= mysqli_fetch_array($count_ofer);
		$numofertas = $fil['numofertas'];
		*/
	}
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

	<script src="https://code.jquery.com/jquery-1.11.1.min.js"></script>
 

	<link rel="stylesheet" href="css/reset.css"> <!-- CSS reset -->
	<link rel="stylesheet" href="css/style.css"> <!-- Gem style -->
	<script src="../js/modernizr.js"></script> <!-- Modernizr -->
	
  	
	<title>:: Tllevo : Operador Vista Vehiculo</title>
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
		<div id="logo"><img src="img/logo-1.png" alt="Home"></div><div id="text-menu">Editar Vehículo<br><span id="subtext-menu">Datos del Vehículo</span></div>
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
                    <input type="hidden" value="<?php echo $id_vehi;?>" name="id_vehi" id="id_vehi" /> 
                    <div class="form-body">
                    	<div class="form-group">
							<div class="table-responsive">
								<table class="table table-bordered">
									
									<tr>
										<td align="center">
											<div id="load_img">
												<img class="img-responsive" width="70%" src="<?php echo $ruta_img;?>" alt="Foto" />
											</div>
										</td>
										

									</tr>
									<tr>
										<td style="vertical-align: middle;" align="center">
											<input	class='filestyle' data-buttonText="Foto" data-input="false" data-size="lg" data-iconName="glyphicon glyphicon-camera" type="file" name="imagefile" id="imagefile" onchange="upload_image();">
										</td>
									</tr>
								</table>
							</div>
						</div>
				        <div class="form-group">
				            <label for="origen">Chofer Asignado:</label>
				            <select class="form-control" id="cmb_nomchofer" name="cmb_nomchofer">
				            	<option>--Seleccione--</option>
				            	<?php
			            		$query_chof= mysqli_query($con,"SELECT * FROM tbl_proveedor where tbl_proveedor.pro_ope_id=$id_ope");
			            		while ($chofes=mysqli_fetch_array($query_chof)){

			            			if ($vehi_pro_id == $chofes['pro_id']) {
			            				$selected="selected";
			            			}
			            			else $selected="";
				            	?>
				            	<option value="<?php echo $chofes['pro_id'];?>" <?php echo $selected;?>><?php echo utf8_encode($chofes["pro_nombres"]." ".$chofes["pro_apellidos"]);?></option>
				            	<?php }
				            	?>
				            	
				            </select>
				        </div>
				        <div class="form-group">
				            <label for="origen">Vehículo Patente:</label>
				            <input type="text" class="form-control" id="vehi_patente" name="vehi_patente" value="<?php echo $vehi_patente;?>">
				        </div>
				        <div class="form-group">
				            <label for="origen">Modelo:</label>
				            <input type="text" class="form-control" id="vehi_modelo" name="vehi_modelo" value="<?php echo $vehi_modelo;?>">
				        </div>
				        <div class="form-group">
				            <label for="origen">Marca:</label>
				            <input type="text" class="form-control" id="vehi_marca" name="vehi_marca" value="<?php echo $vehi_marca;?>">
				        </div>
				        <div class="form-group row">
				            <div class="col-xs-6 col-md-6 col-lg-6">
							    	<label for="ex1">Año:</label>
							    	<input class="form-control" id="vehi_anio" name="vehi_anio" type="text" value="<?php echo $vehi_anio;?>" >
							</div>
							<div class="col-xs-6 col-md-6 col-lg-6">
							    	<label for="ex1">Capacidad (m<sup style="font-size: 11px">3</sup>):</label>
							    	<input class="form-control" id="vehi_volumen" name="vehi_volumen" type="text" value="<?php echo $vehi_volumen;?>">
							</div>
				        </div>
				        <div class="form-group row">
				        	<div class="col-xs-6 col-md-6 col-lg-6">
					            <label for="origen">Tipo de Transporte:</label>
					            <select class="form-control" id="cmb_tipotrans" name="cmb_tipotrans">
					            	<option>--Seleccione--</option>
					            	<?php
				            		$query_trans= mysqli_query($con,"SELECT * FROM tbl_transporte");
				            		while ($trans=mysqli_fetch_array($query_trans)){
				            			if ($trans_id == $trans['trans_id']) {
				            				$selected="selected";
				            			}
				            			else $selected="";
					            	?>
					            	<option value="<?php echo $trans['trans_id'];?>" <?php echo $selected;?>><?php echo $trans["trans_nombre"];?></option>
					            	<?php }
					            	?>
					            	
					            </select>
					        </div>
					        <div class="col-xs-6 col-md-6 col-lg-6">
					            <label for="origen">Abierto/Cerrado:</label>
					            <select class="form-control" id="cmb_abiercerr" name="cmb_abiercerr">
					            	<option>--Seleccione--</option>
					            	<option value="1" <?php if ($vehi_abierto_cerrado==1) echo "selected";?>>Abierto</option>
					            	<option value="2" <?php if ($vehi_abierto_cerrado==2) echo "selected";?>>Cerrado</option>
					            	
					            </select>
					        </div>
				        </div>
				        
				        <div class="form-group row">
				            <div class="col-xs-6 col-md-6 col-lg-6">
							    	<label for="ex1">Nro Ejes:</label>
							    	<input class="form-control" id="vehi_num_ejes" name="vehi_num_ejes" type="text" value="<?php echo $vehi_num_ejes;?>">
							</div>
				            <div class="col-xs-6 col-md-6 col-lg-6">
							    	<label for="ex1">Rendimiento (<span style="font-size: 12px"> km/L</span>):</label>
							    	<input class="form-control" id="vehi_rendimiento" name="vehi_rendimiento" type="text" value="<?php echo $vehi_rendimiento;?>" >
							</div>
							
				        </div>
				    </div>
			</form>
		</div>


		<div class="col-md-12" align="center">			
			<button type="button" onclick="grabar_vehiculo()" class="btn btn-lg btn-default" id="btn-grabar"><i class="glyphicon glyphicon-check"></i> Grabar Datos</button>
			<br>
			<br>
		</div>
		
	</main>

	<div id="cd-shadow-layer"></div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
<script src="js/main-operator.js"></script> <!-- Gem jQuery -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<script src="../js/bootbox.js"></script>


<script>
	function grabar_vehiculo(){
			$('#btn-grabar').text('Guardando...'); //change button text
    		$('#btn-grabar').attr('disabled',true); //set button disable 
    		var url;
    		$.ajax({
		        url : 'process/grabar_edit_vehiculo.php',
		        type: "POST",
		        data: $('#form').serialize(),
		        //dataType: "JSON",
		        success: function(data)
		        {
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

		        },
		        error: function (jqXHR, textStatus, errorThrown)
		        {
		            alert('Error procesando los datos');
		            $('#btn-grabar').html('<i class="glyphicon glyphicon-check"></i> Grabar'); //change button text
		            $('#btn-grabar').attr('disabled',false); //set button enable 

		        }
		    });
	}


</script>
</body>
</html>
<script type="text/javascript" src="../js/bootstrap-filestyle.js"> </script>
<script>
	function upload_image(){
			
			var inputFileImage = document.getElementById("imagefile");
			var file = inputFileImage.files[0];
			var id_vehi = $('#id_vehi').val();
			if( (typeof file === "object") && (file !== null) )
			{
				$("#load_img").text('Cargando...');	
				var data = new FormData();
				data.append('imagefile',file);
				data.append('id_vehi',id_vehi)
				$.ajax({
					url: "process/imagen_ajax.php",        // Url to which the request is send
					type: "POST",             // Type of request to be send, called as method
					data: data, 			  // Data sent to server, a set of key/value pairs (i.e. form fields and values)
					contentType: false,       // The content type used when sending data to the server.
					cache: false,             // To unable request pages to be cached
					processData:false,        // To send DOMDocument or non processed data file it is set to false
					success: function(data)   // A function to be called if request succeeds
					{
						$("#load_img").html(data);
						
					}
				});	
			}
	}
</script>
