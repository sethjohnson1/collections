<?php

// sj - Load composer autoload
require APP . 'Vendor/autoload.php';

Cache::config('default', array('engine' => 'File'));

 
 CakePlugin::load(array(
 'DebugKit',
 //'Chosen',
 'Search',
 'Utils',
 //'Users',
 //'Comments'
 ));
 
 CakePlugin::load('Users', array('routes' => true));
 CakePlugin::load('ExtAuth');
 
 //needs to move to global config file...
 Configure::write('App.defaultEmail', 'forms@centerofthewest.org');

Configure::write('Dispatcher.filters', array(
	'AssetDispatcher',
	'CacheDispatcher'
));

/**
 * Configures default file logging options
 */
App::uses('CakeLog', 'Log');
CakeLog::config('debug', array(
	'engine' => 'File',
	'types' => array('notice', 'info', 'debug'),
	'file' => 'debug',
));
CakeLog::config('error', array(
	'engine' => 'File',
	'types' => array('warning', 'error', 'critical', 'alert', 'emergency'),
	'file' => 'error',
));

/**
 * Private unified config 
 */


App::uses('PhpReader', 'Configure');
if (file_exists(ROOT . DS . APP_DIR . DS . 'Config' . DS . 'private.php')) {
  Configure::config('default', new PhpReader());
  Configure::load('private');
}
else {
  echo 'ROOT: '.ROOT.'<br>';
  echo 'APP_DIR: '.APP_DIR.'<br>';
  throw new CakeException('ROOT/APP_DIR/Config/private.php not found.  You must create this file from the template APP_DIR/Config/private_sample.php');
}