<!doctype html>
<html>
	<head>
		
		<title>Applicant Panel  - Official Web Portal of Department of Sports, Government of Uttar Pradesh, India</title>
		
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<link rel="shortcut icon" href="favicon.png" />
		<link href="{{ url('admin') }}/css/bootstrap.css" rel='stylesheet' />
		<link href="{{ url('admin') }}/css/all.css" rel="stylesheet" />    
		<link href="{{ url('admin') }}/css/dataTables.bootstrap5.min.css" rel='stylesheet' />
		<link href="{{ url('admin') }}/css/custom_theme.css" rel='stylesheet' />
		<link href="{{ url('admin') }}/css/draggle.css" rel="stylesheet">
		<link href="{{ url('admin') }}/css/responsive.css" rel='stylesheet' /> 
		<link href="{{ url('admin') }}/css/datepicker.css" rel="stylesheet" media="all" />   
		<link href="{{ url('admin') }}/css/select2.min.css" rel="stylesheet" media="all" />  
		
		
	</head>
	<body class="dashbg">
		
		
		<div class="contentwraper">
			@includeIf('components.hostel_header_dashboard')
			
			
			
			@yield('hostelDashboard')
			
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
			<script>
				(function () {
					'use strict'
					
					// Fetch all the forms we want to apply custom Bootstrap validation styles to
					var forms = document.querySelectorAll('.needs-validation')
					
					// Loop over them and prevent submission
					Array.prototype.slice.call(forms)
					.forEach(function (form) {
						form.addEventListener('submit', function (event) {
							if (!form.checkValidity()) {
								event.preventDefault()
								event.stopPropagation()
							}
							
							form.classList.add('was-validated')
						}, false)
					})
				})()
			</script>
			
			
			
		</body>
	</html>
