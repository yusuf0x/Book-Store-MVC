<?php 
	ini_set('display_startup_errors',1);
	ini_set('display_errors',1);
	error_reporting(-1);

	//Require libraries
	// require_once 'PHPMailer/src/PHPMailer.php';
	// require_once 'PHPMailer/src/Exception.php';
	// require_once 'PHPMailer/src/SMTP.php';
	require_once 'libraries/Core.php';
	require_once 'libraries/Controller.php';
	require_once 'libraries/Database.php';
	require_once 'helpers/session_helper.php';
	require_once 'config/config.php';
	require_once 'fpdf184/fpdf.php';
	
	// require_once 'fpdf184/CevicheOne-Regular.php';
	// require_once 'fpdf184/fpdf_gen.php';
	// require_once'fpdf184/makefont/makefont.php';
	
	$init = new Core();

?>