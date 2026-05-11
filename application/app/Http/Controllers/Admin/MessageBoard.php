<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;

use Maatwebsite\Excel\Facades\Excel;
use App\Imports\ImportSendSms;
use Illuminate\Support\Facades\Mail;
class MessageBoard extends Controller
{
    public function email_template_list()
    {
        $email_template = DB::table('email_templates')->orderBy('id', 'DESC')->get();
        return view('admin.message_board.email_template_list',compact('email_template'));
    }
    public function email_template()
    {
        return view('admin.message_board.email_template');
    }

    public function saveEmailTemplate(Request $req)
    {
        $validation = Validator::make($req->all(), [
            'template_id'     => 'required|min:6|max:10|unique:email_templates,template_id,'.$req->id,
            'template_name'     => 'required',
            'email_subject'     => 'required',
            'email_body'     => 'required'
        ]);
        if ($validation->fails())
            return response()->json(['error' => true, 'msg' => $validation->errors()->first()]);

            // dd($req->all());

            $data=[
                'template_id'       => $req->template_id,
                'template_name'       => $req->template_name,
                'subject'       => $req->email_subject,
                'body'       => $req->email_body,
            ];

        if(isset($req->id)){
            $data['updated_by']= Auth::guard('admin')->user()->id;
            DB::table('email_templates')->where('id', $req->id)->update($data);
            return response()->json(["error" => false, "msg" => "Email Template Update Successfully","url" => route('email_template_list')]);
        }
        else{
            $data['created_by']= Auth::guard('admin')->user()->id;
            DB::table('email_templates')->insert($data);
            return response()->json(["error" => false, "msg" => "Email Template Add Successfully","url" => route('email_template_list')]);
        }
    }

    public function editEmailTemplate($id)
    {
        $email_template = DB::table('email_templates')->where('id', $id)->first();
        return view('admin.message_board.email_template', ['email_template'=>$email_template]);
    }
    public function lockEmailTemplate($id){
        DB::table('email_templates')->where('id', '=', $id)->update(['lock_status'=>1]);
        return redirect()->back()->with("success", "Email Template Successfully Locked.");
    }

    public function deleteEmailTemplate($id){
        DB::table('email_templates')->where('id', '=', $id)->delete();
        return redirect()->back()->with("success", "Email Template Successfully Deleted.");
    }



    // sms template

    public function sms_template_list()
    {
        $sms_templates = DB::table('sms_templates')->orderBy('id', 'DESC')->get();
        return view('admin.message_board.sms_template_list',compact('sms_templates'));
    }
    public function sms_template()
    {
        return view('admin.message_board.sms_template');
    }

    public function saveSmsTemplate(Request $req)
    {
        $validation = Validator::make($req->all(), [
            'template_id'     => 'required|min:6|max:10|unique:sms_templates,template_id,'.$req->id,
            'template_name'     => 'required',
            'content'     => 'required'
        ]);
        if ($validation->fails())
            return response()->json(['error' => true, 'msg' => $validation->errors()->first()]);

            // dd($req->all());

            $data=[
                'template_id'       => $req->template_id,
                'template_name'       => $req->template_name,
                'content'       => $req->content,
            ];

        if(isset($req->id)){
            $data['updated_by']= Auth::guard('admin')->user()->id;
            DB::table('sms_templates')->where('id', $req->id)->update($data);
            return response()->json(["error" => false, "msg" => "SMS Template Update Successfully","url" => route('sms_template_list')]);
        }
        else{
            $data['created_by']= Auth::guard('admin')->user()->id;
            DB::table('sms_templates')->insert($data);
            return response()->json(["error" => false, "msg" => "SMS Template Add Successfully","url" => route('sms_template_list')]);
        }
    }

    public function editSmsTemplate($id)
    {
        $sms_templates = DB::table('sms_templates')->where('id', $id)->first();
        return view('admin.message_board.sms_template', ['sms_templates'=>$sms_templates]);
    }
    public function lockSmsTemplate($id){
        DB::table('sms_templates')->where('id', '=', $id)->update(['lock_status'=>1]);
        return redirect()->back()->with("success", "SMS Template Successfully Locked.");
    }
    public function deleteSmsTemplate($id){
        DB::table('sms_templates')->where('id', '=', $id)->delete();
        return redirect()->back()->with("success", "SMS Template Successfully Deleted.");
    }

    public function send_sms(Request $req)
    {
        if($req->ajax()){


            if($req->user_type == 1){
                if($req->other){
                    $other_number=explode(",",$req->other);
                    $number_all=array_merge($other_number,$req->existing_users);
                }else{
                    $number_all=$req->existing_users;

                }
                foreach($number_all as $number){
                    $url = 'http://api.smscountry.com/SMSCwebservice_bulk.aspx?' . http_build_query([
                        'User'         => 'Vareli',
                        'passwd'       => 'Vtpl@1234',
                        'mobilenumber' => $number,
                        'message'      => strip_tags($req->TEMPLATE_CONMTENT),
                        'sid'          => 'VARELI',
                        'mtype'        => 'N',
                        'DR'           => 'Y',
                    ]);
                    $ch = curl_init();
                    curl_setopt($ch, CURLOPT_URL, $url);
                    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
                    $result = curl_exec($ch);
                    curl_close($ch);
                }
            }else{
                $content=$req->TEMPLATE_CONMTENT;
                $file_a= $req->file('userfile')->store('temp');
                $import = new ImportSendSms;
                Excel::import($import,$file_a);
                foreach($import->number as $number){
                    $url = 'http://api.smscountry.com/SMSCwebservice_bulk.aspx?' . http_build_query([
                        'User'         => 'Vareli',
                        'passwd'       => 'Vtpl@1234',
                        'mobilenumber' => $number,
                        'message'      => strip_tags($req->TEMPLATE_CONMTENT),
                        'sid'          => 'VARELI',
                        'mtype'        => 'N',
                        'DR'           => 'Y',
                    ]);
                    $ch = curl_init();
                    curl_setopt($ch, CURLOPT_URL, $url);
                    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
                    $result = curl_exec($ch);
                    curl_close($ch);
                }


            }

                return response()->json(["error" => false, "msg" => "Send Successfully"]);

        }
        $sms_templates = DB::table('sms_templates')->orderBy('id', 'DESC')->get();
        $role_management = DB::table('urm_role_manager')->orderBy('id', 'ASC')->get();
        return view('admin.message_board.sms_send',compact('sms_templates','role_management'));
    }

    public function send_broadcast( Request $request){


        if($request->method() == 'POST'){

            if($request->allUsers == 1){
                $validation =  Validator::make($request->all(), [
                    'subject'=> 'required',
                    'message'=> 'required',


                ]);
            }else{
                $validation =  Validator::make($request->all(), [
                    'subject'=> 'required',
                    'message'=> 'required',
                    'role_user.*'=>'required'

                ]);
            }

    if ($validation->fails())
    return redirect()->back()->with('error', $validation->errors()->first());

  $datacompose = [
    'type'=> 2,
    'subject'=> $request->subject,
    'message'=>$request->message,
    'created_by'=> Auth::guard('admin')->user()->id,

  ];

   $id =  DB::table('admin_mail_composer')->insertGetId($datacompose);

   if ($request->attachment){

     foreach ( $request->attachment as $key => $value) {
        $attachment = moveFile('mail/attachment', $value);
        $data = [
            'mail_id'=> $id,
            'attachment'=> $attachment,
            'type'=>3
        ];
        DB::table('admin_mail_attachment')->insert($data);
     }
    }


   if($request->allUsers == 1){
   $allUsers =  DB::table('admin')->get();

    foreach ( $allUsers as $key => $value) {
        $data = [
            'mail_id'=>$id ,
            'user_id'=> $value->id,
        ];
       DB::table('broadcasting')->insert($data);
     }
   }else{

    $user_list = array_unique($request->existing_users);
    foreach ( $user_list as $key => $value) {
        $data = [
            'mail_id'=>$id ,
            'user_id'=> $value,
        ];
       DB::table('broadcasting')->insert($data);
     }
   }






   return redirect()->back()->with('success', 'Mail Sent Succesfully.');



        };






        $role_management = DB::table('urm_role_manager')->orderBy('id', 'ASC')->get();
        return view('admin.message_board.send_broadcast',compact('role_management'));
    }


  public function broadcast_list( Request $req){


    $broadcast_list =   DB::table('admin_mail_composer')->where('type', 2)->where('created_by', Auth::guard('admin')->user()->id)->get();

    return view('admin.message_board.broadcast_list',compact('broadcast_list'));
  }


  public function broadcast_deactive($broadcast_id){

    DB::table('admin_mail_composer')->where('type', 2)->where('id', $broadcast_id)->update(['draft'=>2]);

    // DB::table('broadcasting')->where('broadcast_id', $broadcast_id)->update(['status'=>2]);
    return response()->json(["error" => false, "msg" => "Deactivated Successfully","url" => route('broadcast_list')]);


  }



  public function view_broadcast($broadcast_id){


    $view_broadcast =   DB::table('admin_mail_composer')->where('type', 2)->where('id',$broadcast_id)->first();


    $admin_mail_attachment =  DB::table('admin_mail_attachment')->where('mail_id',$broadcast_id)->get();

    return response()->json(["error" => false, "data" =>$view_broadcast, "attachment"=> $admin_mail_attachment]);


  }



  public function changeBroadcastStatus($id){
   $data= DB::table('broadcasting')->where('id', $id)->update(['message_read'=>2]);
   $data= DB::table('broadcasting')->where('id', $id)->first();
   $view_broadcast =   DB::table('admin_mail_composer')->where('type', 2)->where('id',$data->mail_id)->first();

   $admin_mail_attachment =  DB::table('admin_mail_attachment')->where('mail_id',$view_broadcast->id)->get();
    return response()->json(["error" => false,"data"=>$view_broadcast,"attachment"=> $admin_mail_attachment]);

  }


  public function all_broadcast(){
    DB::table('broadcasting')->where('user_id', Auth::guard('admin')->user()->id)->update(['message_read'=>2]);

   $broadcast_list= DB::table('broadcasting')
   ->leftJoin('admin_mail_composer', 'admin_mail_composer.id', '=', 'broadcasting.mail_id')
   ->select('admin_mail_composer.*','broadcasting.*', 'broadcasting.id as idd')
   ->whereNull('draft')
   ->where('admin_mail_composer.type', 2)
   ->where('broadcasting.user_id', Auth::guard('admin')->user()->id)
   ->orderByDesc('broadcasting.id')->get();


    return view('admin.message_board.all_broadcast',compact('broadcast_list'));

}

    public function get_template_message(Request $req)
    {
        if($req->type=="sms"){
            $sms_templates = DB::table('sms_templates')->where('id', '=', $req->template_id)->first();
			echo $sms_templates->content;
        }else{
            $sms_templates = DB::table('email_templates')->where('id', '=', $req->template_id)->first();
			return $sms_templates;
        }
    }

    public function get_user(Request $req)
    {
        // dd($req->value);
            $sms_templates = DB::table('admin')->where('admin_role', '=', $req->value)->get();
			return $sms_templates;
    }



    //  mail
    public function send_mail(Request $req)
    {
        if($req->ajax()){


            if($req->user_type == 1){
                // dd($req->all());
                if($req->other){
                    $other_email=explode(",",$req->other);
                    $all_email=array_merge($other_email,$req->existing_users);
                }else{
                    $all_email=$req->existing_users;

                }
                $usermail = "do_not_reply@khelsathi.in";
                $tomail = $all_email;
                $arrayDummy = $tomail;
                // unset($arrayDummy[array_search($tomail[0], $arrayDummy)]);
                // $bccmail = implode(",",$arrayDummy);
                // foreach($all_email as $number){
                    // print_r(count($arrayDummy)); die;
                    $subject = $req->email_subject;
                    $body = urlencode(strip_tags($req->TEMPLATE_CONMTENT));

                    Mail::to($usermail)->bcc($arrayDummy)->send(new \App\Mail\SendMail($subject,$body));

                    $data=[
                        'template_id'=>$req->templates,
                        'count'=>count($arrayDummy),
                        'added_by'=> Auth::guard('admin')->user()->id
                       ];

                       $id = DB::table('communication_log_email_history')->insertGetId($data);

                // }
            }else{
                $content=$req->TEMPLATE_CONMTENT;
                $file_a= $req->file('userfile')->store('temp');
                $import = new ImportSendSms;
                Excel::import($import,$file_a);
                $all_email=$import->number;
                $usermail = "do_not_reply@khelsathi.in";
                $tomail = $all_email;
                $arrayDummy = $tomail;
                // unset($arrayDummy[array_search($tomail[0], $arrayDummy)]);
                // dd($arrayDummy);

                // $bccmail = '["'.implode('","',$arrayDummy).'"]';
                // foreach($all_email as $number){
                // print_r(count($arrayDummy)); die;

                    $subject = $req->email_subject;
                    $body = strip_tags($req->TEMPLATE_CONMTENT);
                    // ["pankaj8932971158@gmail.com","arjunguptagpl@gmail.com"]
                    Mail::to($usermail)->bcc($arrayDummy)->send(new \App\Mail\SendMail($subject,$body));
                    $data=[
                        'template_id'=>$req->templates,
                        'count'=>count($arrayDummy),
                        'added_by'=> Auth::guard('admin')->user()->id
                       ];

                       $id = DB::table('communication_log_email_history')->insertGetId($data);

            }

                return response()->json(["error" => false, "msg" => "Send Successfully"]);

        }
        $email_templates = DB::table('email_templates')->orderBy('id', 'DESC')->get();
        $role_management = DB::table('urm_role_manager')->orderBy('id', 'ASC')->get();
        return view('admin.message_board.mail_send',compact('email_templates','role_management'));
    }

}
