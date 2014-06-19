<?php 

$query_detalleLibro = sprintf("SELECT 
	idlibro,
	titulo,
	publicacion,
	estado,
	disponible,
autor.nombre as autor,
propietario.nombre as propietario,
editorial.nombre as editorial
 FROM libro 
 inner join autor on libro.idautor = autor.idautor
 inner join usuario on libro.idpropietario = usuario.idusuario
 inner join editorial on libro.ideditorial = editorial.ideditorial
  WHERE idlibro = %s", $colname_detalleLibro);