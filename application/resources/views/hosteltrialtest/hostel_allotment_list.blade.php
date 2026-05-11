@extends( 'layouts/admin_layout' )
@section( 'content' )



		<div class="pageheader" id="menu-margin">
			<h4 class="mb-0"> Hostel Allotment <!-- <a class="btn btn-sm btn-success" href="{{ route('exportExcel',5) }}"> -->
                <a title="Sport Wise Count" class="btn btn-sm btn-success float-end" onclick="ExportToExcel('xlsx')">
                    <i class="fa fa-file-excel"></i> Export to Excel
                  </a>
							     </h4> </div>

		<div class="card">

			<div class="card-body">
				<div class="mb-4">
					<form  method="post" action="{{ route('hostel_allotment_list') }}"  class="needs-validation row"  novalidate enctype="multipart/form-data">
                        @csrf


                        <div class="col-md-2">
							<label for="status_filter">Gender <span class="text-danger">*</span></label>
							<select   name="gender" class="form-control" required id="gender">
								<option value="">--Select Gender--</option>
								<option value="1" {{request()->input('gender') == 1 ? 'selected' : ''}}>Male</option>
								<option value="2" {{request()->input('gender') == 2 ? 'selected' : ''}}>Female</option>

							</select>
						</div>
						<div class="col-md-3">

							<label for="project_filter">Sport <span class="text-danger">*</span></label>
							<select class="form-control" id="sport_filter" name="sport_id" required>
								<option value="">--All--</option>
								@foreach ($sports as $item)
								<option value="{{$item->id}}" {{request()->input('sport_id') == $item->id ? 'selected' : ''}}>{{$item->name}}</option>
								@endforeach

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
							<a href="{{ route('hostel_allotment_list') }}" class="btn btn-success  btn-block">
					      	Reset
                            </a>
						</div>
                        {{-- <div class="col-md-1">
							<label for="reset">&nbsp;</label>
                            <a class="btn btn-success  btn-block " onclick="approvedchecked()">
                                Approved
                            </a>
						</div> --}}





					</form>
				</div>


                            <div class="card" style="display: none" id="college_allot">

                                <div class="card-body">
                                    <div class="col-90">
                                        <form action="{{route('hostel_allot')}}" method="post" enctype="multipart/form-data" class="directMarkQuery needs-validation hostelallotted" novalidate>
                                            @csrf
                                        <div class="form-group">
                                            <input type="hidden" name="user_id" id="hostelAlotuser" value="">
                                            <label class="placeholder">Hotel List <span class="text-danger">*</span></label>
                                            <select name="hostel_id" class="form-control" required>
                                            </select>
                                            <button type="button" class="btn-warning" onclick="closemodal()">Close</button>
                                            <button type="submit" class="btn btn-success mt-2">Submit/दर्ज करे</button>
                                        </div>
                                    </form>
                                    </div>
                                </div>
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



						  </tr>
						</thead>
						<tbody id="hostelapplicant">
							@foreach ($hostelList as $key=>$item)
							<tr>
								<td>{{$key + 1}}  <input class="form-check-input approvedcheck" type="checkbox"  id="approvedcheck{{ $item->id }}" @if($item->hostel_alloted_id) checked disabled value="" @else value="{{ $item->id }}" @endif   onclick="approvedchecked()">
                                </td>
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

							</tr>
							@endforeach

						</tbody>
					</table>


				</div>


			</div>
		</div>



@endsection

@push('custom-scripts')

{{--
<div class="" id="college_allot" >
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Hostel Alot</h5>
                <button type="button" class="btn-close" onclick="closemodal()" ></button>
            </div>
            <form action="{{route('hostel_allot')}}" method="post" enctype="multipart/form-data" class="directMarkQuery needs-validation" novalidate>
                @csrf
                <div class="card">
                    <div class="card-body">
                        <div class="col-90">
                            <div class="form-group">
                                <input type="hidden" name="user_id" id="hostelAlotuser" value="">
                                <label class="placeholder">Hotel List <span class="text-danger">*</span></label>
                                <select name="hostel_id" class="form-control" required>
                                </select>
                                <button type="button" class="btn btn-info mt-2" data-bs-dismiss="modal">Back</button>
                                <button type="submit" class="btn btn-success mt-2">Submit/दर्ज करे</button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div> --}}












<script type="text/javascript" src="{{ asset('js/xlsx.full.min.js') }}"></script>
<script >

function closemodal(){
    $('#college_allot').hide()
}


    function approvedchecked(){


        var arr = [];
$('input.approvedcheck:checkbox:checked').each(function () {
    if($(this).val()){
        arr.push($(this).val());
    }

});

  if(arr.length == 0){
    $('#college_allot').hide()
  }

 var gender = $('#gender').val();
 var sport_filter = $('#sport_filter').val();
 $.ajax({
            type: "POST",
            url: "{{url('hosteladmin/hostel_seat_vacant')}}",
            data: {gender:gender,arr:arr, sport : sport_filter},
            success: function (response) {
                $('#college_allot').show();
                $('#hostelAlotuser').val(arr)

                var d = $('select[name="hostel_id"]').empty();
				$('select[name="hostel_id"]').append(
					'<option value="">Select Hostel</option>');
				$.each(response.data, function(key, value) {
					$('select[name="hostel_id"]').append(
						'<option value="' + value.id + '">' + value
						.hostel_name + ' (Vacant Seat : '+ value.vacant+')</option>');
				});

            }
        });
    }

    $(`.hostelallotted`).submit(function (e) {
                e.preventDefault();
              $.ajax({
            type: "POST",
            url: $(this).attr("action"),
            data: new FormData(this),
            //dataType: "json",
            contentType: false,
            cache: false,
            processData: false,
            success: function (res) {
                if (res.error == false) {


					success(res.msg);
                    $('#college_allot').hide()
                    var arr = [];
 $('input.approvedcheck:checkbox:checked').each(function () {
arr.push($(this).attr('disabled', true));
});





                } else {
                    error(res.msg);
                     }
            },
        });
});



    function ExportToExcel(type, fn, dl) {
       var elt = document.getElementById('dataTable');
       var wb = XLSX.utils.table_to_book(elt, { sheet: "sheet1" });
       return dl ?
         XLSX.write(wb, { bookType: type, bookSST: true, type: 'base64' }):
         XLSX.writeFile(wb, fn || ('Applicant List.' + (type || 'xlsx')));
    }

</script>
@endpush
