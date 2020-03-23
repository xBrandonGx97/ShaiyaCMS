<?php

namespace Classes\Utils;

class Auth
{
    // similar to laravels auth class
    public static function check()
    {
        // Check if user is logged in
        if (Session::has('User')) {
            return true;
        }
    }

    public static function guest()
    {
        // Check if user is not logged in
        if (!Session::has('User')) {
            return true;
        }
    }

    public static function attempt($credentials)
    {
        // Authentication passed
    }

    public static function login($user, $remember = false)
    {
        // Log user in
    }

    public static function loginUsingId($user, $remember = false)
    {
        // Log user in using their primary id
    }

    public static function logout()
    {
        // Log user out
        if (Session::has('User')) {
            User::updateLoginStatus(0);
            Session::regenerate();
            Session::forget('User');
            $referrer = $_SERVER['HTTP_REFERER'];
            redirect($referrer);
        }
    }

    public static function viaRemember()
    {
        // was authenticated from remember me cookie
    }

    public static function _get()
    {
        return get_class_methods(get_called_class());
    }
}
