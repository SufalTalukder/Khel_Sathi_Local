@extends( 'layouts.onlineAdmissionnav' )
@section('content')
<div class="col-md-6 bg-light1">
                <div class="p-4 p-lg-5 login-form">
                    <div class="text-center text-md-center mb-4 mt-md-0">
                        <h3 class="mb-0">Login</h3>

                        {{-- TEMPORARILY DISABLED - Opening Soon --}}
                        {{-- <div class="d-flex justify-content-center align-items-center mt-2"><span class="fw-normal">Don't have an account? <a href="{{route('onlineAdmission.register')}}" class="fw-bold">Register Here </a>
अकाउंट नहीं है? <a href="{{route('onlineAdmission.register')}}" class="fw-bold">अभी पंजीकरण करें</a></span></div> --}}

                        {{-- TEMPORARILY DISABLED: Opening Soon Notice --}}
                        <div class="mt-3 mb-2">
                            <div style="border:2px solid #fd7e14; border-radius:10px; padding:14px 18px; background:linear-gradient(135deg,#fff8f0,#fff3e0);">
                                <div style="font-size:18px; font-weight:800; color:#fd7e14; letter-spacing:1px;">🕐 New Applications: Opening Soon</div>
                                <div style="font-size:12px; color:#6c757d; margin-top:6px;">
                                    New registrations for Sports College Admission are not available at the moment.<br>
                                    <span>स्पोर्ट्स कॉलेज प्रवेश हेतु नए पंजीकरण अभी उपलब्ध नहीं हैं।</span>
                                </div>
                                <div style="margin-top:8px;">
                                    <span style="display:inline-block;background:#fd7e14;color:#fff;font-size:11px;font-weight:700;padding:3px 12px;border-radius:20px;letter-spacing:0.5px;">Opening Soon / जल्द आ रहा है</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <form action="{{route('onlineAdmission.login')}}" id="gymsubmit" class="mt-4 needs-validation" novalidate method="post">
            @csrf


                        <div class="form-group mb-3">
                            <label for="email">1. Registered Application Number/पंजीकृत आवेदन संख्या</label>
                            <input type="text" name="appl_no" class="form-control " id="email" value="{{old('email')}}" required>
                @error('email')
                        <div class="text-danger">{{ $message }}</div>
                 @enderror
                        </div>
                        <div class="form-group">
                            <div class="form-group mb-3">
                                <label for="password-field">2. Password/पासवर्ड</label>
                                <input type="password" name="password" class="form-control " id="password-field"  value="{{old('password')}}" required>
                                <span toggle="#password-field" class="fa fa-fw fa-eye field-icon toggle-password"></span>
                                @error('password')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="captcha">
                                <div class="captcha">
                                    <label class="btn-block">3. Captcha/कैप्चा</label>
                                    <span class="unselectable" id="p_refresh">{{$capchaCode}}</span>
                                   <input name="capchaCode" type="hidden" class="form-control captchacode unselectable h4" value="{{$capchaCode}}" readonly>
                                </div> </div>
                        </div>
                        <div class="col-md-1">
                            <div class="refresh"><a href="javascript:void(0)" title="Refresh Captcha"><span class="fas fa-redo"></span></a></div>
                        </div>
                        <div class="col-md-5">
                            <label>4. Enter Captcha/कैप्चा भरें</label>
                            <input name="captcha" type="text" class="form-control "  value="{{old('captcha')}}" required>
                            @error('captcha')
                             <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>
                        </div>
                        <div class="d-grid mb-3"><button type="submit" class="btn btn-outline-danger rounded-pill">Sign in/लॉगिन करें</button></div>
                        <div class="clearfix"></div>
                        <div class="d-flex justify-content-between align-items-top">
                            <a href="{{ route('onlineAdmission.forgot') }}" class="small text-right"><b>Forgot Password?/पासवर्ड भूल गए?</b></a>

                        </div>
                    </form>
                </div>
                </div>
                @endsection



    @push('custom-scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/crypto-js/3.1.9-1/crypto-js.js"></script>
    <script>
    $(".refresh").on("click", function () {
        $.ajax({
            type: "GET",
            url: ajaxUrl + "/player_coach/cp_refresh/",
            dataType: "json",
            success: function (res) {
                console.log(res)
                $("#p_refresh").html(res.capchaCode);
                $(".captchacode").val(res.capchaCode);
                // $(".refreshc").val(res.capchaCode);
            },
        });
    });



$("#gymsubmit").submit(function (e) {

e.preventDefault();
if ($("#gymsubmit")[0].checkValidity() === false) {
    e.stopPropagation();
} else {
    // Encryption logic
    if ($("#password-field").val() != '') {
        var dataToEncrypt = $("#password-field").val();
        var encryptionKey = "2b7e151628aed2a6abf7158809cf4f3c";
        var keyHex = CryptoJS.enc.Hex.parse(encryptionKey);
        var encrypted = CryptoJS.AES.encrypt(dataToEncrypt, keyHex, {
            mode: CryptoJS.mode.ECB
        });
        $("#password-field").val(encrypted.toString());
        
        var mdataToEncrypt = $("#email").val();
        var mencryptKey = "2b7e151628aed2a6abf7158809cf4f3c";
        var mkeyHex = CryptoJS.enc.Hex.parse(mencryptKey);
        var mencrypted = CryptoJS.AES.encrypt(mdataToEncrypt, mkeyHex, {
            mode: CryptoJS.mode.ECB
        });
        $("#email").val(mencrypted.toString());
    }

    $.ajax({
        type: "POST",
        url: $(this).attr("action"),
        data: new FormData(this),
        dataType: "json",
        contentType: false,
        cache: false,
        processData: false,
        success: function (res) {
            if (res.error == false) {
                success(res.msg);
                if(res.route) {
                    window.location.href = ajaxUrl + '/' + res.route;
                } else if (res.url) {
                    window.location.href = res.url;
                }
            } else {
                error(res.msg);
                // Refresh captcha on failure or reset encryption if needed? 
                // Usually better to reload or reset field
                location.reload(); 
            }
        },
        error: function() {
            location.reload();
        }
    });
}
$("#gymsubmit").addClass("was-validated");
});

</script>

    @endpush
