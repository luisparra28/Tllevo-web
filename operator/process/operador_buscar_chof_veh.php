<?php
	require_once ("../../config/db.php");//Contiene las variables de configuracion para conectar a la base de datos
	require_once ("../../config/conexion.php");//Contiene funcion que conecta a la base de datos
	session_start();
	$id_ope = $_SESSION["ope_id"];
	echo $id_ope;
	
	$action = (isset($_REQUEST['action'])&& $_REQUEST['action'] !=NULL)?$_REQUEST['action']:'';
	
	if($action == 'ajax'){
		 $sTable = "tbl_proveedor";
		 $sWhere = " WHERE tbl_proveedor.pro_ope_id =".$id_ope."";
		
		$sWhere.=" order by tbl_proveedor.pro_id desc";
		include 'pagination.php'; //include pagination file
		//pagination variables
		$page = (isset($_REQUEST['page']) && !empty($_REQUEST['page']))?$_REQUEST['page']:1;
		$per_page = 10; //how much records you want to show
		$adjacents  = 4; //gap between pages after number of adjacents
		$offset = ($page - 1) * $per_page;

		$misql = "SELECT count(*) AS numrows FROM $sTable  $sWhere";
		//echo $misql;
		//Count the total number of row in your table*/
		$count_query   = mysqli_query($con, "SELECT count(*) AS numrows FROM $sTable  $sWhere");
		$row= mysqli_fetch_array($count_query);
		$numrows = $row['numrows'];
		$total_pages = ceil($numrows/$per_page);
		$reload = './operator_listproveh.php';
		//main query to fetch the data
		$sql="SELECT * FROM  $sTable $sWhere LIMIT $offset,$per_page";
		$query = mysqli_query($con, $sql);
		//loop through fetched data
		if ($numrows>0){
			
			?>
			<div class="table-responsive">
			  <table class="table table-striped">
				<tr  class="" style="background-color: #31353d; color: #fff">
					<th>Chofer</th>
					
					<th class='text-right'>Vehículo</th>
					
				</tr>
				<?php
				while ($row=mysqli_fetch_array($query)){
						$id_chof			= $row['pro_id'];
						$pro_nombres		= utf8_encode($row['pro_nombres']);
						$pro_apellidos		= utf8_encode($row['pro_apellidos']);
						$pro_rut			= $row['pro_rut'];

						$sql1="SELECT * from tbl_vehiculo where vehi_pro_id=$id_chof";
						$result = mysqli_query($con, $sql1);
						if ($rowx = mysqli_fetch_array($result)){
							$id_vehi			= $rowx['vehi_id'];
							$vehi_transporte_id	= $rowx['vehi_transporte_id'];
							//$trans_nombre	    = utf8_encode($rowx['trans_nombre']);
							$vehi_foto			= $rowx['vehi_foto'];
							$vehi_patente		= utf8_encode($rowx['vehi_patente']);
							$vehi_anio			= $rowx['vehi_anio'];
							$vehi_modelo		= utf8_encode($rowx['vehi_modelo']);
							$vehi_marca			= utf8_encode($rowx['vehi_marca']);
							$vehi_volumen		= $rowx['vehi_volumen'];
						}
						else{
							$id_vehi			= "";
							$vehi_transporte_id	= "";
							$vehi_foto			= "";
							$vehi_patente		= "";
							$vehi_anio			= "";
							$vehi_modelo		= "";
							$vehi_marca			= "";
							$vehi_volumen		= "";
						}
						/*

						//$date_added			= date('d/m/Y H:i:00', strtotime($row['solic_fecha_requerida']));
						$vehi_num_ejes		= $row['vehi_num_ejes'];
						$vehi_rendimiento 	= $row['vehi_rendimiento'];*/
						
					?>
					
					<tr class="clickable-row" data-id="<?php echo $id_vehi;?>" style="cursor: pointer;">
						
						<td style="word-wrap:break-word; white-space: normal"><span style="font-weight: 600;" class="text-3"><?php echo $pro_nombres." ".$pro_apellidos;?></span><br>
							<span class="text-2">RUT: <?php echo $pro_rut;?></span><br>
							<button type="button" class="btn btn-sm btn-default btn-verchofer" data-idchof="<?php echo $id_chof;?>" id="btn-verchofer"><i class="glyphicon glyphicon-user" ></i> Ver Chofer</button>
						</td>	
						<td>
							<span style="font-weight: 600" class="pull-right text-3"><?php echo $vehi_patente;?></span><br>
							<span class="pull-right text-2">Modelo: <?php echo $vehi_modelo;?></span><br>
							<button type="button" class="btn btn-sm btn-default btn-vervehic pull-right" data-idvehi="<?php echo $id_vehi;?>" id="btn-vervehic"><i class="glyphicon glyphicon-record" ></i> Ver Vehículo</button>
						</td>
					</tr>
					<?php
				}
				?>
				<tr>
					<td colspan=7><span class="pull-right">
						<?php
						 echo paginate($reload, $page, $total_pages, $adjacents,'cargar');
						?></span>
					</td>
				</tr>
			  </table>
			  <script>
			  $(document).ready(function(){
			  		$(".btn-verchofer").click(function() {
			  			var id_chof = $(this).data("idchof");
				      	location.href="operator_chofer_edit.php?idchof="+id_chof;
				    });
				    $(".btn-vervehic").click(function() {
				    	var id_vehi = $(this).data("idvehi");
				      	location.href="operator_vehiculo_edit.php?idvehi="+id_vehi;
				    });

				});
			  
			  </script>
			</div>
			<?php
		}
	}
?>