@extends( 'layouts/web' )
@section( 'content' )
<style>
	.unselectable {
		-webkit-user-select: none;
		-webkit-touch-callout: none;
		-moz-user-select: none;
		-ms-user-select: none;
		user-select: none;
	}
</style>
<div class="row">
	<div class="col-md-6 loginsidebar">
		<div class="row justify-content-center">
			<div class="col-4 col-lg-2 text-center mb-3">
				<img src="{{ asset('') }}/images/-logo.png" class="img-fluid mobile-resp" />
			</div>
			<div class="col-md-12 col-12 deptname">
				<h3 class="hd-org">Khel Sathi Portal/खेल साथी पोर्टल</h3>
				<h3>Department of Sports, Government of Uttar Pradesh<br>खेल विभाग, उत्तर प्रदेश सरकार</h3>
			</div>
			<div class="col-md-12 col-12 deptname">
				<h5 class="text-success">Online System for Former Sportspersons of UP to Seek Financial Assistance/Monthly Pension<br>वित्तीय सहायता/मासिक पेंशन प्राप्त करने हेतु उत्तर प्रदेश के पूर्व खिलाड़ियों के लिए ऑनलाइन प्रणाली</h5>
			</div>
		</div>
	</div>
	<div class="col-md-6 bg-light1">
		<div class="p-4 p-lg-5 login-form">
			<div class="text-center text-md-center mb-2 mt-md-0">
				<h3 class="mb-0">Applicant's Login/आवेदक का लॉगिन</h3>
				<div class="d-flex justify-content-center align-items-center mt-2"><span class="fw-normal">Don't have an account?
						<a href="{{ route('fasignUp') }}" class="fw-bold">Register Here</a></span>
				</div>
				<div class="d-flex justify-content-center align-items-center mt-2"><span class="fw-normal">अकाउंट नहीं है?
						<a href="{{ route('fasignUp') }}" class="fw-bold">अभी पंजीकरण करें</a></span>
				</div>
			</div>
			<form action="{{ route('falogin') }}" method="post" id="login" class="mt-3 g-3 required" novalidate>
				<div class="form-group ">
					<label for="email">1. Registered Email ID/पंजीकृत ईमेल आईडी</label>
					<input type="email" class="form-control" id="email" name="email" required>
					<div class="invalid-feedback">
						Please Enter Registered Email ID.
					</div>
				</div>
				<div class="form-group  password" id="hidepwd">
					<label for="password-field">2. Password/पासवर्ड</label>
					<input type="password" class="form-control" id="password-field" name="password" required>
					<span toggle="#password-field" class="fa fa-fw fa-eye field-icon toggle-password"></span>
					<div class="invalid-feedback">
						Please Enter Password.
					</div>
				</div>
				<p class="form-group text-end">
					<a href="{{route('faforgot')}}" class="small">Forgot Password?/पासवर्ड भूल गए?</a>
					<!--<input class="form-check-input" type="checkbox" value="" id="remember">
                            <label class="form-check-label mb-0" for="remember">Remember me</label>-->
				</p>
				<!-- login through otp start-->
				<div class="form-group enterotp">
					<label>2.Enter OTP <strong class="text-danger">*</strong></label>
					<div class="input-group">
						<input type="text" id="otp_data" name="otp_data" class="form-control form-control-user" placeholder="Enter OTP">
						<div class="input-group-append">
							<a href="javascript://" class="btn btn-info resendotpLogin" type="submit">Resend OTP</a>
						</div>
					</div>
					<span class="err_otp" style="color:red; display:none;"></span>
				</div>
				<!-- login through otp end-->
				<div class="row mb-5">
					<div class="col-md-5">
						<div class="captcha">
							<label class="btn-block">3. Captcha/कैप्चा</label>
							<!-- <img src="{{ asset('') }}/aplicant_template/images/captcha.jpg" alt="Captcha" title="Captcha"> -->
							<span class="unselectable" id="cp_refresh">{{$Code1}}+{{$Code2}}</span>
						</div>
					</div>
					<div class="col-md-1 refresh">
						<div class="cp_refresh"><a href="javascript:void(0)" title="Refresh Captcha"><span class="fas fa-redo"></span></a>
						</div>
					</div>
					<div class="col-md-6">
						<label>4. Enter Captcha/कैप्चा भरें</label>
						<input name="captcha" id="captcha" type="text" required class="form-control">
						<div class="invalid-feedback">
							Please Enter Captcha.
						</div>
					</div>
				</div>
				<!-- login through otp start-->
				<input id="type" name="type" type="hidden" value="1">
				<input id="form_type" name="form_type" type="hidden" value="2">
				<div class="mb-2" id="hidelogin">				
				</div>
				<div class="d-grid"><button type="submit" class="btn w-100 btn-info">Login/लॉगिन करें</button> </div>
				<input type="hidden" name="capchaCode" id="capchaCode" class="refreshc" value="{{$capchaCode}}">
			</form>
		</div>
	</div>
</div>
<div class="modal fade" id="Department" tabindex="-1" aria-labelledby="nativealert" aria-hidden="true">
	<div class="modal-dialog modal-xl">
		<div class="modal-content">
			<div class="modal-header">
				<!-- <h5 class="modal-title" id="exampleModalLabel">Instructions</h5> -->
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<div class="modal-body" style="max-height: 450px; overflow: auto;">
				<div class="text-center mb-4">
					<img src="{{ asset('') }}/images/spt.png" style=" width: 30%; height: auto; " />
				</div>
				<div class="row">
					<div class="col-md-6" style="border-right: solid thin #ddd;">
						<h3 class="text-center">Khel Sathi Portal</h3>
						<p>Khel Sathi is the Web Based Portal governed by Department of Sports, Government of Uttar Pradesh catering several departmental services through online mode. The portal is intended to be used by the Sportspersons and other beneficiaries who are the natives of Uttar Pradesh state.</p>
						<p>The service <b>“Online System for Former Sportspersons of UP to Seek Financial Assistance/Monthly Pension”</b> facilitates beneficiaries to register on Portal and seek Financial Assistance/Monthly Pension from UP Sports Department.</p>
						<p><i>Applicant can request for Financial Assistance/Monthly Pension on the basis of eligibility criteria issued by the department from time to time or published on its official website.</i>
						</p>
						<p>This portal enables candidates to register online and furnish their Domicile, Sports, Professional and other details relevant in relation to Seek Financial Assistance/Monthly Pension.</p>
						<p>Once the application form is submitted, same is forwarded to the login of concerned Authority of UP Sports Department for further processing. If competent Authority accepts the request then the candidate is notified about the same.</p>
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
						<p><b>"वित्तीय सहायता/मासिक पेंशन प्राप्त करने हेतु उत्तर प्रदेश के पूर्व खिलाड़ियों के लिए ऑनलाइन प्रणाली"</b> लाभार्थियों को पोर्टल पर पंजीकरण करने एवं उत्तर प्रदेश सरकार से वित्तीय सहायता/मासिक पेंशन प्राप्त करने हेतु आवेदन करने की सुविधा प्रदान करती है।</p>
						<p><i>उम्मीदवार, वित्तीय सहायता/मासिक पेंशन प्राप्त करने हेतु विभाग द्वारा समय-समय पर जारी या विभाग की आधिकारिक वेबसाइट पर प्रकाशित पात्रता मानदंड के आधार पर आवेदन कर सकते हैं।</i>
						</p>
						<p>यह पोर्टल उम्मीदवारों को ऑनलाइन पंजीकरण करने एवं वित्तीय सहायता/मासिक पेंशन प्राप्त करने के संबंध में उनके अधिवास, खेल, व्यवसाय व अन्य प्रासंगिक विवरणों को प्रस्तुत करने में सक्षम बनाता है।</p>
						<p>आवेदन प्रपत्र दर्ज हो जाने के पश्चात, उसे आगे की कार्यवाही हेतु उ0प्र0 खेल विभाग के संबंधित अधिकारी के लॉगिन पर अग्रेषित कर दिया जाता है। यदि सक्षम प्राधिकारी अनुरोध स्वीकार करते हैं तो उम्मीदवार को इसके संबंध में सूचित किया जाता है।</p>
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
			<div class="modal-footer justify-content-md-center">
				<div class="col-2 d-grid">
					<button class="btn btn-info" type="button" data-bs-dismiss="modal" aria-label="OK">OK</button>
				</div>

			</div>
		</div>
	</div>
</div>

@endsection
