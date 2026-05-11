@extends( 'layouts/admin_layout' )
@section( 'content' )

<div class="row">
	<div class="col-md-12">
		<div class="pageheader" id="menu-margin">
			<h4 class="mb-0">Create Regional Sports Master </h4>
		</div>
		<div class="card mb-3">
			<div class="card-body">
				<form action="{{ route('saveRegionalMaster') }}" class="needs-validation" novalidate method="post" autocomplete="off">
					@csrf
					<div class="row">
						
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
								<label for="name">Regional Sports Office <span class="text-danger">*</span></label>
								<input type="text" class="form-control alphanumeric" id="regional_name" name="regional_name" value="{{ old('regional_name') }}" placeholder="Enter Regional Name" required>
								<div class="invalid-feedback">
									Please provide Regional Name.
								</div>
								@if ($errors->has('regional_name'))
								<span class="error_mess">{{ $errors->first('Regional_name') }}</span> @endif
							</div>
						</div>
                        <div class="col-md-4">
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
			<h4 class="mb-0">Regional Master List
			</h4>
		</div>
		<div class="card">
			<div class="card-body">
				<div class="table-responsive">
					<table id="dataTable" class="table table-bordred table-hover bg-white datatable">
						<thead>
							<tr>
								<th width="10%">S.No.</th>
								<th width="20%">Regional Name</th>
								<th width="20%">District Name</th>	
                                <th width="10%" class="text-center">Status</th>							
								<th class="text-center">Edit</th>
								<th class="text-center">Delete</th>
							</tr>
						</thead>
						<tbody>
							@foreach($regional as $key=>$reg)
							<tr>

								<td>{{ $key+1 }}</td>
								<td>{{ $reg->regional_name }}</td>
								<td>{{ $reg->city }}</td>	
                                <td class="text-center">
                                <div class="form-control2">
                                <label class="switch">
                                <input type="checkbox" id="themeskin{{ $key+1 }}"
                                <?php if ($reg->status == 1) {
                                echo "checked";
                                } elseif ($reg->status == 0) {
                                echo "";
                                } else {
                                echo "checked";
                                } ?>>
                               <div class="slider round" onclick="districtStatus('{{$reg->id}}')">
                               <?php if ($reg->status == 1) {
                                  echo "<span class='on'>Enable</span>";
                                }
                               if ($reg->status == 0) {
                                   echo "<span class='off'>Disable</span>";
                               }  ?>
                                        </div>
                                    </label>
                                </div>
									</td>							
								<td class="text-center">
									<a class="btn btn-sm btn-dark pointer bt role_manager_id" href="javascript:void(0)" data-toggle="modal" data-target="#exampleModal" data-id="{{$reg->id}}" data-name="{{$reg->regional_name}}" data-district="{{$reg->city_id}}">
										<i class="far fa-edit"></i>
									</a>
								</td>
								<td class="text-center">
									<a class="btn btn-sm btn-danger pointer bt px-2" href="{{url('/admin/delete-regional-master/')}}/{{$reg->id}}" onclick="return confirm('Are you sure you want to delete ?')">
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
				<h5 class="modal-title" id="exampleModalLabel">Update Regional Name</h5>
				<button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span></button>

			</div>
			<form action="{{ route('updateRegionalMaster') }}" class="needs-validation" method="post" autocomplete="off">
				@csrf
				<div class="modal-body">
					<div class="row">
						
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
								<label for="name">Regional Name</label>
								<input type="hidden" class="form-control" id="regional_id" name="id">
								<input type="text" class="form-control alphanumeric" id="regional_name" name="regional_name" required>
								<div class="invalid-feedback">
									Please provide Regional.
								</div>
								@if ($errors->has('regional_name'))
								<span class="error_mess">{{ $errors->first('regional_name') }}</span> @endif
							</div>
						</div>			
						
					</div>

				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
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
		var regional_id = $(this).data('id');
		var regional_name = $(this).data('name');
		var district = $(this).data('district');
		
		$('#district').val(district);
		$('#regional_id').val(regional_id);
		$('#regional_name').val(regional_name);
	});

	//Delete Hostel Division
	function deleteRegionalMaster(id) {
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
					url: ajaxUrl + "/deleteRegionalMaster/" + id,
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

    //change division status
	function districtStatus(id) {
        //alert(id);
		$.ajax({
                type: "GET",
                url: ajaxUrl + "/admin/regionalStatus/" + id,
                dataType: "text",
                success: function(res) {
                success(res.msg);
                console.log("url"+res);
                window.location.href =  ajaxUrl + "/admin/create-regional/";
			  },
		});
	}
</script>
@endpush
