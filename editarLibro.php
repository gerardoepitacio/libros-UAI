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
  $updateSQL = sprintf("UPDATE libro SET estado=%s, idautor=%s, idpropietario=%s, ideditorial=%s, publicacion=%s, disponible=%s, titulo=%s WHERE idlibro=%s",
                       GetSQLValueString($_POST['estado'], "int"),
                       GetSQLValueString($_POST['idautor'], "int"),
                       GetSQLValueString($_POST['idpropietario'], "int"),
                       GetSQLValueString($_POST['ideditorial'], "int"),
                       GetSQLValueString($_POST['publicacion'], "date"),
                       GetSQLValueString($_POST['disponible'], "int"),
                       GetSQLValueString($_POST['titulo'], "text"),
                       GetSQLValueString($_POST['idlibro'], "int"));

  mysql_select_db($database_coneccion, $coneccion);
  $Result1 = mysql_query($updateSQL, $coneccion) or die(mysql_error());

  $updateGoTo = "administracionLibros.php";
  if (isset($_SERVER['QUERY_STRING'])) {
    $updateGoTo .= (strpos($updateGoTo, '?')) ? "&" : "?";
    $updateGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $updateGoTo));
}

$colname_registroLibros = "-1";
if (isset($_GET['idlibro'])) {
  $colname_registroLibros = (get_magic_quotes_gpc()) ? $_GET['idlibro'] : addslashes($_GET['idlibro']);
}
mysql_select_db($database_coneccion, $coneccion);
$query_registroLibros = sprintf("SELECT * FROM libro WHERE idlibro = %s", $colname_registroLibros);
$registroLibros = mysql_query($query_registroLibros, $coneccion) or die(mysql_error());
$row_registroLibros = mysql_fetch_assoc($registroLibros);
$totalRows_registroLibros = mysql_num_rows($registroLibros);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Libros UAI</title>

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


<!-- CSS -->
		<link rel="stylesheet" href="css/style.css" type="text/css" media="screen" />
		<!-- ENDS CSS -->
		
		<!-- prettyPhoto -->
		<link rel="stylesheet" href="js/prettyPhoto/css/prettyPhoto.css" type="text/css" media="screen" />
		<!-- ENDS prettyPhoto -->
		
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
					<span class="title">Edicion</span></div>
					<!-- ENDS title -->
					
					<!-- page-content -->
					<div class="page-content">
					
						<!-- 2 cols -->
						<div class="one-half">
	

<form method="post" name="form1" action="<?php echo $editFormAction; ?>">
  <table align="center">
    <tr valign="baseline">
      <td nowrap align="right">Idlibro:</td>
      <td><?php echo $row_registroLibros['idlibro']; ?></td>
    </tr>
    <tr valign="baseline">
      <td nowrap align="right">Estado:</td>
      <td><input type="text" name="estado" value="<?php echo $row_registroLibros['estado']; ?>" size="32"></td>
    </tr>
    <tr valign="baseline">
      <td nowrap align="right">Idautor:</td>
      <td><input type="text" name="idautor" value="<?php echo $row_registroLibros['idautor']; ?>" size="32"></td>
    </tr>
    <tr valign="baseline">
      <td nowrap align="right">Idpropietario:</td>
      <td><input type="text" name="idpropietario" value="<?php echo $row_registroLibros['idpropietario']; ?>" size="32"></td>
    </tr>
    <tr valign="baseline">
      <td nowrap align="right">Ideditorial:</td>
      <td><input type="text" name="ideditorial" value="<?php echo $row_registroLibros['ideditorial']; ?>" size="32"></td>
    </tr>
    <tr valign="baseline">
      <td nowrap align="right">Publicacion:</td>
      <td><input type="text" name="publicacion" value="<?php echo $row_registroLibros['publicacion']; ?>" size="32"></td>
    </tr>
    <tr valign="baseline">
      <td nowrap align="right">Disponible:</td>
      <td><input type="text" name="disponible" value="<?php echo $row_registroLibros['disponible']; ?>" size="32"></td>
    </tr>
    <tr valign="baseline">
      <td nowrap align="right">Titulo:</td>
      <td><input type="text" name="titulo" value="<?php echo $row_registroLibros['titulo']; ?>" size="32"></td>
    </tr>
    <tr valign="baseline">
      <td nowrap align="right">&nbsp;</td>
      <td><input type="submit" value="Actualizar registro"></td>
    </tr>
  </table>
  <input type="hidden" name="MM_update" value="form1">
  <input type="hidden" name="idlibro" value="<?php echo $row_registroLibros['idlibro']; ?>">
</form><p>&nbsp;</p>



						</div>
						<div class="clear "></div>
						<!-- ENDS 2 cols -->

					</div>
					<!-- ENDS page-content -->

						
				</div>
				<!-- ENDS content -->
				
				<!-- twitter -->
				<div class="twitter-reader">
					<script>Chirp({user:"ansimuz",max:1})</script></div>
		  </div>
				<!-- ENDS twitter -->
				
	</div>
			<!-- ENDS main-wrapper -->
			
		
		</div>		
		<!-- ENDS MAIN -->



		<!-- start cufon -->
		<script type="text/javascript"> Cufon.now(); </script>
		<!-- ENDS start cufon -->

</body>
</html>
<?php
mysql_free_result($librosUsuario);

mysql_free_result($registroLibros);
?>
