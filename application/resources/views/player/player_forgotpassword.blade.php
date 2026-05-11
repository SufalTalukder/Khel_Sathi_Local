@extends( 'layouts\player_layout_application' )
@section('content')
<div class="col-md-6 bg-light1">

                <div class="p-4 p-lg-5 login-form">
                    <div class="text-center text-md-center mb-4 mt-md-0">
                        <h3 class="mb-0">Forgot Password?</h3>
                        <p>Please submit your User ID below and we'll send you a link to recover your password.</p>
                        <!--<div class="d-flex justify-content-center align-items-center mt-2"><span class="fw-normal">Don't have an account? <a href="./sign-up.html" class="fw-bold">Create account</a></span></div>-->
                    </div>
                    <form action="{{ route('playerforgotStore') }}" class="mt-4 needs-validation" novalidate method="post">
                    @csrf
                        <div class="form-group mb-4">
                            <label for="email">Email Id</label>
                            <input type="email" class="form-control " id="email" name="email" value="{{ old('email') }}"
                        required>
                        </div>
                        <div class="d-grid">
                        <button type="submit" class="btn btn-outline-danger rounded-pill" data-bs-toggle="modal"
                        data-bs-target="#verify">Submit/दर्ज करें</button>
                       </div>
                        <div class="d-flex justify-content-center align-items-top mt-3">
                        <div><a href="{{ route('playerlogin') }}" class="small btn btn-outline-light rounded-pill">Back to Login/पिछले चरण पर जाएं</a>

                        </div>
                    </form>
                </div>
            </div>
@endsection
@push('custom-scripts')
