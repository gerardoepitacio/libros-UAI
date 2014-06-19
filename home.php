<?php require_once('Connections/coneccion.php'); ?>
<?php

 session_start();
 if(empty($_SESSION['idusuario'])) { // Recuerda usar corchetes.
 header('Location: index.php');
 } 


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


  		<!-- AJAX-->
<script language="JavaScript" type="text/javascript"> 
	var peticionAjax2 = null;
	peticionAjax2 = new XMLHttpRequest();

function evento(){
	var valor = document.getElementById('s').value;
	if(valor.length != 0){
if(peticionAjax2) {

var palabras="";
var	textoAreaDividido = valor.split(" ");
for (var ele in textoAreaDividido) {
	palabras = palabras + textoAreaDividido[ele]+" "; 
}
		
peticionAjax2.open('GET',"busqueda.php?valor="+palabras, true);
//peticionAjax.open('GET', "agregarComentario.php?idpublicacion=, true);
 peticionAjax2.onreadystatechange = estadoPeticion;
 document.getElementById('resultados').value="";
 peticionAjax2.send(null); //No le enviamos datos a la página

 }//if peticion ajax true
 else
 	alert("No se pudo obtener un objeto ajax");


	}//if variable length
	else{
window.location="./home.php"
document.getElementById('s').focus();
	}
}


function estadoPeticion() {
 switch(peticionAjax2.readyState) { //Según el estado de la petición devolvemos un Texto.
  case 0:  //alert('sin iniciar');
 break; 
// case 1:  alert('cargando');
 break; 
 case 2:  
 //alert('cargando');
 break; 
 //case 3:  alert('interactivo');
 break; 
 case 4: 
 //Si ya hemos completado la petición, devolvemos además la información. 
 document.getElementById('resultados').innerHTML=peticionAjax2.responseText; 
 break; 
 } 

 }//function 


function clearText(){
	document.getElementById('s').value = "";
}

function defaultText(){

document.getElementById('s').value = "Search...";	
}


</script> 

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
						<div >
						<div id = "preResultados">
							<datalist id="lista">
							</datalist>
							
						</div>
							<input type="text" value="Search..." name="s" id="s" onfocus="clearText()" list = "lista"  onKeyUp="evento()"/>
							<input type="submit" id="searchsubmit" value=" " />
						</div>
					</form>
				</div>
				
				
				
				
				<!-- navigation -->
				<div id="nav-holder">
					<ul id="nav" class="sf-menu">
						<li class="current_page_item"><a href="home.php">HOME</a>
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
			
					<!-- headline -->
					<div class="headline">Bienvenid@ <?php echo $_SESSION['nombre'];?></div>
					<!-- ENDS headline -->
					<div class="shadow-divider"></div>

					
					<!-- LEFT COL -->
					<div class="front-left-col">
						<!-- INICIO RESULTADOS-->
					<div id = "resultados">
						<div class="bullet-title">
						  <div class="big">

						    <p>Novedades</p>
					      </div>
							<div class="small">
							  <p>Post recientes </p>
						    </div>
						</div>
						<br /><br />

						<!-- news list -->
						<ul class="news-list">
							
							<?php do{?>
							<li>
							
							<div class="news-title">
								<a href="singleBlog.php?idpublicacion=<?php echo $row_publicacion['idpublicacion'];?>" >
								<h5><?php echo $row_publicacion['tPublicacion']; ?> </h5>
								</a></div>

								<a href="singleBlog.php?idpublicacion=<?php echo $row_publicacion['idpublicacion'];?>" > 
								<div class="news-title">
							<?php echo $row_publicacion['nombre']; ?>  /  <?php echo $row_publicacion['titulo']; ?> 

								</div>
								</a>							
							</li>
				          
			              <li>
						  
				            <div class="news-brief">
					         <p style="text-align:justify"> <?php echo  nl2br(substr($row_publicacion['contenido'],0,100))."<h1>. . .<h1>"; ?></p>						    
						    </div>
							  
						    <div class="news-date">
						      <?php 
							  $sqlComents = "select count(*) as total from comentarios where idpublicacion = ".$row_publicacion['idpublicacion']."\n";
								$comentarios = mysql_query($sqlComents, $coneccion) or die(mysql_error());
								$resultado = '-1';
						
								if($numComents = mysql_fetch_assoc($comentarios)){
								$resultado = $numComents['total'] ;
								}
							  echo $row_publicacion['hora']; 
								echo "<p style= align=\"left\">" .  $resultado ." Comentarios </p>"; 							  
									  
							  ?>
							 
						    </div>
						  </li>
							<?php 
							} while ($row_publicacion = mysql_fetch_assoc($publicaciones)); 
							?>
						</ul>
						<!-- ENDS news-list -->
						
						
						<p><a href="#" class="link-button right"><span>MORE POSTS</span></a></p>
					</div>
					<!-- ENDS front-left-col -->


				</div>
				<!-- END RESULTADOS-->

					
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
		<!-- ENDS FOOTER -->
        <!-- start cufon -->
<script type="text/javascript"> Cufon.now(); </script>
		<!-- ENDS start cufon -->
	
	</body>
</html>
