<html><body><?php
	require_once'Load_Script.php';

	// initialize default credentials
	$creds = new SourceCredentials($sourcename, $password, array($siteID));
	$usercreds = new UserCredentials($username, $userpass, array($userid));
	$classService = new MBClassService();
	$classService->SetDefaultCredentials($creds);
	$classService->SetDefaultUserCredentials($usercreds);

	$clientService = new MBClientService();
	$clientService->SetDefaultCredentials($creds);
	$clientService->SetDefaultUserCredentials($usercreds);

	// get a list of upcoming classes
	
	if($_REQUEST["ClassID"] ) {
		$classID = $_REQUEST['ClassID'];
		$result = $classService->GetClassVisits($classID);
		$cds = $result->GetClassVisitsResult->Class->Visits->Visit;
			$arraycnt = 0;
			$arraycnt = count($cds);
			if ($arraycnt > 1) {
				for ($i = 0; $i < $arraycnt; $i++) {
					$clientID = $cds[$i]->Client->ID;
					$clientFirst = $cds[$i]->Client->FirstName;
					$clientLast = $cds[$i]->Client->LastName;
					$unpaid = true;
					$checkedIn = $cds[$i]->SignedIn;
					if (strpos($cds[$i]->Service->Name, "Unpaid") === false) {$unpaid = false;}
					$cdsHtml .= sprintf('<li>%s: %s, %s</li>', $clientID, $clientLast, $clientFirst);
					
					$clientList[] = array('ClientID' => $clientID,
									'ClientFirst' => $clientFirst,
									'ClientLast' => $clientLast,
									'Unpaid' => $unpaid,
									'CheckedIn' => $checkedIn);
				}
			} elseif ($arraycnt == 1) {
					$clientID = $cds->Client->ID;
					$clientFirst = $cds->Client->FirstName;
					$clientLast = $cds->Client->LastName;
					$unpaid = true;
					$checkedIn = $cds->SignedIn;
					if (strpos($cds->Service->Name, "Unpaid") === false) {$unpaid = false;}
					$cdsHtml .= sprintf('<li>%s: %s, %s</li>', $clientID, $clientLast, $clientFirst);
					
					$clientList[] = array('ClientID' => $clientID,
									'ClientFirst' => $clientFirst,
									'ClientLast' => $clientLast,
									'Unpaid' => $unpaid,
									'CheckedIn' => $checkedIn);
			} else {
				$clientList[] = null;
			}
			echo json_encode($clientList);
	} else {
	echo
		json_encode(null);
	}
?></body></html>