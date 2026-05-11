<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
class FinancialAssistance_Model extends Model
{
    use HasFactory;
    protected $table = 'financial_assistance';

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
            'domicile_certificate'                 => 'required|mimes:pdf,png,jpg,jpeg|max:2000',
            'qualification_doc'                 => 'required|mimes:pdf,png,jpg,jpeg|max:2000',

            "monthly_income_personal"       => 'required',
            "income_certificate"       => 'required|mimes:pdf,png,jpg,jpeg|max:2000',
            // "dmc_income_verification"       => 'required|mimes:pdf,png,jpg,jpeg|max:2000',
            "level_of_report"       => 'required',
            "relevant_certificate"       => 'required|mimes:pdf,png,jpg,jpeg|max:2000',
            // "other_achievements"       => 'required',
            "document_other_achievements"       => 'nullable|mimes:pdf,png,jpg,jpeg|max:2000',
            "document_justifying_achievements"       => 'nullable|mimes:pdf,png,jpg,jpeg|max:2000',
            "total_professional_experience"       => 'required',
            // "experience_sports_association"       => 'required',
            "document_justifying_experience"       => 'nullable|mimes:pdf,png,jpg,jpeg|max:2000',
            // "income_other_sources"       => 'required',
            "income_document_other_sources"       => 'nullable|mimes:pdf,png,jpg,jpeg|max:2000',
            "details_of_assistance_benefits"       => 'required',
            "relevant_documents_justifing_assistance"       => 'required|mimes:pdf,png,jpg,jpeg|max:2000',
            "physical_condition"       => 'required',
            "medical_certificate"       => 'nullable|mimes:pdf,png,jpg,jpeg|max:2000',
            // "guardian_signature"       => 'required|mimes:pdf,png,jpg,jpeg|max:2000',
            "bank_name"       => 'required',
            "bank_branch"       => 'required',
            "bank_acc_no"       => 'required',
            "bank_ifsc"       => 'required',
            "acc_holder_name"       => 'required',
            "pan"       => 'required',
            "mobile_registered_in_bank"       => 'required',
            // "other_relevant_information_applicant"       => 'required',


           
        ];
      
        $validation = Validator::make($req->all(), $required, msg());
  
        if ($validation->fails())
             return redirect()->back()->withInput($req->all())->with('error', $validation->errors()->first());

        try{
            // $name = now()->timestamp.".{$req->domicile_certificate->getClientOriginalName()}";
            $domicile_certificate = "{$req->domicile_certificate->getClientOriginalName()}";
            $path = $req->file('domicile_certificate')->storeAs('financial_assistance', $domicile_certificate, 'public');
           
            $qualification_doc = "{$req->qualification_doc->getClientOriginalName()}";
            $path = $req->file('qualification_doc')->storeAs('financial_assistance', $qualification_doc, 'public');
        
            $income_certificate = "{$req->income_certificate->getClientOriginalName()}";
            $path = $req->file('income_certificate')->storeAs('financial_assistance', $income_certificate, 'public');
        
            // $dmc_income_verification = "{$req->dmc_income_verification->getClientOriginalName()}";
            // $path = $req->file('qualification_doc')->storeAs('financial_assistance', $dmc_income_verification, 'public');
        
            $relevant_certificate = "{$req->relevant_certificate->getClientOriginalName()}";
            $path = $req->file('relevant_certificate')->storeAs('financial_assistance', $relevant_certificate, 'public');
        if($req->document_other_achievements){
            $document_other_achievements = "{$req->document_other_achievements->getClientOriginalName()}";
            $path = $req->file('document_other_achievements')->storeAs('financial_assistance', $document_other_achievements, 'public');
        
        }
        else{
            $document_other_achievements ="";
        }
           
            // $document_justifying_achievements = "{$req->document_justifying_achievements->getClientOriginalName()}";
            // $path = $req->file('document_justifying_achievements')->storeAs('financial_assistance', $document_justifying_achievements, 'public');
       
            if($req->income_document_other_sources){
            $income_document_other_sources = "{$req->income_document_other_sources->getClientOriginalName()}";
            $path = $req->file('income_document_other_sources')->storeAs('financial_assistance', $income_document_other_sources, 'public');
        
        }
        else{
            $income_document_other_sources ="";
        }
           
            if($req->document_justifying_experience){
            $document_justifying_experience = "{$req->document_justifying_experience->getClientOriginalName()}";
            $path = $req->file('document_justifying_experience')->storeAs('financial_assistance', $document_justifying_experience, 'public');
            }
            else{
                $document_justifying_experience = "";
            }
            // $document_justifying_experience = "{$req->document_justifying_experience->getClientOriginalName()}";
            // $path = $req->file('document_justifying_experience')->storeAs('financial_assistance', $document_justifying_experience, 'public');
        
            $relevant_documents_justifing_assistance = "{$req->relevant_documents_justifing_assistance->getClientOriginalName()}";
            $path = $req->file('relevant_documents_justifing_assistance')->storeAs('financial_assistance', $relevant_documents_justifing_assistance, 'public');
        if($req->medical_certificate){
            $medical_certificate = "{$req->medical_certificate->getClientOriginalName()}";
            $path = $req->file('medical_certificate')->storeAs('financial_assistance', $medical_certificate, 'public');
        
        }
        else{
            $medical_certificate ="";
        }
         
            // $guardian_signature = "{$req->guardian_signature->getClientOriginalName()}";
            // $path = $req->file('guardian_signature')->storeAs('financial_assistance', $guardian_signature, 'public');
        
            $user = DB::table('financial_assistance')->where('user_id', Auth::id())->first();
            if($user){

                static::update_updatefinancialform($req);
                return redirect('financial-assistance/financialformPreview')->with('success','Successfully Updated!!');
            }
        
                else{
                    $applNo = rand(11111, 99999);
                    $applicationNo= date('ymd').$applNo;
                    // dd($applicationNo);
                    $check = DB::table('financial_assistance')->insertGetId(array(
                    'user_id' =>Auth::id(),
                    'sport_type' =>$req->sport_type,
                    // 'sport_position' =>$req->s_position,
                    'application_no' => $applicationNo,
                    'qualification' =>$req->qualification,
                    'domicile_certificate'      => $domicile_certificate,
                    'qualification_doc'      => $qualification_doc,
                    'monthly_income_personal' =>$req->monthly_income_personal,
                    'income_certificate' =>$income_certificate,
                    // 'dmc_income_verification' =>$dmc_income_verification,
                    'level_of_report' =>$req->level_of_report,
                    'relevant_certificate' =>$relevant_certificate,
                    'other_achievements' =>$req->other_achievements,
                    'document_other_achievements' =>$document_other_achievements,
                    // 'document_justifying_achievements' =>$document_justifying_achievements,
                    'total_professional_experience' =>$req->total_professional_experience,
                    'experience_sports_association' =>$req->experience_sports_association,
                    'document_justifying_experience' =>$document_justifying_experience,
                    'income_other_sources' =>$req->income_other_sources,
                    'income_document_other_sources' =>$income_document_other_sources,
                    'details_of_assistance_benefits' =>$req->details_of_assistance_benefits,
                    'relevant_documents_justifing_assistance' =>$relevant_documents_justifing_assistance,
                    'physical_condition' =>$req->physical_condition,
                    'medical_certificate' =>$medical_certificate,
                    'bank_name' =>$req->bank_name,
                    'bank_branch' =>$req->bank_branch,
                    'bank_acc_no' =>$req->bank_acc_no,
                    'bank_ifsc' =>$req->bank_ifsc,
                    'acc_holder_name' =>$req->acc_holder_name,
                    'pan' =>$req->pan,
                    'mobile_registered_in_bank' =>$req->mobile_registered_in_bank,
                    'other_relevant_information_applicant' =>$req->other_relevant_information_applicant,
                    // 'guardian_signature' =>$guardian_signature,


                        ));
                        
                        foreach($req->sport_achievement_docs as $key=>$item){
                            // dd($item->getClientOriginalName());
                            // $sport_achievement_docs1 = $req->sport_achievement_docs[$key]->getClientOriginalName();
                            $sport_achievement_docs = $item->getClientOriginalName();
                            // dd($req->file('sport_achievement_docs')[0]);
                            $req->file('sport_achievement_docs')[$key]->storeAs('financial_assistance', $sport_achievement_docs, 'public');
        
                            DB::table('sport_achievement_master')->insertGetId(array(
                                'user_id' =>Auth::id(),
                                'sport_achievement' => $req->sport_achievement[$key],
                                'sport_achievement_name' => $req->sport_achievement_name[$key],
                                'sport_achievement_docs' => $sport_achievement_docs,
                                'award_id' => 4,
                            ));
                           
                         }
                         DB::table('user_award_apply_master')->where('user_id', Auth::id())->where('award_type_id', 4)->update([
                            'status' =>1,
                           
                        ]);
            
                return redirect('financial-assistance/financialformPreview')->with('success','Successfully Submitted!!');
                    }
            }catch(\Exception $e){
                // return redirect()->back()->withInput($req->all())->with('error','Something goes wrong while uploading file!');
                // dd($e);
                return redirect()->back()->withInput($req->all())->with('error','Something goes wrong while uploading file!');
            } 
        
    }

    static function update_updatefinancialform($req)
    {

       
        $required = [
            

            'sport_type'            => 'required',
            "qualification"       => 'required',
            'domicile_certificate'                 => 'nullable|mimes:pdf,png,jpg,jpeg|max:2000',
            'qualification_doc'                 => 'nullable|mimes:pdf,png,jpg,jpeg|max:2000',

            "monthly_income_personal"       => 'required',
            "income_certificate"       => 'nullable|mimes:pdf,png,jpg,jpeg|max:2000',
            // "dmc_income_verification"       => 'nullable|mimes:pdf,png,jpg,jpeg|max:2000',
            "level_of_report"       => 'required',
            "relevant_certificate"       => 'nullable|mimes:pdf,png,jpg,jpeg|max:2000',
            // "other_achievements"       => 'required',
            "document_other_achievements"       => 'nullable|mimes:pdf,png,jpg,jpeg|max:2000',
            "document_justifying_achievements"       => 'nullable|mimes:pdf,png,jpg,jpeg|max:2000',
            "total_professional_experience"       => 'required',
            // "experience_sports_association"       => 'required',
            "document_justifying_experience"       => 'nullable|mimes:pdf,png,jpg,jpeg|max:2000',
            // "income_other_sources"       => 'required',
            "income_document_other_sources"       => 'nullable|mimes:pdf,png,jpg,jpeg|max:2000',
            "details_of_assistance_benefits"       => 'required',
            "relevant_documents_justifing_assistance"       => 'nullable|mimes:pdf,png,jpg,jpeg|max:2000',
            "physical_condition"       => 'required',
            "medical_certificate"       => 'nullable|mimes:pdf,png,jpg,jpeg|max:2000',
            // "guardian_signature"       => 'required|mimes:pdf,png,jpg,jpeg|max:2000',
            "bank_name"       => 'required',
            "bank_branch"       => 'required',
            "bank_acc_no"       => 'required',
            "bank_ifsc"       => 'required',
            "acc_holder_name"       => 'required',
            "pan"       => 'required',
            "mobile_registered_in_bank"       => 'required',
            // "other_relevant_information_applicant"       => 'required',


           
        ];
      
        $validation = Validator::make($req->all(), $required, msg());
  
        if ($validation->fails())
             return redirect('financial-assistance/edit_financialform')->withInput($req->all())->with('error', $validation->errors()->first());

        try{
            // $name = now()->timestamp.".{$req->domicile_certificate->getClientOriginalName()}";
            if($req->domicile_certificate){
                $domicile_certificate = "{$req->domicile_certificate->getClientOriginalName()}";
                $path = $req->file('domicile_certificate')->storeAs('financial_assistance', $domicile_certificate, 'public');
                }
                else{
                    $domicile_certificate = $req->domicile_certificate1;
                }
    
                if($req->qualification_doc){
                $qualification_doc = "{$req->qualification_doc->getClientOriginalName()}";
                $path = $req->file('qualification_doc')->storeAs('financial_assistance', $qualification_doc, 'public');
                }
                else{
                    $qualification_doc = $req->qualification_doc1;
                }
    
                if($req->income_certificate){
                $income_certificate = "{$req->income_certificate->getClientOriginalName()}";
                $path = $req->file('income_certificate')->storeAs('financial_assistance', $income_certificate, 'public');
                }
                else{
                    $income_certificate = $req->income_certificate1;
                }
    
                // if($req->dmc_income_verification){
                // $dmc_income_verification = "{$req->dmc_income_verification->getClientOriginalName()}";
                // $path = $req->file('qualification_doc')->storeAs('financial_assistance', $dmc_income_verification, 'public');
                // }
                // else{
                //     $dmc_income_verification = $req->dmc_income_verification1;
                // }
    
                if($req->relevant_certificate){
                $relevant_certificate = "{$req->relevant_certificate->getClientOriginalName()}";
                $path = $req->file('relevant_certificate')->storeAs('financial_assistance', $relevant_certificate, 'public');
                }
                else{
                    $relevant_certificate = $req->relevant_certificate1;
                }

                if($req->document_other_achievements){
                $document_other_achievements = "{$req->document_other_achievements->getClientOriginalName()}";
                $path = $req->file('document_other_achievements')->storeAs('financial_assistance', $document_other_achievements, 'public');
                }else{
                    $document_other_achievements =$req->document_other_achievements1;
                }

                // if($req->document_justifying_achievements){
                // $document_justifying_achievements = "{$req->document_justifying_achievements->getClientOriginalName()}";
                // $path = $req->file('document_justifying_achievements')->storeAs('financial_assistance', $document_justifying_achievements, 'public');
                // }else{
                //     $document_justifying_achievements =$req->document_justifying_achievements1;
                // }


            if($req->income_document_other_sources){
                $income_document_other_sources = "{$req->income_document_other_sources->getClientOriginalName()}";
                $path = $req->file('income_document_other_sources')->storeAs('financial_assistance', $income_document_other_sources, 'public');
                }
                else{
                    $income_document_other_sources = $req->income_document_other_sources1;
                }
    
                if($req->document_justifying_experience){
                $document_justifying_experience = "{$req->document_justifying_experience->getClientOriginalName()}";
                $path = $req->file('document_justifying_experience')->storeAs('financial_assistance', $document_justifying_experience, 'public');
                }
                else{
                    $document_justifying_experience = $req->document_justifying_experience1;
                }
    
                if($req->relevant_documents_justifing_assistance){
                $relevant_documents_justifing_assistance = "{$req->relevant_documents_justifing_assistance->getClientOriginalName()}";
                $path = $req->file('relevant_documents_justifing_assistance')->storeAs('financial_assistance', $relevant_documents_justifing_assistance, 'public');
                }
                else{
                    $relevant_documents_justifing_assistance = $req->relevant_documents_justifing_assistance1;
                }
    
                if($req->medical_certificate){
                $medical_certificate = "{$req->medical_certificate->getClientOriginalName()}";
                $path = $req->file('medical_certificate')->storeAs('financial_assistance', $medical_certificate, 'public');
                }
                else{
                    $medical_certificate = $req->medical_certificate1;
                }
    
            // $guardian_signature = "{$req->guardian_signature->getClientOriginalName()}";
            // $path = $req->file('guardian_signature')->storeAs('financial_assistance', $guardian_signature, 'public');
        
          
            //    $sport_achievement_docs= $req->sport_achievement_docs;
            //     print_r($sport_achievement_docs);exit;
  
                $check = DB::table('financial_assistance')->where('user_id', Auth::id())->update([
                    
                    'sport_type' =>$req->sport_type,
                    'qualification' =>$req->qualification,
                    'domicile_certificate'      => $domicile_certificate,
                    'qualification_doc'      => $qualification_doc,
                    'monthly_income_personal' =>$req->monthly_income_personal,
                    'income_certificate' =>$income_certificate,
                    // 'dmc_income_verification' =>$dmc_income_verification,
                    'level_of_report' =>$req->level_of_report,
                    'relevant_certificate' =>$relevant_certificate,
                    'other_achievements' =>$req->other_achievements,
                    'document_other_achievements' =>$document_other_achievements,
                    // 'document_justifying_achievements' =>$document_justifying_achievements,
                       'total_professional_experience' =>$req->total_professional_experience,
                    'experience_sports_association' =>$req->experience_sports_association,
                    'document_justifying_experience' =>$document_justifying_experience,
                    'income_other_sources' =>$req->income_other_sources,
                    'income_document_other_sources' =>$income_document_other_sources,
                    'details_of_assistance_benefits' =>$req->details_of_assistance_benefits,
                    'relevant_documents_justifing_assistance' =>$relevant_documents_justifing_assistance,
                    'physical_condition' =>$req->physical_condition,
                    'medical_certificate' =>$medical_certificate,
                    'bank_name' =>$req->bank_name,
                    'bank_branch' =>$req->bank_branch,
                    'bank_acc_no' =>$req->bank_acc_no,
                    'bank_ifsc' =>$req->bank_ifsc,
                    'acc_holder_name' =>$req->acc_holder_name,
                    'pan' =>$req->pan,
                    'mobile_registered_in_bank' =>$req->mobile_registered_in_bank,
                    'other_relevant_information_applicant' =>$req->other_relevant_information_applicant,
                   

                        ]);
                        DB::table('sport_achievement_master')->where('user_id',Auth::id())->where('award_id',4)->delete();
                        // dd($req->sport_achievement_docs[0]->getClientOriginalName());
                        
                        foreach($req->sport_achievement as $key=>$item){
                            if(isset($req->sport_achievement_docs[$key]) ){
                               
                                $sport_achievement_docs = $req->sport_achievement_docs[$key]->getClientOriginalName();
                                $req->file('sport_achievement_docs')[$key]->storeAs('financial_assistance', $sport_achievement_docs, 'public');
                                }
                                else{
                                    $sport_achievement_docs = $req->sport_achievement_docs1[$key];
                                }
                                // dd(  $req->sport_achievement_docs1);
                           $get_id= DB::table('sport_achievement_master')->insertGetId(array(
                                'user_id' =>Auth::id(),
                                'sport_achievement' => $req->sport_achievement[$key],
                                'sport_achievement_name' => $req->sport_achievement_name[$key],
                                'sport_achievement_docs' => $sport_achievement_docs,
                                'award_id' => 4,
                            ));
                           
                         }
                       
            
                return redirect('financial-assistance/financialformPreview')->with('success','Successfully Updated!!');
            }catch(\Exception $e){
                return redirect()->back()->withInput($req->all())->with('error','Something goes wrong while uploading file!');
            } 
        
    }


    static function save_monthlyPension($req)
    {

       
        $required = [
            

            'sport_type'            => 'required',
            'award_certificate'                 => 'required|mimes:pdf,png,jpg,jpeg|max:2000',
            
            "honoured_award"       => 'required',
            "award_year"       => 'required',
            "bank_name"       => 'required',
            "bank_branch"       => 'required',
            "bank_acc_no"       => 'required',
            "bank_ifsc"       => 'required',
            "acc_holder_name"       => 'required',
            "pan"       => 'required',
            "mobile_registered_in_bank"       => 'required',
            // "other_relevant_information_applicant"       => 'required',


           
        ];
      
        $validation = Validator::make($req->all(), $required, msg());
  
        if ($validation->fails())
             return redirect('/financial-assistance/monthlyPension_form')->withInput($req->all())->with('error', $validation->errors()->first());

        try{
            // $name = now()->timestamp.".{$req->domicile_certificate->getClientOriginalName()}";

            $user = DB::table('monthly_pension')->where('user_id', Auth::id())->first();
            if($user){

                static::updatemonthlypensionform($req);
                return redirect('financial-assistance/monthlypensionformpreview')->with('success','Successfully Updated!!');
            }
        
                else{
            $award_certificate = $req->award_certificate->getClientOriginalName();
            $path = $req->file('award_certificate')->storeAs('financial_assistance', $award_certificate, 'public');
           
      
            $applNo = rand(11111, 99999);
            $applicationNo= date('ymd').$applNo;
                $check = DB::table('monthly_pension')->insertGetId(array(
                    'user_id' =>Auth::id(),
                    'application_no' => $applicationNo,
                    'sport_type' =>$req->sport_type,
                    'award_certificate' =>$award_certificate,
                    'honoured_award' =>$req->honoured_award,
                   'award_year' =>$req->award_year,
                  
                    'bank_name' =>$req->bank_name,
                    'bank_branch' =>$req->bank_branch,
                    'bank_acc_no' =>$req->bank_acc_no,
                    'bank_ifsc' =>$req->bank_ifsc,
                    'acc_holder_name' =>$req->acc_holder_name,
                    'pan' =>$req->pan,
                    'mobile_registered_in_bank' =>$req->mobile_registered_in_bank,
                    'other_relevant_information_applicant' =>$req->other_relevant_information_applicant,
                    // 'guardian_signature' =>$guardian_signature,


                        ));

                      
                         DB::table('user_award_apply_master')->where('user_id', Auth::id())->where('award_type_id', 5)->update([
                            'status' =>1,
                           
                        ]);
            
                return redirect('financial-assistance/monthlypensionformpreview')->with('success','Successfully Submitted!!');
            }}catch(\Exception $e){
                // return redirect()->back()->withInput($req->all())->with('error',$e->getMessage());
// dd($e);
                return redirect()->back()->withInput($req->all())->with('error','Something goes wrong while uploading file!');
            } 
        
    }


    static function updatemonthlypensionform($req)
    {

       
        $required = [
            

            'sport_type'            => 'required',
            'award_certificate'                 => 'nullable|mimes:pdf,png,jpg,jpeg|max:2000',
            
            "honoured_award"       => 'required',
            "award_year"       => 'required',
            "bank_name"       => 'required',
            "bank_branch"       => 'required',
            "bank_acc_no"       => 'required',
            "bank_ifsc"       => 'required',
            "acc_holder_name"       => 'required',
            "pan"       => 'required',
            "mobile_registered_in_bank"       => 'required',
            // "other_relevant_information_applicant"       => 'required',


           
        ];
      
        $validation = Validator::make($req->all(), $required, msg());
  
        if ($validation->fails())
             return redirect('/financial_assistance/edit_monthlypensionform')->withInput($req->all())->with('error', $validation->errors()->first());

        try{
            // $name = now()->timestamp.".{$req->domicile_certificate->getClientOriginalName()}";

            if($req->award_certificate){
                $award_certificate = $req->award_certificate->getClientOriginalName();
                $path = $req->file('award_certificate')->storeAs('financial_assistance', $award_certificate, 'public');
                }
                else{
                    $award_certificate = $req->award_certificate1;
                }
            // $award_certificate = "{$req->award_certificate->getClientOriginalName()}";
            // $path = $req->file('award_certificate')->storeAs('financial_assistance', $award_certificate, 'public');
           
      
        
                $check = DB::table('monthly_pension')->where('user_id', Auth::id())->update([
                    // 'user_id' =>Auth::id(),
                    'sport_type' =>$req->sport_type,
                    'award_certificate' =>$award_certificate,
                    'honoured_award' =>$req->honoured_award,
                   'award_year' =>$req->award_year,
                  
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

                    
            
                return redirect('financial-assistance/monthlypensionformpreview')->with('success','Successfully Updated!!');
            }catch(\Exception $e){
                return redirect()->back()->withInput($req->all())->with('error','Something goes wrong while uploading file!');
            } 
        
    }

}
