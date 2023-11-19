<?php

namespace App\Controllers;

use Core\Http\Request;

use App\Services\UsersService;

class AuthController {

    /**
     * The method checking authentification of user
     * 
     * @access public
     * @return bool
     */
    public function isAuth(): bool
    {
        return isset($_SESSION['user_id']) && (int)$_SESSION['user_id'] > 0;
    }

    /**
     * The method checking authentification of user
     * 
     * @access public
     * @return bool
     */
    public function login(Request $request): bool
    {
        $us = new UsersService;
        
        $us->findUser($request->field('login'), $request->field('password'));

        return isset($_SESSION['user_id']) && (int)$_SESSION['user_id'] > 0;
    }

    /**
     * The method checking authentification of user
     * 
     * @access public
     * @return bool
     */
    public function logout(): bool
    {
        unlink($_SESSION['user_id']);

        return empty($_SESSION['user_id']);
    }
}