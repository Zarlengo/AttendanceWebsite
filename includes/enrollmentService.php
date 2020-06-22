<?php
class MBEnrollmentService extends MBAPIService
{	
	function __construct($debug = false)
	{
		$endpointUrl = "https://" . GetApiHostname() . "/0_5/ClassService.asmx";
		$wsdlUrl = $endpointUrl . "?wsdl";
	
		$this->debug = $debug;
		$option = array();
		if ($debug)
		{
			$option = array('trace'=>1);
		}
		$this->client = new soapclient($wsdlUrl, $option);
		$this->client->__setLocation($endpointUrl);
	}
		
	//GetEnrollments(array(), array(), array(), array(), array(), array(), array(), null, null)
	public function GetEnrollments($locationIDs, $classScheduleIDs, $staffIDs, $programIDs, $sessionTypeIDs, $semesterIDs, $courseIDs, $startDate, $endDate, $PageSize = null, $CurrentPage = null, $XMLDetail = XMLDetail::Full, $Fields = NULL, SourceCredentials $credentials = null){
		
		$additions = array();
		
		if (count($locationIDs) > 0)
		{
			$additions['LocationIDs'] = $locationIDs;
		}

		if (count($classScheduleIDs) > 0)
		{
			$additions['ClassScheduleIDs'] = $classScheduleIDs;
		}
		
		if (count($staffIDs) > 0)
		{
			$additions['StaffIDs'] = $staffIDs;
		}
		
		if (count($programIDs) > 0)
		{
			$additions['ProgramIDs'] = $programIDs;
		}
		
		if (count($sessionTypeIDs) > 0)
		{
			$additions['SessionTypeIDs'] = $sessionTypeIDs;
		}
		
		if (count($semesterIDs) > 0)
		{
			$additions['SemesterIDs'] = $semesterIDs;
		}
		
		if (count($courseIDs) > 0)
		{
			$additions['CourseIDs'] = $courseIDs;
		}
		
		if (isset($startDate) > 0)
		{
			$additions['StartDate'] = $startDate;//->format(DateTime::ATOM);
		}
		
		if (isset($endDate) > 0)
		{
			$additions['EndDate'] = $endDate;//->format(DateTime::ATOM);
		}
		$Fields = array('Enrollments.Classes');
			
		// $params = $this->GetMindbodyParams($additions, $this->GetCredentials($credentials), $XMLDetail, $PageSize, $CurrentPage, $Fields, $this->GetUserCredentials($usercredentials));
		$url = 'https://api.mindbodyonline.com/public/v6/enrollment/enrollments';

		try
		{
			$result = $this->curl_connect($url, $additions);
		}
		catch (SoapFault $fault)
		{
			DebugResponse($result);
			echo '</xmp><br/><br/> Error Message : <br/>', $fault->getMessage(); 
		}
		
		if ($this->debug)
		{
			DebugRequest($this->client);
			DebugResponse($this->client, $result);
		}
		
		return $result;
	}
}