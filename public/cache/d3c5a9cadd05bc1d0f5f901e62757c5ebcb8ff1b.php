<?php 
	use \Classes\Utils\Data;
	use \Classes\DB\MSSQL;
	use \Classes\Utils\Session;
	use \Classes\Utils\User;
	use \Classes\Utils\Pagination;

	Session::init('Default');
	require_once($_SERVER['DOCUMENT_ROOT'].'/../app/models/rankings.php');
    $Rankings	=	new Rankings();
    User::run();
    $User	=	User::_fetch_User();

	$records_per_page	=	15;
	$page	=	'';
	$output = 	'';

	$content = trim(file_get_contents("php://input"));

  	$decoded = json_decode($content, true);
 ?>
  	<?php if(is_array($decoded)): ?>
  	    <?php 
  		if(isset($decoded['page'])) {
  			$page	=	$decoded['page'];
        } else {
  			$page   =   1;
        }

  		$prevPage   =   $page-1;
	    $nextPage   =   $page+1;

	    $start_from	=	($page	-	1)*$records_per_page;
	    $RankNum = ($page - 1) * $records_per_page;

	    $Rankings->getRankings();

	    $sql=("
                SELECT u.UserUID, u.UserID, c.CharID, c.CharName, c.Level, c.Family, c.Job, c.K1, c.K2, umg.Country
                FROM PS_GameData.dbo.Chars AS c
                INNER JOIN PS_UserData.dbo.Users_Master AS u ON c.UserUID = u.UserUID
                INNER JOIN PS_GameData.dbo.UserMaxGrow AS umg ON c.UserUID = umg.UserUID
                WHERE c.Del = '0' AND u.Status = '0'
                GROUP BY c.CharID, c.CharName, c.Level, c.Family, c.Job, c.K1, c.K2, umg.Country, u.UserID, u.UserUID
                ORDER BY [c].[K1] DESC, [c].[K2] ASC, [c].[CharName] ASC
                OFFSET $start_from ROWS FETCH NEXT $records_per_page ROWS ONLY
        ");
        $stmt   =   MSSQL::connect()->prepare($sql);
         ?>
        <?php if($stmt->execute()): ?>
            <?php 
        	$res    =   $stmt->fetchAll();
    	    $rowCount   =   count($res);
    	     ?>
    	    <div class="container">
                <div class="row">
                    <div class="col-md-3 order-md-2 text-right">
                        <input type="search" class="form-control form-control-sm" name="search" id="searchBox" placeholder="Search..">
                    </div>
                    <div class="col-md-9 ">
                        <?php echo e(Pagination::showPages_Rankings($records_per_page,$prevPage,$nextPage,$page)); ?>

                    </div>
                </div>
            </div>
            <?php if(count($Rankings->data) > 0): ?>
                <div class="table-responsive">
                    <table class="table table-sm table-dark table-striped tac">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Name</th>
                                <th>Faction</th>
                                <th>Class</th>
                                <th>Level</th>
                                <th>Guild</th>
                                <th>Kills</th>
                                <th>Deaths</th>
                                <th>Rank</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $__currentLoopData = $res; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <?php 
                                    $RankNum++;
                                    $Faction    =   $Rankings->get_Faction($data['Country']);
                                    $Class      =   $Rankings->get_Class($data['Country'],$data['Job']);
                                    $getRank    =   $Rankings->get_Rank($data['K1']);
                                 ?>
                                <tr>
                                    <td><?php echo e($RankNum); ?></td>
                                    <td><?php echo e($data['CharName']); ?></td>
                                    <td><?php echo e($Faction); ?></td>
                                    <td class="IconHolder" width="10">
                                        <span class="<?php echo e($Faction); ?>">
                                            <span class="ClassIcon <?php echo e($Class); ?>" title="<?php echo e(htmlspecialchars($Class)); ?>"></span>
                                        </span>
                                    </td>
                                    <td><?php echo e($data['Level']); ?></td>
                                    <td>test</td>
                                    <td><?php echo e($data['K1']); ?></td>
                                    <td><?php echo e($data['K2']); ?></td>
                                    <td>
                                        <span class="RankIcon Rank<?php echo e($getRank); ?>" title="Rank<?php echo e($getRank); ?>"></span>
                                    </td>
                                </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </tbody>
                    </table>
                </div>
            <?php endif; ?>
        <?php endif; ?>
    <?php endif; ?>