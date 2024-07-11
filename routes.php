<?php
require 'controllers/CinemaController.php';

// Determine base path dynamically
$base_path = dirname(__FILE__); // Adjust this based on your setup if needed

// Remove base path from URI to get the remaining path
$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$uri = trim($uri, '/');
$uri = str_replace($base_path, '', $uri); // Remove base path

$uriSegments = explode('/', $uri);

$controller = new CinemaController();

$controller_index = 1;
if (isset($uriSegments[$controller_index]) && $uriSegments[$controller_index] == 'cinema') {
    if (isset($uriSegments[$controller_index + 1])) {
        $controller->edit($uriSegments[$controller_index + 1]);
    } else {
        $controller->index();
    }
} else {
    echo "404 Not Found";
}
