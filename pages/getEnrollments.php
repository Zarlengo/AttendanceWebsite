<?php
	require_once 'Load_Script.php';
	//require_once('../includes/Classes_Variable.php');
	// initialize default credentials
	$creds = new SourceCredentials($sourcename, $password, array($siteID));
	$usercreds = new UserCredentials($username, $userpass, array($userid));
	$classService = new MBClassService();
	$classService->SetDefaultCredentials($creds);
	$classService->SetDefaultUserCredentials($usercreds);
	
	require_once'dateCheck.php';
	if(isset($startDate) !== true) {

		$startDate = new DateTime;
		$endDate = new DateTime;
		$startDate->sub($EnrollStart);
		$endDate->add($EnrollEnd);
		$endDate = date_format($endDate, DateTime::ATOM);		
		$startDate = date_format($startDate, DateTime::ATOM);
	}
	
	$result = $classService->GetEnrollments(array(), array(), array(), array(), array(), array(), array(), $startDate, $endDate);

	$nextID = null;
	if($result->GetEnrollmentsResult->ResultCount !== 0){
		$cls = toArray($result->GetEnrollmentsResult->Enrollments->ClassSchedule);

		$cds = array();
		foreach ($cls as $cl) {
			$cms = toArray($cl->Classes->Class);
			foreach ($cms as $cm){
				$classTime = $cm->StartDateTime;
				$programID = $cm->ClassDescription->Program->ID;
				if ($classTime >= $startDate && $classTime <= $endDate && $programID === $EnrollProgramID) {
					
					$cds[] = array('ClassTime' => $cm->StartDateTime,
							'ClassID' => $cm->ID,
							'ClassSchID' => $cm->ClassScheduleID,
							'TestID' => $cm->ClassDescription->ID,
							'ClassName' => $cm->ClassDescription->Name);
						}
			}
		}			
		asort($cds);
		foreach ($cds as $cd) {
			if ($nextID === null){$nextID = $cd[ClassID];}
			$cdsHtml .= sprintf('<li classID="%s" testID="%s" scheduleID="%s" class="enrollList"><a>%s     (%s)</a></li>',
					$cd['ClassID'], $cd['TestID'], $cd['ClassSchID'], $cd['ClassName'], date("m-d g:i a", strtotime($cd['ClassTime'])));
		}
		
	} else {$nextID = '[null]';}
	$cdsHtml .= sprintf('<li id="nextClass" next="%s" class="classList"></li>', $nextID);


	echo $cdsHtml;
?>