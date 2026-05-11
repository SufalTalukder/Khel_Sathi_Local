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

	<title>Hostel Admission  - Official Web Portal of Department of Sports, Government of Uttar Pradesh, India</title>

	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
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

	<style>
		
		.menuheader-width {
  left: 0;
}
		.menumarginleft {
  margin-left: 0;
}
		</style>
</head>
<body class="dashbg">
	<!-- Google Tag Manager (noscript) -->
<noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-NKD3W5D5"
height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
<!-- End Google Tag Manager (noscript) -->
		<div class="contentwraper menumarginleft">
			<div class="container pagecontentbody">
				<div class="tab-content">
					<div class="pagebody removebg-color">
		@includeIf('components.hostel_header_dashboard') @yield('hostelDashboard')
			
				
					</div>
				</div>
			</div>
			</div>
			
			
			<script>
			var ajaxUrl = "{{ url('') }}";
		</script>

		<script type="text/javascript" src="{{ url('admin') }}/js/jquery-min.js"></script>
		<script type="text/javascript" src="{{ url('admin') }}/js/bootstrap.js"></script>
		<script type="text/javascript" src="{{ url('admin') }}/js/jquery.nanoscroller.min.js"></script>
		<script type="text/javascript" src="{{ url('admin') }}/js/jquery.dataTables.min.js"></script>
		<script type="text/javascript" src="{{ url('admin') }}/js/dataTables.bootstrap5.min.js"></script>
		<script type="text/javascript" src="{{ url('admin') }}/js/builder.js"></script>
		<script type="text/javascript" src="{{ url('admin') }}/js/beautifyhtml.js"></script>
		<script type="text/javascript" src="{{ url('admin') }}/js/dragble.js"></script>
		<script type="text/javascript" src="{{ url('admin') }}/js/datepicker.js"></script>
		<script type="text/javascript" src="{{ url('admin') }}/js/datepicker.en.js"></script>
		<script type="text/javascript" src="{{ url('admin') }}/js/select2.min.js"></script>
		<script type="text/javascript" src="{{ url('admin') }}/js/theme-script.js"></script>
		<script type="text/javascript" src="{{ url('admin') }}/js/toast.js"></script>
		<script type="text/javascript" src="{{ url('admin') }}/js/custom.js"></script>
		<script type="text/javascript" src="{{ url('admin') }}/js/sweetalert.min.js"></script>

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
		</script>
		<script>
			( function () {
				'use strict'

				// Fetch all the forms we want to apply custom Bootstrap validation styles to
				var forms = document.querySelectorAll( '.needs-validation' )

				// Loop over them and prevent submission
				Array.prototype.slice.call( forms )
					.forEach( function ( form ) {
						form.addEventListener( 'submit', function ( event ) {
							if ( !form.checkValidity() ) {
								event.preventDefault()
								event.stopPropagation()
							}

							form.classList.add( 'was-validated' )
						}, false )
					} )
			} )()
		</script>

<x-message/>

</body>
</html>
