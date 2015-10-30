<?php
	require_once("classes/Autoloader.php");
	session_start();
	try {
		new Message("/http/" . $_SERVER['REQUEST_METHOD'] . strtok($_SERVER["REQUEST_URI"],'?'));
	} catch (Exception $e) {
		new Message("/on/exception/" . $e->getCode(),$e);
	}
?>
