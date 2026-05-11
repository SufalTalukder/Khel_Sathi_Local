@extends( 'layouts/admin_layout' )
@section( 'content' )

<div class="pageheader" id="menu-margin">
<h4 class="mb-0"> List of Hostel Applicant

	</h4>
</div>


<div class="card">
	<div class="card-body">
		<div class="mb-4">
			<form class="row" method="post" action="{{ route('hostel_absent_application') }}">
				@csrf
				<div class="col-md-4">
					<div class="form-group">
						<label for="project_filter">Sport</label>
						@php
						$abc=request()->input('subsport');
						@endphp
						<select class="form-select" id="sport_filter" name="sport_id" onchange="sporttype(this.value)" data-subsport="{{  $abc }}">
							<option value="">--All--</option>
							@foreach ($sports as $item)
							<option value="{{$item->id}}" {{request()->input('sport_id') == $item->id ? 'selected' : ''}}>{{$item->name}}</option>
							@endforeach
						</select>
					</div>
				</div>
				<div class="col-md-4" id="subsport_div">
					<div class="form-group">
						<label for="subsport">Sub Sport Name</label>
						<div id="list1" class="dropdown-check-list">
							<select name="subsport" id="dropdownid" class="form-select">
							</select>
						</div>
					</div>
				</div>
				{{-- <div class="col-md-3">
							<label for="city_filter">Division</label>
							<select class="form-select" id="division" name="division" onchange="fetchone()">
								<option value="">--All--</option>
								@foreach ($divisions as $item)
								<option value="{{$item->id}}" {{request()->input('division') == $item->id ? 'selected' : ''}}>{{$item->division_name}}</option>
				@endforeach
				</select>
		</div> --}}


        @if(Auth::guard('admin')->user()->district_id < 1)



		<div class="col-md-4">
			<div class="form-group">
				<label for="city_filter">District</label>
				<select class="form-select" id="city_filter" name="city_filter" onchange="fetchone()">
					<option value="">--All--</option>
					@foreach ($districts as $item)
					<option value="{{$item->id}}" {{request()->input('city_filter') == $item->id ? 'selected' : ''}}>{{$item->city}}</option>
					@endforeach
				</select>
			</div>
		</div>

        @endif
		<div class="col-md-4">
			<div class="form-group">
				<label for="status_filter">Trial Absent</label>
				<select class="form-select" id="status_filter" name="trial_type" onchange="fetchone()">
					<option value="">--All--</option>
					<option value="1" {{request()->input('trial_type') == 1 ? 'selected' : ''}} {{Request::segment(3) == 1 ? 'selected' : '1'}}>District Trial Absent</option>
					<option value="2" {{request()->input('trial_type') == 2 ? 'selected' : ''}} {{Request::segment(3) == 2 ? 'selected' : '2'}}>Division Trial Absent</option>
                    <option value="3" {{request()->input('trial_type') == 3 ? 'selected' : ''}}  {{Request::segment(3) == 3 ? 'selected' : '3'}} >State Trial Absent</option>
                </select>
			</div>
		</div>
		<div class="col-md-2">
			<div class="form-group d-grid">
				<label for="reset">&nbsp;</label>
				<button type="submit" class="btn btn-primary  btn-block">
					Submit
				</button>
			</div>
		</div>
		<div class="col-md-2">
			<div class="form-group d-grid">
				<label for="reset">&nbsp;</label>
				<a href="{{ route('hostelList') }}" class="btn btn-danger btn-block">
					Reset
				</a>
			</div>
		</div>

		</form>
	</div>
	<div class="pageheader" id="menu-margin">
	<h4 class="mb-0">
		Application List
		<a title="Application Details ExportToExcel" class="btn btn-sm btn-success float-end" onclick="ExportToExcel('xlsx')">
			<i class="fa fa-file-excel"></i> Export to Excel
		</a>
	</h4>
</div>

	<div id="hostelapplication" class="table-responsive">
		<table id="dataTable" class="table table-striped table-bordered dataTable datatable">
			<thead>
				<tr>
					<th>S.No.</th>
					<th>Application No.</th>
					<th>Applicant’s Name</th>
					<th>Email ID</th>
					<th>District</th>
					<th>Sports</th>


					{{-- <th>Query Status</th> --}}
					<th class="text-center">Action</th>


				</tr>
			</thead>


			<tbody id="hostelapplicant">
				@foreach ($hostelList as $key=>$item)
				<tr>
					<td>{{$key + 1}}</td>
					<td>{{$item->application_no}}</td>
					<td>{{$item->name}}</td>
					<td>{{$item->email}}</td>
					<td>{{districtName($item->district_id)}} </td>
					<td>{{sport_name_hostel($item->sports)}} </td>



					<td><a class="btn btn-sm btn-dark" href="{{route('hostelView', $item->id)}}"><i class="fa fa-eye"></i> </a> </td>

				</tr>
				@endforeach

			</tbody>
		</table>






	</div>


</div>
</div>




@endsection



@push('custom-scripts')


<script>
	$(document).ready(function() {
		var initial_sport = $("#sport_filter").val();
		if (initial_sport) {
			sporttype(initial_sport);
		}
	});

	function hostelList(user_id) {
		$('#hostelAlotuser').val(user_id);
		$.ajax({
			url: "{{ asset('assets_admin/hostel_filter')}}/" + user_id,
			type: "GET",
			dataType: "json",
			success: function(data) {

				var d = $('select[name="hostel_id"]').empty();
				$('select[name="hostel_id"]').append(
					'<option value="">Select Module</option>');
				$.each(data, function(key, value) {
					$('select[name="hostel_id"]').append(
						'<option value="' + value.id + '">' + value
						.hostel_name + '</option>');
				});
			},
		});
	}


	function sporttype(sport) {
		var subsports_id = $("#sport_filter").attr('data-subsport');


		$.ajax({
			type: "POST",
			url: "{{url('collegeadmin/get_subsport')}}",
			data: {
				sport
			},
			success: function(response) {
				if (response.sub_type.length > 0) {
					$('#subsport_div').show();
					var d = $('select[name="subsport"]').empty();
					$('select[name="subsport"]').append(
						'<option value="">Select Sub Sport</option>');
					$.each(response.sub_type, function(key, value) {
						$('select[name="subsport"]').append(
							`<option  ${value.id==subsports_id?'selected':''}   value="${value.id}"> ${value.sub_type} </option>`);
					});
				} else {
					$('#subsport_div').hide();
					$('select[name="subsport"]').empty();
				}
			}
		})
	}
</script>

<script type="text/javascript" src="{{ asset('js/xlsx.full.min.js') }}"></script>
<script>
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
			XLSX.writeFile(wb, fn || ('Hostel Applicant List.' + (type || 'xlsx')));
	}
</script>
@endpush
