@extends('layouts\admin_layout_hostelAuth')
@section('hostelcontent')
    <div class="col-md-6 bg-light1">
        <div class="p-4 p-lg-5 login-form">
            <div class="text-center text-md-center mb-2 mt-md-0">
                <h3 class="mb-0">OTP Verification/ओटीपी सत्यापन</h3>
                <div class="d-flex justify-content-center align-items-center mt-2"><span class="fw-normal">Kindly fill and
                        verify the OTP sent on the entered Mobile No./Email ID.<br>
                        भरे गए मोबाइल नंबर/ईमेल आईडी पर प्राप्त ओटीपी को भरकर सत्यापित करें।
                    </span></div>
            </div>
            <form action="{{ route('hostel.otpStore') }}" class="mt-4 needs-validation" novalidate method="POST">
                @csrf
                <div class="form-group">
                    <label for="password-field">Enter OTP/ओटीपी दर्ज करें</label>
                    <div class="row">
                        <div class="col">
                            <div class="input-group">
                                <input type="type" name="otp1" id="otp1" class="form-control" maxlength="1"
                                    oninput="return IsNumeric(event,2)" required>
                                <input type="type" name="otp2" id="otp2" class="form-control " maxlength="1"
                                    oninput="return IsNumeric(event,3)" required>
                                <input type="type" name="otp3" id="otp3" class="form-control " maxlength="1"
                                    oninput="return IsNumeric(event,4)" required>
                            </div>
                        </div>
                        <div class="col-1 otp-dash">-</div>
                        <div class="col">
                            <div class="input-group">
                                <input type="type" name="otp4" id="otp4" class="form-control "
                                    maxlength="1"oninput="return IsNumeric(event,5)" required>
                                <input type="type" name="otp5" id="otp5" class="form-control " maxlength="1"
                                    oninput="return IsNumeric(event,6)" required>
                                <input type="type" name="otp6" id="otp6" class="form-control " maxlength="1"
                                    oninput="return IsNumeric(event,7)" required>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="clearfix"></div>
                <div class="d-flex justify-content-center align-items-center mt-2 text-center mb-3">
                    <span class="fw-normal text-black-50"><span class="otp-time">Resend OTP after <span
                                id="countdown"></span>Seconds</span><br>
                        <a href="{{ route('hostel.resendotp') }}" class="fw-bold">Resend OTP/ओटीपी पुन: भेजें</a>
                    </span>
                </div>
                <div class="d-grid mb-3"><button type="submit" class="btn btn-info w-100" data-bs-toggle="modal"
                        data-bs-target="#verify">Verify/सत्यापित करें</button> </div>
            </form>
        </div>
    </div>
@endsection

<script>
    function IsNumeric(e, id) {
        console.log(e)
        if (e.data != null)
            $("#otp" + id).focus();
        else
            $("#otp" + (id - 2)).focus();
    }
</script>
