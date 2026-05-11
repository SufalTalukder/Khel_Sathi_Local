<!doctype html>
<html><!-- InstanceBegin template="/Templates/template.dwt" codeOutsideHTMLIsLocked="false" -->
<head>
<!-- InstanceBeginEditable name="doctitle" -->
<title>Applicant Panel</title>
<!-- InstanceEndEditable -->
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="shortcut icon" href="favicon.png" />
<link href="{{ url('RPCAA') }}/css/bootstrap.css" rel='stylesheet'/>

<link href="{{ url('RPCAA') }}/css/all.css" rel="stylesheet"/>
<link href="{{ url('RPCAA') }}/css/dataTables.bootstrap5.min.css" rel='stylesheet'/>
<link href="{{ url('RPCAA') }}/css/custom_theme.css" rel='stylesheet'/>
<link href="{{ url('RPCAA') }}/css/draggle.css" rel="stylesheet">
<link href="{{ url('RPCAA') }}/css/responsive.css" rel="stylesheet" media="all"/>
<link href="{{ url('RPCAA') }}/css/datepicker.css" rel="stylesheet" media="all"/>
<link href="{{ url('RPCAA') }}/css/toast.css" rel='stylesheet'/>
<link href="{{ url('RPCAA') }}/css/default.css" rel='stylesheet'/>
<link href="{{ url('RPCAA') }}/css/select2.min.css" rel="stylesheet" media="all"/>
<!-- InstanceBeginEditable name="head" -->
<!-- InstanceEndEditable -->
</head>
<body class="dashbg">
<div class="contentwraper">
  <header class="header">
    <div class="container-fluid">
      <div class="row">
        <div class="col-2 col-md-1 b-right"> <img src="{{ url('RPCAA') }}/images/dash-logo.png" alt="" class="dash-logo" /> </div>
        <div class="col-10 col-md-11">
          <div class="row modulebg">
            <div class="col">
              <h3 class="moudlename">Khel Sathi Portal/खेल साथी पोर्टल<span class="department-logo">Department of Sports, Government of Uttar Pradesh / खेल विभाग, उत्तर प्रदेश सरकार</span></h3>

            </div>
            <div class="col-auto">
                <nav class="navbar navbar-expand-lg topmenu">
                    <!--button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon icons icon-menu"></span></button-->
                    <!--div class="collapse navbar-collapse" id="navbarSupportedContent"-->
                      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        <!--li class="nav-item active"><a class="nav-link" href="dashboard.html"><span class="icons icon-speedometer"></span> Dashboard </a></li-->
                        <li class="nav-item"><a href="#" class="profileicon"> <span class="icons icon-user"></span> </a>
                          <div class="sidebar">
                            <div class="profiletitle">{{Auth::guard('PrivateCoaching')->user()->name}}<span class="text-uppercase">Applicant</span> </div>
                            <div class="scrollwrap">
                              <div class="nano-content">
                                <ul class="navsidebar">

                                    <li class="nav-item"><a href="{{route('private_coaching_profile_preview')}}"><span class="icons icon-lock"></span> Profile</a> </li>

                                  <li class="nav-item"><a href="{{route('private_coaching_change_password')}}"><span class="icons icon-lock"></span> Change Password</a> </li>
                                  <li class="nav-item"><a href="{{route('private_coaching_dashboard')}}"><span class="icons icon-lock"></span> Dashboard</a> </li>

                                </ul>
                              </div>
                            </div>
                            <div class="logoutbutton"><a href="{{route('private_coaching_logout')}}"><span class="fas fa-power-off"></span>&nbsp;&nbsp;Logout</a></div>
                          </div>
                        </li>
                      </ul>

                  </nav>
            </div>
            </div>
			  <div class="row modulebg1">
            <div class="col">
              <h4>Registration of Pvt. Coaching Academies / Associations ,Gyms, Swimming Pools / निजी कोचिंग अकादमियों / संघों, जिम, और तरणताल का पंजीकरण</h4>
            </div>


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
				<div class="col-md-8">
					<ul class="foot-list">
						<li>Copyright © Department of Sports, Government of Uttar Pradesh / खेल विभाग, उत्तर प्रदेश सरकार</li>
					</ul>
				</div>
				<!--<div class="col-md-7">
                <ul class="foot-list">
                    <li><b>Technical Helpline :</b> Mobile:+91-9898989898, Email ID: testdomain@gmail.com</li>
                </ul>
            </div>-->
				<div class="col-md-4">
					<ul class="foot-list float-end">
						<li>Powered by <a href="http://otpl.co.in/" target="_blank">VTPL</a>
						</li>
					</ul>
				</div>
			</div>
		</footer>
</div>
<script>
    var ajaxUrl = "{{ url('') }}";
</script>
<script type="text/javascript" src="{{ url('RPCAA') }}/js/jquery-min.js"></script>
<script type="text/javascript" src="{{ url('RPCAA') }}/js/bootstrap.js"></script>
<script type="text/javascript" src="{{ url('RPCAA') }}/js/jquery.nanoscroller.min.js"></script>
<script type="text/javascript" src="{{ url('RPCAA') }}/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="{{ url('RPCAA') }}/js/dataTables.bootstrap5.min.js"></script>
<script type="text/javascript" src="{{ url('RPCAA') }}/js/builder.js"></script>
<script type="text/javascript" src="{{ url('RPCAA') }}/js/beautifyhtml.js"></script>
<script type="text/javascript" src="{{ url('RPCAA') }}/js/dragble.js"></script>
<script type="text/javascript" src="{{ url('RPCAA') }}/js/datepicker.js"></script>
<script type="text/javascript" src="{{ url('RPCAA') }}/js/datepicker.en.js"></script>
<script type="text/javascript" src="{{ url('RPCAA') }}/js/select2.min.js"></script>
<script type="text/javascript" src="{{ url('RPCAA') }}/js/theme-script.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.blockUI/2.70/jquery.blockUI.min.js"></script>
<script type="text/javascript" src="{{ url('admin') }}/js/toast.js"></script>
<script type="text/javascript" src="{{ url('admin') }}/js/custom.js"></script>
<script type="text/javascript" src="{{ url('admin') }}/js/sweetalert.min.js"></script>
<x-message/>


<!-- InstanceBeginEditable name="for-javascript" -->
<script>
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

<x-message/>
<script>
     $(".toggle-password").click(function () { $(this).toggleClass("fa-eye fa-eye-slash"); var input = $($(this).attr("toggle")); if (input.attr("type") == "password") { input.attr("type", "text"); } else { input.attr("type", "password"); } });
 </script>
     @stack('custom-scripts')
<!-- InstanceEnd --></html>
