<?php require_once('Connections/coneccion.php'); ?>
<?php
session_start();
 if(empty($_SESSION['idusuario'])) { 
 header('Location: index.php');
 } 
 


$colname_detalleLibro = "-1";
if (isset($_GET['idlibro'])) {
  $colname_detalleLibro = (get_magic_quotes_gpc()) ? $_GET['idlibro'] : addslashes($_GET['idlibro']);
}
mysql_select_db($database_coneccion, $coneccion);
$query_detalleLibro = sprintf("SELECT idlibro,titulo,publicacion,estado,disponible,
autor.nombre as autor,
usuario.nombre as propietario,
editorial.nombre as editorial
 FROM libro 
 inner join autor on libro.idautor = autor.idautor
 inner join usuario on libro.idpropietario = usuario.idusuario
 inner join editorial on libro.ideditorial = editorial.ideditorial
  WHERE idlibro = %s", $colname_detalleLibro);

$detalleLibro = mysql_query($query_detalleLibro, $coneccion) or die(mysql_error());
$row_detalleLibro = mysql_fetch_assoc($detalleLibro);
$totalRows_detalleLibro = mysql_num_rows($detalleLibro);


?>



<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">  
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	
		<title>Libros UAI</title>
			
			
		<!-- CSS -->
		<link rel="stylesheet" href="css/style.css" type="text/css" media="screen" />
		<!-- ENDS CSS -->
		
		<!-- prettyPhoto -->
		<link rel="stylesheet" href="js/prettyPhoto/css/prettyPhoto.css" type="text/css" media="screen" />
		<!-- ENDS prettyPhoto -->
	
		<!-- JS -->
		<script type="text/javascript" src="js/jquery_1.4.2.js"></script>
		<script type="text/javascript" src="js/jqueryui.js"></script>
		<script type="text/javascript" src="js/easing.js"></script>
		<script type="text/javascript" src="js/jquery.cycle.all.js"></script>
		<script type="text/javascript" src="js/tooltip/jquery.tools.min.js"></script>
		<script type="text/javascript" src="js/filterable.pack.js"></script>
		<script type="text/javascript" src="js/prettyPhoto/js/jquery.prettyPhoto.js"></script>
		<script type="text/javascript" src="js/chirp.js"></script>
		<script type="text/javascript" src="js/jquery.tabs/jquery.tabs.pack.js"></script>
		<script type="text/javascript" src="js/custom.js"></script>
		<!-- ENDS JS -->
		
		<!-- Cufon -->
		<script src="js/cufon-yui.js" type="text/javascript"></script>
		<script src="js/fonts/bebas-neue_400.font.js" type="text/javascript"></script>
        <!-- /Cufon -->
		
		<!-- superfish -->
		<link rel="stylesheet" type="text/css" media="screen" href="css/superfish-custom.css" /> 
		<script type="text/javascript" src="js/superfish-1.4.8/js/hoverIntent.js"></script> 
		<script type="text/javascript" src="js/superfish-1.4.8/js/superfish.js"></script> 
		<!-- ENDS superfish -->
		
		<!-- tabs -->
        <link rel="stylesheet" href="css/jquery.tabs.css" type="text/css" media="print, projection, screen" />
        <!-- Additional IE/Win specific style sheet (Conditional Comments) -->
        <!--[if lte IE 7]>
        <link rel="stylesheet" href="css/jquery.tabs-ie.css" type="text/css" media="projection, screen">
        <![endif]-->
  		<!-- ENDS tabs -->
	</head>
	
	
	<body>

		<!-- HEADER -->
		<div id="header">
		<div class="degree">
			<div class="wrapper">
				<a href="home.php"><img src="img/logo.png" alt="Logo" id="logo" /></a>
		
				<!-- search -->
				<div class="top-search">
					<form  method="get" id="searchform" action="">
						<div>
							<input type="text" value="Search..." name="s" id="s" onfocus="defaultInput(this)" onblur="clearInput(this)" />
							<input type="submit" id="searchsubmit" value=" " />
						</div>
					</form>
				</div>
				<!-- ENDS search -->
				
				<!-- navigation -->
				<div id="nav-holder">
					<ul id="nav" class="sf-menu">
						<li ><a href="home.php">HOME</a>
						</li>
				

						<li  ><a href="libros.php">MIS LIBROS</a>
						<ul>
								<li><a href="administracionLibros.php">Administrar</a></li>								
						</ul>
						</li>
						<li><a href="lecturas.php">MIS LECTURAS</a>
						<ul>
								<li><a href="lecturas.php">Actuales</a></li>
								<li><a href="lecturas.php">Hechas</a></li>																
						</ul>
						</li>
						
						<li ><a href="blogs.php">BLOG</a>
						<ul>
								<li><a href="lecturas.php">Nuevo</a></li>
								<li><a href="blogs.php">Administrar</a></li>																
						</ul>
						</li>
						
						<li ><a href="about.php?idusuario=<?php echo $_SESSION['idusuario'];?>"> <?php echo $_SESSION['nombre'];?></a>
						<ul>
								<li><a href="editarCuenta.php">Configuracion</a></li>
								<li><a href="index.php"> Salir</a></li>
						</ul>
						</li>
						
						
					</ul>
				</div>
				<!-- ENDS navigation -->
			
			
			</div>
			<!-- ENDS HEADER-wrapper -->
		</div>
		</div>
		<!-- ENDS HEADER -->
			
		<!-- MAIN -->
		<div id="main">
			<!-- wrapper -->
		  <div class="wrapper">
				<!-- content -->
				<div class="content">
					<!-- title -->
					<div class="title-holder">
						<span class="title">Detalles Libro </span></div>
					<!-- ENDS title -->
				

							  <!--info libro-->
					  <ul class="staff">
					  	<img src="img/logo3.png" alt="Pic" />

						  <li>
						   <?php 
						   			if($totalRows_detalleLibro != 0)
						   				{
						   
						   		  ?>

							  <div class="information">
								  <div class="header">
								  	
									<div class="name"><?php echo $row_detalleLibro['titulo']; ?></div>
									<div class="contact">Autor: <?php echo $row_detalleLibro['autor']; ?></div>
									<div class="contact"><?php echo $row_detalleLibro['editorial']?></div>

									<div class="contact">Identificador Unico: <?php echo $row_detalleLibro['idlibro']; ?></div>
									<div class="contact">Publicacion: <?php echo $row_detalleLibro['publicacion']; ?></div>
									  <div class="contact">Propietario: <?php echo $row_detalleLibro['propietario']
									  ; ?> </div>
									  <div class="contact">Estado <?php echo $row_detalleLibro['estado']; ?> </div>
									  <div class="contact"><br><?php 
									  if($row_detalleLibro['disponible'] == 1)
									  echo '<p><a href="#" class="link-button"><span>Solicitar</span></a></p>';
									else
										echo '<p class="link-button"><span>No disponible</span></p>';

									  ?>  </div>
								  </div>
							  </div>
						  </li>
					  </ul>
					  	  <!--end info libro-->
				 	

					  	  <!--leyendo por....-->
                     <ul class="staff">
						  <li></li>  
					      <li>							 
					        <div class="information">
					          <div class="header">
					            <div class="name">Leyendo por...</div>
							      <?php 
									  	  
										mysql_select_db($database_coneccion, $coneccion);
										$sql_lecturaActual = "SELECT usuario.nombre, inicio,fin
										FROM 
										lectura inner join usuario on lectura.idusuario = usuario.idusuario
										where lectura.idlibro = ".$colname_detalleLibro." 
										and fin is null
										order by inicio desc";

										//ORDER BY `publicacion`.`hora` DESC LIMIT 0, 30 

									$lecturaActual = mysql_query($sql_lecturaActual, $coneccion) or die(mysql_error());
									$rowLecturaActual = mysql_fetch_assoc($lecturaActual);
									$rowsLecturaActual = mysql_num_rows($lecturaActual);
									  
									  
										if($rowsLecturaActual != 0 )
											{
									?>		  
					            
					            <table cellspacing="0" cellpadding="0" border="0">
					              <tbody>
					                <tr>
					                  <th>Lector</th>
								      <th>inicio</th>
								      <th>fin</th>
								      								    </tr>
					                <?php do { 
					                	?>
					                  <tr>
					                    <td><?php echo $rowLecturaActual['nombre']; ?></td>
								        <td><?php echo $rowLecturaActual['inicio']; ?></td>
								        <td>--------------<?php echo $rowLecturaActual['fin']; ?></td>
							        </tr>
					                  <?php } while ($rowLecturaActual = mysql_fetch_assoc($lecturaActual)); 
	

										?>
					                </tbody>
				                </table>
								    <?php 	
											}//TOTAL ROWS LIBROS USUARIO
											else
												echo '<p>Sin registros<p>';
											
											?>
					            </div>
						      </div>
				        </li>
					  </ul>
					  <!--end leyendo por -->




				   	  <!--libro leido por-->
                     <ul class="staff">
						  <li></li>  
					      <li>							 
					        <div class="information">
					          <div class="header">
					            <div class="name">Sus lectores</div>
							      <?php 
									  	  
										mysql_select_db($database_coneccion, $coneccion);
										$sql_lectura = "SELECT usuario.nombre, inicio,fin
										FROM 
										lectura inner join usuario on lectura.idusuario = usuario.idusuario
										where lectura.idlibro = ".$colname_detalleLibro." 
										and fin is not null
										order by fin desc";

										//ORDER BY `publicacion`.`hora` DESC LIMIT 0, 30 

									$lecturaUsuario = mysql_query($sql_lectura, $coneccion) or die(mysql_error());
									$row_lectura = mysql_fetch_assoc($lecturaUsuario);
									$totalRows_librosUsuario = mysql_num_rows($lecturaUsuario);
									  
									  
										if($totalRows_librosUsuario != 0 )
											{
									?>		  
					            
					            <table cellspacing="0" cellpadding="0" border="0">
					              <tbody>
					                <tr>
					                  <th>Lector</th>
								      <th>inicio</th>
								      <th>fin</th>
								      								    </tr>
					                <?php do { ?>
					                  <tr>
					                    <td><?php echo $row_lectura['nombre']; ?></td>
								        <td><?php echo $row_lectura['inicio']; ?></td>
								        <td><?php echo $row_lectura['fin']; ?></td>
							        </tr>
					                  <?php } while ($row_lectura = mysql_fetch_assoc($lecturaUsuario)); 
	

										?>
					                </tbody>
				                </table>
								    <?php 	
											}//TOTAL ROWS LIBROS USUARIO
											else{

										echo '<p>Sin registros<p>';
											}


											}//TOTAL ROWS DETALLE LIBROS... 
											
											?>
					            </div>
						      </div>
				        </li>
					  </ul>
					  <!--end libro leido por-->


				  </div>

<!--END PAGE-CONTENT-->


				  <?php //}//END SOLICITUD VSITANTE?>
					<!-- ENDS page-content -->

				</div>
				
				
			  <!-- ENDS content -->
				
			  <!-- twitter -->
		  </div>
			<!-- ENDS twitter -->
				
	</div>
			<!-- ENDS main-wrapper -->
			
		
		</div>		
		<!-- ENDS MAIN -->	
		
		<!-- FOOTER -->
		<div id="footer">
		<div class="degree">
			<!-- wrapper -->
			<!-- ENDS footer-wrapper -->
	
</div>
		</div>
		<!-- ENDS FOOTER -->


		<!-- BOTTOM -->
		<div id="bottom">
			<!-- wrapper -->
			<!-- ENDS bottom-wrapper -->
					
			<p>hola!</p>
			
</div>
		<!-- ENDS BOTTOM -->

		<!-- start cufon -->
		<script type="text/javascript"> Cufon.now(); </script>
		<!-- ENDS start cufon -->
	
	</body>
</html>
<?php
mysql_free_result($detalleLibro);
?>
