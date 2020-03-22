<?php
	class Template{

		public $NoMsgArr;
		public $output;

		function alert($AlertColor=null,$AlertDismiss=null){
			echo '<div class="container no_padding">';
				echo '<div class="row">';
					echo '<div class="col-md-12">';
						echo '<div class="alert';
						if($AlertColor){
							echo ' '.$AlertColor.'';
						}
						if($AlertDismiss){
							echo ' '.$AlertDismiss.'';
						}
						echo '" role="alert">';

						if($AlertDismiss){
							echo '<button type="button" class="close" data-dismiss="alert" aria-label="Close">';
								echo '<span aria-hidden="true">&times;</span>';
							echo '</button>';
						}
							echo '<h4 class="alert-heading"><i class="fa fa-info-circle"></i> <strong>Notice</strong></h4>';
							echo 'some text';
						echo '</div>';
					echo '</div>';
				echo '</div>';
			echo '</div>';
		}
		function badge($BadgeColor,$BadgeText){
			echo '<span class="badge '.$BadgeColor.'">'.$BadgeText.'</span>';
		}
		function BADGE_AJAX($BadgeColor,$BadgeText){
			echo '<div class="badge '.$BadgeColor.' text-center f_18 w_100_p">'.$BadgeText.'</div>';
		}
		function badge_pill($PillColor,$PillText){
			echo '<span class="badge badge-pill f_14 '.$PillColor.'">'.$PillText.'</span>';
		}
		function NoMsgArr(){
			$this->NoMsgArr = array("REGISTRATION_COMPLETE","ERROR");
		}
		# Card Loader Functions
		function PAGE_CARD($TITLE,$TEXT_ALIGN,$BODY,$FOOTER){
			$ret	=	false;
			$this->Separator("20");
				$ret	.=	'<div class="container">';
				$ret	.=	'<div class="col-md-12 text-center">';
			$ret	.=	'<div id="content_card" class="card-news">';
			if(!empty($TITLE)){
				$ret	.=	'<div class="card-header tac title pTitle show">'.$TITLE.'</div>';
			}
			if(!empty($BODY)){
				$ret	.=	'<div class="card-block content_bg content pContent '.$TEXT_ALIGN.'">';
					$ret	.=	'<div class="separator_10"></div>';
					$ret	.=	'<div class="card-text">'.$BODY.'</div>';
					$ret	.=	'<div class="separator_10"></div>';
				$ret	.=	'</div>';
			}
			if(!empty($FOOTER)){
				$ret	.=	'<div class="card-footer content_bg footer pContent">';
					$ret	.=	'<div class="tac b_i">';
						$ret	.=	'Posted on <font class="red">'.Date("m/d/y",strtotime($FOOTER)).'</font> at <font class="red">'.Date("h:iA ",strtotime($FOOTER)).'</font>';
					$ret	.=	'</div>';
				$ret	.=	'</div>';
			}
				$ret	.=	'</div>';
			$ret	.=	'</div>';
		$ret	.=	'</div>';

			return $ret;
		}
		function PAGE_CARD_NEWS($TITLE,$BODY,$BYWHO,$DATE){
			$ret	=	false;
			$ret	.=	'<div class="container">';
				$ret	.=	'<div class="col-md-12 text-center">';
					$ret	.=	'<div id="content_card1" class="card-news">';
			if(!empty($TITLE)){
				$ret	.=	'<div class="card-header tac title pTitle show">'.$TITLE.'</div>';
			}
			if(!empty($BODY)){
				$ret	.=	'<div class="card-block content_bg content pContent">';
					$ret	.=	'<div class="separator_10"></div>';
					$ret	.=	'<div class="card-text">'.$BODY.'</div>';
					$ret	.=	'<div class="separator_10"></div>';
				$ret	.=	'</div>';
			}
			if(!empty($BYWHO)){
				$ret	.=	'<div class="card-block content_bg content pContent">';
					$ret	.=	'<div class="card-link" style="text-align:right;margin-right:10px">By: '.$BYWHO.'</div>';
				$ret	.=	'</div>';
			}
			if(!empty($DATE)){
				$ret	.=	'<div class="card-block content_bg content pContent">';
					$ret	.=	'<div class="card-link" style="text-align:right;margin-right:5px">'.$DATE.'</div>';
				$ret	.=	'</div>';
			}
			if(!empty($FOOTER)){
				$ret	.=	'<div class="card-footer content_bg footer pContent">';
					$ret	.=	'<div class="tac b_i">';
						$ret	.=	'Posted on <font class="red">'.Date("m/d/y",strtotime($FOOTER)).'</font> at <font class="red">'.Date("h:iA ",strtotime($FOOTER)).'</font>';
					$ret	.=	'</div>';
				$ret	.=	'</div>';
			}
				$ret	.=	'</div>';
			$ret	.=	'</div>';
		$ret	.=	'</div>';

			return $ret;
		}
		function PLUGIN_CARD($TITLE,$TEXT_ALIGN,$BODY,$FOOTER){
			$ret	=	false;

			$ret	.=	'<div id="plugin_card" class="card-s bg-dark">';
			if(!empty($TITLE)){
				$ret	.=	'<div class="card-header side-head card_border tac title pTitle show no_radius">'.$TITLE.'</div>';
			}
			if(!empty($BODY)){
				$ret	.=	'<div class="card-block side-block card_border content_bg content no_radius pContent '.$TEXT_ALIGN.'">';
					$ret	.=	'<div class="card-text">';
						$ret	.=	'<div class="m_tb_10 p_lr_15">';
							$ret	.=	$BODY;
						$ret	.=	'</div>';
					$ret	.=	'</div>';
				$ret	.=	'</div>';
			}
			if(!empty($FOOTER)){
				$ret	.=	'<div class="card-footer card_border content_bg footer no_radius pContent">';
					$ret	.=	'<div class="tac b_i">';
						$ret	.=	'Posted on <font class="red">'.Date("m/d/y",strtotime($FOOTER)).'</font> at <font class="red">'.Date("h:iA ",strtotime($FOOTER)).'</font>';
					$ret	.=	'</div>';
				$ret	.=	'</div>';
			}
			$ret	.=	'</div>';

			return $ret;
		}
		# Misc Display Functions
		function mail_diag(){
			echo 'Debug : '.$this->PayPal->PAYPAL_DEBUG.'<br>';
			echo 'Receiver : '.$this->PayPal->PAYPAL_RECEIVER.'<br>';
			echo 'SB URI : '.$this->PayPal->PAYPAL_SANDBOX_URI.'<br>';
			echo 'SD URI : '.$this->PayPal->PAYPAL_STANDARD_URI.'<br>';
			echo 'USE SB : '.$this->PayPal->PAYPAL_SANDBOX.'<br>';
			echo 'Send Conf Email : '.$this->PayPal->PAYPAL_CONF_EMAIL.'<br>';
			echo 'Member Email : '.$_SESSION["Email"].'<br>';
		}
		function Separator($Height){
			switch($Height){
				case '5'	:	echo '<div class="separator_5"></div>';	break;
				case '10'	:	echo '<div class="separator_10"></div>';	break;
				case '15'	:	echo '<div class="separator_15"></div>';	break;
				case '20'	:	echo '<div class="separator_20"></div>';	break;
				case '30'	:	echo '<div class="separator_30"></div>';	break;
				case '40'	:	echo '<div class="separator_40"></div>';	break;
				case '50'	:	echo '<div class="separator_50"></div>';	break;
				case '60'	:	echo '<div class="separator_60"></div>';	break;
				case '70'	:	echo '<div class="separator_70"></div>';	break;
				case '80'	:	echo '<div class="separator_80"></div>';	break;
				case '90'	:	echo '<div class="separator_90"></div>';	break;
				case '100'	:	echo '<div class="separator_100"></div>';	break;
			}
		}
		function input_group($ID,$PLACEHOLDER,$VALUE,$ATTRIB,$PREPEND,$APPEND,$WIDTH=false){
			echo '<div class="input-group input-group-sm mb-3 '.$WIDTH.'">';
				if($PREPEND){
					echo '<div class="input-group-prepend">';
						echo '<span class="input-group-text" id="basic-addon">'.$PREPEND.'</span>';
					echo '</div>';
				}

				echo '<input class="form-control" id="'.$ID.'" name="'.$ID.'" type="text" placeholder="'.$PLACEHOLDER.'" value="'.$VALUE.'" '.$ATTRIB.'/>';

				if($APPEND){
					echo '<div class="input-group-append">';
						echo '<span class="input-group-text">'.$APPEND.'</span>';
					echo '</div>';
				}
			echo '</div>';
		}
		function input_select($SELECT){
			echo '<div class="input-group input-group-sm mb-3">';
				echo $SELECT;
			echo '</div>';
		}
		# OUTPUT
		function OUTPUT_TABLE_HEAD($output=false){
			echo '<div class="row" id="TableLoader">';
				echo '<div class="col-lg-12" id="TabularData">';
					echo '<div class="table-responsive">';
						echo '<table id="mytable" class="table table-sm acp_table">';
							echo '<thead>';
								echo '<tr>';
									if($output){
										foreach($output as $key=>$value){
											echo '<th>'.$value.'</th>';
										}
									}
								echo '</tr>';
							echo '</thead>';
		}
		function OUTPUT_TABLE_BODY($output=false){
							echo '<tbody>';
								echo '<tr>';
									foreach($output as $key=>$value){
										echo '<td>'.$value.'</td>';
									}
								echo '</tr>';
							echo '</tbody>';
						echo '</table>';
					echo '</div>';
				echo '</div>';
			echo '</div>';
		}
		function OUTPUT_TABLE(){
			$head	=	$this->SQL->output["head"];
			$body	=	$this->SQL->output["body"];
		#	$row	=	$this->SQL->output["body"][];
			
			echo '<pre>';
				var_dump($row);
			echo '</pre>';
			exit();
			$this->OUTPUT_TABLE_HEAD($this->SQL->output);
			#$this->
		}
		function _do_pageHead($TITLE=false,$SUB_TITLE=false,$TEXT=false){
			echo '<div class="container">';
				echo '<div class="row">';
					echo '<div class="col-md-12 text-center">';
						echo '<div id="content_card" class="card-cms">';
							if($TITLE){
								echo '<div class="card-header tac title pTitle show">'.$TITLE;
							if($SUB_TITLE){
								echo '<h6 class="mb-2 text-muted">'.$SUB_TITLE.'</h6>';
							}
							if($TEXT){
								echo '<h6 class="mb-2 text-muted">'.$TEXT.'</h6>';
							}
							echo '</div>';
						}
						echo '<div class="card-block content_bg content pContent">';
						$this->Separator(10);	
		}
		function _do_pageFooter($TITLE=false,$SUB_TITLE=false){
						$this->Separator(10);
						echo '</div>';
					echo '</div>';
				echo '</div>';
			echo '</div>';
		echo '</div>';
		}
		function _do_ACP_pageHeader($container=false,$row=false,$col_closed=false,$col_size=false,$TITLE=false,$SUB_TITLE=false){
			echo '<div class="container">';
				echo '<div class="row">';
					if($col_closed){
						echo '<div class="col-md-3"></div>';
					}
					if($col_size){
						echo '<div class="col-'.$col_size.' text-center">';
					}
						echo '<div class="card custom-card">';
							if($TITLE){
								echo '<div class="card-header cstm-card-head tac title pTitle show">'.$TITLE;
							if($SUB_TITLE){
								echo '<h6 class="mb-2 text-muted">'.$SUB_TITLE.'</h6>';
							}
								echo '</div>';
							}
					echo '<div class="card-body">';
		}
		function _do_ACP_pageFooter(){
				echo '</div>';
			echo '</div>';
		echo '</div>';
	echo '</div>';
	}
	function _start_mainSection(){
		echo '<main>';
			echo '<section class="container">';
	}
	function _end_mainSection(){
		echo '</section>';
			$this->Separator(20);
		echo '</main>';
	}
	function _add_new_img_Gallery($imgsrc=false,$imgtitle=false,$imgalt=false){
		if($imgsrc){
			echo '<div class="col-lg-3 col-md-4 col-xs-6 thumb">';
            echo '<a class="thumbnail" href="#" data-image-id="" data-toggle="modal" data-title="" data-image="'.$imgsrc.'" data-target="#image-gallery"><img class="img-thumbnail" src="'.$imgsrc.'" alt="'.$imgalt.'"  title="'.$imgtitle.'"></a>';
        echo '</div>';
		}
	}
		# MISC
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