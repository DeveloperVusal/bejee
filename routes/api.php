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
                die($isAuth->create());
            } else {
                header('Content-Type: application/json');
                http_response_code(405);
                $resp = new Response(
                    Status::Error, 1,
                    'Invalid method, POST must be passed'
                );
                die($resp->create());
            }

            break;
        case '/api/logout':
            if ($requset->method === 'GET') {
                $ac = new AuthController;
                $isLogout = $ac->logout();

                header('Location: /');

                die;
            } else {
                header('Content-Type: application/json');
                http_response_code(405);
                $resp = new Response(
                    Status::Error, 1,
                    'Invalid method, POST must be passed'
                );
                die($resp->create());
            }
            break;
        case '/api/task-save':
            if ($requset->method === 'PUT') {
                $tc = new TasksController();
                $response = $tc->save($requset);
                die($response->create());
            } else {
                header('Content-Type: application/json');
                http_response_code(405);
                $resp = new Response(
                    Status::Error, 1,
                    'Invalid method, PUT must be passed'
                );
                die($resp->create());
            }

            break;

        case '/api/task-get':
            if ($requset->method === 'GET') {

            } else {
                header('Content-Type: application/json');
                http_response_code(405);
                $resp = new Response(
                    Status::Error, 1,
                    'Invalid method, GET must be passed'
                );
                die($resp->create());
            }

            break;
        case '/api/task-delete':
            if ($requset->method === 'DELETE') {

            } else {
                header('Content-Type: application/json');
                http_response_code(405);
                $resp = new Response(
                    Status::Error, 1,
                    'Invalid method, DELETE must be passed'
                );
                die($resp->create());
            }

            break;
        default:
            header('Content-Type: application/json');
            http_response_code(404);
            $resp = new Response(
                Status::Error, 1,
                '404, Not found'
            );
            die($resp->create());
            break;
    }
}