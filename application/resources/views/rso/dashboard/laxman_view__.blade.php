@extends( 'layouts/admin_layout' )
@section( 'content' )


<div class="pageheader" id="menu-margin">
	<h4 class="mb-0"> &nbsp;
	<a href="{{ asset('assets_admin/laxman') }}"  class="btn btn-sm  btn-outline-primary ms-2 float-end " ><span class="icons icon-list"></span> Back to Dashboard</a>
		 <button type="button" data-print="modal" class="btn btn-sm  btn-outline-primary ms-2 float-end "   onclick="PrintDoc()"><span class="icons icon-printer"></span> Print/प्रिंट</button>
	</h4>
</div>


<div class="bhoechie-tab-container">
	<div class="row">
		<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
			<div class="bhoechie-tab-menu">
				<div class="list-group">
					<a  class="list-group-item active" style="width: 100%;">
                                            <span class="fas fa-file-pdf"></span>
                                            Application for Nomination for Laxman Award
                                        </a>
				
				</div>
			
			</div>
		</div>
	</div>
	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 bhoechie-tab">
		<div class="bhoechie-tab-content active">
			<div class="form-scroll">
				<div>
					<div class="row">
						<div class="col-md-12">
							<div class="profile-head">
								<div class="tab-content profile-tab" id="myTabContent">
									<div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
										<div class="row">
											<div class="col-md-12" id="prodiv">
												<table class="dn" style="width: 100%; margin-bottom: 5px;" border="0">
													<tr>
														<td colspan="2" align="center" style="position: relative; border: 0; padding-bottom: 5px;">
															<div style="border-bottom: 0px solid #000; padding-bottom: 2vw;">
																<!-- <img src="images/logo.png" style="position: absolute; width: 70px; top: 5px; left: 0;"/> -->
																<div style="font-size: 3vw; font-weight: bold;">
																	<!-- Department of Sports -->
																	Khel Sathi Portal / खेल साथी पोर्टल
																</div>
																<div style="font-size: 2vw; font-weight: bold;">
																	Government of Uttar Pradesh/उत्तर प्रदेश सरकार
																</div>
																<div style="font-size: 2vw; font-weight: bold;">Nomination Form to Seek Reward from Government of UP / उ0प्र0 सरकार से पुरस्कार प्राप्त करने हेतु नामांकन प्रपत्र</div>
															</div>
														</td>
													</tr>
												</table>
												@foreach($articles as $article)
												<p class="bg-light"><strong>Application no. / आवेदन क्रमांक:-</strong> <b>{{$article->application_no}}</b>
												</p>
												<table  id="dataTable" class="table table-bordered" border="1" style="border-collapse: collapse; width: 100%;">
													<tr>
														<td colspan="6" class="bg-light">
															<strong>Basic Details/सामान्य विवरण</strong>
														</td>
													</tr>

													<tr>
														<td><b>Applicant's Full Name<br>आवेदक का पूरा नाम</b>
														</td>
														<td>{{$article->fullname}}</td>
														<td><b>Which Sport did/do you play?<br>कौन सा खेल खेलते थे/हैं?</b>
														</td>
														<td>{{$article->sport_name}}</td>
														<td colspan="2" rowspan="2"><b>Photograph of Applicant's<br>आवेदक की फोटो</b><br/>
															<div class="text-center" style="padding: 5px;" align="center">
																<img src="{{asset('storage/award/').'/'.$article->photograph_doc}}" class="img-fluid" style="width: 140px;"/>
															</div>
														</td>
													</tr>
													<tr>
														<td><b>Mobile Number<br>मोबाइल नंबर</b>
														</td>
														<td>{{$article->mobile}}</td>
														<td><b>Email ID<br>ईमेल आईडी</b>
														</td>
														<td>{{$article->email}}</td>

													</tr>
													<tr>
														<td colspan="6" class="bg-light">
															<strong>Applicant's Details/आवेदक का विवरण</strong>
														</td>
													</tr>
													<tr>
														<!-- <td><b>Application no.<br>आवेदन क्रमांक</b></td>
                                                                                <td>{{$article->application_no }}</td> -->
														<td><b>Date of Birth<br>जन्म तिथि</b>
														</td>
														<td>{{$article->dob}}</td>
														<td><b>Place of Birth<br>जन्म स्थान</b>
														</td>
														<td>{{$article->place_of_birth}}</td>

													</tr>
													<tr>
														<td><b>Mother’s Name<br>माता का नाम</b>
														</td>
														<td>{{$article->mother_name}}</td>
														<td><b>Father’s Name<br>पिता का नाम</b>
														</td>
														<td>{{$article->father_name}}</td>
														<td><b>Gender<br>लिंग</b>
														</td>
														<td>{{$article->gender}}</td>


													</tr>
													<tr>
														<td><b>Highest Educational Qualification<br>उच्चतम शैक्षणिक योग्यता</b>
														</td>
														<td>
															@if($article->qualification == '10') 10th / High School @elseif($article->qualification == '12') 12th / Intermediate @elseif($article->qualification == 'graduation') Graduation @elseif($article->qualification == 'master_degree') Master Degree @else Other @endif
														</td>
														<td><b>Upload Certificate of Highest Educational Qualification<br>उच्चतम शैक्षणिक योग्यता का प्रमाणपत्र अपलोड करें</b>
														</td>
														<td>
															@if($article->qualification_doc !='') @php $img = url('storage/laxman_award').'/'.$article->qualification_doc; $img1 = url('public/images/images.svg'); $doc = explode('.',$article->qualification_doc); if($doc[1]=='pdf') $img1 = url('public/images/pdf.svg'); @endphp
															<img role="button" src="{{$img1}}" onclick="appendImage('{{$img}}','{{$doc[1]}}')" class="img-fluid img-query"/>

															<!-- <strong class="btn btn-success btn-xs">Uploaded</strong>
                                                                                    <a href="{{url('storage/award',$article->qualification_doc)}}" target="_blank">
                                                                                        <span class="btn btn-success btn-xs">View</span>
                                                                                    </a> -->
															@else
															<strong class="btn btn-danger btn-xs">Not Uploaded</strong> @endif
														</td>
														<td><b>Domicile Certificate of UP<br>उत्तर प्रदेश का अधिवास प्रमाणपत्र अपलोड करें</b>
														</td>
														<td>
															@if($article->domicile_certificate !='') @php $img = url('storage/laxman_award').'/'.$article->domicile_certificate; $img1 = url('public/images/images.svg'); $doc = explode('.',$article->domicile_certificate); if($doc[1]=='pdf') $img1 = url('public/images/pdf.svg'); @endphp
															<img role="button" src="{{$img1}}" onclick="appendImage('{{$img}}','{{$doc[1]}}')" class="img-fluid img-query"/>

															<!-- <strong class="btn btn-success btn-xs">Uploaded</strong>
                                                                                    <a href="{{url('storage/laxman_award',$article->domicile_certificate)}}" target="_blank">
                                                                                        <span class="btn btn-success btn-xs">View</span>
                                                                                    </a> -->
															@else
															<strong class="btn btn-danger btn-xs">Not Uploaded</strong> @endif
														</td>
													</tr>
													<tr>
														@if($article->highschool_certificate !='')
														<td><b>Highschool/Matriculation Certificate<br>हाईस्कूल/मैट्रिकुलेशन प्रमाणपत्र</b>
														</td>
														<td>

															@php $img = url('storage/laxman_award').'/'.$article->highschool_certificate; $img1 = url('public/images/images.svg'); $doc = explode('.',$article->highschool_certificate); if($doc[1]=='pdf') $img1 = url('public/images/pdf.svg'); @endphp
															<img role="button" src="{{$img1}}" onclick="appendImage('{{$img}}','{{$doc[1]}}')" class="img-fluid img-query"/>

															<!-- 
                                                                                    
                                                                                    <strong class="btn btn-success btn-xs">Uploaded</strong>
                                                                                    <a href="{{url('storage/laxman_award',$article->highschool_certificate)}}" target="_blank">
                                                                                        <span class="btn btn-success btn-xs">View</span>
                                                                                    </a>
                                                                                    
                                                                                 -->
														</td>
														@endif
													</tr>
												
													<tr>
														<td colspan="6" class="bg-light">
															<strong>Current Address/वर्तमान पता</strong>
														</td>
													</tr>
													<tr>
														<td><b>Address<br>पता</b>
														</td>
														<td>{{$article->present_address}}</td>
														<td><b>District<br>राज्य</b>
														</td>
														<td>{{districtName($article->present_district)}}</td>
														<td><b>State<br>जनपद</b>
														</td>
														<td>{{stateName($article->present_state)}}</td>

													</tr>
													<tr>
														<td colspan="6" class="bg-light">
															<strong>Permanent Address/स्थायी पता</strong>
														</td>
													</tr>
													<tr>
														<td><b>Address<br>पता</b>
														</td>
														<td>{{$article->permanent_address}}</td>
														<td><b>District<br>राज्य</b>
														</td>
														<td>{{districtName($article->permanent_district)}}</td>
														<td><b>State<br>जनपद</b>
														</td>
														<td>Uttar Pradesh</td>

													</tr>
													<tr>
														<td colspan="6" class="bg-light">
															<strong>Bank Details/बैंक खाते का विवरण</strong>
														</td>
													</tr>
													<tr>
														<td><b>Name of Bank<br>बैंक का नाम</b>
														</td>
														<td>{{$article->bank_name}}</td>
														<td><b>Branch<br>शाखा</b>
														</td>
														<td>{{$article->bank_branch}}</td>
														<td><b>Bank Account No.<br>बैंक खाता संख्या</b>
														</td>
														<td>{{$article->bank_acc_no}}</td>
													</tr>
													<tr>
														<td><b>IFSC<br>आईएफएससी</b>
														</td>
														<td>{{$article->bank_ifsc}}</td>
														<td><b>Account Holder Name<br>खाता धारक का नाम</b>
														</td>
														<td>{{$article->acc_holder_name}}</td>
														<td><b>PAN<br>पैन कार्ड</b>
														</td>
														<td>{{$article->pan}}</td>
													</tr>
													<tr>
														<td><b>Mobile No. (registered with Bank Account)<br>मोबाइल नंबर (बैंक खाते के साथ जो पंजीकृत है)</b>
														</td>
														<td>{{$article->mobile_registered_in_bank}}</td>
														<td><b>Any other relevant information applicant wants to specify?<br>कोई अन्य प्रासंगिक जानकारी आवेदक निर्दिष्ट करना चाहते हैं?</b>
														</td>
														<td>{{$article->other_relevant_information_applicant}}</td>
													</tr>
													<tr>
														<td colspan="6" class="bg-light">
															<strong>Sports Achievements/खेल क्षेत्र में उपलब्धियां</strong>
														</td>
													</tr>
													@foreach($sport_achievement as $item)
													<tr>
														<td><b>Sports Competition Name <br>खेलकूद प्रतियोगिता का नाम</b>
														</td>
														<td>{{$item->name}}</td>
														<td><b>Sport Name<br>खेल का नाम</b>
														</td>
														<td>{{$item->sport_achievement_name}}</td>
														<td><b>Position<br>पद का नाम</b>
														</td>
														<td>{{$item->sport_achievement_position}}</td>
													</tr>
													<tr>
														<td><b>Period of Competition<br>प्रतियोगिता की अवधि</b>
														</td>
														<td><b>From :-</b> {{$item->competition_from_date}} </br><b> To :-</b> {{$item->competition_to_date}}</td>
														<td><b>Place<br>स्थान</b>
														</td>
														<td>{{$item->sport_achievement_State_Institution}}</td>
														<td><b>Documents<br>दस्तावेज</b>
														</td>
														<td>
															@if($item->sport_achievement_docs !='') @php $img = url('storage/laxmibai_award').'/'.$item->sport_achievement_docs; $img1 = url('public/images/images.svg'); $doc = explode('.',$item->sport_achievement_docs); if($doc[1]=='pdf') $img1 = url('public/images/pdf.svg'); @endphp
															<img role="button" src="{{$img1}}" onclick="appendImage('{{$img}}','{{$doc[1]}}')" class="img-fluid img-query"/>

															<!-- <strong class="btn btn-success btn-xs">Uploaded</strong>
                                                                                        <a href="{{url('storage/laxman_award',$item->sport_achievement_docs)}}" target="_blank">
                                                                                             <span class="btn btn-success btn-xs">View</span>
                                                                                        </a> -->
															@else
															<strong class="btn btn-danger btn-xs"> Not Uploaded</strong> @endif
														</td>
													</tr>
													@endforeach

													<tr>
														<td colspan="6" class="bg-light">
															<strong>Other Achievements/अन्य उपलब्धियां</strong>
														</td>
													</tr>
													@foreach($other_achievement as $item)
													<tr>
														<td><b>Name of the Achievement<br>उपलब्धि का नाम</b>
														</td>
														<td>{{$item->achievement_name}}</td>
														<td><b>Documents<br>दस्तावेज</b>
														</td>
														<td>
															@if($item->achievement_docs !='')
																@php
																$img = url('storage/laxman_award').'/'.$item->achievement_docs;
																$img1 = url('public/images/images.svg');
																$doc = explode('.',$item->achievement_docs);
																if($doc[1]=='pdf')
																$img1 = url('public/images/pdf.svg');
																@endphp
																<img role="button" src="{{$img1}}" onclick="appendImage('{{$img}}','{{$doc[1]}}')" class="img-fluid img-query" />
															
															<!-- <strong class="btn btn-success btn-xs">Uploaded</strong>
															<a href="{{url('storage/laxman_award',$item->achievement_docs)}}" target="_blank">
                                                                                             <span class="btn btn-success btn-xs">View</span>
                                                                                        </a> -->
															@else
															<strong class="btn btn-danger btn-xs"> Not Uploaded</strong> @endif
														</td>
													</tr>
													@endforeach
													<tr>
														<td colspan="6" class="bg-light">
															<strong>Dope Test/डोप टेस्ट</strong>
														</td>
													</tr>
													<tr>
														<td colspan="1" align="center">
															<input class="dope_test" name="dope_test" {{ ($article->final_submit == 1 ? 'disabled' : '') }} {{ ($article->dope_test == 1 ? 'checked' : '') }} value="1" required type="radio" /> &nbsp; <b>Yes/हां</b>
														</td>
														<td colspan="1" align="center">
															<input class="dope_test" name="dope_test" value="2" {{ ($article->final_submit == 1 ? 'disabled' : '') }} {{ ($article->dope_test == 2 ? 'checked' : '') }} type="radio" /> &nbsp; <b>No/नहीं</b>
														</td>
														<td colspan="4">Have you ever been convicted for consuming drugs during any Competition/Championship?<br>क्या आपको कभी किसी प्रतियोगिता/चैंपियनशिप के दौरान नशीली दवाओं के सेवन के लिए दोषी ठहराया गया है?</td>
													</tr>
													<tr>
														<td colspan="6" class="bg-light">
															<strong>Court Case/न्यायालय मुकदमा</strong>
														</td>
													</tr>
													<tr>
														<td colspan="1" align="center">
															<input name="court_case" value="1" {{ ($article->final_submit == 1 ? 'disabled' : '') }} {{ ($article->court_case == 1 ? 'checked' : '') }} class="court_case" required type="radio" /> &nbsp; <b>Yes/हां</b>
														</td>
														<td colspan="1" align="center">
															<input name="court_case" value="2" {{ ($article->final_submit == 1 ? 'disabled' : '') }} {{ ($article->court_case == 2 ? 'checked' : '') }} class="court_case" type="radio" /> &nbsp; <b>No/नहीं</b>
														</td>
														<td colspan="4">Have you ever been convicted by a Court of Law in any Case/Sexual Harassment?<br>क्या आपको कभी किसी न्यायालय द्वारा किसी मामले/यौन उत्पीड़न में दोषी ठहराया गया है?</td>
													</tr>

													<tr>
														<td colspan="6" class="bg-light">
															<strong>Declaration/घोषणा</strong>
														</td>
													</tr>
													<tr>
														<td colspan="1" align="center">
															<input {{ ($article->final_submit == 1 ? 'disabled' : '') }} {{ ($article->final_submit == 1 ? 'checked' : '') }} type="checkbox" id="checkbox" /> &nbsp; <b>I Agree/मैं सहमत हूं</b>
														</td>
														<td colspan="5">I hereby declare that I have read all terms & conditions, eligibility criteria and other relevant information related to the Application and abide by them. I also declare that all the above particulars are true to the best of my knowledge. If any of my facts are found to be wrong or incorrect, my application shall be liable for rejection and I shall be solely held responsible for it.<br>मैं एतद्द्वारा घोषणा करता/करती हूं कि मैंने आवेदन से संबंधित सभी नियम और शर्तें, पात्रता मानदंड और अन्य प्रासंगिक जानकारी पढ़ ली हैं एवं उनका पालन करता/करती हूं। मैं यह भी घोषणा करता/करती हूं कि उपरोक्त सभी विवरण मेरे अनुसार सत्य व सही हैं। यदि मेरा कोई भी तथ्य गलत अथवा असत्य पाया जाता है, तो मेरा आवेदन अस्वीकृत किया जा सकता है और इसके लिए पूर्णतः मैं स्वयं उत्तरदायी ठहराया जाऊंगा/जाऊंगी।
														</td>
													</tr>
													<tr>
														<td colspan="3" align="center">
															<span>Date<br>तिथि</span><br>
															<b>{{ dmy($article->created_at) }}</b>
														</td>
														<td colspan="3" align="center">
															<img src="{{asset('storage/award/').'/'.$article->signature_doc}}" class="img-fluid" style="width: 140px;"><br>
															<b>Applicant's Signature<br>आवेदक के हस्ताक्षर</b>
														</td>
													</tr>
													<tr>
														<?php 
                                                                                 
                                                                                if($article->form_status == 1 || $article->form_status == 2 || $query_s != 0){ ?>
														<!-- <td colspan="2" align="center">
                                                                                    <a href="#"  class="btn btn-info disabled btn-sm" data-bs-toggle="modal" data-bs-target="#query_form_marked">Mark Query</a>
                                                                                </td>
                                                                                <td colspan="2" align="center">
                                                                                    <a href="#" class="btn btn-success disabled btn-sm" data-bs-toggle="modal" data-bs-target="#Subapp">Accept</a>
                                                                                </td>
                                                                                <td colspan="2" align="center">
                                                                                    <a href="#"  class="btn btn-danger disabled btn-sm" data-bs-toggle="modal" data-bs-target="#Rejectapp">Reject</a>
                                                                                </td> -->
														@if($article->form_status == 1)
														<td colspan="6"  class="noprint" align="center">
															<b>Form Status :-</b> <span class="btn btn-success disabled btn-sm ml-5">Accepted</span>
														</td>
														@elseif($article->form_status == 2)
														<td colspan="6"  class="noprint" align="center">
															<b>Form Status :-</b> <span class="btn btn-danger btn-sm ml-5">Rejected</span>
														</td>
														@else
														<td colspan="3"  class="noprint" align="center">
															<b>Form Status :-</b> <span class="btn btn-danger btn-sm ml-5">Pending</span>
															<!-- <a href="#" class="btn btn-info disabled btn-sm" data-bs-toggle="modal" data-bs-target="#query_form_marked">Mark Query</a> -->
														</td>
														<td colspan="3"  class="noprint" align="center">
														<b>Action:- </b> &nbsp;
															<a href="#" class="btn btn-info disabled btn-sm" data-bs-toggle="modal" data-bs-target="#query_form_marked">Mark Query</a>
															<a href="#" class="btn btn-success disabled btn-sm" data-bs-toggle="modal" data-bs-target="#Subapp">Accept</a>
															<a href="#" class="btn btn-danger disabled btn-sm" data-bs-toggle="modal" data-bs-target="#Rejectapp">Reject</a>

														</td>
														<!-- <td colspan="2" align="center">
															<a href="#" class="btn btn-danger disabled btn-sm" data-bs-toggle="modal" data-bs-target="#Rejectapp">Reject</a>
														</td> -->
														@endif



														<?php } else {?>
														<td colspan="3" class="noprint" align="center">
															<b>Form Status :-</b> <span class="btn btn-danger btn-sm ml-5">Pending</span>
															<!-- <a href="#" class="btn btn-info btn-sm" data-bs-toggle="modal" data-bs-target="#query_form_marked">Mark Query</a> -->
														</td>
														<td colspan="3"  class="noprint" align="center">
														<b>Action:- </b> &nbsp;
															<a href="#" class="btn btn-info btn-sm" data-bs-toggle="modal" data-bs-target="#query_form_marked">Mark Query</a>
															<a href="#" class="btn btn-success btn-sm" data-bs-toggle="modal" data-bs-target="#Subapp">Accept</a>
															<a href="#" class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#Rejectapp">Reject</a>

														</td>
														<!-- <td colspan="2" align="center">
															<a href="#" class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#Rejectapp">Reject</a>
														</td> -->
														<?php } ?>



													</tr>
												</table>
												@endforeach
												 @if($article->form_status == 1 || $article->form_status == 2) 
													@if(count($queryData) > 0)
													<x-query-details :queryData="$queryData"/> @endif 
													@else
													<x-query-details :queryData="$queryData"/>
												 @endif
												{{-- <x-query-details :queryData="$queryData" /> --}}
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<br><br><br>

@endsection


<x-marked-query :id="$id" :type="1" />

	<!--For Reject Application-->
	<div class="modal fade" id="Rejectapp" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
		<div class="modal-dialog modal-lg">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="exampleModalLabel">Reject Application</h5>
					<!--<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>-->
				</div>
				<form action="{{route('award_is_rejected')}}" method="post">
					@csrf
					<div class="modal-body">
						<input type="hidden" name="user_id" value="{{$article->user_id}}">
						<input type="hidden" name="form_type" value="1">
						<h3 class="text-center">Are you sure to Reject the Application? Action once taken cannot be reverted.</h3>
						<div class="form-group mb-3">
							<label class="placeholder">Remark</label>
							<textarea name="remark" required rows="1" class="form-control" cols="40"></textarea>
						</div>
					</div>
					<div class="modal-footer">
						<!--<button type="button" class="btn btn btn-outline-danger"><span class="icons icon-cloud-download"></span> Download</button>-->
						<button type="submit" class="btn btn-info">Yes</button>
						<button type="button" class="btn btn-danger" data-bs-dismiss="modal">No</button>
					</div>
				</form>
			</div>
		</div>
	</div>

<!--For Submit Application-->
<div class="modal fade" id="Subapp" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">Accept Application</h5>
				<!--<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>-->
			</div>
			<form action="{{route('award_is_accepted')}}" method="post">
				@csrf
				<div class="modal-body">
					<h3 class="text-center">Are you sure to Accept the Application? Action once taken cannot be reverted.</h3>
					<input type="hidden" name="user_id" value="{{$article->user_id}}">
					<input type="hidden" name="form_type" value="1">
					<div class="form-group mb-3">
						<label class="placeholder">Remark</label>
						<textarea name="remark" rows="1" class="form-control" cols="40"></textarea>
					</div>
				</div>

				<div class="modal-footer">
					<!--<button type="button" class="btn btn btn-outline-danger"><span class="icons icon-cloud-download"></span> Download</button>-->
					<button type="submit" class="btn btn-info">Yes</button>
					<button type="button" class="btn btn-danger" data-bs-dismiss="modal">No</button>
				</div>
			</form>
		</div>
	</div>
</div>



