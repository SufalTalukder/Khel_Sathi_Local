@extends( 'layouts/coaching_camp' )
@section('content')
<div class="p-4 p-lg-5 login-form">
    <div class="text-center text-md-center mb-4 mt-md-0">
        <h3 class="mb-0">Forgot Password/पासवर्ड भूल गए??</h3>
        <p>Please submit your registered User ID below to receive your Password on registered Email ID &
            Mobile No.<br>
            पंजीकृत ईमेल आईडी और मोबाइल नंबर पर अपना पासवर्ड प्राप्त करने के लिए कृपया अपनी पंजीकृत
            यूज़र आईडी नीचे सबमिट करें।</p>
        <!--<div class="d-flex justify-content-center align-items-center mt-2"><span class="fw-normal">Don't have an account? <a href="./sign-up.html" class="fw-bold">Create account</a></span></div>-->
    </div>
    <form action="{{ route('coaching_camp_forgotStore') }}" id="submitform" class="mt-2 needs-validation" novalidate
    method="post" >
    @csrf

        <div class="form-group mb-4">
            <label for="email">1. Email ID/ईमेल आईडी</label>
            <input type="email" class="form-control " id="email" name="email" value="{{ old('email') }}"
            required>
        </div>
        {{-- <div class="form-group mb-4">
            <label for="email">2. Mobile Number (Registered Only)/मोबाइल नंबर (केवल पंजीकृत)</label>
            <input type="email" class="form-control" id="email">
        </div> --}}

        <div class="row">


            <!-- <div class="col-md-6">

                <button type="submit" class="btn btn-danger w-100 rounded-pill"
                    data-bs-toggle="modal" data-bs-target="#verify">Submit/दर्ज करे</button>
            </div> -->

            <div class="col-md-6">

                <button type="submit" class="btn btn-outline-danger rounded-pill" >Submit/दर्ज करें</button>
            </div>




            <div class="col-md-6">
                <a href="{{ route('coaching_camp_login') }}" class="small btn btn-outline-light rounded-pill">Back to Login/पिछले चरण पर जाएं</a>

            </div>
        </div>


    </form>
</div>
  @endsection


  @push('custom-scripts')
<script>

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
