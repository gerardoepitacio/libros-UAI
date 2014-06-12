<?php require_once('Connections/coneccion.php'); ?>
<?php
// *** Validate request to login to this site.

if (!isset($_SESSION)) {
  session_start();
  unset($_SESSION['MM_Username']);
  unset($_SESSION['MM_UserGroup']);
  unset($_SESSION['idusuario']);
  
  }
  else{
  session_destroy();
  
  }

$loginFormAction = $_SERVER['PHP_SELF'];
if (isset($_GET['accesscheck'])) {
  $_SESSION['PrevUrl'] = $_GET['accesscheck'];
}

if (isset($_POST['Usuario'])) {
  $loginUsername=$_POST['Usuario'];
  $password=$_POST['pass'];
  $MM_fldUserAuthorization = "";
  $MM_redirectLoginSuccess = "home.php";
  $MM_redirectLoginFailed = "error.php";
  $MM_redirecttoReferrer = false;
  mysql_select_db($database_coneccion, $coneccion);
  
  $LoginRS__query=sprintf("SELECT idusuario,nombre,correo, password FROM usuario WHERE correo='%s' AND password='%s'",
    get_magic_quotes_gpc() ? $loginUsername : addslashes($loginUsername), get_magic_quotes_gpc() ? $password : addslashes($password)); 
   
  $LoginRS = mysql_query($LoginRS__query, $coneccion) or die(mysql_error());
  $loginFoundUser = mysql_num_rows($LoginRS);
  if ($loginFoundUser) {
     $loginStrGroup = "";
	$row = mysql_fetch_row($LoginRS);
	$id = $row[0];
	$name = $row[1];
	
	$nombres = explode(" ",$name);
    //declare two session variables and assign them
    $_SESSION['MM_Username'] = $loginUsername;
    $_SESSION['MM_UserGroup'] = $loginStrGroup;
	$_SESSION['idusuario'] = $id;
	$_SESSION['nombre'] = $nombres[0]." ".$nombres[1];
    if (isset($_SESSION['PrevUrl']) && false) {
      $MM_redirectLoginSuccess = $_SESSION['PrevUrl'];	
    }
    header("Location: " . $MM_redirectLoginSuccess );
  }
  else {
    header("Location: ". $MM_redirectLoginFailed );
  }
}
?>




<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">  
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	
		<title>SIMPLE</title>
			
		<!-- CSS -->
		<link rel="stylesheet" href="css/style.css" type="text/css" media="screen" />
		<!--[if IE 6]>
			<link rel="stylesheet" type="text/css" media="screen" href="css/ie-hacks.css" />
			<script type="text/javascript" src="js/DD_belatedPNG.js"></script>
			<script>
	      		/* EXAMPLE */
	      		DD_belatedPNG.fix('*');
	    	</script>
		<![endif]-->
		<!--[if IE 7]>
			<link rel="stylesheet" href="css/ie7-hacks.css" type="text/css" media="screen" />
		<![endif]-->
		<!--[if IE 8]>
			<link rel="stylesheet" href="css/ie8-hacks.css" type="text/css" media="screen" />
		<![endif]-->
		<!-- ENDS CSS -->
		
		<!-- prettyPhoto -->
		<link rel="stylesheet" href="js/prettyPhoto/css/prettyPhoto.css" type="text/css" media="screen" />
		<!-- ENDS prettyPhoto -->
		
		<!-- JS -->
		<script type="text/javascript" src="js/jquery_1.4.2.js"></script>
		<script type="text/javascript" src="js/jqueryui.js"></script>
		<script type="text/javascript" src="js/easing.js"></script>
		<script type="text/javascript" src="js/jquery.cycle.all.js"></script>
		<script type="text/javascript" src="js/tooltip/jquery.tools.min.js"></script>
		<script type="text/javascript" src="js/filterable.pack.js"></script>
		<script type="text/javascript" src="js/prettyPhoto/js/jquery.prettyPhoto.js"></script>
		<script type="text/javascript" src="js/chirp.js"></script>
		<script type="text/javascript" src="js/jquery.tabs/jquery.tabs.pack.js"></script>
		<script type="text/javascript" src="js/custom.js"></script>
		<!-- ENDS JS -->

		<!-- Cufon -->
		<script src="js/cufon-yui.js" type="text/javascript"></script>
		<script src="js/fonts/bebas-neue_400.font.js" type="text/javascript"></script>
        <!-- /Cufon -->
	
		<!-- superfish -->
		<link rel="stylesheet" type="text/css" media="screen" href="css/superfish-custom.css" /> 
		<script type="text/javascript" src="js/superfish-1.4.8/js/hoverIntent.js"></script> 
		<script type="text/javascript" src="js/superfish-1.4.8/js/superfish.js"></script> 
		<!-- ENDS superfish -->
		
		<!-- tabs -->
        <link rel="stylesheet" href="css/jquery.tabs.css" type="text/css" media="print, projection, screen" />
        <!-- Additional IE/Win specific style sheet (Conditional Comments) -->
        <!--[if lte IE 7]>
        <link rel="stylesheet" href="css/jquery.tabs-ie.css" type="text/css" media="projection, screen">
        <![endif]-->
  		<!-- ENDS tabs -->
		
	</head>
	
	
	<body>

		<!-- HEADER -->
		<div id="header">
		<div class="degree">
			<div class="wrapper">
				<a href="index.php"><img src="img/logo.png" alt="Logo" id="logo" /></a>
		
				<!-- search -->
				<div class="top-search">
					<form  method="get" id="searchform" action="">
						<div>
							<input type="text" value="Search..." name="s" id="s" onfocus="defaultInput(this)" onblur="clearInput(this)" />
							<input type="submit" id="searchsubmit" value=" " />
						</div>
					</form>
				</div>
				<!-- ENDS search -->
			
			</div>
			<!-- ENDS HEADER-wrapper -->
		</div>
		</div>
		<!-- ENDS HEADER -->
			
		<!-- MAIN -->
		<div id="main">
			<!-- wrapper -->
			<div class="wrapper">
				<!-- content -->
				<div class="content">
					<!-- title -->
					<div class="title-holder"></div>
					<!-- ENDS title -->
					
					<!-- page-content -->
					<div class="page-content">
					
						<!-- 2 cols -->
						<div class="one-half">
							<h4>Libros UAI</h4>
							<h4>Control de prestamos </h4>
							<p>Lee, explora, comparte un libro . </p>
							
							
<script type="text/javascript" src="js/form-validation.js"></script>					
<form id="form1" name="form1" method="POST" action="<?php echo $loginFormAction; ?>">
<fieldset>
  <p>
    <label>Correo <br/>
          <input name="Usuario" type="text" id="Usuario" />
    </label>
  </p>
  <p>
    <label>Pass <br />
    <input name="pass" type="password" id="pass" />
    </label>
  </p>
  <p>
	<input type="submit" value="Entrar" name="submit" id="submit" />
  </p>
  </fieldset>
<p id="error" class="warning">Error!</p>
</form>
							
					<p id="success" class="success">OK</p>		
							<!-- ENDS form -->
		<p><a href="agregarNuevoUsuario.php" class="link-button"><span>Regristrarme</span></a></p>
					  </div>
						<div class="clear "></div>
						<!-- ENDS 2 cols -->

					</div>
					<!-- ENDS page-content -->

						
				</div>
				<!-- ENDS content -->
				
				<!-- twitter -->
				<div class="twitter-reader">
					<script>Chirp({user:"ansimuz",max:1})</script></div>
		  </div>
				<!-- ENDS twitter -->
				
	</div>
			<!-- ENDS main-wrapper -->
			
		
		</div>		
		<!-- ENDS MAIN -->	
		
		<!-- FOOTER -->
		<div id="footer">
		<div class="degree">
			<!-- wrapper -->
			<!-- ENDS footer-wrapper -->
</div>
		</div>
		<!-- ENDS FOOTER -->


		<!-- BOTTOM -->
		<div id="bottom">
			<!-- wrapper -->
			<!-- ENDS bottom-wrapper -->
</div>
		<!-- ENDS BOTTOM -->

		<!-- start cufon -->
		<script type="text/javascript"> Cufon.now(); </script>
		<!-- ENDS start cufon -->
	
	</body>
</html>
