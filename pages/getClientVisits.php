<html><body><?php
 
if($_REQUEST["ClientID"] ) {
	$clientID = $_REQUEST['ClientID'];
    require_once '../pages/Load_Script.php';

	// initialize default credentials
	$creds = new SourceCredentials($sourcename, $password, array($siteID));
	$usercreds = new UserCredentials($username, $userpass, array($userid));
	$clientService = new MBClientService();
	$clientService->SetDefaultCredentials($creds);
	$clientService->SetDefaultUserCredentials($usercreds);

	$result = $clientService->GetClientVisits($clientID);
	$cds = toArray($result->GetClientVisitsResult->Visits->Visit);
	$dateArray = array(); 
	$classArray = array(); 
	$minDate = new DateTime();
	$maxDate = new DateTime('2000-01-01');
	$skipDate = $HistoryStartDate;
	$errors = array_filter($cds);
	
	if (!empty($errors)){
		foreach ($cds as $cd) {
			$name = $cd->Name;
			$historyBoolean = false;
			foreach ($HistoryArray as $history) {
				if (strpos($name, $history) !== FALSE) {
					$historyBoolean = true;
				}
			}
			if ($historyBoolean !== true) {
				$startDate = new DateTime($cd->StartDateTime);
				if ($startDate >= $skipDate){
					if ($minDate > $startDate) {$minDate = $startDate;}
					if ($maxDate < $startDate) {$maxDate = $startDate;}
					$weekValue = intval($startDate->format('w'));
					$weekName = $startDate->format('l');
					$classID = $weekValue.$weekName.'@'.$startDate->format('H').':'.$startDate->format('i').'-'.$name;
					if ( array_search($classID, $classArray) == null) {$classArray[$classID] = $dateArray;}
				}
			}
		}
		ksort($classArray);
		$classCnt = count($classArray);
		if (!empty($classArray)){
			$minYear = intval($minDate->format('Y'));
			$minMonth = intval($minDate->format('m'));
			$maxYear = intval($maxDate->format('Y'));
			$maxMonth = intval($maxDate->format('m'));

			foreach ($cds as $cd) {
				$name = $cd->Name;
				$historyBoolean = false;
				foreach ($HistoryArray as $history) {
					if (strpos($name, $history) !== FALSE) {
						$historyBoolean = true;
					}
				}
				if ($historyBoolean !== true) {
					$startDate = new DateTime($cd->StartDateTime);
					if ($startDate >= $skipDate){
						$weekValue = intval($startDate->format('w'));
						$weekName = $startDate->format('l');
						$monthValue = intval($startDate->format('m'));
						$yearValue = intval($startDate->format('Y'));
						$dateValue = $monthValue.'-'.$yearValue;
						$id = $cd->ID;
						$classID = $weekValue.$weekName.'@'.$startDate->format('H').':'.$startDate->format('i').'-'.$name;
						$classQty = $classArray[$classID][$dateValue];
						$classArray[$classID][$dateValue] = $classQty + 1;
						if ($classChar < strlen($classID)) {$classChar = strlen($classID);}
					}
				}
			}
			$classChar = $classChar * 8;

			echo '<table border=1 style="border-collapse: collapse"><thead>
					<tr><th><div class="table-head rotate" style="width:60px;white-space: nowrap">Month - Year</div></th>';

			$keys = array_keys($classArray);
			$iterations = count($keys);

			for($i = 0; $i < $iterations; $i++) {
				$titleValue = substr($keys[$i],1);
				$historyBoolean = false;
				foreach ($HistoryTeach as $history) {
					if (strpos($titleValue, $history) !== FALSE) {
						$historyBoolean = true;
					}
				}
				if ($historyBoolean !== true) {
					$classStatus = 'classes';
				} else {
					$classStatus = 'teaches';
				}
				echo '<th style="vertical-align:bottom" class="'.$classStatus.'"><div class="rotate" style="width:20px;white-space:nowrap;">'.$titleValue.'</div></th>';
			}
			echo '<th style="height:'.$classChar.'px" class="classes"><div class="rotate">Class Total</div></th><th style="height:'.$classChar.'px" class="teaches"><div class="rotate">Teaching Total</div></th></tr></thead><tbody>';

			for($j = $minYear; $j <= $maxYear; $j++) {
				if ($j == $minYear) {$startMonth = $minMonth;} else {$startMonth = 1;}
				if ($j == $maxYear) {$endMonth = $maxMonth;} else {$endMonth = 12;}
				for($i = $startMonth; $i <= $endMonth; $i++){
					$rowString = null;
					$dateValue = $i.'-'.$j;
					$rowString .= '<tr><td>'.$dateValue.'</td>';
					$classTotal = 0;
					$teachTotal = 0;
					for ($h = 0; $h < $classCnt; $h++){
						$titleValue = substr($keys[$h],1);
						$classAmount = $classArray[$keys[$h]][$dateValue];
						$historyBoolean = false;
						foreach ($HistoryTeach as $history) {
							if (strpos($titleValue, $history) !== FALSE) {
								$historyBoolean = true;
							}
						}
						if ($historyBoolean !== true) {
							$classStatus = 'classes';
							$classTotal = $classTotal + $classAmount;
						} else {
							$classStatus = 'teaches';
							$teachTotal = $teachTotal + $classAmount;
						}
						$historyBoolean = false;
						foreach ($HistoryTest as $history) {
							if (strpos($keys[$h], $history) !== FALSE) {
								$historyBoolean = true;
							}
						}
						if ($historyBoolean == true and $classAmount > 0) {$rowString .= '<td style="background-color:yellow" class="'.$classStatus.'">';} else{ $rowString .= '<td class="'.$classStatus.'">';}
						$rowString .= $classAmount.'</td>';
					}
					$rowString .= '<td class="classes">'.$classTotal.'</td><td class="teaches">'.$teachTotal.'</td>';
					if ($classTotal != 0 || $teachTotal != 0) {echo $rowString;}
				}
			}
		} else {
			echo json_encode('No history found');
		}
	} else {
		echo json_encode('No history found');
	}
} else {
	echo json_encode('No Client');
}
?></body></html>