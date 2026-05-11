@extends( 'layouts.onlineAdmissionnav' )
@section('content')

{{-- TEMPORARILY DISABLED: Registration form wrapped with Opening Soon overlay --}}
<div class="col-md-6 bg-light1" style="position:relative;">

    {{-- Opening Soon Overlay --}}
    <div style="position:absolute;inset:0;z-index:10;background:rgba(255,255,255,0.93);display:flex;flex-direction:column;align-items:center;justify-content:center;border-radius:8px;">
        <div style="text-align:center;padding:30px;">
            <div style="font-size:60px;margin-bottom:10px;">🕐</div>
            <h2 style="color:#fd7e14;font-weight:800;letter-spacing:1px;margin-bottom:8px;">Opening Soon</h2>
            <h4 style="color:#fd7e14;font-weight:600;margin-bottom:16px;">जल्द आ रहा है</h4>
            <p style="color:#6c757d;font-size:15px;max-width:340px;margin:0 auto 20px;">New registrations for Sports College Admission are not available at the moment. Please check back later.</p>
            <p style="color:#6c757d;font-size:13px;max-width:340px;margin:0 auto 24px;">स्पोर्ट्स कॉलेज प्रवेश के लिए नए पंजीकरण अभी उपलब्ध नहीं हैं।</p>
            <a href="{{ route('onlineAdmission.loginForm') }}" class="btn btn-outline-secondary btn-sm px-4">← Back to Login</a>
        </div>
    </div>

    <div class="pt-4 pb-5 login-form" style="filter:blur(2px);pointer-events:none;user-select:none;">
        <div class="text-center text-md-center mt-md-0">
            <h3 class="mb-0">Registration/पंजीकरण</h3>
            <div class="d-flex justify-content-center align-items-center mt-2"><span class="fw-normal">Already Registered?/पहले से पंजीकृत? <!-- <a href="{{ route('onlineAdmission.loginForm') }}" class="fw-bold">Sign In/लॉगिन करें</a> --></span></div>
        </div>
        <form action="{{ route('onlineAdmission.preRegistration') }}" method="post" class="mt-2 needs-validation" novalidate id="gymsubmit">
            @csrf
            <div class="alert alert-success bg-transparent fade show p-2 mb-2" role="alert">
                <ul class="mb-0">
                    <li>यहां दर्ज की गई जानकारी को सबमिट करने के बाद संशोधित नहीं किया जा सकता / Information entered here can not be modified after submitting.</li>
                </ul>
            </div>
            
            <div class="row">
                <div class="col-lg-12">
                    <div class="form-group row required mb-2">
                        <label class="col-form-label col-lg-5" for="fname">पूरा नाम / Full Name</label>
                        <div class="col-lg-7">
                            <input type="text" class="form-control" value="{{old('fname')}}" id="fname" required name="fname" placeholder="Full Name"  onkeypress='return ((event.charCode >= 65 && event.charCode <= 90) || (event.charCode >= 97 && event.charCode <= 122) || (event.charCode == 32))' pattern="^[A-Za-z -]+$" maxlength="255">
                        </div>
                    </div>
                </div>

                <div class="col-lg-12">
                    <div class="form-group row required mb-2">
                        <label class="col-form-label col-lg-5">जन्मतिथि / Date of Birth</label>
                        <div class="col-lg-7">
                            <input type="text" class="form-control datepicker-here" value="{{old('dateOfBirth')}}" name="dateOfBirth" placeholder="DD-MM-YYYY" required readonly>
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
                                <input class="form-check-input" type="radio" name="native_of_up" id="native_no" value="0" required>
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
                                <option value="">Select</option>
                                <option value="1">Male</option>
                                <option value="2">Female</option>
                                <option value="3">Other</option>
                            </select>
                        </div>
                    </div>
                </div>

                <div class="col-lg-12">
                    <div class="form-group row required mb-2">
                        <label class="col-form-label col-lg-5" for="email">ईमेल पता / Email ID</label>
                        <div class="col-lg-7">
                            <input type="email" class="form-control" id="email" required pattern="^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$"  name="email" placeholder="Email ID" maxlength="255">
                        </div>
                    </div>
                </div>

                <div class="col-lg-12">
                    <div class="form-group row required  mb-2">
                        <label class="col-form-label col-lg-5" for="mobileNumber">मोबाइल नंबर / Mobile Number</label>
                        <div class="col-lg-7">
                            <div class="input-group">
                                <input type="text" class="form-control" id="mobileNumber" name="mobile" pattern="[6-9][0-9]{9}$"  required maxlength="10" minlength="10"  placeholder="Enter Mobile Number " oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');">
                            </div>
                            <small class="form-text text-muted"><strong>This number will be used for all communication.</strong></small>
                        </div>
                    </div>
                </div>

                <div class="col-lg-12">
                    <div class="form-group row required mb-2">
                        <label class="col-form-label col-lg-5">आधार संख्या / Aadhaar Number</label>
                        <div class="col-lg-7">
                            <input type="text" class="form-control" name="aadhar_no" required maxlength="12" minlength="12" pattern="[0-9]{12}" oninput="this.value = this.value.replace(/[^0-9]/g, '');">
                        </div>
                    </div>
                </div>

                <div class="col-lg-12">
                    <div class="form-group row required mb-2">
                        <label class="col-form-label col-lg-5">व्यक्तिगत शिक्षा संख्या / Personal Education Number (PEN)</label>
                        <div class="col-lg-7">
                            <input type="text" class="form-control" name="pen_no" required>
                        </div>
                    </div>
                </div>

                <input type="hidden" name="role" value="user">

                <div class="col-lg-12">
                    <div class="form-group mb-3">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="captcha">
                                        <label class="btn-block">4. Captcha/कैप्चा</label>
                                        <span class="unselectable" id="p_refresh">{{$capchaCode}}</span>
                                       <input name="capchaCode" type="hidden" class="form-control captchacode unselectable h4" value="{{$capchaCode}}" readonly>
                                    </div>
                            </div>
                            <div class="col-md-1">
                                <div class="refresh"><a href="javascript:void(0)" title="Refresh Captcha"><span class="fas fa-redo"></span></a></div>
                            </div>

                            <div class="col-md-7">
                                <label>4. Enter Captcha/कैप्चा भरें</label>
                                <input name="captcha" type="text" class="form-control "  value="{{old('captcha')}}" required>
                                @error('captcha')
                                 <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>
            <div class="form-group mb-2">
                <div class="row">
                    <div class="col-md-6 d-grid">
                        <button type="submit" class="btn btn-outline-danger rounded-pill"><i class="fa fa-user-plus"></i> Register/पंजीकरण करें <span class="fa fa-arrow-right"></span></button>
                    </div>
                    <div class="col-md-6 d-grid">
                        <a href="{{ route('onlineAdmission.register') }}" class="btn btn-outline-secondary rounded-pill"><i class="fa fa-undo"></i> Reset/रीसेट</a>
                    </div>
                </div>
            </div>
        </form>
    </div>{{-- end blurred inner div --}}
</div>{{-- end col-md-6 --}}
@endsection
@push('custom-scripts')
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
        },
    });
});



$("#gymsubmit").submit(function (e) {

    e.preventDefault();
    if ($("#gymsubmit")[0].checkValidity() === false) {
        e.stopPropagation();
    } else {
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

                    window.location.href = res.url;


                } else {
                    error(res.msg);
                }
            },
        });
    }
    $("#gymsubmit").addClass("was-validated");
});

$(document).ready(function() {
    $('.datepicker-here').datepicker({
        language: 'en',
        autoClose: true,
        dateFormat: 'yyyy-mm-dd'
    });
});
</script>

@endpush
