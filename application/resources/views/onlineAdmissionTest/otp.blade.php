@extends('layouts/web')
@section('content')

<style>
    html { height: 100%; overflow: hidden; }
    body { height: 100%; }
    .container-fluid { height: calc(100vh - 38px); padding: 0; }
    .row.admission-row { height: 100%; margin: 0; }
    .admission-row .loginsidebar { height: 100vh; overflow: hidden; padding: 0; }
    .admission-row .scroll-panel { height: 100%; overflow-y: auto; padding: 20px 30px 50px; }
    footer { position: fixed; bottom: 0; left: 0; right: 0; z-index: 99; background: #fff; border-top: 1px solid #eee; }
</style>

<div class="row admission-row">

    <div class="d-none d-md-block col-md-6 loginsidebar">
        <div class="row justify-content-md-center">
            <div class="col-12 col-md-4 col-lg-2 text-center mb-3">
                <img src="{{ asset('onlineAdmission_storage/images/dash-logo.png') }}" class="img-fluid mobile-resp"/>
            </div>
            <div class="col-md-12 col-12 deptname">
                <h3 class="hd-org">Khel Sathi Portal/खेल साथी पोर्टल</h3>
            </div>
            <div class="col-md-12 pt-1 deptname">
                <h3 class="text-success">Department of Sports, Government of Uttar Pradesh<br>
                    खेल विभाग, उत्तर प्रदेश सरकार
                </h3>
                <h5 class="text-success">
                    Sports College Admission<br>स्पोर्ट कॉलेज प्रवेश
                </h5>
            </div>
        </div>
    </div>

    <div class="col-md-6 bg-light1 scroll-panel">
        <div class="pt-2 login-form">
            <div class="text-center text-md-center mt-md-0">
                <h3 class="mb-0">OTP Verification/ओटीपी सत्यापन</h3>
                <p class="text-muted small mt-2">An OTP has been sent on your registered Mobile No. &amp; Email ID.<br>
                    पंजीकृत मोबाइल नंबर व ईमेल आईडी पर ओटीपी भेज दिया गया है।</p>
            </div>

            <form action="{{ route('onlineAdmissionTest.otpVerify') }}" id="otpForm" class="mt-3 needs-validation" novalidate method="post">
                @csrf
                <div class="form-group mb-4 text-center">
                    <label class="mb-3 fw-semibold">Enter OTP/ओटीपी भरें</label>
                    <div class="d-flex gap-2 justify-content-center">
                        <input type="text" name="otp1" class="form-control text-center otp fw-bold fs-5" maxlength="1" required style="width:52px">
                        <input type="text" name="otp2" class="form-control text-center otp fw-bold fs-5" maxlength="1" required style="width:52px">
                        <input type="text" name="otp3" class="form-control text-center otp fw-bold fs-5" maxlength="1" required style="width:52px">
                        <input type="text" name="otp4" class="form-control text-center otp fw-bold fs-5" maxlength="1" required style="width:52px">
                        <input type="text" name="otp5" class="form-control text-center otp fw-bold fs-5" maxlength="1" required style="width:52px">
                        <input type="text" name="otp6" class="form-control text-center otp fw-bold fs-5" maxlength="1" required style="width:52px">
                    </div>
                </div>
                <div class="d-grid mb-3">
                    <button type="submit" class="btn btn-outline-danger rounded-pill">
                        <i class="fa fa-check-circle"></i> Verify OTP/ओटीपी सत्यापित करें
                    </button>
                </div>
            </form>

            <div class="text-center mt-2">
                <a href="javascript:void(0)" id="resendBtn" class="small fw-bold">
                    Didn't receive OTP? Resend/ओटीपी नहीं मिला? पुनः भेजें
                </a>
            </div>
        </div>
    </div>

</div>

@endsection

@push('custom-scripts')
<script>
$('.otp').keyup(function(){
    if(this.value.length == this.maxLength){ $(this).next('.otp').focus(); }
});
$('.otp').keydown(function(e){
    if(e.key==='Backspace' && !this.value){ $(this).prev('.otp').focus(); }
});

$("#otpForm").submit(function(e){
    e.preventDefault();
    if(!this.checkValidity()){ $(this).addClass('was-validated'); return; }
    $.ajax({
        type:"POST", url:$(this).attr("action"),
        data: new FormData(this),
        dataType:"json", contentType:false, cache:false, processData:false,
        success: function(res){
            if(res.error==false){ success(res.msg); setTimeout(()=>{ window.location.href=res.url; },1000); }
            else{ error(res.msg); }
        }
    });
});

$("#resendBtn").click(function(){
    $(this).text('Sending.../भेज रहे हैं...').css('pointer-events','none');
    var self = this;
    $.ajax({
        type:"POST", url:"{{ route('onlineAdmissionTest.resendOtp') }}",
        data:{_token:"{{ csrf_token() }}"}, dataType:"json",
        success: function(res){
            if(res.error==false){ success(res.msg); } else{ error(res.msg); }
            $(self).text('Resend OTP/ओटीपी पुनः भेजें').css('pointer-events','auto');
        }
    });
});
</script>
@endpush
