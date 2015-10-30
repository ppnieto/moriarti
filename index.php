<?php
	require_once("classes/Autoloader.php");
	session_start();
	ini_set('display_errors', 1);
	try {
		new Message("/http/" . $_SERVER['REQUEST_METHOD'] . strtok($_SERVER["REQUEST_URI"],'?'));
	} catch (Exception $e) {
		//print_r($e);die;
		new Message("/on/exception/" . $e->getCode(),$e);
	}
	unset($_SESSION['VIEW']);
	unset($_SESSION['DATA']);
?>
