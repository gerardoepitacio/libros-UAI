<?php require_once('Connections/coneccion.php'); ?>
<?php
function GetSQLValueString($theValue, $theType, $theDefinedValue = "", $theNotDefinedValue = "") 
{
  $theValue = (!get_magic_quotes_gpc()) ? addslashes($theValue) : $theValue;

  switch ($theType) {
    case "text":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;    
    case "long":
    case "int":
      $theValue = ($theValue != "") ? intval($theValue) : "NULL";
      break;
    case "double":
      $theValue = ($theValue != "") ? "'" . doubleval($theValue) . "'" : "NULL";
      break;
    case "date":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;
    case "defined":
      $theValue = ($theValue != "") ? $theDefinedValue : $theNotDefinedValue;
      break;
  }
  return $theValue;
}

$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}

if ((isset($_POST["MM_update"])) && ($_POST["MM_update"] == "form1")) {
  $updateSQL = sprintf("UPDATE publicacion SET titulo=%s, contenido=%s WHERE idpublicacion=%s",
                       GetSQLValueString($_POST['titulo'], "text"),
                       GetSQLValueString($_POST['contenido'], "text"),
                       GetSQLValueString($_POST['idpublicacion'], "int"));

  mysql_select_db($database_coneccion, $coneccion);
  $Result1 = mysql_query($updateSQL, $coneccion) or die(mysql_error());

  $updateGoTo = "singleBlog.php";
  if (isset($_SERVER['QUERY_STRING'])) {
    $updateGoTo .= (strpos($updateGoTo, '?')) ? "&" : "?";
    $updateGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $updateGoTo));
}

$colname_datosBlog = "-1";
if (isset($_GET['idpublicacion'])) {
  $colname_datosBlog = (get_magic_quotes_gpc()) ? $_GET['idpublicacion'] : addslashes($_GET['idpublicacion']);
}
mysql_select_db($database_coneccion, $coneccion);
$query_datosBlog = sprintf("SELECT * FROM publicacion WHERE idpublicacion = %s", $colname_datosBlog);
$datosBlog = mysql_query($query_datosBlog, $coneccion) or die(mysql_error());
$row_datosBlog = mysql_fetch_assoc($datosBlog);
$totalRows_datosBlog = mysql_num_rows($datosBlog);
?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
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
						<li><a href="agregarAutor.php">MIS LECTURAS</a>
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
			
						
<form method="post" name="form1" action="<?php echo $editFormAction; ?>">
  <table align="center">
    <tr valign="baseline">
      <td nowrap align="right">Titulo:</td>
      <td><input type="text" name="titulo" value="<?php echo $row_datosBlog['titulo']; ?>" size="100"></td>
    </tr>
    <tr valign="baseline">
      <td nowrap align="right" valign="top">Contenido:</td>
      <td><textarea name="contenido" cols="80" rows="30"><?php echo $row_datosBlog['contenido']; ?></textarea>
      </td>
    </tr>
    <tr valign="baseline">
      <td nowrap align="right">&nbsp;</td>
      <td><input type="submit" value="Actualizar registro"></td>
    </tr>
  </table>
  <input type="hidden" name="idpublicacion" value="<?php echo $row_datosBlog['idpublicacion']; ?>">
  <input type="hidden" name="MM_update" value="form1">
  <input type="hidden" name="idpublicacion" value="<?php echo $row_datosBlog['idpublicacion']; ?>">
</form>
		
				
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
</div>
		<!-- ENDS BOTTOM -->


</body>
</html>
<?php
mysql_free_result($datosBlog);
?>
