@extends('layouts/web')
@section('content')

<style>
    .mobile::placeholder {
        color: white;
        opacity: 1;
        /* Firefox */
    }

    .mobile:-ms-input-placeholder {
        color: white;
    }

    .mobile::-ms-input-placeholder {
        color: white;
    }
</style>
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
        <div class="pt-3 pb-5 px-0 px-lg-5 login-form">
            <div class="text-center text-md-center mt-md-0">
                <h3 class="mb-0">Applicant’s Registration<br>आवेदक का पंजीकरण</h3>
                <div class="d-flex justify-content-center align-items-center mt-2"><span class="fw-normal">Already Registered? <a href="{{url('/')}}" class="fw-bold">Click Here to Login</a></span>
                </div>
                <div class="d-flex justify-content-center align-items-center mt-2"><span class="fw-normal">पहले से पंजीकृत हैं? <a href="{{url('/')}}" class="fw-bold">लॉगिन करने हेतु यहां क्लिक करें</a></span>
                </div>
            </div>
            <form action="{{ route('preRegistration') }}" method="post" id="preregistration" class="needs-validation mt-4 pb-4" novalidate>

                <div class="form-group">
                    <label for="name">1. Applicant’s Full Name/आवेदक का पूरा नाम</label>
                    <input type="text" onkeypress='return ((event.charCode >= 65 && event.charCode <= 90) || (event.charCode >= 97 && event.charCode <= 122) || (event.charCode == 32))' name="fname" required class="form-control" pattern="^[A-Za-z -]+$" id="fname">
                    <div class="invalid-feedback"> Please Enter Applicant’s Name./कृपया आवेदक का नाम भरें।</div>
                </div>

                <div class="form-group">
                    <!-- <label for="name">2. Which Sport do/did you play?<br>कौन सा खेल खेलते थे/हैं?</label> -->
                    <label for="name">2. Are you a native of Uttar Pradesh state?/क्या आप उत्तर प्रदेश के मूल निवासी हैं?</label>
                    <div class="form-control">
                        <div class="form-check form-check-inline m-0">
                            <input onclick="getNativeOfup(this.value)" class="form-check-input native_check" type="radio" name="native_of_up" required id="inlineRadio1" value="1">
                            <label class="form-check-label" for="inlineRadio1">Yes</label>
                        </div>
                        <div class="form-check form-check-inline m-0">
                            <input onclick="getNativeOfup(this.value)" class="form-check-input native_check" type="radio" name="native_of_up" id="inlineRadio2" value="2">
                            <label class="form-check-label" for="inlineRadio2">No</label>
                        </div>
                    </div>
                </div>

                <input type="hidden" name="role" value="AWARD">

                <div class="form-group">
                    <label for="name">3. Mobile Number/मोबाइल नंबर</label>
                    <input type="text" name="mobile" class="form-control" pattern="[6-9][0-9]{9}$" required maxlength="10" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');">
                    <div class="invalid-feedback"> Please Enter Mobile No./कृपया मोबाइल नंबर भरें।</div>
                </div>

                <div class="form-group">
                    <label for="name">4. Email ID/ईमेल आईडी</label>
                    <input required type="email" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,4}$" name="email" class="form-control">
                    <div class="invalid-feedback">Please Enter Valid Email ID./कृपया सही ईमेल आईडी भरें।</div>
                </div>
                <div class="form-group ">
                        <label>5. Aadhar No./आधार नंबर</label>
                            <input type="text" name="aadhar_no" class="form-control" pattern="[2-9]{1}[0-9]{11}" maxlength="12" minlength="12" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');" required>
                        
                    </div>

                <div class="form-group row">
                    <div class="col-md-5 col-5">
                        <div class="captcha">
                            <label class="btn-block">6. Captcha/कैप्चा</label>
                            <!-- <img src="{{ asset('') }}/aplicant_template/images/captcha.jpg" alt="Captcha" title="Captcha"> -->
                            <span class="unselectable" id="cp_refresh">{{$Code1}}+{{$Code2}}</span>
                        </div>
                    </div>
                    <div class="col-md-1 col-1 refresh">
                        <div class="cp_refresh"><a href="javascript:void(0)" title="Refresh Captcha"><span class="fas fa-redo"></span></a></div>
                    </div>
                    <div class="col-md-6 col-6">
                        <label>6. Enter Captcha/कैप्चा भरें</label>
                        <input name="captcha" id="captcha" type="text" required class="form-control">
                        <div class="invalid-feedback"> Please Enter Captcha./कृपया कैप्चा भरें।</div>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-md-6 col-6">
                        <button type="submit" class="btn w-100 btn-info">Register/पंजीकरण करें<span class="fa fa-arrow-right"></span></button>

                        <!-- <a href="otp.html" class="btn btn-info">Register <span class="fa fa-arrow-right"></span></a> -->
                    </div>
                    <div class="col-md-6 col-6 d-grid">
                        <button type="reset" class="btn w-100 btn-outline-secondary ">Reset/रीसेट करें</button>
                    </div>
                    <input type="hidden" name="capchaCode" id="capchaCode" class="refreshc" value="{{$capchaCode}}">
                </div>
            </form>
        </div>
    </div>
</div>

@endsection
