<?php
Moriarti::register(0,'/on/exception/*',function($tipo,$data) {
  new Message('/view/adminlte/public/500',$data);
});
 ?>
