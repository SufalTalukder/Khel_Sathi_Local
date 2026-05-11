@extends( 'layouts/admin_layout' )
@section( 'content' )



		<div class="pageheader" id="menu-margin">
			<h4 class="mb-0"> Division Level Merit List<!-- <a class="btn btn-sm btn-success" href="{{ route('exportExcel',5) }}"> -->
                <a title="Sport Wise Count" class="btn btn-sm btn-success float-end" onclick="ExportToExcel('xlsx')">
                    <i class="fa fa-file-excel"></i> Export to Excel
                  </a>
							     </h4> </div>

		<div class="card">

			<div class="card-body">
				<div class="mb-4">
					<form class="row" method="post" action="{{ route('hostel_division_level_merit_list') }}">
                        @csrf

                            <div class="col-md-3">

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
                            <div class="col-md-3" id="subsport_div">
                                <label for="subsport">Sub Sport Name</label>
                                <div id="list1" class="dropdown-check-list">
                                    <select name="subsport" id="dropdownid" class="form-select">
                                    </select>
                                </div>
                            </div>



                        <div class="col-md-2">
							<label for="status_filter">Gender</label>
							<select class="form-control"  name="gender" >
								<option value="">--Select Gender--</option>
								<option value="1" {{request()->input('gender') == 1 ? 'selected' : ''}}>Male</option>
								<option value="2" {{request()->input('gender') == 2 ? 'selected' : ''}}>Female</option>

							</select>
						</div>
                        @if(Auth::guard('admin')->user()->division_id < 1)
						<div class="col-md-2">
							<label for="city_filter">Division</label>
							<select class="form-control" id="city_filter" name="division_filter" onchange="fetchone()">
								<option value="">--All--</option>
								@foreach ($divisions as $item)
								<option value="{{$item->id}}" {{request()->input('division_filter') == $item->id ? 'selected' : ''}}>{{$item->division_name}}</option>
								@endforeach
							</select>
						</div>
                          @endif

						<div class="col-md-1">
							<label for="reset">&nbsp;</label>
							<button type="submit" class="btn btn-info  btn-block">
							Submit
                            </button>
						</div>
                        <div class="col-md-1">
							<label for="reset">&nbsp;</label>
							<a href="{{ route('hostel_division_level_merit_list') }}" class="btn btn-success  btn-block">
					      	Reset
                            </a>
						</div>






					</form>
				</div>


			  <div id="hostelapplication" class="table-responsive">

				<table  id="dataTable" class="table table-striped table-bordered dataTable datatable">
						<thead>
							<tr>
								<th>S.No.</th>
								<th>Application No.</th>
								<th>Applicant’s Name</th>

                                <th>Mobile</th>

                                <th>DOB</th>
                                <th>Gender</th>
								<th>District</th>
								<th>Sports</th>
								<th>Physical Marks</th>
                                <th>Skill Marks</th>
                                <th>Total Marks</th>

								<th class="text-center">Action</th>



						  </tr>
						</thead>
						<tbody id="hostelapplicant">
							@foreach ($hostelList as $key=>$item)
							<tr>
								<td>{{$key + 1}}</td>
								<td>{{$item->application_no}}</td>
								<td>{{$item->name}}</td>

                                <td>{{$item->mobile}}</td>
                                <td>{{dmy($item->dob)}}</td>
                                <td>@if($item->gender == 1) Male @else Female @endif</td>
								<td>{{districtName($item->district_id)}} </td>
                                <td>{{sport_name_hostel($item->sports)}} </td>

								<td>@if ($item->physical_trial_two_marks) {{ $item->physical_trial_two_marks }}@else NA @endif
								</td>
                                <td>@if ($item->skill_trial_two_marks) {{ $item->skill_trial_two_marks }}@else NA @endif
								</td>
                                <td>@if ($item->total) {{ $item->total }}@else NA @endif
								</td>
								<td><a class="btn btn-sm btn-dark" href="{{route('hostelView', $item->id)}}"><i class="fa fa-eye"></i>   </a> </td>


                                 </td>
							</tr>
							@endforeach

						</tbody>
					</table>


				</div>


			</div>
		</div>




        <script type="text/javascript" src="{{ asset('js/xlsx.full.min.js') }}"></script>
<script>
	$(document).ready(function() {
		var initial_sport = $("#sport_filter").val();
		if (initial_sport) {
			sporttype(initial_sport);
		}
	});

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

	function hostelList( user_id ) {
		$( '#hostelAlotuser' ).val( user_id );
		$.ajax( {
			url: "{{ asset('assets_admin/hostel_filter')}}/" + user_id,
			type: "GET",
			dataType: "json",
			success: function ( data ) {

				var d = $( 'select[name="hostel_id"]' ).empty();
				$( 'select[name="hostel_id"]' ).append(
					'<option value="">Select Module</option>' );
				$.each( data, function ( key, value ) {
					$( 'select[name="hostel_id"]' ).append(
						'<option value="' + value.id + '">' + value
						.hostel_name + '</option>' );
				} );
			},
		} );
	}

    function approvedchecked(){
        var arr = [];
$('input.approvedcheck:checkbox:checked').each(function () {
    arr.push($(this).val());
});
$.ajax({
        type: "POST",
data:{arr},
        url: ajaxUrl + '/hosteladmin/division_level_approved_store',
        dataType: "json",
        success: function (res) {
            success(res.msg);
            window.location.reload();
            },
    	});

    }



    function ExportToExcel(type, fn, dl) {
       var elt = document.getElementById('dataTable');
       var wb = XLSX.utils.table_to_book(elt, { sheet: "sheet1" });
       return dl ?
         XLSX.write(wb, { bookType: type, bookSST: true, type: 'base64' }):
         XLSX.writeFile(wb, fn || ('Division Level Merit List.' + (type || 'xlsx')));
    }

</script>


@endsection
