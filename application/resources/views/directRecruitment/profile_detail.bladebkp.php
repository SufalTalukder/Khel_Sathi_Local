@extends( 'layouts/drlayout' )
@section( 'content' )
	<div class="row">
		<div class="col-2">
			<!-- <a href="{{ route('drdashboard') }}" class="btn btn-outline-primary backbtn"><span class="icons icon-arrow-left"></span> Dashboard</a> -->
			<div class="left-sidebar">
				<div>
					<ul>

						<li><a href="{{ route('drcp') }}" class="active"><span class="icons icon-arrow-right"></span>Applicant’s Profile</a>
						</li>
					</ul>
				</div>
			</div>
		</div>
		<div class="col-10">
			<div class="bhoechie-tab-container">
				<div class="row">

					<form action="{{route('drcompProfile')}}" id="ajxReload" enctype="multipart/form-data" method="post" class="needs-validation mt-4 " novalidate>
						@csrf
						<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
							<div class="bhoechie-tab-content">
								<div class="form-scroll">
									<div>
										<div class="row">
											<div class="col-md-12">
												<h5 class="subheading">A. Nomination Form / नामांकन पत्र</h5>
											</div>
											<div class="col-md-4">
												<div class="form-group">
													<label class="placeholder">1. Applicant's Full Name<br>आवेदक का पूरा नाम *<span class="text-danger">*</span></label>
													<input type="text" class="form-control" name="full_name" value="{{$user->fullname}}" readonly>
												</div>
											</div>

											<div class="col-md-4">
												<div class="form-group">
													<label class="placeholder">2. Mobile Number<br>मोबाइल नंबर<span class="text-danger">*</span></label>
													<input type="text" class="form-control" name="contact_no" value="{{$user->mobile}}" readonly>
												</div>
											</div>
											<div class="col-md-4">
												<div class="form-group">
													<label class="placeholder">3. Email ID<br>ईमेल आईडी<span class="text-danger">*</span></label>
													<input type="email" class="form-control" name="email_id" value="{{$user->email}}" readonly>
												</div>
											</div>

											<div class="col-md-12">
												<h5 class="subheading">B.Sports Achievements/खेल क्षेत्र में उपलब्धियां<span class="text-danger">*</span></h5>
											</div>
											<form id="gett_post">
												<div class="col-md-10">
													<div class="form-group">
														<form name="add_name" id="add_name">
															<table id="dataTable" class="table" id="sport_event">
																<tr>
																	<td><b>Sport Event</b>
																	</td>
																	<td><b>Sport</b>
																	</td>
																	<td><b>Medal</b>
																	</td>
																	<td><b>Date of Event</b>
																	</td>
																	<td><b>Action</b>
																	</td>
																</tr>
																<tr>
																	<td class="form-group">
																		<select id="sport_event0" class="form-select s_event_name" onchange="pushSportEvent(this.value,0)" name="sport_event[]" required>
																			<option value="">-- Select --</option>
																			@foreach($sport_event as $Item)
																			<option value="{{$Item->id}}">{{$Item->event_name}}</option>
																			@endforeach
																		</select>
																	</td>
																	<td>
																		<select class="form-select" name="sport_name[]" required>
																			<option value="">-- Select --</option>
																			@foreach ($sport_list as $type)
																			<option value="{{$type->id}}" {{ old( 'sport_type')===$ type->id ? 'selected' : '' }}>{{$type->name}}</option>
																			@endforeach
																		</select>
																	</td>
																	<td>
																		<select id="medal0" class="form-select" name="medal[]" onchange="pushSportMedal(this.value,0)" required>
																			<option value="">-- Select --</option>
																			<option value="Gold">Gold</option>
																			<option value="Silver">Silver</option>
																			<option value="Bronze">Bronze</option>
																		</select>
																	</td>
																	<td>
																		<input type="text" class="form-control dateTime" onpaste="return false;" ondrop="return false;" onkeypress="return false" id="doc" autocomplete="off" required value="{{old('competition_from_date')}}" name="competition_date[]" data-language="en" placeholder="DD/MM/YYYY" required>
																	</td>

																	<td><button type="button" name="add_award" id="add_award" class="btn btn-primary">Add More</button>
																	</td>

																</tr>
															</table>
															<div style="float: right;">
																<button type="button" id="btn_reset" class="btn btn-outline-danger">Reset</button>
																<button type="button" id="btn_procced" class="btn btn-outline-success">Procced</button>
															</div>

														</form>
													</div>
												</div>

												<div class="col-md-12">
													<h5 class="subheading">C. Application for Posts/पद हेतु आवेदन कर रहे हैं:<span class="text-danger">*</span></h5>
												</div>

												<div class="col-md-10">
													<div class="form-group">
														<form name="add_name" id="add_name">
															<table class="table" id="dynamic_field">
																<tr>
																	<td><b>Prefrences/वरीयता</b>
																	</td>
																	<td><b>Post/पोस्ट</b>
																	</td>
																</tr>
																<tr>
																	<td>
																		<input type="hidden" value={{count($postMaster)}} id="chkk">
																		<select id="select0" class="form-select preference_select" name="post_type[]" required onchange="pushSelect(this.value)">
                                                                    <!-- <option value="">Select</option> -->
                                                                    <!-- @foreach($postMaster as $key=>$sItem) -->
                                                                    <option value="1">Prefrences 1</option>
                                                                    <!-- @endforeach -->
                                                                </select>
																	
																	</td>
																	<td>
																		<select id="post0" class="form-select preference_post" onclick="removeSelect(0)" name="post_name[]" required onchange="pushPost(this.value)">
																			<option value="">Select</option>
																			@foreach ($postMaster as $mItem)
																			<option value={{$mItem->id}}>{{$mItem->post_name}}</option>
																			@endforeach
																		</select>
																	</td>

																	<td><button type="button" name="add" id="add" class="btn btn-primary">Add More</button>
																	</td>

																</tr>
															</table>
														</form>
													</div>
												</div>


												<div class="col-md-12">
													<h5 class="subheading">D. Applicant's Details/आवेदक का विवरण</h5>
												</div>

												<div class="row">
													<div class="col-md-4">
														<div class="form-group">
															<label class="placeholder">1. Mother’s Name<br>माता का नाम<span class="text-danger">*</span></label>
															<input type="text" onkeypress='return ((event.charCode >= 65 && event.charCode <= 90) || (event.charCode >= 97 && event.charCode <= 122) || (event.charCode == 32))' required pattern="^[A-Za-z -]+$" class="form-control" name="mother_name" value="{{old('mother_name') }}">
														</div>
													</div>
													<div class="col-md-4">
														<div class="form-group">
															<label class="placeholder">2. Father’s Name<br>पिता का नाम<span class="text-danger">*</span></label>
															<input type="text" onkeypress='return ((event.charCode >= 65 && event.charCode <= 90) || (event.charCode >= 97 && event.charCode <= 122) || (event.charCode == 32))' required pattern="^[A-Za-z -]+$" class="form-control" name="father_name" value="{{old('father_name') }}">
														</div>
													</div>
													<div class="col-md-4">
														<div class="form-group">
															<label class="placeholder">3. Which Sport did/do you play?<br>कौन सा खेल खेलते थे/हैं?<span class="text-danger">*</span></label>
															<select class="form-select" name="sport_type" required>
																<option value="">Select</option>
																@foreach ($sport_type as $type)
																<option value="{{$type->id}}" {{ $user->sport_type === $type->id ? 'selected' : '' }} {{ old('sport_type') === $type->id ? 'selected' : '' }}>{{$type->name}}</option>
																@endforeach

															</select>
														</div>
													</div>
													<div class="col-md-4">
														<div class="form-group">
															<label>4. Category<br>श्रेणी<span class="text-danger">*</span></label>
															<select required name="category" class="form-select">
																<option value="">Select</option>
																<option value="1" {{ old( 'category')==="1" ? 'selected' : '' }}>General</option>
																<option value="2" {{ old( 'category')==="2" ? 'selected' : '' }}>OBC</option>
																<option value="3" {{ old( 'category')==="3" ? 'selected' : '' }}>SC</option>
																<option value="4" {{ old( 'category')==="4" ? 'selected' : '' }}>ST</option>
																<option value="5" {{ old( 'category')==="5" ? 'selected' : '' }}>Other</option>
															</select>
														</div>
													</div>
													<div class="col-md-4">
														<!-- {{$user->dob==$user->dob?date('d/m/Y',strtotime($user->dob)):''}} -->
														<div class="form-group">
															<label class="placeholder">5. Date of Birth<br>जन्म तिथि<span class="text-danger">*</span></label> @if($user->dob !=="")
															<input type="text" required value="{{old('dob') }}" class="form-control" name="dob" autocomplete="off" id="dob" data-language="en" placeholder="DD/MM/YYYY"> @else <input type="text" required value="{{old('dob') }}" class="form-control" name="dob" id="dob" data-language="en" autocomplete="off" placeholder="DD/MM/YYYY"> @endif

														</div>
													</div>
													<div class="col-md-4">
														<div class="form-group">
															<label class="placeholder">6. Place of Birth<br>जन्म स्थान<span class="text-danger">*</span></label>
															<input type="text" onkeypress='return ((event.charCode >= 65 && event.charCode <= 90) || (event.charCode >= 97 && event.charCode <= 122) || (event.charCode == 32))' class="form-control" required data-language="en" name="place_of_birth" value="{{old('place_of_birth')}}">
														</div>
													</div>
													<div class="col-md-4">
														<div class="form-group">
															<label>7. Gender<br>लिंग<span class="text-danger">*</span></label>
															<select class="form-select" required name="gender">
																<option value="">Select</option>
																<option value="Male" {{ $user->gender === "Male" ? 'selected' : '' }} {{old('gender') =='Male'?'Selected':''}}>Male</option>
																<option value="Female" {{ $user->gender === "Female" ? 'selected' : '' }} {{old('gender')=='Female'?'Selected':''}}>Female</option>
																<option value="Transgender"  {{ $user->gender === "Transgender" ? 'selected' : '' }}  {{old('gender')=='Transgender'?'Selected':''}}>Transgender</option>
															</select>
														</div>
													</div>
													<div class="col-md-4">
														<div class="form-group">
															<label>8. Marital Status<br>वैवाहिक स्थिति<span class="text-danger">*</span></label>
															<select class="form-select" required name="marital_status">
																<option value="">Select</option>
																<option value="Married" {{ $user->marital_status === "Married" ? 'selected' : '' }} {{old('marital_status')=='Married'?'Selected':''}}>Married</option>
																<option value="Single" {{ $user->marital_status === "Single" ? 'selected' : '' }} {{old('marital_status')=='Single'?'Selected':''}}>Single</option>
																<option value="Divorced" {{ $user->marital_status === "Divorced" ? 'selected' : '' }} {{old('marital_status')=='Divorced'?'Selected':''}}>Divorced</option>
																<option value="Widow" {{ $user->marital_status === "Widow" ? 'selected' : '' }} {{old('marital_status')=='Widow'?'Selected':''}}>Widow</option>
																<!-- <option value="Other" {{ $user->marital_status === "Other" ? 'selected' : '' }} {{old('marital_status')=='Other'?'Selected':''}}>Other</option> -->

															</select>
														</div>
													</div>
													<div class="col-md-4">
														<div class="form-group">
															<label class="placeholder">9. Nationality<br>राष्ट्रीयता<span class="text-danger">*</span></label>
															<select class="form-select" required name="nationality">
																<option value="">Select</option>
																<option value="Indian" {{ $user->nationality === "Indian" ? 'selected' : '' }} {{old('nationality')=='Indian'?'Selected':''}}>Indian</option>
																<!-- <option value="Other" {{ $user->nationality === "Other" ? 'selected' : '' }} {{old('nationality')=='Other'?'Selected':''}}>Other</option> -->

															</select>
															<!-- <input type="text" class="form-control" name="nationality" value="{{$user->nationality}}"> -->
														</div>
													</div>
													<div class="col-md-4">
														<div class="form-group">
															<label class="placeholder">10. Religion<br>धर्म<span class="text-danger">*</span></label>
															<select class="form-select" required name="religion">
																<option value="">Select</option>
																<option value="Hindu" {{$user->religion=='Hindu'?'Selected':''}}>Hindu</option>
																<option value="Muslim" {{$user->religion=='Muslim'?'Selected':''}}>Muslim</option>
																<option value="Christian" {{$user->religion=='Christian'?'Selected':''}}>Christian</option>
																<option value="Sikh" {{$user->religion=='Sikh'?'Selected':''}}>Sikh</option>
																<option value="Buddha " {{$user->religion=='Buddha '?'Selected':''}}>Buddha </option>
																<option value="Jain" {{$user->religion=='Jain'?'Selected':''}}>Jain</option>
																<option value="Other" {{old('religion')=='Other'?'Selected':''}}>Other</option>
															</select>
															<!-- <input type="text" class="form-control" name="religion" value="{{$user->religion}}"> -->
														</div>
													</div>
													<div class="col-md-4">
														<div class="form-group">
															<label class="placeholder">11. Sports Achievement<br>खेल उपलब्धियां<span class="text-danger">*</span></label>
															<textarea name="achievement" required rows="1" class="form-control" cols="40">{{$user->achievement}}{{old('achievement')}}</textarea>
														</div>
													</div>
													<div class="col-md-4">
														<div class="form-group">
															<label class="placeholder">12. Aadhaar No.<br>आधार नंबर<span class="text-danger">*</span></label>
															<input type="text" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');" required class="form-control" pattern="[0-9]{12}" name="aadhar_no" maxlength="12" minlength="12" value="{{old('aadhar_no')}}">
														</div>
													</div>
													<div class="col-md-4">
														<div class="form-group">
															<label>13. Upload Certificate of Highest Educational Qualification<br>उच्चतम शैक्षणिक योग्यता का प्रमाणपत्र अपलोड करें<span class="text-danger">*</span></label>
															<div class="input-group">
																<input type="file" required name="qualification_doc" class="form-control" onchange="getfileext(this.value,1)" id="File1" aria-describedby="inputGroupFileAddon05" aria-label="Upload">
																<input type="hidden" value="{{$user->qualification_doc}}" name="qualification_doc1">

															</div>
															<span class="note">(File Format: jpeg, jpg, Pdf | Max File Size: 2 MB)<br>(फाइल का प्रारूप: JPEG/JPG/PDF | फाइल का अधिकतम साइज़: 2 MB)</span>
														</div>
													</div>
													<div class="col-md-4">
														<div class="form-group">
															<label>14. Aadhaar Card<br>आधार कार्ड<span class="text-danger">*</span></label>
															<div class="input-group">
																<input type="file" required name="aadhar_card" class="form-control" onchange="getfileext(this.value,2)" id="File2" aria-describedby="inputGroupFileAddon05" aria-label="Upload">
																<input type="hidden" value="{{$user->aadhar_card}}" name="aadhar_card1">

															</div>
															<span class="note">(File Format: jpeg, jpg, Pdf | Max File Size: 2 MB)<br>(फाइल का प्रारूप: JPEG/JPG/PDF | फाइल का अधिकतम साइज़: 2 MB)</span>
														</div>
													</div>
													<div class="col-md-4">
														<div class="form-group">
															<label>15. Domicile Certificate issued by the Competent Authority<br>सक्षम प्राधिकारी द्वारा जारी किया गया निवास प्रमाण पत्र
<span class="text-danger">*</span></label>
															<div class="input-group">
																<input name="domicile_certificate" required type="file" class="form-control" onchange="getfileext(this.value,3)" id="File3" aria-describedby="inputGroupFileAddon05" aria-label="Upload">
																<input type="hidden" value="{{$user->domicile_certificate}}" name="domicile_certificate1">

															</div>
															<span class="note">(File Format: jpeg, jpg, Pdf | Max File Size: 2 MB)<br>(फाइल का प्रारूप: JPEG/JPG/PDF | फाइल का अधिकतम साइज़: 2 MB)</span>
														</div>
													</div>
													<div class="col-md-6">
														<div class="form-group">
															<label>16. Photograph<br>फोटो<span class="text-danger">*</span></label>
															<div class="input-group">
																<input type="file" required name="photograph" class="form-control" onchange="getfileext3(this,'T4')" id="FileT4" aria-describedby="inputGroupFileAddon05" aria-label="Upload">

															</div>
															<span class="note">(File Format: jpeg, jpg | Max File Size: 2 MB)<br>(फाइल का प्रारूप: JPEG/JPG | फाइल का अधिकतम साइज़: 2 MB)</span>
														</div>
													</div>
													<div class="col-md-4">
														<img id="photo" src="#" alt="your image" style="display:none;height: 80px; width: 100px; "/>

													</div>
													<div class="col-md-6">
														<div class="form-group">
															<label>17. Signature<br>हस्ताक्षर<span class="text-danger">*</span></label>
															<div class="input-group">
																<input type="file" required name="signature" class="form-control" onchange="getfileext2(this,'T3')" id="FileT3" aria-describedby="inputGroupFileAddon05" aria-label="Upload">
															</div>
															<span class="note">(File Format: jpeg, jpg| Max File Size: 2 MB)<br>(फाइल का प्रारूप: JPEG/JPG | फाइल का अधिकतम साइज़: 2 MB)</span>
														</div>

													</div>
													<div class="col-md-6">
														<img id="sign" src="#" alt="your image" style="display:none;height: 80px; width: 100px; "/>

													</div>

													<!-- <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label>Upload Guardian Signature</label>
                                                            <div class="input-group">
                                                                <input type="file" required name="guardian_signature" class="form-control" id="File4" aria-describedby="inputGroupFileAddon05" aria-label="Upload">
                                                                
                                                            </div>
                                                            <span class="note">(File Format: jpeg, jpg, Pdf | Max File Size: 2 MB)<br>(फाइल का प्रारूप: JPEG/JPG/PDF | फाइल का अधिकतम साइज़: 2 MB)</span>
                                                        </div>
                                                    </div> -->
												</div>
												<div class="col-md-12">
													<h5 class="subheading">D. Current Address/वर्तमान पता<span class="text-danger">*</span></h5>
												</div>
												<div class="row">
													<div class="col-md-3">
														<div class="form-group">
															<label class="placeholder">1. Address<br>पता<span class="text-danger">*</span></label>
															<textarea id="address1" required name="present_address" rows="1" class="form-control" cols="25">{{old('present_address')}}</textarea>
															<!-- <input type="text" required class="form-control" name="present_address" id="address1" value="{{$user->present_address}}"> -->
														</div>
													</div>
													<div class="col-md-3">
														<div class="form-group">
															<label class="placeholder">2. State<br>राज्य<span class="text-danger">*</span></label>
															<select class="form-select" required name="present_state" id="state1" onchange="get_city(this.value,'district1')">
																<option value="">Select State</option>
																@foreach($state as $value)
																<option value="{{$value->id}}" {{old( 'present_state')==$value->id?'Selected':''}}>{{$value->name}}</option>
																@endforeach
															</select>
														</div>
													</div>
													<div class="col-md-3">
														<div class="form-group">
															<label class="placeholder">3. District<br>जनपद<span class="text-danger">*</span></label> {{old('present_district')}}
															<input type="hidden" id="h_district1" value="{{old('present_district')}}"/>
															<select class="form-select" required name="present_district" id="district1">
																<option value="">Select</option>
																@foreach($all_city as $value)
																<option value="{{$value->id}}" {{ old( 'present_district')===$ value->id ? 'selected' : '' }} {{$user->present_district==$value->id?'Selected':''}}>{{$value->city}}</option>
																@endforeach
															</select>
														</div>
													</div>
													<div class="col-md-3">
														<div class="form-group">
															<label class="placeholder">4. Pin Code<br>पिन कोड<span class="text-danger">*</span></label>
															<input type="text" required oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');" class="form-control" maxlength="6" minlength="6" name="present_pincode" id="present_pincode" pattern="[0-9]{6}" value="{{$user->present_pincode}}{{old('present_pincode')}}">
														</div>
													</div>
												</div>
												<div class="col-md-12">
													<h5 class="subheading">E. Permanent Address/स्थायी पता<input type="checkbox" name="" value="yes" id="same">same as correspondence address/वर्तमान पते के समान</h5>
												</div>
												<div class="row">
													<div class="col-md-4">
														<div class="form-group">
															<label class="placeholder">1. Address<br>पता<span class="text-danger">*</span></label>
															<!-- <input type="text" required class="form-control dis_check" name="permanent_address" id="permanent_address" value="{{$user->permanent_address}}"> -->
															<textarea id="permanent_address" required name="permanent_address" rows="1" class="form-control" cols="25">{{old('permanent_address')}}</textarea>
														</div>
													</div>
													<!-- <div class="col-md-3">
                                                        <div class="form-group">
                                                            <label class="placeholder">State  <span class="text-danger">*</span></label>
                                                            <select class="form-select dis_check" required name="permanent_state" id="state" onchange="get_city(this.value,'district')">
                                                                <option value="">Select State</option>
                                                               @foreach($state as $value)
                                                               <option value="{{$value->id}}" {{old('permanent_state')==$value->id?'Selected':''}}>{{$value->name}}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    </div> -->
													<div class="col-md-4">
														<div class="form-group">
															<label class="placeholder dis_check">2. District<br>जनपद<span class="text-danger">*</span></label>
															<input type="hidden" id="h_district" value="{{old('permanent_district')}}"/>
															<select class="form-select" required name="permanent_district" id="district">

																<option value="">Select</option>
																@foreach($all_city as $value)
																<option value="{{$value->id}}" {{ old( 'permanent_district')===$ value->id ? 'selected' : '' }} {{$user->permanent_district==$value->id?'Selected':''}}>{{$value->city}}</option>
																@endforeach


															</select>
														</div>
													</div>
													<div class="col-md-4">
														<div class="form-group">
															<label class="placeholder">3. Pin Code<br>पिन कोड<span class="text-danger">*</span></label>
															<input type="text" required oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');" class="form-control dis_check" pattern="[0-9]{6}" minlength="6" maxlength="6" name="permanent_pincode" id="permanent_pincode" value="{{$user->permanent_pincode}}{{old('permanent_pincode')}}">
														</div>
													</div>
												</div>








												<div class="bhoechie-footer">
													<div class="row justify-content-center">
														<div class="col-md-3 d-grid">
															<button type="submit" id="reg-submit" class="btn btn-info">Save & Procced/दर्ज करें व आगे बढ़ें</button>
														</div>

													</div>
												</div>
										</div>
									</div>
								</div>
							</div>
							</form>
						</div>
				</div>
			</div>
		</div>




	@endsection @push('custom-scripts')
	<script src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.11.1/jquery.validate.min.js"></script>
	<script type="text/javascript">
		function showMsg() {
			info( "Please Complete Your Profile" );
		}


		function get_city( value, id ) {
			if ( value != 23 ) {
				$( "#same" ).attr( "disabled", true );
			} else {
				$( "#same" ).removeAttr( "disabled" );
			}
			let city = $( "#district1" ).val();
			let same = $( "#same" ).prop( 'checked' ) == true;
			let h_city = $( "#h_district" ).val();
			let h_city1 = $( "#h_district1" ).val();
			let option = `<option value=''>Select City</option>`;
			$.ajax( {
				type: "POST",
				url: "{{url('get_city')}}",
				data: {
					value
				},

				success: function ( response ) {
					response.forEach( ( item ) => {
						///setTimeout(() => {
						if ( h_city && id == "district" && $( "#same" ).prop( 'checked' ) == false ) {
							option += `<option value="${item.id}" ${item.id==h_city?'selected':''}>${item.city}</option>`;
						} else if ( h_city1 && id == "district1" && $( "#same" ).prop( 'checked' ) == false ) {
							option += `<option value="${item.id}" ${item.id==h_city1?'selected':''}>${item.city}</option>`;
						} else if ( city && id == "district" ) {
							option += `<option value="${item.id}" ${item.id==city ? 'selected':''}>${item.city}</option>`;
						} else {
							option += `<option value="${item.id}" >${item.city}</option>`;
						}
						///}, 20)
					} );
					$( "#" + id ).empty();
					$( "#" + id ).append( option );
				}
			} );
		}

		function setoldvalue( element ) {
			console.log( this.value );
			element.setAttribute( "oldvalue", this.value );
		}

		$( "#same" ).change( ( e ) => {
			if ( $( "#same" ).is( ":checked" ) ) {
				let address1 = $( "#address1" ).val();
				let district1 = $( "#district1" ).val();
				let state = $( "#state1" ).val();
				let permanent_pincode = $( "#present_pincode" ).val();
				$( "#state" ).val( state );
				$( "#permanent_address" ).val( address1 );
				$( "#permanent_pincode" ).val( permanent_pincode );
				$( '#state' ).trigger( 'change' );
				$( "#district" ).val( district1 );
				$( '.dis_check' ).attr( "style", "pointer-events: none;" );
			} else {
				$( "#permanent_address" ).val( '' );
				$( "#state" ).val( '' );
				$( "#district" ).val( '' );
				$( "#permanent_pincode" ).val( '' );
				$( '.dis_check' ).attr( "style", "" );

			}
		} )
		var start = ( new Date() ).getFullYear() - 100;
		var end = ( new Date() ).getFullYear() - 18;
		var yrRange = start + ":" + end;
		$( "#dob" ).datepicker( {
			changeMonth: true,
			changeYear: true,
			minDate: '-60Y',
			yearRange: yrRange,
			dateFormat: 'dd/mm/yy',
			maxDate: '-18Y'
		} );

		// $("#dob").datepicker({
		//     changeMonth: true,
		//     changeYear: true,
		//     yearRange: '1960:3025',
		//     minDate: '-60Y',
		//     dateFormat: 'dd/mm/yy',
		//     maxDate: '-18Y'
		// });
	</script>


	<script>
		var selectOption = '<option value="">Select</option>';
		var postOption = '<option value="">Select</option>';
	</script>
	<!-- @foreach ($selectMaster as $key=>$sItem)
<script>
    selectOption += '<option value="{{$sItem->name}}">{{$key}}</option>';
</script>
@endforeach -->
	@foreach ($postMaster as $key=>$pItem)
	<script>
		selectOption += '<option value="{{$key + 1}}">Prefrences {{$key +1 }}</option>';
		postOption += '<option value="{{$pItem->id}}">{{$pItem->post_name}}</option>';
	</script>
	@endforeach

	<script>
		$( "#doc" ).datepicker( {
			changeMonth: true,
			changeYear: true,
			minDate: '-60Y',
			yearRange: "-100:+0",
			maxDate: '0',
			dateFormat: 'dd/mm/yy'
		} );


		var selectOptionJsonArray = [];
		var postOptionJsonArray = [];
		var ck = 2;

		function disabledAttrApply() {

			$.each( selectOptionJsonArray, function ( index, data ) {
				$( ".preference_select option[value='" + data + "']" ).not( ':selected' ).attr( "disabled", "disabled" );
			} );
			$.each( postOptionJsonArray, function ( index, dataPost ) {
				$( ".preference_post option[value='" + dataPost + "']" ).not( ':selected' ).attr( "disabled", "disabled" );
			} );
		}

		//data remove 
		function removeSelect( i ) {

			var post = $( "#post" + i ).val();
			// console.log(postOptionJsonArray)
			$.each( postOptionJsonArray, function ( index, dataPost ) {
				console.log( dataPost )
				if ( dataPost == post ) {
					console.log( dataPost )
					postOptionJsonArray.splice( $.inArray( post, postOptionJsonArray ), 1 );
					$( ".preference_post option" ).removeAttr( "disabled" );
				}
			} );
			// postOptionJsonArray = postOptionJsonArray.filter((item, i, ar) => ar.indexOf(item) === i);
			// postOptionJsonArray.splice($.inArray(post, postOptionJsonArray), 1);
			// $(".preference_select option").removeAttr("disabled");
			// $(".preference_post option").removeAttr("disabled");

			// setTimeout(() => {
			//     disabledAttrApply();
			// }, 350);
		}
		$( document ).ready( function () {
			$( ".preference_select" ).attr( "style", "pointer-events: none;background-image: none" );
			var i = 11;
			var length;

			$( "#add" ).click( function () {
				if ( $( '#chkk' ).val() < ck ) {
					return false;
				}

				$( ".preference_select option" ).removeAttr( "disabled" );
				$( ".preference_post option" ).removeAttr( "disabled" );

				i++;
				ck++;
				$( '#dynamic_field' ).append( '<tr id="row' + i + '"><td><select onchange="pushSelect(this.value)" id="select' + i + '" required name="post_type[]" class="form-select preference_select" class="form-control name_list"><option value="{{$key + 1}}">Prefrences {{$key +1 }}</option></select></td><td><select onclick="removeSelect(' + i + ')" onchange="pushPost(this.value)" id="post' + i + '" class="form-select preference_post" name="post_name[]" required >' + postOption + '</select></td><td><button type="button" name="remove" id="' + i + '" class="btn btn-danger btn_remove" onclick="removeSelectOption(' + i + ')">X</button></td></tr>' );
				$( ".preference_select" ).attr( "style", "pointer-events: none;background-image: none" );
				setTimeout( () => {
					disabledAttrApply();
				}, 250 );

			} );

			$( document ).on( 'click', '.btn_remove', function () {
				var button_id = $( this ).attr( "id" );
				$( '#row' + button_id + '' ).remove();
			} );

			$( "#submit" ).on( 'click', function ( event ) {
				var formdata = $( "#add_name" ).serialize();
				event.preventDefault()
			} );

			$( "#add_award" ).click( function () {
				i++;
				$( '#sport_event' ).append( '<tr id="row' + i + '"> <td class="form-group"><select id="sport_event' + i + '" class="form-select s_event_name" name="sport_event[]"  onchange="pushSportEvent(this.value,' + i + ')" required ><option value="">-- Select --</option>@foreach($sport_event as $Item)<option value="{{$Item->id}}">{{$Item->event_name}}</option>@endforeach </select></td> <td> <select class="form-select" name="sport_name[]" required>  <option value="">-- Select --</option> @foreach ($sport_list as $type) <option value="{{$type->id}}"  {{ old('
					sport_type ') === $type->id ? '
					selected ' : '
					' }}>{{$type->name}}</option> @endforeach </select></td><td><select id="medal' + i + '" class="form-select" onchange="pushSportMedal(this.value,' + i + ')" name="medal[]" required  ><option value="">-- Select --</option> <option value="Gold">Gold</option><option value="Silver">Silver</option><option value="Bronze">Bronze</option></select></td><td><input type="text" class="form-control dateTime" onpaste="return false;" ondrop="return false;" onkeypress="return false" id="doc' + i + '" autocomplete="off" required value="{{old('
					competition_from_date ')}}" name="competition_date[]" data-language="en" placeholder="DD/MM/YYYY" required></td><td><button type="button" name="remove"  onclick="removeSportData(' + i + ')" id="' + i + '" class="btn btn-danger btn_remove">X</button></td></tr>' );

				$( ".dateTime" ).datepicker( {
					changeMonth: true,
					changeYear: true,
					minDate: '-60Y',
					yearRange: "-100:+0",
					maxDate: '0',
					dateFormat: 'dd/mm/yy'
				} );

			} );



		} );




		function pushPost( value ) {
			console.log( this.defaultValue )
			if ( value != '' ) {
				postOptionJsonArray.push( value );
				setTimeout( () => {
					disabledAttrApply();
				}, 250 );
			}
		}

		function pushSelect( value ) {
			if ( value != '' ) {
				selectOptionJsonArray.push( value );
				setTimeout( () => {
					disabledAttrApply();
				}, 250 );
			}
		}

		// $('.preference_post').live('focus', function(){
		//     console.log($(this).attr('oldValue',$(this).val()));
		// });
		function removeSelectOption( i ) {

			var post = $( "#post" + i ).val();
			postOptionJsonArray = postOptionJsonArray.filter( ( item, i, ar ) => ar.indexOf( item ) === i );
			postOptionJsonArray.splice( $.inArray( post, postOptionJsonArray ), 1 );

			var select = $( "#select" + i ).val();
			selectOptionJsonArray = selectOptionJsonArray.filter( ( item, i, ar ) => ar.indexOf( item ) === i );
			selectOptionJsonArray.splice( $.inArray( select, selectOptionJsonArray ), 1 );

			$( ".preference_select option" ).removeAttr( "disabled" );
			$( ".preference_post option" ).removeAttr( "disabled" );

			setTimeout( () => {
				disabledAttrApply();
			}, 350 );
			ck--;
		}

		setTimeout( () => {
			disabledAttrApply();
		}, 500 );

		// function removeEvent(i) {

		//         var sport_event =  $("#sport_event" + i).attr("old-value");
		//         console.log("old" + sport_event)
		//         $.each(sportEventJsonArray, function(index, data) {
		//             console.log("check"+data)
		//             if(data == sport_event){
		//                 console.log("remove"+data)
		//                 sportEventJsonArray.splice($.inArray(sport_event, sportEventJsonArray), 1);
		//             }
		//             setTimeout(() => {
		//             disabledAttrApply();
		//         }, 250);
		//         });
		//     }

		//sport event 
		var sportEventJsonArray = [];
		var sportMedalJsonArray = [];

		function pushSportEvent( value, i ) {

			if ( value != '' ) {

				var sport_event = $( "#sport_event" + i ).attr( "old-value" );
				$.each( sportEventJsonArray, function ( index, data ) {
					console.log( "check" + data )
					if ( data == sport_event ) {
						sportEventJsonArray.splice( $.inArray( sport_event, sportEventJsonArray ), 1 );
					}
				} );

				$( "#sport_event" + i ).attr( {
					"old-value": value
				} );
				sportEventJsonArray.splice( i, 0, value );
				setTimeout( () => {
					disabledAttrApply();
				}, 250 );
			}
		}

		function pushSportMedal( value, i ) {
			if ( value != '' ) {

				var sport_medal = $( "#medal" + i ).attr( "old-value" );
				$.each( sportMedalJsonArray, function ( index, data ) {
					console.log( "check" + data )
					if ( data == sport_medal ) {
						console.log( "remove" + data )
						sportMedalJsonArray.splice( $.inArray( sport_medal, sportMedalJsonArray ), 1 );
					}
				} );

				$( "#medal" + i ).attr( {
					"old-value": value
				} );


				sportMedalJsonArray.splice( i, 0, value );
				setTimeout( () => {
					disabledAttrApply();
				}, 250 );
			}
		}

		$( document ).on( 'click', '#btn_reset', function () {

			$( '#dynamic_field' ).find( "input,button,textarea,select" ).attr( "disabled", "disabled" );
			$( '#sport_event' ).find( "input,button,textarea,select" ).removeAttr( 'disabled' );
		} );

		$( document ).on( 'click', '#btn_procced', function () {

			var x = document.getElementsByName( "sport_event[]" );
			if ( x.length == 0 || x[ 0 ].value == null || x[ 0 ].value == "" ) {
				alert( "Sport Event Empty" );
				return false;
			}

			var y = document.getElementsByName( "medal[]" );
			if ( y.length == 0 || y[ 0 ].value == null || y[ 0 ].value == "" ) {
				alert( "Medal Empty" );
				return false;
			}


			$.ajax( {
				type: "POST",
				url: ajaxUrl + "/direct-recruitment/getPost",
				data: {
					sportEvent: sportEventJsonArray,
					sportMedal: sportMedalJsonArray
				},
				success: function ( res ) {
					$( "#dynamic_field" ).empty();
					$( "#dynamic_field" ).append( res );

				},
			} );
			$( '#sport_event' ).find( "input,button,textarea,select" ).attr( "disabled", "disabled" );
			$( '#dynamic_field' ).find( "input,button,textarea,select" ).removeAttr( 'disabled' );
		} );

		function removeSportData( i ) {
			var sport_event = $( "#sport_event" + i ).val();
			sportEventJsonArray = sportEventJsonArray.filter( ( item, i, ar ) => ar.indexOf( item ) === i );
			sportEventJsonArray.splice( $.inArray( sport_event, sportEventJsonArray ), 1 );

			var medal = $( "#medal" + i ).val();
			sportMedalJsonArray = sportMedalJsonArray.filter( ( item, i, ar ) => ar.indexOf( item ) === i );
			sportMedalJsonArray.splice( $.inArray( medal, sportMedalJsonArray ), 1 );

			setTimeout( () => {
				disabledAttrApply();
			}, 350 );
			ck--;
		}
	</script>
	@endpush