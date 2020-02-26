<?php
    namespace Classes\Settings;
    use Classes\DB\MSSQL;
    class Settings {
        public static function run(){
            $settings = [];
            MSSQL::query('SELECT * FROM ShaiyaCMS.dbo.CMS_MAIN');
            $datas    =   MSSQL::resultSet();
            foreach($datas as $data) {
                $settings[$data->SETTING] = $data->VALUE;
            }
            $_SESSION['Settings'] = $settings;
        }
        public static function _Props(){
			echo '<div class="col-md-12">';
				echo '<b>Properties for class ('.get_called_class().'):</b><br>';
				echo '<pre>';
					echo print_r(get_class_vars(get_called_class()));
				echo '</pre>';
			echo '</div>';
			exit();
		}
    }