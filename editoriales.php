<?php require_once('Connections/coneccion.php'); ?>
<?php
mysql_select_db($database_coneccion, $coneccion);
$query_Recordset1 = "SELECT * FROM editorial ORDER BY ideditorial ASC";
$Recordset1 = mysql_query($query_Recordset1, $coneccion) or die(mysql_error());
$row_Recordset1 = mysql_fetch_assoc($Recordset1);
$totalRows_Recordset1 = mysql_num_rows($Recordset1);
?>


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">  
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	
		<title>SIMPLE</title>
			
			
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
						<li><a href="home.php">HOME</a>
							<ul>
								<li><a href="index-3d.html">algun item</a></li>
							</ul>
						</li>
				

						<li  class="current_page_item"><a href="libros.php">MIS LIBROS</a>
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
						
						<li ><a href="blogs.php">BLOG</a></li>
						<li><a href="staff.html">CUENTA</a>
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
							<h4>Editoriales</h4>
							<table cellspacing="0" cellpadding="0" border="0">
							<tbody>
  <tr>
    <th>ideditorial</th>
    <th>nombre</th>
    <th>ubicacion</th>
    <th>telefono</th>
    <th>web</th>
  </tr>
  <?php do { ?>
    <tr>
      <td><?php echo $row_Recordset1['ideditorial']; ?></td>
      <td><?php echo $row_Recordset1['nombre']; ?></td>
      <td><?php echo $row_Recordset1['ubicacion']; ?></td>
      <td><?php echo $row_Recordset1['telefono']; ?></td>
      <td><?php echo $row_Recordset1['web']; ?></td>
    </tr>

    <?php } while ($row_Recordset1 = mysql_fetch_assoc($Recordset1)); ?>
</tbody>
</table>
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
mysql_free_result($Recordset1);
?>