<?php

use Core\Http\Request;

$query = $_SERVER['REQUEST_URI'];
$requset = new Request();

switch ($query) {
    case '/api/login':
        if ($requset->method === 'POST') {

        } else {
            http_response_code(405);
            echo json_encode([
                'type' => 'error',
                'message' => 'Invalid method, POST must be passed'
            ]);
        }

        break;
    case '/api/logout':
        if ($requset->method === 'POST') {

        } else {
            http_response_code(405);
            echo json_encode([
                'type' => 'error',
                'message' => 'Invalid method, POST must be passed'
            ]);
        }

        break;
    case '/api/task-save':
        if ($requset->method === 'PUT') {

        } else {
            http_response_code(405);
            echo json_encode([
                'type' => 'error',
                'message' => 'Invalid method, PUT must be passed'
            ]);
        }

        break;

    case '/api/task-get':
        if ($requset->method === 'GET') {

        } else {
            http_response_code(405);
            echo json_encode([
                'type' => 'error',
                'message' => 'Invalid method, GET must be passed'
            ]);
        }

        break;
    case '/api/task-delete':
        if ($requset->method === 'DELETE') {

        } else {
            http_response_code(405);
            echo json_encode([
                'type' => 'error',
                'message' => 'Invalid method, DELETE must be passed'
            ]);
        }

        break;
    default:
        http_response_code(404);
        echo "404 Not found";
        break;
}