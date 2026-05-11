@extends('layouts/coaching_camp')
@section('content')
    <div class="pt-4 pb-5 login-form">
        <div class="text-center text-md-center mt-md-0">
            <h3 class="mb-0"> Applicant’s Registration/आवेदक का पंजीकरण</h3>
            <div class="d-flex justify-content-center align-items-center mt-2"><span class="fw-normal"> <a
                        href="{{ route('coaching_camp_login') }}" class="fw-bold text-primary">Already Registered ? Click Here
                        to Login<br>
                        पहले से ही पंजीकृत? लॉगिन करने हेतु यहां क्लिक करें</a></span> </div>
        </div>
        <form action="{{ route('coaching_camp_regsiter_store') }}" id="submitform" class="mt-2 needs-validation" novalidate
            method="post">
            @csrf
            <div class="alert alert-success bg-transparent fade show p-2 mb-2" role="alert">
                <ul class="mb-0">
                    <li>यहां दर्ज की गई जानकारी को सबमिट करने के बाद संशोधित नहीं किया जा सकता / Information entered here
                        can not be modified after submitting.</li>
                </ul>
            </div>
            <div class="row">

                <div class="col-lg-12">
                    <div class="form-group row required mb-2" aria-required="true">
                        <label class="col-form-label col-lg-6" for="firstName">1. Name / नाम<span
                                class="text-danger">*</span></label>
                        <div class="col-lg-6">
                            <input type="text" class="form-control" value="{{ old('name') }}" id="firstName" required
                                name="name" placeholder="Full Name"
                                onkeypress='return ((event.charCode >= 65 && event.charCode <= 90) || (event.charCode >= 97 && event.charCode <= 122) || (event.charCode == 32))'
                                pattern="^[A-Za-z -]+$" maxlength="255">

                        </div>
                    </div>
                </div>


                <div class="col-lg-12">
                    <div class="form-group row required mb-2" aria-required="true">
                        <label class="col-form-label col-lg-6" for="firstName">2. ईमेल पता / Email ID<span
                                class="text-danger">*</span></label>
                        <div class="col-lg-6">
                            <input type="email" class="form-control" id="email" required
                                pattern="^[^ ]+@[^ ]+\.[a-z]{2,6}$" name="email" placeholder="Email ID" maxlength="255">

                        </div>
                    </div>
                </div>


                {{-- <div class="col-lg-12">
            <div class="form-group row required mb-2" aria-required="true">
                <label class="col-form-label col-lg-5" for="email">2. ईमेल पता / Email ID</label>
                <div class="col-lg-6 float-end">
                    <input type="email" class="form-control" id="email" required pattern="^[^ ]+@[^ ]+\.[a-z]{2,6}$"  name="email" placeholder="Email ID" maxlength="255">

                </div>
            </div>
        </div> --}}

                <div class="col-lg-12">
                    <div class="form-group row required  mb-2" aria-required="true">
                        <label class="col-form-label col-lg-6" for="mobileNumber">3. मोबाइल नंबर/Mobile Number<span
                                class="text-danger">*</span></label>
                        <div class="col-lg-6">
                            <div class="input-group">
                                <div class="input-group-prepend"> <span class="input-group-text">+91</span> </div>
                                <input type="text" class="form-control" id="mobileNumber" name="mobile"required  placeholder="Enter Mobile Number "
                                    maxlength="10" minlength="10"oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');"
                                     pattern="[6-9][0-9]{9}$" >

                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-12">
                    <div class="form-group row required  mb-2" aria-required="true">
                        <label class="col-form-label col-lg-6" for="dob">4. Date of Birth/ जन्म तिथि <span
                                class="text-danger">*</span></label>
                        <div class="col-lg-6">
                            @php
                                $minDate = date('Y-m-d',strtotime('-18 years'));
                                $maxDate = date('Y-m-d');
                            @endphp

                            <input type="date" class="form-control" id="dob" name="dob" required
                                min="{{ $minDate }}" max="{{ $maxDate }}"
                                placeholder="Select date of birth (Only under 18 years)">
                        </div>
                    </div>
                </div>

                <div class="col-lg-12">
                    <div class="form-group row required  mb-2" aria-required="true">
                        <label class="col-form-label col-lg-6" for="mobileNumber">4. Aadhar Number / आधार नं0<span
                                class="text-danger">*</span></label>
                        <div class="col-lg-6">
                            <input type="number" class="form-control" id="mobileNumber" name="aadhar" required
                                min="100000000000" max="999999999999" placeholder="Enter Aadhar No.">

                        </div>
                    </div>
                </div>
                <div class="col-lg-12">
                    <div class="form-group mb-3">
                        <div class="row">
                            <div class="col-md-5 col-6">
                                <div class="captcha">
                                    <label>5. Captcha/कैप्चा<span class="text-danger">*</span></label>
                                    <span class="unselectable"
                                        id="p_refresh">{{ $Code1 }}+{{ $Code2 }}</span>

                                    <input name="captchacode" type="hidden"
                                        class="form-control captchacode unselectable h4" value="{{ $Code1 + $Code2 }}"
                                        readonly>


                                </div>
                            </div>
                            <div class="col-md-1 col-1 refresh">
                                <div class="cp_refresh"><a href="javascript:void(0)" class="refresh4554554"
                                        title="Refresh Captcha"><span class="fas fa-redo"></span></a></div>
                            </div>
                            <div class="col-md-6 col-5">
                                <label>6. Enter Captcha/कैप्चा भरें<span class="text-danger">*</span></label>
                                <input name="captcha" type="text" placeholder="Enter Captcha" class="form-control"
                                    required>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="form-group mb-2">
                <div class="row">
                    <div class="col-md-12 d-grid"> <button type="submit" class="btn btn-danger rounded-pill"><i
                                class="fa fa-user-plus"></i> Register </button> </div>

                </div>
            </div>
        </form>
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


        $(".refresh4554554").on("click", function() {
            $.ajax({
                type: "GET",
                url: ajaxUrl + "/coaching_camp/cp_refresh/",
                dataType: "json",
                success: function(res) {
                    console.log(res)
                    $("#p_refresh").html(res.Code1 + '+' + res.Code2);
                    $(".captchacode").val(res.Code1 + res.Code2);
                    // $(".refreshc").val(res.capchaCode);
                },
            });
        });

        $("#submitform").submit(function(e) {

            e.preventDefault();
            if ($("#submitform")[0].checkValidity() === false) {
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
                    success: function(res) {
                        if (res.error == false) {
                            success(res.msg);

                            window.location.href = res.url;


                        } else {
                            error(res.msg);
                        }
                    },
                });
            }
            $("#submitform").addClass("was-validated");
        });
    </script>
@endpush
