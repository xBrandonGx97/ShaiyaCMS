<?php

namespace Classes\Utils;

class Post
{

    public function get($key)
    {
        if (isset($_POST[$key])) {
            $result = $_POST[$key];
            return $result;
        }
    }

    public function exists($key)
    {
        if (isset($_POST[$key])) {
            return true;
        } else {
            return false;
        }
    }

    public function all($type = null)
    {
        $result = '<pre>';
            $result .= $this->variables($type, $_POST);
        $result .= '</pre>';
        return $result;
    }

    public function variables($type, $vars)
    {
        switch ($type) {
            case '1':
                return var_dump($vars);
            case '2':
                return print_r($vars);
            default:
                return var_dump($vars);
        }
    }
}
