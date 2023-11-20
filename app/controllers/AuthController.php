<?php

namespace App\Controllers;

use Core\Http\Request;
use Core\Http\{Response, Status};

use App\Services\UsersService;

class AuthController {

    /**
     * The method checking authentification of user
     * 
     * @static
     * @access public
     * @return bool
     */
    public static function isAuth(): bool
    {
        return isset($_SESSION['user_id']) && (int)$_SESSION['user_id'] > 0;
    }

    /**
     * The method checking authentification of user
     * 
     * @param Request $request
     * @access public
     * @return Response
     */
    public function login(Request $request): Response
    {
        if (empty($request->field('login')) || empty($request->field('password'))) {
            return new Response(
                Status::Error, 2,
                'Поля обязательны для заполнения',
            );
        }
        $us = new UsersService;
        
        $fetch = $us->findUser($request->field('login'), $request->field('password'));

        $is = (isset($fetch[0]['id']) && (int)$fetch[0]['id'] > 0)?true:false;

        if ($is) {
            $_SESSION['user_id'] = $fetch[0]['id'];

            return new Response(
                Status::Success, 0,
                'Успешно авторизция',
            );
        } else {
            return new Response(
                Status::Error, 2,
                'Неверные реквизиты доступа',
            );
        }
    }

    /**
     * The method checking authentification of user
     * 
     * @access public
     * @return bool
     */
    public function logout(): bool
    {
        unset($_SESSION['user_id']);

        return empty($_SESSION['user_id']);
    }
    
    /**
     * The method get the user id while authentication
     * 
     * @static
     * @access public
     * @return int
     */
    public static function getUserId(): int
    {
        return (int)$_SESSION['user_id'];
    }
}