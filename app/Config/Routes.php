<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');
$routes->get('health', 'HealthCheck::db');
$routes->resource('clients', ['controller' => 'ClientController']);
