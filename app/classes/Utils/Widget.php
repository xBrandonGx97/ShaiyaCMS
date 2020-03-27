<?php

namespace Classes\Utils;

use Illuminate\Database\Capsule\Manager as Eloquent;

class Widget
{
    public function display(string $mode = 'right'): object
    {
        $widgets = Eloquent::table(table('widgets'))
            ->select()
            ->where('Enabled', 1)
            ->orderBy('Priority', 'ASC')
            ->get();
        return $widgets;
    }
}
