<?php
require_once 'controllers/CinemaController.php';
require_once 'controllers/RestaurantController.php';

$base_path = dirname(__FILE__);

$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$uri = trim($uri, '/');
$uri = str_replace($base_path, '', $uri);

$uriSegments = explode('/', $uri);

$cinemaController = new CinemaController();
$restaurantController = new RestaurantController();

$controller_index = 1;
if (isset($uriSegments[$controller_index]) && $uriSegments[$controller_index] == 'cinema') {
    if (isset($uriSegments[$controller_index + 1])) {
        $cinemaController->edit($uriSegments[$controller_index + 1]);
    } else {
        $cinemaController->index();
    }
} else if (isset($uriSegments[$controller_index]) && $uriSegments[$controller_index] == 'restaurant') {
    if (isset($uriSegments[$controller_index + 1])) {
        $restaurantController->editMenu($uriSegments[$controller_index + 1]);
    } else {
        $restaurantController->index();
    }
} else {
    require_once "views/404.php";
}
