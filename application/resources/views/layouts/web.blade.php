<!doctype html>
<html>

<head>
    <!-- Google Tag Manager -->
    <script>
        (function(w, d, s, l, i) {
            w[l] = w[l] || [];
            w[l].push({
                'gtm.start': new Date().getTime(),
                event: 'gtm.js'
            });
            var f = d.getElementsByTagName(s)[0],
                j = d.createElement(s),
                dl = l != 'dataLayer' ? '&l=' + l : '';
            j.async = true;
            j.src =
                'https://www.googletagmanager.com/gtm.js?id=' + i + dl;
            f.parentNode.insertBefore(j, f);
        })(window, document, 'script', 'dataLayer', 'GTM-NKD3W5D5');
    </script>
    <!-- End Google Tag Manager -->
    <title>Official Web Portal of Department of Sports, Government of Uttar Pradesh, India</title>
    </title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <link rel="shortcut icon" href="../images/favicon.png" />
    <?php if (url('/') == 'http://127.0.0.1:8000') {
        $urls = url('/');
    } else {
        $urls = url('/public');
    } ?>
    <link href="{{ asset('admin') }}/css/bootstrap.css" rel='stylesheet' />
    <link href="{{ asset('admin') }}/css/font.css" rel='stylesheet' />
    <link href="{{ asset('admin') }}/css/login.css" rel='stylesheet' />
    <link href="{{ asset('admin') }}/css/all.css" rel="stylesheet" />
    <link href="{{ asset('admin') }}/css/dataTables.bootstrap5.min.css" rel='stylesheet' />
    <link href="{{ asset('admin') }}/css/custom_theme.css" rel='stylesheet' />
    <link href="{{ asset('admin') }}/css/draggle.css" rel="stylesheet">
    <link href="{{ asset('admin') }}/css/responsive.css" rel='stylesheet' />
    <link href="{{ asset('admin') }}/css/datepicker.css" rel="stylesheet" media="all" />
    <link href="{{ asset('admin') }}/css/toast.css" rel='stylesheet' />
    <link href="{{ asset('admin') }}/css/default.css" rel='stylesheet' />

    <link href="{{ url('admin') }}/css/select2.min.css" rel="stylesheet" media="all" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/css/intlTelInput.css" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/js/intlTelInput.min.js"></script>
</head>

<body>
    <!-- Google Tag Manager (noscript) -->
    <noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-NKD3W5D5" height="0" width="0"
            style="display:none;visibility:hidden"></iframe></noscript>
    <!-- End Google Tag Manager (noscript) -->
    <div class="container-fluid">
        <a href="#" title="Instruction" class="help" data-bs-toggle="modal" data-bs-target="#myModal"><span
                class="item">
                <img src="{{ asset('assets_admin/images/instruction.png') }}" />
            </span>
            <div class="circle" style="animation-delay: 0s"></div>
            <div class="circle" style="animation-delay: 1s"></div>
            <div class="circle" style="animation-delay: 2s"></div>
            <div class="circle" style="animation-delay: 3s"></div>
        </a>
        @yield('content')

    </div>

    <footer>
        <div class="row">
            <div class="col-md-8">
                <ul class="foot-list">
                    <li>Copyright &copy; Department of Sports, Government of Uttar Pradesh / खेल विभाग, उत्तर प्रदेश
                        सरकार</li>
                </ul>
            </div>
            <!--<div class="col-md-7">
                <ul class="foot-list">
                    <li><b>Technical Helpline :</b> Mobile:+91-9898989898, Email ID: testdomain@gmail.com</li>
                </ul>
            </div>-->
            <!-- <div class="col-md-4">
     <ul class="foot-list float-end">
      <li>Powered by <a href="http://otpl.co.in/" target="_blank">VTPL</a>
      </li>
     </ul>
    </div> -->
        </div>
    </footer>




    <div class="modal fade" id="nativealert" tabindex="-1" aria-labelledby="nativealert" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header border-0 pb-0">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body text-center px-4 pb-2">
                    <div style="font-size:48px; color:#dc3545; line-height:1;">&#9888;</div>
                    <h5 class="mt-2 mb-3" style="color:#dc3545;">Not Eligible / अपात्र</h5>
                    <p class="mb-1">We are sorry! You are ineligible to apply.</p>
                    <p class="mb-3">Only natives of <strong>Uttar Pradesh</strong> are eligible for this application.
                    </p>
                    <hr class="my-2">
                    <p class="mb-1 text-muted">आप आवेदन करने के लिए अपात्र हैं।</p>
                    <p class="mb-0 text-muted">केवल <strong>उत्तर प्रदेश</strong> के मूल निवासी ही इस आवेदन के लिए पात्र
                        हैं।</p>
                </div>
                <div class="modal-footer justify-content-center border-0 pt-2">
                    <button type="button" class="btn btn-danger rounded-pill px-4" data-bs-dismiss="modal">OK</button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="myModal" tabindex="-1" aria-labelledby="myModal" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header text-center" style="display: block;">
                    <b>Instructions/अनुदेश</b>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6">
                            <ul class="list">

                                <li>Step 1: Get yourself registered by furnishing basic details, and OTP based
                                    verification.</li>
                                <li>Step 2: Login to the Portal with the received Login Credentials.</li>
                                <li>Step 3: Submit the Application Form.</li>
                                <li>Step 4: Wait for the response of UP Sports Department. </li>
                            </ul>
                        </div>


                        <div class="col-md-6 border-left ">
                            <ul class="list">

                                <li>चरण 1: बुनियादी विवरण और ओटीपी आधारित सत्यापन प्रदान करके स्वयं को पंजीकृत करें।
                                </li>
                                <li>चरण 2: प्राप्त लॉगिन क्रेडेंशियल के साथ पोर्टल पर लॉगिन करें।</li>
                                <li>चरण 3: आवेदन पत्र जमा करें।</li>
                                <li>चरण 4: यूपी खेल विभाग की प्रतिक्रिया की प्रतीक्षा करें।</li>
                            </ul>
                        </div>


                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>



    <script>
        var ajaxUrl = "{{ url('') }}";
    </script>
    <script src="{{ asset('admin') }}/js/jquery-min.js"></script>
    <script src="{{ asset('admin') }}/js/bootstrap.js"></script>
    <script src="{{ asset('admin') }}/js/datepicker.js"></script>
    <script src="{{ asset('admin') }}/js/datepicker.en.js"></script>
    <script type="text/javascript" src="{{ asset('admin') }}/js/jquery.dataTables.min.js"></script>
    <script type="text/javascript" src="{{ asset('admin') }}/js/dataTables.bootstrap5.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.blockUI/2.70/jquery.blockUI.min.js"></script>
    <script type="text/javascript" src="{{ asset('admin') }}/js/toast.js"></script>
    <script src="{{ asset('admin') }}/js/custom.js"></script>
    <!-- <script src="~/Scripts/jquery_cookie.js" type="text/javascript"></script> -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-cookie/1.4.1/jquery.cookie.min.js"
        integrity="sha512-3j3VU6WC5rPQB4Ld1jnLV7Kd5xr+cq9avvhwqzbH/taCRNURoeEpoPBK9pDyeukwSxwRPJ8fDgvYXd6SkaZ2TA=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <x-message />
    <script>
        function investorType(type) {
            if (type == 2) {
                $(".investorType").hide();
                $(".attrs").removeAttr("required");
                $("#repl_3_2").html(2);
                $("#repl_5_4").html(3);
                $("#repl_6_5").html(4);
                $("#repl_7_6").html(5);

            } else {
                $(".investorType").show();
                $(".attrs").attr("required", "required");
                $("#repl_3_2").html(3);
                $("#repl_5_4").html(5);
                $("#repl_6_5").html(6);
                $("#repl_7_6").html(7);
            }
        }
        $(".attrs").attr("required", "required");

        $(".toggle-password").click(function() {
            $(this).toggleClass("fa-eye fa-eye-slash");
            var input = $($(this).attr("toggle"));
            if (input.attr("type") == "password") {
                input.attr("type", "text");
            } else {
                input.attr("type", "password");
            }
        });





        // A $( document ).ready() block.
        $(document).ready(function() {
            const phoneInputField = document.querySelector("#mobile");
            if (phoneInputField) {
                const phoneInput = window.intlTelInput(phoneInputField, {
                    initialCountry: "in",
                    utilsScript: "https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/js/utils.js",
                });
            }
            // setTimeout(() => {
            //     $("#mobile").attr("placeholder", "Enter Mobile No");
            // }, 50);
        });
    </script>
    <script type="text/javascript">
        $(window).on('load', function() {
            if ($.cookie('bas_referral') == null) {
                // $('#conceptnote').modal('show');
                $('#basicExampleModal').modal('show');
                // var date = new Date();
                // date.setTime(date.getTime() + (30 * 1000));
                var ref = document.referrer.toLowerCase();

                var cookURL = $.cookie('bas_referral', ref, {
                    expires: 1
                });
            }
            $('#Department').modal('show');
        });
    </script>
    @stack('custom-scripts')
</body>

</html>
