@extends('layouts/facility_booking_layout')
@section('content')
    <div class="container-fluid">
        <a href="#" title="Instruction" class="help" data-bs-toggle="modal" data-bs-target="#myModal">
            <span class="item">
                <img src="{{ asset('facility_booking_storage') }}/images/instruction.png" />
            </span>
            <div class="circle" style="animation-delay: 0s"></div>
            <div class="circle" style="animation-delay: 1s"></div>
            <div class="circle" style="animation-delay: 2s"></div>
            <div class="circle" style="animation-delay: 3s"></div>
        </a>
        <div class="row">
            <div class="col-md-6 loginsidebar">
                <div class="row justify-content-center">
                    <div class="col-4 col-lg-3 text-center mb-3"> <img
                            src="{{ asset('facility_booking_storage') }}/images/logo.png" class="img-fluid"> </div>
                    <div class="col-md-12 col-12 deptname">
                        <h3 class="hd-org">Khel Sathi Portal/खेल साथी पोर्टल</h3>
                        <h5>Department of Sports, Government of Uttar Pradesh<br>
                            खेल विभाग, उत्तर प्रदेश सरकार</h5>
                    </div>
                    <div class="col-md-12 col-12 deptname">
                        <h4 class="text-danger">Facility Booking/सुविधा बुकिंग</h4>
                    </div>
                </div>
            </div>
            <div class="col-md-6 bg-light1">
                <div class="p-4 p-lg-5 login-form">
                    <div class="text-center text-md-center mb-4 mt-md-0">
                        <h3 class="mb-0">Applicant's Login/आवेदक का लॉगिन</h3>
                        <div class="text-center mt-2">
                            <span class="fw-normal">Don't have an account? <a
                                    href="{{ route('facility_booking_register') }}" class="fw-bold">Create
                                    Account</a>
                            </span>
                            <br>
                            <span class="fw-normal">अकाउंट नहीं है? <a href="{{ route('facility_booking_register') }}"
                                    class="fw-bold">सृजित करें </a>
                            </span>
                        </div>
                    </div>
                    <form id="preregister" action="{{ route('facility_booking_login') }}" class="mt-2 needs-validation"
                        novalidate method="post">
                        @csrf
                        <div class="form-group mb-3">
                            <label for="email">1. Registered Email ID/पंजीकृत ईमेल आईडी</label>
                            <input type="text" class="form-control" id="email" name="email" required>
                            {{-- <input required type="email" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,4}$" name="email"
                            class="form-control" max="255"> --}}
                        </div>
                        <div class="form-group mb-3">
                            <label for="password-field">2. Password/पासवर्ड</label>
                            <input type="password" required class="form-control" name="password" id="password-field">
                            <span toggle="#password-field" required
                                class="fa fa-fw fa-eye field-icon toggle-password"></span>
                        </div>
                        <div class="d-flex justify-content-end mb-3 align-items-top text-end">
                            <a href="{{ route('facility_booking_forgot_password') }}" class="small text-right"><b>
                                    Forgot Password/पासवर्ड भूल गए?
                                </b></a>
                            <style>
                                .cp_refresh {
                                    padding: 38px 0px 0px 0px;
                                }
                            </style>
                        </div>
                        <div class="row form-group mb-3">
                            <div class="col-lg-5 col-5">
                                <div class="captcha">
                                    <label class="btn-block">3. Captcha/कैप्चा</label>
                                    <span class="unselectable"
                                        id="cp_refresh">{{ $Code1 }}+{{ $Code2 }}</span>
                                </div>
                            </div>
                            <div class="col-lg-1 col-1 refresh">
                                <div class="cp_refresh"><a href="javascript:void(0)" title="Refresh Captcha"><span
                                            class="fas fa-redo"></span></a></div>
                            </div>
                            <div class="col-lg-6 col-6">
                                <label>4. Enter Captcha/कैप्चा भरें</label>
                                <input name="captcha" id="captcha" type="text" required class="form-control">
                            </div>
                        </div>
                        <div class="justify-content-center row">
                            <div class="col-md-6">
                                <input type="hidden" name="capchaCode" id="capchaCode" class="refreshc"
                                    value="{{ $capchaCode }}">
                                <button type="submit" class="btn btn-outline-success w-100"
                                    onclick="validateandcheck()">Login/लॉगिन करें</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>


    <script>
        $(".refresh").on("click", function() {
            $.ajax({
                type: "GET",
                url: ajaxUrl + "/gymnasium_swimming/cp_refresh/",
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
@endsection
@push('custom-scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/crypto-js/3.1.9-1/crypto-js.js"></script>
    <script type="text/javascript">
        function validateandcheck() {


            // alert(1)

            if ($("#password-field").val() != '') {
                var dataToEncrypt = $("#password-field").val();
                var encryptionKey = "2b7e151628aed2a6abf7158809cf4f3c";
                var keyHex = CryptoJS.enc.Hex.parse(encryptionKey);
                var encrypted = CryptoJS.AES.encrypt(dataToEncrypt, keyHex, {
                    mode: CryptoJS.mode.ECB
                });
                $("#password-field").val(encrypted.toString());

                var mdataToEncrypt = $("#email").val();
                var mencryptionKey = "2b7e151628aed2a6abf7158809cf4f3c";
                var mkeyHex = CryptoJS.enc.Hex.parse(mencryptionKey);
                var mencrypted = CryptoJS.AES.encrypt(mdataToEncrypt, mkeyHex, {
                    mode: CryptoJS.mode.ECB
                });


                $("#email").val(mencrypted.toString());

            };
        }
    </script>
@endpush
