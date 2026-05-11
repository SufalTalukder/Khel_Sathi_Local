@extends( 'layouts\eklavya_kreeda_kosh_layout' )
@section('content')

<div class="col-md-6 bg-light1">
    <div class="p-4 p-lg-5 login-form">
        <div class="text-center text-md-center mb-4 mt-md-0">
            <h3 class="mb-0"> Applicant’s Login/आवेदक का लॉगिन</h3>
            <div class="d-flex justify-content-center align-items-center mt-2"><span class="fw-bold">


                <a href="{{ route('eklavya_kreeda_kosh_register') }}" class="fw-bold  text-primary">	Don’t have an account? Register Here<br>अकाउंट नहीं है? अभी पंजीकरण करें</a>



                </span></div>
        </div>

        <form action="{{ route('eklavya_kreeda_kosh_loginStore') }}" id="eklsubmit" class="mt-2 needs-validation" novalidate
        method="post" >
            @csrf
            <div class="form-group mb-3">
                <label for="email">1. Email ID/ईमेल आईडी<span class="text-danger">*</span></label>
                <input type="email" class="form-control" name="email" id="email" required>

            <div class="form-group">
                <div class="form-group mb-3">
                    <label for="password-field">2. Password/पासवर्ड<span class="text-danger">*</span></label>
                    <input type="password" class="form-control" name="password" id="password-field" required>
                    <span toggle="#password-field"
                        class="fa fa-fw fa-eye field-icon toggle-password"></span>
                </div>
                <p class="text-end mt-0">
                    <a href="{{ route('eklavya_kreeda_kosh_forgotpassword') }}" class="small text-right"><b>	Forgot Password?/पासवर्ड भूल गए?</b></a>
<div></div></p>
                <div class="form-group">
                    <div class="row">
                        <div class="col-md-5 col-6">
                            <div class="captcha">
                                <label > 3. Captcha/कैप्चा<span class="text-danger">*</span></label>
                                <span class="unselectable" id="p_refresh">{{$Code1}}+{{$Code2}}</span>
                                <input name="captchacode" type="hidden" class="form-control captchacode unselectable h4" value="{{$Code1+$Code2}}" readonly>
                        </div>
                        <div class="col-md-1 col-1 refresh">
                            <div class="cp-refresh"><a href="javascript:void(0)" title="Refresh Captcha"><span
                                class="fas fa-redo"></span></a></div>
                        </div>
                        <div class="col-md-6 col-5">
                            <label>4. Enter Captcha/कैप्चा भरें<span class="text-danger">*</span></label>
                            <input name="captcha" type="text" class="form-control "  value="{{old('captcha')}}" required>
                            @error('captcha')
                             <div class="text-danger">{{ $message }}</div>
                            @enderror
                         </div>
                    </div>
                </div>

            <div class="d-grid mb-3"><button type="submit"
                    class="btn btn-outline-danger rounded-pill">Login/लॉग इन करें</button> </div>
            <div class="clearfix"></div>


        </form>
    </div>
</div>


@endsection


@push('custom-scripts')
<script>

$(".refresh").on("click", function () {
    $.ajax({
        type: "GET",
        url: ajaxUrl + "/eklavya_kreeda_kosh/cp_refresh/",
        dataType: "json",
        success: function (res) {

            $("#p_refresh").html(res.Code1 +'+'+ res.Code2);
            $(".captchacode").val(res.Code1 + res.Code2);
            // $(".refreshc").val(res.capchaCode);
        },
    });
});

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

</script>
@endpush

