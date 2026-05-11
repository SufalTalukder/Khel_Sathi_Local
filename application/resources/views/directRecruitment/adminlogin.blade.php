@extends('layouts/web')
@section('content')
<style>
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
              <h1>Department of Sports</h1>
                <h2>Government of Uttar Pradesh</h2>
			</div>
            <div class="col-md-12 pt-1 deptname">
                <h3 class="text-success">Directorate Login</h3>
            </div>
        </div>
    </div>
    <div class="col bg-light">
        <div class="p-4 p-lg-5 login-form">
            <div class="text-center text-md-center mt-md-0">
                <h3 class="mb-0">Sign in</h3>
                <!-- <div class="d-flex justify-content-center align-items-center mt-2"><span class="fw-normal">Don't have an account?
                        <a href="{{ route('signUp') }}" class="fw-bold">Create account</a></span></div> -->
            </div>
            <form action="{{ route('adminlogin') }}" method="post" id="adminlogin" class="mt-2 row g-3 required" novalidate>
                <div class="col-md-12">
                    <label for="user_type">User Type</label>
                    <select class="form-select form-control" name="user_type" id="user_type">
                        <option value="">Select</option>
                        @foreach($user_master as $key => $data)
                        <option value="{{$data->id}}">{{$data->name}}</option>
                        @endforeach
                    </select>
                </div>

                <div class="col-md-12">
                    <label for="email">Email</label>
                    <input type="email" class="form-control" id="email" name="email" required>
                    <div class="invalid-feedback">
                        Please enter email.
                    </div>
                </div>

                <div class="col-md-12">
                    <label for="password-field">Password</label>
                    <input type="password" class="form-control" id="password-field" name="password" required>
                    <span toggle="#password-field" class="fa fa-fw fa-eye field-icon toggle-password"></span>
                    <div class="invalid-feedback">
                        Please enter password.
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="row">
                        <div class="col-md-5">
                            <div class="captcha">
                                <label class="btn-block">Captcha</label>
                                <span class="unselectable" id="cp_refresh">{{$capchaCode}}</span>
                            </div>
                        </div>
                        <div class="col-md-1 refresh">
                            <div class="cp_refresh"><a href="javascript:void(0)" title="Refresh Captcha"><span class="fas fa-redo"></span></a></div>
                        </div>
                        <div class="col-md-6">
                            <label>Enter Captcha</label>
                            <input name="captcha" id="captcha" type="text" required pattern="[0-9]{5}$" class="form-control">
                            <div class="invalid-feedback">
                                Please provide a valid captcha.
                            </div>
                        </div>
                    </div>
                </div>

                <div class="d-grid"><button type="submit" class="btn btn-info w-100">Sign in</button> </div>
                <div class="clearfix"></div>
                <div class="d-flex justify-content-between align-items-top">
                            <a href="{{route('adminforgot')}}" class="small text-right">Forgot Password?/पासवर्ड भूल गए?</a>
                <input type="hidden" name="capchaCode" id="capchaCode" class="refreshc" value="{{$capchaCode}}">
            </form>
        </div>
    </div>
</div>

@endsection
