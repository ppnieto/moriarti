<?php

// rewrite relative urls to match template location
Moriarti::register(1,'/on/render/*',function($code,$data) {
  $xpath = new DOMXPath($data);
  $template = Moriarti::get('plugins/template')['data']['active'];
  $notSrcAbs = "[not(starts-with(@src, 'http'))]";
  $notHrefAbs = "[not(starts-with(@href, 'http'))]";
  // rewrite <link href> <script src> and <img src> with relative urls
  $linkhrefs = $xpath->query("//link$notHrefAbs/@href | //script$notSrcAbs/@src | //img$notSrcAbs/@src");
  foreach($linkhrefs as $linkhref) {
    // add prefix with right location
    $linkhref->nodeValue = "/plugins/template/$template/layout/" . $linkhref->nodeValue;
  }
});
?>
