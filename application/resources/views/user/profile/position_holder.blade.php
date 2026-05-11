@extends('layouts/layout')
@section('content')
<div class="row">
	<!-- <div class="col-md-2">
		<div class="left-sidebar">
			<div>
				<ul>
					<li> <a href="{{ route('dashboard') }}"><span class="icons icon-arrow-left"></span> Dashboard</a></li>
					<li><a href="{{ route('profile') }}"><span class="icons icon-arrow-left"></span>Applicant’s Profile</a></li>
				</ul>
			</div>
		</div>
	</div> -->
	<div class="col-md-12">
		<div class="bhoechie-tab-container">
			<div class="row">
				<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
					<div class="bhoechie-tab-content">
						<div class="form-scroll">
							<form action="{{url('save_position_holder_award')}}" method="post" id="ajxReload" enctype="multipart/form-data" class="needs-validation" novalidate="">
								@csrf
								<div>
									<div class="row">
										<!-- <div class="col-md-12">
											<h5 class="subheading">A. Basic Details/सामान्य विवरण</h5>
										</div> -->
										<div class="col-md-12">
                                            <h5 class="subheading">Nomination Form for 1st, 2nd & 3rd Position Holder  / प्रथम, द्वितीय और तृतीय स्थान के विजेताओं को हेतु नामांकन</h5>
                                        </div>
                                        <!-- basic Detail -->
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label>1. Name / नाम</label>
                                                <div class="input-group">
                                                    <input type="text" class="form-control" value="{{$user->fullname}}" readonly>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label>2. Aadhar Number / आधार कार्ड</label>
                                                <div class="input-group">
                                                    <input type="text" class="form-control" value="{{$user->aadhar_no}}" readonly>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label>3. Mobile Number / मोबाइल नंबर</label>
                                                <div class="input-group">
                                                    <input type="text" class="form-control" value="{{$user->mobile}}" readonly>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label>4. Email ID / ईमेल आईडी</label>
                                                <div class="input-group">
                                                    <input type="text" class="form-control" value="{{$user->email}}" readonly>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- end basic detail -->
                                        <div class="col-md-12">
                                            <h5 class="subheading">A. Basic Details/सामान्य विवरण</h5>
                                        </div>
										<div class="col-md-6">
											<div class="form-group">
												<label class="placeholder">1. Which Sport do/did you play?<br>कौन सा खेल खेलते थे/हैं?<span class="text-danger">*</span></label>
												<select class="form-select sport_type" id="select1" name="sport_type" required>
													<option value="">Select</option>
													@foreach ($sport_type as $type)
													<option value="{{$type->id}}" {{ $selected_sport == $type->id ? 'selected' : '' }} {{ old('sport_type') === $type->id ? 'selected' : '' }}>{{$type->name}}</option>
													@endforeach
												</select>
											</div>
										</div>
										<!-- <div class="col-md-4">
											<div class="form-group">
											<label class="placeholder">Position as a Sportsperson <span class="text-danger">*</span></label>
											<input type="text" class="form-control" value="10" name="s_postion" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');" required>
											</div>
										</div> -->
										<div class="col-md-6">
											<div class="form-group">
												<label class="placeholder">2. Highest Educational Qualification<br>उच्चतम शैक्षणिक योग्यता <span class="text-danger">*</span></label>
												<select class="form-control dropdown form-select" required id="qualification" name="qualification">
													<option value="" selected="selected" disabled="disabled">Select</option>
													<option {{ old('qualification') === "10" ? 'selected' : '' }} value="10">10th / High School</option>
													<option {{ old('qualification') === "12" ? 'selected' : '' }} value="12">12th / Intermediate</option>
													<option {{ old('qualification') === "graduation" ? 'selected' : '' }} value="graduation">Graduation</option>
													<option {{ old('qualification') === "master_degree" ? 'selected' : '' }} value="master_degree">Master Degree</option>
													<option {{ old('qualification') === "other" ? 'selected' : '' }} value="other">Other</option>
												</select>
											</div>
										</div>

										<div class="col-md-6" id="otherQualificationBox" style="display:none;">
    										<div class="form-group">
        										<label>Specify Other Qualification</label>
        										<input type="text" class="form-control" name="other_qualification" placeholder="Enter your qualification">
    										</div>
										</div>

										<div class="col-md-6">
											<div class="form-group">
												<label>3. Upload Domicile Certificate of UP<br>उत्तर प्रदेश का मूल निवास प्रमाण पत्र अपलोड करें<span class="text-danger">*</span></label>
												<div class="input-group">
													<input type="file" value="{{old('domicile_certificate') }}" name="domicile_certificate" class="form-control" onchange="getfileext(this.value,2)" id="File2" aria-describedby="inputGroupFileAddon05" aria-label="Upload" required>
													<!-- <a  class="btn btn-secondary" id="A4">View</a> -->
												</div>
												<span class="note">(File Format: jpeg, jpg, Pdf | Max File Size: 2 MB)<br>(फाइल का प्रारूप: JPEG/JPG/PDF | फाइल का अधिकतम साइज़: 2 MB)</span>
											</div>
										</div>
										<div class="col-md-6">
											<div class="form-group">
												<label>4. Upload Certificate of Highest Educational Qualification<br>उच्चतम शैक्षणिक योग्यता का प्रमाणपत्र अपलोड करें<span class="text-danger">*</span></label>
												<div class="input-group">
													<input type="file" name="qualification_doc" class="form-control" onchange="getfileext(this.value,1)" id="File1" aria-describedby="inputGroupFileAddon05" aria-label="Upload" required>
													<!-- <a  class="btn btn-secondary" id="A4">View</a> -->
												</div>
												<span class="note">(File Format: jpeg, jpg, Pdf | Max File Size: 2 MB)<br>(फाइल का प्रारूप: JPEG/JPG/PDF | फाइल का अधिकतम साइज़: 2 MB)</span>
											</div>
										</div>
										<div class="col-md-12">
											<h5 class="subheading">B. Competition Details/प्रतियोगिता विवरण</h5>
										</div>
										{{-- <div class="col-md-4">
											<div class="form-group">
												<label class="placeholder">Event Type<br>प्रकार<span class="text-danger">*</span></label>
												<select class="form-select" name="event_type" required>
													<option value="">Select</option>
													<option {{old('event_type')=='Individual'?'Selected':''}} value="Individual">Individual</option>
													<option {{old('event_type')=='Team Game'?'Selected':''}} value="Team Game">Team Game</option>
												</select>
											</div>
										</div>
										<div class="col-md-4">
											<div class="form-group">
												<label class="placeholder">Competition Name<br>
													प्रतियोगिता का नाम <span class="text-danger">*</span></label>
												<input onkeypress='return ((event.charCode >= 65 && event.charCode <= 90) || (event.charCode >= 97 && event.charCode <= 122) || (event.charCode == 32))' type="text" class="form-control"  name="competition_name" required>
											</div>
										</div>
										<div class="col-md-4">
											<div class="form-group">
												<label class="placeholder">Venue Name<br>स्थल का नाम<span class="text-danger">*</span></label>
												<input onkeypress='return ((event.charCode >= 65 && event.charCode <= 90) || (event.charCode >= 97 && event.charCode <= 122) || (event.charCode == 32))' type="text" class="form-control"  name="venue_name" required>
											</div>
										</div>
										<input type="hidden" name="dob" value={{$dob}} id="dob" />
										<div class="col-md-4">
											<label class="placeholder">Date of Competition/प्रतियोगिता की तिथि<span class="text-danger">*</span></label>
											<div class="row">
												<div class="col-md-6">
													<div class="form-group">
														<label class="placeholder">From <span class="text-danger">*</span></label>
														<input type="text" class="form-control" onkeypress="return false"  autocomplete="off" required value="{{old('competition_from_date')}}" name="competition_from_date" data-language="en" placeholder="DD/MM/YYYY" required>
													</div>
												</div>
												<div class="col-md-6">
													<div class="form-group">
														<label class="placeholder">To <span class="text-danger">*</span></label>

													</div>
												</div>
												<span id="note5" style=" color: red; " class="note5">If the Sports Certificate (3 years prior to the current year) of the competition has been attached then it is mandatory to attach its affidavit and submit the original copy of the affidavit along with the application form to the Directorate of Sports, U.P.</span>
											</div>
										</div>
										<div class="col-md-4" id="affidavit">
											<div class="form-group">
												<label>Upload Affidavit of Award Certificate<br>पुरस्कार प्रमाणपत्र का शपथ पत्र अपलोड करें <span class="text-danger">*</span></label>
												<div class="input-group">
													<input type="file" name="award_certificate_affidavit" class="form-control" onchange="getfileext(this.value,5)" id="File5" aria-describedby="inputGroupFileAddon05" aria-label="Upload">
													<!-- <a  class="btn btn-secondary" id="A4">View</a> -->
												</div>
												<span class="note">(File Format: jpeg, jpg, Pdf | Max File Size: 2 MB)<br>(फाइल का प्रारूप: JPEG/JPG | फाइल का अधिकतम साइज़: 2 MB)</span>
											</div>
										</div>
										<div class="col-md-4">
											<div class="form-group">
												<label class="placeholder">Earned Achievement<br>उपलब्धियां<span class="text-danger">*</span></label>
												<!-- <input onkeypress='return ((event.charCode >= 65 && event.charCode <= 90) || (event.charCode >= 97 && event.charCode <= 122) || (event.charCode == 32))' type="text" class="form-control" value="{{old('earned_achievement') }}" name="earned_achievement" pattern="[A-Za-z]+" required> -->
												<select class="form-select" name="earned_achievement" required>
													<option value="">Select</option>
													<option {{old('earned_achievement')=='Gold'?'Selected':''}} value="Gold">Gold</option>
													<option {{old('earned_achievement')=='Silver'?'Selected':''}} value="Silver">Silver</option>
													<option {{old('earned_achievement')=='Bronze'?'Selected':''}} value="Bronze">Bronze</option>
												</select>
											</div>
										</div>
										<div class="col-md-4">
											<div class="form-group">
												<label class="placeholder">Type of Competition<br>प्रतियोगिता का प्रकार<span class="text-danger">*</span></label>
												<select class="form-select" name="competition_type" required>
													<option value="">Select</option>
													<option {{old('competition_type')=='National'?'Selected':''}} value="National">National</option>
													<option {{old('competition_type')=='International'?'Selected':''}} value="International">International</option>
													<option {{old('competition_type')=='Khelo India Youth'?'Selected':''}} value="Khelo India Youth">Khelo India Youth</option>
													<option {{old('competition_type')=='All India University/Khelo India University'?'Selected':''}} value="All India University/Khelo India University">All India University/Khelo India University</option>
												</select>
											</div>
										</div>
										<div class="col-md-12">
											<div class="form-group">
												<table class="table" id="dynamic_field3">
													<thead>
														<td colspan="2" style="padding: 0;"><label>Upload Self-attested Copy of Award Certificate/पुरुस्कार प्रमाणपत्र का शपथ पत्र अपलोड करें<span class="text-danger">*</span></label></td>
														</tr>
													</thead>
													<tbody>
														<tr>
															<td style="width: 50%;">
																<input type="file" name="award_certificate_add[]" class="form-control" onchange="getfileext(this.value,3)" id="File3" aria-describedby="inputGroupFileAddon05" aria-label="Upload" required>
															</td>
															<td><button type="button" name="add" id="add3" class="btn btn-primary mt-1">Add award</button></td>
														</tr>
													</tbody>
												</table>
												<span class="note">(File Format: jpeg, jpg, Pdf | Max File Size: 2 MB)<br>(फाइल का प्रारूप: JPEG/JPG/PDF | फाइल का अधिकतम साइज़: 2 MB)</span>
											</div>
										</div> --}}
								{{--  --}}
								<input type="hidden" name="dob" value={{$dob}} id="dob" />
								<div class="col-md-12">
									<div class="form-group">
										<table class="table table-bordered" id="dynamic_field">
											<thead>
												<tr>
													<td rowspan="2"><label>Type of Competition <br>प्रतियोगिता का प्रकार</label> <span class="text-danger">*</span>
													</td>
													<td rowspan="2"><label>Event Type<br>आयोजन का प्रकार</label> <span class="text-danger">*</span>
													</td>
													<td rowspan="2"><label>Event Name<br>आयोजन का नाम</label> <span class="text-danger">*</span>
													</td>
													<td rowspan="2"><label> Earned Medals<br>अर्जित पदक</label> <span class="text-danger">*</span>
													</td>
													<td colspan="2" class="text-center"><label>Period of Competition<br>प्रतियोगिता की अवधि</label> <span class="text-danger">*</span>
													</td>
													<td rowspan="2"><label>Venue Name</br>स्थल का नाम</label> <span class="text-danger">*</span< /td>
													<td rowspan="2"><label>Upload Relevant Certificate<br>प्रासंगिक प्रमाण पत्र अपलोड करें<span class="text-danger">*</span><br><span class="note">(File Format/फाइल का प्रारूप: JPEG/JPG/PDF | Max File Size/फाइल का अधिकतम साइज़: 2 MB)</span>
														</label>
													</td>
													<td rowspan="2"><label>Event Detail</br>आयोजन का विवरण<span class="text-danger">*</span></label> </td>
													<td rowspan="2"></td>
												</tr>
												<tr>
													<td><label>From </label>
													</td>
													<td><label>To </label>
													</td>
												</tr>
											</thead>
											<tbody>
												<tr id="row1">
													<td>
														<select name="competition_name[]" onchange="get_event(1,1)" required  class="form-select competition_name">
															<option value="">Select</option>
															@foreach ($competition as $type)
															<option value="{{$type->id}}" >{{$type->name}}</option>
															@endforeach
														</select>
													</td>
													<td>
														<select class="form-select event_type" onchange="get_event(1,1)" name="event_type[]" required>
															<option value="">Select</option>
															<option value="1">Individual</option>
															<option value="2">Team</option>
															<option value="3">Both</option>

														</select>
													</td>
													<td>
														<select class="form-select event_name" name="event_name[]" required>
															<option value="">Select</option>
															@foreach ($event as $type)
															<option value="{{$type->id}}" >{{$type->name}}</option>
															@endforeach
														</select>
													</td>
													<td style="width: 135px;">
														<select class="form-select" name="earned_medals[]" required>
															<option value="">Select</option>
															<option  value="1st / Gold">1st / Gold</option>
															<option  value="2nd / Silver">2nd / Silver</option>
															<option  value="3rd / Bronze">3rd / Bronze</option>
														</select>
													</td>
													<td style="width: 120px;">
														<input type="text" id="doc" class="form-control firstDate " onpaste="return false;" ondrop="return false;" onkeypress="return false" autocomplete="off" required value="{{old('competition_from_date')}}" name="competition_from_date[]" data-language="en" placeholder="dd-mm-yyyy" required>
													</td>
													<td style="width: 120px;">
														<input type="text" class="form-control to-to-to " onpaste="return false;" ondrop="return false;" onkeypress="return false" id="to" autocomplete="off" required value="{{old('competition_to_date')}}" name="competition_to_date[]" data-language="en" placeholder="dd-mm-yyyy" required>
													</td>
													<td><input type="text" required  name="place[]" placeholder="Place" class="form-control name_email">
													</td>
													<td>
														<div class="input-group">
															<input type="file" required name="award_certificate[]" class="form-control" onchange="getfileext(this.value,3)" id="File3" aria-describedby="inputGroupFileAddon05" aria-label="Upload">
														</div>
													</td>
													<td><input type="text" required value="{{old('event_detail') }}" name="event_details[]" placeholder="Event Detail" class="form-control"></td>
													<td><button type="button" name="add" id="add" class="btn btn-primary mt-1">Add</button>
													</td>
												</tr>
											</tbody>
										</table>
									</div>
								</div>
								{{--  --}}

										<div class="col-md-12">
											<h5 class="subheading">C. Bank Account Details/बैंक खाते का विवरण</h5>
										</div>
										<div class="col-md-4">
											<div class="form-group">
												<label class="placeholder">1. IFSC<br>आईएफएससी<span class="text-danger">*</span></label>
												<input type="text" value="{{old('bank_ifsc') }}" pattern="[A-Z]{4}0[A-Z0-9]{6}" name="bank_ifsc" required class="form-control" onblur="getBankDetails(this.value)" id="ifscupper">
											</div>
										</div>
										<div class="col-md-4">
											<div class="form-group">
												<label class="placeholder">2. Name of Bank<br>बैंक का नाम<span class="text-danger">*</span></label>
												<input type="text" name="bank_name" onkeypress='return ((event.charCode >= 65 && event.charCode <= 90) || (event.charCode >= 97 && event.charCode <= 122) || (event.charCode == 32))' pattern="^[A-Za-z -]+$" value="{{old('bank_name') }}" required class="form-control" id="bankName">
											</div>
										</div>
										<div class="col-md-4">
											<div class="form-group">
												<label class="placeholder">3. Branch<br>शाखा<span class="text-danger">*</span></label>
												<input type="text" name="bank_branch" onkeypress='return ((event.charCode >= 65 && event.charCode <= 90) || (event.charCode >= 97 && event.charCode <= 122) || (event.charCode == 32))' pattern="^[A-Za-z -]+$" value="{{old('bank_branch') }}" required class="form-control" id="bank_branch">
											</div>
										</div>
										<div class="col-md-4">
											<div class="form-group">
												<label class="placeholder">4. Bank Account No.<br>बैंक खाता संख्या<span class="text-danger">*</span></label>
												<input type="text" value="{{old('bank_acc_no') }}" pattern=".{9,18}" minlength="9" maxlength="18" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');" name="bank_acc_no" required class="form-control">
											</div>
										</div>

										<div class="col-md-4">
											<div class="form-group">
												<label class="placeholder">5. Account Holder Name<br>खाता धारक का नाम<span class="text-danger">*</span></label>
												<input type="text" onkeypress='return ((event.charCode >= 65 && event.charCode <= 90) || (event.charCode >= 97 && event.charCode <= 122) || (event.charCode == 32))' value="{{old('acc_holder_name') }}" pattern="^[A-Za-z -]+$" name="acc_holder_name" required class="form-control">
											</div>
										</div>
										<div class="col-md-4">
											<div class="form-group">
												<label class="placeholder">6. Mobile No. (registered with Bank Account)<br>मोबाइल नंबर (बैंक खाते के साथ जो पंजीकृत है)<span class="text-danger">*</span></label>
												<input type="text" value="{{old('mobile_registered_in_bank') }}" pattern="[6-9][0-9]{9}$" required maxlength="10" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');" name="mobile_registered_in_bank" class="form-control">
											</div>
										</div>
										<div class="col-md-12">
											<h5 class="subheading">D. Other Details/अन्य विवरण</h5>
										</div>
										<div class="col-md-6">
											<div class="form-group">
												<label>1. Upload PAN<br>पैन अपलोड करें<span class="text-danger">*</span></label>
												<div class="input-group">
													<input type="file" name="pan_doc" class="form-control" onchange="getfileext(this.value,5)" id="File5" aria-describedby="inputGroupFileAddon05" aria-label="Upload" required>
													<!-- <a  class="btn btn-secondary" id="A4">View</a> -->
												</div>
												<span class="note">(File Format: jpeg, jpg, Pdf | Max File Size: 2 MB)<br>(फाइल का प्रारूप: JPEG/JPG/PDF | फाइल का अधिकतम साइज़: 2 MB)</span>
											</div>
										</div>
										<div class="col-md-6">
											<div class="form-group">
												<label>2. Sports certificate issued by the general secretary of the concerned sports association<br>संबंधित खेल संघ के महासचिव द्वारा जारी खेल प्रमाण पत्र<span class="text-danger">*</span></label>
												<div class="input-group">
													<input type="file" name="sport_certificate" class="form-control" onchange="getfileext(this.value,6)" id="File6" aria-describedby="inputGroupFileAddon05" aria-label="Upload" required>
													<!-- <a  class="btn btn-secondary" id="A4">View</a> -->
												</div>
												<span class="note">(File Format: jpeg, jpg, Pdf | Max File Size: 2 MB)<br>(फाइल का प्रारूप: JPEG/JPG/PDF | फाइल का अधिकतम साइज़: 2 MB)</span>
											</div>
										</div>
										<div class="col-md-6">
											<div class="form-group">
												<label>3. First Page of Bank Passbook<br>बैंक पासबुक का प्रथम पृष्ठ<span class="text-danger">*</span></label>
												<div class="input-group">
													<input type="file" name="passbook_doc" class="form-control" onchange="getfileext(this.value,7)" id="File7" aria-describedby="inputGroupFileAddon05" aria-label="Upload" required>
													<!-- <a  class="btn btn-secondary" id="A4">View</a> -->
												</div>
												<span class="note">(File Format: jpeg, jpg, Pdf | Max File Size: 2 MB)<br>(फाइल का प्रारूप: JPEG/JPG/PDF | फाइल का अधिकतम साइज़: 2 MB)</span>
											</div>
										</div>
									</div>
									<div class="bhoechie-footer">
										<div class="row justify-content-center">
											<div class="col-md-4 d-grid">
												<button type="submit" class="btn btn-info">Save & Proceed/दर्ज करें व आगे बढ़ें</button>
											</div>
										</div>
									</div>
								</div>
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
</div>
@endsection
@push('custom-scripts')
<script>
	$(document).ready(function() {
		function disableBack() {
			window.history.forward()
		}

		window.onload = disableBack();
		window.onpageshow = function(evt) {
			if (evt.persisted) disableBack()
		}
	});
</script>
<script>
	// window.onload=()=>{
	//     $("#select1").select2();
	// }
	var start = parseInt($("#dob").val());
	var end = (new Date()).getFullYear();
	var yrRange = (start + 9) + ":" + end;
	$('#affidavit').hide();
	$('#note5').hide();
	// console.log((new Date()).getFullYear());
	var checkkk = 0;

	var i = 1;
	var length;
	//var addamount = 0;
	var addamount = 700;

	$("#add3").click(function() {


		addamount += 700;
		console.log('amount: ' + addamount);
		i++;
		$('#dynamic_field3').append('<tr id="row' + i + '"><td><div class="input-group"><input type="file" name="award_certificate_add[]" class="form-control"  onchange="getfileext(this.value,3' + i + ')" id="File3' + i + '" aria-describedby="inputGroupFileAddon05" aria-label="Upload" required></div></td><td><button type="button" name="remove" id="' + i + '" class="btn btn-danger mt-1 px-2 btn_remove"><span class="far fa-trash-alt"></span></button></td></tr>');
	});

	$(document).on('click', '.btn_remove', function() {
		addamount -= 700;
		console.log('amount: ' + addamount);


		var button_id = $(this).attr("id");
		$('#row' + button_id + '').remove();
	});
</script>
<script>
	$(document).ready(function() {
		var i = 1;
		var length;
		//var addamount = 0;
		var addamount = 700;
		var start = $("#dob").val();
		var end = (new Date()).getFullYear();
		var yrRange = start + ":" + end;
		var checkkk = 0;
		// $(".dateTimeee").datepicker({
		// 	changeMonth: true,
		// 	changeYear: true,
		// 	// minDate: '-60Y',
		// 	minDate: new Date(start, 4 - 1, 1),
		// 	yearRange: yrRange,
		// 	maxDate: '0',
		// 	dateFormat: 'dd-mm-yy'
		// });

		$("#doc").datepicker({
			changeMonth: true,
			changeYear: true,
			minDate: '-60Y',
			yearRange: yrRange,
			maxDate: '0',
			dateFormat: 'dd-mm-yy'
		});
		$("#doc").change(function() {
			console.log(checkkk)
			var min = new Date($("#doc").val());
			var st = $("#doc").datepicker('getDate');
			var start = new Date(st);
			if (checkkk == 0) {
				$("#to").datepicker({
					changeMonth: true,
					changeYear: true,
					minDate: start,
					yearRange: yrRange,
					maxDate: '0',
					dateFormat: 'dd-mm-yy'
				});
			} else {
				$("#to").datepicker('option', {
					minDate: start
				});
			}
			checkkk = 1;
			// }, 5);
		})

		$("#add").click(function() {
			addamount += 700;
			console.log('amount: ' + addamount);
			i++;
			$('#dynamic_field').append('<tr id="row' + i + '"><td><select name="competition_name[]" onchange="get_event(' + i + ',1)" required class="form-select competition_name" class="form-control name_list"><option value="">Select</option>@foreach ($competition as $type) <option  value="{{$type->id}}">{{$type->name}}</option> @endforeach</td><td><select onchange="get_event(' + i + ',1)" class="form-select event_type" name="event_type[]" required=""><option value="">Select</option><option value="1">Individual</option><option value="2">Team</option><option value="3">Both</option></select></td><td><select class="form-select event_name" name="event_name[]" required=""> <option value="">Select</option>  </select></td><td><select class="form-select" name="earned_medals[]" required> <option value="">Select</option> <option   value="1st / Gold">1st / Gold</option> <option value="2nd / Silver">2nd / Silver</option> <option  value="3rd / Bronze">3rd / Bronze</option></select></td><td><input type="text" class="form-control firstDate dateTimeee" onchange="checkDate('+i+')" onpaste="return false;" ondrop="return false;" onkeypress="return false" id="doc' + i + '" autocomplete="off" required   name="competition_from_date[]" data-language="en" placeholder="dd-mm-yyyy" required></td><td><input type="text" class="form-control to-to-to dateTimeee"  onchange="checkDate('+i+')" onpaste="return false;" ondrop="return false;" onkeypress="return false" id="' + i + 'to" autocomplete="off" required  name="competition_to_date[]" data-language="en" placeholder="dd-mm-yyyy" required></td><td><input type="text" required  name="place[]" placeholder="Place" class="form-control name_email"></td><td><div class="input-group"><input type="file" name="award_certificate[]" required class="form-control"   onchange="getfileext(this.value,2' + i + ')" id="File2' + i + '" aria-describedby="inputGroupFileAddon05" aria-label="Upload"></div></td><td><input type="text" required value="" name="event_details[]" placeholder="Event Detail" class="form-control"></td><td><button type="button" name="remove" id="' + i + '" class="btn btn-danger mt-1 px-2 btn_remove"><span class="far fa-trash-alt"></span></button></td></tr>');
			var start = $("#dob").val();
			var end = (new Date()).getFullYear();
			var yrRange = start + ":" + end;
			var checkkk = 0;
			$(".dateTimeee").datepicker({
				changeMonth: true,
				changeYear: true,
				minDate: '-60Y',
				minDate: new Date(start, 4 - 1, 1),
				yearRange: yrRange,
				maxDate: '0',
				dateFormat: 'dd-mm-yy'
			});
		});
		$(document).on('click', '.btn_remove', function() {
			addamount -= 700;
			console.log('amount: ' + addamount);
			var button_id = $(this).attr("id");
			$('#row' + button_id + '').remove();
		});
	});

	

</script>

<script>
$(document).ready(function(){

    $("#qualification").change(function(){

        var value = $(this).val();

        if(value === "other"){
            $("#otherQualificationBox").show();
        }else{
            $("#otherQualificationBox").hide();
        }

    });

});
</script>
<script>
$(document).ready(function(){

    if($("#qualification").val() === "other"){
        $("#otherQualificationBox").show();
    }

});
</script>
@endpush
