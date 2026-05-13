<?php

$routes ??= service('routes');

$routes->get('/', 'Empleados::index');
$routes->resource('empleados', ['placeholder' => '(:num)', 'except' => 'show']);

$routes->group('es', static function ($routes) {
	$routes->get('empleados', 'Empleados::index/es');
	$routes->get('empleados/new', 'Empleados::new/es');
	$routes->post('empleados', 'Empleados::create/es');
	$routes->get('empleados/(:num)/edit', 'Empleados::edit/$1/es');
	$routes->put('empleados/(:num)', 'Empleados::update/$1/es');
	$routes->delete('empleados/(:num)', 'Empleados::delete/$1/es');
});

$routes->group('en', static function ($routes) {
	$routes->get('employees', 'Empleados::index/en');
	$routes->get('employees/new', 'Empleados::new/en');
	$routes->post('employees', 'Empleados::create/en');
	$routes->get('employees/(:num)/edit', 'Empleados::edit/$1/en');
	$routes->put('employees/(:num)', 'Empleados::update/$1/en');
	$routes->delete('employees/(:num)', 'Empleados::delete/$1/en');
});
