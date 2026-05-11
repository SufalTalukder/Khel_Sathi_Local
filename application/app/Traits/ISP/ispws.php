<?php

function getToken($apiUrl, $data){
   $curl = curl_init();
         curl_setopt($curl, CURLOPT_POST, 1);
         if ($data)
			curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
      

curl_setopt($curl, CURLOPT_URL, $apiUrl);
   curl_setopt($curl, CURLOPT_HTTPHEADER, array(
      'APIKEY: 123456789',
      'Content-Type: application/json',
   ));
   
   curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
   curl_setopt($curl, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
   
   $resultData = curl_exec($curl);
   if(!$resultData){
		die("Invalid API Request!");
	}
   curl_close($curl);
   return $resultData;
}



function callIspWs( $apiUrl, $data, $token){

   $curl = curl_init();
         curl_setopt($curl, CURLOPT_POST, 1);
         if ($data)
            curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
  
$headr = array();
$headr[] = 'Content-type: application/json';
$headr[] = 'Authorization: Bearer '.$token;
curl_setopt($curl, CURLOPT_URL, $apiUrl);
   curl_setopt($curl, CURLOPT_HTTPHEADER, $headr);
   
   curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);

   
   $resultData = curl_exec($curl);
   if(!$resultData){
		die("Invalid API Request!");
	}
   curl_close($curl);
   return $resultData;
}


?>

