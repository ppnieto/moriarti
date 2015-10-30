<?php
Moriarti::register(9,'/view/adminlte/*',function($code,$data) {
  // show warnings
  $doc = Moriarti::get('view');
  $notifications = $doc->getElementByID('notifications');
  if ($notifications != null) {
    $content = file_get_contents(__DIR__ . '/view/notifications/warning.html');
    $warningDoc = DOMUtil::parseHTML($content);
    foreach(Moriarti::getArr('warning') as $warningTxt) {
      DOMUtil::findElementsByClassName('warning-message',$warningDoc)->item(0)->nodeValue=$warningTxt;
      DOMUtil::importDOM($notifications,$warningDoc);
    }

    $content = file_get_contents(__DIR__ . '/view/notifications/error.html');
    $errorDoc = DOMUtil::parseHTML($content);
    foreach(Moriarti::getArr('error') as $errorTxt) {
      DOMUtil::findElementsByClassName('error-message',$errorDoc)->item(0)->nodeValue=$errorTxt;
      DOMUtil::importDOM($notifications,$errorDoc);
    }

    $content = file_get_contents(__DIR__ . '/view/notifications/info.html');
    $infoDoc = DOMUtil::parseHTML($content);
    foreach(Moriarti::getArr('info') as $infoTxt) {
      DOMUtil::findElementsByClassName('info-message',$infoDoc)->item(0)->nodeValue=$infoTxt;
      DOMUtil::importDOM($notifications,$infoDoc);
    }
  }

});
?>
