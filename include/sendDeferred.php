<?php
	require_once(dirname(__FILE__) . "/../classes/Autoloader.php");		
	
	$seconds = $argv[1];
	$code = $argv[2];	

	sleep($seconds);
	new Message($code);

?>