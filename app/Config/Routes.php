<?php

$routes ??= service('routes');

$routes->match(['get', 'post'], 'ops/migrate', 'OpsMigrate::run');

$routes->group('', ['filter' => 'session'], static function ($routes) {
    $routes->get('/', 'Empleados::index');
    $routes->resource('empleados', ['placeholder' => '(:num)', 'except' => 'show']);
});

$routes->get('login', 'AuthController::loginView');
$routes->post('login', 'AuthController::loginAction');
$routes->get('register', 'AuthController::registerView');
$routes->post('register', 'AuthController::registerAction');
$routes->post('logout', 'AuthController::logoutAction');

$routes->group('es', static function ($routes) {
	$routes->get('login', 'AuthController::loginView/es');
	$routes->post('login', 'AuthController::loginAction/es');
	$routes->get('register', 'AuthController::registerView/es');
	$routes->post('register', 'AuthController::registerAction/es');
	$routes->post('logout', 'AuthController::logoutAction/es');
});

$routes->group('en', static function ($routes) {
	$routes->get('login', 'AuthController::loginView/en');
	$routes->post('login', 'AuthController::loginAction/en');
	$routes->get('register', 'AuthController::registerView/en');
	$routes->post('register', 'AuthController::registerAction/en');
	$routes->post('logout', 'AuthController::logoutAction/en');
});

$routes->group('es', ['filter' => 'session'], static function ($routes) {
	$routes->get('empleados', 'Empleados::index/es');
	$routes->get('empleados/new', 'Empleados::new/es');
	$routes->post('empleados', 'Empleados::create/es');
	$routes->get('empleados/(:num)/edit', 'Empleados::edit/$1/es');
	$routes->put('empleados/(:num)', 'Empleados::update/$1/es');
	$routes->delete('empleados/(:num)', 'Empleados::delete/$1/es');
});

$routes->group('en', ['filter' => 'session'], static function ($routes) {
	$routes->get('employees', 'Empleados::index/en');
	$routes->get('employees/new', 'Empleados::new/en');
	$routes->post('employees', 'Empleados::create/en');
	$routes->get('employees/(:num)/edit', 'Empleados::edit/$1/en');
	$routes->put('employees/(:num)', 'Empleados::update/$1/en');
	$routes->delete('employees/(:num)', 'Empleados::delete/$1/en');
});
