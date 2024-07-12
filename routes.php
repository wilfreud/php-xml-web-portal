<?php
require_once 'controllers/CinemaController.php';
require_once 'controllers/RestaurantController.php';

$base_path = dirname($_SERVER['SCRIPT_NAME']);

$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$uri = trim($uri, '/');
$uri = str_replace(trim($base_path, '/'), '', $uri);
$uri = trim($uri, '/');

$uriSegments = explode('/', $uri);

$cinemaController = new CinemaController();
$restaurantController = new RestaurantController();

$controller_index = 0; // Adjusted to start from 0 for simplicity
if (isset($uriSegments[$controller_index])) {
    switch ($uriSegments[$controller_index]) {
        case 'cinema':
            if (isset($uriSegments[$controller_index + 1])) {
                $cinemaController->edit($uriSegments[$controller_index + 1]);
            } else {
                $cinemaController->index(null);
            }
            break;
        case 'restaurant':
            if (isset($uriSegments[$controller_index + 1])) {
                $restaurantController->editMenu($uriSegments[$controller_index + 1]);
            } else {
                $restaurantController->index();
            }
            break;
        default:
            require_once "views/404.php";
            break;
    }
} else {
    require_once "views/404.php";
}
