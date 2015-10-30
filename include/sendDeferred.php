<?php
	require_once(dirname(__FILE__) . "/../classes/Autoloader.php");		
	
	$seconds = $argv[1];
	$tipo = $argv[2];	
	
	echo "$seconds $tipo \n";
	
	sleep($seconds);
	echo "$seconds $tipo ok\n";
	\Eventos::send($tipo);	
	echo "$seconds $tipo ok 2\n";

?>