<html><body><?php
	require_once 'Load_Script.php';

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

		$cds = $result->Class->Visits;
			$arraycnt = 0;
			$arraycnt = count($cds);
			if ($arraycnt > 1) {
				for ($i = 0; $i < $arraycnt; $i++) {
					$clientID = $cds[$i]->ClientId;
					$unpaid = true;
					$checkedIn = $cds[$i]->SignedIn;
					if ($cds[$i]->ServiceName != null) {$unpaid = false;}
					$cdsHtml .= sprintf('<li>%s: %s, %s</li>', $clientID);
					
					$clientList[] = array('ClientID' => $clientID,
									'Unpaid' => $unpaid,
									'CheckedIn' => $checkedIn);
				}
			} elseif ($arraycnt == 1) {
					$clientID = $cds->ClientId;
					$unpaid = true;
					$checkedIn = $cds->SignedIn;
					if ($cds->ServiceName != null) {$unpaid = false;}
					$cdsHtml .= sprintf('<li>%s: %s, %s</li>', $clientID);
					
					$clientList[] = array('ClientID' => $clientID,
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