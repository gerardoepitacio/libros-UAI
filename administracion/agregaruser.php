<?php require_once('../Connections/coneccion.php'); ?>
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

if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "form1")) {
  $insertSQL = sprintf("INSERT INTO libro (idlibro, genero, estado, idautor, idpropietario, ideditorial, publicacion, disponible) VALUES (%s, %s, %s, %s, %s, %s, %s, %s)",
                       GetSQLValueString($_POST['idlibro'], "int"),
                       GetSQLValueString($_POST['genero'], "text"),
                       GetSQLValueString($_POST['estado'], "text"),
                       GetSQLValueString($_POST['idautor'], "int"),
                       GetSQLValueString($_POST['idpropietario'], "int"),
                       GetSQLValueString($_POST['ideditorial'], "int"),
                       GetSQLValueString($_POST['publicacion'], "date"),
                       GetSQLValueString($_POST['disponible'], "int"));

  mysql_select_db($database_coneccion, $coneccion);
  $Result1 = mysql_query($insertSQL, $coneccion) or die(mysql_error());
}
?>
<form method="post" name="form1" action="<?php echo $editFormAction; ?>">
  <table align="center">
    <tr valign="baseline">
      <td nowrap align="right">Idlibro:</td>
      <td><input type="text" name="idlibro" value="" size="32"></td>
    </tr>
    <tr valign="baseline">
      <td nowrap align="right">Genero:</td>
      <td><input type="text" name="genero" value="" size="32"></td>
    </tr>
    <tr valign="baseline">
      <td nowrap align="right">Estado:</td>
      <td><input type="text" name="estado" value="" size="32"></td>
    </tr>
    <tr valign="baseline">
      <td nowrap align="right">Idautor:</td>
      <td><input type="text" name="idautor" value="" size="32"></td>
    </tr>
    <tr valign="baseline">
      <td nowrap align="right">Idpropietario:</td>
      <td><input type="text" name="idpropietario" value="" size="32"></td>
    </tr>
    <tr valign="baseline">
      <td nowrap align="right">Ideditorial:</td>
      <td><input type="text" name="ideditorial" value="" size="32"></td>
    </tr>
    <tr valign="baseline">
      <td nowrap align="right">Publicacion:</td>
      <td><input type="text" name="publicacion" value="" size="32"></td>
    </tr>
    <tr valign="baseline">
      <td nowrap align="right">Disponible:</td>
      <td><input type="text" name="disponible" value="" size="32"></td>
    </tr>
    <tr valign="baseline">
      <td nowrap align="right">&nbsp;</td>
      <td><input type="submit" value="Insertar registro"></td>
    </tr>
  </table>
  <input type="hidden" name="MM_insert" value="form1">
</form>
<p>&nbsp;</p>
