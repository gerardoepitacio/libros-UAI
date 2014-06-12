<?php require_once('Connections/coneccion.php'); ?>
<?php
$maxRows_libros = 10;
$pageNum_libros = 0;
if (isset($_GET['pageNum_libros'])) {
  $pageNum_libros = $_GET['pageNum_libros'];
}
$startRow_libros = $pageNum_libros * $maxRows_libros;

mysql_select_db($database_coneccion, $coneccion);
$query_libros = "SELECT * FROM libro";
$query_limit_libros = sprintf("%s LIMIT %d, %d", $query_libros, $startRow_libros, $maxRows_libros);
$libros = mysql_query($query_limit_libros, $coneccion) or die(mysql_error());
$row_libros = mysql_fetch_assoc($libros);

if (isset($_GET['totalRows_libros'])) {
  $totalRows_libros = $_GET['totalRows_libros'];
} else {
  $all_libros = mysql_query($query_libros);
  $totalRows_libros = mysql_num_rows($all_libros);
}
$totalPages_libros = ceil($totalRows_libros/$maxRows_libros)-1;
?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Documento sin t&iacute;tulo</title>
</head>

<body>
<table border="1">
  <tr>
    <td>idlibro</td>
    <td>estado</td>
    <td>idautor</td>
    <td>idpropietario</td>
    <td>ideditorial</td>
    <td>publicacion</td>
    <td>disponible</td>
    <td>titulo</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <?php do { ?>
    <tr>
      <td><?php echo $row_libros['idlibro']; ?></td>
      <td><?php echo $row_libros['estado']; ?></td>
      <td><?php echo $row_libros['idautor']; ?></td>
      <td><?php echo $row_libros['idpropietario']; ?></td>
      <td><?php echo $row_libros['ideditorial']; ?></td>
      <td><?php echo $row_libros['publicacion']; ?></td>
      <td><?php echo $row_libros['disponible']; ?></td>
      <td><?php echo $row_libros['titulo']; ?></td>
      <td><a href="editarLibro.php?idlibro=<?php echo $row_libros['idlibro']?>">mod</a></td>
      <td>elim</td>
    </tr>
    <?php } while ($row_libros = mysql_fetch_assoc($libros)); ?>
</table>
</body>
</html>
<?php
mysql_free_result($libros);
?>