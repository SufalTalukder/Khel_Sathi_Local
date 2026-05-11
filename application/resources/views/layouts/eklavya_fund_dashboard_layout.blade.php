<!doctype html>
<html>
<head>
        <!-- Google Tag Manager -->
        <script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
    new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
    j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
    'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
    })(window,document,'script','dataLayer','GTM-NKD3W5D5');</script>
    <!-- End Google Tag Manager -->
    <title>Official Web Portal of Department of Sports, Government of Uttar Pradesh, India</title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <base href="{{ url('/public') }}">
    <?php $urls = url('/public'); ?>
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <link rel="shortcut icon" href="favicon.png" />
    <link href="{{ asset('eklavya_fund') }}/css/bootstrap.css" rel='stylesheet' />
    <link href="{{ asset('eklavya_fund') }}/css/font.css" rel="stylesheet" />
    <link href="{{ asset('eklavya_fund') }}/css/all.css" rel="stylesheet" />
    <link href="{{ asset('eklavya_fund') }}/css/dataTables.bootstrap5.min.css" rel="stylesheet" />
    <link href="{{ asset('eklavya_fund') }}/css/datepicker.css" rel="stylesheet" media="all" />
    <link href="{{ asset('eklavya_fund') }}/css/custom_theme.css" rel='stylesheet' />
    <link href="{{ asset('eklavya_fund') }}/css/default.css" rel='stylesheet' />
    <link href="{{ asset('eklavya_fund') }}/css/draggle.css" rel="stylesheet">
    <link href="{{ asset('eklavya_fund') }}/css/responsive.css" rel='stylesheet' />
    <link href="{{ asset('eklavya_fund') }}/css/select2.min.css" rel="stylesheet" media="all" />
    <link href="{{ asset('admin') }}/css/login.css" rel='stylesheet' />
    <link href="{{ asset('admin') }}/css/toast.css" rel='stylesheet'/>
  <!--<style>
        .login-form .form-control {
            min-height: 35px;
        }
    </style>-->
</head>
<body class="dashbg">
    <div class="contentwraper">
        <header class="header">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-1 b-right"> <img src="{{ asset('eklavya_fund') }}/images/logo.png" alt="" class="dash-logo dash-resp" style=" max-width: 95px; " /> </div>
                    <div class="col-md-11">
                        <div class="row modulebg">
                            <div class="col">
                                <h4 class="moudlename">
                                    Khel Sathi Portal / खेल साथी पोर्टल <br>
                                    <span style=" font-size: 15px; color: gainsboro; "> Government of Uttar Pradesh/उत्तर प्रदेश सरकार </span>
                                </h4>
                            </div>
                            <div class="col-auto">
                                <nav class="navbar navbar-expand-lg topmenu">
                                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon icons icon-menu"></span></button>
                                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                                        <ul class="navbar-nav m-2">
                                            <li class="nav-item active"> <a class="nav-link dbbtn" href="{{url('eklavyaFund/dashboard')}}"> <span class="icons icon-speedometer"></span> Dashboard/डैशबोर्ड </a> </li>
                                            <li class="nav-item">
                                                <a href="javascript:void(0)" class="profileicon"> <span class="icons icon-user"></span> </a>
                                                <div class="sidebar">
                                                    <div class="profiletitle">{{Auth::guard('EklavyaFund')->user()->academy_name}}<span class="text-uppercase">3</span></div>
                                                    <div class="scrollwrap">
                                                        <div>
                                                            <ul class="navsidebar">
                                                                <li class="nav-item"><a href="#"><span class="icons icon-user"></span> Profile</a> </li>
                                                                <li class="nav-item"><a href="{{url('eklavyaFund/change_password')}}"><span class="icons icon-lock"></span> Change Password/पासवर्ड बदलें</a> </li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                    <div class="logoutbutton"> <a href="{{url('eklavyaFund/logout')}}"> <span class="fas fa-power-off"></span>&nbsp;&nbsp; Logout/लॉगआउट करें </a> </div>
                                                </div>
                                            </li>
                                        </ul>
                                    </div>
                                </nav>
                            </div>
                            <nav class="navbar navbar-expand-lg mainmenu">
                                <div class="container-fluid p-0">
                                    <span class="nav-text">Eklavya Krida Kosh Application for financial assistance to Sports Clubs/Academies/एकलव्य क्रीड़ा कोष खेल क्लबों/एकेडमियों के लिए वित्तीय सहायता पंजीकरण</span>
                                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon icons icon-menu"></span></button>
                                    <div class="collapse navbar-collapse" id="Div1">
                                        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                                            <li class="nav-item"> <a class="nav-link module-name" href="#"> </a> </li>
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
                <div class="col-md-8">
                    <ul class="foot-list">
                        <li>Copyright &copy; Department of Sports, Government of Uttar Pradesh / खेल विभाग, उत्तर प्रदेश सरकार</li>
                    </ul>
                </div>
                <!-- <div class="col-md-4">
                    <ul class="foot-list float-end">
                        <li>Powered by <a href="http://otpl.co.in/" target="_blank">VTPL</a> </li>
                    </ul>
                </div> -->
            </div>
        </footer>
    </div>
    <script>
		var ajaxUrl = "{{ url('') }}";
	</script>
    <script src="{{ asset('') }}/eklavya_fund/js/jquery-min.js"></script>
    <script src="{{ asset('') }}/eklavya_fund/js/bootstrap.js"></script>
    <script type="text/javascript" src="{{ asset('eklavya_fund') }}/js/jquery.nanoscroller.min.js"></script>
    <script type="text/javascript" src="{{ asset('eklavya_fund') }}/js/jquery.dataTables.min.js"></script>
    <script type="text/javascript" src="{{ asset('eklavya_fund') }}/js/dataTables.bootstrap5.min.js"></script>
    <script type="text/javascript" src="{{ asset('eklavya_fund') }}/js/builder.js"></script>
    <script type="text/javascript" src="{{ asset('eklavya_fund') }}/js/beautifyhtml.js"></script>
    <script type="text/javascript" src="{{ asset('eklavya_fund') }}/js/dragble.js"></script>
    <script src="{{ asset('') }}/assets_admin/js/datepicker.js"></script>
    <script src="{{ asset('') }}/assets_admin/js/datepicker.en.js"></script>
    <script type="text/javascript" src="{{ asset('') }}/assets_admin/js/toast.js"></script>
    <script type="text/javascript" src="{{ asset('eklavya_fund') }}/js/select2.min.js"></script>
    <script type="text/javascript" src="{{ asset('eklavya_fund') }}/js/sweetalert.min.js"></script>
    <script type="text/javascript" src="{{ asset('eklavya_fund') }}/js/theme-script.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.blockUI/2.70/jquery.blockUI.min.js"></script>
    <script src="{{ asset('') }}/assets_admin/js/custom.js"></script>
    <!-- InstanceBeginEditable name="for-javascript" -->
    
    <!-- InstanceEndEditable -->
    <!-- InstanceBeginEditable name="for-javascript" -->
    <script>
        $('.datepicker').datetimepicker({
            format: 'DD/MM/YYYY',
        });
        $(".back").click(function () {
            window.history.go(-1);
            return false;
        });
    </script>
    <script>
        $('body,html').click(function (e) {
            $('#hide-menu').removeClass('header header-width');
        });
    </script>
    @stack('custom-scripts')
    <!-- InstanceEndEditable -->
</body>

</html>
