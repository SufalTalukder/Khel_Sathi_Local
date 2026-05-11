<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class PositionHolder extends Model
{
    use HasFactory;

    protected $table = 'position_holder';

    protected $fillable = [
        'user_id',
        'sport_type',
        'sport_position',
        'domicile_certificate',
        'qualification',
        'qualification_doc',




        'competition_name',
        'venue_name',
        'competition_to_date',
        'competition_from_date',
        'earned_achievement',
        'award_certificate',
        'competition_type',
        'event_type',

        'bank_name',
        'bank_branch',
        'bank_acc_no',
        'bank_ifsc',
        'acc_holder_name',
        'mobile_registered_in_bank',

        'pan_doc',
        'sport_certificate',
        'passbook_doc',
        'final_submit',
        'created_at'

    ];

    static function preRegistration($req)
    {

// dd($req->all());
        $required = [


            'sport_type' => 'required',
            "qualification" => 'required',
            'domicile_certificate' => 'required|mimes:pdf,jpg,jpeg|max:2000',
            'qualification_doc' => 'required|mimes:pdf,jpg,jpeg|max:2000',
            'award_certificate_affidavit' => 'nullable|mimes:pdf,jpg,jpeg|max:2000',

            "competition_name.*" => 'required',
            "event_type.*" => 'required',
            "event_name.*" => 'required',
            "earned_medals.*" => 'required',
            "competition_from_date.*" => 'required',
            "competition_to_date.*" => 'required',
            "place.*" => 'required',
            "award_certificate.*" => 'required|mimes:pdf,jpg,jpeg|max:2000',
            "event_details.*" => 'required',

            "bank_name" => 'required',
            "bank_branch" => 'required',
            "bank_acc_no" => 'required',
            "bank_ifsc" => 'required',
            "acc_holder_name" => 'required',
            "mobile_registered_in_bank" => 'required',

            "pan_doc" => 'required|mimes:pdf,jpg,jpeg|max:2000',
            "sport_certificate" => 'required|mimes:pdf,jpg,jpeg|max:2000',
            "passbook_doc" => 'required|mimes:pdf,jpg,jpeg|max:2000',




        ];

        $validation = Validator::make($req->all(), $required, msg());
        if ($validation->fails())
        return response()->json(["error" => true, "msg" => $validation->errors()->first()]);

            // return redirect('/position_holder')->withInput($req->all())->with('error', $validation->errors()->first());

        try {

            $qualification_doc = date('His').$req->qualification_doc->getClientOriginalName();
            $path = $req->file('qualification_doc')->storeAs('position_holder', $qualification_doc, 'public');

            $domicile_certificate = date('His').$req->domicile_certificate->getClientOriginalName();
            $path = $req->file('domicile_certificate')->storeAs('position_holder', $domicile_certificate, 'public');
            if($req->award_certificate_affidavit){
                $award_certificate_affidavit = date('His').$req->award_certificate_affidavit->getClientOriginalName();
                $path = $req->file('award_certificate_affidavit')->storeAs('position_holder', $award_certificate_affidavit, 'public');
            }
            else{
                $award_certificate_affidavit ="";
            }

            $pan_doc = date('His').$req->pan_doc->getClientOriginalName();
            $path = $req->file('pan_doc')->storeAs('position_holder', $pan_doc, 'public');

            $sport_certificate = date('His').$req->sport_certificate->getClientOriginalName();
            $path = $req->file('sport_certificate')->storeAs('position_holder', $sport_certificate, 'public');


            $passbook_doc = date('His').$req->passbook_doc->getClientOriginalName();
            $path = $req->file('passbook_doc')->storeAs('position_holder', $passbook_doc, 'public');

            $user = DB::table('position_holder')->where('user_id', Auth::id())->first();

            // if ($user) {
            //     static::update_position_holder($req);
            //     return redirect('/positiondetailForm')->with('success', 'Successfully Updated!!');

            // } else {
                $applNo = rand(11111, 99999);


                $data = [
                    'user_id' => Auth::id(),
                    'application_no' => date('ymd').$applNo,
                    'sport_type' => $req->sport_type,
                    // 'sport_position' =>$req->s_position,
                    'qualification' => $req->qualification,
                    'domicile_certificate' => $domicile_certificate,
                    'qualification_doc' => $qualification_doc,

                    // "competition_name" => $req->competition_name,
                    // "venue_name" => $req->venue_name,
                    // "competition_from_date" => $req->competition_from_date,
                    // "competition_to_date" => $req->competition_to_date,
                    // "earned_achievement" => $req->earned_achievement,
                    // "award_certificate_affidavit" => $award_certificate_affidavit,
                    // "competition_type" => $req->competition_type,
                    // "event_type" => $req->event_type,

                    'bank_name' => $req->bank_name,
                    'bank_branch' => $req->bank_branch,
                    'bank_acc_no' => $req->bank_acc_no,
                    'bank_ifsc' => $req->bank_ifsc,
                    'acc_holder_name' => $req->acc_holder_name,
                    'mobile_registered_in_bank' => $req->mobile_registered_in_bank,

                    "pan_doc" => $pan_doc,
                    "sport_certificate" => $sport_certificate,
                    "passbook_doc" => $passbook_doc,

                ];


                if(Session::get('sessDetails')){


                    $data['serviceCode_edistrict']=Session::get('sessDetails')['serviceCode'];
                    $data['DCode_edistrict']=Session::get('sessDetails')['DCode'];
                    $data['RequestKey_edistrict']=Session::get('sessDetails')['RequestKey'];
                    $data['UserName_edistrict']=Session::get('sessDetails')['UserName'];
            }
                // dd(date('ymd').$applNo);
                $check = DB::table('position_holder')->insertGetId($data);
                DB::table('position_holder_competition_docs')->where('user_id', Auth::id())->where('application_no', $req->application_no)->delete();
                foreach ($req->award_certificate as $key => $item) {
                    // dd($item->getClientOriginalName());
                    // $sport_achievement_docs1 = $req->sport_achievement_docs[$key]->getClientOriginalName();
                    $award_certificate = date('His').$item->getClientOriginalName();
                    $req->file('award_certificate')[$key]->storeAs('position_holder', $award_certificate, 'public');

                    DB::table('position_holder_competition_docs')->insertGetId(
                        array(
                            'user_id' => Auth::id(),
                            'application_no' => date('ymd').$applNo,
                            "competition_name" => $req->competition_name[$key],
                            "event_type" => $req->event_type[$key],
                            "event_name" => $req->event_name[$key],
                            "earned_medals" => $req->earned_medals[$key],
                            "competition_from_date" => $req->competition_from_date[$key],
                            "competition_to_date" => $req->competition_to_date[$key],
                            "place" => $req->place[$key],
                            "event_details" => $req->event_details[$key],
                            'award_certificate' => $award_certificate,
                        )
                    );

                }


                //  dd($req->other_achievement_docs);

                DB::table('user_award_apply_master')->where('user_id', Auth::id())->where('award_type_id', 3)->update([
                    'status' => 1,

                ]);
                return response()->json(["error" => false, "msg" => 'Submitted Successfully!!', "url" => url('positiondetailForm/'.date('ymd').$applNo)]);

                // return redirect('/positiondetailForm/'.date('ymd').$applNo)->with('success', 'Successfully Submitted!!');
            // }
        } catch (\Exception $e) {
            return response()->json(["error" => true, "msg" => $e->getMessage()]);

            // return redirect()->back()->with('error', 'Something goes wrong while uploading file!');
        }

    }

    static function update_position_holder($req)
    {

        $application_no=$req->application_no;
        $required = [


            'sport_type' => 'required',
            "qualification" => 'required',
            'domicile_certificate' => 'nullable|mimes:pdf,jpg,jpeg|max:2000',
            'qualification_doc' => 'nullable|mimes:pdf,jpg,jpeg|max:2000',

            // "competition_name.*" => 'required',
            // "event_type.*" => 'required',
            // "event_name.*" => 'required',
            // "earned_medals.*" => 'required',
            // "competition_from_date.*" => 'required',
            // "competition_to_date.*" => 'required',
            // "place.*" => 'required',
            // "award_certificate.*" => 'nullable|mimes:pdf,jpg,jpeg|max:2000',
            // "event_details.*" => 'required',

            "bank_name" => 'required',
            "bank_branch" => 'required',
            "bank_acc_no" => 'required',
            "bank_ifsc" => 'required',
            "acc_holder_name" => 'required',
            "mobile_registered_in_bank" => 'required',

            "pan_doc" => 'nullable|mimes:pdf,jpg,jpeg|max:2000',
            "sport_certificate" => 'nullable|mimes:pdf,jpg,jpeg|max:2000',
            "passbook_doc" => 'nullable|mimes:pdf,jpg,jpeg|max:2000',



        ];

        $validation = Validator::make($req->all(), $required, msg());

        if ($validation->fails())
        return response()->json(["error" => true, "msg" => $validation->errors()->first()]);

            // return redirect()->back()->withInput($req->all())->with('error', $validation->errors()->first());

        try {
            if ($req->qualification_doc) {
                $qualification_doc = date('His').$req->qualification_doc->getClientOriginalName();
                $path = $req->file('qualification_doc')->storeAs('position_holder', $qualification_doc, 'public');
            } else {
                $qualification_doc = $req->qualification_doc1;
            }

            if ($req->domicile_certificate) {
                $domicile_certificate = date('His').$req->domicile_certificate->getClientOriginalName();
                $path = $req->file('domicile_certificate')->storeAs('position_holder', $domicile_certificate, 'public');
            } else {
                $domicile_certificate = $req->domicile_certificate1;
            }
            // dd($req->award_certificate_affidavit1);
            if ($req->award_certificate_affidavit) {
                $award_certificate_affidavit = date('His').$req->award_certificate_affidavit->getClientOriginalName();
                $path = $req->file('award_certificate_affidavit')->storeAs('position_holder', $award_certificate_affidavit, 'public');
            } elseif($req->award_certificate_affidavit1) {

                $award_certificate_affidavit = $req->award_certificate_affidavit1;
            }
            else {
                $award_certificate_affidavit = "";
            }

            if ($req->pan_doc) {
                $pan_doc = date('His').$req->pan_doc->getClientOriginalName();
                $path = $req->file('pan_doc')->storeAs('position_holder', $pan_doc, 'public');
            } else {
                $pan_doc = $req->pan_doc1;
            }

            if ($req->sport_certificate) {
                $sport_certificate = date('His').$req->sport_certificate->getClientOriginalName();
                $path = $req->file('sport_certificate')->storeAs('position_holder', $sport_certificate, 'public');
            } else {
                $sport_certificate = $req->sport_certificate1;
            }

            if ($req->passbook_doc) {
                $passbook_doc = date('His').$req->passbook_doc->getClientOriginalName();
                $path = $req->file('passbook_doc')->storeAs('position_holder', $passbook_doc, 'public');
            } else {
                $passbook_doc = $req->passbook_doc1;
            }



            $user = DB::table('position_holder')->where('user_id', Auth::id())->first();

            //    $sport_achievement_docs= $req->sport_achievement_docs;
            //     print_r($sport_achievement_docs);exit;
            if ($user) {
                $check = DB::table('position_holder')->where('user_id', Auth::id())->where('application_no', $req->application_no)->update([
                    'sport_type' => $req->sport_type,
                    // 'sport_position' =>$req->s_position,
                    'qualification' => $req->qualification,
                    'domicile_certificate' => $domicile_certificate,
                    'qualification_doc' => $qualification_doc,

                    "competition_name" => $req->competition_name,
                    "venue_name" => $req->venue_name,
                    "competition_from_date" => $req->competition_from_date,
                    "competition_to_date" => $req->competition_to_date,
                    "earned_achievement" => $req->earned_achievement,
                    "award_certificate_affidavit" => $award_certificate_affidavit,
                    "competition_type" => $req->competition_type,
                    "event_type" => $req->event_type,

                    'bank_name' => $req->bank_name,
                    'bank_branch' => $req->bank_branch,
                    'bank_acc_no' => $req->bank_acc_no,
                    'bank_ifsc' => $req->bank_ifsc,
                    'acc_holder_name' => $req->acc_holder_name,
                    'mobile_registered_in_bank' => $req->mobile_registered_in_bank,

                    "pan_doc" => $pan_doc,
                    "sport_certificate" => $sport_certificate,
                    "passbook_doc" => $passbook_doc,

                ]);
                // dd($req->award_certificate1[]);
                // DB::table('position_holder_competition_docs')->where('user_id', Auth::id())->where('application_no', $req->application_no)->delete();

                // if ($req->award_certificate1) {
                //     foreach ($req->award_certificate1 as $key => $item) {
                //         if (isset($req->award_certificate[$key])) {
                //             $awardCertificate = $req->award_certificate[$key]->getClientOriginalName();
                //             $req->file('award_certificate')[$key]->storeAs('position_holder', $awardCertificate, 'public');
                //         } else {
                //             $awardCertificate = $item;
                //         }
                //         if ($awardCertificate) {
                //             DB::table('position_holder_competition_docs')->insert([
                //                 'user_id' => Auth::id(),
                //                 'application_no' => $req->application_no,
                //                 'award_certificate' => $awardCertificate
                //             ]);
                //         }
                //     }
                // }

                // if (!empty($req->award_certificate_add)) {
                //     foreach ($req->award_certificate_add as $key => $item) {
                //         if (isset($req->award_certificate_add[$key])) {
                //             $awardCertificate = $req->award_certificate_add[$key]->getClientOriginalName();
                //             $req->file('award_certificate_add')[$key]->storeAs('position_holder', $awardCertificate, 'public');
                //             DB::table('position_holder_competition_docs')->insert([
                //                 'user_id' => Auth::id(),
                //                 'application_no' => $req->application_no,
                //                 'award_certificate' => $awardCertificate
                //             ]);
                //         }
                //     }
                // }

                DB::table('position_holder_competition_docs')->where('user_id', Auth::id())->where('application_no', $req->application_no)->delete();
                foreach ($req->competition_name as $key => $item) {
                    // dd($item->getClientOriginalName());
                    // $sport_achievement_docs1 = $req->sport_achievement_docs[$key]->getClientOriginalName();
                    if (isset($req->award_certificate[$key])) {
                    $award_certificate = date('His').$item->getClientOriginalName();
                    $req->file('award_certificate')[$key]->storeAs('position_holder', $award_certificate, 'public');
                    }else{
                        $award_certificate = $req->award_certificate1[$key];
                    }
                    DB::table('position_holder_competition_docs')->insertGetId(
                        array(
                            'user_id' => Auth::id(),
                            'application_no' => $req->application_no,
                            "competition_name" => $req->competition_name[$key],
                            "event_type" => $req->event_type[$key],
                            "event_name" => $req->event_name[$key],
                            "earned_medals" => $req->earned_medals[$key],
                            "competition_from_date" => $req->competition_from_date[$key],
                            "competition_to_date" => $req->competition_to_date[$key],
                            "place" => $req->place[$key],
                            "event_details" => $req->event_details[$key],
                            'award_certificate' => $award_certificate,
                        )
                    );

                }







            }
            return response()->json(["error" => false, "msg" => 'Successfully Updated!! !!', "url" => url('positiondetailForm/'.$application_no)]);

            // return redirect('/positiondetailForm/'.$application_no)->with('success', 'Successfully Updated!!');
        } catch (\Exception $e) {
            return response()->json(["error" => true, "msg" => $e->getMessage()]);

            // return redirect()->back()->with('error', 'Something goes wrong while uploading file!');
        }

    }
}
