@extends( 'layouts\eklavya_kreeda_kosh_layout' )
@section('content')
<div class="col-md-6 bg-light1">
    <div class="p-4 p-lg-5 login-form">
        <div class="text-center text-md-center mb-4 mt-md-0">
            <h3 class="mb-0">OTP Verification/ओटीपी सत्यापन</h3>
            <div class="d-flex justify-content-center align-items-center mt-2"><span class="fw-normal">Enter the OTP sent on your Mobile No. and Email ID/आपके मोबाइल नंबर और ईमेल आईडी पर भेजे गए ओटीपी को भरकर सत्यापित करें</span>
        </div>
        <form action="{{ url('eklavyaFund/otp') }}" class="mt-4" method="POST" id="otpVerify">
            @csrf
            <div class="form-group mb-3">
                <label for="password-field">Enter OTP/ओटीपी भरें</label>

                <div class="row">
                    <div class="col">
                        <div class="input-group">
                            <input type="type" name="otp1" id="otp1" class="form-control" maxlength="1" oninput="return IsNumeric(event,2)" required>
                            <input type="type" name="otp2" id="otp2" class="form-control " maxlength="1" oninput="return IsNumeric(event,3)" required>
                            <input type="type" name="otp3" id="otp3" class="form-control " maxlength="1" oninput="return IsNumeric(event,4)" required>
                        </div>
                    </div>
                    <div class="col-1 otp-dash">-</div>
                    <div class="col">
                        <div class="input-group">
                            <input type="type" name="otp4" id="otp4" class="form-control " maxlength="1" oninput="return IsNumeric(event,5)" required>
                            <input type="type" name="otp5" id="otp5" class="form-control " maxlength="1" oninput="return IsNumeric(event,6)" required>
                            <input type="type" name="otp6" id="otp6" class="form-control " maxlength="1" oninput="return IsNumeric(event,7)" required>
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
            
            <div class="text-center mb-3">
                {{-- <div class="d-grid mb-3"><a href="#" class="btn btn-info" data-bs-toggle="modal" data-bs-target="#verify">Verify/सत्यापित करें</a> </div> --}}
                <button type="submit" class="btn btn-outline-danger rounded-pill w-50 ">Verify/सत्यापित करें</button> </div>
        </form>
    </div>
</div>
<div class="modal fade" id="verify" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-body text-center">
                <p>
                    <img src="{{url('public/eklavya_fund')}}/images/sent.png" alt="Sent" title="Sent">
                </p>
                <div class="clearfix"></div>
                <h5>
                    Your Registration is completed and Password has been sent on your registered Mobile No. & Email ID. Kindly Login to proceed.<br />
                    आपका पंजीकरण पूरा हो गया है और आपके पंजीकृत मोबाइल नंबर और ईमेल आईडी पर पासवर्ड भेज दिया गया है। कृपया आगे बढ़ने के लिए लॉगिन करें।
                </h5>
            </div>
            <div class="modal-footer justify-content-md-center">
                <div class="col-4 d-grid">
                    <a class="btn btn-info" href="{{url('eklavyaFund')}}">OK</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('custom-scripts')
<script>
 

</script>
@endpush

