<?php
 
  try{
		$client = new SoapClient("./wsdl/AdministrationService.wsdl",
						   array("trace" => 1,
								"location" => "https://cgws-hti.getnet.com.br:4443/eCommerceWS/1.0/AdministrationService",
								"uri"      => "https://cgws-hti.getnet.com.br:4443/eCommerceWS/1.0/AdministrationService",
								"cache_wsdl" => WSDL_CACHE_NONE,
								"features" => SOAP_SINGLE_ELEMENT_ARRAYS
						 ));
  } 
  catch(SoapFault $erro){
	echo "SoapFault: BEGIN -----------------------------------------------------------<br>\n";
    var_dump($erro);
	echo "<br> END -------------------------------------------------------------------<br><br><br>\n";
  }
 
### -- Deve escolher qual padrao usar.
# ---- 3DES
#$Key_3DES = "123456789012345678901234"; //24 Caracter Key
#$iv_3DES = "fedcba98"; //8 Caracter iv_3DES
# ---- AES
#$key_AES = "1234567891234567"; //16 Caracter Key
#$iv_AES = "fedcba9876543210";  //16 Caracter IV

$request = array(
    'arg0' => array(
        'username'    => '',
		'password'    => '',
		'merchantID'  => '',
		'key'         => '',
		'iv'          => '',
    ),
);

try{
    $result = $client->__soapCall( 'changeKeysService', array($request) );
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