<?php

namespace App\Http\Controllers;

use App\Events\ChangePasswordLog;
use App\Events\UserLoggedIn;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\AuthModel;
use App\Models\DirectRecruitmentV;
use Illuminate\Contracts\Auth\Authenticatable;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use App\Events\SmsMail;
use App\Events\StatusChangeLog;
use Session;
use DateTime;
use Illuminate\Session\SessionManager;
use Illuminate\Support\Facades\Session as FacadesSession;

class DirectRecruitment extends Controller
{




    public function profile_detail($app_no="")
    {
        $adv_list ="";
        $adv_no=session()->get('adv_no');
        if(Auth::user()->profile_complete ==2){
            return redirect('/direct-recruitment/edit_profile_detail');
        }

        //  $sport_name= DB::table('advertisment_post_master')->where('id', $adv_no)->orderBy('id', 'DESC')->get();

        // $user = DirectRecruitmentV::where('user_id', Auth::id())->first();
        $user = User::where('id', Auth::id())->first();

        // $sport_type = DB::table('sport_type')->get();
        $country = DB::table('countries')->get();
        $state = DB::table('states')->orderBy('name','ASC')->get();
        $city = DB::table('cities')->orderBy('city','ASC')->get();
        $sport_event = DB::table('sports_event_master')->get();
        $sport_list = DB::table('sport_type')->get();
        $selectMaster = DB::table('select_master')->select('id','name')->get();

        $sportAchievement = DB::table('direct_recruitment_sport_achievement')->where('application_no', $app_no)->where('user_id', Auth::id())->get();
    //  dd($sportAchievement);
        $type_arr=[];
        foreach  ($sportAchievement as $key=>$item) {
            // dd($item->medal);
            $sport_event = $item->sport_event;
            $medal = $item->medal;
            if(($sport_event == 7 || $sport_event == 9) && ($medal=="Silver" || $medal=="Gold" || $medal=="Bronze")){
                $type_arr[]="1";
            }
            if(($sport_event == 10 || $sport_event == 11 || $sport_event == 12 || $sport_event == 13) && ($medal=="Gold")){
                $type_arr[]="1";
            }
            if(($sport_event == 10 || $sport_event == 11 || $sport_event == 12 || $sport_event == 13) && ($medal=="Silver")){
                $type_arr[]="2";
            }
            if(($sport_event == 10 || $sport_event == 11 || $sport_event == 12 || $sport_event == 13) && ( $medal=="Bronze")){
                $type_arr[]="3";
            }
        };
        // dd($type_arr);
        // $postMaster = DB::table('advertisment_post_master')->whereIn('post_category', $type_arr)->where('start_date','<=',date('Y-m-d'))->where('end_date','>=',date('Y-m-d'))->get();
        $postMaster = DB::table('advertisment_post_master')->whereIn('post_category', $type_arr)->get();
        $adv_list = DB::table('advertisment_post_master')->where('post_category', $type_arr)->orderBy('id', 'DESC')->get();
        $post_id=array();
        $sport_id="";
        foreach ($adv_list as $key=>$item){
            if($key != 0){
                $sport_id .=',';
            }
            $sport_id .= $item->sport_type;
            // array_merge($sport_id,$item->sport_type);
            // $post_id[]=$item->id;
            //  $sport_id[]=$item->sport_type;
            // array_merge($sport_id,$item->sport_type);
        }
        $spo = explode(",", $sport_id);
        // $sport_type = DB::table('sport_type')->whereIn('id', $spo)->get();
        $sport_type = DB::table('sport_type')->get();

        $all_city = DB::table('cities')->where('state_id', '23')->orderBy('city','ASC')->get();
        return view('directRecruitment.profile_detail', compact('postMaster','selectMaster','user', 'country', 'state', 'all_city', 'sport_type','sport_event','sport_list','sportAchievement','app_no'));
    }

    public function sport_achievement()
    {
        $adv_no=session()->get('adv_no');
        $sport_event = DB::table('sports_event_master')->select('event_name as name','id')->get();
        $sport_list = DB::table('sport_type')->get();
        // $user = DirectRecruitmentV::where('user_id', Auth::id())->first();
        $selected_sport = DB::table('sport_welfare_registration_master')->select('sport_type')->where('id', Auth::id())->get()[0]->sport_type;
        $user = User::where('id', Auth::id())->first();
        // $postMaster = DB::table('advertisment_post_master')->select('id','post_name')->where('advertisment_no', $adv_no)->where('start_date','<=',date('Y-m-d'))->where('end_date','>=',date('Y-m-d'))->get();
        $postMaster = DB::table('advertisment_post_master')->select('id','post_name')->where('advertisment_no', $adv_no)->get();
        $sportAchievement = DB::table('direct_recruitment_sport_achievement')->where('application_no', $user->application_no)->where('user_id', Auth::id())->get();
        return view('directRecruitment.sport_achievement', compact('selected_sport','sport_event','sport_list','user','sportAchievement'));
    }

    public function save_achievement(Request $req)
    {
        $required = [
            'sport_event.*'             => 'required',
            'sport_name.*'             => 'required',
            'medal.*'             => 'required',
            'event_details.*'             => 'required',
            'competition_date.*'             => 'required',

        ];

        $validation = Validator::make($req->all(), $required, msg());

        if ($validation->fails())
            return response()->json(['error' => true, 'msg' => $validation->errors()->first()]);

            $user = User::where('id', Auth::id())->first();
            $data = DB::table('direct_recruitment')->where('user_id', Auth::id())->where('is_editable', 1)->orderBy('id','desc')->first();
            if($data)
            {
                $applicationNo = $data->application_no;
                DB::table('direct_recruitment_sport_achievement')->where('user_id', Auth::id())->where('application_no', $applicationNo)->delete();

            }else{
                $applNo = rand(11111, 99999);
                $applicationNo= date('ymd').$applNo;

                $data = [
                    'user_id'       => Auth::id(),
                    'application_no'       => $applicationNo,
                ];


                if(Session::get('sessDetails')){


                    $data['serviceCode_edistrict']=Session::get('sessDetails')['serviceCode'];
                    $data['DCode_edistrict']=Session::get('sessDetails')['DCode'];
                    $data['RequestKey_edistrict']=Session::get('sessDetails')['RequestKey'];
                    $data['UserName_edistrict']=Session::get('sessDetails')['UserName'];

            }
                $id = DB::table('direct_recruitment')->insertGetId($data);
            }

            foreach ($req->sport_event as $key => $item) {

                    if(isset($req->sport_achievement_docs[$key]) ){
                    $sport_achievement_docs = date('His').$req->sport_achievement_docs[$key]->getClientOriginalName();
                    $req->file('sport_achievement_docs')[$key]->storeAs('direct_recruitment', $sport_achievement_docs, 'public');
                    }


                // dd($req->competition_date[$key]);
                DB::table('direct_recruitment_sport_achievement')->insertGetId([
                    'user_id' => Auth::id(),
                    'application_no' => $applicationNo,
                    'sport_event' => $item,
                    'sport_name' => $req->sport_name[$key],
                    'medal' => $req->medal[$key],

                    'competition_from_date' => $req->competition_from_date[$key],
                    'competition_to_date' => $req->competition_to_date[$key],
                    'sport_place' => $req->sport_place[$key],
                    'event_details' => $req->event_details[$key],
                    'sport_achievement_docs' => $sport_achievement_docs,
                ]);
            }


            //
            $sportAchievement = DB::table('direct_recruitment_sport_achievement')->where('application_no', $applicationNo)->where('user_id', Auth::id())->get();
            //  dd($sportAchievement);
                $type_arr=[];
                foreach  ($sportAchievement as $key=>$item) {
                    // dd($item->medal);
                    $sport_event = $item->sport_event;
                    $medal = $item->medal;
                    if(($sport_event == 7 || $sport_event == 9) && ($medal=="Silver" || $medal=="Gold" || $medal=="Bronze")){
                        $type_arr[]="1";
                    }
                    if(($sport_event == 10 || $sport_event == 11 || $sport_event == 12 || $sport_event == 13) && ($medal=="Gold")){
                        $type_arr[]="1";
                    }
                    if(($sport_event == 10 || $sport_event == 11 || $sport_event == 12 || $sport_event == 13) && ($medal=="Silver")){
                        $type_arr[]="2";
                    }
                    if(($sport_event == 10 || $sport_event == 11 || $sport_event == 12 || $sport_event == 13) && ( $medal=="Bronze")){
                        $type_arr[]="3";
                    }
                };
                // dd($type_arr);
                // $postMaster = DB::table('advertisment_post_master')->whereIn('post_category', $type_arr)->where('start_date','<=',date('Y-m-d'))->where('end_date','>=',date('Y-m-d'))->get();
                $postMaster = DB::table('advertisment_post_master')->whereIn('post_category', $type_arr)->get();


            return response()->json(["error" => false, "msg" => "Sport Achievement Successfully Added.", "data" => $postMaster, "url" => url('/direct-recruitment/profile_detail/'.$applicationNo)]);
            // return response()->json(["error" => false, "msg" => "Sport Achievement Successfully Added.", "url" => url('/direct-recruitment/profile_detail/'.$applicationNo)]);


    }



    public function edit_profile_detail($app_no="")
    {
        $adv_list ="";
        $adv_no=session()->get('adv_no');
        $adv_list = DB::table('advertisment_post_master')->where('advertisment_no', $adv_no)->orderBy('id', 'DESC')->get();
        $post_id=array();
        $sport_id="";
        foreach ($adv_list as $key=>$item){
            if($key != 0){
                $sport_id .=',';
            }
            $sport_id .= $item->sport_type;
        }
        $spo = explode(",", $sport_id);
        $sport_type = DB::table('sport_type')->whereIn('id', $spo)->get();

        // $user = DirectRecruitmentV::where('user_id', Auth::id())->first();
        // $sport_type = DB::table('sport_type')->get();
        $user = User::where('id', Auth::id())->first();
        $country = DB::table('countries')->get();
        $state = DB::table('states')->orderBy('name','ASC')->get();
        $city = DB::table('cities')->orderBy('city','ASC')->get();
        $all_city = DB::table('cities')->where('state_id', '23')->orderBy('city','ASC')->get();

        $selectMaster = DB::table('select_master')->select('id','name')->get();
        // $postMaster = DB::table('post_master')->select('id','name')->get();
        // $postMaster = DB::table('advertisment_post_master')->select('id','post_name')->where('advertisment_no', $adv_no)->where('end_date','>=',date('Y-m-d'))->get();


        $articles = DB::table('direct_recruitment')
            ->select('*')
            ->where('user_id', Auth::id())
            ->where('application_no', $app_no)
            ->first();
        $post = DB::table('applicant_post_master')
            ->select('*')
            ->where('user_id', Auth::id())
            ->where('application_no', $app_no)
            ->get();
            // dd($post);

            $sportAchievement = DB::table('direct_recruitment_sport_achievement')->where('application_no', $app_no)->where('user_id', Auth::id())->get();
    //  dd($sportAchievement);
        $type_arr=[];
        foreach  ($sportAchievement as $key=>$item) {
            // dd($item->medal);
            $sport_event = $item->sport_event;
            $medal = $item->medal;
            if(($sport_event == 7 || $sport_event == 9) && ($medal=="Silver" || $medal=="Gold" || $medal=="Bronze")){
                $type_arr[]="1";
            }
            if(($sport_event == 10 || $sport_event == 11 || $sport_event == 12 || $sport_event == 13) && ($medal=="Gold")){
                $type_arr[]="1";
            }
            if(( $sport_event == 10 || $sport_event == 11 || $sport_event == 12 || $sport_event == 13) && ($medal=="Silver")){
                $type_arr[]="2";
            }
            if(($sport_event == 10 || $sport_event == 11 || $sport_event == 12 || $sport_event == 13) && ( $medal=="Bronze")){
                $type_arr[]="3";
            }
        };
        // dd($type_arr);
        // $postMaster = DB::table('advertisment_post_master')->whereIn('post_category', $type_arr)->where('start_date','<=',date('Y-m-d'))->where('end_date','>=',date('Y-m-d'))->get();
        $postMaster = DB::table('advertisment_post_master')->whereIn('post_category', $type_arr)->get();

        // $postMaster = DB::table('advertisment_post_master')->whereIn('post_category', $type_arr)->get();
        $adv_list = DB::table('advertisment_post_master')->where('post_category', $type_arr)->orderBy('id', 'DESC')->get();
        $post_id=array();
        $sport_id="";
        foreach ($adv_list as $key=>$item){
            if($key != 0){
                $sport_id .=',';
            }
            $sport_id .= $item->sport_type;
            // array_merge($sport_id,$item->sport_type);
            // $post_id[]=$item->id;
            //  $sport_id[]=$item->sport_type;
            // array_merge($sport_id,$item->sport_type);
        }
        $spo = explode(",", $sport_id);
        // $sport_type = DB::table('sport_type')->whereIn('id', $spo)->get();
        $sport_type = DB::table('sport_type')->get();

        return view('directRecruitment.edit_profile_detail', compact('sportAchievement','postMaster','selectMaster','user', 'country', 'state', 'all_city', 'sport_type', 'articles', 'post'));
    }

    public function compProfile(Request $req)
    {
        // dd($req->all());
            DB::table('applicant_post_master')->where('user_id', Auth::id())->where('application_no', $req->app_no)->delete();
            foreach ($req->post_name as $key => $item) {
                $ch = DB::table('applicant_post_master')->insertGetId(array(
                    'user_id' => Auth::id(),
                    'application_no' => $req->app_no,
                    'post_type' => $req->post_type[$key],
                    'post_name' => $req->post_name[$key],
                ));
            };

            if ($req->domicile_certificate) {
                $domicile_certificate = date('His').$req->domicile_certificate->getClientOriginalName();
                $path = $req->file('domicile_certificate')->storeAs('direct_recruitment', $domicile_certificate, 'public');
            }
            if ($req->qualification_doc) {
                $qualification_doc = date('His').$req->qualification_doc->getClientOriginalName();
                $path = $req->file('qualification_doc')->storeAs('direct_recruitment', $qualification_doc, 'public');
            }
            //
            if ($req->achievement_doc) {
                $achievement_doc = date('His').$req->achievement_doc->getClientOriginalName();
                $path = $req->file('achievement_doc')->storeAs('direct_recruitment', $achievement_doc, 'public');
            }
            //
            $check = DB::table('direct_recruitment')->where('user_id', Auth::id())->where('application_no', $req->app_no)->update([
                // 'achievement_doc'      => $achievement_doc,
                'domicile_certificate'      => $domicile_certificate,
                'qualification_doc'      => $qualification_doc,
                'category' => $req->category,
                'religion' => $req->religion,
            ]);

            if ($ch) {
                $check = DB::table('direct_recruitment_sport_achievement')->where('application_no', $req->app_no)->where('user_id', Auth::id())->update(['profile_complete' => 2]);
                session()->flash('success', 'Profile Successfully Updated.');
                return response()->json(["error" => false, "msg" => "Detail Successfully Updated.", "url" => url('/direct-recruitment/formPreview/'.$req->app_no)]);
                // return redirect('/direct-recruitment/formPreview')->with('success', 'Profile Successfully Updated.');
            } else {
                session()->flash('error', 'Profile Not Updated.');
                // return redirect('/direct-recruitment/edit_profile_detail')->with('error', 'Profile Not Updated.');
                return response()->json(['error' => true, 'msg' => "Profile Not Updated."]);
            }

    }
    public function formPreview($app_no="")
    {
        // $articles = User::where('id', Auth::id())
        //     ->get();
        // dd(Auth::id());
        $post = DB::table('applicant_post_master')

            ->select('*')
            ->where('user_id', Auth::id())
            ->where('application_no', $app_no)
            ->get();
        //  dd($post);
        // $user = User::where('id', Auth::id())->first();
        $user = User::where('id', Auth::id())->first();
        // $articles = DB::table('direct_recruitment')
        //     ->select('*')
        //     ->where('user_id', Auth::id())
        //     ->where('application_no',$app_no)
        //     ->get();
        $articles =DB::table('sport_welfare_registration_master as swrm')
        ->join('direct_recruitment as la', 'swrm.id', '=', 'la.user_id')
        ->join('sport_type as st', 'swrm.sport_type', '=', 'st.id')
        ->select('swrm.fullname','swrm.email','swrm.mobile','swrm.gender','swrm.association_certificate', 'swrm.association_certificate_upload',
        'st.name as sport_name','swrm.place_of_birth','swrm.dob','swrm.nationality',
        'la.achievement_doc','la.religion as religionn','la.category','la.qualification_doc','la.is_editable','la.amount_release','la.amount_release_status','la.form_status','la.application_no','la.domicile_certificate','la.created_at','la.final_submit',
        'swrm.signature_doc','swrm.photograph_doc','swrm.marital_status','swrm.religion','swrm.aadhar_no','swrm.aadhar_doc','swrm.birth_certificate','swrm.father_name','swrm.mother_name','swrm.present_address','swrm.present_state','swrm.present_district','swrm.present_pincode','swrm.permanent_address','swrm.permanent_state','swrm.permanent_district','swrm.permanent_pincode','swrm.present_flat_no','swrm.permanent_flat_no')
        ->where('swrm.id', Auth::id())
        ->where('la.application_no', $app_no)
        ->get();

        $userId = Auth::id();

        $queryData = DB::table('query_master')->where('form_type',6)->where('user_id',$userId)->where('application_no', $app_no)->orderBy('id','DESC')->get();
    //    dd(Auth::user()->application_no);
        $sportAchievement = DB::table('direct_recruitment_sport_achievement')->where('application_no', $app_no)->where('user_id', Auth::id())->get();

        return view('directRecruitment.applicant_preview_form', compact('sportAchievement','user', 'articles', 'post','queryData','app_no'));
    }

    public function updateProfile(Request $req)
    {

        $end = date('d/m/Y', strtotime('-18 years'));




            foreach ($req->post_name as $key => $item) {

                $adv_list = DB::table('advertisment_post_master')->where('id', $item)->first();

                $spo = explode(",", $adv_list->sport_type);
                $sport_type=true;
                    if (in_array($req->sport_type, $spo))
                    {
                        $sport_type=false;
                    }


                // $interval = 42;
                //for category wise post

                //$interval = strtotime($interval);
                $category_post=false;

                if($req->category == 1 && $adv_list->general_post ==0){
                    $category_post=true;
                }
                if($req->category == 2 && $adv_list->obc_post ==0){
                    $category_post=true;
                }
                if($req->category == 3 && $adv_list->sc_post ==0){
                    $category_post=true;
                }
                if($req->category == 4 && $adv_list->st_post ==0){
                    $category_post=true;
                }

                //for age relaxation
                $age_relax=0;
                if($req->category == 2 && $adv_list->age_relax_obc !=0){

                    $age_relax= $adv_list->age_relax_obc;
                }
                if($req->category == 3 && $adv_list->age_relax_sc !=0){

                    $age_relax= $adv_list->age_relax_sc;
                }
                if($req->category == 4 && $adv_list->age_relax_st !=0){

                    $age_relax= $adv_list->age_relax_st;
                }



                // if(($interval < $adv_list->min_age) || ($interval > ($adv_list->max_age + $age_relax) ||  $category_post )){
                    // if( $category_post ){
                    // $chekk=true;
                    // dd($req->all());
                   // return redirect('/direct-recruitment/edit_profile_detail')->withInput()->with('error', "You are not eligible for $adv_list->post_name.");
                //    return response()->json(['error' => true, 'msg' => "On the basis of information submitted, you are ineligible to apply for $adv_list->post_name post. Kindly go on Advertisement page, click on the respective Post name and go through the eligibility criteria given./दर्ज की गई जानकारी के आधार पर, आप इस पद के लिए आवेदन करने हेतु अपात्र हैं। पात्रता मानदंड देखने के लिए कृपया विज्ञापन पृष्ठ पर जाएं एवं संबंधित पद के नाम पर क्लिक करें।"]);
                // }
            };
            // if($chekk){
            //     return response()->json(['error' => true, 'msg' => "You are not eligible for $adv_list->post_name."]);

            // }
        if ($req->domicile_certificate) {
            $domicile_certificate = date('His').$req->domicile_certificate->getClientOriginalName();
            $path = $req->file('domicile_certificate')->storeAs('direct_recruitment', $domicile_certificate, 'public');
        } else {
            $domicile_certificate = $req->domicile_certificate1;
        }

        //
        // if ($req->achievement_doc) {
        //     $achievement_doc = "{$req->achievement_doc->getClientOriginalName()}";
        //     $path = $req->file('achievement_doc')->storeAs('direct_recruitment', $achievement_doc, 'public');
        // } else {
        //     $achievement_doc = $req->achievement_doc1;
        // }
        //
        if ($req->qualification_doc) {
            $qualification_doc = date('His').$req->qualification_doc->getClientOriginalName();
            $path = $req->file('qualification_doc')->storeAs('direct_recruitment', $qualification_doc, 'public');
        } else {
            $qualification_doc = $req->qualification_doc1;
        }

        if ($req->aadhar_card) {
            $aadhar_card = date('His').$req->aadhar_card->getClientOriginalName();
            $path = $req->file('aadhar_card')->storeAs('direct_recruitment', $aadhar_card, 'public');
        } else {
            $aadhar_card = $req->aadhar_card1;
        }
        if ($req->photograph) {
            $photograph = date('His').$req->photograph->getClientOriginalName();
            $path = $req->file('photograph')->storeAs('direct_recruitment', $photograph, 'public');
        } else {
            $photograph = $req->photograph1;
        }

        if ($req->signature) {
            $signature = date('His').$req->signature->getClientOriginalName();
            $path = $req->file('signature')->storeAs('direct_recruitment', $signature, 'public');
        } else {
            $signature = $req->signature1;
        }

        $check = DB::table('direct_recruitment')->where('user_id', Auth::id())->where('application_no', $req->application_no)->update([



            // 'achievement_doc'      => $achievement_doc,
            'domicile_certificate'      => $domicile_certificate,
            'qualification_doc'      => $qualification_doc,
            'category' => $req->category,
                'religion' => $req->religion,

        ]);
        DB::table('applicant_post_master')->where('user_id', Auth::id())->where('application_no', $req->application_no)->delete();
        foreach ($req->post_name as $key => $item) {
            $ch = DB::table('applicant_post_master')->insertGetId(array(
                'user_id' => Auth::id(),
                'application_no' => $req->application_no,
                'post_type' => $req->post_type[$key],
                'post_name' => $req->post_name[$key],
            ));
        };

        if ($ch) {
            $check = DB::table('direct_recruitment')->where('user_id', Auth::id())->where('application_no', $req->application_no)->update(['profile_complete' => 2]);
             DB::table('direct_recruitment')->where('user_id', Auth::id())->where('final_submit',1)->where('application_no', $req->application_no)->update(['is_editable' => 0]);

            session()->flash('success', 'Profile Successfully Updated.');
            return response()->json(["error" => false, "msg" => "Detail Successfully Updated.", "url" => url('/direct-recruitment/formPreview/'.$req->application_no)]);

            // return response()->json(["error" => false, "msg" => "Detail Successfully Updated.", "url" => url('/direct-recruitment/formPreview')]);
            // return redirect('/direct-recruitment/formPreview')->with('success', 'Profile Successfully Updated.');
        } else {
            session()->flash('error', 'Profile Not Updated.');
            // return redirect('/direct-recruitment/edit_profile_detail')->with('error', 'Profile Not Updated.');
            return response()->json(['error' => true, 'msg' => "Profile Not Updated."]);
        }
    }

    public function finalSubmit(Request $req)
    {





       $table = DB::table('isp_common_detail')->where('user_id',Auth::id())->where('email', Auth::user()->email)->where('type', 'DIRECT RECRUITMENT')->whereNull('main_table_id')->update(['main_table_id'=>$req->id]);

       $isp = isp_common_detail(Auth::id(),Auth::user()->email, 'DIRECT RECRUITMENT',$req->id);

       if($isp){



        $url= env('ISP_URl');

        $secretkey = env('ISP_SECRET_KEY');

        $tokenpassword = env('ISP_TOKEN_PASSWORD');
        $dept_id = env('ISP_DEPT_ID');


        $postData = array (
            "username"=>  $dept_id,
            "password"=>  $tokenpassword
        );



        $response = json_decode(getToken( $url.'/ispws/authenticate', json_encode($postData)));

       $token=$response->token;
        $returnServiceStatus = new ReturnServiceStatus();
        $returnServiceStatus->set_applicant_id($isp->applicant_id);
        $returnServiceStatus->set_request_id($isp->request_id);

        $returnServiceStatus->set_service_code($isp->service_code);
        $returnServiceStatus->set_application_id($isp->applicant_id);
        $returnServiceStatus->set_status_code("s104");
        $returnServiceStatus->set_remarks("Application Submitted");
        $returnServiceStatus->set_pendency_level("10");
        $returnServiceStatus->set_action_taken_time( date("Y-m-d h:i:s"));
        $returnServiceStatus->set_pending_with_officer("NA");
        $returnServiceStatus->selected_district_for_processing_application($isp->permanent_district);
        $returnServiceStatus->designated_code("452");
        $returnServiceStatus->designated_location_code(isp_division(Auth::user()->permanent_district));
        $returnServiceStatus->designated_target_date(date('Y-m-d', strtotime("+30 days")));



        $e_data = encryptString(json_encode($returnServiceStatus),$secretkey);

        $finalLoad = array(
            "dept_id"=> $dept_id,
            "e_data"=> $e_data
        );

        $response = callIspWs( $url.'/ispws/isp/v1/returnApplicationAcknowledgement', json_encode($finalLoad),$token );

        $Data_enc= json_decode($response)->data;

        $Data_dsc= json_encode(decryptString($Data_enc,$secretkey));

       };


       if(Auth::user()->registered_from == 2){

        $check = DB::table('position_holder')->where('user_id', Auth::id())->first();

       $url = 'http://164.100.181.28/DeptWebIntService/Service.asmx?op=SendResponse';
       $rKey= $check->RequestKey_edistrict;

       $depId= '5EA45F3FA6BD786D7E1024431E03961D';
       $serviceCode = $check->serviceCode_edistrict;
       $application = $check->application_no;
       $main_xml_str = '<?xml version="1.0" encoding="utf-8"?><soap:Envelope xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xmlns:xsd="http://www.w3.org/2001/XMLSchema" xmlns:soap="http://schemas.xmlsoap.org/soap/envelope/"><soap:Body><SendResponse xmlns="http://tempuri.org/"><RequestKey>'.$rKey.'</RequestKey><DeptRegistraionID>'.$depId.'</DeptRegistraionID><ApplicationNo>'.$application.'</ApplicationNo><serviceCode>'.$serviceCode.'</serviceCode></SendResponse></soap:Body></soap:Envelope>';

       $call_api = call_curlApi($main_xml_str,$url,'Response');

       $xmlStr = preg_replace("/(<\/?)(\w+):([^>]*>)/", "$1$2$3", $call_api);
       $xml = simplexml_load_string($xmlStr);
       $json = json_encode($xml);

       $array = json_decode($json,TRUE);

       $check = $array['soapBody']['SendResponseResponse']['SendResponseResult'];

       $xmlStr = preg_replace("/(<\/?)(\w+):([^>]*>)/", "$1$2$3", $check);
       $xml = simplexml_load_string($xmlStr);
       $json = json_encode($xml);

       $array = json_decode($json,TRUE);

        if($array['ReturnType']!= 1){
            session()->flash('error', 'Technical Issue.');
            return;
        }





      };




        $check = DB::table('direct_recruitment')->where('user_id', Auth::id())->where('application_no', $req->id)->update([
            'final_submit' => 1,'is_editable' => 0,
        ]);
        // StatusChangeLog::dispatch(6,Auth::id(),"","Form Submitted","direct_recruitment");
        // if ($check) {
        //     session()->flash('success', 'Application Successfully Updated.');
        //     return redirect('/dashboard')->with('success', 'Successfully Submitted.');
        // } else {
        //     session()->flash('error', 'Application Not Updated.');
        //     return redirect('/direct-recruitment/formPreview/'.$req->id)->with('error', 'Profile Not Updated.');
        // }
        if($check)
        session()->flash('success', 'Successfully Submitted.');
        return $check;
    }


    //jyoti
    public function postDetail(){
        $data=[];
        $advpostdetails = DB::table('advertisment_post_master')->distinct()
        ->orderBy('id', 'desc')
        ->get(['advertisment_no']);
        foreach ($advpostdetails as $key=>$advpostdetail) {

        $data[$key]['advt']=$advpostdetail->advertisment_no;
         $advposts = DB::table('advertisment_post_master')
         ->where('advertisment_post_master.advertisment_no','=', $advpostdetail->advertisment_no)
         ->get();
         $data[$key]['data']=$advposts;
        }

     return view('directRecruitment.post_detail', compact('advpostdetails','data'));
    }

    public function advertisment_details(Request $req){

        $adv_list = DB::table('advertisment_post_master')->where('post_name', $req->id)->orderBy('id', 'DESC')->first();

         return response()->json(["error" => false,"data"=>$adv_list]);
    }
    public function advertisment_session(Request $req){
        // $chekk=str_replace('_','/',$id);
    //    dd($req->id);
       session()->put('adv_no', $req->id);
       return response()->json(["error" => false, "url" => url('/direct-recruitment/loginForm')]);


    }


}

class ISPApplicantData {

	public $request_id;
	public  $dept_id;
}

 class ISPRequestData {

	public  $dept_id;
	public  $e_data;
}

 class ISPRequestedDataResponse {

	public  $error;
	public  $statusMessage;
	public  $data;
	public  $timestamp;

public function set_data($data) {
    $this->data = $data;
  }
  public function get_data() {
    return $this->data;
  }

  public function set_error($error) {
    $this->error = $error;
  }
  public function get_error() {
    return $this->error;
  }

 public function set_statusMessage($statusMessage) {
    $this->statusMessage = $statusMessage;
  }
  public function get_statusMessage() {
    return $this->statusMessage;
  }

  public function set_timestamp($timestamp) {
    $this->timestamp = $timestamp;
  }
  public function get_timestamp() {
    return $this->timestamp;
  }



}

class ISPRequestIdData{

	public  $request_id;
	public  $applicant_id;
	public  $service_code;
	public  $request_validated;

public function set_request_id($request_id) {
    $this->request_id = $request_id;
  }
  public function get_request_id() {
    return $this->request_id;
  }

  public function set_applicant_id($applicant_id) {
    $this->applicant_id = $applicant_id;
  }
  public function get_applicant_id() {
    return $this->applicant_id;
  }

 public function set_service_code($service_code) {
    $this->service_code = $service_code;
  }
  public function get_service_code() {
    return $this->service_code;
  }





}

class ISPRequestValidate {

	public  $sessionkey;
	public  $dept_id;
}

class ISPResponseApplicantData {

	public  $applicant_id;
	public  $first_name_eng;
	public  $middle_name_eng;
	public  $ast_name_eng;
	public  $first_name_hindi;
	public  $middle_name_hindi;
	public $gender;
	public $father_or_husband_or_guardian_name_eng;
	public $father_or_husband_or_guardian_name_hindi;
	public $mother_name_eng;
	public $mother_name_hindi;
	public $category;
	public $dob;
	public $pan_no;
	public $mobile;
	public $email;
	public $residential_house_no;
	public $residential_mohalla;
	public $residential_state;
	public $residential_post_office;
	public $residential_district;
	public $residential_tehsil;
	public $residential_police_station;
	public $residential_pin;
	public $permanent_house_no;
	public $permanent_mohalla;
	public $permanent_state;
	public $permanent_post_office;
	public $permanent_district;
	public $permanent_tehsil;
	public $permanent_police_station;
	public $permanent_pin;
	public $service_name_eng;
	public $service_name_hindi;
	public $service_code;
	public $family_id;
	public $member_id;
}

class ReturnServiceStatus {

	public $request_id;
	public $applicant_id;
	public $service_code;
	public $application_id;
	public $status_code;
	public $remarks;
	public $pendency_level;
	public $action_taken_time;
	public $pending_with_officer;
	public $d1;
    public $d2;
    public $d3;
    public $d4;
    public $d5;
    public $d6;
    public $d7;
    public $d8;
    public $d9;
    public $d10;
    public $d11;
    public $d12;
    public $d13;
    public $d14;
    public $d15;
    public $d16;
    public $d17;
    public $d18;
    public $d19;
    public $d20;

    public $selected_district_for_processing_application;

    public $designated_code;

    public $designated_location_code;

    public $designated_target_date;



    public function designated_code($designated_code) {
        $this->designated_code = $designated_code;
      }

      public function designated_location_code($designated_location_code) {
        $this->designated_location_code = $designated_location_code;
      }


      public function designated_target_date($designated_target_date) {
        $this->designated_target_date = $designated_target_date;
      }


    public function set_request_id($request_id) {
    $this->request_id = $request_id;
  }
 public function getRequest_id() {
    return $this->request_id;
  }

 public function set_applicant_id($applicant_id) {
    $this->applicant_id = $applicant_id;
  }
  function get_applicant_id() {
    return $this->applicant_id;
  }

public function set_service_code($service_code) {
    $this->service_code = $service_code;
  }
  public function get_service_code() {
    return $this->service_code;
  }

public function set_application_id($application_id) {
    $this->application_id = $application_id;
  }
  public function get_application_id() {
    return $this->application_id;
  }

public function set_status_code($status_code) {
    $this->status_code = $status_code;
  }
  public function get_status_code() {
    return $this->status_code;
  }

public function set_remarks($remarks) {
    $this->remarks = $remarks;
  }
  public function get_remarks() {
    return $this->remarks;
  }

public function set_pendency_level($pendency_level) {
    $this->pendency_level = $pendency_level;
  }
  public function get_pendency_level() {
    return $this->pendency_level;
  }

public function set_action_taken_time($action_taken_time) {
    $this->action_taken_time = $action_taken_time;
  }
  public function get_action_taken_time() {
    return $this->action_taken_time;
  }

public function set_pending_with_officer($pending_with_officer) {
     $this->pending_with_officer = $pending_with_officer;
  }

  public function selected_district_for_processing_application($selected_district_for_processing_application) {
  $this->selected_district_for_processing_application = $selected_district_for_processing_application;
  }


}

class ISPToken {

	public $username;
	public $password;
}

class ISPTokenResponse {

	public $token;
	public $error;
	public $statusMessage;
	public $timestamp;

	public function set_token($token) {
    $this->token = $token;
  }
  public function get_token() {
    return $this->token;
  }

  public function set_error($error) {
    $this->error = $error;
  }
  public function get_error() {
    return $this->error;
  }

 public function set_statusMessage($statusMessage) {
    $this->statusMessage = $statusMessage;
  }
  public function get_statusMessage() {
    return $this->statusMessage;
  }

  public function set_timestamp($timestamp) {
    $this->timestamp = $timestamp;
  }
  public function get_timestamp() {
    return $this->timestamp;
  }

}

