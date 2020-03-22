<?php
	class Style{
		public $_style_array=array();

		function __construct($DatabaseObj){
			$this->db 		=	$DatabaseObj;

			$this->_style_array();
		}
		function _style_array($ZONE=false,$TYPE=false,$CSS_NAME=false){
			$_array		=	array();

			# JQUERY CORE
			array_push($this->_style_array,$this->JQUERY_HOME_DIR());			#0
			array_push($this->_style_array,$this->JQUERY_VERSION());			#1
			array_push($this->_style_array,$this->JQUERY_JS());					#2
			# JQUERYUI CORE
			array_push($this->_style_array,$this->JQUERYUI_HOME_DIR());			#3
			array_push($this->_style_array,$this->JQUERYUI_VERSION());			#4
			array_push($this->_style_array,$this->JQUERYUI_JS());				#5
			array_push($this->_style_array,$this->JQUERYUI_THEME_NAME());		#6
			array_push($this->_style_array,$this->JQUERYUI_STYLE_CSS());		#7
			array_push($this->_style_array,$this->JQUERYUI_THEME_CSS());		#8
			# JQUERY EXTRAS
			array_push($this->_style_array,$this->JQUERY_ADDONS_DIR());			#9
			array_push($this->_style_array,$this->JQUERY_CUSTOM_DIR());			#10
			# ADDONS - BOOTSTRAP
			array_push($this->_style_array,$this->JQUERY_BS_DIR());				#11
			array_push($this->_style_array,$this->JQUERY_BS_VERSION());			#12
			array_push($this->_style_array,$this->JQUERY_BS_CSS());				#13
			array_push($this->_style_array,$this->JQUERY_BS_JS());				#14
			# ADDONS - EASING
			array_push($this->_style_array,$this->JQUERY_EASING_DIR());			#15
			array_push($this->_style_array,$this->JQUERY_EASING_VERSION());		#16
			array_push($this->_style_array,$this->JQUERY_EASING_JS());			#17
			array_push($this->_style_array,$this->JQUERY_EASING_COMPAT_JS());	#18
			# ADDONS - GOOGLE ANALYTICS
			array_push($this->_style_array,$this->JQUERY_GA_DIR());				#19
			array_push($this->_style_array,$this->JQUERY_GA_JS());				#20
			# ADDONS - MODERNIZR
			array_push($this->_style_array,$this->JQUERY_MODERNIZR_DIR());		#21
			array_push($this->_style_array,$this->JQUERY_MODERNIZR_VERSION());	#22
			array_push($this->_style_array,$this->JQUERY_MODERNIZR_JS());		#23
			# ADDONS - TINYMCE
			array_push($this->_style_array,$this->JQUERY_TINYMCE_DIR());		#24
			array_push($this->_style_array,$this->JQUERY_TINYMCE_VERSION());	#25
			array_push($this->_style_array,$this->JQUERY_TINYMCE_JS());			#26
			array_push($this->_style_array,$this->JQUERY_TINYMCE_INIT());		#27
			# ADDONS - TETHER
			array_push($this->_style_array,$this->JQUERY_TETHER_DIR());			#28
			array_push($this->_style_array,$this->JQUERY_TETHER_VERSION());		#29
			array_push($this->_style_array,$this->JQUERY_TETHER_JS());			#30
			# ADDONS - WOW
			array_push($this->_style_array,$this->JQUERY_WOW_DIR());			#31
			array_push($this->_style_array,$this->JQUERY_WOW_VERSION());		#32
			array_push($this->_style_array,$this->JQUERY_WOW_JS());				#33
			array_push($this->_style_array,$this->JQUERY_WOW_CSS());			#34
			# STYLES
			array_push($this->_style_array,$this->STYLES_DIR());				#35
			array_push($this->_style_array,$this->THEMES_DIR());				#36
			array_push($this->_style_array,$this->CORE_CSS_DIR());				#37
			array_push($this->_style_array,$this->UNI_CSS_DIR($ZONE,$TYPE));	#38
			array_push($this->_style_array,$this->FONTS_DIR());					#39
			array_push($this->_style_array,$this->FONTAWESOME_DIR());			#40
			array_push($this->_style_array,$this->FONTAWESOME_CSS());			#41
			array_push($this->_style_array,$this->FONTICONS_DIR());				#42
			array_push($this->_style_array,$this->FONTICONS_CSS());				#43
			array_push($this->_style_array,$this->CUSTOM_DIR());				#44
			array_push($this->_style_array,$this->ICONS_DIR());					#45
			array_push($this->_style_array,$this->LOADLAB_DIR());				#46
			array_push($this->_style_array,$this->LOADER_CSS());				#47
		}
		# JQUERY CORE
		function JQUERY_HOME_DIR(){
			return 'assets/jquery/';
		}
		function JQUERY_VERSION(){
			return 'v1.12.4';
		}
		function JQUERY_JS(){
			return $this->_style_array[0].$this->_style_array[1]."/"."jquery-".$this->_style_array[1].".js";
		}
		# JQUERYUI CORE
		function JQUERYUI_HOME_DIR(){
			return $this->_style_array[0].'UI/';
		}
		function JQUERYUI_VERSION(){
			return 'v1.12.1';
		}
		function JQUERYUI_JS(){
			return $this->_style_array[3].$this->_style_array[4]."/"."js/jquery-".$this->_style_array[4].".ui.js";
		}
		function JQUERYUI_THEME_NAME(){
			return 'Dot Luv';
		}
		function JQUERYUI_STYLE_CSS(){
			return $this->_style_array[3].$this->_style_array[4]."/themes/".$this->_style_array[6]."/jquery-ui-style.css";
		}
		function JQUERYUI_THEME_CSS(){
			return $this->_style_array[3].$this->_style_array[4]."/themes/".$this->_style_array[6]."/jquery-ui-theme.css";
		}
		# JQUERY EXTRAS
		function JQUERY_ADDONS_DIR(){
			return $this->_style_array[0].'Addons/';
		}
		function JQUERY_CUSTOM_DIR(){
			return $this->_style_array[0].'Custom/';
		}
		# JQUERY ADDONS - BOOTSTRAP
		function JQUERY_BS_DIR(){
			return $this->_style_array[9].'Bootstrap/';
		}
		function JQUERY_BS_VERSION(){
			return 'v4.0.0';
		}
		function JQUERY_BS_CSS(){
			return $this->_style_array[11].$this->_style_array[12].'/bootstrap.css';
		}
		function JQUERY_BS_JS(){
			return $this->_style_array[11].$this->_style_array[12].'/bootstrap.min.js';
		}
		# EASING
		function JQUERY_EASING_DIR(){
			return $this->_style_array[9].'Easing/';
		}
		function JQUERY_EASING_VERSION(){
			return 'v1.3';
		}
		function JQUERY_EASING_JS(){
			return $this->_style_array[15].$this->_style_array[16].'/jquery.easing.1.3.js';
		}
		function JQUERY_EASING_COMPAT_JS(){
			return $this->_style_array[15].$this->_style_array[16].'/jquery.easing.compatibility.js';
		}
		# GOOGLE ANALYTICS
		function JQUERY_GA_DIR(){
			return $this->_style_array[9].'Google/';
		}
		function JQUERY_GA_JS(){
			return $this->_style_array[19].'analytics.js';
		}
		# MODERNIZR
		function JQUERY_MODERNIZR_DIR(){
			return $this->_style_array[9].'modernizr/';
		}
		function JQUERY_MODERNIZR_VERSION(){
			return 'v2.8.3';
		}
		function JQUERY_MODERNIZR_JS(){
			return $this->_style_array[21].$this->_style_array[22].'/modernizr.custom.js';
		}
		# TINYMCE
		function JQUERY_TINYMCE_DIR(){
			return $this->_style_array[9].'TinyMCE/';
		}
		function JQUERY_TINYMCE_VERSION(){
			return 'v4.9.0';
		}
		function JQUERY_TINYMCE_JS(){
			return $this->_style_array[24].$this->_style_array[25].'/js/tinymce.min.js';
		}
		function JQUERY_TINYMCE_INIT(){
			return $this->_style_array[24].$this->_style_array[25].'/js/init.tinymce.js';
		}
		# TETHER
		function JQUERY_TETHER_DIR(){
			return $this->_style_array[9].'Tether/';
		}
		function JQUERY_TETHER_VERSION(){
			return 'v1.3.3';
		}
		function JQUERY_TETHER_JS(){
			return $this->_style_array[28].$this->_style_array[29].'/js/tether.js';
		}
		# WOW
		function JQUERY_WOW_DIR(){
			return $this->_style_array[9].'Wow/';
		}
		function JQUERY_WOW_VERSION(){
			return 'v1.1.2';
		}
		function JQUERY_WOW_JS(){
			return $this->_style_array[31].$this->_style_array[32]."/wow.min.js";
		}
		function JQUERY_WOW_CSS(){
			return $this->_style_array[31].$this->_style_array[32]."/animate.css";
		}
		# STYLES
		function STYLES_DIR(){
			return 'Assets/Styles/';
		}
		function THEMES_DIR(){
			return 'Assets/Themes/';
		}
		function CORE_CSS_DIR(){
			return $this->_style_array[36].'Core/';
		}
		function UNI_CSS_DIR($ZONE,$TYPE){
			if($ZONE == "CMS"){
				if($TYPE == "STYLE"){
					return $this->_style_array[35].$this->Theme->_theme_array[3]."css/";
				}
				elseif($TYPE == "THEME"){
					return $this->_style_array[36].$this->Theme->_theme_array[4]."css/";
				}
			}
			elseif($ZONE == "ACP"){
				return $this->_style_array[35].$this->Theme->_theme_array[5]."css/";
			}
		}
		function UNI_IMAGES($ZONE,$IMG_TYPE=false){
			if($ZONE == "CMS"){
				if($IMG_TYPE == "LOGO"){
					return $this->_style_array[35].$this->Theme->_theme_array[3].'images/logo/';
				}
				elseif($IMG_TYPE == "C_LOGO"){
					return $this->_style_array[36].$this->Theme->_theme_array[4].'images/logo/';
				}
				elseif($IMG_TYPE == "WP"){
					return $this->_style_array[35].$this->Theme->_theme_array[3].'images/wp/';
				}
				elseif($IMG_TYPE == "C_WP"){
					return $this->_style_array[36].$this->Theme->_theme_array[4].'images/wp/';
				}
				elseif($IMG_TYPE == "ICON"){
					return $this->_style_array[35].$this->Theme->_theme_array[3].'images/icon/';
				}
				elseif($IMG_TYPE == "C_ICON"){
					return $this->_style_array[36].$this->Theme->_theme_array[4].'images/icon/';
				}
				elseif($IMG_TYPE == "MISC"){
					return $this->_style_array[35].$this->Theme->_theme_array[3].'images/misc/';
				}
				elseif($IMG_TYPE == "C_MISC"){
					return $this->_style_array[36].$this->Theme->_theme_array[4].'images/misc/';
				}
				elseif($IMG_TYPE == "AJAX"){
					return $this->_style_array[35].$this->Theme->_theme_array[4].'images/ajax/';
				}
				else{}
			}
			elseif($ZONE == "ACP"){
				return $this->_style_array[35].$this->Theme->_theme_array[5].'Images/';
			}
		}
		function UNI_IMAGES_DIR($ZONE){
			$IMG_DIR	=	'Images/';

			if($ZONE == "CMS"){
				return $this->UNI_THEME_CSS_DIR($ZONE).$this->Theme->_theme_array[4]($ZONE)."css/";
			}
			elseif($Zone == "ACP"){
				return $this->_style_array[31].$this->Theme->_theme_array[5].'Images/';
			}
		}
		function FONTS_DIR(){
			return $this->_style_array[37].'Fonts/';
		}
		function FONTAWESOME_DIR(){
			return  $this->_style_array[39].'font-awesome/v5.6.1/';
		}
		function FONTAWESOME_CSS(){
			return $this->_style_array[40].'css/all.css';
		}
		function FONTICONS_DIR(){
			return $this->_style_array[39].'fonticons/';
		}
		function FONTICONS_CSS(){
			return $this->_style_array[42].'css/fonts.css';
		}
		function CUSTOM_DIR(){
			return $this->_style_array[37].'Custom/Custom/';
		}
		function ICONS_DIR(){
			return $this->_style_array[37].'Icons/';
		}
		function LOADLAB_DIR(){
			return $this->_style_array[37].'LoadLab/';
		}
		function LOADER_CSS(){
			return $this->_style_array[44].'Preloader.css';
		}
		function shop_icons_dir(){
			return 'assets/Themes/Standard/images/shop_icons/';
		}
		function Props(){
			echo '<div class="col-md-12">';
				echo '<b>Properties for class ('.get_class($this).'):</b><br>';
				echo '<pre>';
					echo print_r(get_object_vars($this));
				echo '</pre>';
			echo '</div>';
			exit();
		}
	}
?>