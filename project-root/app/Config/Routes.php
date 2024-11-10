<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

// Default route
$routes->get('/', 'Home::index');

// Blog API routes
$routes->get('blogs', 'BlogController::index'); // Get all blogs
$routes->get('blogs/(:num)', 'BlogController::show/$1'); // Get a single blog by ID
$routes->post('blogs', 'BlogController::create'); // Create a new blog
$routes->put('blogs/(:num)', 'BlogController::update/$1'); // Update an existing blog by ID
$routes->delete('blogs/(:num)', 'BlogController::delete/$1'); // Delete a blog by ID
