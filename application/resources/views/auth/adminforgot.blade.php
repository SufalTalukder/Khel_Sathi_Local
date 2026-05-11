@extends('layouts/web')
@section('content')
<style>
      
    </style>
<div class="row">
    <div class="col-md-6 loginsidebar">
        <div class="row justify-content-center">
            <div class="col-4 col-lg-2 text-center mb-3">
                <img src="{{ asset('assets_admin/images/logo.png') }}" class="img-fluid" />
            </div>
            <div class="col-md-12 col-12 deptname">
                        <h3 class="hd-org">Khel Sathi Portal/खेल साथी पोर्टल

</h1>
            </div>
            <div class="col-md-12 pt-1 deptname">
				 <h3 class="text-success">Department of Sports, Government of Uttar Pradesh<br>
खेल विभाग, उत्तर प्रदेश सरकार</h3>
				</div>
            <div class="col-md-12 pt-2 deptname">
            <h1 class="text-success">Hostel Admission</h1>
                 
            </div>
        </div>
    </div> 
    <div class="col bg-light">
        <div class="p-4 p-lg-5 login-form">
            <div class="text-center text-md-center mb-2 mt-md-0">
                <h3 class="mb-0">Forgot Password?</h3>
                <div class="d-flex justify-content-center align-items-center mt-2"><span class="fw-normal">
                Please submit your User ID below and we'll send you a link to recover your password.

                </span>
            </div>
            </div>
            <form action="{{ route('adminforgot') }}" method="post" id="login" class="mt-4 row g-3 required" novalidate>
                <div class="form-group">
                    <label for="email">User Id</label>
                    <input type="email" class="form-control" id="email" name="email" required>
                    <div class="invalid-feedback">
                        Please enter email.
                    </div>
                </div>
               
                <div class="d-grid"><button type="submit" class="btn btn-info">Submit/दर्ज करे</button> </div>
                
                <div class="clearfix"></div>
                <div class="d-flex justify-content-between align-items-top">
                            <a href="{{url('admin/login')}}" class="small text-right">Back/वापस</a>
                       </div>
           </form>
        </div>
    </div>
</div>

@endsection
