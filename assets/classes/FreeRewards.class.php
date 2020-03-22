<?php
    class FreeRewards{
        public $Columns   = "ID,ItemID,ItemName,ItemDescription,ItemIconUrl,ItemCount";
        function __construct($db,$User){
			$this->db		=	$db;
			$this->User		=	$User;
		}
        function _do_freeRewards(){
            if(isset($_POST["OPEN"])){
                sleep(1);
                $this->Random_Item();
            }elseif(isset($_POST["REDEEM"])){
                sleep(1);
                $ItemID    = $this->User_Pending_Item($ColumnName = "ItemID");
                $ItemCount = $this->User_Pending_Item($ColumnName = "ItemCount");
                $this->SendItem($ItemID,$ItemCount);
            }
            if($this->User->LoggedIn() and $this->User_Pending_Item() == null and $this->LootBoxTime() == null){
			echo '<div id="view_mystery" class="view" style="display:block">';
				echo '<div class="instruction_title open" style="">Open your <b>FREE</b> mystery box now!</div>';
				echo '<div class="wrapper_logo" align="center">';
					echo '<img id="logo" src="assets/Themes/Standard/images/lootbox/mystery_box.png" alt="Free Rewards" title="Free Rewards">';
				echo '</div>';
				echo '<div class="wrapper_btns" style="position: relative; top: -15px;" align="center">';
					if($this->Query_Items($this->Columns) != null){
					echo '<a id="wrapper_btn_open" class="wrapper_btn">';
						echo '<input type="submit" id="btnOpen" name="OPEN" value="OPEN" onclick="spinner()">';
					echo '</a>';
					}
				echo '</div>';
			echo '</div>';
            }elseif($this->User->LoggedIn() and $this->User_Pending_Item() != null and $this->LootBoxTime() == null){
                echo '<div id="view_success" class="view">';
                    echo '<div class="instruction_title">Congratulations! You got:</div>';
                    echo '<div class="instruction_content">';
                        echo '<span class="wrapper_icon">';
                            echo '<img src="assets/Themes/Standard/images/lootbox/icons/'.$this->User_Pending_Item($ColumnName = "ItemIconUrl").'" name="icon_url" id="won_item_icon">';
                        echo '</span>';
                        echo '<span class="wrapper_desc" id="won_item_name">'.$this->User_Pending_Item($ColumnName = "ItemName").'</span>';
					echo '</div>';
					echo '<br>';
                    echo '<div class="wrapper_btns" align="center">';
                        echo '<a id="wrapper_btn_redeem" class="wrapper_btn">';
                            echo '<input type="submit" id="btnRedeem" name="REDEEM" value="REDEEM" onclick="spinner()">';
                        echo '</a>';
                    echo '</div>';
                echo '</div>';
            }elseif($this->User->LoggedIn() and $this->User_Pending_Item() == null and $this->LootBoxTime() == True){
                echo '<div id="view_mystery" class="view">';
                    echo '<div class="wrapper_timer">';
                        echo '<div id="timer_timeout" class="instruction_timer">';
                            $this->LootBoxTime();
                        echo '</div>';
                        echo '<div class="instruction_timeout">Until you can open again.</div>';
                    echo '</div>';
                    echo '<div class="wrapper_logo" align="center">';
                        echo '<img id="logo" src="assets/Themes/Standard/images/lootbox/mystery_box.png" alt="Free Rewards" title="Free Rewards">';
                    echo '</div>';
                    echo '<input type="hidden" name="time"/>';
                echo '</div>';
                echo '<script type="text/javascript" src="js/jquery-3.3.1.min.js"></script>';
                echo '<script type="text/javascript" src="js/ajax.js"></script>';
            }
        }
        function Query_Items($Columns = null){
		$Query_ID = $this->db->conn->prepare("SELECT ID FROM ".$this->db->get_TABLE('SH_LOOT_BOX')."");
		$Query_ID->execute();
		$List_ID  = $Query_ID->fetchAll(PDO::FETCH_ASSOC);
		$Count_ID = $Query_ID->rowcount();

		$Limit     = 10;
		$ForLimit  = 2;

			$Query = $this->db->conn->prepare("
				SELECT  * FROM    ( SELECT    ROW_NUMBER() OVER ( ORDER BY ID DESC) AS RowNum ,
				$Columns
				FROM ".$this->db->get_TABLE('SH_LOOT_BOX')."
				) AS Sorgu
			");
			$Query->execute();

			if($Count_ID){
				return $List = $Query->fetchAll(PDO::FETCH_ASSOC);
			}else{
				return null;
			}
		}

	function Random_Item(){
		$Query_LootBox_Items = $this->db->conn->prepare("SELECT * FROM ".$this->db->get_TABLE('SH_LOOT_BOX')." ORDER BY ID DESC");
		$Query_LootBox_Items->execute();
		$List_LootBox_Items  = $Query_LootBox_Items->fetch(PDO::FETCH_ASSOC);

		$ID = false;
		while ($ID = True){
        	$Random_ID = rand(1,$List_LootBox_Items["ID"]);
        	$Query_LootBox_Items_ID = $this->db->conn->prepare("SELECT ID FROM ".$this->db->get_TABLE('SH_LOOT_BOX')." WHERE ID = ?");
			$Query_LootBox_Items_ID->execute(array($Random_ID));
			$Control_lootBox_Items_ID = $Query_LootBox_Items_ID->rowcount();
			if($Control_lootBox_Items_ID){
				$ID == True;
				break;
			}
    	}
		$Send_LootBox_Item_Pending = $this->db->conn->prepare("INSERT INTO ".$this->db->get_TABLE('SH_LOOT_BOX_ITEMS_PENDING')." (UserUID,ID) VALUES (?,?)");
		$Send_LootBox_Item_Pending->execute(array($this->User->UserUID,$Random_ID));
		$Control_Send_LootBox_Item_Pending = $Send_LootBox_Item_Pending->rowcount();
		if($Control_Send_LootBox_Item_Pending){
#			header("Location:index.php");
		}else{
			echo "<script>alert('error plaise try again later')</script>";
		}
	}

	function User_Pending_Item ($ColumnName = null){
		$Query_User_Pending_LootBox_Item_ID = $this->db->conn->prepare("SELECT ID FROM ".$this->db->get_TABLE('SH_LOOT_BOX_ITEMS_PENDING')." WHERE UserUID = ?");
    	$Query_User_Pending_LootBox_Item_ID->execute(array($this->User->UserUID));
    	$Control_User_Pending_LootBox_Item_ID = $Query_User_Pending_LootBox_Item_ID->rowcount();
    	if($Control_User_Pending_LootBox_Item_ID){
    		$List_User_Pending_LootBox_Item_ID = $Query_User_Pending_LootBox_Item_ID->fetch(PDO::FETCH_ASSOC);
    		if($ColumnName){
    			$Query_User_Pending_LootBox_Item = $this->db->conn->prepare("SELECT * FROM ".$this->db->get_TABLE('SH_LOOT_BOX')." WHERE ID = ?");
				$Query_User_Pending_LootBox_Item->execute(array($List_User_Pending_LootBox_Item_ID["ID"]));
				$Control_User_Pending_LootBox_Item = $Query_User_Pending_LootBox_Item->rowcount();
				if($Control_User_Pending_LootBox_Item){
					$List_User_Pending_LootBox_Item = $Query_User_Pending_LootBox_Item->fetch(PDO::FETCH_ASSOC);
					return $List_User_Pending_LootBox_Item[$ColumnName];
				}else{
					$Delete_User_Pending_Item = $this->db->conn->prepare("DELETE FROM ".$this->db->get_TABLE('SH_LOOT_BOX_ITEMS_PENDING')." WHERE ID = ?");
					$Delete_User_Pending_Item->execute(array($List_User_Pending_LootBox_Item_ID["ID"]));
#					header("Location:index.php");
				}
    		}else{
    			return True;
    		}
    	}else{
    		return null;
    	}
	}

	function SendItem($ItemID,$ItemCount){
		$slot = 0;
        $querySlot = $this->db->conn->prepare('SELECT Slot FROM PS_GameData.dbo.UserStoredPointItems WHERE UserUID = ?');
        $querySlot->bindValue(1, $this->User->UserUID, PDO::PARAM_INT); 
        $querySlot->execute();
        while ($row = $querySlot->fetch(PDO::FETCH_NUM)){
	        if ($row[0] != $slot){
	        break;
	        } else {
	        $slot++;
	        }
    	}

		$Send_User_Item = $this->db->conn->prepare("INSERT INTO PS_GameData.dbo.UserStoredPointItems 
		(UserUID,Slot,ItemID,ItemCount) 
		VALUES 
		(?,?,?,?)");
		$Send_User_Item->execute(array($this->User->UserUID,$slot,$ItemID,$ItemCount));
		$Control_User_Send_Item = $Send_User_Item->rowcount();
		if($Control_User_Send_Item){
			$Delete_User_Pending_Item = $this->db->conn->prepare("DELETE FROM ".$this->db->get_TABLE('SH_LOOT_BOX_ITEMS_PENDING')." WHERE UserUID = ?");
			$Delete_User_Pending_Item->execute(array($this->User->UserUID));
			$LootBox_Time = time();
			$Insert_LootBox_Time = $this->db->conn->prepare("INSERT INTO ".$this->db->get_TABLE('SH_LOOT_BOX_TIME')." (UserUID,LootBoxTime) VALUES (?,?)");
			$Insert_LootBox_Time->execute(array($this->User->UserUID,$LootBox_Time));
			$Insert_Log = $this->db->conn->prepare("INSERT INTO ".$this->db->get_TABLE('SH_LOOT_BOX_LOGS')." 
			(UserUID,ItemID,ItemCount)
			VALUES
			(?,?,?)
			");
			$Insert_Log->execute(array($this->User->UserUID,$ItemID,$ItemCount));
#			header("Location:index.php");
		}else{
			echo "<script>alert('error plaise try again later')</script>";
		}
	}

	function LootBoxTime(){
		global $Reward_Hour;
		$Query_User_LootBox_Time   = $this->db->conn->prepare("SELECT LootBoxTime FROM ".$this->db->get_TABLE('SH_LOOT_BOX_TIME')." WHERE UserUID = ?");
		$Query_User_LootBox_Time->execute(array($this->User->UserUID));
		$Control_User_lootBox_Time = $Query_User_LootBox_Time->rowcount();
		if($Control_User_lootBox_Time){
			$List_User_LootBox_Time  = $Query_User_LootBox_Time->fetch(PDO::FETCH_ASSOC);
			$LootBoxTime = $List_User_LootBox_Time["LootBoxTime"]+$Reward_Hour*60*60;
			if($LootBoxTime > time()){
				$time = $LootBoxTime-time();
				if($time<=60){
					if($time < 10){
						$time = "0".$time;
					}
					return "00&nbsp;: &nbsp;"."00&nbsp;: &nbsp;".$time;
				}elseif(($time>60) && !($time>3600)){
					$minute= floor($time/60);
					$remaining=$time-$minute*60;
					if($remaining < 10){
						$remaining = "0".$remaining;
					}
					if($minute < 10){
						$minute = "0".$minute;
					}
					return "00&nbsp;: &nbsp;".$minute ."&nbsp;: &nbsp;". $remaining;
				}elseif($time>3600 && !($time>86400)){
					$hour= floor($time/(60*60));
					$remaining=$time-($hour*60*60);
					$minute=floor($remaining/60);
					$remaining_second=($time)-($hour*60*60)-($minute*60);
					if($remaining_second < 10){
						$remaining_second = "0".$remaining_second;
					}
					if($minute < 10){
						$minute = "0".$minute;
					}
					if($hour < 10){
						$hour = "0".$hour;
					}
					return $hour ."&nbsp;:&nbsp;" . $minute . "&nbsp;:&nbsp;" . $remaining_second;
				}elseif($time>86400){
					$day=floor($time/(60*60*24));
					$remaining_hour=$time-($day*60*60*24);
					$day ." :,";
					$hour=floor($remaining_hour/(60*60)) ;
					$remaining_minute= ($time)-($day*60*60*24)-($hour*60*60);
					$minute=floor($remaining_minute/60);
					$minute." :,";
					$remaining_second= ($time)-($day*60*60*24)-($hour*60*60)-($minute*60);
					$second=floor($remaining_second);
					if($second < 10){
						$second = "0".$second;
					}
					if($minute < 10){
						$minute = "0".$minute;
					}
					if($hour < 10){
						$hour = "0".$hour;
					}
					if($day < 10){
						$day = "0".$day;
					}
					return $day ."&nbsp;:&nbsp;" . $hour. "&nbsp;:&nbsp;" . $minute. "&nbsp;:&nbsp;".$second;
				}
			}else{
				$Delete_User_LootBox_Time = $this->db->conn->prepare("DELETE FROM ".$this->db->get_TABLE('SH_LOOT_BOX_TIME')." WHERE UserUID = ?");
				$Delete_User_LootBox_Time->execute(array($this->User->UserUID));
#				echo '<script type="text/javascript">window.location = "index.php"</script>';
			}
		}else{
			return null;
		}
	}
    }
?>