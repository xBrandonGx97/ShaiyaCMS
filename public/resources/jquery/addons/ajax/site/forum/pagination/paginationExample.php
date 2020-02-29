<?php
	define('AJAX_CALL', true);
	# Autoloader
	require_once($_SERVER['DOCUMENT_ROOT'] . "/../app/bootstrap.php");
	Bootstrap::_is_ajax();
	
	use \Classes\Utils\Data;
	use \Classes\DB\MSSQL;
	use \Classes\Utils\Session;
	
	Session::init('Default');
	
	$records_per_page	=	5;
	$page	=	'';
	$output = 	'';
	
	if(isset($_POST['page'])) {
		$page	=	$_POST['page'];
	} else {
		$page	=	1;
	}
	
	$start_from	=	($page	-	1)*$records_per_page;
	
	#echo 'start from: '.$start_from;
	
	$sql=("
			SELECT PostID, PostBody FROM ShaiyaCMS.dbo.FORUM_POSTS ORDER BY PostID ASC OFFSET $start_from ROWS FETCH NEXT $records_per_page ROWS ONLY
	");
  	$stmt   =   MSSQL::connect()->prepare($sql);
    if ($stmt->execute()) {
    	#echo 'yes';
    	while($data=$stmt->fetch()){
    		echo $data['PostBody'].'<br>';
		}
		$sql=("
				SELECT * FROM ShaiyaCMS.dbo.FORUM_POSTS ORDER BY PostID DESC
		");
  		$stmt   =   MSSQL::connect()->prepare($sql);
  		$stmt->execute();
  		$result = 	$stmt->fetchAll();
  		$total_records	=	count($result);
  		$total_pages	=	ceil($total_records/$records_per_page);
  		for ($i=1; $i<=$total_pages; $i++) {
  			$output.= '<a class="pagination_link" id="'.$i.'">'.$i.'</a>';
		}
	}
    
    echo $output;
?>
<script>
	$(".pagination_link").click(function() {
	    const page = $(this).attr("id");
        load_data(page);
    })
</script>