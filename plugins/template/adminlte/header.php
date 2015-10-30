<?php

Moriarti::register(3,'/view/adminlte/private/*',function($code,$data) {
    foreach(DOMUtil::xpathQuery("//text()[. = 'USER_NAME']") as $userName) {
      $userName->nodeValue=$_SESSION['USER']['NAME'];
    }
});

?>
