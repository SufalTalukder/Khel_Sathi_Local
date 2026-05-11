@extends( 'layouts\private_coaching_layout' )
@section('content')


<div class="container-fluid">
    <a href="#" title="Instruction" class="help">
        <span class="item">
            <img src="{{ url('RPCAA') }}/images/instruction.png" />
        </span>
        <div class="circle" style="animation-delay: 0s"></div>
        <div class="circle" style="animation-delay: 1s"></div>
        <div class="circle" style="animation-delay: 2s"></div>
        <div class="circle" style="animation-delay: 3s"></div>
    </a>
    <div class="row">
        <div class="col-md-6 loginsidebar">
            <div class="row justify-content-center">
                <div class="col-4 col-lg-2 text-center mb-3"> <img src="{{ url('RPCAA') }}/images/logo.png" class="img-fluid"> </div>
                <div class="col-md-12 col-12 deptname">
                    <h3 class="hd-org">Khel Sathi Portal/खेल साथी पोर्टल</h3>
                    <h5>
                        Department of Sports, Government of Uttar Pradesh<br>
                        खेल विभाग, उत्तर प्रदेश सरकार
                    </h5>
                </div>
                <div class="col-md-12 col-12 deptname">
                    <h5 class="text-danger">
                        Registration of Pvt. Coaching Academies / Associations ,Gyms, Swimming Pools<br /> निजी कोचिंग अकादमियों / संघों, जिम, और तरणताल का पंजीकरण     </h5>
                </div>
            </div>
        </div>
        <div class="col-md-6 bg-light1">
            <div class="p-4 p-lg-5 login-form">
                <div class="text-center text-md-center mb-4 mt-md-0">
                    <h3 class="mb-0">OTP Verification/ओटीपी सत्यापन</h3>
                    <div class="d-flex justify-content-center align-items-center mt-2">
                        <span class="fw-normal">
                            Enter and verify the OTP sent on the Mobile No./Email ID<br>
                            आपके मोबाइल नंबर और ईमेल आईडी पर भेजे गए ओटीपी को भरकर सत्यापित करें
                        </span>
                    </div>
                </div>
                <form action="{{ route('private_coaching_otp_store') }}" class="mt-4" method="POST" id="submitform">
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
                         <span class="fw-normal text-black-50"><span class="otp-time">Resend OTP/पुनः भेजें <span id="countdown"></span> Seconds</span><br>

                    <a href="javascript:void(0)" class="fw-bold  after-time-out otpresend434" style="display: none;" id="resend_otp" >Resend OTP/ओटीपी पुनः भेजें</a>
                            {{-- <a href="javascript:void(0)"  class="fw-bold otpresend434">Resend</a> --}}

                    </div>
                    <hr>
                    <div class="text-center mb-3">
                      <button  type="submit" class="btn btn-outline-success " >Verify/सत्यापित करें</button>
                    </div>
                </form>
            </div>
        </div>
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

    var ajaxUrl = "{{ url('') }}";

    $(".otpresend434").on("click", function () {
         $(".after-time-out").hide();
        $(".otp-time").show();
        timeleft = 20;
        $("#otp1").val("");
        $("#otp2").val("");
        $("#otp3").val("");
        $("#otp4").val("");
        $("#otp5").val("");
        $("#otp6").val("");
        $.ajax({
            type: "GET",
            url: ajaxUrl + "/private_coaching/resend_otp",
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

    $("#submitform").submit(function (e) {

e.preventDefault();
if ($("#submitform")[0].checkValidity() === false) {
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
$("#submitform").addClass("was-validated");
});


</script>
@endpush
