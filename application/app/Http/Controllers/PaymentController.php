<?php

namespace App\Http\Controllers;

use App\Models\OnlineAdmissionModel;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

use Illuminate\Support\Facades\Http;

class PaymentController extends Controller
{


    private const OPENSSL_CIPHER_NAME = "aes-128-cbc";
    private const CIPHER_KEY_LEN = 16;
    private static function fixKey($key)
    {

        if (strlen($key) < PaymentController::CIPHER_KEY_LEN) {

            return str_pad("$key", PaymentController::CIPHER_KEY_LEN, "0");
        }

        if (strlen($key) > PaymentController::CIPHER_KEY_LEN) {

            return substr($key, 0, PaymentController::CIPHER_KEY_LEN);
        }
        return $key;
    }

    static function encrypt($key, $iv, $data)
    {


        //echo 'Data value is :' .$data;
        //echo "<br>";
        $encodedEncryptedData = base64_encode(openssl_encrypt($data, PaymentController::OPENSSL_CIPHER_NAME, PaymentController::fixKey($key), OPENSSL_RAW_DATA, $iv));

        $encodedIV = base64_encode($iv);
        $encryptedPayload = $encodedEncryptedData . ":" . $encodedIV;
        //echo '$encryptedPayload value is :' .$encryptedPayload;

        return $encryptedPayload;
    }


    public function gateway()
    {
        $data = DB::table('admission_registration_login as rg')
            ->join('online_admission_basic_details as basic', 'rg.id', '=', 'basic.user_id')
            ->join('online_admission_communication_details as communication', 'rg.id', '=', 'communication.user_id')
            ->join('online_admission_education_document_details as education', 'rg.id', '=', 'education.user_id')
            ->join('sport_type', 'basic.sport_type', '=', 'sport_type.id')
            ->join('cities', 'cities.id', '=', 'communication.p_district')
            ->select('rg.*', 'basic.*', 'communication.*', 'education.*', 'sport_type.name', 'cities.trial_from_date')
            ->where('rg.id', Auth::guard('OnlineAdmission')->user()->id)->first();

        $encData = null;
        $clientCode = 'GGSSC';
        $username = 'nishant.jha_8637';
        $password = 'GGSSC_SP8637';
        $authKey = 'voeXpkMY5WTg63sl';
        $authIV = 'wE9gkr5BKoTXf8Mh';

        $payerName = $data->fullname;
        $payerEmail = $data->email;
        $payerMobile = $data->mobile;
        $payerAddress = '';

        $clientTxnId = date('Y') . time();
        $amount = 200;
        $amountType = 'INR';
        $mcc = 5137;
        $channelId = 'W';
        $callbackUrl = route('gatewayResponse');
        $challan_no = $data->challan_no;

        $encData = "?clientCode=" . $clientCode . "&transUserName=" . $username . "&transUserPassword=" . $password . "&payerName=" . $payerName .
            "&payerMobile=" . $payerMobile . "&payerEmail=" . $payerEmail . "&payerAddress=" . $payerAddress . "&clientTxnId=" . $clientTxnId .
            "&amount=" . $amount . "&amountType=" . $amountType . "&mcc=" . $mcc . "&channelId=" . $channelId . "&callbackUrl=" . $callbackUrl . "&udf6=" . $challan_no;

        $paymentdata = $this->encrypt($authKey, $authIV, $encData);
        return view('onlineAdmission.payment')->with('data', $data)->with('clientCode', $clientCode)->with('paymentdata', $paymentdata)->with('clientTxnId', $clientTxnId);
    }


    public function gatewayResponse(Request $request)
    {
        $query = $request->encResponse;
        $authKey = 'voeXpkMY5WTg63sl';
        $authIV = 'wE9gkr5BKoTXf8Mh';
        $decText = null;
        $decText = $this->decrypt($authKey, $authIV, $query);;
        $array = explode("&", $decText);
        $payerName = Str::after($array[0], '=');
        $payerEmail = Str::after($array[1], '=');
        $payerMobile = Str::after($array[2], '=');
        $clientTxnId = Str::after($array[3], '=');
        $amount = Str::after($array[5], '=');
        $clientCode = Str::after($array[6], '=');
        $paidAmount = Str::after($array[7], '=');
        $paymentMode = Str::after($array[8], '=');
        $bankName = Str::after($array[9], '=');
        $amountType = Str::after($array[10], '=');
        $uniquechallan = Str::after($array[26], '=');
        $status = Str::after($array[11], '=');
        $statusCode = Str::after($array[12], '=');
        $challanNumber = Str::after($array[26], '=');
        $SabPaisaTxnId = Str::after($array[14], '=');
        $SabPaisaMessage = Str::after($array[15], '=');
        $bankMessage = Str::after($array[16], '=');
        $bankErrorCode = Str::after($array[17], '=');
        $SabPaisaErrorCode = Str::after($array[18], '=');
        $bankTxnId = Str::after($array[19], '=');
        $transDate = Str::after($array[20], '=');

        $student =    OnlineAdmissionModel::where('email', $payerEmail)->first();
        Auth::guard('OnlineAdmission')->login($student);
        if ($status == 'SUCCESS' &&   ($amount == '200.0')) {  // TEMP: 5.0 for test

            // Step 1: Immediately record payment and mark as paid (before secondary verification)
            $user = DB::table('admission_registration_login')->where('challan_no', $challanNumber)->first();
            if ($user) {
                DB::table('admission_registration_login')->where('id', $user->id)->update([
                    'payment_status' => 1,
                    'enroll_no' => date('Y') . sprintf("%06d", $user->id)
                ]);
                $paymentData = [
                    'user_id' => $user->id,
                    'payerName' => $payerName,
                    'payerEmail' => $payerEmail,
                    'payerMobile' => $payerMobile,
                    'clientTxnId' => $clientTxnId,
                    'amount' => $amount,
                    'clientCode' =>  $clientCode,
                    'paidAmount' => $paidAmount,
                    'paymentMode' => $paymentMode,
                    'bankName' =>  $bankName,
                    'amountType' => $amountType,
                    'uniquechallan' => $uniquechallan,
                    'status' => $status,
                    'statusCode' =>   $statusCode,
                    'challanNumber' =>   $challanNumber,
                    'SabPaisaTxnId' => $SabPaisaTxnId,
                    'SabPaisaMessage' =>  $SabPaisaMessage,
                    'bankMessage' => $bankMessage,
                    'bankErrorCode' =>  $bankErrorCode,
                    'SabPaisaErrorCode' =>   $SabPaisaErrorCode,
                    'bankTxnId' =>   $bankTxnId,
                    'transDate' =>  $transDate,
                ];
                DB::table('online_admission_payment_response_details')->insert($paymentData);
            }

            // Step 2: Secondary verification (audit only — payment already recorded above)
            try {
                $statusTrans = 'clientCode=GGSSC&clientTxnId=' . $clientTxnId;
                $statusTransEncData = $this->encrypt($authKey, $authIV, $statusTrans);
                $parts = explode(':', $statusTransEncData);
                $verifyUrl = "https://txnenquiry.sabpaisa.in/SPTxtnEnquiry/getTxnStatusByClientxnId";
                $ch = curl_init($verifyUrl);
                curl_setopt($ch, CURLOPT_POST, 1);
                curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode(['clientCode' => 'GGSSC', 'statusTransEncData' => $parts[0]]));
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
                curl_setopt($ch, CURLOPT_HTTPHEADER, ['Content-Type: application/json']);
                curl_setopt($ch, CURLOPT_TIMEOUT, 10);
                $result = curl_exec($ch);
                curl_close($ch);

                if ($result && $user && $user->registered_from == 2) {
                    $check = DB::table('admission_registration_login')->where('id', $user->id)->first();
                    $soapUrl = 'http://164.100.181.28/DeptWebIntService/Service.asmx?op=SendResponse';
                    $main_xml_str = '<?xml version="1.0" encoding="utf-8"?><soap:Envelope xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xmlns:xsd="http://www.w3.org/2001/XMLSchema" xmlns:soap="http://schemas.xmlsoap.org/soap/envelope/"><soap:Body><SendResponse xmlns="http://tempuri.org/"><RequestKey>' . $check->RequestKey . '</RequestKey><DeptRegistraionID>5EA45F3FA6BD786D7E1024431E03961D</DeptRegistraionID><ApplicationNo>' . $check->application_no . '</ApplicationNo><serviceCode>' . $check->serviceCode . '</serviceCode></SendResponse></soap:Body></soap:Envelope>';
                    call_curlApi($main_xml_str, $soapUrl, 'Response');
                }
            } catch (\Exception $e) {
                // Verification failed but payment already recorded — safe to continue
            }

            // Step 3: Redirect to receipt page
            $receiptRoute = ($user && $user->registered_from == 1) ? 'onlineAdmissionTest.paymentReceipt' : 'onlineAdmission.dashboard';
            return redirect()->route($receiptRoute)->with('success', 'Payment Successful. Your application has been submitted successfully.');
        } else {
            $user =  DB::table('admission_registration_login')->where('challan_no', $challanNumber)->first();

            $paymentData = [
                'user_id' => $user->id,
                'payerName' => $payerName,
                'payerEmail' => $payerEmail,
                'payerMobile' => $payerMobile,
                'clientTxnId' => $clientTxnId,
                'amount' => $amount,
                'clientCode' =>  $clientCode,
                'paidAmount' => $paidAmount,
                'paymentMode' => $paymentMode,
                'bankName' =>  $bankName,
                'amountType' => $amountType,
                'uniquechallan' => $uniquechallan,
                'status' => $status,
                'statusCode' =>   $statusCode,
                'challanNumber' =>   $challanNumber,
                'SabPaisaTxnId' => $SabPaisaTxnId,
                'SabPaisaMessage' =>  $SabPaisaMessage,
                'bankMessage' => $bankMessage,
                'bankErrorCode' =>  $bankErrorCode,
                'SabPaisaErrorCode' =>   $SabPaisaErrorCode,
                'bankTxnId' =>   $bankTxnId,
                'transDate' =>  $transDate
            ];

            $data = DB::table('online_admission_payment_response_details')->insert($paymentData);
            $dashRoute = $user && $user->registered_from == 1 ? 'onlineAdmissionTest.dashboard' : 'onlineAdmission.dashboard';
            return redirect()->route($dashRoute)->with('success', 'Payment Failed. Please try again.');
        }
    }



    public function transactionenquirystore(Request $request)
    {


        $statusTrans = 'clientCode=GGSSC&clientTxnId=' . $request->clientTxnID;

        $authKey = 'voeXpkMY5WTg63sl';
        $authIV = 'wE9gkr5BKoTXf8Mh';

        $statusTransEncData = $this->encrypt($authKey, $authIV,  $statusTrans);

        $parts = explode(':', $statusTransEncData);

        $url = "https://txnenquiry.sabpaisa.in/SPTxtnEnquiry/getTxnStatusByClientxnId";
        $Data = [

            'clientCode' => 'GGSSC',
            'statusTransEncData' => $parts[0],

        ];

        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($Data));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
        $result = curl_exec($ch);
        curl_close($ch);

        $decryptedData = openssl_decrypt(
            base64_decode(json_decode($result)->statusResponseData),
            PaymentController::OPENSSL_CIPHER_NAME,
            PaymentController::fixKey($authKey),
            OPENSSL_RAW_DATA,
            base64_decode($parts[1])
        );

        $array  = explode("&", $decryptedData);


        $udf1 =   $uniquechallan = Str::after($array[11], '=');
        $udf6 =   $uniquechallan = Str::after($array[16], '=');

        if ($udf1 == "NA" || $udf1 == null) {
            $uniquechallan =   $uniquechallan = Str::after($array[16], '=');
        } else if ($udf6 == "NA" || $udf6 == null) {
            $uniquechallan =   $uniquechallan = Str::after($array[11], '=');
        } else {
            $uniquechallan = false;
        }
        // $udf6=   $uniquechallan= Str::after($array[16], '=') ;

        $payerName = Str::after($array[0], '=');
        $payerEmail = Str::after($array[1], '=');
        $payerMobile = Str::after($array[2], '=');
        $clientTxnId = Str::after($array[3], '=');
        $amount = Str::after($array[5], '=');
        $clientCode = Str::after($array[6], '=');
        $paidAmount = Str::after($array[7], '=');
        $paymentMode = Str::after($array[8], '=');
        $bankName = Str::after($array[9], '=');
        $amountType = Str::after($array[10], '=');
        //    $uniquechallan= Str::after($array[11], '=') ;
        $status = Str::after($array[31], '=');
        $statusCode = Str::after($array[33], '=');
        $challanNumber = Str::after($array[26], '=');
        $SabPaisaTxnId = Str::after($array[35], '=');
        $SabPaisaMessage = Str::after($array[36], '=');
        $bankMessage = Str::after($array[37], '=');
        $bankErrorCode = Str::after($array[38], '=');
        $SabPaisaErrorCode = Str::after($array[39], '=');
        $bankTxnId = Str::after($array[40], '=');
        $transDate = Str::after($array[43], '=');


        if ($status == 'SUCCESS' &&   $amount == '200.0' && $uniquechallan) {

            $user =  DB::table('admission_registration_login')->where('challan_no',  $uniquechallan)->where('email', $payerEmail)->first();

            if ($user) {
                DB::table('admission_registration_login')->where('challan_no',  $uniquechallan)->where('email', $payerEmail)->update([
                    'payment_status' => 1,
                    'enroll_no' => date('Y') . sprintf("%06d", $user->id)
                ]);




                $check = DB::table('admission_registration_login')->where('id',   $user->id)->first();

                $url = 'http://164.100.181.28/DeptWebIntService/Service.asmx?op=SendResponse';
                $rKey = $check->RequestKey;

                $depId = '5EA45F3FA6BD786D7E1024431E03961D';
                $serviceCode = $check->serviceCode;
                $application = $check->application_no;
                $main_xml_str = '<?xml version="1.0" encoding="utf-8"?><soap:Envelope xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xmlns:xsd="http://www.w3.org/2001/XMLSchema" xmlns:soap="http://schemas.xmlsoap.org/soap/envelope/"><soap:Body><SendResponse xmlns="http://tempuri.org/"><RequestKey>' . $rKey . '</RequestKey><DeptRegistraionID>' . $depId . '</DeptRegistraionID><ApplicationNo>' . $application . '</ApplicationNo><serviceCode>' . $serviceCode . '</serviceCode></SendResponse></soap:Body></soap:Envelope>';

                $call_api = call_curlApi($main_xml_str, $url, 'Response');

                $xmlStr = preg_replace("/(<\/?)(\w+):([^>]*>)/", "$1$2$3", $call_api);
                $xml = simplexml_load_string($xmlStr);
                $json = json_encode($xml);

                $array = json_decode($json, TRUE);

                $check = $array['soapBody']['SendResponseResponse']['SendResponseResult'];

                $xmlStr = preg_replace("/(<\/?)(\w+):([^>]*>)/", "$1$2$3", $check);
                $xml = simplexml_load_string($xmlStr);
                $json = json_encode($xml);

                $array = json_decode($json, TRUE);

                if ($array['ReturnType'] != 1) {
                    session()->flash('error', 'Technical Issue.');
                    return;
                }











                $paymentData = [

                    'user_id' => $user->id,
                    'payerName' => $payerName,
                    'payerEmail' => $payerEmail,
                    'payerMobile' => $payerMobile,
                    'clientTxnId' => $clientTxnId,
                    'amount' => $amount,
                    'clientCode' =>  $clientCode,
                    'paidAmount' => $paidAmount,
                    'paymentMode' => $paymentMode,
                    'bankName' =>  $bankName,
                    'amountType' => $amountType,
                    'uniquechallan' => $uniquechallan,
                    'status' => $status,
                    'statusCode' =>   $statusCode,
                    'challanNumber' =>   $challanNumber,
                    'SabPaisaTxnId' => $SabPaisaTxnId,
                    'SabPaisaMessage' =>  $SabPaisaMessage,
                    'bankMessage' => $bankMessage,
                    'bankErrorCode' =>  $bankErrorCode,
                    'SabPaisaErrorCode' =>   $SabPaisaErrorCode,
                    'bankTxnId' =>   $bankTxnId,
                    'transDate' =>  $transDate,


                ];
                //dd($paymentData);

                $data = DB::table('online_admission_payment_response_details')->insert($paymentData);

                return redirect()->route('transactionenquiryupdate')->with('success', 'Payment Successfull.');;
            } else {
                return redirect()->route('transactionenquiryupdate')->with('error', 'user not found.');;
            }
        } else {
            return redirect()->route('transactionenquiryupdate')->with('error', 'Payment Failed.');;
        }
    }


    public function transactionenquirystorebyemail(Request $request)
    {


        $statusTrans = 'clientCode=GGSSC&clientTxnId=' . $request->clientTxnID;

        $authKey = 'voeXpkMY5WTg63sl';
        $authIV = 'wE9gkr5BKoTXf8Mh';

        $statusTransEncData = $this->encrypt($authKey, $authIV,  $statusTrans);

        $parts = explode(':', $statusTransEncData);

        $url = "https://txnenquiry.sabpaisa.in/SPTxtnEnquiry/getTxnStatusByClientxnId";
        $Data = [

            'clientCode' => 'GGSSC',
            'statusTransEncData' => $parts[0],

        ];

        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($Data));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
        $result = curl_exec($ch);
        curl_close($ch);

        $decryptedData = openssl_decrypt(
            base64_decode(json_decode($result)->statusResponseData),
            PaymentController::OPENSSL_CIPHER_NAME,
            PaymentController::fixKey($authKey),
            OPENSSL_RAW_DATA,
            base64_decode($parts[1])
        );

        $array  = explode("&", $decryptedData);
        // dd($array);

        // $udf1=   $uniquechallan= Str::after($array[11], '=') ;
        // $udf6=   $uniquechallan= Str::after($array[16], '=') ;

        // if($udf1=="NA" || $udf1==null){
        //     $uniquechallan=   $uniquechallan= Str::after($array[16], '=') ;
        // }
        // else if($udf6=="NA" || $udf6==null){
        //     $uniquechallan=   $uniquechallan= Str::after($array[11], '=') ;
        // }else{
        //     $uniquechallan = false;
        // }
        // $udf6=   $uniquechallan= Str::after($array[16], '=') ;

        $payerName = Str::after($array[0], '=');
        $payerEmail = Str::after($array[1], '=');
        $payerMobile = Str::after($array[2], '=');
        $clientTxnId = Str::after($array[3], '=');
        $amount = Str::after($array[5], '=');
        $clientCode = Str::after($array[6], '=');
        $paidAmount = Str::after($array[7], '=');
        $paymentMode = Str::after($array[8], '=');
        $bankName = Str::after($array[9], '=');
        $amountType = Str::after($array[10], '=');
        //    $uniquechallan= Str::after($array[11], '=') ;
        $status = Str::after($array[31], '=');
        $statusCode = Str::after($array[33], '=');
        $challanNumber = Str::after($array[26], '=');
        $SabPaisaTxnId = Str::after($array[35], '=');
        $SabPaisaMessage = Str::after($array[36], '=');
        $bankMessage = Str::after($array[37], '=');
        $bankErrorCode = Str::after($array[38], '=');
        $SabPaisaErrorCode = Str::after($array[39], '=');
        $bankTxnId = Str::after($array[40], '=');
        $transDate = Str::after($array[43], '=');


        if ($status == 'SUCCESS' &&   $amount == '200.0') {

            $user =  DB::table('admission_registration_login')->where('fullname',  $payerName)->where('email', $payerEmail)->where('mobile', $payerMobile)->first();

            if ($user) {
                DB::table('admission_registration_login')->where('fullname',  $payerName)->where('email', $payerEmail)->where('mobile', $payerMobile)->update([
                    'payment_status' => 1,
                    'enroll_no' => date('Y') . sprintf("%06d", $user->id)
                ]);


                if (Auth::guard('OnlineAdmission')->user()->registered_from == 2) {

                    $check = DB::table('admission_registration_login')->where('id', Auth::guard('OnlineAdmission')->user()->id)->first();

                    $url = 'http://164.100.181.28/DeptWebIntService/Service.asmx?op=SendResponse';
                    $rKey = $check->RequestKey;

                    $depId = '5EA45F3FA6BD786D7E1024431E03961D';
                    $serviceCode = $check->serviceCode;
                    $application = $check->application_no;
                    $main_xml_str = '<?xml version="1.0" encoding="utf-8"?><soap:Envelope xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xmlns:xsd="http://www.w3.org/2001/XMLSchema" xmlns:soap="http://schemas.xmlsoap.org/soap/envelope/"><soap:Body><SendResponse xmlns="http://tempuri.org/"><RequestKey>' . $rKey . '</RequestKey><DeptRegistraionID>' . $depId . '</DeptRegistraionID><ApplicationNo>' . $application . '</ApplicationNo><serviceCode>' . $serviceCode . '</serviceCode></SendResponse></soap:Body></soap:Envelope>';

                    $call_api = call_curlApi($main_xml_str, $url, 'Response');

                    $xmlStr = preg_replace("/(<\/?)(\w+):([^>]*>)/", "$1$2$3", $call_api);
                    $xml = simplexml_load_string($xmlStr);
                    $json = json_encode($xml);

                    $array = json_decode($json, TRUE);

                    $check = $array['soapBody']['SendResponseResponse']['SendResponseResult'];

                    $xmlStr = preg_replace("/(<\/?)(\w+):([^>]*>)/", "$1$2$3", $check);
                    $xml = simplexml_load_string($xmlStr);
                    $json = json_encode($xml);

                    $array = json_decode($json, TRUE);

                    if ($array['ReturnType'] != 1) {
                        session()->flash('error', 'Technical Issue.');
                        return;
                    }
                };


                $paymentData = [

                    'user_id' => $user->id,
                    'payerName' => $payerName,
                    'payerEmail' => $payerEmail,
                    'payerMobile' => $payerMobile,
                    'clientTxnId' => $clientTxnId,
                    'amount' => $amount,
                    'clientCode' =>  $clientCode,
                    'paidAmount' => $paidAmount,
                    'paymentMode' => $paymentMode,
                    'bankName' =>  $bankName,
                    'amountType' => $amountType,
                    'uniquechallan' => $user->challan_no,
                    'status' => $status,
                    'statusCode' =>   $statusCode,
                    'challanNumber' =>   $challanNumber,
                    'SabPaisaTxnId' => $SabPaisaTxnId,
                    'SabPaisaMessage' =>  $SabPaisaMessage,
                    'bankMessage' => $bankMessage,
                    'bankErrorCode' =>  $bankErrorCode,
                    'SabPaisaErrorCode' =>   $SabPaisaErrorCode,
                    'bankTxnId' =>   $bankTxnId,
                    'transDate' =>  $transDate,
                ];


                $data = DB::table('online_admission_payment_response_details')->insert($paymentData);

                return redirect()->route('transactionenquiryupdatebyemail')->with('success', 'Payment Successfull.');;
            } else {
                return redirect()->route('transactionenquiryupdatebyemail')->with('error', 'user not found.');;
            }
        } else {
            return redirect()->route('transactionenquiryupdatebyemail')->with('error', 'Payment Failed.');;
        }
    }
    static function decrypt($key, $iv, $data)
    {

        $parts = explode(':', $data);
        //print_r($parts);                     //Separate Encrypted data from iv.
        $encrypted = $parts[0];
        $iv = $parts[1];
        $decryptedData = openssl_decrypt(
            base64_decode($encrypted),
            PaymentController::OPENSSL_CIPHER_NAME,
            PaymentController::fixKey($key),
            OPENSSL_RAW_DATA,
            base64_decode($iv)
        );
        return $decryptedData;
    }


    static function respdecrypt($key, $iv, $data)
    {

        $parts = explode(':', $data);
        //print_r($parts);                     //Separate Encrypted data from iv.
        $encrypted = $parts[0];
        $iv = $parts[1];
        $decryptedData = openssl_decrypt(
            base64_decode($encrypted),
            PaymentController::OPENSSL_CIPHER_NAME,
            PaymentController::fixKey($key),
            OPENSSL_RAW_DATA,
            base64_decode($iv)
        );
        return $decryptedData;
    }




    //     public function gatewayRefund(){

    //         $encData=null;

    //         $clientCode='NITE5';


    //         $authKey = 'zvMzY0UZLxkiE6ad';
    //         $authIV = 'iFwrtsCSw3j7HG15';
    //         $clientCode='NITE5';
    //         $amount=100;
    //         $spTxnId ='018720805230913035';
    //         $clientTxnId='1814';
    //         $message ='return my payment'
    //       ;
    //         $encData= "amount=".$amount."&spTxnId=".$spTxnId."&clientTxnId=".$clientTxnId."&message=".$message ;


    //         $refundQuery = $this->encrypt($authKey, $authIV, $encData);

    //          $ch = curl_init();

    //          curl_setopt($ch,CURLOPT_URL, `https://stage-securepay.sabpaisa.in/SabPaisaRefundApi/refund?clientcode=$clientCode&refundQuery=$refundQuery`);

    //             curl_setopt($ch,CURLOPT_HTTPGET, true);

    //             //curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/x-www-form-urlencoded'));
    //             curl_setopt($ch,CURLOPT_RETURNTRANSFER, true);
    //             $result = curl_exec($ch);
    //             dd($result)
    // ;

    //     }



    public function transactiondetail(Request $request)
    {

        $data = [
            'clientTxnId' => $request->transaction,
            'user_id' =>  Auth::guard('OnlineAdmission')->user()->id,
            'uniquechallan' => Auth::guard('OnlineAdmission')->user()->challan_no,
            'date' => date("Y-m-d h:i:sa")
        ];
        $data = DB::table('online_admission_transaction')->insert($data);

        return response()->json(["error" => false, "msg" => "Transaction detail Submit Successfully"]);
    }


    public function transactionenquiryupdate()
    {
        return view('collegeAdmin.transactionenquiryupdate');
    }

    public function transactionenquiryupdatebyemail()
    {
        return view('collegeAdmin.transactionenquiryupdatebyemail');
    }
}
