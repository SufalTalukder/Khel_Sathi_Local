@extends('layouts\player_layout_application')
@section('content')
    <div class="col-md-6 bg-light1">
        <div class="p-4 p-lg-5 login-form">
            <div class="text-center text-md-center mb-4 mt-md-0">
                <h3 class="mb-0">Login</h3>
                <div class="d-flex justify-content-center align-items-center mt-2"><span class="fw-normal">Don't have an
                        account? <a href="{{ route('playerregistration') }}" class="fw-bold">Register Here </a>
                        अकाउंट नहीं है? <a href="{{ route('playerregistration') }}" class="fw-bold">अभी पंजीकरण
                            करें</a></span></div>
            </div>
            <form action="{{ route('playerloginStore') }}" class="mt-4 needs-validation" novalidate method="post">
                @csrf


                <div class="form-group mb-3">
                    <label for="email">1. Registered Email ID/पंजीकृत ईमेल आईडी</label>
                    <input type="email" name="email" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,4}$"
                        class="form-control " id="email" value="{{ old('email') }}" required>
                    @error('email')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <div class="form-group mb-3">
                        <label for="password-field">2. Password/पासवर्ड</label>
                        <input type="password" name="password" class="form-control " id="password-field"
                            value="{{ old('password') }}" required>
                        <span toggle="#password-field" class="fa fa-fw fa-eye field-icon toggle-password"></span>
                        @error('password')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="captcha">
                                    <div class="captcha">
                                        <label class="btn-block">3. Captcha/कैप्चा</label>
                                        <span class="unselectable"
                                            id="p_refresh">{{ $Code1 }}+{{ $Code2 }}</span>
                                        <input name="captchacode" type="hidden"
                                            class="form-control captchacode unselectable h4" value="{{ $Code1 + $Code2 }}"
                                            readonly>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-1">
                                <div class="refresh"><a href="javascript:void(0)" title="Refresh Captcha"><span
                                            class="fas fa-redo"></span></a></div>
                            </div>
                            <div class="col-md-5">
                                <label>4. Enter Captcha/कैप्चा भरें</label>
                                <input name="captcha" type="text" class="form-control " value="{{ old('captcha') }}"
                                    required>
                                @error('captcha')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>
                <div class="d-grid mb-3"><button type="submit" class="btn btn-outline-danger rounded-pill">Sign in/लॉगिन
                        करें</button></div>
                <div class="clearfix"></div>
                <div class="d-flex justify-content-between align-items-top">
                    <a href="{{ route('playerforgotpassword') }}" class="small text-right"><b>Forgot Password?/पासवर्ड भूल
                            गए?</b></a>

                </div>
            </form>
        </div>
    @endsection



    @push('custom-scripts')
        <script>
            $(".refresh").on("click", function() {
                $.ajax({
                    type: "GET",
                    url: ajaxUrl + "/player_coach/cp_refresh/",
                    dataType: "json",
                    success: function(res) {
                        console.log(res)
                        $("#p_refresh").html(res.Code1 + '+' + res.Code2);
                        $(".captchacode").val(res.Code1 + res.Code2);
                        // $(".refreshc").val(res.capchaCode);
                    },
                });
            });
        </script>
    @endpush
