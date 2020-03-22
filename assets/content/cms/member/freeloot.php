<?php
	# Content
	$this->Tpl->_start_mainSection();
		$this->Tpl->Separator(20);
        $this->Tpl->_do_pageHead("Free Loot");
        $this->User->AuthCMS();
            echo ' <form method="post">';
            $this->FreeRewards->_do_freeRewards();
            # Spinner
            echo '<div class="wrapper_spinner" id="spinner" style="display: none;">';
            echo '<div class="transparent"></div>';
                echo '<div class="spinner">';
                    echo '<img src="assets/Themes/Standard/images/lootbox/spinner.gif" height="30">';
                echo '</div>';
            echo '</div>';
            echo '<div id="event_description">This will give you an item to help you in the game!</div>';
                echo '<div id="prize_list_title" class="u">Prize List</div>';
                echo '<div class="fieldsetTitle"></div>';
                echo '<fieldset id="wrapper_prizes" class="bordered">';
                if($this->FreeRewards->Query_Items($this->FreeRewards->Columns) != null){
                    foreach($this->FreeRewards->Query_Items($this->FreeRewards->Columns) as $LootBoxItems){
                        echo '<div class="wrapper_prize">';
                            echo '<div class="prize_name">'.$LootBoxItems["ItemName"].'x'.$LootBoxItems["ItemCount"].'</div>';
                            echo '<span class="wrapper_icon">';
                                echo '<img class="prize_icon" src="assets/Themes/Standard/images/lootbox/icons/'.$LootBoxItems["ItemIconUrl"].'">';
                            echo '</span>';
                            echo '<span class="wrapper_desc">';
                                echo '<p>'.$LootBoxItems["ItemDescription"].'</p>';
                            echo '</span>';
                        echo '</div>';
                    }
                }else{
                    echo 'No Items Found!';
                }
                echo '</fieldset>';
            echo '</form>';
		$this->Tpl->_do_pageFooter();
		$this->Tpl->Separator(20);
	$this->Tpl->_end_mainSection();
?>

<script>
    function spinner(){
        var spinner = document.getElementById("spinner");
        spinner.style.display = "block";
    }
</script>