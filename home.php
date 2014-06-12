<?php require_once('Connections/coneccion.php'); ?>
<?php
$charset = mysql_client_encoding($coneccion);

echo "The current character set is: $charset\n";


  //Empezamos la sesión 
 session_start();

 //Si no hay una sesión creada, redireccionar al index. 
 if(empty($_SESSION['idusuario'])) { // Recuerda usar corchetes.
 header('Location: index.php');
 } // Recuerda usar corchetes


mysql_select_db($database_coneccion, $coneccion);
mysql_query("SET NAMES 'utf8'");

$sql = "SELECT publicacion.idpublicacion,publicacion.titulo as tPublicacion,usuario.nombre, libro.titulo, publicacion.contenido, publicacion.hora\n"
    . "FROM usuario, libro, publicacion inner join lectura\n"
    . "WHERE publicacion.idlectura = lectura.idlectura\n"
    . "AND lectura.idusuario = usuario.idusuario\n"
    . "AND lectura.idlibro = libro.idlibro\n"
    . "ORDER BY `publicacion`.`hora` DESC LIMIT 0, 30 ";
	
$publicaciones = mysql_query($sql, $coneccion) or die(mysql_error());
$row_publicacion = mysql_fetch_assoc($publicaciones);
$totalRows_librosUsuario = mysql_num_rows($publicaciones);
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
		<div id="home-header">
		<div class="degree">
			<!-- wrapper -->
			<div class="wrapper">
				<a href="home.php"><img src="img/logo.png" alt="Logo" id="logo" /></a>
		
				
				
				<div class="top-search">
					<form  method="get" id="searchform" action="">
						<div>
							<input type="text" value="Search..." name="s" id="s" onfocus="defaultInput(this)" onblur="clearInput(this)" />
							<input type="submit" id="searchsubmit" value=" " />
						</div>
					</form>
				</div>
				
				
				
				
				<!-- navigation -->
				<div id="nav-holder">
					<ul id="nav" class="sf-menu">
						<li class="current_page_item"><a href="home.php">HOME</a>
							<ul>
								<li><a href="index-3d.html">algun item</a></li>
							</ul>
						</li>
				

						<li  ><a href="libros.php">MIS LIBROS</a>
						<ul>
								<li><a href="administracionLibros.php">Administrar</a></li>								
						</ul>
						</li>
						<li><a href="agregarAutor.php">MIS LECTURAS</a>
						<ul>
								<li><a href="index-3d.html">Actuales</a></li>
								<li><a href="index-3d.html">Hechas</a></li>																
						</ul>
						</li>
						
						<li ><a href="blog.php">BLOG</a></li>
						<li><a href="staff.html">CUENTA <h>:<?php echo $_SESSION['idusuario'];?><></a>
						<ul>
								<li><a href="#">Configuracion</a></li>
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
			
					<!-- headline -->
					<div class="headline">Bienvenid@ <?php echo $_SESSION['nombre'];?></div>
					<!-- ENDS headline -->
					<div class="shadow-divider"></div>
					<div class="front-left-col">
						<div class="bullet-title">
						  <div class="big">
						    <p>Novedades</p>
					      </div>
							<div class="small">Post recientes </div>
						</div>
						<!-- news list -->
						<ul class="news-list">
							
							<?php do{?>
							<li>
								<div class="news-title">
								<a href="#">
								<?php echo $row_publicacion['nombre']; ?> Comenta <?php echo $row_publicacion['titulo']; ?></a></div>
							</li>
				            <li>
								<div class="news-title">
								<a href="#">
								<?php echo $row_publicacion['tPublicacion']; ?></a></div>
							
							</li>
			              <li>
				            <div class="news-brief">
					         <p style="text-align:justify"> <?php echo  $row_publicacion['contenido']; ?>	</p>						    
							  </div>
						    <div class="news-date">
						      <?php echo $row_publicacion['hora']; ?>							    </div>
						  </li>
							<?php } while ($row_publicacion = mysql_fetch_assoc($publicaciones)); ?>
						</ul>
						<!-- ENDS news-list -->
						
						
						<p><a href="#" class="link-button right"><span>MORE POSTS</span></a></p>
					</div>
					<!-- ENDS front-left-col -->
					
					<!-- front-right-col-->
			  <div class="front-right-col">
						<div class="bullet-title">
							<div class="big">Notificaciones</div>
							<div class="small"><?php echo date('Y-m-d') ."\n";?></div>
						</div>
						<ul class="blocks-holder">
						  <li class="block"><a href="about.html" ></a> </li>
							<li class="block"><a href="about.html" ></a> </li>
							<li class="block"><a href="about.html" ></a> </li>
						  <li class="block"><a href="about.html" ></a> </li>
						</ul>
					</div>
					<!-- ENDS front-left-col -->
		  </div>
				<!-- ENDS home-content -->
				<div class="clear"></div>
				
				
				<!-- twitter -->
				<div class="twitter-reader">
					<script>Chirp({user:"ansimuz",max:1})</script></div>
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


		<!-- start cufon -->
		<script type="text/javascript"> Cufon.now(); </script>
		<!-- ENDS start cufon -->
	
	</body>
</html>
