<?php
    class GuildRanking{
        private $res;
        
        function __construct($db){
			$this->db		=	$db;
        }
        function _get_Guild_Rankings(){
            $this->sql = ("
                            SELECT TOP 15* FROM PS_GameData.dbo.Guilds AS [G]
                            INNER JOIN PS_GameData.dbo.GuildDetails AS [GD] ON [GD].[GuildID] = [G].[GuildID]
                            WHERE DEL=:Del AND GuildPoint!=:GuildPoint ORDER BY GuildPoint DESC
	        ");
            $this->query=$this->db->conn->prepare($this->sql);
            $this->params = array(0,0);
			$this->query->execute($this->params);
                echo '<div class="table-responsive">';
		            echo '<table class="table table-sm table-dark table-striped tac">';
			            echo '<thead>';
				            echo '<tr class="boss-record">';
                                echo '<th class="boss-record">Rank</th>';
                                echo '<th class="boss-record">Guild Name</th>';
                                echo '<th class="boss-record">Guild Leader</th>';
                                echo '<th class="boss-record">Members</th>';
                                echo '<th class="boss-record">Points</th>';
                                echo '<th class="boss-record">Faction</th>';
				            echo '</tr>';
			            echo '</thead>';
                        echo '<tbody>';
                        while($getData=$this->query->fetch()){
				                echo '<tr>';
                                    echo '<td>'.$getData['Rank'].'</td>';
                                    echo '<td>'.$getData['GuildName'].'</td>';
                                    echo '<td>'.$getData['MasterName'].'</td>';
                                    echo '<td>'.$getData['TotalCount'].'</td>';
                                    echo '<td>'.$getData['GuildPoint'].'</td>';
                                        if($getData['Country']==0){
                                            echo '<td><img src="assets/Themes/Standard/images/icons/guildranking/aol.png" height="35" width="35"></td>';
                                        }
                                        if($getData['Country']==1){
                                            echo '<td><img src="assets/Themes/Standard/images/icons/guildranking/uof.png" height="35" width="35"></td>';
                                        }
                                echo '</tr>';
                                    }
			            echo '</tbody>';
		            echo '</table>';
	            echo '</div>';
        }
        function _get_Guild_Rankings_Plugin(){
            $this->sql = ("
                            SELECT TOP 15* FROM PS_GameData.dbo.Guilds AS [G]
                            INNER JOIN PS_GameData.dbo.GuildDetails AS [GD] ON [GD].[GuildID] = [G].[GuildID]
                            WHERE DEL=? AND GuildPoint!=? ORDER BY GuildPoint DESC
	        ");
            $this->query=$this->db->conn->prepare($this->sql);
            $this->params = array(0,0);
			$this->query->execute($this->params);
                echo '<div class="table-responsive">';
		            echo '<table class="table table-sm table-dark table-striped tac">';
			            echo '<thead>';
				            echo '<tr class="boss-record">';
                                echo '<th class="boss-record">Rank</th>';
                                echo '<th class="boss-record">Guild Name</th>';
                                echo '<th class="boss-record">Members</th>';
                                echo '<th class="boss-record">Faction</th>';
				            echo '</tr>';
			            echo '</thead>';
			            echo '<tbody>';
                            while($getData=$this->query->fetch()){
				                echo '<tr>';
                                    echo '<td>'.$getData['Rank'].'</td>';
                                    echo '<td>'.$getData['GuildName'].'</td>';
                                    echo '<td>'.$getData['TotalCount'].'</td>';
                                        if($getData['Country']==1){
                                            echo '<td><img src="assets/Themes/Standard/images/icons/guildranking/aol.png" height="35" width="35"></td>';
                                        }
                                        if($getData['Country']==0){
                                            echo '<td><img src="assets/Themes/Standard/images/icons/guildranking/uof.png" height="35" width="35"></td>';
                                        }
				                echo '</tr>';
			                }
			            echo '</tbody>';
		            echo '</table>';
	            echo '</div>';
        }
    }
?>