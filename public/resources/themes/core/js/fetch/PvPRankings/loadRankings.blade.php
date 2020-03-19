@php
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
@endphp
  	@if(is_array($decoded))
  	    @php
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
        @endphp
        @if ($stmt->execute())
            @php
        	$res    =   $stmt->fetchAll();
    	    $rowCount   =   count($res);
            @endphp
            </div>
                            </div>
                        </div>
    	    <div class="col-md-9 ">
                        {{Pagination::showPages_Rankings($records_per_page,$prevPage,$nextPage,$page)}}
                    </div>
            @if(count($Rankings->data) > 0)
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
                            @foreach($res as $data)
                                @php
                                    $RankNum++;
                                    $Faction    =   $Rankings->get_Faction($data['Country']);
                                    $Class      =   $Rankings->get_Class($data['Country'],$data['Job']);
                                    $getRank    =   $Rankings->get_Rank($data['K1']);
                                @endphp
                                <tr>
                                    <td>{{$RankNum}}</td>
                                    <td>{{$data['CharName']}}</td>
                                    <td>{{$Faction}}</td>
                                    <td class="IconHolder" width="10">
                                        <span class="{{$Faction}}">
                                            <span class="ClassIcon {{$Class}}" title="{{htmlspecialchars($Class)}}"></span>
                                        </span>
                                    </td>
                                    <td>{{$data['Level']}}</td>
                                    <td>test</td>
                                    <td>{{$data['K1']}}</td>
                                    <td>{{$data['K2']}}</td>
                                    <td>
                                        <span class="RankIcon Rank{{$getRank}}" title="Rank{{$getRank}}"></span>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @endif
        @endif
    @endif