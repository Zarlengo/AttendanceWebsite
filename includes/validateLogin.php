<?php
		
if($_REQUEST["sourcename"] && $_REQUEST["password"] && $_REQUEST["siteID"] && $_REQUEST["username"] && $_REQUEST["userpass"] && $_REQUEST["userid"]) {
	
	$sourcename =	$_REQUEST["sourcename"];
	$password =		$_REQUEST["password"];
	$siteID = 		$_REQUEST["siteID"];
	$username =		$_REQUEST["username"];
	$userpass = 	$_REQUEST["userpass"];
	$userid = 		$_REQUEST["userid"];
	
		require_once('mbApi.php');
		require_once('clientService.php');
			
			
			
			
			
			$creds = new SourceCredentials($sourcename, $password, array($siteID));
			$usercreds = new UserCredentials($username, $userpass, array($userid));
			$clientService = new MBClientService();
			$clientService->SetDefaultCredentials($creds);
			$clientService->SetDefaultUserCredentials($usercreds);

			//public function ValidateLogin($username, $password, $PageSize = null, $CurrentPage = null, $XMLDetail = XMLDetail::Full, $Fields = null, SourceCredentials $credentials = null)
			
			echo ('<pre>');
			print_r($clientService);
			$result = $clientService->GetClients(array());
			echo '<br>***<br>';
			print_r($result);
			echo '<br>***<br>';
			echo ('</pre>');
			
} else {
}
?>