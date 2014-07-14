-- phpMyAdmin SQL Dump
-- version 3.5.2.2
-- http://www.phpmyadmin.net
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 14-07-2014 a las 17:23:25
-- Versión del servidor: 5.5.27
-- Versión de PHP: 5.4.7

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de datos: `librosuai`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `autor`
--

CREATE TABLE IF NOT EXISTS `autor` (
  `nombre` varchar(100) DEFAULT NULL,
  `pais` varchar(100) DEFAULT NULL,
  `nacimiento` date DEFAULT NULL,
  `fallecimiento` date DEFAULT NULL,
  `idautor` int(11) NOT NULL,
  PRIMARY KEY (`idautor`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `autor`
--

INSERT INTO `autor` (`nombre`, `pais`, `nacimiento`, `fallecimiento`, `idautor`) VALUES
('Jose Emilio Pacheco', 'Mexicano', '1939-06-30', '2014-01-26', 0),
('Gabriel José de la Concordia García Márquez', 'colombiado', '1927-03-06', '2014-04-17', 1),
('Jorge Mario Pedro Vargas Llosa', 'peruano', '1936-03-28', NULL, 2),
('Eric Arthur Blair', 'Reino Unido', '1903-06-25', '1950-01-21', 3),
('Arthur Conan Doyle', 'Escocia', '1859-05-22', '1930-07-07', 4),
('Ana Frank', 'Alemania', '1929-06-12', '1945-03-00', 5);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `comentarios`
--

CREATE TABLE IF NOT EXISTS `comentarios` (
  `idcomentario` int(11) NOT NULL AUTO_INCREMENT,
  `idpublicacion` int(11) DEFAULT NULL,
  `contenido` varchar(1000) DEFAULT NULL,
  `idusuario` int(11) DEFAULT NULL,
  `horacomentario` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`idcomentario`),
  KEY `idx_comentarios` (`idusuario`),
  KEY `idx_comentarios_0` (`idpublicacion`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=167 ;


--
-- Volcado de datos para la tabla `comentarios`
--

INSERT INTO `comentarios` (`idcomentario`, `idpublicacion`, `contenido`, `idusuario`, `horacomentario`) VALUES
(37, 20, 'ffh', 1, '2014-06-15 21:51:49'),
(127, 7, 'holaaa comentario! comentario! comentario! comentario! comentario! comentario! comentario! comentario! comentario! comentario! comentario! comentario! comentario! comentario! comentario! comentario! comentario! comentario! comentario! comentario! comentario! comentario! comentario! comentario! comentario! comentario! comentario! comentario! comentario! comentario! comentario! comentario! comentario! comentario! comentario! comentario! comentario! comentario! comentario! comentario! comentario! comentario! comentario! comentario! comentario! comentario! comentario! comentario! comentario! comentario! comentario! comentario! comentario! comentario! comentario! comentario! comentario! comentario! comentario! comentario! comentario! comentario! comentario! comentario! comentario! comentario! comentario!', 12, '2014-06-16 15:47:07'),
(128, 7, 'comentario! comentario! comentario! comentario! comentario! comentario! comentario! comentario! comentario! comentario! comentario!', 12, '2014-06-16 15:47:16'),
(156, 24, ':e', 1, '2014-06-19 22:29:54'),
(157, 24, 'dsafdasdfa', 1, '2014-06-19 23:21:10'),
(158, 24, 'asdfasdfasdf', 1, '2014-06-19 23:21:12'),
(159, 7, 'asdadsfsadfadsfadsfadsfadsfasfadsa', 1, '2014-06-19 23:21:37'),
(160, 7, 'jgjhgjhgjhghg', 13, '2014-06-19 23:53:18'),
(161, 7, 'jhkhkjhkjhkjhk', 13, '2014-06-19 23:53:21'),
(163, 20, 'asdfasdfasdfadsfadsfadsf', 13, '2014-06-20 00:04:52'),
(164, 20, 'sadfadsfads', 13, '2014-06-20 00:04:57'),
(165, 24, 'kk', 1, '2014-06-27 01:59:11'),
(166, 24, 'mnnmnkn', 1, '2014-06-27 01:59:32');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `editorial`
--

CREATE TABLE IF NOT EXISTS `editorial` (
  `ideditorial` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(100) DEFAULT NULL,
  `ubicacion` varchar(100) DEFAULT NULL,
  `telefono` varchar(20) DEFAULT NULL,
  `web` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`ideditorial`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=11 ;

--
-- Volcado de datos para la tabla `editorial`
--

INSERT INTO `editorial` (`ideditorial`, `nombre`, `ubicacion`, `telefono`, `web`) VALUES
(1, 'Oveja Negra', 'Carrera 14 No 47-39 Ofic. 205. 205 Bogota-Colombia', '5713020622', 'www.editorialovejanegra.com'),
(3, 'Editorial Trillas S.A. de C.V', 'Av. Rio Churubusco 385 Col. Gral. Pedro Maria Anaya', '015556884007', 'www.etrillas.com.mx'),
(6, 'Libreria de Porrua Hermanos y Cia S.A. de C.V.', 'Esquina de Republica de Argentina y Justo Sierra, Centro Historico, Mexico D.F.', '018000192300', 'www.porrua.mx'),
(7, 'Grupo Anaya, S.A. ', 'C Juan Ignacio Luca de Tena, 15 28027 Madrid, Espania.', '34913938800', 'www.anaya.es/1.0_secciones/home.php'),
(8, 'Ediciones Era S.A. de C.V.', 'Calle del trabajo 31, Colonia La Fama, Tlalpan 14269, Mexico D. F.', '01 55 5528 1221', 'www.edicionesera.com.mx/'),
(9, 'Editorial Lectorum', 'Pasaje Zocalo Pino Suarez, Loc. 9, Mexico D.F.', '5522 0278', 'www.lectorum.com.mx/'),
(10, 'Editorial Diana', 'Av. Presidente Masaryk, 111, 2.º  Colonia Chapultepec Morales 11570 Mexico, D. F.', '52 55 30 00 62 00', 'www.planeta.es/es/ES/AreasActividad/Editoriales/Grupo-Planeta/Editorial-Diana.htm');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `genero`
--

CREATE TABLE IF NOT EXISTS `genero` (
  `idgenero` int(11) NOT NULL AUTO_INCREMENT,
  `genero` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`idgenero`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=16 ;

--
-- Volcado de datos para la tabla `genero`
--

INSERT INTO `genero` (`idgenero`, `genero`) VALUES
(1, 'Oda'),
(2, 'Himmno'),
(3, 'Elegia'),
(4, 'Cancion'),
(5, 'Satira'),
(6, 'Epigrama'),
(7, 'Epopeya'),
(8, 'Poema epico'),
(9, 'Romance'),
(10, 'Fabula'),
(11, 'Epistola'),
(12, 'Cuento'),
(13, 'Apologo'),
(14, 'Leyenda'),
(15, 'Novela');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `lectura`
--

CREATE TABLE IF NOT EXISTS `lectura` (
  `idlectura` int(11) NOT NULL AUTO_INCREMENT,
  `idusuario` int(11) DEFAULT NULL,
  `idlibro` int(11) DEFAULT NULL,
  `inicio` date DEFAULT NULL,
  `fin` date DEFAULT NULL,
  PRIMARY KEY (`idlectura`),
  KEY `idx_lectura` (`idlibro`),
  KEY `idx_lectura_0` (`idusuario`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=11 ;

--
-- Volcado de datos para la tabla `lectura`
--

INSERT INTO `lectura` (`idlectura`, `idusuario`, `idlibro`, `inicio`, `fin`) VALUES
(2, 4, 6, '2014-06-03', NULL),
(7, 2, 5, '2014-06-01', NULL),
(8, 2, 6, '2014-05-12', '2014-05-30'),
(9, 2, 5, '2014-04-07', '2014-05-08'),
(10, 1, 5, '2014-05-12', '2014-06-01');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `libro`
--

CREATE TABLE IF NOT EXISTS `libro` (
  `idlibro` int(11) NOT NULL AUTO_INCREMENT,
  `estado` int(11) DEFAULT NULL,
  `idautor` int(11) DEFAULT NULL,
  `idpropietario` int(11) DEFAULT NULL,
  `ideditorial` int(11) DEFAULT NULL,
  `publicacion` date DEFAULT NULL,
  `disponible` tinyint(1) DEFAULT NULL,
  `titulo` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`idlibro`),
  KEY `idx_libro` (`idautor`),
  KEY `idx_libro_0` (`idpropietario`),
  KEY `idx_libro_1` (`ideditorial`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=38 ;

--
-- Volcado de datos para la tabla `libro`
--

INSERT INTO `libro` (`idlibro`, `estado`, `idautor`, `idpropietario`, `ideditorial`, `publicacion`, `disponible`, `titulo`) VALUES
(5, 100, 3, 1, 9, '2002-08-00', 0, '1984'),
(6, 100, 4, 1, 7, '2008-02-15', 0, 'Las aventuras de Sherlock Holmes'),
(30, 100, 0, 3, 1, '2013-11-11', 1, 'El principio del placer'),
(36, 100, 3, 1, 10, '2014-04-24', 1, 'Rebelion en la granja'),
(37, 10, 5, 12, 6, '2002-02-12', 1, 'Diario');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `libro_genero`
--

CREATE TABLE IF NOT EXISTS `libro_genero` (
  `idlibro_genero` int(11) NOT NULL AUTO_INCREMENT,
  `idlibro` int(11) DEFAULT NULL,
  `idgenero` int(11) DEFAULT NULL,
  PRIMARY KEY (`idlibro_genero`),
  KEY `idx_libro_genero` (`idlibro`),
  KEY `idx_libro_genero_0` (`idgenero`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Volcado de datos para la tabla `libro_genero`
--

INSERT INTO `libro_genero` (`idlibro_genero`, `idlibro`, `idgenero`) VALUES
(1, 6, 12),
(3, 5, 15);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `publicacion`
--

CREATE TABLE IF NOT EXISTS `publicacion` (
  `idpublicacion` int(11) NOT NULL AUTO_INCREMENT,
  `idlectura` int(11) DEFAULT NULL,
  `contenido` varchar(5000) DEFAULT NULL,
  `titulo` varchar(100) DEFAULT NULL,
  `hora` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`idpublicacion`),
  KEY `idx_comentario` (`idlectura`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=31 ;

--
-- Volcado de datos para la tabla `publicacion`
--

INSERT INTO `publicacion` (`idpublicacion`, `idlectura`, `contenido`, `titulo`, `hora`) VALUES
(7, 8, 'Hablar sobre este tema en estos momentos, es muy atreviso, este autor lo hizo genialmente bien.', 'hola!!', '0000-00-00 00:00:00'),
(20, 10, 'La novela se localiza en una futura Londres, parte de una regi?n llamada Franja A?rea 1, que "... \r\nalguna vez fue llamada Inglaterra o Britania"2 integrada, a su vez, en un inmenso estado colectivista: \r\nOcean?a. La sociedad de Ocean?a est? dividida en tres grupos. Los miembros "externos" del Partido \r\n?nico, los miembros del Consejo dirigente, o c?rculo interior del partido, y una masa de gente a la \r\nque el Partido mantiene pobre y entretenida para que no puedan ni quieran rebelarse, los proles.\r\nLos miembros "externos" constituyen la burocracia del aparato estatal (de ah? la necesidad de la \r\nestricta vigilancia), viven sometidos a un control asfixiante y a una propaganda alienante que los \r\ndesmoraliza y les impide pensar cr?ticamente. El estado suprime todo derecho y los condena a una \r\nexistencia poco m?s que miserable, con riesgo de perder la vida o sufrir vej?menes espantosos, si no \r\nque demostrasen suficiente fidelidad y adhesi?n a la causa nacional. Para ello se organizan numerosas \r\nmanifestaciones donde se requiere la participaci?n activa de los miembros, gritando las consignas \r\nfavorables al partido, vociferando contra los supuestos traidores, dando rienda suelta al m?s \r\ndesaforado fanatismo. Solo con fervor fan?tico se puede escapar a la omnipresente vigilancia de la \r\npolic?a del pensamiento.\r\n\r\nLa novela es una descripci?n anal?tica de los reg?menes totalitarios, muy en particular del r?gimen \r\nstalinista. El t?tulo que se le da al gran dictador as? lo sugiere: "Gran Hermano". Una alusi?n \r\ninequ?voca a Stalin. Adem?s se ridiculiza el derrotero pol?tico de ?ste ante la agresi?n nazi en la \r\nSegunda Guerra Mundial: Stalin pas? de ser virtual aliado de Hitler, a ser su m?s enconado enemigo. Y \r\nese tremendo acto fallido pesar?a sobre la credibilidad de los comunistas del mundo entero.\r\nEl personaje principal de la novela es Winston Smith, que trabaja en el Ministerio de la Verdad (uno \r\nde los cuatro ministerios que hay). Su cometido es reescribir la historia, ironizando as?, el ideal \r\ndeclarado en el nombre del Ministerio.\r\n\r\nLos ministerios son los siguientes:\r\nEl Ministerio del Amor (en neolengua Minimor) se ocupa de administrar los castigos, la tortura y de \r\nreeducar a los miembros del Partido inculcando un amor f?rreo por el Gran Hermano y las ideolog?as del \r\nPartido.\r\n\r\nEl Ministerio de la Paz (Minipax) se encarga de asuntos relacionados con la guerra y se esfuerza para \r\nlograr que la contienda sea permanente. Si hay guerra con otros pa?ses, el pa?s est? en paz consigo \r\nmismo. (Hay menos revueltas sociales cuando el odio y el miedo se pueden enfocar hacia fuera, como \r\nse?ala la psicolog?a social).\r\n\r\nEl Ministerio de la Abundancia (Minidancia) encargado de los asuntos relacionados con la econom?a y de \r\nconseguir que la gente viva siempre al borde de la subsistencia mediante un duro racionamiento.\r\nEl Ministerio de la Verdad (Miniver) se dedica a manipular o destruir los documentos hist?ricos de \r\ntodo tipo (incluyendo fotograf?as, libros y peri?dicos), para conseguir que las evidencias del pasado \r\ncoincidan con la versi?n oficial de la historia, mantenida por el Estado.\r\n', 'Lo mejor de George orwell', '2014-06-12 09:06:58'),
(24, 10, '1984 sitúa su acción en un Estado totalitario llamado Oceanía, el cuál, ha sido implantado tras una \r\nrevolución de la población contra el sistema capitalista. Dicho estado es gobernado por un único \r\npartido, cuya ideología se denomina INGSOC (Socialismo Inglés). Éste, ejerce un control absoluto sobre \r\nsus súbditos, a través de diversos instrumentos de control, y sobre los aspectos que conciernen a las \r\npersonas, tales como su pasado, presente y futuro. En consecuencia, dicho nivel de control ha acabado \r\ncon asomo alguno de libertad y de verdadero afecto humano.\r\n\r\nWinston Smith, el personaje principal de la novela, a pesar de ser miembro del partido, es disidente \r\ncon la doctrina del partido.\r\n\r\nEn la primera parte de la novela, vemos cómo toma conciencia sobre la manipulación de la cuál, es \r\nvíctima. Esto provoca en él, ansias de conocer el modo de vida existente antes de la revolución. \r\nAdemás, medita acerca de su vida, plasmando todo aquello que siente en un pequeño diario. Es decir, \r\npiensa en todo aquello que puede poseer y que no posee, debido a que el Gran Hermano (concreción que \r\nel partido presenta al mundo) quiere mantener el poder a cualquier precio. Éste sacrifica todo valor \r\nhumano con el fin de poseer el poder absoluto. Por tanto, dijéramos que Winston, en última instancia, \r\ncomprende cómo vivir en dicha sociedad, sin entender por qué vivir así y no de una manera diferente. \r\nNo encuentra sentido alguno a su modo de vida. En la segunda parte, el descontento existente en su \r\npersona le impulsa a rebelarse contra el partido, llevando a cabo actos que el partido considera \r\ndelictivos. Así, mediante Julia (otro miembro del partido), de la cuál se enamora, infringe la \r\ndoctrina del partido, puesto que, según esta, el único amor que un miembro del partido\r\n\r\ndebe manifestar, es aquel que debe dirigirse única y exclusivamente hacia la figura del Gran Hermano. \r\nPara evitar la presencia de los instrumentos de control, Winston alquila una habitación en una casa de \r\nun proletario (clase social menos controlada) para los contactos con Julia. Sin embargo, Winston y \r\nJulia son detenidos aquí, ya que dicho alquiler constituye una trampa de la Policía del Pensamiento \r\n(instrumento de control social) para detenerlos. Además, Winston junto con Julia decide alistarse en \r\nlas filas de la Hermandad (grupo que intenta conspirar contra el partido), la cuál, resulta ser una \r\ntapadera perfecta para detener a los disidentes, ya que antes o después todo disidente intenta ponerse \r\nen contacto con ella. Durante esta parte, a través del libro de Goldstein, el cuál, es proporcionado a \r\naquel que intenta ponerse en contacto con esa hipotética hermandad y que, lógicamente, ha sido editado \r\npor el propio partido, Winston descubre el único y verdadero objetivo del partido: el poder absoluto.\r\n\r\nEn la última parte, vemos cómo Winston es detenido y torturado, con el fin de su reciclaje. Para ello, \r\nes sometido a una descomunal tortura, tanto física como psicológica, la cuál, trastornan los \r\nsentimientos y principios que posee hacia el partido. Dijéramos que sus principios heréticos son \r\nborrados, quedando sólo en él, sentimientos de amor hacia la figura del Gran Hermano.\r\n', 'George orwell no me canso de comentar esta obra tan genial', '2014-06-12 11:09:52'),
(30, NULL, 'dfghgfdsasfghjhgfdaASDFGHJHGFDAasdfghj', 'zxfghjklkjgfds', '2014-06-16 15:01:41');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `unidad`
--

CREATE TABLE IF NOT EXISTS `unidad` (
  `idunidad` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(100) DEFAULT NULL,
  `ubicacion` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`idunidad`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Volcado de datos para la tabla `unidad`
--

INSERT INTO `unidad` (`idunidad`, `nombre`, `ubicacion`) VALUES
(1, 'Unidad Academica de Ingenieria', 'AV. Lazaro Cardenas S/N, Cuidad Universitaria'),
(2, 'Unidad Academica de Derecho', 'AV. Lazaro Cardenas S/N, Cuidad Universitaria'),
(3, 'Unidad Academica de Filosofia y Letras', 'AV. Lazaro Cardenas S/N, Cuidad Universitaria');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE IF NOT EXISTS `usuario` (
  `idusuario` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(100) DEFAULT NULL,
  `sexo` char(1) DEFAULT NULL COMMENT 'm = masculino\nf = femenino',
  `correo` varchar(100) DEFAULT NULL,
  `facebook` varchar(100) DEFAULT NULL,
  `telefono` varchar(20) DEFAULT NULL,
  `direccion` varchar(100) DEFAULT NULL,
  `idunidad` int(11) DEFAULT NULL,
  `password` text,
  PRIMARY KEY (`idusuario`),
  KEY `idx_usuario` (`idunidad`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 COMMENT='Usuario del sistema que puede poner a disposicion un libro o pedir prestado un libro\n' AUTO_INCREMENT=14 ;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`idusuario`, `nombre`, `sexo`, `correo`, `facebook`, `telefono`, `direccion`, `idunidad`, `password`) VALUES
(1, 'Juan Gerardo Epitacio Galvez', 'M', 'ger.epitacio@gmail.com', 'https://www.facebook.com/gerardo.epitafio', '7471007108', 'Martirez 30 de Diciembre, Col. Guerrero', 1, 'password'),
(2, 'Adalid Cruz Iturbide', 'M', 'adalid@gmail.com', 'https://www.facebook.com/adal.cruz.75', '7471006699', 'Col. los Angeles', 3, 'password'),
(3, 'Hilbert Epitacio Galvez', 'M', 'vicius.hil.vortex@gmail.com', 'www.facebook.com/sidpunkie', '7471337454', 'Col. Industrial', 1, 'password'),
(4, 'Arely Medina Soto', 'F', 'arely.brujita.14@gmail.com', 'https://www.facebook.com/BrujithaaaA', '7471019052', 'Av. Tepeyac Manzana 3 Lote 81, Col. Guadalupe ', 1, 'medina'),
(6, 'wer', 'w', 'qw', 'qw', '23', 'qw', 2, 'qw'),
(9, 'asdf', 'a', 'd', 'd', 'd', 'dir', 1, '345'),
(12, 'Guadalupe Lucero Duran', 'F', 'gualupis@gmail.com', 'https://www.facebook.com/guadalupe.luceroduran', '666666', 'Por la coca', 1, 'password'),
(13, 'jesus antonio tepec', 'M', 'chucho@gmail.com', 'facebookxxxxxx', '66666666', 'por la rosa', 1, 'chucho');

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `comentarios`
--
ALTER TABLE `comentarios`
  ADD CONSTRAINT `fk_comentarios_publicacion` FOREIGN KEY (`idpublicacion`) REFERENCES `publicacion` (`idpublicacion`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_comentarios_usuario` FOREIGN KEY (`idusuario`) REFERENCES `usuario` (`idusuario`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `lectura`
--
ALTER TABLE `lectura`
  ADD CONSTRAINT `fk_lectura` FOREIGN KEY (`idlibro`) REFERENCES `libro` (`idlibro`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_lectura_0` FOREIGN KEY (`idusuario`) REFERENCES `usuario` (`idusuario`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `libro`
--
ALTER TABLE `libro`
  ADD CONSTRAINT `fk_libro` FOREIGN KEY (`idautor`) REFERENCES `autor` (`idautor`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_libro_0` FOREIGN KEY (`idpropietario`) REFERENCES `usuario` (`idusuario`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_libro_1` FOREIGN KEY (`ideditorial`) REFERENCES `editorial` (`ideditorial`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `libro_genero`
--
ALTER TABLE `libro_genero`
  ADD CONSTRAINT `fk_libro_genero` FOREIGN KEY (`idlibro`) REFERENCES `libro` (`idlibro`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_libro_genero_0` FOREIGN KEY (`idgenero`) REFERENCES `genero` (`idgenero`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `publicacion`
--
ALTER TABLE `publicacion`
  ADD CONSTRAINT `fk_comentario` FOREIGN KEY (`idlectura`) REFERENCES `lectura` (`idlectura`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD CONSTRAINT `fk_usuario` FOREIGN KEY (`idunidad`) REFERENCES `unidad` (`idunidad`) ON DELETE NO ACTION ON UPDATE NO ACTION;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
