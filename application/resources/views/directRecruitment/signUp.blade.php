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

    .unselectable {
        -webkit-user-select: none;
        -webkit-touch-callout: none;
        -moz-user-select: none;
        -ms-user-select: none;
        user-select: none;
    }
</style>
<div class="row">
    <div class="col-md-6 loginsidebar">
        <div class="row justify-content-center">
            <div class="col-4 col-lg-2 text-center mb-3">
                <img src="{{ asset('') }}/assets_admin/images/logo.png" class="img-fluid" />
            </div>
            <div class="col-md-12 col-12 deptname">
                <h1 class="hd-org">Khel Sathi Portal / खेल साथी पोर्टल</h1>
                <h2>Department of Sports, Government of Uttar Pradesh<br>खेल विभाग, उत्तर प्रदेश सरकार</h2>
            </div>
            <div class="col-md-12 col-12 deptname">
                <h5 class="text-success">Online Application Submission for Direct Recruitment as Gazetted Officer<br>राजपत्रित अधिकारी के रूप में सीधी भर्ती हेतु ऑनलाइन आवेदन</h5>
            </div>
        </div>
    </div>


    <div class="col-md-6 bg-light1">
        <div class="p-5 login-form">
            <div class="text-center text-md-center mt-md-0">
                <h3 class="mb-0">Applicant’s Registration<br>आवेदक का पंजीकरण</h3>
                <div class="d-flex justify-content-center align-items-center mt-2"><span class="fw-normal">Already Registered? <a href="{{route('drloginForm')}}" class="fw-bold">Click Here to Login</a></span></div>
                <div class="d-flex justify-content-center align-items-center mt-2"><span class="fw-normal">पहले से पंजीकृत हैं? <a href="{{route('drloginForm')}}" class="fw-bold">लॉगिन करने हेतु यहां क्लिक करें</a></span></div>
            </div>
            <form action="{{ route('drpreRegistration') }}" method="post" id="preregistration" class="needs-validation mt-4" novalidate>
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="name">1. Applicant’s Full Name/ आवेदक का पूरा नाम</label>
                            <input type="text" onkeypress='return ((event.charCode >= 65 && event.charCode <= 90) || (event.charCode >= 97 && event.charCode <= 122) || (event.charCode == 32))' name="fname" required class="form-control" pattern="^[A-Za-z -]+$" id="fname">
                        </div>
                    </div>

                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="name">2. Are you a native of Uttar Pradesh state?<br>क्या आप उत्तर प्रदेश के मूल निवासी हैं?</label>
                            <div class="form-control">
                                <div class="form-check form-check-inline me-3">
                                    <input class="form-check-input" onclick="getNativeOfup(this.value)" type="radio" name="native_of_up" required id="inlineRadio1" value="1">
                                    <span class="form-check-label" for="inlineRadio1">Yes</span>
                                </div>
                                <div class="form-check form-check-inline m-0">
                                    <input class="form-check-input" onclick="getNativeOfup(this.value)" type="radio" name="native_of_up" id="inlineRadio2" value="2">
                                    <span class="form-check-label" for="inlineRadio2">No</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <input type="hidden" name="role" value="dr">

                <!-- <div class="row"> -->
                <!-- <div class="col-md-6">
                                <div class="form-group">
                                    <label for="name">Position as a Sportsperson</label>
                                    <input type="text"  name="sport_position"  required  class="form-control" id="Text2">
                                </div>
                            </div> -->
                <!-- <div class="col-md-6">
                                <div class="form-group">
                                    <label for="name">Which Sport do/did you play?</label>
                                    <select  name="sport_type" required class="form-select" style="padding: 13px;">
                                        <option value="">Select</option>
                                        <option value="Athletics">Athletics</option>
                                        <option value="Badminton">Badminton </option>
                                        <option value="Cricket">Cricket</option>
                                        <option value="Football">Football</option>
                                        <option value="Gymnastic">Gymnastic</option>
                                        <option value="Hockey">Hockey</option>
                                        <option value="Judo">Judo</option>
                                        <option value="Kabaddi">Kabaddi</option>
                                        <option value="Swimming">Swimming </option>
                                        <option value="Volleyball">Volleyball</option>
                                        <option value="Wrestling">Wrestling</option>
                                    </select>
                                </div>
                            </div>-->
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="name">3. Mobile Number / मोबाइल नंबर</label>
                            <input type="text" name="mobile" class="form-control" pattern="[6-9][0-9]{9}$" required maxlength="10" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="name">4. Email ID / ईमेल आईडी</label>
                            <input required type="email" name="email" class="form-control">
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="row">
                        <div class="col-md-5">
                            <div class="captcha">
                                <label class="btn-block">5. Captcha/ कैप्चा</label>
                                <!-- <img src="{{ asset('') }}/assets_admin/images/captcha.jpg" alt="Captcha" title="Captcha"> -->
                                <span class="unselectable" id="cp_refresh">{{$Code1}}+{{$Code2}}</span>
                            </div>
                        </div>
                        <div class="col-md-1 refresh">
                            <div class="cp_refresh"><a href="javascript:void(0)" title="Refresh Captcha"><span class="fas fa-redo"></span></a></div>
                        </div>
                        <div class="col-md-6">
                            <label>6. Enter Captcha/ कैप्चा भरें</label>
                            <input name="captcha" id="captcha" type="text" required class="form-control">
                            <div class="invalid-feedback">
                                Please Enter Valid Captcha.
                            </div>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="row">
                        <div class="col-md-6">
                            <button type="submit" class="btn btn-info w-100">Register/पंजीकरण करें<span class="fa fa-arrow-right"></span></button>

                            <!-- <a href="otp.html" class="btn btn-info w-100">Register <span class="fa fa-arrow-right"></span></a> -->
                        </div>
                        <div class="col-md-6">
                            <button type="reset" class="btn btn-outline-secondary w-100">Reset/रीसेट करें</button>
                        </div>
                        <input type="hidden" name="capchaCode" id="capchaCode" class="refreshc" value="{{$capchaCode}}">
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection
