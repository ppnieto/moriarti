<?php

Moriarti::register(3,'/view/adminlte/private/*',function($code,$data) {
  $doc = Moriarti::get('view');
  DOMUtil::findElementsByClassName('messages-text')->item(0)->nodeValue='Tienes 100 mensajes';
  DOMUtil::findElementsByClassName('messages-count')->item(0)->nodeValue=100;
});

?>
