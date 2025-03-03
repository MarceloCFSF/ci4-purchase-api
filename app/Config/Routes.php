<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('health', 'HealthCheck::db');
$routes->resource('clients', ['controller' => 'ClientController']);
$routes->resource('products', ['controller' => 'ProductController']);
$routes->resource('purchases', ['controller' => 'PurchaseController']);
