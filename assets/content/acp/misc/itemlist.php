<?php
	# Authorization
	$this->User->Auth();
	$this->User->AuthGM();
	
	#	Create DATABASE LOG
	$this->LogSys->createLog("Viewed Item List Log");
	
	#	Form Data
	$count=1;
    $sql = ("
                SELECT * FROM ".$this->db->get_TABLE("SH_ITEMS")." WHERE ItemName NOT LIKE '%?%' ORDER BY ItemName Asc
	");
	$stmt=$this->db->conn->prepare($sql);
	$stmt->execute();

	# Start Template
	$this->Tpl->_do_ACP_pageHeader("","",true,"14","Country (6=AOL/UOF,2=AOL,5=UOF) IF A 1 apears in row signifying a class that is class that wears or uses item. /getitem useing Type space TypeID space Count you want.");
        echo "
        <table class='table table-dark'>
            <tr>
                <td>ItemName</td>
                <td>Type</td>
                <td>TypeID</td>
                <td>Requierd Level</td>
                <td>Country</td>
                <td>Fight/War</td>
                <td>Def/Guard</td>
                <td>Ranger/Sin</td>
                <td>Archer/Hunter</td>
                <td>Mage/Pag</td>
                <td>Priest/Orc</td>
                <td>Max O.J.Stats</td>
                <td>Count Per Stack</td>";
                while($row=$stmt->fetch()){
                    echo "<tr style=\"color:white\">";
                        echo "<td>".$row['ItemID']."</td>";
                        echo "<td>".$row['ItemName']."</td>";
                        echo "<td>".$row['Type']."</td>";
                        echo "<td>".$row['TypeID']."</td>";
                        echo "<td>".$row['Reqlevel']."</td>";
                        echo "<td>".$row['Country']."</td>";
                        echo "<td>".$row['Attackfighter']."</td>";
                        echo "<td>".$row['Defensefighter']."</td>";
                        echo "<td>".$row['Patrolrogue']."</td>";
                        echo "<td>".$row['Shootrogue']."</td>";
                        echo "<td>".$row['Attackmage']."</td>";
                        echo "<td>".$row['ReqWis']."</td>";
                        echo "<td>".$row['Count']."</td>";
                    echo "</tr>";
                    $count++;
                }
        echo "</table>";
    # End Template
	$this->Tpl->_do_ACP_pageFooter();
?>