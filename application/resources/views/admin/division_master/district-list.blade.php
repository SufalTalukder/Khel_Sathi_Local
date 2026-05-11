@extends( 'layouts/admin_layout' )
@section( 'content' )

<div class="row">
	<div class="col-md-12">
		<div class="pageheader" id="menu-margin">
			<h4 class="mb-0">Create District</h4>
		</div>
		<div class="card mb-3">
			<div class="card-body">
				<form action="{{ route('saveDistrict') }}" class="needs-validation" method="post" autocomplete="off">
					@csrf
					<div class="row">
						<div class="col-md-2">
							<div class="form-group">
								<label for="name">State Name <span class="text-danger">*</span></label>
								<select class="form-select" id="state_id" name="state_id" style="pointer-events: none;" value="{{ old('state_id') }}" required="">
									<option selected="" disabled="" value="">Select State</option>
									@foreach($states as $key=>$state)
									<option {{$state->id == 23 ? 'selected' : ''}} value="{{ $state->id }}" data-badge="">{{$state->name}}</option>
									@endforeach
								</select>
							</div>
							@if ($errors->has('state_id'))
							<span class="error_mess">{{ $errors->first('state_id') }}</span>
							@endif
						</div>
						<div class="col-md-2">
							<div class="form-group">
								<label for="name">District Name <span class="text-danger">*</span></label>
								<input type="text" class="form-control alphanumeric" id="city" name="city" value="{{ old('city') }}" placeholder="Enter District Name" required="">
								<div class="invalid-feedback">
									Please Provide District Name.
								</div>
								@if ($errors->has('city'))
								<span class="error_mess">{{ $errors->first('city') }}</span> @endif
							</div>
						</div>
						<div class="col-md-2">
							<div class="form-group">
								<label for="name">Status <span class="text-danger">*</span></label>
								<select class="form-select" name="status" value="{{ old('status') }}" required="">
									<option selected="" disabled="" value="">Select Status</option>
									<option value="1">Enable</option>
									<option value="0">Disable</option>
								</select>
							</div>
							@if ($errors->has('status'))
							<span class="error_mess">{{ $errors->first('status') }}</span> @endif
						</div>
						<div class="col-md-4">
							<div class="form-group">
								<label for="name">Description <span class="text-danger">*</span></label>
								<textarea id="description" name="description" class="form-control" placeholder="Enter Description" style="height: 35px !important;"></textarea>
							</div>
							@if ($errors->has('description'))
							<span class="error_mess">{{ $errors->first('description') }}</span> @endif
						</div>
						<div class="col-md-2 d-grid">
							<label class="form-label">&nbsp;</label>
							<button class="btn btn-primary form-group" type="submit">Submit/दर्ज करे</button>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>


	<div class="col-md-12">
		<div class="pageheader" id="menu-margin">
			<h4 class="mb-0">District List <a title="District List" class="btn btn-sm btn-success float-end" onclick="ExportToExcel('xlsx')">
					<i class="fa fa-file-excel"></i> Export to Excel
				</a>
			</h4>
		</div>
		<div class="card">
			<div class="card-body">
				<div class="">
					<div class="table-responsive">
						<table id="dataTable" class="table table-bordred table-hover bg-white datatable">
							<thead>
								<tr>
									<th width="6%">S.No.</th>
									<th width="20%">District Name</th>
									<th class="text-center">Status</th>
									<th class="text-center">Description</th>
									<th class="text-center">Trial Location</th>

									<th class="text-center">Trial From Date</th>
									<th class="text-center">Trial To Date</th>
									<th class="text-center">Edit</th>
								</tr>
							</thead>
							<tbody>
								@foreach($districts as $key=>$district)
								<tr>

									<td>{{ $key+1 }}</td>
									<td>{{ $district->city }}</td>
									<td class="text-center">
										<div class="form-control2">
											<label class="switch">
												<input type="checkbox" id="themeskin{{ $key+1 }}" <?php if ($district->status == 1) {
																										echo "checked";
																									} elseif ($district->status == 0) {
																										echo "";
																									} else {
																										echo "checked";
																									} ?>>
												<div class="slider round" onclick="sportStatus('{{$district->id}}')">
													<span class="off">Disable</span>
													<span class="on">Enable</span>
												</div>
											</label>

										</div>
									</td>


									
									<td>{{ $district->description}}</td>
									<td>{{ $district->trial_location }}</td>


									<td>@if(isset($district->trial_from_date)){{ dmy($district->trial_from_date) }} @else NA @endif</td>
									<td>@if(isset($district->trial_to_date)){{ dmy($district->trial_to_date) }} @else NA @endif</td>
								
									<td class="text-center">
										<a class="btn btn-sm btn-dark pointer bt role_manager_id" href="javascript:void(0)" data-toggle="modal" data-target="#exampleModal" data-id="{{$district->id}}" data-name="{{$district->city}}" data-description="{{$district->description}}" data-trial_from_date="{{$district->trial_from_date}}" data-trial_to_date="{{$district->trial_to_date}}" >
											<i class="far fa-edit"></i>
										</a>

									</td>
								</tr>
								@endforeach
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
	</div>


</div>


@endsection
<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">Update District Name</h5>
				<button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span></button>

			</div>
			<form action="{{ route('updateDistrict') }}" class="needs-validation" method="post" autocomplete="off">
				@csrf
				<div class="modal-body">
					<div class="row">
						<div class="col-md-12">
							<div class="form-group">
								<label for="name">District Name</label>
								<input type="hidden" class="form-control" id="district_id" name="id">
								<input type="text" class="form-control" id="name" name="name" required>
								<div class="invalid-feedback">
									Please provide District.
								</div>
								@if ($errors->has('name'))
								<span class="error_mess">{{ $errors->first('name') }}</span> @endif
							</div>
						</div>
						<div class="col-md-12">
							<div class="form-group">
								<label for="name">Description</label>

								<textarea id="description" name="description" class="form-control" placeholder="Enter Description"></textarea>

								<div class="invalid-feedback">
									Please provide Description.
								</div>
								@if ($errors->has('description'))
								<span class="error_mess">{{ $errors->first('description') }}</span> @endif
							</div>
						</div>

						<div class="col-md-6">
							<div class="form-group">
								<label for="name">Trial From Date</label>

								
								<input type="date" class="form-control" id="trial_from_date" oninput="trial_from_datee(this.value)" name="trial_from_date" required>
								<div class="invalid-feedback">
									Please provide Trial From Date.
								</div>
								@if ($errors->has('trial_from_date'))
								<span class="error_mess">{{ $errors->first('trial_from_date') }}</span> @endif
							</div>
						</div>


						<div class="col-md-6">
							<div class="form-group">
								<label for="name">Trial to Date</label>

							
								<input type="date" class="form-control" id="trial_to_date" name="trial_to_date" required>
								<div class="invalid-feedback">
									Please provide Trial to Date.
								</div>
								@if ($errors->has('trial_to_date'))
								<span class="error_mess">{{ $errors->first('trial_to_date') }}</span> @endif
							</div>
						</div>
					</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
					<button class="btn btn-primary" type="submit">Submit/दर्ज करे</button>
				</div>
			</form>
		</div>
	</div>
</div>

@push( 'custom-scripts' )
<script type="text/javascript">
	//update==========================
	$('.role_manager_id').click(function() {
		var district_id = $(this).data('id');
		var name = $(this).data('name');
		var description = $(this).data('description');


		var trial_from_date = $(this).data('trial_from_date');

		var trial_to_date = $(this).data('trial_to_date');
		$('#description').val(description);

		$('#trial_from_date').val(trial_from_date);
		$('#trial_to_date').val(trial_to_date);
		$('#district_id').val(district_id);
		$('#name').val(name);
	});

    function trial_from_datee(value){
		$('#trial_to_date').val('');
		$('#trial_to_date').attr('min', value);
	
	}



	//change sport status
	function sportStatus(id) {
		$.ajax({
			type: "GET",
			url: ajaxUrl + "/admin/districtStatus/" + id,
			dataType: "text",
			success: function(res) {
				success(res.msg);
			},
		});
	}


	//Delete sport
	// function deleteDivision( id ) {
	// 	Swal.fire( {
	// 		title: "Are you sure?",
	// 		text: "You won't be able to revert this!",
	// 		icon: "warning",
	// 		showCancelButton: true,
	// 		confirmButtonColor: "#3085d6",
	// 		cancelButtonColor: "#d33",
	// 		confirmButtonText: "Yes, delete it!",
	// 	} ).then( ( result ) => {
	// 		if ( result.isConfirmed ) {
	// 			$.ajax( {
	// 				type: "GET",
	// 				url: ajaxUrl + "/deleteDivision/" + id,
	// 				dataType: "json",
	// 				success: function ( res ) {
	// 					success( res.msg );
	// 					$( "#responsive" ).load( " #responsive" );
	// 					tableRendor();
	// 				},
	// 			} );
	// 		}
	// 	} );
	// }
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
			XLSX.writeFile(wb, fn || ('District List.' + (type || 'xlsx')));
	}
</script>
@endpush
