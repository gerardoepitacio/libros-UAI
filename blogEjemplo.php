<?php require_once('Connections/coneccion.php'); ?>
<?php
$charset = mysql_client_encoding($coneccion);

echo "The current character set is: $charset\n";


$colname_contenidoblog = "-1";
//if (isset($_GET['idpublicacion'])) {
if ((isset($_GET['idpublicacion'])) && ($_GET['idpublicacion'] != "")) {

  $colname_contenidoblog = (get_magic_quotes_gpc()) ? $_GET['idpublicacion'] : addslashes($_GET['idpublicacion']);
mysql_select_db($database_coneccion, $coneccion);
mysql_query("SET NAMES 'utf8'");

	
}


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
    . "and lectura.idlibro = libro.idlibro LIMIT 0, 30 ";


$contenidoblog = mysql_query($sql, $coneccion) or die(mysql_error());
$row_contenidoblog = mysql_fetch_assoc($contenidoblog);
$totalRows_contenidoblog = mysql_num_rows($contenidoblog);


?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Documento sin t&iacute;tulo</title>
</head>

<body>
<?php echo $row_contenidoblog['contenido']; ?>
<?php echo $row_contenidoblog['titulo']; ?>
<?php echo $row_contenidoblog['tPublicacion']; ?>
<?php echo $row_contenidoblog['nombre']; ?>




</body>
</html>
<?php
mysql_free_result($contenidoblog);
?>
