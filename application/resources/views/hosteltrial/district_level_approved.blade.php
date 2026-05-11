@extends( 'layouts/admin_layout' )
@section( 'content' )



		<div class="pageheader" id="menu-margin">
			<h4 class="mb-0"> List of Hostel Applicant<!-- <a class="btn btn-sm btn-success" href="{{ route('exportExcel',5) }}"> -->
              
				<a title="Application Details ExportToExcel" class="btn btn-sm btn-success float-end" href="{{route('download_hostel_pdf',2)}}">
					<i class="fa fa-file-excel"></i> Export to PDF
				</a>
				
				<a title="Sport Wise Count" class="btn btn-sm btn-success float-end" onclick="ExportToExcel('xlsx')">
                    <i class="fa fa-file-excel"></i> Export to Excel
                  </a>
							     </h4> </div>

		<div class="card">

			<div class="card-body">
				<div class="mb-4">
					<form class="row" method="post" action="{{ route('district_level_approved') }}">
                        @csrf
						<div class="col-md-1">
							<label for="session_year">Year</label>
							<select class="form-control" name="session_year" onchange="fetchone()">
								@foreach ($years as $year)
								<option value="{{$year}}" {{(request()->input('session_year') ?? config('app.session_year')) == $year ? 'selected' : ''}}>{{$year}}</option>
								@endforeach
							</select>
						</div>

						<div class="col-md-2">

							<label for="project_filter">Sport</label>
							<select class="form-control" id="sport_filter" name="sport_id" onchange="fetchone()">
								<option value="">--All--</option>
								@foreach ($sports as $item)
								<option value="{{$item->id}}" {{request()->input('sport_id') == $item->id ? 'selected' : ''}}>{{$item->name}}</option>
								@endforeach

							</select>

						</div>

                        <div class="col-md-1">
							<label for="status_filter">Gender</label>
							<select class="form-control"  name="gender" >
								<option value="">--All--</option>
								<option value="1" {{request()->input('gender') == 1 ? 'selected' : ''}}>Male</option>
								<option value="2" {{request()->input('gender') == 2 ? 'selected' : ''}}>Female</option>

							</select>
						</div>
                        @if(Auth::guard('admin')->user()->district_id < 1)
						<div class="col-md-2">
							<label for="city_filter">District</label>
							<select class="form-control" id="city_filter" name="city_filter" onchange="fetchone()">
								<option value="">--All--</option>
								@foreach ($districts as $item)
								<option value="{{$item->id}}" {{request()->input('city_filter') == $item->id ? 'selected' : ''}}>{{$item->city}}</option>
								@endforeach
							</select>
						</div>
                        @endif

                        <div class="col-md-2">
							<label for="approval_filter">Status</label>
							<select class="form-control" name="approval_filter" onchange="fetchone()">
								<option value="">--All--</option>
								<option value="1" {{request()->input('approval_filter') == 1 ? 'selected' : ''}}>Approved</option>
								<option value="2" {{request()->input('approval_filter') == 2 ? 'selected' : ''}}>Pending</option>
							</select>
						</div>

						<div class="col-md-1">
							<label for="reset">&nbsp;</label>
							<button type="submit" class="btn btn-info  btn-block">
							Submit
                            </button>
						</div>
                        <div class="col-md-1">
							<label for="reset">&nbsp;</label>
							<a href="{{ route('district_level_approved') }}" class="btn btn-success  btn-block">
					      	Reset
                            </a>
						</div>
                        <div class="col-md-1">
							<label for="reset">&nbsp;</label>
                            <a title="Check items to approve and click here" class="btn btn-success  btn-block " onclick="approvedchecked()">
                                Approve
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
								<th>Email ID</th>
                                <th>Mobile</th>
                                <th>Gender</th>
								<th>District</th>
                            
								<th>Sports</th>
								{{-- <th>Application Status</th> --}}

								<th class="text-center">Action</th>
                                <th class="text-center">Approved</th>


						  </tr>
						</thead>
						<tbody id="hostelapplicant">
							@foreach ($hostelList as $key=>$item)
							<tr>
								<td>{{$key + 1}}</td>
								<td>{{$item->application_no}}</td>
								<td>{{$item->name}}</td>
								<td>{{$item->email}}</td>
                                <td>{{$item->mobile}}</td>
                                <td>@if($item->gender == 1) Male @else Female @endif</td>
								<td>{{districtName($item->district_id)}} </td>
                                <td>{{sport_name_hostel($item->sports)}} </td>
							


								{{-- <td>@if ($item->status == 3) Pending @elseif ($item->status == 1) Allotted @else Not Allotted @endif
								</td> --}}
								<td><a class="btn btn-sm btn-dark" href="{{route('hostelView', $item->id)}}"><i class="fa fa-eye"></i>   </a> </td>
                                 <td>
                                    @if ($item->district_level_approved)
                                    <div class="btn btn-sm btn-primary">Approved  </div>
                                    @else
                                    <input class="form-check-input approvedcheck" type="checkbox" value="{{ $item->id }}" id="flexCheckDefault">
                                    <label class="form-label" for="flexCheckDefault">
                                      Approve
                                    </label>
                                    @endif

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
        url: ajaxUrl + '/hosteladmin/district_level_approved_store',
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
         XLSX.writeFile(wb, fn || ('Applicant List.' + (type || 'xlsx')));
    }
</script>


@endsection
