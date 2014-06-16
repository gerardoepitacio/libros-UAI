<?php require_once('Connections/coneccion.php'); ?>
<?php
$charset = mysql_client_encoding($coneccion);

echo "The current character set is: $charset\n";

session_start();

 //Si no hay una sesión creada, redireccionar al index. 
 if(empty($_SESSION['idusuario'])) { // Recuerda usar corchetes.
 header('Location: index.php');
 } // Recuerda usar corchetes




mysql_select_db($database_coneccion, $coneccion);
mysql_query("SET NAMES 'utf8'");

	$sql = "select \n"
    . "publicacion.idpublicacion, \n"
    . "usuario.nombre, \n"
    . "libro.titulo, \n"
    . "publicacion.titulo as tPublicacion, \n"
    . "publicacion.contenido, \n"
    . "publicacion.hora\n"
    . "from usuario,publicacion,libro inner join lectura\n"
    . "where\n"
    . "usuario.idusuario = ".$_SESSION['idusuario']."\n"
    . "and publicacion.idlectura = lectura.idlectura\n"
    . "and lectura.idusuario = usuario.idusuario\n" 
    . "and lectura.idlibro = libro.idlibro\n"
    . "ORDER BY `publicacion`.`hora` DESC LIMIT 0, 30 ";
	
	
$publicaciones = mysql_query($sql, $coneccion) or die(mysql_error());

$totalRows_librosUsuario = mysql_num_rows($publicaciones);

?>



<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">  
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		
		<title>LIBROS UAI</title>
			
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
				<a href="index.html"><img src="img/logo.png" alt="Logo" id="logo" /></a>
		
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
							<ul>
								<li><a href="index-3d.html">algun item</a></li>
							</ul>
						</li>
				

						<li  ><a href="libros.php">MIS LIBROS</a>
						<ul>
								<li><a href="administracionLibros.php">Administrar</a></li>								
						</ul>
						</li>
						<li><a href="lecturas.php">MIS LECTURAS</a>
						<ul>
								<li><a href="index-3d.html">Actuales</a></li>
								<li><a href="index-3d.html">Hechas</a></li>																
						</ul>
						</li>
						
						<li class="current_page_item"><a href="blogs.php">BLOG</a>
						<ul>
								<li><a href="agregarBlog.php">Nuevo</a></li>
								<li><a href="blogs.php">Administrar</a></li>																
						</ul>
						
						
						</li>
						
						<li><a href="staff.html">CUENTA</a></li>
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
				<!-- content -->
				<div class="content-blog">
						<!-- POSTS -->
						<div id="posts">
						
						

						<?php 
								if($row_publicacion = mysql_fetch_assoc($publicaciones))
									{
									
						do{						
						
						
					$sqlComents = "select count(*) as total from comentarios where idpublicacion = ".$row_publicacion['idpublicacion']."\n"
    				. "";
						$comentarios = mysql_query($sqlComents, $coneccion) or die(mysql_error());
						$resultado = -1;
						if($numComents = mysql_fetch_assoc($comentarios)){
							$resultado = $numComents['total'] ;
						}else{
						$resultado = "Sin comentarios...";
						}
						
						
						?>
							<!-- post -->
							<div class="post">
								<!-- post-header -->
								<div class="post-header">
									<div class="post-title">
									<a href="singleBlog.php?idpublicacion=<?php echo $row_publicacion['idpublicacion'];?>" > 
									
									<?php 
									
									if( strlen($row_publicacion['tPublicacion']) > 45 )
										$row_publicacion['tPublicacion'] = 	substr($row_publicacion['tPublicacion'],0,40).". . . ";
													
									echo $row_publicacion['tPublicacion']; 
									
									?>	 </a>
									
									</div>
									<div class="post-meta">
										POSTED BY <a href="#"> <?php echo $_SESSION['nombre'];?> <?php echo $row_publicacion['hora']; ?> 
										</a></div>
										<div class="n-comments"><?php echo $resultado ?></div>
								</div>
								<!-- ENDS post-header -->
								<!-- post-img -->
							  <div class="post-img"><a href="singleBlog.php" title=""></a>						 		</div>
						 		<!-- ENDS post-img -->
							 		<div class="excerpt">
									 <?php echo nl2br(substr($row_publicacion['contenido'],0,200)).". . ."; ?> 
							  </div>
									<p>
									
									<a href="eliminarRegistro.php?idpublicacion=<?php echo $row_publicacion['idpublicacion'];?>" 
									class="link-button right" style="color:#FF4F4F" ><span> Eliminar </span></a>

									<a href="editarBlog.php?idpublicacion=<?php echo $row_publicacion['idpublicacion'];?>" 
									class="link-button right"><span> Editar </span></a>
									
									<a href="singleBlog.php?idpublicacion=<?php echo $row_publicacion['idpublicacion'];?>" 
									class="link-button right">
									<span>Ver </span>									</a></p>
							</div>
							<!-- ENDS post -->

<?php } while ($row_publicacion = mysql_fetch_assoc($publicaciones));

}//if
else{

						echo "	<div class=\"post\">
								<!-- post-header -->
								<div class=\"post-header\">
									<div class=\"post-title\"><a href=\"single.html\" > Actualmente no tienes entradas</a></div>
									</div><!--header -->
									</div><!--post-->
						";
}

?>

						
							<!-- blog-pager -->
							<p class="clear"></p>
							<!-- ENDS blog-pager -->
                        </div>
						<!-- ENDS POSTS -->

						<!-- sidebar -->
						<ul id="sidebar">
							<!-- init sidebar -->
							<li>
								<h2 class="custom"><span>CATEGORIES</span></h2>		
								<ul>
									<li class="cat-item"><a href="agregarBlog.php" title="Escribe un nuevo blog!">Nuevo</a></li>
								</ul>
							</li>	
							<!-- ENDS init sidebar -->
							
							<!-- recent posts -->
							<!-- ENDS recent posts -->
						</ul>
						<!-- ENDS sidebar -->
														
						
						
				</div>
				<!-- ENDS content-blog -->
				
				
				
	</div>
			<!-- ENDS main-wrapper -->
			
		
		</div>		
		<!-- ENDS MAIN -->	
		
		<!-- FOOTER -->
		<div id="footer">
		<div class="degree">
			<!-- wrapper -->
			<div class="wrapper">
				<!-- social bar -->
				<!-- ENDS social bar -->
                <!-- footer-cols -->
                <!-- ENDS footer-cols -->
</div>
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
