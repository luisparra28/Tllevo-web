<?php
	/* Connect To Database*/
	if (isset($_FILES["imagefile"])){

				$target_dir="../../../tllevo-front/img/vehiculos/";
				$image_name = time()."_".basename($_FILES["imagefile"]["name"]);
				$target_file = $target_dir . $image_name;
				$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
				$imageFileZise=$_FILES["imagefile"]["size"];
				
				/* Inicio Validacion*/
				// Allow certain file formats
				if(($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif" ) and $imageFileZise>0) {
					$errors[]= "<p>Lo sentimos, sólo se permiten archivos JPG , JPEG, PNG y GIF.</p>";
				} else if ($imageFileZise > 2097152) {//1048576 byte=1MB - 2097152 = 2MB
					$errors[]= "<p>Lo sentimos, pero el archivo es demasiado grande. Selecciona Imagen de menos de 1MB</p>";
				}  
			else
			{
				/* Fin Validacion*/
				if ($imageFileZise>0){
					move_uploaded_file($_FILES["imagefile"]["tmp_name"], $target_file);
				
				}	
				
                    
                ?>
				<img class="img-responsive" src="../../tllevo-front/img/vehiculos/<?php echo $image_name;?>" alt="Foto">
			
			<?php		
			}
	}	
				
		if (isset($errors)){
	?>
		<div class="alert alert-danger">
			<button type="button" class="close" data-dismiss="alert">&times;</button>
			<strong>Error! </strong>
		<?php
			foreach ($errors as $error){
				echo $error;
			}
		?>
		</div>	
	<?php
	}
?>