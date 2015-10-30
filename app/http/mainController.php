<?php

Moriarti::register(1,'/http/*',function($tipo,$data) {
	if (isset($_SESSION['USER'])) {
		Moriarti::store('layout','private');
	} else {
		Moriarti::store('layout','public');
	}
});



?>
