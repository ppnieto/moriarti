<?php

Moriarti::register(0,'/bd/*',function($tipo,$data) {
  $settings = Moriarti::get('plugins/bd');

  $bd = new PDO('mysql:host=' . $settings['data']['host'] . ';dbname=' . $settings['data']['database'], $settings['data']['user'], $settings['data']['password']);

  $bd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  $bd->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);

  Moriarti::store('bd',$bd);
});

?>
