@extends( 'layouts\admin_hostel_application' )
@section( 'application' )

<style>
	.dn {
		display: none;
	}
</style>

<body class="dashbg">
	<div class="contentwraper">
		@includeIf('components.hostel_header_dashboard')
		<style>
			.pagebody {
				padding: 0 15px;

			}
		</style>
		<div class="container pagecontentbody">
			<div class="tab-content">
				<div class="pagebody removebg-color ">
					<div class="pageheader">
						<h4 class="mb-0">Application for Hostel Admission/छात्रावास में प्रवेश हेतु आवेदन<a class="btn btn-dark float-end" href="{{route('hostel.dashboard')}}" style="width: auto;"><span class="icons icon-arrow-left"></span> Dashboard/डैशबोर्ड</a></h4>
					</div>
					<div class="bhoechie-tab-container">
						<div class="row">
							<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
								<div class="bhoechie-tab-menu">
									<div class="list-group">
										<a href="#" class="list-group-item @if ( $userDetails->level == 0 ) active @endif @if ( $userDetails->level == 4) disabled @endif" style="width: 25%;">
											<span class="icons icon-user"></span>
											Basic Details/सामान्य विवरण
										</a>
										<a href="#" class="list-group-item  @if ( $userDetails->level == 1 ) active @endif @if ( $userDetails->level == 4  || $userDetails->level < 1) disabled @endif" style="width: 25%;">
											<span class="fas fa-envelope"></span>
											Communication Details/संचार विवरण
										</a>
										<a href="#" class="list-group-item @if ( $userDetails->level == 2 ) active @endif  @if ($userDetails->level == 4  || $userDetails->level < 2) disabled @endif" style="width: 25%;">
											<span class="icons icon-grid"></span>
											Educational Qualification Details/शैक्षणिक योग्यता विवरण
										</a>
										<a href="#" class="list-group-item @if ( $userDetails->level == 3 ) active @endif  @if ($userDetails->level == 4  || $userDetails->level < 3) disabled @endif  @if ( $userDetails->level == 4) active @endif" style="width: 25%;">
											<span class="fas fa-file-pdf"></span>
											Application Preview/एप्लिकेशन पूर्वावलोकन
										</a>
									</div>
								</div>
							</div>
							<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 bhoechie-tab">
								<div class="bhoechie-tab-content @if ( $userDetails->level == 0 ) active @endif   @if ( $userDetails->level == 4) disabled @endif ">
									<form action="{{route('hostel.applicationBasicForm')}}" method="post" class="needs-validation" novalidate enctype="multipart/form-data">
										@csrf
										<div class="form-scroll">
											<div class="nano-content">
												<div class="row">
													<div class="col-md-12">
														<h5 class="subheading">A. Registration Details/पंजीकरण संबंधी विवरण</h5>
													</div>
													<div class="col-md-4">
														<div class="form-group">
															<label class="placeholder">1. Applicant’s Name/आवेदक का नाम <span class="text-danger">*</span></label>
															<input type="text" class="form-control alphanumeric" value="{{$userDetails->name}}" disabled>
														</div>
													</div>
													<div class="col-md-4">
														<div class="form-group">
															<label class="placeholder">2. Date of Birth/जन्मतिथि<span class="text-danger">*</span></label>
															<input type="text" class="form-control datepicker-here" value="{{dmy($userDetails->dob)}}" disabled>
														</div>
													</div>
													<div class="col-md-4">
														<div class="form-group">
															<label class="placeholder">3. Aadhaar Number/आधार नंबर <span class="text-danger">*</span></label>
															<input type="text" class="form-control" value="{{$userDetails->aadhar}}" disabled>
														</div>
													</div>
													<div class="col-md-4">
														<div class="form-group">
															<label class="placeholder">4. Mobile Number/मोबाइल नंबर <span class="text-danger">*</span></label>
															<input type="text" class="form-control" value="{{$userDetails->mobile}}" disabled>
														</div>
													</div>
													<div class="col-md-4">
														<div class="form-group">
															<label class="placeholder">5. Email ID/ईमेल आईडी <span class="text-danger">*</span></label>
															<input type="email" class="form-control" value="{{$userDetails->email}}" disabled>
														</div>
													</div>
													<div class="col-md-4">
														<div class="form-group">
															<label class="placeholder">6. State/राज्य <span class="text-danger">*</span></label>
															<input type="email" class="form-control" value="{{$userDetails->native_of_up}}" disabled>
														</div>
													</div>
													<div class="col-md-4">
														<div class="form-group">
															<label class="placeholder">7. Gender/लिंग<span class="text-danger">*</span></label>
															<input type="email" class="form-control" value="@if ($userDetails->gender == 1)
																	Male/पुरुष
																@else
																	Female/महिला
																@endif" disabled>
														</div>
													</div>
													<div class="col-md-8">
														<div class="form-group">
															<label for="username" class="placeholder">8. Are you existing student of Sports College? <br> (Guru Gobind Singh Sports College, Lucknow/Bir Bahadur Singh Sports College, Gorakhpur/Major Dhyanchand Sports College, Saifai)<span class="text-danger">*</span></label>
															<div class="form-control">
																<div class="form-check form-check-inline">
																	<input class="form-check-input" type="radio" name="existing_student" id="existing_studentt" {{ old('existing_student') === '1' ? 'checked' : '' }} @isset($userDetails->applicationBasicDetasils) @if ($userDetails->existing_student == '1') checked @endif @endisset value="1" required>
																	<label class="form-check-label" for="class1">Yes/हाँ</label>
																</div>
																<div class="form-check form-check-inline">
																	<input class="form-check-input" type="radio" name="existing_student" id="existing_studenttt" {{ old('existing_student') === '2' ? 'checked' : '' }} @isset($userDetails->applicationBasicDetasils) @if ($userDetails->existing_student == '2') checked @endif @endisset value="2" required>
																	<label class="form-check-label" for="class7">No/नहीं</label>
																</div>
																@error('existing_student')
																<div class="text-danger">{{ $message }}</div>
																@enderror
															</div>
														</div>
													</div>
													<div class="col-md-4 existing_student_yes">
														<div class="form-group">
															<label class="placeholder">9. Admission No. <span class="text-danger">*</span></label>
															<input type="number" class="form-control" min="1" name="admission_no" id="admission_noo" value="@isset($userDetails->applicationBasicDetasils){{$userDetails->applicationBasicDetasils->admission_no}}@endisset">
														</div>
													</div>
													<div class="col-md-4 existing_student_yes">
														<div class="form-group">
															<label class="placeholder">10.Sports College <span class="text-danger">*</span></label>
															<select class="form-select" name="sports_college" required id="sports_college">
																<option value="">Select/चयन करें</option>
																<option value="Guru Gobind Singh Sports College, Lucknow" @isset($userDetails->applicationBasicDetasils) @if ($userDetails->applicationBasicDetasils->sports_college == "Guru Gobind Singh Sports College, Lucknow") selected @endif @endisset >Guru Gobind Singh Sports College, Lucknow</option>
																<option value="Bir Bahadur Singh Sports College, Gorakhpur" @isset($userDetails->applicationBasicDetasils) @if ($userDetails->applicationBasicDetasils->sports_college == "Bir Bahadur Singh Sports College, Gorakhpur") selected @endif @endisset >Bir Bahadur Singh Sports College, Gorakhpur</option>
																<option value="Major Dhyanchand Sports College, Saifai" @isset($userDetails->applicationBasicDetasils) @if ($userDetails->applicationBasicDetasils->sports_college == "Major Dhyanchand Sports College, Saifai") selected @endif @endisset >Major Dhyanchand Sports College, Saifai</option>
															</select>
														</div>
													</div>
													<div class="col-md-4 existing_student_yes">
														<div class="form-group">
															<label class="placeholder">11. Roll No. <span class="text-danger">*</span></label>
															<input type="number" class="form-control" min="1" name="roll_no" id="roll_noo" @isset($userDetails->applicationBasicDetasils->roll_no) value="{{$userDetails->applicationBasicDetasils->roll_no}}" @endisset >
														</div>
													</div>
													<div class="col-md-4 existing_student_yes">
														<div class="form-group">
															<label class="placeholder">12. Student Id Card <span class="text-danger">*</span></label>
															<input type="hidden" class="form-control" id="student_id_carddd" value="@isset($userDetails->applicationBasicDetasils){{$userDetails->applicationBasicDetasils->student_id_card}} @endisset">
															<div class="input-group">
																<input type="file" class="form-control" name="student_id_card" id="student_id_cardd">
																@isset($userDetails->applicationBasicDetasils->student_id_card)<a href="{{url('public/hostelapplicant/student_id_card/')}}/{{$userDetails->applicationBasicDetasils->student_id_card}} " class="btn btn-secondary" id="A3" target="_blank">View</a>@endisset
															</div>
															<span class="note">File Format/फाइल का प्रारूप: JPEG/JPG/PDF | Max File Size/फाइल का अधिकतम साइज़: 2 MB</span>
														</div>
													</div>
													<div class="col-md-8 existing_student_yes">
														<div class="form-group">
															<label class="placeholder">13.
																Participated in a recognized category's national championship (Attach a certificate certified by the principal) / कालेज में अध्ययनरत रहते हुए मान्यता प्राप्त किसी वर्ग की राष्ट्रीय चैम्पियनशिप में भाग लिया हो (प्रधानाचार्य द्वारा प्रमाणित प्रमाण पत्र संलग्न करें<span class="text-danger">*</span></label>
															<input type="hidden" class="form-control" id="national_champtionship_documentt" value="@isset($userDetails->applicationBasicDetasils){{$userDetails->applicationBasicDetasils->national_champtionship_document}} @endisset">
															<div class="input-group">
																<input type="file" class="form-control" name="national_champtionship_document" id="national_champtionship_document">
																@isset($userDetails->applicationBasicDetasils->national_champtionship_document)<a href="{{url('public/hostelapplicant/student_id_card/')}}/{{$userDetails->applicationBasicDetasils->national_champtionship_document}} " class="btn btn-secondary" id="A3" target="_blank">View</a>@endisset
															</div>
															<span class="note">File Format/फाइल का प्रारूप: JPEG/JPG/PDF | Max File Size/फाइल का अधिकतम साइज़: 2 MB</span>
														</div>
													</div>
													<div class="col-md-12">
														<h5 class="subheading">B. Applicant’s Details/आवेदक का विवरण</h5>
													</div>
													<div class="col-md-4">
														<div class="form-group">
															<label>1. District/जनपद <span class="text-danger">*</span></label>
															<select class="form-select" name="district_id" required id="district_id">
																<option value="">Select/चयन करें</option>
																@foreach ($districts as $district)
																<option value="{{$district->id}}" {{ old('district_id') === $district->id ? 'selected' : '' }} @isset($userDetails->applicationBasicDetasils) @if ($userDetails->applicationBasicDetasils->district_id == $district->id) selected @endif @endisset >{{$district->city}}</option>
																@endforeach
															</select>
															@error('district_id')
															<div class="text-danger">{{ $message }}</div>
															@enderror
														</div>
													</div>
													<div class="col-md-4">
														<div class="form-group">
															<label>2. District/Regional Sports Office/क्षेत्रीय खेल कार्यालय<span class="text-danger">*</span></label>
															<input type="hidden" id="region_sport_office_idd" value="@isset($userDetails->applicationBasicDetasils->region_sport_office_id ){{ $userDetails->applicationBasicDetasils->region_sport_office_id }} @endisset">
															<select class="form-select" name="region_sport_office_id" id="region_sport_office_id" required>
																{{-- <option value="">Select/चयन करें</option>
																			@foreach ($regions as $region)
																			<option value="{{$region->id}}" {{ old('region_sport_office_id') === $region->id ? 'selected' : '' }} @isset($userDetails->applicationBasicDetasils) @if ($userDetails->applicationBasicDetasils->region_sport_office_id == $region->id) selected @endif @endisset>{{$region->region_office}}</option>
																@endforeach --}}
															</select>
															@error('region_sport_office_id')
															<div class="text-danger">{{ $message }}</div>
															@enderror
														</div>
													</div>
													<div class="col-md-4">
														<div class="form-group">
															<label class="placeholder">3. Sports Name/खेल का नाम<span class="text-danger">*</span></label>
															<select class="form-select" name="sports" onchange="sporttype(this.value)" id="sport_type" required>
																<option value="">Select/चयन करें</option>
																@foreach ($sports as $sport)
																<option value="{{$sport->id}}" @isset($userDetails->applicationBasicDetasils) @if ($userDetails->applicationBasicDetasils->sports == $sport->id) selected @endif @endisset >{{$sport->name}}</option>
																@endforeach
															</select>
															@error('sports')
															<div class="text-danger">{{ $message }}</div>
															@enderror
														</div>
													</div>
													<div class="col-md-3" id="subsport">
														<div class="form-group mb-3">
															<label>Select Sub Sport<span class="text-danger">*</span></label>
															<select class="form-select form-control container3" required name="sub_type" data-subsport="@if(isset($userDetails->applicationBasicDetasils) && $userDetails->applicationBasicDetasils->sub_sport_type){{$userDetails->applicationBasicDetasils->sub_sport_type}}@endif">
															</select>
														</div>
													</div>
													<div class="col-md-4">
														<div class="form-group">
															<label>4. Category/वर्ग <span class="text-danger">*</span></label>
															<select class="form-select" name="category" required>
																<option value="">Select/चयन करें</option>
																<option value="General" {{ old('category') === 'General' ? 'selected' : '' }} @isset($userDetails->applicationBasicDetasils) @if ($userDetails->applicationBasicDetasils->category == "General") selected @endif @endisset>General</option>
																<option value="OBC" {{ old('category') === 'OBC' ? 'selected' : '' }} @isset($userDetails->applicationBasicDetasils) @if ($userDetails->applicationBasicDetasils->category == "OBC") selected @endif @endisset>OBC</option>
																<option value="SC" {{ old('category') === 'SC' ? 'selected' : '' }} @isset($userDetails->applicationBasicDetasils) @if ($userDetails->applicationBasicDetasils->category == "SC") selected @endif @endisset>SC</option>
																<option value="ST" {{ old('category') === 'ST' ? 'selected' : '' }} @isset($userDetails->applicationBasicDetasils) @if ($userDetails->applicationBasicDetasils->category == "ST") selected @endif @endisset>ST</option>
																<option value="EWS" {{ old('category') === 'EWS' ? 'selected' : '' }} @isset($userDetails->applicationBasicDetasils) @if ($userDetails->applicationBasicDetasils->category == "EWS") selected @endif @endisset>EWS</option>
															</select>
															@error('category')
															<div class="text-danger">{{ $message }}</div>
															@enderror
														</div>
													</div>
													<div class="col-md-4">
														<div class="form-group">
															<label>5. Sub Category/उपश्रेणी</label>
															<input type="text" class="form-control" name="sub_category" value="{{isset($userDetails->applicationBasicDetasils) ? $userDetails->applicationBasicDetasils->sub_category : old('sub_category')}}">
														</div>
														@error('sub_category')
														<div class="text-danger">{{ $message }}</div>
														@enderror
													</div>
													<div class="col-md-4">
														<div class="form-group ">
															<label class="placeholder">6. Photograph of Applicant/आवेदक की फोटो <span class="text-danger">*</span></label>
															@isset($userDetails->applicationBasicDetasils) <div class="form-control text-center">
																<img src="{{url('public/hostelapplicant/applicant_file')}}/{{$userDetails->applicationBasicDetasils->applicant_file}}" class="img-fluid" style="width: 140px;" />
															</div>@endisset
															<input type="file" class="form-control mt-1" name="applicant_file" onchange="getfileext11(this.value,15)" id="File15" value="{{old('applicant_file')}}" {{isset($userDetails->applicationBasicDetasils) ? '' : 'required'}}>
															<span class="note">File Format/फाइल का प्रारूप: JPEG/JPG | Max File Size/फाइल का अधिकतम साइज़: 2 MB</span> @error('applicant_file')
															<div class="text-danger">{{ $message }}</div>
															@enderror
														</div>
													</div>
													<div class="col-md-4">
														<div class="form-group ">
															<label class="placeholder">7. Signature of Applicant/आवेदक के हस्ताक्षर <span class="text-danger">*</span></label>
															@isset($userDetails->applicationBasicDetasils)<div class="form-control text-center">
																<img src="{{url('public/hostelapplicant/applicant_sign')}}/{{$userDetails->applicationBasicDetasils->applicant_sign}}" class="img-fluid" style="width: 140px;" />
															</div>@endisset
															<input type="file" class="form-control mt-1" name="applicant_sign" onchange="getfileext11(this.value,14)" id="File14" value="{{old('applicant_sign')}}" {{isset($userDetails->applicationBasicDetasils) ? '' : 'required'}}>
															<span class="note">File Format/फाइल का प्रारूप: JPEG/JPG | Max File Size/फाइल का अधिकतम साइज़: 2 MB</span> @error('applicant_sign')
															<div class="text-danger">{{ $message }}</div>
															@enderror
														</div>
													</div>
													<div class="col-md-4">
														<div class="form-group">
															<label class="placeholder">8. Upload Aadhaar Card /आधार कार्ड अपलोड करें<span class="text-danger">*</span></label>
															<div class="input-group">
																<input type="file" class="form-control" onchange="getfileext(this.value,16)" id="File16" pattern="([^\\s]+(\\.(?i)(jpg))$)" aria-describedby="inputGroupFileAddon05" aria-label="Upload" name="aadhar_card_file" value="{{old('aadhar_card_file')}}" {{isset($userDetails->applicationBasicDetasils) ? '' : 'required'}}>
																@isset($userDetails->applicationBasicDetasils)<a href="{{url('public/hostelapplicant/aadhar_card_file/')}}/{{$userDetails->applicationBasicDetasils->aadhar_card_file}} " class="btn btn-secondary" id="A3" target="_blank">View</a>@endisset
															</div>
															<span class="note">File Format/फाइल का प्रारूप: JPEG/JPG | Max File Size/फाइल का अधिकतम साइज़: 2 MB</span>
															@error('aadhar_card_file')
															<div class="text-danger">{{ $message }}</div>
															@enderror
														</div>
													</div>
													<div class="col-md-4">
														<div class="form-group">
															<label>9. Upload Domicile Certificate/निवास प्रमाणपत्र अपलोड करें <span class="text-danger">*</span></label>
															<div class="input-group">
																<input type="file" class="form-control" aria-describedby="inputGroupFileAddon05" aria-label="Upload" name="applicant_domicle" onchange="getfileext(this.value,10)" id="File10" value="{{old('applicant_domicle')}}" {{isset($userDetails->applicationBasicDetasils) ? '' : 'required'}}>
																@isset($userDetails->applicationBasicDetasils)<a href="{{url('public/hostelapplicant/applicant_domicle')}}/{{$userDetails->applicationBasicDetasils->applicant_domicle}}" class="btn btn-secondary" target="_blank" id="A4">View/देखे</a> @endisset
															</div>
															<span class="note">File Format/फाइल का प्रारूप: JPEG/JPG | Max File Size/फाइल का अधिकतम साइज़: 2 MB</span> @error('applicant_domicle')
															<div class="text-danger">{{ $message }}</div>
															@enderror
														</div>
													</div>
													<div class="col-md-4">
														<div class="form-group">
															<label>10. DOB certificate certified by School/registrar <span class="text-danger">*</span></label>
															<div class="input-group">
																<input type="file" class="form-control" aria-describedby="inputGroupFileAddon05" aria-label="Upload" name="applicant_dob_certificate" onchange="getfileext(this.value,10)" id="File10" value="{{old('applicant_domicle')}}" {{isset($userDetails->applicationBasicDetasils) ? '' : 'required'}}>
																@isset($userDetails->applicationBasicDetasils)<a href="{{url('public/hostelapplicant/applicant_dob_certificate')}}/{{$userDetails->applicationBasicDetasils->applicant_dob_certificate}}" class="btn btn-secondary" target="_blank" id="A4">View/देखे</a> @endisset
															</div>
															<span class="note">File Format/फाइल का प्रारूप: JPEG/JPG | Max File Size/फाइल का अधिकतम साइज़: 2 MB</span> @error('applicant_dob_certificate')
															<div class="text-danger">{{ $message }}</div>
															@enderror
														</div>
													</div>
													<div class="col-md-4">
														<div class="form-group">
															<label class="placeholder">11. Visible Identification Mark/दृश्यमान पहचान चिह्न <span class="text-danger">*</span></label>
															<input type="text" class="form-control" name="identification_mark" pattern="[A-Za-z ]{1,500}" value="{{isset($userDetails->applicationBasicDetasils) ? $userDetails->applicationBasicDetasils->identification_mark : old('identification_mark')}}" required> @error('identification_mark')
															<div class="text-danger">{{ $message }}</div>
															@enderror
														</div>
													</div>
													<div class="col-md-4" id="number_of_teethhhhh">
														<div class="form-group">
															<label class="placeholder">12. Number of Teeth/दांतों की संख्या <span class="text-danger">*</span></label>
															<input type="number" max="28" min="24" class="form-control" name="number_of_teeth" id="number_of_teeth" value="{{isset($userDetails->applicationBasicDetasils) ? $userDetails->applicationBasicDetasils->number_of_teeth : old('number_of_teeth')}}" required oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');">
															<span class="note">*Note: Upto 12 Years – Max. 24 teeth, Upto 15 Years – Max. 28 teeth
															</span>
															<span class="note">
																नोट: 12 वर्ष तक - अधिकतम 24 दाँत, 15 वर्ष तक - अधिकतम 28 दाँत
															</span>
															@error('number_of_teeth')
															<div class="text-danger">{{ $message }}</div>
															@enderror
														</div>
													</div>
													<div class="col-md-4">
														<div class="form-group">
															<label for="username" class="placeholder">13. Is applicant suffering from Skin Disease/Fits/Other Disease? /क्या आवेदक त्वचा रोग/फिट्स/अन्य रोग से ग्रसित हैं?<span class="text-danger">*</span></label>
															<div class="form-control">
																<div class="form-check form-check-inline">
																	<input id="pwdss" class="form-check-input" type="radio" name="disease" id="Radio3" {{ old('disease') === 'Yes' ? 'checked' : '' }} @isset($userDetails->applicationBasicDetasils) @if ($userDetails->applicationBasicDetasils->disease == 'Yes') checked @endif @endisset value="Yes" required>
																	<label class="form-check-label" for="class1">Yes/हाँ</label>
																</div>
																<div class="form-check form-check-inline">
																	<input class="form-check-input" id="pwds" type="radio" name="disease" id="Radio4" {{ old('disease') === 'Yes' ? 'checked' : '' }} @isset($userDetails->applicationBasicDetasils) @if ($userDetails->applicationBasicDetasils->disease == 'No') checked @endif @endisset value="No" required>
																	<label class="form-check-label" for="class7">No/नहीं</label>
																</div>
																@error('disease')
																<div class="text-danger">{{ $message }}</div>
																@enderror
															</div>
														</div>
													</div>
													<div class="col-md-4" id="medicalupload">
														<div class="form-group">
															<label class="placeholder">14. Upload Medical Certificate/चिकित्सकीय प्रमाणपत्र अपलोड करें <span class="text-danger">*</span></label>
															<div class="input-group">
																<input type="hidden" value="@isset($userDetails->applicationBasicDetasils->medical_certificate_file ){{$userDetails->applicationBasicDetasils->medical_certificate_file}}@endisset" id="medical_certificate_file1">
																<input type="file" class="form-control" onchange="getfileext(this.value,5)" id="File5" aria-describedby="inputGroupFileAddon05" aria-label="Upload" name="medical_certificate_file">
																@isset($userDetails->applicationBasicDetasils->medical_certificate_file) <a href="{{url('public/hostelapplicant/medical_certificate_file')}}/{{$userDetails->applicationBasicDetasils->medical_certificate_file}} " class="btn btn-secondary" target="_blank" id="A5">View/देखे</a>@endisset
															</div>
															<span class="note">File Format/फाइल का प्रारूप: JPEG/JPG | Max File Size/फाइल का अधिकतम साइज़: 2 MB</span>
															@error('medical_certificate_file')
															<div class="text-danger">{{ $message }}</div>
															@enderror
														</div>
													</div>
													<div class="col-md-4">
														<div class="form-group">
															<label class="placeholder">15. Father’s Name/पिता का नाम <span class="text-danger">*</span></label>
															<input type="text" class="form-control alphanumeric" name="father_name" pattern="[A-Za-z ]{1,32}" value="{{isset($userDetails->applicationBasicDetasils) ? $userDetails->applicationBasicDetasils->father_name : old('father_name')}}" required> @error('father_name')
															<div class="text-danger">{{ $message }}</div>
															@enderror
														</div>
													</div>
													<div class="col-md-4">
														<div class="form-group">
															<label>16. Father's Occupation/पिता का व्यवसाय <span class="text-danger">*</span></label>
															<select class="form-select" name="father_occuption" required>
																<option value="">Select/चयन करें</option>
																<option value='Government' {{ old('father_occuption') === 'Government' ? 'selected' : '' }} @isset($userDetails->applicationBasicDetasils) @if ($userDetails->applicationBasicDetasils->father_occuption == "Government") selected @endif @endisset >Government </option>
																<option value="Private" {{ old('father_occuption') === 'Private' ? 'selected' : '' }} @isset($userDetails->applicationBasicDetasils) @if ($userDetails->applicationBasicDetasils->father_occuption == "Private") selected @endif @endisset>Private</option>
																<option value="Business" {{ old('father_occuption') === 'Business' ? 'selected' : '' }} @isset($userDetails->applicationBasicDetasils) @if ($userDetails->applicationBasicDetasils->father_occuption == "Business") selected @endif @endisset>Business</option>
															</select>
															@error('father_occuption')
															<div class="text-danger">{{ $message }}</div>
															@enderror
														</div>
													</div>
													<div class="col-md-4">
														<div class="form-group">
															<label class="placeholder">17. Mother’s Name/माता का नाम <span class="text-danger">*</span></label>
															<input type="text" class="form-control alphanumeric" name="mother_name" pattern="[A-Za-z ]{1,32}" value="{{isset($userDetails->applicationBasicDetasils) ? $userDetails->applicationBasicDetasils->mother_name : old('mother_name')}}" required> @error('mother_name')
															<div class="text-danger">{{ $message }}</div>
															@enderror
														</div>
													</div>
													<div class="col-md-4">
														<div class="form-group">
															<label>18. Mother's Occupation/माता का व्यवसाय <span class="text-danger">*</span></label>
															<select class="form-select" name="mother_occuption" required>
																<option value="">Select/चयन करें</option>
																<option value='Government' {{ old('mother_occuption') === 'Private' ? 'selected' : '' }} @isset($userDetails->applicationBasicDetasils) @if ($userDetails->applicationBasicDetasils->mother_occuption == "Government") selected @endif @endisset >Government </option>
																<option value="Private" {{ old('mother_occuption') === 'Private' ? 'selected' : '' }} @isset($userDetails->applicationBasicDetasils) @if ($userDetails->applicationBasicDetasils->mother_occuption == "Private") selected @endif @endisset>Private</option>
																<option value="Business" {{ old('mother_occuption') === 'Business' ? 'selected' : '' }} @isset($userDetails->applicationBasicDetasils) @if ($userDetails->applicationBasicDetasils->mother_occuption == "Business") selected @endif @endisset>Business</option>
																<option value="House wife" {{ old('mother_occuption') === 'House wife' ? 'selected' : '' }} @isset($userDetails->applicationBasicDetasils) @if ($userDetails->applicationBasicDetasils->mother_occuption == "House wife") selected @endif @endisset>House wife</option>
																<option value="Other" {{ old('mother_occuption') === 'Other' ? 'selected' : '' }} @isset($userDetails->applicationBasicDetasils) @if ($userDetails->applicationBasicDetasils->mother_occuption == "Other") selected @endif @endisset>Other</option>
															</select>
															@error('mother_occuption')
															<div class="text-danger">{{ $message }}</div>
															@enderror
														</div>
													</div>
													<div class="col-md-4">
														<div class="form-group">
															<label class="placeholder">19. Height (in Centimetre)/लंबाई (सेंटीमीटर में) <span class="text-danger">*</span></label>
															<input type="text" class="form-control" name="height" maxlength="3" value="{{isset($userDetails->applicationBasicDetasils) ? $userDetails->applicationBasicDetasils->height : old('height')}}" required oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');">
															@error('height')
															<div class="text-danger">{{ $message }}</div>
															@enderror
														</div>
													</div>
													<div class="col-md-4">
														<div class="form-group">
															<label class="placeholder">20. Weight (in KG)/वजन (किलोग्राम में) <span class="text-danger">*</span></label>
															<input type="text" class="form-control" name="weight" maxlength="3" value="{{isset($userDetails->applicationBasicDetasils) ? $userDetails->applicationBasicDetasils->weight : old('weight')}}" required oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');"> @error('weight')
															<div class="text-danger">{{ $message }}</div>
															@enderror
														</div>
													</div>
													<div class="col-md-4">
														<div class="form-group">
															<label class="placeholder">21. Blood Group/ब्लड ग्रुप </label>
															<select class="form-select" name="blood_group">
																<option value="">Select/चयन करें</option>
																<option value='A+ve' {{ old('blood_group') === 'A+ve' ? 'selected' : '' }} @isset($userDetails->applicationBasicDetasils) @if ($userDetails->applicationBasicDetasils->blood_group == "A+ve") selected @endif @endisset >A+ve </option>
																<option value='A-ve' {{ old('blood_group') === 'A-ve' ? 'selected' : '' }} @isset($userDetails->applicationBasicDetasils) @if ($userDetails->applicationBasicDetasils->blood_group == "A-ve") selected @endif @endisset >A-ve </option>
																<option value="B+ve" {{ old('blood_group') === 'B+ve' ? 'selected' : '' }} @isset($userDetails->applicationBasicDetasils) @if ($userDetails->applicationBasicDetasils->blood_group == "B+ve") selected @endif @endisset>B+ve</option>
																<option value="B-ve" {{ old('blood_group') === 'B-ve' ? 'selected' : '' }} @isset($userDetails->applicationBasicDetasils) @if ($userDetails->applicationBasicDetasils->blood_group == "B-ve") selected @endif @endisset>B-ve</option>
																<option value="AB+ve" {{ old('blood_group') === 'AB+ve' ? 'selected' : '' }} @isset($userDetails->applicationBasicDetasils) @if ($userDetails->applicationBasicDetasils->blood_group == "AB+ve") selected @endif @endisset>AB+ve</option>
																<option value="AB-ve" {{ old('blood_group') === 'AB-ve' ? 'selected' : '' }} @isset($userDetails->applicationBasicDetasils) @if ($userDetails->applicationBasicDetasils->blood_group == "AB-ve") selected @endif @endisset>AB-ve</option>
																<option value="O+ve" {{ old('blood_group') === 'O+ve' ? 'selected' : '' }} @isset($userDetails->applicationBasicDetasils) @if ($userDetails->applicationBasicDetasils->blood_group == "O+ve") selected @endif @endisset>O+ve</option>
																<option value="O-ve" {{ old('blood_group') === 'O-ve' ? 'selected' : '' }}@isset($userDetails->applicationBasicDetasils) @if ($userDetails->applicationBasicDetasils->blood_group == "O-ve") selected @endif @endisset>O-ve</option>
															</select>
														</div>
													</div>
													<div class="col-md-4" id="class_for_which_admissionnn">
														<div class="form-group">
															<label class="placeholder">22. Class for which applicant is seeking admission/आवेदक किस कक्षा में प्रवेश चाह रहे हैं<span class="text-danger">*</span></label>
															<select class="form-select" name="class_for_which_admission" required id="class_for_which_admission">
																<option value="">Select/चयन करें</option>
																<option value='V' {{ old('class_for_which_admission') === 'V' ? 'selected' : '' }} @isset($userDetails->applicationBasicDetasils) @if ($userDetails->applicationBasicDetasils->class_for_which_admission == "V") selected @endif @endisset >V </option>
																<option value='VI' {{ old('class_for_which_admission') === 'VI' ? 'selected' : '' }} @isset($userDetails->applicationBasicDetasils) @if ($userDetails->applicationBasicDetasils->class_for_which_admission == "VI") selected @endif @endisset >VI </option>
																<option value='VII' {{ old('class_for_which_admission') === 'VII' ? 'selected' : '' }} @isset($userDetails->applicationBasicDetasils) @if ($userDetails->applicationBasicDetasils->class_for_which_admission == "VII") selected @endif @endisset >VII </option>
																<option value='VIII' {{ old('class_for_which_admission') === 'VIII' ? 'selected' : '' }} @isset($userDetails->applicationBasicDetasils) @if ($userDetails->applicationBasicDetasils->class_for_which_admission == "VIII") selected @endif @endisset >VIII </option>
																<option value='IX' {{ old('class_for_which_admission') === 'IX' ? 'selected' : '' }} @isset($userDetails->applicationBasicDetasils) @if ($userDetails->applicationBasicDetasils->class_for_which_admission == "IX") selected @endif @endisset >IX </option>
																<option value='X' {{ old('class_for_which_admission') === 'X' ? 'selected' : '' }} @isset($userDetails->applicationBasicDetasils) @if ($userDetails->applicationBasicDetasils->class_for_which_admission == "X") selected @endif @endisset >X </option>
																<option value='XI' {{ old('class_for_which_admission') === 'XI' ? 'selected' : '' }}@isset($userDetails->applicationBasicDetasils) @if ($userDetails->applicationBasicDetasils->class_for_which_admission == "XI") selected @endif @endisset >XI </option>
																<option value='XII' {{ old('class_for_which_admission') === 'XII' ? 'selected' : '' }} @isset($userDetails->applicationBasicDetasils) @if ($userDetails->applicationBasicDetasils->class_for_which_admission == "XII") selected @endif @endisset >XII </option>
															</select>
															@error('class_for_which_admission')
															<div class="text-danger">{{ $message }}</div>
															@enderror
														</div>
													</div>
												</div>
												<div class="bhoechie-footer">
													<div class="row justify-content-center">
														<div class="col-md-3 col-6 d-grid">
															<button type="submit" class="btn btn-info">Save & Next/दर्ज करें व आगे बढ़ें</button>
														</div>
														<div class="col-md-3 col-6 d-grid">
															<button type="reset" class="btn btn-light">Reset/रीसेट करें</button>
														</div>
													</div>
												</div>
											</div>
										</div>
									</form>
								</div>
								<div class="bhoechie-tab-content  @if ( $userDetails->level == 1 ) active @endif  @if ( $userDetails->level == 4  || $userDetails->level < 1) disabled @endif">
									<form action="{{route('hostel.applicationCommunicationForm')}}" class="needs-validation" novalidate method="post">
										@csrf
										<div class="form-scroll">
											<div class="nano-content">
												<div class="row">
													<div class="col-md-12">
														<h5 class="subheading">C. Permanent Address/स्थायी पता</h5>
													</div>
												</div>
												<div class="row">
													<div class="col-md-4">
														<div class="form-group">
															<label class="placeholder">1. Gram/Mohalla/ग्राम/मोहल्ला <span class="text-danger">*</span></label>
															<input type="text" class="form-control alphanumeric" name='p_gram_mohalla' id="p_gram_mohalla" required value="{{isset($userDetails->applicationCommunicationDetails) ? $userDetails->applicationCommunicationDetails->p_gram_mohalla : old('p_gram_mohalla')}}">
															@error('p_gram_mohalla')
															<div class="text-danger">{{ $message }}</div>
															@enderror
														</div>
													</div>
													<div class="col-md-4">
														<div class="form-group">
															<label class="placeholder">2. Post Office/डाक घर<span class="text-danger">*</span></label>
															<input type="text" class="form-control alphanumeric" name="p_post" id="p_post" required value="{{isset($userDetails->applicationCommunicationDetails) ? $userDetails->applicationCommunicationDetails->p_post : old('p_post')}}">
															@error('p_post')
															<div class="text-danger">{{ $message }}</div>
															@enderror
														</div>
													</div>
													<div class="col-md-4">
														<div class="form-group">
															<label class="placeholder">3. Thana/थाना <span class="text-danger">*</span></label>
															<input type="text" class="form-control alphanumeric" id="p_thana" name="p_thana" required value="{{isset($userDetails->applicationCommunicationDetails) ? $userDetails->applicationCommunicationDetails->p_thana : old('p_thana')}}">
															@error('p_thana')
															<div class="text-danger">{{ $message }}</div>
															@enderror
														</div>
													</div>
													<div class="col-md-4">
														<div class="form-group">
															<label class="placeholder">4. State/राज्य<span class="text-danger">*</span></label>

															<select class="form-select" name="p_state_id" id="p_state_id" required>
																<option value="">Select/चयन करें</option>
																<option value="23" selected {{ old('p_state_id') == '23' ? 'selected' : '' }} @isset($userDetails->applicationCommunicationDetails) @if ($userDetails->applicationCommunicationDetails->p_state_id == '23') selected @endif @endisset>UTTAR PRADESH</option>
															</select>
															@error('p_state_id')
															<div class="text-danger">{{ $message }}</div>
															@enderror

														</div>
													</div>
													<div class="col-md-4">
														<div class="form-group">
															<label class="placeholder">5. District/जनपद <span class="text-danger">*</span></label>
															<select class="form-select" name="p_district_id" id="p_district_id" required>
																<option value="">Select/चयन करें</option>
																@foreach ($districts as $district)
																<option value="{{$district->id}}" {{ old('p_district_id') == $district->id ? 'selected' : '' }} @isset($userDetails->applicationCommunicationDetails) @if ($userDetails->applicationCommunicationDetails->p_district_id == $district->id) selected @endif @endisset>{{$district->city}}</option>
																@endforeach


															</select>
															@error('p_district_id')
															<div class="text-danger">{{ $message }}</div>
															@enderror
														</div>
													</div>
													<div class="col-md-4">
														<div class="form-group">
															<label class="placeholder">6. Mobile No./मोबाइल नंबर <span class="text-danger">*</span></label>
															<input type="text" class="form-control" name="p_mobile" id="p_mobile" pattern="[6-9][0-9]{9}$" maxlength="10" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');" required readonly value="{{$userDetails->mobile}}">
															@error('p_mobile')
															<div class="text-danger">{{ $message }}</div>
															@enderror
														</div>
													</div>
													<div class="col-md-4">
														<div class="form-group">
															<label class="placeholder">7. Alternate Mobile No./वैकल्पिक मोबाइल नंबर</label>
															<input type="text" class="form-control" name="p_alt_mobile" id="p_alt_mobile" pattern="[6-9][0-9]{9}$" maxlength="10" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');" value="{{isset($userDetails->applicationCommunicationDetails) ? $userDetails->applicationCommunicationDetails->p_alt_mobile : old('p_alt_mobile')}}">
															@error('p_alt_mobile')
															<div class="text-danger">{{ $message }}</div>
															@enderror
														</div>
													</div>
													<div class="col-md-4">
														<div class="form-group">
															<label class="placeholder">8. Email ID/ईमेल आईडी </label>
															<input type="text" class="form-control" name="p_email" id="p_email" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,4}$" readonly value="{{$userDetails->email}}">
															@error('p_email')
															<div class="text-danger">{{ $message }}</div>
															@enderror
														</div>
													</div>
													<div class="col-md-4">
														<div class="form-group">
															<label class="placeholder">9. PIN Code/पिन कोड <span class="text-danger">*</span></label>
															<input type="number" class="form-control" name="p_pin" id="p_pin" min="100000" max="999999" required value="{{isset($userDetails->applicationCommunicationDetails) ? $userDetails->applicationCommunicationDetails->p_pin : old('p_pin')}}">
															@error('p_pin')
															<div class="text-danger">{{ $message }}</div>
															@enderror
														</div>
													</div>
												</div>
												<div class="row">
													<div class="col-md-12">
														<h5 class="subheading">D. Correspondence Address/पत्राचार हेतु पता<small><input type="checkbox" id="myCheck" onclick="myFunction()" />
																Same as above/उपरोक्त अनुसार</small></h5>
													</div>
												</div>
												<div class="row">
													<div class="col-md-4">
														<div class="form-group">
															<label class="placeholder">1. Gram/Mohalla/ग्राम/मोहल्ला <span class="text-danger">*</span></label>
															<input type="text" class="form-control alphanumeric" name="c_gram_mohalla" id="c_gram_mohalla" required value="{{isset($userDetails->applicationCommunicationDetails) ? $userDetails->applicationCommunicationDetails->c_gram_mohalla : old('c_gram_mohalla')}}">
															@error('c_gram_mohalla')
															<div class="text-danger">{{ $message }}</div>
															@enderror
														</div>
													</div>
													<div class="col-md-4">
														<div class="form-group">
															<label class="placeholder">2. Post Office/डाक घर <span class="text-danger">*</span></label>
															<input type="text" class="form-control alphanumeric" name="c_post" id="c_post" required value="{{isset($userDetails->applicationCommunicationDetails) ? $userDetails->applicationCommunicationDetails->c_post : old('c_post')}}">
															@error('c_post')
															<div class="text-danger">{{ $message }}</div>
															@enderror
														</div>
													</div>
													<div class="col-md-4">
														<div class="form-group">
															<label class="placeholder">3. Thana/थाना<span class="text-danger">*</span></label>
															<input type="text" class="form-control alphanumeric" id="c_thana" name="c_thana" required value="{{isset($userDetails->applicationCommunicationDetails) ? $userDetails->applicationCommunicationDetails->c_thana : old('c_thana')}}">
															@error('c_thana')
															<div class="text-danger">{{ $message }}</div>
															@enderror
														</div>
													</div>
													<div class="col-md-4">
														<div class="form-group">
															<label class="placeholder">4. State/राज्य <span class="text-danger">*</span></label>
															<select class="form-select" name="c_state_id" id="c_state_id" required>
																<option value>Select</option>

																@foreach ($stateAll as $state)
																<option value="{{$state->id}}" {{ old('c_state_id') == $state->id ? 'selected' : '' }} @isset($userDetails->applicationCommunicationDetails) @if ($userDetails->applicationCommunicationDetails->c_state_id == $state->id) selected @endif @endisset >{{$state->name}}</option>
																@endforeach

																@error('c_state_id')
																<div class="text-danger">{{ $message }}</div>
																@enderror
															</select>

														</div>
													</div>
													<div class="col-md-4">
														<div class="form-group">
															<label class="placeholder">5. District/जनपद <span class="text-danger">*</span></label>
															<select class="form-select" name="c_district_id" id="c_district_id" required>
																<option value="">Select/चयन करें</option>
																@foreach ($districtAll as $district)
																<option value="{{$district->id}}" {{ old('c_district_id') == $district->id ? 'selected' : '' }} @isset($userDetails->applicationCommunicationDetails) @if ($userDetails->applicationCommunicationDetails->c_district_id == $district->id) selected @endif @endisset >{{$district->city}}</option>
																@endforeach
															</select>

															@error('c_district_id')
															<div class="text-danger">{{ $message }}</div>
															@enderror
														</div>
													</div>
													<div class="col-md-4">
														<div class="form-group">
															<label class="placeholder">6. Mobile No./मोबाइल नंबर </label>
															<input type="text" class="form-control" name="c_mobile" pattern="[6-9][0-9]{9}$" maxlength="10" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');" id="c_mobile" readonly value="{{$userDetails->mobile}}">
															@error('c_mobile')
															<div class="text-danger">{{ $message }}</div>
															@enderror
														</div>
													</div>
													<div class="col-md-4">
														<div class="form-group">
															<label class="placeholder">7. Alternate Mobile No./वैकल्पिक मोबाइल नंबर</label>
															<input type="text" class="form-control" name="c_alt_mobile" id="c_alt_mobile" pattern="[6-9][0-9]{9}$" maxlength="10" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');" value="{{isset($userDetails->applicationCommunicationDetails) ? $userDetails->applicationCommunicationDetails->c_alt_mobile : old('c_alt_mobile')}}">
															@error('c_alt_mobile')
															<div class="text-danger">{{ $message }}</div>
															@enderror
														</div>
													</div>
													<div class="col-md-4">
														<div class="form-group">
															<label class="placeholder">8. Email ID/ईमेल आईडी <span class="text-danger">*</span></label>
															<input type="text" class="form-control" name="c_email" id="c_email" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,4}$" readonly value="{{$userDetails->email}}">
															@error('c_email')
															<div class="text-danger">{{ $message }}</div>
															@enderror
														</div>
													</div>
													<div class="col-md-4">
														<div class="form-group">
															<label class="placeholder">9. PIN Code/पिन कोड <span class="text-danger">*</span></label>
															<input type="number" class="form-control" name="c_pin" id="c_pin" min="100000" max="999999" required value="{{isset($userDetails->applicationCommunicationDetails) ? $userDetails->applicationCommunicationDetails->c_pin : old('c_pin')}}">
															@error('c_pin')
															<div class="text-danger">{{ $message }}</div>
															@enderror
														</div>
													</div>
												</div>
												<div class="bhoechie-footer">
													<div class="row justify-content-center">
														<div class="col-md-3 col-6 d-grid">
															<button type="submit" class="btn btn-info">Save and Next/दर्ज करें व आगे बढ़ें</button>
														</div>
														<div class="col-md-3 col-6 d-grid">
															<button type="reset" class="btn btn-light">Reset/रीसेट करें</button>
														</div>
													</div>
												</div>
											</div>
										</div>
									</form>
								</div>
								<div class="bhoechie-tab-content @if ( $userDetails->level == 2 ) active @endif   @if ($userDetails->level == 4  || $userDetails->level < 2) disabled @endif">
									<form action="{{route('hostel.applicationQualificationForm')}}" method="post" id="applicationQualificationForm" class="needs-validation" novalidate>
										@csrf
										<div class="form-scroll">
											<div class="nano-content">
												<div class="row">
													<div class="col-md-12">
														<h5 class="subheading">E. Educational Qualification Details/शैक्षणिक योग्यता विवरण</h5>
													</div>
													<div class="col-md-3">
														<div class="form-group">
															<label>1. Previous Class/पूर्व कक्षा <span class="text-danger">*</span></label>
															<select class="form-select" name="class" required>
																<option value="">Select/चयन करें</option>
																<option value="IV" {{ old('class') == "IV" ? 'selected' : '' }} @isset($userDetails->applicationQualificationDetails) @if ($userDetails->applicationQualificationDetails->class == "IV") selected @endif @endisset >IV</option>
																<option value="V" {{ old('class') == "V" ? 'selected' : '' }} @isset($userDetails->applicationQualificationDetails) @if ($userDetails->applicationQualificationDetails->class == "V") selected @endif @endisset >V</option>

																<option value="VI" {{ old('class') == "VI" ? 'selected' : '' }} @isset($userDetails->applicationQualificationDetails) @if ($userDetails->applicationQualificationDetails->class == "VI") selected @endif @endisset >VI</option>
																<option value="VII" {{ old('class') == "VII" ? 'selected' : '' }} @isset($userDetails->applicationQualificationDetails) @if ($userDetails->applicationQualificationDetails->class == "VII") selected @endif @endisset >VII</option>
																<option value="VIII" {{ old('class') == "VIII" ? 'selected' : '' }} @isset($userDetails->applicationQualificationDetails) @if ($userDetails->applicationQualificationDetails->class == "VIII") selected @endif @endisset >VIII</option>
																<option value="IX" {{ old('class') == "IX" ? 'selected' : '' }} @isset($userDetails->applicationQualificationDetails) @if ($userDetails->applicationQualificationDetails->class == "IX") selected @endif @endisset >IX</option>
																<option value="X Higher Secondary" {{ old('class') == "X Higher Secondary"? 'selected' : '' }} @isset($userDetails->applicationQualificationDetails) @if ($userDetails->applicationQualificationDetails->class == "X Higher Secondary") selected @endif @endisset >X Higher Secondary</option>
																<option value="XI" {{ old('class') == "XI"? 'selected' : '' }} @isset($userDetails->applicationQualificationDetails) @if ($userDetails->applicationQualificationDetails->class == "XI") selected @endif @endisset >XI</option>
																<option value="XII Senior Secondary" {{ old('class') == "XII Senior Secondary" ? 'selected' : '' }} @isset($userDetails->applicationQualificationDetails) @if ($userDetails->applicationQualificationDetails->class == "XII Senior Secondary") selected @endif @endisset >XII Senior Secondary</option>
															</select>
															@error('class')
															<div class="text-danger">{{ $message }}</div>
															@enderror
														</div>
													</div>
													<div class="col-md-3">
														<div class="form-group">
															<label>2. Passed Out from School/College/स्कूल/कॉलेज से उत्तीर्ण<span class="text-danger">*</span></label>
															<input id="Text3" name="school_college" type="text" class="form-control alphanumeric" required value="{{isset($userDetails->applicationQualificationDetails) ? $userDetails->applicationQualificationDetails->school_college : old('school_college')}}">
														</div>
													</div>
													<div class="col-md-3">
														<div class="form-group">
															<label>3. Year of Passing/उत्तीर्ण होने का वर्ष <span class="text-danger">*</span></label>
															<select class="form-select" name="passing_year" required>
																<option value="">Select/चयन करें</option>
																@for ($i = date( "Y"); $i > 1990; $i--) <option value="{{$i}}" {{ old('passing_year') == $i ? 'selected' : '' }} @isset($userDetails->applicationQualificationDetails) @if ($userDetails->applicationQualificationDetails->passing_year == $i) selected @endif @endisset >{{$i}}</option>
																@endfor

															</select>

															@error('year')
															<div class="text-danger">{{ $message }}</div>
															@enderror
														</div>
													</div>
													<div class="col-md-3">
														<div class="form-group">
															<label>4. Obtained Marks/प्राप्त अंक <span class="text-danger">*</span></label>
															<input id="Text1" name="obtain_mark" type="type" class="form-control" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');" required value="{{isset($userDetails->applicationQualificationDetails) ? $userDetails->applicationQualificationDetails->obtain_mark : old('obtain_mark')}}">
															@error('obtain_mark')
															<div class="text-danger">{{ $message }}</div>
															@enderror
														</div>
													</div>
													<div class="col-md-3">
														<div class="form-group">
															<label>5. Maximum Marks/अधिकतम अंक <span class="text-danger">*</span></label>
															<input id="Text2" name="total_mark" onblur="Marks()" type="type" class="form-control" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');" required value="{{isset($userDetails->applicationQualificationDetails) ? $userDetails->applicationQualificationDetails->total_mark : old('total_mark')}}">
															@error('total_mark')
															<div class="text-danger">{{ $message }}</div>
															@enderror
														</div>
													</div>

													<div class="col-md-3">
														<div class="form-group">
															<label>6. Result /परीक्षाफल <span class="text-danger">*</span></label>
															<input id="Text2" name="result" type="type" maxlength="20" minlength="1" class="form-control" required value="{{isset($userDetails->applicationQualificationDetails) ? $userDetails->applicationQualificationDetails->result : old('result')}}">
															@error('result')
															<div class="text-danger">{{ $message }}</div>
															@enderror
														</div>
													</div>

												</div>
												<div class="bhoechie-footer">
													<div class="row justify-content-center">
														<div class="col-md-3 col-6 d-grid">
															<button type="submit" class="btn btn-info">Save and Next/दर्ज करें व आगे बढ़ें</button>
														</div>
														<div class="col-md-3 col-6 d-grid">
															<button type="reset" class="btn btn-light">Reset/रीसेट करें</button>
														</div>
													</div>
												</div>
											</div>
										</div>
									</form>
								</div>
								<div class="bhoechie-tab-content @if ( $userDetails->level == 3 ) active @endif   @if ($userDetails->level == 4  || $userDetails->level < 3) disabled @endif  @if ( $userDetails->level == 4) active @endif">
									<form action="{{route('hostel.applicationPreviewForm')}}" method="POST" enctype="multipart/form-data" class="needs-validation" novalidate>
										@csrf
										<div class="form-scroll">
											<div class="nano-content">
												<div id="prodiv">
													<div class="table-responsive">
														<table class="dn" style="width: 100%; margin-bottom: 5px;" border="0">
															<tbody>
																<tr>
																	<td colspan="2" align="center" style="position: relative; border: 0; padding-bottom: 5px;">
																		<div style="border-bottom: 0px solid #000; ">
																			<img src="{{ url('admin') }}/images/logo.png" style="position: absolute; width: 70px; top: 5px; left: 0;">
																			<div style="font-size: 25px; font-weight: bold;">
																				Department of Sports
																			</div>
																			<div style="font-size: 18px; font-weight: bold;">
																				GOVERNMENT OF UTTAR PRADESH
																			</div>
																			<div style="font-size: 18px; font-weight: bold;">
																				Application Form for Hostel Admission
																			</div>
																			<div style="font-size: 18px; font-weight: bold;">
																				{{$userDetails->created_at->format('Y') . '-' . ($userDetails->created_at->year + 1)}}

																			</div>
																		</div>
																	</td>
																</tr>
																<tr>
																	<td style="text-align: left; font-size: 12px; padding-top: 5px;"></td>
																	<td style="text-align: right; font-size: 12px; padding-top: 5px;"><b>Print Date :</b> {{ Carbon\Carbon::parse(date('Y-m-d') )->format('d/m/Y') }}</td>
																</tr>
															</tbody>
														</table>
													</div>
													<table id="dataTable" class="table table-bordered" border="1">
														<tr>
															<th colspan="6" style="color: #9e134c;font-size: 15px;" class="bg-light">Basic Details/सामान्य विवरण</th>
														</tr>
														<tr>
															<td colspan="6"><strong style="color: #14bb6d;">A. Registration Details/पंजीकरण संबंधी विवरण</strong></td>
														</tr>
														<tr>
															<td><strong>1.Application no.&rsquo;s Name/आवेदक का नाम</strong></td>
															<td>@if ($userDetails->application_no)
																{{$userDetails->application_no}}
																@else
																NA
																@endif
															</td>
															<td><strong>2. Applicant&rsquo;s Name/आवेदक का नाम</strong></td>
															<td>{{$userDetails->name}} </td>
															<td rowspan="7" colspan="2"><b>Photograph of Applicant/आवेदक का फोटो</b><br />
																<div class="text-center"> <img src="{{url('public/hostelapplicant/applicant_file/')}}/@isset($userDetails->applicationBasicDetasils){{$userDetails->applicationBasicDetasils->applicant_file}} @endisset" class="img-fluid" style="width: 140px;" /> </div>
															</td>
														</tr>
														<tr>
															<td><strong>3. Date of Birth/जन्मतिथि </strong></td>
															<td>{{ dmy($userDetails->dob) }}</td>
															<td><strong>4. Aadhaar Number/आधार नंबर</strong></td>
															<td>{{$userDetails->aadhar}}</td>
														</tr>
														<tr>
															<td><strong>Aadhar Card/आधार कार्ड</strong></td>
															<td><a href="{{url('public/hostelapplicant/aadhar_card_file/')}}/@isset($userDetails->applicationBasicDetasils){{$userDetails->applicationBasicDetasils->aadhar_card_file}} @endisset" class="btn btn-success btn-xs" target="_blank">Uploaded/अपलोड किए गए</a></td>
															<td><strong>5. Mobile Number/मोबाइल नंबर</strong></td>
															<td>{{$userDetails->mobile}}</td>
														</tr>
														<tr>
															<td><strong>6. Email ID/ईमेल आईडी </strong></td>
															<td>{{$userDetails->email}}</td>
															<td><strong>6. State/राज्य</strong></td>
															<td>Uttar Pradesh</td>
														</tr>
														<tr>
															<td><strong>7. Gender/लिंग</strong></td>
															<td>@if ($userDetails->gender == 1)
																Male
																@else
																Female
																@endif</td>
															@isset($userDetails->applicationBasicDetasils)
															<td><strong>8. Are you existing student of Sports College?</strong></td>
															<td>@if ($userDetails->existing_student == 1)
																Yes
																@else
																No
																@endif</td>
															@endisset
														</tr>
														<tr>
															@isset($userDetails->applicationBasicDetasils) @if ($userDetails->applicationBasicDetasils->admission_no)
															<td><strong>9. Admission No.</strong></td>
															<td>
																{{ $userDetails->applicationBasicDetasils->admission_no}}
															</td>
															@endif
															@if ($userDetails->applicationBasicDetasils->roll_no)
															<td><strong>10. Roll No.</strong></td>
															<td>
																{{ $userDetails->applicationBasicDetasils->roll_no}}
															</td>
															@endif
															@endisset
														</tr>
														<tr>
															@isset($userDetails->applicationBasicDetasils)
															@if ($userDetails->applicationBasicDetasils->student_id_card)
															<td><strong>11. Student Id Card</strong></td>
															<td><a href="{{url('public/hostelapplicant/student_id_card/')}}/@isset($userDetails->applicationBasicDetasils){{$userDetails->applicationBasicDetasils->student_id_card}} @endisset" class="btn btn-success btn-xs" target="_blank">Uploaded/अपलोड किए गए</a></td>
															@endif
															@endisset
															@isset($userDetails->applicationBasicDetasils)
															@if ($userDetails->applicationBasicDetasils->sports_college)
															<td><strong>12. Sports College</strong></td>
															<td>{{$userDetails->applicationBasicDetasils->sports_college}} </td>
															@endif
															@endisset
														</tr>
														<tr>
															@isset($userDetails->applicationBasicDetasils)
															@if ($userDetails->applicationBasicDetasils->national_champtionship_document)
															<td><strong>13. Student Id Card</strong>
															<td><a href="{{url('public/hostelapplicant/national_champtionship_document/')}}/@isset($userDetails->applicationBasicDetasils){{$userDetails->applicationBasicDetasils->national_champtionship_document}} @endisset" class="btn btn-success btn-xs" target="_blank">Uploaded/अपलोड किए गए</a></td>
															</td>
															@endif
															@endisset
														</tr>
														<td colspan="6"><strong style="color: #14bb6d;">B. Applicant’s Details/आवेदक का विवरण</strong></td>
														</tr>
														<tr>
															<td><strong>1. District/जनपद </strong></td>
															<td> @isset($userDetails->applicationBasicDetasils){{$userDetails->applicationBasicDetasils->district->city}} @endisset</td>
															<td><strong>2. Regional/District Sports Office/क्षेत्रीय खेल कार्यालय</strong></td>
															<td> @isset($userDetails->applicationBasicDetasils->region_sport_office_id){{regionsportname($userDetails->applicationBasicDetasils->region_sport_office_id)}} @endisset</td>
														</tr>
														<tr>
															<td><strong>3. Sports Name /खेल का नाम</strong></td>
															<td> @isset($userDetails->applicationBasicDetasils){{sport_name_hostel($userDetails->applicationBasicDetasils->sports)}} @endisset</td>
															<td><strong>4. Category/वर्ग</strong></td>
															<td> @isset($userDetails->applicationBasicDetasils){{$userDetails->applicationBasicDetasils->category}} @endisset </td>
														</tr>
														<tr>
															<td><strong>5. Sub Category/उपश्रेणी</strong></td>
															<td> @isset($userDetails->applicationBasicDetasils){{$userDetails->applicationBasicDetasils->sub_category}} @endisset </td>
															<td><strong>6. Father&rsquo;s Name/पिता का नाम </strong></td>
															<td>@isset($userDetails->applicationBasicDetasils){{$userDetails->applicationBasicDetasils->father_name}} @endisset </td>
															<td rowspan="2" colspan="2"><b>Signature of Applicant/आवेदक के हस्ताक्षर</b><br />
																<div class="text-center"> <img src="{{url('public/hostelapplicant/applicant_sign/')}}/@isset($userDetails->applicationBasicDetasils){{$userDetails->applicationBasicDetasils->applicant_sign}} @endisset" class="img-fluid" style="width: 140px;" /> </div>
															</td>
														</tr>
														<tr>
															<td><strong>7. Father's Occupation/पिता का व्यवसाय </strong></td>
															<td>@isset($userDetails->applicationBasicDetasils) {{$userDetails->applicationBasicDetasils->father_occuption}} @endisset </td>
															<td><strong>8. Mother&rsquo;s Name/माता का नाम</strong></td>
															<td>@isset($userDetails->applicationBasicDetasils) {{$userDetails->applicationBasicDetasils->mother_name}} @endisset</td>
														</tr>
														<tr>
															<td style="width: 15%"><strong>9. Mother's Occupation/माता का व्यवसाय</strong></td>
															<td style="width: 20%">@isset($userDetails->applicationBasicDetasils) {{$userDetails->applicationBasicDetasils->mother_occuption}} @endisset</td>
															<td style="width: 15%"><strong>10. Height (in Centimetre)/लंबाई (सेंटीमीटर में)</strong></td>
															<td style="width: 20%">@isset($userDetails->applicationBasicDetasils) {{$userDetails->applicationBasicDetasils->height}} @endisset</td>
															<td style="width: 15%"><strong>11. Weight (in KG)/वजन (किलोग्राम में)</strong></td>
															<td style="width: 15%">@isset($userDetails->applicationBasicDetasils) {{$userDetails->applicationBasicDetasils->weight}} @endisset</td>
														</tr>
														<tr>
															<td><strong>12. Blood Group/ब्लड ग्रुप</strong></td>
															<td>@isset($userDetails->applicationBasicDetasils) {{$userDetails->applicationBasicDetasils->blood_group}} @endisset</td>
															<td><strong>13. Class for which applicant is seeking admission/आवेदक किस कक्षा में प्रवेश चाह रहे हैं</strong></td>
															<td>@isset($userDetails->applicationBasicDetasils) {{$userDetails->applicationBasicDetasils->class_for_which_admission}} @endisset</td>
															<td><b>Domicile of Uttar Pradesh/उत्तर प्रदेश का मूल निवासी</b></td>
															<td> Uttar Pradesh/उत्तर प्रदेश </td>
														</tr>
														<tr>
															<td><strong>Upload Domicile Certificate/निवास प्रमाणपत्र अपलोड करें </strong></td>
															<td><a href="{{url('public/hostelapplicant/applicant_domicle/')}}/@isset($userDetails->applicationBasicDetasils){{$userDetails->applicationBasicDetasils->applicant_domicle}} @endisset" class="btn btn-success btn-xs" target="_blank">Uploaded/अपलोड किए गए</a></td>
															<td><strong>Visible Identification Mark/दृश्यमान पहचान चिह्न</strong></td>
															<td>@isset($userDetails->applicationBasicDetasils) {{$userDetails->applicationBasicDetasils->identification_mark}} @endisset</td>
															<td><strong>Number of Teeth/दांतों की संख्या</strong></td>
															<td>@isset($userDetails->applicationBasicDetasils) {{$userDetails->applicationBasicDetasils->number_of_teeth}} @endisset</td>
														</tr>
														<tr>
															<td><strong>DOB certificate certified by School/registrar</strong></td>
															<td><a href="{{url('public/hostelapplicant/applicant_dob_certificate/')}}/@isset($userDetails->applicationBasicDetasils){{$userDetails->applicationBasicDetasils->applicant_dob_certificate}} @endisset" class="btn btn-success btn-xs" target="_blank">Uploaded/अपलोड किए गए</a></td>
															<td><strong>Is applicant suffering from Skin Disease/Fits/Other Disease? /क्या आवेदक त्वचा रोग/फिट्स/अन्य रोग से ग्रसित हैं? </strong></td>
															<td>@isset($userDetails->applicationBasicDetasils) {{$userDetails->applicationBasicDetasils->disease}} @endisset</td>
															<td><strong>Upload Medical Certificate/चिकित्सकीय प्रमाणपत्र अपलोड करें</strong></td>
															@if(isset($userDetails->applicationBasicDetasils) && $userDetails->applicationBasicDetasils->medical_certificate_file)
															<td><a href="{{url('public/hostelapplicant/medical_certificate_file/')}}/@isset($userDetails->applicationBasicDetasils){{$userDetails->applicationBasicDetasils->medical_certificate_file}} @endisset" class="btn btn-success btn-xs" target="_blank">Uploaded/अपलोड किए गए</a></td>
															@else
															<td>N/A</td>
															@endif
														</tr>
														<tr>
															<td><strong>Sub Sport</strong></td>
															<td colspan="5">@isset($userDetails->applicationBasicDetasils) @if($userDetails->applicationBasicDetasils->sub_sport_type){{sub_sport_name($userDetails->applicationBasicDetasils->sub_sport_type)}} @else NA @endif @endisset</td>
														</tr>
														<tr>
															<th colspan="6" style="color: #9e134c;font-size: 15px;" class="bg-light">Communication Details/संचार विवरण </th>
														</tr>
														<tr>
															<td colspan="6"><strong style="color: #14bb6d;">C. Permanent Address/स्थायी पता</strong></td>
														</tr>
														<tr>
															<td><strong>1. Gram/Mohalla/ग्राम/मोहल्ला</strong></td>
															<td>@isset($userDetails->applicationCommunicationDetails){{$userDetails->applicationCommunicationDetails->p_gram_mohalla}} @endisset</td>
															<td><strong>2. Post Office/डाक घर</strong></td>
															<td>@isset($userDetails->applicationCommunicationDetails){{$userDetails->applicationCommunicationDetails->p_post}} @endisset</td>
															<td><strong>3. Thana/थाना </strong></td>
															<td>@isset($userDetails->applicationCommunicationDetails){{$userDetails->applicationCommunicationDetails->p_thana}} @endisset</td>
														</tr>
														<tr>
															<td><strong>4. State/राज्य</strong></td>
															<td>@isset($userDetails->applicationCommunicationDetails){{$userDetails->applicationCommunicationDetails->pstate->name}} @endisset</td>
															<td><strong>5. District/जनपद</strong></td>
															<td>@isset($userDetails->applicationCommunicationDetails){{$userDetails->applicationCommunicationDetails->pdistrict->city}} @endisset</td>
															<td><strong>6. Mobile No./मोबाइल नंबर </strong></td>
															<td>@isset($userDetails->applicationCommunicationDetails){{$userDetails->applicationCommunicationDetails->p_mobile}} @endisset</td>
														</tr>
														<tr>
															<td><strong>7. Alternate Mobile No./वैकल्पिक मोबाइल नंबर</strong></td>
															<td>@isset($userDetails->applicationCommunicationDetails){{$userDetails->applicationCommunicationDetails->p_alt_mobile}} @endisset</td>
															<td><strong>8. Email ID/ईमेल आईडी</strong></td>
															<td>@isset($userDetails->applicationCommunicationDetails){{$userDetails->applicationCommunicationDetails->p_email}} @endisset</td>
															<td><strong>9. PIN Code/पिन कोड</strong></td>
															<td>@isset($userDetails->applicationCommunicationDetails){{$userDetails->applicationCommunicationDetails->p_pin}} @endisset</td>
														</tr>
														<tr>
															<td colspan="6"><strong style="color: #14bb6d;">D. Correspondence Address/पत्राचार हेतु पता</strong></td>
														</tr>
														<tr>
															<td><strong>1. Gram/Mohalla/ग्राम/मोहल्ला</strong></td>
															<td>@isset($userDetails->applicationCommunicationDetails){{$userDetails->applicationCommunicationDetails->c_gram_mohalla}} @endisset</td>
															<td><strong>2. Post Office/डाक घर</strong></td>
															<td>@isset($userDetails->applicationCommunicationDetails){{$userDetails->applicationCommunicationDetails->c_post}} @endisset</td>
															<td><strong>3. Thana/थाना</strong></td>
															<td>@isset($userDetails->applicationCommunicationDetails){{$userDetails->applicationCommunicationDetails->c_thana}} @endisset</td>
														</tr>
														<tr>
															<td><strong>4. State/राज्य </strong></td>
															<td>@isset($userDetails->applicationCommunicationDetails){{$userDetails->applicationCommunicationDetails->cstate->name}} @endisset</td>
															<td><strong>5. District/जनपद</strong></td>
															<td>@isset($userDetails->applicationCommunicationDetails){{$userDetails->applicationCommunicationDetails->cdistrict->city}} @endisset</td>
															<td><strong>6. Mobile No./मोबाइल नंबर</strong></td>
															<td>@isset($userDetails->applicationCommunicationDetails){{$userDetails->applicationCommunicationDetails->c_mobile}} @endisset</td>
														</tr>
														<tr>
															<td><strong>7. Alternate Mobile No./वैकल्पिक मोबाइल नंबर</strong></td>
															<td>@isset($userDetails->applicationCommunicationDetails){{$userDetails->applicationCommunicationDetails->c_alt_mobile}} @endisset</td>
															<td><strong>8. Email ID/ईमेल आईडी</strong></td>
															<td>@isset($userDetails->applicationCommunicationDetails){{$userDetails->applicationCommunicationDetails->c_email}} @endisset</td>
															<td><strong>9. PIN Code/पिन कोड</strong></td>
															<td>@isset($userDetails->applicationCommunicationDetails){{$userDetails->applicationCommunicationDetails->c_pin}} @endisset</td>
														</tr>
														<tr>
															<td colspan="6" style="color: #9e134c;font-size: 15px;" class="bg-light"><strong>Educational Qualification/शैक्षणिक योग्यता </strong>
															</td>
														</tr>
														<tr>
															<td><strong>1. Previous Class/पूर्व कक्षा</strong></td>
															<td>@isset($userDetails->applicationQualificationDetails){{$userDetails->applicationQualificationDetails->class}} @endisset</td>
															<td><strong>2. Passed Out from School/College/स्कूल/कॉलेज से उत्तीर्ण</strong></td>
															<td>@isset($userDetails->applicationQualificationDetails){{$userDetails->applicationQualificationDetails->school_college}} @endisset</td>
															<td><strong>3. Year of Passing/उत्तीर्ण होने का वर्ष</strong></td>
															<td>@isset($userDetails->applicationQualificationDetails){{$userDetails->applicationQualificationDetails->passing_year}} @endisset</td>
														</tr>
														<tr>
															<td><strong>4. Obtained Marks/प्राप्त अंक </strong></td>
															<td>@isset($userDetails->applicationQualificationDetails){{$userDetails->applicationQualificationDetails->obtain_mark}} @endisset</td>
															<td><strong>5. Maximum Marks/अधिकतम अंक</strong></td>
															<td>@isset($userDetails->applicationQualificationDetails){{$userDetails->applicationQualificationDetails->total_mark}} @endisset</td>
															<td><strong>6. Result /परीक्षाफल</strong></td>
															<td>@isset($userDetails->applicationQualificationDetails){{$userDetails->applicationQualificationDetails->result}} @endisset</td>
														</tr>
														{{-- <?php if ($userDetails->payment_status == 1 || $userDetails->payment_status == 2 || $userDetails->payment_status == 3) { ?>
															<tr>
																<td colspan="6"  style="color: #9e134c;font-size: 15px;" class="bg-light"><strong>Payment Details/भुगतान विवरण
															</tr>
															<tr>
																<td>
																	<b>Challan No</b>
																</td>
																<td>@isset($userDetails->unique_chalan_no){{$userDetails->unique_chalan_no}} @endisset</td>
														<td>
															<b>Bank Name</b>
														</td>
														<td>State Bank Of India</td>
														<td>
															<b>Branch Name</b>
														</td>
														<td>@isset($userDetails->branch_name){{$userDetails->branch_name}} @endisset</td>
														</tr>
														<tr>
															<td><b>Payment District</b></td>
															<td>@isset($userDetails->payment_district){{districtName($userDetails->payment_district)}} @endisset</td>
															<td><b>Payment Date</b></td>
															<td>@isset($userDetails->payment_date){{date('d-m-Y',strtotime($userDetails->payment_date))}} @endisset</td>
															<td><b>Amount</b></td>
															<td>@isset($userDetails->paid_amount)Rs.{{$userDetails->paid_amount}} @endisset</td>
														</tr>
														<tr>
															<td><b>Payment Varification</b></td>
															<td>
																<?php if ($userDetails->payment_status == 1) { ?>
																	<a href="javascript:void(0)" class="btn btn-warning btn-xs  disabled">Pending</a>
																<?php } ?>
																<?php if ($userDetails->payment_status == 2) { ?>
																	<a href="javascript:void(0)" class="btn btn-success btn-xs  disabled">Accepted</a>
																<?php } ?>
																<?php if ($userDetails->payment_status == 3) { ?>
																	<a href="javascript:void(0)" class="btn btn-danger btn-xs  disabled">Rejected</a>
																<?php } ?>
															</td>
															<td><b>Challan Copy</b></td>
															<td><a href="{{url('public/hostelapplicant/payment_receipt/')}}/@isset($userDetails->payment_receipt){{$userDetails->payment_receipt}} @endisset" class="btn btn-success btn-xs" target="_blank">Uploaded</a></td>
														</tr>
													<?php } ?> --}}
													</table>
													<div class="row px-2 justify-content-center noprint">
														<div class="col-md-12 bg-light mb-3">
															<h5 class="subheading2 mb-0">Declaration/घोषणा</h5>
														</div>
														<div class="col-md-12">
															<p>I declare that the above particulars are true to the best of my knowledge. If any of my facts are found to be wrong, my admission should be cancelled, for which all responsibility will be mine. I have read all the facts thoroughly and after admission I will strictly follow the hostel rules.</p>
															<p>मैं घोषणा करता/करती हूं कि उपरोक्त विवरण मेरी सर्वोत्तम जानकारी के अनुसार सत्य हैं। यदि मेरा कोई भी तथ्य गलत पाया जाये तो मेरा प्रवेश निरस्त कर दिया जाये, जिसकी समस्त जिम्मेदारी मेरी होगी। मैंने सभी तथ्यों को अच्छी तरह से पढ़ लिया है और प्रवेश के बाद मैं छात्रावास के नियमों का सख्ती से पालन करूंगा।</p>
														</div>
														<div class="col-md-12 text-center mb-3">
															<h5>
																<input class="form-check-input" type="checkbox" name="confirm" value="1" @if ( $userDetails->level == 4) disabled @endif @isset($userDetails->applicationPreviewDetails) @if ($userDetails->applicationPreviewDetails->confirm == "1") checked @endif @endisset required> &nbsp; <b>I Agree / मैं सहमत हूं <span class="text-danger">*</span></b>
															</h5>
														</div>
														<div class="col-md-4">
															<label>Guardian Full Name/अभिभावक का पूरा नाम <span class="text-danger">*</span></label>
															<input type="text" class="form-control" name="guardian_name" pattern="[A-Za-z ]{1,32}" value="{{isset($userDetails->applicationPreviewDetails) ? $userDetails->applicationPreviewDetails->guardian_name : old('guardian_name')}}" @if ( $userDetails->level == 4) disabled @endif required>
														</div>
														<div class="col-md-4">
															<div class="form-group">
																<label class="placeholder">Guardian Signature/अभिभावक के हस्ताक्षर<span class="text-danger">*</span></label>
																<div class="input-group">
																	<input type="file" class="form-control" name="guardian_sign" onchange="getfileext11(this.value,20)" id="File20" {{isset($userDetails->applicationPreviewDetails) ? '' : 'required'}} @if ( $userDetails->level == 4) disabled @endif >
																	@isset($userDetails->applicationPreviewDetails)<a href="{{url('public/hostelapplicant/guardian_sign')}}/{{$userDetails->applicationPreviewDetails->guardian_sign}}" class="btn btn-secondary" target="_blank" id="A1">View/देखे</a> @endisset
																	@error('guardian_sign')
																	<div class="text-danger">{{ $message }}</div>
																	@enderror
																</div>
																<span class="note">File Format/फाइल का प्रारूप: JPEG/JPG | Max File Size/फाइल का अधिकतम साइज़: 2 MB</span>
															</div>
														</div>
													</div>
												</div>
											</div>
										</div>
										<div class="bhoechie-footer">
											<div class="row  justify-content-center">
												@if ( $userDetails->level != 4)
												<div class="col-md-3 col-6 d-grid">
													<button type="submit" class="btn btn-info">Final Submit/अंतिम रूप से दर्ज करें</button>
												</div>
												@else
												<div class="col-md-3 col-6 d-grid">
													<button onclick="PrintDoc()" class="btn btn-light">Preview in PDF/पीडीएफ में पूर्वावलोकन करें</button>
												</div>
												@endif
											</div>
										</div>
										@if ($mark_query->count() > 0)
										<div class="noprint">
											<h3 class="bg-light"> Details of Queries </h3>
											<div class="table-responsive">
												<table class="table table-bordered" border="1" style="border-collapse: collapse; width: 100%;" id="query-form-marked-table">
													<thead>
														<tr>
															<th>S.No.</th>
															<th>Subject</th>
															<th>Query Details</th>
															<th>Query Related Document</th>
														</tr>
													</thead>
													<tbody>
														@foreach ($mark_query as $key=>$item)
														<tr>
															<td>
																{{$key + 1}}
															</td>
															<td>
																{{$item->query_subject}}
															</td>
															<td>
																{{$item->query_details}}
															</td>
															<td>
																@if($item->query_doc!='')
																@php
																$img = url('public/queryDoc').'/'.$item->query_doc;
																$img1 = url('public/images/images.svg');
																$doc = explode('.',$item->query_doc);
																if($doc[1]=='pdf')
																$img1 = url('public/images/pdf.svg');
																@endphp
																<a href="{{url('public/queryDoc')}}/{{$item->query_doc}}" class="btn btn-success btn-sm" data-bs-toggle="modal" target="_blank">View</a>
																@endif
															</td>







														</tr>
														@endforeach

													</tbody>

												</table>
											</div>
										</div>
										@endif
									</form>
								</div>
							</div>
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
					<li>Copyright &copy; Department of Sports</li>
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
	@foreach ($mark_query as $key=>$item)
	<div class="modal fade" id="query_marked_reply{{$item->id}}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
		<div class="modal-dialog modal-lg">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="exampleModalLabel">Reply Query</h5>
					<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
				</div>
				<form action="{{route('query_hostel_reply_user')}}" method="post" enctype="multipart/form-data" class="directMarkQuery needs-validation" novalidate>
					@csrf
					<div class="card">
						<div class="card-body">
							<div class="col-90">
								<div class="form-group">
									<input type="hidden" name="queryIdReply" id="queryIdReply" value="{{$item->id}}">



									<label class="placeholder">Details <span class="text-danger">*</span></label>
									<textarea class="form-control" name="is_mark_query_reply alphanumeric" id="is_mark_query_reply" cols="95" rows="2" required></textarea>

									<label>Documents</label>
									<div class="input-group">
										<input type="file" name="query_doc" class="query_doc_image_reply form-control" onchange="getfileext(this.value,10)" id="File10" aria-describedby="inputGroupFileAddon05" aria-label="Upload">
									</div>
									<span class="note">File Format/फाइल का प्रारूप: JPEG/JPG | Max File Size/फाइल का अधिकतम साइज़: 2 MB</span>

									<br>
									<button type="button" class="btn btn-info mt-2" data-bs-dismiss="modal">Back</button>
									<button type="submit" class="btn btn-success mt-2">Reply</button>
								</div>
							</div>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
	@endforeach
	@foreach ($mark_query as $key=>$item)
	<div class="modal fade" id="query_marked_detail{{$item->id}}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
		<div class="modal-dialog modal-lg">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="exampleModalLabel">Query Details</h5>
					<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
				</div>
				<table id="dataTable" class="table table-bordered" border="1" style="border-collapse: collapse; width: 100%;">
					<thead>
						<tr>
							<th>S.No.</th>
							<th>Details</th>
							<th>Document</th>
							<th>Date</th>
							<th>Reply </th>
						</tr>
					</thead>

					<tbody>
						@foreach ($item->queryReplies as $key=>$reply)


						<tr>
							<td>
								{{$key + 1}}
							</td>
							<td>
								{{$reply->reply}}
							</td>
							<td>
								<a href="<?= url('public/queryDoc') . '/' . $reply->reply_doc; ?>" target="_blank">
									<div class="btn btn-success">Document</div>
								</a>
							</td>

							<td><?= dmy($reply->trans_date); ?></td>

							<td>
								@if($reply->reply_type == 1)
								Admin

								@else
								User
								@endif
							</td>

						</tr>
						@endforeach

					</tbody>

				</table>
			</div>
		</div>
	</div>
	@endforeach
	<div id="prodivv" class="dn">
		<div id="content" style="position:relative; width:800px; margin:0 auto">
			<div style="text-align:right; margin-bottom:5px;">Bank Copy</div>
			<table border="1" cellspacing="0" cellpadding="6" width="100%" style="border-collapse:collapse;">
				<thead>
					<tr>
						<th colspan="2">
							<div style="padding: 0 15px 3px;">
								<div style="text-align: center; font-size: 20pt; margin: 0px 0px 0px 0px; padding: 0px 0 0; color: #383838; font-weight: bold;">
									CHALLAN
								</div>
								<div style="text-align: center; margin:0px 0px 0px 0px; font-size:14pt; padding: 0px; color:#383838; font-weight: bold;">
									(खेल विभाग)
								</div>
								<div style="text-align: center; margin:0px 0px 0px 0px; font-size:16pt; padding: 0px; color:#383838; font-weight: bold;">
									Government of Uttar Pradesh
								</div>
								<div style="text-align: center; margin:0px 0px 0px 0px; font-size:16pt; padding: 0px; color:#383838; font-weight: bold;">
									वित्तीय नियम संग्रह खण्ड-5, भाग-2 प्रपत्र संख्या-43ए (1) (प्रस्तर 417 एवं 478 देखिए)
								</div>
								<div style="text-align: center; margin:0px 0px 0px 0px; font-size:13pt; padding: 0px; color:#383838; font-weight: bold;">
									Uttar PradeshTreasury Form-209(1) - Challan for Depositing Money
								</div>
								<div style="text-align: center; margin:0px 0px 0px 0px; font-size:13pt; padding: 0px; color:#383838; font-weight: bold;">
									[To be submitted through Challan]
								</div>
							</div>
						</th>
					</tr>
				</thead>
				<tbody>
					<tr>
						<td>
							Challan No.: <strong> @isset($userDetails->unique_chalan_no){{ $userDetails->unique_chalan_no }}@endisset</strong>
						</td>
						<td>
							Challan Date: <strong> {{ dmy(now()) }}</strong>
						</td>
					</tr>
					<tr>
						<td>
							Financial Year:<strong>2024-2025</strong>
						</td>
						<td>
							Tax Period: <strong>ANNUAL</strong>
						</td>
					</tr>
					<tr>
						<td>
							Name of the Bank
						</td>
						<td>
							<strong><em>State Bank of India</em></strong>
						</td>
					</tr>
					<tr>
						<td>
							Name of the Branch
						</td>
						<td>
							<strong><em></em></strong>
						</td>
					</tr>

					<tr>
						<td>
							District
						</td>
						<td>
							<strong> @isset($userDetails->applicationBasicDetasils){{$userDetails->applicationBasicDetasils->district->city}} @endisset</strong>
						</td>
					</tr>


					<tr>
						<td>
							Unique ID
						</td>
						<td>
							<strong> </strong>
						</td>
					</tr>
					<tr>
						<td>
							Depositor Name
						</td>
						<td>
							<strong>{{$userDetails->name}}</strong>
						</td>
					</tr>
					<tr>
						<td>
							Depositor Mobile
						</td>
						<td>
							<strong>{{$userDetails->mobile}}</strong>
						</td>
					</tr>
					<tr>
						<td>
							Depositor Address
						</td>
						<td>
							<strong></strong>
						</td>
					</tr>
					<tr>
						<td colspan="2">
							<div class="table-responsive" style="padding:1rem;">
								<table class="table" border="0" cellspacing="0" cellpadding="3" width="100%" style="border-collapse:collapse; font-size:10pt;">
									<thead>
										<tr>
											<th>Head</th>
											<th>Description</th>
											<th>Serial No.</th>
											<th>Amount (in Rs.)</th>
										</tr>
									</thead>
									<tbody>
										<tr>
											<td>0202031010100</td>
											<td>शिक्षा खेलकूद, कला तथा संस्कृति</td>
											<td align="center">1</td>
											<td align="right">10.00</td>
										</tr>
										<tr>
											<td></td>
											<td>Totals of the above heads</td>
											<td>-</td>
											<td align="right">10.00</td>
										</tr>
									</tbody>
								</table>
							</div>
						</td>
					</tr>

				</tbody>
			</table>
		</div>
		<div id="content" style="position:relative; width:800px; margin:0 auto">
			<div style="text-align:right; margin:15px 0 5px; padding-top:5px; border-top:1px dashed #000;">Student Copy</div>
			<table border="1" cellspacing="0" cellpadding="6" width="100%" style="border-collapse:collapse;">
				<thead>
					<tr>
						<th colspan="2">
							<div style="padding: 0 15px 3px;">
								<div style="text-align: center; font-size: 20pt; margin: 0px 0px 0px 0px; padding: 0px 0 0; color: #383838; font-weight: bold;">
									CHALLAN
								</div>
								<div style="text-align: center; margin:0px 0px 0px 0px; font-size:14pt; padding: 0px; color:#383838; font-weight: bold;">
									(खेल विभाग)
								</div>
								<div style="text-align: center; margin:0px 0px 0px 0px; font-size:16pt; padding: 0px; color:#383838; font-weight: bold;">
									Government of Uttar Pradesh
								</div>
								<div style="text-align: center; margin:0px 0px 0px 0px; font-size:16pt; padding: 0px; color:#383838; font-weight: bold;">
									वित्तीय नियम संग्रह खण्ड-5, भाग-2 प्रपत्र संख्या-43ए (1) (प्रस्तर 417 एवं 478 देखिए)
								</div>
								<div style="text-align: center; margin:0px 0px 0px 0px; font-size:13pt; padding: 0px; color:#383838; font-weight: bold;">
									Uttar PradeshTreasury Form-209(1) - Challan for Depositing Money
								</div>
								<div style="text-align: center; margin:0px 0px 0px 0px; font-size:13pt; padding: 0px; color:#383838; font-weight: bold;">
									[To be submitted through Challan]
								</div>
							</div>
						</th>
					</tr>
				</thead>
				<tbody>
					<tr>
						<td>
							Challan No.: <strong>@isset($userDetails->unique_chalan_no){{ $userDetails->unique_chalan_no }}@endisset</strong>
						</td>
						<td>
							Challan Date: <strong> {{ dmy(now()) }}</strong>
						</td>
					</tr>
					<tr>
						<td>
							Financial Year:<strong>2024-2025</strong>
						</td>
						<td>
							Tax Period: <strong>ANNUAL</strong>
						</td>
					</tr>
					<tr>
						<td>
							Name of the Bank
						</td>
						<td>
							<strong><em>State Bank of India</em></strong>
						</td>
					</tr>
					<tr>
						<td>
							Name of the Branch
						</td>
						<td>
							<strong><em></em></strong>
						</td>
					</tr>
					<tr>
						<td>
							District
						</td>
						<td>
							<strong> @isset($userDetails->applicationBasicDetasils){{$userDetails->applicationBasicDetasils->district->city}} @endisset</strong>
						</td>
					</tr>
					<tr>
						<td>
							Unique ID
						</td>
						<td>
						<td>
							<strong> </strong>
						</td>
					</tr>
					<tr>
						<td>
							Depositor Name
						</td>
						<td>
							<strong>{{$userDetails->name}}</strong>
						</td>
					</tr>
					<tr>
						<td>
							Depositor Mobile
						</td>
						<td>
							<strong>{{$userDetails->mobile}}</strong>
						</td>
					</tr>
					<tr>
						<td>
							Depositor Address
						</td>
						<td>
							<strong></strong>
						</td>
					</tr>
					<tr>
						<td colspan="2">
							<div class="table-responsive" style="padding:1rem;">
								<table class="table" border="0" cellspacing="0" cellpadding="3" width="100%" style="border-collapse:collapse; font-size:10pt;">
									<thead>
										<tr>
											<th>Head</th>
											<th>Description</th>
											<th>Serial No.</th>
											<th>Amount (in Rs.)</th>
										</tr>
									</thead>
									<tbody>
										<tr>
											<td>0202031010100</td>
											<td>शिक्षा खेलकूद, कला तथा संस्कृति</td>
											<td align="center">1</td>
											<td align="right">10.00</td>
										</tr>
										<tr>
											<td></td>
											<td>Totals of the above heads</td>
											<td>-</td>
											<td align="right">10.00</td>
										</tr>
									</tbody>
								</table>
							</div>
						</td>
					</tr>

				</tbody>
			</table>
		</div>
	</div>
	@endsection
	@section('customJS')
	<script>
		function PrintDocc() {

			var toPrint = document.getElementById('prodivv');

			var popupWin = window.open('', '_blank', 'left=100,top=100,width=1100,height=600,tollbar=0,scrollbars=1,status=0,resizable=1');

			popupWin.document.open();

			popupWin.document.write('<html><title>Challan</title><head><style>body{font-family:Arial; counter-reset: page;} .noprint{display: none;} table{width:100%; border-collapse:collapse;} .table tr th, .table tr td{border:1px solid #000; padding:2px 3px; font-size: 10pt;} @page { size: A4 portrait; margin: 10pt 10pt 10pt;}</style></head><body onload="window.print()">')

			popupWin.document.write(toPrint.innerHTML);

			popupWin.document.write('</body></html>');

			popupWin.document.close();
		}
		$(document).ready(function() {
			$('#sport_type').trigger('change');
			$('#pwds').trigger('change');
			$('#pwdss').trigger('change');
			$('#district_id').trigger('change');
			$('#existing_studenttt').trigger('change');
			$('#existing_studentt').trigger('change');
		});
	</script>
	<script type="text/javascript">
		function Marks() {
			if (+document.getElementById("Text2").value <= +document.getElementById("Text1").value) {
				console.log(document.getElementById("Text2").value, document.getElementById("Text1").value);
				error('Obtain Marks should less than equal Total Marks');
				document.getElementById("Text2").value = "";
			}
		}
		$('select[name="c_state_id"]').on('change', function() {
			var c_state_id = $(this).val();
			if (c_state_id) {
				$.ajax({
					url: "{{ url('/hostel/application_form/district') }}/" + c_state_id,
					type: "GET",
					dataType: "json",
					success: function(data) {
						var d = $('select[name="c_district_id"]').empty();
						$('select[name="c_district_id"]').append(
							'<option value="">Select Module</option>');
						$.each(data, function(key, value) {
							$('select[name="c_district_id"]').append(
								'<option value="' + value.id + '">' + value
								.city + '</option>');
						});
					},
				});
			}
		});
		$('#district_id').change(function() {
			let option = `<option value=''>Select</option>`;
			value = $('#district_id').val();
			region_sport_office_idd = $('#region_sport_office_idd').val();
			$.ajax({
				type: "POST",
				url: "{{url('get_region_sport_office')}}",
				data: {
					value
				},
				success: function(response) {
					response.forEach((item) => {
						option += `<option selected value="${item.id}" ${item.id==region_sport_office_idd?'selected':''}>${item.regional_name}</option>`;
					});
					$("#region_sport_office_id").empty();
					$("#region_sport_office_id").append(option);
				}
			});
		})
	</script>
	<script>
		function sporttype(sport) {
			$(".container3").attr("required", true);
			var subsports_id = $(".container3").attr('data-subsport');
			$.ajax({
				type: "POST",
				url: "{{url('hostel/get_subsport')}}",
				data: {
					sport
				},
				success: function(response) {
					$(".container3").empty();
					if (response.length > 0) {
						$("#subsport").show();
						$(".container3").attr("required", true);
						let option = `<option value=''>Select Subsport</option>`;
						$.each(response, function(key, item) {
							option += ` <option value="${item.id}" ${item.id==subsports_id?'selected':''}>${item.sub_type}</option>`;
						})
						$(".container3").append(option);
					} else {
						$("#subsport").hide();
						$(".container3").attr("required", false);
					}
				}
			})
		}

		function myFunction() {
			var checkBox = document.getElementById("myCheck");
			
		}
		$('#pwds').change(function() {
			$("#medicalupload").hide();
			$("#File5").removeAttr('required');
		});
		$('#pwdss').change(function() {
			$("#medicalupload").show();
			if ($('#medical_certificate_file1').val() && $('#pwds').val() == 'Yes') {
				$("#File5").removeAttr('required');
			} else if ($('#medical_certificate_file1').val() == "" && $('#pwds').val() == 'Yes') {
				$("#File5").attr("required", "true");
			}
		});
		$(document).ready(function() {
			function toggleExistingStudent() {
				if ($('#existing_studentt').prop('checked') && $('#existing_studentt').val() == 1) {
					$(".existing_student_yes").show();
					$("#admission_noo").attr("required", "true");
					$("#roll_noo").attr("required", "true");
					$("#sports_college").attr("required", "true");
					if ($('#student_id_carddd').val() && $('#existing_studentt').val() == 1) {
						$("#student_id_cardd").removeAttr('required');
					} else if ($('#student_id_carddd').val() == "" && $('#existing_studentt').val() == 1) {
						$("#student_id_cardd").attr("required", "true");
					}
					if ($('#national_champtionship_documentt').val() && $('#existing_studentt').val() == 1) {
						$("#national_champtionship_document").removeAttr('required');
					} else if ($('#national_champtionship_documentt').val() == "" && $('#existing_studentt').val() == 1) {
						$("#national_champtionship_document").attr("required", "true");
					}
				} else {
					$("#sports_college").removeAttr('required');
					$("#admission_noo").removeAttr('required');
					$("#roll_noo").removeAttr('required');
					$("#student_id_cardd").removeAttr('required');
					$(".existing_student_yes").hide();
					$("#national_champtionship_document").removeAttr('required');
				}
			}
			// Run on page load
			toggleExistingStudent();
			// Run on value change
			$('#existing_studentt').on('change', function() {
				toggleExistingStudent();
			});
		});
		$('#existing_studentt').change(function() {
			$(".existing_student_yes").show();
			$("#admission_noo").attr("required", "true");
			$("#class_for_which_admissionnn").hide();
			$("#class_for_which_admission").removeAttr('required');
			$("#number_of_teethhhhh").hide();
			$("#number_of_teeth").removeAttr('required');
			$("#roll_noo").attr("required", "true");
			$("#sports_college").attr("required", "true");
			if ($('#student_id_carddd').val() && $('#existing_studentt').val() == 1) {
				$("#student_id_cardd").removeAttr('required');
			} else if ($('#student_id_carddd').val() == "" && $('#existing_studentt').val() == 1) {
				$("#student_id_cardd").attr("required", "true");
			}
			if ($('#national_champtionship_documentt').val() && $('#existing_studentt').val() == 1) {
				$("#national_champtionship_document").removeAttr('required');
			} else if ($('#national_champtionship_documentt').val() == "" && $('#existing_studentt').val() == 1) {
				$("#national_champtionship_document").attr("required", "true");
			}
		});
		$('#existing_studenttt').change(function() {
			$("#class_for_which_admissionnn").show();
			$("#class_for_which_admission").attr("required", "true");
			$("#number_of_teethhhhh").show();
			$("#number_of_teeth").attr("required", "true");
			$(".existing_student_yes").hide();
			$("#admission_noo").removeAttr('required');
			$("#roll_noo").removeAttr('required');
			$("#student_id_cardd").removeAttr('required');
			$("#national_champtionship_document").removeAttr('required');
		});
	</script>
	@endsection
