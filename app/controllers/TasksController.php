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

        $result = $ts->save();

        return new Response(
            Status::Success, 0,
            'Successfully', $result
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