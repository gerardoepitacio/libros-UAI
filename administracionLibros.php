<?php require_once('Connections/coneccion.php'); 

session_start();

 //Si no hay una sesión creada, redireccionar al index. 
 if(empty($_SESSION['idusuario'])) { // Recuerda usar corchetes.
 header('Location: index.php');
 } // Recuerda usar corchetes
 
 

?>
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

mysql_select_db($database_coneccion, $coneccion);


 $query_librosUsuario = sprintf("SELECT idlibro, estado,autor.nombre as autor, editorial.nombre as editorial, publicacion, disponible, titulo FROM libro,autor,editorial
   where libro.idpropietario = '%s'
   and   libro.idautor = autor.idautor
   and   libro.ideditorial = editorial.ideditorial
   ",$_SESSION['idusuario']
   );
 

$librosUsuario = mysql_query($query_librosUsuario, $coneccion) or die(mysql_error());
$row_librosUsuario = mysql_fetch_assoc($librosUsuario);
$totalRows_librosUsuario = mysql_num_rows($librosUsuario);

?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Documento sin t&iacute;tulo</title>

	
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
						<li><a href="lecturas.php">MIS LECTURAS</a>
						</li>
						
						<li ><a href="blogs.php">BLOG</a>
						<ul>
								<li><a href="agregarBlog.php">Nuevo</a></li>
								<li><a href="blogs.php">Administrar</a></li>																
						</ul>
						</li>
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
					<div class="title-holder">
					<span class="title">Administracion Libros </span>
					</div>
					
					
					<!-- ENDS title -->
					
					<!-- page-content -->
					<div class="page-content">
					<p><a href="agregarLibro.php" class="link-button"><span>Agregar un Nuevo Libro</span></a></p>
						<!-- 2 cols -->
						<div class="one-half">
		

<table width="150%" border="0" cellpadding="0" cellspacing="0">
<tbody>
  <tr>
    <th>idlibro</td>
    <th>estado</td>
    <th>idautor</td>
    <th>titulo</td>
    <th>publicacion</td>
    <th>editorial</td>
    <th>disponible</td>
    <th>Acciones    
  </tr>
  <?php do { ?>
    <tr>
      <td><?php echo $row_librosUsuario['idlibro']; ?></td>
      <td><?php echo $row_librosUsuario['estado']; ?></td>
      <td><?php echo $row_librosUsuario['autor']; ?></td>
      <td><?php echo $row_librosUsuario['titulo']; ?></td>
      <td><?php echo $row_librosUsuario['publicacion']; ?></td>
      <td><?php echo $row_librosUsuario['editorial']; ?></td>
      <td>
	  <?php 
	  if($row_librosUsuario['disponible'] == 1)
	  echo 'disponible';
	  else
	  echo '<a href="detallePrestamo.php?idlibro='.$row_librosUsuario['idlibro'].'">prestado</a>'
	  ?>
	  
	  </td>
      <td><a href="editarLibro.php?idlibro=<?php echo $row_librosUsuario['idlibro'];?>">Editar </a><a href="eliminarRegistro.php?idlibro=<?php echo $row_librosUsuario['idlibro']; ?>">Eliminar</a> </td>
    </tr>
    <?php } while ($row_librosUsuario = mysql_fetch_assoc($librosUsuario)); ?>
	</tbody>
</table>



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
?>