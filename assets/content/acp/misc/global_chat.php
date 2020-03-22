<?php
	# Authorization
	$this->User->Auth();
	$this->User->AuthStaff();

	# AUTOREFRESH, $timer = 30, UNITS ARE IN SECONDS
	$timer = 30;
	$timezone = 'EST';
	date_default_timezone_set($timezone);

	# Map ChatType integer to a meaningful string
	$ChatType_Color = array(1=>'normal',2=>'whisper',3=>'guild',4=>'party',5=>'trade',6=>'yelling',7=>'area');
	
	# Query
    $sql = ("
                SELECT TOP 1000 cl.CharID,cl.ChatType,cl.TargetName,cl.ChatData,cl.ChatTime,cl.MapID,c.CharName,c.Family
                FROM ".$this->db->get_TABLE("SH_CHATLOG")." AS cl
                INNER JOIN ".$this->db->get_TABLE("SH_CHARDATA")." AS c ON c.CharID = cl.CharID
                ORDER BY cl.ChatTime DESC
	");
	$stmt=$this->db->conn->prepare($sql);
	$stmt->execute();

	#	Create DATABASE LOG
	$this->LogSys->createLog("Viewed Global Chat Log");

	# Start Template
	$this->Tpl->_do_ACP_pageHeader("","",false,"12","Live In-Game Chat");
                                        echo '<h2 class="italic currentDate">'.date('l jS \of F Y h:i:s A').$timezone.' | This Page Auto-Updates In: '.$timer.' Seconds</h2>';
                                        echo '<div class="red-base">';
                                        echo '<h4>Chat Legend:<br />|';
                                            echo '<font class="normal">Normal</font> |';
                                            echo '<font class="whisper">Whisper</font> |';
                                            echo '<font class="area">Area</font> |';
                                            echo '<font class="yelling">Yelling</font> |';
                                            echo '<font class="party">Party</font> |';
                                            echo '<font class="guild">Guild</font> |';
                                            echo '<font class="trade">Trade</font> |';
                                        echo '</h4>';
                                        echo '</div>';
                                        echo '<table class="ChatData table table-dark">';
                                            echo '<tr>';
                                                echo '<th class="column-map">Map</th>';
                                                echo '<th class="column-char">Character</th>';
                                                echo '<th class="column-light">AoL</th>';
                                                echo '<th class="column-dark">UoF</th>';
                                                echo '<th class="column-date">Date</th>';
                                            echo '</tr>';
                                        echo '<br />';
                                        $i = 0;
                                        while($ChatData=$stmt->fetch()){
                                            echo '<tr style="background-color:rgba(000,000,139,0.15) !important;">';
                                            if ($ChatData['Family'] == 0 || $ChatData['Family'] == 1) {
                                                echo '<td>'.$this->User->get_Map($ChatData['MapID']).'</td>';
                                                echo '<td><a href="?pageid=PLR_EDIT&char='.$ChatData['CharName'].'">'.$ChatData['CharName'].'</a></td>';
                                                echo '<td class="'.$this->GlobChat->chat_color($ChatData['ChatType']).'">';
                        #							echo '(ChatType: '.$ChatData['ChatType'].')';
                                                    echo !empty($ChatData['TargetName']) ? 'PM *=> '.$ChatData['TargetName'].': ' : '';
                                                    echo htmlentities($ChatData['ChatData']);
                                                echo '</td>';
                                                echo '<td>&nbsp;</td>';
                                                echo '<td class="ChatTime">'.date("M d, y H:i:s A", strtotime($ChatData['ChatTime'])).'</td>';
                                            }
                                            echo '</tr>';

                                            echo '<tr style="background-color:rgba(255,000,000,0.15) !important;">';
                                            if ($ChatData['Family'] == 2 || $ChatData['Family'] == 3) {
                                                echo '<td>'.$this->User->get_Map($ChatData['MapID']).'</td>';
                                                echo '<td><a href="?pageid=PLR_EDIT&char='.$ChatData['CharName'].'">'.$ChatData['CharName'].'</a></td>';
                                                echo '<td>&nbsp;</td>';
                                                echo '<td class="'.$this->GlobChat->chat_color($ChatData['ChatType']).'">';
                    #							echo '(ChatType: '.$ChatData['ChatType'].')';
                                                echo !empty($ChatData['TargetName']) ? 'PM => '.$ChatData['TargetName'].': ' : '';
                                                echo htmlentities($ChatData['ChatData']);
                                            echo '</td>';
                                            echo '<td class="ChatTime">'.date("M d, y H:i:s A", strtotime($ChatData['ChatTime'])).'</td>';
                                            }
                                            echo '</tr>';
    
                                            $i++;
                                        }
                                        echo '</table>';
                                    echo '</div>';
	                           echo '</div>';
	                       echo '</div>';
	                   echo '</div>';
	               echo '</div>';
?>
	<script type="text/javascript">
		var refresh = setInterval(function(){
			window.location.reload();
		},
		<?php echo $timer*500; ?>
		);
	</script>