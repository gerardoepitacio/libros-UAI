<?php require_once('Connections/coneccion.php'); ?>
<?php
$maxRows_prestamo = 10;
$pageNum_prestamo = 0;
if (isset($_GET['pageNum_prestamo'])) {
  $pageNum_prestamo = $_GET['pageNum_prestamo'];
}
$startRow_prestamo = $pageNum_prestamo * $maxRows_prestamo;

$colname_prestamo = "-1";
if (isset($_GET['idlibro'])) {
  $colname_prestamo = (get_magic_quotes_gpc()) ? $_GET['idlibro'] : addslashes($_GET['idlibro']);
}
mysql_select_db($database_coneccion, $coneccion);
$query_prestamo = sprintf("SELECT * FROM lectura WHERE inicio IS NOT NULL and fin IS NULL and  idlibro = %s", $colname_prestamo);
$query_limit_prestamo = sprintf("%s LIMIT %d, %d", $query_prestamo, $startRow_prestamo, $maxRows_prestamo);
$prestamo = mysql_query($query_limit_prestamo, $coneccion) or die(mysql_error());
$row_prestamo = mysql_fetch_assoc($prestamo);

if (isset($_GET['totalRows_prestamo'])) {
  $totalRows_prestamo = $_GET['totalRows_prestamo'];
} else {
  $all_prestamo = mysql_query($query_prestamo);
  $totalRows_prestamo = mysql_num_rows($all_prestamo);
}
$totalPages_prestamo = ceil($totalRows_prestamo/$maxRows_prestamo)-1;
?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Documento sin t&iacute;tulo</title>
</head>

<body>
<table border="1">
  <tr>
    <td>idlectura</td>
    <td>idusuario</td>
    <td>idlibro</td>
    <td>inicio</td>
    <td>fin</td>
  </tr>
  <?php do { ?>
    <tr>
      <td><?php echo $row_prestamo['idlectura']; ?></td>
      <td><?php echo $row_prestamo['idusuario']; ?></td>
      <td><?php echo $row_prestamo['idlibro']; ?></td>
      <td><?php echo $row_prestamo['inicio']; ?></td>
      <td><?php echo $row_prestamo['fin']; ?></td>
    </tr>
    <?php } while ($row_prestamo = mysql_fetch_assoc($prestamo)); ?>
</table>
</body>
</html>
<?php
mysql_free_result($prestamo);
?>
