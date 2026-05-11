@extends('layouts/web')
@section('content')


<div class="row">
    <div class="col-md-6 loginsidebar">
        <div class="row justify-content-md-center">
            <div class="col-12 col-md-4 col-lg-2 text-center mb-3">
                <img src="{{ asset('assets_admin/images/logo.png') }}" class="img-fluid mobile-resp" />
            </div>
            <div class="col-md-12 col-12 deptname">
                <h3 class="hd-org">Khel Sathi Portal/खेल साथी पोर्टल</h3>
            </div>
            <div class="col-md-12 pt-1 deptname">
                <h3 class="text-success">Department of Sports, Government of Uttar Pradesh<br>
                    खेल विभाग, उत्तर प्रदेश सरकार
                </h3>
                <h5 class="text-success">
                    Nomination Form to Seek Reward from Government of UP<br>उ0प्र0 सरकार से पुरस्कार प्राप्त करने हेतु नामांकन प्रपत्र
                </h5>
            </div>
        </div>
    </div>
    <div class="col-md-6 bg-light1">
        <div class="p-4 p-lg-5 login-form">
            <div class="text-center text-md-center mb-2 mt-md-0">
                <h3 class="mb-0">OTP Verification/ओटीपी सत्यापन</h3>
                <div class="d-flex justify-content-center align-items-center mt-2"><span class="fw-normal">Enter the OTP sent on your Mobile No. and Email ID/आपके मोबाइल नंबर और ईमेल आईडी पर भेजे गए ओटीपी को भरकर सत्यापित करें</span>
                </div>
            </div>
            <form action="{{ route('otpVerify') }}" method="post" id="otpVerify" class="needs-validation" novalidate>
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
                        <a href="javascript:void(0)" class="fw-bold  after-time-out" style="display: none;" id="resend_otp" onclick="resendOtp()">Resend OTP/ओटीपी पुनः भेजें</a>
                    </span>
                </div>
                <div class="d-grid mb-3">
                    <button class="btn btn-info" type="submit">
                        Verify/सत्यापित करें
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>



@endsection
@push('custom-scripts')
<script>
    // var timeleft = 20;
    // console.log(timeleft);
    // var downloadTimer = setInterval(function () {
    //     if (timeleft <= 0) {
    //         clearInterval(downloadTimer);
    //         $(".after-time-out").show();
    //         $(".otp-time").hide();
    //         document.getElementById("countdown").innerHTML = "Finished";

    //     } else {
    //         document.getElementById("countdown").innerHTML = timeleft + "";
    //     }
    //     timeleft -= 1;
    // }, 1000);

    // $(".after-time-out").hide();
    //     var downloadTimer = setInterval(function () {
    //         if (timeleft <= 0) {
    //         $(".after-time-out").show();
    //         $(".otp-time").hide();
    //         } else {
    //             $("#countdown").html(timeleft);
    //         }
    //         timeleft -= 1;
    //     }, 1000);
</script>
@endpush
