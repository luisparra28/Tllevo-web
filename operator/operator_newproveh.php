<?php 
session_start();
require_once ("../config/db.php");//Contiene las variables de configuracion para conectar a la base de datos
require_once ("../config/conexion.php");//Contiene funcion que conecta a la base de datos
$id_ope = $_SESSION['ope_id'];
		
?>
<!doctype html>
<html lang="en" class="no-js">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link href="https://fonts.googleapis.com/css?family=Lato" rel="stylesheet">
	<link rel='stylesheet prefetch' href='https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css'>
	<link rel='stylesheet' href='css/wizard.css'>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>  
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

    <link rel="stylesheet" href="../css/datepicker3.css">
	

	<link rel="stylesheet" href="css/reset.css"> <!-- CSS reset -->
	<link rel="stylesheet" href="css/style.css"> <!-- Gem style -->
	<script src="../js/modernizr.js"></script> <!-- Modernizr -->
  	
	<title>:: Tllevo : Chofer-Vehiculo</title>
</head>
<body>
	<header role="banner">
		<div id="logo"><img src="img/logo-1.png" alt="Home"></div><div id="text-menu">Registrar Chofer<br><span id="subtext-menu">Nuevo Chofer y Vehículo</span></div>
		<div id="cd-hamburger-menu"><a class="cd-img-replace" href="#0">Menu</a></div>
	</header>
	<nav id="main-nav">
		<ul>
			<li><a class="current" href="operator.php"><i class="glyphicon glyphicon-home" id="icon-menu"></i>&nbsp; Home</a></li>
			<li><a href="operator_listproveh.php"><i class="glyphicon glyphicon-list-alt" id="icon-menu"></i>&nbsp; Mis Vehículos</a></li>
			<li><a href="./?logout"><i class="glyphicon glyphicon-off" id="icon-menu"></i>&nbsp; Salir</a></li>
		</ul>
	</nav>

	<main>
		<!--<div class="col-md-12">
				<div align="center" style="background-color: #efefe7; padding:8px; border-bottom: 3px solid #da2129; border-radius: 4px">Nuevo Chofer-Vehiculo</div>
		</div>-->
		<div class="container">
			<div class="stepwizard">
			    <div class="stepwizard-row setup-panel">
			        <div class="stepwizard-step">
			            <a href="#step-1" type="button" class="btn btn-primary btn-circle">1</a>
			            <p style="font-size: 13px">Chofer</p>
			        </div>
			        <div class="stepwizard-step">
			            <a href="#step-2" type="button" class="btn btn-default btn-circle disabled">2</a>
			            <p style="font-size: 13px">Vehículo</p>
			        </div>
			        
			    </div>
			</div>
			<form role="form" id="form" action="#">
				<input type="hidden" id="id_ope" name="id_ope" value="<?php echo $id_ope;?>">
			    <div class="row setup-content" id="step-1">
			        <div class="col-xs-12">
			            <div class="col-md-11">
			                <h3>&nbsp;</h3>
			                	<div class="form-group">
				            <label for="origen">RUT:</label>
				            <input type="text" class="form-control" required="required" id="pro_rut" name="pro_rut" value="">
				        </div>
				        <div class="form-group">
				            <label for="origen">Nombres:</label>
				            <input type="text" class="form-control" required="required" id="pro_nombres" name="pro_nombres" value="">
				        </div>
				        <div class="form-group">
				            <label for="origen">Apellidos:</label>
				            <input type="text" class="form-control" required="required" id="pro_apellidos" name="pro_apellidos" value="">
				        </div>
				        <div class="form-group">
				            <label for="origen">Email:</label>
				            <input type="email" class="form-control" required="email" id="pro_email" name="pro_email" value="">
				        </div>
				        <div class="form-group row">
				            <div class="col-xs-6 col-md-6 col-lg-6">
							    	<label for="ex1">Telf Móvil:</label>
							    	<input class="form-control" id="pro_telf_movil" name="pro_telf_movil" type="text" value="" >
							</div>
							<div class="col-xs-6 col-md-6 col-lg-6">
					            <label for="date">Fecha Nacim.:</label>
					            <div class="input-daterange" >
					                <input type="text" name="pro_fecha_nac" id="pro_fecha_nac" value="" class="form-control" />
					            </div>
					        </div>
				        </div>
				        <div class="form-group">
				            <label for="origen">Dirección:</label>
				            <input type="text" class="form-control" required="required" id="pro_direccion" name="pro_direccion" onFocus="geolocate()" value="">
				        </div>
				        <div class="form-group row">
				            <div class="col-xs-6 col-md-6 col-lg-6">
							    	<label for="ex1">Región:</label>
							    	<select class="form-control" id="cmb_region" name="cmb_region">
						            	<option value="">--Seleccione--</option>
						            	<?php
					            		$query_region= mysqli_query($con,"SELECT * FROM tbl_region");
					            		while ($trans=mysqli_fetch_array($query_region)){
					            			
						            	?>
						            	<option value="<?php echo $reg['reg_id'];?>"><?php echo $reg["reg_nombre"];?></option>
						            	<?php }
						            	?>
						            	
						            </select>
							</div>
							<div class="col-xs-6 col-md-6 col-lg-6">
							    	<label for="ex1">Comuna:</label>
							    	<select class="form-control" id="cmb_comuna" name="cmb_comuna" required="required">
						            	<option value="">--Seleccione--</option>
						            	<?php
					            		$query_comuna= mysqli_query($con,"SELECT * FROM tbl_comuna");
					            		while ($comun=mysqli_fetch_array($query_comuna)){
					            			
						            	?>
						            	<option value="<?php echo $comun['com_id'];?>"><?php echo utf8_encode($comun["com_nombre"]);?></option>
						            	<?php }
						            	?>
						            	
						            </select>
							</div>


				        </div>
				        <div class="form-group">
				            	<label for="origen">Experiencia en años conduciendo transporte:</label>
				            	<select class="form-control" id="pro_experiencia" name="pro_experiencia" required="required">
						            	<option value="">--Seleccione--</option>						            	
						            	<option value="1 a 5">1 a 5</option>
						            	<option value="6 a 10">6 a 10</option>
						            	<option value="mayor a 10">mayor a 10</option>
						        </select>
				        </div>
				        <div class="form-group">
				            <label for="origen">Fecha Vencimiento Licencia:</label>
				            <div class="input-daterange" >
					                <input type="text" class="form-control" id="pro_venci_licencia" name="pro_venci_licencia" value="">
					        </div>
				            
				        </div>
					            <button class="btn btn-primary nextBtn pull-right" type="button">Siguiente</button>

					    </div>
					    <br><br>
			        </div>
			    </div>
			    <div class="row setup-content" id="step-2">
			        <div class="col-xs-12">
			            <div class="col-md-11">
			                <h3>&nbsp;</h3>
			                <div class="form-group">
							<div class="table-responsive">
								<table class="table table-bordered">
									
									<tr>
										<td align="center">
											<div id="load_img">
												<img class="img-responsive" width="50%" src="../../tllevo-front/img/vehiculos/transport.png" alt="Foto" />
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
				            <label for="origen">Vehículo Patente:</label>
				            <input type="text" class="form-control" required="required" id="vehi_patente" name="vehi_patente" value="">
				        </div>
				        <div class="form-group">
				            <label for="origen">Modelo:</label>
				            <input type="text" class="form-control" required="required" id="vehi_modelo" name="vehi_modelo" value="">
				        </div>
				        <div class="form-group">
				            <label for="origen">Marca:</label>
				            <input type="text" class="form-control" id="vehi_marca" name="vehi_marca" value="">
				        </div>
				        <div class="form-group row">
				            <div class="col-xs-6 col-md-6 col-lg-6">
							    	<label for="ex1">Año:</label>
							    	<input class="form-control" id="vehi_anio" name="vehi_anio" type="text" value="" >
							</div>
							<div class="col-xs-6 col-md-6 col-lg-6">
							    	<label for="ex1">Capacidad (m<sup style="font-size: 11px">3</sup>):</label>
							    	<input class="form-control" required="required" id="vehi_volumen" name="vehi_volumen" type="text" value="">
							</div>
				        </div>
				        <div class="form-group row">
				            <div class="col-xs-6 col-md-6 col-lg-6">
					            <label for="origen">Tipo de Transporte:</label>
					            <select class="form-control" required="required" id="cmb_tipotrans" name="cmb_tipotrans">
					            	<option value="">--Seleccione--</option>
					            	<?php
				            		$query_trans= mysqli_query($con,"SELECT * FROM tbl_transporte");
				            		while ($trans=mysqli_fetch_array($query_trans)){
					            	?>
					            	<option value="<?php echo $trans['trans_id'];?>"><?php echo $trans["trans_nombre"];?></option>
					            	<?php }
					            	?>
					            	
					            </select>
					        </div>
					        <div class="col-xs-6 col-md-6 col-lg-6">
					            <label for="origen">Abierto/Cerrado:</label>
					            <select class="form-control" required="required" id="cmb_abiercerr" name="cmb_abiercerr">
					            	<option value="">--Seleccione--</option>
					            	<option value="1">Abierto</option>
					            	<option value="2">Cerrado</option>
					            	
					            </select>
					        </div>
				        </div>
				        
				        <div class="form-group row">
				            <div class="col-xs-6 col-md-6 col-lg-6">
							    	<label for="ex1">Nro Ejes:</label>
							    	<input class="form-control" id="vehi_num_ejes" name="vehi_num_ejes" type="text" value="">
							</div>
				            <div class="col-xs-6 col-md-6 col-lg-6">
							    	<label for="ex1">Rendimiento (<span style="font-size: 12px"> km/L</span>):</label>
							    	<input class="form-control" id="vehi_rendimiento" name="vehi_rendimiento" type="text" value="" >
							</div>
							
				        </div>

			                <button class="btn btn-success nextBtn pull-right" type="button" id="btnSave">Grabar</button>
			            </div>
			        </div>
			    </div>
			    <br><br>
			    
			    
			</form>
		</div>

	</main>

	<div id="cd-shadow-layer"></div>
	


<script src="js/main-operator.js"></script> <!-- Gem jQuery -->
<script src="js/pen.js"></script>
<script src='//cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>
<script src='//maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js'></script>
<script src='https://cdnjs.cloudflare.com/ajax/libs/tooltipster/3.3.0/js/jquery.tooltipster.min.js'></script>
<script src='https://cdn.jsdelivr.net/jquery.validation/1.15.0/jquery.validate.min.js'></script>

<script src="../js/bootstrap-datepicker.js"></script>
<script src="../js/bootbox.js"></script> <!-- Bootbox -->
<script type="text/javascript" src="../js/bootstrap-filestyle.js"> </script>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCq2IB2MrfoWuvAsG0TFRCxoGiFgtot6Uw&v=3.exp&signed_in=true&libraries=places"></script>

  

    <script >
    

      $(document).ready(function () {
      	jQuery.extend(jQuery.validator.messages, {
		  required: "Este campo es obligatorio.",
		  remote: "Por favor, rellena este campo.",
		  email: "Por favor, escribe una dirección de correo válida",
		  url: "Por favor, escribe una URL válida.",
		  date: "Por favor, escribe una fecha válida.",
		  dateISO: "Por favor, escribe una fecha (ISO) válida.",
		  number: "Por favor, escribe un número entero válido.",
		  digits: "Por favor, escribe sólo dígitos.",
		  creditcard: "Por favor, escribe un número de tarjeta válido.",
		  equalTo: "Por favor, escribe el mismo valor de nuevo.",
		  accept: "Por favor, escribe un valor con una extensión aceptada.",
		  maxlength: jQuery.validator.format("Por favor, no escribas más de {0} caracteres."),
		  minlength: jQuery.validator.format("Por favor, no escribas menos de {0} caracteres."),
		  rangelength: jQuery.validator.format("Por favor, escribe un valor entre {0} y {1} caracteres."),
		  range: jQuery.validator.format("Por favor, escribe un valor entre {0} y {1}."),
		  max: jQuery.validator.format("Por favor, escribe un valor menor o igual a {0}."),
		  min: jQuery.validator.format("Por favor, escribe un valor mayor o igual a {0}.")
		});
      


      
      //validation

     $('input, select').tooltipster({
         trigger: 'custom',
         onlyOne: false,
         position: 'bottom-left',
         theme: 'tooltipster-light',
       });

        $("#form").validate({
            errorPlacement: function (error, element) {
                var lastError = $(element).data('lastError'),
                    newError = $(error).text();

                $(element).data('lastError', newError);

                if(newError !== '' && newError !== lastError){
                    $(element).tooltipster('content', newError);
                    $(element).tooltipster('show');
                }
            },
            success: function (label, element) {
                $(element).tooltipster('hide');
            },
            messages:{
              acceptTerms:{required : "Debe aceptar los términos"},
            }
        });

  
    /* This code handles all of the navigation stuff.
    ** Probably leave it. Credit to https://bootsnipp.com/snippets/featured/form-wizard-and-validation
    */
    var navListItems = $('div.setup-panel div a'),
            allWells = $('.setup-content'),
            allNextBtn = $('.nextBtn');

    allWells.hide();

    navListItems.click(function (e) {
        e.preventDefault();
        var $target = $($(this).attr('href')),
            $item = $(this);

        if (!$item.hasClass('disabled')) {
            navListItems.removeClass('btn-primary').addClass('btn-default');
            $item.addClass('btn-primary');
            $('input, select').tooltipster("hide");
            allWells.hide();
            $target.show();
            $target.find('input:eq(0)').focus();
        }
    });

    /* Handles validating using jQuery validate.
    */
    allNextBtn.click(function(){
        var curStep = $(this).closest(".setup-content"),
            curStepBtn = curStep.attr("id"),
            nextStepWizard = $('div.setup-panel div a[href="#' + curStepBtn + '"]').parent().next().children("a"),
            curInputs = curStep.find("input[type='text'],input[type='email'],input[type='url'],select"),
            isValid = true;

        //Loop through all inputs in this form group and validate them.
        for(var i=0; i<curInputs.length; i++){
        	if (window.CP.shouldStopExecution(1)){break;}
            if (!$(curInputs[i]).valid()){
                isValid = false;
            }
        }
		window.CP.exitedLoop(1);


        if (isValid){
            //Progress to the next page.
          
          nextStepWizard.removeClass('disabled').trigger('click');
            // # # # AJAX REQUEST HERE # # # 
            
       	if (curStepBtn=="step-2"){
       		var file = $('.img-responsive').attr('src');
			var pro_rut = $('#pro_rut').val();
			var pro_nombres = $('#pro_nombres').val();
			var pro_apellidos = $('#pro_apellidos').val();
			var pro_email = $('#pro_email').val();
			var pro_telf_movil = $('#pro_telf_movil').val();
			var pro_direccion = $('#pro_direccion').val();
			var cmb_comuna = $('#cmb_comuna').val();
			var pro_fecha_nac = $('#pro_fecha_nac').val();
			var pro_venci_licencia = $('#pro_venci_licencia').val();
			var pro_experiencia = $('#pro_experiencia').val();
			var vehi_patente = $('#vehi_patente').val();
			var vehi_modelo = $('#vehi_modelo').val();
			var vehi_marca = $('#vehi_marca').val();
			var vehi_anio = $('#vehi_anio').val();
			var vehi_volumen = $('#vehi_volumen').val();
			var cmb_tipotrans = $('#cmb_tipotrans').val();
			var cmb_abiercerr = $('#cmb_abiercerr').val();
			var vehi_num_ejes = $('#vehi_num_ejes').val();
			var vehi_rendimiento = $('#vehi_rendimiento').val();

			var data = new FormData();
				data.append('imagefile',file);
				data.append('pro_rut',pro_rut);
				data.append('pro_nombres',pro_nombres);
				data.append('pro_apellidos',pro_apellidos);
				data.append('pro_email',pro_email);
				data.append('pro_telf_movil',pro_telf_movil);
				data.append('pro_direccion',pro_direccion);
				data.append('cmb_comuna',cmb_comuna);
				data.append('pro_fecha_nac',pro_fecha_nac);
				data.append('pro_venci_licencia',pro_venci_licencia);
				data.append('pro_experiencia',pro_experiencia);

				data.append('vehi_patente',vehi_patente);
				data.append('vehi_modelo',vehi_modelo);
				data.append('vehi_marca',vehi_marca);
				data.append('vehi_anio',vehi_anio);
				data.append('vehi_volumen',vehi_volumen);
				data.append('cmb_tipotrans',cmb_tipotrans);
				data.append('cmb_abiercerr',cmb_abiercerr);
				data.append('vehi_num_ejes',vehi_num_ejes);
				data.append('vehi_rendimiento',vehi_rendimiento);

	       	$.ajax({
	         	url:"process/grabar_new_chof_veh.php",
				type: "POST",             // Type of request to be send, called as method
				data: data, 			  // Data sent to server, a set of key/value pairs (i.e. form fields and values)
				contentType: false,       // The content type used when sending data to the server.
				cache: false,             // To unable request pages to be cached
				processData:false,        // To send DOMDocument or non processed data file it is set to false
	         	success:function(data){
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
	         	error: function (jqXHR, textStatus, errorThrown){
	            	alert('Error procesando los datos');
	        	}
	      	});
       	}
            /*
            Theoretically, in order to preserve the state of the form should the worst happen, we could use an ajax call that would look something like this:
            
            //Prepare the key-val pairs like a normal post request.
            var fields = {};
            for(var i= 0; i < curInputs.length; i++){
              fields[$(curInputs[i]).attr("name")] = $(curInputs[i]).attr("name").val();
            }
            
            $.post(
                "location.php",
                fields,
                function(data){
                  //Silent success handler.
                }                
            );
            
            //The FINAL button on last page should have its own logic to finalize the enrolment.
            */
        }

       
    });

    $('div.setup-panel div a.btn-primary').trigger('click');

    
});
      //# sourceURL=pen.js
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
<script>
	function upload_image(){
			
			var inputFileImage = document.getElementById("imagefile");
			var file = inputFileImage.files[0];
			if( (typeof file === "object") && (file !== null) )
			{
				$("#load_img").text('Cargando...');	
				var data = new FormData();
				data.append('imagefile',file);
				$.ajax({
					url: "process/imagen_insert.php",        // Url to which the request is send
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