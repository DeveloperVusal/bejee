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
            'is_done' => (int)$request->field('is_done'),
        ];

        if (!(int)$request->field('id')) {
            $pattern = '/^([a-z0-9_\.-])+@[a-z0-9-]+\.([a-z]{2,10}\.)?[a-z]{2,10}$/i';

            if (!preg_match($pattern, $fields['email'])) {
                return new Response(
                    Status::Error, 3,
                    'E-mail введен некорректно'
                );
            }
        }

        $result = $ts->save($fields, (int)$request->field('id'));

        return new Response(
            Status::Success, 0,
            'Задача успешно сохранена!', $result
        );
    }

    /**
     * The method for delete tasks
     * 
     * @param Request $request
     * @access public
     * @return Response
     */
    public function delete(Request $request): Response
    {
        if ((int)$request->field('id')) {
            $ts = new TasksService();
            $result = $ts->delete((int)$request->field('id'));

            return new Response(
                Status::Success, 0,
                'Задача успешно удалена!', $result
            );
        } else {
            return new Response(
                Status::Error, 2,
                'Id не передан!'
            );
        }
    }

    /**
     * The method for get tasks
     * 
     * @access public
     * @return array
     */
    public function get(Request $request): array
    {
        $ts = new TasksService();

        $sorts = [
            'name' => $request->field('sort-name'),
            'email' => $request->field('sort-email'),
            'is_done' => $request->field('sort-is_done'),
        ];

        $sorts = array_map(function($k, $v) {
            return ($v)?'`'.$k.'` '.strtoupper($v):'';
        }, array_keys($sorts), array_values($sorts));
        $sorts = array_filter($sorts, function($v){
            return !empty($v);
        });

        return $ts->get((int)$request->field('page'), join(',', $sorts));
    }
}