@extends( 'layouts/admin_layout' )
@section( 'content' )

<div class="pageheader" id="menu-margin">
<h4 class="mb-0"> List of Hostel Applicant

	</h4>
</div>


<div class="card">
	<div class="card-body">
		<div class="mb-4">
			<form class="row" method="post" action="{{ route('filterHostel') }}">
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
							<option value="{{ data_get($item, 'id') }}" {{request()->input('sport_id') == data_get($item, 'id') ? 'selected' : ''}}>{{ data_get($item, 'name') }}</option>
							@endforeach
						</select>
					</div>
				</div>
				<div class="col-md-4">
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
				<label for="status_filter">Application Status</label>
				<select class="form-select" id="status_filter" name="status_filter" onchange="fetchone()">
					<option value="">--All--</option>
					<option value="3" {{request()->input('status_filter') == 3 ? 'selected' : ''}}  {{Request::segment(3) == 3 ? 'selected' : ''}} >Pending</option>
					<option value="1" {{request()->input('status_filter') == 1 ? 'selected' : ''}} {{Request::segment(3) == 1 ? 'selected' : ''}}>Provisionally Accepted</option>
					<option value="2" {{request()->input('status_filter') == 2 ? 'selected' : ''}} {{Request::segment(3) == 2 ? 'selected' : ''}}>Rejected</option>
				</select>
			</div>
		</div>

        <div class="col-md-4">
			<div class="form-group">
				<label for="status_filter">District Level Trial</label>
				<select class="form-select" name="district_trial">
					<option value="">--All--</option>
				    <option value="1" {{request()->input('district_trial') == 1 ? 'selected' : ''}} >Pending</option>
					<option value="2" {{request()->input('district_trial') == 2 ? 'selected' : ''}} >Pass</option>
					<option value="3" {{request()->input('district_trial') == 3 ? 'selected' : ''}}  >Fail</option>
					</select>
			</div>
		</div>

        <div class="col-md-4">
			<div class="form-group">
				<label for="status_filter">Payment Status</label>
				<select class="form-select" name="payment_status">
					<option value="">--All--</option>
				    <option value="1" {{request()->input('payment_status') == 1 ? 'selected' : ''}} >Pending</option>
					<option value="2" {{request()->input('payment_status') == 2 ? 'selected' : ''}} >Success</option>
					<option value="3" {{request()->input('payment_status') == 3 ? 'selected' : ''}}  >Fail</option>
					</select>
			</div>
		</div>

        @if( Auth::guard('admin')->user()->division_id > 1 || (Auth::guard('admin')->user()->district_id < 1 && Auth::guard('admin')->user()->division_id < 1))
        <div class="col-md-4">
			<div class="form-group">
				<label for="status_filter">Division Level Trial</label>
				<select class="form-select" name="division_trial">
					<option value="">--All--</option>
				    <option value="1" {{request()->input('division_trial') == 1 ? 'selected' : ''}} >Pending</option>
					<option value="2" {{request()->input('division_trial') == 2 ? 'selected' : ''}} >Pass</option>
					<option value="3" {{request()->input('division_trial') == 3 ? 'selected' : ''}}  >Fail</option>
					</select>
			</div>
		</div>
        @endif
        @if(Auth::guard('admin')->user()->district_id < 1 && Auth::guard('admin')->user()->division_id < 1)
        <div class="col-md-4">
			<div class="form-group">
				<label for="status_filter">State Level Trial</label>
				<select class="form-select" name="state_trial">
					<option value="">--All--</option>
				    <option value="1" {{request()->input('state_trial') == 1 ? 'selected' : ''}} >Pending</option>
					<option value="2" {{request()->input('state_trial') == 2 ? 'selected' : ''}} >Pass</option>
					<option value="3" {{request()->input('state_trial') == 3 ? 'selected' : ''}}  >Fail</option>
					</select>
			</div>
		</div>



        @endif


        <div class="col-md-4">
			<div class="form-group">
				<label for="status_filter">Existing student of Sports College</label>
				<select class="form-select" name="existing_student">
					<option value="">--All--</option>
				    <option value="1" {{request()->input('existing_student') == 1 ? 'selected' : ''}} >Yes </option>
					<option value="2" {{request()->input('existing_student') == 2 ? 'selected' : ''}} >No</option>
					</select>
			</div>
		</div>

        <div class="col-md-4">
			<div class="form-group">
				<label for="status_filter">Session Year </label>
                <select class="form-select" name="session_year">
					<option value="">--All--</option>
                    @php
                        $currentSession = config('app.session_year');
                    @endphp
                    @for ($i = $currentSession; $i >= 2024; $i--)
                        <option value="{{$i}}" {{request()->input('session_year') == $i ? 'selected' : ''}} >{{$i}}-{{$i+1}}</option>
                    @endfor
					</select>
			</div>
		</div>

		<div class="col-md-4">
			<div class="form-group">
				<label for="status_filter">Gender </label>
				<select class="form-select" name="gender">
					<option value="">--All--</option>
                    <option value="1" {{request()->input('gender') == 1 ? 'selected' : ''}} >Male</option>
				    <option value="2" {{request()->input('gender') == 2 ? 'selected' : ''}} >Female</option>


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
		<a title="Application Details ExportToExcel" class="btn btn-sm btn-success float-end" href="{{route('download_hostel_pdf',1)}}">
			<i class="fa fa-file-excel"></i> Export to PDF
		</a>
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
                    <th>Mobile</th>
					<th>District</th>
					<th>Sport</th>
                    <th>Sub Sport</th>
					<th>Application Status</th>

					<th>Payment Status</th>

					{{-- <th>Cancelled Status</th> --}}
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
                    <td>{{$item->mobile}}</td>
					<td>{{districtName($item->district_id)}} </td>
					<td> {{sport_name_hostel($item->sports)}} </td>

                    <td>  <input type="hidden" name="" value="{{ $item->sub_sport_type }}" id="subsport_filterrr{{$item->id}}">

                        @if($item->sub_sport_type){{sub_sport_name($item->sub_sport_type)}} @else NA @endif </td>

					<td>@if ($item->status == 3) Pending @elseif ($item->status == 1) Provisionally Accepted @else Rejected @endif
					</td>
					<?php if($item->payment_status==1 || $item->payment_status==2 || $item->payment_status==3){ ?>
					<td>
					<?php if($item->payment_status==1){ ?>
						<a href="javascript:void(0)" class="btn btn-warning btn-xs  disabled">Pending</a>
					<?php } ?>
					<?php if($item->payment_status==2){ ?>
						<a href="javascript:void(0)" class="btn btn-success btn-xs  disabled">Success


                        </a>
                        <br>

                       {{ dmy($item->payment_allotment_fee_date != "" ? $item->payment_allotment_fee_date : $item->payment_date) }}

                         <br>
                         10 INR
					<?php } ?>
					<?php if($item->payment_status==3){ ?>
						<a href="javascript:void(0)" class="btn btn-danger btn-xs  disabled">Fail</a>
                    <?php } }else{echo 'N/A';}?>

                </td>

                    {{-- <td>@if ($item->cancel_status == 1)
                        <a href="javascript:void(0)" class="btn btn-danger btn-xs  disabled">Cancelled</a>
                    @else
                        NA
                    @endif</td> --}}
					<td>

                        @if($item->detach_status == 1)


                           <a class="btn btn-sm btn-danger" href="javascript:void(0)" >Vacated</a>

                          @elseif($item->hostel_alloted_id)
                          <a class="btn btn-sm btn-warning" href="javascript:void(0)" onclick="fetchhosteldetach({{$item->id}})">Vacate</a>

                          @else

                          NA
                          @endif

                        {{-- <a class="btn btn-sm btn-warning" href="javascript:void(0)" onclick="subsportupdate({{ $item->id  }}, {{ $item->sports  }})">Subsport Update </a> --}}


        {{--                <a class="btn btn-sm btn-danger @if ($item->cancel_status == 1)disabled @endif" href="javascript:void(0)" onclick="rejectstatus({{ $item->id  }})"><i class="fa fa-close"></i> </a> --}}


                        <a class="btn btn-sm btn-dark" href="{{route('hostelView', $item->id)}}"><i class="fa fa-eye"></i> </a> </td>

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

<div class="modal" id="exampleModalLabellllll" >
    <div class="modal-dialog modal-lg">

        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Cancel</h5>
                <!--<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>-->
            </div>



            <form id="formReject" action="{{route('cancel_application_hostel')}}" method="post">
                @csrf
                <div class="modal-body">




                    <div class="row">


                        <div class="col-md-12">
                          <div class="form-group mb-3">
                            <input type="hidden" name="user_id" id="user_id" value="">
                            <label class="placeholder">Reason For Cancellation<span class="text-danger">*</span></label>
                            <input type="text" name="reason_cancelled" class="form-control" required>
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
</div> --}}

<div class="modal" id="exampleModalLabellllll2" >
    <div class="modal-dialog modal-lg">

        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title"> Hostel Detach</h5>
                <!--<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>-->
            </div>



            <form class="hosteldetach" action="{{route('hostel_detach')}}" method="post" >
                @csrf
                <div class="modal-body">




                    <div class="row">


                        <div class="col-md-12">
                          <div class="form-group mb-3">
                            <input type="hidden" name="user_id" id="user_iddd" value="">
                            <label class="placeholder">Reason For Detach<span class="text-danger">*</span></label>
                            <input type="text" name="reason_detach" class="form-control" required>
                          </div>
                        </div>
                </div>
                <div class="modal-footer">
                    <!--<button type="button" class="btn btn btn-outline-danger"><span class="icons icon-cloud-download"></span> Download</button>-->
                    <button type="submit" class="btn btn-info">Submit</button>
                    <button type="button" class="btn btn-danger" onclick="closetrialll()">No</button>
                </div>
            </form>


        </div>
    </div>
</div>

<div class="modal" id="exampleModalLabel2" >
    <div class="modal-dialog modal-lg">

        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Update Sub Sport</h5>
                <!--<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>-->
            </div>



            <form id="formReject" action="{{route('hostel_sub_sport_update')}}" method="post">
                @csrf
                <div class="modal-body">




                    <div class="row">


                        <div class="col-md-12">
                          <div class="form-group mb-3">
                            <input type="hidden" name="user_id" id="user_idd" value="">
                            <label class="placeholder">Sub Sport<span class="text-danger">*</span></label>
                            <select class="form-select form-control" required name="subsporttt" id="subsportt">
                                <option value="">Select</option>

                            </select>
                          </div>
                        </div>
                </div>
                <div class="modal-footer">
                    <!--<button type="button" class="btn btn btn-outline-danger"><span class="icons icon-cloud-download"></span> Download</button>-->
                    <button type="submit" class="btn btn-info">Submit</button>
                    <button type="button" class="btn btn-danger" onclick="closetrialll()">No</button>
                </div>
            </form>


        </div>
    </div>
</div>
<script>






function closetriall(){
    $("#exampleModalLabel2").hide();
}



function closetrialll(){
    $("#exampleModalLabellllll2").hide();
}



function rejectstatus(id){
    $("#exampleModalLabellllll").show();
    $("#user_id").val(id);
    $("#trial_division").val(trial_division);


}


function closetrial(){
    $("#exampleModalLabellllll").hide();
}


function subsportupdate(id,sport_id ){
	var subsports_id = $(`#subsport_filterrr${id}`).val();

$("#exampleModalLabel2").show();
$("#user_idd").val(id);
var sport = sport_id;
$.ajax({
			type: "POST",
			url: "{{url('collegeadmin/get_subsport')}}",
			data: {
				sport
			},
			success: function(response) {

				var d = $('select[name="subsporttt"]').empty();
				$('select[name="subsporttt"]').append(
					'<option value="">Select Sub Sport</option>');
				$.each(response.sub_type, function(key, value) {
					$('select[name="subsporttt"]').append(
						`<option    ${value.id==subsports_id?'selected':''}   value="${value.id}"> ${value.sub_type} </option>`);
				});
			}
		})



}






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







//     function fetchhostel(id) {



// $.ajax({
//     url: "{{ url('/hosteladmin/hostel_allotment_list') }}",
//     type: "POST",
//     data: {user_id:id},
//     success: function(res) {
//         $.each(res, function(key, data) {

//             var item = key + 1;
//             var vacantBoy = data.boys - data.boys_alloted;
//             var vacantGirl = data.girls - data.girls_alloted;
//             $('#hostellist').append(
//                 "<tr><td>" + item + "</td> <td>" + data.hostel_name + "</td><td>" + data.total_seats + "</td><td>" + data.boys + "</td> <td>" + data.girls + "</td><td>" + data.boys_alloted + "</td> <td>" + data.girls_alloted + "</td><td>" + vacantBoy + "</td><td>" + vacantGirl + "</td></tr>"
//             );
//         });
//     },
// });
// }




function fetchhosteldetach(id) {
        $("#user_iddd").val(id);
        $("#exampleModalLabellllll2").show();







}


$(`.hosteldetach`).submit(function (e) {
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


                    location.reload();



                } else {
                    error(res.msg);
                     }
            },
        });
});







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
