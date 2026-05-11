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
                <h3 class="mb-0">Change Password/पासवर्ड बदलें</h3>
            </div>

            <div class="alert alert-warning small p-2 mt-3">
                <i class="fa fa-info-circle"></i> For security reasons, you must change your auto-generated password on first login.<br>
                सुरक्षा कारणों से, पहले लॉगिन पर स्वतः उत्पन्न पासवर्ड बदलना आवश्यक है।<br>
                • New Password must contain at least 8 characters, including uppercase, lowercase, and numbers.
            </div>

            <form action="{{ route('onlineAdmissionTest.updatePassword') }}" id="changePwdForm" class="mt-2 needs-validation" novalidate method="post">
                @csrf
                <div class="form-group mb-3">
                    <label class="form-label fw-semibold">1. Current Password/वर्तमान पासवर्ड</label>
                    <div class="input-group">
                        <input type="password" name="old_password" id="old_pwd" class="form-control" required>
                        <span class="input-group-text" style="cursor:pointer;"><i class="fa fa-fw fa-eye toggle-password" toggle="#old_pwd"></i></span>
                    </div>
                </div>
                <div class="form-group mb-3">
                    <label class="form-label fw-semibold">2. New Password/नया पासवर्ड</label>
                    <div class="input-group">
                        <input type="password" name="password" id="new_pwd" class="form-control" required>
                        <span class="input-group-text" style="cursor:pointer;"><i class="fa fa-fw fa-eye toggle-password" toggle="#new_pwd"></i></span>
                    </div>
                </div>
                <div class="form-group mb-4">
                    <label class="form-label fw-semibold">3. Retype New Password/नया पासवर्ड पुनः भरें</label>
                    <div class="input-group">
                        <input type="password" name="password_confirmation" id="conf_pwd" class="form-control" required>
                        <span class="input-group-text" style="cursor:pointer;"><i class="fa fa-fw fa-eye toggle-password" toggle="#conf_pwd"></i></span>
                    </div>
                </div>
                <div class="d-grid">
                    <button type="submit" class="btn btn-outline-danger rounded-pill">
                        <i class="fa fa-lock"></i> Change Password/पासवर्ड बदलें
                    </button>
                </div>
            </form>
        </div>
    </div>

</div>

@endsection
@push('custom-scripts')
<script>
$(".toggle-password").click(function(){
    $(this).toggleClass("fa-eye fa-eye-slash");
    var input = $($(this).attr("toggle"));
    input.attr("type", input.attr("type") === "password" ? "text" : "password");
});

$("#changePwdForm").submit(function(e){
    e.preventDefault();
    if(!this.checkValidity()){ $(this).addClass('was-validated'); return; }
    $.ajax({
        type:"POST", url:$(this).attr("action"),
        data: new FormData(this),
        dataType:"json", contentType:false, cache:false, processData:false,
        success: function(res){
            if(res.error==false){ success(res.msg); setTimeout(()=>{ window.location.href=res.url; },1000); }
            else{ error(res.msg); }
        }
    });
});
</script>
@endpush
