<?php

namespace Classes\Settings;

use Illuminate\Database\Capsule\Manager as Eloquent;
use Classes\Utils;

class Settings
{
    public function __construct(Utils\Session $session)
    {
        $this->session = $session;
        $settings = [];
        $datas = Eloquent::table(table('CMS_MAIN'))
            ->select()
            ->get();
        foreach ($datas as $data) {
            $settings[$data->SETTING] = $data->VALUE;
        }
        $this->session->put('Settings', $settings);
    }

    public function props()
    {
        echo '<div class="col-md-12">';
        echo '<b>Properties for class (' . get_called_class() . '):</b><br>';
        echo '<pre>';
        print_r(get_class_vars(get_called_class()));
        echo '</pre>';
        echo '</div>';
        exit();
    }
}
