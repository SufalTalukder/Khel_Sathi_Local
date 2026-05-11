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

    /* Left panel — fixed, does not scroll */
    .admission-row .loginsidebar {
        height: 100%;
        overflow: hidden;
        padding: 0;
    }

    /* Right panel — only this scrolls */
    .admission-row .scroll-panel {
        height: 100%;
        overflow-y: auto;
        padding: 20px 30px 50px;
    }

footer {
        position: fixed;
        bottom: 0;
        left: 0;
        right: 0;
        z-index: 99;
        background: #fff;
        border-top: 1px solid #eee;
    }

    /* Fill left panel all the way to the footer — no gap */
    .admission-row .loginsidebar {
        height: 100vh;
    }
</style>

<div class="row admission-row">

    {{-- LEFT SIDEBAR — same as login page --}}
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

    {{-- RIGHT FORM PANEL — independently scrollable --}}
    <div class="col-md-6 bg-light1 scroll-panel">
        <div class="pt-2 login-form">
            <div class="text-center text-md-center mt-md-0">
                <h3 class="mb-0">Registration/पंजीकरण</h3>
                <div class="d-flex justify-content-center align-items-center mt-2">
                    <span class="fw-normal">Already Registered?/पहले से पंजीकृत?
                        <a href="{{ route('onlineAdmissionTest.loginForm') }}" class="fw-bold">Sign In/लॉगिन करें</a>
                    </span>
                </div>
            </div>

            <form action="{{ route('onlineAdmissionTest.preRegistration') }}" method="post" class="mt-2 needs-validation" novalidate id="gymsubmit">
                @csrf

                <div class="alert alert-success bg-transparent fade show p-2 mb-2" role="alert">
                    <ul class="mb-0">
                        <li>यहां दर्ज की गई जानकारी को सबमिट करने के बाद संशोधित नहीं किया जा सकता / Information entered here can not be modified after submitting.</li>
                    </ul>
                </div>
                <div class="d-grid mb-2">
                    <a href="{{url('public/onlineAdmission_storage/sports_college_notification_2026_2027.pdf')}}" target="_blank"
                        class="btn btn-outline-success text-center ">
                        <b>आवेदन हेतु निर्धारित अ्हताएं / योग्यता एवं निर्देश</b>
                    </a>
                </div>

                <div class="row">

                    <div class="col-lg-12">
                        <div class="form-group row required mb-2">
                            <label class="col-form-label col-lg-5" for="fname">पूरा नाम / Full Name</label>
                            <div class="col-lg-7">
                                <input type="text" class="form-control" value="{{ old('fname') }}" id="fname" required name="fname"
                                    placeholder="Full Name"
                                    onkeypress="return ((event.charCode >= 65 && event.charCode <= 90) || (event.charCode >= 97 && event.charCode <= 122) || (event.charCode == 32))"
                                    pattern="^[A-Za-z -]+$" maxlength="255">
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-12">
                        <div class="form-group row required mb-2">
                            <label class="col-form-label col-lg-5">जन्मतिथि / Date of Birth</label>
                            <div class="col-lg-7">
                                <input type="date" class="form-control" value="{{ old('dateOfBirth') }}"
                                    id="dateOfBirth" name="dateOfBirth" required
                                    min="2009-04-01" max="2017-03-31">
                                <small class="text-muted">Class 6: Age 9–12 years; DOB between 01.04.2014 and 31.03.2017. / कक्षा 6: आयु 9–12 वर्ष; जन्मतिथि 01.04.2014 से 31.03.2017<br>
Class 9: Age 12–15 years; DOB between 01.04.2011 and 31.03.2014. / कक्षा 9: आयु 12–15 वर्ष; जन्मतिथि 01.04.2011 से 31.03.2014<br>
Class 11: Age 14–17 years; DOB between 01.04.2009 and 31.03.2012. / कक्षा 11: आयु 14–17 वर्ष; जन्मतिथि 01.04.2009 से 31.03.2012।</small>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-12">
                        <div class="form-group row required mb-2">
                            <label class="col-form-label col-lg-5">क्या आप उ.प्र. के मूल निवासी हैं? / Are you a native of UP?</label>
                            <div class="col-lg-7 pt-2">
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="native_of_up" id="native_yes" value="1" required>
                                    <label class="form-check-label" for="native_yes">Yes</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="native_of_up" id="native_no" value="2">
                                    <label class="form-check-label" for="native_no">No</label>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-12">
                        <div class="form-group row required mb-2">
                            <label class="col-form-label col-lg-5">लिंग / Gender</label>
                            <div class="col-lg-7 pt-2 ptn">
                                <select class="form-control form-select" name="gender" required>
                                    <option value="">Select/चुनें</option>
                                    <option value="1">Male/पुरुष</option>
                                    <option value="2">Female/महिला</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-12">
                        <div class="form-group row required mb-2">
                            <label class="col-form-label col-lg-5" for="email">ईमेल पता / Email ID</label>
                            <div class="col-lg-7">
                                <input type="email" class="form-control" id="email" required
                                    pattern="^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$"
                                    name="email" placeholder="Email ID" maxlength="255">
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-12">
                        <div class="form-group row required mb-2">
                            <label class="col-form-label col-lg-5" for="mobileNumber">मोबाइल नंबर / Mobile Number</label>
                            <div class="col-lg-7">
                                <input type="text" class="form-control" id="mobileNumber" name="mobile"
                                    pattern="[6-9][0-9]{9}$" required maxlength="10" minlength="10"
                                    placeholder="Enter Mobile Number"
                                    oninput="this.value = this.value.replace(/[^0-9]/g, '');">
                                <small class="form-text text-muted"><strong>This number will be used for all communication.</strong></small>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-12">
                        <div class="form-group row required mb-2">
                            <label class="col-form-label col-lg-5">आधार संख्या / Aadhaar Number</label>
                            <div class="col-lg-7">
                                <input type="text" class="form-control" name="aadhar_no" required
                                    maxlength="12" minlength="12" pattern="[0-9]{12}"
                                    oninput="this.value = this.value.replace(/[^0-9]/g, '');">
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-12">
                        <div class="form-group row required mb-2">
                            <label class="col-form-label col-lg-5">व्यक्तिगत शिक्षा संख्या / PEN No.</label>
                            <div class="col-lg-7">
                                <input type="text" class="form-control" name="pen_no" required>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-12">
                        <div class="alert alert-info bg-transparent p-2 mb-0 small">
                            <i class="fa fa-info-circle"></i> Your login credentials will be auto-generated and sent to your registered Mobile No. & Email ID after OTP verification.<br>
                            लॉगिन क्रेडेंशियल ओटीपी सत्यापन के बाद पंजीकृत मोबाइल व ईमेल पर भेजे जाएंगे।
                        </div>
                    </div>

                    <input type="hidden" name="role" value="user">

                    <div class="col-lg-12">
                        <div class="form-group mb-3">
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="captcha">
                                        <label class="btn-block">Captcha/कैप्चा</label>
                                        <span class="unselectable" id="p_refresh">{{ $capchaCode }}</span>
                                        <input name="capchaCode" type="hidden" class="captchacode" value="{{ $capchaCode }}" readonly>
                                    </div>
                                </div>
                                <div class="col-md-1 refresh">
                                    <a href="javascript:void(0)" title="Refresh Captcha"><span class="fas fa-redo"></span></a>
                                </div>
                                <div class="col-md-7">
                                    <label>Enter Captcha/कैप्चा भरें</label>
                                    <input name="captcha" type="text" class="form-control" value="{{ old('captcha') }}" required>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="form-group mb-2">
                        <div class="row">
                            <div class="col-md-6 d-grid">
                                <button type="submit" class="btn btn-outline-danger rounded-pill">
                                    <i class="fa fa-user-plus"></i> Register/पंजीकरण करें <span class="fa fa-arrow-right"></span>
                                </button>
                            </div>
                            <div class="col-md-6 d-grid">
                                <a href="{{ route('onlineAdmissionTest.register') }}" class="btn btn-outline-secondary rounded-pill">
                                    <i class="fa fa-undo"></i> Reset/रीसेट
                                </a>
                            </div>
                        </div>
                    </div>

                </div>
                
            </form>
        </div>
    </div>

</div>

@endsection

@push('custom-scripts')
<script>
$(".refresh a, .cp_refresh a").on("click", function () {
    $.ajax({ type: "GET", url: ajaxUrl + "/player_coach/cp_refresh/", dataType: "json",
        success: function (res) { $("#p_refresh").html(res.capchaCode); $(".captchacode").val(res.capchaCode); }
    });
});

// Block non-UP registration immediately on radio change
$("input[name=native_of_up]").change(function(){
    if($(this).val() == '2'){
        $('#nativealert').modal('show');
        $(this).prop('checked', false);
    }
});

$("#gymsubmit").submit(function (e) {
    e.preventDefault();
    if (!this.checkValidity()) { $(this).addClass('was-validated'); return; }
    if($("input[name=native_of_up]:checked").val() != '1'){
        $('#nativealert').modal('show'); return;
    }
    $.ajax({
        type: "POST", url: $(this).attr("action"),
        data: new FormData(this), dataType: "json",
        contentType: false, cache: false, processData: false,
        success: function (res) {
            if (res.error == false) { success(res.msg); window.location.href = res.url; }
            else { error(res.msg); }
        }
    });
    $(this).addClass('was-validated');
});

</script>
@endpush
