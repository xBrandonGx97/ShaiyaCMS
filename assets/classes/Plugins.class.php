<?php
	class Plugins{
		public $MODE='void';
		public $OPT_A='DISPLAY';
		public $OPT_B='INSTALL';

		function __construct($db,$Dirs,$Modal,$SQL,$Template,$Setting,$User,$BossRecord,$GuildRanking){
			$this->db			=	$db;
			$this->Dirs			=	$Dirs;
			$this->Modal		=	$Modal;
			$this->SQL			=	$SQL;
			$this->Tpl			=	$Template;
			$this->Setting		=	$Setting;
			$this->User			=	$User;
			$this->BossRecord	=	$BossRecord;
			$this->GuildRanking	=	$GuildRanking;
		}
		# PLUGINS
		function plugin_search_left(){
			$this->MODE = $this->OPT_A;
			$this->plugin_load_left();
		}
		function plugin_load_left(){
			# Sort by will start by what's called in order
			$PLUGIN_NAME='ServerTime';
			$PLUGIN_ENABLED=1;
			$PLUGIN_MASTERFILE='plugin.ServerTime.php';
			if($PLUGIN_NAME=='ServerTime' && $PLUGIN_ENABLED==1){
				require_once($this->Dirs->DIR_PLUGINS.$PLUGIN_MASTERFILE);
			}
			$PLUGIN_NAME='GRBTime';
			$PLUGIN_ENABLED=0;
			$PLUGIN_MASTERFILE='plugin.GRBTime.php';
			if($PLUGIN_NAME=='GRBTime' && $PLUGIN_ENABLED==1){
				require_once($this->Dirs->DIR_PLUGINS.$PLUGIN_MASTERFILE);
			}
			$PLUGIN_NAME='BossRecords';
			$PLUGIN_ENABLED=1;
			$PLUGIN_MASTERFILE='plugin.BossRecords.php';
			if($PLUGIN_NAME=='BossRecords' && $PLUGIN_ENABLED==1){
				require_once($this->Dirs->DIR_PLUGINS.$PLUGIN_MASTERFILE);
			}
			$PLUGIN_NAME='GuildRanking';
			$PLUGIN_ENABLED=0;
			$PLUGIN_MASTERFILE='plugin.GuildRanking.php';
			if($PLUGIN_NAME=='GuildRanking' && $PLUGIN_ENABLED==1){
				require_once($this->Dirs->DIR_PLUGINS.$PLUGIN_MASTERFILE);
			}
			$PLUGIN_NAME='ServerInformation';
			$PLUGIN_ENABLED=0;
			$PLUGIN_MASTERFILE='plugin.ServerInfo.php';
			if($PLUGIN_NAME=='ServerInformation' && $PLUGIN_ENABLED==1){
				require_once($this->Dirs->DIR_PLUGINS.$PLUGIN_MASTERFILE);
			}
			$PLUGIN_NAME='PlayersOnline';
			$PLUGIN_ENABLED=0;
			$PLUGIN_MASTERFILE='plugin.PlayersOnline.php';
			if($PLUGIN_NAME=='PlayersOnline' && $PLUGIN_ENABLED==1){
				require_once($this->Dirs->DIR_PLUGINS.$PLUGIN_MASTERFILE);
			}
			$PLUGIN_NAME='ServerStatus';
			$PLUGIN_ENABLED=0;
			$PLUGIN_MASTERFILE='plugin.ServerStatus.php';
			if($PLUGIN_NAME=='ServerStatus' && $PLUGIN_ENABLED==1){
				require_once($this->Dirs->DIR_PLUGINS.$PLUGIN_MASTERFILE);
			}
		}
		function plugin_search_right(){
			$this->MODE = $this->OPT_A;
			$this->plugin_load_right();
		}
		function plugin_load_right(){
			# Sort by will start by what's called in order
			$PLUGIN_NAME='UserInfo';
			$PLUGIN_ENABLED=1;
			$PLUGIN_MASTERFILE='plugin.UserInfo.php';
			if($PLUGIN_NAME=='UserInfo' && $PLUGIN_ENABLED==1){
				require_once($this->Dirs->DIR_PLUGINS.$PLUGIN_MASTERFILE);
			}
			$PLUGIN_NAME='GRBTime';
			$PLUGIN_ENABLED=0;
			$PLUGIN_MASTERFILE='plugin.GRBTime.php';
			if($PLUGIN_NAME=='GRBTime' && $PLUGIN_ENABLED==1){
				require_once($this->Dirs->DIR_PLUGINS.$PLUGIN_MASTERFILE);
			}
			$PLUGIN_NAME='ServerInformation';
			$PLUGIN_ENABLED=0;
			$PLUGIN_MASTERFILE='plugin.ServerInfo.php';
			if($PLUGIN_NAME=='ServerInformation' && $PLUGIN_ENABLED==1){
				require_once($this->Dirs->DIR_PLUGINS.$PLUGIN_MASTERFILE);
			}
			$PLUGIN_NAME='PlayersOnline';
			$PLUGIN_ENABLED=0;
			$PLUGIN_MASTERFILE='plugin.PlayersOnline.php';
			if($PLUGIN_NAME=='PlayersOnline' && $PLUGIN_ENABLED==1){
				require_once($this->Dirs->DIR_PLUGINS.$PLUGIN_MASTERFILE);
			}
			$PLUGIN_NAME='ServerStatus';
			$PLUGIN_ENABLED=0;
			$PLUGIN_MASTERFILE='plugin.ServerStatus.php';
			if($PLUGIN_NAME=='ServerStatus' && $PLUGIN_ENABLED==1){
				require_once($this->Dirs->DIR_PLUGINS.$PLUGIN_MASTERFILE);
			}
		}
		function formatSize($bytes){
			# Get Drive Space Stats
			$types=array('B','KB','MB','GB','TB');
			for($i=0;$bytes>=1024&&$i<(count($types)-1);$bytes/=1024,$i++);
			return(round($bytes,2)." ".$types[$i]);
		}
		function Storage_Meter($data){
			$Title	=	NULL;
			$Body	=	NULL;

			# Get disk space free (in bytes)
			$Drive	=	$data;
			$df = disk_free_space($Drive);

			# Get disk space total (in bytes)
			$dt = disk_total_space($Drive);

			# Calculate the disk space used (in bytes)
			$du=$dt-$df;
			$da=$dt+$df;

			# Percentage of disk used
			$dp=sprintf('%.2f',($du/$dt)*100);
			$dr=sprintf('%.2f',100-$dp);
			$d_gb=(round($dt/(1024*1024*1024)));
			$d_gbu=(round($df/(1024*1024*1024)));
			$d_gbr=round(($dt-$df)/(1024*1024*1024));

			# Content
			$Title	.=	'System Storage';
			$Body	.=	'<div class="tac">';
				$Body	.=	'<font class="b_i">'.$Drive.' '.$this->formatSize($dt).'</font><br>';
				$Body	.=	'<font class="b_i">Used: '.$dp.'% ('.$this->formatSize($du).')</font><br>';
				$Body	.=	'<font class="b_i">Free: '.$dr.'% ('.$this->formatSize($dt-$du).')</font>';
			$Body	.=	'</div>';
			$Body	.=	$this->Tpl->Separator('10');

			$Body	.=	'<div class="bar-outer">';
				$Body	.=	'<div class="bar-inner1" style="width:'.$dp.'%"></div>';
				$Body	.=	'<div class="bar-label b_i">'.$dp.'%</div>';
			$Body	.=	'</div>';
			$Body	.=	$this->Tpl->Separator('10');

			$Body	.=	'<div class="bar-outer">';
				$Body	.=	'<div class="bar-inner2" style="width:'.$dr.'%"></div>';
				$Body	.=	'<div class="bar-label b_i">'.$dr.'%</div>';
			$Body	.=	'</div>';

			echo $this->Tpl->PLUGIN_CARD($Title,'',$Body,'');
		}
		# PROPS LIST
		function Props(){
			# Debugging
			echo "<b>Class=>Settings Properties:</b> ";
			echo "<pre>";
				print_r(get_object_vars($this));
			echo "</pre>";
		}
	}
?>