@extends('layouts/facility_booking_layout')
@section('content')
<div class="container-fluid">
    <a href="#" title="Instruction" class="help"><span class="item">
            <img src="{{ asset('facility_booking_storage') }}/images/instruction.png" />
        </span>
        <div class="circle" style="animation-delay: 0s"></div>
        <div class="circle" style="animation-delay: 1s"></div>
        <div class="circle" style="animation-delay: 2s"></div>
        <div class="circle" style="animation-delay: 3s"></div>
    </a>
    <div class="row">
        <div class="col-md-6 loginsidebar">
            <div class="row justify-content-center">
                <div class="col-4 col-lg-3 text-center mb-3"> <img src="{{ asset('facility_booking_storage') }}/images/logo.png" class="img-fluid"> </div>
                <div class="col-md-12 col-12 deptname">
                    <h3 class="hd-org">Khel Sathi Portal/खेल साथी पोर्टल</h3>
                    <h5>Department of Sports, Government of Uttar Pradesh<br>
                        खेल विभाग, उत्तर प्रदेश सरकार</h5>
                </div>
                <div class="col-md-12 col-12 deptname">
                    <h4 class="text-danger">Facility Booking/सुविधा बुकिंग</h4>
                </div>
            </div>
        </div>
        <div class="col-md-6 bg-light1">
            <div class="p-4 p-lg-5 login-form">
                <div class="text-center text-md-center mb-4 mt-md-0">
                    <h3 class="mb-0">Forgot Password/पासवर्ड भूल गए?</h3>
                    <p>Please submit your User ID below and we'll send you a link to recover your password.<br>कृपया नीचे अपना पंजीकृत ईमेल आईडी सबमिट करें और हम आपको आपके मोबाइल नंबर पर एक पासवर्ड भेजेंगे।</p>
                    <!--<div class="d-flex justify-content-center align-items-center mt-2"><span class="fw-normal">Don't have an account? <a href="./sign-up.html" class="fw-bold">Create account</a></span></div>-->
                </div>
                <form id="preregister" action="{{route('facility_booking_forgot_password')}}" class="mt-2 needs-validation" novalidate method="post">

                    @csrf
                    <div class="form-group mb-4">
                        <label for="email">Registered Email ID/पंजीकृत ईमेल आईडी</label>
                        <input type="email" name="email" class="form-control" required id="email">
                    </div>


                    <div class="row">
                        <div class="col-md-6 col-6">
                            <button type="submit" class="btn btn-outline-success w-100">Submit/दर्ज करे</button>
                        </div>
                        <div class="col-md-6 col-6">
                            <a href="{{route('facility_booking_login')}}" class="small btn btn-outline-light w-100">Back/वापस</a>


                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>


@endsection
