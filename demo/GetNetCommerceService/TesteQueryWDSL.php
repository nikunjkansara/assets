<?php
 
  try{
		//https://cgws-hti.getnet.com.br:4443/eCommerceWS/1.0/CommerceService?wsdl
		$client = new SoapClient("./wsdl/CommerceService.wsdl",
						   array("trace" => 1,
								"location" => "https://cgws-hti.getnet.com.br:4443/eCommerceWS/1.0/CommerceService",
								"uri"      => "https://cgws-hti.getnet.com.br:4443/eCommerceWS/1.0/CommerceService",
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
        'authentication' => array(
			'username'   => '',
			'password'   => '',
			'merchantID' => '',
        ),
        'query' => array(
            'query' => array(
                'terminalID' => '',
				'merchantTrackID' => '',
            ),
        ),
    ),
);

try{
    $result = $client->__soapCall( 'queryDataService', array($request) );
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