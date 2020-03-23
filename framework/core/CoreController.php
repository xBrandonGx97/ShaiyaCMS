<?php

namespace Framework\Core;

class CoreController
{
    // Load model
    public static function model($model)
    {
        // Instantiate model
        return new $model();
    }

    // Load view
    public static function view($view, $data = [])
    {
        $blade = new \Framework\Blade\BladeController('view');
        // Load Directives
        $blade->loadDirectives();
        // Load View
        $blade->loadView($view, $data);
    }

    public static function widget($view, $data = [])
    {
        $blade = new \Framework\Blade\BladeController('widget', $view);
        // Load Directives
        $blade->loadDirectives();
        // Load View
        $blade->loadWidget($view, $data);
    }
}
