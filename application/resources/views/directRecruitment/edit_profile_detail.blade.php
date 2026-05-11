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
			<input type="hidden" value="{{$articles->application_no}}" name="application_no">
				<div class="row">
				<div class="col-md-12">
                        <h5 class="subheading">Nomination Form for Gazetted Officer  / राजपत्रित अधिकारी हेतु नामांकन</h5>
                    </div>
                    <div class="col-md-12">
                        <h5 class="subheading">A. Basic Details/सामान्य विवरण</h5>
                    </div>
					<div class="col-md-4">
                        <div class="form-group">
                            <label class="placeholder">1. Applicant's Full Name/आवेदक का पूरा नाम <span class="text-danger">*</span></label>
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
                        <table class="table table-bordered" id="sport_event">
                            <tr>
								<td rowspan="2"><label>Sports Competition Name <br>खेलकूद प्रतियोगिता का नाम</label> <span class="text-danger">*</span>
								</td>
								<td rowspan="2"><label>Sport Name<br>खेल का नाम</label> <span class="text-danger">*</span>
								</td>
								<td rowspan="2"><label>Position / Medal<br>पद का नाम / पदक</label> <span class="text-danger">*</span>
								</td>
								<td colspan="2" class="text-center"><label>Period of Competition<br>प्रतियोगिता की अवधि</label> <span class="text-danger">*</span>
								</td>
								<td rowspan="2"><label>Venue Name</br>स्थल का नाम</label> <span class="text-danger">*</span< /td>
								<td rowspan="2"><label>Upload Relevant Certificate<br>प्रासंगिक प्रमाण पत्र अपलोड करें<span class="text-danger">*</span>
									</label>
								</td>
								<td rowspan="2"><label>Sport Event Detail</br>खेलकूद प्रतियोगिता का विवरण<span class="text-danger">*</span></label> </td>
								<td rowspan="2"></td>
							</tr>
							<tr>
								<td><label>From </label>
								</td>
								<td><label>To </label>
								</td>
							</tr>
                            <?php $sele_sport = ""; ?>
                            @foreach($sportAchievement as $item)
                            <?php $sele_sport = $item->sport_name ?>
                            <tr>
                                <td class="form-group">
                                    <input type="text" class="form-control" name="sport_event[]" value="{{sportNEventName($item->sport_event)}}" readonly>
                                </td>
                                <td>
                                    <input type="text" class="form-control" name="sport_name[]" value="{{sport_name($item->sport_name)}}" readonly>
                                </td>
                                <td>
                                    <input type="text" class="form-control" name="medal[]" value="{{$item->medal}}" readonly>
                                </td>
                                <!--  -->
                                <td>
                                    <input type="text" class="form-control" name="competition_from_date[]" value="{{$item->competition_from_date}}" readonly>
                                </td>
                                <td>
                                    <input type="text" class="form-control" name="competition_to_date[]" value="{{$item->competition_to_date}}" readonly>
                                </td>
                                <td>
                                    <input type="text" class="form-control" name="sport_place[]" value="{{$item->sport_place}}" readonly>
                                </td>
                                <td style="text-align:center">
                                    @if($item->sport_achievement_docs !='')
                                        <a  href="{{url('storage/direct_recruitment',$item->sport_achievement_docs)}}" target="_blank">
                                            <!-- <span class="btn btn-success btn-xs"> Uploaded</span> -->
                                            <i class="fa fa-download"></i>
                                        </a>
                                    @else
                                        <strong class="btn btn-danger btn-xs">Not Uploaded</strong>
                                    @endif
                                </td>
                                <td>
                                    <input type="text" class="form-control" name="event_details[]" value="{{$item->event_details}}" readonly>
                                </td>
                                <!--  -->
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
								@if(count($post) !=0)
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
								@else
								<tr>
                                    <td>
                                        <input type="hidden" value={{count($postMaster)}} id="chkk">
                                        <select id="select0" class="form-select preference_select" name="post_type[]" required onchange="pushSelect(this.value)">                                            
                                            <option value="1">Preferences 1</option>                                            
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
									<td><button type="button" name="add" id="add" class="btn btn-primary mt-1">Add More</button></td>
                                </tr>
								@endif
							</table>
						</div>
					</div>
					<div class="col-md-12">
						<h5 class="subheading"> </h5>
					</div>
						<div class="col-md-4">
							<div class="form-group">
								<label> Category/श्रेणी<span class="text-danger">*</span></label>
								<select required name="category" class="form-select">
									<option value="">Select</option>
									<option {{$articles->category=='1'?'Selected':''}} value="1">General</option>
									<option {{$articles->category=='2'?'Selected':''}} value="2">OBC</option>
									<option {{$articles->category=='3'?'Selected':''}} value="3">SC</option>
									<option {{$articles->category=='4'?'Selected':''}} value="4">ST</option>
									<option {{$articles->category=='5'?'Selected':''}} value="5">Other</option>
								</select>
							</div>
						</div>
						<div class="col-md-4">
							<div class="form-group">
								<label class="placeholder">Religion/धर्म<span class="text-danger">*</span></label>
								<select class="form-select" required name="religion">
									<option value="">Select</option>
									<option value="Hindu" {{$articles->religion=='Hindu'?'Selected':''}}>Hindu</option>
									<option value="Muslim" {{$articles->religion=='Muslim'?'Selected':''}}>Muslim</option>
									<option value="Christian" {{$articles->religion=='Christian'?'Selected':''}}>Christian</option>
									<option value="Sikh" {{$articles->religion=='Sikh'?'Selected':''}}>Sikh</option>
									<option value="Buddha " {{$articles->religion=='Buddha '?'Selected':''}}>Buddha </option>
									<option value="Jain" {{$articles->religion=='Jain'?'Selected':''}}>Jain</option>
									<option value="Other" {{$articles->religion=='Other'?'Selected':''}}>Other</option>
								</select>
								<!-- <input type="text" class="form-control" name="religion" value="{{$user->religion}}"> -->
							</div>
						</div>
						<div class="col-md-4">
							<div class="form-group">
								<label>Upload Certificate of Highest Educational Qualification/उच्चतम शैक्षणिक योग्यता का प्रमाणपत्र अपलोड करें<span class="text-danger">*</span></label>
								<div class="input-group">
									<input type="file" name="qualification_doc" class="form-control" onchange="getfileext(this.value,1)" id="File1" aria-describedby="inputGroupFileAddon05" aria-label="Upload">
									<input type="hidden" name="qualification_doc1" value="{{$articles->qualification_doc}}"> @if($articles->qualification_doc!='') @php $img = url('storage/direct_recruitment').'/'.$articles->qualification_doc; $img1 = url('public/images/view.jpg'); $doc = explode('.',$articles->qualification_doc); @endphp
									<img src="{{$img1}}" role="button" onclick="appendImage('{{$img}}','{{$doc[1]}}')" class="img-fluid" /> @endif
								
								</div>
								<span class="note">(File Format: jpeg, jpg, Pdf | Max File Size: 2 MB)<br>(फाइल का प्रारूप: JPEG/JPG/PDF | फाइल का अधिकतम साइज़: 2 MB)</span>
							</div>
						</div>
						<div class="col-md-4">
							<div class="form-group">
								<label>Domicile Certificate issued by the Competent Authority<br>सक्षम प्राधिकारी द्वारा जारी किया गया मूल निवास प्रमाण पत्र<span class="text-danger">*</span></label>
								<div class="input-group">
									<input name="domicile_certificate" type="file" class="form-control" onchange="getfileext(this.value,3)" id="File3" aria-describedby="inputGroupFileAddon05" aria-label="Upload">
									<input type="hidden" name="domicile_certificate1" value="{{$articles->domicile_certificate}}"> @if($articles->domicile_certificate !='')
								
									@php $img = url('storage/direct_recruitment').'/'.$articles->domicile_certificate; $img1 = url('public/images/view.jpg'); $doc = explode('.',$articles->domicile_certificate); @endphp
									<img src="{{$img1}}" role="button" onclick="appendImage('{{$img}}','{{$doc[1]}}')" class="img-fluid" /> @endif
								</div>
								<span class="note">(File Format: jpeg, jpg, Pdf | Max File Size: 2 MB)</span>
							</div>
						</div>

						{{-- <div class="col-md-4">
							<div class="form-group">
								<label>Upload Document Proof for sport achievement<span class="text-danger">*</span></label>
								<div class="input-group">
									<input name="achievement_doc" type="file" class="form-control" onchange="getfileext(this.value,333)" id="File333" aria-describedby="inputGroupFileAddon05" aria-label="Upload">
									<input type="hidden" name="achievement_doc1" value="{{$articles->achievement_doc}}"> @if($articles->achievement_doc !='')
									@php $img = url('storage/direct_recruitment').'/'.$articles->achievement_doc; $img1 = url('public/images/view.jpg'); $doc = explode('.',$articles->achievement_doc); @endphp
									<img src="{{$img1}}" role="button" onclick="appendImage('{{$img}}','{{$doc[1]}}')" class="img-fluid" /> @endif
								</div>
								<span class="note">Make a single PDF file correspondently to your all Sport Achievement<br>(File Format: jpeg, jpg, Pdf | Max File Size: 2 MB)</span>
							</div>
						</div> --}}

						
					</div>
				</div>
				
				<div class="bhoechie-footer">
					<div class="row justify-content-center">
						<div class="col-md-3 d-grid">
							<button type="submit" id="reg-submit" class="btn btn-info">Save & Procced/दर्ज करें व आगे बढ़ें</button>
						</div>
					</div>
				</div>
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
