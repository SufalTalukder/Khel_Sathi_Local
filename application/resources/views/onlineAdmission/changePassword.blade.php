@extends( 'layouts.onlineAdmissionnav' )
@section('content')
<div class="row justify-content-center">
    <div class="col-md-6">
        <div class="card">
            <div class="card-header">
                <h4 class="mb-0">Change Password/पासवर्ड बदलें</h4>
            </div>
            <div class="card-body p-4 p-lg-5">
                <form action="{{route('onlineAdmission.updatePassword')}}" id="gymsubmit" class="needs-validation" novalidate method="post">
                    @csrf
                    <div class="form-group mb-3">
                        <label for="old_password">1. Current Password/वर्तमान पासवर्ड</label>
                        <input type="password" name="old_password" class="form-control" id="old_password" required>
                    </div>
                    <div class="form-group mb-3">
                        <label for="password">2. New Password/नया पासवर्ड</label>
                        <input type="password" name="password" class="form-control" id="password" required>
                        <small class="text-muted">Password must contain at least 8 characters, including uppercase, lowercase, and numbers.</small>
                    </div>
                    <div class="form-group mb-4">
                        <label for="password_confirmation">3. Retype New Password/नया पासवर्ड पुनः भरें</label>
                        <input type="password" name="password_confirmation" class="form-control" id="password_confirmation" required>
                    </div>
                    <div class="d-grid mb-3">
                        <button type="submit" class="btn btn-outline-danger rounded-pill">Update Password/पासवर्ड अपडेट करें</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@push('custom-scripts')
<script>
$("#gymsubmit").submit(function (e) {
    e.preventDefault();
    if ($("#gymsubmit")[0].checkValidity() === false) {
        e.stopPropagation();
    } else {
        $.ajax({
            type: "POST",
            url: $(this).attr("action"),
            data: new FormData(this),
            dataType: "json",
            contentType: false,
            cache: false,
            processData: false,
            success: function (res) {
                if (res.error == false) {
                    success(res.msg);
                    window.location.href = res.url;
                } else {
                    error(res.msg);
                }
            },
        });
    }
    $("#gymsubmit").addClass("was-validated");
});
</script>
@endpush
