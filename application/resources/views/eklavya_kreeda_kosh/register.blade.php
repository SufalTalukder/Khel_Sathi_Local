@extends( 'layouts\eklavya_kreeda_kosh_layout' )
@section('content')
<div class="col-md-6 bg-light1">
    <div class="pt-4 pb-5 login-form">
        <div class="text-center text-md-center mt-md-0">
            <h3 class="mb-0">Applicant’s Registration/आवेदक का पंजीकरण</h3>

            <div class="d-flex justify-content-center align-items-center mt-2"><span class="fw-normal"> <a href="{{ route('eklavya_kreeda_kosh_login') }}" class="fw-bold">Already Registered ? Click Here to Login<br>पहले से ही पंजीकृत ? लॉगिन करने हेतु यहां क्लिक करें</a></span>
            </div>

        </div>
        <form action="{{ route('eklavya_kreeda_kosh_registrationStore') }}" id="eklsubmit" class="mt-2 needs-validation" novalidate
        method="post" >
        @csrf
            <div class="alert alert-success bg-transparent fade show p-2 mb-2" role="alert">
                <ul class="mb-0">
                    <li>यहां दर्ज की गई जानकारी को सबमिट करने के बाद संशोधित नहीं किया जा सकता/Information entered here can not be modified after submitting.</li>
                </ul>
            </div>
            <div id="ageLimitError" class="d-none">
                <div class="alert alert-danger fade show fs-14" role="alert">
                    Kindly note that the minimum age for admission to Std 6 and above is minimum admissible age is 8 to 12 years as on 01-04-2023.
                </div>
            </div>
            <div id="formError" class="alert alert-danger alert-dismissible fade show d-none" role="alert">
                Invalid Captcha Code. Please try again.
            </div>
            <div class="row">

                <div class="col-lg-12">
                    <div class="form-group row required mb-2" aria-required="true">
                        <label class="col-form-label col-lg-5" for="firstName">1. पूरा नाम/Full Name<span class="text-danger">*</span></label>
                        <div class="col-lg-7">
                            <input type="text" class="form-control" id="firstName" name="name" placeholder="Full Name" maxlength="255" onkeypress='return ((event.charCode >= 65 && event.charCode <= 90) || (event.charCode >= 97 && event.charCode <= 122) || (event.charCode == 32))' pattern="^[A-Za-z -]+$"  maxlength="255" required>
                            @error('name')
                            <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>


                <div class="col-lg-12">
                    <div class="form-group row required mb-2" aria-required="true">
                        <label class="col-form-label col-lg-5" for="email">2. ईमेल पता/Email ID<span class="text-danger">*</span></label>
                        <div class="col-lg-7">
                            <input type="email" class="form-control" id="email" name="email" placeholder="Email ID" maxlength="255" pattern="^[^ ]+@[^ ]+\.[a-z]{2,6}$" required>
                            @error('email')
                            <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="col-lg-12">
                    <div class="form-group row required  mb-2" aria-required="true">
                        <label class="col-form-label col-lg-5" for="mobileNumber">3. मोबाइल नंबर/Mobile Number<span class="text-danger">*</span></label>
                        <div class="col-lg-7">
                            <div class="input-group">

                                <input type="text" class="form-control" id="mobile" name="mobile" placeholder="Enter Mobile Number " pattern="[6-9][0-9]{9}$"    placeholder="Enter Mobile Number "maxlength="10" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');" data-toggle="tooltip" data-placement="bottom" title=""  required>
                                @error('mobile')
                                <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-12">
                    <div class="form-group row required radio-group mb-2" aria-required="true">
                        <label class="col-form-label col-lg-8">4. Are you a native of Uttar Pradesh?/क्या आप उत्तर प्रदेश के मूल निवासी हैं?<span class="text-danger">*</span></label>

                        <div class="col-lg-4">

                                    <div class="form-check form-check-inline">
                                    <input onclick="getNativeOfup(this.value)" class="form-check-input native_check" type="radio" name="native_of_up" required id="inlineRadio1" value="1">
                                    <label class="form-check-label" for="inlineRadio1">Yes/हाँ</label>
                                </div>
                                    <div class="form-check form-check-inline">
                                    <input onclick="getNativeOfup(this.value)" class="form-check-input native_check" type="radio" name="native_of_up" id="inlineRadio2" value="2" required>
                                    <label class="form-check-label" for="inlineRadio2">No/नहीं</label>
                                </div>
                                @error('native_of_up')
                                <div class="text-danger">{{ $message }}</div>
                                @enderror

                        </div>
                    </div>
                </div>
                <div class="col-lg-12">
                    <div class="form-group mb-3">
                        <div class="row">
                            <div class="col-md-5 col-6">
                                <div class="captcha">

                                    <label class="btn-block">5. Captcha/कैप्चा</label>
                                    <span class="unselectable" id="p_refresh">{{$Code1}}+{{$Code2}}</span>
                                   <input name="captchacode" type="hidden" class="form-control captchacode unselectable h4" value="{{$Code1+$Code2}}" readonly>

                                </div>
                            </div>
                            <div class="col-md-1 col-1 refresh">
                                <div class="cp-refresh"><a href="javascript:void(0)" title="Refresh Captcha"><span
                                            class="fas fa-redo"></span></a></div>
                            </div>
                            <div class="col-md-6 col-5">
                                <label>Enter Captcha/कैप्चा भरें<span class="text-danger">*</span></label>
                                <input name="captcha" type="text" class="form-control "  value="{{old('captcha')}}" required>
                                @error('captcha')
                                 <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="form-group mb-2">
                <div class="row">
                    <div class="col-md-6 d-grid">
                        <button type="submit"  class="btn btn-outline-danger rounded-pill"><i class="fa fa-user-plus"></i> Register <span class="fa fa-arrow-right"></span></button>
                    </div>
                    <div class="col-md-6 d-grid">
                        <button type="reset" class="btn btn-outline-secondary rounded-pill"><i class="fa fa-undo"></i> Reset</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>


@endsection
@push('custom-scripts')
<script>
function getNativeOfup(value) {

    if (value == 2) {
        $("#nativealert").modal("toggle");
        $(".btn-outline-danger,.rounded-pill").prop("disabled", true);
    } else {
        $(".btn-outline-danger,.rounded-pill").prop("disabled", false);
    }
}


$(".refresh").on("click", function () {
    $.ajax({
        type: "GET",
        url: ajaxUrl + "/eklavya_kreeda_kosh/cp_refresh/",
        dataType: "json",
        success: function (res) {
            console.log(res)
            $("#p_refresh").html(res.Code1 +'+'+ res.Code2);
            $(".captchacode").val(res.Code1 + res.Code2);
            // $(".refreshc").val(res.capchaCode);
        },
    });
});

$("#eklsubmit").submit(function (e) {

e.preventDefault();
if ($("#eklsubmit")[0].checkValidity() === false) {
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
$("#eklsubmit").addClass("was-validated");
});


</script>
@endpush
