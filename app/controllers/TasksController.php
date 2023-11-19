<?php

namespace App\Controllers;

use App\Services\TasksService;
use Core\Http\Request;
use Core\Http\{Response, Status};

class TasksController {

    /**
     * The method for add or save tasks
     * 
     * @param Request $request
     * @access public
     * @return Response
     */
    public function save(Request $request): Response
    {
        $ts = new TasksService();

        $fields = [
            'name' => htmlspecialchars($request->field('name')),
            'email' => $request->field('email'),
            'text' => htmlspecialchars($request->field('text')),
        ];

        $result = $ts->save($fields);

        return new Response(
            Status::Success, 0,
            'Задача успешно сохранена!', $result
        );
    }

    /**
     * The method for get tasks
     * 
     * @access public
     * @return array
     */
    public function get(): array
    {
        $ts = new TasksService();

        return $ts->get();
    }
}