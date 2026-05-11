<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class EdistrcitController extends Controller
{


public function sendrequestapiedistrict(Request $request){




    $url = 'http://164.100.181.28/DeptWebIntService/Service.asmx?op=SendRequest';
    // $response = [];http://164.100.181.16/DeptWebIntServiceCitizenDemo/Service.asmx
    $rKey= 'i9NNPqRFkC+zXJIMJ24obQb0P/NiyQLes4eOFOt97CnDDkCgBOMswrsxGU5AxZUvgi6MNuLIb73EHtByzqzggzN/olJtgZ1xx342Wei8SQZr9UvwCOwS/dyNhFZCkFvp';

    $depId= '5EA45F3FA6BD786D7E1024431E03961D';
    // $url = 'http://164.100.181.28/DeptWebIntServiceCitizenDemo/Service.asmx/SendRequest?RequestKey='.$rKey.'&DeptRegistraionID='.$depId;
    // dd($url);


    $main_xml_str =  '<?xml version="1.0" encoding="utf-8"?>
    <soap:Envelope xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xmlns:xsd="http://www.w3.org/2001/XMLSchema" xmlns:soap="http://schemas.xmlsoap.org/soap/envelope/">
      <soap:Body>
        <SendRequest xmlns="http://tempuri.org/">
          <RequestKey>'.$request->RequestKey.'</RequestKey>
          <DeptRegistraionID>'.$depId.'</DeptRegistraionID>
        </SendRequest>
      </soap:Body>
    </soap:Envelope>';
    $call_api = $this->call_curlApi($main_xml_str,$url,'Response');
    // $xml = simplexml_load_string($call_api, "SimpleXMLElement", LIBXML_NOCDATA);
    // $json = json_encode($xml);
    // $array = json_decode($json,TRUE);
$xmlStr = preg_replace("/(<\/?)(\w+):([^>]*>)/", "$1$2$3", $call_api);
$xml = simplexml_load_string($xmlStr);
$json = json_encode($xml);

$array = json_decode($json,TRUE);

$check = $array['soapBody']['SendRequestResponse']['SendRequestResult'];
$xmlStr = preg_replace("/(<\/?)(\w+):([^>]*>)/", "$1$2$3", $check);
$xml = simplexml_load_string($xmlStr);
$json = json_encode($xml);

$array = json_decode($json,TRUE);

$sessDetails = [
    'ReturnType'=> $array['ReturnType'],
    'UserName'=> $array['UserName'],
    'DCode'=> $array['DCode'],
    'RequestKey'=>$request->RequestKey,
];

Session::put('sessDetails', $sessDetails);

return view('e_district.home');



}



public function appResponse_reqId()
{
    // echo $rKey;die;

    $url = 'http://164.100.181.28/DeptWebIntService/Service.asmx?op=SendResponse';
    $rKey= 'i9NNPqRFkC+zXJIMJ24obQb0P/NiyQLes4eOFOt97CnDDkCgBOMswrsxGU5AxZUvgi6MNuLIb73EHtByzqzggzN/olJtgZ1xx342Wei8SQZr9UvwCOwS/dyNhFZCkFvp';

    $depId= '5EA45F3FA6BD786D7E1024431E03961D';
    $serviceCode = '16601';
    $application = '233233333';
    $main_xml_str = '<?xml version="1.0" encoding="utf-8"?><soap:Envelope xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xmlns:xsd="http://www.w3.org/2001/XMLSchema" xmlns:soap="http://schemas.xmlsoap.org/soap/envelope/"><soap:Body><SendResponse xmlns="http://tempuri.org/"><RequestKey>'.$rKey.'</RequestKey><DeptRegistraionID>'.$depId.'</DeptRegistraionID><ApplicationNo>'.$application.'</ApplicationNo><serviceCode>'.$serviceCode.'</serviceCode></SendResponse></soap:Body></soap:Envelope>';

    $call_api = $this->call_curlApi($main_xml_str,$url,'Response');

    $xmlStr = preg_replace("/(<\/?)(\w+):([^>]*>)/", "$1$2$3", $call_api);
    $xml = simplexml_load_string($xmlStr);
    $json = json_encode($xml);

    $array = json_decode($json,TRUE);

    $check = $array['soapBody']['SendResponseResponse']['SendResponseResult'];

    $xmlStr = preg_replace("/(<\/?)(\w+):([^>]*>)/", "$1$2$3", $check);
    $xml = simplexml_load_string($xmlStr);
    $json = json_encode($xml);

    $array = json_decode($json,TRUE);

    return $array;
}




public function call_curlApi($xml,$url,$arr_title){

        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => $url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 10,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => $xml,
            CURLOPT_HTTPHEADER => array(
                'Content-Type:text/xml',
                'Accept: application/xml'
            ),
        ));
        $curl_err = curl_error($curl);
        $response = curl_exec($curl);
        curl_close($curl);


        return $response;
        // print_r($curl_err);
        // echo $response;die;

        // $xml_res = XmlToArray::convert($response);
        // $res = XmlToArray::convert(@$xml_res['soap:Body']['Send'.$arr_title.'Response']['Send'.$arr_title.'Result']);
        // // print_r($res); die;

        // if(is_array($res)){
        //     return [true,$res];
        // }
        // $this->ErrorInsert('EDistrictController::call_curlApi',$curl_err.' not in array & empty res & not in status field.'.$response.' after convert :- '.json_encode($res));
        // return [false,$curl_err.' not in array & empty res & not in status field.'.$response];
        }




     public  function e_district_application_status(Request $req){


           if($req->servicecode == 16601){
         $check = DB::table('financial_assistance')->where('application_no', $req->applicationNo)->first();

         if($check){

            return response()->json(["error" => false, "msg" => $check->form_status]);

         }else{
            return response()->json(["error" => true, "msg" => "No Record Found."]);


         }



           }elseif($req->servicecode == 16602){
            $check =   DB::table('position_holder')->where('application_no', $req->applicationNo)->first();
            if($check){

                return response()->json(["error" => false, "msg" => $check->form_status]);

             }else{
                return response()->json(["error" => true, "msg" => "No Record Found."]);


             }
           }elseif($req->servicecode == 16603){


            if($req->gender == 1){
                $check =   DB::table('laxman_award')->where('application_no', $req->applicationNo)->first();
                if($check){

                    return response()->json(["error" => false, "msg" => $check->form_status]);

                 }else{
                    return response()->json(["error" => true, "msg" => "No Record Found."]);


                 }
            }elseif($req->gender == 2){
                $check =   DB::table('ranilaxmibai_award')->where('application_no', $req->applicationNo)->first();
                if($check){

                    return response()->json(["error" => false, "msg" => $check->form_status]);

                 }else{
                    return response()->json(["error" => true, "msg" => "No Record Found."]);



                 }
            }

           }
           elseif($req->servicecode == 16604){
            $check =   DB::table('direct_recruitment')->where('application_no', $req->applicationNo)->first();
            if($check){

                return response()->json(["error" => false, "msg" => $check->form_status]);

             }else{
                return response()->json(["error" => true, "msg" => "No Record Found."]);


             }
           }




           elseif($req->servicecode == 16605){
            $check =   DB::table('admission_registration_login')->where('application_no', $req->applicationNo)->where('payment_status', 1)->first();
            if($check){
                if($check->final_status == 1){
                    $final_status = 1;
                }elseif($check->final_status == 2){
                    $final_status = 3;
                }elseif($check->final_status == 3){
                    $final_status = 2;
                }

                return response()->json(["error" => false, "msg" => $final_status]);

             }else{
                return response()->json(["error" => true, "msg" => "No Record Found."]);


             }
           }



        }









}
