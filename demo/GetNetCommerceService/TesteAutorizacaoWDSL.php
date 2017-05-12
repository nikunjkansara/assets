<?php
	
	include 'security_AES.php';
	include 'security_3DES.php';

	$card = "";
	$cvv = "";

	$key_AES = "1234567891234567"; //16 Caracter Key
	$iv_AES = "fedcba9876543210"; //16 Caracter IV
	$cardEncrypted_AES = Security_AES::encrypt($card, $key_AES, $iv_AES);
	$cvvEncrypted_AES = Security_AES::encrypt($cvv, $key_AES, $iv_AES);

	$Key_3DES = "12345678901234567890abcd"; //24 Caracter Key
	$iv_3DES = "fedcba98"; //8 Caracter iv_3DES
	$cardEncrypted_3DES = Security_3DES::encrypt($card, $Key_3DES, $iv_3DES);
	$cvvEncrypted_3DES = Security_3DES::encrypt($cvv, $Key_3DES, $iv_3DES);
	
	 echo "Número do Cartão Criptografado: = $cardEncrypted_3DES <br>";
	 echo "Número do CVV Criptografado: = $cvvEncrypted_3DES  <br>";
	 echo " <br> <br>";
 
  try{
		//https://cgws-hti.getnet.com.br:4443/eCommerceWS/1.0/CommerceService?wsdl
		$client = new SoapClient("./wsdl/CommerceService.wsdl",
						   array("trace" => 1,
								"location" => "https://cgws-hti.getnet.com.br:4443/eCommerceWS/1.0/CommerceService",
								"uri"      => "https://cgws-hti.getnet.com.br:4443/eCommerceWS/1.0/CommerceService",
						 ));
  } 
  catch(SoapFault $erro){
	echo "SoapFault: BEGIN -----------------------------------------------------------<br>\n";
    var_dump($erro);
	echo "<br> END -------------------------------------------------------------------<br><br><br>\n";
  }
 
$request = array(
    'arg0' => array(
        'authentication' => array(
			'username'    => '',
			'password'    => '',
			'merchantID'  => '',
        ),
		'authorizations' => array(
			'authorization' => array(
				'terminalID' => '',
				'merchantTrackID' => '',
				'amount' => '',
				'currencycode' => '986',
				'instType' => '',
				'instNum' => '',
				'card' => array(
					'number' => $cardEncrypted_3DES,
					'cvv2' => $cvvEncrypted_3DES,
					'expiryMonth' => '',
					'expiryYear' => '',
					'holderName' => '',
				),
				'tranMCC' => '',
				'softDescriptor' => '',
			),
		),
    ),
);

try{
    $result = $client->__soapCall( 'authorizationService', array($request) );
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