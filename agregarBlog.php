<?php require_once('Connections/coneccion.php'); ?>
<?php

session_start();

 //Si no hay una sesión creada, redireccionar al index. 
 if(empty($_SESSION['idusuario'])) { // Recuerda usar corchetes.
 header('Location: index.php');
 } // Recuerda usar corchetes
 
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


if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "form1")) {
  $insertSQL = sprintf("INSERT INTO publicacion (idlectura, titulo, contenido) VALUES (%s, %s, %s)",
                       GetSQLValueString($_POST['idlectura'], "int"),
                       GetSQLValueString($_POST['titulo'], "text"),
                       GetSQLValueString($_POST['contenido'], "text"));

  mysql_select_db($database_coneccion, $coneccion);
  $Result1 = mysql_query($insertSQL, $coneccion) or die(mysql_error());

  $insertGoTo = "blogs.php";
  if (isset($_SERVER['QUERY_STRING'])) {
    $insertGoTo .= (strpos($insertGoTo, '?')) ? "&" : "?";
    $insertGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $insertGoTo));
}


?>


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
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
						</li><li class="current_page_item"><a href="blogs.php">BLOG</a>
						<ul>
								<li><a href="lecturas.php">Nuevo</a></li>
								<li><a href="blogs.php">Administrar</a></li>																
						</ul></li>
						
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
		
		
		<div id="main">
			<!-- wrapper -->
			<div class="wrapper">
			
			

<form method="post" name="form1" action="<?php echo $editFormAction; ?>">
  <table width="788" height="200" align="center">
   <tr valign="baseline">
      <td>Libro: <?php echo $_GET['titulo']?></td>
    </tr>
	<tr valign="baseline">
    <td>Autor: <?php echo $_GET['autor']?></td>
    </tr>
	<tr valign="baseline">
      <td><input type="text" name="titulo" value="" size="100" placeholder="Titulo del blog"></td>
    </tr>
    <tr valign="baseline">
      <td><textarea name="contenido" cols="80" rows="40"></textarea></td>
    </tr>
    <tr valign="baseline">
      <td height="28" align="center" nowrap><input name="submit" type="submit" value="PUBLICAR" /></td>
    </tr>
  </table>
  <input type="hidden" name="idlectura" value="<?php echo $_GET['idlectura']?>" size="100">
  <input type="hidden" name="MM_insert" value="form1">
  
</form>
<p>&nbsp;</p>

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



</body>
</html>
