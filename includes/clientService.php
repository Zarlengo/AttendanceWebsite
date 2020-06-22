<?php
class MBClientService extends MBAPIService 
{
	function __construct($debug = false){
		$endpointUrl = "https://" . GetApiHostname() . "/0_5/ClientService.asmx";
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
	
	public function GetClients(array $clientIDs, $SearchText = null, $IsProspect = null, $PageSize = null, $CurrentPage = 0, $XMLDetail = XMLDetail::Full, $Fields = NULL, SourceCredentials $credentials = null){		
		$additions = array();
		
		if (count($clientIDs) > 0)
		{
			$additions['ClientIds'] = $clientIDs;
		}
		// $additions['SearchText'] = "";
		// $additions['IsProspect'] = "";
		// $additions['Fields'] = array('Clients.CustomClientFields');
		
		// $params = $this->GetMindbodyParams($additions, $this->GetCredentials($credentials), $XMLDetail, $PageSize, $CurrentPage, $Fields, $this->GetUserCredentials($usercredentials));
		$url = 'https://api.mindbodyonline.com/public/v6/client/clients';

		try
		{
			$result = $this->curl_connect($url, $additions, "GET", $CurrentPage, true);
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
	
	public function GetClientVisits($clientID, $StartDate = null, $EndDate = null, $UnpaidsOnly = null, $SearchText = null, $IsProspect = null, $PageSize = null, $CurrentPage = null, $XMLDetail = XMLDetail::Full, $Fields = NULL, SourceCredentials $credentials = null){		
		$additions = array();
		
		$additions['ClientID'] = $clientID;
		$additions['StartDate'] = "2000-01-01";
		$additions['UnpaidsOnly'] = False;
		
		$params = $this->GetMindbodyParams($additions, $this->GetCredentials($credentials), $XMLDetail, $PageSize, $CurrentPage, $Fields, $this->GetUserCredentials($usercredentials));
		$url = 'https://api.mindbodyonline.com/public/v6/client/clientvisits';
		try
		{
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
	
	public function AddOrUpdateClients($client, $test = false, SourceCredentials $credentials = null, $XMLDetail = XMLDetail::Full, $PageSize = NULL, $CurrentPage = NULL, $Fields = NULL){	
		$additions['Test'] = $test;
		$additions['Client'] = $client;
		$additions['CrossRegionalUpdate'] = false;
		// $params = $this->GetMindbodyParams($additions, $this->GetCredentials($credentials), $XMLDetail, $PageSize, $CurrentPage, $Fields, $this->GetUserCredentials($usercredentials));
		
		// $this->client->__setLocation("https://" . GetApiHostname() . "/0_5/ClientService.asmx"); //Setting the Endpoint to use SSL
		$url = 'https://api.mindbodyonline.com/public/v6/client/updateclient';
		$options = array(CURLOPT_POSTFIELDS => json_encode($additions));
		
		try {
        	$result = $this->curl_connect($url, $options, "POST");
		} catch (SoapFault $fault) {
			// <xmp> tag displays xml output in html
			echo 'Request : <br/><xmp>',
			$this->client->__getLastRequest(),
			'</xmp><br/><br/> Error Message : <br/>',
			$fault->getMessage(); 
		}
		
		if ($this->debug) {
			echo 'Request : <br/><xmp>', $this->client->__getLastRequest(), '</xmp><br/><br/>';
		}
		
		return $result;
	}
	
	public function UpdateClientVisits($visit, $test = false, $sendEmail = false, $PageSize = null, $CurrentPage = null, $XMLDetail = XMLDetail::Full, $Fields = NULL, SourceCredentials $credentials = null){
		
		$additions = array();
		
		if (isset($visit) > 0)
		{
			$additions['VisitId'] = $visit;
		}
		
		// $params = $this->GetMindbodyParams($additions, $this->GetCredentials($credentials), $XMLDetail, $PageSize, $CurrentPage, $Fields, $this->GetUserCredentials($usercredentials));
		$url = 'https://api.mindbodyonline.com/public/v6/client/updateclientvisit';
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
	
}?>