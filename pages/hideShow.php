<?php
		require_once'../pages/Load_Script.php';
// initialize default credentials
$creds = new SourceCredentials($sourcename, $password, array($siteID));
$usercreds = new UserCredentials($username, $userpass, array($userid));
$clientService = new MBClientService();
$clientService->SetDefaultCredentials($creds);
$clientService->SetDefaultUserCredentials($usercreds);

$today = new DateTime;
$today = date_format($today, 'Y-m-d');

if ($_GET['showID'] == 'ignore') {
	$clientArray = array('Id' => $_GET['clientID'], 'CustomClientFields' => array(	array('ID' => $customRankID, 'Value' => $_GET['rank']), 
																					array('ID' => $customRankDate, 'Value' => $today)));
} else {
	$clientArray = array('Id' => $_GET['clientID'], 'CustomClientFields' => array(array('ID' => $customShowAtt, 'Value' => $_GET['showID'])));
}
$result = $clientService->AddOrUpdateClients($clientArray);
?>

