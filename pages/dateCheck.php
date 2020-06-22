<?php
	if($_REQUEST["NewStart"]) 	{
		$startDate = DateTime::createFromFormat('Y-m-d', $_REQUEST["NewStart"]);	
		$startDate->setTime(8, 0, 0);
		$startDate = date_format($startDate, DateTime::ATOM);
	}
	if($_REQUEST["NewEnd"]) 	{
		$endDate =   DateTime::createFromFormat('Y-m-d', $_REQUEST["NewEnd"]);
		$endDate->setTime(8, 0, 0);
		$endDate = date_format($endDate, DateTime::ATOM);
	}
?>