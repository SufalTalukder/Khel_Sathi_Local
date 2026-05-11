<!DOCTYPE html>
<html>
	
	
	<head>
		    <!-- Google Tag Manager -->
			<script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
    new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
    j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
    'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
    })(window,document,'script','dataLayer','GTM-NKD3W5D5');</script>
    <!-- End Google Tag Manager -->
		
		<title>Department - Official Web Portal of Department of Sports, Government of Uttar Pradesh, India</title>
		
		<meta charset="utf-8" />
		<meta http-equiv="X-UA-Compatible" content="IE=edge" />
		<meta name="viewport" content="width=device-width, initial-scale=1" />
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<link rel="shortcut icon" href="favicon.png" />
		<meta name="csrf-token" content="{{ csrf_token() }}" />
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
 
		<link href="{{ url('admin') }}/css/select2.min.css" rel="stylesheet" media="all" />  
		<link href="{{ url('admin') }}/css/all.min.css" rel="stylesheet" />
	</head>
	
	<body class="dashbg">
		<!-- Google Tag Manager (noscript) -->
<noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-NKD3W5D5"
height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
<!-- End Google Tag Manager (noscript) -->
		<div class="contentwraper">
			
			<x-departmennav />
			
			<div class="container-fluid pagecontentbody">
				<div class="tab-content">
					@yield('content')
				</div>
			</div>
			
			<footer>
				<div class="row">
					<div class="col-md-8">
				<ul class="foot-list">
							<li>Copyright &copy; Uttar Pradesh New and Renewable Energy Developmet Agency</li>
						</ul>
					</div>
					<!-- <div class="col-md-4">
				<ul class="foot-list float-end">
							<li>Powered by <a href="http://otpl.co.in/" target="_blank">VTPL</a>
							</li>
						</ul>
					</div> -->
				</div>
			</footer>
		</div>
		
		
		<x-modal />
		
		
		<script>
			var ajaxUrl = "{{ url('') }}";
		</script>
		<script type="text/javascript" src="{{ url('admin') }}/js/jquery-min.js"></script>
		<script type="text/javascript" src="{{ url('admin') }}/js/bootstrap.js"></script>
		<script type="text/javascript" src="{{ url('admin') }}/js/jquery.nanoscroller.min.js"></script>
		<script type="text/javascript" src="{{ url('admin') }}/js/jquery.dataTables.min.js"></script>
		<script type="text/javascript" src="{{ url('admin') }}/js/dataTables.bootstrap5.min.js"></script>
		<script type="text/javascript" src="{{ url('admin') }}/js/datepicker.js"></script>
		<script type="text/javascript" src="{{ url('admin') }}/js/datepicker.en.js"></script>
		<script type="text/javascript" src="{{ url('admin') }}/js/builder.js"></script>
		<script type="text/javascript" src="{{ url('admin') }}/js/beautifyhtml.js"></script>
		<script type="text/javascript" src="{{ url('admin') }}/js/dragble.js"></script>
		<script type="text/javascript" src="{{ url('admin') }}/js/theme-script.js"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.blockUI/2.70/jquery.blockUI.min.js"></script>
		<script type="text/javascript" src="{{ url('admin') }}/js/toast.js"></script>
		<script type="text/javascript" src="{{ url('admin') }}/js/custom.js"></script>
		<script type="text/javascript" src="{{ url('admin') }}/js/sweetalert.min.js"></script>
		
		<x-message />
		<script>
			$('#aprvbtn').click(function() {
				swal({
					title: "Successful!",
					text: "Request is Approved Successfully",
					icon: "success",
					button: "OK",
				});
			});
			$('#cnfreject').click(function() {
				swal("Are you sure you want to do this?", {
					buttons: ["No", true],
				});
			});
		</script>
		@stack('custom-scripts')
		
	</body>
	
	
</html>
