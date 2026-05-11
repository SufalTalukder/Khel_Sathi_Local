<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Mail;
class BookingController extends Controller
{



public function guest_room_booking(){

 $state=DB::table('states')->orderBy('name')->get();
    return view('booking.guestroombooking',compact('state'));
}


public function guest_room_booking_store(Request $request){
    $validation = Validator::make($request->all(), [
        'name' => 'required',
        'email' => 'required',
        'mobile' => 'required',
        'aadhaar' => 'required',
        'state' => 'required',
        'district' => 'required',
        'address' => 'required',
        'from_date' => 'required',
        'to_date' => 'required',
        'member' => 'required',
        'category' => 'required',
    ], msg());

    if ($validation->fails())
        return response()->json(['error' => true, 'msg' => $validation->errors()->first()]);


        $data = [
         'name' => $request->name,
        'email' => $request->email,
        'mobile' => $request->mobile,
        'aadhaar' => $request->aadhaar ,
        'state' => $request->state,
        'district' => $request->district,
        'address' => $request->address,
        'from_date' => $request->from_date,
        'to_date' => $request->to_date,
        'member' => $request->member,
        'category' => $request->category,
        ];

      $id =  DB::table('guest_room_booking')->insertGetId($data);

      $booking_no = 'GU'.date('Y').sprintf("%06d",$id);
      DB::table('guest_room_booking')->where('id', $id)->update(['booking_no'=> $booking_no]);
      $from_date = dmy($request->from_date);

      $tp_date = dmy($request->to_date);

      $data = array("name" => "smtp", "body" => "Hi  $request->name,
      <br>
       Your booking has been registered from $from_date to $tp_date date. Your booking  number is  $booking_no.");
      $to_email = $request->email;


          Mail::send('emails.mail', $data, function ($message) use ($to_email) {
              $message->to($to_email)


                  ->subject("Guest Room Booking has been registered")
               ;
              $message->from(env('MAIL_USERNAME'), env('MAIL_FROM_NAME'));
              });


       return  redirect()->back()->with('success', 'Guest Room Booked Successfully.');

}




public function stadium_booking(){
   $stadium = DB::table('studium_master')->orderBy('studium_name')->get();
   $sport = DB::table('sport_master')->orderBy('name')->get();

    $state=DB::table('states')->orderBy('name')->get();
       return view('booking.stadiumbooking',compact('state','stadium','sport'));
   }





public function stadium_booking_store(Request $request){
    $validation = Validator::make($request->all(), [
        'name' => 'required',
        'email' => 'required',
        'mobile' => 'required',

        'from_date' => 'required',
        'to_date' => 'required',
        'sport' => 'required',
        'stadium' => 'required',
        'institute' => 'required',
    ], msg());

    if ($validation->fails())
        return response()->json(['error' => true, 'msg' => $validation->errors()->first()]);


        $data = [
         'name' => $request->name,
        'email' => $request->email,
        'mobile' => $request->mobile,
        'sport' => $request->sport,
        'stadium' => $request->stadium,
        'institute' => $request->institute,
        'from_date' => $request->from_date,
        'to_date' => $request->to_date,

        ];

        $id =   DB::table('stadium_booking')->insertGetId($data);
        $booking_no = 'ST'.date('Y').sprintf("%06d",$id);
        DB::table('stadium_booking')->where('id', $id)->update(['booking_no'=> $booking_no]);

        $from_date = dmy($request->from_date);

        $tp_date = dmy($request->to_date);

        $data = array("name" => "smtp", "body" => "Hi  $request->name,
        <br>
         Your booking has been registered from $from_date to $tp_date date. Your booking  number is  $booking_no.");
        $to_email = $request->email;


            Mail::send('emails.mail', $data, function ($message) use ($to_email) {
                $message->to($to_email)


                    ->subject("Stadium Booking has been registered")
                 ;
                $message->from(env('MAIL_USERNAME'), env('MAIL_FROM_NAME'));
                });



       return  redirect()->back()->with('success', 'Stadium Booked Successfully.');

}



public function admin_guest_room_booking(){
   $booking_list =  DB::table('guest_room_booking')->orderByDesc('created_on')->get();


   return view ('admin.booking.guest_room', compact('booking_list'));

}






public function admin_stadium_booking(){
    $booking_list =  DB::table('stadium_booking')->orderByDesc('created_on')->get();


    return view ('admin.booking.stadium_booking', compact('booking_list'));

 }


 public function stadium_booking_approved(Request $request){


    $data = [
        'approved_status' => $request->status,
       'status_message' => $request->status_message,
       ];


       if( $request->status == 1){

        $msg ='Application Approved Successfully.';
       }else{
        $msg ='Application Decline Successfully.';
       }


       DB::table('stadium_booking')->where('id', $request->id)->update($data);



       
       return redirect()->back()->with('success', $msg);
 }

 public function guest_room_booking_approved(Request $request){
    $data = [
        'approved_status' => $request->status,
       'status_message' => $request->status_message,


       ];


       if( $request->status == 1){

        $msg ='Application Approved Successfully.';
       }else{
        $msg ='Application Decline Successfully.';
       }


       DB::table('guest_room_booking')->where('id', $request->id)->update($data);
       return redirect()->back()->with('success', $msg);
 }












}
