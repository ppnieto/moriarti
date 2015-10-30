<?php

Moriarti::register(1,'/http/*/login',function($tipo,$data) {
	Moriarti::store('layout','login');
});


Moriarti::register(1,'/http/POST/login',function($tipo,$data) {
	$user = $_POST["username"];
	$pass = $_POST["password"];
	$encrypted_password = sha1($pass);
	new Message("/bd/query/validateLogin",[':name'=>$user,':password'=>$pass]);

	if (!empty(Moriarti::get('validateLogin'))) {
		$_SESSION['USER'] = Moriarti::get('validateLogin')[0];
		header("Location: .");die;
	} else {
		new Message("/on/warning","User or password incorrect");
	}
});

Moriarti::register(1,'/http/GET/logout',function($code,$data) {
	session_destroy();
	header("Location: .");die;
});
?>
