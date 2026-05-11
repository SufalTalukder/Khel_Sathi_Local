@extends('layouts/web')
@section('content')
    <style>

    </style>
    <div class="row">
        <div class="col-md-6 loginsidebar">
            <div class="row justify-content-center">
                <div class="col-4 col-lg-2 text-center mb-3">
                    <img src="{{ asset('assets_admin/images/logo.png') }}" class="img-fluid mobile-resp" />
                </div>
                <div class="col-md-12 col-12 deptname">
                    <h3 class="hd-org">Khel Sathi Portal/खेल साथी पोर्टल</h1>
                </div>
                <div class="col-md-12 pt-1 deptname">
                    <h3 class="text-success">Department of Sports, Government of Uttar Pradesh<br>
                        खेल विभाग, उत्तर प्रदेश सरकार
                    </h3>
                </div>
            </div>
        </div>
        <div class="col">
            <div class="p-4 p-lg-5 login-form">
                <div class="text-center text-md-center mt-md-0">
                    <h3 class="mb-0">Login/लॉग इन</h3>
                </div>
                <form action="{{ route('adminlogin') }}" method="post" id="adminlogin" class="mt-2 row g-3 required"
                    novalidate>
                    <div class="col-md-12">
                        <label for="email">Email/ईमेल</label>
                        <input type="text" class="form-control" id="email" name="email" required>
                        {{-- <input type="email" class="form-control" id="email" name="email" required> --}}
                        <div class="invalid-feedback">
                            Please enter email/कृपया ईमेल दर्ज करें
                        </div>
                    </div>
                    <div class="col-md-12">
                        <label for="password-field">Password/पासवर्ड</label>
                        <input type="password" class="form-control" id="password-field" name="password" required>
                        <span toggle="#password-field" class="fa fa-fw fa-eye field-icon toggle-password"></span>
                        <div class="invalid-feedback">
                            Please enter password/कृपया पासवर्ड दर्ज करें
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="row">
                            <div class="col-md-5 col-5">
                                <div class="captcha">
                                    <label class="btn-block">Captcha/कॅप्चा</label>
                                    <!-- <span class="unselectable" id="cp_refresh">{{ $capchaCode }}</span> -->
                                    <span class="unselectable"
                                        id="cp_refresh">{{ $Code1 }}+{{ $Code2 }}</span>
                                </div>
                            </div>
                            <div class="col-md-1 col-1 refresh">
                                <div class="cp_refresh"><a href="javascript:void(0)" title="Refresh Captcha"><span
                                            class="fas fa-redo"></span></a></div>
                            </div>
                            <div class="col-md-6 col-6">
                                <label>Enter Captcha/केप्चा भरे</label>
                                <input name="captcha" id="captcha" type="text" required max="2"
                                    class="form-control">
                                <!-- <input name="captcha" id="captcha" type="text" required pattern="[0-9]{5}$" class="form-control"> -->
                                <div class="invalid-feedback">
                                    Please provide a valid captcha/कृपया एक मान्य कैप्चा प्रदान करें
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="d-grid"><button type="submit" class="btn btn-info" onclick="validateandcheck()">Sign
                            in/लॉगिन करे</button> </div>
                    <div class="clearfix"></div>
                    <div class="d-flex justify-content-between align-items-top">
                        <input type="hidden" name="capchaCode" id="capchaCode" class="refreshc"
                            value="{{ $capchaCode }}">
                    </div>
                </form>
            </div>
        </div>
    </div>
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
