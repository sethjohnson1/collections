<?php
//default that LL changed to root path
	Router::connect('/', array('controller' => 'treasures', 'action' => 'index'));
	
	//i wonder if there is a way to not have to make one for each action.. moving on now
	//Router::redirect('/users/login', array('controller' => 'users', 'plugin' => 'users','action'=>'login'));

//sj - to fix routes to treasures
	Router::redirect('/treasures/', array('controller' => 'treasures', 'action' => 'index'));
	Router::redirect('/treasures', array('controller' => 'treasures', 'action' => 'index'));
	
//sj- routes from escaping users
//there must be a better way, but for now its demonstration purposes
/*	Router::redirect('/users/treasures/*', array('controller' => 'treasures', 'action' => 'index'));
	Router::redirect('/users/medvalues/*', array('controller' => 'medvalues', 'action' => 'index'));
	Router::redirect('/users/makers/*', array('controller' => 'makers', 'action' => 'index'));
	Router::redirect('/users/usergals/*', array('controller' => 'usergals', 'action' => 'index'));
	*/
//end sj

	Router::connect('/auth_login/*', array( 'plugin'=>'users','controller' => 'users', 'action' => 'auth_login'));
	Router::connect('/auth_callback/*', array( 'plugin'=>'users','controller' => 'users', 'action' => 'auth_callback'));
	Router::redirect('/contest', array('controller' => 'treasures', 'action' => 'contest'));
	Router::redirect('/seth\'s_beaded_trucker_hat', array('controller' => 'pages', 'action' => 'seth\'s_beaded_trucker_hat'));
	
	Router::parseExtensions('json','xml');
	CakePlugin::routes();
	
	
/** BELOW IS CAKEPHP default -- CHANGE IF YOU MUST
 * ...and connect the rest of 'Pages' controller's URLs.
 */
	Router::connect('/pages/*', array('controller' => 'pages', 'action' => 'display'));

/**
 * Load the CakePHP default routes. Only remove this if you do not want to use
 * the built-in default routes.
 */
	require CAKE . 'Config' . DS . 'routes.php';
