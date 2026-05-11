<?php

namespace App\Listeners;

use App\Events\SmsMail;
use App\Models\HostelRegister;
use App\Models\PlayerCoach;
use App\Models\PlayerRegistration;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

class SmsMailFired
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  \App\Events\SmsMail  $event
     * @return void
     */
    public function handle(SmsMail $event)
    {
        if ($event->type == 1) {


            $otp = $event->item['otp'];
            // dd($event->item['email']);

            // try {
            //     Mail::to($event->item['email'])->send(new \App\Mail\OtpSend($otp, 'OTP to Register'));
            // } catch (Throwable $e) {
            //     report($e);

            //     //return false;
            // }

            try {

                Mail::to($event->item['email'])->send(new \App\Mail\OtpSend($otp, 'OTP to Register'));


              } catch (\Exception $e) {

                  return true;
              }

            $message = 'Your OTP for Registration is ' . $otp . '-OMNINET TECHNOLOGIES PVT LTD';
            //    dd($message);
            // $message = "Your OTP to register on File Investment Intent Portal is  $otp . (Invest UP) Udyog Bandhu";
            // $message = "Your OTP to register on File Investment Intent Portal is  $otp . (Invest UP) Udyog Bandhu";
            SendSMS($event->item['mobile'], $message);

        } elseif ($event->type == 2) {
            // dd($users);
            $users = DB::table('sport_welfare_registration')->select('fullname', 'email', 'user_password')->where('id', $event->item['id'])->first();
            $user = DB::table('sport_welfare_registration_master')->where('sport_welfare_registration_master.email', $users->email)->first();
            try {
                Mail::to($users->email)->send(new \App\Mail\RegistrationSuccess($users->fullname, $users->email, $user->user_password));
            }  catch (\Exception $e) {

                return true;
            }



        } elseif ($event->type == 4) {
            $password = $event->item['password'];
            $email = $event->item['email'];
            $users = DB::table('sport_welfare_registration_master')->select('fullname', 'email', 'user_password')->where('email', $email)->first();

            try {
                Mail::to($users->email)->send(new \App\Mail\ForgetPassword($users->fullname, $users->email, $users->user_password));
            }  catch (\Exception $e) {

                  return true;
              }

            $message = 'Your password has been changed. Your User ID is ' . $email . ' and Password is [' . $password . ']. Omninet Technologies Pvt. Ltd.';
            //    dd($message);
            // $message = "Your OTP to register on File Investment Intent Portal is  $otp . (Invest UP) Udyog Bandhu";
            // $message = "Your OTP to register on File Investment Intent Portal is  $otp . (Invest UP) Udyog Bandhu";
            SendPassword($event->item['mobile'], $message);

        } elseif ($event->type == 5) {
            $users = HostelRegister::where('id', $event->item['id'])->first();

            try {
                Mail::to($users->email)->send(new \App\Mail\RegistrationSuccess($users->name, $users->email, $users->decoded_password));
            }  catch (\Exception $e) {

                  return true;
              }


        } elseif ($event->type == 6) {
            $password = $event->item['password'];
            $email = $event->item['email'];
            $users = HostelRegister::where('email', $email)->first();

            try {
                Mail::to($users->email)->send(new \App\Mail\ForgetPassword($users->name, $users->email, $users->decoded_password));
            }  catch (\Exception $e) {

                  return true;
              }

            $message = 'Your password has been changed. Your User ID is ' . $email . ' and Password is [' . $users->decoded_password . ']. Omninet Technologies Pvt. Ltd.';
            //    dd($message);
            // $message = "Your OTP to register on File Investment Intent Portal is  $otp . (Invest UP) Udyog Bandhu";
            // $message = "Your OTP to register on File Investment Intent Portal is  $otp . (Invest UP) Udyog Bandhu";
            SendPassword($event->item['mobile'], $message);
        } elseif ($event->type == 11) {
            if (isset($event->item['otp'])) {
                $otp = $event->item['otp'];
                // dd($event->item['email']);


                    Mail::to($event->item['email'])->send(new \App\Mail\OtpSend($otp, 'OTP to Register'));

                $message = 'Your OTP for Registration is ' . $otp . '-OMNINET TECHNOLOGIES PVT LTD';
                SendSMS($event->item['mobile'], $message);}
            } elseif ($event->type == 9)  {

                $users = DB::table('sport_welfare_registration_master')->select('fullname', 'email', 'user_password')->where('email', $event->item['email'])->first();


                    Mail::to($event->email)->send(new \App\Mail\ForgetPassword($users->fullname, $users->email, $users->user_password));



            }elseif ($event->type == 12) {
                // dd($event->item);
                   $applicationNo = $event->item['applicationNo'];
                              $password = $event->item['password'];
                              $email = $event->item['email'];
                              $users = DB::table('admission_registration_login')->select('fullname', 'email', 'application_no', 'user_password' , 'mobile')->where('application_no', $event->item['applicationNo'])->first();



                                      Mail::to($users->email)->send(new \App\Mail\RegistrationSuccess($users->fullname, $users->application_no, $users->user_password));



                              $message = 'You are successfully registered on Khel Sathi Portal. Kindly login with the User ID ' . $users->application_no . ' and Password ' . $users->user_password . '. -Omninet Technologies Pvt. Ltd.' ;

                              loginCredential($event->item['mobile'], $message);
            }elseif ($event->type == 13) {
                $password = $event->item['password'];
                $email = $event->item['email'];
                $users = DB::table('admission_registration_login')->select('fullname', 'email', 'application_no', 'user_password' , 'mobile')->where('aadhar_no', $event->item['aadhar_no'])->first();


                    Mail::to($users->email)->send(new \App\Mail\ForgetPassword($users->fullname, $users->application_no, $users->user_password));



                $message = 'Please login with the User ID ' . $users->application_no . 'and the Password ' . $users->user_password . ' on Khel Sathi Portal. -Omninet Technologies Pvt. Ltd.' ;

                forgotpassword($users->mobile, $message);
            }

            elseif ($event->type == 14) {
                $password = $event->item['password'];
                $email = $event->item['email'];
                $users = DB::table('direct_recruitment')->select('fullname', 'email', 'user_password')->where('email', $email)->first();

                try {
                    Mail::to($users->email)->send(new \App\Mail\ForgetPassword($users->fullname, $users->email, $users->user_password));
                } catch (Throwable $e) {
                    //report($e);

                    //return false;
                }
                $message = 'Your password has been changed. Your User ID is ' . $email . ' and Password is [' . $password . ']. Omninet Technologies Pvt. Ltd.';
                //    dd($message);
                // $message = "Your OTP to register on File Investment Intent Portal is  $otp . (Invest UP) Udyog Bandhu";
                // $message = "Your OTP to register on File Investment Intent Portal is  $otp . (Invest UP) Udyog Bandhu";
                SendPassword($event->item['mobile'], $message);

            }
            elseif ($event->type == 15) {
                // dd($users);

                $users = DB::table('direct_recruitment')->select('fullname', 'email', 'user_password','mobile')->where('user_id', $event->item['id'])->first();
                $message = 'Your password has been changed. Your User ID is ' . $users->email . ' and Password is [' .  $users->user_password . ']. Omninet Technologies Pvt. Ltd.';
                SendPassword( $users->mobile, $message);
                try {
                    Mail::to($users->email)->send(new \App\Mail\RegistrationSuccess($users->fullname, $users->email, $users->user_password));
                }  catch (\Exception $e) {

                    return true;
                }



            }elseif ($event->type == 16) {
                $password = $event->item['password'];
                $email = $event->item['email'];
                $users = DB::table('player_registration')->select('name', 'email', 'dob', 'decoded_password' , 'mobile')->where('email', $event->item['email'])->first();
                Mail::to($users->email)->send(new \App\Mail\ForgetPassword($users->name, $users->email, $users->decoded_password));
                $message = 'Please login with the User ID ' . $users->email . 'and the Password ' . $users->decoded_password . ' on Khel Sathi Portal. -Omninet Technologies Pvt. Ltd.' ;

                forgotpassword($users->mobile, $message);
            } elseif ($event->type == 17) {
                $users = PlayerCoach::where('id', $event->item['id'])->first();

                try {
                    Mail::to($users->email)->send(new \App\Mail\RegistrationSuccess($users->fullname, $users->email, $users->decoded_password));


                } catch (\Exception $e) {

                    return true;
                }


            }
elseif ($event->type == 18) {
                $password = $event->item['password'];
                $email = $event->item['email'];
                $users = DB::table('facility_booking_register')->select('name', 'email', 'dob', 'decoded_password' , 'mobile')->where('email', $event->item['email'])->first();
                Mail::to($users->email)->send(new \App\Mail\ForgetPassword($users->name, $users->email, $users->decoded_password));
                $message = 'Please login with the User ID ' . $users->email . 'and the Password ' . $users->decoded_password . ' on Khel Sathi Portal. -Omninet Technologies Pvt. Ltd.' ;

                forgotpassword($users->mobile, $message);
            } elseif ($event->type == 19) {
                $users = FacilityRegister::where('id', $event->item['id'])->first();
                try {
                    Mail::to($users->email)->send(new \App\Mail\RegistrationSuccess($users->fullname, $users->email, $users->decoded_password));
                } catch (\Exception $e) {
                    return true;
                }
            }


            elseif ($event->type == 20) {
                $users = CoachingCamp::where('id', $event->item['id'])->first();

                try {
                    Mail::to($users->email)->send(new \App\Mail\RegistrationSuccess($users->name, $users->email, $users->decoded_password));


                } catch (\Exception $e) {

                    return true;
                }


            }
        }




}
