<?php
		require_once'../pages/Load_Script.php';
		require_once'../includes/Belt_List.php';
// initialize default credentials
$creds = new SourceCredentials($sourcename, $password, array($siteID));
$usercreds = new UserCredentials($username, $userpass, array($userid));
$clientService = new MBClientService();
$clientService->SetDefaultCredentials($creds);
$clientService->SetDefaultUserCredentials($usercreds);

$classService = new MBClassService();
$classService->SetDefaultCredentials($creds);
$classService->SetDefaultUserCredentials($usercreds);

$rankChange = $_GET['rankChange'];
$clientID = $_GET['clientID'];
$classID = $_GET['classID'];
$rankID = number_format((float)$_GET['rankID'] + $rankChange, 2);
$beltRank = $beltList[$rankID]['Image_Loc'];



$today = new DateTime;
$today = date_format($today, 'Y-m-d');
$clientArray = array('Client' => array('ID' => $clientID, 'CustomClientFields' => array('CustomClientField' => array(array('ID' => $customRankID, 'Value' => $rankID), array('ID' => $customRankDate, 'Value' => $today)))));

$result = $clientService->AddOrUpdateClients($clientArray);
	
$result2 = $classService->GetClassVisits ($classID);
$cds = toArray($result2->GetClassVisitsResult->Class->Visits->Visit);
if ($rankChange >= 0) {$signIn = true;} else {$signIn = false;}

foreach ($cds as $cd) {
	$visitID = $cd->ID;
	$visitClientID = $cd->Client->ID;
	if ($clientID==$visitClientID) {
		$clientVisits = array('Visit' => array( 'ID' => $visitID, 'SignedIn' => $signIn));
		$result = $classService->UpdateClientVisits($clientVisits);
	}
}
	echo json_encode($rankID.'||'.$beltRank);
?>