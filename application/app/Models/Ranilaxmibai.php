<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class Ranilaxmibai extends Model
{
    use HasFactory;

    protected $table = 'ranilaxmibai_award';

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
        'document_other_achievements',
        'highschool_certificate',
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
            'qualification_doc'                 => 'required|mimes:pdf,jpg,jpeg|max:2000',
            'notary_affidavit_doc'                 => 'required|mimes:pdf,jpg,jpeg|max:2000',
            'sport_achievement_docs.*'                 => 'required|mimes:pdf,jpg,jpeg|max:2000',
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



        ];

        $validation = Validator::make($req->all(), $required, msg());
        // dd($req->sport_achievement_docs,$validation->errors());
        if ($validation->fails())
        return response()->json(["error" => true, "msg" => $validation->errors()->first()]);

            //  return redirect('/rani_laxmi_bai_award')->withInput($req->all())->with('error', $validation->errors()->first());

        try{

            $qualification_doc = date('His').$req->qualification_doc->getClientOriginalName();
            $path = $req->file('qualification_doc')->storeAs('laxmibai_award', $qualification_doc, 'public');

            $domicile_certificate = date('His').$req->domicile_certificate->getClientOriginalName();
            $path = $req->file('domicile_certificate')->storeAs('laxmibai_award', $domicile_certificate, 'public');

            $notary_affidavit_doc = time() . '_' . preg_replace('/\s+/', '_', $req->notary_affidavit_doc->getClientOriginalName());
            $path = $req->file('notary_affidavit_doc')->storeAs('laxmibai_award', $notary_affidavit_doc, 'public');

             
             if($req->highschool_certificate){
                $highschool_certificate = date('His').$req->highschool_certificate->getClientOriginalName();
                $path = $req->file('highschool_certificate')->storeAs('laxmibai_award', $highschool_certificate, 'public');
                $player_type=1;
            }else{
                $highschool_certificate ="";
                $player_type=2;
            }

             $user = DB::table('ranilaxmibai_award')->where('user_id', Auth::id())->first();
            // if($user){
            //     static::update_laxmibai_award($req);
            //     // dd("123");
            //     return redirect('/laxmibaidetailForm')->with('success','Successfully Updated!!');

            // }else{

                $applNo = date('ymd').rand(11111, 99999);
        //  dd($applNo);


        $data = [
            'user_id' =>Auth::id(),
            'application_no' =>$applNo,
            'sport_type' =>$req->sport_type,
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


                $check = DB::table('ranilaxmibai_award')->insertGetId($data);
                        // dd($check);
                        foreach($req->sport_achievement_docs as $key=>$item){
                            // dd($item->getClientOriginalName());
                            // $sport_achievement_docs1 = $req->sport_achievement_docs[$key]->getClientOriginalName();
                            $sport_achievement_docs = date('His').$item->getClientOriginalName();
                            $req->file('sport_achievement_docs')[$key]->storeAs('laxmibai_award', $sport_achievement_docs, 'public');

                            DB::table('sport_achievement_master')->insertGetId(array(
                                'user_id' =>Auth::id(),
                                'application_no' =>$applNo,
                                'award_id' =>2,
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
                         ;
                        //  dd($req->other_achievement_docs);
                       if($req->other_achievement_docs){
                            foreach($req->other_achievement_docs as $key=>$item){

                                // $sport_achievement_docs1 = $req->sport_achievement_docs[$key]->getClientOriginalName();
                                $other_achievement_docs = date('His').$item->getClientOriginalName();
                                $req->file('other_achievement_docs')[$key]->storeAs('laxmibai_award', $other_achievement_docs, 'public');

                                DB::table('other_achievement_master')->insert(array(
                                    'user_id' =>Auth::id(),
                                    'application_no' =>$applNo,
                                    'award_id' =>2,
                                    'achievement_name' => $req->other_achievement_name[$key],
                                    'achievement_docs' => $other_achievement_docs,
                                ));

                             }
                         }

                         DB::table('user_award_apply_master')->where('user_id', Auth::id())->where('award_type_id', 2)->update([
                            'status' =>1,

                        ]);
                        return response()->json(["error" => false, "msg" => 'Submitted Successfully. !!', "url" => url('laxmibaidetailForm/'.$applNo)]);

                // return redirect('/laxmibaidetailForm/'.$applNo)->with('success','Successfully Submitted!!');
            // }
            }catch(\Exception $e){
                return response()->json(["error" => true, "msg" => $e->getMessage()]);

                // dd($e);
                // return redirect()->back()->with('error','Something goes wrong while uploading file!');
            }

    }

    static function update_laxmibai_award($req)
    {

        $application_no=$req->application_no;
        $required = [


            'sport_type'            => 'required',
            "qualification"       => 'required',
            'domicile_certificate'                 => 'nullable|mimes:pdf,jpg,jpeg|max:2000',
            'qualification_doc'                 => 'nullable|mimes:pdf,jpg,jpeg|max:2000',
            'notary_affidavit_doc'                 => 'nullable|mimes:pdf,jpg,jpeg|max:2000',
            "sport_competition_name.*"       => 'required',
            "sport_name.*"       => 'required',
            "event_details.*"       => 'required',
            "sport_achievement_position.*"       => 'required',
            "competition_from_date.*"       => 'required',
            "competition_to_date.*"       => 'required',
            "sport_place.*"       => 'required',

            'sport_achievement_docs.*'                 => 'nullable|mimes:pdf,jpg,jpeg|max:2000',
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

        if ($validation->fails())
        return response()->json(["error" => true, "msg" => $validation->errors()->first()]);

            //  return redirect('/edit_laxmibai_award')->withInput($req->all())->with('error', $validation->errors()->first());




       try{

            if($req->domicile_certificate){
            $domicile_certificate = date('His').$req->domicile_certificate->getClientOriginalName();
          $path = $req->file('domicile_certificate')->storeAs('laxmibai_award', $domicile_certificate, 'public');
            }
            else{
                $domicile_certificate = $req->domicile_certificate1;
            }

            if($req->qualification_doc){
            $qualification_doc = date('His').$req->qualification_doc->getClientOriginalName();
            $path = $req->file('qualification_doc')->storeAs('laxmibai_award', $qualification_doc, 'public');
            }
            else{
                $qualification_doc = $req->qualification_doc1;
            }
            if($req->highschool_certificate){
            $highschool_certificate = date('His').$req->highschool_certificate->getClientOriginalName();
            $path = $req->file('highschool_certificate')->storeAs('laxmibai_award', $highschool_certificate, 'public');
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
            $user = DB::table('ranilaxmibai_award')->where('user_id', Auth::id())->first();

            if($user){
                $check = DB::table('ranilaxmibai_award')->where('user_id', Auth::id())->where('application_no', $req->application_no)->update([
                    'sport_type' =>$req->sport_type,
                    // 'sport_position' =>$req->s_position,
                    'qualification' =>$req->qualification,
                    'domicile_certificate'      => $domicile_certificate,
                    'qualification_doc'      => $qualification_doc,
                    'highschool_certificate'      => $highschool_certificate,
                    'bank_name' =>$req->bank_name,
                    'bank_branch' =>$req->bank_branch,
                    'bank_acc_no' =>$req->bank_acc_no,
                    'bank_ifsc' =>$req->bank_ifsc,
                    'acc_holder_name' =>$req->acc_holder_name,
                    'pan' =>$req->pan,
                    'mobile_registered_in_bank' =>$req->mobile_registered_in_bank,
                    'other_relevant_information_applicant' =>$req->other_relevant_information_applicant,
                    'notary_affidavit_doc'      => $notary_affidavit_doc,
                    // 'guardian_signature' =>$guardian_signature,


                        ]);
                        // dd($req->sport_achievement);
                       ;
                        // dd($req->sport_achievement_docs[0]->getClientOriginalName());

                        $previous = DB::table('sport_achievement_master')->where('user_id',Auth::id())->where('application_no', $req->application_no)->where('award_id',2)->get();

                        foreach ($previous as $key => $value) {
                            DB::table('sport_achievement_master')->delete($value->id);
                        }

                        foreach($req->sport_competition_name as $key=>$item){

                            if(isset($req->sport_achievement_docs[$key]) ){

                                $sport_achievement_docs = date('His').$req->sport_achievement_docs[$key]->getClientOriginalName();
                               $req->file('sport_achievement_docs')[$key]->storeAs('laxmibai_award', $sport_achievement_docs, 'public');
                                }
                                else{
                                    $sport_achievement_docs = $req->sport_achievement_docs1[$key];
                                }

// dd(($req->competition_from_date[$key]));
                         $data=   DB::table('sport_achievement_master')->insertGetId(array(
                                'user_id' =>Auth::id(),
                                'award_id' =>2,
                                'application_no' => $req->application_no,
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



                         DB::table('other_achievement_master')->where('user_id',Auth::id())->where('application_no', $req->application_no)->where('award_id',2)->delete();


                         if($req->other_achievement_name){

                            foreach($req->other_achievement_name as $key=>$item){

                                if(isset($req->other_achievement_docs[$key]) && $req->other_achievement_docs[$key] != "" ){

                                    $other_achievement_docs = date('His').$req->other_achievement_docs[$key]->getClientOriginalName();
                                    $req->file('other_achievement_docs')[$key]->storeAs('laxmibai_award', $other_achievement_docs, 'public');
                                    }
                                    else{
                                        if(isset($req->other_achievement_docs1[$key]) && $req->other_achievement_docs1 != ""){

                                            $other_achievement_docs = $req->other_achievement_docs1[$key];
                                        }
                                        else{
                                            $other_achievement_docs ="";
                                        }
                                    }
                                    if($req->other_achievement_name[$key]){
                                        DB::table('other_achievement_master')->insert(array(
                                            'user_id' =>Auth::id(),
                                            'award_id' =>2,
                                            'application_no' => $req->application_no,
                                            'achievement_name' => $req->other_achievement_name[$key],
                                            'achievement_docs' => $other_achievement_docs,
                                        ));
                                    }


                             }
                         }

            }
            return response()->json(["error" => false, "msg" => 'Successfully Updated!! !!', "url" => url('laxmibaidetailForm/'.$application_no)]);

            // return redirect('/laxmibaidetailForm/'.$application_no)->with('success','Successfully Updated!!');
       }catch(\Exception $e){
        // dd($e);
        return response()->json(["error" => true, "msg" => $e->getMessage()]);

        //    return redirect('/rani_laxmi_bai_award/'.$application_no)->with('error','Something goes wrong while uploading file!');
       }

    }
}
