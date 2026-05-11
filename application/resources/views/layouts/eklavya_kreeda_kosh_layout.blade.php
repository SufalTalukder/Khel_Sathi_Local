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
    <link href="{{ asset('admin') }}/css/bootstrap.css" rel='stylesheet' />
    <link href="{{ asset('admin') }}/css/all.css" rel="stylesheet" />
    <link href="{{ asset('admin') }}/css/datepicker.css" rel="stylesheet" media="all" />
    <link href="{{ asset('eklavya') }}/css/custom_theme.css" rel='stylesheet' />
    <link href="{{ asset('admin') }}/css/responsive.css" rel='stylesheet' />
    <link href="{{ asset('admin') }}/css/login.css" rel='stylesheet' />
    <link href="{{ asset('admin') }}/css/toast.css" rel='stylesheet'/>
  <!--<style>
        .login-form .form-control {
            min-height: 35px;
        }
    </style>-->
</head>
<body>
    <!-- Google Tag Manager (noscript) -->
<noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-NKD3W5D5"
height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
<!-- End Google Tag Manager (noscript) -->
    <div class="container-fluid">
        <a href="#" title="Instruction" class="help" data-bs-toggle="modal" data-bs-target="#myModal">
            <span class="item">
                <img src="{{ asset('player') }}/images/instruction.png" />
            </span>
            <div class="circle" style="animation-delay: 0s"></div>
            <div class="circle" style="animation-delay: 1s"></div>
            <div class="circle" style="animation-delay: 2s"></div>
            <div class="circle" style="animation-delay: 3s"></div>
        </a>
        <div class="row">
            <div class="col-md-6 loginsidebar">
                <div class="row justify-content-md-center">
                    <div class="col-3 col-lg-2 text-center mb-3">
                        <img src="{{ asset('') }}/player/images/logo.png" alt="logo" class="img-fluid" />
                    </div>
                    <div class="col-md-12 col-12 deptname">
                        <h3 class="hd-org text-primary">Khel Sathi Portal/खेल साथी पोर्टल</h3>

                        <h3>Department of Sports, Government of Uttar Pradesh<br>खेल विभाग, उत्तर
                            प्रदेश सरकार</h3>
                    </div>
                    <div class="col-md-12 col-12 deptname">
                        <h1 class="text-danger">Eklavya Krida Kosh/एकलव्य क्रीड़ा कोष</h1>

                    </div>
                </div>
            </div>

            @yield('content')
        </div>
    </div>
    <footer>
        <div class="row">
            <div class="col-md-10">
                <ul class="foot-list">
                    <li>Copyright © Department of Sports, Government of Uttar Pradesh/खेल विभाग, उत्तर प्रदेश सरकार</li>
                </ul>
            </div>
            <!--<div class="col-md-7">
                <ul class="foot-list">
                    <li><b>Technical Helpline :</b> Mobile:+91-9898989898, Email ID: testdomain@gmail.com</li>
                </ul>
            </div>-->
            <!-- <div class="col-md-2">
                <ul class="foot-list">
                    <li>Powered by <a href="http://otpl.co.in/" target="_blank">VTPL</a></li>
                </ul>
            </div> -->
            <div class="modal fade" id="nativealert" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
				<div class="modal-dialog">
					<div class="modal-content text-dark">
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



    </footer>
    <div class="modal fade" id="myModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content" >
                <div class="modal-header text-center" style="display: block;">
                    <b>Instructions/अनुदेश</b>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                <div class="row">
                <div class="col-md-6">
                    <ul class="list">

                        <li>Step 1: Get yourself registered by furnishing basic details, and OTP based verification.</li>
                        <li>Step 2: Login to the Portal with the received Login Credentials.</li>
                        <li>Step 3: Submit the Application Form.</li>
                        <li>Step 4: Wait for the response of UP Sports Department. </li>
                    </ul>
                </div>


                    <div class="col-md-6 border-left ">
                    <ul class="list">

<li>चरण 1: बुनियादी विवरण और ओटीपी आधारित सत्यापन प्रदान करके स्वयं को पंजीकृत करें।</li>
<li>चरण 2: प्राप्त लॉगिन क्रेडेंशियल के साथ पोर्टल पर लॉगिन करें।</li>
<li>चरण 3: आवेदन पत्र जमा करें।</li>
<li>चरण 4: यूपी खेल विभाग की प्रतिक्रिया की प्रतीक्षा करें।</li>
                    </ul>
                </div>


                </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>


</body>

<script>
    var ajaxUrl = "{{ url('') }}";

 </script>
 <script src="{{ asset('') }}/assets_admin/js/jquery-min.js"></script>
 <script src="{{ asset('') }}/assets_admin/js/bootstrap.js"></script>
 <script src="{{ asset('') }}/assets_admin/js/datepicker.js"></script>
 <script src="{{ asset('') }}/assets_admin/js/datepicker.en.js"></script>
 <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.blockUI/2.70/jquery.blockUI.min.js"></script>
 <script type="text/javascript" src="{{ asset('') }}/assets_admin/js/toast.js"></script>
 <script src="{{ asset('') }}/assets_admin/js/custom.js"></script>
 <x-message/>

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

    });
</script>
@stack('custom-scripts')

</body>

</html>
