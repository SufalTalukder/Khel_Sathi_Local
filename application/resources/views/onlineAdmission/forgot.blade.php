@extends( 'layouts.onlineAdmissionnav' )
@section('content')
<div class="col-md-6 bg-light1">
                <div class="p-4 p-lg-5 login-form">
                    <div class="text-center text-md-center mb-4 mt-md-0">
                        <h3 class="mb-0">Forgot Password/पासवर्ड भूल गए?</h3>
                        <div class="d-flex justify-content-center align-items-center mt-2"><span class="fw-normal">Enter your Registered Application Number/Email ID to receive password./पासवर्ड प्राप्त करने के लिए अपना पंजीकृत आवेदन संख्या/ईमेल आईडी भरें।</span></div>
                    </div>
                    <form action="{{route('ponlineAdmission.forgot')}}" id="gymsubmit" class="mt-4 needs-validation" novalidate method="post">
            @csrf


                        <div class="form-group mb-3">
                            <label for="email">1. Registered Application Number/पंजीकृत आवेदन संख्या</label>
                            <input type="text" name="application_no" class="form-control " id="application_no" value="{{old('application_no')}}" required>
                @error('application_no')
                        <div class="text-danger">{{ $message }}</div>
                 @enderror
                        </div>

                        <div class="d-grid mb-3 mt-4"><button type="submit" class="btn btn-outline-danger rounded-pill">Submit/जमा करें</button></div>
                        <div class="clearfix"></div>
                        <div class="d-flex justify-content-between align-items-top">
                            <!-- <a href="{{ route('onlineAdmission.loginForm') }}" class="small text-right"><b>Back to Login/लॉगिन पर वापस जाएं</b></a> -->

                        </div>
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

                // window.location.href = res.url;


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
