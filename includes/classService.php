<?php
class MBClassService extends MBAPIService{	
	function __construct($debug = false){
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
	
	public function GetClasses(array $classDescriptionIDs, array $classIDs, array $staffIDs, $startDate, $endDate, $clientID = null, $PageSize = null, $CurrentPage = null, $XMLDetail = XMLDetail::Full, $Fields = NULL, SourceCredentials $credentials = null){		
		$additions = array();
		if (count($classDescriptionIDs))
		{
			$additions['ClassDescriptionIds'] = $classDescriptionIDs;
		}
		if (count($classIDs))
		{
			$additions['ClassIds'] = $classIDs;
		}
		if (count($staffIDs))
		{
			$additions['StaffIds'] = $staffIDs;
		}
		if (isset($startDate))
		{
			$additions['StartDateTime'] = $startDate;//->format(DateTime::ATOM);
		}
		if (isset($endDate))
		{
			$additions['EndDateTime'] = $endDate;//->format(DateTime::ATOM);
		}
		if (isset($clientID))
		{
			$additions['ClientId'] = $clientID;
		}
		
		// $params = $this->GetMindbodyParams($additions, $this->GetCredentials($credentials), $XMLDetail, $PageSize, $CurrentPage, $Fields, $this->GetUserCredentials($usercredentials));
		
		$url = 'https://api.mindbodyonline.com/public/v6/class/classes';
		try
		{
			// $result = $this->client->GetClasses($params);
			$result = $this->curl_connect($url, $additions);
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
	
	public function GetClassVisits($classID, $PageSize = null, $CurrentPage = null, $XMLDetail = XMLDetail::Full, $Fields = NULL, SourceCredentials $credentials = null){
		
		$additions = array();
			$additions['ClassID'] = $classID;
		
		// $params = $this->GetMindbodyParams($additions, $this->GetCredentials($credentials), $XMLDetail, $PageSize, $CurrentPage, $Fields, $this->GetUserCredentials($usercredentials));
		$url = 'https://api.mindbodyonline.com/public/v6/class/classvisits';
		
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

	public function AddClientsToClasses($clientID, $classID, $test = false, $RequirePayment = null, $Waitlist = null, $SendEmail = null, $WaitlistEntryID = null, $ClientServiceID = null, $PageSize = null, $CurrentPage = null, $XMLDetail = XMLDetail::Bare, $Fields = null, SourceCredentials $credentials = null){		
		$additions = array();
		if (isset($clientID))
		{
			$additions['ClientId'] = $clientID;
		}
		if (isset($classID))
		{
			$additions['ClassId'] = $classID;
		}
		
		$additions['Test'] = false;
		$additions['Waitlist'] = false;
		$additions['RequirePayment'] = false;
			
		// $params = $this->GetMindbodyParams($additions, $this->GetCredentials($credentials), $XMLDetail, $PageSize, $CurrentPage, $Fields, $this->GetUserCredentials($usercredentials));
		
		$url = 'https://api.mindbodyonline.com/public/v6/class/addclienttoclass';
		$options = array(CURLOPT_POSTFIELDS => json_encode($additions));
		
		try
		{
			// $result = $this->client->AddClientsToClasses($params);
			$result = $this->curl_connect($url, $options, "POST");
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
	
	public function RemoveClientsFromClasses($clientID, $classID, $test = false, $SendEmail = null, $LateCancel = null, $PageSize = null, $CurrentPage = null, $XMLDetail = XMLDetail::Full, $Fields = null, SourceCredentials $credentials = null){		
		$additions = array();
		if (isset($clientID))
		{
			$additions['ClientID'] = $clientID;
		}
		if (isset($classID))
		{
			$additions['ClassID'] = $classID;
		}
		
			$additions['Test'] = false;
			$additions['LateCancel'] = false;
		
		// $params = $this->GetMindbodyParams($additions, $this->GetCredentials($credentials), $XMLDetail, $PageSize, $CurrentPage, $Fields, $this->GetUserCredentials($usercredentials));
		$url = 'https://api.mindbodyonline.com/public/v6/class/removeclientfromclass';
		$options = array(CURLOPT_POSTFIELDS => json_encode($additions));
		
		try
		{
        	$result = $this->curl_connect($url, $options, "POST");
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