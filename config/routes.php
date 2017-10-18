<?php
/**
 * Routes configuration
 *
 * In this file, you set up routes to your controllers and their actions.
 * Routes are very important mechanism that allows you to freely connect
 * different URLs to chosen controllers and their actions (functions).
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */

use Cake\Core\Plugin;
use Cake\Routing\Router;

/**
 * The default class to use for all routes
 *
 * The following route classes are supplied with CakePHP and are appropriate
 * to set as the default:
 *
 * - Route
 * - InflectedRoute
 * - DashedRoute
 *
 * If no call is made to `Router::defaultRouteClass()`, the class used is
 * `Route` (`Cake\Routing\Route\Route`)
 *
 * Note that `Route` does not do any inflections on URLs which will result in
 * inconsistently cased URLs when used with `:plugin`, `:controller` and
 * `:action` markers.
 *
 */
Router::defaultRouteClass('DashedRoute');

Router::scope('/', function ($routes) {
	$routes->extensions(['json', 'xml', 'pdf']);
    /**
     * Here, we are connecting '/' (base path) to a controller called 'Pages',
     * its action called 'display', and we pass a param to select the view file
     * to use (in this case, src/Template/Pages/home.ctp)...
     */
	$routes->connect('/', ['controller' => 'Landing', 'action' => 'view']);
	$routes->connect('/login', ['controller' => 'Users', 'action' => 'login']);
	
	$routes->connect('/projects', ['controller' => 'Projects', 'action' => 'view']);
	$routes->connect('/projects/create', ['controller' => 'Projects', 'action' => 'create']);
	$routes->connect('/projects/edit/*', ['controller' => 'Projects', 'action' => 'edit']);
	$routes->connect('/projects/delete/:id', ['controller' => 'Projects', 'action' => 'delete'],['pass' => ['id']]);
	$routes->connect('/projects/conversation', ['controller' => 'Projects', 'action' => 'conversation']);
	
	
	$routes->connect('/dashboard', ['controller' => 'Dashboard', 'action' => 'view']);
	
	$routes->connect('/delete/*', ['controller' => 'App', 'action' => 'deleteRecord']);
	
	$routes->connect('/daily-report', ['controller' => 'Dailyreports', 'action' => 'view']);
	$routes->connect('/daily-report/edit/*', ['controller' => 'Dailyreports', 'action' => 'edit']);
	$routes->connect('/daily-report/delete/:id', ['controller' => 'Dailyreports', 'action' => 'delete'],['pass' => ['id']]);
	
	$routes->connect('/members', ['controller' => 'Employers', 'action' => 'view']);
	$routes->connect('/members/edit/*', ['controller' => 'Employers', 'action' => 'edit']);
	$routes->connect('/members/delete/:id', ['controller' => 'Employers', 'action' => 'delete'],['pass' => ['id']]);
    $routes->connect('/workers/:id/:projectid', ['controller' => 'Employers', 'action' => 'workers'],['pass' => ['id','projectid']]);
	
	$routes->connect('/documents', ['controller' => 'Activity', 'action' => 'document-view']);
	$routes->connect('/documents/create', ['controller' => 'Activity', 'action' => 'document-create']);
	
	$routes->connect('/screenshots', ['controller' => 'Activity', 'action' => 'screenshot-view']);
	$routes->connect('/screenshots/:id', ['controller' => 'Activity', 'action' => 'screenshot-view'],['pass' => ['id']]);
	$routes->connect('/screenshots/:id/:filedate', ['controller' => 'Activity', 'action' => 'screenshot-view'],['pass' => ['id','filedate']]);
	$routes->connect('/screenshots/create', ['controller' => 'Activity', 'action' => 'screenshot-create']);
	$routes->connect('/screenshotDetails/', ['controller' => 'Screenshots', 'action' => 'screenshotDetails']);
	
	
	$routes->connect('/activites', ['controller' => 'Activity', 'action' => 'view']);
	$routes->connect('/description', ['controller' => 'Employers', 'action' => 'description']);
	$routes->connect('/weekly-report', ['controller' => 'Employers', 'action' => 'weeklyReport']);
	
	
    $routes->connect('/upload-document', ['controller' => 'Employers', 'action' => 'uploadDocument']);
    $routes->connect('/list-document', ['controller' => 'Employers', 'action' => 'listDocument']);
	
	/*TimeSheet*/
	$routes->connect('/timesheet', ['controller' => 'Timesheet', 'action' => 'index']);
	$routes->connect('/new-timesheet', ['controller' => 'Timesheet', 'action' => 'newTimesheet']);
	$routes->connect('/edit-timesheet', ['controller' => 'Timesheet', 'action' => 'editTimesheet']);
	
    $routes->connect('/chat/*', ['controller' => 'Conversation', 'action' => 'chat']);
    $routes->connect('/conversation/*', ['controller' => 'Conversation', 'action' => 'conversation']);
	/*Bugs*/
    $routes->connect('/bug-sheet/*', ['controller' => 'Bugs', 'action' => 'bugSheet']);
    $routes->connect('/new-bug/*', ['controller' => 'Bugs', 'action' => 'newBug']);
    $routes->connect('/edit-bug/*', ['controller' => 'Bugs', 'action' => 'editBug']);
    $routes->connect('/bugchat/*', ['controller' => 'Conversation', 'action' => 'bugchat']);
	
	/*Features*/
    $routes->connect('/feature-list/*', ['controller' => 'Features', 'action' => 'featureList']);
    $routes->connect('/new-feature/*', ['controller' => 'Features', 'action' => 'newFeature']);
    $routes->connect('/edit-feature/*', ['controller' => 'Features', 'action' => 'editFeature']);
    $routes->connect('/featurechat/*', ['controller' => 'Conversation', 'action' => 'Featurechat']);
	
	
	/*Tasks*/
    $routes->connect('/task-list/*', ['controller' => 'Tasks', 'action' => 'taskList']);
    $routes->connect('/new-task/*', ['controller' => 'Tasks', 'action' => 'newTask']);
    $routes->connect('/edit-task/*', ['controller' => 'Tasks', 'action' => 'editTask']);
    $routes->connect('/taskchat/*', ['controller' => 'Conversation', 'action' => 'Taskchat']);
	
	
	/*bTrack*/
    $routes->connect('/brands/*', ['controller' => 'Brands', 'action' => 'view']);
	$routes->connect('/brandDetails/', ['controller' => 'Brands', 'action' => 'brandDetails']);
	$routes->connect('/linkedinDetails/', ['controller' => 'Brands', 'action' => 'linkedinDetails']);
	$routes->connect('/saveSearch/', ['controller' => 'Brands', 'action' => 'saveSearch']);
	$routes->connect('/subscribe/', ['controller' => 'Brands', 'action' => 'subscribe']);
	
	$routes->connect('/facebook/*', ['controller' => 'Facebook', 'action' => 'view']);
	$routes->connect('/facebookDetails/*', ['controller' => 'Facebook', 'action' => 'facebookDetails']);
	
	$routes->connect('/linkedin/*', ['controller' => 'Linkedin', 'action' => 'view']);
	$routes->connect('/linkedinDetails/*', ['controller' => 'Linkedin', 'action' => 'linkedinDetails']);

	
	/*financial*/
    $routes->connect('/financial/', ['controller' => 'Financial', 'action' => 'project-budget']);
    $routes->connect('/financial/budget-calculation', ['controller' => 'Financial', 'action' => 'budget-calculation']);
    $routes->connect('/financial/project-budget', ['controller' => 'Financial', 'action' => 'project-budget']);
    $routes->connect('/financial/view-pdf/*', ['controller' => 'Financial', 'action' => 'view-pdf']);
	 $routes->connect('/financial/edit', ['controller' => 'Financial', 'action' => 'edit']);
	

	
    //~ $routes->connect('/', ['controller' => 'Homes', 'action' => 'index']);
    //~ $routes->connect('/dashboard', ['controller' => 'Homes', 'action' => 'dashboard']);
    $routes->connect('/login', ['controller' => 'Users', 'action' => 'login']);
    $routes->connect('/logout', ['controller' => 'Users', 'action' => 'logout']);
    $routes->connect('/recover/*', ['controller' => 'Users', 'action' => 'recover']);
	//$routes->connect('Clients/create/*', ['controller' => 'Clients', 'action' => 'create']);
	$routes->connect('/clients/create', ['controller' => 'Clients', 'action' => 'create']);
	$routes->connect('/clients/', ['controller' => 'Clients', 'action' => 'view']);
	$routes->connect('/clients/edit/*', ['controller' => 'Clients', 'action' => 'edit']);
	$routes->connect('/clients/delete/:id', ['controller' => 'Clients', 'action' => 'delete'],['pass' => ['id']]);

    // $routes->connect('/change-password', ['controller' => 'Users', 'action' => 'changePassword']);

    /**
     * Connect catchall routes for all controllers.
     *
     * Using the argument `DashedRoute`, the `fallbacks` method is a shortcut for
     *    `$routes->connect('/:controller', ['action' => 'index'], ['routeClass' => 'DashedRoute']);`
     *    `$routes->connect('/:controller/:action/*', [], ['routeClass' => 'DashedRoute']);`
     *
     * Any route class can be used with this method, such as:
     * - DashedRoute
     * - InflectedRoute
     * - Route
     * - Or your own route class
     *
     * You can remove these routes once you've connected the
     * routes you want in your application.
     */
    $routes->fallbacks('DashedRoute');
});
/**
 * Load all plugin routes.  See the Plugin documentation on
 * how to customize the loading of plugin routes.
 */
Plugin::routes();
