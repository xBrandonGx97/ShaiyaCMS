<?php
	# Content
	$this->Tpl->_do_pageHead("Downloads","Thank you downloading!");
	echo '<p>Thank you for choosing to download Server Name. Please note that by downloading our server you agree to our <a href="?pageid=TERMS" class="terms">Terms of Service</a>.</p>';
		# MEGA
		echo '<button onclick="window.open(\'https://mega.nz/#!PvgWkChQ!x0FWYuRsy6okkkcgpoTBSPi67AhPnoA0sRR30YGLgbA\')" class="btn btn-sm btn-dl m_auto"><img src="assets/Themes/Standard/images/icons/mega-logo.png" width="30"> Mega</button>';
    	# Google Drive
		echo '<button onclick="window.open(\'https://drive.google.com/open?id=1qTFeiJfvhpkuQFqmunXr9MSIHP9ncgDS\')" class="btn btn-sm btn-dl m_auto"><img src="assets/Themes/Standard/images/icons/Google-Drive-Icon.png" width="30">Google Drive</a></button>';
	$this->Tpl->_do_pageFooter();
?>