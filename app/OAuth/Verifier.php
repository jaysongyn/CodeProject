<?php
/**
 * Created by PhpStorm.
 * User: jayson.inf
 * Date: 31/07/2015
 * Time: 21:28
 */

namespace CodeProject\OAuth;

use Auth;

class Verifier
{
    public function verify($username, $password)
    {
        $credentials = [
            'email'    => $username,
            'password' => $password,
        ];

        if (Auth::once($credentials)) {
            return Auth::user()->id;
        }

        return false;
    }
}