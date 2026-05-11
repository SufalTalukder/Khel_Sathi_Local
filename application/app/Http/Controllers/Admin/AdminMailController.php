<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator as FacadesValidator;

class AdminMailController extends Controller
{
    public function adminmail(){
        $mail =   DB::table('admin_mail_composer')->where('type', 1)->where('draft', 1)->where('created_by', Auth::guard('admin')->user()->id)->orderByDesc('id')->get();
        return view('admin.mailer.index', compact('mail'));
    }

    public function mail_compose(Request $request){

       $composer =  DB::table('admin_mail_composer')->find($request->id);

        $role_management = DB::table('urm_role_manager')->orderBy('id', 'ASC')->get();

        return view('admin.mailer.compose', compact('role_management', 'composer'));
    }


    public function adminmailStore(Request $request){

        if($request->ajax()){

            $validation =   Validator::make($request->all(), [
                'subject'=> 'required',
                'message'=> 'required',
            ]);
            if ($validation->fails())
                return response()->json(['error' => true, 'msg' => $validation->errors()->first()]);
            $datacompose = [
                'type'=> 1,
                'draft'=>2,
                'subject'=> $request->subject,
                'message'=>$request->message,
                'created_by'=> Auth::guard('admin')->user()->id,

              ];

               $id =  DB::table('admin_mail_composer')->insertGetId($datacompose);
               return response()->json(["error" => false, "msg" =>'Mail Saved as Draft.']);




        }

        if($request->iddd){
            $composer =  DB::table('admin_mail_composer')->where('id',$request->iddd)->delete();
        };


        $validation =  Validator::make($request->all(), [
            'subject'=> 'required',
            'message'=> 'required',
            'role_user.*'=>'required'
        ]);
        if ($validation->fails())
        return redirect()->back()->with('error', $validation->errors()->first());

      $datacompose = [
        'type'=> 1,
        'draft'=>1,
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
                'type'=>1
            ];
            DB::table('admin_mail_attachment')->insert($data);
         }
        }
        // dd($request->existing_users);
        if($request->existing_users){
            $user_list = array_unique($request->existing_users);
            foreach ( $user_list as $key => $value) {
               $data = [
                   'mail_id'=>$id ,
                   'user_id'=> $value,
               ];
               DB::table('admin_mailer')->insert($data);
            }
        }
       


       return redirect()->route('mail_compose')->with('success', 'Mail Sent Succesfully.');
    }



    public function draft_mail (){
      $draft_mail =   DB::table('admin_mail_composer')->where('type', 1)->where('draft', 2)->where('created_by', Auth::guard('admin')->user()->id)
      ->orderByDesc('id')->get();

        return view('admin.mailer.draft', compact('draft_mail'));
    }


    public function all_mail (){
         $mail =   DB::table('admin_mailer')
         ->leftJoin('admin_mail_composer', 'admin_mailer.mail_id', '=', 'admin_mail_composer.id')
         ->select('admin_mailer.*','admin_mail_composer.*', 'admin_mailer.id as idd')

        //  ->leftJoin('admin_mail_attachment', 'admin_mail_attachment.mail_id', '=', 'admin_mail_composer.id')
         ->where('admin_mail_composer.type', 1)
         ->where('admin_mail_composer.draft', 1)
         ->where('admin_mailer.user_id', Auth::guard('admin')->user()->id)
         ->orderByDesc('admin_mail_composer.id')
         ->get();

         return view('admin.mailer.all_mail', compact('mail'));

    }

    public function mail_view($id){
        $composer =  DB::table('admin_mailer')->find($id);
if ($composer->message_read ==1) {
    DB::table('admin_mailer')->where('id',$id)->update(['message_read'=> 2, 'readed_on'=> now()]);

}
$reply_attachment =  DB::table('admin_mail_attachment')->where('mail_id',$id)->where('type', 2)->get();

        $mail_composer =  DB::table('admin_mail_composer')->find($composer->mail_id);
        $admin_mail_attachment =  DB::table('admin_mail_attachment')->where('mail_id',$mail_composer->id)->where('type', 1)->get();
        return view('admin.mailer.mail_view', compact('composer', 'mail_composer','admin_mail_attachment','reply_attachment'));
    }


    public function mail_view_detail($id){
        $composer =  DB::table('admin_mailer')->where('mail_id',$id)->get();
// dd($composer);
        $mail_composer =  DB::table('admin_mail_composer')->find($id);
        $admin_mail_attachment =  DB::table('admin_mail_attachment')->where('mail_id',$mail_composer->id)->where('type', 1)->get();
        // dd($admin_mail_attachment);
        return view('admin.mailer.mail_view_detail', compact('composer', 'mail_composer','admin_mail_attachment'));

    }


    public function mail_reply(Request $request){

        $validation = Validator::make($request->all(),[
            'reply'=> 'required',
        ]);
        if ($validation->fails())
            return response()->json(['error' => true, 'msg' => $validation->errors()->first()]);


        $composer =  DB::table('admin_mailer')->where('id',$request->id)->update([
            'reply'=>$request->reply,
            'reply_on'=>now(),

        ]);


        if ($request->attachment){

            foreach ( $request->attachment as $key => $value) {
               $attachment = moveFile('mail/attachment', $value);
               $data = [
                   'mail_id'=> $request->id,
                   'attachment'=> $attachment,
                   'type'=>2
               ];
               DB::table('admin_mail_attachment')->insert($data);
            }
           }

           return response()->json(["error" => false, "msg" =>'Reply Sent Successfully.',"url" => route('mail_view', $request->id)]);

    }



    public function add_announcement(Request $request){


     if($request->method() == 'POST'){
        $validation =  Validator::make($request->all(), [

            'message'=> 'required',
            'start_date'=>'required',
            'end_date'=>'required'
        ]);
        if ($validation->fails())
        return redirect()->back()->with('error', $validation->errors()->first());


        $data = [
            'announcement'=> $request->message,
            'start_date'=> $request->start_date,
            'end_date'=> $request->end_date,
            'created_by'=> Auth::guard('admin')->user()->id,
        ];

        DB::table('admin_announcement')->insert($data);

        return redirect()->back()->with('success', 'Announcement Created Successfully.');


     }
        return view('admin.announcement.create');
    }



    public function announcement(){

        $announcement = DB::table('admin_announcement')->orderByDesc('id')->get();
        return view('admin.announcement.index', compact('announcement'));
    }




}
