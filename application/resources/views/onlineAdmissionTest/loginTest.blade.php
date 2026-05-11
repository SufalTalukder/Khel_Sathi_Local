@extends('layouts/web')
@section('content')

<style>
    html { height: 100%; overflow: hidden; }
    body { height: 100%; }

    .container-fluid { height: calc(100vh - 38px); padding: 0; }

    .row.admission-row {
        height: 100%;
        margin: 0;
    }

    /* .admission-row .loginsidebar {
        height: 100%;
        overflow: hidden;
        padding: 0;
    } */

    /* .admission-row .scroll-panel {
        height: 100%;
        overflow-y: auto;
        padding: 20px 30px 50px;
    } */

footer {
        position: fixed;
        bottom: 0;
        left: 0;
        right: 0;
        z-index: 99;
        background: #fff;
        border-top: 1px solid #eee;
    }

    /* .admission-row .loginsidebar {
        height: 100vh;
    } */
</style>

<div class="row admission-row">

    {{-- LEFT SIDEBAR — identical to auth/login.blade.php --}}
    <!-- <div class="d-none d-md-block col-md-6 loginsidebar">
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
    </div> -->
    <div class="col-md-6 loginsidebar">
            <div class="row justify-content-center">
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

    {{-- RIGHT FORM PANEL — independently scrollable --}}
    <div class="col-md-6 bg-light1 scroll-panel">
        <!-- <div class="row d-md-none justify-content-center">
            <div class="col-6 col-md-4 col-lg-2 text-center mb-3">
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
        </div> -->
        <div class="p-3 p-lg-4 login-form">
            <div class="text-center text-md-center mb-2 mt-md-0">
                <h3 class="mb-0">Applicant's Login/आवेदक का लॉगिन</h3>
                <div class="d-flex justify-content-center align-items-center mt-2">
                    <span class="fw-normal">Don't have an account?
                        <a href="{{ route('onlineAdmissionTest.register') }}" class="fw-bold">Register Here/अभी पंजीकरण करें</a>
                    </span>
                </div>
            </div>

            <form action="{{ route('onlineAdmissionTest.login') }}" method="post" id="gymsubmit" class="mt-4 needs-validation" novalidate>
                @csrf

                <div class="form-group mb-3">
                    <label for="appl_no">1. Registered Application Number/पंजीकृत आवेदन संख्या</label>
                    <input type="text" name="appl_no" class="form-control" id="appl_no" value="{{ old('appl_no') }}" required>
                </div>

                <div class="form-group mb-3">
                    <label for="password-field">2. Password/पासवर्ड</label>
                    <div class="input-group">
                        <input type="password" name="password" class="form-control" id="password-field" required>
                        <span class="input-group-text" style="cursor:pointer;"><i class="fa fa-fw fa-eye toggle-password" toggle="#password-field"></i></span>
                    </div>
                    <div class="text-end mt-1">
                        <a href="{{ route('onlineAdmissionTest.forgotPassword') }}" class="small">Forgot Password?/पासवर्ड भूल गए?</a>
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-md-5 col-5">
                        <div class="captcha">
                            <label class="btn-block">3. Captcha/कैप्चा</label>
                            <span class="unselectable" id="p_refresh">{{ $capchaCode }}</span>
                            <input name="capchaCode" type="hidden" class="captchacode" value="{{ $capchaCode }}">
                        </div>
                    </div>
                    <div class="col-md-1 col-1 refresh">
                        <div class="cp_refresh">
                            <a href="javascript:void(0)" title="Refresh Captcha"><span class="fas fa-redo"></span></a>
                        </div>
                    </div>
                    <div class="col-md-6 col-6">
                        <label>4. Enter Captcha/कैप्चा भरें</label>
                        <input name="captcha" type="text" class="form-control" required>
                    </div>
                </div>

                <div class="justify-content-center row mt-4">
                    <div class="col-md-6">
                        <button type="submit" class="btn btn-outline-danger w-100 rounded-pill">Sign in/लॉगिन करें</button>
                    </div>
                </div>
                <div class="d-grid mb-2">
                    <a href="{{url('public/onlineAdmission_storage/sports_college_notification_2026_2027.pdf')}}" target="_blank"
                        class="btn btn-outline-success text-center blink_me">
                        <b>आवेदन हेतु निर्धारित अ्हताएं / योग्यता एवं निर्देश</b>
                    </a>
                </div>
            </form>
        </div>
    </div>

</div>

@endsection

@push('custom-scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/crypto-js/3.1.9-1/crypto-js.js"></script>
<script>
$(".refresh a, .cp_refresh a").on("click", function () {
    $.ajax({ type: "GET", url: ajaxUrl + "/player_coach/cp_refresh/", dataType: "json",
        success: function (res) { $("#p_refresh").html(res.capchaCode); $(".captchacode").val(res.capchaCode); }
    });
});

$("#gymsubmit").submit(function (e) {
    e.preventDefault();
    if (!this.checkValidity()) { $(this).addClass('was-validated'); return; }

    var key    = CryptoJS.enc.Hex.parse("2b7e151628aed2a6abf7158809cf4f3c");
    var encPwd = CryptoJS.AES.encrypt($("#password-field").val(), key, { mode: CryptoJS.mode.ECB }).toString();
    var encId  = CryptoJS.AES.encrypt($("#appl_no").val(),        key, { mode: CryptoJS.mode.ECB }).toString();
    $("#password-field").val(encPwd);
    $("#appl_no").val(encId);

    $.ajax({
        type: "POST", url: $(this).attr("action"),
        data: new FormData(this), dataType: "json",
        contentType: false, cache: false, processData: false,
        success: function (res) {
            if (res.error == false) { success(res.msg); window.location.href = ajaxUrl + '/' + res.route; }
            else { error(res.msg); location.reload(); }
        },
        error: function () { location.reload(); }
    });
});
</script>
@endpush
