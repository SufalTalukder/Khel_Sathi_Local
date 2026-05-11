<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\CalendarManagement;
use Illuminate\Support\Facades\Auth;


class CalendarManagementController extends Controller
{
    public function index(){
        $CalendarManagementEdit  = '';
      
        return view('admin/calendar_management/index',compact('CalendarManagementEdit'));
    }
    public function saveCalendar(Request $req)
    {
     
        $req->validate([
            'header_name'     => 'required|max:150',
            'subject_name'   => 'required',
            'type' => 'required'
        ]);
        $calenderdata = new CalendarManagement();
		$calenderdata->header_name = $req->header_name;
        $calenderdata->subject_name =  $req->subject_name;
        $calenderdata->remarks = $req->remarks;
        $calenderdata->type =  $req->type;

        if ($calenderdata->type  == 1 && $req->hasFile('media_data_upload')){
            $media_data= moveFile('calendar_management/media_data', $req->media_data_upload);
            $calenderdata->media_data = $media_data;
        }else{
            $calenderdata->media_data = $req->media_data_url;
        }
          
		$calenderdata->save();

      return redirect('admin/create_calendar_management')->with("success", "Calendar Form Successfully Created.");
    }

    public function calendarList(){
        $calendarList = DB::table('calender_management_info')->select('header_name', 'remarks', 'id', 'subject_name', 'type', 'media_data','created_at')->orderBy('id', 'DESC')->get();
       // dd( $calendarList);
        return view('admin/calendar_management/calendar_list', compact('calendarList'));
   
    }
    public function edit_calendar($id){

        $CalendarManagementEdit = CalendarManagement::find($id);
        return view('admin/calendar_management/index', compact('CalendarManagementEdit'));
       
    }
    public function calendar_management_update ($id,Request $req){
     
        $CalendarManagement= CalendarManagement::find($id);
        $validation = Validator::make($req->all(), [
            'header_name'     => 'required|max:150',
            'subject_name'   => 'required',
            'type' => 'required'
        ]);

        if ($validation->fails()){
            return response()->json(['error' => true, 'msg' => $validation->errors()->first()]);
        }
        $data = [            
            'header_name' => $req->header_name,
            'subject_name' => $req->subject_name,
            'type' => $req->type,
            'remarks' => $req->remarks,       
        ];
        if ($req->type  == 1 && $req->hasFile('media_data_upload')){
            $media_data= moveFile('calendar_management/media_data', $req->media_data_upload);
            $data['media_data'] = $media_data;
        }else if($req->type  == 2 && $req->media_data_url){
            $data['media_data'] = $req->media_data_url;
        }else{
            $data['media_data'] = $req->media_data_hidden;
        }

      // dd($data);
            
        $CalendarManagementForm = CalendarManagement::find($id);
        $CalendarManagementForm->update($data);

return redirect('admin/calendar_list')->with("success", "Calendar form updated successfully.");
      //  return response()->json(['error' => false, 'msg' => 'Submitted Successfully.', 'url'=> route('calendarList' ,$CalendarManagementForm->id)]);
       
    }

}



?>