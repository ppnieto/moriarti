<?php

Moriarti::register(9,'/view/adminlte/public/500',function($code,$data) {
  $doc = Moriarti::get('view')->getElementById('titleError')->nodeValue = 'Error';
  $doc = Moriarti::get('view')->getElementById('msgError')->nodeValue = $data->getMessage();
  $doc = Moriarti::get('view')->getElementById('lineError')->nodeValue = $data->getFile() . ' - ' . $data->getLine();
});
?>
