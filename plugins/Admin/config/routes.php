<?php
use Cake\Routing\Router;

Router::plugin('Admin', ['path' => '/administrator'], function ($routes) {
	$routes->extensions(['json', 'xml']);
	$routes->connect('/', ['controller' => 'default', 'action' => 'dashboard']);
	$routes->connect('/candidates', ['controller' => 'users', 'action' => 'candidates']);
    $routes->fallbacks('DashedRoute');
    
});
