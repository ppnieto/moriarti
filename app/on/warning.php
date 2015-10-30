<?php
Moriarti::register(0,'/on/warning',function($tipo,$data) {
  Moriarti::storeArr('warning',$data);
});
Moriarti::register(0,'/on/info',function($tipo,$data) {
  Moriarti::storeArr('info',$data);
});
Moriarti::register(0,'/on/error',function($tipo,$data) {
  Moriarti::storeArr('error',$data);
});
?>
