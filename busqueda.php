<?php require_once('Connections/coneccion.php'); ?>
<?php

  mysql_select_db($database_coneccion, $coneccion);

$valorBusqueda = $_GET['valor'];


  //****************************coneccion a base de datos resuesta....
//NUM COMENTARIOS

  $sqlBusqueda = "SELECT * FROM usuario WHERE nombre LIKE '".$valorBusqueda."%' OR nombre LIKE '%".$valorBusqueda."%'   LIMIT 0, 5 ";
	
	$resultadoBusqueda = mysql_query($sqlBusqueda, $coneccion) or die(mysql_error());				

$encabezadoPersonas = '<h1>Personas:</h1> <br>';
$respuestaPersonas = '';
while( $row_publicacion = mysql_fetch_assoc($resultadoBusqueda)){

$respuestaPersonas .= '<h6> <a href ="about.php?idusuario='.$row_publicacion['idusuario'].'">'.$row_publicacion['nombre'].' </a></h6>
              <br></br>
                  ';


}



  $sqlBusqueda = "SELECT * FROM libro WHERE titulo LIKE '%".$valorBusqueda."%' LIMIT 0, 5 ";
  
  $resultadoBusqueda = mysql_query($sqlBusqueda, $coneccion) or die(mysql_error());       

$encabezadoLibros = '<h1>Libros:</h1> <br>';
$respuestaLibros = '';
while( $row_libros = mysql_fetch_assoc($resultadoBusqueda)){

$respuestaLibros .= '<h6> <a href ="detalleLibro.php?idlibro='.$row_libros['idlibro'].'">'.$row_libros['titulo'].'</a></h6>
              <br></br>
                  ';


}







echo $encabezadoPersonas.$respuestaPersonas.$encabezadoLibros.$respuestaLibros;