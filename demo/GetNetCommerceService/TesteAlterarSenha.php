<?php
 
  try{
		$client = new SoapClient("./wsdl/AdministrationService.wsdl",
						   array("trace" => 1,
								"location" => "https://cgws-hti.getnet.com.br:4443/eCommerceWS/1.0/AdministrationService",
								"uri"      => "https://cgws-hti.getnet.com.br:4443/eCommerceWS/1.0/AdministrationService",
								"cache_wsdl" => WSDL_CACHE_NONE,
								"features" => SOAP_SINGLE_ELEMENT_ARRAYS
						 ));
     
     // Obtendo a lista de funções descritas no WSDL
     $function = $client->__getFunctions();
	 
     // resultado
	 echo "Function: BEGIN ---------------------------------------------------------<br>\n";
     var_dump($function);
	 echo "<br> END: -------------------------------------------------------------------<br><br><br>\n";
	 
  } 
  catch(SoapFault $erro){
	echo "SoapFault: BEGIN -----------------------------------------------------------<br>\n";
    var_dump($erro);
	echo "<br> END -------------------------------------------------------------------<br><br><br>\n";
  }
  
$request = array(
    'arg0' => array(
        'username'        => '',
        'merchantID'      => '',
        'currentPassword' => '',
        'newPassword'     => '',
    ),
);

try{
    $result = $client->__soapCall( 'changeAuthenticationService', array($request) );
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