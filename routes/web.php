<?php

use Core\Facades\Render\View;
use Vudev\Page\Pagination;
use Core\Http\Request;

use App\Controllers\TasksController;

$requset = new Request();
$query = $_SERVER['REQUEST_URI'];

switch ($query) {
    case '/':
        $tc = new TasksController();
        $result = $tc->get($requset);

        $pagination = new Pagination([
            'count' => $result['count'],
            'current_page' => 1,
            'page_count' => 3,
            'views_page' => 5,
            'query_key' => 'page_n',
            
            // 'temps' => [
            //     'start_text' => 'На старт',
            //     'next_text' => 'вперед',
            //     'classes' => [
            //         'linkpage' => 'pagination_linkpage',
            //         'current' => 'pagination_linkpage_current',
            //         'start' => 'pagination_start',
            //         'next' => 'pagination_next'
            //     ],
            // ]  
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