<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
      <!-- Google Tag Manager -->
      <script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
    new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
    j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
    'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
    })(window,document,'script','dataLayer','GTM-NKD3W5D5');</script>
    <!-- End Google Tag Manager -->
	<title>Applicant - Official Web Portal of Department of Sports, Government of Uttar Pradesh, India</title>
	<meta charset="utf-8"/>
	<meta http-equiv="X-UA-Compatible" content="IE=edge"/>
	<meta name="viewport" content="width=device-width, initial-scale=1"/>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
	<base href="{{ url('/public') }}">
	<meta name="csrf-token" content="{{ csrf_token() }}"/>
	<link rel="shortcut icon" href="favicon.png"/>
    <link href="{{ asset('admin') }}/css/bootstrap.css" rel='stylesheet'/>
    <link href="{{ asset('admin') }}/css/all.css" rel="stylesheet"/>
    <link href="{{ asset('admin') }}/css/datepicker.css" rel="stylesheet" media="all"/>
    <link href="{{ asset('player') }}/css/custom_theme_player.css" rel='stylesheet'/>
    <link href="{{ asset('admin') }}/css/responsive.css" rel='stylesheet'/>
    <link href="{{ asset('admin') }}/css/toast.css" rel='stylesheet'/>
    <!--<style>
        .login-form .form-control {
            min-height: 35px;
        }
    </style>-->
    <script type="text/javascript" src="{{ asset('/public') }}/assets_admin/js/jquery-min.js"></script>
</head>
<body class="dashbg">
  <!-- Google Tag Manager (noscript) -->
<noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-NKD3W5D5"
height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
<!-- End Google Tag Manager (noscript) -->
<div class="contentwraper">
  <header class="header">
    <div class="container-fluid">
      <div class="row">
        <div class="col col-md-1 b-right"> <img src="{{ asset('player/images/dash-logo.png')}}" alt="" class="dash-logo" /> </div>
        <div class="col col-md-11">
          <div class="row modulebg">
            <div class="col">
              <h4 class="moudlename">Department of Sports</h4>
            </div>
            <div class="col-auto">
              <nav class="navbar navbar-expand-lg topmenu">
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon icons icon-menu"></span></button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                  <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item active"><a class="nav-link" href="{{route('playerdashboard')}}"><span class="icons icon-speedometer"></span> Dashboard </a></li>
                    <li class="nav-item"><a href="javascript:void();" class="profileicon"> <span class="icons icon-user"></span> </a>
                      <div class="sidebar">
                        <div class="profiletitle"><?php echo ucfirst(Auth::guard('player')->user()->name);?><span class="text-uppercase">Applicant</span> <span>Last Login : <?php echo date("d-m-Y ", strtotime(Auth::guard('player')->user()->last_login));?> </span></div>
                        <div class="scrollwrap">
                          <div class="nano-content">
                            <ul class="navsidebar">
                              <li class="nav-item"><a href="{{route('playerchangepassword')}}"><span class="icons icon-lock"></span> Change Password</a> </li>
                            </ul>
                          </div>
                        </div>
                        <div class="logoutbutton"><a href="{{route('playerlogout')}}"><span class="fas fa-power-off"></span>&nbsp;&nbsp;Logout</a></div>
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
                    <li class="nav-item"> <a class="nav-link module-name" href="#"> Government of Uttar Pradesh </a> </li>
                  </ul>
                </div>
              </div>
            </nav>
          </div>
        </div>
      </div>
    </div>
  </header>
  @yield('content')
  <footer>
    <div class="row">
      <div class="col-md-10">
        <ul class="foot-list">
          <li>Copyright &copy; Department of Sports</li>
        </ul>
      </div>
      <div class="col-md-2">
        <ul class="foot-list">
          <li>Powered by <a href="http://otpl.co.in/" target="_blank">VTPL</a></li>
        </ul>
      </div>
    </div>
  </footer>
</div>

<script>
		var ajaxUrl = "{{ url('') }}";
	</script>
	<script type="text/javascript" src="{{ asset('admin') }}/js/bootstrap.js"></script>
	<script type="text/javascript" src="{{ asset('admin') }}/js/jquery.nanoscroller.min.js"></script>
	<script type="text/javascript" src="{{ asset('admin') }}/js/jquery.dataTables.min.js"></script>
	<script type="text/javascript" src="{{ asset('admin') }}/js/dataTables.bootstrap5.min.js"></script>
	<script type="text/javascript" src="{{ asset('admin') }}/js/builder.js"></script>
	<script type="text/javascript" src="{{ asset('admin') }}/js/beautifyhtml.js"></script>
	<script type="text/javascript" src="{{ asset('admin') }}/js/dragble.js"></script>
	<script type="text/javascript" src="{{ asset('admin') }}/js/datepicker.js"></script>
	<script type="text/javascript" src="{{ asset('admin') }}/js/datepicker.en.js"></script>
	<script type="text/javascript" src="{{ asset('admin') }}/js/theme-script.js"></script>
	<script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script>
	<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.blockUI/2.70/jquery.blockUI.min.js"></script>
	<script type="text/javascript" src="{{ url('admin') }}/js/toast.js"></script>
	<script type="text/javascript" src="{{ url('admin') }}/js/custom.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <script type="text/javascript" src="{{ url('admin') }}/js/sweetalert.min.js"></script>

	<x-message/>

	<script>
		$( ".toggle-password" ).click( function () {
			$( this ).toggleClass( "fa-eye fa-eye-slash" );
			var input = $( $( this ).attr( "toggle" ) );
			if ( input.attr( "type" ) == "password" ) {
				input.attr( "type", "text" );
			} else {
				input.attr( "type", "password" );
			}
		} );
		$( 'body,html' ).click( function ( e ) {

			// if ($(".sidebar ").hasClass("sidebar-width") ) {
			// alert($("sidebar").length );
			// $(".sidebar").removeClass("sidebar-width");
			// $(".header").removeClass("header-width");
			// }
		} );
	</script>
	@stack('custom-scripts')

</body>
</html>
