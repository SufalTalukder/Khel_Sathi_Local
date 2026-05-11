<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\User;

class RegisteredUser extends Controller
{
   public function registeredUsers()
   {
      // dd("hello");
      $users =  DB::table('sport_welfare_registration_master')->orderBy('id', 'DESC')->get();
      return view('admin.user.userlist', compact('users'));
   }

   public function usermanage()
   {
      $users =  DB::table('up_investor_registration_master')->orderBy('id', 'DESC')->get();
      return view('admin.user.usermanage', compact('users'));
   }


   public function userslist()
   {
      $users =  DB::table('admin')->orderBy('id', 'DESC')->get();
      return view('admin.user.userslist', compact('users'));
   }


   public function usersStatus($id)
   {
      $status = DB::table('up_investor_registration_master')->where('id', $id)->first()->status;
      DB::table('up_investor_registration_master')->where('id', $id)->update(["status" => $status == 1 ? 0 : 1]);
      $msg = $status == 0 ? "Enabled" : "Disabled";
      return response()->json(['error' => false, "msg" => 'User Successfully .' . $msg]);
   }

   public function edituser($id)
   {
      $item =  DB::table('up_investor_registration_master')->where('id', $id)->first();
      $roles =  DB::table('urm_role_manager')->where('role_status', 1)->orderBy('role_name', 'ASC')->get();
      $country = DB::table('countries')->get();
      return view('admin.user.edituser', compact('item', 'roles', 'country'));
   }

   public function updateUser(Request $req)
   {
      $validation = Validator::make($req->all(), [
         'authorized_person' => 'required|max:500',
         'rolename'          => 'required',
         'email'             => 'required|email',
         'mobile'            => 'required|numeric|digits:10',
         'pancardno'         => 'nullable|regex:/^([a-zA-Z]){5}([0-9]){4}([a-zA-Z]){1}?$/',
         'gstno'             => 'nullable|regex:/^[0-9]{2}[A-Z]{5}[0-9]{4}[A-Z]{1}[1-9A-Z]{1}Z[0-9A-Z]{1}$/',
         'country'           => 'required',
         'state'             => 'required',
         'district'          => 'required',
         'address'           => 'required',
      ], msg());

      if ($validation->fails())
         return response()->json(['error' => true, 'msg' => $validation->errors()->first()]);

      User::updateUser($req);

      return response()->json(['error' => false]);
   }
   public function deleteUser($id){
      DB::table('admin')->where('id', '=', $id)->delete();
      return redirect()->back()->with("success", "User Successfully Deleted.");
    }
}
