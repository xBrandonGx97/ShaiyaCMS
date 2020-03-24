<?php

namespace Framework\Core;

class CoreController
{
    // Load model
    public function model($model)
    {
        // Instantiate model
        return new $model();
    }

    // Load view
    public function view($view, $data = [])
    {
        $blade = new \Framework\Blade\BladeController('view');
        // Load Directives
        $blade->loadDirectives();
        // Load View
        $blade->loadView($view, $data);
    }

    // Load widget
    public function widget($view, $data = [])
    {
        $blade = new \Framework\Blade\BladeController('widget', $view);
        // Load Directives
        $blade->loadDirectives();
        // Load View
        $blade->loadWidget($view, $data);
    }
}
