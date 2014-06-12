<?php require_once('Connections/coneccion.php'); ?>
<?php
mysql_select_db($database_coneccion, $coneccion);
$query_librosUsuario = "SELECT idlibro, estado, idautor, ideditorial, publicacion, disponible, titulo FROM libro";
$librosUsuario = mysql_query($query_librosUsuario, $coneccion) or die(mysql_error());
$row_librosUsuario = mysql_fetch_assoc($librosUsuario);
$totalRows_librosUsuario = mysql_num_rows($librosUsuario);
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
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
    <td>ideditorial</td>
    <td>publicacion</td>
    <td>disponible</td>
    <td>titulo</td>
  </tr>
  <?php do { ?>
    <tr>
      <td><?php echo $row_librosUsuario['idlibro']; ?></td>
      <td><?php echo $row_librosUsuario['estado']; ?></td>
      <td><?php echo $row_librosUsuario['idautor']; ?></td>
      <td><?php echo $row_librosUsuario['ideditorial']; ?></td>
      <td><?php echo $row_librosUsuario['publicacion']; ?></td>
      <td><?php echo $row_librosUsuario['disponible']; ?></td>
      <td><?php echo $row_librosUsuario['titulo']; ?></td>
    </tr>
    <?php } while ($row_librosUsuario = mysql_fetch_assoc($librosUsuario)); ?>
</table>
</body>
</html>
<?php
mysql_free_result($librosUsuario);
?>

