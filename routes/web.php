<?php

use Core\Facades\Render\View;
use Vudev\Page\Pagination;
use Core\Http\Request;

use App\Controllers\AuthController;
use App\Controllers\TasksController;

$request = new Request();
$query = parse_url($_SERVER['REQUEST_URI']);
$query = $query['path'] ?? '';
preg_match('/^\/api/m', $query, $matches);

if (!sizeof($matches)) {
    switch ($query) {
        case '/':
            $ac = new AuthController();
            $tc = new TasksController();
            $result = $tc->get($request);

            $pagination = new Pagination([
                'count' => $result['count'],
                'current_page' => (int)$request->field('page'),
                'page_count' => 3,
                'views_page' => 5,
            ]);

            View::get('todo', 'index.htm.php', [
                'auth' => $ac,
                'data' => $result['list'],
                'pagination' => $pagination,
            ]);

            break;
        
        case '/auth':
            if (AuthController::isAuth()) {
                header('Location: /');
            }

            View::get('todo', 'auth.htm.php');

            break;
        default:
            http_response_code(404);
            echo "404 Not found";
            break;
    }
}