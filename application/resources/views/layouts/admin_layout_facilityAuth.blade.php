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
	<title>Applicant Panel</title>
	<meta charset="utf-8" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge" />
	<meta name="viewport" content="width=device-width, initial-scale=1" />
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<base href="{{ url('/public') }}">
	<meta name="csrf-token" content="{{ csrf_token() }}" />
    <link href="{{ asset('admin') }}/css/bootstrap.css" rel="stylesheet" />
    <link href="{{ asset('admin') }}/css/all.css" rel="stylesheet" />
    <link href="{{ asset('admin') }}/css/datepicker.css" rel="stylesheet" media="all" />
    <link href="{{ asset('admin') }}/css/custom_theme.css" rel="stylesheet" />
    <link href="{{ asset('admin') }}/css/responsive.css" rel="stylesheet" />
    <link href="{{ asset('admin') }}/css/default.css" rel="stylesheet" />
    <link href="{{ asset('admin') }}/css/login.css" rel="stylesheet" />
    <link href="{{ asset('admin') }}/css/toast.css" rel='stylesheet'/>
    <style>
.contentwraper {
   
   padding-top: 104px;
}
</style>
</head>

<body>
    <!-- Google Tag Manager (noscript) -->
<noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-NKD3W5D5"
height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
<!-- End Google Tag Manager (noscript) -->
    <div class="container-fluid">
        <a href="#" title="Instruction" class="help">
            <span class="item">
                <img src="{{ asset('admin') }}/images/instruction.png" />
            </span>
            <div class="circle" style="animation-delay: 0s"></div>
            <div class="circle" style="animation-delay: 1s"></div>
            <div class="circle" style="animation-delay: 2s"></div>
            <div class="circle" style="animation-delay: 3s"></div>
        </a>
        <div class="row">
            <div class="col-md-6 loginsidebar">
                <div class="row justify-content-center">
                    <div class="col-4 col-lg-3 text-center mb-3"> <img src="{{ asset('admin') }}/images/logo.png" class="img-fluid"> </div>
                    <div class="col-md-12 col-12 deptname">
                        <h3 class="hd-org">Khel Sathi Portal/खेल साथी पोर्टल</h3>
                        <h5>Department of Sports, Government of Uttar Pradesh<br>
                            खेल विभाग, उत्तर प्रदेश सरकार</h5>
                    </div>
                    <div class="col-md-12 col-12 deptname">
                        <h2 class="text-danger">Facility Booking/सुविधा बुकिंग</h2>
                    </div>
                </div>
            </div>
    @yield('facilitycontent')

    <footer>
        <div class="row">
            <div class="col-md-8">
                <ul class="foot-list">
                    <li>Copyright © Department of Sports, Government of Uttar Pradesh / खेल विभाग, उत्तर प्रदेश सरकार</li>
                </ul>
            </div>
            <!--<div class="col-md-7">
                <ul class="foot-list">
                    <li><b>Technical Helpline :</b> Mobile:+91-9898989898, Email ID: testdomain@gmail.com</li>
                </ul>
            </div>-->
            <!-- <div class="col-md-4">
                <ul class="foot-list float-end">
                    <li>Powered by <a href="http://otpl.co.in/" target="_blank">VTPL</a>
                    </li>
                </ul>
            </div> -->
        </div>
    </footer>
   
    </div>
    </div>
    <script src="{{ asset('admin') }}/js/jquery-min.js"></script>
    <script src="{{ asset('admin') }}/js/bootstrap.js"></script>
    <script>
			var ajaxUrl = "{{ url('') }}";
		</script>
   

</body>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.blockUI/2.70/jquery.blockUI.min.js"></script>

<script type="text/javascript" src="{{ asset('admin') }}/js/datepicker.js"></script>
<script type="text/javascript" src="{{ asset('admin') }}/js/datepicker.en.js"></script>
<script type="text/javascript" src="{{ url('admin') }}/js/toast.js"></script>
	<script type="text/javascript" src="{{ url('admin') }}/js/custom.js"></script>
	<script type="text/javascript" src="{{ url('admin') }}/js/sweetalert.min.js"></script>

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
//calculate age
$(function() {
   // $('#mini_pool').hide(); 
      $('#facility_datepick').change(function()
        {
            console.log('1424121');
            //console.log("change");
            var facility_datepick = new Date(document.getElementById('facility_datepick').value);
            var today = new Date();
            var age = Math.floor((today-facility_datepick)/(365.25*24*60*60*1000));
            document.getElementById('facility_age').value = age;
            document.getElementById('total_age').value = age;
        });		
    });
</script>

 <x-message/>
 @stack('custom-scripts')
</body>
</html>
