<?php

include "wsdataclass.php";
include "encdec.php";
include "ispws.php";

$url= "http://164.100.181.91";

 $secretkey = "VXYKacPsLWPzXXxZnyYbheKuvnMiDZoX";  //Replace with your secret key
//  $tokenpassword = "1kPe8PdpLX0b4gREHuMe";//Replace with your token password
//  $dept_id = "1234567";  //Replace with your dept id		 
$tokenpassword = "kye9Bx2sUTfeSu3wVyFq";//Replace with your token password
 $dept_id = "6384862";  //Replace with your dept id		 

$postData = array (
	"username"=>  $dept_id,  
	"password"=>  $tokenpassword  
);



$response = json_decode(getToken( $url.'/ispws/authenticate', json_encode($postData)));	
print_r($response);



$token=$response->token;


////////////////////////////////////Calling api getRequestValidatedAndRequestID//////////////////
$inputData = array (
	"sessionkey"=> "5C1EHC89EE49FE31FFA5B682CF0512089509"
);

$e_data = encryptString(json_encode($inputData),$secretkey);
echo json_encode($inputData)."sessionkey enc"."<br>";
echo $e_data;

$finalLoad = array(
	"dept_id"=> $dept_id,
	"e_data"=> $e_data
);


$response = callIspWs( $url.'/ispws/isp/v1/getRequestValidatedAndRequestID', json_encode($finalLoad),$token );	
echo $response;
$Data_enc= json_decode($response)->data;

$Data_dsc= json_decode(decryptString($Data_enc,$secretkey));

//echo $Data_dsc;
$request_id=$Data_dsc->request_id;
$applicant_id=$Data_dsc->applicant_id;
$service_code=$Data_dsc->service_code;

session_start();
$_SESSION["request_id"]=$request_id;
$_SESSION["applicant_id"]=$applicant_id;
$_SESSION["service_code"]=$service_code;

echo $request_id."----".$applicant_id."----".$service_code;


//////////////////////////////////////////////////////END///////////////////////




////////////////////////////////////Calling api getApplicantCommonDetails//////////////////
$inputData = array (
	"request_id"=> $request_id
);

$e_data = encryptString(json_encode($inputData),$secretkey);
echo json_encode($inputData)."sessionkey enc"."<br>";
echo $e_data."------edata";

$finalLoad = array(
	"dept_id"=> $dept_id,
	"e_data"=> $e_data
);

$response = callIspWs( $url.'/ispws/isp/v1/getApplicantCommonDetails', json_encode($finalLoad),$token );	
echo $response."-------response";
$Data_enc= json_decode($response)->data;

$Data_dsc= json_decode(decryptString($Data_enc,$secretkey));
echo $Data_dsc."-----------------------------";
////////data dsc will hold all the common details fields
$first_name_eng=$Data_dsc->first_name_eng;
echo $first_name_eng;


//////////////////////////////////////////////////////END///////////////////////




////////////////////////////////////Calling api returnServiceStatus//////////////////


$returnServiceStatus = new ReturnServiceStatus();
$returnServiceStatus->set_applicant_id($_SESSION['applicant_id']);
$returnServiceStatus->set_request_id($_SESSION['request_id']);

$returnServiceStatus->set_service_code($_SESSION['service_code']);
$returnServiceStatus->set_application_id("122345");
$returnServiceStatus->set_status_code("s101");
$returnServiceStatus->set_remarks("test");
$returnServiceStatus->set_pendency_level("10");
$returnServiceStatus->set_action_taken_time("2023-11-15 11:11:10");
$returnServiceStatus->set_pending_with_officer("NA");

$e_data = encryptString(json_encode($returnServiceStatus),$secretkey);

$finalLoad = array(
	"dept_id"=> $dept_id,
	"e_data"=> $e_data
);


echo json_encode($finalLoad).'final load return';
$response = callIspWs( $url.'/ispws/isp/v1/returnServiceStatus', json_encode($finalLoad),$token );	
echo $response."-------response";
$Data_enc= json_decode($response)->data;

$Data_dsc= json_encode(decryptString($Data_enc,$secretkey));



//////////////////////////////////////////////////////END///////////////////////

?>