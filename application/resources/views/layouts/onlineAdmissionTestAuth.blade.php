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
    <link href="{{ asset('admin') }}/css/login.css" rel="stylesheet"/>
    <link href="{{ asset('onlineAdmission_storage') }}/css/all.css" rel="stylesheet"/>
    <link href="{{ asset('onlineAdmission_storage') }}/css/custom_theme.css" rel="stylesheet"/>
    <link href="{{ asset('admin') }}/css/datepicker.css" rel="stylesheet"/>
    <link href="{{ asset('admin') }}/css/toast.css" rel="stylesheet"/>
    <link href="{{ asset('admin') }}/css/default.css" rel="stylesheet"/>
    <script src="{{ url('admin') }}/js/jquery-min.js"></script>
</head>
<body class="dashbg">

<div class="contentwraper" style="padding-top:100px; padding-bottom:55px;">

    {{-- HEADER — same as onlineAdmissionnav --}}
    <header class="header">
        <div class="container-fluid">
            <div class="row">
                <div class="col-2 col-md-1 b-right">
                    <img src="{{ asset('onlineAdmission_storage') }}/images/dash-logo.png" alt="" class="dash-logo"/>
                </div>
                <div class="col-10 col-md-11">
                    <div class="row modulebg">
                        <div class="col">
                            <h4 class="moudlename">Department of Sports/खेल विभाग</h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </header>

    {{-- TWO-COLUMN LAYOUT matching original loginsidebar pattern --}}
    <div class="container-fluid pagecontentbody">
        <div class="tab-content">
            <div class="pagebody removebg-color">
                <div class="row g-0" style="min-height: calc(100vh - 160px);">

                    {{-- LEFT SIDEBAR — exact match to original .loginsidebar CSS --}}
                    <div class="col-md-5 loginsidebar d-none d-md-flex flex-column align-items-center" style="padding-top:3%;">
                        <div class="deptname px-3 text-center">
                            <div class="item mb-3">
                                <div class="circle"></div>
                                <div class="circle" style="animation-delay:.4s;"></div>
                                <div class="circle" style="animation-delay:.8s;"></div>
                                <img src="{{ asset('onlineAdmission_storage') }}/images/dash-logo.png" alt="Logo">
                            </div>
                            <h3>Khel Sathi Portal<br><small>खेल साथी पोर्टल</small></h3>
                            <h5>Department of Sports, Government of Uttar Pradesh<br>
                                <small style="font-size:13px; color:#333;">खेल विभाग, उत्तर प्रदेश सरकार</small>
                            </h5>
                            <h5 class="mt-2" style="color:#c00;">Sports College Admission<br>
                                <small>स्पोर्ट कॉलेज प्रवेश</small>
                            </h5>
                            <p class="mt-1" style="font-size:12px; color:#555;">ऑनलाइन आवेदन पोर्टल</p>
                        </div>
                    </div>

                    {{-- RIGHT FORM PANEL --}}
                    <div class="col-md-7 bg-light1">
                        <div class="p-4 p-lg-5 login-form">
                            @yield('content')
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>

    {{-- FOOTER --}}
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

<script src="{{ url('admin') }}/js/bootstrap.js"></script>
<script src="{{ url('admin') }}/js/datepicker.js"></script>
<script src="{{ url('admin') }}/js/datepicker.en.js"></script>
<script src="{{ url('admin') }}/js/toast.js"></script>
<script src="{{ url('admin') }}/js/custom.js"></script>
<script src="{{ url('admin') }}/js/sweetalert.min.js"></script>
<script>var ajaxUrl = "{{ url('') }}";</script>
<x-message />
@stack('custom-scripts')
</body>
</html>
