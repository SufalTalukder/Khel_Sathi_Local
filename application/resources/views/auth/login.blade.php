@extends( 'layouts/web' )
@section( 'content' )

<div class="row">
	<div class="col-md-6 loginsidebar">
		<div class="row justify-content-md-center">
			<div class="col-12 col-md-4 col-lg-2 text-center mb-3">
				<img src="{{ asset('assets_admin/images/logo.png') }}" class="img-fluid mobile-resp" />
			</div>
			<div class="col-md-12 col-12 deptname">
				<h3 class="hd-org">Khel Sathi Portal/खेल साथी पोर्टल</h3>
			</div>
			<div class="col-md-12 pt-1 deptname">
				<h3 class="text-success">Department of Sports, Government of Uttar Pradesh<br>
					खेल विभाग, उत्तर प्रदेश सरकार
				</h3>
				<h5 class="text-success">
					Nomination Form to Seek Reward from Government of UP<br>उ0प्र0 सरकार से पुरस्कार प्राप्त करने हेतु नामांकन प्रपत्र
				</h5>
			</div>
		</div>
	</div>
	<div class="col-md-6">
		<div class="p-3 p-lg-4 login-form">
			<div class="text-center text-md-center mb-2 mt-md-0">
				<h3 class="mb-0">Applicant's Login/आवेदक का लॉगिन</h3>
				<div class="d-flex justify-content-center align-items-center mt-2"><span class="fw-normal">Don't have an account?
						<a href="{{ route('signUp') }}" class="fw-bold">Register Here</a></span>
				</div>
				<div class="d-flex justify-content-center align-items-center mt-2"><span class="fw-normal">अकाउंट नहीं है?
						<a href="{{ route('signUp') }}" class="fw-bold">अभी पंजीकरण करें</a></span>
				</div>
			</div>
			<form action="{{ route('login') }}" method="post" id="login" class="mt-4 required" novalidate>
				<div class="row">
					<div class="col-md-12">
						<div class="form-group">
							<label for="email">1. Registered Email ID/पंजीकृत ईमेल आईडी</label>
							{{-- <input type="email" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,4}$" class="form-control" id="email" name="email" required> --}}
							<input type="text"  class="form-control" id="email" name="email" required>
							<div class="invalid-feedback">
								Please Enter Registered Email ID./कृपया पंजीकृत ईमेल आईडी भरें।
							</div>
						</div>
					</div>
					<div class="col-md-12">
						<div class="form-group password" id="hidepwd">
							<label for="password-field">2. Password/पासवर्ड</label>
							<input type="password" class="form-control" id="password-field" name="password" required>
							<span toggle="#password-field" class="fa fa-fw fa-eye field-icon toggle-password"></span>
							<div class="invalid-feedback">
								Please Enter Password./कृपया पासवर्ड भरें।
							</div>
						</div>
					</div>
					<div class="col-md-12">
						<p class="mb-5">
							<a href="{{route('forgot')}}" class="small float-end">Forgot Password/पासवर्ड भूल गए?</a>
						</p>
					</div>
					<!-- login through otp start-->
					<div class="col-md-12">
						<div class="form-group enterotp">
							<label>2.Enter OTP <strong class="text-danger">*</strong></label>
							<div class="input-group">
								<input type="text" id="otp_data" name="otp_data" class="form-control form-control-user" placeholder="Enter OTP">
								<div class="input-group-append">
									<a href="javascript://" class="btn btn-info btn-lg resendotpLogin" type="submit">Resend OTP</a>
								</div>
							</div>
							<span class="err_otp" style="color:red; display:none;"></span>
						</div>
					</div>
					<div class="col-md-5 col-5">
						<div class="captcha">
							<label class="btn-block">3. Captcha/कैप्चा</label>
							<!-- <img src="{{ asset('') }}/aplicant_template/images/captcha.jpg" alt="Captcha" title="Captcha"> -->
							<!-- <span class="unselectable" id="cp_refresh">{{$capchaCode}}</span> -->
							<span class="unselectable" id="cp_refresh">{{$Code1}}+{{$Code2}}</span>
						</div>
					</div>
					<div class="col-md-1 col-1 refresh">
						<div class="cp_refresh"><a href="javascript:void(0)" title="Refresh Captcha"><span class="fas fa-redo"></span></a>
						</div>
					</div>
					<div class="col-md-6 col-6">
						<label>4. Enter Captcha/कैप्चा भरें</label>
						<!-- <input name="captcha" id="captcha" type="text" required pattern="[0-9]{5}$" class="form-control"> -->
						<input name="captcha" id="captcha" type="text" required class="form-control">
						<div class="invalid-feedback">
							Please Enter Captcha./कृपया कैप्चा भरें।
						</div>
					</div>
				</div>
				<!-- login through otp start-->
				<input id="type" name="type" type="hidden" value="1">
				<input id="form_type" name="form_type" type="hidden" value="1">
				<div class="mb-2" id="hidelogin">
					<!-- <span>
                        <a href="javascript://" class="link otplink hidefield showfield">Login through OTP Verification</a>
					    <a href="javascript://" class="link passlink hidefield">Login through Password</a>
                    </span> -->
				</div>
				<!-- login through otp end-->
				<div class="justify-content-center row mt-5">
					<div class="col-md-6">
						<button type="submit" class="btn btn-info w-100" onclick="validateandcheck()">Login/लॉगिन करें</button>
					</div>
				</div>
				<input type="hidden" name="capchaCode" id="capchaCode" class="refreshc" value="{{$capchaCode}}">
			</form>
		</div>
	</div>
</div>


<!-- Modal -->
<div class="modal fade" id="basicExampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-xl">
		<div class="modal-content">
			<div class="modal-header">
				<!-- <h5 class="modal-title" id="exampleModalLabel">Modal title</h5> -->
				<button type="button" class="btn-close btn-danger" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<div class="modal-body">
				<div class="text-center mb-4">
					<img src="{{ asset('') }}/images/spt.png" style=" width: 30%; height: auto; " />
				</div>
				<div class="row">
					<div class="col-md-6" style="border-right: solid thin #ddd;">
						<h3 class="text-center">Khel Sathi Portal</h3>
						<p>Khel Sathi is the Web Based Portal governed by Department of Sports, Government of Uttar Pradesh catering several departmental services through online mode. The portal is intended to be used by the Sportspersons and other beneficiaries who are the natives of Uttar Pradesh state.</p>
						<p>The service <b>“Nomination Form to Seek Reward from Government of UP”</b> facilitates beneficiaries to register on Portal and apply for Nomination to seek following awards/reward:</p>
						<ul>
							<li>Laxman Award (for Male Sportspersons)</li>
							<li>Rani Laxmibai Award (for Female Sportspersons)</li>
							<li>Prize Money (for 1st, 2nd & 3rd Position Winners) </li>

						</ul>
						<p><i>Candidates can apply for the nomination on the basis of eligibility criteria issued by the department from time to time or published on its official website.</i>
						</p>
						<p>This system enables candidates to register online and furnish their Domicile, Sports, Professional and other details relevant to their nomination.</p>
						<p>Once the nomination request is submitted, same is forwarded to the login of concerned Authority of UP Sports Department for further processing. If competent Authority accepts the request then the candidate is notified about the same.</p>
						<p><i>In case UP Sports Department rejects the application at any step, application will get terminated and status of application will be displayed on the dashboard.</i>
						</p>
						<p>Along with, this portal enables its users to:</p>
						<ul>
							<li>View all actions taken by UP Sports Department through their login</li>
							<li>Track real-time status of application</li>
							<li>Answer the query raised by Department in relation to the submitted application </li>
							<li>Raise query with UP Sports Department in relation to application</li>
							<li>Get SMS & Email alerts at all necessary steps</li>

						</ul>
					</div>
					<div class="col-md-6">
						<h3 class="text-center">खेल साथी पोर्टल</h3>
						<p>खेल साथी, खेल विभाग, उत्तर प्रदेश सरकार द्वारा संचालित वेब आधारित पोर्टल है, जो ऑनलाइन प्रणाली के माध्यम से विभिन्न विभागीय सेवाओं की पूर्ति करता है। पोर्टल का उद्देश्य उन खिलाड़ियों अथवा लाभार्थियों को लाभ पहुंचाना है जो उत्तर प्रदेश राज्य के मूल निवासी हैं।</p>
						<p><b>"उ0प्र0 सरकार से पुरस्कार प्राप्त करने हेतु नामांकन प्रपत्र" </b> लाभार्थियों को पोर्टल पर पंजीकरण करने एवं निम्नलिखित पुरस्कार प्राप्त करने के लिए नामांकन हेतु आवेदन करने की सुविधा प्रदान करती है:</p>
						<ul>
							<li>लक्ष्मण पुरस्कार (पुरुष खिलाड़ियों हेतु)</li>
							<li>रानी लक्ष्मीबाई पुरस्कार (महिला खिलाड़ियों हेतु)</li>
							<li>पुरस्कार राशि (प्रथम, द्वितीय और तृतीय स्थान के विजेताओं हेतु) </li>

						</ul>

						<p><i>उम्मीदवार, नामांकन के लिए विभाग द्वारा समय-समय पर जारी या विभाग की आधिकारिक वेबसाइट पर प्रकाशित पात्रता मानदंड के आधार पर आवेदन कर सकते हैं।</i>
						</p>
						<p>यह प्रणाली, उम्मीदवारों को ऑनलाइन पंजीकरण करने एवं उनके नामांकन के लिए अधिवास, खेल, व्यवसाय एवं अन्य प्रासंगिक विवरण प्रस्तुत करने में सक्षम बनाती है।</p>
						<p>नामांकन प्रपत्र दर्ज हो जाने के पश्चात, उसे आगे की कार्यवाही हेतु उ0प्र0 खेल विभाग के संबंधित अधिकारी के लॉगिन पर अग्रेषित कर दिया जाता है। यदि सक्षम प्राधिकारी अनुरोध स्वीकार करते हैं तो उम्मीदवार को इसके संबंध में सूचित किया जाता है।</p>
						<p><i>यदि उ0प्र0 खेल विभाग किसी भी चरण पर आवेदन को अस्वीकार करता है तो आवेदन तत्काल प्रभाव से निरस्त हो जाएगा एवं आवेदन की स्थिति डैशबोर्ड पर प्रदर्शित हो जाएगी।</i>
						</p>
						<p>उक्त के अतिरिक्त, यह पोर्टल अपने उपयोगकर्ताओं को सक्षम बनाता है:</p>
						<ul>
							<li>उ0प्र0 खेल विभाग द्वारा उनके लॉगिन के माध्यम से की गई सभी कार्यवाहियों को देखने में</li>
							<li>आवेदन की वर्तमान स्थिति के बारे में</li>
							<li>दर्ज किए गए आवेदन के संबंध में विभाग द्वारा दर्ज की गई आपत्ति/संशय का उत्तर देने में</li>
							<li>आवेदन के संबंध में उत्तर प्रदेश खेल विभाग से जानकारी प्राप्त करने में</li>
							<li>सभी आवश्यक चरणों पर एसएमएस व ईमेल अलर्ट प्राप्त करने में</li>
						</ul>
					</div>
				</div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
			</div>
		</div>
	</div>
</div>
@endsection
@push('custom-scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/crypto-js/3.1.9-1/crypto-js.js"></script>
<script type="text/javascript">
    function validateandcheck() {


        // alert(1)

        if ($("#password-field").val() != '') {
            var dataToEncrypt = $("#password-field").val();
             var encryptionKey = "2b7e151628aed2a6abf7158809cf4f3c";
             var keyHex = CryptoJS.enc.Hex.parse(encryptionKey);
             var encrypted = CryptoJS.AES.encrypt(dataToEncrypt, keyHex, {
                 mode: CryptoJS.mode.ECB
             });
             $("#password-field").val(encrypted.toString());
         
         var mdataToEncrypt = $("#email").val();
         var mencryptionKey = "2b7e151628aed2a6abf7158809cf4f3c";
         var mkeyHex = CryptoJS.enc.Hex.parse(mencryptionKey);
         var mencrypted = CryptoJS.AES.encrypt(mdataToEncrypt, mkeyHex, {
             mode: CryptoJS.mode.ECB
         });


         $("#email").val(mencrypted.toString());

    };
}
</script>
@endpush
