@extends('layouts\admin_layout_hostelAuth')
@section('hostelcontent') 
    <div class="col-md-6 bg-light1">
        <div class="p-4 p-lg-5 login-form">
            <div class="text-center text-md-center mb-2 mt-md-0">
                <h3 class="mb-0">Forgot Password?/पासवर्ड भूल गए?</h3>
                <p>Please submit your registered Email ID below to receive the password on the registered Mobile Number and
                    Email ID.<br>
                    पंजीकृत ईमेल आईडी एवं मोबाइल नंबर पर अपना पासवर्ड प्राप्त करने हेतु कृपया नीचे अपनी पंजीकृत ईमेल आईडी
                    दर्ज करें।
                </p>
                <!--<div class="d-flex justify-content-center align-items-center mt-2"><span class="fw-normal">Don't have an account? <a href="./sign-up.html" class="fw-bold">Create account</a></span></div>-->
            </div>
            <form action="{{ route('hostel.forgotStore') }}" class="mt-4 was-validated" method="post">
                @csrf
                <div class="form-group">
                    <label for="email">Registered Email ID/पंजीकृत ईमेल आईडी</label>
                    <input type="email" class="form-control " id="email" name="email" value="{{ old('email') }}"
                        required>
                </div>
                <div class="form-group"><button type="submit" class="btn btn-info w-100" data-bs-toggle="modal"
                        data-bs-target="#verify">Submit/दर्ज करें</button>
                </div>
                <div class="form-group">
                    <div><a href="{{ route('hostel.login') }}" class="small text-right">Previous Step/पिछले चरण पर जाएं</a>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
