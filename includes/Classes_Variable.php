<?php
	
	$beltClass = [0, 1, 2, 3, 4, 5, 6, 7];
	$Class_Session = [];

	// Little Ninjas
	$beltClass[0] =  ['0.00'];

	// Beginner Kids
	$beltClass[1] =  ['1.00', '1.01', '1.02', '1.03', '1.04', '1.05'];

	//Advanced Kids
	$beltClass[2] =  ['1.06', '1.07', '1.08', '1.09', '1.10', '1.11', '1.12', '1.13', '1.14', '1.15', '1.16', '1.17', '1.18', '1.19', '1.20', '1.21', '1.22', '1.23'];

	// Adults
	$beltClass[3] =  ['2.00', '2.01', '2.02', '2.03', '2.04', '2.05', '2.06', '2.07', '2.08', '2.09', '2.10', '2.11', '2.12', '2.13', '2.14', '2.15', '2.16', '2.17'];

	// Advanced Kids & Adults
	$beltClass[4] =  ['2.06', '2.07', '2.08', '2.09', '2.10', '2.11', '2.12', '2.13', '1.09', '1.10', '1.11', '1.12', '1.13', '1.14', '1.15'];

	// Black Belts
	$beltClass[5] =  ['1.22', '1.23', '2.09', '2.10', '2.11', '2.12', '2.13', '2.14', '2.15', '2.16', '2.17'];

	// Teaching Green, Brown and Black
	$beltClass[6] =  ['1.22', '1.23', '2.03', '2.04', '2.05', '2.06', '2.07', '2.08', '2.09', '2.10', '2.11', '2.12', '2.13', '2.14', '2.15', '2.16', '2.17'];
	
	// All Kids Ranks
	$beltClass[7] = array_merge($beltClass[1], $beltClass[2]);
	
	// All Karate Ranks
	$beltClass[8] = array_merge($beltClass[1], $beltClass[2], $beltClass[3]);
	
	// High Rank (Brown + Above)
	$beltClass[9] = ['1.17', '1.18', '1.19', '1.20', '1.21', '1.22', '1.23', '2.06', '2.07', '2.08', '2.09', '2.10', '2.11', '2.12', '2.13', '2.14', '2.15', '2.16', '2.17'];
	
/***************** TEST DATABASE ********************/
	$Class_Schedule_ID[2223] =  array(CopyFrom => 2171);
	
	
	$Class_Description_ID[172] =  array_merge($beltClass[3], array(Testing => true));
	$Class_Description_ID[221] =  array_merge($beltClass[1], array(Testing => true));
	$Class_Description_ID[289] =  array_merge($beltClass[3], array(Testing => true));
	$Class_Description_ID[307] =  array_merge($beltClass[2], array(Testing => true));
	
	$Class_Description_ID[168] =  $beltClass[1];
	$Class_Description_ID[169] =  $beltClass[2];
	$Class_Description_ID[170] =  $beltClass[7];
	$Class_Description_ID[177] =  $beltClass[7];
	$Class_Description_ID[211] =  $beltClass[8];
	$Class_Description_ID[291] =  $beltClass[7];
	$Class_Description_ID[292] =  $beltClass[3];
	$Class_Description_ID[295] =  $beltClass[3];
	$Class_Description_ID[341] =  $beltClass[3];
	$Class_Description_ID[342] =  $beltClass[3];
	$Class_Description_ID[346] =  $beltClass[2];
	
	$Class_Description_ID[257] =  array(Ignore => true);
	$Class_Description_ID[287] =  array(Ignore => true);
	
	$Class_Description_ID[223] =  array_merge($beltClass[1], array(Testing => true));
	$Class_Description_ID[286] =  array_merge($beltClass[1], array(Testing => true));
	$Class_Description_ID[301] =  array_merge($beltClass[2], array(Testing => true));
	$Class_Description_ID[345] =  array_merge($beltClass[1], array(Testing => true));
	
	$Class_Description_ID[69] =   array_merge($beltClass[6], array(Assistant => true));
	$Class_Description_ID[231] =  array_merge($beltClass[5], array(Assistant => true));
	$Class_Description_ID[329] =  array_merge($beltClass[6], array(Assistant => true));
	
	
	/***************** ClassScheduleID **************/
	/***************** For specific class info ******/
	$Class_Schedule_ID[62] = $beltClass[6];				// Monday 16:00		Assistant Instructors
	$Class_Schedule_ID[56] = $beltClass[6];				// Monday 17:00		Assistant Instructors
	$Class_Schedule_ID[58] = $beltClass[6];				// Tuesday 16:30	Assistant Instructors
	$Class_Schedule_ID[60] = $beltClass[6];				// Tuesday 17:30	Assistant Instructors
	$Class_Schedule_ID[63] = $beltClass[6];				// Wednesday 16:00	Assistant Instructors
	$Class_Schedule_ID[57] = $beltClass[6];				// Wednesday 17:00	Assistant Instructors
	$Class_Schedule_ID[64] = $beltClass[6];				// Thursday 15:30	Assistant Instructors
	$Class_Schedule_ID[59] = $beltClass[6];				// Thursday 16:30	Assistant Instructors
	$Class_Schedule_ID[61] = $beltClass[6];				// Thursday 17:30	Assistant Instructors
	
	$Class_Schedule_ID[171] = array(CopyFrom => 178);	// Monday 18:30		Adults and Teens Karate
	$Class_Schedule_ID[173] = array(CopyFrom => 179);	// Wednesday 18:30	Adults and Teens Karate
	$Class_Schedule_ID[187] = array(CopyFrom => 190);	// Friday 17:00		Mat Work Karate
	
	
	/***************** ClassDescriptionID **************/
	/***************** For general class info **********/
	$Class_Description_ID[8]  = $beltClass[0];  																		// Little Ninjas
	$Class_Description_ID[14] = $beltClass[1];																			// Beginner Kids Karate
	$Class_Description_ID[27] = $beltClass[2]; 																			// Advanced Kids Karate
	$Class_Description_ID[3]  = $beltClass[7]; 															 				// Kids Karate
	$Class_Description_ID[1]  = $beltClass[3]; 																			// Adults and Teens Karate
	$Class_Description_ID[9]  = $beltClass[3]; 																			// Advanced Teens and Adults Karate

	$Class_Description_ID[12] = $beltClass[8]; 																			// Kata Class
	$Class_Description_ID[4]  = array_merge($beltClass[2], $beltClass[3]); 												// Weapons Class
	$Class_Description_ID[11] = array_merge($beltClass[2], $beltClass[3]);  											// Sparring Class
	$Class_Description_ID[5]  = $beltClass[8];  																		// Mat Work Class
	$Class_Description_ID[13] = $beltClass[8]; 																			// Open Workout

	$Class_Description_ID[17] = array_merge($beltClass[5], 					array(Assistant => true));					// Assistant Instructors
	$Class_Description_ID[30] = array_merge($beltClass[8], 					array(Dues => true));	// Cuong Nhu Dues

	/***************** ENROLLMENTS ********************/
	$Class_Description_ID[24] = array_merge($beltClass[3], 					array(Testing => true)); 					// Adult Testing
	$Class_Description_ID[25] = array_merge($beltClass[1], 					array(Testing => true)); 					// Kids 4:30 Testing
	$Class_Description_ID[26] = array_merge($beltClass[2], 					array(Testing => true)); 					// Kids 5:30 Testing
	$Class_Description_ID[29] = array_merge($beltClass[9], 					array(Testing => true));					// High Rank Testing

	$Class_Description_ID[6]  =  											array(					Ignore => true);	// Kickboxing Boot Camp
	$Class_Description_ID[16] = 											array(					Ignore => true);	// Cardio Cycling Class

	$Class_Description_ID[31] = $beltClass[8];																			// Kata Tournament
	$Class_Description_ID[32] = array_merge($beltClass[0], $beltClass[7]);												// Kata Tournament - Warrior Division
	$Class_Description_ID[33] = $beltClass[8];																			// Kata Tournament - Weapons
	$Class_Description_ID[28] = $beltClass[7];																			// Summer Camp


	/***************** Removed classes ********************/
	//$Class_Description_ID[10] = ; // Blackbelt Class
	//$Class_Description_ID[18] = ; // Adult Stripe Testing
	//$Class_Description_ID[19] = ; // Kids 4:30 Stripe Testing
	//$Class_Description_ID[20] = ; // Kids 5:30 Stripe Testing	
	
	if ($initialize == true){
		$cdsHtml = '<div type="hidden">';
		foreach($Class_Schedule_ID as $key=>$value)
		{
		  $cdsHtml .= sprintf("<input type='hidden' id='Class_Schedule_ID%s' value='%s'>", $key, json_encode($value));
		}
		foreach($Class_Description_ID as $key=>$value)
		{
		  $cdsHtml .= sprintf("<input type='hidden' id='Class_Description_ID%s' value='%s'>", $key, json_encode($value));
		}
		$cdsHtml .= '</div>';
		echo($cdsHtml);
	}
	?>