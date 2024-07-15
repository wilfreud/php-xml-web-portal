<?php
require_once 'controllers/CinemaController.php';
require_once 'controllers/RestaurantController.php';
require_once 'controllers/AuthController.php';
session_start();

$base_path = dirname($_SERVER['SCRIPT_NAME']);

$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$uri = trim(str_replace(trim($base_path, '/'), '', $uri), '/');
$uriSegments = explode('/', $uri);

$cinemaController = new CinemaController();
$restaurantController = new RestaurantController();
$authController = new AuthController();


$controller_index = 0;

if (!empty($uriSegments[$controller_index])) {
    $controller = $uriSegments[$controller_index];
    $action = $uriSegments[$controller_index + 1] ?? null;
    $id = $uriSegments[$controller_index + 2] ?? null;

    switch ($controller) {
        case "":
            $authController->home();
            break;
        case 'cinema':
            handleCinemaController($cinemaController, $action, $id);
            break;
        case 'restaurant':
            handleRestaurantController($restaurantController, $action, $id);
            break;
        case 'login':
            $authController->login();
            break;
        case 'logout':
            $authController->logout();
            break;
        default:
            render404();
            break;
    }
} else {
    $authController->home();
}

function handleCinemaController($controller, $action, $id)
{
    if ($action || $action == 0) {
        if (is_numeric($action)) {
            $controller->edit($action);
        } elseif ($action === 'delete') {
            $controller->deleteMovie($id);
        } elseif ($action === 'edit') {
            $controller->edit($action);
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
        } elseif ($action === 'edit') {
            $controller->edit($action);
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
