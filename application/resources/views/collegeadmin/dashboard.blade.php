@extends( 'layouts/admin_layout' )
@section( 'content' )
<style>
	.dn {
		display: none;
	}
</style>
<div class="pageheader" id="menu-margin">
	<h4 class="mb-0">
		Application Details
		<a href="{{ url('collegeadmin/trialList') }}" class="btn btn-sm  btn-outline-primary ms-2 float-end "><span class="icons icon-list"></span> Trial List</a>
		<a href="{{ asset('assets_admin/dashboard') }}" class="btn btn-outline-danger btn-sm backbtn float-end  m-0"><span class="icons icon-arrow-left"></span>Back/पीछे</a>
	</h4>
</div>
<div class="card">
	<div class="card-body">
		<form action="{{ route('filter') }}" class="needs-validation" method="post" autocomplete="off" id="formHostelMaster" novalidate>
			@csrf
			<div class="row">
				<div class="col-md-3">
					<div class="form-group">
						<label for="name">Sports Name</label>
						<div id="list1" class="dropdown-check-list">
							@php
							$abc=request()->input('subsport');
							@endphp


							<select name="sport_id" id="sport" onchange="sporttype(this.value)" class="form-select" data-subsport={{ $abc}}>
								<option value="" data-badge="">Select Sport Name</option>
								@foreach($sports as $key=>$sport)
								<option value="{{ $sport->id }}" {{request()->input('sport_id') == $sport->id ? 'selected' : ''}} data-badge=""> {{$sport->name}}</option>
								@endforeach
							</select>

						</div>
					</div>
				</div>

				<div class="col-md-3">
					<div class="form-group">
						<label for="subsport">Sub Sport </label>
						<div id="list1" class="dropdown-check-list">
							<select name="subsport" id="dropdownid" class="form-select">
							</select>
						</div>
					</div>
				</div>
				@if(Auth::guard('admin')->user()->admin_role == 1 || Auth::guard('admin')->user()->admin_role == 6 || Auth::guard('admin')->user()->admin_role == 19)
				<div class="col-md-3">
					<div class="form-group">
						<label for="district">Division</label>
						<div id="list1" class="dropdown-check-list">
							<select name="division_id" id="dropdownid" class="form-select">
								<option value="">Select Division</option>
								@foreach($divisions as $key=>$item)
								<option value="{{ $item->id }}" {{request()->input('division_id') == $item->id ? 'selected' : ''}} data-badge=""> {{$item->division_name}}</option>
								@endforeach
							</select>
						</div>
					</div>
				</div>
				@endif
				<div class="col-md-3">
					<div class="form-group">
						<label for="district">District</label>
						<div id="list1" class="dropdown-check-list">
							<select name="district_id" id="dropdownid" class="form-select">
								<option value="">Select District</option>
								@foreach($district as $key=>$item)
								<option value="{{ $item->id }}" {{request()->input('district_id') == $item->id ? 'selected' : ''}} data-badge=""> {{$item->city}}</option>
								@endforeach
							</select>
						</div>
					</div>
				</div>

				<div class="col-md-3">
					<div class="form-group">
						<label for="name">Action</label>
						<select class="form-select" id="action" name="action">
							<option selected="" disabled="" value="">Select Action</option>
							<option value="1" @isset($status) @if ($status==1) selected @endif @endisset {{request()->input('action') == 1 ? 'selected' : ''}}>Pending</option>
							<option value="2" @isset($status) @if ($status==2) selected @endif @endisset {{request()->input('action') == 2 ? 'selected' : ''}}>Accepted </option>
							<option value="3" @isset($status) @if ($status==3) selected @endif @endisset {{request()->input('action') == 3 ? 'selected' : ''}}>Rejected </option>
						</select>
					</div>
					@if ($errors->has('action'))
					<span class="error_mess">{{ $errors->first('action') }}</span> @endif
				</div>


				<div class="col-md-3">
					<div class="form-group">
						<label for="name">Query Marked </label>
						<select class="form-select" id="query_marked" name="query_marked">
							<option value="">Select </option>
							<option value="1" {{request()->input('query_marked') == 1 ? 'selected' : ''}}>Query Marked</option>
							<option value="2" {{request()->input('query_marked') == 2 ? 'selected' : ''}}>Query Resolved</option>

						</select>
					</div>
					@if ($errors->has('action'))
					<span class="error_mess">{{ $errors->first('action') }}</span> @endif
				</div>
				<div class="col-md-3">
					<div class="form-group">
						<label for="name">Trial List</label>
						<select class="form-select" id="triallist" name="trial_type">
							<option value="">Select Trial List</option>
							<option value="2" {{request()->input('trial_type') == 2 ? 'selected' : ''}}>Trial One Pass </option>
							<option value="3" {{request()->input('trial_type') == 3 ? 'selected' : ''}}>Trial Two Pass</option>
							<option value="4" {{request()->input('trial_type') == 4 ? 'selected' : ''}}>Trial One Fail</option>
							<option value="5" {{request()->input('trial_type') == 5 ? 'selected' : ''}}>Trial Two Fail</option>
						</select>
					</div>
					@if ($errors->has('action'))
					<span class="error_mess">{{ $errors->first('action') }}</span> @endif
				</div>
				<div class="col-md-3">
					<div class="form-group">
						<label for="name">From Date</label>
						<input type="date" name="from_Date" max="{{date(" Y-m-d ")}}" class="form-control" value="{{ request()->input('from_Date') }}">
					</div>
					@if ($errors->has('from_Date'))
					<span class="error_mess">{{ $errors->first('from_Date') }}</span> @endif
				</div>
				<div class="col-md-3">
					<div class="form-group">
						<label for="name">To Date</label>
						<input type="date" name="to_Date" max="{{date(" Y-m-d ")}}" value="{{ request()->input('to_Date') }}" class="form-control">
					</div>
					@if ($errors->has('to_Date'))
					<span class="error_mess">{{ $errors->first('to_Date') }}</span> @endif
				</div>
				<div class="col-md-1">
					<div class="form-group">
						<label for="name">&nbsp;</label>
						<button class="btn btn-primary" type="submit">Search</button>
					</div>
				</div>
				<div class="col-md-1">
					<div class="form-group">
						<label for="name">&nbsp;</label>
						<a href="{{ url('collegeadmin/dashboard') }}" class="btn btn-danger backbtn ">Reset</a>
					</div>
				</div>
			</div>
		</form>
	</div>
</div>
<div class="pageheader" id="menu-margin">
	<h4 class="mb-0">
		Application List

		<a title="Application Details ExportToExcel" class="btn btn-sm btn-success float-end" href="{{route('download_hostel_pdf',9)}}">
			<i class="fa fa-file-excel"></i> Export to PDF
		</a>

		<a title="Application Details ExportToExcel" class="btn btn-sm btn-success float-end" onclick="ExportToExcel('xlsx')">
			<i class="fa fa-file-excel"></i> Export to Excel
		</a>
	</h4>
</div>
<div class="card">
	<div class="card-body">
		<div class="table-responsive" id="prodiv">

			<table class="dn" style="
width: 100%;
">

				<tr>
					<th>
						<div
							style="padding: 0 15px 3px; margin-bottom: 10px; margin-top:10px; border-bottom: 2px solid #000; position: relative; line-height: 1;">
							<img src="{{ asset('') }}/assets_admin/images/logo.png"
								style="width: 75px; height: auto; position: absolute; top: 0px; left: 20px;">
							<h1
								style="text-align: center; font-size: 20pt; margin: 0px 0px 0px 0px; padding: 0px 0 0; color: #000;">
								Sports Directorate, Govt. of Uttar Pradesh
							</h1>
							<h2
								style="text-align: center; margin:3px 0px 10px 0px; font-size:11pt; padding: 0px; color:#000;">
								Khel Bhawan Hazratganj Lucknow, Uttar Pradesh 226001
							</h2>
							<h5
								style="text-align: center; margin:0px 0px 0px 0px; font-size:16pt; padding: 0px; color:#000;">
								Khel Sathi Portal
							</h5>
						</div>

						<h6
							style="text-align: center; margin:0px 0px 0px 0px; font-size:14pt; padding: 0px; color:#000; ">
							Monitoring System
						</h6>
						<h6
							style="text-align: center; margin:0px 0px 15px 0px; font-size:12pt; padding: 0px; color:#000; text-decoration:underline;">
							Applicant List
						</h6>
					</th>
				</tr>
			</table>




			<table id="dataTable" class="table table_new datatable table-bordred table-hover bg-white">
				<thead>
					<tr>
						<th>S.No.</th>
						<th class="text-center">View</th>
						<th class="text-center">Status</th>
						<th class="text-center">Query status</th>
						<th>Registration No.</th>
						{{-- <th>Application No.</th> --}}
						<th>Applicant Name</th>
						<th>Father Name</th>
						<th> PEN No.</th>
						<th>Mobile</th>
						<th>Aadhar Number</th>
						<th>Sports Name</th>
						<th>Sub Sports </th>
						<th>UDISE Code</th>
						<th class="text-center">Transaction Date</th>
						<th>Transaction Id</th>
						<th>Email</th>
						{{-- <th class="text-center">Action</th> --}}
						<th class="text-center">Trial 1 Status</th>
						<th class="text-center">Trial 2 status</th>

						<th class="text-center">Sport College</th>


					</tr>
				</thead>
				<tbody>
					@if(!empty($registrations)) @foreach($registrations as $key=>$registration)
					<tr>
						<td>{{ $key+1 }}</td>
						<td class="text-center"><a href="{{url('/collegeadmin/admission-detail/')}}/{{ $registration->register_id }}" class="btn btn-sm btn-dark rounded-pill border-0" target="_blank"><i class="fa fa-eye"></i></a></td>
						<td class="text-center">
							@if ($registration->final_status == 1)
							<span class="badge bg-warning text-white rounded-pill">Pending</span> @elseif ($registration->final_status == 2)
							<span class="badge bg-primary text-white rounded-pill">Provisionally accepted</span> @else
							<span class="badge bg-danger rounded-pill">Rejected</span>


							@endif
						</td>
						<td>{{ $registration->application_no }}</td>
						
						{{-- <td>{{ $registration->enroll_no }}</td> --}}
						<td>{{ $registration->fullname }}</td>

						<td>{{ $registration->father_name }}</td>
						<td>@if($registration->pen_no){{ $registration->pen_no }}@else NA @endif</td>
						<td>{{ $registration->mobile }}</td>
						<td>{{ $registration->aadhar_no }}</td>
						<td>{{ $registration->name }}</td>
						<td>
							@if ($registration->sub_type && $registration->sub_type != " ")
							{{$registration->sub_type }}
							@else
							NA
							@endif
						</td>
						<td>@if($registration->updise_code){{ $registration->updise_code }}@else NA @endif</td>
						<td>@if(isset($registration->transDate))
							{{dmy($registration->transDate)}}
							@endif
						</td>
						<td class="text-center">
							@if( isset($registration->uniquechallan)) {{$registration->uniquechallan}} @else NA @endif
						</td>
						<td>{{ $registration->email }}</td>
						
						@php
  //  $trial1 = trial_date($registration->application_no, 1);
  //  $trial2 = trial_date($registration->application_no, 2);
@endphp

<td>
    @if ($registration->trial_type == 1)
        NA
    @elseif (in_array($registration->trial_type, [2, 3, 5]))
        <span class="badge bg-success rounded-pill">Pass</span><br>
     {{-- {{ isset($trial1->date) ? dmy($trial1->date) : 'NA' }} --}}
    @elseif ($registration->trial_type == 4)
        <span class="badge bg-danger rounded-pill">Fail</span><br>
        {{-- {{ isset($trial1->date) ? dmy($trial1->date) : 'NA' }} --}}
    @endif
</td>

<td>
    @if (in_array($registration->trial_type, [1, 2, 4]))
        NA
    @elseif ($registration->trial_type == 3)
        <span class="badge bg-success rounded-pill">Pass</span><br>
        {{-- {{ isset($trial2->date) ? dmy($trial2->date) : 'NA' }} --}}
    @elseif ($registration->trial_type == 5)
        <span class="badge bg-danger rounded-pill">Fail</span><br>
        {{-- {{ isset($trial2->date) ? dmy($trial2->date) : 'NA' }} --}}
    @endif
</td>

						{{-- <td class="text-center">
										<!-- <span class="badge border border-success text-success bg-transparent  rounded-pill">Forwarded</span> -->
										<span class="badge border border-info text-info bg-transparent  rounded-pill">Not Forwarded</span>
										<!-- <span class="badge border border-danger text-danger bg-transparent  rounded-pill">Decline</span>
										<span class="badge border border-warning text-warning bg-transparent  rounded-pill">Pending</span> -->
									</td> --}}
						<td class="text-center">
							@if(isset($registration->query_status) && ($registration->query_status == 1)) Query Marked @elseif($registration->query_status == 2) Query Resolved @else NA @endif </td>






						<td>
							Preference 1 : {{sportCollege( explode(",",$registration->sport_college)[0])}} <br>

							@isset($registration) @if ( count(explode(",",$registration->sport_college)) > 1)
							Preference 2 : {{sportCollege( explode(",",$registration->sport_college)[1])}} @endif @endisset
						</td>



						<!-- <td class="text-center">
                            <a href="javascript:void(0)" class="btn btn-sm btn-dark rounded-pill border-0" onclick="changeTrial({{ $registration->register_id  }},{{ $registration->trial_division }} )">Change Trial</a>
					</td> -->
					</tr>
					@endforeach @endif
				</tbody>
			</table>
		</div>
	</div>
</div>


@endsection

@push('custom-scripts')





<div class="modal" id="exampleModalLabellllll">
	<div class="modal-dialog modal-lg">

		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">Change Trial Division</h5>
				<!--<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>-->
			</div>



			<form id="formReject" action="{{route('change_trial_division')}}" method="post">
				@csrf
				<div class="modal-body">




					<div class="row">
						<div class="col-md-12">
							<div class="form-group mb-3">
								<input type="hidden" name="user_id" id="user_id" value="">
								<label class="placeholder">1.Trial Division<span class="text-danger">*</span></label>
								<select class="form-select form-control" required name="trial_division" id="trial_division">
									<option value="">Select</option>
									@foreach ($division as $type)
									<option value="{{$type->id}}">{{$type->division_name}}</option>
									@endforeach
								</select>
							</div>
						</div>
					</div>
					<div class="modal-footer">
						<!--<button type="button" class="btn btn btn-outline-danger"><span class="icons icon-cloud-download"></span> Download</button>-->
						<button type="submit" class="btn btn-info">Submit</button>
						<button type="button" class="btn btn-danger" onclick="closetrial()">No</button>
					</div>



			</form>


		</div>
	</div>
</div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.9.2/html2pdf.bundle.js">
</script>
<script type="text/javascript" src="{{ asset('js/xlsx.full.min.js') }}"></script>
<script>
	function changeTrial(id, trial_division) {
		$("#exampleModalLabellllll").show();
		$("#user_id").val(id);
		$("#trial_division").val(trial_division);


	}



















	function closetrial() {
		$("#exampleModalLabellllll").hide();
	}

	function ExportToExcel(type, fn, dl) {
		var elt = document.getElementById('dataTable');
		var wb = XLSX.utils.table_to_book(elt, {
			sheet: "sheet1"
		});
		return dl ?
			XLSX.write(wb, {
				bookType: type,
				bookSST: true,
				type: 'base64'
			}) :
			XLSX.writeFile(wb, fn || ('Application Details.' + (type || 'xlsx')));
	}



	function sporttype(sport) {
		var subsports_id = $("#sport").attr('data-subsport');
		$.ajax({
			type: "POST",
			url: "{{url('collegeadmin/get_subsport')}}",
			data: {
				sport
			},
			success: function(response) {

				var d = $('select[name="subsport"]').empty();
				$('select[name="subsport"]').append(
					'<option value="">Select Sub Sport</option>');
				$.each(response.sub_type, function(key, value) {
					$('select[name="subsport"]').append(
						`<option  ${value.id==subsports_id?'selected':''}   value="${value.id}"> ${value.sub_type} </option>`);
				});
			}

		})
	}


	function PrintDocc() {
		// let makepdf = document.getElementById("prodiv");
		// html2pdf().from(makepdf).save();
		var toPrint = document.getElementById('prodiv');

		var popupWin = window.open('', '_blank', 'left=100,top=100,width=1100,height=600,tollbar=0,scrollbars=1,status=0,resizable=1');

		popupWin.document.open();

		popupWin.document.write('<html><head><style>body{font-family:Arial; counter-reset: page;} .noprint, #dataTable_length, #dataTable_filter {display: none;} table{width:100%; border-collapse:collapse;} .table tr th, .table tr td{border:1px solid #000; padding:2px 3px; font-size: 10pt;} </style></head><body onload="window.print()">')

		popupWin.document.write(toPrint.innerHTML);
		popupWin.document.write('<div style="text-align:center; width:98%; font-size:9pt; padding:0px; position:fixed; bottom:0;">This is a Software Generated Report.</div></body></html>');
		popupWin.document.close();



		// $('.fa-download').text('Uploaded');
		//     var toPrint = document.getElementById('prodiv');
		//
		//     var popupWin = window.open('', '_blank', 'left=100,top=100,width=1100,height=600,tollbar=0,scrollbars=1,status=0,resizable=1');
		//
		//     popupWin.document.open();
		//
		//     popupWin.document.write('<html><head><style>body{font-family:Arial}  .intentbtn { display: table; width: 100%; margin-bottom: 10px; margin-top: 5px; background-image: url(../images/corner-1.png); background-position: right top; background-size: contain; min-height: 100px; } a{ text-decoration: none; } .bg-light{background-color: #dee2e6 !important; font-size: 14px !important;} .noprint{display: none;} table{width:100%; border-collapse:collapse;} .table tr th, .table tr td{border:1px solid #000; padding:4px 5px; font-size: 12px;}</style></head><body onload="window.print()">')
		//
		//     popupWin.document.write(toPrint.innerHTML);
		//
		//     popupWin.document.write('<div style="text-align:center; width:98%; font-size:9pt; padding:0px; position:fixed; bottom:0;">This is a Software Generated Report.</div></body></html>');
		//
		//     popupWin.document.close();
		//     $('.fa-download').text('');
	}
</script>
@endpush
