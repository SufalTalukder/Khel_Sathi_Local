<!DOCTYPE html>
<html lang="en">
<head>
    <title>Sports College Admission / स्पोर्ट कॉलेज प्रवेश</title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" href="{{ asset('onlineAdmission_storage') }}/images/dash-logo.png" />
    <link href="{{ asset('onlineAdmission_storage') }}/css/bootstrap.css" rel="stylesheet"/>
    <link href="{{ asset('admin') }}/css/font.css" rel="stylesheet"/>
    <link href="{{ asset('onlineAdmission_storage') }}/css/all.css" rel="stylesheet"/>
    <link href="{{ asset('onlineAdmission_storage') }}/css/dataTables.bootstrap5.min.css" rel="stylesheet"/>
    <link href="{{ asset('onlineAdmission_storage') }}/css/custom_theme.css" rel="stylesheet"/>
    <link href="{{ asset('onlineAdmission_storage') }}/css/draggle.css" rel="stylesheet"/>
    <link href="{{ asset('onlineAdmission_storage') }}/css/responsive.css" rel="stylesheet"/>
    <link href="{{ asset('admin') }}/css/datepicker.css" rel="stylesheet"/>
    <link href="{{ asset('admin') }}/css/toast.css" rel="stylesheet"/>
    <link href="{{ asset('admin') }}/css/default.css" rel="stylesheet"/>
    <script src="{{ url('admin') }}/js/jquery-min.js"></script>
    <style>
        .contentwraper { padding-top: 130px !important; }
        @media print {
            .no-print { display: none !important; }
            header, footer { display: none !important; }
            .contentwraper { padding-top: 0 !important; }
        }
    </style>
</head>
<body class="dashbg">
    <div class="contentwraper">
        <header class="header">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-2 col-md-1 b-right">
                        <img src="{{ asset('onlineAdmission_storage') }}/images/dash-logo.png" alt="" class="dash-logo"/>
                    </div>
                    <div class="col-10 col-md-11">
                        <div class="row modulebg align-items-center">
                            <div class="col">
                                <h4 class="moudlename">Department of Sports/खेल विभाग</h4>
                            </div>
                            <x-OnlineAdmissionnav/>
                            @if(Auth::guard('OnlineAdmission')->check())
                            <div class="col-auto no-print">
                                <a href="{{ route('onlineAdmissionTest.logout') }}" class="btn btn-outline-danger btn-sm rounded-pill">
                                    <i class="fas fa-power-off"></i> Logout
                                </a>
                            </div>
                            @endif
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
                        <li>Powered by <a href="https://www.vareli.co.in/" target="_blank">VTPL / वीटीपीएल द्वारा संचालित</a></li>
                    </ul>
                </div>
            </div>
        </footer>
    </div>

    <!-- Final Submit Confirmation Modal -->
    <div class="modal fade" id="onlineFinalWarning" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-body text-center pt-4">
                    <h5>• Are you sure to do the final submission of the Application? No changes will be allowed in the Application once its final submission is done.<br><br>
                    क्या आप आवेदन को अंतिम रूप से दर्ज करना सुनिश्चित करते हैं? आवेदन को अंतिम रूप से दर्ज करने के पश्चात इसमें किसी प्रकार के संशोधन की अनुमति नहीं होगी।</h5>
                </div>
                <div class="modal-footer justify-content-center">
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">No</button>
                    <a class="btn btn-info" id="final_submit" href="javascript:void(0)">Yes</a>
                </div>
            </div>
        </div>
    </div>

    <script>var ajaxUrl = "{{ url('') }}";</script>
    <script src="{{ url('admin') }}/js/bootstrap.js"></script>
    <script src="{{ url('admin') }}/js/jquery.nanoscroller.min.js"></script>
    <script src="{{ url('admin') }}/js/jquery.dataTables.min.js"></script>
    <script src="{{ url('admin') }}/js/dataTables.bootstrap5.min.js"></script>
    <script src="{{ url('admin') }}/js/datepicker.js"></script>
    <script src="{{ url('admin') }}/js/datepicker.en.js"></script>
    <script src="{{ url('admin') }}/js/builder.js"></script>
    <script src="{{ url('admin') }}/js/dragble.js"></script>
    <script src="{{ url('admin') }}/js/theme-script.js"></script>
    <script src="{{ url('admin') }}/js/toast.js"></script>
    <script src="{{ url('admin') }}/js/custom.js"></script>
    <script src="{{ url('admin') }}/js/sweetalert.min.js"></script>
    <x-message/>
    <script>
        $(".toggle-password").click(function() {
            $(this).toggleClass("fa-eye fa-eye-slash");
            var input = $($(this).attr("toggle"));
            input.attr("type", input.attr("type") == "password" ? "text" : "password");
        });
    </script>
    @stack('custom-scripts')
</body>
</html>
