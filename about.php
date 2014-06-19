<?php require_once('Connections/coneccion.php'); ?>
<?php
session_start();
 if(empty($_SESSION['idusuario'])) { 
 header('Location: index.php');
 } 
 

$maxRows_usuario = 10;
$pageNum_usuario = 0;
if (isset($_GET['pageNum_usuario'])) {
  $pageNum_usuario = $_GET['pageNum_usuario'];
}
$startRow_usuario = $pageNum_usuario * $maxRows_usuario;

$colname_usuario = "-1";
if (isset($_GET['idusuario'])) {
  $colname_usuario = (get_magic_quotes_gpc()) ? $_GET['idusuario'] : addslashes($_GET['idusuario']);
}
mysql_select_db($database_coneccion, $coneccion);
$query_usuario = sprintf("SELECT usuario.nombre,usuario.sexo,usuario.correo, usuario.facebook,
								usuario.telefono,usuario.direccion, unidad.nombre as unidad 	
								FROM usuario,unidad 
								WHERE idusuario = %s 
								and usuario.idunidad = unidad.idunidad", $colname_usuario);
								
$query_limit_usuario = sprintf("%s LIMIT %d, %d", $query_usuario, $startRow_usuario, $maxRows_usuario);
$usuario = mysql_query($query_limit_usuario, $coneccion) or die(mysql_error());
$row_usuario = mysql_fetch_assoc($usuario);

if (isset($_GET['totalRows_usuario'])) {
  $totalRows_usuario = $_GET['totalRows_usuario'];
} else {
  $all_usuario = mysql_query($query_usuario);
  $totalRows_usuario = mysql_num_rows($all_usuario);
}
$totalPages_usuario = ceil($totalRows_usuario/$maxRows_usuario)-1;



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
						<?php 
						
						if($_SESSION['idusuario'] != $colname_usuario)
						echo '<li  ><a href="about.php?idusuario='.$_SESSION['idusuario'].'">'.$_SESSION['nombre'].'</a>';
						else
						echo '<li class="current_page_item" ><a href="about.php?idusuario='.$_SESSION['idusuario'].'">'.$_SESSION['nombre'].'</a>';
						

						?>
						
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
						<span class="title">Detalle de la cuenta </span></div>
					<!-- ENDS title -->
					
					<!-- page-content -->
				  <div class="page-content">

						<!-- staff -->
					  <ul class="staff">
						  <li>
						   <?php 
									  if(strcasecmp($row_usuario['sexo'],'f') == 0 )
									  echo '<img src="img/girl.png" alt="Pic" />'; 
									  else
									   echo '<img src="img/guy.png" alt="Pic" />';
									  ?>
						  
							 
							  <div class="information">
								  <div class="header">
									  <div class="name"><?php echo $row_usuario['nombre']; ?></div>
									  <div class="contact"><a href="<?php echo $row_usuario['facebook']; ?>">
									  								<?php echo $row_usuario['facebook']; ?></a> </div>
									<div class="contact">Correro: <?php echo $row_usuario['correo']; ?></div>
									  <div class="contact">Direccion: <?php echo $row_usuario['direccion']; ?> </div>
									  <div class="contact">Telefono: <?php echo $row_usuario['telefono']; ?> </div>
									  <div class="contact"><?php echo $row_usuario['unidad']; ?>  </div>
								  </div>
							  </div>
						  </li>
			             
					  
					  </ul>
				  </div>
				  
				   <div class="page-content">

						<?php 
						
						if($_SESSION['idusuario'] != $colname_usuario)
						{//si la solicitud de pagina web la hace un visitante.
						?>
						<!-- staff -->
					  <ul class="staff">
						  <li>							 
							  <div class="information">
								  <div class="header">
									  <div class="name">Libros Registrados</div>
									  <?php 
									  	  
										mysql_select_db($database_coneccion, $coneccion);
										$query_librosUsuario = "SELECT idlibro, estado,autor.nombre as autor, 
										editorial.nombre as editorial,
										publicacion, disponible, titulo
										FROM libro,autor,editorial 
										where idpropietario = ". $colname_usuario."
										and   libro.idautor = autor.idautor
										and   libro.ideditorial = editorial.ideditorial";


									$librosUsuario = mysql_query($query_librosUsuario, $coneccion) or die(mysql_error());
									$row_librosUsuario = mysql_fetch_assoc($librosUsuario);
									$totalRows_librosUsuario = mysql_num_rows($librosUsuario);
									  
									  
										if($totalRows_librosUsuario != 0 )
											{
									?>		  
									
										<table cellspacing="0" cellpadding="0" border="0">
											<tbody>
											  <tr>
											    <th>estado</th>
											    <th>autor</th>
											    <th>titulo</th>
											    <th>editorial</th>
											    <th>Disponibilidad</th>
											  </tr>
									  <?php do { ?>
									    <tr>
									      <td><?php echo $row_librosUsuario['estado']; ?></td>
									      <td><?php echo $row_librosUsuario['autor']; ?></td>
									      <td><?php echo $row_librosUsuario['titulo']; ?></td>
									      <td><?php echo $row_librosUsuario['editorial']; ?></td>
									      <td><?php 
	   
										  if($row_librosUsuario['disponible'] == 1){
										  echo '<p><a href="#" class="link-button"><span>Solicitar</span></a></p>';
										  }else
										  echo 'No disponible'
									  ?></td>
								      </tr>
									    <?php } while ($row_librosUsuario = mysql_fetch_assoc($librosUsuario)); 
	

										?>
											</tbody>
									</table>
										<?php 	
											}else{

										echo '<p>Sin registros<p>';
											}
											
											?>
								  </div>
							  </div>
						  </li>  
					  </ul>
				  </div>
				  <?php 
				}
				  ?>
<!--CONTENEDOR LIBROS LEIDOS-->
					<div class="page-content">

						<?php 
						
						if($_SESSION['idusuario'] != $colname_usuario)
						{//si la solicitud de pagina web la hace un visitante.
						?>
						<!-- staff -->
					  <ul class="staff">
						  <li>							 
							  <div class="information">
								  <div class="header">
									  <div class="name">LIBROS LEIDOS</div>
									  <?php 


										mysql_select_db($database_coneccion, $coneccion);

$query_leidos = "SELECT lectura.idlectura,libro.titulo as titulo,  autor.nombre as autor, usuario.nombre as propietario, lectura.inicio, lectura.fin
FROM lectura,libro,usuario,autor
WHERE lectura.idusuario = ".$colname_usuario."
and lectura.idlibro = libro.idlibro
and libro.idautor = autor.idautor
and libro.idpropietario = usuario.idusuario
and fin IS NOT NULL
";

									$librosLeidos = mysql_query($query_leidos, $coneccion) or die(mysql_error());
									$row_libroLeido = mysql_fetch_assoc($librosLeidos);
									$totalRows_librosLeidos = mysql_num_rows($librosLeidos);
									  
									  
										if($totalRows_librosLeidos != 0 )
											{
									?>		  
									
										<table cellspacing="0" cellpadding="0" border="0">
											<tbody>
											  <tr>
											    <th>titulo</th>
											    <th>autor</th>
											    <th>inicio</th>
											    <th>fin</th>
											  </tr>
									  <?php do { ?>
									    <tr>
									      <td><?php echo $row_libroLeido['titulo']; ?></td>
									      <td><?php echo $row_libroLeido['autor']; ?></td>
									      <td><?php echo $row_libroLeido['inicio']; ?></td>
									      <td><?php echo $row_libroLeido['fin']; ?></td>
									      <td><?php 
									  ?>
									</td>
								      </tr>
									    <?php } while ($row_libroLeido = mysql_fetch_assoc($librosLeidos)); 
	

										?>
											</tbody>
									</table>
										<?php 	
											}else{

										echo '<p>Usuario reacio a vivir mas vidas... o es ingeniero</p>';
											}
											
											?>
								  </div>
							  </div>
						  </li>  
					  </ul>
				  </div>				  
				  <!--FIN CONTENEDOR LIBROS LEIDOS-->

				  <?php 
				}//END SOLICITUD VSITANTE
				?>
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

			
</div>
		<!-- ENDS BOTTOM -->

		<!-- start cufon -->
		<script type="text/javascript"> Cufon.now(); </script>
		<!-- ENDS start cufon -->
	
	</body>
</html>
<?php
mysql_free_result($usuario);
?>
