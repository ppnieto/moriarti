<?php

Moriarti::register(1,'/http/*',function($tipo,$data) {
	ini_set('display_errors', 1);
	if (isset($_SESSION['USER'])) {
		Moriarti::store('layout','private');
	} else {
		Moriarti::store('layout','public');
	}
});



?>
