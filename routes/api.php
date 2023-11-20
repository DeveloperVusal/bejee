<?php

use App\Controllers\AuthController;
use App\Controllers\TasksController;
use Core\Http\Request;
use Core\Http\Response;
use Core\Http\Status;

$query = $_SERVER['REQUEST_URI'];
$requset = new Request();

preg_match('/^\/api/m', $query, $matches);

if (sizeof($matches)) {
    switch ($query) {
        case '/api/login':
            if ($requset->method === 'POST') {
                $ac = new AuthController;
                $isAuth = $ac->login($requset);

                echo $isAuth->create();
                exit;
            } else {
                header('Content-Type: application/json');
                http_response_code(405);
                $resp = new Response(
                    Status::Error, 1,
                    'Invalid method, POST must be passed'
                );
                echo $resp->create();
                exit;
            }

            break;
        case '/api/logout':
            if ($requset->method === 'GET') {
                $ac = new AuthController;
                $isLogout = $ac->logout();

                header('Location: /');

                exit;
            } else {
                header('Content-Type: application/json');
                http_response_code(405);
                $resp = new Response(
                    Status::Error, 1,
                    'Invalid method, POST must be passed'
                );
                echo $resp->create();
                exit;
            }
            break;
        case '/api/task-save':
            if ($requset->method === 'PUT') {
                if (AuthController::isAuth()) {
                    $tc = new TasksController();
                    $response = $tc->save($requset);

                    echo $response->create();
                    exit;
                } else {
                    http_response_code(401);
                    die;
                }
            } else {
                header('Content-Type: application/json');
                http_response_code(405);
                $resp = new Response(
                    Status::Error, 1,
                    'Invalid method, PUT must be passed'
                );
                echo $resp->create();
                exit;
            }

            break;
        case '/api/task-delete':
            if ($requset->method === 'POST') {
                if (AuthController::isAuth()) {
                    $tc = new TasksController();
                    $response = $tc->delete($requset);

                    echo $response->create();
                    exit;
                } else {
                    http_response_code(401);
                    die;
                }
            } else {
                header('Content-Type: application/json');
                http_response_code(405);
                $resp = new Response(
                    Status::Error, 1,
                    'Invalid method, PUT must be passed'
                );
                echo $resp->create();
                exit;
            }

            break;
        default:
            header('Content-Type: application/json');
            http_response_code(404);
            $resp = new Response(
                Status::Error, 1,
                '404, Not found'
            );
            echo $resp->create();
            exit;
            break;
    }
}