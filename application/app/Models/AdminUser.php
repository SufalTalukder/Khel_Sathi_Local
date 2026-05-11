<?php

namespace App\Models;

use App\Events\ChangePasswordLog;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AdminUser extends Authenticatable
{
    use HasFactory;

    protected $table = 'admin';

    protected $fillable = [
        'department_id',
        'admin_role',
        'email',
        'mobile',
        'password',
        'user_password',
        'user_type'
    ];

    static function changePassword($req)
    {

        if (!Hash::check($req->old_password, Auth::guard('admin')->user()->password))
            return response()->json(["error" => true, "msg" => "The old password does not match our records."]);

        if (Hash::check($req->password, Auth::guard('admin')->user()->password))
            return response()->json(["error" => true, "msg" => "Old password and New password cannot be same"]);


       $checkold =  DB::table('change_password_log')->where('type', 1)->where('email',Auth::guard('admin')->user()->email )->where('user_id',Auth::guard('admin')->user()->id)->take(3)->orderByDesc('id')->get();


       if($checkold){
           foreach ($checkold as $key => $value) {
               if($value->password == $req->password){
                return response()->json(["error" => true, "msg" => "Old password cannot be same"]);

               }
           }
       }
    //   ChangePasswordLog::dispatch(1, Auth::guard('admin')->user()->id,Auth::guard('admin')->user()->email, $req->password );

        DB::table('admin')->where('id', Auth::guard('admin')->user()->id)->update([
            'password' => Hash::make($req->password),
            'user_password' => $req->password
        ]);


        // UserLoggedIn::dispatch(Auth::guard('rsouser')->user()->id, 2,3,'rsouser');
        Auth::guard('admin')->logout();

        // return redirect('rso/login');
        session()->flash('success', 'Password Successfully changed.');
        return response()->json(["error" => false, "url" => url('admin/login')]);
    }
}
