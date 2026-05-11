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
				<img src="{{ asset('') }}/assets_admin/images/logo.png" class="img-fluid"/>
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
    <div class="col bg-light">
        <div class="p-4 p-lg-5 login-form">
            <div class="text-center text-md-center mb-2 mt-md-0">
                <h3 class="mb-0">Forgot Password?</h3>
                <div class="d-flex justify-content-center align-items-center mt-2"><span class="fw-normal">
                Please submit your Email ID below and we'll send you a link to recover your password.

                </span>
            </div>
            </div>
            <form action="{{ route('drforgot') }}" method="post" id="adminlogin" class="mt-4 row g-3 required" novalidate>
                <div class="form-group">
                    <label for="email">Email Id</label>
                    <input type="email" class="form-control" id="email" name="email" required>
                    <div class="invalid-feedback">
                        Please enter email.
                    </div>
                </div>
               
                <div class="d-grid"><button type="submit" class="btn btn-info w-100">Submit/दर्ज करे</button> </div>
                
                <div class="clearfix"></div>
                <div class="d-flex justify-content-between align-items-top">
                            <a href="{{url('/direct-recruitment/loginForm')}}" class="small text-right">Back/वापस</a>
                       </div>
           </form>
        </div>
    </div>
</div>

@endsection
