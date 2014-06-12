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

if ((isset($_POST["MM_update"])) && ($_POST["MM_update"] == "form1")) {
  $updateSQL = sprintf("UPDATE libro SET estado=%s, idautor=%s, idpropietario=%s, ideditorial=%s, publicacion=%s, disponible=%s, titulo=%s WHERE idlibro=%s",
                       GetSQLValueString($_POST['estado'], "int"),
                       GetSQLValueString($_POST['idautor'], "int"),
                       GetSQLValueString($_POST['idpropietario'], "int"),
                       GetSQLValueString($_POST['ideditorial'], "int"),
                       GetSQLValueString($_POST['publicacion'], "date"),
                       GetSQLValueString($_POST['disponible'], "int"),
                       GetSQLValueString($_POST['titulo'], "text"),
                       GetSQLValueString($_POST['idlibro'], "int"));

  mysql_select_db($database_coneccion, $coneccion);
  $Result1 = mysql_query($updateSQL, $coneccion) or die(mysql_error());

  $updateGoTo = "libros.php";
  if (isset($_SERVER['QUERY_STRING'])) {
    $updateGoTo .= (strpos($updateGoTo, '?')) ? "&" : "?";
    $updateGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $updateGoTo));
}

$colname_registroLibros = "-1";
if (isset($_GET['idlibro'])) {
  $colname_registroLibros = (get_magic_quotes_gpc()) ? $_GET['idlibro'] : addslashes($_GET['idlibro']);
}
mysql_select_db($database_coneccion, $coneccion);
$query_registroLibros = sprintf("SELECT * FROM libro WHERE idlibro = %s", $colname_registroLibros);
$registroLibros = mysql_query($query_registroLibros, $coneccion) or die(mysql_error());
$row_registroLibros = mysql_fetch_assoc($registroLibros);
$totalRows_registroLibros = mysql_num_rows($registroLibros);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Documento sin t&iacute;tulo</title>
</head>

<body>
<form method="post" name="form1" action="<?php echo $editFormAction; ?>">
  <table align="center">
    <tr valign="baseline">
      <td nowrap align="right">Idlibro:</td>
      <td><?php echo $row_registroLibros['idlibro']; ?></td>
    </tr>
    <tr valign="baseline">
      <td nowrap align="right">Estado:</td>
      <td><input type="text" name="estado" value="<?php echo $row_registroLibros['estado']; ?>" size="32"></td>
    </tr>
    <tr valign="baseline">
      <td nowrap align="right">Idautor:</td>
      <td><input type="text" name="idautor" value="<?php echo $row_registroLibros['idautor']; ?>" size="32"></td>
    </tr>
    <tr valign="baseline">
      <td nowrap align="right">Idpropietario:</td>
      <td><input type="text" name="idpropietario" value="<?php echo $row_registroLibros['idpropietario']; ?>" size="32"></td>
    </tr>
    <tr valign="baseline">
      <td nowrap align="right">Ideditorial:</td>
      <td><input type="text" name="ideditorial" value="<?php echo $row_registroLibros['ideditorial']; ?>" size="32"></td>
    </tr>
    <tr valign="baseline">
      <td nowrap align="right">Publicacion:</td>
      <td><input type="text" name="publicacion" value="<?php echo $row_registroLibros['publicacion']; ?>" size="32"></td>
    </tr>
    <tr valign="baseline">
      <td nowrap align="right">Disponible:</td>
      <td><input type="text" name="disponible" value="<?php echo $row_registroLibros['disponible']; ?>" size="32"></td>
    </tr>
    <tr valign="baseline">
      <td nowrap align="right">Titulo:</td>
      <td><input type="text" name="titulo" value="<?php echo $row_registroLibros['titulo']; ?>" size="32"></td>
    </tr>
    <tr valign="baseline">
      <td nowrap align="right">&nbsp;</td>
      <td><input type="submit" value="Actualizar registro"></td>
    </tr>
  </table>
  <input type="hidden" name="MM_update" value="form1">
  <input type="hidden" name="idlibro" value="<?php echo $row_registroLibros['idlibro']; ?>">
</form>
<p>&nbsp;</p>
</body>
</html>
<?php
mysql_free_result($registroLibros);
?>
