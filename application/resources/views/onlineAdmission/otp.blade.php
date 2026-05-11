@extends( 'layouts.onlineAdmissionnav' )
@section('content')
<div class="col-md-6 bg-light1">
                <div class="p-4 p-lg-5 login-form">
                    <div class="text-center text-md-center mb-4 mt-md-0">
                        <h3 class="mb-0">OTP Verification/ओटीपी सत्यापन</h3>
                        <div class="d-flex justify-content-center align-items-center mt-2"><span class="fw-normal">An OTP has been sent on your registered Mobile No. & Email ID./पंजीकृत मोबाइल नंबर व ईमेल आईडी पर ओटीपी भेज दिया गया है।</span></div>
                    </div>
                    <form action="{{route('onlineAdmission.otpVerify')}}" id="gymsubmit" class="mt-4 needs-validation" novalidate method="post">
            @csrf

                        <div class="form-group mb-3 text-center">
                            <label for="email" class="mb-3">Enter OTP/ओटीपी भरें</label>
                            <div class="d-flex gap-2 justify-content-center">
                             <input type="text" name="otp1" class="form-control text-center otp"  maxlength="1"  required>
                             <input type="text" name="otp2" class="form-control text-center otp"  maxlength="1"  required>
                             <input type="text" name="otp3" class="form-control text-center otp"  maxlength="1"  required>
                             <input type="text" name="otp4" class="form-control text-center otp"  maxlength="1"  required>
                             <input type="text" name="otp5" class="form-control text-center otp"  maxlength="1"  required>
                             <input type="text" name="otp6" class="form-control text-center otp"  maxlength="1"  required>
                            </div>
                @error('email')
                        <div class="text-danger">{{ $message }}</div>
                 @enderror
                        </div>

                        <div class="d-grid mb-3 mt-4"><button type="submit" class="btn btn-outline-danger rounded-pill">Verify OTP/ओटीपी सत्यापित करें</button></div>
                        <div class="clearfix"></div>

                    </form>
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

$('.otp').keyup(function() {
    if (this.value.length == this.maxLength) {
        $(this).next('.otp').focus();
    }
});

</script>

    @endpush
