<?php require_once('Connections/coneccion.php'); ?>
<?php

 session_start();
 if(empty($_SESSION['idusuario'])) {
 header('Location: index.php');
 }


mysql_select_db($database_coneccion, $coneccion);
$query_librosUsuario = "SELECT idlibro, estado,autor.nombre as autor, editorial.nombre as editorial, publicacion, disponible, titulo 
FROM libro,autor,editorial 
where 
idpropietario = ". $_SESSION['idusuario']."
and   libro.idautor = autor.idautor
and   libro.ideditorial = editorial.ideditorial
"
;




$librosUsuario = mysql_query($query_librosUsuario, $coneccion) or die(mysql_error());
$row_librosUsuario = mysql_fetch_assoc($librosUsuario);
$totalRows_librosUsuario = mysql_num_rows($librosUsuario);
?>


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">  
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	
		<title>Libros UAI</title>
			
			
		<!-- CSS -->
		<link rel="stylesheet" href="css/style.css" type="text/css" media="screen" />
	
		
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
				
				<!-- navigation -->
				<div id="nav-holder">
					<ul id="nav" class="sf-menu">
						<li> <a href="home.php">HOME</a>
						</li>
				

						<li  class="current_page_item"><a href="libros.php">MIS LIBROS</a>
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
						<li><a href="about.php?idusuario=<?php echo $_SESSION['idusuario'];?>"> <?php echo $_SESSION['nombre'];?></a>
						<ul>
								<li><a href="editarCuenta.php">Configuracion</a></li>
								<li><a href="index.php"> Salir</a></li>
						</ul>
						</li>
					</ul>
				</div>
				<!-- ENDS navigation -->
			
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
					<div class="title-holder"></div>
					<!-- ENDS title -->
					
					
					<!-- page-content -->
						<div class="page-content">
					
						<!-- left -->
						<!-- ENDS left -->
                        <!-- right -->
<div class="one-half last"><br/>
          <!-- ENDS info boxes -->
<?php 
if($totalRows_librosUsuario != 0 )
{
?>		  
		  
<h4>Mis libritos</h4>
							
<table cellspacing="0" cellpadding="0" border="0">
<tbody>
  <tr>
    <th>idlibro</th>
    <th>estado</th>
    <th>autor</th>
    <th>titulo</th>
    <th>editorial</th>
    <th>publicacion</th>
    <th>disponible</th>
  </tr>
  <?php do { ?>
    <tr>
      <td><?php echo $row_librosUsuario['idlibro']; ?></td>
      <td><?php echo $row_librosUsuario['estado']; ?></td>
      <td><?php echo $row_librosUsuario['autor']; ?></td>
      <td><?php echo $row_librosUsuario['titulo']; ?></td>
      <td><?php echo $row_librosUsuario['editorial']; ?></td>
      <td><?php echo $row_librosUsuario['publicacion']; ?></td>
      <td><?php 
	   
	  if($row_librosUsuario['disponible'] == 1)
	  echo 'disponible';
	  else
	  echo '<a href="detalleLibro.php?idlibro='.$row_librosUsuario['idlibro'].'">prestado</a>'
	  ?></td>
    </tr>
    <?php } while ($row_librosUsuario = mysql_fetch_assoc($librosUsuario)); 
	

	?>
	</tbody>
</table>
<?php 
}else{

echo '<h4>No tienes libros registrados!</h4>';
echo '<br></br>';
echo '<p><a href="agregarLibro.php" class="link-button"><span>Agregar un Nuevo Libro</span></a></p>';
}
?>

<!-- ENDS table -->	
		
						</div>
						<!-- ENDS right -->
			
				  </div>
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
		<!-- ENDS BOTTOM -->
        <!-- start cufon -->
<script type="text/javascript"> Cufon.now(); </script>
		<!-- ENDS start cufon -->
	
	</body>
</html>
<?php
mysql_free_result($librosUsuario);
?>

