<?php
	require_once'Load_Script.php';
	require_once '../includes/Classes_Variable.php';
	// initialize default credentials
	$creds = new SourceCredentials($sourcename, $password, array($siteID));
	$usercreds = new UserCredentials($username, $userpass, array($userid));
	$classService = new MBClassService();
	$classService->SetDefaultCredentials($creds);
	$classService->SetDefaultUserCredentials($usercreds);
	//$startDate = '2016-03-30T00:00:00+00:00';
	//$endDate = '2016-03-31T00:00:00+00:00';
	//$startDate = date(DateTime::ATOM);
	
	require_once'dateCheck.php';
	if(isset($startDate) !== true) {$startDate = date(DateTime::ATOM);}
	if(isset($endDate) !== true) {$endDate = $startDate;}
	$result = $classService->GetClasses(array(), array(), array(), $startDate, $endDate, null, null, 0);
	$cdsHtml = null;
	$nextID = null;
	if($result->GetClassesResult->ResultCount !== 0){
		$cls = toArray($result->GetClassesResult->Classes->Class);
		$cds = array();
		foreach ($cls as $cl) {
			$cds[] = array('ClassTime' => $cl->StartDateTime,
							'ClassID' => $cl->ID,
							'ScheduleID' => $cl->ClassScheduleID,
							'DescID' => $cl->ClassDescription->ID,
							'ClassName' => $cl->ClassDescription->Name,
							'Assistant' => $Class_Description_ID[$cl->ClassDescription->ID][Assistant],
							'Ignore' => $Class_Description_ID[$cl->ClassDescription->ID][Ignore],
							'Testing' => $Class_Description_ID[$cl->ClassDescription->ID][Testing],
							'CopyFrom' => $Class_Schedule_ID[$cl->ClassScheduleID][CopyFrom]);
		}
	
		asort($cds);
		/*echo '<pre>';
		print_r($cds);
		echo '</pre>';*/
		$nextClass = 0;
		foreach ($cds as $cd) {
			if ( $cd['Testing'] == true ) {
				$testVar = true;
			} 
			if ($cd['Ignore'] != true){
				$classDate = date("H:i", strtotime($cd[ClassTime]));
				$modDate = date("H:i", strtotime($startDate . "- 7 hours - 15 minutes"));
				if ((($cd['Assistant'] != true) && ($cd['Testing'] != true)) && (($modDate >= $classDate) || ($nextClass == 0))){$nextClass = $cd['DescID'];$nextID = $cd['ClassID'];}
				
				$cd_class = 'classList';
				if ($cd['Testing'] == true ) {$cd_class .= ' Testing';}
				if ($cd['Assistant'] == true) {$cd_class .= ' Assistant';}
				if ($cd['CopyFrom'] == true) {$cd_class .= ' CopyFrom';}
				$cdsHtml .= sprintf(
						'<li id='.$cd['DescID'].'  scheduleID='.$cd['ScheduleID'].' classID="'.$cd['ClassID'].'" class="'.$cd_class.'" classTime="'.$classDate.'" copyFrom="'.$cd['CopyFrom'].'">
						<a href="#">%s     (%s)</a></li>',
						$cd[ClassName],
						date("g:i a", strtotime($cd[ClassTime])));
			} 
		}
		
	} else {$nextID = null;$nextClass = null;}
		
		
	$cdsHtml .= sprintf('<li id="nextClass" next="%s" nextid="%s" class="classList"></li>', $nextClass, $nextID);
	if ($testVar == true){$cdsHtml .= sprintf('<li id="testClass" class="classList"></li>');}
	echo($cdsHtml);

?>