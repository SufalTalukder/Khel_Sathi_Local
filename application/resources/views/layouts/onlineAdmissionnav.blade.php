<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

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
    <!-- InstanceBeginEditable name="doctitle" -->
    <title>Applicant Panel</title>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <link rel="shortcut icon" href="favicon.png" />
    <?php $urls = url('/public'); ?>
    <link href="{{ asset('onlineAdmission_storage') }}/css/bootstrap.css" rel='stylesheet' />
    <link href="{{ asset('admin') }}/css/font.css" rel='stylesheet' />
    <link href="{{ asset('admin') }}/css/login.css" rel='stylesheet' />
    <link href="{{ asset('onlineAdmission_storage') }}/css/all.css" rel="stylesheet" />
    <link href="{{ asset('onlineAdmission_storage') }}/css/dataTables.bootstrap5.min.css" rel='stylesheet' />
    <link href="{{ asset('onlineAdmission_storage') }}/css/custom_theme.css" rel='stylesheet' />
    <link href="{{ asset('onlineAdmission_storage') }}/css/draggle.css" rel="stylesheet">
    <link href="{{ asset('onlineAdmission_storage') }}/css/responsive.css" rel="stylesheet" media="all" />
    <link href="{{ asset('admin') }}/css/datepicker.css" rel="stylesheet" media="all" />
    <link href="{{ asset('admin') }}/css/toast.css" rel='stylesheet' />
    <link href="{{ asset('admin') }}/css/default.css" rel='stylesheet' />
    <script type="text/javascript" src="{{ url('admin') }}/js/jquery-min.js"></script>
    <!-- InstanceBeginEditable name="head" -->

</head>

<body class="dashbg">
    <!-- Google Tag Manager (noscript) -->
    <noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-NKD3W5D5"
            height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
    <!-- End Google Tag Manager (noscript) -->
    <style>
        .contentwraper {
            padding-top: 130px !important;
        }
    </style>
    <div class="contentwraper">
        <header class="header">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-2 col-md-1 b-right"> <img src="{{ asset('onlineAdmission_storage') }}/images/dash-logo.png" alt="" class="dash-logo" /> </div>
                    <div class="col-10 col-md-11">
                        <div class="row modulebg">
                            <div class="col">
                                <h4 class="moudlename">Department of Sports/खेल विभाग</h4>
                            </div>
                            <x-OnlineAdmissionnav />
                        </div>
                    </div>
                </div>
            </div>
        </header>
        <div class="container-fluid pagecontentbody">
            <div class="tab-content">
                <div class="pagebody removebg-color">
                    @yield('content')
                </div>
            </div>
        </div>
        <footer>
            <div class="row">
                <div class="col-md-8">
                    <ul class="foot-list">
                        <li>Copyright &copy; Department of Sports, Government of Uttar Pradesh / खेल विभाग, उत्तर प्रदेश सरकार</li>
                    </ul>
                </div>
                <div class="col-md-4">
                    <ul class="foot-list float-end">
                        <li>Powered by <a href="https://www.vareli.co.in/" target="_blank">VTPL</a>
                        </li>
                    </ul>
                </div>
            </div>
        </footer>
    </div>

    <div class="modal fade" id="onlineFinalWarning" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">


                </div>
                <div class="modal-body text-center">

                    <div class="clearfix"></div>
                    <!--<h5>Your OTP verification is done successfully. Kindly <b>Proceed to Pay</b> the Registration Fee. After Fee Payment, your Registration on Portal will be completed, and Password will be sent on your registered Mobile No. & Email ID.</h5>-->
                    <h5>• Are you sure to do the final submission of the Application? No changes will be allowed in the Application once its final submission is done./क्या आप आवेदन को अंतिम रूप से दर्ज करना सुनिश्चित करते हैं? आवेदन को अंतिम रूप से दर्ज करने के पश्चात इसमें किसी प्रकार के संशोधन की अनुमति नहीं होगी। <br>
                        <br>

                </div>
                <div class="modal-footer justify-content-md-center">
                    <div class="col-4 d-flex gap-3">
                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">No</button>
                        <a class="btn btn-info" id="final_submit" href="Javascript:void(0)">Yes</a>
                    </div>

                </div>
            </div>
        </div>
    </div>
    <script>
        var ajaxUrl = "{{ url('') }}";
    </script>

    <script type="text/javascript" src="{{ url('admin') }}/js/bootstrap.js"></script>
    <script type="text/javascript" src="{{ url('admin') }}/js/jquery.nanoscroller.min.js"></script>
    <script type="text/javascript" src="{{ url('admin') }}/js/jquery.dataTables.min.js"></script>
    <script type="text/javascript" src="{{ url('admin') }}/js/dataTables.bootstrap5.min.js"></script>
    <script type="text/javascript" src="{{ url('admin') }}/js/datepicker.js"></script>
    <script type="text/javascript" src="{{ url('admin') }}/js/datepicker.en.js"></script>
    <script type="text/javascript" src="{{ url('admin') }}/js/builder.js"></script>
    <script type="text/javascript" src="{{ url('admin') }}/js/beautifyhtml.js"></script>
    <script type="text/javascript" src="{{ url('admin') }}/js/dragble.js"></script>
    <script type="text/javascript" src="{{ url('admin') }}/js/theme-script.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.blockUI/2.70/jquery.blockUI.min.js"></script>
    <script type="text/javascript" src="{{ url('admin') }}/js/toast.js"></script>
    <script type="text/javascript" src="{{ url('admin') }}/js/custom.js"></script>
    <script type="text/javascript" src="{{ url('admin') }}/js/sweetalert.min.js"></script>
    <script type="text/javascript" src="{{ url('admin') }}/js/chart.js"></script>


    <x-message />

    <script>
        $(".toggle-password").click(function() {
            $(this).toggleClass("fa-eye fa-eye-slash");
            var input = $($(this).attr("toggle"));
            if (input.attr("type") == "password") {
                input.attr("type", "text");
            } else {
                input.attr("type", "password");
            }
        });
        $('body,html').click(function(e) {

            // if ($(".sidebar ").hasClass("sidebar-width") ) {
            // alert($("sidebar").length );
            // $(".sidebar").removeClass("sidebar-width");
            // $(".header").removeClass("header-width");
            // }
        });
    </script>
    <script>
        $('body,html').click(function(e) {
            $('#hide-menu').removeClass('header header-width');
        });
    </script>
    @stack('custom-scripts')

</body>

</html>
