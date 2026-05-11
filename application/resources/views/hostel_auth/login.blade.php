@extends('layouts\admin_layout_hostelAuth')
@section('hostelcontent')




<div class="col-md-6 bg-light1">
    <div class="p-4 p-lg-5 login-form">
        <div class="text-center text-md-center mb-2 mt-md-0">
            <h3 class="mb-0">Applicant Login/आवेदक का लॉगिन</h3>
            <div class="text-center mt-2">
                {{-- TEMPORARILY DISABLED - Applications Closed --}}
                {{-- <span class="fw-normal">Don't have an account? <a href="{{route('hostel.register')}}" class="fw-bold">Create Account</a></span> --}}
                {{-- <br> --}}
                {{-- <span class="fw-normal">अकाउंट नहीं है? <a href="{{route('hostel.register')}}" class="fw-bold">सृजित करें </a></span> --}}
                <span class="badge bg-danger fs-6 px-3 py-2">Applications Closed / आवेदन बंद हैं</span>
            </div>
        </div>
        <form action="{{route('hostel.loginStore')}}" class="mt-4 needs-validation" novalidate method="post">
            @csrf
            <div class="form-group">
                <label for="email">1. Registered Email ID/पंजीकृत ईमेल आईडी</label>
				<input type="text"  class="form-control" id="email" name="email" required>
                {{-- <input type="email" name="email" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,4}$" class="form-control " id="email" value="{{old('email')}}" required> --}}
                @error('email')
                <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group mb-0">
                <label for="password-field">2. Password/पासवर्ड</label>
                <input type="password" name="password" class="form-control " id="password-field" value="{{old('password')}}" required>
                <span toggle="#password-field" class="fa fa-fw fa-eye field-icon toggle-password"></span>
                @error('password')
                <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
            <p class="text-end">
                <a href="{{route('hostel.forgot')}}" class="small "> Forgot Password?/पासवर्ड भूल गए?</a>
                <!--<input class="form-check-input" type="checkbox" value="" id="remember">
                <label class="form-check-label mb-0" for="remember">Remember me</label>-->
            </p>
            <div class="form-group">
                <div class="row">
                    <div class="col-md-5 col-5">
                        <div class="captcha">
                            <div class="captcha">
                                <label class="btn-block">3. Captcha/कैप्चा</label>
                                <span class="unselectable" id="cp_refresh">{{$captchaCode}}</span>
                                <input name="captchacode" type="hidden" class="form-control unselectable h4" value="{{$captchaCode}}" readonly>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-1 col-1 refresh">
                        <div class="cp_refresh"><a href="{{route('hostel.login')}}" title="Refresh Captcha"><span class="fas fa-redo"></span></a></div>
                    </div>
                    <div class="col-md-6 col-6">
                        <label>4. Enter Captcha/कैप्चा भरें</label>
                        <input name="captcha" type="text" class="form-control " value="{{old('captcha')}}" required>
                        @error('captcha')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </div>
            <p class="mb-3"><button type="submit" class="btn btn-info w-100">Login/लॉगिन करें</button> </p>
            <div class="d-grid mb-2">
                <a href="{{url('public/hostelapplicant/Pravesh_Hostel.pdf')}}" target="_blank"
                    class="btn btn-outline-success text-center blink_me">
                    <b>आवेदन हेतु निर्धारित अ्हताएं / योग्यता एवं निर्देश</b>
                </a>
            </div>
        </form>
    </div>
</div>
@endsection

