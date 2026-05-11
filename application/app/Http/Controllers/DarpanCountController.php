<?php

namespace App\Http\Controllers;

use App\Imports\DarpanCount;
use App\Imports\Trial_import;
use App\Imports\Trial_import_coaching;
use App\Imports\Trial_import_state;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\HeadingRowImport;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use Symfony\Component\Mime\Message;

class DarpanCountController extends Controller
{
    public function darpancount(){
        return view('darpancount.create');
    }

    public function darpancountStore(Request $request){
        DB::Select("TRUNCATE TABLE`darpan_count`");


        $instance_code = $request->instance_code;
        $project_code =  $request->project_code;

        $objInput = [
            "instance_code" => $instance_code,
            "project_code" => $project_code,
        ];

        // $apiConnect = $this->ApiConnect($objInput, $instance_code,$project_code,$request->hmac_key, $request->web_api_key);


        // $response= $this->decryptdata($apiConnect, $request->web_api_key);


        $data = [
            'web_api_key' => $request->web_api_key,
            'hmac_key' => $request->hmac_key,
            'instance_code' => $request->instance_code,
            'project_code' => $request->project_code,
            'frequency_id' => $request->frequency_id,
            'group_id' => $request->group_id,
            'date' => $request->date,
        ];


        // foreach ($response as $lst) {
        //     echo   $lst["dd"] . "</br>" . $lst["gid"] . "</br>";
        // }


      Excel::import(new DarpanCount,  $request->file('file'));

      $datacount =  DB::table('darpan_count')->get();
      return view('darpancount.index')->with('data',$data)->with('datacount', $datacount)->with('success', 'Successfully Created');



    }




    public function ApiConnectWithDaterange($api, $api_key)
    {
        $data = json_encode($api);
        $rawdatastring = json_encode(["projpara" => $api, "rawdata" => $data]);

        $iv ="ZY4hPbe125vdVIr5QPDpQw==";

        $secretiv_base = base64_decode($iv); //IV



        $clientmis_key_base = base64_decode($api_key); //APIKEY

        $encryptionMethod = "AES-256-CBC";

        $data = openssl_encrypt(
            $rawdatastring,
            $encryptionMethod,
            $clientmis_key_base,
            "0",
            $secretiv_base
        );

        $hashdata = $data . $api_key;

        $hash = hash("sha512", $hashdata);

        $response = json_encode(
            [
                "data" => $data,
                "hash" => $hash,
                "iv" => $iv,
                "project_code" => $api["project_code"],
                "instance_code" => $api["instance_code"],
            ],
            JSON_UNESCAPED_SLASHES
        );

        return $response;
    }

    public function ApiConnect($objInput, $instance_code,$project_code,$hmac_key,$api_key)
    {

		$data = json_encode($objInput);
        $rawdata = json_encode(["projpara" => $objInput, "rawdata" => $data]);

        $token = $this->GetAuthHeaderValue($rawdata, $instance_code,$project_code,$hmac_key);


        /* $objInput=array();
       $instance_code= $this->instance_Code;
	   $project_code=$this->project_Code;

	   $objInput=array('instance_code' => $instance_code, 'project_code' => $project_code);
	    */

        $payload = $this->ApiConnectWithDaterange($objInput, $api_key);



        $url = "https://stateapi.darpan.nic.in/getdate";

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        $headers = [
            "Content-Type: application/json",
            "Authorization:" . $token,
        ];
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $payload);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_FAILONERROR, true);
        $response = curl_exec($ch);
        if (!$response) {
            // echo curl_error($ch);
        }
        curl_close($ch);

        return $response;
    }

    public function GetAuthHeaderValue($rawdata, $instance_code,$project_code,$hmac_key)
    {
        //$rawdata='{"projpara":{"instance_code":2,"project_code":2101998},"rawdata":"{\"instance_code\":2,\"project_code\":2101998}"}';

        $requestContentBase64String = hash("sha512", $rawdata);



        $PushDataAPIUrl = "https://stateapi.darpan.nic.in/getdate";

        $requestUri = urlencode($PushDataAPIUrl);

        $requestUri2 = strtolower($requestUri);

        $requestHttpMethod = "POST";

        $requestTimeStamp = time();

        $nonce = base64_encode(time());

        $clientmis_key_base = base64_decode($hmac_key); //HMACAPIKEY

        $RawSign =
            $instance_code .
            $project_code .
            $requestHttpMethod .
            $requestUri2 .
            $requestTimeStamp .
            $nonce .
            $requestContentBase64String;

        $hmac = hash_hmac("sha512", $RawSign, $clientmis_key_base, true);

        $hmac_base = base64_encode($hmac);

        $token =
            "DarpanToken " .
            $instance_code .
            ":" .
            $project_code .
            ":" .
            $hmac_base .
            ":" .
            $nonce .
            ":" .
            $requestTimeStamp;

        return $token;
    }


    public function darpancountStoreFinal(Request $request){




        $Contentmaster = [];


            $data2 = array();




            // for($i=0 ; $i<count($request->datacount); $i++){
            //     $data2[$i]['kvalue'] = $tKvalue[$i];
            //     $data2[$i]['lvalue'] = $tlvalue[$i];

            // }


            foreach (json_decode($request->datacount) as $key => $value) {

                $data2[$key]['kvalue'] = $value->k_value;
                $data2[$key]['lvalue'] = $value->l_value;
            }






            // getdate returns m/d/Y (e.g. 03/31/2026); convert to Y-m-d for SQL Server (e.g. 2026-03-31)
            $old_date = \DateTime::createFromFormat('m/d/Y', $request->date);
            $date = $old_date ? $old_date->format('Y-m-d') : $request->date;

           // var_dump($date);exit;
            array_push($Contentmaster, [
                "instance_code" => (int) $request->instance_code,
                "project_code" => (int) $request->project_code,
                "frequency_id" => (int) $request->frequency_id,
                "group_id" => (int)$request->group_id,
                "datadate" => stripslashes($date),
                "seq_no" => (int) 0,
                "listkpidata" => $data2,
                "totalrecordcount" =>count(json_decode($request->datacount)),
                "optional1" => null,
                "optional2" => null,
            ]);




        $compressstring = json_encode($Contentmaster, JSON_UNESCAPED_SLASHES);//string generated which will used for compresser

        $objInput = [];


        $objInput = [
            "instance_code" => (int) $request->instance_code,
            "project_code" => (int) $request->project_code,
        ];


        $tokenstring = json_encode(
            [
                "projpara" => $objInput,
                "rawdata" => json_encode(
                    $Contentmaster,
                    JSON_UNESCAPED_SLASHES
                ),
            ],
            JSON_UNESCAPED_SLASHES
        );//string generated which will used for token genertion







        $compressdata = $this->compresser($compressstring);//calling compresser function



        $payloadvalue = $this->PushDataPayload($objInput, $compressdata, $request->web_api_key);//calling payload function


    //    echo $payloadvalue;
        $token = $this->PushDataToken($tokenstring,$request->instance_code, $request->project_code ,$request->hmac_key);//calling token generation function


        $output = $this->PushDataApiConnect($payloadvalue, $token);//calling api function

        if (!$output) {
            return redirect()->route('darpancount')->with('success', 'API Error: No response from server.');
        }

        $decryptdata = json_decode($output);
        if (is_null($decryptdata) || !isset($decryptdata->data)) {
            // API returned a non-encrypted plain response (e.g. success/error message)
            return redirect()->route('darpancount')->with('success', 'API Response: ' . $output);
        }

        $decryptoutput = $this->decryptdata($output, $request->web_api_key);//calling decrypt function

        $message = isset($decryptoutput[0]['Message']) ? $decryptoutput[0]['Message'] : json_encode($decryptoutput);
        return redirect()->route('darpancount')->with('success', $message);
    }


    public function compresser($string)//compresser function
    {
        $str = $string;
        $buffer = unpack("C*", $str);
        $compressedData = gzencode($str);
        $compressedData_array = unpack("C*", $compressedData);
        $buffer = unpack("C*", pack("L", sizeof($buffer)));
        $gZipBuffer = array_merge($buffer, $compressedData_array);
        $str = call_user_func_array("pack", array_merge(["C*"], $gZipBuffer));
        return base64_encode($str);
    }

    public function PushDataPayload($api, $compressdata ,$api_key)//function to generate payload for pushdata
    {
        $rawdatastring = json_encode([
            "projpara" => $api,
            "compresseddata" => $compressdata,
        ]);

        $iv ="ZY4hPbe125vdVIr5QPDpQw==";

        $secretiv_base = base64_decode($iv); //IV



        $clientmis_key_base = base64_decode($api_key); //APIKEY

        $encryptionMethod = "AES-256-CBC"; // AES is used by the U.S. gov't to encrypt top secret documents.

        $data = openssl_encrypt(
            $rawdatastring,
            $encryptionMethod,
            $clientmis_key_base,
            "0",
            $secretiv_base
        );

        $hashdata = $data . $api_key;

        $hash = hash("sha512", $hashdata);

        $response = json_encode(
            [
                "data" => $data,
                "hash" => $hash,
                "iv" => $iv,
                "project_code" => $api["project_code"],
                "instance_code" => $api["instance_code"],
            ],
            JSON_UNESCAPED_SLASHES
        );

        return $response;
    }
    public function PushDataToken($rawdata, $instance_code , $project_code, $hmac_key)//function to generate token for pushdata
    {

        $requestContentBase64String = hash("sha512", $rawdata);



        // $instance_code = $this->instance_Code;



        // $project_code = $this->project_Code;

        $PushDataAPIUrl = "https://stateapi.darpan.nic.in/pushdata";

        $requestUri = urlencode($PushDataAPIUrl);

        $requestUri2 = strtolower($requestUri);

        $requestHttpMethod = "POST";

        $requestTimeStamp = time();

        $nonce = base64_encode(time());

        $clientmis_key_base = base64_decode($hmac_key); //HMACAPIKEY

        $RawSign =
            $instance_code .
            $project_code .
            $requestHttpMethod .
            $requestUri2 .
            $requestTimeStamp .
            $nonce .
            $requestContentBase64String;

        $hmac = hash_hmac("sha512", $RawSign, $clientmis_key_base, true);

        $hmac_base = base64_encode($hmac);

        $token =
            "DarpanToken " .
            $instance_code .
            ":" .
            $project_code .
            ":" .
            $hmac_base .
            ":" .
            $nonce .
            ":" .
            $requestTimeStamp;

        return $token;
    }

    public function PushDataApiConnect($payload, $token)//function for push data api calling
    {

        $url = "https://stateapi.darpan.nic.in/pushdata";

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        $headers = [
            "Content-Type: application/json",
            "Authorization:" . $token,
        ];
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $payload);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_FAILONERROR, true);
        $response = curl_exec($ch);
        if (!$response) {
            echo curl_error($ch);
        }
        curl_close($ch);



        return $response;
    }
    public function decryptdata($data, $api_key)
    {
        $decryptdata = json_decode($data);

        $output = $decryptdata->data;

        $iv = $decryptdata->iv;

        $secretiv_base = base64_decode($iv); //IV



        $clientmis_key_base = base64_decode($api_key); //APIKEY
        $encryptionMethod = "AES-256-CBC";

        //$clientmis_key_base = base64_decode($this->clientmis_key);

        $decryptedMessage = openssl_decrypt(
            $output,
            $encryptionMethod,
            $clientmis_key_base,
            "0",
            $secretiv_base
        );

        $decrypt_json = json_decode($decryptedMessage, true);

        return $decrypt_json;
    }





    public function getdateAction(Request $request)
    {
        $objInput = [
            "instance_code" => (int) $request->instance_code,
            "project_code"  => (int) $request->project_code,
        ];

        $apiResponse = $this->ApiConnect(
            $objInput,
            $request->instance_code,
            $request->project_code,
            $request->hmac_key,
            $request->web_api_key
        );

        $decrypted = $this->decryptdata($apiResponse, $request->web_api_key);

        return response()->json($decrypted);
    }

    public function trial_import(Request $request){


        if ($request->isMethod('post'))
        {

            Excel::import(new Trial_import_coaching,  $request->file('file'));


            return redirect()->back()->with('success', 'Successfully Uploaded');
        }



    return view('darpancount.trial');

}


















}


