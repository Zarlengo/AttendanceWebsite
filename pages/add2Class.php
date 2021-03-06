<?php

		require_once 'Load_Script.php';

	// initialize default credentials
	$creds = new SourceCredentials($sourcename, $password, array($siteID));
	$usercreds = new UserCredentials($username, $userpass, array($userid));
	$classService = new MBClassService();
	$classService->SetDefaultCredentials($creds);
	$classService->SetDefaultUserCredentials($usercreds);
	
	$clientID = $_GET['clientID'];
	$classID = $_GET['classID'];
	$classChange = $_GET['classChange'];
	if ($classChange == 'remove'){
		$result = $classService->RemoveClientsFromClasses($clientID, $classID);
	} else {
		$result = $classService->AddClientsToClasses($clientID, $classID);
	}
	?>