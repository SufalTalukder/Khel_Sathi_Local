<!doctype html>
<html><!-- InstanceBegin template="/Templates/template.dwt" codeOutsideHTMLIsLocked="false" -->
<head>
    <!-- InstanceBeginEditable name="doctitle" -->
<title>Official Web Portal of Department of Sports, Government of Uttar Pradesh, India</title>
<!-- InstanceEndEditable -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <link rel="shortcut icon" href="favicon.png" />

    <link href="{{ asset('admin') }}/css/all.css" rel="stylesheet" />
    <link href="{{ asset('public/coaching_camp')}}/css/bootstrap.css" rel='stylesheet' />
    <link href="{{ asset('public/coaching_camp')}}/css/all.css" rel="stylesheet" />
    <link href="{{ asset('public/coaching_camp')}}/css/dataTables.bootstrap5.min.css" rel='stylesheet' />
    <link href="{{ asset('public/coaching_camp')}}/css/custom_theme.css" rel='stylesheet' />
    <link href="{{ asset('public/coaching_camp')}}/css/draggle.css" rel="stylesheet">
    <link href="{{ asset('public/coaching_camp')}}/css/responsive.css" rel='stylesheet' />
    <link href="{{ asset('public/coaching_camp')}}/css/datepicker.css" rel="stylesheet" media="all" />
    <link href="{{ asset('public/coaching_camp')}}/css/select2.min.css" rel="stylesheet" media="all" />
    <link href="{{ asset('public/coaching_camp')}}/css/font.css" rel="stylesheet" media="all" />
    <link href="{{ asset('admin') }}/css/toast.css" rel='stylesheet'/>
    <!-- InstanceBeginEditable name="head" -->
<!-- InstanceEndEditable -->
</head>
<body class="dashbg">
    <div class="contentwraper">
        <header class="header">
            <div class="container-fluid">
                <div class="row">
                    <div class="col col-md-1 b-right">
                        <img src="{{ asset('public/coaching_camp')}}/images/dash-logo.png" alt="" class="dash-logo" />
                    </div>
                    <div class="col col-md-11">
                        <div class="row modulebg">
                            <div class="col">
                                <h4 class="moudlename">Khel Sathi Portal/खेल साथी पोर्टल <small>Department of Sports, Government of Uttar Pradesh
खेल विभाग, उत्तर प्रदेश सरकार</small></h4>
                            </div>
                            <div class="col-auto">
                                <nav class="navbar navbar-expand-lg topmenu">
                                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon icons icon-menu"></span></button>
                                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                                        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                                            <li class="nav-item active"><a class="nav-link" href="{{ route('coaching_camp_dashboard') }}"><span class="icons icon-speedometer"></span> Dashboard </a></li>
                                            <li class="nav-item"><a href="#" class="profileicon">
                                                <span class="icons icon-user"></span> </a><div class="sidebar">
                                                    <div class="profiletitle">{{ Auth::guard('CoachingCamp')->user()->name }}<span class="text-uppercase">Applicant</span> <span>Last Login : {{ dmy(Auth::guard('CoachingCamp')->user()->last_login) }}</span></div>
                                                    <div class="scrollwrap">
                                                        <div class="nano-content">
                                                            <ul class="navsidebar">

                                                                <li class="nav-item"><a href="{{ route('coaching_camp_change_password') }}"><span class="icons icon-lock"></span>  Change Password</a> </li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                    <div class="logoutbutton"><a href="{{ route('coaching_camp_logout') }}"><span class="fas fa-power-off"></span>&nbsp;&nbsp;Logout</a></div>
                                                </div>
                                            </li>
                                        </ul>
                                    </div>
                                </nav>
                            </div>
                            <nav class="navbar navbar-expand-lg mainmenu">
                                <div class="container-fluid p-0">
                                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon icons icon-menu"></span></button>
                                    <div class="collapse navbar-collapse" id="Div1">
                                        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                                            <li class="nav-item"> <a class="nav-link module-name" href="#">
{{-- District Sports Office / जिला खेलकार्यालय --}}
</a> </li>
                                        </ul>
                                    </div>
                                </div>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
        </header>
        <!-- InstanceBeginEditable name="Content Area" -->
 @yield('content')
  <!-- InstanceEndEditable -->
        <footer>
            <div class="row">
                <div class="col-md-10">
                    <ul class="foot-list">
                        <li>Copyright © Department of Sports, Government of Uttar Pradesh / खेल विभाग, उत्तर प्रदेश सरकार</li>
                    </ul>
                </div>
                <!-- <div class="col-md-2">
                    <ul class="foot-list">
                        <li>Powered by <a href="http://otpl.co.in/" target="_blank">VTPL</a></li>
                    </ul>
                </div> -->
            </div>
        </footer>
    </div>


    <script type="text/javascript" src="{{ asset('public/coaching_camp')}}/js/jquery-min.js"></script>
    <script type="text/javascript" src="{{ asset('public/coaching_camp')}}/js/bootstrap.js"></script>
    <script type="text/javascript" src="{{ asset('public/coaching_camp')}}/js/jquery.nanoscroller.min.js"></script>
    <script type="text/javascript" src="{{ asset('public/coaching_camp')}}/js/jquery.dataTables.min.js"></script>
    <script type="text/javascript" src="{{ asset('public/coaching_camp')}}/js/dataTables.bootstrap5.min.js"></script>
    <script type="text/javascript" src="{{ asset('public/coaching_camp')}}/js/builder.js"></script>
    <script type="text/javascript" src="{{ asset('public/coaching_camp')}}/js/beautifyhtml.js"></script>
    <script type="text/javascript" src="{{ asset('public/coaching_camp')}}/js/dragble.js"></script>
    <script type="text/javascript" src="{{ asset('public/coaching_camp')}}/js/datepicker.js"></script>
	<script type="text/javascript" src="{{ asset('public/coaching_camp')}}/js/datepicker.en.js"></script>
    <script type="text/javascript" src="{{ asset('public/coaching_camp')}}/js/select2.min.js"></script>
    <script type="text/javascript" src="{{ asset('public/coaching_camp')}}/js/theme-script.js"></script>
    <!-- InstanceBeginEditable name="for-javascript" -->
<div class="modal fade" id="myModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
      <div class="modal-content" >
          <div class="modal-header text-center" style="display: block;">
              <b>Instructions/अनुदेश</b>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
          <div class="row">
          <div class="col-md-6">
              <ul class="list">

                  <li>Step 1: Get yourself registered by furnishing basic details, and OTP based verification.</li>
                  <li>Step 2: Login to the Portal with the received Login Credentials.</li>
                  <li>Step 3: Submit the Application Form.</li>
                  <li>Step 4: Wait for the response of UP Sports Department. </li>
              </ul>
          </div>


              <div class="col-md-6 border-left ">
              <ul class="list">

<li>चरण 1: बुनियादी विवरण और ओटीपी आधारित सत्यापन प्रदान करके स्वयं को पंजीकृत करें।</li>
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

<script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.blockUI/2.70/jquery.blockUI.min.js"></script>
<script type="text/javascript" src="{{ url('admin') }}/js/toast.js"></script>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script type="text/javascript" src="{{ url('admin') }}/js/sweetalert.min.js"></script>
<script type="text/javascript" src="{{ url('admin') }}/js/custom.js"></script>
 <x-message/>
<script>

var ajaxUrl = "{{ url('') }}";

        $(".toggle-password").click(function () {

            $(this).toggleClass("fa-eye fa-eye-slash");
            var input = $($(this).attr("toggle"));
            if (input.attr("type") == "password") {
                input.attr("type", "text");
            } else {
                input.attr("type", "password");
            }
        });
    </script>

@stack('custom-scripts')
<!-- InstanceEndEditable -->
</body>
<!-- InstanceEnd --></html>
