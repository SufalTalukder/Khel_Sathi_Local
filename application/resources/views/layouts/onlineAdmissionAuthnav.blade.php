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
      <title>Online Admission - Official Web Portal of Department of Sports, Government of Uttar Pradesh, India</title>
      <meta charset="utf-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
      <meta name="csrf-token" content="{{ csrf_token() }}"/>
      <link rel="shortcut icon" href="../images/favicon.png"/>
      <?php $urls = url('/public'); ?>
      <link href="{{ asset('onlineAdmission') }}/css/bootstrap.css" rel='stylesheet'/>
      <link href="{{ asset('admin') }}/css/font.css" rel='stylesheet'/>
      <link href="{{ asset('admin') }}/css/login.css" rel='stylesheet'/>
      <link href="{{ asset('onlineAdmission') }}/css/all.css" rel="stylesheet"/>
      <link href="{{ asset('onlineAdmission') }}/css/dataTables.bootstrap5.min.css" rel='stylesheet'/>
      <link href="{{ asset('onlineAdmission') }}/css/custom_theme.css" rel='stylesheet'/>
      <link href="{{ asset('onlineAdmission') }}/css/draggle.css" rel="stylesheet">
      <link href="{{ asset('onlineAdmission') }}/css/responsive.css" rel="stylesheet" media="all"/>
      <link href="{{ asset('admin') }}/css/datepicker.css" rel="stylesheet" media="all"/>
      <link href="{{ asset('admin') }}/css/toast.css" rel='stylesheet'/>
      <link href="{{ asset('admin') }}/css/default.css" rel='stylesheet'/>
      <link href="{{ url('onlineAdmission') }}/css/select2.min.css" rel="stylesheet" media="all"/>
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/css/intlTelInput.css"/>
      <script src="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/js/intlTelInput.min.js"></script>
   </head>
   <body>
      <!-- Google Tag Manager (noscript) -->
<noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-NKD3W5D5"
height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
<!-- End Google Tag Manager (noscript) -->
      <div class="container-fluid">
         <a href="#" title="Instruction" class="help" data-bs-toggle="modal" data-bs-target="#myModal">
            <span class="item">
            <img src="{{ asset('') }}/onlineAdmission/images/instruction.png" />
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
            <div class="col-md-5">
               <ul class="foot-list">
                  <li>Copyright &copy; Department of Sports, Government of Uttar Pradesh / खेल विभाग, उत्तर प्रदेश सरकार</li>
               </ul>
            </div>
            <div class="col-md-4">
               <ul class="foot-list">
                  <li>For admission related queries, Please Call: +91-9230992739</li>
                  {{-- <li><b>Technical Helpline :</b> Mobile:+91-9898989898, Email ID: testdomain@gmail.com</li> --}}
               </ul>
               </div>
            <div class="col-md-3">
               <ul class="foot-list float-end">
                  <li>Powered by <a href="https://www.vareli.co.in/" target="_blank">VTPL</a>
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
                  <p><strong>Step/</strong><strong>चरण</strong><strong> 1 – Register on the Portal/</strong><strong>पोर्टल पर पंजीकरण करें</strong><strong> </strong></p>
                  <ul class="list">
                     <li>To register on Khel Sathi Portal, user  will have to submit details in respective fields of Registration Panel./खेल साथी पोर्टल पर पंजीकरण करने हेतु  उपयोगकर्ता को पंजीकरण पैनल की संबंधित फील्डों में अपेक्षित  विवरण दर्ज करना होगा। </li>
                     <li>Thereafter, entered Mobile No./Email  ID will be verified through OTP. Once the verification is done, Login  Credentials will be shared on their registered Email ID &amp; Mobile No./तत्पश्चात  दर्ज किये गये मोबाइल नंबर/ईमेल आईडी को <strong>OTP</strong> के माध्यम से सत्यापित किया जाएगा। सत्यापन के पश्चात  लॉगिन विवरण उपयोगकर्ता के पंजीकृत ईमेल आईडी व मोबाइल नंबर  पर साझा कर दिया जाएगा।</li>
                  </ul>
                  <p><strong>Step/</strong><strong>चरण</strong><strong> </strong><strong>2 – Login  to the Portal/</strong><strong>पोर्टल  पर लॉग इन करें</strong><strong> </strong></p>
                  <ul class="list">
                     <li>After successful registration, user can  login through the User ID and Password they have received on their registered  Mobile No. &amp; Email ID./सफल पंजीकरण के पश्चात, उपयोगकर्ता अपने पंजीकृत मोबाइल नंबर व ईमेल आईडी पर  प्राप्त यूजर आईडी व पासवर्ड के माध्यम से लॉगिन कर सकते हैं। </li>
                     <li>On first login, user will have to  change their auto-generated password, for security reasons./प्रथम बार लॉग इन करने पर,  सुरक्षा कारणों से उपयोगकर्ता को अपना स्वतः जनित पासवर्ड  बदलना होगा। </li>
                  </ul>
                  <p><em>* Please  be attentive while filling the registration details. No changes will be allowed  in the submitted details later./</em><em>कृपया पंजीकरण विवरण सावधानी पूर्वक भरें। पंजीकरण के पश्चात दर्ज विवरण में  किसी भी प्रकार के संशोधन की अनुमति नहीं दी जाएगी।</em></p>
               </div>
               <div class="modal-footer">
                  <a href="{{ asset('public/instruction/Khel-Sathi-Admission-Instructions-Eng.pdf') }}" class="btn btn-primary" target="_blank" >Download Instruction in English</a>
                  <a href="{{ asset('public/instruction/Khel-Sathi-Admission-Instructions-Hindi.pdf') }}" class="btn btn-primary" target="_blank" >हिन्दी में दिशानिर्देश डाउनलोड करें</a>
               </div>
            </div>
         </div>
      </div>
      <div class="modal fade" id="forgotpasswordd" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
         <div class="modal-dialog">
            <div class="modal-content">
               <div class="modal-header">
               </div>
               <div class="modal-body text-center">
                  <div class="clearfix"></div>
                  <!--<h5>Your OTP verification is done successfully. Kindly <b>Proceed to Pay</b> the Registration Fee. After Fee Payment, your Registration on Portal will be completed, and Password will be sent on your registered Mobile No. & Email ID.</h5>-->
                  <h5>
                  •	Are you sure to do the final submission of the Application? No changes will be allowed in the Application once its final submission is done./क्या आप आवेदन को अंतिम रूप से दर्ज करना सुनिश्चित करते हैं? आवेदन को अंतिम रूप से दर्ज करने के पश्चात इसमें किसी प्रकार के संशोधन की अनुमति नहीं होगी। <br>
                  <br>
                  •	After final submission, form should become non-editable. Also, message should be Final Submission of Application is completed. Kindly pay the Application Fee./आवेदन को अंतिम रूप से दर्ज कर दिया गया है। कृपया आवेदन शुल्क का भुगतान करें।
               </div>
               <div class="modal-footer justify-content-md-center">
                  <div class="col-4 d-flex gap-3">
                     <button type="button" class="btn btn-danger" data-bs-dismiss="modal" >No</button>
                     <a class="btn btn-info" id="final_submit" href="Javascript:void(0)">Yes</a>
                  </div>
               </div>
            </div>
         </div>
      </div>

      <div class="modal hide fade" id="myModal">
        <div class="modal-header">
            <a class="close" data-bs-dismiss="modal">×</a>
            <h3>Modal header</h3>
        </div>
        <div class="modal-body">
            <p>One fine body…</p>
        </div>
        <div class="modal-footer">
            <a href="#" class="btn">Close</a>
            <a href="#" class="btn btn-primary">Save changes</a>
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





   </script>
   <script>
      jQuery( document ).ready( function ( $ ) {
      	$( "#basicExampleModal" ).modal( 'show' );
      
      	//$('#newsTicker1').breakingNews();
      } );
   </script>
   <script>
      jQuery( document ).ready( function ( $ ) {
      	$( "#basicExampleModal" ).modal( 'show' );
      	//$('#newsTicker1').breakingNews();
      } );
   </script>
	    
		  <script type="text/javascript">
    $(window).on('load', function() {
        $('#Admission').modal('show');
    });
</script>
@stack('custom-scripts')
</html>
