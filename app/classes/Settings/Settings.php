<?php

   namespace Classes\Settings;

    use Classes\DB\MSSQL;
    use Illuminate\Database\Capsule\Manager as Eloquent;

    class Settings
    {
        public function __construct()
        {
            $settings = [];
            $datas = Eloquent::table(MSSQL::getTable('CMS_MAIN'))
             ->select()
             ->get();
            foreach ($datas as $data) {
                $settings[$data->SETTING] = $data->VALUE;
            }
            $_SESSION['Settings'] = $settings;
        }

        public function _Props()
        {
            echo '<div class="col-md-12">';
            echo '<b>Properties for class (' . get_called_class() . '):</b><br>';
            echo '<pre>';
            echo print_r(get_class_vars(get_called_class()));
            echo '</pre>';
            echo '</div>';
            exit();
        }
    }
