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
	<title>Direct Recruitment  - Official Web Portal of Department of Sports, Government of Uttar Pradesh, India</title>
	<meta charset="utf-8"/>
	<meta http-equiv="X-UA-Compatible" content="IE=edge"/>
	<meta name="viewport" content="width=device-width, initial-scale=1"/>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
	<base href="{{ url('/public') }}">
	<meta name="csrf-token" content="{{ csrf_token() }}"/>
	<link rel="shortcut icon" href="favicon.png"/>
	<link href="{{ asset('admin') }}/css/bootstrap.css" rel='stylesheet'/>
	<link href="{{ asset('admin') }}/css/font.css" rel='stylesheet'/>
	<link href="{{ asset('admin') }}/css/login.css" rel='stylesheet'/>
	<link href="{{ asset('admin') }}/css/all.css" rel="stylesheet"/>
	<link href="{{ asset('admin') }}/css/dataTables.bootstrap5.min.css" rel='stylesheet'/>
	<link href="{{ asset('admin') }}/css/custom_theme.css" rel='stylesheet'/>
	<link href="{{ asset('admin') }}/css/draggle.css" rel="stylesheet">
	<link href="{{ asset('admin') }}/css/responsive.css" rel='stylesheet'/>
	<link href="{{ asset('admin') }}/css/datepicker.css" rel="stylesheet" media="all"/>
	<link href="{{ asset('admin') }}/css/toast.css" rel='stylesheet'/>
	<link href="{{ asset('admin') }}/css/default.css" rel='stylesheet'/>

	<link href="{{ url('admin') }}/css/select2.min.css" rel="stylesheet" media="all"/>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.1/css/bootstrap-select.css"/>
	<style>
		
.menumarginleft {
  margin-left: 0px;
}
		.menuheader-width {
  left: 0px;
}
	</style>

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
					<div class="col-3 col-md-1 b-right">
						<img src="{{ asset('') }}/assets_admin/images/logo.png" alt="" class="dash-logo"/>
					</div>
					<div class="col-9 col-md-11">
						<div class="row modulebg">
							<div class="col">
								<h4 class="moudlename">Khel Sathi Portal / खेल साथी पोर्टल</h4>
							</div>
							<x-drnavbar/>
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








		<div class="modal fade" id="DirectFrm" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title" id="exampleModalLabel">Instructions</h5>
						<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
					</div>
					<div class="modal-body text-center">
						<p>
							<img src="{{'public/images/sent.png'}}" alt="Sent" title="Sent">
						</p>
						<div class="clearfix"></div>
						<!--<h5>Your OTP verification is done successfully. Kindly <b>Proceed to Pay</b> the Registration Fee. After Fee Payment, your Registration on Portal will be completed, and Password will be sent on your registered Mobile No. & Email ID.</h5>-->
						<!-- <h5>Submit successfully</h5> -->
						<h5>Are you sure to do the final submission of the Form? No changes will be allowed, once the final submission is done.<br>क्या आप सुनिश्चित करते हैं कि आपको आवेदन पत्र दर्ज करना है? अंतिम रूप से दर्ज करने के पश्चात आवेदन में किसी भी प्रकार के संशोधन की अनुमति नहीं होगी।</h5>

					</div>
					<div class="modal-footer justify-content-md-center">
						<div class="col-4 d-grid">
							<a class="btn btn-info" href="{{route('drfinalSubmit')}}">Final Submit</a>
						</div>

					</div>
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

	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.bundle.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.1/js/bootstrap-select.min.js"></script>
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
