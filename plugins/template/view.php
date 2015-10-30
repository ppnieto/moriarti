<?php

// ending 'http' message, starts for processing new 'view' message
Moriarti::register(10,'/http/*',function($code,$data) {
	$res = explode('/',$code)[3];
	if ($res == '') $res = 'index';
	$template = Moriarti::get('plugins/template')['data']['active'];
	$layout = Moriarti::get('layout');
	new Message("/view/$template/$layout/$res");
});

// load DOM layout
Moriarti::register(1,'/view/*/*/*',function($code,$data) {
	$template = explode('/',$code)[2];
	$layout = explode('/',$code)[3];

	$filename = dirname(__FILE__) . "/$template/layout/$layout.html";

	if(file_exists($filename)) {
		Moriarti::store('view',DOMUtil::loadHTMLFile($filename));
	} else {
		throw new Exception("No existe layout " . $layout);
	}
});

// write out processed view and layout
Moriarti::register(10,'/view/*/*/*',function($code,$data) {
	$view = explode('/',$code)[4];
	$doc = Moriarti::get('view');
	// pre render event
	$m = new Message("/on/render/$view",$doc);	
	// write out view to client
	echo $doc->saveHTML();
});


?>
