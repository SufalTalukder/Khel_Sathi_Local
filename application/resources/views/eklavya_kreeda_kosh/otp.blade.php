@extends( 'layouts\eklavya_kreeda_kosh_layout' )
@section('content')
<div class="col-md-6 bg-light1">
    <div class="p-4 p-lg-5 login-form">
        <div class="text-center text-md-center mb-4 mt-md-0">
            <h3 class="mb-0">OTP Verification/ओटीपी सत्यापन</h3>
            <div class="d-flex justify-content-center align-items-center mt-2"><span class="fw-normal">Enter the OTP sent on your Mobile No. and Email ID/आपके मोबाइल नंबर और ईमेल आईडी पर भेजे गए ओटीपी को भरकर सत्यापित करें</span>
        </div>
        <form action="{{ route('eklavya_kreeda_kosh_otpStore') }}" class="mt-4" method="POST" id="eklsubmit">
            @csrf
            <div class="form-group mb-3">
                <label for="password-field">Enter OTP/ओटीपी भरें</label>

                <div class="row">
                    <div class="col">
                        <div class="input-group">
                            <input type="type" name="otp1" id="otp1" class="form-control" maxlength="1" oninput="return IsNumeric(event,2)" required>
                            <input type="type" name="otp2" id="otp2" class="form-control " maxlength="1" oninput="return IsNumeric(event,3)" required>
                            <input type="type" name="otp3" id="otp3" class="form-control " maxlength="1" oninput="return IsNumeric(event,4)" required>
                        </div>
                    </div>
                    <div class="col-1 otp-dash">-</div>
                    <div class="col">
                        <div class="input-group">
                            <input type="type" name="otp4" id="otp4" class="form-control " maxlength="1" oninput="return IsNumeric(event,5)" required>
                            <input type="type" name="otp5" id="otp5" class="form-control " maxlength="1" oninput="return IsNumeric(event,6)" required>
                            <input type="type" name="otp6" id="otp6" class="form-control " maxlength="1" oninput="return IsNumeric(event,7)" required>
                         </div>
                    </div>
                </div>
            </div>
            <div class="clearfix"></div>
            <div class="d-flex justify-content-center align-items-center mt-2 text-center mb-3">
                <span class="fw-normal text-black-50">
                    <a href="{{ route('eklavya_kreeda_kosh_resend_otp') }}" class="fw-bold">Resend OTP/ओटीपी पुनः भेजें</a>
                </span>
            </div>
            <div class="text-center mb-3">




                <button type="submit" class="btn btn-outline-danger rounded-pill w-50 " data-bs-toggle="modal" data-bs-target="#verify">Verify/सत्यापित करें</button> </div>
        </form>
    </div>
</div>

@endsection

@push('custom-scripts')
<script>
    function IsNumeric(e, id) {

        if (e.data != null)
            $("#otp" + id).focus();
        else
            $("#otp" + (id - 2)).focus();
    }
 $("#eklsubmit").submit(function (e) {

e.preventDefault();
if ($("#eklsubmit")[0].checkValidity() === false) {
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
$("#eklsubmit").addClass("was-validated");
});
$("#otpresend").on("click", function () {
        $.ajax({
            type: "GET",
            url: ajaxUrl + "/gymnasium_swimming/resend_otp/",
            dataType: "json",
            success: function (res) {
                 if (res.error == false) {
                success(res.msg);
            } else {
                error(res.msg);
            }
            },
        });
    });
</script>
@endpush

