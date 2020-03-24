<?php

namespace Classes\Utils;

class Session
{
    private $sessionName;
    private $name = config['sessionName'];
    // later set session name in env/config file

    public function __construct()
    {
        if (!isset($_SESSION)) {
            // Start our session
            session_name($this->name);
            session_start();
            setcookie($this->name, session_id(), 0, '/', null, null, true);
        }
        $this->sessionName = $this->name;
    }

    public function put($key, $key2 = false, $value)
    {
        // check if session started on each function
        if (isset($_SESSION)) {
            if (session_name() === $this->sessionName) {
                if ($key2 || !empty($key2)) {
                    if (!isset($_SESSION[$key][$key2])) {
                        $_SESSION[$key][$key2] = $value;
                    }
                } else {
                    if (isset($_SESSION[$key])) {
                        $_SESSION[$key] = $value;
                    }
                }
            }
        }
    }

    public function regenerate()
    {
        if (isset($_SESSION)) {
            if (session_name() === $this->sessionName) {
                session_regenerate_id(true);
            }
        }
    }

    public function has($key)
    {
        if (isset($_SESSION)) {
            if (session_name() === $this->sessionName) {
                if (isset($_SESSION[$key])) {
                    return true;
                }
                return false;
            }
        }
    }

    public function get($key, $key2 = false)
    {
        if (isset($_SESSION)) {
            if (session_name() === $this->sessionName) {
                if ($key2) {
                    if (isset($_SESSION[$key][$key2])) {
                        return $_SESSION[$key][$key2];
                    }
                } else {
                    if (isset($_SESSION[$key])) {
                        if (is_array($_SESSION[$key])) {
                            $result = var_dump($_SESSION[$key]);
                        } else {
                            echo $result = $_SESSION[$key];
                        }
                        return $result;
                    }
                }
            }
        }
    }

    public function exists($key)
    {
        if (isset($_SESSION)) {
            if (session_name() === $this->sessionName) {
                if (isset($_SESSION[$key])) {
                    return true;
                } else {
                    return false;
                }
            }
        }
    }

    public function all()
    {
        if (isset($_SESSION)) {
            if (session_name() === $this->sessionName) {
                return print_r($_SESSION);
            }
        }
    }

    public function forget($key)
    {
        if (isset($_SESSION)) {
            if (session_name() === $this->sessionName) {
                if (isset($_SESSION[$key])) {
                    unset($_SESSION[$key]);
                }
            }
        }
    }

    public function flush()
    {
        if (isset($_SESSION)) {
            if (session_name() === $this->sessionName) {
                session_unset();
                session_destroy();
            }
        }
    }

    public function save()
    {
    }
}
