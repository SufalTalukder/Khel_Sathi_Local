@extends('layouts/facility_booking_layout')
@section('content')
<div class="container-fluid">
    <a href="#" title="Instruction" class="help" data-bs-toggle="modal" data-bs-target="#myModal">
        <span class="item"> <img src="{{ asset('facility_booking_storage') }}/images/instruction.png" /> </span>
        <div class="circle" style="animation-delay: 0s"></div>
        <div class="circle" style="animation-delay: 1s"></div>
        <div class="circle" style="animation-delay: 2s"></div>
        <div class="circle" style="animation-delay: 3s"></div>
    </a>
    <div class="row">
        <div class="col-md-6 loginsidebar">
            <div class="row justify-content-center">
                <div class="col-4 col-lg-3 text-center mb-3"> <img
                        src="{{ asset('facility_booking_storage') }}/images/logo.png" class="img-fluid"> </div>
                <div class="col-md-12 col-12 deptname">
                    <h3 class="hd-org">Khel Sathi Portal/खेल साथी पोर्टल</h3>
                    <h5>
                        Department of Sports, Government of Uttar Pradesh<br> खेल विभाग, उत्तर प्रदेश सरकार
                    </h5>
                </div>
                <div class="col-md-12 col-12 deptname">
                    <h4 class="text-danger">Facility Booking/सुविधा बुकिंग</h4>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="pt-4 pb-5 login-form">
                <h3 class="mb-0">Applicant’s Registration/आवेदक का पंजीकरण</h3>
                <div class="d-flex text-center justify-content-center align-items-center mt-2">
                    <span class="fw-normal">
                        <a href="{{ route('facility_booking_login') }}" class="fw-bold">
                            Already Registered ? Click Here to Login<br>
                            पहले से ही पंजीकृत ? लॉगिन करने हेतु यहां क्लिक करें
                        </a>
                    </span>
                </div>
                <form id="preregister" action="{{ route('facility_booking_register') }}" class="mt-2 needs-validation"
                    novalidate method="post">
                    @csrf
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group ">
                                <label class="col-form-label" for="firstName">1. Full Name/पूरा नाम</label>
                                <input type="text" class="form-control" id="name" name="name" maxlength="255"
                                    onkeypress='return ((event.charCode >= 65 && event.charCode <= 90) || (event.charCode >= 97 && event.charCode <= 122) || (event.charCode == 32))'
                                    pattern="^[A-Za-z -]+$" maxlength="255" required>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label class="col-form-label" for="firstName">2. Father's Name/पिता का नाम</label>
                                <input type="text" class="form-control" name="fathername" maxlength="255"
                                    onkeypress='return ((event.charCode >= 65 && event.charCode <= 90) || (event.charCode >= 97 && event.charCode <= 122) || (event.charCode == 32))'
                                    pattern="^[A-Za-z -]+$" maxlength="255" required>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label class="col-form-label" for="firstName">3. Mother's Name/मां का नाम</label>
                                <input type="text" class="form-control" id="fname" name="mothername"
                                    maxlength="255"
                                    onkeypress='return ((event.charCode >= 65 && event.charCode <= 90) || (event.charCode >= 97 && event.charCode <= 122) || (event.charCode == 32))'
                                    pattern="^[A-Za-z -]+$" maxlength="255" required>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label class="col-form-label" for="firstName">4. Nationality/राष्ट्रीयता</label>
                                <Select name="nationality" class="form-select form-control" required>
                                    <option value="">Select Nationality </option>
                                    <option value="Indian" selected>Indian </option>
                                    {{-- @foreach ($countries as $key => $item)
                                            <option value="{{ $item->id }}" {{ $item->id == 105 ? 'selected' : '' }}>
                                    {{ $item->name }}</option>
                                    @endforeach --}}
                                </Select>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label class="col-form-label" for="dateOfBirth">5. Date of Birth/जन्मतिथि </label>
                                <input type="date" class="form-control" min="1955-04-01" name="dob"
                                    max="{{ date('Y-m-d') }}" onchange="getAge(this)" id="dateOfBirth"
                                    name="dateOfBirth" required>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label class="col-form-label" for="email">6. Email ID/ईमेल आईडी</label>
                                <input required name="email" type="email"
                                    pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,4}$" name="email"
                                    class="form-control" max="255">
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label class="col-form-label" for="aadhar_no">7. Age/आयु </label>
                                <input type="text" readonly id="getAgee" name="age" value=""
                                    class="form-control" required>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label class="col-form-label" for="mobileNumber">8. Mobile No./मोबाइल नंबर</label>
                                <div class="input-group">
                                    <div class="input-group-prepend"> <span class="input-group-text">+91</span> </div>
                                    <input type="text" name="mobile" class="form-control"
                                        pattern="[6-9][0-9]{9}$" required maxlength="10"
                                        oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');">
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-5 col-5">
                            <div class="captcha">
                                <label class="btn-block">9. Captcha/कैप्चा</label>
                                <span class="unselectable"
                                    id="cp_refresh">{{ $Code1 }}+{{ $Code2 }}</span>
                            </div>
                        </div>
                        <div class="col-lg-1 col-1 refresh">
                            <div class="cp_refresh"><a href="javascript:void(0)" title="Refresh Captcha"><span
                                        class="fas fa-redo"></span></a></div>
                        </div>
                        <div class="col-lg-6 col-6">
                            <label>10. Enter Captcha/कैप्चा भरें</label>
                            <input name="captcha" id="captcha" type="text" required class="form-control">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <hr>
                        </div>
                        <div class="col-md-6 col-6 d-grid">
                            <input type="hidden" name="capchaCode" id="capchaCode" class="refreshc"
                                value="{{ $capchaCode }}">
                            <button type="submit" class="btn btn-outline-success "><i class="fa fa-user-plus"></i>
                                Register <span class="fa fa-arrow-right"></span>
                            </button>
                        </div>
                        <div class="col-md-6 col-6 d-grid">
                            <button type="reset" class="btn btn-outline-secondary "><i class="fa fa-undo"></i>
                                Reset
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<script>
    function calculateAgeDifference(date1, date2) {
        var diffMilliseconds = Math.abs(date1 - date2);
        var millisecondsInYear = 1000 * 60 * 60 * 24 * 365.25; // Average milliseconds in a year including leap years
        var yearsDiff = Math.floor(diffMilliseconds / millisecondsInYear);

        return yearsDiff;
    }

    // Example usage:


    function getAge(date1) {

        var dateOfBirth1 = new Date(date1.value);
        var dateOfBirth2 = new Date("{{config('app.session_year')}}-04-01");

        var ageDifference = calculateAgeDifference(dateOfBirth1, dateOfBirth2);


        $('#getAgee').val(ageDifference);

    }


    $(".refresh").on("click", function() {
        $.ajax({
            type: "GET",
            url: ajaxUrl + "/gymnasium_swimming/cp_refresh/",
            dataType: "json",
            success: function(res) {
                console.log(res)
                $("#p_refresh").html(res.Code1 + '+' + res.Code2);
                $(".captchacode").val(res.Code1 + res.Code2);
                // $(".refreshc").val(res.capchaCode);
            },
        });
    });
</script>
@endsection
