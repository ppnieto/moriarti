<?php

Moriarti::register(0,'/http/*',function($code,$data) {
	$view = substr($code,strrpos($code,"/")+1);// implode('/',$tmp);
	$exclude = Moriarti::get('plugins/firewall')['data']['exclude'];
	if (!isset($_SESSION['USER']) && !in_array($view,$exclude)) {
		header("Location: login");
		die;
	}
});

?>
