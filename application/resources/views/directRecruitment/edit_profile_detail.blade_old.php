@extends( 'layouts/layout' )
@section( 'content' )
<div class="dashbg">
	<div class="pageheader mb-0">
		<div class="row">
			<div class="col-md-12">
				<h4>Applicant’s Profile <a href="{{ route('profile') }}" class="btn btn-outline-info backbtn btn-sm float-end"><span class="icons icon-arrow-left"></span>Back/पीछे</a></h4>
			</div>
		</div>
	</div>
	<div class="card mt-3 mb-3">
		<div class="card-body">
			<form action="{{route('drupdateProfile')}}" id="ajxReload" enctype="multipart/form-data" method="post" class="needs-validation mt-4 " novalidate>
				 @foreach($user as $item)
				<div class="row">
					<div class="col-md-12">
						<h5 class="subheading">A. Basic Details/सामान्य विवरण</h5>
					</div>
					<div class="col-md-4">
						<div class="form-group">
							<label class="placeholder">1. Applicant's Full Name/आवेदक का पूरा नाम<span class="text-danger">*</span></label>
							<input type="text" class="form-control" name="full_name" value="{{$user->fullname}}" readonly>
						</div>
					</div>
					<div class="col-md-4">
						<div class="form-group">
							<label class="placeholder">2. Mobile Number/मोबाइल नंबर<span class="text-danger">*</span></label>
							<input type="text" class="form-control" name="contact_no" value="{{$user->mobile}}" readonly>
						</div>
					</div>
					<div class="col-md-4">
						<div class="form-group">
							<label class="placeholder">3. Email ID/ईमेल आईडी<span class="text-danger">*</span></label>
							<input type="email" class="form-control" name="email_id" value="{{$user->email}}" readonly>
						</div>
					</div>
					<div class="col-md-12">
						<h5 class="subheading">B.Sports Achievements/खेल क्षेत्र में उपलब्धियां<span class="text-danger">*</span></h5>
					</div>
					<div class="col-md-12">
						<table id="dataTable" class="table table-bordered" id="sport_event">
							<tr>
								<td><b>Sport Event</b>
								</td>
								<td><b>Sport</b>
								</td>
								<td><b>Medal</b>
								</td>
								<td><b>Date of Event</b>
								</td>
							</tr>
							@foreach($sportAchievement as $item)
							<?php $sele_sport = $item->sport_name ?>
							<tr class="bg-white">
								<td class="form-group">
									<input type="text" class="form-control" name="sport_event[]" value="{{sportEventName($item->sport_event)}}" readonly>
								</td>
								<td>
									<input type="text" class="form-control" name="sport_name[]" value="{{sport_name($item->sport_name)}}" readonly>
								</td>
								<td>
									<input type="text" class="form-control" name="medal[]" value="{{$item->medal}}" readonly>
								</td>
								<td>
									<input type="text" class="form-control dateTime" value="{{dmy($item->competition_date)}}" name="competition_date[]" readonly>
								</td>
							</tr>              
							@endforeach
						</table>
					</div>
					<div class="col-md-12">
						<h5 class="subheading">C. Application for Posts/पद हेतु आवेदन कर रहे हैं:<span class="text-danger">*</span> </h5>
					</div>
					<div class="col-md-12">
						<div class="form-group">
							<table class="table table-bordered" id="dynamic_field">
								<tr>
									<td><b>Prefrences/वरीयता</b>
									</td>
									<td><b>Post/पोस्ट</b>
									</td>
									<td></td>
								</tr>
								<?php $postCollection = $selectCollection = []; ?>
								<input type="hidden" value={{count($postMaster)}} id="chkk"> @foreach( $post as $key=>$item) @php $chkk=$key;@endphp
								<tr id="row{{$key}}">
									<?php $ttt = $key; ?>
									<td>
										<select id="select{{$key}}" class="form-select preference_select" name="post_type[]" required onchange="pushSelect(this.value)">
											<option value="">Select</option>
											<?php
											foreach ($postMaster as $key => $sItem) {
											?>
												<option <?= $item->post_type == ($key + 1) ? 'Selected' : ''; ?> value="{{$key+1}}">Prefrences {{$key+1}}</option>
											<?php
											}
											?>
										</select>
									</td>
									<td>
										<select id="post{{$key}}" class="form-select preference_post" onchange="removeSelectOption('post{{$key}}')" name="post_name[]" required onchange="pushPost(this.value)">
											<option value="">Select</option>
											<?php foreach ($postMaster as $mItem) { ?>
												<option <?= $item->post_name == $mItem->id ? 'Selected' : ''; ?> value="{{$mItem->id}}">{{$mItem->post_name}}</option>
											<?php
												if ($item->post_name == $mItem->id) {
													$postCollection[] = $item->post_name;
												}
											}
											?>
										</select>
									</td>
									@if(!isset($item) || ($chkk == 0))
									@if(count($postMaster) >1 )
									<td><button type="button" name="add" id="add" class="btn btn-primary mt-1">Add More</button></td>
									@endif
									@else
									<td><button onclick="removeSelectOption('{{$ttt}}')" type="button" name="remove" id="{{$ttt}}" class="btn btn-danger btn_remove"><span class="far fa-trash-alt"></span></button></td>
									@endif
								</tr>
								@endforeach
							</table>
						</div>
					</div>
					<div class="col-md-12">
						<h5 class="subheading">D. Applicant's Details/आवेदक का विवरण</h5>
					</div>
					<div class="row">
						<div class="col-md-4">
							<div class="form-group">
								<label class="placeholder">1. Mother’s Name/माता का नाम<span class="text-danger">*</span></label>
								<input type="text" onkeypress='return ((event.charCode >= 65 && event.charCode <= 90) || (event.charCode >= 97 && event.charCode <= 122) || (event.charCode == 32))' pattern="^[A-Za-z -]+$" required class="form-control @if(isset($iso_detail) && $iso_detail->mother_name_eng) dis_check @endif" name="mother_name" value="{{$user->mother_name}}">
							</div>
						</div>
						<div class="col-md-4">
							<div class="form-group">
								<label class="placeholder">2. Father’s Name/पिता का नाम <span class="text-danger">*</span></label>
								<input type="text" onkeypress='return ((event.charCode >= 65 && event.charCode <= 90) || (event.charCode >= 97 && event.charCode <= 122) || (event.charCode == 32))' pattern="^[A-Za-z -]+$" required class="form-control @if(isset($iso_detail) && $iso_detail->father_or_husband_or_guardian_name_eng) dis_check @endif" name="father_name" @if(isset($iso_detail) && $iso_detail->father_or_husband_or_guardian_name_eng) value="{{ $iso_detail->father_or_husband_or_guardian_name_eng }}" class="form-control dis_check" @endif class="form-control" value="{{$user->father_name}}">
							</div>
						</div>
						<div class="col-md-4">
							<div class="form-group">
								<label class="placeholder">3. Which Sport did you play?/आपने कौन सा खेल खेला? <span class="text-danger">*</span></label>
								<select style=" pointer-events: none;" class="form-select" name="sport_type" required>
									<option value="">Select</option>
									@foreach ($sport_type as $type)
									<option value="{{$type->id}}" {{ $sele_sport===$type->id ? 'selected' : '' }}>{{$type->name}}</option>
									@endforeach

								</select>
							</div>
						</div>
						<div class="col-md-4">
							<div class="form-group">
								<label>4. Category/श्रेणी<span class="text-danger">*</span></label>
								<select required name="category" class="form-select">
									<option value="">Select</option>
									<option {{$user->category=='1'?'Selected':''}} value="1">General</option>
									<option {{$user->category=='2'?'Selected':''}} value="2">OBC</option>
									<option {{$user->category=='3'?'Selected':''}} value="3">SC</option>
									<option {{$user->category=='4'?'Selected':''}} value="4">ST</option>
									<option {{$user->category=='5'?'Selected':''}} value="5">Other</option>
								</select>
							</div>
						</div>
						<div class="col-md-4">
							<!-- {{$user->dob==$user->dob?date('d/m/Y',strtotime($user->dob)):''}} -->
							<div class="form-group">
								<label class="placeholder">5. Date of Birth/जन्म तिथि<span class="text-danger">*</span></label> @if($user->dob !=="")
								<input type="text" required @if(isset($iso_detail) && $iso_detail->dob) class="form-control dis_check" value="{{isodate($iso_detail->dob)}}" @else value="{{$user->dob}}" id="dob" @endif name="dob" class="form-control" autocomplete="off" data-language="en" placeholder="DD/MM/YYYY"> @else <input type="text" required value="" class="form-control" name="dob" id="dob" data-language="en" autocomplete="off" placeholder="DD/MM/YYYY"> @endif
							</div>
						</div>
						<div class="col-md-4">
							<div class="form-group">
								<label class="placeholder">6. Place of Birth/जन्म स्थान<span class="text-danger">*</span></label>
								<input type="text" onkeypress='return ((event.charCode >= 65 && event.charCode <= 90) || (event.charCode >= 97 && event.charCode <= 122) || (event.charCode == 32))' class="form-control" required data-language="en" name="place_of_birth" value="{{$user->place_of_birth}}">
							</div>
						</div>
						<div class="col-md-4">
							<div class="form-group">
								<label>7. Gender/लिंग<span class="text-danger">*</span></label>
								<select class="form-select @if(isset($iso_detail) && $iso_detail->gender) dis_check @endif" required name="gender">
									<option value="">Select</option>
									<option value="Male" @if(isset($iso_detail) && $iso_detail->gender && $iso_detail->gender == "M") Selected @else {{$user->gender=='Male'?'Selected':''}}@endif>Male</option>
									<option value="Female" @if(isset($iso_detail) && $iso_detail->gender && $iso_detail->gender == "F") Selected @else{{$user->gender=='Female'?'Selected':''}} @endif>Female</option>
									<option value="Transgender" @if(isset($iso_detail) && $iso_detail->gender && $iso_detail->gender == "T") Selected @else{{$user->gender=='Transgender'?'Selected':''}}@endif>Transgender</option>
								</select>
							</div>
						</div>
						<div class="col-md-4">
							<div class="form-group">
								<label>8. Marital status/वैवाहिक स्थिति<span class="text-danger">*</span></label>
								<select class="form-select @if(isset($iso_detail) && $iso_detail->marital_status) dis_check @endif" required name="marital_status">
									<option value="">Select</option>
									<option value="Married" @if(isset($iso_detail) && $iso_detail->marital_status && $iso_detail->marital_status == "2") Selected @else {{$user->marital_status=='Married'?'Selected':''}}@endif>Married</option>
									<option value="Single" @if(isset($iso_detail) && $iso_detail->marital_status && $iso_detail->marital_status == "1") Selected @else {{$user->marital_status=='Single'?'Selected':''}}@endif>Single</option>
									<option value="Divorced" @if(isset($iso_detail) && $iso_detail->marital_status && $iso_detail->marital_status == "3") Selected @else {{ $user->marital_status === "Divorced" ? 'selected' : '' }} {{old('marital_status')=='Divorced'?'Selected':''}}@endif>Divorced</option>
									<option value="Widow" @if(isset($iso_detail) && $iso_detail->marital_status && $iso_detail->marital_status == "4") Selected @else {{ $user->marital_status === "Widow" ? 'selected' : '' }} {{old('marital_status')=='Widow'?'Selected':''}}@endif>Widow</option>
									<option value="Widower" @if(isset($iso_detail) && $iso_detail->marital_status && $iso_detail->marital_status == "5") Selected @else {{ $user->marital_status === "Widower" ? 'selected' : '' }} {{old('marital_status')=='Widower'?'Selected':''}}@endif>Widower</option>
								</select>
							</div>
						</div>
						<div class="col-md-4">
							<div class="form-group">
								<label class="placeholder">9. Nationality/राष्ट्रीयता<span class="text-danger">*</span></label>
								<select class="form-select" required name="nationality">
									<option value="">Select</option>
									<option value="Indian" {{$user->nationality=='Indian'?'Selected':''}}>Indian</option>
									<!-- <option value="Other" {{$user->nationality=='Other'?'Selected':''}}>Other</option> -->

								</select>
								<!-- <input type="text" class="form-control" name="nationality" value="{{$user->nationality}}"> -->
							</div>
						</div>
						<div class="col-md-4">
							<div class="form-group">
								<label class="placeholder">10. Religion/धर्म<span class="text-danger">*</span></label>
								<select class="form-select" required name="religion">
									<option value="">Select</option>
									<option value="Hindu" {{$user->religion=='Hindu'?'Selected':''}}>Hindu</option>
									<option value="Muslim" {{$user->religion=='Muslim'?'Selected':''}}>Muslim</option>
									<option value="Christian" {{$user->religion=='Christian'?'Selected':''}}>Christian</option>
									<option value="Sikh" {{$user->religion=='Sikh'?'Selected':''}}>Sikh</option>
									<option value="Buddha " {{$user->religion=='Buddha '?'Selected':''}}>Buddha </option>
									<option value="Jain" {{$user->religion=='Jain'?'Selected':''}}>Jain</option>
									<option value="Other" {{$user->religion=='Other'?'Selected':''}}>Other</option>
								</select>
								<!-- <input type="text" class="form-control" name="religion" value="{{$user->religion}}"> -->
							</div>
						</div>
						<div class="col-md-4">
							<div class="form-group">
								<label class="placeholder">11. Sports Achievement/खेल उपलब्धियां<span class="text-danger">*</span></label>
								<textarea name="achievement" required rows="1" class="form-control" cols="40">{{$user->sport_achievement}}</textarea>
							</div>
						</div>
						<div class="col-md-4">
							<div class="form-group">
								<label class="placeholder">12. Aadhar Number/आधार नंबर<span class="text-danger">*</span></label>
								<input type="text" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');" required class="form-control" pattern="[0-9]{12}" name="aadhar_no" maxlength="12" minlength="12" value="{{$user->aadhar_no}}">
							</div>
						</div>
						<div class="col-md-4">
							<div class="form-group">
								<label>13. Upload Certificate of Highest Educational Qualification/उच्चतम शैक्षणिक योग्यता का प्रमाणपत्र अपलोड करें<span class="text-danger">*</span></label>
								<div class="input-group">
									<input type="file" name="qualification_doc" class="form-control" onchange="getfileext(this.value,1)" id="File1" aria-describedby="inputGroupFileAddon05" aria-label="Upload">
									<input type="hidden" name="qualification_doc1" value="{{$user->qualification_doc}}"> @if($user->qualification_doc!='') @php $img = url('storage/app/public/direct_recruitment').'/'.$user->qualification_doc; $img1 = url('public/images/view.jpg'); $doc = explode('.',$user->qualification_doc); @endphp
									<img src="{{$img1}}" role="button" onclick="appendImage('{{$img}}','{{$doc[1]}}')" class="img-fluid" /> @endif
									<!-- @if($user->qualification_doc !='')
                                                        <a class="btn btn-success" href="{{url('storage/app/public/direct_recruitment',$user->qualification_doc)}}" target="_blank">
                                                            View
                                                        </a>
                                                        @endif -->
								</div>
								<span class="note">(File Format: jpeg, jpg, Pdf | Max File Size: 2 MB)<br>(फाइल का प्रारूप: JPEG/JPG/PDF | फाइल का अधिकतम साइज़: 2 MB)</span>
							</div>
						</div>
						<div class="col-md-4">
							<div class="form-group">
								<label>14. Aadhaar card<br>आधार कार्ड<span class="text-danger">*</span></label>
								<div class="input-group">
									<input type="file" name="aadhar_card" class="form-control" onchange="getfileext(this.value,2)" id="File2" aria-describedby="inputGroupFileAddon05" aria-label="Upload">
									<input type="hidden" name="aadhar_card1" value="{{$user->aadhar_doc}}"> @if($user->aadhar_doc !='')
									<!-- <a class="btn btn-success" href="{{url('storage/app/public/direct_recruitment',$user->aadhar_doc)}}" target="_blank">
                                                            View
                                                        </a> -->

									@php $img = url('storage/app/public/direct_recruitment').'/'.$user->aadhar_doc; $img1 = url('public/images/view.jpg'); $doc = explode('.',$user->aadhar_doc); @endphp
									<img src="{{$img1}}" role="button" onclick="appendImage('{{$img}}','{{$doc[1]}}')" class="img-fluid" /> @endif
								</div>
								<span class="note">(File Format: jpeg, jpg, Pdf | Max File Size: 2 MB)<br>(फाइल का प्रारूप: JPEG/JPG/PDF | फाइल का अधिकतम साइज़: 2 MB)</span>
							</div>
						</div>
						<div class="col-md-4">
							<div class="form-group">
								<label>15. Domicile Certificate issued by the Competent Authority<br>सक्षम प्राधिकारी द्वारा जारी किया गया निवास प्रमाण पत्र<span class="text-danger">*</span></label>
								<div class="input-group">
									<input name="domicile_certificate" type="file" class="form-control" onchange="getfileext(this.value,3)" id="File3" aria-describedby="inputGroupFileAddon05" aria-label="Upload">
									<input type="hidden" name="domicile_certificate1" value="{{$user->domicile_certificate}}"> @if($user->domicile_certificate !='')
									<!-- <a class="btn btn-success" href="{{url('storage/app/public/direct_recruitment',$user->domicile_certificate)}}" target="_blank">
                                                            View
                                                        </a> -->
									@php $img = url('storage/app/public/direct_recruitment').'/'.$user->domicile_certificate; $img1 = url('public/images/view.jpg'); $doc = explode('.',$user->domicile_certificate); @endphp
									<img src="{{$img1}}" role="button" onclick="appendImage('{{$img}}','{{$doc[1]}}')" class="img-fluid" /> @endif
								</div>
								<span class="note">(File Format: jpeg, jpg, Pdf | Max File Size: 2 MB)</span>
							</div>
						</div>

						<!--  aaa-->
						<div class="col-md-6">
							<div class="form-group">
								<label class="placeholder">16. Do you have association approved certificate?<br>
									क्या आपके पास एसोसिएशन द्वारा अनुमोदित प्रमाणपत्र है?<span class="text-danger">*</span></label>
								<select name="association_certificate" required id="association_certificate" class="form-select">
									<option value="">Select</option>
									<option value="1" {{$user->association_certificate ==  "1" ? 'Selected':''}} {{ old('association_certificate') === "1" ? 'selected' : '' }}>Yes</option>
									<option value="2" {{$user->association_certificate=="2" ? 'Selected':''}} {{ old('association_certificate') === "2" ? 'selected' : '' }}>No</option>
								</select>
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label>17. Upload association approved certificate<br>एसोसिएशन द्वारा अनुमोदित प्रमाणपत्र अपलोड करें !</label>
								<div class="input-group">
									<input type="file" name="association_certificate_upload" class="form-control" onchange="getfileext(this.value,9)" id="association_certificate_upload" aria-describedby="inputGroupFileAddon05" aria-label="Upload">
									<input type="hidden" name="association_certificate1" id="association_certificate1" value="{{$user->association_certificate_upload}}">
									<!-- <a href="#" class="btn btn-secondary" id="A4">View</a> -->
								</div>
								<span class="note">(File Format/फाइल का प्रारूप: JPEG/JPG/PDF | Max File Size/फाइल का अधिकतम साइज़: 2 MB)</span>
							</div>
						</div>
						<!--aaaa  -->
						<div class="col-md-6">
							<div class="form-group">
								<label>18. Upload your Photograph<br>फोट अपलोड करें<span class="text-danger">*</span></label>
								<div class="input-group">
									<input type="file" name="photograph" class="form-control" onchange="getfileext3(this,'T4')" id="FileT4" aria-describedby="inputGroupFileAddon05" aria-label="Upload">
									<input type="hidden" name="photograph1" value="{{$user->photograph_doc}}"> @if($user->photograph_doc !='')
									
									@php $img = url('storage/app/public/direct_recruitment').'/'.$user->photograph_doc; $img1 = url('public/images/view.jpg'); $doc = explode('.',$user->photograph_doc); @endphp
									<img src="{{$img1}}" role="button" onclick="appendImage('{{$img}}','{{$doc[1]}}')" class="img-fluid" /> @endif
								</div>
								<span class="note">(File Format: jpeg, jpg | Max File Size: 2 MB)<br>(फाइल का प्रारूप: JPEG/JPG/PDF | फाइल का अधिकतम साइज़: 2 MB)</span>
							</div>
							<img id="photo" src="#" alt="your image" style="display:none;height: 80px; width: 100px; margin-bottom: 15px;" />
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label>19. Upload your Signature<br>हस्ताक्षर अपलोड करें<span class="text-danger">*</span></label>
								<div class="input-group">
									<input type="file" name="signature" class="form-control" onchange="getfileext2(this,'T3')" id="FileT3" aria-describedby="inputGroupFileAddon05" aria-label="Upload">
									<input type="hidden" name="signature1" value="{{$user->signature_doc}}"> @if($user->signature_doc !='')
									
									@php $img = url('storage/app/public/direct_recruitment').'/'.$user->signature_doc; $img1 = url('public/images/view.jpg'); $doc = explode('.',$user->signature_doc); @endphp
									<img src="{{$img1}}" role="button" onclick="appendImage('{{$img}}','{{$doc[1]}}')" class="img-fluid" /> @endif
								</div>
								<span class="note">(File Format: jpeg, jpg| Max File Size: 2 MB)<br>(फाइल का प्रारूप: JPEG/JPG/PDF | फाइल का अधिकतम साइज़: 2 MB)</span>
							</div>
							<img id="sign" src="#" alt="your image" style="display:none;height: 80px; width: 100px;  margin-bottom: 15px;" />
						</div>
					</div>
				</div>
				<div class="col-md-12">
					<h5 class="subheading">E. Current Address/वर्तमान पता</h5>
				</div>
				<div class="row">
					<div class="col-md-3">
						<div class="form-group">
							<label class="placeholder">1. Address/पता<span class="text-danger">*</span></label>
							<textarea id="address1" required name="present_address" rows="1" class="form-select" cols="25">{{$user->present_address}}</textarea>
							<!-- <input type="text" required class="form-control" name="present_address" id="address1" value="{{$user->present_address}}"> -->
						</div>
					</div>
					<div class="col-md-3">
						<div class="form-group">
							<label class="placeholder">2. State/राज्य<span class="text-danger">*</span></label>
							<select class="form-select @if(isset($iso_detail) && $iso_detail->residential_state) dis_check @endif" required name="present_state" id="state1" onchange="get_city(this.value,'district1')">
								<option value="">Select State</option>
								@foreach($state as $value)
								<option value="{{$value->id}}" {{$user->present_state==$value->id?'Selected':''}}>{{$value->name}}</option>
								@endforeach
							</select>
						</div>
					</div>
					<div class="col-md-3">
						<div class="form-group">
							<label class="placeholder">3. District/जनपद<span class="text-danger">*</span></label>
							<input type="hidden" id="h_district1" value="{{$user->present_district}}" />
							<select class="form-select @if(isset($iso_detail) && $iso_detail->residential_district) dis_check @endif" required name="present_district" id="district1">
								<option value="">Select</option>
								@foreach($all_city as $value)
								<option value="{{$value->id}}" {{ $user->present_district === $value->id ? 'selected' : '' }} {{$user->present_district==$value->id?'Selected':''}}>{{$value->city}}</option>
								@endforeach
							</select>
						</div>
					</div>
					<div class="col-md-3">
						<div class="form-group">
							<label class="placeholder">4. Pin Code/पिन कोड<span class="text-danger">*</span></label>
							<input type="text" required oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');" class="form-control @if(isset($iso_detail) && $iso_detail->residential_pin) dis_check @endif" maxlength="6" minlength="6" name="present_pincode" id="present_pincode" pattern="[0-9]{6}" value="{{$user->present_pincode}}">
						</div>
					</div>
				</div>
				<div class="col-md-12">
					<h5 class="subheading">F. Permanent Address/स्थायी पता
						<small class="ms-3 text-dark"> <input type="checkbox" name="" value="yes" id="same" class="me-1">same as correspondence address/वर्तमान पते के समान </small>					
					</h5>
				</div>
				<div class="row">
					<div class="col-md-4">
						<div class="form-group">
							<label class="placeholder">1. Address/पता<span class="text-danger">*</span> </label>
							<!-- <input type="text" required class="form-control dis_check" name="permanent_address" id="permanent_address" value="{{$user->permanent_address}}"> -->
							<textarea id="permanent_address" required name="permanent_address" rows="1" class="form-select" cols="25">{{$user->permanent_address}}</textarea>
						</div>
					</div>
					<!-- <div class="col-md-3">
                                                        <div class="form-group">
                                                            <label class="placeholder">State <span class="text-danger">*</span> </label>
                                                            <select class="form-select dis_check" required name="permanent_state" id="state" onchange="get_city(this.value,'district')">
                                                                <option value="">Select State</option>
                                                               @foreach($state as $value)
                                                               <option value="{{$value->id}}" {{$user->permanent_state==$value->id?'Selected':''}}>{{$value->name}}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    </div> -->
					<div class="col-md-4">
						<div class="form-group">
							<label class="placeholder dis_check">2. District/जनपद<span class="text-danger">*</span> </label>
							<input type="hidden" id="h_district" value="{{$user->permanent_district}}" />
							<select class="form-select @if(isset($iso_detail) && $iso_detail->permanent_district) dis_check @endif" required name="permanent_district" id="district">
								<option value="">Select</option>
								@foreach($all_city as $value)
								<option value="{{$value->id}}" {{ $user->permanent_district === $value->id ? 'selected' : '' }} {{$user->permanent_district==$value->id?'Selected':''}}>{{$value->city}}</option>
								@endforeach
							</select>
						</div>
					</div>
					<div class="col-md-4">
						<div class="form-group">
							<label class="placeholder">3. Pin Code/पिन कोड<span class="text-danger">*</span> </label>
							<input type="text" required oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');" class="form-control @if(isset($iso_detail) && $iso_detail->permanent_pin) dis_check @endif" pattern="[0-9]{6}" minlength="6" maxlength="6" name="permanent_pincode" id="permanent_pincode" value="{{$user->permanent_pincode}}">
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
				@endforeach
			</form>
		</div>
	</div>
</div>
@endsection
<!-- modal for stock alert -->
<div class="modal fade" id="stock_alert" tabindex="-1" data-backdrop="static" data-keyboard="false">
	<div class="modal-dialog">
		<div class="modal-content" style=" text-align: center; font-size: x-large; color: red; ">
			<div class="modal-header">
				<a href="{{ route('drsa') }}"><span class="icons icon-arrow-left"></span>Back/पीछे</a>
			</div>
			<div class="modal-body">
				<p> No Post Available</p>
			</div>
		</div>
	</div>
</div>
<!-- end modal for stock alert -->

@push( 'custom-scripts' )

<script type="text/javascript">
	var aaa = '<?= count($postMaster); ?>';
	if (aaa == 0) {
		$('#stock_alert').modal('show');
		$('#stock_alert').modal({
			backdrop: 'static',
			keyboard: false
		})
	}

	function showMsg() {
		info("Please Complete Your Profile");
	}

	function get_city(value, id) {
		if (value != 23) {
			$("#same").attr("disabled", true);
		} else {
			$("#same").removeAttr("disabled");
		}
		let city = $("#district1").val();
		let same = $("#same").prop('checked') == true;
		let h_city = $("#h_district").val();
		let h_city1 = $("#h_district1").val();
		let option = `<option value=''>Select City</option>`;
		$.ajax({
			type: "POST",
			url: "{{url('get_city')}}",
			data: {
				value
			},

			success: function(response) {
				response.forEach((item) => {
					///setTimeout(() => {
					if (h_city && id == "district" && $("#same").prop('checked') == false) {
						option += `<option value="${item.id}" ${item.id==h_city?'selected':''}>${item.city}</option>`;
					} else if (h_city1 && id == "district1" && $("#same").prop('checked') == false) {
						option += `<option value="${item.id}" ${item.id==h_city1?'selected':''}>${item.city}</option>`;
					} else if (city && id == "district") {
						option += `<option value="${item.id}" ${item.id==city ? 'selected':''}>${item.city}</option>`;
					} else {
						option += `<option value="${item.id}" >${item.city}</option>`;
					}
					///}, 20)
				});
				$("#" + id).empty();
				$("#" + id).append(option);
			}
		});
	}

	$("#same").change((e) => {
		if ($("#same").is(":checked")) {
			let address1 = $("#address1").val();
			let state = $("#state1").val();
			let permanent_pincode = $("#present_pincode").val();
			$("#state").val(state);
			$("#permanent_address").val(address1);
			$("#permanent_pincode").val(permanent_pincode);
			$('#state').trigger('change');
			$('.dis_check').attr("style", "pointer-events: none;");
		} else {
			$("#permanent_address").val('');
			$("#state").val('');
			$("#district").val('');
			$("#permanent_pincode").val('');
			$('.dis_check').attr("style", "");

		}
	})

	var start = (new Date()).getFullYear() - 100;
	var end = (new Date()).getFullYear() - 18;
	var yrRange = start + ":" + end;
	$("#dob").datepicker({
		changeMonth: true,
		changeYear: true,
		minDate: '-60Y',
		yearRange: yrRange,
		dateFormat: 'dd/mm/yy',
		maxDate: '-18Y'
	});

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
	var selectOptionJson = <?= json_encode($selectCollection); ?>;
	var postOptionJson = <?= json_encode($postCollection); ?>;
</script>
<!-- @foreach ($selectMaster as $sItem)
<script>
	selectOption += '<option value="{{$sItem->name}}">{{$sItem->name}}</option>';
</script>
@endforeach -->
@foreach( $postMaster as $key => $pItem )
<script>
	selectOption += '<option value="{{$key + 1}}">Prefrences {{$key +1 }}</option>';
	postOption += '<option value="{{$pItem->id}}">{{$pItem->post_name}}</option>';
</script>
@endforeach

<script>
	$('.dis_check').attr("style", "pointer-events: none;");
	var selectOptionJsonArray = [];
	var postOptionJsonArray = [];
	var ck = 3;


	$(document).ready(function() {
		// $( ".preference_select" ).attr( "style", "pointer-events: none;background-image: none" );
		var i = 11;
		var ij = 2;

		var length;

		$.each(selectOptionJson, function(index, data) {
			selectOptionJsonArray.push(data);
		});
		$.each(postOptionJson, function(index, dataPost) {
			postOptionJsonArray.push(dataPost);
		});
		$("#add").click(function() {

			//    alert("hii");
			if ($('#chkk').val() < ck) {
				return false;
			}
			// $(".preference_select option").removeAttr("disabled");
			// $(".preference_post option").removeAttr("disabled");

			i++;
			ij++;
			ck++;
			$('#dynamic_field').append('<tr id="row' + i + '"><td><select onchange="pushSelect(this.value)" id="select' + i + '" required name="post_type[]" class="form-select preference_select" class="form-control name_list">' + selectOption + '</select></td><td><select onchange="pushPost(this.value)" id="post' + i + '" class="form-select preference_post" name="post_name[]" required >' + postOption + '</select></td><td><button type="button" name="remove" id="' + i + '" class="btn btn-danger btn_remove mt-1 px-2" onclick="removeSelectOption(' + i + ')"><span class="far fa-trash-alt"></span></button></td></tr>');
			// $('#dynamic_field').append('<tr id="row' + i + '"><td><select onchange="pushSelect(this.value)" id="select' + i + '" required name="post_type[]" class="form-select preference_select" class="form-control name_list">' + selectOption + '</select></td><td><select onchange="pushPost(this.value)" id="post' + i + '" class="form-select preference_post" name="post_name[]" required >' + postOption + '</select></td><td><button type="button" name="remove" id="' + i + '" class="btn btn-danger btn_remove" onclick="removeSelectOption(' + i + ')">X</button></td></tr>');
			// $( ".preference_select" ).attr( "style", "pointer-events: none;background-image: none" );
			// $(".preference_select").attr("style", "background-image: none;");


		});

		$(document).on('click', '.btn_remove', function() {
			var button_id = $(this).attr("id");
			$('#row' + button_id + '').remove();
		});

		$("#submit").on('click', function(event) {
			var formdata = $("#add_name").serialize();
			event.preventDefault()
		});
	});

	function pushPost(value) {
		if (value != '') {
			postOptionJsonArray.push(value);
		}
	}

	function pushSelect(value) {
		if (value != '') {
			selectOptionJsonArray.push(value);

		}
	}

	function removeSelectOption(i) {

		var post = $("#post" + i).val();
		postOptionJsonArray = postOptionJsonArray.filter((item, i, ar) => ar.indexOf(item) === i);
		postOptionJsonArray.splice($.inArray(post, postOptionJsonArray), 1);

		var select = $("#select" + i).val();
		selectOptionJsonArray = selectOptionJsonArray.filter((item, i, ar) => ar.indexOf(item) === i);
		selectOptionJsonArray.splice($.inArray(select, selectOptionJsonArray), 1);

		$(".preference_select option").removeAttr("disabled");
		$(".preference_post option").removeAttr("disabled");

		ck--;
	}



	//new column add
	$("#association_certificate").on('change', function() {
		if (this.value == "1" && $('#association_certificate1').val() == "") {

			$("#association_certificate_upload").attr('required', true);
		} else {
			$("#association_certificate_upload").attr('required', false);
		}

	});
	// $("#reg-submit").on("click", function () {
	//     console.log(selectOptionJsonArray)
	//     console.log(selectOptionJsonArray)
	//     return false;

	// });

	$(document.body).on('change', '.preference_post', function() {
		var selecteditem = $(this);
		$('.preference_post').each(function(index, value) {
			var item = $(this);
			if (item.val() != '' && (!selecteditem.is(item))) {
				if (item.val() === selecteditem.val()) {
					selecteditem.val("");
					alert("Post Already Selected");
					return false;
				}
			}
		});
	});

	$(document.body).on('change', '.preference_select', function() {
		var selecteditem = $(this);
		$('.preference_select').each(function(index, value) {
			var item = $(this);
			if (item.val() != '' && (!selecteditem.is(item))) {
				if (item.val() === selecteditem.val()) {
					selecteditem.val("");
					alert("Preference Already Selected");
					return false;
				}
			}
		});


	});
</script>
@endpush