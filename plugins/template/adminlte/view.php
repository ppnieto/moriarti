<?php

Moriarti::register(2,'/view/adminlte/*/*',function($code,$data) {
  $viewName = explode('/',$code)[4];
  $filename = dirname(__FILE__) . "/view/$viewName.html";
  if(file_exists($filename)) {
    $doc = Moriarti::get('view');
    $content = file_get_contents($filename);
    DOMUtil::importDOM($doc->getElementById('contentFragment'),DOMUtil::parseHTML($content));
  }
});


?>
