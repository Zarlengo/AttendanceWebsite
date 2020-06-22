<html><body><a id='p1'></a><a>/</a><a id='p2'></a>

<?php
	require_once'../pages/Load_Script.php';
	require_once 'clientList.php';
		
	$creds = new SourceCredentials($sourcename, $password, array($siteID));
	$usercreds = new UserCredentials($username, $userpass, array($userid));
	$clientService = new MBClientService();
	$clientService->SetDefaultCredentials($creds);
	$clientService->SetDefaultUserCredentials($usercreds);
	$classService = new MBClassService();
	$classService->SetDefaultCredentials($creds);
	$classService->SetDefaultUserCredentials($usercreds);
	$cdsHtml = '';
	$clientIDs = array();
	$ListSize = count($clientList);
			$cnt = 0;

?><script>document.getElementById('p2').innerHTML=<?php echo $ListSize-1; ?>;</script><?
	for ($x = 0; $x < $ListSize; $x++) {//count($clientList)
		
		$clientID = $clientList[$x][0];
		$rankValue = $clientList[$x][3];
		if ($cnt >= 5){
			$clientIDs[] = $clientID;
			$cnt = 0;
		}
		$cnt = $cnt + 1;
		$clientArray = array('Client' => array('ID' => $clientID, 'CustomClientFields' => array('CustomClientField' => array(array('ID' => 28, 'Value' => $rankValue), array('ID' => 4, 'Value' => 'show')))));

		//$result = $clientService->AddOrUpdateClients($clientArray);
		?><script>document.getElementById('p1').innerHTML=<?php echo $x; ?>;</script><?

	}

	$TestclassID = array(22087, 22224);
	echo '<pre>';
	for ($n = 0; $n < count($TestclassID); $n++){
	echo $TestclassID[$n]; echo '<br>';
		$result = $classService->AddClientsToClasses($clientIDs, array($TestclassID[$n]), false, null, null);
		$result = $classService->AddClientsToClasses($clientIDs, array($TestclassID[$n]), false, null, null);
		print_r($result);
	}
	echo '</pre>';
	
	
	echo 'Complete';
//? ><script>window.location.replace(document.referrer);</script></body></html>