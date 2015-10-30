<?php

Moriarti::register(1,'/http/*',function($tipo,$data) {
  if (isset($_GET['lang'])) {
    $_SESSION['lang'] = $_GET['lang'];
  }
});

Moriarti::register(1,'/on/render/*',function($code,$data) {
  if (isset($_SESSION['lang'])) {
    $lang = $_SESSION['lang'];
  } else {
    $lang = substr($_SERVER['HTTP_ACCEPT_LANGUAGE'], 0, 2);
  }

  $view = explode('/',$code)[3];

  $xpath = new DOMXPath($data);
  // translate all texts
  $translations = Moriarti::get('plugins/template-translation')['data']['translations'];
  $texts = $xpath->evaluate('//text()[not(parent::script)][string-length() > 0]');
  foreach ($texts as $node) {
    $key = trim($node->nodeValue);
    if ($key == '') continue;
    if (isset($translations[$lang][$key])) {
      $node->nodeValue= $translations[$lang][$key];
    }
    if (isset($translations[$lang . '/' . $view][$key])) {
      $node->nodeValue= $translations[$lang . '/' . $view][$key];
    }
  }
});


?>
