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
//INSERTAMOS REGISTRO
$insertSQL = sprintf("INSERT INTO comentarios (idpublicacion, idusuario, contenido) VALUES (%s, %s, %s)",
                       GetSQLValueString($_GET['idpublicacion'], "int"),
                       GetSQLValueString($_GET['idusuario'], "int"),
                       GetSQLValueString($_GET['contenido'], "text"));

  mysql_select_db($database_coneccion, $coneccion);
  $Result1 = mysql_query($insertSQL, $coneccion) or die(mysql_error());
  
  //****************************coneccion a base de datos resuesta....

//NUM COMENTARIOS
	$sqlComents = "select count(*) as total from comentarios where idpublicacion = ".$_GET['idpublicacion'];
	
	$comentarios = mysql_query($sqlComents, $coneccion) or die(mysql_error());
	$resultado = '-1';
	
	if($numComents = mysql_fetch_assoc($comentarios)){
		$resultado = $numComents['total'] ;
		}	  
									

									
  $cadenaNumComentarios = '<div class="comments-header"><span class="n-comments">'.$resultado.'</span><span class="text">COMENTARIOS</span></div>
	<ol class="comments-list">';
	
  
  //CONTENIDO COMENTARIO.
  if($resultado != 0){
								
	$sqlcomentarios = "select comentarios.idcomentario,usuario.nombre,comentarios.contenido,\n"
    . "comentarios.horacomentario \n"
    . "from usuario,comentarios\n"
    . "where \n"
    . "comentarios.idpublicacion = ".$_GET['idpublicacion']."\n"
    . "and comentarios.idusuario = usuario.idusuario\n"
    . "ORDER BY `comentarios`.`horacomentario` ASC ";
	
  $cadenaComentarios = '';							   
	$result = mysql_query($sqlcomentarios, $coneccion) or die(mysql_error());
	while($comentariosPublicacion = mysql_fetch_assoc($result)){
	$shortName = explode(" ",$comentariosPublicacion['nombre']); 
	
  $cadenaComentarios = $cadenaComentarios.'
   									<li>
										<div class="comment-wrap">
											<img alt="avatar" src="img/dummies/avatar.jpg" alt="avatar" width="51" height="51" class="avatar"/>
											<div class="comments-right">
												<div class="meta-date">'.$comentariosPublicacion['horacomentario'].'</div>
												<div><a href="#" class="url"><strong>'.$shortName[0].' '.$shortName[1].'</strong></a></div>
												<div class="brief"><p>'.$comentariosPublicacion['contenido'].'</p></div>
											</div>
										</div>
								  </li>  
						';
						

  
  }//while...
  }//if 0 comentarios
  
  $fin = '</ol>';
  
  $respuesta = $cadenaNumComentarios.$cadenaComentarios.$fin;
  echo $respuesta;
  

  
?>
