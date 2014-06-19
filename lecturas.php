<?php require_once('Connections/coneccion.php'); ?>
<?php
 
session_start();
 if(empty($_SESSION['idusuario'])) { 
 header('Location: index.php');
 }

$maxRows_leidos = 10;
$pageNum_leidos = 0;
if (isset($_GET['pageNum_leidos'])) {
  $pageNum_leidos = $_GET['pageNum_leidos'];
}
$startRow_leidos = $pageNum_leidos * $maxRows_leidos;

mysql_select_db($database_coneccion, $coneccion);
//$query_leidos = "SELECT * FROM lectura";

$query_leidos = "SELECT libro.titulo as titulo,  autor.nombre as autor, usuario.nombre as propietario, lectura.inicio, lectura.fin
FROM lectura,libro,usuario,autor
WHERE lectura.idusuario = ".$_SESSION['idusuario']."
and lectura.idlibro = libro.idlibro
and libro.idautor = autor.idautor
and libro.idpropietario = usuario.idusuario
and fin IS NOT NULL
";


$query_limit_leidos = sprintf("%s LIMIT %d, %d", $query_leidos, $startRow_leidos, $maxRows_leidos);
$leidos = mysql_query($query_limit_leidos, $coneccion) or die(mysql_error());
$row_leidos = mysql_fetch_assoc($leidos);

if (isset($_GET['totalRows_leidos'])) {
  $totalRows_leidos = $_GET['totalRows_leidos'];
} else {
  $all_leidos = mysql_query($query_leidos);
  $totalRows_leidos = mysql_num_rows($all_leidos);
}
$totalPages_leidos = ceil($totalRows_leidos/$maxRows_leidos)-1;

$maxRows_lecturas = 10;
$pageNum_lecturas = 0;
if (isset($_GET['pageNum_lecturas'])) {
  $pageNum_lecturas = $_GET['pageNum_lecturas'];
}
$startRow_lecturas = $pageNum_lecturas * $maxRows_lecturas;

mysql_select_db($database_coneccion, $coneccion);
$query_lecturas = "SELECT libro.titulo as titulo,  autor.nombre as autor, usuario.nombre as propietario, lectura.inicio, lectura.fin
FROM lectura,libro,usuario,autor
WHERE lectura.idusuario = ".$_SESSION['idusuario']."
and lectura.idlibro = libro.idlibro
and libro.idautor = autor.idautor
and libro.idpropietario = usuario.idusuario
and fin IS NULL
";
$query_limit_lecturas = sprintf("%s LIMIT %d, %d", $query_lecturas, $startRow_lecturas, $maxRows_lecturas);
$lecturas = mysql_query($query_limit_lecturas, $coneccion) or die(mysql_error());
$row_lecturas = mysql_fetch_assoc($lecturas);

if (isset($_GET['totalRows_lecturas'])) {
  $totalRows_lecturas = $_GET['totalRows_lecturas'];
} else {
  $all_lecturas = mysql_query($query_lecturas);
  $totalRows_lecturas = mysql_num_rows($all_lecturas);
}
$totalPages_lecturas = ceil($totalRows_lecturas/$maxRows_lecturas)-1;
?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">  
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	
		<title>Libros UAI</title>
			
			
		<!-- CSS -->
		<link rel="stylesheet" href="css/style.css" type="text/css" media="screen" />
		<!--[if IE 6]>
			<link rel="stylesheet" type="text/css" media="screen" href="css/ie-hacks.css" />
			<script type="text/javascript" src="js/DD_belatedPNG.js"></script>
			<script>
	      		/* EXAMPLE */
	      		DD_belatedPNG.fix('*');
	    	</script>
		<![endif]-->
		<!--[if IE 7]>
			<link rel="stylesheet" href="css/ie7-hacks.css" type="text/css" media="screen" />
		<![endif]-->
		<!--[if IE 8]>
			<link rel="stylesheet" href="css/ie8-hacks.css" type="text/css" media="screen" />
		<![endif]-->
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
				<a href="home.html"><img src="img/logo.png" alt="Logo" id="logo" /></a>
		
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
						<li class="current_page_item"><a href="lecturas.php">MIS LECTURAS</a>
						<ul>
								<li><a href="lecturas.php">Actuales</a></li>
								<li><a href="lecturas.php">Hechas</a></li>																
						</ul>
						</li>
						
						<li ><a href="blogs.php">BLOG</a>
						<ul>
								<li><a href="agregarBlog.php">Nuevo</a></li>
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
						<span class="title">Mis lecturas </span>
						<span class="subtitle">Hechas y leyendo </span>					</div>
					<!-- ENDS title -->
					
					<!-- page-content -->
					<div class="page-content">
						
							<!-- accordions -->
							<h5 class="accordion-trigger custom"><a href="#"> HACIENDO </a></h5>
							<div class="accordion-container">
							<div class="block">
                              <table cellspacing="0" cellpadding="0" border="0">
							  <tbody>
                                <tr>
                                  <th>Titulo</th>
                                  <th>Autor</th>
                                  <th>Propietario</th>
								  <th>Inicio</th>
                                  <th>Fin</th>
                                </tr>
                                <?php do { ?>
                                  <tr>
                                    <td><?php echo $row_lecturas['titulo']; ?></td>
                                    <td><?php echo $row_lecturas['autor']; ?></td>
                                    <td><?php echo $row_lecturas['propietario']; ?></td>
                                    <td><?php echo $row_lecturas['inicio']; ?></td>
                                    <td>-----------</td>
                                  </tr>
                                  <?php } while ($row_lecturas = mysql_fetch_assoc($lecturas)); ?>
								</tbody>
                              </table>
							  </div>
								
					  </div>
							<h5 class="accordion-trigger custom"><a href="#">REALIZADAS </a></h5>
							<div class="accordion-container">
							    
								<div class="block">
                                  <table cellspacing="0" cellpadding="0" border="0">
								   <tbody>
                                    <tr>
                                  <th>Titulo</th>
                                  <th>Autor</th>
                                  <th>Propietario</th>
								  <th>Inicio</th>
                                  <th>Fin</th>
                                    </tr>
                                    <?php do { ?>
                                      <tr>
                                    <td><?php echo $row_leidos['titulo']; ?></td>
                                    <td><?php echo $row_leidos['autor']; ?></td>
                                    <td><?php echo $row_leidos['propietario']; ?></td>
                                    <td><?php echo $row_leidos['inicio']; ?></td>
                                    <td><?php echo $row_leidos['fin']; ?></td>
                                      </tr>
                                      <?php } while ($row_leidos = mysql_fetch_assoc($leidos)); ?>
									  </tbody>
                                  </table>
								</div>
							<!-- ENDS accordions -->
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
mysql_free_result($leidos);

mysql_free_result($lecturas);
?>
