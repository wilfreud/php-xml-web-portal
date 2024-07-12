<?php
require_once 'controllers/CinemaController.php';
require_once 'controllers/RestaurantController.php';

$base_path = dirname($_SERVER['SCRIPT_NAME']);

$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$uri = trim(str_replace(trim($base_path, '/'), '', $uri), '/');
$uriSegments = explode('/', $uri);

$cinemaController = new CinemaController();
$restaurantController = new RestaurantController();

$controller_index = 0;

if (!empty($uriSegments[$controller_index])) {
    $controller = $uriSegments[$controller_index];
    $action = $uriSegments[$controller_index + 1] ?? null;
    $id = $uriSegments[$controller_index + 2] ?? null;

    switch ($controller) {
        case 'cinema':
            handleCinemaController($cinemaController, $action, $id);
            break;
        case 'restaurant':
            handleRestaurantController($restaurantController, $action, $id);
            break;
        default:
            render404();
            break;
    }
} else {
    render404();
}

function handleCinemaController($controller, $action, $id)
{
    if ($action) {
        if (is_numeric($action)) {
            $controller->edit($action);
        } elseif ($action === 'delete') {
            $controller->deleteMovie($id);
        } elseif ($action === 'edit') {
            $controller->edit($id);
        } else {
            $controller->index();
        }
    } else {
        $controller->index();
    }
}

function handleRestaurantController($controller, $action, $id)
{
    if ($action) {
        if (is_numeric($id)) {
            if ($action === 'details') {
                $controller->details($id);
            } elseif ($action === 'edit') {
                $controller->edit($id);
            } elseif ($action === 'delete') {
                $controller->deleteRestaurant($id);
            } else {
                render404();
            }
        } elseif ($action === 'edit' && $id === 'new') {
            $controller->edit(null); // For creating a new restaurant
        } else {
            render404();
        }
    } else {
        $controller->index();
    }
}

function render404()
{
    require_once "views/errors/404.php";
}
