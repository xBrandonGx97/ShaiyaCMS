<?php

	$db			    =	new Classes\DB\MSSQL;
	$Data		    =	new Classes\Utils\Data();
	$pagingHelper	=	new Classes\Utils\PagingHelper($pagingData=false);
	$Rank_DAO		=	new Classes\Shaiya\Rank_DAO($Data,$db,$pagingHelper);

	if(!isset($_POST)){
		return;
	}

    // Ranking configuration and definition of valid user inputs
	$defaultPageIndex				=	0;
	$defaultPageSize				=	25;
	$validPageSizes					=	array(5,10,25,100); // This determines valid values for how many results can be displayed on a page.
	$validOrderBys					=	array('K1','K2','KDR'); // This determines valid values for how the results can be ordered on a page.
	$validPageDirections			=	array('ASC','DESC'); // This determines valid values for how the direction results can be sorted on a page.

    // Gather valid user input from the user's POST request
	$pagingData						=	array();
	$pagingData['pageIndex']		=	isset($_POST['pageIndex']) && (!empty($_POST['pageIndex']) && is_numeric($_POST['pageIndex'])) && $_POST['pageIndex'] >= 0 ? $_POST['pageIndex'] : $defaultPageIndex;
	$pagingData['pageSize']			=	isset($_POST['pageSize']) && (!empty($_POST['pageIndex']) && is_numeric($_POST['pageSize'])) && in_array($_POST['pageSize'],$validPageSizes) ? $_POST['pageSize'] : $defaultPageSize;
	$pagingData['pageOrder']		=	isset($_POST['pageOrder']) && !empty($_POST['pageOrder']) && in_array($_POST['pageOrder'],$validOrderBys) ? $_POST['pageOrder'] : 'K1';
	$pagingData['pageDirection']	=	isset($_POST['pageDirection']) && !empty($_POST['pageDirection']) && in_array($_POST['pageDirection'],$validPageDirections) ? $_POST['pageDirection'] : 'DESC';

	$pagingData['level']			=	isset($_POST['level']) && (!empty($_POST['level']) || is_numeric($_POST['level'])) ? $_POST['level'] : 0;
	$pagingData['class']			=	isset($_POST['class']) && (!empty($_POST['class']) || is_numeric($_POST['class'])) ? $_POST['class'] : 0;
	$pagingData['faction']			=	isset($_POST['faction']) && (!empty($_POST['faction']) || is_numeric($_POST['faction'])) ? $_POST['faction'] : 0;

	$characterRanks					=	$Rank_DAO->getCharacterRanks($pagingData);
	$pagingData['totalResults']		=	isset($characterRanks['TotalCount']) ? $characterRanks['TotalCount'] : 0;

	$pagingHelper	=	new Classes\Utils\PagingHelper($pagingData);

	$Rank_DAO->_get_rank_view($characterRanks);
?>