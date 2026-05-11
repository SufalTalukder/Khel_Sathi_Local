@extends( 'layouts/admin_layout' )
@section( 'content' )

<div class="row">
	<div class="col-md-12">
		<div class="pageheader" id="menu-margin">
			<h4 class="mb-0">Create Stadium Master </h4>
		</div>
		<div class="card mb-3">
			<div class="card-body">
				<form action="{{ route('saveStudiumMaster') }}" class="needs-validation" novalidate method="post" autocomplete="off">
					@csrf
					<div class="row">
						<div class="col-md-3">
							<div class="form-group">
								<label for="name">Stadium Name <span class="text-danger">*</span></label>
								<input type="text" class="form-control alphanumeric" id="studium_name" name="studium_name" value="{{ old('studium_name') }}" placeholder="Enter Stadium Name" required>
								<div class="invalid-feedback">
									Please provide Stadium Name.
								</div>
								@if ($errors->has('studium_name'))
								<span class="error_mess">{{ $errors->first('studium_name') }}</span> @endif
							</div>
						</div>
						<div class="col-md-3">
							<div class="form-group">
								<label for="name">District <span class="text-danger">*</span></label>
								<select class="form-select" id="district" name="district" value="{{ old('district') }}" required>
									<option selected="" disabled="" value="">Select Distrct</option>
									@foreach($districts as $key=>$district)
									<option value="{{ $district->id }}" data-badge="">{{$district->city}}</option>
									@endforeach
								</select>
								<div class="invalid-feedback">
									Please provide District.
								</div>
							</div>
							@if ($errors->has('district'))
							<span class="error_mess">{{ $errors->first('district') }}</span>
							@endif
						</div>
						<div class="col-md-3">
							<div class="form-group">
								<label for="name">Longitude <span class="text-danger">*</span></label>
								<input type="text" class="form-control alphanumeric" id="longitude" name="longitude" value="{{ old('longitude') }}" placeholder="Enter Stadium Longitude" required>
								<div class="invalid-feedback">
									Please provide Longitude.
								</div>
								@if ($errors->has('longitude'))
								<span class="error_mess">{{ $errors->first('longitude') }}</span> @endif
							</div>
						</div>
						<div class="col-md-3">
							<div class="form-group">
								<label for="name">Latitude <span class="text-danger">*</span></label>
								<input type="text" class="form-control alphanumeric" id="latitude" name="latitude" value="{{ old('latitude') }}" placeholder="Enter Stadium Latituse" required>
								<div class="invalid-feedback">
									Please provide Latitude.
								</div>
								@if ($errors->has('latitude'))
								<span class="error_mess">{{ $errors->first('latitude') }}</span> @endif
							</div>
						</div>
						<div class="col-md-2 d-grid">
							<button class="btn btn-primary form-group" type="submit">Submit/दर्ज करे</button>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>


	<div class="col-md-12">
		<div class="pageheader" id="menu-margin">
			<h4 class="mb-0">Stadium Master List
			</h4>
		</div>
		<div class="card">
			<div class="card-body">
				<div class="table-responsive">
					<table id="dataTable" class="table table-bordred table-hover bg-white datatable">
						<thead>
							<tr>
								<th width="10%">S.No.</th>
								<th width="20%">Stadium Name</th>
								<th width="20%">District Name</th>
								<th width="20%">Longitude</th>
								<th width="20%">latitude</th>
								<th class="text-center">Edit</th>
								<th class="text-center">Delete</th>
							</tr>
						</thead>
						<tbody>
							@foreach($studiums as $key=>$studium)
							<tr>

								<td>{{ $key+1 }}</td>
								<td>{{ $studium->studium_name }}</td>
								<td>{{ $studium->city }}</td>
								<td>{{ $studium->longitude }}</td>
								<td>{{ $studium->latitude }}</td>
								<td class="text-center">
									<a class="btn btn-sm btn-dark pointer bt role_manager_id" href="javascript:void(0)" data-toggle="modal" data-target="#exampleModal" data-id="{{$studium->id}}" data-name="{{$studium->studium_name}}" data-longitude="{{$studium->longitude}}" data-latitude="{{$studium->latitude}}" data-district="{{$studium->city_id}}">
										<i class="far fa-edit"></i>
									</a>
								</td>
								<td class="text-center">
									<a class="btn btn-sm btn-danger pointer bt px-2" href="{{url('/admin/delete-studium-master/')}}/{{$studium->id}}" onclick="return confirm('Are you sure you want to delete ?')">
										<i class="fa fa-trash"></i>
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


@endsection
<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">Update Stadium Name</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span></button>

			</div>
			<form action="{{ route('updateStudiumMaster') }}" class="needs-validation" method="post" autocomplete="off">
				@csrf
				<div class="modal-body">
					<div class="row">
						<div class="col-md-6">
							<div class="form-group">
								<label for="name">Stadium Name</label>
								<input type="hidden" class="form-control" id="studium_id" name="id">
								<input type="text" class="form-control alphanumeric" id="studium_name" name="studium_name" required>
								<div class="invalid-feedback">
									Please provide Division.
								</div>
								@if ($errors->has('studium_name'))
								<span class="error_mess">{{ $errors->first('studium_name') }}</span> @endif
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label for="name">District *</label>
								<select class="form-select" id="district" name="district" value="{{ old('district') }}" required>
									<option selected="" disabled="" value="">Select Distrct</option>
									@foreach($districts as $key=>$district)
									<option value="{{ $district->id }}" data-badge="">{{$district->city}}</option>
									@endforeach
								</select>
							</div>
							@if ($errors->has('district'))
							<span class="error_mess">{{ $errors->first('district') }}</span>
							@endif
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label for="name">Longitude *</label>
								<input type="text" class="form-control alphanumeric" id="longitude" name="longitude" required>
								<div class="invalid-feedback">
									Please provide Division.
								</div>

							</div>
							@if ($errors->has('longitude'))
							<span class="error_mess">{{ $errors->first('longitude') }}</span> @endif

						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label for="name">Latitude *</label>
								<input type="text" class="form-control alphanumeric" id="latitude" name="latitude" required>
								<div class="invalid-feedback">
									Please provide Latitude.
								</div>

							</div>
							@if ($errors->has('latitude'))
							<span class="error_mess">{{ $errors->first('latitude') }}</span> @endif

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
		var studium_id = $(this).data('id');
		var studium_name = $(this).data('name');
		var district = $(this).data('district');
		var latitude = $(this).data('latitude');
		var longitude = $(this).data('longitude');
		$('#district').val(district);
		$('#latitude').val(latitude);
		$('#longitude').val(longitude);
		$('#studium_id').val(studium_id);
		$('#studium_name').val(studium_name);
	});

	//Delete Hostel Division
	function deleteStudiumMaster(id) {
		Swal.fire({
			title: "Are you sure?",
			text: "You won't be able to revert this!",
			icon: "warning",
			showCancelButton: true,
			confirmButtonColor: "#3085d6",
			cancelButtonColor: "#d33",
			confirmButtonText: "Yes, delete it!",
		}).then((result) => {
			if (result.isConfirmed) {
				$.ajax({
					type: "GET",
					url: ajaxUrl + "/deleteStudiumMaster/" + id,
					dataType: "json",
					success: function(res) {
						success(res.msg);
						$("#responsive").load(" #responsive");
						tableRendor();
					},
				});
			}
		});
	}
</script>
@endpush
