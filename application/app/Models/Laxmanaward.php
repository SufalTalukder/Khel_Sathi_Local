<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class Laxmanaward extends Model
{
    use HasFactory;

    protected $table = 'laxman_award';

    protected $fillable = [
        'user_id',
        'sport_type',
        'sport_position',
        'domicile_certificate',
        'qualification',
        'qualification_doc',
        'monthly_income_personal',

        'income_certificate',
        'dmc_income_verification',
        'level_of_report',
        'relevant_certificate',
        'other_achievements',
        'qualification_doc',
        'highschool_certificate',
        'document_other_achievements',

        'document_justifying_achievements',
        'total_professional_experience',
        'experience_sports_association',
        'document_justifying_experience',
        'income_other_sources',
        'income_document_other_sources',
        'details_of_assistance_benefits',

        'relevant_documents_justifing_assistance',
        'physical_condition',
        'medical_certificate',
        'bank_name',
        'bank_branch',
        'bank_acc_no',
        'bank_ifsc',

        'acc_holder_name',
        'pan',
        'mobile_registered_in_bank',
        'other_relevant_information_applicant',
        'notary_affidavit_doc',
        'guardian_signature',
        'dope_test',
        'court_case',
    ];

    static function preRegistration($req)
    {


        $required = [


            'sport_type'            => 'required',
            "qualification"       => 'required',
            'domicile_certificate'                 => 'required|mimes:pdf,jpg,jpeg|max:2000',
            'notary_affidavit_doc'                 => 'required|mimes:pdf,jpg,jpeg|max:2000',
            'qualification_doc'                 => 'required|mimes:pdf,jpg,jpeg|max:2000',

            "sport_competition_name.*"       => 'required',
            "sport_name.*"       => 'required',
            "event_details.*"       => 'required',
            "sport_achievement_position.*"       => 'required',
            "competition_from_date.*"       => 'required',
            "competition_to_date.*"       => 'required',
            "sport_place.*"       => 'required',

            'sport_achievement_docs.*'                 => 'required|mimes:pdf,jpg,jpeg|max:2000',
            'achievement_docs.*'                 => 'nullable|mimes:pdf,jpg,jpeg|max:2000',
            'highschool_certificate'                 => 'nullable|mimes:pdf,jpg,jpeg|max:2000',

            "bank_name"       => 'required',
            "bank_branch"       => 'required',
            "bank_acc_no"       => 'required',
            "bank_ifsc"       => 'required',
            "acc_holder_name"       => 'required',
            "pan"       => 'required',
            "mobile_registered_in_bank"       => 'required',



        ];

        $validation = Validator::make($req->all(), $required, msg());
        // dd($req->sport_achievement_docs,$validation->errors());
        if ($validation->fails())
        return response()->json(["error" => true, "msg" => $validation->errors()->first()]);
            //  return redirect('/laxman_award')->withInput($req->all())->with('error', $validation->errors()->first());

        try{

            
            $qualification_doc = time() . '_' . preg_replace('/\s+/', '_', $req->qualification_doc->getClientOriginalName());
            $path = $req->file('qualification_doc')->storeAs('award', $qualification_doc, 'public');
            // $sport_achievement_docs = $req->sport_achievement_docs->getClientOriginalName();
            // $path = $req->file('sport_achievement_docs')->storeAs('award', $sport_achievement_docs, 'public');



            // $name = now()->timestamp.".{$req->domicile_certificate->getClientOriginalName()}";
             $domicile_certificate = time() . '_' . preg_replace('/\s+/', '_', $req->domicile_certificate->getClientOriginalName());
             $path = $req->file('domicile_certificate')->storeAs('laxman_award', $domicile_certificate, 'public');
           if($req->highschool_certificate){
            $highschool_certificate = time() . '_' . preg_replace('/\s+/', '_', $req->highschool_certificate->getClientOriginalName());
            $path = $req->file('highschool_certificate')->storeAs('laxman_award', $highschool_certificate, 'public');
            $player_type=1;
        }
            else{
                $highschool_certificate ="";
                $player_type=2;
            }

            $notary_affidavit_doc = time() . '_' . preg_replace('/\s+/', '_', $req->notary_affidavit_doc->getClientOriginalName());
            $path = $req->file('notary_affidavit_doc')->storeAs('laxman_award', $notary_affidavit_doc, 'public');


            $user = DB::table('laxman_award')->where('user_id', Auth::id())->first();

            // if($user){

            //     static::update_laxman_award($req);
            //     return redirect('/laxmandetailForm')->with('success','Successfully Updated!!');

            // }else{
                $applNo = rand(11111, 99999);

              $data = [
                    'user_id' =>Auth::id(),
                    'sport_type' =>$req->sport_type,
                    'application_no' => date('ymd').$applNo,
                    // 'sport_position' =>$req->s_position,
                    'qualification' =>$req->qualification,
                    'domicile_certificate'      => $domicile_certificate,
                    'qualification_doc'      => $qualification_doc,
                    'highschool_certificate'      => $highschool_certificate,
                    'notary_affidavit_doc'      => $notary_affidavit_doc,
                    'bank_name' =>$req->bank_name,
                    'bank_branch' =>$req->bank_branch,
                    'bank_acc_no' =>$req->bank_acc_no,
                    'bank_ifsc' =>$req->bank_ifsc,
                    'acc_holder_name' =>$req->acc_holder_name,
                    'pan' =>$req->pan,
                    'player_type' =>$player_type,
                    'mobile_registered_in_bank' =>$req->mobile_registered_in_bank,
                    'other_relevant_information_applicant' =>$req->other_relevant_information_applicant,


              ];

                if(Session::get('sessDetails')){


                    $data['serviceCode_edistrict']=Session::get('sessDetails')['serviceCode'];
                    $data['DCode_edistrict']=Session::get('sessDetails')['DCode'];
                    $data['RequestKey_edistrict']=Session::get('sessDetails')['RequestKey'];
                    $data['UserName_edistrict']=Session::get('sessDetails')['UserName'];
            }
                $check = DB::table('laxman_award')->insertGetId($data);

                        foreach($req->sport_achievement_docs as $key=>$item){
                            // dd($item->getClientOriginalName());
                            // $sport_achievement_docs1 = $req->sport_achievement_docs[$key]->getClientOriginalName();
                           
                            $sport_achievement_docs = time() . '_' . preg_replace('/\s+/', '_', $item->getClientOriginalName());
                            $req->file('sport_achievement_docs')[$key]->storeAs('laxman_award', $sport_achievement_docs, 'public');

                            DB::table('sport_achievement_master')->insertGetId(array(
                                'user_id' =>Auth::id(),
                                'application_no' => date('ymd').$applNo,
                                'award_id' =>1,
                                'sport_achievement' => $req->sport_competition_name[$key],
                                'sport_achievement_name' => $req->sport_name[$key],
                                'event_details' => $req->event_details[$key],
                                'competition_from_date' => $req->competition_from_date[$key],
                                'competition_to_date' => $req->competition_to_date[$key],
                                'sport_achievement_position' => $req->sport_achievement_position[$key],
                                'sport_achievement_State_Institution' => $req->sport_place[$key],
                                'sport_achievement_docs' => $sport_achievement_docs,
                            ));

                         }

                       if($req->other_achievement_docs){
                            foreach($req->other_achievement_docs as $key=>$item){

                                // $sport_achievement_docs1 = $req->sport_achievement_docs[$key]->getClientOriginalName();
                              
                                $other_achievement_docs = time() . '_' . preg_replace('/\s+/', '_', $item->getClientOriginalName());
                                $req->file('other_achievement_docs')[$key]->storeAs('laxman_award', $other_achievement_docs, 'public');

                                DB::table('other_achievement_master')->insert(array(
                                    'user_id' =>Auth::id(),
                                    'application_no' => date('ymd').$applNo,
                                    'award_id' =>1,
                                    'achievement_name' => $req->other_achievement_name[$key],
                                    'achievement_docs' => $other_achievement_docs,
                                ));

                             }
                         }

                         DB::table('user_award_apply_master')->where('user_id', Auth::id())->where('award_type_id', 1)->update([
                            'status' =>1,

                        ]);
                    return response()->json(["error" => false, "msg" => 'Nomination Form Submitted Successfully./नामांकन प्रपत्र सफलतापूर्वक भरा गया। !!', "url" => url('laxmandetailForm/'.date('ymd').$applNo)]);

                // return redirect('/laxmandetailForm/'.date('ymd').$applNo)->with('success','Nomination Form Submitted Successfully./नामांकन प्रपत्र सफलतापूर्वक भरा गया। !!');
            // }
            }catch(\Exception $e){
                return response()->json(["error" => true, "msg" => $e->getMessage()]);

                // return redirect('/edit_laxman_award/'.date('ymd').$applNo)->with('error','Something goes wrong while uploading file!');
            }

    }

    static function update_laxman_award($req)
    {

        
        $application_no=$req->application_no;
        $required = [


            'sport_type'            => 'required',
            "qualification"       => 'required',
            'domicile_certificate'                 => 'nullable|mimes:pdf,jpg,jpeg|max:2000',
            'qualification_doc'                 => 'nullable|mimes:pdf,jpg,jpeg|max:2000',
            'sport_achievement_docs.*'                 => 'nullable|mimes:pdf,jpg,jpeg|max:2000',
            'achievement_docs.*'                 => 'nullable|mimes:pdf,jpg,jpeg|max:2000',
            'highschool_certificate'                 => 'nullable|mimes:pdf,jpg,jpeg|max:2000',
            "sport_competition_name.*"       => 'required',
            "sport_name.*"       => 'required',
            "event_details.*"       => 'required',
            "sport_achievement_position.*"       => 'required',
            "competition_from_date.*"       => 'required',
            "competition_to_date.*"       => 'required',
            "sport_place.*"       => 'required',

            "bank_name"       => 'required',
            "bank_branch"       => 'required',
            "bank_acc_no"       => 'required',
            "bank_ifsc"       => 'required',
            "acc_holder_name"       => 'required',
            "pan"       => 'required',
            "mobile_registered_in_bank"       => 'required',
            'notary_affidavit_doc'                 => 'nullable|mimes:pdf,jpg,jpeg|max:2000',




        ];

        $validation = Validator::make($req->all(), $required, msg());

        if ($validation->fails())
        return response()->json(["error" => true, "msg" => $validation->errors()->first()]);

            //  return redirect('/edit_laxman_award')->withInput()->with('error', $validation->errors()->first());

       try{
            if($req->domicile_certificate){
            $domicile_certificate = time() . '_' . preg_replace('/\s+/', '_', $req->domicile_certificate->getClientOriginalName());
            $path = $req->file('domicile_certificate')->storeAs('laxman_award', $domicile_certificate, 'public');
            }
            else{
                $domicile_certificate = $req->domicile_certificate1;
            }
            if($req->qualification_doc){
            $qualification_doc = time() . '_' . preg_replace('/\s+/', '_', $req->qualification_doc->getClientOriginalName());
            $path = $req->file('qualification_doc')->storeAs('award', $qualification_doc, 'public');
            }
            else{
                $qualification_doc = $req->qualification_doc1;
            }

            if($req->highschool_certificate){
            $highschool_certificate = time() . '_' . preg_replace('/\s+/', '_', $req->highschool_certificate->getClientOriginalName());
            $path = $req->file('highschool_certificate')->storeAs('laxman_award', $highschool_certificate, 'public');
            }
            else{
                $highschool_certificate = $req->highschool_certificate1;
            }

            if($req->notary_affidavit_doc){
            $notary_affidavit_doc = time() . '_' . preg_replace('/\s+/', '_', $req->notary_affidavit_doc->getClientOriginalName());
            $path = $req->file('notary_affidavit_doc')->storeAs('laxman_award', $notary_affidavit_doc, 'public');
            }
            else{
                $notary_affidavit_doc = $req->notary_affidavit_doc1;
            }


            $user = DB::table('laxman_award')->where('user_id', Auth::id())->first();

            //    $sport_achievement_docs= $req->sport_achievement_docs;
            //     print_r($sport_achievement_docs);exit;
            if($user){
                $check = DB::table('laxman_award')->where('user_id', Auth::id())->where('application_no', $req->application_no)->update([
                    'sport_type' =>$req->sport_type,
                    // 'sport_position' =>$req->s_position,
                    'qualification' =>$req->qualification,
                    'domicile_certificate'      => $domicile_certificate,
                    'qualification_doc'      => $qualification_doc,
                    'highschool_certificate'      => $highschool_certificate,
                    'notary_affidavit_doc'      => $notary_affidavit_doc,
                    
                    'bank_name' =>$req->bank_name,
                    'bank_branch' =>$req->bank_branch,
                    'bank_acc_no' =>$req->bank_acc_no,
                    'bank_ifsc' =>$req->bank_ifsc,
                    'acc_holder_name' =>$req->acc_holder_name,
                    'pan' =>$req->pan,
                    'mobile_registered_in_bank' =>$req->mobile_registered_in_bank,
                    'other_relevant_information_applicant' =>$req->other_relevant_information_applicant,
                    // 'guardian_signature' =>$guardian_signature,

                        ]);


                $previous = DB::table('sport_achievement_master')->where('user_id',Auth::id())->where('application_no', $req->application_no)->where('award_id',1)->get();

                        foreach ($previous as $key => $value) {
                            DB::table('sport_achievement_master')->delete($value->id);
                        }
                        foreach($req->sport_competition_name as $key=>$item){
                            if(isset($req->sport_achievement_docs[$key]) ){

                                $sport_achievement_docs = time() . '_' . preg_replace('/\s+/', '_', $req->sport_achievement_docs[$key]->getClientOriginalName());
                                $req->file('sport_achievement_docs')[$key]->storeAs('laxman_award', $sport_achievement_docs, 'public');
                                }
                                else{
                                    $sport_achievement_docs = $req->sport_achievement_docs1[$key];
                                }

                           $get_id= DB::table('sport_achievement_master')->insert(array(
                                'user_id' =>Auth::id(),
                                'application_no' => $req->application_no,
                                'award_id' =>1,
                                'sport_achievement' => $req->sport_competition_name[$key],
                                'sport_achievement_name' => $req->sport_name[$key],
                                'event_details' => $req->event_details[$key],
                                'competition_from_date' => $req->competition_from_date[$key],
                                'competition_to_date' => $req->competition_to_date[$key],
                                'sport_achievement_position' => $req->sport_achievement_position[$key],
                                'sport_achievement_State_Institution' => $req->sport_place[$key],
                                'sport_achievement_docs' => $sport_achievement_docs,
                            ));

                         }

                    //    dd($sport_achievement_docs);
                         DB::table('other_achievement_master')->where('user_id',Auth::id())->where('application_no', $req->application_no)->where('award_id',1)->delete();
                         if($req->other_achievement_name){


                            foreach($req->other_achievement_name as $key=>$item){
                                if(isset($req->other_achievement_docs[$key]) ){

                                    $other_achievement_docs = time() . '_' . preg_replace('/\s+/', '_', $req->other_achievement_docs[$key]->getClientOriginalName());
                                    $req->file('other_achievement_docs')[$key]->storeAs('laxman_award', $other_achievement_docs, 'public');
                                    }
                                    else{
                                        // dd($req->other_achievement_docs1);
                                        if(isset($req->other_achievement_docs1[$key]) && $req->other_achievement_docs1 != " "){

                                            $other_achievement_docs = $req->other_achievement_docs1[$key];
                                        }
                                        else{
                                            $other_achievement_docs ="";
                                        }
                                    }
                                // $sport_achievement_docs1 = $req->sport_achievement_docs[$key]->getClientOriginalName();
                                // $other_achievement_docs = $item->getClientOriginalName();
                                // $req->file('other_achievement_docs')[$key]->storeAs('laxman_award', $other_achievement_docs, 'public');
                               if($req->other_achievement_name[$key]){
                                DB::table('other_achievement_master')->insert(array(
                                    'user_id' =>Auth::id(),
                                    'award_id' =>1,
                                    'application_no' => $req->application_no,
                                    'achievement_name' => $req->other_achievement_name[$key],
                                    'achievement_docs' => $other_achievement_docs,
                                ));
                               }


                             }
                         }
                         DB::table('user_award_apply_master')->where('user_id', Auth::id())->where('award_type_id', 1)->update([
                            'status' =>1,

                        ]);

            }
            return response()->json(["error" => false, "msg" => 'Successfully Updated!! !!', "url" => url('laxmandetailForm/'.$application_no)]);

            // return redirect('/laxmandetailForm/'.$application_no)->with('success','Successfully Updated!!');
        }catch(\Exception $e){
            return response()->json(["error" => true, "msg" => $e->getMessage()]);

            // return redirect('/edit_laxman_award/'.$application_no)->with('Something goes wrong while uploading file!');
        }

    }
}
