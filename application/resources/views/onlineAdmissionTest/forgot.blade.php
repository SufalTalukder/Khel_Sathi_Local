@extends('layouts/web')
@section('content')

<style>
    html { height: 100%; overflow: hidden; }
    body { height: 100%; }
    .container-fluid { height: calc(100vh - 38px); padding: 0; }
    .row.admission-row { height: 100%; margin: 0; }
    .admission-row .loginsidebar { height: 100vh; overflow: hidden; padding: 0; }
    .admission-row .scroll-panel { height: 100%; overflow-y: auto; padding: 20px 30px 50px; }
    footer { position: fixed; bottom: 0; left: 0; right: 0; z-index: 99; background: #fff; border-top: 1px solid #eee; }
</style>

<div class="row admission-row">

    <div class="d-none d-md-block col-md-6 loginsidebar">
        <div class="row justify-content-md-center">
            <div class="col-12 col-md-4 col-lg-2 text-center mb-3">
                <img src="{{ asset('onlineAdmission_storage/images/dash-logo.png') }}" class="img-fluid mobile-resp"/>
            </div>
            <div class="col-md-12 col-12 deptname">
                <h3 class="hd-org">Khel Sathi Portal/खेल साथी पोर्टल</h3>
            </div>
            <div class="col-md-12 pt-1 deptname">
                <h3 class="text-success">Department of Sports, Government of Uttar Pradesh<br>
                    खेल विभाग, उत्तर प्रदेश सरकार
                </h3>
                <h5 class="text-success">
                    Sports College Admission<br>स्पोर्ट कॉलेज प्रवेश
                </h5>
            </div>
        </div>
    </div>

    <div class="col-md-6 bg-light1 scroll-panel">
        <div class="pt-2 login-form">
            <div class="text-center text-md-center mt-md-0">
                <h3 class="mb-0">Forgot Password/पासवर्ड भूल गए</h3>
                <div class="d-flex justify-content-center align-items-center mt-2">
                    <span class="fw-normal">
                        <a href="{{ route('onlineAdmissionTest.loginForm') }}" class="fw-bold">← Back to Login/लॉगिन पर वापस जाएं</a>
                    </span>
                </div>
            </div>

            <form action="{{ route('onlineAdmissionTest.forgot') }}" id="forgotForm" class="mt-3 needs-validation" novalidate method="post">
                @csrf
                <div class="form-group mb-3">
                    <label class="form-label fw-semibold">Application Number/आवेदन संख्या</label>
                    <input type="text" name="application_no" class="form-control" required placeholder="Enter your Registration Number">
                </div>
                <div class="d-grid">
                    <button type="submit" class="btn btn-outline-danger rounded-pill">
                        <i class="fa fa-paper-plane"></i> Send Password/पासवर्ड भेजें
                    </button>
                </div>
            </form>
        </div>
    </div>

</div>

@endsection
@push('custom-scripts')
<script>
$("#forgotForm").submit(function(e){
    e.preventDefault();
    if(!this.checkValidity()){ $(this).addClass('was-validated'); return; }
    $.ajax({
        type:"POST", url:$(this).attr("action"),
        data: new FormData(this),
        dataType:"json", contentType:false, cache:false, processData:false,
        success: function(res){
            if(res.error==false){ success(res.msg); } else{ error(res.msg); }
        }
    });
});
</script>
@endpush
