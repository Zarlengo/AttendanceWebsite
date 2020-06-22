<?php
	require_once 'Load_Script.php';

	// initialize default credentials
	$creds = new SourceCredentials($sourcename, $password, array($siteID));
	$usercreds = new UserCredentials($username, $userpass, array($userid));
	$classService = new MBClassService();
	$classService->SetDefaultCredentials($creds);
	$classService->SetDefaultUserCredentials($usercreds);
/*
	$clientService = new MBClientService();
	$clientService->SetDefaultCredentials($creds);
	$clientService->SetDefaultUserCredentials($usercreds);
*/
	// get a list of upcoming classes
	
	$result = $classService->GetClassVisits($CNclassID);
	$cds = $result->Class->Visits;
	$arraycnt = count($cds);
	for ($i = 0; $i < $arraycnt; $i++) {
		if ($cds[$i]->ServiceName != null) {
			$clientID = $cds[$i]->ClientId;
			$unpaid = false;
			$cdsHtml .= sprintf('<li>%s</li>', $clientID);
			
			$clientList[] = array('ClientId' => $clientID,
							'Unpaid' => $unpaid);
		}
	}
?><html><body><?php
	echo json_encode($clientList);

?></body></html>