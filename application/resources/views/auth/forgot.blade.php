@extends('layouts/web')
@section('content')
<style>

</style>
<div class="row">
    <div class="col-md-6 loginsidebar">
        <div class="row justify-content-md-center">
            <div class="col-12 col-md-4 col-lg-2 text-center mb-3">
                <img src="{{ asset('') }}/assets_admin/images/logo.png" class="img-fluid mobile-resp" />
            </div>
            <div class="col-md-12 col-12 deptname">
                <h3 class="hd-org">Khel Sathi Portal/खेल साथी पोर्टल</h3>
            </div>
            <div class="col-md-12 pt-1 deptname">
                <h3 class="text-success">Department of Sports, Government of Uttar Pradesh<br>
                    खेल विभाग, उत्तर प्रदेश सरकार
                </h3>
                <h5 class="text-success">
                    Nomination Form to Seek Reward from Government of UP<br>उ0प्र0 सरकार से पुरस्कार प्राप्त करने हेतु नामांकन प्रपत्र
                </h5>
            </div>
        </div>
    </div>
    <div class="col bg-light1">
        <div class="p-4 p-lg-5 login-form">
            <div class="text-center text-md-center mb-2 mt-md-0">
                <h3 class="mb-0">Forgot Password/पासवर्ड भूल गए?</h3>
                <div class="d-flex justify-content-center align-items-center mt-2"><span class="fw-normal">
                        Please submit your Registered Email ID below and we'll send you a password on your mobile number.
                    </span>
                </div>
            </div>
            <form action="{{ route('forgot') }}" method="post" id="reload" class="mt-4 row g-3 required" novalidate>
                <div class="form-group">
                    <label for="email">Registered Email ID/पंजीकृत ईमेल आईडी</label>
                    <input type="email" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,4}$" class="form-control" id="email" name="email" required>
                    <div class="invalid-feedback">
                        Please enter email.
                    </div>
                </div>
                <div class="d-grid"><button type="submit" class="btn btn-info w-100">Submit/दर्ज करे</button> </div>
                <div class="clearfix"></div>
                <div class="d-flex justify-content-between align-items-top">
                    <a href="{{url('/')}}" class="small text-right">Back/वापस</a>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection
