<?php

$config = array(
  'database' => array(
    'test' => array(
      'datasource' => 'Database/Mysql',
      'persistent' => false,
      'host' => 'localhost',
      'login' => 'root',
      'password' => '',
      'database' => '',
    ),
    'default' => array(
      'datasource' => 'Database/Mysql',
      'persistent' => false,
      'host' => 'localhost',
      'login' => 'root',
      'password' => '',
      'database' => 'oc_dl',
    ),
  )
);


Configure::write('debug', 2);
Configure::write('Security.salt', 'qwewrtyuiop123');
Configure::write('Security.cipherSeed', '987654321');
Configure::write('bitlyAPIkey','R_96a646d39d544d10a44ac55801d25c30');

?>
