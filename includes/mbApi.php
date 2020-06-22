<?php
/* This file contains all the soap references we need to communicate with the MINDBODY V0.5 API using PHP.
*
*/
/**
 * Gets the hostname for the Api environment.
 */
function GetApiHostname()
{
	return "api.mindbodyonline.com";
}
function GetApiNamespace()
{
	return "https://api.mindbodyonline.com/0_5";
}
// helper functions
function toArray($obj)
{
   if (is_array($obj)) { return $obj; } 
   else { return array($obj); }
}
// helper functions
function header_expand($obj)
{
	$header_string = "";
	foreach ($obj as $key => $value) {
		if (is_array($value)) {
			foreach ($value as $element) {
				$header_string .= "&" . $key . "=" . $element;
			}
		} else {
			$header_string .= "&" . $key . "=" . $value;
		}
	}
	// echo "<pre>";
	// print_r($header_string);
	// echo "</pre>";
	return $header_string;
}
function toComplexType($item, $objectName)
{
	return new SoapVar($item, XSD_ANYTYPE, $objectName, GetApiNamespace());
}
function DebugRequest($client)
{
   // <xmp> tag displays xml output in html
   echo "<h2>Request</h2><br/><xmp>", $client->__getLastRequest(), "</xmp><br/><br/>";
}
function DebugResponse($client, $result)
{
   echo('<h2>Result - Size: ' . strlen($client->__getLastResponse()) . '</h2><pre>');
   print_r($result);
   echo("</pre>");
}
// MB Request Objects
class SourceCredentials
{
	public $SourceName;
	public $Password;
	public $SiteIDs;
	  
	function __construct($SourceName, $Password, array $SiteIDs)
	{
		 $this->SourceName = $SourceName;
		 $this->Password = $Password;
		 $this->SiteIDs = $SiteIDs;
	}
	public function ConvertToSOAP()
	{
		$arr['SourceName'] = $this->SourceName;
		$arr['Password'] = $this->Password;
		$arr['SiteIDs'] = $this->SiteIDs;
		return $arr;
	}
}
class UserCredentials
{
	public $Username;
	public $Password;
	public $SiteIDs;
	  
	function __construct($Username, $Password, array $SiteIDs)
	{
		 $this->Username = $Username;
		 $this->Password = $Password;
		 $this->SiteIDs = $SiteIDs;
	}
	public function ConvertToSOAP()
	{
		$arr['Username'] = $this->Username;
		$arr['Password'] = $this->Password;
		$arr['SiteIDs'] = $this->SiteIDs;
		return $arr;
	}
}
abstract class XMLDetail
{
	const Bare = 'Bare';
	const Basic = 'Basic';
	const Full = 'Full';
}
class MBAPIService
{
	protected $serviceUrl;
	protected $client;
	protected $debug = false;
	protected $defaultCredentials = null;
	protected $defaultUserCredentials = null;
	
	/**
	 * You can store a set of default SourceCredentials in the object if you are using the 
	 * same ones multiple times.
	 * @param SourceCredentials $credentials
	 */
	public function SetDefaultCredentials(SourceCredentials $credentials)
	{
		$this->defaultCredentials = $credentials;
	}
	public function SetDefaultUserCredentials(UserCredentials $usercredentials)
	{
		$this->defaultUserCredentials = $usercredentials;
	}
	
	protected function GetMindbodyParams($additions, $credentials, $XMLDetail, $PageSize, $CurrentPage, $Fields, $UserCredentials)
	{		
		$params['SourceCredentials'] = $credentials->ConvertToSOAP();
		$params['XMLDetail'] = $XMLDetail;
		$params['PageSize'] = $PageSize;
		$params['CurrentPageIndex'] = $CurrentPage;
		$params['Fields'] = $Fields;
		$params['UserCredentials'] = $UserCredentials->ConvertToSOAP();
		// Add the additions array and wrap it in Request
		
		return array('Request' => array_merge($params, $additions));
	}
	
	protected function GetCredentials(SourceCredentials $credentials = null)
	{
		if (isset($credentials))
		{
			return $credentials;
		}
		else if (isset($this->defaultCredentials))
		{
			return $this->defaultCredentials;
		}
		else
		{
			throw new Exception('No source credentials supplied, and no default credentials stored');
		}
	}
	protected function GetUserCredentials(UserCredentials $usercredentials = null)
	{
		if (isset($usercredentials))
		{
			return $usercredentials;
		}
		else if (isset($this->defaultUserCredentials))
		{
			return $this->defaultUserCredentials;
		}
		else
		{
			throw new Exception('No source user credentials supplied, and no default user credentials stored');
		}
	}
	protected function curl_connect($url, array $options = array(), $method = "GET", $CurrentPage = 0, $token = false)
	{
		$pagination = array('limit' => 200, 'offset' => $CurrentPage);
		$apiKey = "b5a2310ad9f54be9b72bd19e5fa4605a";
		$siteId = -99;
		$username = "Siteowner";
		$password = "apitest1234";


		$defaults = array(
			CURLOPT_HEADER => 0,
			CURLOPT_RETURNTRANSFER => 1,
			CURLOPT_TIMEOUT => 4
		);

		if ($method == "POST" || $token == true)
		{
			$header = array(
				CURLOPT_URL => "https://api.mindbodyonline.com/public/v6/usertoken/issue",
				CURLOPT_POST => 1,
				CURLOPT_HTTPHEADER => array("Content-Type: application/json", "Api-Key: {$apiKey}","SiteId: {$siteId}"));

			$getToken = array(
				CURLOPT_POSTFIELDS => json_encode(array("Username" => $username, "Password" => $password)));
			$ch = curl_init();
			curl_setopt_array($ch,  ($defaults + $getToken + $header));
			if( ! $result = curl_exec($ch))
			{
				trigger_error(curl_error($ch));
			}
			curl_close($ch);
			$token = json_decode($result)->AccessToken;
		}


		if ($method == "POST")
		{
			$header = array(
				CURLOPT_URL => $url. (strpos($url, '?') === FALSE ? '?' : ''). http_build_query($pagination),
				CURLOPT_POST => 1,
				CURLOPT_HTTPHEADER => array("Content-Type: application/json", "Api-Key: {$apiKey}","SiteId: {$siteId}","Authorization: {$token}"));


		} else {
			$options = header_expand($options);
			
			// CURLOPT_URL => "https://api.mindbodyonline.com/public/v6/client/clients?limit=200&offset=0&ClientIDs=100011998&SearchText=&IsProspect=&Fields=Clients.CustomClientFields",
			$header = array(
				CURLOPT_URL => $url. (strpos($url, '?') === FALSE ? '?' : ''). http_build_query($pagination) . $options,
				CURLOPT_HTTPHEADER => array("Content-Type: application/json", "Api-Key: {$apiKey}","SiteId: {$siteId}","Authorization: {$token}"));
			$options = array();
		}

		$ch = curl_init();
		curl_setopt_array($ch,  ($options + $defaults + $header));
		if( ! $result = curl_exec($ch))
		{
			trigger_error(curl_error($ch));
		}
		curl_close($ch);
		return json_decode($result);
	}
	
}