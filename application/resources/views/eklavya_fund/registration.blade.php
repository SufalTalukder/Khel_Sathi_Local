@extends( 'layouts\eklavya_fund_layout' )
@section('content')
<div class="col-md-6 bg-light1">
    <div class="pt-3 pb-5 login-form">
        <div class="text-center text-md-center mt-md-0">
            <h3 class="mb-0">Registration/पंजीकरण</h3>
            <div class="d-flex justify-content-center align-items-center mt-2">
                <span class="fw-normal">Already Registered? <a href="{{url('eklavyaFund')}}" class="fw-bold">Click Here to Login</a></span>
            </div>
            <div class="d-flex justify-content-center align-items-center mt-2">
                <span class="fw-normal">पहले से पंजीकृत हैं? <a href="{{url('eklavyaFund')}}" class="fw-bold">लॉगिन करने हेतु यहां क्लिक करें</a></span>
            </div>
        </div>
        <form action="{{url('eklavyaFund/registration')}}" method="post" id="preregistration" class="needs-validation mt-4 pb-4" novalidate>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="name">1. Name of Sports Club/Academy<br />खेल क्लब/एकेडमी का नाम</label>
                        <input type="text" name="academy_name" required class="form-control" id="academy_name">
                        <div class="invalid-feedback"> Please Enter Name of Sports Club/Academy/कृपया खेल क्लब/एकेडमी का नाम भरें।</div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="name">2. Name of the Sport<br />खेल का नाम</label>
                        <select class="form-select form-control" name="sport_name" id="sport_name" required>
                            <option value="">Select</option>
                            @foreach ($sports as $type)
                            <option value="{{$type->id}}">{{$type->name}}</option>
                            @endforeach
                        </select>
                        <div class="invalid-feedback"> Please Enter  Name of the Sport /खेल का नाम</div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="name">3. Mobile Number/मोबाइल नंबर</label>
                        <input type="text" name="mobile" class="form-control" pattern="[6-9][0-9]{9}$" required maxlength="10" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');">
                        <div class="invalid-feedback"> Please Enter Mobile No./कृपया मोबाइल नंबर भरें।</div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="name">4. Email ID/ईमेल आईडी</label>
                        <input required type="email" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,4}$" name="email" class="form-control">
                        <div class="invalid-feedback">Please Enter Valid Email ID./कृपया सही ईमेल आईडी भरें।</div>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                        <label for="name">5. Location of the Sports Club/Academy within the state boundary<br>खेल क्लब/अकादमी उत्तर प्रदेश राज्य के सीमा क्षेत्र में स्थापित एवं कार्यरत हो</label>
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
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                        <label for="name">6. TAN Number/PAN Number/TAN नंबर/PAN नंबर</label>
                        <input type="text"  pattern="[a-zA-Z]{5}[0-9]{4}[a-zA-Z]{1}" style="text-transform:uppercase" name="pan" required class="form-control">
                        <div class="invalid-feedback"> Please Enter TAN Number/PAN Number/TAN नंबर/PAN नंबर</div>
                    </div>
                </div>
                <div class="col-md-5">
                    <div class="form-group row">
                        <div class="captcha">
                            <label > 7. Captcha/कैप्चा<span class="text-danger">*</span></label>
                            <span class="unselectable" id="cp_refresh">{{$Code1}}+{{$Code2}}</span>
                            <input name="captchacode" type="hidden" class="form-control captchacode unselectable h4" value="{{$Code1+$Code2}}" readonly>
                        </div>
                    </div>
                </div>
                <div class="col-md-1 refresh">
                    <div class="form-group row">
                        <div class="cp_refresh"><a href="javascript:void(0)" title="Refresh Captcha"><span class="fas fa-redo"></span></a></div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group row">
                        <label>8. Enter Captcha/कैप्चा भरें</label>
                        <input name="captcha" id="captcha" type="text" required class="form-control">
                        <div class="invalid-feedback"> Please Enter Captcha./कृपया कैप्चा भरें।</div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group d-grid">
                        <button type="submit" class="btn w-100 btn-info">Register/पंजीकरण करें<span class="fa fa-arrow-right"></span></button>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group d-grid">
                        <button type="reset" class="btn w-100 btn-outline-secondary ">Reset/रीसेट करें</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>


@endsection
@push('custom-scripts')
<script>

</script>
@endpush
