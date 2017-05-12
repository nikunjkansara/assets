<?php 

 ini_set('soap.wsdl_cache_enabled',0);
 ini_set('soap.wsdl_cache_ttl',0);
 
class JaxWsSoapClient extends SoapClient
{
    public function __call($method, $arguments){
        $response = parent::__call($method, $arguments);
        return $response;
    }
}
 try { 
  
  $client  = new JaxWsSoapClient("./wsdl/CommerceService.wsdl",
                                       array("trace" => 1,
											"location" => "https://cgws-hti.getnet.com.br:4443/eCommerceWS/1.0/CommerceService",
											"uri"      => "https://cgws-hti.getnet.com.br:4443/eCommerceWS/1.0/CommerceService",
                                     ));
									 
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
 $result = $client->__call('queryDataService', array($request));
 
  echo("<br/>Dumping request:<br/>".$client->__getLastRequest());
  echo("<br/>Returning value of __soapCall() call: ");
  var_dump($result);
 
}catch(SoapFault $exception)
{
  print_r("Got issue:<br/>") ;
  print_r($exception->getMessage());
}
 
?>