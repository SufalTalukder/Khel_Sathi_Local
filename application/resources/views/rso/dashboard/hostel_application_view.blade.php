@extends('layouts/rso_layout')
@section('content')


<div class="pageheader" id="menu-margin">
	<h4 class="mb-0">Application Preview
		<button type="button" data-print="modal" class="btn btn-sm  btn-outline-primary ms-2 float-end " onclick="PrintDoc()" style="width: auto;"><span class="icons icon-arrow-right"></span>Print</button>
		<a href="javascript: history.go(-1)" class="btn btn-outline-danger btn-sm backbtn float-end "><span class="icons icon-arrow-left"></span>Back/पीछे</a>
	</h4>
</div>
<div class="bhoechie-tab-container">
	<div class="bg-white p-3" id="prodiv">
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
		<div class="table-responsive">
			<table id="dataTable" class="table table-bordered" border="1" style="border-collapse: collapse; width: 100%;">
				<tbody>

                    <tr>
                        <th colspan="6" style="color: #9e134c;font-size: 15px;" class="bg-light">Basic Details/सामान्य विवरण</th>
                      </tr>
                         <tr>
                        <td colspan="6"><strong style="color: #14bb6d;">A. Registration Details/पंजीकरण संबंधी विवरण</strong></td>
                      </tr>

                      <tr>

                        <td><strong>1. Application No./आवेदक का नाम</strong></td>
                        <td>@if ($userDetails->application_no)
                            {{$userDetails->application_no}}
                            @else
                            NA
                        @endif </td>
                        <td><strong>2. Applicant&rsquo;s Name/आवेदक का नाम</strong></td>
                        <td>{{$userDetails->name}} </td>

                        <td rowspan="7" colspan="2"><b>Photograph of Applicant/आवेदक का फोटो</b><br/>
                          <div class="text-center"> <img src="{{asset('hostelapplicant/applicant_file/')}}/@isset($userDetails->applicationBasicDetasils){{$userDetails->applicationBasicDetasils->applicant_file}} @endisset" class="img-fluid" style="width: 140px;"/> </div></td>
                      </tr>
                      <tr>
                        <td><strong>3. Date of Birth/जन्मतिथि </strong></td>
                        <td>{{ dmy($userDetails->dob) }}</td>
                        <td><strong>4. Aadhaar Number/आधार नंबर</strong></td>
                        <td>{{$userDetails->aadhar}}</td>
                       </tr>
                      <tr>
                        <td><strong>Aadhar Card/आधार कार्ड</strong></td>
                        <td><a href="{{asset('hostelapplicant/aadhar_card_file/')}}/@isset($userDetails->applicationBasicDetasils){{$userDetails->applicationBasicDetasils->aadhar_card_file}} @endisset" class="btn btn-success btn-xs" target="_blank">Uploaded/अपलोड किए गए</a></td>

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

                      <td><strong>8.  Are you existing student of Sports College?</strong></td>
                      <td>@if ($userDetails->existing_student == 1)
                        Yes
                      @else
                    No
                      @endif</td>
                    </tr>


                    <tr>
                        @if ($userDetails->applicationBasicDetasils->admission_no)
                        <td><strong>9. Admission No.</strong></td>
                        <td>
                        {{  $userDetails->applicationBasicDetasils->admission_no}}
                       </td>
                       @endif
                       @if ($userDetails->applicationBasicDetasils->roll_no)
                        <td><strong>10. Roll No.</strong></td>
                        <td>
                        {{  $userDetails->applicationBasicDetasils->roll_no}}
                       </td>
                       @endif
                      </tr>

                      <tr>

                       @if ($userDetails->applicationBasicDetasils->student_id_card)
                        <td><strong>11. Student Id Card</strong>
                            <td><a href="{{asset('hostelapplicant/student_id_card/')}}/@isset($userDetails->applicationBasicDetasils){{$userDetails->applicationBasicDetasils->student_id_card}} @endisset" class="btn btn-success btn-xs" target="_blank">Uploaded/अपलोड किए गए</a></td>

                       </td>
                       @endif



                       @isset($userDetails->applicationBasicDetasils)
   @if ($userDetails->applicationBasicDetasils->sports_college)
    <td><strong>12. Sports College</strong>
        <td>{{$userDetails->applicationBasicDetasils->sports_college}} </td>

   </td>
   @endif
   @endisset
                      </tr>


                      <tr>
  @isset($userDetails->applicationBasicDetasils)
   @if ($userDetails->applicationBasicDetasils->national_champtionship_document)
    <td><strong>13. Student Id Card</strong>
        <td><a href="{{asset('hostelapplicant/national_champtionship_document/')}}/@isset($userDetails->applicationBasicDetasils){{$userDetails->applicationBasicDetasils->national_champtionship_document}} @endisset" class="btn btn-success btn-xs" target="_blank">Uploaded/अपलोड किए गए</a></td>

   </td>
   @endif
   @endisset
  </tr>
                        <td colspan="64"><strong style="color: #14bb6d;">B. Applicant’s Details/आवेदक का विवरण</strong></td>
                        </tr>
                      <tr>
                        <td><strong>1. District/जनपद </strong></td>
                        <td> @isset($userDetails->applicationBasicDetasils){{$userDetails->applicationBasicDetasils->district->city}}   @endisset</td>
                        <td><strong>2. Regional/District Sports Office/क्षेत्रीय खेल कार्यालय</strong></td>
                        <td> @isset($userDetails->applicationBasicDetasils->region_sport_office_id){{regionsportname($userDetails->applicationBasicDetasils->region_sport_office_id)}}  @endisset</td>
                      </tr>
                      <tr>
                        <td><strong>3. Sports Name /खेल का नाम</strong></td>
                        <td>  @isset($userDetails->applicationBasicDetasils){{sport_name_hostel($userDetails->applicationBasicDetasils->sports)}}  @endisset</td>
                         <td><strong>4. Category/वर्ग</strong></td>
                        <td> @isset($userDetails->applicationBasicDetasils){{$userDetails->applicationBasicDetasils->category}} @endisset </td>
                      </tr>
                      <tr>
                        <td><strong>5. Sub Category/उपश्रेणी</strong></td>
                        <td> @isset($userDetails->applicationBasicDetasils){{$userDetails->applicationBasicDetasils->sub_category}} @endisset </td>
                        <td><strong>6. Father&rsquo;s Name/पिता का नाम </strong></td>
                        <td>@isset($userDetails->applicationBasicDetasils){{$userDetails->applicationBasicDetasils->father_name}} @endisset </td>
                        <td rowspan="2" colspan="2"><b>Signature  of Applicant/आवेदक के हस्ताक्षर</b><br />
                          <div class="text-center"> <img src="{{asset('hostelapplicant/applicant_sign/')}}/@isset($userDetails->applicationBasicDetasils){{$userDetails->applicationBasicDetasils->applicant_sign}} @endisset"  class="img-fluid" style="width: 140px;" /> </div></td>
                      </tr>
                      <tr>
                        <td><strong>7. Father's Occupation/पिता का व्यवसाय </strong></td>
                        <td>@isset($userDetails->applicationBasicDetasils)	{{$userDetails->applicationBasicDetasils->father_occuption}} @endisset </td>
                        <td><strong>8. Mother&rsquo;s Name/माता का नाम</strong></td>
                        <td>@isset($userDetails->applicationBasicDetasils)	{{$userDetails->applicationBasicDetasils->mother_name}} @endisset</td>
                      </tr>
                      <tr>
                        <td style="width: 15%"><strong>9. Mother's Occupation/माता का व्यवसाय</strong></td>
                        <td style="width: 20%">@isset($userDetails->applicationBasicDetasils)	{{$userDetails->applicationBasicDetasils->mother_occuption}} @endisset</td>
                        <td style="width: 15%"><strong>10. Height (in Centimetre)/लंबाई (सेंटीमीटर में)</strong></td>
                        <td style="width: 20%">@isset($userDetails->applicationBasicDetasils)	{{$userDetails->applicationBasicDetasils->height}} @endisset</td>
                        <td style="width: 15%"><strong>11. Weight (in KG)/वजन (किलोग्राम में)</strong></td>
                        <td style="width: 15%">@isset($userDetails->applicationBasicDetasils)	{{$userDetails->applicationBasicDetasils->weight}} @endisset</td>
                      </tr>
                      <tr>
                        <td><strong>12. Blood Group/ब्लड ग्रुप</strong></td>
                        <td>@isset($userDetails->applicationBasicDetasils)	{{$userDetails->applicationBasicDetasils->blood_group}} @endisset</td>
                        <td><strong>13. Class for which applicant is seeking admission/आवेदक किस कक्षा में प्रवेश चाह रहे हैं</strong></td>
                        <td>@isset($userDetails->applicationBasicDetasils)	{{$userDetails->applicationBasicDetasils->class_for_which_admission}} @endisset</td>
                        <td><b>Domicile of Uttar Pradesh/उत्तर प्रदेश का मूल निवासी</b></td>
                        <td> Uttar Pradesh/उत्तर प्रदेश </td>
                      </tr>
                      <tr>
                        <td><strong>Upload Domicile Certificate/निवास प्रमाणपत्र अपलोड करें </strong></td>
                        <td><a href="{{asset('hostelapplicant/applicant_domicle/')}}/@isset($userDetails->applicationBasicDetasils){{$userDetails->applicationBasicDetasils->applicant_domicle}} @endisset" class="btn btn-success btn-xs" target="_blank">Uploaded/अपलोड किए गए</a></td>
                        <td><strong>Visible Identification Mark/दृश्यमान पहचान चिह्न</strong></td>
                        <td>@isset($userDetails->applicationBasicDetasils)	{{$userDetails->applicationBasicDetasils->identification_mark}} @endisset</td>
                        <td><strong>Number of Teeth/दांतों की संख्या</strong></td>
                        <td>@isset($userDetails->applicationBasicDetasils)	{{$userDetails->applicationBasicDetasils->number_of_teeth}} @endisset</td>
                      </tr>


                      <tr>

                            <td><strong>DOB certificate certified by School/registrar</strong></td>
                            <td><a href="{{asset('hostelapplicant/applicant_dob_certificate/')}}/@isset($userDetails->applicationBasicDetasils){{$userDetails->applicationBasicDetasils->applicant_dob_certificate}} @endisset" class="btn btn-success btn-xs" target="_blank">Uploaded/अपलोड किए गए</a></td>

                        <td ><strong>Is applicant suffering from Skin Disease/Fits/Other Disease? /क्या आवेदक त्वचा रोग/फिट्स/अन्य रोग से ग्रसित हैं? </strong></td>
                        <td>@isset($userDetails->applicationBasicDetasils)	{{$userDetails->applicationBasicDetasils->disease}} @endisset</td>
                        <td><strong>Upload Medical Certificate/चिकित्सकीय प्रमाणपत्र अपलोड करें</strong></td>
                        @if(isset($userDetails->applicationBasicDetasils) && $userDetails->applicationBasicDetasils->medical_certificate_file)
                        <td><a href="{{asset('hostelapplicant/medical_certificate_file/')}}/@isset($userDetails->applicationBasicDetasils){{$userDetails->applicationBasicDetasils->medical_certificate_file}} @endisset" class="btn btn-success btn-xs" target="_blank">Uploaded/अपलोड किए गए</a></td>
                          @else
                          <td>N/A</td>

                          @endif
                    </tr>

                    <tr>

                        <td><strong>Sub Sport</strong></td>
                        <td>@if($userDetails->applicationBasicDetasils->sub_sport_type){{sub_sport_name($userDetails->applicationBasicDetasils->sub_sport_type)}} @else NA @endif</td>


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
                        <td >@isset($userDetails->applicationCommunicationDetails){{$userDetails->applicationCommunicationDetails->p_email}} @endisset</td>
                        <td><strong>9.  PIN Code/पिन कोड</strong></td>
                        <td >@isset($userDetails->applicationCommunicationDetails){{$userDetails->applicationCommunicationDetails->p_pin}} @endisset</td>

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
                        <td >@isset($userDetails->applicationCommunicationDetails){{$userDetails->applicationCommunicationDetails->c_email}} @endisset</td>
                        <td><strong>9.  PIN Code/पिन कोड</strong></td>
                        <td >@isset($userDetails->applicationCommunicationDetails){{$userDetails->applicationCommunicationDetails->c_pin}} @endisset</td>


                    </tr>
                      <tr>
                        <td colspan="6"  style="color: #9e134c;font-size: 15px;" class="bg-light"><strong>Educational Qualification/शैक्षणिक योग्यता

                            </strong></td>
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
                    <?php if( $userDetails->payment_status==2){ ?>
                      <tr>
                        <td colspan="6"  style="color: #9e134c;font-size: 15px;" class="bg-light"><strong>Payment Details/भुगतान विवरण
                      </tr>
                      <tr>

                      @php
$challan =  DB::table('rajkosh_payment_response')
                       ->join('rajkosh_payment_request', 'rajkosh_payment_request.Depchallan', '=', 'rajkosh_payment_response.challan_no')
                       ->join('hostel_register', 'rajkosh_payment_request.application_no', '=', 'hostel_register.application_no')
                       ->where('hostel_register.application_no', $userDetails->application_no)
                       ->select('rajkosh_payment_request.Depchallan')
                       ->first()
@endphp
                                            <td>
                                                <b>Challan No</b>
                                            </td>
                                            <td>@isset($challan)  {{$challan->Depchallan}} @endisset</td>
                                            
                                            <td><b>Payment Status</b></td>
                                            <td>
                                            <?php if($userDetails->payment_status==1){ ?>
                                                <a href="javascript:void(0)" class="btn btn-warning btn-xs  disabled">Pending</a>
                                            <?php } ?>
                                            <?php if($userDetails->payment_status==2){ ?>
                                                <a href="javascript:void(0)" class="btn btn-success btn-xs  disabled">Accepted</a>
                                            <?php } ?>
                                            <?php if($userDetails->payment_status==3){ ?>
                                                <a href="javascript:void(0)" class="btn btn-danger btn-xs  disabled">Rejected</a>
                                            <?php } ?>
                                            </td>
                                            <td>
                                                <b>Amount</b>
                                            </td>
                                            <td>10 INR</td>
                                            </tr>
                                            <tr>
                                            <td>
                                                <b> Date</b>
                                            </td>
                                             <td>{{ dmy($userDetails->payment_allotment_fee_date != "" ? $userDetails->payment_allotment_fee_date : $userDetails->payment_date) }}</td>
                                        

                  
                                        
                                              </tr>
                                        <?php } ?>
						<td colspan="6" class="bg-light">
							<strong>Declaration</strong>
						</td>
					</tr>
					<tr>
						<td colspan="6">I declare that the above particulars are true to the best of my knowledge. If any of my facts are found to be wrong, my admission should be canceled, for which all responsibility will be mine. I have read all the facts thoroughly and after admission I will strictly follow the hostel rules.
						</td>
					</tr>
					<tr>
						<td colspan="6" align="center">
							<input type="checkbox" checked="checked" disabled> &nbsp; <b>I Agree</b>
						</td>
					</tr>
					<tr>
						<td colspan="3" align="center">
							<span>{{ $userDetails->applicationPreviewDetails->guardian_name}}</span><br>
							<b>Guardian Full Name</b>
						</td>
						<td colspan="3" align="center">
							<img src="{{url('public/hostelapplicant/guardian_sign')}}/{{$userDetails->applicationPreviewDetails->guardian_sign}} " class="img-fluid" style="width: 140px;  height: 50px;"><br>
							<b>Guardian Signature</b>
						</td>
					</tr>
					@if($userDetails->status == 2 || $userDetails->status == 1 )
					<tr align="center">
						@if ($userDetails->status == 1)
						<td colspan="6" align="center">
							<strong>
								Application Status : </strong> <a href="#" class="btn btn-success btn-sm  @if($userDetails->status == 2  || $userDetails->status == 1  ) disabled @endif" data-bs-toggle="modal" data-bs-target="#acceptHostel">Accepted</a>
						</td>
						@else
						<td colspan="6" align="center">
							<strong>
								Application Status : </strong> <a href="#" class="btn btn-danger btn-sm @if($userDetails->status == 2  || $userDetails->status == 1  ) disabled @endif" data-bs-toggle="modal" data-bs-target="#rejectHostel">Rejected</a> <br>
                <strong>  Reason : </strong>  {{ $userDetails->remark }}
						</td>
						@endif
					</tr>
					@else
					<tr>

<?php //dd($userDetails->payment_status); ?>

<?php if($userDetails->payment_status == 3){ ?>
<td colspan="6" align="center">
	<a href="#" class="btn btn-info me-2 btn-sm" >Payment Rejected</a>

</td>

<?php }	?>

@if($userDetails->status == 3 )
<tr>
    <td colspan="6" align="center">
@if ($mark_query->count() == 0)
<a href="#" class="btn btn-warning me-2 btn-sm " data-bs-toggle="modal" data-bs-target="#query_marked_hostel">Mark Query</a>
@endif
</td>



</tr>
<tr>
  @if(Auth::guard('admin')->user()->admin_role !=18)
    <td colspan="6" align="center">
        @if($userDetails->payment_status == 2 )
            <a href="#" class="btn btn-success me-2 btn-sm  @if($userDetails->status == 2  || $userDetails->status == 1  ) disabled @endif" data-bs-toggle="modal" data-bs-target="#acceptHostel">Accept</a>
            @endif
            <a href="#" class="btn btn-danger btn-sm @if($userDetails->status == 2  || $userDetails->status == 1  ) disabled @endif" data-bs-toggle="modal" data-bs-target="#rejectHostel">Reject</a>
        </td>

@endif

    </tr>

@endif


					@endif
				</tbody>
			</table>
		</div>
		{{-- @if(count($queryData)>0) --}}

		@if ($mark_query->count() > 0)

		<div class="noprint">
			<h3 class="bg-light p-1"> Details of Queries </h3>
			<div class="table-responsive">
				<table id="dataTable" class="table table-bordered" border="1" style="border-collapse: collapse; width: 100%;" id="query-form-marked-table">
					<thead>
						<tr>
							<th>S.No.</th>
							<th>Subject</th>
							<th>Remark</th>
							<th>Related Document</th>



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
								<a href="{{asset('queryDoc')}}/{{$item->query_doc}}" class="btn btn-success btn-sm" data-bs-toggle="modal" target="_blank">View</a>
                                @else
                                NA
                                @endif
							</td>



						</tr>
						@endforeach
					</tbody>
				</table>
			</div>
		</div>
		@endif
	</div>
</div>

@endsection
