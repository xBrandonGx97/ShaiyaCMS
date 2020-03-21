<?php

class CoreController
{
    // Load model
    public static function model($model)
    {
        // Require model file
        require_once $GLOBALS['config']['APPROOT'] . '/models/' . $model . '.php';

        // Instantiate model
        return new $model();
    }

    // Load view
    public static function view($view, $data = [])
    {
        $blade = new BladeController();
        // Load Directives
        $blade->loadDirectives();
        // Load View
        $blade->loadView($view, $data);
    }
}
