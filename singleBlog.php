<?php require_once('Connections/coneccion.php'); ?>
<?php
 

//Empezamos la sesión 
 session_start();

 //Si no hay una sesión creada, redireccionar al index. 
 if(empty($_SESSION['idusuario'])) { // Recuerda usar corchetes.
 header('Location: index.php');
 } // Recuerda usar corchetes

$editFormAction = $_SERVER['PHP_SELF'];


$colname_contenidoblog = "-1";
$contenidoblog = " ";
$row_contenidoblog = " ";
$totalRows = " ";
//if (isset($_GET['idpublicacion'])) {
if ((isset($_GET['idpublicacion'])) && ($_GET['idpublicacion'] != "")) {

$colname_contenidoblog = (get_magic_quotes_gpc()) ? $_GET['idpublicacion'] : addslashes($_GET['idpublicacion']);
mysql_select_db($database_coneccion, $coneccion);
mysql_query("SET NAMES 'utf8'");
$query_contenidoblog = sprintf("SELECT * FROM publicacion WHERE idpublicacion = %s", $colname_contenidoblog);

$sql = "select \n"
    . "usuario.nombre, \n"
    . "libro.titulo, \n"
    . "publicacion.titulo as tPublicacion,\n"
    . "publicacion.contenido, \n"
    . "publicacion.hora\n"
    . "from usuario,publicacion,libro inner join lectura\n"
    . "where\n"
    . "publicacion.idpublicacion = ".$colname_contenidoblog."\n"
    . "and lectura.idlectura = publicacion.idlectura \n"
    . "and lectura.idusuario = usuario.idusuario\n"
    . "and lectura.idlibro = libro.idlibro";


$contenidoblog = mysql_query($sql, $coneccion) or die(mysql_error());
$row_contenidoblog = mysql_fetch_assoc($contenidoblog);
$totalRows = mysql_num_rows($contenidoblog);
}
/*
if ((isset($_POST['commentID']))  && ($_POST['commentID'] != "")){
echo 'este es un nuevo comentario';
//inset(_POST['commentID']);

}
*/

?>



<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">  
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	
		<title>SIMPLE</title>
			
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


<!-- AJAX-->
<script language="JavaScript" src="	js/ConstructorXMLHttpRequest.js"></script> 
<script language="JavaScript" type="text/javascript"> 
var peticionAjax = null;
peticionAjax = new XMLHttpRequest();

//Se llama cuando cambia peticion01.readyState. 
function estadoPeticion() { 

 switch(peticionAjax.readyState) { //Según el estado de la petición devolvemos un Texto.
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
//alert('finalizando');
 //Si ya hemos completado la petición, devolvemos además la información. 
 document.getElementById('listaComentarios').innerHTML= 
peticionAjax.responseText; 
 break; 
 } 
 }

 function enviarComentario() {

 var iduser = document.getElementById('idusuario').value;
 var idpublicacion = document.getElementById('idpublicacion').value;
 var contenido = document.getElementById('contenido').value;
// alert(iduser + "\n" +idpublicacion + "\n" +contenido); 
 if(contenido.length != 0 ){
 if(peticionAjax) {

 	peticionAjax.open('GET', "agregarComentario.php?idpublicacion="+idpublicacion+"&idusuario="+iduser+"&contenido="+contenido, true);
/*Asignamos la función que se llama cada vez que cambia 
el estado de peticion01.readyState Y LO HACEMOS ANTES THE HACER EL 
SEND porque inicia la transmisión.*/ 
// alert('procesando');

document.getElementById('contenido').value = "";
 peticionAjax.onreadystatechange = estadoPeticion; 
 peticionAjax.send(null); //No le enviamos datos a la página
 }
 
 }
  
 } 
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
						<li><a href="about.php?idusuario=<?php echo $_SESSION['idusuario'];?>">CUENTA <h></a>
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
				<div class="content-blog">

						<!-- POSTS -->
						<div id="posts">
							<!-- post -->
							<div class="single-post">
								<!-- post-header -->
								<div class="post-header single">
									<div class="post-title"><a href="singleBlog.php" ><?php echo
									 $row_contenidoblog['tPublicacion'];?> </a></div>
									<div class="post-meta">
										<?php 
										if($totalRows!=0)
										echo $row_contenidoblog['titulo']; ?> 
										POSTED BY <a href="#"> <?php 
										if($totalRows!=0)
										echo $row_contenidoblog['nombre']; ?>
										 </a> en <a href="#"> <?php 
										 if($totalRows!=0)
										 echo $row_contenidoblog['hora']; ?> </a>
									</div>
								</div>
								<!-- ENDS post-header -->
								
								<!-- post-content -->								
						 		<div id="contenido-post" style="text-align:justify; width: auto;">
						 		 <?php 
								 if($totalRows!=0)
								 echo nl2br($row_contenidoblog['contenido']); ?>
							  </div>
								<!-- ENDS post-content -->
								
								<div id = listaComentarios>
								<!-- comments list -->
									<?php
						$sqlComents = "select count(*) as total from comentarios where idpublicacion = ".$colname_contenidoblog;
						$comentarios = mysql_query($sqlComents, $coneccion) or die(mysql_error());
						$resultado = '-1';
						
						if($numComents = mysql_fetch_assoc($comentarios)){
							$resultado = $numComents['total'] ;
						}	  
									?>
									
								
								<div class="comments-header"><span class="n-comments"><?php echo $resultado;?></span><span class="text">COMENTARIOS</span></div>
								<ol class="comments-list">
													
								<?php 
								
								if($resultado != 0){
								
							$sqlcomentarios = "select comentarios.idcomentario,usuario.nombre,comentarios.contenido,\n"
    . "comentarios.horacomentario \n"
    . "from usuario,comentarios\n"
    . "where \n"
    . "comentarios.idpublicacion = ".$colname_contenidoblog	."\n"
    . "and comentarios.idusuario = usuario.idusuario\n"
    . "ORDER BY `comentarios`.`horacomentario` ASC ";
								   
						$result = mysql_query($sqlcomentarios, $coneccion) or die(mysql_error());
					while($comentariosPublicacion = mysql_fetch_assoc($result)){
							
								?>			
													
									 <li>
										<div class="comment-wrap">
											<img src='img/dummies/avatar.jpg' alt='avatar' width="51" height="51" class='avatar' />
											<div class="comments-right">
												<div class="meta-date"><?php echo $comentariosPublicacion['horacomentario']?></div>
												<div><a href='#' class='url'><strong>
												<?php
												$shortName = explode(" ",$comentariosPublicacion['nombre']); 
												echo $shortName[0].' '.$shortName[1];
												?></strong></a></div>
												<div class="brief">
											  <p><?php echo $comentariosPublicacion['contenido']?></p></div>
										  </div>
									   </div>
								  </li>
											
									<?php
									}//while...
									}//hay comentarios...... resultado =! 0
									else{
									
										echo "------------------------------------------------------------------------------";
									}
									
									?>
									
											
								</ol>
								<!-- ENDS comments list -->
</div> <!-- lista de comentarios.....>
								
								<!-- comments form -->
								<div class="leave-comment">
								<p>
								  <h3>Comentar</h3>	
								<!--	<form  id="commentform"> -->
										<fieldset>
										<p>
											  <textarea name="contenido" cols="80%" rows="10" wrap="physical" id="contenido" tabindex="4"></textarea>
										</p>
											<p><input type="submit" name="submit" id="submit" tabindex="5" value="SEND" onclick="enviarComentario();"/></p>
											<p><input type="hidden" name="commentID" value="true" /></p>
											
											<p><input type="hidden" name="idpublicacion" id="idpublicacion" value=<?php echo $_GET['idpublicacion']?> /></p>
											<p><input type="hidden" name="idusuario" id="idusuario" value= <?php echo $_SESSION['idusuario']?>/></p>
										</fieldset>
<!--									</form>   -->
								</div>
								<!-- ENDS comments form -->	



							</div>
							<!-- ENDS post -->


						</div>	
						<!-- ENDS POSTS -->

						<!-- sidebar -->
						<!-- ENDS sidebar -->
                </div>
				<!-- ENDS content-blog -->
				
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
