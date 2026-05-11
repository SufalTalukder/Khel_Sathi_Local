<?php

namespace App\Http\Controllers;

use App\Models\CoachingCamp;
use App\Models\HostelRegister;
use App\Models\OnlineAdmissionModel;
use App\Models\FacilityRegister;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class RajkoshController extends Controller
{
  public function payment_request_bkp_20_01_25(Request $request)
  {

    $userDetail = Auth::guard('hostel')->user();
    $division_id = rajkosh_division_treasury($userDetail->applicationCommunicationDetails->pdistrict->id);

    $DEPCODE = 'EDU';
    $enc_DEPCODE = base64_encode('EDU');
    $PMODE = 'NETPAY';
    $enc_PMODE = base64_encode('NETPAY');
    $PTYPE = "";
    $CHQDDNO = '';
    $CHQDT = "";
    $ASMTYEAR = (config('app.session_year') - 1) . '-' . config('app.session_year');
    $enc_ASMTYEAR = base64_encode((config('app.session_year') - 1) . '-' . config('app.session_year'));
    $TAXPERIOD = "A";
    $enc_TAXPERIOD = base64_encode("A");
    $PERIOD = "";
    $enc_BANK = base64_encode("0001");
    $UIDNO = "";
    $enc_NAME = base64_encode($userDetail->name);
    $enc_DepositorADDRESS = "";
    $enc_DIVCODE = base64_encode($division_id->DIVCODE);
    $TCODE = $division_id->TCODE;
    $enc_TCODE = base64_encode($TCODE);
    $enc_LOCATION = base64_encode($userDetail->applicationCommunicationDetails->pdistrict->city);
    $REMARK = "";
    $TOTAL = '2500';
    $enc_TOTAL = base64_encode('2500');
    $enc_REFERENCEID = base64_encode("S05");
    $enc_ServiceID = base64_encode("05");
    $SNO = "40";
    $enc_SNO = base64_encode("40");
    $HEAD = "020203101010000";
    $enc_HEAD = base64_encode("020203101010000");
    $AMOUNT = '2500';
    $enc_AMOUNT = base64_encode('2500');

    $OTHER1 = $DEPCODE . $PMODE . $ASMTYEAR . $TAXPERIOD . $TCODE . $TOTAL;
    $md5OTHER1 = strtoupper(md5($OTHER1));
    $sha512other1 = strtoupper(hash("sha512", $md5OTHER1));

    $OTHER2 = $DEPCODE . $SNO . $HEAD . $AMOUNT;
    $md5OTHER2 = strtoupper(md5($OTHER2));
    $sha512other2 = strtoupper(hash("sha512", $md5OTHER2));


    $curl = curl_init();

    curl_setopt_array($curl, array(
      CURLOPT_URL => 'https://rajkosh.up.nic.in/rkapi/rajkoshapi/Rajkosh',
      CURLOPT_RETURNTRANSFER => true,
      CURLOPT_ENCODING => '',
      CURLOPT_MAXREDIRS => 10,
      CURLOPT_TIMEOUT => 0,
      CURLOPT_FOLLOWLOCATION => true,
      CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
      CURLOPT_CUSTOMREQUEST => 'POST',
      CURLOPT_POSTFIELDS => '{"DEPCODE":"' . $enc_DEPCODE . '","PMODE":"' . $enc_PMODE . '","PTYPE":"","CHQDDNO":"","CHQDT":"","ASMTYEAR":"' . $enc_ASMTYEAR . '","TAXPERIOD":"' . $enc_TAXPERIOD . '","PERIOD":"","BANK":"' . $enc_BANK . '","UIDNO":"","NAME":"' . $enc_NAME . '","DepositorADDRESS":"' . $enc_DepositorADDRESS . '","DIVCODE":"' . $enc_DIVCODE . '","TCODE":"' . $enc_TCODE . '","LOCATION":"' . $enc_LOCATION . '","REMARK":"","TOTAL":"' . $enc_TOTAL . '","REFERENCEID":"' . $enc_REFERENCEID . '","ServiceID":"' . $enc_ServiceID . '","OTHER1":"' . $sha512other1 . '","rajkoshHeadInfo":[{"SNO":"' . $enc_SNO . '","HEAD":"' . $enc_HEAD . '","AMOUNT":"' . $enc_AMOUNT . '","OTHER2":"' . $sha512other2 . '"}]}',
      CURLOPT_HTTPHEADER => array(
        'Content-Type: application/json',
        'Cache-Control: no-cache',
        'secret: x$p#9cbJu',
        'key: Khel',
        'Content-Type: application/json'
      ),
    ));

    $response = curl_exec($curl);

    curl_close($curl);

    if ($response) {
      $paymenturl = json_decode($response)[0]->Output2;

      $paymentchallan = explode('|', json_decode($response)[0]->Output1)[0];

      $DEPCODE = 'EDU';
      $enc_DEPCODE = base64_encode('EDU');
      $PMODE = 'NETPAY';
      $enc_PMODE = base64_encode('NETPAY');
      $PTYPE = "";
      $CHQDDNO = '';
      $CHQDT = "";
      $ASMTYEAR = (config('app.session_year') - 1) . '-' . config('app.session_year');
      $enc_ASMTYEAR = base64_encode((config('app.session_year') - 1) . '-' . config('app.session_year'));
      $TAXPERIOD = "A";
      $enc_TAXPERIOD = base64_encode("A");
      $PERIOD = "";
      $BANK = "0001";
      $enc_BANK = base64_encode("0001");
      $UIDNO = "";
      $NAME = $userDetail->name;
      $enc_NAME = base64_encode($userDetail->name);
      $enc_DepositorADDRESS = "";
      $DepositorADDRESS = "";
      $DIVCODE = $division_id->DIVCODE;
      $enc_DIVCODE = base64_encode($division_id->DIVCODE);
      $TCODE = $division_id->TCODE;
      $enc_TCODE = base64_encode($TCODE);
      $LOCATION = $userDetail->applicationCommunicationDetails->pdistrict->city;
      $enc_LOCATION = base64_encode($userDetail->applicationCommunicationDetails->pdistrict->city);
      $REMARK = "";
      $TOTAL = '10';
      $enc_TOTAL = base64_encode('10');
      $REFERENCEID = "S05";
      $enc_REFERENCEID = base64_encode("S05");
      $ServiceID = "05";
      $enc_ServiceID = base64_encode("05");
      $SNO = "40";
      $enc_SNO = base64_encode("40");
      $HEAD = "020203101010000";
      $enc_HEAD = base64_encode("020203101010000");
      $AMOUNT = '10';
      $enc_AMOUNT = base64_encode('10');

      $OTHER1 = $DEPCODE . $PMODE . $ASMTYEAR . $TAXPERIOD . $TCODE . $TOTAL;
      $md5OTHER1 = strtoupper(md5($OTHER1));
      $sha512other1 = strtoupper(hash("sha512", $md5OTHER1));

      $OTHER2 = $DEPCODE . $SNO . $HEAD . $AMOUNT;
      $md5OTHER2 = strtoupper(md5($OTHER2));
      $sha512other2 = strtoupper(hash("sha512", $md5OTHER2));

      $Depchallan = $DEPCODE . $paymentchallan;

      $data = [
        'application_no' => $userDetail->application_no,
        'application_id' => $userDetail->id,
        'Depchallan' => $Depchallan,
        'challanNumber' => $paymentchallan,
        'DEPCODE' => $DEPCODE,
        'PMODE' => $PMODE,
        'PTYPE' => $PTYPE,
        'CHQDDNO' => $CHQDDNO,
        'CHQDT' => $CHQDT,
        'ASMTYEAR' => $ASMTYEAR,
        'TAXPERIOD' => $TAXPERIOD,
        'PERIOD' => $PERIOD,
        'BANK' => $BANK,
        'UIDNO' => $UIDNO,
        'NAME' => $NAME,
        'DepositorADDRESS' => $DepositorADDRESS,
        'DIVCODE' => $DIVCODE,
        'TCODE' => $TCODE,
        'LOCATION' => $LOCATION,
        'TOTAL' => $TOTAL,
        'REFERENCEID' => $REFERENCEID,
        'ServiceID' => $ServiceID,
        'SNO' => $SNO,
        'HEAD' => $HEAD,
        'AMOUNT' => $AMOUNT,
        'OTHER1' => $OTHER1,
        'OTHER2' => $OTHER2,
        'module' => 1,

      ];

      $id = DB::table('rajkosh_payment_request')->insertGetId($data);

      return redirect($paymenturl);
    }


    return redirect()->back()->with('error', 'Internal Server Error.');
  }

  public function payment_request(Request $request)
  {
    $userDetail = Auth::guard('hostel')->user();
    $division_id = rajkosh_division_treasury($userDetail->applicationCommunicationDetails->pdistrict->id);
    $TOTAL = 10;

    $DEPCODE = 'EDU';
    $PMODE = 'NETPAY';
    $PTYPE = '';
    $CHQDDNO = '';
    $CHQDT = '';
    $ASMTYEAR = (config('app.session_year') - 1) . '-' . config('app.session_year');
    $TAXPERIOD = 'A';
    $PERIOD = '';
    $BANK = '0001';
    $UIDNO = '';
    $NAME = $userDetail->name;
    $DepositorADDRESS = '';
    $DIVCODE = $division_id->DIVCODE;
    $TCODE = $division_id->TCODE;
    $LOCATION = $userDetail->applicationCommunicationDetails->pdistrict->city;
    $REMARK = '';
    $REFERENCEID = 'S05';
    $ServiceID = '05';
    $SNO = '40';
    $HEAD = '020203101010000';
    $AMOUNT = $TOTAL;

    $OTHER1 = $DEPCODE . $PMODE . $ASMTYEAR . $TAXPERIOD . $TCODE . $TOTAL;
    $sha512other1 = strtoupper(hash('sha512', strtoupper(md5($OTHER1))));

    $OTHER2 = $DEPCODE . $SNO . $HEAD . $AMOUNT;
    $sha512other2 = strtoupper(hash('sha512', strtoupper(md5($OTHER2))));

    $postFields = json_encode([
      'DEPCODE' => base64_encode($DEPCODE),
      'PMODE' => base64_encode($PMODE),
      'PTYPE' => '',
      'CHQDDNO' => '',
      'CHQDT' => '',
      'ASMTYEAR' => base64_encode($ASMTYEAR),
      'TAXPERIOD' => base64_encode($TAXPERIOD),
      'PERIOD' => '',
      'BANK' => base64_encode($BANK),
      'UIDNO' => '',
      'NAME' => base64_encode($NAME),
      'DepositorADDRESS' => '',
      'DIVCODE' => base64_encode($DIVCODE),
      'TCODE' => base64_encode($TCODE),
      'LOCATION' => base64_encode($LOCATION),
      'REMARK' => '',
      'TOTAL' => base64_encode((string)$TOTAL),
      'REFERENCEID' => base64_encode($REFERENCEID),
      'ServiceID' => base64_encode($ServiceID),
      'OTHER1' => $sha512other1,
      'rajkoshHeadInfo' => [[
          'SNO' => base64_encode($SNO),
          'HEAD' => base64_encode($HEAD),
          'AMOUNT' => base64_encode((string)$AMOUNT),
          'OTHER2' => $sha512other2,
        ]],
    ]);

    // rajkosh.up.nic.in uses legacy TLS - enable UnsafeLegacyRenegotiation
    $prevOpenSslConf = getenv('OPENSSL_CONF');
    putenv('OPENSSL_CONF=' . base_path('openssl_legacy.cnf'));

    $curl = curl_init();
    curl_setopt_array($curl, [
      CURLOPT_URL => 'https://rajkosh.up.nic.in/rkapi/rajkoshapi/Rajkosh',
      CURLOPT_RETURNTRANSFER => true,
      CURLOPT_ENCODING => '',
      CURLOPT_MAXREDIRS => 10,
      CURLOPT_TIMEOUT => 30,
      CURLOPT_FOLLOWLOCATION => true,
      CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
      CURLOPT_SSL_VERIFYPEER => false,
      CURLOPT_SSL_VERIFYHOST => false,
      CURLOPT_SSL_OPTIONS => CURLSSLOPT_ALLOW_BEAST,
      CURLOPT_CUSTOMREQUEST => 'POST',
      CURLOPT_POSTFIELDS => $postFields,
      CURLOPT_HTTPHEADER => [
        'Content-Type: application/json',
        'Cache-Control: no-cache',
        'secret: x$p#9cbJu',
        'key: Khel',
      ],
    ]);
    $response = curl_exec($curl);
    curl_close($curl);
    putenv('OPENSSL_CONF=' . ($prevOpenSslConf ?: ''));

    if ($response) {
      $decoded = json_decode($response);
      if (is_string($decoded)) {
           return redirect()->back()->with('error', 'Payment gateway returned an invalid response: ' . $decoded);
      }
      $paymenturl = $decoded[0]->Output2;
      $paymentchallan = explode('|', $decoded[0]->Output1)[0];
      $Depchallan = $DEPCODE . $paymentchallan;

      DB::table('rajkosh_payment_request')->insertGetId([
        'application_no' => $userDetail->application_no,
        'application_id' => $userDetail->id,
        'Depchallan' => $Depchallan,
        'challanNumber' => $paymentchallan,
        'DEPCODE' => $DEPCODE, 'PMODE' => $PMODE, 'PTYPE' => $PTYPE,
        'CHQDDNO' => $CHQDDNO, 'CHQDT' => $CHQDT, 'ASMTYEAR' => $ASMTYEAR,
        'TAXPERIOD' => $TAXPERIOD, 'PERIOD' => $PERIOD, 'BANK' => $BANK,
        'UIDNO' => $UIDNO, 'NAME' => $NAME, 'DepositorADDRESS' => $DepositorADDRESS,
        'DIVCODE' => $DIVCODE, 'TCODE' => $TCODE, 'LOCATION' => $LOCATION,
        'TOTAL' => $TOTAL, 'REFERENCEID' => $REFERENCEID, 'ServiceID' => $ServiceID,
        'SNO' => $SNO, 'HEAD' => $HEAD, 'AMOUNT' => $AMOUNT,
        'OTHER1' => $OTHER1, 'OTHER2' => $OTHER2,
        'type' => 0, 'module' => 1,
      ]);

      return redirect($paymenturl);
    }

    return redirect()->back()->with('error', 'Payment gateway connection failed. Please try again.');
  }



  public function payment_request_for_allotment(Request $request)
  {
    $userDetail = Auth::guard('hostel')->user();
    $division_id = rajkosh_division_treasury($userDetail->applicationCommunicationDetails->pdistrict->id);
    $TOTAL = 2500;

    $DEPCODE = 'EDU';
    $PMODE = 'NETPAY';
    $PTYPE = '';
    $CHQDDNO = '';
    $CHQDT = '';
    $ASMTYEAR = (config('app.session_year') - 1) . '-' . config('app.session_year');
    $TAXPERIOD = 'A';
    $PERIOD = '';
    $BANK = '0001';
    $UIDNO = '';
    $NAME = $userDetail->name;
    $DepositorADDRESS = '';
    $DIVCODE = $division_id->DIVCODE;
    $TCODE = $division_id->TCODE;
    $LOCATION = $userDetail->applicationCommunicationDetails->pdistrict->city;
    $REMARK = '';
    $REFERENCEID = 'S05';
    $ServiceID = '05';
    $SNO = '40';
    $HEAD = '020203101010000';
    $AMOUNT = $TOTAL;

    $OTHER1 = $DEPCODE . $PMODE . $ASMTYEAR . $TAXPERIOD . $TCODE . $TOTAL;
    $sha512other1 = strtoupper(hash('sha512', strtoupper(md5($OTHER1))));

    $OTHER2 = $DEPCODE . $SNO . $HEAD . $AMOUNT;
    $sha512other2 = strtoupper(hash('sha512', strtoupper(md5($OTHER2))));

    $postFields = json_encode([
      'DEPCODE' => base64_encode($DEPCODE),
      'PMODE' => base64_encode($PMODE),
      'PTYPE' => '',
      'CHQDDNO' => '',
      'CHQDT' => '',
      'ASMTYEAR' => base64_encode($ASMTYEAR),
      'TAXPERIOD' => base64_encode($TAXPERIOD),
      'PERIOD' => '',
      'BANK' => base64_encode($BANK),
      'UIDNO' => '',
      'NAME' => base64_encode($NAME),
      'DepositorADDRESS' => '',
      'DIVCODE' => base64_encode($DIVCODE),
      'TCODE' => base64_encode($TCODE),
      'LOCATION' => base64_encode($LOCATION),
      'REMARK' => '',
      'TOTAL' => base64_encode((string)$TOTAL),
      'REFERENCEID' => base64_encode($REFERENCEID),
      'ServiceID' => base64_encode($ServiceID),
      'OTHER1' => $sha512other1,
      'rajkoshHeadInfo' => [[
          'SNO' => base64_encode($SNO),
          'HEAD' => base64_encode($HEAD),
          'AMOUNT' => base64_encode((string)$AMOUNT),
          'OTHER2' => $sha512other2,
        ]],
    ]);

    // rajkosh.up.nic.in uses legacy TLS - enable UnsafeLegacyRenegotiation
    $prevOpenSslConf2 = getenv('OPENSSL_CONF');
    putenv('OPENSSL_CONF=' . base_path('openssl_legacy.cnf'));

    $curl = curl_init();
    curl_setopt_array($curl, [
      CURLOPT_URL => 'https://rajkosh.up.nic.in/rkapi/rajkoshapi/Rajkosh',
      CURLOPT_RETURNTRANSFER => true,
      CURLOPT_ENCODING => '',
      CURLOPT_MAXREDIRS => 10,
      CURLOPT_TIMEOUT => 30,
      CURLOPT_FOLLOWLOCATION => true,
      CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
      CURLOPT_SSL_VERIFYPEER => false,
      CURLOPT_SSL_VERIFYHOST => false,
      CURLOPT_SSL_OPTIONS => CURLSSLOPT_ALLOW_BEAST,
      CURLOPT_CUSTOMREQUEST => 'POST',
      CURLOPT_POSTFIELDS => $postFields,
      CURLOPT_HTTPHEADER => [
        'Content-Type: application/json',
        'Cache-Control: no-cache',
        'secret: x$p#9cbJu',
        'key: Khel',
      ],
    ]);
    $response = curl_exec($curl);
    curl_close($curl);
    putenv('OPENSSL_CONF=' . ($prevOpenSslConf2 ?: ''));

    if ($response) {
      $decoded = json_decode($response);
      $paymenturl = $decoded[0]->Output2;
      $paymentchallan = explode('|', $decoded[0]->Output1)[0];
      $Depchallan = $DEPCODE . $paymentchallan;

      DB::table('rajkosh_payment_request')->insertGetId([
        'application_no' => $userDetail->application_no,
        'application_id' => $userDetail->id,
        'Depchallan' => $Depchallan,
        'challanNumber' => $paymentchallan,
        'DEPCODE' => $DEPCODE, 'PMODE' => $PMODE, 'PTYPE' => $PTYPE,
        'CHQDDNO' => $CHQDDNO, 'CHQDT' => $CHQDT, 'ASMTYEAR' => $ASMTYEAR,
        'TAXPERIOD' => $TAXPERIOD, 'PERIOD' => $PERIOD, 'BANK' => $BANK,
        'UIDNO' => $UIDNO, 'NAME' => $NAME, 'DepositorADDRESS' => $DepositorADDRESS,
        'DIVCODE' => $DIVCODE, 'TCODE' => $TCODE, 'LOCATION' => $LOCATION,
        'TOTAL' => $TOTAL, 'REFERENCEID' => $REFERENCEID, 'ServiceID' => $ServiceID,
        'SNO' => $SNO, 'HEAD' => $HEAD, 'AMOUNT' => $AMOUNT,
        'OTHER1' => $OTHER1, 'OTHER2' => $OTHER2,
        'type' => 0, 'module' => 3,
      ]);

      return redirect($paymenturl);
    }

    return redirect()->back()->with('error', 'Payment gateway connection failed. Please try again.');
  }














  public function payment_response(Request $request)
  {

    $userDetail = DB::table('rajkosh_payment_request')->where('Depchallan', base64_decode($request->challan_no))->first();


    $data = [

      'challan_no' => base64_decode($request->challan_no),
      'Bank_Id' => base64_decode($request->Bank_Id),
      'ref_no' => base64_decode($request->ref_no),
      'amount' => base64_decode($request->amount),
      'Status' => base64_decode($request->Status),
      'status_desc' => base64_decode($request->status_desc),
      'Other' => base64_decode($request->Other),
    ];

    $id = DB::table('rajkosh_payment_response')->insertGetId($data);



    if ($userDetail->module == 2) {
      if (base64_decode($request->Status) == 'Success') {

        $application = DB::table('facility_booking_type_detail')->where('id', $userDetail->application_id)->first();

        $users = FacilityRegister::where('id', $application->user_id)->first();

        Auth::guard('facility_booking')->login($users);

        DB::table('facility_booking_type_detail')->where('id', $userDetail->application_id)->update([
          'payment_status' => 1,
          'payment_date' => date('Y-m-d'),
        ]);



        return redirect()->route('facility_booking_dashboard')->with('success', 'Payment Successful.');
      }

      return redirect()->route('facility_booking_dashboard')->with('error', 'Payment Fail.');
    }
    elseif ($userDetail->module == 1) {

      $student = HostelRegister::where('application_no', $userDetail->application_no)->first();
      Auth::guard('hostel')->login($student);
      if (base64_decode($request->Status) == 'Success') {




        $hostelUser = HostelRegister::find($userDetail->application_id);

        $hostelUser->update([

          'level' => 4,
          'payment_status' => 2,
          'payment_date' => date('Y-m-d'),
        ]);



        return redirect()->route('hostel.dashboard')->with('success', 'Payment Successful.');
      }

      return redirect()->route('hostel.dashboard')->with('error', 'Payment Fail.');
    }








    elseif ($userDetail->module == 3) {

      $student = HostelRegister::where('application_no', $userDetail->application_no)->first();
      Auth::guard('hostel')->login($student);
      if (base64_decode($request->Status) == 'Success') {

        $hostelUser = HostelRegister::find($userDetail->application_id);

        $hostelUser->update([
          'payment_allotment_fee_status' => 1,
          'payment_allotment_fee_date' => date('Y-m-d'),
        ]);



        return redirect()->route('hostel.dashboard')->with('success', 'Payment Successful.');
      }

      return redirect()->route('hostel.dashboard')->with('error', 'Payment Fail.');
    }









    elseif ($userDetail->module == 4) {



      if (base64_decode($request->Status) == 'Success') {

        $application = DB::table('coaching_camp_basic_details')->where('id', $userDetail->application_id)->first();

        $users = CoachingCamp::where('id', $application->user_id)->first();

        Auth::guard('CoachingCamp')->login($users);

        DB::table('coaching_camp_basic_details')->where('id', $userDetail->application_id)->update([
          'payment_status' => 1,
          'payment_date' => date('Y-m-d'),
        ]);



        return redirect()->route('coaching_camp_dashboard')->with('success', 'Payment Successful.');
      }

      return redirect()->route('coaching_camp_dashboard')->with('error', 'Payment Fail.');
    }
    elseif ($userDetail->module == 5) {



      if (base64_decode($request->Status) == 'Success') {

        $application = DB::table('coaching_camp_basic_details')->where('id', $userDetail->application_id)->first();

        $users = CoachingCamp::where('id', $application->user_id)->first();

        Auth::guard('CoachingCamp')->login($users);

        DB::table('coaching_camp_basic_details')->where('id', $userDetail->application_id)->update([
          'payment_status_coaching_fee' => 1,
          'payment_date_coaching_fee' => date('Y-m-d'),
        ]);



        return redirect()->route('coaching_camp_dashboard')->with('success', 'Payment Successful.');
      }

      return redirect()->route('coaching_camp_dashboard')->with('error', 'Payment Fail.');
    }
  }






  public function update_payment_status($application)
  {


    $rajkoskdata = DB::table('rajkosh_payment_request')->where('application_no', $application)->where('module', 1)->get();
    if (count($rajkoskdata) > 0) {
      foreach ($rajkoskdata as $item) {


        $curl = curl_init();

        curl_setopt_array($curl, array(
          CURLOPT_URL => 'https://nicupws.up.nic.in/rajkoshdoubleverification.asmx/DoubleVerifyParticular?TransNo=' . $item->Depchallan . '&Amount=2500',
          CURLOPT_RETURNTRANSFER => true,
          CURLOPT_ENCODING => '',
          CURLOPT_MAXREDIRS => 10,
          CURLOPT_TIMEOUT => 0,
          CURLOPT_FOLLOWLOCATION => true,
          CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
          CURLOPT_CUSTOMREQUEST => 'GET',
          CURLOPT_HTTPHEADER => array(
            'Accept: application/json'
          ),
        ));

        $response = curl_exec($curl);

        curl_close($curl);
        $data_response = explode("|", simplexml_load_string($response));


        if (explode("=", $data_response[1])[1] == 'Success') {


          $data = [

            'challan_no' => explode("=", $data_response[0])[1],
            'Bank_Id' => '',
            'ref_no' => explode("=", $data_response[3])[1],
            'amount' => explode("=", $data_response[4])[1],
            'Status' => explode("=", $data_response[1])[1],
            'status_desc' => explode("=", $data_response[2])[1],
            'Other' => '',
          ];

          $id = DB::table('rajkosh_payment_response')->insertGetId($data);

          $student = HostelRegister::where('application_no', $application)->first();
          Auth::guard('hostel')->login($student);

          $hostelUser = HostelRegister::find($student->id);

          $hostelUser->update([

            'level' => 4,
            'payment_status' => 2,
          ]);



          return redirect()->back()->with('success', 'Payment Status updated Successful.');
        }
      }
    }

    return redirect()->back();
  }


  public function update_payment_status_allotment($application)
  {


    $rajkoskdata = DB::table('rajkosh_payment_request')->where('application_no', $application)->where('module', 1)->get();
    if (count($rajkoskdata) > 0) {
      foreach ($rajkoskdata as $item) {


        $curl = curl_init();

        curl_setopt_array($curl, array(
          CURLOPT_URL => 'https://nicupws.up.nic.in/rajkoshdoubleverification.asmx/DoubleVerifyParticular?TransNo=' . $item->Depchallan . '&Amount=2500',
          CURLOPT_RETURNTRANSFER => true,
          CURLOPT_ENCODING => '',
          CURLOPT_MAXREDIRS => 10,
          CURLOPT_TIMEOUT => 0,
          CURLOPT_FOLLOWLOCATION => true,
          CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
          CURLOPT_CUSTOMREQUEST => 'GET',
          CURLOPT_HTTPHEADER => array(
            'Accept: application/json'
          ),
        ));

        $response = curl_exec($curl);

        curl_close($curl);
        $data_response = explode("|", simplexml_load_string($response));
        ;


        if (explode("=", $data_response[1])[1] == 'Success') {


          $data = [

            'challan_no' => explode("=", $data_response[0])[1],
            'Bank_Id' => '',
            'ref_no' => explode("=", $data_response[3])[1],
            'amount' => explode("=", $data_response[4])[1],
            'Status' => explode("=", $data_response[1])[1],
            'status_desc' => explode("=", $data_response[2])[1],
            'Other' => '',
          ];

          $id = DB::table('rajkosh_payment_response')->insertGetId($data);

          $student = HostelRegister::where('application_no', $application)->first();
          Auth::guard('hostel')->login($student);

          $hostelUser = HostelRegister::find($student->id);

          $hostelUser->update([

            'payment_allotment_fee_status' => 1,
            'payment_allotment_fee_date' => date('Y-m-d'),
          ]);



          return redirect()->back()->with('success', 'Payment Status updated Successful.');
        }
      }
    }

    return redirect()->back();
  }







  public function update_payment_status_facility_booking($application)
  {


    $rajkoskdata = DB::table('rajkosh_payment_request')->where('application_no', $application)->where('module', 2)->get();

    if (count($rajkoskdata) > 0) {
      foreach ($rajkoskdata as $item) {


        $curl = curl_init();

        curl_setopt_array($curl, array(
          CURLOPT_URL => 'https://nicupws.up.nic.in/rajkoshdoubleverification.asmx/DoubleVerifyParticular?TransNo=' . $item->Depchallan . '&Amount=' . $item->AMOUNT,
          CURLOPT_RETURNTRANSFER => true,
          CURLOPT_ENCODING => '',
          CURLOPT_MAXREDIRS => 10,
          CURLOPT_TIMEOUT => 0,
          CURLOPT_FOLLOWLOCATION => true,
          CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
          CURLOPT_CUSTOMREQUEST => 'GET',
          CURLOPT_HTTPHEADER => array(
            'Accept: application/json'
          ),
        ));

        $response = curl_exec($curl);

        curl_close($curl);
        $data_response = explode("|", simplexml_load_string($response));
        ;


        if (explode("=", $data_response[1])[1] == 'Success') {


          $data = [

            'challan_no' => explode("=", $data_response[0])[1],
            'Bank_Id' => '',
            'ref_no' => explode("=", $data_response[3])[1],
            'amount' => explode("=", $data_response[4])[1],
            'Status' => explode("=", $data_response[1])[1],
            'status_desc' => explode("=", $data_response[2])[1],
            'Other' => '',
          ];

          $id = DB::table('rajkosh_payment_response')->insertGetId($data);





          DB::table('facility_booking_type_detail')->where('application_no', $application)->update([
            'payment_status' => 1,
            'payment_date' => date('Y-m-d'),
          ]);

          return redirect()->route('facility_booking_dashboard')->with('success', 'Payment Status updated Successful.');
        }
      }
    }

    return redirect()->back();
  }
  public function facility_booking_payment_request(Request $request, $id)
  {


    $application = DB::table('facility_booking_type_detail')->where('id', $id)->first();
    $TOTAL = $application->amount_to_be_paid;
    $userDetail = DB::table('facility_booking_register')->where('id', $application->user_id)->first();
    $division_id = rajkosh_division_treasury($application->city);

    $DEPCODE = 'EDU';
    $enc_DEPCODE = base64_encode('EDU');
    $PMODE = 'NETPAY';
    $enc_PMODE = base64_encode('NETPAY');
    $PTYPE = "";
    $CHQDDNO = '';
    $CHQDT = "";
    $ASMTYEAR = (config('app.session_year') - 1) . '-' . config('app.session_year');
    $enc_ASMTYEAR = base64_encode((config('app.session_year') - 1) . '-' . config('app.session_year'));
    $TAXPERIOD = "A";
    $enc_TAXPERIOD = base64_encode("A");
    $PERIOD = "";
    $enc_BANK = base64_encode("0001");
    $UIDNO = "";
    $enc_NAME = base64_encode($userDetail->name);
    $enc_DepositorADDRESS = "";
    $enc_DIVCODE = base64_encode($division_id->DIVCODE);
    $TCODE = $division_id->TCODE;
    $enc_TCODE = base64_encode($TCODE);
    $enc_LOCATION = base64_encode($application->city);
    $REMARK = "";
    // $TOTAL = $application->amount_to_be_paid;
    $enc_TOTAL = base64_encode($TOTAL);
    $enc_REFERENCEID = base64_encode("S05");
    $enc_ServiceID = base64_encode("05");
    $SNO = "40";
    $enc_SNO = base64_encode("40");
    $HEAD = "020203101010000";
    $enc_HEAD = base64_encode("020203101010000");
    $AMOUNT = $TOTAL;
    $enc_AMOUNT = base64_encode($AMOUNT);

    $OTHER1 = $DEPCODE . $PMODE . $ASMTYEAR . $TAXPERIOD . $TCODE . $TOTAL;
    $md5OTHER1 = strtoupper(md5($OTHER1));
    $sha512other1 = strtoupper(hash("sha512", $md5OTHER1));

    $OTHER2 = $DEPCODE . $SNO . $HEAD . $AMOUNT;
    $md5OTHER2 = strtoupper(md5($OTHER2));
    $sha512other2 = strtoupper(hash("sha512", $md5OTHER2));


    $data_response = '{"DEPCODE":"' . $enc_DEPCODE . '","PMODE":"' . $enc_PMODE . '","PTYPE":"","CHQDDNO":"","CHQDT":"","ASMTYEAR":"' . $enc_ASMTYEAR . '","TAXPERIOD":"' . $enc_TAXPERIOD . '","PERIOD":"","BANK":"' . $enc_BANK . '","UIDNO":"","NAME":"' . $enc_NAME . '","DepositorADDRESS":"' . $enc_DepositorADDRESS . '","DIVCODE":"' . $enc_DIVCODE . '","TCODE":"' . $enc_TCODE . '","LOCATION":"' . $enc_LOCATION . '","REMARK":"","TOTAL":"' . $enc_TOTAL . '","REFERENCEID":"' . $enc_REFERENCEID . '","ServiceID":"' . $enc_ServiceID . '","OTHER1":"' . $sha512other1 . '","rajkoshHeadInfo":[{"SNO":"' . $enc_SNO . '","HEAD":"' . $enc_HEAD . '","AMOUNT":"' . $enc_AMOUNT . '","OTHER2":"' . $sha512other2 . '"}]}';



    $DEPCODE = 'EDU';
    $enc_DEPCODE = base64_encode('EDU');
    $PMODE = 'NETPAY';
    $enc_PMODE = base64_encode('NETPAY');
    $PTYPE = "";
    $CHQDDNO = '';
    $CHQDT = "";
    $ASMTYEAR = (config('app.session_year') - 1) . '-' . config('app.session_year');
    $enc_ASMTYEAR = base64_encode((config('app.session_year') - 1) . '-' . config('app.session_year'));
    $TAXPERIOD = "A";
    $enc_TAXPERIOD = base64_encode("A");
    $PERIOD = "";
    $BANK = "0001";
    $enc_BANK = base64_encode("0001");
    $UIDNO = "";
    $NAME = $userDetail->name;
    $enc_NAME = base64_encode($userDetail->name);
    $enc_DepositorADDRESS = "";
    $DepositorADDRESS = "";
    $DIVCODE = $division_id->DIVCODE;
    $enc_DIVCODE = base64_encode($division_id->DIVCODE);
    $TCODE = $division_id->TCODE;
    $enc_TCODE = base64_encode($TCODE);
    $LOCATION = $application->city;
    $enc_LOCATION = base64_encode($application->city);
    $REMARK = "";
    $TOTAL = $application->amount_to_be_paid;
    $enc_TOTAL = base64_encode($application->amount_to_be_paid);
    $REFERENCEID = "S05";
    $enc_REFERENCEID = base64_encode("S05");
    $ServiceID = "05";
    $enc_ServiceID = base64_encode("05");
    $SNO = "40";
    $enc_SNO = base64_encode("40");
    $HEAD = "020203101010000";
    $enc_HEAD = base64_encode("020203101010000");
    $AMOUNT = $application->amount_to_be_paid;
    $enc_AMOUNT = base64_encode($application->amount_to_be_paid);

    $OTHER1 = $DEPCODE . $PMODE . $ASMTYEAR . $TAXPERIOD . $TCODE . $TOTAL;
    $md5OTHER1 = strtoupper(md5($OTHER1));
    $sha512other1 = strtoupper(hash("sha512", $md5OTHER1));

    $OTHER2 = $DEPCODE . $SNO . $HEAD . $AMOUNT;
    $md5OTHER2 = strtoupper(md5($OTHER2));
    $sha512other2 = strtoupper(hash("sha512", $md5OTHER2));

    $data_set = [
      'application_no' => $application->application_no,
      'application_id' => $application->id,


      'DEPCODE' => $DEPCODE,
      'PMODE' => $PMODE,
      'PTYPE' => $PTYPE,
      'CHQDDNO' => $CHQDDNO,
      'CHQDT' => $CHQDT,
      'ASMTYEAR' => $ASMTYEAR,
      'TAXPERIOD' => $TAXPERIOD,
      'PERIOD' => $PERIOD,
      'BANK' => $BANK,
      'UIDNO' => $UIDNO,
      'NAME' => $NAME,
      'DepositorADDRESS' => $DepositorADDRESS,
      'DIVCODE' => $DIVCODE,
      'TCODE' => $TCODE,
      'LOCATION' => $LOCATION,
      'TOTAL' => $TOTAL,
      'REFERENCEID' => $REFERENCEID,
      'ServiceID' => $ServiceID,
      'SNO' => $SNO,
      'HEAD' => $HEAD,
      'AMOUNT' => $AMOUNT,
      'OTHER1' => $OTHER1,
      'OTHER2' => $OTHER2,
      'type' => $application->service,
      'module' => 2,



    ];


    $data = [
      'data_response' => $data_response,
      'data_set' => $data_set,


    ];




    return redirect('https://www.startinup.up.gov.in/demo/PaymentController/payment_gateway/' . base64_encode(json_encode($data)));
  }



  public function facility_booking_payment_request_bkp_23_12_2024(Request $request, $id)
  {




    $application = DB::table('facility_booking_type_detail')->where('id', $id)->first();
    $userDetail = DB::table('facility_booking_register')->where('id', $application->user_id)->first();
    $division_id = rajkosh_division_treasury($application->city);

    $DEPCODE = 'EDU';
    $enc_DEPCODE = base64_encode('EDU');
    $PMODE = 'NETPAY';
    $enc_PMODE = base64_encode('NETPAY');
    $PTYPE = "";
    $CHQDDNO = '';
    $CHQDT = "";
    $ASMTYEAR = (config('app.session_year') - 1) . '-' . config('app.session_year');
    $enc_ASMTYEAR = base64_encode((config('app.session_year') - 1) . '-' . config('app.session_year'));
    $TAXPERIOD = "A";
    $enc_TAXPERIOD = base64_encode("A");
    $PERIOD = "";
    $enc_BANK = base64_encode("0001");
    $UIDNO = "";
    $enc_NAME = base64_encode($userDetail->name);
    $enc_DepositorADDRESS = "";
    $enc_DIVCODE = base64_encode($division_id->DIVCODE);
    $TCODE = $division_id->TCODE;
    $enc_TCODE = base64_encode($TCODE);
    $enc_LOCATION = base64_encode($application->city);
    $REMARK = "";
    $TOTAL = $application->amount_to_be_paid;
    $enc_TOTAL = base64_encode($application->amount_to_be_paid);
    $enc_REFERENCEID = base64_encode("S05");
    $enc_ServiceID = base64_encode("05");
    $SNO = "40";
    $enc_SNO = base64_encode("40");
    $HEAD = "020203101010000";
    $enc_HEAD = base64_encode("020203101010000");
    $AMOUNT = $application->amount_to_be_paid;
    $enc_AMOUNT = base64_encode($application->amount_to_be_paid);

    $OTHER1 = $DEPCODE . $PMODE . $ASMTYEAR . $TAXPERIOD . $TCODE . $TOTAL;
    $md5OTHER1 = strtoupper(md5($OTHER1));
    $sha512other1 = strtoupper(hash("sha512", $md5OTHER1));

    $OTHER2 = $DEPCODE . $SNO . $HEAD . $AMOUNT;
    $md5OTHER2 = strtoupper(md5($OTHER2));
    $sha512other2 = strtoupper(hash("sha512", $md5OTHER2));


    $curl = curl_init();
    //curl_setopt($curl, CURLOPT_SSLVERSION, CURL_SSLVERSION_TLSv1_2);
    curl_setopt($curl, CURLOPT_SSL_OPTIONS, CURLSSLOPT_ALLOW_BEAST);
    curl_setopt($curl, CURLOPT_SSLVERSION, CURL_SSLVERSION_TLSv1_2);
    //curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
    //curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
    curl_setopt_array($curl, array(
      CURLOPT_URL => 'https://rajkosh.up.nic.in/rkapi/rajkoshapi/Rajkosh',
      CURLOPT_RETURNTRANSFER => true,
      CURLOPT_ENCODING => '',
      CURLOPT_MAXREDIRS => 10,
      CURLOPT_TIMEOUT => 0,
      CURLOPT_FOLLOWLOCATION => true,
      CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,

      CURLOPT_CUSTOMREQUEST => 'POST',
      CURLOPT_POSTFIELDS => '{"DEPCODE":"' . $enc_DEPCODE . '","PMODE":"' . $enc_PMODE . '","PTYPE":"","CHQDDNO":"","CHQDT":"","ASMTYEAR":"' . $enc_ASMTYEAR . '","TAXPERIOD":"' . $enc_TAXPERIOD . '","PERIOD":"","BANK":"' . $enc_BANK . '","UIDNO":"","NAME":"' . $enc_NAME . '","DepositorADDRESS":"' . $enc_DepositorADDRESS . '","DIVCODE":"' . $enc_DIVCODE . '","TCODE":"' . $enc_TCODE . '","LOCATION":"' . $enc_LOCATION . '","REMARK":"","TOTAL":"' . $enc_TOTAL . '","REFERENCEID":"' . $enc_REFERENCEID . '","ServiceID":"' . $enc_ServiceID . '","OTHER1":"' . $sha512other1 . '","rajkoshHeadInfo":[{"SNO":"' . $enc_SNO . '","HEAD":"' . $enc_HEAD . '","AMOUNT":"' . $enc_AMOUNT . '","OTHER2":"' . $sha512other2 . '"}]}',
      CURLOPT_HTTPHEADER => array(
        'Content-Type: application/json',
        'Cache-Control: no-cache',
        'secret: x$p#9cbJu',
        'key: Khel',
        'Content-Type: application/json'
      ),

    ));





    $response = curl_exec($curl);
    if (curl_errno($curl)) {
      echo 'cURL error: ' . curl_error($curl);
    }
    curl_close($curl);


    $response = curl_exec($curl);

    if ($response === false) {
      dd(curl_error($curl));
      throw new Exception("cURL Error: " . curl_error($curl));
    }
    curl_close($curl);

    if ($response) {
      $paymenturl = json_decode($response)[0]->Output2;

      $paymentchallan = explode('|', json_decode($response)[0]->Output1)[0];

      $DEPCODE = 'EDU';
      $enc_DEPCODE = base64_encode('EDU');
      $PMODE = 'NETPAY';
      $enc_PMODE = base64_encode('NETPAY');
      $PTYPE = "";
      $CHQDDNO = '';
      $CHQDT = "";
      $ASMTYEAR = (config('app.session_year') - 1) . '-' . config('app.session_year');
      $enc_ASMTYEAR = base64_encode((config('app.session_year') - 1) . '-' . config('app.session_year'));
      $TAXPERIOD = "A";
      $enc_TAXPERIOD = base64_encode("A");
      $PERIOD = "";
      $BANK = "0001";
      $enc_BANK = base64_encode("0001");
      $UIDNO = "";
      $NAME = $userDetail->name;
      $enc_NAME = base64_encode($userDetail->name);
      $enc_DepositorADDRESS = "";
      $DepositorADDRESS = "";
      $DIVCODE = $division_id->DIVCODE;
      $enc_DIVCODE = base64_encode($division_id->DIVCODE);
      $TCODE = $division_id->TCODE;
      $enc_TCODE = base64_encode($TCODE);
      $LOCATION = $application->city;
      $enc_LOCATION = base64_encode($application->city);
      $REMARK = "";
      $TOTAL = $application->amount_to_be_paid;
      $enc_TOTAL = base64_encode($application->amount_to_be_paid);
      $REFERENCEID = "S05";
      $enc_REFERENCEID = base64_encode("S05");
      $ServiceID = "05";
      $enc_ServiceID = base64_encode("05");
      $SNO = "40";
      $enc_SNO = base64_encode("40");
      $HEAD = "020203101010000";
      $enc_HEAD = base64_encode("020203101010000");
      $AMOUNT = $application->amount_to_be_paid;
      $enc_AMOUNT = base64_encode($application->amount_to_be_paid);

      $OTHER1 = $DEPCODE . $PMODE . $ASMTYEAR . $TAXPERIOD . $TCODE . $TOTAL;
      $md5OTHER1 = strtoupper(md5($OTHER1));
      $sha512other1 = strtoupper(hash("sha512", $md5OTHER1));

      $OTHER2 = $DEPCODE . $SNO . $HEAD . $AMOUNT;
      $md5OTHER2 = strtoupper(md5($OTHER2));
      $sha512other2 = strtoupper(hash("sha512", $md5OTHER2));
      $Depchallan = $DEPCODE . $paymentchallan;
      $data = [
        'application_no' => $application->application_no,
        'application_id' => $application->id,
        'Depchallan' => $Depchallan,
        'challanNumber' => $paymentchallan,
        'DEPCODE' => $DEPCODE,
        'PMODE' => $PMODE,
        'PTYPE' => $PTYPE,
        'CHQDDNO' => $CHQDDNO,
        'CHQDT' => $CHQDT,
        'ASMTYEAR' => $ASMTYEAR,
        'TAXPERIOD' => $TAXPERIOD,
        'PERIOD' => $PERIOD,
        'BANK' => $BANK,
        'UIDNO' => $UIDNO,
        'NAME' => $NAME,
        'DepositorADDRESS' => $DepositorADDRESS,
        'DIVCODE' => $DIVCODE,
        'TCODE' => $TCODE,
        'LOCATION' => $LOCATION,
        'TOTAL' => $TOTAL,
        'REFERENCEID' => $REFERENCEID,
        'ServiceID' => $ServiceID,
        'SNO' => $SNO,
        'HEAD' => $HEAD,
        'AMOUNT' => $AMOUNT,
        'OTHER1' => $OTHER1,
        'OTHER2' => $OTHER2,
        'type' => $application->service,
        'module' => 2,



      ];

      $id = DB::table('rajkosh_payment_request')->insertGetId($data);

      return redirect($paymenturl);
    }


    return redirect()->back()->with('error', 'Internal Server Error.');
  }




  public function coaching_camp_application_registration_fee(Request $request)
  {
    $month = date('n'); // Numeric month without leading zero (1–12)
    $year = date('Y'); // Current year in 4 digits

    if ($month >= 4) {
      // April to December: Assessment year is current year – next year
      $DynamicASMTYEAR = $year . '-' . ($year + 1);
    }
    else {
      // January to March: Assessment year is previous year – current year
      $DynamicASMTYEAR = ($year - 1) . '-' . $year;
    }




    $userDetail = Auth::guard('CoachingCamp')->user();
    $permanent_district_id = DB::table('coaching_camp_basic_details')->where('user_id', Auth::guard('CoachingCamp')->user()->id)->first()->permanent_district;
    $basic = DB::table('coaching_camp_basic_details')->where('user_id', Auth::guard('CoachingCamp')->user()->id)->first();
    $division_id = rajkosh_division_treasury($permanent_district_id);


    $sportIds = explode(',', optional($basic)->sport ?? '');


    $TOTAL = count($sportIds) * 10;


    $DEPCODE = 'EDU';
    $enc_DEPCODE = base64_encode('EDU');
    $PMODE = 'NETPAY';
    $enc_PMODE = base64_encode('NETPAY');
    $PTYPE = "";
    $CHQDDNO = '';
    $CHQDT = "";
    $ASMTYEAR = $DynamicASMTYEAR;
    $enc_ASMTYEAR = base64_encode($DynamicASMTYEAR);
    $TAXPERIOD = "A";
    $enc_TAXPERIOD = base64_encode("A");
    $PERIOD = "";
    $enc_BANK = base64_encode("0001");
    $UIDNO = "";
    $enc_NAME = base64_encode($userDetail->name);
    $enc_DepositorADDRESS = "";
    $enc_DIVCODE = base64_encode($division_id->DIVCODE);
    $TCODE = $division_id->TCODE;
    $enc_TCODE = base64_encode($TCODE);
    $enc_LOCATION = base64_encode(districtName($permanent_district_id));
    $REMARK = "";
    // $TOTAL = $application->amount_to_be_paid;
    $enc_TOTAL = base64_encode($TOTAL);
    $enc_REFERENCEID = base64_encode("S05");
    $enc_ServiceID = base64_encode("05");
    $SNO = "40";
    $enc_SNO = base64_encode("40");
    $HEAD = "020203101010000";
    $enc_HEAD = base64_encode("020203101010000");
    $AMOUNT = $TOTAL;
    $enc_AMOUNT = base64_encode($AMOUNT);

    $OTHER1 = $DEPCODE . $PMODE . $ASMTYEAR . $TAXPERIOD . $TCODE . $TOTAL;
    $md5OTHER1 = strtoupper(md5($OTHER1));
    $sha512other1 = strtoupper(hash("sha512", $md5OTHER1));

    $OTHER2 = $DEPCODE . $SNO . $HEAD . $AMOUNT;
    $md5OTHER2 = strtoupper(md5($OTHER2));
    $sha512other2 = strtoupper(hash("sha512", $md5OTHER2));


    $data_response = '{"DEPCODE":"' . $enc_DEPCODE . '","PMODE":"' . $enc_PMODE . '","PTYPE":"","CHQDDNO":"","CHQDT":"","ASMTYEAR":"' . $enc_ASMTYEAR . '","TAXPERIOD":"' . $enc_TAXPERIOD . '","PERIOD":"","BANK":"' . $enc_BANK . '","UIDNO":"","NAME":"' . $enc_NAME . '","DepositorADDRESS":"' . $enc_DepositorADDRESS . '","DIVCODE":"' . $enc_DIVCODE . '","TCODE":"' . $enc_TCODE . '","LOCATION":"' . $enc_LOCATION . '","REMARK":"","TOTAL":"' . $enc_TOTAL . '","REFERENCEID":"' . $enc_REFERENCEID . '","ServiceID":"' . $enc_ServiceID . '","OTHER1":"' . $sha512other1 . '","rajkoshHeadInfo":[{"SNO":"' . $enc_SNO . '","HEAD":"' . $enc_HEAD . '","AMOUNT":"' . $enc_AMOUNT . '","OTHER2":"' . $sha512other2 . '"}]}';



    $DEPCODE = 'EDU';
    $enc_DEPCODE = base64_encode('EDU');
    $PMODE = 'NETPAY';
    $enc_PMODE = base64_encode('NETPAY');
    $PTYPE = "";
    $CHQDDNO = '';
    $CHQDT = "";
    $ASMTYEAR = $DynamicASMTYEAR;
    $enc_ASMTYEAR = base64_encode($DynamicASMTYEAR);
    $TAXPERIOD = "A";
    $enc_TAXPERIOD = base64_encode("A");
    $PERIOD = "";
    $BANK = "0001";
    $enc_BANK = base64_encode("0001");
    $UIDNO = "";
    $NAME = $userDetail->name;
    $enc_NAME = base64_encode($userDetail->name);
    $enc_DepositorADDRESS = "";
    $DepositorADDRESS = "";
    $DIVCODE = $division_id->DIVCODE;
    $enc_DIVCODE = base64_encode($division_id->DIVCODE);
    $TCODE = $division_id->TCODE;
    $enc_TCODE = base64_encode($TCODE);
    $LOCATION = districtName($permanent_district_id);
    $enc_LOCATION = base64_encode(districtName($permanent_district_id));
    $REMARK = "Coaching Camp Registration";

    $enc_TOTAL = base64_encode($TOTAL);
    $REFERENCEID = "S05";
    $enc_REFERENCEID = base64_encode("S05");
    $ServiceID = "05";
    $enc_ServiceID = base64_encode("05");
    $SNO = "40";
    $enc_SNO = base64_encode("40");
    $HEAD = "020203101010000";
    $enc_HEAD = base64_encode("020203101010000");
    $AMOUNT = $TOTAL;
    $enc_AMOUNT = base64_encode($TOTAL);

    $OTHER1 = $DEPCODE . $PMODE . $ASMTYEAR . $TAXPERIOD . $TCODE . $TOTAL;
    $md5OTHER1 = strtoupper(md5($OTHER1));
    $sha512other1 = strtoupper(hash("sha512", $md5OTHER1));

    $OTHER2 = $DEPCODE . $SNO . $HEAD . $AMOUNT;
    $md5OTHER2 = strtoupper(md5($OTHER2));
    $sha512other2 = strtoupper(hash("sha512", $md5OTHER2));

    $data_set = [

      'application_no' => $basic->application_no,
      'application_id' => $basic->id,


      'DEPCODE' => $DEPCODE,
      'PMODE' => $PMODE,
      'PTYPE' => $PTYPE,
      'CHQDDNO' => $CHQDDNO,
      'CHQDT' => $CHQDT,
      'ASMTYEAR' => $ASMTYEAR,
      'TAXPERIOD' => $TAXPERIOD,
      'PERIOD' => $PERIOD,
      'BANK' => $BANK,
      'UIDNO' => $UIDNO,
      'NAME' => $NAME,
      'DepositorADDRESS' => $DepositorADDRESS,
      'DIVCODE' => $DIVCODE,
      'TCODE' => $TCODE,
      'LOCATION' => $LOCATION,
      'TOTAL' => $TOTAL,
      'REFERENCEID' => $REFERENCEID,
      'ServiceID' => $ServiceID,
      'SNO' => $SNO,
      'HEAD' => $HEAD,
      'AMOUNT' => $AMOUNT,
      'OTHER1' => $OTHER1,
      'OTHER2' => $OTHER2,
      'type' => 0,
      'module' => 4,

    ];



    $data = [
      'data_response' => $data_response,
      'data_set' => $data_set,


    ];




    return redirect('https://www.startinup.up.gov.in/demo/PaymentController/payment_gateway/' . base64_encode(json_encode($data)));
  }



  public function coaching_camp_application_coaching_fee(Request $request)
  {
    $month = date('n'); // Numeric month without leading zero (1–12)
    $year = date('Y'); // Current year in 4 digits

    if ($month >= 4) {
      // April to December: Assessment year is current year – next year
      $DynamicASMTYEAR = $year . '-' . ($year + 1);
    }
    else {
      // January to March: Assessment year is previous year – current year
      $DynamicASMTYEAR = ($year - 1) . '-' . $year;
    }




    $userDetail = Auth::guard('CoachingCamp')->user();
    $permanent_district_id = DB::table('coaching_camp_basic_details')->where('user_id', Auth::guard('CoachingCamp')->user()->id)->first()->permanent_district;
    $basic = DB::table('coaching_camp_basic_details')->where('user_id', Auth::guard('CoachingCamp')->user()->id)->first();
    $division_id = rajkosh_division_treasury($permanent_district_id);
    $TOTAL = $basic->payment_amount_coaching;



    $DEPCODE = 'EDU';
    $enc_DEPCODE = base64_encode('EDU');
    $PMODE = 'NETPAY';
    $enc_PMODE = base64_encode('NETPAY');
    $PTYPE = "";
    $CHQDDNO = '';
    $CHQDT = "";
    $ASMTYEAR = $DynamicASMTYEAR;
    $enc_ASMTYEAR = base64_encode($DynamicASMTYEAR);
    $TAXPERIOD = "A";
    $enc_TAXPERIOD = base64_encode("A");
    $PERIOD = "";
    $enc_BANK = base64_encode("0001");
    $UIDNO = "";
    $enc_NAME = base64_encode($userDetail->name);
    $enc_DepositorADDRESS = "";
    $enc_DIVCODE = base64_encode($division_id->DIVCODE);
    $TCODE = $division_id->TCODE;
    $enc_TCODE = base64_encode($TCODE);
    $enc_LOCATION = base64_encode(districtName($permanent_district_id));
    $REMARK = "";
    // $TOTAL = $application->amount_to_be_paid;
    $enc_TOTAL = base64_encode($TOTAL);
    $enc_REFERENCEID = base64_encode("S05");
    $enc_ServiceID = base64_encode("05");
    $SNO = "40";
    $enc_SNO = base64_encode("40");
    $HEAD = "020203101010000";
    $enc_HEAD = base64_encode("020203101010000");
    $AMOUNT = $TOTAL;
    $enc_AMOUNT = base64_encode($AMOUNT);

    $OTHER1 = $DEPCODE . $PMODE . $ASMTYEAR . $TAXPERIOD . $TCODE . $TOTAL;
    $md5OTHER1 = strtoupper(md5($OTHER1));
    $sha512other1 = strtoupper(hash("sha512", $md5OTHER1));

    $OTHER2 = $DEPCODE . $SNO . $HEAD . $AMOUNT;
    $md5OTHER2 = strtoupper(md5($OTHER2));
    $sha512other2 = strtoupper(hash("sha512", $md5OTHER2));


    $data_response = '{"DEPCODE":"' . $enc_DEPCODE . '","PMODE":"' . $enc_PMODE . '","PTYPE":"","CHQDDNO":"","CHQDT":"","ASMTYEAR":"' . $enc_ASMTYEAR . '","TAXPERIOD":"' . $enc_TAXPERIOD . '","PERIOD":"","BANK":"' . $enc_BANK . '","UIDNO":"","NAME":"' . $enc_NAME . '","DepositorADDRESS":"' . $enc_DepositorADDRESS . '","DIVCODE":"' . $enc_DIVCODE . '","TCODE":"' . $enc_TCODE . '","LOCATION":"' . $enc_LOCATION . '","REMARK":"","TOTAL":"' . $enc_TOTAL . '","REFERENCEID":"' . $enc_REFERENCEID . '","ServiceID":"' . $enc_ServiceID . '","OTHER1":"' . $sha512other1 . '","rajkoshHeadInfo":[{"SNO":"' . $enc_SNO . '","HEAD":"' . $enc_HEAD . '","AMOUNT":"' . $enc_AMOUNT . '","OTHER2":"' . $sha512other2 . '"}]}';



    $DEPCODE = 'EDU';
    $enc_DEPCODE = base64_encode('EDU');
    $PMODE = 'NETPAY';
    $enc_PMODE = base64_encode('NETPAY');
    $PTYPE = "";
    $CHQDDNO = '';
    $CHQDT = "";
    $ASMTYEAR = $DynamicASMTYEAR;
    $enc_ASMTYEAR = base64_encode($DynamicASMTYEAR);
    $TAXPERIOD = "A";
    $enc_TAXPERIOD = base64_encode("A");
    $PERIOD = "";
    $BANK = "0001";
    $enc_BANK = base64_encode("0001");
    $UIDNO = "";
    $NAME = $userDetail->name;
    $enc_NAME = base64_encode($userDetail->name);
    $enc_DepositorADDRESS = "";
    $DepositorADDRESS = "";
    $DIVCODE = $division_id->DIVCODE;
    $enc_DIVCODE = base64_encode($division_id->DIVCODE);
    $TCODE = $division_id->TCODE;
    $enc_TCODE = base64_encode($TCODE);
    $LOCATION = districtName($permanent_district_id);
    $enc_LOCATION = base64_encode(districtName($permanent_district_id));
    $REMARK = "Coaching Camp Fees";

    $enc_TOTAL = base64_encode($TOTAL);
    $REFERENCEID = "S05";
    $enc_REFERENCEID = base64_encode("S05");
    $ServiceID = "05";
    $enc_ServiceID = base64_encode("05");
    $SNO = "40";
    $enc_SNO = base64_encode("40");
    $HEAD = "020203101010000";
    $enc_HEAD = base64_encode("020203101010000");
    $AMOUNT = $TOTAL;
    $enc_AMOUNT = base64_encode($TOTAL);

    $OTHER1 = $DEPCODE . $PMODE . $ASMTYEAR . $TAXPERIOD . $TCODE . $TOTAL;
    $md5OTHER1 = strtoupper(md5($OTHER1));
    $sha512other1 = strtoupper(hash("sha512", $md5OTHER1));

    $OTHER2 = $DEPCODE . $SNO . $HEAD . $AMOUNT;
    $md5OTHER2 = strtoupper(md5($OTHER2));
    $sha512other2 = strtoupper(hash("sha512", $md5OTHER2));

    $data_set = [

      'application_no' => $basic->application_no,
      'application_id' => $basic->id,


      'DEPCODE' => $DEPCODE,
      'PMODE' => $PMODE,
      'PTYPE' => $PTYPE,
      'CHQDDNO' => $CHQDDNO,
      'CHQDT' => $CHQDT,
      'ASMTYEAR' => $ASMTYEAR,
      'TAXPERIOD' => $TAXPERIOD,
      'PERIOD' => $PERIOD,
      'BANK' => $BANK,
      'UIDNO' => $UIDNO,
      'NAME' => $NAME,
      'DepositorADDRESS' => $DepositorADDRESS,
      'DIVCODE' => $DIVCODE,
      'TCODE' => $TCODE,
      'LOCATION' => $LOCATION,
      'TOTAL' => $TOTAL,
      'REFERENCEID' => $REFERENCEID,
      'ServiceID' => $ServiceID,
      'SNO' => $SNO,
      'HEAD' => $HEAD,
      'AMOUNT' => $AMOUNT,
      'OTHER1' => $OTHER1,
      'OTHER2' => $OTHER2,
      'type' => 0,
      'module' => 5,

    ];



    $data = [
      'data_response' => $data_response,
      'data_set' => $data_set,


    ];




    return redirect('https://www.startinup.up.gov.in/demo/PaymentController/payment_gateway/' . base64_encode(json_encode($data)));
  }
}
