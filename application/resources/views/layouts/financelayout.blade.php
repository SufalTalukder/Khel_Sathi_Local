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
	<title>Finance Assistance - Official Web Portal of Department of Sports, Government of Uttar Pradesh, India</title>
	<meta charset="utf-8" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge" />
	<meta name="viewport" content="width=device-width, initial-scale=1" />
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<base href="{{ url('/public') }}">
	<meta name="csrf-token" content="{{ csrf_token() }}" />
	<link rel="shortcut icon" href="favicon.png" />
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
	<style>
		.menumarginleft {
			margin-left: 0;
		}
		.menuheader-width {
			left: 0;
		}
	</style>
	<link href="{{ url('admin') }}/css/select2.min.css" rel="stylesheet" media="all" />
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
					<div class="col-md-1 b-right">
						<img src="{{ asset('') }}/assets_admin/images/logo.png" alt="" class="dash-logo dash-resp" />
					</div>
					<div class="col-md-11">
						<div class="row modulebg">
							<div class="col">
								<h4 class="moudlename">Khel Sathi Portal / खेल साथी पोर्टल</h4>
							</div>
							<x-financenavbar />
						</div>
					</div>
				</div>
			</div>
		</header>

		<div class="container pagecontentbody">
			@yield('content')
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
	@stack('custom-scripts')

</body>

</html>
