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
	<title>Official Web Portal of Department of Sports, Government of Uttar Pradesh, India</title></title>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
	<meta name="csrf-token" content="{{ csrf_token() }}"/>
	<link rel="shortcut icon" href="../images/favicon.png"/>
	<?php if (url('/') == 'http://127.0.0.1:8000') {
        $urls = url('/');
    } else {
        $urls = url('/public');
    } ?>
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
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/css/intlTelInput.css"/>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/js/intlTelInput.min.js"></script>
</head>

<body>
	<!-- Google Tag Manager (noscript) -->
<noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-NKD3W5D5"
height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
<!-- End Google Tag Manager (noscript) -->
	<div class="container-fluid">
		<a href="#" title="Instructions" class="help" data-bs-toggle="modal" data-bs-target="#myModal"><span class="item">
                <img src="{{ asset('assets_admin/images/instruction.png') }}" />
            </span>
            <div class="circle" style="animation-delay: 0s"></div>
            <div class="circle" style="animation-delay: 1s"></div>
            <div class="circle" style="animation-delay: 2s"></div>
            <div class="circle" style="animation-delay: 3s"></div>
        </a>
		@yield('content')

		<div class="modal fade" id="nativealert" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title" id="exampleModalLabel">Instructions</h5>
						<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
					</div>
					<div class="modal-body text-center">
						<div class="clearfix"></div>
						<h5>You are ineligible to apply. Only natives of UP are eligible for this application./आप आवेदन करने के लिए अपात्र हैं। केवल उ0प्र0 के मूल निवासी ही इस आवेदन के लिए पात्र हैं।</h5>

					</div>
					<div class="modal-footer justify-content-md-center">
						<div class="col-4 d-grid">
							<button type="button" data-bs-dismiss="modal" aria-label="OK">OK</button>
						</div>

					</div>
				</div>
			</div>
		</div>
	</div>
	<footer>
		<div class="row">
			<div class="col-md-8">
				<ul class="foot-list">
					<li>Copyright &copy; Department of Sport, Government of Uttar Pradesh</li>
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
	<div class="modal fade" id="myModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="exampleModalLabel">Instructions</h5>
					<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
				</div>
				<div class="modal-body">
					<ul class="list">
						<!--<li>Step 1: Enter your Company ID, User ID & Password. </li>
                        <li>Step 2: Set up your Security Questions. </li>
                        <li>Step 3: One Time Passcode Setup. </li>
                        <li>Step 4: User Password Change. </li>-->
						<li>
							<a href="{{ asset('') }}/instruction.pdf" target="blank">
                            <h3 class="note" style="font-size: 1.4em;"><b>Yet be uploaded soon...</b></h3>
                                <!-- <h3 class="note" style="font-size: 1.4em;"><b>Guidelines to Raise Request for Establishment of Solar Energy Project in UP through UPNEDA Solar Energy Portal</b></h3> -->
                            </a>
						
						</li>
					</ul>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-primary" data-bs-dismiss="modal">Close</button>
				</div>
			</div>
		</div>
	</div>

	<div class="modal fade" id="concept-note" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
		<div class="modal-dialog modal-lg">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="exampleModalLabel">Concept Note</h5>
					<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
				</div>
				<div class="modal-body">
					<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur quis viverra turpis. Cras quis eros eget odio varius fermentum quis condimentum ex. Etiam cursus sollicitudin sem, et consectetur mi euismod a. Suspendisse at dui interdum, tristique lacus quis, tristique sem. Donec in dui sed orci luctus dictum nec venenatis massa. Morbi non massa eget dolor convallis feugiat. Maecenas ac cursus odio. Curabitur in congue lectus. Suspendisse sed magna rhoncus, porta risus nec, tempus ante. Donec fringilla vehicula nisi a aliquam. Cras blandit varius risus malesuada porta. Vivamus non interdum metus.</p>

					<p>Integer rutrum leo et augue imperdiet, a fermentum justo ultricies. Quisque rutrum ipsum a ligula pretium, vitae laoreet ipsum consequat. Nulla vel gravida urna, sed euismod nibh. Suspendisse mauris ipsum, feugiat sed arcu vitae, auctor rhoncus nulla. Donec ac auctor sem. Integer a dignissim quam. Maecenas id tempor lorem, eget suscipit eros. Nulla et maximus tortor. Phasellus congue augue in aliquam tincidunt. Maecenas vehicula lacus leo, non feugiat ipsum iaculis sit amet. Etiam interdum dignissim aliquet. Nulla quis ante cursus, elementum odio eu, ultricies arcu.</p>
				</div>
				<div class="modal-footer">
					<!--<button type="button" class="btn btn btn-outline-danger"><span class="icons icon-cloud-download"></span> Download</button>-->
					<button type="button" class="btn btn-primary" data-bs-dismiss="modal">Close</button>
				</div>
			</div>
		</div>
	</div>

<script>
	var ajaxUrl = "{{ url('') }}";
</script>
<script src="{{ asset('') }}/assets_admin/js/jquery-min.js"></script>
<script src="{{ asset('') }}/assets_admin/js/bootstrap.js"></script>
<script src="{{ asset('') }}/assets_admin/js/datepicker.js"></script>
<script src="{{ asset('') }}/assets_admin/js/datepicker.en.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.blockUI/2.70/jquery.blockUI.min.js"></script>
<script type="text/javascript" src="{{ asset('') }}/js/toast.js"></script>
<script src="{{ asset('') }}/js/custom.js"></script>

<x-message/>
<script>
	function investorType( type ) {
		if ( type == 2 ) {
			$( ".investorType" ).hide();
			$( ".attrs" ).removeAttr( "required" );
			$( "#repl_3_2" ).html( 2 );
			$( "#repl_5_4" ).html( 3 );
			$( "#repl_6_5" ).html( 4 );
			$( "#repl_7_6" ).html( 5 );

		} else {
			$( ".investorType" ).show();
			$( ".attrs" ).attr( "required", "required" );
			$( "#repl_3_2" ).html( 3 );
			$( "#repl_5_4" ).html( 5 );
			$( "#repl_6_5" ).html( 6 );
			$( "#repl_7_6" ).html( 7 );
		}
	}
	$( ".attrs" ).attr( "required", "required" );

	$( ".toggle-password" ).click( function () {
		$( this ).toggleClass( "fa-eye fa-eye-slash" );
		var input = $( $( this ).attr( "toggle" ) );
		if ( input.attr( "type" ) == "password" ) {
			input.attr( "type", "text" );
		} else {
			input.attr( "type", "password" );
		}
	} );

	var timeleft = 20;
	var downloadTimer = setInterval( function () {
		if ( timeleft <= 0 ) {
			clearInterval( downloadTimer );
			document.getElementById( "countdown" ).innerHTML = "Finished";

		} else {
			$( ".fw-bold" ).prop( 'disabled', true );
			document.getElementById( "countdown" ).innerHTML = timeleft + "";
		}
		timeleft -= 1;
	}, 1000 );

	// A $( document ).ready() block.
	$( document ).ready( function () {
		const phoneInputField = document.querySelector( "#mobile" );
		const phoneInput = window.intlTelInput( phoneInputField, {
			initialCountry: "in",
			utilsScript: "https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/js/utils.js",
		} );
		// setTimeout(() => {
		//     $("#mobile").attr("placeholder", "Enter Mobile No");
		// }, 50);
	} );
</script>
</body>
</html>
