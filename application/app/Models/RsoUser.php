<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
class RsoUser extends Authenticatable
{
    use HasFactory;

    protected $table = 'rsouser';

    protected $fillable = [
        'name',
        'role',
        'email',
        'mobile',
        'password',
        'user_password'
    ];

    static function changePassword($req)
    {

        if (!Hash::check($req->old_password, Auth::guard('rsouser')->user()->password))
            return response()->json(["error" => true, "msg" => "The old password does not match our records."]);

        if (Hash::check($req->password, Auth::guard('rsouser')->user()->password))
            return response()->json(["error" => true, "msg" => "Old password and New password cannot be same"]);

        DB::table('rsouser')->where('id', Auth::guard('rsouser')->user()->id)->update([
            'password' => Hash::make($req->password),
            'user_password' => $req->password
        ]);
        // UserLoggedIn::dispatch(Auth::guard('rsouser')->user()->id, 2,3,'rsouser');
        Auth::guard('rsouser')->logout();
       
        // return redirect('rso/login');
        session()->flash('success', 'Password Successfully changed.');
        return response()->json(["error" => false, "url" => url('rso/login')]);
    }
}

