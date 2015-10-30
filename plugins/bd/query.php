<?php

Moriarti::register(1,'/bd/query/*',function($code,$data) {
	$queryName = explode("/",$code)[3];

	$filename = dirname(__FILE__) . '/queries/' . $queryName . '.inc';
	if(file_exists($filename)) {
		ob_start();
		include($filename);
		$query = ob_get_clean();
	} else {
		throw new \Exception("Can't find query " . $queryName);
	}

	$result = Moriarti::get('bd')->prepare($query);
	$result->execute($data);
	Moriarti::store($queryName,$result->fetchAll());

});
?>
