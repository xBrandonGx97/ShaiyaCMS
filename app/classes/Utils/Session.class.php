<?php

namespace Classes\Utils;

use Classes\DB\MSSQL;

class Session
{
    public static $sessionName;

    public static function init($name)
    {
        if (!isset($_SESSION)) {
            // Start our session
            session_name($name);
            session_start();
            setcookie($name, session_id(), 0, '/', null, null, true);
            self::$sessionName = $name;
        }
    }

    public static function doLogin()
    {
    }

    public static function doLogout()
    {
        if (isset($_SESSION['User'])) {
            self::updateLoginStatus(0);
            session_regenerate_id(true);
            unset($_SESSION['User']);
            $referrer = $_SERVER['HTTP_REFERER'];
            //header('location: '.$referrer);
            echo '<script>
				socket.emit("logout", "");
			</script>';
        }
    }

    public static function updateLoginStatus($status)
    {
        $loginStatus = MSSQL::query()
            ->table('WEB_PRESENCE')
            ->update('LoginStatus', ':status')
            ->bind(':status', $status)
            ->bind(':id', Session::get('User', 'UserID'))
            ->where('UserID', ':id');

        /* $sql = ('
                UPDATE ShaiyaCMS.dbo.WEB_PRESENCE
                SET LoginStatus = :status
                WHERE UserID = :id
        ');
        MSSQL::query($sql);
        MSSQL::bind(':status', $status, \PDO::PARAM_INT);
        MSSQL::bind(':id', $_SESSION['User']['UserID'], \PDO::PARAM_STR);
        MSSQL::execute(); */
    }

    public static function put($key, $key2 = false, $value)
    {
        // check if session started on each function
        if (isset($_SESSION)) {
            if (session_name() === self::$sessionName) {
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

    public static function regenerate()
    {
        if (isset($_SESSION)) {
            if (session_name() === self::$sessionName) {
                session_regenerate_id(true);
            }
        }
    }

    public static function has($key)
    {
        if (isset($_SESSION)) {
            if (session_name() === self::$sessionName) {
                if (isset($_SESSION[$key])) {
                    return true;
                }
            }
        }
    }

    public static function get($key, $key2 = false)
    {
        if (isset($_SESSION)) {
            if (session_name() === self::$sessionName) {
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

    public static function exists($key)
    {
        if (isset($_SESSION)) {
            if (session_name() === self::$sessionName) {
                if (isset($_SESSION[$key])) {
                    return true;
                } else {
                    return false;
                }
            }
        }
    }

    public static function all()
    {
        if (isset($_SESSION)) {
            if (session_name() === self::$sessionName) {
                return print_r($_SESSION);
            }
        }
    }

    public static function forget($key)
    {
        if (isset($_SESSION)) {
            if (session_name() === self::$sessionName) {
                if (isset($_SESSION[$key])) {
                    unset($_SESSION[$key]);
                }
            }
        }
    }

    public static function flush()
    {
        if (isset($_SESSION)) {
            if (session_name() === self::$sessionName) {
                session_unset();
                session_destroy();
            }
        }
    }

    public static function save()
    {
    }
}
