<?php
	
include __DIR__.'/Security_AES.php';
include __DIR__.'/Security_3DES.php';
	
 
  try {
		$client = new SoapClient("./wsdl/AdministrationService.wsdl",
		   array("trace" => 1,
				"location" => "https://cgws-hti.getnet.com.br:4443/eCommerceWS/1.1/AdministrationService",
				"uri"      => "https://cgws-hti.getnet.com.br:4443/eCommerceWS/1.1/AdministrationService",
		 ));
	} catch(SoapFault $erro){
	echo "SoapFault: BEGIN -----------------------------------------------------------<br>\n";
    var_dump($erro);
	echo "<br> END -------------------------------------------------------------------<br><br><br>\n";
  }
//Set the SOAP parameter values  
$request = array(
    'arg0' => array(
    	
	    	'username'    => 'hti_fare',
			'merchantID'  => '1007399',
			'currentPassword'    => '#GetNet2013@CommerceWS#',
			'newPassword'	=> '#GetNet2013@CommerceWS1'		
       
    ),
);

try{
	//pass the request parameters to the soapcall that is use for the assign value to each parameters
	
    $result = $client->__soapCall( 'ChangeAuthenticationService', array($request) );    
}catch(SoapFault $e){
	echo "Exception: BEGIN -----------------------------------------------------------<br>\n";
    print_r($e);
	echo "<br> END -------------------------------------------------------------------<br><br><br>\n";
}

echo "REQUEST: BEGIN -------------------------------------------------------------<br>\n";
echo htmlentities($client->__getLastRequest());
echo "<br> END -------------------------------------------------------------------<br><br><br>\n";

echo "RESPONSE: BEGIN ---------------------------------------------------------<br>\n"; 
echo htmlentities($client->__getLastResponse());
echo "<br> END -------------------------------------------------------------------<br><br><br>\n";
?>