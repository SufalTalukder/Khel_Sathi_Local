@extends('layouts/web')
@section('content')


<div class="row">
    <div class="col-md-6 loginsidebar">
        <div class="row justify-content-center">
            <div class="col-md-6 col-lg-2 text-center mb-3">
                <img src="{{ asset('') }}/images/-logo.png" class="img-fluid mobile-resp" />
            </div>
            <div class="col-md-12 col-12 deptname">
                        <h1 class="hd-org">Khel Sathi Portal/खेल साथी पोर्टल</h1>
                        <h2>Department of Sports, Government of Uttar Pradesh<br>खेल विभाग, उत्तर प्रदेश सरकार</h2>
                    </div>
            <div class="col-md-12 col-12 deptname">
            <h5 class="text-success">Online System for Former Sportspersons of UP to Seek Financial Assistance/Monthly Pension<br>वित्तीय सहायता/मासिक पेंशन प्राप्त करने हेतु उत्तर प्रदेश के पूर्व खिलाड़ियों के लिए ऑनलाइन प्रणाली</h5>

            </div>
        </div>
    </div>
    <div class="col-md-6 bg-light1">
        <div class="p-4 p-lg-5 login-form">
            <div class="text-center text-md-center mb-2 mt-md-0">
                <h3 class="mb-0">OTP Verification<br>ओटीपी सत्यापन</h3>
                <div class="d-flex justify-content-center align-items-center mt-2"><span class="fw-normal">Enter and verify the OTP sent on the Mobile No./Email ID<br>आपके मोबाइल नंबर और ईमेल आईडी पर भेजे गए ओटीपी को भरकर सत्यापित करें</span>
                </div>
            </div>
            <form action="{{ route('faotpVerify') }}" method="post" id="otpVerify" class="needs-validation" novalidate>
                <div class="form-group">
                    <label for="password-field">Enter OTP/ओटीपी भरें</label>
                    <div class="row">
                        <div class="col">
                            <div class="input-group">

                                <input type="text" required id="otp1" name="otp1" aria-label="First name" class="form-control" maxlength="1" oninput="return IsNumeric(event,2);">

                                <input type="text" required id="otp2" name="otp2" aria-label="Last name" class="form-control" maxlength="1" oninput="return IsNumeric(event,3);">

                                <input type="text" required id="otp3" name="otp3" aria-label="Last name" class="form-control" maxlength="1" oninput="return IsNumeric(event,4);">

                            </div>
                        </div>
                        <div class="col-1 otp-dash">-</div>
                        <div class="col">
                            <div class="input-group">

                                <input type="text" required id="otp4" name="otp4" aria-label="First name" class="form-control" maxlength="1" oninput="return IsNumeric(event,5);">

                                <input type="text" required id="otp5" name="otp5" aria-label="Last name" class="form-control" maxlength="1" oninput="return IsNumeric(event,6);">

                                <input type="text" required id="otp6" name="otp6" aria-label="Last name" class="form-control" maxlength="1" oninput="return IsNumeric(event,7);">

                            </div>
                        </div>
                    </div>
                </div>
                <div class="clearfix"></div>
                <div class="d-flex justify-content-center align-items-center mt-2 text-center mb-3">
                    <span class="fw-normal text-black-50">
                        <span class="otp-time">
                            Resend OTP after
                            <span id="countdown"></span>
                            Seconds
                        </span>
                        <br>
                        <a href="javascript:void(0)" class="fw-bold after-time-out" style="display: none;" onclick="resendOtp()">Resend OTP/पुनः भेजें</a>
                    </span>
                </div>
                <div class="d-grid mb-3">
                    <button class="btn btn-info w-100" type="submit">Verify/सत्यापित करें</button>
                </div>
            </form>
        </div>
    </div>
</div>





@endsection
