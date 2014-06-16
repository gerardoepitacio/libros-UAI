<?php require_once('Connections/coneccion.php'); ?>
<?php

session_start();
 if(empty($_SESSION['idusuario'])) { 
 header('Location: index.php');
 } 

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
  $updateSQL = sprintf("UPDATE usuario SET nombre=%s, sexo=%s, correo=%s, facebook=%s, telefono=%s, direccion=%s, idunidad=%s, password=%s WHERE idusuario=%s",
                       GetSQLValueString($_POST['nombre'], "text"),
                       GetSQLValueString($_POST['sexo'], "text"),
                       GetSQLValueString($_POST['correo'], "text"),
                       GetSQLValueString($_POST['facebook'], "text"),
                       GetSQLValueString($_POST['telefono'], "text"),
                       GetSQLValueString($_POST['direccion'], "text"),
                       GetSQLValueString($_POST['idunidad'], "int"),
                       GetSQLValueString($_POST['password'], "text"),
                       GetSQLValueString($_POST['idusuario'], "int"));

  mysql_select_db($database_coneccion, $coneccion);
  $Result1 = mysql_query($updateSQL, $coneccion) or die(mysql_error());

  $updateGoTo = "about.php";
  if (isset($_SERVER['QUERY_STRING'])) {
    $updateGoTo .= (strpos($updateGoTo, '?')) ? "&" : "?";
    $updateGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $updateGoTo));
}

$colname_infousuario = "-1";
if (isset($_SESSION['idusuario'])) {
  $colname_infousuario = (get_magic_quotes_gpc()) ? $_SESSION['idusuario'] : addslashes($_SESSION['idusuario']);
}
mysql_select_db($database_coneccion, $coneccion);
$query_infousuario = sprintf("SELECT * FROM usuario WHERE idusuario = %s", $colname_infousuario);
$infousuario = mysql_query($query_infousuario, $coneccion) or die(mysql_error());
$row_infousuario = mysql_fetch_assoc($infousuario);
$totalRows_infousuario = mysql_num_rows($infousuario);

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
if (isset($_SESSION['idusuario'])) {
  $colname_usuario = (get_magic_quotes_gpc()) ? $_SESSION['idusuario'] : addslashes($_SESSION['idusuario']);
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
						
						<li class="current_page_item"><a href="blogs.php">BLOG</a>
						<ul>
								<li><a href="agregarBlog.php">Nuevo</a></li>
								<li><a href="blogs.php">Administrar</a></li>																
						</ul>
						
						
						</li>
						
						<li><a href="about.php?idusuario="<?php echo $_SESSION['idusuario']?>">CUENTA</a></li>
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
					<div class="title-holder">
						<span class="title">Cuenta </span>
						<span class="subtitle">Pell </span>					</div>
					<!-- ENDS title -->
					
					<!-- page-content -->
				  <div class="page-content">

						<!-- staff -->
						<form method="post" name="form1" action="<?php echo $editFormAction; ?>">
				                          <table align="center">
                          <tr valign="baseline">
                            <td nowrap align="right">Idusuario:</td>
                            <td><?php echo $row_infousuario['idusuario']; ?></td>
                          </tr>
                          <tr valign="baseline">
                            <td nowrap align="right">Nombre:</td>
                            <td><input type="text" name="nombre" value="<?php echo $row_infousuario['nombre']; ?>" size="32"></td>
                          </tr>
                          <tr valign="baseline">
                            <td nowrap align="right">Sexo:</td>
                            <td><input type="text" name="sexo" value="<?php echo $row_infousuario['sexo']; ?>" size="32"></td>
                          </tr>
                          <tr valign="baseline">
                            <td nowrap align="right">Correo:</td>
                            <td><input type="text" name="correo" value="<?php echo $row_infousuario['correo']; ?>" size="32"></td>
                          </tr>
                          <tr valign="baseline">
                            <td nowrap align="right">Facebook:</td>
                            <td><input type="text" name="facebook" value="<?php echo $row_infousuario['facebook']; ?>" size="32"></td>
                          </tr>
                          <tr valign="baseline">
                            <td nowrap align="right">Telefono:</td>
                            <td><input type="text" name="telefono" value="<?php echo $row_infousuario['telefono']; ?>" size="32"></td>
                          </tr>
                          <tr valign="baseline">
                            <td nowrap align="right">Direccion:</td>
                            <td><input type="text" name="direccion" value="<?php echo $row_infousuario['direccion']; ?>" size="32"></td>
                          </tr>
                          <tr valign="baseline">
                            <td nowrap align="right">Idunidad:</td>
                            <td><input type="text" name="idunidad" value="<?php echo $row_infousuario['idunidad']; ?>" size="32"></td>
                          </tr>
                          <tr valign="baseline">
                            <td nowrap align="right">Password:</td>
                            <td><input type="text" name="password" value="<?php echo $row_infousuario['password']; ?>" size="32"></td>
                          </tr>
                          <tr valign="baseline">
                            <td nowrap align="right">&nbsp;</td>
                            <td><input type="submit" value="Actualizar registro"></td>
                          </tr>
                        </table>
                        <input type="hidden" name="MM_update" value="form1">
                        <input type="hidden" name="idusuario" value="<?php echo $row_infousuario['idusuario']; ?>">
                      </form>
                      <p>&nbsp;</p>
                      <p>&nbsp;</p>
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
mysql_free_result($infousuario);
?>