<?php
 
   // require_once '../pages/Load_Script.php';
  
// initialize default credentials
$creds = new SourceCredentials($sourcename, $password, array($siteID));
$usercreds = new UserCredentials($username, $userpass, array($userid));
$clientService = new MBClientService();
$clientService->SetDefaultCredentials($creds);
$clientService->SetDefaultUserCredentials($usercreds);
$cdsClient =   '<div class="container"><div class="container-fluid"><div class="row"><div class="col-sm-12"><table id="ClientTable" class="table table-hover table-condensed"><thead><tr><th>Rank</th><th>First Name</th><th>Last Name</th></tr></thead><tbody>';
$cdsEnd = '</tbody></table></div></div></div></div>';

$result = $clientService->GetClients(array());
$cds = toArray($result->GetClientsResult->Clients->Client);

$buttonString = '<div><button type="button" class="btn btn-secondary" id = "attCheck">Absent</button></div>';
$instructButtonString = '<div><button type="button" class="btn btn-secondary" id = "instructCheck" style="display:none">Not Teaching</button>';
$instructButtonString .= '<button type="button" class="btn btn-secondary" id = "testCheck" style="display:none">Testing</button></div>';



$clientList = array();
$cnt = 0;

$regex = '/\d\.\d{2}/';
foreach ($cds as $cd) {
	$rankID = null;
	$beltRank = null;
	$activeID = 'hide';
	$array = json_decode(json_encode($cd->CustomClientFields->CustomClientField), True);
	if (is_array($array[0])) {
		$key = array_search($customRankID, array_column($array, 'ID'));
		$key2 = array_search($customShowAtt, array_column($array, 'ID'));
		if ($key !== false) {
			$rankID = $array[$key]['Value'];
		}
		if ($key2 !== false) {
			$activeID = $array[$key2]['Value'];
		}
	} elseif ($array['ID'] == $customRankID) {
		$rankID = $array['Value'];
	} elseif ($array['ID'] == $customShowAtt) {
		$activeID = $array['Value'];
	}
		
	if (($rankID !== null) && ($activeID == 'show')){
		if (preg_match($regex, $rankID)) {
			$beltRank = $beltList[$rankID]['Image_Loc'];
			$clientList[] =  array ('ID' => $rankID, 'ClientID' => $cd->ID, 'Rank' => $beltRank, 'FirstName' => $cd->FirstName, 'LastName' => $cd->LastName, 'Nickname' => $cd->NickName);
		} 
	}
}
usort($clientList, compare_fullname);

foreach ($clientList as $cLs) {
	if ($cLs['ID'] >= 2.00) {
		$bgColor = "#999999";		
	} else {
		$bgColor = null;		
	}
	$imgRank = '<img  style="vertical-align:middle" src="belts/' . $cLs['Rank'] . '" style="width:180px;height:20px;">';
	$clientString = sprintf('id='.$cLs['ClientID'].' rank1='.$cLs['ID'].' style="vertical-align:middle" bgcolor="'.$bgColor.'"><td style="vertical-align:middle">'.$imgRank.'</td><td style="vertical-align:middle">%s</td><td style="vertical-align:middle">%s</td><td style="vertical-align:middle"><img class="CNStatus" src="icons/CNLogo_Small.png" style="display:none; width:40px; height:40px;"></td><td align="center">'.$buttonString.'</td><td align="center">'.$instructButtonString.'</td></tr>',
				$cLs['FirstName'], $cLs['LastName']);
	$cdsClient 	.= sprintf('<tr class="clientList" '). $clientString;	
	

}

	$cdsClient .= sprintf('<tr class="clientList" id="NoMatches"><td></td><td>%s</td><td>%s</td><td></td></tr>',
				'No', 'Matches');

				
	$cdsClient .=	$cdsEnd;
	echo($cdsClient);
	

// -------------------------------------- 
  function compare_fullname($a, $b)
  {
    // sort by last name
    $retval = strnatcmp($a['ID'], $b['ID']);
    // if last names are identical, sort by first name
    if(!$retval) {
		$retval = strnatcmp($a['FirstName'], $b['FirstName']);
		if(!$retval) {
			$retval = strnatcmp($a['LastName'], $b['LastName']);
	}}
    return $retval;
  }


// -------------------------------------- 
?>