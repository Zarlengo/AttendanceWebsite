<?php
 
    //require_once '../pages/Run_Script.php';
  
// initialize default credentials
$creds = new SourceCredentials($sourcename, $password, array($siteID));
$usercreds = new UserCredentials($username, $userpass, array($userid));
$clientService = new MBClientService();
$clientService->SetDefaultCredentials($creds);
$clientService->SetDefaultUserCredentials($usercreds);
$cdsHtml = '<div class="container"><div class="row"><div class="col-sm-12"><table id="ClientTable" class="table table-hover table-condensed"><thead><tr><th>Rank</th><th>First Name</th><th>Last Name</th><th></th><th></th><th></th><th></th></tr></thead><tbody>';
$cdsHtmlEnd = '</tbody></table></div></div></div>';

$result = $clientService->GetClients(array());
$cds = toArray($result->GetClientsResult->Clients->Client);

$dropStringPre = '<div class="dropdown"><button class="btn btn-default dropdown-toggle" id="cLabel" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" ';
$dropStringStyleHide = 'style="background-color:grey;color:#000;width:160px">';
$dropStringStyleShow = 'style="background-color:#337ab7;color:#fff;width:160px">';
$dropStringSuf = '</button><ul id="class_type" class="dropdown-menu" aria-labelledby="dLabel" style="background-color:grey;"><li id="Hidden_Menu" align="center"><a>No Rank</a></li><li id="Little_Ninja_Menu" align="center"><a>Little Ninjas</a></li><li id="Children_Menu" align="center"><a>Childrens Karate</a></li><li id="Adult_Menu" align="center"><a>Teens/Adult Karate</a></li></ul></div>';
			
$showString = '<div class="btn-group" data-toggle="buttons" style="vertical-align:middle"><label class="btn btn-primary active hide_show"><input type="checkbox" autocomplete="off">Shown</label></div>';
$hideString = '<div class="btn-group" data-toggle="buttons" style="vertical-align:middle"><label class="btn btn-default active hide_show"><input type="checkbox" autocomplete="off">No Rank</label></div>';

$buttonString = '<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal" style="vertical-align:middle">Change Rank</button>';
$inactiveString = '<button type="button" class="btn btn-secondary inactiveButton" data-toggle="modal" style="vertical-align:middle">Inactive</button>';
$activeString = '<button type="button" class="btn btn-primary inactiveButton" data-toggle="modal" style="vertical-align:middle">Active</button>';

$buttonStringPre = '<div class="dropdown"><button class="btn btn-default dropdown-toggle" id="dLabel" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="background-color:#337ab7;color:#fff">Change Rank<span class="caret"></span></button>';

$buttonStringHidden ='<div class="dropdown"><button class="btn btn-default dropdown-toggle" id="dLabel" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="background-color:grey;color:#000" disabled>Change Rank<span class="caret"></span></button>
						<ul class="dropdown-menu dropdown-menu-right" aria-labelledby="dLabel" style="background-color:grey;width:320px"></ul>';
						
$buttonString = $buttonStringPre.$buttonStringLittle;
$buttonStringChild = "<ul id='belt_change' class='dropdown-menu dropdown-menu-right' aria-labelledby='dLabel' style='background-color:grey;width:320px'>
						<li id='1.00' class='Children'><a><img style='vertical-align:middle' src='belts/W.png'>&nbsp;White Belt</a></li>
						<li id='1.01' class='Children'><a><img style='vertical-align:middle' src='belts/W1Y.png'>&nbsp;1 Yellow Stripe</a></li>
						<li id='1.02' class='Children'><a><img style='vertical-align:middle' src='belts/W2Y.png'>&nbsp;2 Yellow Stripes</a></li>
						<li id='1.03' class='Children'><a><img style='vertical-align:middle' src='belts/Y.png'>&nbsp;Yellow Belt</a></li>
						<li id='1.04' class='Children'><a><img style='vertical-align:middle' src='belts/Y1P.png'>&nbsp;Purple Stripe</a></li>
						<li id='1.05' class='Children'><a><img style='vertical-align:middle' src='belts/Y2P.png'>&nbsp;2 Purple Stripes</a></li>
						<li id='1.06' class='Children'><a><img style='vertical-align:middle' src='belts/P.png'>&nbsp;Purple Belt</a></li>
						<li id='1.07' class='Children'><a><img style='vertical-align:middle' src='belts/P1Bl.png'>&nbsp;1 Blue Stripe</a></li>
						<li id='1.08' class='Children'><a><img style='vertical-align:middle' src='belts/P2Bl.png'>&nbsp;2 Blue Stripes</a></li>
						<li id='1.09' class='Children'><a><img style='vertical-align:middle' src='belts/Bl.png'>&nbsp;Blue Belt</a></li>
						<li id='1.10' class='Children'><a><img style='vertical-align:middle' src='belts/Bl1G.png'>&nbsp;1 Green Stripe</a></li>
						<li id='1.11' class='Children'><a><img style='vertical-align:middle' src='belts/Bl2G.png'>&nbsp;2 Green Stripes</a></li>
						<li id='1.12' class='Children'><a><img style='vertical-align:middle' src='belts/G.png'>&nbsp;Green Belt</a></li>
						<li id='1.13' class='Children'><a><img style='vertical-align:middle' src='belts/G1Br.png'>&nbsp;1 Brown Stripe</a></li>
						<li id='1.14' class='Children'><a><img style='vertical-align:middle' src='belts/G2Br.png'>&nbsp;2 Brown Stripes</a></li>
						<li id='1.15' class='Children'><a><img style='vertical-align:middle' src='belts/G3Br.png'>&nbsp;3 Brown Stripes</a></li>
						<li id='1.16' class='Children'><a><img style='vertical-align:middle' src='belts/G4Br.png'>&nbsp;4 Brown Stripes</a></li>
						<li id='1.17' class='Children'><a><img style='vertical-align:middle' src='belts/Br.png'>&nbsp;Brown Belt</a></li>
						<li id='1.18' class='Children'><a><img style='vertical-align:middle' src='belts/Br1Bk.png'>&nbsp;1 Black Stripe</a></li>
						<li id='1.19' class='Children'><a><img style='vertical-align:middle' src='belts/Br2Bk.png'>&nbsp;2 Black Stripes</a></li>
						<li id='1.20' class='Children'><a><img style='vertical-align:middle' src='belts/Br3Bk.png'>&nbsp;3 Black Stripes</a></li>
						<li id='1.21' class='Children'><a><img style='vertical-align:middle' src='belts/Br4Bk.png'>&nbsp;4 Black Stripes</a></li>
						<li id='1.22' class='Children'><a><img style='vertical-align:middle' src='belts/Bk.png'>&nbsp;Black Belt</a></li>
						<li id='1.23' class='Children'><a><img style='vertical-align:middle' src='belts/Bk1R.png'>&nbsp;Shodan</a></li></ul></div>";
						
						
						
$buttonStringAdult = "<ul id='belt_change' class='dropdown-menu dropdown-menu-right' aria-labelledby='dLabel' style='background-color:grey;width:320px'>
						<li id='2.00' class='Adult'><a><img style='vertical-align:middle' src='belts/W.png'>&nbsp;White Belt</a></li>
						<li id='2.01' class='Adult'><a><img style='vertical-align:middle' src='belts/W1G.png'>&nbsp;1 Green Stripe</a></li>
						<li id='2.02' class='Adult'><a><img style='vertical-align:middle' src='belts/W2G.png'>&nbsp;2 Green Stripes</a></li>
						<li id='2.03' class='Adult'><a><img style='vertical-align:middle' src='belts/G.png'>&nbsp;Green Belt</a></li>
						<li id='2.04' class='Adult'><a><img style='vertical-align:middle' src='belts/G1Br.png'>&nbsp;1 Brown Stripe</a></li>
						<li id='2.05' class='Adult'><a><img style='vertical-align:middle' src='belts/G2Br.png'>&nbsp;2 Brown Stripes</a></li>
						<li id='2.06' class='Adult'><a><img style='vertical-align:middle' src='belts/Br.png'>&nbsp;Brown Belt</a></li>
						<li id='2.07' class='Adult'><a><img style='vertical-align:middle' src='belts/Br1Bk.png'>&nbsp;1 Black Stripe</a></li>
						<li id='2.08' class='Adult'><a><img style='vertical-align:middle' src='belts/Br2Bk.png'>&nbsp;2 Black Stripes</a></li>
						<li id='2.09' class='Adult'><a><img style='vertical-align:middle' src='belts/Bk.png'>&nbsp;Black Belt</a></li>
						<li id='2.10' class='Adult'><a><img style='vertical-align:middle' src='belts/Bk1R.png'>&nbsp;Shodan</a></li>
						<li id='2.11' class='Adult'><a><img style='vertical-align:middle' src='belts/Bk2R.png'>&nbsp;Nidan</a></li>
						<li id='2.12' class='Adult'><a><img style='vertical-align:middle' src='belts/Bk3R.png'>&nbsp;Sandan</a></li>
						<li id='2.13' class='Adult'><a><img style='vertical-align:middle' src='belts/Bk4R.png'>&nbsp;Yondan</a></li>
						<li id='2.14' class='Adult'><a><img style='vertical-align:middle' src='belts/Go.png'>&nbsp;Godan</a></li>
						<li id='2.15' class='Adult'><a><img style='vertical-align:middle' src='belts/Ro.png'>&nbsp;Rokudan</a></li>
						<li id='2.16' class='Adult'><a><img style='vertical-align:middle' src='belts/Sh.png'>&nbsp;Shichidan</a></li>
					</ul></div>";





$clientList = array();
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
	if ($rankID !== null){
		if (preg_match($regex, $rankID)) {
			$beltRank = $beltList[$rankID]['Image_Loc'];}
	}
	$clientList[] =  array ('ID' => $rankID, 'ClientID' => $cd->ID, 'Rank' => $beltRank, 'FirstName' => $cd->FirstName, 'LastName' => $cd->LastName, 'Nickname' => $cd->NickName, 'Active' => $activeID);
		
}
usort($clientList, compare_fullname);
foreach ($clientList as $cLs) {
	if ($cLs['Rank'] === null) {
		$imgRank = null;
		$dropStringMid = $dropStringStyleHide.'No Rank<span class="caret"></span>';
		$buttonString = $buttonStringHidden;
	} else {
		$imgRank = '<img  style="vertical-align:middle" src="belts/' . $cLs['Rank'] . '" style="width:180px;height:20px;">';
		$rankGrp = intval($cLs['ID'][0]);
		switch ($rankGrp){
			case 0:
				$dropStringMid = $dropStringStyleShow.'Little Ninjas<span class="caret"></span>';
				$buttonString = $buttonStringHidden;
				break;
			case 1:
				$dropStringMid = $dropStringStyleShow.'Childrens Karate<span class="caret"></span>';
				$buttonString = $buttonStringPre.$buttonStringChild;
				break;
			case 2:
				$dropStringMid = $dropStringStyleShow.'Teens/Adult Karate<span class="caret"></span>';
				$buttonString = $buttonStringPre.$buttonStringAdult;
				break;
			default:
				$dropStringMid = $dropStringStyleHide.'No Rank<span class="caret"></span>';
				$buttonString = $buttonStringHidden;
		}
	}
	if ($cLs['Active'] == 'show') {
		$showString = $activeString;
	} else {
		$showString = $inactiveString;
	}
	$slideString = $dropStringPre.$dropStringMid.$dropStringSuf;
	
	$cdsHtml .= sprintf('<tr class="clientList" id="'.$cLs['ClientID'].'" rank1="'.$cLs['ID'].'" style="vertical-align:middle">
							<td id="RankImg" style="vertical-align:middle">'.$imgRank.'</td>
							<td id="FirstName" style="vertical-align:middle">%s</td>
							<td id="LastName" style="vertical-align:middle">%s</td>
							<td style="vertical-align:middle">
								<img class="CNStatus" src="icons/CNLogo_Small.png" style="display:none; width:40px; height:40px;"></td>
							<td>'.$showString.'</td><td>'.$slideString.'</td><td>'.$buttonString.'</td></tr>',
				$cLs['FirstName'], $cLs['LastName']);
}

echo($cdsHtml);

// -------------------------------------- 
  function compare_fullname($a, $b)
  {
    // sort by last name

	$retval = strnatcmp($a['LastName'], $b['LastName']);
	if(!$retval) {
		$retval = strnatcmp($a['FirstName'], $b['FirstName']);
	}
    return $retval;
  }


// -------------------------------------- 
?>