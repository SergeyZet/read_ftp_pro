<?php
	require_once 'Base/SimpleSQLClass.php';
	//zero lvl
	
	require_once 'TableTypesRewards.php';
	require_once 'TableThemesExamples.php';
	require_once 'TableUsersRoles.php';
	require_once 'TableRanksUsers.php';
	require_once 'TableCities.php';
	require_once 'TableGroups.php';
	require_once 'TableRolesExamples.php';
	require_once 'TableStructuresTablesEE.php';
	//comlex
	require_once 'TableAvatars.php';
				
	//one lvl
	require_once 'TableRewardsByRaitingsQuality.php';
	require_once 'TableTypesElementaryExamples.php';
	require_once 'TableUsers.php';
	require_once 'TableTypesExamples.php';

	
	
	//two lvl
	require_once 'TableElementaryExamples.php';
	require_once 'TableExamples.php';
	require_once 'TableGroupsRolesUsers.php';

	//three lvl	
	require_once 'TableStructuresLessons.php';
	require_once 'TableRefElemExaWithExamples.php';	
	
	//many tables
	require_once 'TableElemExaByTypesId.php';	
	require_once 'TableHistoryUsersByTypesStructureElemExaId.php';
?>