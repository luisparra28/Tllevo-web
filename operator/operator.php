<?php 
session_start();
require_once ("../config/db.php");//Contiene las variables de configuracion para conectar a la base de datos
require_once ("../config/conexion.php");//Contiene funcion que conecta a la base de datos
$id_ope = $_SESSION['ope_id'];

$query= mysqli_query($con,"SELECT * FROM tbl_operador where ope_id = $id_ope");
		$row= mysqli_fetch_array($query);

		$ope_rut				= $row['ope_rut'];
		$ope_razon_social   	= utf8_encode($row['ope_razon_social']);
		$ope_direccion      	= utf8_encode($row['ope_direccion']);
		$ope_telefono    		= $row['ope_telefono'];
		$ope_email				= $row['ope_email'];
		$ope_repres_nombre		= utf8_encode($row['ope_repres_nombre']);
		$ope_repres_rut			= $row['ope_repres_rut'];
		$ope_repres_telefono	= $row['ope_repres_telefono'];
		$ope_cuenta_banco		= $row['ope_cuenta_banco'];
		$ope_cuenta_tipo		= $row['ope_cuenta_tipo'];
		$ope_cuenta_rut			= $row['ope_cuenta_rut'];
		$ope_cuenta_nombre		= $row['ope_cuenta_nombre'];
		$ope_cuenta_numero		= $row['ope_cuenta_numero'];
		
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
	

	<link rel="stylesheet" href="css/reset.css"> <!-- CSS reset -->
	<link rel="stylesheet" href="css/style.css"> <!-- Gem style -->
	<script src="../js/modernizr.js"></script> <!-- Modernizr -->
  	
	<title>:: Tllevo : Operador</title>
</head>
<body>
	<header role="banner">
		<div id="logo"><img src="img/logo-1.png" alt="Home"></div><div id="text-menu">Mis Datos<br><span id="subtext-menu">Datos Principales de Operador</span></div>
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
				<div align="center" style="background-color: #efefe7; padding:8px; border-bottom: 3px solid #da2129; border-radius: 4px">Mis Datos</div>
		</div>-->
		<div class="container">
			<div class="stepwizard">
			    <div class="stepwizard-row setup-panel">
			        <div class="stepwizard-step">
			            <a href="#step-1" type="button" class="btn btn-primary btn-circle">1</a>
			            <p>Razón Social</p>
			        </div>
			        <div class="stepwizard-step">
			            <a href="#step-2" type="button" class="btn btn-default btn-circle disabled">2</a>
			            <p>Representante</p>
			        </div>
			        <div class="stepwizard-step">
			            <a href="#step-3" type="button" class="btn btn-default btn-circle disabled">3</a>
			            <p>Bancarios</p>
			        </div>
			    </div>
			</div>
			<form role="form" id="form">
				<input type="hidden" id="id_ope" name="id_ope" value="<?php echo $id_ope;?>">
			    <div class="row setup-content" id="step-1">
			        <div class="col-xs-12">
			            <div class="col-md-11">
			                <h3>&nbsp;</h3>
			                	<div class="form-group">
				            		<label for="origen">RUT:</label>
				   					<input type="text" class="form-control" required="required" id="ope_rut" name="ope_rut" value="<?php echo $ope_rut;?>">
						        </div>
						        <div class="form-group">
						            <label for="origen">Razón Social:</label>
						            <input type="text" class="form-control" required="required" id="ope_razon_social" name="ope_razon_social" value="<?php echo $ope_razon_social;?>">
						        </div>
						        <div class="form-group">
						            <label class="control-label" for="origen">Dirección Comercial:</label>
						            <input type="text" class="form-control" id="ope_direccion" name="ope_direccion" value="<?php echo $ope_direccion;?>">
						        </div>
						        <div class="form-group">
						            <label for="origen">Teléfono:</label>
						            <input type="text" class="form-control" id="ope_telefono" name="ope_telefono" value="<?php echo $ope_telefono;?>">
						        </div>
						        <div class="form-group">
							    	<label for="ex1">Email:</label>
							    	<input class="form-control" id="ope_email" required="email" name="ope_email" type="email" value="<?php echo $ope_email;?>" >
						        </div>

					            <button class="btn btn-primary nextBtn pull-right" type="button">Siguiente</button>
					    </div>
			        </div>
			    </div>
			    <div class="row setup-content" id="step-2">
			        <div class="col-xs-12">
			            <div class="col-md-11">
			                <h3>&nbsp;</h3>
			                <div class="form-group">
			                    <label class="control-label">Nombre:</label>
			                    <input maxlength="200" type="text" name="nom_repre" required="required" class="form-control" value="<?php echo $ope_repres_nombre;?>" />
			                </div>
			                <div class="form-group">
			                    <label class="control-label">RUT:</label>
			                    <input maxlength="200" type="text" name="rut_repre" required="required" class="form-control" value="<?php echo $ope_repres_rut;?>" />
			                </div>
			                <div class="form-group">
			                    <label class="control-label">Teléfono:</label>
			                    <input maxlength="200" type="text" name="telf_repre" required="required" class="form-control" value="<?php echo $ope_repres_telefono;?>" />
			                </div>
			                
			                <button class="btn btn-primary nextBtn pull-right" type="button">Siguiente</button>
			            </div>
			        </div>
			    </div>

			    <div class="row setup-content" id="step-3">
			        <div class="col-xs-12">
			            <div class="col-md-11">
			                <h3>&nbsp;</h3>
			                <div class="form-group">
			                    <label class="control-label">Banco:</label>
			                    <select class="form-control" id="ope_cuenta_banco" required="required" name="ope_cuenta_banco">
					            	<option value="">--Seleccione--</option>
					            	<?php
				            		$query_bancos= mysqli_query($con,"SELECT * FROM tbl_banco");
				            		while ($bank=mysqli_fetch_array($query_bancos)){
				            			if ($ope_cuenta_banco == $bank['banco_id']) {
				            				$selected="selected";
				            			}
				            			else $selected="";
					            	?>
					            	<option value="<?php echo $bank['banco_id'];?>" <?php echo $selected;?>><?php echo utf8_encode($bank["banco_nombre"]);?></option>
					            	<?php }
					            	?>
					            	
					            </select>
			                </div>
			                <div class="form-group">
			                    <label class="control-label">Tipo de Cuenta:</label>
			                    <select class="form-control" id="ope_cuenta_tipo" required="required" name="ope_cuenta_tipo">
					            	<option value="">--Seleccione--</option>
					            	<?php
				            		$query_tipos= mysqli_query($con,"SELECT * FROM tbl_cuenta_tipo");
				            		while ($tipcue=mysqli_fetch_array($query_tipos)){
				            			if ($ope_cuenta_tipo == $tipcue['cuetip_id']) {
				            				$selected="selected";
				            			}
				            			else $selected="";
					            	?>
					            	<option value="<?php echo $tipcue['cuetip_id'];?>" <?php echo $selected;?>><?php echo utf8_encode($tipcue["cuetip_nombre"]);?></option>
					            	<?php }
					            	?>
					            </select>
			                </div>
			                <div class="form-group">
			                    <label class="control-label">RUT Titular:</label>
			                    <input maxlength="200" type="text" name="ope_cuenta_rut" required="required" class="form-control" value="<?php echo $ope_cuenta_rut;?>" />
			                </div>
			                <div class="form-group">
			                    <label class="control-label">Nombre Titular:</label>
			                    <input maxlength="200" type="text" name="ope_cuenta_nombre" required="required" class="form-control" value="<?php echo $ope_cuenta_nombre;?>" />
			                </div>
			                <div class="form-group">
			                    <label class="control-label">Nro de Cuenta:</label>
			                    <input maxlength="200" type="text" name="ope_cuenta_numero" required="required" class="form-control" value="<?php echo $ope_cuenta_numero;?>" />
			                </div>
			                
			                <button class="btn btn-success nextBtn pull-right" type="button" id="btnSave">Grabar</button>
			            </div>
			        </div>
			    </div>
			    
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
<script src="../js/bootbox.js"></script>
  

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
            
       	if (curStepBtn=="step-3"){
       		$('#btnSave').text('guardando...'); //change button text
	    	$('#btnSave').attr('disabled',true); //set button disable 
	       	$.ajax({
	         	url:"process/grabar_operador.php",
	         	method:"POST",
	         	data:$('#form').serialize(),
	         	//dataType: "JSON",
	         	success:function(data){
	            	//alert(data);
	            	//location.href="operator.php";
	            	$('#btnSave').text('Grabar'); //change button text
			        $('#btnSave').attr('disabled',false); //set button enable
	            	bootbox.dialog({
                        title: 'Mensaje',
                        message: data,
                        buttons: {
                            ok: {
                                label: "OK",
                                className: 'btn-default',
                                callback: function(){
                                	location.href="operator.php";
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

</body>
</html>