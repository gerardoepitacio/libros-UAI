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

if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "form1")) {
  $insertSQL = sprintf("INSERT INTO usuario (nombre, sexo, correo, facebook, telefono, direccion, idunidad, password) VALUES (%s, %s, %s, %s, %s, %s, %s, %s)",
                       GetSQLValueString($_POST['nombre'], "text"),
                       GetSQLValueString($_POST['sexo'], "text"),
                       GetSQLValueString($_POST['correo'], "text"),
                       GetSQLValueString($_POST['facebook'], "text"),
                       GetSQLValueString($_POST['telefono'], "text"),
                       GetSQLValueString($_POST['direccion'], "text"),
                       GetSQLValueString($_POST['idunidad'], "int"),
                       GetSQLValueString($_POST['password'], "text"));

  mysql_select_db($database_coneccion, $coneccion);
  $Result1 = mysql_query($insertSQL, $coneccion) or die(mysql_error());

  $insertGoTo = "index.php";
  if (isset($_SERVER['QUERY_STRING'])) {
    $insertGoTo .= (strpos($insertGoTo, '?')) ? "&" : "?";
    $insertGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $insertGoTo));
  /*action="<?php echo $editFormAction; ?>" */
}
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
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
		
		<script>
	
		</script>
		
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
					<span class="title">Nuevo Lector </span></div>
					<!-- ENDS title -->
					
					<!-- page-content -->
					<div class="page-content">
					
						<!-- 2 cols -->
						<div class="one-half">
							<h4>Completa tus datos correctamente
  
</h4>
<script type="text/javascript" src="js/form-add-user-validation.js"></script>	
<!--<form id="form1" method="post" action="home.php" name="form1" onsubmit="return validaCampos()" >-->
<form id="formAddUser" method="post" action=<?php echo $editFormAction ?>name="form1"  >
	  <p id="error" class="warning"></p>
<fieldset>
  <table width="175%" align="center">
    <tr valign="baseline">
      <td nowrap align="right">Nombre:</td>
      <td><input id="nombre" class="entradaTexto" type="text" name="nombre" value="" size="32"></td>
    </tr>
    <tr valign="baseline">
	<datalist id="sexos">
		<option label="Masculino" value="M">
		<option label="Femenino" value="F">
	</datalist>
	
	
	
      <td nowrap align="right">Sexo:</td>
      <td><input id="sexo" class="entradaTexto" type="text" list = "sexos" name="sexo" value="" size="32"></td>
    </tr>
    <tr valign="baseline">
      <td nowrap align="right">Correo:</td>
      <td><input id="correo" class="entradaTexto" type="email" name="correo" value="" size="32"></td>
    </tr>
    <tr valign="baseline">
      <td nowrap align="right">Facebook:</td>
      <td><input  id="facebook" class="entradaTexto" type="text" name="facebook" value="" size="32"></td>
    </tr>
    <tr valign="baseline">
      <td nowrap align="right">Telefono:</td>
      <td><input  id="telefono" class="entradaTexto" type="tel" name="telefono" value="" size="32"></td>
    </tr>
    <tr valign="baseline">
      <td nowrap align="right">Direccion:</td>
      <td><input id="direccion" class="entradaTexto" type="text" name="direccion" value="" size="32"></td>
    </tr>
    <tr valign="baseline">
      <td nowrap align="right">Idunidad:</td>
	  <?php 
	 	 mysql_select_db($database_coneccion, $coneccion);
	  	$sqlUnidades = "select nombre,idunidad from unidad";
		$unidades = mysql_query($sqlUnidades, $coneccion) or die(mysql_error());

	echo '	<datalist id="unidades">';		
		while($row = mysql_fetch_array($unidades)){
//	echo "<option value='".$resultado[nombre_campo]."'> ". $nombre_campo."</option>";
    echo '<option value="'.$row['idunidad'].'" label="'.$row['nombre'].'">';	
	}//while
	echo '</datalist>';
	  ?>

      <td><input id="idunidad" class="entradaTexto" type="text" list = "unidades" name="idunidad"  value="" size="32"></td>
    </tr>
    <tr valign="baseline">
      <td nowrap align="right">Password:</td>
      <td><input id="password" class="entradaTexto" type="password" name="password" value="" size="32"></td>
    </tr>
	<tr valign="baseline">
      <td nowrap align="right">Repite Password:</td>
      <td><input id="password2" class="entradaTexto" type="password" name="password2" value="" size="32"></td>
    </tr>
    <tr valign="baseline">
      <td nowrap align="right">&nbsp;</td>
      <td><input type="submit" value="Insertar registro" name="submit" id="submit"></td>
    </tr>
  </table>
 
  <input type="hidden" name="MM_insert" value="form1">
  
   
  </fieldset>
  
</form>

					</div>
					<!-- ENDS page-content -->
				</div>
				<!-- ENDS content -->				
	</div>
			<!-- ENDS main-wrapper -->
			
		
		</div>		
		<!-- ENDS MAIN -->	
		
		<!-- FOOTER -->
		<!-- ENDS FOOTER -->
        <!-- BOTTOM -->
        <!-- ENDS BOTTOM -->
        <!-- start cufon -->
<script type="text/javascript"> Cufon.now(); </script>
		<!-- ENDS start cufon -->
	
	</body>
</html>
