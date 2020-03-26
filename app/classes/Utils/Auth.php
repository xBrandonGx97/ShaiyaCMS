<?php

namespace Classes\Utils;

class Auth
{
    public function __construct(Session $session)
    {
        $this->session = $session;
        $this->user = new User($this->session);
    }

    // similar to laravels auth class
    public function check()
    {
        // Check if user is logged in
        if ($this->session->has('User')) {
            return true;
        }
    }

    public function guest()
    {
        // Check if user is not logged in
        if (!$this->session->has('User')) {
            return true;
        }
    }

    public function attempt($credentials)
    {
        // Authentication passed
    }

    public function login($user, $remember = false)
    {
        // Log user in
    }

    public function loginUsingId($user, $remember = false)
    {
        // Log user in using their primary id
    }

    public function logout(): void
    {
        // Log user out
        if ($this->session->has('User')) {
            $this->user->updateLoginStatus(0);
            $this->session->regenerate();
            $this->session->forget('User');
            $referrer = $_SERVER['HTTP_REFERER'];
            redirect($referrer);
        }
    }

    public function viaRemember()
    {
        // was authenticated from remember me cookie
    }

    public function get()
    {
        return get_class_methods(get_called_class());
    }
}
