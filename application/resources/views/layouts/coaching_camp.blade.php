<!doctype html>
<html>
<!-- InstanceBegin template="/Templates/login.dwt" codeOutsideHTMLIsLocked="false" -->
<head>
<!-- InstanceBeginEditable name="doctitle" -->
<title>Official Web Portal of Department of Sports, Government of Uttar Pradesh, India</title>
<!-- InstanceEndEditable -->
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="shortcut icon" href="images/logo.png" />
<link href="{{ asset('admin') }}/css/all.css" rel="stylesheet" />
<link href="{{ asset('public/coaching_camp/css/bootstrap.css') }}" rel="stylesheet" />
<link href="{{ asset('public/coaching_camp/css/all.css') }}" rel="stylesheet" />
<link href="{{ asset('public/coaching_camp/css/custom_theme.css') }}" rel="stylesheet" />
<link href="{{ asset('public/coaching_camp/css/responsive.css') }}" rel="stylesheet" />
<link href="{{ asset('public/coaching_camp/css/font.css') }}" rel="stylesheet" media="all" />
<!-- InstanceBeginEditable name="head" -->
<link href="{{ asset('admin') }}/css/toast.css" rel='stylesheet'/>
<!-- InstanceEndEditable -->
</head>

<body>
<div class="container-fluid"> <a href="#" title="Instruction" class="help" data-bs-toggle="modal" data-bs-target="#myModal"> <span class="item"> <img src="{{ asset('public/coaching_camp/images/instruction.png') }}" /> </span>
  <div class="circle" style="animation-delay: 0s"></div>
  <div class="circle" style="animation-delay: 1s"></div>
  <div class="circle" style="animation-delay: 2s"></div>
  <div class="circle" style="animation-delay: 3s"></div>
  </a>
  <div class="row">
    <div class="col-md-6 loginsidebar">
      <div class="row justify-content-md-center">
        <div class="col-3 col-lg-2 text-center mb-3"> <img src="{{ asset('public/coaching_camp/images/logo.png') }}" class="img-fluid logo1" /> </div>
        <div class="col-md-12 col-12 deptname">
          <h3 class="hd-org text-primary">Khel Sathi Portal/खेल साथी पोर्टल</h3>
          <h3>
            Department of Sports, Government of Uttar Pradesh<br>
            खेल विभाग, उत्तर प्रदेश सरकार
          </h3>
        </div>
        <div class="col-md-12 col-12 deptname">
          <h4 class="text-danger">Application form for Sports Training / खेल प्रशिक्षण हेतु आवेदन-पत्र</h4>
        </div>
      </div>
    </div>
    <div class="col-md-6 bg-light1"> <!-- InstanceBeginEditable name="Content Area" -->




      @yield('content')
      <!-- InstanceEndEditable --> </div>
  </div>
</div>
<footer>
  <div class="row">
    <div class="col-md-10">
      <ul class="foot-list">
        <li>Copyright © Department of Sports, Government of Uttar Pradesh / खेल विभाग, उत्तर प्रदेश सरकार</li>
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
  </div>
</footer>
<div class="modal fade" id="myModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content" >
      <div class="modal-header text-center" style="display: block;"> <b>Instructions/अनुदेश</b>
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
<div class="modal fade" id="verify" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-body text-center">
        <p> <img src="images/sent.png" alt="Sent" title="Sent"> </p>
        <div class="clearfix"></div>
        <h5>Password Recovery Link has been sent on your registered Email ID./पासवर्ड रिकवरी लिंक आपके पंजीकृत ईमेल आईडी पर भेज दिया गया है।</h5>
      </div>
      <div class="modal-footer justify-content-md-center">
        <div class="col-3 d-grid"> <a class="btn btn-danger rounded-pill" href="index.html">Ok</a> </div>
      </div>
    </div>
  </div>
</div>
<script src="{{ asset('public/coaching_camp/js/jquery-min.js') }}"></script>
<script src="{{ asset('public/coaching_camp/js/bootstrap.js') }}"></script>

<script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.blockUI/2.70/jquery.blockUI.min.js"></script>
<script type="text/javascript" src="{{ url('admin') }}/js/toast.js"></script>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script type="text/javascript" src="{{ url('admin') }}/js/sweetalert.min.js"></script>
<script type="text/javascript" src="{{ url('admin') }}/js/custom.js"></script>
 <x-message/>
<script>

var ajaxUrl = "{{ url('') }}";
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
    @stack('custom-scripts')
<!-- InstanceBeginEditable name="for-javascript" --> <!-- InstanceEndEditable -->
</body>
<!-- InstanceEnd -->
</html>
