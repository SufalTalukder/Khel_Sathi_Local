@extends( 'layouts/admin_layout' )
@section( 'content' )
<div class="pageheader" id="menu-margin">
	<h4 class="mb-0">
		Application Details

		<a href="{{ asset('assets_admin/dashboard') }}" class="btn btn-outline-danger btn-sm backbtn float-end  m-0"><span class="icons icon-arrow-left"></span>Back/पीछे</a>
	</h4>
</div>
<div class="card">
	<div class="card-body">
		<form action="{{ route('online_admission_absent') }}" class="needs-validation" method="post" autocomplete="off" id="formHostelMaster" novalidate>
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
                @if(Auth::guard('admin')->user()->admin_role == 1 || Auth::guard('admin')->user()->admin_role == 6 )
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
						<label for="name">Trial </label>
						<select class="form-select" id="triallist" name="trial_type">
							<option value="">Select Trial List</option>
							<option value="1" {{request()->input('trial_type') == 1 ? 'selected' : ''}}>Trial One Absent</option>
							<option value="2" {{request()->input('trial_type') == 2 ? 'selected' : ''}}>Trial Two Absent</option>

						</select>
					</div>
					@if ($errors->has('action'))
					<span class="error_mess">{{ $errors->first('action') }}</span> @endif
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
						<a href="{{ asset('assets_admin/online_admission_absent') }}" class="btn btn-danger backbtn ">Reset</a>
					</div>
				</div>
			</div>
		</form>
	</div>
</div>
<div class="pageheader" id="menu-margin">
	<h4 class="mb-0">
		Application List
		<a title="Application Details ExportToExcel" class="btn btn-sm btn-success float-end" onclick="ExportToExcel('xlsx')">
			<i class="fa fa-file-excel"></i> Export to Excel
		</a>
	</h4>
</div>
<div class="card">
	<div class="card-body">
		<div class="table-responsive table-bordred">
			<table id="dataTable" class="table table_new datatable table-bordred table-hover bg-white">
				<thead>
					<tr>
						<th>S.No.</th>
						<th>Registration No.</th>
                        <th class="text-center">Date</th>

						<th>Applicant Name</th>



						<th>Sports Name</th>
						<th>Sub Sports </th>

						<th class="text-center">View</th>
					</tr>
				</thead>
				<tbody>
					@if(!empty($registrations)) @foreach($registrations as $key=>$registration)
					<tr>
						<td>{{ $key+1 }}</td>
						<td>{{ $registration->application_no }}</td>
                        <td>@if(isset($registration->created_at))
							{{dmy($registration->created_at)}}
							@endif
						</td>
						{{-- <td>{{ $registration->enroll_no }}</td> --}}
						<td>{{ $registration->fullname }}</td>


						<td>{{ $registration->name }}</td>
						<td>
							@if ($registration->sub_type && $registration->sub_type != " ")
							{{$registration->sub_type }}
							@else
							NA
							@endif
						</td>

						{{-- <td class="text-center">
										<!-- <span class="badge border border-success text-success bg-transparent  rounded-pill">Forwarded</span> -->
										<span class="badge border border-info text-info bg-transparent  rounded-pill">Not Forwarded</span>
										<!-- <span class="badge border border-danger text-danger bg-transparent  rounded-pill">Decline</span>
										<span class="badge border border-warning text-warning bg-transparent  rounded-pill">Pending</span> -->
									</td> --}}
                                   		<td class="text-center">
                        	<a href="{{url('/collegeadmin/admission-detail/')}}/{{ $registration->id }}" class="btn btn-sm btn-dark rounded-pill border-0"><i class="fa fa-eye"></i></a>
						</td>
					</tr>
					@endforeach @endif
				</tbody>
			</table>
		</div>
	</div>
</div>


@endsection

@push('custom-scripts')
<div class="modal" id="exampleModalLabellllll" >
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
                                <option  value="{{$type->id}}" >{{$type->division_name}}</option>
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

<script type="text/javascript" src="{{ asset('js/xlsx.full.min.js') }}"></script>
<script>

function changeTrial(id, trial_division){
    $("#exampleModalLabellllll").show();
    $("#user_id").val(id);
    $("#trial_division").val(trial_division);


}


function closetrial(){
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





</script>
@endpush
