<?php
class MBClassService extends MBAPIService
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
	
	/**
	 * Returns the raw result of the MINDBODY SOAP call.
	 * @param int $PageSize
	 * @param int $CurrentPage
	 * @param string $XMLDetail
	 * @param string $Fields
	 * @param SourceCredentials $credentials A source credentials object to use with this call
	 * @return object The raw result of the SOAP call
	 */
	public function AddClientsToClasses(array $clientIDs, array $classIDs, $test = false, $RequirePayment = null, $Waitlist = null, $SendEmail = null, $WaitlistEntryID = null, $ClientServiceID = null, $PageSize = null, $CurrentPage = null, $XMLDetail = XMLDetail::Bare, $Fields = null, SourceCredentials $credentials = null)
	{		
		$additions = array();
		if (isset($clientIDs))
		{
			$additions['ClientIDs'] = $clientIDs;
		}
		if (isset($classIDs))
		{
			$additions['ClassIDs'] = $classIDs;
		}
		
			$additions['Test'] = false;
			//$additions['RequirePayment'] = true;
			
		$params = $this->GetMindbodyParams($additions, $this->GetCredentials($credentials), $XMLDetail, $PageSize, $CurrentPage, $Fields, $this->GetUserCredentials($usercredentials));
		
		try
		{
			$result = $this->client->AddClientsToClasses($params);
		}
		
		catch (SoapFault $fault)
		{
			DebugResponse($this->client);
			// <xmp> tag displays xml output in html
			echo '</xmp><br/><br/> Error Message : <br/>', $fault->getMessage(); 
		}
		
		if ($this->debug)
		{
			DebugRequest($this->client);
			DebugResponse($this->client, $result);
		}
		
		return $result;
	}
	
	/**
	 * Returns the raw result of the MINDBODY SOAP call.
	 * @param int $PageSize
	 * @param int $CurrentPage
	 * @param string $XMLDetail
	 * @param string $Fields
	 * @param SourceCredentials $credentials A source credentials object to use with this call
	 * @return object The raw result of the SOAP call
	 * GetClasses(array(), array(), array(), null, null)
	 */
	public function GetClasses(array $classDescriptionIDs, array $classIDs, array $staffIDs, $startDate, $endDate, $clientID = null, $PageSize = null, $CurrentPage = null, $XMLDetail = XMLDetail::Full, $Fields = NULL, SourceCredentials $credentials = null)
	{		
		$additions = array();
		if (count($classDescriptionIDs))
		{
			$additions['ClassDescriptionIDs'] = $classDescriptionIDs;
		}
		if (count($classIDs))
		{
			$additions['ClassIDs'] = $classIDs;
		}
		if (count($staffIDs))
		{
			$additions['StaffIDs'] = $staffIDs;
		}
		if (isset($startDate))
		{
			$additions['StartDateTime'] = $startDate;//->format(DateTime::ATOM);
		}
		if (isset($endDate))
		{
			$additions['EndDateTime'] = $endDate;//->format(DateTime::ATOM);
		}
		if (count($clientID))
		{
			$additions['ClientID'] = $clientID;
		}
		
		$params = $this->GetMindbodyParams($additions, $this->GetCredentials($credentials), $XMLDetail, $PageSize, $CurrentPage, $Fields, $this->GetUserCredentials($usercredentials));
		
		try
		{
			$result = $this->client->GetClasses($params);
		}
		catch (SoapFault $fault)
		{
			DebugResponse($this->client);
			// <xmp> tag displays xml output in html
			echo '</xmp><br/><br/> Error Message : <br/>', $fault->getMessage(); 
		}
		
		if ($this->debug)
		{
			DebugRequest($this->client);
			DebugResponse($this->client, $result);
		}
		
		return $result;
	}
	
	/**
	 * Returns the raw result of the MINDBODY SOAP call.
	 * @param string $XMLDetail
	 * @param string $Fields
	 * @param SourceCredentials $credentials A source credentials object to use with this call
	 * @return object The raw result of the SOAP call
	 * GetClassDescriptions(array(), array(), array(), array(), null, null)
	 */
	public function GetClassDescriptions(array $classDescriptionIDs, array $ProgramIDs, array $staffIDs, array $locationIDs, $startTime, $endTime, $PageSize = NULL, $CurrentPage = NULL, $XMLDetail = XMLDetail::Full, $Fields = NULL, SourceCredentials $credentials = null)
	{
		$additions = array();
		if (count($classDescriptionIDs) > 0)
		{
			$additions['ClassDescriptionsIDs'] = $classDescriptionIDs;
		}
		if (count($programIDs) > 0)
		{
			$additions['ProgramIDs'] = $ProgramIDs;
		}
		if (count($staffIDs) > 0)
		{
			$additions['StaffIDs'] = $staffIDs;
		}
		if (count($locationIDs) > 0)
		{
			$additions['LocationIDs'] = $locationIDs;
		}
		if (isset($startDate))
		{
			$additions['StartClassDateTime'] = $startDate->format(DateTime::ATOM);
		}
		if (isset($endDate))
		{
			$additions['EndClassDateTime'] = $endDate->format(DateTime::ATOM);
		}
		
		$params = $this->GetMindbodyParams($additions, $this->GetCredentials($credentials), $XMLDetail, $PageSize, $CurrentPage, $Fields);
		
		try
		{
			$result = $this->client->GetClassDescriptions($params);
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
			
		$params = $this->GetMindbodyParams($additions, $this->GetCredentials($credentials), $XMLDetail, $PageSize, $CurrentPage, $Fields, $this->GetUserCredentials($usercredentials));

		try
		{
			$result = $this->client->GetEnrollments($params);
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
	//GetClassVisits(classID)
	public function GetClassVisits($classID, $PageSize = null, $CurrentPage = null, $XMLDetail = XMLDetail::Full, $Fields = NULL, SourceCredentials $credentials = null){
		
		$additions = array();
			$additions['ClassID'] = $classID;
		
		$params = $this->GetMindbodyParams($additions, $this->GetCredentials($credentials), $XMLDetail, $PageSize, $CurrentPage, $Fields, $this->GetUserCredentials($usercredentials));
		
		try
		{
			$result = $this->client->GetClassVisits($params);
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

	
	
/**

<s:element minOccurs="0" maxOccurs="1" name="Visits" type="tns:ArrayOfVisit"/>


<s:element minOccurs="1" maxOccurs="1" name="Test" nillable="true" type="s:boolean"/>
<s:element minOccurs="1" maxOccurs="1" name="SendEmail" nillable="true" type="s:boolean"/>
**/
	public function UpdateClientVisits(array $visits, $test = false, $sendEmail = false, $PageSize = null, $CurrentPage = null, $XMLDetail = XMLDetail::Full, $Fields = NULL, SourceCredentials $credentials = null){
		
		$additions = array();
		
		if (count($visits) > 0)
		{
			$additions['Visits'] = $visits;
		}
		
		$params = $this->GetMindbodyParams($additions, $this->GetCredentials($credentials), $XMLDetail, $PageSize, $CurrentPage, $Fields, $this->GetUserCredentials($usercredentials));
		
		try
		{
			$result = $this->client->UpdateClientVisits($params);
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


	public function GetClassSchedules($locationIDs, $classScheduleIDs, $staffIDs, $programIDs, $sessionTypeIDs, $startDate,$endDate, $PageSize = null, $CurrentPage = null, $XMLDetail = XMLDetail::Full, $Fields = NULL, SourceCredentials $credentials = null){

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
		if (isset($startDate) > 0)
		{
			$additions['StartDateTime'] = $startDate->format(DateTime::ATOM);
		}
		if (isset($endDate) > 0)
		{
			$additions['EndDateTime'] = $endDate->format(DateTime::ATOM);
		}
			//$additions['LocationIDs'] = array();
			//$additions['SessionTypeIDs'] = array();
		
		$params = $this->GetMindbodyParams($additions, $this->GetCredentials($credentials), $XMLDetail, $PageSize, $CurrentPage, $Fields, $this->GetUserCredentials($usercredentials));
		
		try
		{
			$result = $this->client->GetClassSchedules($params);
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
	public function RemoveClientsFromClasses(array $clientIDs, array $classIDs, $test = false, $SendEmail = null, $LateCancel = null, $PageSize = null, $CurrentPage = null, $XMLDetail = XMLDetail::Full, $Fields = null, SourceCredentials $credentials = null)
	{		
		$additions = array();
		if (isset($clientIDs))
		{
			$additions['ClientIDs'] = $clientIDs;
		}
		if (isset($classIDs))
		{
			$additions['ClassIDs'] = $classIDs;
		}
		
			$additions['Test'] = false;
			$additions['LateCancel'] = false;
		
		$params = $this->GetMindbodyParams($additions, $this->GetCredentials($credentials), $XMLDetail, $PageSize, $CurrentPage, $Fields, $this->GetUserCredentials($usercredentials));
		
		try
		{
			$result = $this->client->RemoveClientsFromClasses($params);
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
	public function AddClientsToEnrollments(array $clientIDs, $classScheduleIDs, $courseIDs, $enrollDateForward, $enrollOpen, $test, $sendEmail, $waitlist, $waitlistEntryID){
		
		$additions = array();
		if (isset($clientIDs))  //string
		{
			$additions['ClientIDs'] = $clientIDs;
		}
		if (isset($classScheduleIDs))  //int
		{
			$additions['ClassScheduleIDs'] = $classScheduleIDs;
		}
		if (isset($courseIDs))  //int
		{
			$additions['CourseIDs'] = $courseIDs;
		}
		if (isset($enrollDateForward)) //DateTime
		{
			$additions['EnrollDateForward'] = $enrollDateForward;
		}
		if (isset($enrollOpen)) //DateTime
		{
			$additions['EnrollOpen'] = $enrollOpen;
		}
		if (isset($sendEmail))  //boolean
		{
			$additions['SendEmail'] = $sendEmail;
		}
		if (isset($waitlist))  //boolean
		{
			$additions['Waitlist'] = $waitlist;
		}
		if (isset($waitlistEntryID)) //int
		{
			$additions['WaitlistEntryID'] = $waitlistEntryID;
		}
		
		
			$additions['Test'] = false;
			
		
		$params = $this->GetMindbodyParams($additions, $this->GetCredentials($credentials), $XMLDetail, $PageSize, $CurrentPage, $Fields, $this->GetUserCredentials($usercredentials));
		
		try
		{
			$result = $this->client->AddClientsToEnrollments($params);
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
	public function RemoveFromWaitlist(){
		
		$additions = array();
		
		$params = $this->GetMindbodyParams($additions, $this->GetCredentials($credentials), $XMLDetail, $PageSize, $CurrentPage, $Fields, $this->GetUserCredentials($usercredentials));
		
		try
		{
			$result = $this->client->RemoveFromWaitlist($params);
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
	public function GetSemesters(){
		
		$additions = array();
		
		$params = $this->GetMindbodyParams($additions, $this->GetCredentials($credentials), $XMLDetail, $PageSize, $CurrentPage, $Fields);
		
		try
		{
			$result = $this->client->GetSemesters($params);
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
	public function GetCourses(){
		
		$additions = array();
		
		$params = $this->GetMindbodyParams($additions, $this->GetCredentials($credentials), $XMLDetail, $PageSize, $CurrentPage, $Fields);
		
		try
		{
			$result = $this->client->GetCourses($params);
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
	public function GetWaitlistEntries(){
		
		$additions = array();
		
		$params = $this->GetMindbodyParams($additions, $this->GetCredentials($credentials), $XMLDetail, $PageSize, $CurrentPage, $Fields);
		
		try
		{
			$result = $this->client->GetWaitlistEntries($params);
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
	public function SubtituteClassTeacher(){
		
		$additions = array();
		
		$params = $this->GetMindbodyParams($additions, $this->GetCredentials($credentials), $XMLDetail, $PageSize, $CurrentPage, $Fields);
		
		try
		{
			$result = $this->client->SubtituteClassTeacher($params);
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
	public function CancelSingleClass(){
		
		$additions = array();
		
		$params = $this->GetMindbodyParams($additions, $this->GetCredentials($credentials), $XMLDetail, $PageSize, $CurrentPage, $Fields);
		
		try
		{
			$result = $this->client->CancelSingleClass($params);
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


/**
	public function GetClassesResponse(array $classes, $PageSize = NULL, $CurrentPage = NULL, $XMLDetail = XMLDetail::Full, $Fields = NULL, SourceCredentials $credentials = null){
		
		$additions = array();
		if (count($classes) > 0)
		{
			$additions['Classes'] = $classes;
		}
		$params = $this->GetMindbodyParams($additions, $this->GetCredentials($credentials), $XMLDetail, $PageSize, $CurrentPage, $Fields);
		
		try
		{
			$result = $this->client->GetClassesResponse($params);
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
	public function UpdateClientVisitsResponse(){
		
		$additions = array();
		
		$params = $this->GetMindbodyParams($additions, $this->GetCredentials($credentials), $XMLDetail, $PageSize, $CurrentPage, $Fields);
		
		try
		{
			$result = $this->client->UpdateClientVisitsResponse($params);
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
	public function GetClassVisitsResponse(){
		
		$additions = array();
		
		$params = $this->GetMindbodyParams($additions, $this->GetCredentials($credentials), $XMLDetail, $PageSize, $CurrentPage, $Fields);
		
		try
		{
			$result = $this->client->GetClassVisitsResponse($params);
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
	public function GetClassDescriptionsResponse(){
		
		$additions = array();
		
		$params = $this->GetMindbodyParams($additions, $this->GetCredentials($credentials), $XMLDetail, $PageSize, $CurrentPage, $Fields);
		
		try
		{
			$result = $this->client->GetClassDescriptionsResponse($params);
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
	public function GetEnrollmentsResponse(){
		
		$additions = array();
		
		$params = $this->GetMindbodyParams($additions, $this->GetCredentials($credentials), $XMLDetail, $PageSize, $CurrentPage, $Fields);
		
		try
		{
			$result = $this->client->GetEnrollmentsResponse($params);
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
	public function GetClassSchedulesResponse(){
		
		$additions = array();
		
		$params = $this->GetMindbodyParams($additions, $this->GetCredentials($credentials), $XMLDetail, $PageSize, $CurrentPage, $Fields);
		
		try
		{
			$result = $this->client->GetClassSchedulesResponse($params);
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
	public function AddClientsToClassesResponse(){
		
		$additions = array();
		
		$params = $this->GetMindbodyParams($additions, $this->GetCredentials($credentials), $XMLDetail, $PageSize, $CurrentPage, $Fields);
		
		try
		{
			$result = $this->client->AddClientsToClassesResponse($params);
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
	public function RemoveClientsFromClassesResponse(){
		
		$additions = array();
		
		$params = $this->GetMindbodyParams($additions, $this->GetCredentials($credentials), $XMLDetail, $PageSize, $CurrentPage, $Fields);
		
		try
		{
			$result = $this->client->RemoveClientsFromClassesResponse($params);
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
	public function AddClientsToEnrollmentsResponse(){
		
		$additions = array();
		
		$params = $this->GetMindbodyParams($additions, $this->GetCredentials($credentials), $XMLDetail, $PageSize, $CurrentPage, $Fields);
		
		try
		{
			$result = $this->client->AddClientsToEnrollmentsResponse($params);
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
	public function RemoveFromWaitlistResponse(){
		
		$additions = array();
		
		$params = $this->GetMindbodyParams($additions, $this->GetCredentials($credentials), $XMLDetail, $PageSize, $CurrentPage, $Fields);
		
		try
		{
			$result = $this->client->RemoveFromWaitlistResponse($params);
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
	public function GetSemestersResponse(){
		
		$additions = array();
		
		$params = $this->GetMindbodyParams($additions, $this->GetCredentials($credentials), $XMLDetail, $PageSize, $CurrentPage, $Fields);
		
		try
		{
			$result = $this->client->GetSemestersResponse($params);
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
	public function GetCoursesResponse(){
		
		$additions = array();
		
		$params = $this->GetMindbodyParams($additions, $this->GetCredentials($credentials), $XMLDetail, $PageSize, $CurrentPage, $Fields);
		
		try
		{
			$result = $this->client->GetCoursesResponse($params);
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
	public function GetWaitlistEntriesResponse(){
		
		$additions = array();
		
		$params = $this->GetMindbodyParams($additions, $this->GetCredentials($credentials), $XMLDetail, $PageSize, $CurrentPage, $Fields);
		
		try
		{
			$result = $this->client->GetWaitlistEntriesResponse($params);
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
	public function SubtituteClassTeacherResponse(){
		
		$additions = array();
		
		$params = $this->GetMindbodyParams($additions, $this->GetCredentials($credentials), $XMLDetail, $PageSize, $CurrentPage, $Fields);
		
		try
		{
			$result = $this->client->SubtituteClassTeacherResponse($params);
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
	public function CancelSingleClassResponse(){
		
		$additions = array();
		
		$params = $this->GetMindbodyParams($additions, $this->GetCredentials($credentials), $XMLDetail, $PageSize, $CurrentPage, $Fields);
		
		try
		{
			$result = $this->client->CancelSingleClassResponse($params);
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
**/
}