<?php
	namespace Classes\UI;
	if(!defined('IN_CMS')){die('<b>'.__NAMESPACE__.'\UI</b>: unauthorized access detected, exiting...');}

	class UI{

		# PUBLIC
		public static function BADGE_AJAX($BadgeColor,$BadgeText) {
			echo '<div class="badge '.$BadgeColor.' text-center fs_18 w_100_p">'.$BadgeText.'</div>';
		}
		# MISC
		public static function _Props(){
			echo '<b>Browser Class => Display Properties:</b>';
			echo '<pre>';
				print_r(get_object_vars(__CLASS__));
			echo '</pre>';
		}
	}