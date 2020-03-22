<?php
	class GlobChat{
		function __construct($DatabaseObj){
			$this->db	=	$DatabaseObj;
		}
		function chat_color($num){
		switch($num){
			case 1: return 'normal'; break;
			case 2: return 'whisper'; break;
			case 3: return 'guild'; break;
			case 4: return 'party'; break;
			case 5: return 'trade'; break;
			case 6: return 'yelling'; break;
			case 7: return 'area'; break;
		}
	}
}