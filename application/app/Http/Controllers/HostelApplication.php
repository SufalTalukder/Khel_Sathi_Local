<?php

namespace App\Http\Controllers;

use App\Models\DivisionModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\HostelBasicDetail;
use App\Models\HostelCommunicationDetail;
use App\Models\HostelPreviewDetail;
use App\Models\HostelQualificationDetail;
use App\Models\HostelRegister;
use App\Models\HostelMaster;
use Illuminate\Support\Facades\Validator;
use App\Models\MarkQuery;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use PDF;
use DateTime;
class HostelApplication extends Controller
{

    public function dashboard (){

        $districts = DB::table('cities')->where('state_id', '23')->get();
        $status = Auth::guard('hostel')->user()->change_password_status;
        $userDetails = Auth::guard('hostel')->user();

        $sportList = array();
        if(Auth::guard('hostel')->user()->applicationBasicDetasils){

    }

        if($status == 0){
            return redirect()->route('hostel.changePassword');
        }

        $trialInfo = null;
        $commDetails = $userDetails->applicationCommunicationDetails;
        if ($commDetails && $commDetails->p_district_id) {
            $divisionId = DB::table('hostel_div_district_mapping')
                ->where('district_id', $commDetails->p_district_id)
                ->value('division_id');
            $trialInfo = $this->getTrialVenueByDivision($divisionId);
        }

        if (($userDetails->query_status == 1 && $userDetails->level != 4)|| ($userDetails->query_mark == 2 && $userDetails->level == 4)){
            return view('hostel_auth.dashboard',compact('userDetails', 'sportList','districts', 'trialInfo'));


        }elseif($userDetails->level != "4"){
            return redirect()->route('hostel.applicationForm');
        }


        return view('hostel_auth.dashboard',compact('userDetails', 'sportList','districts', 'trialInfo'));
    }

    private function getTrialVenueByDivision($divisionId)
    {
        $map = [
            // Devipatan, Ayodhya, Basti
            30 => ['venue' => 'Dr. Ambedkar Stadium, Dhabha Semar, Ayodhya', 'venue_hi' => 'डॉ0 अम्बेडकर स्टेडियम, डाभासेमर, अयोध्या', 'date_from' => '12-05-2026', 'date_to' => '13-05-2026', 'time' => '7:00 AM'],
            25 => ['venue' => 'Dr. Ambedkar Stadium, Dhabha Semar, Ayodhya', 'venue_hi' => 'डॉ0 अम्बेडकर स्टेडियम, डाभासेमर, अयोध्या', 'date_from' => '12-05-2026', 'date_to' => '13-05-2026', 'time' => '7:00 AM'],
            28 => ['venue' => 'Dr. Ambedkar Stadium, Dhabha Semar, Ayodhya', 'venue_hi' => 'डॉ0 अम्बेडकर स्टेडियम, डाभासेमर, अयोध्या', 'date_from' => '12-05-2026', 'date_to' => '13-05-2026', 'time' => '7:00 AM'],
            // Meerut, Saharanpur
            35 => ['venue' => 'Dr. Ambedkar Stadium, Near Gandhi Park, Saharanpur', 'venue_hi' => 'डॉ0 अम्बेडकर स्टेडियम, निकट गांधी पार्क, सहारनपुर', 'date_from' => '12-05-2026', 'date_to' => '13-05-2026', 'time' => '7:00 AM'],
            39 => ['venue' => 'Dr. Ambedkar Stadium, Near Gandhi Park, Saharanpur', 'venue_hi' => 'डॉ0 अम्बेडकर स्टेडियम, निकट गांधी पार्क, सहारनपुर', 'date_from' => '12-05-2026', 'date_to' => '13-05-2026', 'time' => '7:00 AM'],
            // Gorakhpur, Azamgarh
            31 => ['venue' => 'Sports College, Gorakhpur', 'venue_hi' => 'स्पोर्ट्स कॉलेज, गोरखपुर', 'date_from' => '15-05-2026', 'date_to' => '16-05-2026', 'time' => '7:00 AM'],
            26 => ['venue' => 'Sports College, Gorakhpur', 'venue_hi' => 'स्पोर्ट्स कॉलेज, गोरखपुर', 'date_from' => '15-05-2026', 'date_to' => '16-05-2026', 'time' => '7:00 AM'],
            // Moradabad, Bareilly
            37 => ['venue' => 'Subhash Chandra Bose Stadium, Moradabad', 'venue_hi' => 'सुभाष चंद्र बोस स्टेडियम, मुरादाबाद', 'date_from' => '15-05-2026', 'date_to' => '16-05-2026', 'time' => '7:00 AM'],
            27 => ['venue' => 'Subhash Chandra Bose Stadium, Moradabad', 'venue_hi' => 'सुभाष चंद्र बोस स्टेडियम, मुरादाबाद', 'date_from' => '15-05-2026', 'date_to' => '16-05-2026', 'time' => '7:00 AM'],
            // Varanasi, Mirzapur
            40 => ['venue' => 'Dr. Ambedkar Stadium, Lalpur, Varanasi', 'venue_hi' => 'डॉ0 अम्बेडकर स्टेडियम, लालपुर, वाराणसी', 'date_from' => '18-05-2026', 'date_to' => '19-05-2026', 'time' => '7:00 AM'],
            36 => ['venue' => 'Dr. Ambedkar Stadium, Lalpur, Varanasi', 'venue_hi' => 'डॉ0 अम्बेडकर स्टेडियम, लालपुर, वाराणसी', 'date_from' => '18-05-2026', 'date_to' => '19-05-2026', 'time' => '7:00 AM'],
            // Lucknow, Kanpur
            34 => ['venue' => 'Sports College, Lucknow', 'venue_hi' => 'स्पोर्ट्स कॉलेज, लखनऊ', 'date_from' => '18-05-2026', 'date_to' => '19-05-2026', 'time' => '7:00 AM'],
            33 => ['venue' => 'Sports College, Lucknow', 'venue_hi' => 'स्पोर्ट्स कॉलेज, लखनऊ', 'date_from' => '18-05-2026', 'date_to' => '19-05-2026', 'time' => '7:00 AM'],
            // Prayagraj, Chitrakoot
            38 => ['venue' => 'M. M. Malviya Stadium and Mayo Hall, Prayagraj', 'venue_hi' => 'म0 म0 मालवीय स्टेडियम व मेयो हाल, प्रयागराज', 'date_from' => '21-05-2026', 'date_to' => '22-05-2026', 'time' => '7:00 AM'],
            29 => ['venue' => 'M. M. Malviya Stadium and Mayo Hall, Prayagraj', 'venue_hi' => 'म0 म0 मालवीय स्टेडियम व मेयो हाल, प्रयागराज', 'date_from' => '21-05-2026', 'date_to' => '22-05-2026', 'time' => '7:00 AM'],
            // Agra, Aligarh, Jhansi
            18 => ['venue' => 'Eklavya Sports Stadium, Agra', 'venue_hi' => 'एकलव्य स्पोर्ट्स स्टेडियम, आगरा', 'date_from' => '21-05-2026', 'date_to' => '22-05-2026', 'time' => '7:00 AM'],
            24 => ['venue' => 'Eklavya Sports Stadium, Agra', 'venue_hi' => 'एकलव्य स्पोर्ट्स स्टेडियम, आगरा', 'date_from' => '21-05-2026', 'date_to' => '22-05-2026', 'time' => '7:00 AM'],
            32 => ['venue' => 'Eklavya Sports Stadium, Agra', 'venue_hi' => 'एकलव्य स्पोर्ट्स स्टेडियम, आगरा', 'date_from' => '21-05-2026', 'date_to' => '22-05-2026', 'time' => '7:00 AM'],
        ];
        return $map[$divisionId] ?? null;
    }




    public function applicationForm(){

        $status = Auth::guard('hostel')->user()->change_password_status;

        $districts = DB::table('cities')->where('state_id', '23')->get();

        $districtAll = DB::table('cities')->orderBy('city')->get();

        $stateAll = DB::table('states')->where('country_id', '105')->get();

        $regions = DB::table('region_sport_office')->get();
        $date1 =new \DateTime(Auth::guard('hostel')->user()->dob);
        $date2 = new \DateTime(config('app.session_year') . "-04-01");
        $interval = ($date1->diff($date2))->y;

        if ($interval > 15 || $interval < 8) {
            Auth::guard('hostel')->logout();
            return redirect()->route('hostel.login')->with('error', 'You are not eligible for this session (Age must be 8-15 years as on 1st April).');
        }

        $gender = Auth::guard('hostel')->user()->gender;
        $currentTime = date('H:i');
        $currentDate = date('Y-m-d');

        // Male deadline: Today (March 25th) at 1:30 PM - Already past
        $isPastMaleDeadline = ($currentDate >= '2026-03-25' && ($currentDate > '2026-03-25' || $currentTime >= '13:30'));
        
        // Female deadline: Tomorrow (March 26th) at 1:30 PM
        $isPastFemaleDeadline = ($currentDate >= '2026-03-26' && ($currentDate > '2026-03-26' || $currentTime >= '13:30'));
        
        // Female allowed sports: None (Closed)
        $femaleAllowedSports = [];

        if ($gender == 1) { // Male
            $sports = collect(); // Male forms are resolved and should remain unavailable
        } else { // Female
            if ($isPastFemaleDeadline) {
                $sports = collect(); // No sports available for female after deadline (Tomorrow 1:30 PM)
            } else {
                $sports = DB::table('sport_master')->whereIn('id', $femaleAllowedSports)->where('status', 1)->orderBy('name')->get();
            }
        }
        // $sports = DB::table('sport_type')->orderBy('name')->get();

        $userDetails = Auth::guard('hostel')->user();
        $mark_query = MarkQuery::where('form_type', 7)->where('user_id', $userDetails->id)->get();
        $sportList = array();

        if(Auth::guard('hostel')->user()->applicationBasicDetasils){


    }


        if($status == 0){
            return redirect()->route('hostel.changePassword');
        }


        return view('hostel_auth.application_form' ,compact('districts', 'regions', 'sports', 'userDetails', 'stateAll' , 'districtAll', 'sportList' ,'mark_query'));
    }

    public function applicationbasicForm(Request $request){

        $gender = Auth::guard('hostel')->user()->gender;
        $currentTime = date('H:i');
        $currentDate = date('Y-m-d');
        
        $isPastMaleDeadline = ($currentDate >= '2026-03-25' && ($currentDate > '2026-03-25' || $currentTime >= '13:30'));
        $isPastFemaleDeadline = ($currentDate >= '2026-03-26' && ($currentDate > '2026-03-26' || $currentTime >= '13:30'));
        
        $femaleAllowedSports = [];

        if($gender == 1){
            return redirect()->back()->with('error', 'Admission for Male category is closed.');
        }

        if($gender == 2){
            if($isPastFemaleDeadline){
                return redirect()->back()->with('error', 'Admission for Female category is closed.');
            }
            if(!in_array($request->sports, $femaleAllowedSports)){
                return redirect()->back()->with('error', 'Admission for this sport is closed.');
            }
        }

        $request->validate([
            'sports' => 'required',
            'father_name' => 'required',
            'mother_name' => 'required',
            'height' => 'required',
            'weight' => 'required',
        
            'identification_mark' => 'required',
        
            'disease' => 'required'
        ]);

        $date1 = new \DateTime(Auth::guard('hostel')->user()->dob);
        $date2 = new \DateTime(config('app.session_year') . "-04-01");
        $interval = ($date1->diff($date2))->y;

        if ($interval > 15 || $interval < 8) {
            Auth::guard('hostel')->logout();
            return redirect()->route('hostel.login')->with('error', 'You are not eligible for this session (Age must be 8-15 years as on 1st April).');
        }


        $data = [
            'hostel_register_id' => Auth::guard('hostel')->user()->id,
            'district_id' => $request->district_id,
            'region_sport_office_id' => $request->region_sport_office_id,
            'sports' => $request->sports,
            'category' => $request->category,
            'sub_category' => $request->sub_category,
            'father_name' => $request->father_name,
            'father_occuption' => $request->father_occuption,
            'mother_name' => $request->mother_name,
            'mother_occuption' => $request->mother_occuption,
            'height' => $request->height,
            'weight' => $request->weight,
            'blood_group' => $request->blood_group,
            'class_for_which_admission' => $request->class_for_which_admission,
            'identification_mark' => $request->identification_mark,
            'number_of_teeth' => $request->number_of_teeth,
            'disease' => $request->disease,
            'sports_college' => $request->sports_college,
        ];

        if($request->sub_type){
            $data['sub_sport_type']= $request->sub_type;
        }else{
            $data['sub_sport_type']=null;
        }

        $userhostelBasic = HostelBasicDetail::where('hostel_register_id' , Auth::guard('hostel')->user()->id)->first();

        if($request->disease == 'Yes'){
            if($request->file('medical_certificate_file')) {

                $request->validate([
                    'medical_certificate_file' => 'required|max:2048',
                ]);

            if($userhostelBasic!= "" ){
                if(File::exists(public_path('hostelapplicant/medical_certificate_file/'.$userhostelBasic->medical_certificate_file))) {
                    File::delete(public_path('hostelapplicant/medical_certificate_file/'.$userhostelBasic->medical_certificate_file));
                   }
            }

                $file = $request->file('medical_certificate_file');
                $file_path = time().$file->getClientOriginalName();
                $file->move(public_path('hostelapplicant/medical_certificate_file'), $file_path);
                $data['medical_certificate_file'] = $file_path;
            }
        }else{
            $data['medical_certificate_file'] = "";
        }





        if($request->existing_student == 1){

            $data['roll_no'] = $request->roll_no;
            $data['admission_no'] = $request->admission_no;


                $user = Auth::guard('hostel')->user();

                $user->existing_student = '1';

                $user->save();



            if($request->file('student_id_card')) {

                $request->validate([
                    'student_id_card' => 'required|max:2048',
                ]);

            if($userhostelBasic!= "" ){
                if(File::exists(public_path('hostelapplicant/student_id_card/'.$userhostelBasic->student_id_card))) {
                    File::delete(public_path('hostelapplicant/student_id_card/'.$userhostelBasic->student_id_card));
                   }
            }

                $file = $request->file('student_id_card');
                $file_path = time().$file->getClientOriginalName();
                $file->move(public_path('hostelapplicant/student_id_card'), $file_path);
                $data['student_id_card'] = $file_path;
            }



            if($request->file('national_champtionship_document')) {

                $request->validate([
                    'national_champtionship_document' => 'required|max:2048',
                ]);

            if($userhostelBasic!= "" ){
                if(File::exists(public_path('hostelapplicant/national_champtionship_document/'.$userhostelBasic->national_champtionship_document))) {
                    File::delete(public_path('hostelapplicant/national_champtionship_document/'.$userhostelBasic->national_champtionship_document));
                   }
            }

                $file = $request->file('national_champtionship_document');
                $file_path = time().$file->getClientOriginalName();
                $file->move(public_path('hostelapplicant/national_champtionship_document'), $file_path);
                $data['national_champtionship_document'] = $file_path;
            }









        }else{

            $user = Auth::guard('hostel')->user();

            $user->existing_student = '2';

            $user->save();

            $data['student_id_card'] = "";
            $data['roll_no'] = "";
            $data['admission_no'] = "";
            $data['national_champtionship_document'] = "";
        }



        if($request->file('applicant_domicle')) {

            $request->validate([
                'applicant_domicle' => 'required|required|max:2048',
            ]);
            if($userhostelBasic!= "" ){
                if( File::exists(public_path('hostelapplicant/applicant_domicle/'.$userhostelBasic->applicant_domicle))) {
                    File::delete(public_path('hostelapplicant/applicant_domicle/'.$userhostelBasic->applicant_domicle));
                   }
            }


            $file = $request->file('applicant_domicle');
            $file_path = time().$file->getClientOriginalName();
            $file->move(public_path('hostelapplicant/applicant_domicle'), $file_path);
            $data['applicant_domicle'] = $file_path;
        }



        if($request->file('applicant_dob_certificate')) {

            $request->validate([
                'applicant_dob_certificate' => 'required|required|max:2048',
            ]);
            if($userhostelBasic!= "" ){
                if( File::exists(public_path('hostelapplicant/applicant_dob_certificate/'.$userhostelBasic->applicant_dob_certificate))) {
                    File::delete(public_path('hostelapplicant/applicant_dob_certificate/'.$userhostelBasic->applicant_dob_certificate));
                   }
            }


            $file = $request->file('applicant_dob_certificate');
            $file_path = time().$file->getClientOriginalName();
            $file->move(public_path('hostelapplicant/applicant_dob_certificate'), $file_path);
            $data['applicant_dob_certificate'] = $file_path;
        }


        if($request->file('applicant_sign')) {

            $request->validate([
                'applicant_sign' => 'required|max:2048',
            ]);

               if($userhostelBasic!= "" ){
                if(File::exists(public_path('hostelapplicant/applicant_sign/'.$userhostelBasic->applicant_sign))) {
                    File::delete(public_path('hostelapplicant/applicant_sign/'.$userhostelBasic->applicant_sign));
                 }

            }

            $file = $request->file('applicant_sign');
            $file_path = time().$file->getClientOriginalName();
            $file->move(public_path('hostelapplicant/applicant_sign'), $file_path);
            $data['applicant_sign'] = $file_path;
        }


        if($request->file('applicant_file')) {

            $request->validate([
                'applicant_file' => 'required|max:2048',
            ]);

            if($userhostelBasic!= "" ){

            if(File::exists(public_path('hostelapplicant/applicant_file/'.$userhostelBasic->applicant_file))) {
                File::delete(public_path('hostelapplicant/applicant_file/'.$userhostelBasic->applicant_file));
               }

            }

            $file = $request->file('applicant_file');
            $file_path = time().$file->getClientOriginalName();
            $file->move(public_path('hostelapplicant/applicant_file'), $file_path);
            $data['applicant_file'] = $file_path;
        }


        if($request->file('aadhar_card_file')) {

            $request->validate([
                'aadhar_card_file' => 'required|max:2048',
            ]);

            if($userhostelBasic!= "" ){


            if(File::exists(public_path('hostelapplicant/aadhar_card_file/'.$userhostelBasic->aadhar_card_file))) {
                File::delete(public_path('hostelapplicant/aadhar_card_file/'.$userhostelBasic->aadhar_card_file));
               }

                }


            $file = $request->file('aadhar_card_file');
            $file_path = time().$file->getClientOriginalName();
            $file->move(public_path('hostelapplicant/aadhar_card_file'), $file_path);
            $data['aadhar_card_file'] = $file_path;
        }


          if($userhostelBasic == ""){
           HostelBasicDetail::create($data);
           $user = Auth::guard('hostel')->user();

           $user->level = '1';
           $user->save();


           $msg = 'Your Basic Information saved  successfully';
          }else{
            $userhostelBasic->update($data);

            $msg = 'Your Basic Information updated successfully';
          }
          session()->put('form_no', 1);
        return redirect()->back()->with('success', $msg)->with('form_open', '2');


    }


    public function applicationCommunicationForm(Request $request){


        $request->validate([
            'p_gram_mohalla'  => 'required',
            'c_gram_mohalla'  => 'required',
            'p_post'  => 'required',
            'c_post'  => 'required',
            'p_thana'  => 'required',
            'c_thana'  => 'required',
            'p_state_id'  => 'required',
            'c_state_id'  => 'required',
            'p_district_id'  => 'required',
            'c_district_id'  => 'required',
            'p_mobile'  => 'required',
            'c_mobile'  => 'required',
            'p_alt_mobile'=> 'different:p_mobile',
            'c_alt_mobile'=> 'different:c_mobile',

            'c_pin'=>'required|numeric',
            'p_pin'=>'required|numeric'
        ],[
            'p_alt_mobile.different' => 'Permanent Mobile No. and Alternate Mobile No. should not be same.' ,
            'c_alt_mobile.different' => 'Correspondence Mobile No. and Alternate Mobile No. should not be same.' ,
        ]);






        $data = [
            'hostel_register_id' => Auth::guard('hostel')->user()->id,
            'p_gram_mohalla'  => $request->p_gram_mohalla,
            'c_gram_mohalla'  => $request->c_gram_mohalla,
            'p_post'  => $request->p_post,
            'c_post'  => $request->c_post,
            'p_thana'  => $request->p_thana,
            'c_thana'  => $request->c_thana,
            'p_state_id'  => $request->p_state_id,
            'c_state_id'  => $request->c_state_id,
            'p_district_id'  => $request->p_district_id,
            'c_district_id'  => $request->c_district_id,
            'p_mobile'  => $request->p_mobile,
            'c_mobile'  => $request->c_mobile,
            'p_alt_mobile'=> $request->p_alt_mobile,
            'c_alt_mobile'=> $request->c_alt_mobile,
            'c_email'=>$request->c_email,
            'p_email'=>$request->p_email,
            'c_pin'=>$request->c_pin,
            'p_pin'=>$request->p_pin
        ];




        $userhostelcommunication = HostelCommunicationDetail::where('hostel_register_id' , Auth::guard('hostel')->user()->id)->first();

        if($userhostelcommunication == ""){
            HostelCommunicationDetail::create($data);
            $user = Auth::guard('hostel')->user();

            $user->level = '2';
            $user->save();

            $msg = 'Communication Detail saved successfully';
           }else{

            $userhostelcommunication->update($data);

             $msg = 'Your Basic Information updated successfully';
           }
           session()->put('form_no', 2);
         return redirect()->back()->with('success', $msg)->with('form_open', '3');

    }



    public function applicationQualicationForm(Request $request){


        $request->validate([

            'class'=>'required',
            'school_college'=>'required',
            'passing_year'=>'required',
            'obtain_mark'=>'required',
            'total_mark'=>'required|gte:obtain_mark',
            'result'=>'required',
        ]);


        $data = [
        'hostel_register_id' => Auth::guard('hostel')->user()->id,
        'class' => $request->class,
        'school_college' => $request->school_college,
        'passing_year' => $request->passing_year,
        'obtain_mark' => $request->obtain_mark,
        'total_mark' => $request->total_mark,
        'result'=>$request->result,
        ];






        $userhostelqualification = HostelQualificationDetail::where('hostel_register_id' , Auth::guard('hostel')->user()->id)->first();

        if(!$userhostelqualification){
            HostelQualificationDetail::create($data);
            $user = Auth::guard('hostel')->user();

            $user->level = '3';
            $user->save();

            $msg = 'Qualification Detail Saved  successfully';
           }else{

            $userhostelqualification->update($data);

             $msg = 'Your Basic Information updated successfully';
           }

           session()->put('form_no', 3);

         return redirect()->back()->with('success', $msg)->with('form_open', '4');

    }


    public function applicationPreviewForm(Request $request){


        $request->validate([
            'confirm'=>'required',
            'guardian_name'=>'required',

        ]);

        $data = [
            'hostel_register_id' => Auth::guard('hostel')->user()->id,
            'confirm'=>$request->confirm,
            'guardian_name'=>$request->guardian_name,

            ];






        $userhostelpreview = HostelPreviewDetail::where('hostel_register_id' , Auth::guard('hostel')->user()->id)->first();


         if($request->file('guardian_sign')) {

            $request->validate([
                'guardian_sign' => 'required|mimes:jpeg,jpg|required|max:2048',
            ]);

            if($userhostelpreview != "" ){
                if(File::exists(public_path('hostelapplicant/guardian_sign/'.$userhostelpreview->guardian_sign))) {
                    File::delete(public_path('hostelapplicant/guardian_sign/'.$userhostelpreview->guardian_sign));
                   }
            }


            $file = $request->file('guardian_sign');
            $file_path = time().$file->getClientOriginalName();
            $file->move(public_path('hostelapplicant/guardian_sign'), $file_path);
            $data['guardian_sign'] = $file_path;

        }





        if($userhostelpreview == ""){
            $user = Auth::guard('hostel')->user();
            if ($user && $user->created_at < (config('app.session_year') . '-01-22')) {
                return redirect()->back()->with('success', 'Not Eligible for this year. Register Again');
            };

            HostelPreviewDetail::create($data);


            $user->level = '4';
            $num =$user->id;
            $num_padded =   date('Y').sprintf("%06d", $num);
            $user->application_no =  $num_padded;
            $user->unique_chalan_no =  date('y').sprintf("%08d", $num);
            $user->payment_status = '1';
            $user->save();


            $msg = 'Application FInal Submit Successfully';



            return redirect()->route('hostel_payment_request');
           }else{




          $userhostelpreview->update($data);
             $msg = 'Application FInal Submit Successfully';
           }

           if(Auth::guard('hostel')->user()->query_status == 1){

            $user = Auth::guard('hostel')->user();

            $user->level = '4';
            $user->query_status = '2';
            $user->save();

          }

           return redirect()->back()->with('success', $msg)->with('form_open', '4');


    }



    public function getDistrict($state_id){
        $districts = DB::table('cities')->where('state_id', $state_id)->get();


        return json_encode($districts);
    }



    public function applicationView(){
        return redirect()->route('hostel.applicationForm')->with('form_open', '4');
    }



    public function hostelList($id=null){
        $division=DB::table('hostel_division_master')->get();

   

       $check = DB::table('hostel_div_district_mapping')
       ->select(DB::raw('group_concat(district_id) as district_id'))->where( 'division_id', Auth::guard('admin')->user()->division_id)->get();
        $districts = DB::table('cities')->where('state_id', 23);

        if(Auth::guard('admin')->user()->division_id){

           $districts->whereIn( 'id',explode(',',$check[0]->district_id));
       }


       $districts=   $districts->orderBy('city', 'asc')->get();



        $hostelList =  DB::table('hostel_register as rg')
        ->join('hostel_application_basic as basic', 'rg.id', '=', 'basic.hostel_register_id')
        // ->join('rajkosh_payment_request', 'rajkosh_payment_request.application_no', '=', 'rg.application_no')
        // ->join('rajkosh_payment_response', 'rajkosh_payment_response.challan_no', '=', 'rajkosh_payment_request.Depchallan')
     
       ->select('rg.*','basic.sports', 'basic.district_id','basic.sub_sport_type')

        ->whereIn('rg.payment_status', [1,2]);






        if(Auth::guard('admin')->user()->division_id > 0){

            $hostelList->whereIn( 'basic.district_id',explode(',',$check[0]->district_id));
        }

        if(Auth::guard('admin')->user()->district_id > 0){

            $hostelList->where( 'basic.district_id',Auth::guard('admin')->user()->district_id);
        }
        if($id && ($id == 1 || $id == 2 || $id == 3)){
            $hostelList->where( 'rg.status',$id);
        }


        $hostelList=  $hostelList->where('rg.session_year', config('app.session_year'))->groupBy('rg.id')->get();
        // $userDetails->payment_status                 

        $divisions = DB::table('hostel_division_master')->orderBy('division_name')->get();

       $sports = DB::table('sport_master')->orderBy('name')->get();

        return view('rso.dashboard.hostel_application', compact('hostelList', 'sports', 'districts','divisions'));
    }


    public function hostelView($id){

        $userDetails = HostelRegister::find($id);
        $sportList = array();

    $mark_query = MarkQuery::where('form_type', 7)->where('user_id',$id)->get();
    $closed = MarkQuery::where('form_type', 7)->where('user_id',$id)->where('is_closed', 0)->first();
    return view('rso.dashboard.hostel_application_view', compact('userDetails','sportList' , 'mark_query' , 'closed'));

}

     public function filterHostel( Request $request){

        session()->put('filter_hostel', $request->all());

      // $hostelList = HostelRegister::where('level', 4)->with('applicationBasicDetasils')->where('sports', $request->sports)->latest()->get();
      $division=DB::table('hostel_division_master')->get();
      $check = DB::table('hostel_div_district_mapping')
      ->select(DB::raw('group_concat(district_id) as district_id'))->where( 'division_id', Auth::guard('admin')->user()->division_id)->get();
       $districts = DB::table('cities')->where('state_id', 23);

      if(Auth::guard('admin')->user()->division_id){
         $districts->whereIn( 'id',explode(',',$check[0]->district_id));
      }

       $districts=   $districts->orderBy('city', 'asc')->get();
       $hostelList =  DB::table('hostel_register as rg')
        ->join('hostel_application_basic as basic', 'rg.id', '=', 'basic.hostel_register_id')
        ->select('rg.*','basic.sports','basic.sub_sport_type', 'basic.district_id');
       if ($request->sport_id){
           $hostelList->where( 'basic.sports', $request->sport_id);
       }

       if ($request->subsport){
            $hostelList->where( 'basic.sub_sport_type', $request->subsport);
       }
       if ($request->city_filter){
            $hostelList->where( 'basic.district_id',$request->city_filter);
       }
       if ($request->status_filter){
         $hostelList->where( 'rg.status',$request->status_filter);
       }
       if ($request->district_trial){
        $hostelList->where( 'rg.trial_one',$request->district_trial);
      }
      if ($request->division_trial){
        $hostelList->where( 'rg.trial_two',$request->division_trial);
      }
      if ($request->state_trial){
        $hostelList->where( 'rg.trial_three',$request->state_trial);
      }
      if ($request->gender){
        $hostelList->where( 'rg.gender',$request->gender);
      }






      if ($request->cancelled == 1){
        $hostelList->where( 'rg.cancel_status',$request->cancelled);
      }else{
        $hostelList->whereNull( 'rg.cancel_status');
      }
      $hostelList->whereIn('rg.payment_status', [1,2]);
      if ($request->payment_status == 1){
        $hostelList->where( 'rg.payment_status',$request->payment_status);
      }elseif($request->payment_status == 2){
        $hostelList->where( 'rg.payment_status',$request->payment_status);
    }elseif($request->payment_status == 3){
        $hostelList->where( 'rg.payment_status',3);
      }

      if ($request->existing_student == 1){
        $hostelList->where( 'rg.existing_student',$request->existing_student);
      }



       if(Auth::guard('admin')->user()->division_id > 0){
          $hostelList->whereIn( 'basic.district_id',explode(',',$check[0]->district_id));
       }

       if(Auth::guard('admin')->user()->district_id > 0){
          $hostelList->where( 'basic.district_id',Auth::guard('admin')->user()->district_id);
       }

     

       if ($request->session_year) {
        $hostelList->where('rg.session_year', (string) $request->session_year);
    } else {
        $hostelList->where('rg.session_year', config('app.session_year'));
    }

      $hostelList=   $hostelList->groupBy('rg.id')->get();
       $sports = DB::table('sport_master')->orderBy('name')->get();
       $divisions = DB::table('hostel_division_master')->orderBy('division_name')->get();



       return view('rso.dashboard.hostel_application', compact('hostelList', 'sports', 'districts', 'divisions'));

     }


     public function mark_query_hostel(Request $request){

        $fileName = '';
        if ($request->hasFile('query_doc')){
            $fileName = moveFile('queryDoc', $request->query_doc);
        }



        $hostelUser = HostelRegister::find($request->formID);


        $hostelUser->update([
           'query_status' => 1,
           'level' => 3,


        ]);

        $userId = $request->formID;

        $rsoId  = Auth::guard('admin')->user()->id;


        DB::table('query_master')->insert(array(
            'form_type'     => $request->formType,
            'ticket_number' => $rsoId . date('mdhis'),
            'user_id'       => $userId,
            'rso_id'        => $rsoId,
            'query_details' => $request->is_mark_query,
            'query_subject' => $request->query_subject,
            'query_doc'     => $fileName,
        ));



        return redirect()->route('hostelView', $userId )->with('msg', 'Query Mark Successfully');

     }



     public function query_hostel_reply_admin(Request $request){

        $fileName = '';
        if ($request->hasFile('query_doc'))
            $fileName = moveFile('queryDoc', $request->query_doc);

        $queryId = $request->queryIdReply;

        $repliedBy    = Auth::guard('admin')->user()->id;




        $typename= Auth::guard('admin')->user()->name;

        $data = [
            'query_id'      => $queryId,
            'reply'         => $request->is_mark_query_reply,
            'reply_doc'     => $fileName,
            'replied_by'      =>  $repliedBy,
            'reply_to'      => $request->queryReplyTo,
            'reply_type'      => 1,
        ];

        DB::table('query_reply_detail')->insert($data);

        DB::table('query_master')->where('id', $queryId)->update(["query_status" => 1,"current_status"=>$typename]);


        return redirect()->route('hostelView', $request->queryReplyTo)->with('msg', 'Query Mark Successfully');

     }




     public function query_hostel_reply_user(Request $request){

        $fileName = '';
        if ($request->hasFile('query_doc'))
            $fileName = moveFile('queryDoc', $request->query_doc);

        $queryId = $request->queryIdReply;
        $queryMaster = DB::table('query_master')->where('id', $queryId)->first();
        $repliedBy    = Auth::guard('hostel')->user()->id;
        $replyTo      = $queryMaster->rso_id;



        $typename= Auth::guard('hostel')->user()->name;

        $data = [
            'query_id'      => $queryId,
            'reply'         => $request->is_mark_query_reply,
            'reply_doc'     => $fileName,
            'replied_by'      =>  $repliedBy,
            'reply_to'      =>$replyTo,
            'reply_type'      => 2,
        ];

        DB::table('query_reply_detail')->insert($data);

        DB::table('query_master')->where('id', $queryId)->update(["query_status" => 0,"current_status"=>$typename]);


        return redirect()->route('hostel.applicationForm')->with('form_open', '4');
     }



     public function hostel_accept(Request $request){


        $hostelUser = HostelRegister::find($request->user_id);


        $hostelUser->update([
           'status' => 1,

           'level'=> 4,
           'query_status'=> 2,

           'trial_one' => 1,
           'remark' => $request->remark
        ]);

        return redirect()->route('hostelView', $request->user_id)->with('msg', 'Accepted Successfully');


     }



     public function hostel_reject(Request $request){


        $hostelUser = HostelRegister::find($request->user_id);


        $hostelUser->update([
           'status' => 2,
           'remark' => $request->remark
        ]);

        return redirect()->route('hostelView', $request->user_id)->with('success', 'Rejected Successfully');


     }




     public function queryClosed($id)
     {

         $status = array('is_closed' => 1, 'closeing_date' => date("Y-m-d"));

         DB::table('query_master')->where('id', $id)->update($status);

         return redirect()->back()->with('success', 'Query Closed Successfully');
     }




     public function hostel_list(){
        session()->put('filter_hostel','');
        $districts = DB::table('cities')->where('state_id', '23')->orderBy('city')->get();
        $hostels = DB::table('hostel_master')->orderBy('hostel_name')->get();

        $sports =DB::table('sport_master')->orderBy('name')->get();
        return view('rso.dashboard.hostel_list', compact('districts', 'sports', 'hostels'));
     }

     public function hostel_list_filter(Request $request){

        session()->put('filter_hostel', $request->all());


        $districts = DB::table('cities')->where('state_id', '23')->orderBy('city')->get();

        if($request->district_id && !$request->sport_id){

            $hostels = DB::table('hostel_master')->where('districts', $request->district_id)->orderBy('hostel_name')->get();

        }elseif(!$request->district_id && $request->sport_id){

            $hostels = DB::table('hostel_master')->whereRaw('FIND_IN_SET("'.$request->sport_id.'", sports)')->orderBy('hostel_name')->get();
        }elseif($request->district_id && $request->sport_id){

            $hostels = DB::table('hostel_master')->whereRaw('FIND_IN_SET("'.$request->sport_id.'", sports) ')->Where('districts', $request->district_id)->orderBy('hostel_name')->get();
        }else{
            $hostels = DB::table('hostel_master')->orderBy('hostel_name')->get();
        }

        $sports = DB::table('sport_master')->orderBy('name')->get();

        return view('rso.dashboard.hostel_list', compact('districts', 'sports', 'hostels'));

     }



     public function hostelFilter(Request $request){


        $queryData = HostelRegister::find($request->user_id);

        $gender = $queryData->gender;
        $sports= $queryData->applicationBasicDetasils->sports;

        $integerIDs = array_map('intval', $sports);
        $sportList = array();
        $a = '';
        if($gender == 1){
            for($i=0 ; $i<count($sports); $i++){
                $a .= "FIND_IN_SET($sports[$i] ,sports) or ";

               };
              // $hostels = DB::select('SELECT * FROM `hostel_master` where (boys!= boys_alloted and find_in_set(5,sports) or find_in_set(24,sports)');
             $hostels = DB::table('hostel_master')->whereRaw( chop($a," or ") )->get();

             foreach ($hostels as $key => $value) {
                if($value->boys != $value->boys_alloted){
                    $sportList[$key]= $value;
                }

             };

        }else{
            for($i=0 ; $i<count($sports); $i++){
                $a .= "FIND_IN_SET($sports[$i] ,sports) or ";

               };



               $hostels = DB::table('hostel_master')->whereRaw( chop($a," or ") )->get();
             foreach ($hostels as $key => $value) {
                if($value->girls != $value->girls_alloted){
                    $sportList[$key]= $value;
               }
             };
       }

       return json_encode($sportList);
     }



     public function hostel_allot(Request $request){

   $validation = Validator::make($request->all(), [
            'hostel_id' => 'required',

        ],     $message = [
            'hostel_id.required' => 'Please Select Hostel',

        ]);



        if ($validation->fails()){

            return response()->json(["error" => true, "msg" => $validation->errors()->first()]);
        }




$user_list = explode(',',$request->user_id);
foreach($user_list as $user_id){
    DB::table('hostel_register')->where('id', $user_id)->update(['hostel_alloted_id' => $request->hostel_id, 'ip_address_hostel_alloted'=> $request->ip(),
    'hostel_alloted_by'=> Auth::guard('admin')->user()->id,'hostel_alloted_date'=> now()]);
    $user = HostelRegister::find($user_id);
    $gender = $user->gender;
}

if($gender == 1){
    $hostel= DB::table('hostel_master')->where('id', $request->hostel_id)->first();
    $boy_allot = $hostel->boys_alloted + count($user_list );
    $seat_used = $hostel->seat_used + count($user_list );
    DB::table('hostel_master')->where('id', $request->hostel_id)->update(['boys_alloted' => $boy_allot,'seat_used' => $seat_used]);
  }else{
      $hostel= DB::table('hostel_master')->where('id', $request->hostel_id)->first();
      $girl_allot = $hostel->girls_alloted +  count($user_list );
      $seat_used = $hostel->seat_used + count($user_list );
      DB::table('hostel_master')->where('id', $request->hostel_id)->update(['girls_alloted' => $girl_allot,'seat_used' => $seat_used ]);
   }
   return response()->json(["error" => false, "msg" => "Hostel Alloted Successfully"]);

    }

    public function sport_wise_hostel_seat(){

        $sports = DB::table('sport_master')->orderBy('name')->get();
        $sportswiseseat = DB::table('sport_wise_hostel_seat_master')->get();
        return view('admin.division_master.sport_wise_hostel_seat', compact('sports','sportswiseseat'));
    }

    public function sport_wise_hostel_seat_store(Request $request){
          $request->validate([
            'sport_id'=> 'required|unique:sport_wise_hostel_seat_master,sport_id',
            'hostel_seat_district'=>'required|numeric',
            'hostel_seat_division'=>'required|numeric'
          ],[
            'sport_id.unique' => 'Sport Should be Unique.' ,
            'sport_id.required' => 'Sport is Required.' ,
           ]);

          $data = [
            'sport_id'=> $request->sport_id,
            'hostel_seat_district'=> $request->hostel_seat_district,
            'hostel_seat_division'=> $request->hostel_seat_division,

          ];

          DB::table('sport_wise_hostel_seat_master')->insert($data);

          return redirect()->back()->with('success','Data Save Successfully.');

    }

    public function sport_wise_hostel_seat_update(Request $request){
        $validation = Validator::make($request->all(), [

            'sport_id'=> 'required|unique:sport_wise_hostel_seat_master,sport_id' . ($request->id ? ",$request->id" : ''),
            'hostel_seat_district'=>'required|numeric',
            'hostel_seat_division'=>'required|numeric'
          ],[
            'sport_id.unique' => 'Sport Should be Unique.' ,
            'sport_id.required' => 'Sport is Required.' ,
           ]);

           if ($validation->fails()){
            return redirect()->back()->with('error',$validation->errors()->first());

           }

        DB::table('sport_wise_hostel_seat_master')->where('id', $request->id)->update(["hostel_seat_district" => $request->hostel_seat_district, "hostel_seat_division" => $request->hostel_seat_division, "sport_id" => $request->sport_id]);
        return redirect()->back()->with('success','Data Update Successfully.');
    }


    public function payment_varify_accept(Request $request){
       //dd($request->all);
        $hostelUser = HostelRegister::find($request->user_id);
        if($request->payment_status == 2){
            $status = 1;
        }else{
            $status = 2;
        }
        $hostelUser->update([
           'payment_status' => $request->payment_status,
           'payment_remark' => $request->remark,
           'payment_by'=> $request->user_id,
           'payment_on'=> date('Y-m-d'),
           'status'=> $status,
           'level'=> 4,
           'query_status'=> 2,

        ]);
        return redirect()->route('hostelView', $request->user_id)->with('msg', 'Payment Verify Successfully');

     }

     public function payment_verify_receipt (Request $req){

        $districts = DB::table('cities')->where('state_id', '23')->get();
        $status = Auth::guard('hostel')->user()->change_password_status;
        $userDetails = Auth::guard('hostel')->user();
       // dd( $userDetails);
        $sportList = array();
        $downloadpdfname = $userDetails->name."_Receipt";
        $pdf = PDF::loadView('hostel_auth.payemnt_receipt_pdf',compact('userDetails', 'sportList','districts'));
        $name  = $downloadpdfname."_".date('d-m-Y').'.pdf';
        return $pdf->download($name);
    }
    public function hostelListExport(){
        $division=DB::table('hostel_division_master')->get();



       $check = DB::table('hostel_div_district_mapping')
       ->select(DB::raw('group_concat(district_id) as district_id'))->where( 'division_id', Auth::guard('admin')->user()->division_id)->get();
        $districts = DB::table('cities')->where('state_id', 23);

        if(Auth::guard('admin')->user()->division_id){

           $districts->whereIn( 'id',explode(',',$check[0]->district_id));
       }


       $districts=   $districts->orderBy('city', 'asc')->get();



        $hostelList =  DB::table('hostel_register as rg')
        ->join('hostel_application_basic as basic', 'rg.id', '=', 'basic.hostel_register_id')
        ->select('rg.*','basic.sports', 'basic.district_id')

        ->whereIn('rg.payment_status', [1,2,3]);


        if(Auth::guard('admin')->user()->division_id > 0){

            $hostelList->whereIn( 'basic.district_id',explode(',',$check[0]->district_id));
        }

        if(Auth::guard('admin')->user()->district_id > 0){

            $hostelList->where( 'basic.district_id',Auth::guard('admin')->user()->district_id);
        }


        $hostelList=  $hostelList->get();
        // $userDetails->payment_status


        $divisions = DB::table('hostel_division_master')->orderBy('division_name')->get();

       $sports = DB::table('sport_master')->orderBy('name')->get();

        return view('rso.dashboard.hostel_application', compact('hostelList', 'sports', 'districts','divisions'));
    }


    public function hostel_absent_application(Request $request){


         // $hostelList = HostelRegister::where('level', 4)->with('applicationBasicDetasils')->where('sports', $request->sports)->latest()->get();
      $division=DB::table('hostel_division_master')->get();
      $check = DB::table('hostel_div_district_mapping')
      ->select(DB::raw('group_concat(district_id) as district_id'))->where( 'division_id', Auth::guard('admin')->user()->division_id)->get();
       $districts = DB::table('cities')->where('state_id', 23);

      if(Auth::guard('admin')->user()->division_id){
         $districts->whereIn( 'id',explode(',',$check[0]->district_id));
      }

       $districts=   $districts->orderBy('city', 'asc')->get();

       if ($request->isMethod('post')) {
       $hostelList =  DB::table('hostel_register as rg')
        ->join('hostel_application_basic as basic', 'rg.id', '=', 'basic.hostel_register_id')
        ->select('rg.*','basic.sports','basic.sub_sport_type', 'basic.district_id');
       if ($request->sport_id){
           $hostelList->where( 'basic.sports', $request->sport_id);
       }

       if ($request->subsport){
            $hostelList->where( 'basic.sub_sport_type', $request->subsport);
       }
       if ($request->city_filter){
            $hostelList->where( 'basic.district_id',$request->city_filter);
       }

       if ($request->trial_type){

        if($request->trial_type == 1){
            $hostelList->where( 'rg.trial_one',1);
        }elseif($request->trial_type == 2){
            $hostelList->where( 'rg.trial_two',1);
        }elseif($request->trial_type == 3){
            $hostelList->where( 'rg.trial_three',1);
        }

   }



       if(Auth::guard('admin')->user()->division_id > 0){
          $hostelList->whereIn( 'basic.district_id',explode(',',$check[0]->district_id));
       }

       if(Auth::guard('admin')->user()->district_id > 0){
          $hostelList->where( 'basic.district_id',Auth::guard('admin')->user()->district_id);
       }

       $hostelList=$hostelList->whereIn('rg.payment_status', [1,2,3])->get();

    }else{
        $hostelList = [];
    }
       $sports = DB::table('sport_master')->orderBy('name')->get();
       $divisions = DB::table('hostel_division_master')->orderBy('division_name')->get();


       return view('hosteltrial.hostel_trial_absent', compact('hostelList', 'sports', 'districts', 'divisions'));



    }



    public function districtwisecount(Request $request){

        $sports = DB::table('sport_master')->where('status', 1)->orderBy('name')->get();
        $districts_list = DB::table('cities')->where('state_id', 23)->orderBy('city')->get();
        $divisions = DB::table('hostel_division_master')->orderBy('division_name')->get();

        $query = DB::table('cities')
            ->leftJoin('hostel_application_basic as hab', 'hab.district_id', '=', 'cities.id')
            ->leftJoin('hostel_register as hr', 'hr.id', '=', 'hab.hostel_register_id')
            ->where('cities.state_id', 23);

        if ($request->sport_id) {
            $query->where('hab.sports', $request->sport_id);
        }
        if ($request->subsport) {
            $query->where('hab.sub_sport_type', $request->subsport);
        }
        if ($request->division_filter) {
            $division_districts = DB::table('hostel_div_district_mapping')
                ->where('division_id', $request->division_filter)
                ->pluck('district_id');
            $query->whereIn('cities.id', $division_districts);
        }
        if ($request->district_trial) {
            $query->where('hr.trial_one', $request->district_trial);
        }
        if ($request->city_filter) {
            $query->where('hab.district_id', $request->city_filter);
        }
        if ($request->status_filter) {
            $query->where('hr.status', $request->status_filter);
        }
        if ($request->payment_status) {
            $query->where('hr.payment_status', $request->payment_status);
        }
        if ($request->division_trial) {
            $query->where('hr.trial_two', $request->division_trial);
        }
        if ($request->state_trial) {
            $query->where('hr.trial_three', $request->state_trial);
        }
        if ($request->existing_student) {
            $query->where('hr.existing_student', $request->existing_student);
        }
        if ($request->session_year) {
            $query->where('hr.session_year', $request->session_year);
        }
        if ($request->gender) {
            $query->where('hr.gender', $request->gender);
        }

        $payment_status_filter = $request->payment_status ?? 2;

        $districts = $query->clone()
            ->select('cities.city', 'cities.id')
            ->selectRaw("count(CASE when hr.payment_status = ? then 1 end) as total", [$payment_status_filter])
            ->selectRaw("count(CASE when hr.gender = 1 and hr.payment_status = ? then 1 end) as male", [$payment_status_filter])
            ->selectRaw("count(CASE when hr.gender = 2 and hr.payment_status = ? then 1 end) as female", [$payment_status_filter])
            ->groupBy('cities.id', 'cities.city')
            ->orderBy('cities.city', 'asc')
            ->get();

        $total = $query->clone()
            ->selectRaw("count(CASE when hr.payment_status = ? then 1 end) as total", [$payment_status_filter])
            ->selectRaw("count(CASE when hr.gender = 1 and hr.payment_status = ? then 1 end) as male", [$payment_status_filter])
            ->selectRaw("count(CASE when hr.gender = 2 and hr.payment_status = ? then 1 end) as female", [$payment_status_filter])
            ->get();

        return view('hosteltrial.districtwisecount', compact('districts', 'total', 'sports', 'districts_list', 'divisions'));
    }





      public function cancel_application_hostel(Request $request){
        $validation = Validator::make($request->all(), [

            'reason_cancelled'=> 'required',
          ]);

           if ($validation->fails()){
            return redirect()->back()->with('error',$validation->errors()->first());

           }

        DB::table('hostel_register')->where('id', $request->user_id)->update(["reason_cancelled" => $request->reason_cancelled, "cancel_status" => 1]);
        return redirect()->back()->with('success','Application Cancelled  Successfully.');
      }




      public function hostel_sub_sport_update(Request $request ){
        $validation = Validator::make($request->all(), [

            'subsporttt'=> 'required',
          ]);

           if ($validation->fails()){
            return redirect()->route('hostelList')->with('error',$validation->errors()->first());

           }



           DB::table('hostel_application_basic')->where('hostel_register_id', $request->user_id)->update(["sub_sport_type" => $request->subsporttt]);

           return redirect()->route('hostelList')->with('success','Sub Sport Updated Successfully.');





      }

}
