<?php
	# Authorization
	User::Auth();
	User::AuthGM();

	#	Create DATABASE LOG
	LogSys::createLog("Viewed Send Player Notice");

	$noticestr	=	isset($_POST["noticestr"]) ? Settings::$purifier->purify(trim($_POST["noticestr"])) : false;

	if(isset($_POST['submit'])){
		SExtended::notice_send($noticestr);
		LogSys::createLog("Sent a Notice: ".$noticestr);
			Template::doACP_Head("","",false,"12","Notice Sent Successfully!");
			echo '<p class="fs_18">';
				echo 'Notice Sent : '.$noticestr;
			echo '</p>';
			Template::doACP_Foot();
	}
	else{
		# Start Template
		Template::doACP_Head("","",true,"6","Send Notice");
		echo '<form method="POST">';
			echo '<div class="form-group mx-sm-3 mb-2">';
				echo '<input type="text" name="noticestr" placeholder="Notice" class="form-control text-center fw_bold">';
			echo '</div>';

			echo '<button type="submit" class="btn btn-sm btn-primary text-center" name="submit" style="margin-left:10px;">Submit</button>';
		echo '</form>';
		# End Template
	}
	Template::doACP_Foot();
?>