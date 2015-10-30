<?php

Moriarti::register(1,'/view/adminlte/private/*',function($code,$data) {
  Moriarti::store('userMenu',['Control Panel','Profile','Settings']);
});

?>
