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
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<link rel="shortcut icon" href="../images/favicon.png" />
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
		
		
		<style>
		
		.menuheader-width {
  left: 0;
}
		.menumarginleft {
  margin-left: 0;
}
		</style>
	</head>
	<body>
		
		<!-- Google Tag Manager (noscript) -->
<noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-NKD3W5D5"
height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
<!-- End Google Tag Manager (noscript) -->
		
		<div class="container-fluid">
			<a href="#" title="Instruction" class="help" data-bs-toggle="modal" data-bs-target="#myModal"><span class="item">
                <img src="{{ url('admin') }}/images/instruction.png" />
			</span>
            <div class="circle" style="animation-delay: 0s"></div>
            <div class="circle" style="animation-delay: 1s"></div>
            <div class="circle" style="animation-delay: 2s"></div>
            <div class="circle" style="animation-delay: 3s"></div>
			</a>
			<div class="row">
				<div class="col-md-6 loginsidebar">
					<div class="row justify-content-center">
						<div class="col-4 col-lg-2 text-center mb-3">
							<img src="https://khelsathi.in/application/public/admin/images/logo.png" class="img-fluid" />
						</div> 
						<div class="col-md-12 col-12 deptname">
				<h3 class="hd-org">Khel Sathi Portal/खेल साथी पोर्टल</h3>
				<h3>Department of Sports, Government of Uttar Pradesh<br>खेल विभाग, उत्तर प्रदेश सरकार</h3>
			</div>
						<div class="col-md-12 pt-1 deptname">
							<h5 class="text-success">Application for Hostel Admission/छात्रावास में प्रवेश हेतु आवेदन</h5>
						</div>
					</div>
				</div>
				
				
				@yield('hostelcontent')
				
				
				
			</div>

			<div class="modal fade" id="nativealert" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
				<div class="modal-dialog">
					<div class="modal-content">
						<div class="modal-header">
							<h5 class="modal-title" id="exampleModalLabel">Instructions/अनुदेश</h5>
							<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
						</div>
						<div class="modal-body text-center">
							<ul class="list">
								<li>We are sorry! You are ineligible to apply. Only natives of UP are eligible for this application.<br>आप आवेदन करने के लिए अपात्र हैं। केवल उ0प्र0 के मूल निवासी ही इस आवेदन के लिए पात्र हैं।</li>
							</ul>
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
						<li>Copyright © Department of Sports, Government of Uttar Pradesh/खेल विभाग, उत्तर प्रदेश सरकार </li>
					</ul>
				</div>
				<!--<div class="col-md-7">
					<ul class="foot-list">
                    <li><b>Technical Helpline :</b> Mobile:+91-9898989898, Email ID: testdomain@gmail.com</li>
					</ul>
				</div>-->
				<!-- <div class="col-md-4">
				<ul class="foot-list float-end">
						<li>
					Powered by <a href="http://otpl.co.in/" target="_blank">VTPL</a>/<a href="http://otpl.co.in/" target="_blank">VTPL </a>द्वारा संचालित
					</li>
					</ul>
				</div> -->
			</div>
		</footer>
		<div class="modal fade" id="myModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
			<div class="modal-dialog modal-lg">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title" id="exampleModalLabel">Instructions/दिशानिर्देश</h5>
						<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
					</div>
					<div class="modal-body">
						<h5>Step/चरण 1 – Register on the Portal/पोर्टल पर पंजीकरण करें</h5>
						<ul class="list1">
							<li>To register on Khel Sathi Portal, user will have to submit details in respective fields of Registration Panel./खेल साथी पोर्टल पर पंजीकरण करने हेतु उपयोगकर्ता को पंजीकरण पैनल की संबंधित फील्डों में अपेक्षित विवरण दर्ज करना होगा।</li>
<li>Thereafter, entered Mobile No./Email ID will be verified through OTP. Once the verification is done, Login Credentials will be shared on their registered Email ID & Mobile No./तत्पश्चात दर्ज किये गये मोबाइल नंबर/ईमेल आईडी को OTP के माध्यम से सत्यापित किया जाएगा। सत्यापन के पश्चात लॉगिन विवरण उपयोगकर्ता के पंजीकृत ईमेल आईडी व मोबाइल नंबर पर साझा कर दिया जाएगा।
</li>
							<!--li>
								<h3 class="note" style="font-size: 1.4em;"><b>Note -</b> All File Format: PDF | Max File Size: 2 MB</h3>
								<h3 class="note" style="font-size: 1.4em;"><b>नोट - </b> सभी फ़ाइल प्रारूप: पीडीएफ | अधिकतम फ़ाइल आकार: 2 एमबी</h3>
							</li-->
						</ul>
<style>					
.list1{
 
  
}
</style>					
						
<h5>Step/चरण 2 – Login to the Portal/पोर्टल पर लॉग इन करें</h5>						
						
<ul class="list1"><li>After successful registration, user can login through the User ID and Password they have received on their registered Mobile No. & Email ID./सफल पंजीकरण के पश्चात, उपयोगकर्ता अपने पंजीकृत मोबाइल नंबर व ईमेल आईडी पर प्राप्त यूजर आईडी व पासवर्ड के माध्यम से लॉगिन कर सकते हैं।</li>
<li>On first login, user will have to change their auto-generated password, for security reasons./प्रथम बार लॉग इन करने पर, सुरक्षा कारणों से उपयोगकर्ता को अपना स्वतः जनित पासवर्ड बदलना होगा।</li>
</ul>	
						
<div class="alert alert-success" role="alert">				
* Please be attentive while filling the registration details. No changes will be allowed in the submitted details later./ कृपया पंजीकरण विवरण सावधानी पूर्वक भरें। पंजीकरण के पश्चात दर्ज विवरण में किसी भी प्रकार के संशोधन की अनुमति नहीं दी जाएगी।

						
					</div>
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-info" data-bs-dismiss="modal">Close/बंद करें </button>
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
						<button type="button" class="btn btn-info" data-bs-dismiss="modal">Close</button>
					</div>
				</div>
			</div>
		</div>
	
	<script src="{{ url('admin') }}/js/jquery-min.js"></script>
	<script src="{{ url('admin') }}/js/bootstrap.js"></script>
	<script src="{{ url('admin') }}/js/custom.js"></script>
	<script type="text/javascript" src="{{ url('admin') }}/js/toast.js"></script>
	
	<script type="text/javascript" src="{{ url('admin') }}/js/datepicker.js"></script>
	<script type="/text/javascript" src="{{ url('admin') }}js/datepicker.en.js"></script>
	
  
    
    
    
    
    
   
	
	
	<script>


$( function() {
    $( "#datepick" ).datepicker({ minDate: -20, maxDate: "+1M +10D" });
  } );
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
