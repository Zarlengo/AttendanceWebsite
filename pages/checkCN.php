<html><body><?php
	require_once'Load_Script.php';

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
	$cds = $result->GetClassVisitsResult->Class->Visits->Visit;
	$arraycnt = count($cds);
	for ($i = 0; $i < $arraycnt; $i++) {
		if (strpos($cds[$i]->Service->Name, "Unpaid") === false) {
			$clientID = $cds[$i]->Client->ID;
			$clientFirst = $cds[$i]->Client->FirstName;
			$clientLast = $cds[$i]->Client->LastName;
			$unpaid = false;
			$cdsHtml .= sprintf('<li>%s: %s, %s</li>', $clientID, $clientLast, $clientFirst);
			
			$clientList[] = array('ClientID' => $clientID,
							'ClientFirst' => $clientFirst,
							'ClientLast' => $clientLast,
							'Unpaid' => $unpaid);
		}
	}
	echo json_encode($clientList);

?></body></html>