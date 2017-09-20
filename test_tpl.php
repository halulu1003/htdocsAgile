<?php
  require 'Tpl.class.php';
   
  $tpl = new Tpl();
  $tplarr = array(
      'name'=>'waited',
      'age'=>'100'
    );
  $tpl->assign($tplarr);
  $tpl->assign('message','this is a demo');
  $tpl->display('testTpl.html');
 
?>