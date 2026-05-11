<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;
use Exception;
use Illuminate\Support\Facades\Session;
class darpanController extends Controller
{
    public function index()
      {

        $financial = DB::Select("SELECT COUNT(id) as total,COUNT(CASE WHEN status = 1 THEN 1 END) as total_pending,COUNT(CASE WHEN status = 2 THEN 1 END) as total_accepted,COUNT(CASE WHEN status = 3 THEN 1 END) as total_rejected from darpan_financial_assistance_data WHERE 1 ");
            // $financial  = DB::table('darpan_financial_assistance_data')->count();

         $monthly = DB::Select("SELECT COUNT(id) as total,COUNT(CASE WHEN status = 1 THEN 1 END) as total_pending,COUNT(CASE WHEN status = 2 THEN 1 END) as total_accepted,COUNT(CASE WHEN status = 3 THEN 1 END) as total_rejected from darpan_monthly_pension_data WHERE 1");
            // $monthly  = DB::table('darpan_monthly_pension_data')->count();

            $direct = DB::Select("SELECT COUNT(id) as total,COUNT(CASE WHEN status = 1 THEN 1 END) as total_pending,COUNT(CASE WHEN status = 2 THEN 1 END) as total_accepted,COUNT(CASE WHEN status = 3 THEN 1 END) as total_rejected from darpan_direct_recru_data WHERE 1 ");
            // $direct  = DB::table('darpan_financial_assistance_data')->count();

            $award = DB::Select("SELECT COUNT(id) as total,COUNT(CASE WHEN status = 1 THEN 1 END) as total_pending,COUNT(CASE WHEN status = 2 THEN 1 END) as total_accepted,COUNT(CASE WHEN status = 3 THEN 1 END) as total_rejected from darpan_award_data WHERE 1 ");
            // $award  = DB::table('darpan_award_data')->count();

        //  $ranilaxmibai = DB::Select("SELECT COUNT(CASE WHEN final_submit = 1 THEN 1 END) as total,COUNT(CASE WHEN status = 0 THEN 1 END) as total_pending,COUNT(CASE WHEN status = 1 THEN 1 END) as total_accepted,COUNT(CASE WHEN status = 2 THEN 1 END) as total_rejected from ranilaxmibai_award WHERE 1 AND final_submit = 1");

            $position = DB::Select("SELECT COUNT(id) as total,COUNT(CASE WHEN status = 1 THEN 1 END) as total_pending,COUNT(CASE WHEN status = 2 THEN 1 END) as total_accepted,COUNT(CASE WHEN status = 3 THEN 1 END) as total_rejected from darpan_position_holder_data WHERE 1");
            // $position  = DB::table('darpan_position_holder_data')->count();

         return view('darpan.darpanDashboard', compact('financial', 'monthly', 'direct','award', 'position'));
      }

      public function award(Request $request){

        $date1 = Session::get('Clienttimestamp');
        $date2 = time();
        $mins = ($date2 - $date1) / 60;

        if(Session::get('Clienttimestamp') && $date1  && $mins <= 10 && (Session::get('project_id') == 2697)){



        $year="";
        $city="";
        $segment3= request()->segment(3);
        $segment4= request()->segment(4);

            $details = DB::table('darpan_award_data as dad')
            ->select('*');
            //Filter start here
            if ($request->isMethod('post')) {
                if ($request->has('month')) {
                    if($request->month != 'all')
                      $details->where( 'dad.month',  '=',  $request->month );
                }
                if ($request->has('year_filter')) {
                    if($request->year_filter != 'all')
                       $details->where( 'dad.year', '=', $request->year_filter  );
                }
                if ($request->has('from_date') && $request->from_date != '')
                $details->where(DB::raw("date(concat(dad.year,'/',if(LENGTH(dad.month) >1,dad.month,concat(0,month)),'/','01'))"),'>=',my($request->from_date));

                if ($request->has('to_date') && $request->to_date != '')
                    $details->where(DB::raw("date(concat(dad.year,'/',if(LENGTH(dad.month) >1,dad.month,concat(0,month)),'/','01'))"),'<=',my($request->to_date));

                if ($request->from_date != '' && $request->to_date != '')
                    $details->whereBetween(DB::raw("date(concat(dad.year,'/',if(LENGTH(dad.month) >1,dad.month,concat(0,month)),'/','01'))"), [my($request->from_date), my($request->to_date)]);

            }
            //Filter end here
            if($segment3 && is_numeric($segment3)){
                $details->where( 'dad.status', $segment3);
            }elseif($segment3 ){
                $details->where( 'dad.district', $segment3 );
            }
            if($segment4){
                $details->where( 'dad.district', $segment4);
            }
         $data=$details->get();
        //  dd($city);
        $months = DB::table('month_master')->orderBy('id', 'ASC')->get();




    }else{
        return  redirect('https://up.cmdashboard.nic.in/AuthFailed.html');
    }

            // $cities = DB::table('cities')->where('state_id', 23)->orderBy('city', 'ASC')->get();
        return view('darpan.award', compact('data','months','city','year'));
      }

    public function direct(Request $request){


        $date1 = Session::get('Clienttimestamp');
        $date2 = time();
        $mins = ($date2 - $date1) / 60;

        if(Session::get('Clienttimestamp') && $date1  && $mins <= 10 && (Session::get('project_id') == 2696)){








        $year="";
        $city="";
        $segment3= request()->segment(3);
        $segment4= request()->segment(4);
        $details = DB::table('darpan_direct_recru_data as dad')

        ->select('*');
            //Filter start here
            if ($request->isMethod('post')) {
                if ($request->has('month')) {
                    if($request->month != 'all')
                      $details->where( 'dad.month',  '=',  $request->month );
                }
                if ($request->has('year_filter')) {
                    if($request->year_filter != 'all')
                    $details->where( 'dad.year', '=', $request->year_filter  );
                }
                if ($request->has('from_date') && $request->from_date != '')
                    $details->whereDate(DB::raw("date(concat(dad.year,'/',if(LENGTH(dad.month) >1,dad.month,concat(0,month)),'/','01'))"),'>=',my($request->from_date));

                if ($request->has('to_date') && $request->to_date != '')
                    $details->whereDate(DB::raw("date(concat(dad.year,'/',if(LENGTH(dad.month) >1,dad.month,concat(0,month)),'/','01'))"),'<=',my($request->to_date));

                if ($request->from_date != '' && $request->to_date != '')
                    $details->whereBetween(DB::raw("date(concat(dad.year,'/',if(LENGTH(dad.month) >1,dad.month,concat(0,month)),'/','01'))"), [my($request->from_date), my($request->to_date)]);

            }
            //Filter end here
        if($segment3 && is_numeric($segment3)){
            $details->where( 'dad.status', $segment3);
        }elseif($segment3 ){
            $details->where( 'dad.district', $segment3 );
        }
        if($segment4){
            $details->where( 'dad.district',   $segment4 );
        }

        $data=$details->get();
        // $cities = DB::table('cities')->where('state_id', 23)->orderBy('city', 'ASC')->get();
        $months = DB::table('month_master')->orderBy('id', 'ASC')->get();



    }else{
        return  redirect('https://up.cmdashboard.nic.in/AuthFailed.html');
    }
        return view('darpan.direct', compact('data','months','city','year'));
    }

    public function financial(Request $request){





        $date1 = Session::get('Clienttimestamp');
        $date2 = time();
        $mins = ($date2 - $date1) / 60;

        if(Session::get('Clienttimestamp') && $date1  && $mins <= 10 && (Session::get('project_id') == 2695)){








        $year="";
        $city="";
        $segment3= request()->segment(3);
        $segment4= request()->segment(4);
        $details = DB::table('darpan_financial_assistance_data as dad')
        ->select('*');
        //Filter start here
        if ($request->isMethod('post')) {
            if ($request->has('month')) {
                if($request->month != 'all')
                  $details->where( 'dad.month',  '=',  $request->month );
            }
            if ($request->has('year_filter')) {
                if($request->year_filter != 'all')
                   $details->where( 'dad.year', '=', $request->year_filter  );
            }
            if ($request->has('from_date') && $request->from_date != '')
                $details->where(DB::raw("date(concat(dad.year,'/',if(LENGTH(dad.month) >1,dad.month,concat(0,month)),'/','01'))"),'>=',my($request->from_date));

                if ($request->has('to_date') && $request->to_date != '')
                    $details->where(DB::raw("date(concat(dad.year,'/',if(LENGTH(dad.month) >1,dad.month,concat(0,month)),'/','01'))"),'<=',my($request->to_date));

                if ($request->from_date != '' && $request->to_date != '')
                    $details->whereBetween(DB::raw("date(concat(dad.year,'/',if(LENGTH(dad.month) >1,dad.month,concat(0,month)),'/','01'))"), [my($request->from_date), my($request->to_date)]);

        }
        //Filter end here
        if($segment3 && is_numeric($segment3)){
            $details->where( 'dad.status', $segment3);
        }elseif($segment3 ){
            $details->where( 'dad.district', $segment3);
        }
        if($segment4){
            $details->where( 'dad.district', $segment4 );
        }
        $data=$details->get();
        $months = DB::table('month_master')->orderBy('id', 'ASC')->get();


    }else{
        return  redirect('https://up.cmdashboard.nic.in/AuthFailed.html');
    }
        return view('darpan.financial', compact('data','months','city','year'));
    }


    // public function monthly(Request $request){
    //     $year="";
    //     $city="";
    //     $segment= request()->segment(3);
    //     $details = DB::table('darpan_monthly_pension_data as dad')
    //     ->select('*');
    //     if ($request->isMethod('post')) {

    //             if ($request->has('city_filter')) {

    //                 $city=$request->city_filter;
    //                 if($request->city_filter != 'all')
    //             $details->where( 'dad.district',  'LIKE', '%' . $request->city_filter . '%');
    //         }

    //         if ($request->has('year_filter')) {
    //             $year= $request->year_filter;
    //             if($request->year_filter != 'all')
    //         $details->where( 'dad.year', 'LIKE', '%' . $request->year_filter . '%' );
    //         }
    //         }
    //         if($segment){
    //             $details->where( 'dad.status', $segment);
    //         }
    //     $data=$details->get();
    //     $cities = DB::table('cities')->where('state_id', 23)->orderBy('city', 'ASC')->get();
    //     return view('darpan.monthly', compact('data','cities','city','year'));
    // }

    public function position(Request $request){





        $date1 = Session::get('Clienttimestamp');
        $date2 = time();
        $mins = ($date2 - $date1) / 60;

        if(Session::get('Clienttimestamp') && $date1  && $mins <= 10 && (Session::get('project_id') == 2698)){








        $year="";
        $city="";
        $segment3= request()->segment(3);
        $segment4= request()->segment(4);
        $details = DB::table('darpan_position_holder_data as dad')
        ->select('*');
       //Filter start here
        if ($request->isMethod('post')) {
            if ($request->has('month')) {
                if($request->month != 'all')
                $details->where( 'dad.month',  '=',  $request->month );
            }
            if ($request->has('year_filter')) {
                if($request->year_filter != 'all')
                $details->where( 'dad.year', '=', $request->year_filter  );
            }
            if ($request->has('from_date') && $request->from_date != '')
                $details->where(DB::raw("date(concat(dad.year,'/',if(LENGTH(dad.month) >1,dad.month,concat(0,month)),'/','01'))"),'>=',my($request->from_date));

                if ($request->has('to_date') && $request->to_date != '')
                    $details->where(DB::raw("date(concat(dad.year,'/',if(LENGTH(dad.month) >1,dad.month,concat(0,month)),'/','01'))"),'<=',my($request->to_date));

                if ($request->from_date != '' && $request->to_date != '')
                    $details->whereBetween(DB::raw("date(concat(dad.year,'/',if(LENGTH(dad.month) >1,dad.month,concat(0,month)),'/','01'))"), [my($request->from_date), my($request->to_date)]);

        }
        //Filter end here
        if($segment3 && is_numeric($segment3)){
            $details->where( 'dad.status', $segment3);
        }elseif($segment3 ){
            $details->where( 'dad.district', $segment3 );
        }
        if($segment4){
            $details->where( 'dad.district', $segment4 );
        }
        $data=$details->get();
        // $cities = DB::table('cities')->where('state_id', 23)->orderBy('city', 'ASC')->get();
        $months = DB::table('month_master')->orderBy('id', 'ASC')->get();



    }else{
        return  redirect('https://up.cmdashboard.nic.in/AuthFailed.html');
    }
        return view('darpan.position', compact('data','months','city','year'));
    }



    public function district_direct(Request $request){










        if(Session::get('Clienttimestamp')){
            $date1 = Session::get('Clienttimestamp');
          $date2 = time();
          $mins = ($date2 - $date1) / 60;
                  }

                  if(isset( $request->cpat)){



                      try {

                          $output = $request->cpat;


                          $api_key ="T4Unx2yW3/7L5so3zFn5CtKGcldn1L73KF721UuYaPY=";





                          $output=  base64_decode($output);



                          $json = json_decode($output, true);

                          //Output
                          $output = $json['data'];
                          //Secret iv
                          $secretiv = $json['iv'];
                          $secretiv_base = base64_decode($secretiv);
                          $outputhash = $json['hash'];
                          $unhash = $output;
                          $payloadhash = hash('sha512', $unhash.$api_key);


                          $response = $this->decryptdatavalidate($output, $secretiv_base, $api_key);

                          $token = $response['token'];
                          $l1 = $response['l1'];
                          $l2 = $response['l2'];
                          $projcode = $response['projcode'];
                          $nonce = $response['nonce'];
                          $timestamp = $response['timestamp'];
                          $objmis = $token . '#' . $projcode . '#' . $secretiv_base . '#' . $secretiv.'#'.$nonce.'#'.$timestamp;

                          $data = explode("#", $objmis);
                          if($l2 != 0){
                              $districtArray = explode("#", $l2);

                              session()->put('districtArray',$districtArray);
                          }else{
                              Session::forget('districtArray');
                          }


                          $token = $data[0];
                          $projcode = $data[1];
                          $secretiv_base = $data[2];
                          $secretiv = $data[3];
                          $nonce = $data[4];
                          $timestamp = $data[5];

                          $clientmis_key_base = base64_decode($api_key);
                          $textToEncrypt = $token . '#' . $projcode . '#' . $nonce. '#' . $timestamp; //Token+ProjectCode+nonce+timestamp
                          $encryptionMethod = "AES-256-CBC"; //
                          $encryptedoutput = openssl_encrypt($textToEncrypt, $encryptionMethod, $clientmis_key_base, "0", $secretiv_base);
                          $outputhash = hash("sha512", $encryptedoutput.$api_key);

                          $b = array(
                             'data' => $encryptedoutput,
                             'hash' => $outputhash,
                             'projcode' => $projcode,
                             'instcode' => 2,
                             'iv' => $secretiv
                            );

                            $objpayload_token = json_encode($b, true);
                            $objpayload_token_base = base64_encode($objpayload_token);

                            $handshakingUrl = 'https://up.cmdashboard.nic.in/smis/AuthClientPage.asmx/doAuth?localtokenid='.$objpayload_token_base;

                            $ch = curl_init();
                            curl_setopt($ch, CURLOPT_URL, $handshakingUrl);
                            curl_setopt($ch, CURLOPT_POST, 0);
                            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                            curl_setopt($ch, CURLOPT_FAILONERROR, true);
                            $response = curl_exec($ch);
                            curl_close($ch);
                      //dd($response);
                            if ($response == "Invalid Request")
                            {
                                $_SESSION["Clienttoken"] = "";
                                return  redirect('https://up.cmdashboard.nic.in/AuthFailed.html');

                            }else{
                             $request = base64_decode($response);
                             $requestjson = json_decode($request, true);
                             $output = $requestjson['data'];
                             $outputhash = $requestjson['hash'];
                             $unhash = $output;

                             $payloadhash = hash('sha512', $unhash.$api_key); //data +key

                             if ($outputhash == $payloadhash)
                             {

                                 $encryptionMethod = "AES-256-CBC";

                                 $clientmis_iv_base_new = base64_decode($requestjson['iv']);

                                 $decryptedMessage = openssl_decrypt($output, $encryptionMethod, $clientmis_key_base, "0", $clientmis_iv_base_new);

                                 $decrypt_array = explode("#", $decryptedMessage);

                                 if ($decrypt_array[0] == "failure")
                                 {
                                     $_SESSION["Clienttoken"] = "";
                                     return  redirect('https://up.cmdashboard.nic.in/AuthFailed.html');
                                 }
                                 else
                                 {


                                     session()->put('Clienttoken',$decrypt_array[1]);
                                     session()->put('Clientnonce', $decrypt_array[2]);
                                     session()->put('Clienttimestamp',$decrypt_array[3]);
                                 session()->put('project_id',2696);

                               return redirect('/darpan/district_direct');






                                 }

                              }



                        }

                      } catch (Exception $e) {
                          return  redirect('https://up.cmdashboard.nic.in/AuthFailed.html');
                       }


                      }elseif(Session::get('Clienttimestamp') && $mins <= 10 && (Session::get('project_id') == 2696)){





                        $year="";
                        $city="";
                        // $data = DB::Select("SELECT district,COUNT(id) as total,COUNT(CASE WHEN status = 1 THEN 1 END) as total_pending,COUNT(CASE WHEN status = 2 THEN 1 END) as total_accepted,COUNT(CASE WHEN status = 3 THEN 1 END) as total_rejected from darpan_direct_recru_data WHERE 1 GROUP By district ");
                        $data = DB::Select("SELECT cities.city  as district,COUNT(darpan_direct_recru_data.id) as total,COUNT(CASE WHEN darpan_direct_recru_data.status = 1 THEN 1 END) as total_pending,COUNT(CASE WHEN darpan_direct_recru_data.status = 2 THEN 1 END) as total_accepted,COUNT(CASE WHEN darpan_direct_recru_data.status = 3 THEN 1 END) as total_rejected from   cities left join darpan_direct_recru_data on darpan_direct_recru_data.district = cities.city WHERE cities.state_id=23 GROUP By cities.city");
                        $cities = DB::table('cities')->where('state_id', 23)->orderBy('city', 'ASC')->get();

                        $data_total = DB::Select("SELECT cities.city  as district,COUNT(darpan_direct_recru_data.id) as total,COUNT(CASE WHEN darpan_direct_recru_data.status = 1 THEN 1 END) as total_pending,COUNT(CASE WHEN darpan_direct_recru_data.status = 2 THEN 1 END) as total_accepted,COUNT(CASE WHEN darpan_direct_recru_data.status = 3 THEN 1 END) as total_rejected from   cities left join darpan_direct_recru_data on darpan_direct_recru_data.district = cities.city WHERE cities.state_id=23 ");


    }else{
        return  redirect('https://up.cmdashboard.nic.in/AuthFailed.html');
    }




        return view('darpan.district_direct', compact('data','cities','city','year','data_total'));
    }
    public function district_financial(Request $request){


        if(Session::get('Clienttimestamp')){
            $date1 = Session::get('Clienttimestamp');
          $date2 = time();
          $mins = ($date2 - $date1) / 60;
                  }
          // $date1 = 1711080000;
          // $date2 = time();
          // $mins = ($date2 - $date1) / 60;
          // dd($mins);
          //        dd(date('Y-m-d', 1711010889)) ;
                  if(isset( $request->cpat)){



                      try {

                          $output = $request->cpat;


                          $api_key ="GBYwzhOpVYdCwNEIz0TJN/5vhavh4mVvbGOru3Knjgs=";





                          $output=  base64_decode($output);



                          $json = json_decode($output, true);

                          //Output
                          $output = $json['data'];
                          //Secret iv
                          $secretiv = $json['iv'];
                          $secretiv_base = base64_decode($secretiv);
                          $outputhash = $json['hash'];
                          $unhash = $output;
                          $payloadhash = hash('sha512', $unhash.$api_key);


                          $response = $this->decryptdatavalidate($output, $secretiv_base, $api_key);

                          $token = $response['token'];
                          $l1 = $response['l1'];
                          $l2 = $response['l2'];
                          $projcode = $response['projcode'];
                          $nonce = $response['nonce'];
                          $timestamp = $response['timestamp'];
                          $objmis = $token . '#' . $projcode . '#' . $secretiv_base . '#' . $secretiv.'#'.$nonce.'#'.$timestamp;

                          $data = explode("#", $objmis);
                          if($l2 != 0){
                              $districtArray = explode("#", $l2);

                              session()->put('districtArray',$districtArray);
                          }else{
                              Session::forget('districtArray');
                          }


                          $token = $data[0];
                          $projcode = $data[1];
                          $secretiv_base = $data[2];
                          $secretiv = $data[3];
                          $nonce = $data[4];
                          $timestamp = $data[5];

                          $clientmis_key_base = base64_decode($api_key);
                          $textToEncrypt = $token . '#' . $projcode . '#' . $nonce. '#' . $timestamp; //Token+ProjectCode+nonce+timestamp
                          $encryptionMethod = "AES-256-CBC"; //
                          $encryptedoutput = openssl_encrypt($textToEncrypt, $encryptionMethod, $clientmis_key_base, "0", $secretiv_base);
                          $outputhash = hash("sha512", $encryptedoutput.$api_key);

                          $b = array(
                             'data' => $encryptedoutput,
                             'hash' => $outputhash,
                             'projcode' => $projcode,
                             'instcode' => 2,
                             'iv' => $secretiv
                            );

                            $objpayload_token = json_encode($b, true);
                            $objpayload_token_base = base64_encode($objpayload_token);

                            $handshakingUrl = 'https://up.cmdashboard.nic.in/smis/AuthClientPage.asmx/doAuth?localtokenid='.$objpayload_token_base;

                            $ch = curl_init();
                            curl_setopt($ch, CURLOPT_URL, $handshakingUrl);
                            curl_setopt($ch, CURLOPT_POST, 0);
                            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                            curl_setopt($ch, CURLOPT_FAILONERROR, true);
                            $response = curl_exec($ch);
                            curl_close($ch);
                      //dd($response);
                            if ($response == "Invalid Request")
                            {
                                $_SESSION["Clienttoken"] = "";
                                return  redirect('https://up.cmdashboard.nic.in/AuthFailed.html');

                            }else{
                             $request = base64_decode($response);
                             $requestjson = json_decode($request, true);
                             $output = $requestjson['data'];
                             $outputhash = $requestjson['hash'];
                             $unhash = $output;

                             $payloadhash = hash('sha512', $unhash.$api_key); //data +key

                             if ($outputhash == $payloadhash)
                             {

                                 $encryptionMethod = "AES-256-CBC";

                                 $clientmis_iv_base_new = base64_decode($requestjson['iv']);

                                 $decryptedMessage = openssl_decrypt($output, $encryptionMethod, $clientmis_key_base, "0", $clientmis_iv_base_new);

                                 $decrypt_array = explode("#", $decryptedMessage);

                                 if ($decrypt_array[0] == "failure")
                                 {
                                     $_SESSION["Clienttoken"] = "";
                                     return  redirect('https://up.cmdashboard.nic.in/AuthFailed.html');
                                 }
                                 else
                                 {


                                     session()->put('Clienttoken',$decrypt_array[1]);
                                     session()->put('Clientnonce', $decrypt_array[2]);
                                     session()->put('Clienttimestamp',$decrypt_array[3]);
                                 session()->put('project_id',2695);

                               return redirect('/darpan/district_financial');






                                 }

                              }



                        }

                      } catch (Exception $e) {
                          return  redirect('https://up.cmdashboard.nic.in/AuthFailed.html');
                       }


                      }elseif(Session::get('Clienttimestamp') && $mins <= 10 && (Session::get('project_id') == 2695)){





        $year="";
        $city="";
        $data = DB::Select("SELECT cities.city  as district,COUNT(darpan_financial_assistance_data.id) as total,COUNT(CASE WHEN darpan_financial_assistance_data.status = 1 THEN 1 END) as total_pending,COUNT(CASE WHEN darpan_financial_assistance_data.status = 2 THEN 1 END) as total_accepted,COUNT(CASE WHEN darpan_financial_assistance_data.status = 3 THEN 1 END) as total_rejected from   cities left join darpan_financial_assistance_data on darpan_financial_assistance_data.district = cities.city WHERE cities.state_id=23 GROUP By cities.city");
        // $data = DB::Select("SELECT district,COUNT(id) as total,COUNT(CASE WHEN status = 1 THEN 1 END) as total_pending,COUNT(CASE WHEN status = 2 THEN 1 END) as total_accepted,COUNT(CASE WHEN status = 3 THEN 1 END) as total_rejected from darpan_financial_assistance_data WHERE 1 GROUP By district ");
        $cities = DB::table('cities')->where('state_id', 23)->orderBy('city', 'ASC')->get();
        $data_total =  DB::Select("SELECT cities.city  as district,COUNT(darpan_financial_assistance_data.id) as total,COUNT(CASE WHEN darpan_financial_assistance_data.status = 1 THEN 1 END) as total_pending,COUNT(CASE WHEN darpan_financial_assistance_data.status = 2 THEN 1 END) as total_accepted,COUNT(CASE WHEN darpan_financial_assistance_data.status = 3 THEN 1 END) as total_rejected from   cities left join darpan_financial_assistance_data on darpan_financial_assistance_data.district = cities.city WHERE cities.state_id=23 ");


    }else{
        return  redirect('https://up.cmdashboard.nic.in/AuthFailed.html');
    }

        return view('darpan.district_financial', compact('data','cities','city','year','data_total'));
    }

    public function district_award(Request $request){




        if(Session::get('Clienttimestamp')){
            $date1 = Session::get('Clienttimestamp');
          $date2 = time();
          $mins = ($date2 - $date1) / 60;
                  }
          // $date1 = 1711080000;
          // $date2 = time();
          // $mins = ($date2 - $date1) / 60;
          // dd($mins);
          //        dd(date('Y-m-d', 1711010889)) ;
                  if(isset( $request->cpat)){



                      try {

                          $output = $request->cpat;


                          $api_key ="Z5Hptmix/Kyj0IkNBaxHoykRmET7yLG+AU//+7FdH3E=";





                          $output=  base64_decode($output);



                          $json = json_decode($output, true);

                          //Output
                          $output = $json['data'];
                          //Secret iv
                          $secretiv = $json['iv'];
                          $secretiv_base = base64_decode($secretiv);
                          $outputhash = $json['hash'];
                          $unhash = $output;
                          $payloadhash = hash('sha512', $unhash.$api_key);


                          $response = $this->decryptdatavalidate($output, $secretiv_base, $api_key);

                          $token = $response['token'];
                          $l1 = $response['l1'];
                          $l2 = $response['l2'];
                          $projcode = $response['projcode'];
                          $nonce = $response['nonce'];
                          $timestamp = $response['timestamp'];
                          $objmis = $token . '#' . $projcode . '#' . $secretiv_base . '#' . $secretiv.'#'.$nonce.'#'.$timestamp;

                          $data = explode("#", $objmis);
                          if($l2 != 0){
                              $districtArray = explode("#", $l2);

                              session()->put('districtArray',$districtArray);
                          }else{
                              Session::forget('districtArray');
                          }


                          $token = $data[0];
                          $projcode = $data[1];
                          $secretiv_base = $data[2];
                          $secretiv = $data[3];
                          $nonce = $data[4];
                          $timestamp = $data[5];

                          $clientmis_key_base = base64_decode($api_key);
                          $textToEncrypt = $token . '#' . $projcode . '#' . $nonce. '#' . $timestamp; //Token+ProjectCode+nonce+timestamp
                          $encryptionMethod = "AES-256-CBC"; //
                          $encryptedoutput = openssl_encrypt($textToEncrypt, $encryptionMethod, $clientmis_key_base, "0", $secretiv_base);
                          $outputhash = hash("sha512", $encryptedoutput.$api_key);

                          $b = array(
                             'data' => $encryptedoutput,
                             'hash' => $outputhash,
                             'projcode' => $projcode,
                             'instcode' => 2,
                             'iv' => $secretiv
                            );

                            $objpayload_token = json_encode($b, true);
                            $objpayload_token_base = base64_encode($objpayload_token);

                            $handshakingUrl = 'https://up.cmdashboard.nic.in/smis/AuthClientPage.asmx/doAuth?localtokenid='.$objpayload_token_base;

                            $ch = curl_init();
                            curl_setopt($ch, CURLOPT_URL, $handshakingUrl);
                            curl_setopt($ch, CURLOPT_POST, 0);
                            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                            curl_setopt($ch, CURLOPT_FAILONERROR, true);
                            $response = curl_exec($ch);
                            curl_close($ch);
                      //dd($response);
                            if ($response == "Invalid Request")
                            {
                                $_SESSION["Clienttoken"] = "";
                                return  redirect('https://up.cmdashboard.nic.in/AuthFailed.html');

                            }else{
                             $request = base64_decode($response);
                             $requestjson = json_decode($request, true);
                             $output = $requestjson['data'];
                             $outputhash = $requestjson['hash'];
                             $unhash = $output;

                             $payloadhash = hash('sha512', $unhash.$api_key); //data +key

                             if ($outputhash == $payloadhash)
                             {

                                 $encryptionMethod = "AES-256-CBC";

                                 $clientmis_iv_base_new = base64_decode($requestjson['iv']);

                                 $decryptedMessage = openssl_decrypt($output, $encryptionMethod, $clientmis_key_base, "0", $clientmis_iv_base_new);

                                 $decrypt_array = explode("#", $decryptedMessage);

                                 if ($decrypt_array[0] == "failure")
                                 {
                                     $_SESSION["Clienttoken"] = "";
                                     return  redirect('https://up.cmdashboard.nic.in/AuthFailed.html');
                                 }
                                 else
                                 {


                                     session()->put('Clienttoken',$decrypt_array[1]);
                                     session()->put('Clientnonce', $decrypt_array[2]);
                                     session()->put('Clienttimestamp',$decrypt_array[3]);
                                 session()->put('project_id',2697);

                               return redirect('/darpan/district_award');






                                 }

                              }



                        }

                      } catch (Exception $e) {
                          return  redirect('https://up.cmdashboard.nic.in/AuthFailed.html');
                       }


                      }elseif(Session::get('Clienttimestamp') && $mins <= 10 && (Session::get('project_id') == 2697)){








        $year="";
        $city="";
        $data = DB::Select("SELECT cities.city  as district,COUNT(darpan_award_data.id) as total,COUNT(CASE WHEN darpan_award_data.status = 1 THEN 1 END) as total_pending,COUNT(CASE WHEN darpan_award_data.status = 2 THEN 1 END) as total_accepted,COUNT(CASE WHEN darpan_award_data.status = 3 THEN 1 END) as total_rejected from   cities left join darpan_award_data on darpan_award_data.district = cities.city WHERE cities.state_id=23 GROUP By cities.city");
        // $data = DB::Select("SELECT district,COUNT(id) as total,COUNT(CASE WHEN status = 1 THEN 1 END) as total_pending,COUNT(CASE WHEN status = 2 THEN 1 END) as total_accepted,COUNT(CASE WHEN status = 3 THEN 1 END) as total_rejected from darpan_award_data WHERE 1 GROUP By district ");
        $cities = DB::table('cities')->where('state_id', 23)->orderBy('city', 'ASC')->get();

        $data_total =  DB::Select("SELECT cities.city  as district,COUNT(darpan_award_data.id) as total,COUNT(CASE WHEN darpan_award_data.status = 1 THEN 1 END) as total_pending,COUNT(CASE WHEN darpan_award_data.status = 2 THEN 1 END) as total_accepted,COUNT(CASE WHEN darpan_award_data.status = 3 THEN 1 END) as total_rejected from   cities left join darpan_award_data on darpan_award_data.district = cities.city WHERE cities.state_id=23");


    }else{
        return  redirect('https://up.cmdashboard.nic.in/AuthFailed.html');
    }

        return view('darpan.district_award', compact('data','cities','city','year','data_total'));
    }

    public function district_position(Request $request){








        if(Session::get('Clienttimestamp')){
            $date1 = Session::get('Clienttimestamp');
          $date2 = time();
          $mins = ($date2 - $date1) / 60;
                  }
          // $date1 = 1711080000;
          // $date2 = time();
          // $mins = ($date2 - $date1) / 60;
          // dd($mins);
          //        dd(date('Y-m-d', 1711010889)) ;
                  if(isset( $request->cpat)){



                      try {

                          $output = $request->cpat;


                          $api_key ="Kpuu3ywTwpaq8Ku89E7rVBPnLGVVeleN7lx4J5TaexA=";





                          $output=  base64_decode($output);



                          $json = json_decode($output, true);

                          //Output
                          $output = $json['data'];
                          //Secret iv
                          $secretiv = $json['iv'];
                          $secretiv_base = base64_decode($secretiv);
                          $outputhash = $json['hash'];
                          $unhash = $output;
                          $payloadhash = hash('sha512', $unhash.$api_key);


                          $response = $this->decryptdatavalidate($output, $secretiv_base, $api_key);

                          $token = $response['token'];
                          $l1 = $response['l1'];
                          $l2 = $response['l2'];
                          $projcode = $response['projcode'];
                          $nonce = $response['nonce'];
                          $timestamp = $response['timestamp'];
                          $objmis = $token . '#' . $projcode . '#' . $secretiv_base . '#' . $secretiv.'#'.$nonce.'#'.$timestamp;

                          $data = explode("#", $objmis);
                          if($l2 != 0){
                              $districtArray = explode("#", $l2);

                              session()->put('districtArray',$districtArray);
                          }else{
                              Session::forget('districtArray');
                          }


                          $token = $data[0];
                          $projcode = $data[1];
                          $secretiv_base = $data[2];
                          $secretiv = $data[3];
                          $nonce = $data[4];
                          $timestamp = $data[5];

                          $clientmis_key_base = base64_decode($api_key);
                          $textToEncrypt = $token . '#' . $projcode . '#' . $nonce. '#' . $timestamp; //Token+ProjectCode+nonce+timestamp
                          $encryptionMethod = "AES-256-CBC"; //
                          $encryptedoutput = openssl_encrypt($textToEncrypt, $encryptionMethod, $clientmis_key_base, "0", $secretiv_base);
                          $outputhash = hash("sha512", $encryptedoutput.$api_key);

                          $b = array(
                             'data' => $encryptedoutput,
                             'hash' => $outputhash,
                             'projcode' => $projcode,
                             'instcode' => 2,
                             'iv' => $secretiv
                            );

                            $objpayload_token = json_encode($b, true);
                            $objpayload_token_base = base64_encode($objpayload_token);

                            $handshakingUrl = 'https://up.cmdashboard.nic.in/smis/AuthClientPage.asmx/doAuth?localtokenid='.$objpayload_token_base;

                            $ch = curl_init();
                            curl_setopt($ch, CURLOPT_URL, $handshakingUrl);
                            curl_setopt($ch, CURLOPT_POST, 0);
                            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                            curl_setopt($ch, CURLOPT_FAILONERROR, true);
                            $response = curl_exec($ch);
                            curl_close($ch);
                      //dd($response);
                            if ($response == "Invalid Request")
                            {
                                $_SESSION["Clienttoken"] = "";
                                return  redirect('https://up.cmdashboard.nic.in/AuthFailed.html');

                            }else{
                             $request = base64_decode($response);
                             $requestjson = json_decode($request, true);
                             $output = $requestjson['data'];
                             $outputhash = $requestjson['hash'];
                             $unhash = $output;

                             $payloadhash = hash('sha512', $unhash.$api_key); //data +key

                             if ($outputhash == $payloadhash)
                             {

                                 $encryptionMethod = "AES-256-CBC";

                                 $clientmis_iv_base_new = base64_decode($requestjson['iv']);

                                 $decryptedMessage = openssl_decrypt($output, $encryptionMethod, $clientmis_key_base, "0", $clientmis_iv_base_new);

                                 $decrypt_array = explode("#", $decryptedMessage);

                                 if ($decrypt_array[0] == "failure")
                                 {
                                     $_SESSION["Clienttoken"] = "";
                                     return  redirect('https://up.cmdashboard.nic.in/AuthFailed.html');
                                 }
                                 else
                                 {


                                     session()->put('Clienttoken',$decrypt_array[1]);
                                     session()->put('Clientnonce', $decrypt_array[2]);
                                     session()->put('Clienttimestamp',$decrypt_array[3]);
                                 session()->put('project_id',2698);

                               return redirect('/darpan/district_award');






                                 }

                              }



                        }

                      } catch (Exception $e) {
                          return  redirect('https://up.cmdashboard.nic.in/AuthFailed.html');
                       }


                      }elseif(Session::get('Clienttimestamp') && $mins <= 10 && (Session::get('project_id') == 2698)){










                        $year="";
                        $city="";
                        $data = DB::Select("SELECT cities.city  as district,COUNT(darpan_position_holder_data.id) as total,COUNT(CASE WHEN darpan_position_holder_data.status = 1 THEN 1 END) as total_pending,COUNT(CASE WHEN darpan_position_holder_data.status = 2 THEN 1 END) as total_accepted,COUNT(CASE WHEN darpan_position_holder_data.status = 3 THEN 1 END) as total_rejected from   cities left join darpan_position_holder_data on darpan_position_holder_data.district = cities.city WHERE cities.state_id=23 GROUP By cities.city");
                        $data_total = DB::Select("SELECT cities.city  as district,COUNT(darpan_position_holder_data.id) as total,COUNT(CASE WHEN darpan_position_holder_data.status = 1 THEN 1 END) as total_pending,COUNT(CASE WHEN darpan_position_holder_data.status = 2 THEN 1 END) as total_accepted,COUNT(CASE WHEN darpan_position_holder_data.status = 3 THEN 1 END) as total_rejected from   cities left join darpan_position_holder_data on darpan_position_holder_data.district = cities.city WHERE cities.state_id=23");

                        // $data = DB::Select("SELECT district,COUNT(id) as total,COUNT(CASE WHEN status = 1 THEN 1 END) as total_pending,COUNT(CASE WHEN status = 2 THEN 1 END) as total_accepted,COUNT(CASE WHEN status = 3 THEN 1 END) as total_rejected from darpan_position_holder_data WHERE 1 GROUP By district ");
                        $cities = DB::table('cities')->where('state_id', 23)->orderBy('city', 'ASC')->get();
                        return view('darpan.district_position', compact('data','cities','city','year','data_total'));



    }else{
        return  redirect('https://up.cmdashboard.nic.in/AuthFailed.html');
    }














    }
}
