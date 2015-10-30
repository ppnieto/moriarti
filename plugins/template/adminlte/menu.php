<?php
Moriarti::register(9,'/view/adminlte/private/*',function($code,$data) {
  $view = explode('/',$code)[4];

  $doc = Moriarti::get('view');
  $list = DOMUtil::findElementsByClassName('sidebar-menu')->item(0);
  $item = $list->firstChild;
  foreach(Moriarti::get('userMenu') as $menu) {
    $menuref = str_replace(' ', '',strtolower($menu));
    $newItem = $item->cloneNode(true);
    $list->appendChild($newItem);
    DOMUtil::xpathQuery('.//span',$newItem)->item(0)->nodeValue=$menu;
    DOMUtil::xpathQuery('.//a/@href',$newItem)->item(0)->nodeValue=$menuref;
    if ($view === $menuref) {
      $newItem->setAttribute('class','active');
    }
  }
  $item->parentNode->removeChild($item);
});

?>
