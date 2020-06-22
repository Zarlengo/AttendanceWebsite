<?php
	require_once'Load_Script.php';
	require_once '../includes/Classes_Variable.php';
	// initialize default credentials
	$creds = new SourceCredentials($sourcename, $password, array($siteID));
	$usercreds = new UserCredentials($username, $userpass, array($userid));
	$classService = new MBClassService();
	$classService->SetDefaultCredentials($creds);
	$classService->SetDefaultUserCredentials($usercreds);
	$startDate = date(DateTime::ATOM);
	$endDate = DateTime::createFromFormat('m/d/Y', '12/31/2020');
	$endDate = date_format($endDate, DateTime::ATOM);
	$classDescriptionIDs = array(301);
	$result = $classService->GetClasses($classDescriptionIDs, array(), array(), $startDate, $endDate, null, null, 0);
	echo '<pre>';
	print_r($result);
	echo '</pre>';
	$cdsHtml = null;
	$nextID = null;
	if($result->GetClassesResult->ResultCount !== 0){
		$cls = toArray($result->GetClassesResult->Classes->Class);
		$cds = array();
		foreach ($cls as $cl) {
			$cds[] = array('ClassTime' => $cl->StartDateTime,
							'ClassID' => $cl->ID,
							'ScheduleID' => $cl->ClassScheduleID,
							'ClassName' => $cl->ClassDescription->Name,
							'Dues' => $Class_Session[$cl->ClassDescription->ID][Dues]);
		}
		asort($cds);
		foreach ($cds as $cd) {
			if ($TestMode == True) {//DELETE
				if ($cd['ClassID'] == 22087 || $cd['ClassID'] == 22224){//DELETE
					if ($cd['Dues'] == true){
						$classDate = date("m/d/Y", strtotime($cd[ClassTime]));				
						$cd_class = 'duesList';
						$cdsHtml .= sprintf(
								'<li id='.$cd['ScheduleID'].' classID="'.$cd['ClassID'].'" class="'.$cd_class.'" classDate="'.$classDate.'">
								<a href="#">%s     (%s)</a></li>',
								$cd[ClassName],
								date("m/d/Y", strtotime($cd[ClassTime])));
					} 
				}//DELETE
			}//DELETE
		}
		echo($cdsHtml);
	}
?>