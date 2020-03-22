<?php
    # Content
	$this->Tpl->_start_mainSection();
		$this->Tpl->Separator(20);
        $this->Tpl->_do_pageHead("Gallery");
        echo '<div class="row">';
			$this->Tpl->_add_new_img_Gallery("assets/Themes/Standard/images/carousel/1385535_shaiya-wallpaper.jpg","new image","new image");
			$this->Tpl->_add_new_img_Gallery("assets/Themes/Standard/images/carousel/MoR_Promotion.png","new image","new image");
			$this->Tpl->_add_new_img_Gallery("assets/Themes/Standard/images/carousel/MoR_Patch_notes.png","new image","new image");
			$this->Tpl->_add_new_img_Gallery("assets/Themes/Standard/images/carousel/Shaiya_Halloween_365x212px.gif","new image","new image");
			$this->Tpl->_add_new_img_Gallery("assets/Themes/Standard/images/carousel/shaiya-hd-wallpapers-33612-2510368.jpg","new image","new image");
			$this->Tpl->_add_new_img_Gallery("assets/Themes/Standard/images/carousel/SY-News_MonthlyJanuary_1.jpg","new image","new image");
			$this->Tpl->_add_new_img_Gallery("assets/Themes/Standard/images/carousel/Box03_landing_big.jpg","new image","new image");
        echo '</div>';
		$this->Tpl->_do_pageFooter();
		$this->Tpl->Separator(20);
	$this->Tpl->_end_mainSection();
?>