@extends( 'layouts/admin_layout' )
@section( 'content' )


<div class="pageheader" id="menu-margin">
	<h4 class="mb-0">Sport College Master</h4>
</div>
<div class="card mb-3">
	<div class="card-body">
		<form action="{{ route('saveSportMaster') }}" class="needs-validation" method="post" autocomplete="off">
			@csrf
			<div class="row">
				<div class="col-md-4">
					<div class="form-group">
						<label for="name">College Name *</label>
						<input type="text" class="form-control" id="name" name="name" value="{{ old('name') }}" placeholder="Enter college Name" required="">
						<div class="invalid-feedback">
							Please Provide College Name.
						</div>
						@if ($errors->has('name'))
						<span class="error_mess">{{ $errors->first('name') }}</span> @endif
					</div>
				</div>
				<div class="col-md-4">
					<div class="form-group">
						<label for="name">Collage Address *</label>
						<input type="text" class="form-control" id="c_address" name="c_address" value="{{ old('c_address') }}" placeholder="Enter College Address" required="">
						<div class="invalid-feedback">
							Please Provide College Address .
						</div>
						@if ($errors->has('c_address'))
						<span class="error_mess">{{ $errors->first('c_address') }}</span> @endif
					</div>
				</div>
				<div class="col-md-4 mt-1">
					<div class="form-group">
						<label for="name">District*</label>
						<select class="form-control" id="district" name="district" value="{{ old('district') }}" required="">
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
				<div class="col-md-4 mt-1">
					<div class="form-group">
						<label for="gender">Gender*</label>
						<div class="form-control">
							<input type="radio" name="gender" value="1" required=""> Male &nbsp;
							<input type="radio" name="gender" value="2" required=""> Female &nbsp;
							<input type="radio" name="gender" value="3" required=""> Male & Female
						</div>
					</div>
					@if ($errors->has('gender'))
					<span class="error_mess">{{ $errors->first('gender') }}</span>
					@endif
				</div>
				<div class="col-md-2 d-grid">
					<label class="form-label">&nbsp;</label>
					<button class="btn btn-primary form-group" type="submit">Submit/दर्ज करे</button>
				</div>
			</div>
		</form>
	</div>
</div>
<div class="pageheader" id="menu-margin">
	<h4 class="mb-0">Sport List</h4>
</div>
<div class="card">

	<div class="card-body">
		<div class="table-responsive">
			<table id="dataTable" class="table table-bordred table-hover bg-white datatable">
				<thead>
					<tr>
						<th width="6%">S.No.</th>
						<th width="20%">College Name</th>
						<th width="20%">Gender</th>
						<th width="20%">College Address</th>
						<th width="20%">Districts</th>
						<th width="20%">Created At</th>
						<th width="20%">Updated At</th>
						<th class="text-center">Edit</th>
						<th class="text-center">Delete</th>
					</tr>
				</thead>
				<tbody>
					@foreach($sports as $key=>$sport)
					<tr>

						<td>{{ $key+1 }}</td>
						<td>{{ $sport->college_name }}</td>
						@if($sport->gender ==1)
						<td>Male</td>
						@elseif($sport->gender ==2)
						<td>Female</td>
						@else
						<td>Male & Female</td>
						@endif
						<td>{{ $sport->college_address }}</td>
						<td>{{ $sport->city }}</td>
						<td>{{ $sport->created_at }}</td>
						<td>{{ $sport->updated_at }}</td>
						<td class="text-center">
							<a class="btn btn-sm btn-dark pointer bt role_manager_id" href="javascript:void(0)" data-toggle="modal" data-target="#exampleModal" data-id="{{$sport->id}}" data-name="{{$sport->college_name}}" data-college_address="{{$sport->college_address}}" data-city="{{$sport->city}}" data-city_id="{{$sport->districts_id}}">
								<i class="far fa-edit"></i>
							</a>
						</td>
						<td class="text-center">
							<a class="btn btn-sm btn-danger pointer bt" href="{{url('/admin/delete-college-master/')}}/{{$sport->id}}" onclick="return confirm('Are you sure you want to delete ?')">
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



@endsection
<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">Update Sport College master</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span></button>

			</div>
			<form action="{{ route('updateCollegeMaster') }}" class="needs-validation" method="post" autocomplete="off">
				@csrf
				<div class="modal-body">
					<div class="row">
						<div class="col-md-12 mt-2">
							<div class="form-group">
								<label for="name">College Name </label>
								<input type="hidden" class="form-control" id="sport_id" name="id">
								<input type="text" class="form-control" id="name" name="name" required>
								<div class="invalid-feedback">
									Please provide District.
								</div>
								@if ($errors->has('name'))
								<span class="error_mess">{{ $errors->first('name') }}</span> @endif
							</div>
						</div>
						<div class="col-md-12 mt-2">
							<div class="form-group">
								<label for="name">Collage Address</label>
								<input type="text" class="form-control" id="c_address" name="c_address" required>
								<div class="invalid-feedback">
									Please provide Collage Address.
								</div>
								@if ($errors->has('c_address'))
								<span class="error_mess">{{ $errors->first('c_address') }}</span> @endif
							</div>
						</div>
						<div class="col-md-12 mt-2">
							<div class="form-group">
								<label for="name">District*</label>
								<select class="form-control" name="district" value="{{ old('district') }}" required="">
									<option selected="" disabled="" value="">Select Distrct</option>
									@foreach($districts as $key=>$district)
									<option value="{{ $district->id }}">{{$district->city}}</option>
									@endforeach
								</select>
							</div>
							@if ($errors->has('district'))
							<span class="error_mess">{{ $errors->first('district') }}</span>
							@endif
						</div>
						<div class="col-md-12 mt-2">
							<div class="form-group">
								<label for="name">Gender*</label>
								<label for="gender">Gender*</label><br>
								<input type="radio" name="gender" value="1" required=""> Male &nbsp;
								<input type="radio" name="gender" value="2" required=""> Female &nbsp;
								<input type="radio" name="gender" value="3" required=""> Male & Female &nbsp;
							</div>
							@if ($errors->has('gender'))
							<span class="error_mess">{{ $errors->first('gender') }}</span>
							@endif
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
		var sport_id = $(this).data('id');
		var name = $(this).data('name');

		var college_address = $(this).data('college_address');
		var city = $(this).data('city');

		$('#sport_id').val(sport_id);
		$('#name').val(name);
		$('#c_address').val(college_address);
		$('#district').val(city);
	});

	//Delete sport
	function deleteDivision(id) {
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
					url: ajaxUrl + "/deleteCollegeMaster/" + id,
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
