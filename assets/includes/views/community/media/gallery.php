<?php
	# Content
	Template::_start_mainSection();
		Template::Separator(20);
		Template::_do_pageHead("Gallery");
		echo '<div class="row">';
			Template::_add_new_img_Gallery(DOC_ROOT."/assets/Themes/shCMS/images/carousel/1385535_shaiya-wallpaper.jpg","new image","new image");
			Template::_add_new_img_Gallery(DOC_ROOT."/assets/Themes/shCMS/images/carousel/MoR_Promotion.png","new image","new image");
			Template::_add_new_img_Gallery(DOC_ROOT."/assets/Themes/shCMS/images/carousel/MoR_Patch_notes.png","new image","new image");
			Template::_add_new_img_Gallery(DOC_ROOT."/assets/Themes/shCMS/images/carousel/Shaiya_Halloween_365x212px.gif","new image","new image");
			Template::_add_new_img_Gallery(DOC_ROOT."/assets/Themes/shCMS/images/carousel/shaiya-hd-wallpapers-33612-2510368.jpg","new image","new image");
			Template::_add_new_img_Gallery(DOC_ROOT."/assets/Themes/shCMS/images/carousel/SY-News_MonthlyJanuary_1.jpg","new image","new image");
			Template::_add_new_img_Gallery(DOC_ROOT."/assets/Themes/shCMS/images/carousel/Box03_landing_big.jpg","new image","new image");
		echo '</div>';
		Template::_do_pageFooter();
		Template::Separator(20);
	Template::_end_mainSection();
?>