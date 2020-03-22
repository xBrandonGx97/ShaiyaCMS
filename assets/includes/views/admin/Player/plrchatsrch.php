<?php
	# Authorization
	User::Auth();
	User::AuthStaff();

	$timezone = 'EST';
	date_default_timezone_set($timezone);

	# Map ChatType integer to a meaningful string
    $ChatType_Color = array(1=>'normal',2=>'whisper',3=>'guild',4=>'party',5=>'trade',6=>'yelling',7=>'area');

    $player		=	isset($_POST["player"])		?	Settings::$purifier->purify(trim($_POST["player"]))	:	false;

	# Query
    $sql = ("
                SELECT [CD].[CharID], [CD].[ChatType], [CD].[TargetName], [CD].[ChatData], [CD].[ChatTime], [CD].[MapID],[C].[CharName],[C].[Family]
                FROM ".Database::getTable("SH_CHATLOG")." AS [CD]
                INNER JOIN ".Database::getTable("SH_CHARDATA")." AS [C] ON [CD].[CharID] = [C].[CharID]
                WHERE [C].[CharName]=? ORDER BY ChatTime DESC
	");
	$stmt=Database::connect()->prepare($sql);
	$args = array($player);
	$stmt->execute($args);

	#	Create DATABASE LOG
	LogSys::createLog("Viewed Player Chat Search");

    if (isset($_POST['submit']))
    {
        if (empty($player))
	    {
		    die('You didn\'t specify a Character Name!');
	    }
        Template::doACP_Head("","",false,"12","Player Chat Search");
                                        echo '<h2 class="italic currentDate">'.date('l jS \of F Y h:i:s A ').$timezone.'</h2>';
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
                                                echo '<th class="column-light">Chat</th>';
                                                echo '<th class="column-char">Target</th>';
                                                echo '<th class="column-date">Date</th>';
                                            echo '</tr>';
                                        echo '<br />';
                                        $i = 0;
                                        while($ChatData=$stmt->fetch()){
                                            echo '<tr style="background-color:rgba(000,000,139,0.15) !important;">';
                                            if ($ChatData['Family'] == 0 || $ChatData['Family'] == 1) {
                                                echo '<td>'.User::get_Map($ChatData['MapID']).'</td>';
                                                echo '<td><a href="?p=pl_stat_edit&char='.$ChatData['CharName'].'">'.$ChatData['CharName'].'</a></td>';
                                                echo '<td class="'.Data::chat_color($ChatData['ChatType']).'">';
                        #							echo '(ChatType: '.$ChatData['ChatType'].')';
                                                    echo htmlentities($ChatData['ChatData']);
                                                echo '</td>';
                                                echo '<td>';
                                                echo !empty($ChatData['TargetName']) ? 'PM => '.$ChatData['TargetName'].'' : '';
                                                echo '</td>';
                                                echo '<td class="ChatTime">'.date("M d, y H:i:s A", strtotime($ChatData['ChatTime'])).'</td>';
                                            }
                                            echo '</tr>';

                                            echo '<tr style="background-color:rgba(255,000,000,0.15) !important;">';
                                            if ($ChatData['Family'] == 2 || $ChatData['Family'] == 3) {
                                                echo '<td>'.User::get_Map($ChatData['MapID']).'</td>';
                                                echo '<td><a href="?p=pl_stat_edit&char='.$ChatData['CharName'].'">'.$ChatData['CharName'].'</a></td>';
                                                echo '<td class="'.Data::chat_color($ChatData['ChatType']).'">';
                    #							echo '(ChatType: '.$ChatData['ChatType'].')';
                                                echo htmlentities($ChatData['ChatData']);
                                            echo '</td>';
                                            echo '<td>';
                                            echo !empty($ChatData['TargetName']) ? 'PM => '.$ChatData['TargetName'].'' : '';
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
                   Template::doACP_Foot();
    }
    else{
        Template::doACP_Head("","",true   ,"6","Player Chat Search");
        echo '<b>Character Chat Search<br>';
		echo '<form method="POST">';
			echo '<input type="text" name="player" placeholder="Char Name" class="form-control tac b_i"/>';
			echo '<input type="submit" class="btn btn-sm btn-primary m_auto" style="margin-top:5px !important;" value="Submit" name="submit" />';
        echo '</form>';
        Template::doACP_Foot();
    }
?>