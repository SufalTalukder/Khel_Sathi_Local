<!DOCTYPE html>
<html>
	
	
	<head>
		
		<title>Admin - Official Web Portal of Department of Sports, Government of Uttar Pradesh, India</title>
		
		<meta charset="utf-8" />
		<meta http-equiv="X-UA-Compatible" content="IE=edge" />
		<meta name="viewport" content="width=device-width, initial-scale=1" />
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<base href="{{ url('/public') }}">
		<meta name="csrf-token" content="{{ csrf_token() }}" />
		<link rel="shortcut icon" href="favicon.png" />
		<link rel="shortcut icon" href="favicon.png" />
		<link href="{{ url('admin') }}/css/bootstrap.css" rel='stylesheet' />
		<link href="{{ url('admin') }}/css/all.css" rel="stylesheet" />    
		<link href="{{ url('admin') }}/css/dataTables.bootstrap5.min.css" rel='stylesheet' />
		<link href="{{ url('admin') }}/css/custom_theme.css" rel='stylesheet' />
		<link href="{{ url('admin') }}/css/draggle.css" rel="stylesheet">
		<link href="{{ url('admin') }}/css/responsive.css" rel='stylesheet' /> 
		<link href="{{ url('admin') }}/css/datepicker.css" rel="stylesheet" media="all" />   
		<link href="{{ url('admin') }}/css/select2.min.css" rel="stylesheet" media="all" />  
		<link href="{{ asset('') }}/assets_admin/css/toast.css" rel='stylesheet' />
	</head>
	
	
	
	
	<body class="dashbg">
		<div class="contentwraper">
			
			<x-adminnav />
			
			<div class="container-fluid pagecontentbody">
				<div class="tab-content">
					@yield('content')
				</div>
			</div>
			
			<footer>
				<div class="row">
					<div class="col-md-10">
						<ul class="foot-list">
							<li>Copyright &copy Department of Sports</li>
						</ul>
					</div>
					<div class="col-md-2">
						<ul class="foot-list">
							<li>Powered by <a href="http://otpl.co.in/" target="_blank">VTPL</a>
							</li>
						</ul>
					</div>
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
		<script type="text/javascript" src="{{ url('admin') }}/js/builder.js"></script>
		<script type="text/javascript" src="{{ url('admin') }}/js/beautifyhtml.js"></script>
		<script type="text/javascript" src="{{ url('admin') }}/js/dragble.js"></script>    
		<script type="text/javascript" src="{{ url('admin') }}/js/datepicker.js"></script>
		<script type="text/javascript" src="{{ url('admin') }}/js/datepicker.en.js"></script> 
		<script type="text/javascript" src="{{ url('admin') }}/js/select2.min.js"></script> 
		<script type="text/javascript" src="{{ url('admin') }}/js/theme-script.js"></script>
		
		<script src="{{ url('admin') }}/js/canvasjs.min.js"></script>
		<script type="text/javascript" src="{{ asset('') }}/js/toast.js"></script> <script type="text/javascript" src="{{ asset('') }}/js/toast.js"></script>
		
		
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
