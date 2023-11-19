<?php

use Core\Facades\Render\View;
use Vudev\Page\Pagination;
use Core\Http\Request;

use App\Controllers\TasksController;

$request = new Request();
$query = parse_url($_SERVER['REQUEST_URI']);
$query = $query['path'] ?? '';

switch ($query) {
    case '/':
        $tc = new TasksController();
        $result = $tc->get($request);

        $pagination = new Pagination([
            'count' => $result['count'],
            'current_page' => (int)$request->field('page'),
            'page_count' => 3,
            'views_page' => 5,
        ]);

        View::get('todo', 'index.htm.php', [
            'data' => $result['list'],
            'pagination' => $pagination,
        ]);

        break;
    
    default:
        http_response_code(404);
        echo "404 Not found";
        break;
}