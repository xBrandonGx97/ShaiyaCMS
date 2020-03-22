<?php
	class PvP{
		function _odbc_num_rows($res){
			$rows = 0;
			while (odbc_fetch_array($res)){
				$rows++;
			}
			return $rows;
		}
		function pages($page,$max_page,$url="",$number=4,$get_name="page"){
			$a		=	"";
			$b		=	"";
			$sheet	=	"";

			# function for showing next pages
			if(preg_match("/\?/",$url )){
				$appendix = "&amp;";
			}
			else{
				$appendix = "?";
			}

			if(substr($url,-1,1)=="&"){
				$url = substr_replace($url,"",-1,1);
			}
			elseif(substr($url,-1,1)=="?"){
				$appendix	= "?";
				$url		= substr_replace($url,"",-1,1);
			}
			if($number %2 != 0){
				$number++;
				$a			=	$page - ($number/2);
				$b			=	0;
				$sheet		=	array();
			}
			while($b <= $number){
				if($a > 0 && $a <= $max_page){
					$sheet[]	=	$a;
					$b++;
				}
				elseif($a > $max_page && ($a - $number - 2) >= 0){ 
					$sheet		=	array();
					$a			-=	($number + 2);
					$b			=	0;
				}
				elseif($a > $max_page && ($a - $number - 2) < 0){
					break;
				}
				$a++;
			}
			$return = "";

			if(!in_array(1,$sheet) && count($sheet) > 1){
				if(!in_array(2,$sheet)){
					$return	.=	"<li class=\"page-item\"><a class=\"page-link\" href=\"{$url}{$appendix}{$get_name}=1\"><img src=\"left.png\" alt=\"\"></a></li>";
				}else{
					$return	.=	"<li class=\"page-item\"><a class=\"page-link\" href=\"{$url}{$appendix}{$get_name}=1\">1</a></li>";
				}
			}
			foreach($sheet as $sheets){
				if($sheets==$page){
					$return	.=	"<li class=\"page-item\">$sheets</li>";
				}else{
					$return	.=	"<li class=\"page-item\"><a class=\"page-link\" href=\"{$url}{$appendix}{$get_name}=$sheets\">$sheets</a></li>";
				}
			}
			if(!in_array($max_page,$sheet)&&count($sheet)>1){
				if(!in_array(($max_page-1),$sheet)){
					$return	.=	"<li class=\"page-item\"><a class=\"page-link\" href=\"{$url}{$appendix}{$get_name}=$max_page\"><img src=\"next.png\" alt=\"\"></a></li>";
				}else{
					$return	.=	"<li class=\"page-item\"><a class=\"page-link\" href=\"{$url}{$appendix}{$get_name}=$max_page\">$max_page</a></li>";
				}
			}
			if(empty($return)){
				return "<li class=\"page-item\">1</li>";
			}else{
				return $return;
			}
		}
	}
?>